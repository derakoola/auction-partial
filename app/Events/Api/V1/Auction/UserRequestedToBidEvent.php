<?php

namespace App\Events\Api\V1\Auction;

use App\Events\Api\V1\Event;
use App\Models\Api\V1\Auction;
use App\Models\Api\V1\User;
use Illuminate\Queue\SerializesModels;

class UserRequestedToBidEvent extends Event
{
    use SerializesModels;

    public $auction;
    public $user;

    /**
     * UserRequestedToBidAnAuctionEvent constructor.
     * @param Auction $auction
     * @param User $user
     */
    public function __construct(Auction $auction, User $user)
    {
        $this->auction = $auction;
        $this->user = $user;
    }
}
