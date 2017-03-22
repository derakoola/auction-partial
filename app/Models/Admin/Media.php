<?php

namespace App\Models\Admin;

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
