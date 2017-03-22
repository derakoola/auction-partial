<?php

namespace App\Http\Requests\Api\V1\Auction;

use App\Helpers\Api\V1\ApiHelper;
use App\Http\Requests\Api\V1\Request;

class IndexAuctionRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'string|in:' . implode(',', ApiHelper::getLotTypes()),
            'status' => 'string|in:' . implode(',', ApiHelper::getAuctionStatuses()),
            'categoryId' => 'string|min:1|max:255',
            'countryId' => 'string|min:1|max:255',
            'date' => 'date_format:Y-m-d',
            'page' => 'int|min:1',
        ];
    }
}
