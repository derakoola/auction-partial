<?php

namespace App\Events\Api\V1\Auction;

use App\Events\Api\V1\Event;
use App\Models\Api\V1\Auction;
use App\Models\Api\V1\User;

class BidRejectedEvent extends Event
{

    public $user;
    public $auction;
    public $data;
    public $bid;


    /**
     * BidRejectedEvent constructor.
     * @param User $user
     * @param Auction $auction
     * @param array $data
     * @param array $bid
     */
    public function __construct(User $user, Auction $auction, array $data, array $bid)
    {
        $this->user = $user;
        $this->auction = $auction;
        $this->data = $data;
        $this->bid = $bid;
    }
}
