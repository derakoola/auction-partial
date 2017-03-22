<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Api\V1\Auction\UserRequestedToBidEvent' => [
            'App\Listeners\Api\V1\Auction\PublishRequestOnTheManagerListener',
        ],
        'App\Events\Api\V1\Auction\NewBidRequestedEvent' => [
            'App\Listeners\Api\V1\Auction\SavePublishNewBidListener',
        ],
        'App\Events\Api\V1\Auction\BidVerifiedEvent' => [
            'App\Listeners\Api\V1\Auction\SavePublishVerifiedBidListener',
        ],
        'App\Events\Api\V1\Auction\MessageSavedEvent' => [
            'App\Listeners\Api\V1\Auction\PublishMessageListener',
        ],
        'App\Events\Api\V1\Auction\NextStageCalledEvent' => [
            'App\Listeners\Api\V1\Auction\PublishStageListener',
        ],
        'App\Events\Api\V1\Auction\UserCheckedToBidEvent' => [
            'App\Listeners\Api\V1\Auction\PublishResultOfCheckingListener',
        ],
        'App\Events\Api\V1\Auction\BidRejectedEvent' => [
            'App\Listeners\Api\V1\Auction\NoticeBidderForRejectedBidListener',
        ],
        'App\Events\Api\V1\Auction\BidAcceptedEvent' => [
            'App\Listeners\Api\V1\Auction\PublishAcceptedBidListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
