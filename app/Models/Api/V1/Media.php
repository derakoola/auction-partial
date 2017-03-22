<?php

namespace App\Models\Api\V1;

use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model;

class Media extends Model
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
     * @return array
     */
    public function trim()
    {
        $data = [
            'mediaId' => $this->id,
            'status' => $this->status,
            'type' => $this->type,
            'mimeType' => $this->mimeType,
            'mediaPath' => $this->mediaPath
        ];
        return $data;
    }


    /**
     * @return array
     */
    public function trimEmbed()
    {
        $data = [
            $this->type => [
                'mediaId' => $this->id,
                'status' => $this->status,
                'type' => $this->type,
                'mimeType' => $this->mimeType,
                'mediaPath' => $this->mediaPath
            ]
        ];
        return $data;
    }


    /**
     * @return bool
     */
    public function isReady()
    {
        if ($this->status != 'ready') {
            return false;
        }

        return true;
    }


}
