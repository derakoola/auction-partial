<?php

namespace App\Jobs\Api\V1\Auction;

use App\Helpers\Api\V1\ApiHelper;
use App\Helpers\Api\V1\MakeResponse;
use App\Jobs\Api\V1\Job;
use App\Models\Api\V1\Auction;
use App\Models\Api\V1\User;
use Carbon\Carbon;

class JoinAuctionJob extends Job
{
    private $user;
    private $data;


    /**
     * JoinAuctionJob constructor.
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
        $now = Carbon::now();

        $auction = Auction::where('status', '=', 'onFire')
            ->where('startAt', '<', $now)
            ->where('finishAt', '>', $now)
            ->where('_id', $this->data['auctionId'])
            ->first();

        if (is_null($auction)) {
            return MakeResponse::handle([
                MakeResponse::Status => MakeResponse::Fail,
                MakeResponse::Tag => 'auctionNotFound'
            ]);
        }

        $data = [];

        $socket = ApiHelper::socketConnectionInfo();
        $socket['channel'] = 'channel_' . $auction->id;
        $data['socket'] = $socket;

        if ($this->user && $auction->managerId == $this->user->id) {
            $randManagerId = strtolower(str_random() . rand(10000000, 99999999));
            $auction->randManagerId = $randManagerId;
            $auction->save();

            $manage = ApiHelper::socketConnectionInfo();
            $manage['channel'] = 'channel_' . $randManagerId;
            $data['manage'] = $manage;
        }

        $data['auction'] = $auction->trim();

        // response
        return MakeResponse::handle([
            MakeResponse::Status => MakeResponse::Ok,
            MakeResponse::Tag => 'auctionJoinInfoSent',
            MakeResponse::Data => $data,
        ]);
    }

}
