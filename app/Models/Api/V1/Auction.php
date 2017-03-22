<?php

namespace App\Models\Api\V1;

use App\Helpers\Api\V1\PersianLetter;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model;

class Auction extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['startAt', 'finishAt', 'deleted_at'];


    /**
     * @return int
     */
    public function getMinimumBidAmount()
    {
        $lots = (array)$this->lots;
        $lot = $lots[$this->currentLotId];

        if ($this->bidType == 'auto') {
            $priceKey = 1;

            $bidRules = (array)$this->bidRules;
            ksort($bidRules);

            foreach ($bidRules as $key => $bidRule) {
                if ($this->hottestBid <= $bidRule) {
                    $priceKey = (int)$key;
                    break;
                }
            }

            $minimumBidAmount = (int)$lot['hottestBid'] + (int)$priceKey;

            return (int)$minimumBidAmount;
        }

        $minimumBidAmount = (int)$this->hottestBid;
        return (int)$minimumBidAmount;
    }


    /**
     * @param array $value
     */
    public function setTitleAttribute(array $value)
    {
        if (isset($value['fa'])) {
            $value['fa'] = PersianLetter::changeToPersian($value['fa']);
        }
        $this->attributes['title'] = $value;
    }

    /**
     * @param array $value
     */
    public function setDescriptionAttribute(array $value)
    {
        if (isset($value['fa'])) {
            $value['fa'] = PersianLetter::changeToPersian($value['fa']);
        }
        $this->attributes['description'] = $value;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator_id()
    {
        return $this->belongsTo(User::class, 'creatorId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manager_id()
    {
        return $this->belongsTo(User::class, 'managerId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category_id()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country_id()
    {
        return $this->belongsTo(Country::class, 'countryId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner_id()
    {
        return $this->belongsTo(User::class, 'ownerId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function media_id()
    {
        return $this->belongsTo(Media::class, 'mediaId');
    }

    /**
     * @return array
     */
    public function trim()
    {
        $data = $this->toArray();
        $data['auctionId'] = $this->id;
        return $data;
    }

    /**
     * @return array
     */
    public function trimEmbed()
    {
        $data = $this->toArray();
        $data['auctionId'] = $this->id;
        $data = ['auction' => $data];
        return $data;
    }
}
