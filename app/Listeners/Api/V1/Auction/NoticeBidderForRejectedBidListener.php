<?php

namespace App\Listeners\Api\V1\Auction;

use App\Events\Api\V1\Auction\BidRejectedEvent;
use App\Helpers\Api\V1\MakeResponse;
use App\Models\Api\V1\User;
use Illuminate\Support\Facades\Redis;

class NoticeBidderForRejectedBidListener
{

    /**
     * @param BidRejectedEvent $event
     * @return bool
     */
    public function handle(BidRejectedEvent $event)
    {
        // set type and data
        $data = [];
        $data['type'] = 'bidRejected';
        $data['bid'] = $event->bid;

        // send to all
        $bidderId = $event->bid['bidder']['user']['userId'];
        $channel = User::find($bidderId, ['id', '_id', '_randSocketId'])->getSocketId();

        $data = MakeResponse::handle([
            MakeResponse::Status => MakeResponse::Ok,
            MakeResponse::Tag => 'bidRejected',
            MakeResponse::Data => $data
        ], 200, 'array');
        $data = json_encode($data);

        $redis = Redis::connection();
        $redis->publish($channel, $data);
        return true;
    }
}
