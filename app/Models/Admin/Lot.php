<?php

namespace App\Models\Admin;

use App\Helpers\Api\V1\PersianLetter;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model;

class Lot extends Model
{
    use SoftDeletes;


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $dates = ['deleted_at'];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }

    public function auction()
    {
        return $this->belongsTo(Auction::class, 'auctionId');
    }
    public function creator_id()
    {
        return $this->belongsTo(User::class, 'creatorId');
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
    public function trim()
    {
        $data = $this->toArray();
        $data['lotId'] = $this->id;
        return $data;
    }
}
