<?php

namespace App\Listeners\Api\V1\Auction;

use App\Events\Api\V1\Auction\NewBidRequestedEvent;
use App\Helpers\Api\V1\MakeResponse;
use Illuminate\Support\Facades\Redis;

class PublishNewBidListener
{

    /**
     * @param NewBidRequestedEvent $event
     * @return bool
     */
    public function handle(NewBidRequestedEvent $event)
    {


        $bidAccepted = 'pending';
        if ($auction->bidAcceptance == 'auto') {
            $bidAccepted = 'yes';
            $lot['stage'] = null;
        }

        $bids = isset($lot['bids']) ? (array)$lot['bids'] : [];

        $prices = [];
        foreach (ApiHelper::getCurrencyKeys() as $otherPrice) {
            $prices[$otherPrice] = ApiHelper::convert('usd', $otherPrice, $price);
        }

        $newBidOrder = (int)count($bids) + 1;
        $bids[$newBidOrder] = [
            '_order' => $newBidOrder,
            'prices' => $prices,
            'bidder' => $this->user->trimEmbed(),
            'showBidderIdentity' => ($this->data['showBidderIdentity'] === 'yes') ? true : false,
            'bidAccepted' => $bidAccepted,
            'bidAt' => new \MongoDate()
        ];

        $lots = $auction->lots;
        if ($bidAccepted == 'yes') {
            $lot['hottestBid'] = $price;
            $lot['hottestBidderId'] = $this->user->id;
            $lot['stage'] = null;
        }
        $lot['bids'] = $bids;
        $lots[$this->data['lotId']] = $lot;
        $auction->lots = $lots;
        $auction->save();


        $newBid = $event->auction->lots[$event->auction->currentLotId]['bids'][$event->newBidOrder];

        // set type and data
        $data['type'] = 'newBid';
        $data['newBid'] = $newBid;

        // send to the manager
        if ($event->auction->bidAcceptance != 'auto') {
            $channelName = 'channel_manager_' . (string)$event->auction->id . '_' . (string)$event->auction->randManagerId;

            $data = MakeResponse::handle([
                MakeResponse::Status => MakeResponse::Ok,
                MakeResponse::Tag => 'newBidReceived',
                MakeResponse::Data => $data
            ]);
            $data = json_encode($data);
        } else {

            if (!$newBid['showBidderIdentity']) {
                $newBid['bidder'] = '';
                $data['newBid'] = $newBid;
            }

            // send to all
            $channelName = 'channel_' . $event->auction->id;

            $data = MakeResponse::handle([
                MakeResponse::Status => MakeResponse::Ok,
                MakeResponse::Tag => 'newBidPublished',
                MakeResponse::Data => $data
            ]);
            $data = json_encode($data);
        }

        $redis = Redis::connection();
        $redis->publish($channelName, $data);
        return true;
    }
}
