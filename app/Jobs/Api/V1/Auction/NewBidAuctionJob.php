<?php

namespace App\Jobs\Api\V1\Auction;

use App\Events\Api\V1\Auction\NewBidRequestedEvent;
use App\Helpers\Api\V1\MakeResponse;
use App\Jobs\Api\V1\Job;
use App\Models\Api\V1\Auction;
use App\Models\Api\V1\User;
use Carbon\Carbon;

class NewBidAuctionJob extends Job
{
    private $user;
    private $data;


    /**
     * RequestToBidAuctionJob constructor.
     * @param User $user
     * @param array $data
     */
    public function __construct(User $user, array $data)
    {
        $this->user = $user;
        $this->data = $data;
    }


    /**
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function handle()
    {
        // get auction
        $auction = Auction::where('status', '=', 'onFire')
            ->where('startAt', '<', Carbon::now())
            ->where('finishAt', '>', Carbon::now())
            ->where('_id', $this->data['auctionId'])
            ->first();
        if (!$auction) {
            return MakeResponse::handle([
                MakeResponse::Status => MakeResponse::Fail,
                MakeResponse::Tag => 'auctionNotFound'
            ]);
        }

        // check lotId
        if ((string)$auction->currentLotId !== (string)$this->data['lotId']) {
            return MakeResponse::handle([
                MakeResponse::Status => MakeResponse::Fail,
                MakeResponse::Tag => 'lotIsNotInTheFire'
            ]);
        }

        // get lot
        $lots = (array)$auction->lots;
        if (!isset($lots[(string)$auction->currentLotId])) {
            return MakeResponse::handle([
                MakeResponse::Status => MakeResponse::Fail,
                MakeResponse::Tag => 'lotNotFound'
            ]);
        }

        // get dib amount
        $bidAmount = (int)$this->data['bidAmount'];

        // get and check minimum bid amount
        $minimumBidAmount = $auction->getMinimumBidAmount();
        if ($bidAmount < $minimumBidAmount) {
            return MakeResponse::handle([
                MakeResponse::Status => MakeResponse::Fail,
                MakeResponse::Tag => 'thereAreBidsHotterThatThis'
            ]);
        }

        // save and publish new bid
        event(new NewBidRequestedEvent($this->user, $auction, $this->data));

        // response
        return MakeResponse::handle([
            MakeResponse::Status => MakeResponse::Ok,
            MakeResponse::Tag => 'bidSaved'
        ]);
    }

}
