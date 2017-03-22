<?php

namespace App\Jobs\Api\V1\Auction;

use App\Helpers\Api\V1\ApiHelper;
use App\Helpers\Api\V1\MakeResponse;
use App\Jobs\Api\V1\Job;
use App\Models\Api\V1\Auction;
use App\Models\Api\V1\User;
use Carbon\Carbon;

class IndexAuctionJob extends Job
{
    private $user;
    private $data;


    /**
     * IndexAuctionJob constructor.
     * @param User|null $user
     * @param array $data
     */
    public function __construct(User $user = null, array $data)
    {
        $this->user = $user;
        $this->data = $data;
    }


    /**
     * @return array
     */
    public function handle()
    {
        // get auctions
        $items = Auction::where('status', '=', $this->data['status'])->orderBy('created_at', 'DESC');


        // check date
        $date = Carbon::now();
        if ((string)$this->data['date'] != '') {
            $date = new Carbon((string)$this->data['date']);
        }
        $items->where('startAt', '<', $date)->where('finishAt', '>', $date);


        // check type
        if (in_array($this->data['type'], ApiHelper::getLotTypes())) {
            $items->where('type', $this->data['type']);
        }

        // check category
        if ((string)$this->data['categoryId'] != '') {
            $items->where('categoryId', (string)$this->data['categoryId']);
        }


        // check country
        if ((string)$this->data['countryId'] != '') {
            $items->where('countryId', (string)$this->data['countryId']);
        }

        $items = $items->simplePaginate(config('general.defaultPaginate'));

        // trim data
        $auctions = [];
        foreach ($items as $auction) {
            $auctions[] = $auction->trim();
        }

        $data = [
            'auctions' => $auctions,
            'paginate' => ApiHelper::getSimplePaginate($items),
        ];

        return MakeResponse::handle([
            MakeResponse::Status => MakeResponse::Ok,
            MakeResponse::Tag => 'auctionsIndexed',
            MakeResponse::Data => $data
        ]);
    }
}
