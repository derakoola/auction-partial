<?php

namespace App\Listeners\Api\V1\Auction;

use App\Events\Api\V1\Auction\NewBidRequestedEvent;
use App\Helpers\Api\V1\ApiHelper;
use App\Helpers\Api\V1\MakeResponse;
use App\Models\Api\V1\User;
use Illuminate\Support\Facades\Redis;
use MongoDB\BSON\UTCDateTime;

class SavePublishNewBidListener
{

    /**
     * @param NewBidRequestedEvent $event
     * @return bool
     */
    public function handle(NewBidRequestedEvent $event)
    {
        // get lots and lot and bids
        $lots = (array)$event->auction->lots;
        $lot = $lots[(string)$event->auction->currentLotId];
        $bids = isset($lot['bids']) ? (array)$lot['bids'] : [];

        // check status
        $bidAccepted = 'pending';
        if ($event->auction->bidAcceptance == 'auto') {
            $bidAccepted = 'yes';
            $lot['stage'] = null;
        }

        // make prices
        $prices = [];
        foreach (ApiHelper::getCurrencies(false, true) as $otherPrice) {
            $prices[$otherPrice] = ApiHelper::convert(
                $event->auction->currency,
                $otherPrice,
                (int)$event->data['bidAmount']
            );
        }

        // make and add new bid
        $newBidOrder = (int)count($bids) + 1;
        $bids[$newBidOrder] = [
            '_order' => $newBidOrder,
            'prices' => $prices,
            'bidder' => $event->user->trimEmbed(),
            'showBidderIdentity' => ($event->data['showBidderIdentity'] === 'yes') ? true : false,
            'bidAccepted' => $bidAccepted,
            'bidAt' => new UTCDateTime(strtotime(date('Y-m-d H:i:s')))
        ];
        $lot['bids'] = $bids;

        // add bidder info
        if ($bidAccepted == 'yes') {
            $lot['hottestBid'] = (int)$event->data['bidAmount'];
            $lot['hottestBidderId'] = $event->user->id;
            $lot['stage'] = null;
        }

        // save new bid
        $lots[(string)$event->auction->currentLotId] = $lot;
        $event->auction->lots = $lots;
        $event->auction->save();


        // get new bid to publish
        $newBid = $event->auction->lots[$event->auction->currentLotId]['bids'][$newBidOrder];

        // send to the manager
        if ($event->auction->bidAcceptance != 'auto') {

            // set type and data
            $data = [];
            $data['type'] = 'newBidRequested';
            $data['newBid'] = $newBid;

            $channelName = User::where('_id', $event->auction->managerId)->firstOrFail([
                'id',
                '_id',
                '_randSocketId'
            ])->getSocketId();

            $data = MakeResponse::handle([
                MakeResponse::Status => MakeResponse::Ok,
                MakeResponse::Tag => 'newBidReceived',
                MakeResponse::Data => $data
            ]);
            $data = json_encode($data);

            $redis = Redis::connection();
            $redis->publish($channelName, $data);
            return true;
        }

        // send to all

        // set type and data
        $data = [];
        $data['type'] = 'newBid';
        $data['newBid'] = $newBid;

        // check bidder identity for share it or not
        if (!$data['newBid']['showBidderIdentity']) {
            $data['newBid']['bidder'] = '';
        }

        $channelName = 'channel_' . $event->auction->id;

        $data = MakeResponse::handle([
            MakeResponse::Status => MakeResponse::Ok,
            MakeResponse::Tag => 'newBidPublished',
            MakeResponse::Data => $data
        ]);
        $data = json_encode($data);

        $redis = Redis::connection();
        $redis->publish($channelName, $data);
        return true;
    }
}
