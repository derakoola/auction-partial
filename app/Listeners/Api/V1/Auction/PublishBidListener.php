<?php

namespace App\Listeners\Api\V1\Auction;

use App\Events\Api\V1\Auction\BidVerifiedEvent;
use App\Helpers\Api\V1\MakeResponse;
use Illuminate\Support\Facades\Redis;

class PublishBidListener
{

    /**
     * @param BidVerifiedEvent $event
     * @return bool
     */
    public function handle(BidVerifiedEvent $event)
    {
        $newBid = $event->auction->lots[$event->auction->currentLotId]['bids'][$event->newBidOrder];
        if (!$newBid['showBidderIdentity']) {
            $newBid['bidder'] = '';
        }

        // set type and data
        $data['type'] = 'newBid';
        $data['newBid'] = $newBid;

        // send to all
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
