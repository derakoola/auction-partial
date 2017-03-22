<?php

namespace App\Listeners\Api\V1\Auction;

use App\Events\Api\V1\Auction\BidAcceptedEvent;
use App\Events\Api\V1\Auction\BidRejectedEvent;
use App\Events\Api\V1\Auction\BidVerifiedEvent;

class SavePublishVerifiedBidListener
{

    /**
     * @param BidVerifiedEvent $event
     * @return bool
     */
    public function handle(BidVerifiedEvent $event)
    {
        // get lot
        $lots = (array)$event->auction->lots;
        $currentLotId = (string)$event->auction->currentLotId;
        $lot = $lots[$currentLotId];

        // get the bid
        $bids = (array)$lot['bids'];
        $order = (int)$event->data['_order'];
        $bid = $bids[$order];


        // prepare data to save
        $bid['bidAccepted'] = $event->data['approve'];
        $bid['checkedBy'] = $event->user->trimEmbed();

        $lot['bids'][$order] = $bid;

        // bid rejected
        if ($event->data['approve'] == 'no') {

            // save result
            $lots[$currentLotId] = $lot;
            $event->auction->lots = $lots;
            $event->auction->save();

            // notice bidder
            event(new BidRejectedEvent($event->user, $event->auction, $event->data, $bid));

            // exit method
            return true;
        }

        // bid accepted

        // prepare data to save
        $lot['hottestBid'] = $bid['prices']['usd'];
        $lot['hottestBidderId'] = $bid['bidder']['user']['userId'];
        $lot['stage'] = null;


        // save result
        $lot['bids'][$order] = $bid;
        $lots[$currentLotId] = $lot;
        $event->auction->lots = $lots;
        $event->auction->save();

        // publish the event
        event(new BidAcceptedEvent($event->user, $event->auction, $event->data, $bid));

        // exit method
        return true;
    }
}
