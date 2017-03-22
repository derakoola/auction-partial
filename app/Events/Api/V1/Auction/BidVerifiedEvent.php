<?php

namespace App\Events\Api\V1\Auction;

use App\Events\Api\V1\Event;
use App\Models\Api\V1\Auction;
use App\Models\Api\V1\User;
use Illuminate\Queue\SerializesModels;

class BidVerifiedEvent extends Event
{
    use SerializesModels;

    public $user;
    public $auction;
    public $data;


    /**
     * BidVerifiedEvent constructor.
     * @param User $user
     * @param Auction $auction
     * @param array $data
     */
    public function __construct(User $user, Auction $auction, array $data)
    {
        $this->user = $user;
        $this->auction = $auction;
        $this->data = $data;
    }
}
