<?php

namespace App\Events\Api\V1\Auction;

use App\Events\Api\V1\Event;
use App\Models\Api\V1\Auction;
use Illuminate\Queue\SerializesModels;

class NextStageCalledEvent extends Event
{
    use SerializesModels;

    public $auction;
    public $lot;


    /**
     * NextStageCalledEvent constructor.
     * @param Auction $auction
     * @param array $lot
     */
    public function __construct(Auction $auction, array $lot)
    {
        $this->auction = $auction;
        $this->lot = $lot;
    }
}
