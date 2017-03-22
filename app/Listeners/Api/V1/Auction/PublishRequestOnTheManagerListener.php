<?php

namespace App\Listeners\Api\V1\Auction;

use App\Events\Api\V1\Auction\UserRequestedToBidEvent;
use App\Helpers\Api\V1\MakeResponse;
use Illuminate\Support\Facades\Redis;

class PublishRequestOnTheManagerListener
{


    /**
     * @param UserRequestedToBidEvent $event
     * @return bool
     */
    public function handle(UserRequestedToBidEvent $event)
    {
        // set type and data
        $data['type'] = 'userRequestedToBid';
        $data['userRequestedToBid'] = ["user" => $event->user->trimEmbed()];

        $data = MakeResponse::handle([
            MakeResponse::Status => MakeResponse::Ok,
            MakeResponse::Tag => 'userRequestedToBid',
            MakeResponse::Data => $data
        ], 200, 'array');
        $data = json_encode($data);

        $channelName = 'channel_manager_' . (string)$event->auction->id . '_' . (string)$event->auction->randManagerId;

        $redis = Redis::connection();
        $redis->publish($channelName, $data);

        return true;
    }
}
