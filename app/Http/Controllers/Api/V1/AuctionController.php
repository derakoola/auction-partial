<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\Auction\AddLotToAuctionRequest;
use App\Http\Requests\Api\V1\Auction\CanBidAuctionRequest;
use App\Http\Requests\Api\V1\Auction\IndexAuctionRequest;
use App\Http\Requests\Api\V1\Auction\JoinAuctionRequest;
use App\Http\Requests\Api\V1\Auction\NewBidAuctionRequest;
use App\Http\Requests\Api\V1\Auction\PendingBidsAuctionRequest;
use App\Http\Requests\Api\V1\Auction\PendingUsersAuctionRequest;
use App\Http\Requests\Api\V1\Auction\PublishAuctionRequest;
use App\Http\Requests\Api\V1\Auction\PublishMessageAuctionRequest;
use App\Http\Requests\Api\V1\Auction\RequestToBidAuctionRequest;
use App\Http\Requests\Api\V1\Auction\StoreAuctionRequest;
use App\Http\Requests\Api\V1\Auction\VerifyBidAuctionRequest;
use App\Http\Requests\Api\V1\Auction\VerifyUserToBidAuctionRequest;
use App\Jobs\Api\V1\Auction\AddLotToAuctionJob;
use App\Jobs\Api\V1\Auction\CanBidAuctionJob;
use App\Jobs\Api\V1\Auction\IndexAuctionJob;
use App\Jobs\Api\V1\Auction\JoinAuctionJob;
use App\Jobs\Api\V1\Auction\NewBidAuctionJob;
use App\Jobs\Api\V1\Auction\NextStageAuctionJob;
use App\Http\Requests\Api\V1\Auction\NextStageAuctionRequest;
use App\Jobs\Api\V1\Auction\PendingBidsAuctionJob;
use App\Jobs\Api\V1\Auction\PendingUsersAuctionJob;
use App\Jobs\Api\V1\Auction\PublishAuctionJob;
use App\Jobs\Api\V1\Auction\PublishMessageAuctionJob;
use App\Jobs\Api\V1\Auction\RequestToBidAuctionJob;
use App\Jobs\Api\V1\Auction\StoreAuctionJob;
use App\Jobs\Api\V1\Auction\VerifyBidAuctionJob;
use App\Jobs\Api\V1\Auction\VerifyUserToBidAuctionJob;

class AuctionController extends Controller
{

    /**
     * @param StoreAuctionRequest $request
     * @return mixed
     */
    public function store(StoreAuctionRequest $request)
    {
        // get user
        $user = $request->user();

        // get data
        $data = $request->only([
            'userId',
            'managerId',
            'title',
            'description',
            'mediaId',
            'type',
            'startAt',
            'finishAt',
            'categoryId',
            'countryId',
            'bidType',
            'bidAcceptance',
            'currency',
            'bidRules'
        ]);

        // store lot info
        return $this->dispatchNow(new StoreAuctionJob($user, $data));
    }


    /**
     * @param AddLotToAuctionRequest $request
     * @param $auctionId
     * @return mixed
     */
    public function addLot(AddLotToAuctionRequest $request, $auctionId)
    {

        // get user
        $user = $request->user();

        // get data
        $data = $request->only(['lotId']);
        $data['auctionId'] = (string)trim($auctionId);

        // store lot info
        return $this->dispatchNow(new AddLotToAuctionJob($user, $data));
    }


    /**
     * @param PublishAuctionRequest $request
     * @param $auctionId
     * @return mixed
     */
    public function publish(PublishAuctionRequest $request, $auctionId)
    {
        // get user
        $user = $request->user();

        // get data
        $data = ['auctionId' => (string)trim($auctionId)];

        // store lot info
        return $this->dispatchNow(new PublishAuctionJob($user, $data));
    }


