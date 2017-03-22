<?php

namespace App\Models\Api\V1;

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
     * @return array
     */
    public function trim()
    {
        $data = $this->toArray();
        $data['lotId'] = $this->id;
        return $data;
    }

    /**
     * @return array
     */
    public function trimEmbed()
    {
        $data = $this->toArray();
        $data['lotId'] = $this->id;
        $data = ['lot' => $data];
        return $data;
    }
}
