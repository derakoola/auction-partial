<?php

namespace App\Events\Api\V1\Auction;

use App\Events\Api\V1\Event;
use App\Models\Api\V1\Auction;
use Illuminate\Queue\SerializesModels;

class MessageSavedEvent extends Event
{
    use SerializesModels;

    public $auction;
    public $message;


    /**
     * MessageSavedEvent constructor.
     * @param Auction $auction
     * @param array $message
     */
    public function __construct(Auction $auction, array $message)
    {
        $this->auction = $auction;
        $this->message = $message;
    }
}
