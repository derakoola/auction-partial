<?php

namespace App\Models\Admin;

use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model;

class Auction extends Model
{
    use SoftDeletes;


    protected $collection  = 'auctions';
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['startAt', 'finishAt', 'deleted_at'];


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

}
