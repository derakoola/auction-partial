<?php

namespace App\Listeners\Api\V1\Auction;

use App\Events\Api\V1\Auction\MessageSavedEvent;
use App\Helpers\Api\V1\MakeResponse;
use Illuminate\Support\Facades\Redis;

class PublishMessageListener
{

    /**
     * @param MessageSavedEvent $event
     * @return bool
     */
    public function handle(MessageSavedEvent $event)
    {
        // send to all
        $channelName = 'channel_' . $event->auction->id;

        // set type and data
        $data['type'] = 'newMessage';
        $data['newMessage'] = [
            'message' => $event->message
        ];

        $data = MakeResponse::handle([
            MakeResponse::Status => MakeResponse::Ok,
            MakeResponse::Tag => 'newMessagePublished',
            MakeResponse::Data => $data
        ], 200, 'array');
        $data = json_encode($data);

        $redis = Redis::connection();
        $redis->publish($channelName, $data);
        return true;
    }
}