    /**
     * @param IndexAuctionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexAuctionRequest $request)
    {
        // get user
        $user = $request->user();

        // get data
        $data = $request->only(['type', 'status', 'categoryId', 'countryId', 'date']);

        // store lot info
        return $this->dispatchNow(new IndexAuctionJob($user, $data));
    }


    /**
     * @param JoinAuctionRequest $request
     * @param $auctionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function join(JoinAuctionRequest $request, $auctionId)
    {
        // get user
        $user = $request->user();

        // get data
        $data = ['auctionId' => $auctionId];

        // store lot info
        return $this->dispatchNow(new JoinAuctionJob($user, $data));
    }


    /**
     * @param RequestToBidAuctionRequest $request
     * @param $auctionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function requestToBid(RequestToBidAuctionRequest $request, $auctionId)
    {
        // get user
        $user = $request->user();

        // get data
        $data = ['auctionId' => $auctionId];

        // store lot info
        return $this->dispatchNow(new RequestToBidAuctionJob($user, $data));
    }


    /**
     * @param VerifyUserToBidAuctionRequest $request
     * @param $auctionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyUserToBid(VerifyUserToBidAuctionRequest $request, $auctionId)
    {
        // get user
        $user = $request->user();

        // get data
        $data = $request->only(['userId', 'canBid', 'message']);
        $data['auctionId'] = $auctionId;

        // store lot info
        return $this->dispatchNow(new VerifyUserToBidAuctionJob($user, $data));
    }


    /**
     * @param PendingUsersAuctionRequest $request
     * @param $auctionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function pendingUsers(PendingUsersAuctionRequest $request, $auctionId)
    {
        // get user
        $user = $request->user();

        // get data
        $data = ['auctionId' => $auctionId];

        // store lot info
        return $this->dispatchNow(new PendingUsersAuctionJob($user, $data));
    }


    /**
     * @param NewBidAuctionRequest $request
     * @param $auctionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function newBid(NewBidAuctionRequest $request, $auctionId)
    {
        // get user
        $user = $request->user();

        // get data
        $data = $request->only(['lotId', 'bidAmount', 'showBidderIdentity']);
        $data['auctionId'] = $auctionId;

        // store lot info
        return $this->dispatchNow(new NewBidAuctionJob($user, $data));
    }


    /**
     * @param PendingBidsAuctionRequest $request
     * @param $auctionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function pendingBids(PendingBidsAuctionRequest $request, $auctionId)
    {
        // get user
        $user = $request->user();

        // get data
        $data = ['auctionId' => $auctionId];

        // store lot info
        return $this->dispatchNow(new PendingBidsAuctionJob($user, $data));
    }


    /**
     * @param VerifyBidAuctionRequest $request
     * @param $auctionId
     * @return mixed
     */
    public function verifyBid(VerifyBidAuctionRequest $request, $auctionId)
    {
        // get user
        $user = $request->user();

        // get data
        $data = $request->only(['lotId', 'userId', '_order', 'approve']);
        $data['auctionId'] = $auctionId;

        // store lot info
        return $this->dispatchNow(new VerifyBidAuctionJob($user, $data));
    }


    /**
     * @param PublishMessageAuctionRequest $request
     * @param $auctionId
     * @return mixed
     */
    public function publishMessage(PublishMessageAuctionRequest $request, $auctionId)
    {
        // get user
        $user = $request->user();

        // get data
        $data = $request->only('text', 'mediaId');
        $data['auctionId'] = $auctionId;

        // store lot info
        return $this->dispatchNow(new PublishMessageAuctionJob($user, $data));
    }


    /**
     * @param NextStageAuctionRequest $request
     * @param $auctionId
     * @return mixed
     */
    public function nextStage(NextStageAuctionRequest $request, $auctionId)
    {
        // get user
        $user = $request->user();

        // get data
        $data['auctionId'] = $auctionId;

        // call next stage
        return $this->dispatchNow(new NextStageAuctionJob($user, $data));
    }


    /**
     * @param CanBidAuctionRequest $request
     * @param $auctionId
     * @return mixed
     */
    public function canBid(CanBidAuctionRequest $request, $auctionId)
    {
        // get user
        $user = $request->user();

        // get data
        $data['auctionId'] = $auctionId;

        // call next stage
        return $this->dispatchNow(new CanBidAuctionJob($user, $data));
    }


}
