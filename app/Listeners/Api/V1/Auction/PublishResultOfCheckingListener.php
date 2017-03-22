<?php

namespace App\Listeners\Api\V1\Auction;

use App\Events\Api\V1\Auction\UserCheckedToBidEvent;
use App\Helpers\Api\V1\MakeResponse;
use App\Models\Api\V1\User;
use Illuminate\Support\Facades\Redis;

class PublishResultOfCheckingListener
{


    /**
     * @param UserCheckedToBidEvent $event
     * @return bool
     */
    public function handle(UserCheckedToBidEvent $event)
    {
        $userWhoChecked = User::findOrFail($event->data['userId'], ['_id', '_randSocketId']);

        $data = $event->data['result'];
        $data['type'] = 'userCheckedToBid';

        $data = MakeResponse::handle([
            MakeResponse::Status => MakeResponse::Ok,
            MakeResponse::Tag => 'userRequestedToBid',
            MakeResponse::Data => $data
        ], 200, 'array');
        $data = json_encode($data);

        $channelName = (string)$userWhoChecked->getSocketId();

        $redis = Redis::connection();
        $redis->publish($channelName, $data);

        return true;
    }
}
