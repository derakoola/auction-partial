<?php

namespace App\Listeners\Api\V1\Auction;

use App\Events\Api\V1\Auction\BidAcceptedEvent;
use App\Helpers\Api\V1\MakeResponse;
use Illuminate\Support\Facades\Redis;

class PublishAcceptedBidListener
{

    /**
     * @param BidAcceptedEvent $event
     * @return bool
     */
    public function handle(BidAcceptedEvent $event)
    {
        // set type and data
        $data = [];
        $data['type'] = 'newBid';
        $data['newBid'] = $event->bid;

        // check bidder identity for share it or not
        if (!$data['newBid']['showBidderIdentity']) {
            $data['newBid']['bidder'] = '';
        }

        $channelName = 'channel_' . $event->auction->id;

        $data = MakeResponse::handle([
            MakeResponse::Status => MakeResponse::Ok,
            MakeResponse::Tag => 'newBidPublished',
            MakeResponse::Data => $data
        ], 200, 'array');
        $data = json_encode($data);

        $redis = Redis::connection();
        $redis->publish($channelName, $data);
        return true;
    }
}
