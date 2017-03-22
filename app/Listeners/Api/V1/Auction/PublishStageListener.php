<?php

namespace App\Listeners\Api\V1\Auction;

use App\Events\Api\V1\Auction\NextStageCalledEvent;
use App\Helpers\Api\V1\MakeResponse;
use Illuminate\Support\Facades\Redis;

class PublishStageListener
{

    /**
     * @param NextStageCalledEvent $event
     * @return bool
     */
    public function handle(NextStageCalledEvent $event)
    {
        if ($event->lot['stage'] != 'sold') {
            $data = $this->nextStage($event);
        } else {
            $data = $this->lotSold($event);
        }

        // prepare data
        $data = MakeResponse::handle([
            MakeResponse::Status => MakeResponse::Ok,
            MakeResponse::Tag => 'newStagePublished',
            MakeResponse::Data => $data
        ]);
        $data = json_encode($data);

        // send to all
        $channelName = 'channel_' . $event->auction->id;
        $redis = Redis::connection();
        $redis->publish($channelName, $data);

        return true;
    }


    /**
     * @param NextStageCalledEvent $event
     * @return array
     */
    private function nextStage(NextStageCalledEvent $event)
    {
        $data = [
            'type' => 'nextStage',
            'nextStage' => [
                'stage' => $event->lot['stage']
            ]
        ];

        return $data;
    }


    /**
     * @param NextStageCalledEvent $event
     * @return array
     */
    private function lotSold(NextStageCalledEvent $event)
    {
        $currentLotId = (string)$event->auction->currentLotId;
        $_order = (int)$event->auction->lots[$currentLotId]['_order'];
        $nextOrder = $_order + 1;

        $lots = (array)$event->auction->lots;
        foreach ($lots as $lotId => $item) {
            if ($item['_order'] == $nextOrder) {
                $nextLotId = $lotId;
                break;
            }
        }

        if (!isset($nextLotId)) {
            $event->auction->status = 'finished';
            $event->auction->save();

            return [
                'type' => 'auctionFinished',
                'auctionFinished' => []
            ];
        }

        $event->auction->currentLotId = $nextLotId;
        $event->auction->save();

        $data = [
            'type' => 'nextLot',
            'nextLot' => [
                'lot' => $lots[$nextLotId]
            ]
        ];

        return $data;
    }
}
