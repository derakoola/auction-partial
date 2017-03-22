<?php

namespace App\Http\Requests\Api\V1\Auction;

use App\Http\Requests\Api\V1\Request;

class NewBidAuctionRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'lotId' => 'required|string|min:1|max:255',
            'bidAmount' => 'required|int|min:1',
            'showBidderIdentity' => 'required|in:no,yes'
        ];
    }
}
