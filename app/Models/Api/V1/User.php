<?php

namespace App\Models\Api\V1;

use Illuminate\Auth\Authenticatable;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable, SoftDeletes;


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ['firstName', 'lastName', 'username', '_email', '_permissions', '_phone','password'];
    /**
     * @return array
     */
    public function trimEmbed()
    {
        $data = [
            'user' => [
                'userId' => $this->id,
                'firstName' => $this->firstName,
                'lastName' => $this->lastName
            ]
        ];
        return $data;
    }


    /**
     * @return array
     */
    public function trim()
    {
        $data = [
            'userId' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName
        ];
        return $data;
    }


    /**
     * @return string
     */
    public function getSocketId()
    {
        $randSocketId = (string)$this->_randSocketId;
        if ($randSocketId == '') {
            $randSocketId = (string)rand(1000000000, 9999999999);
            $randSocketId = 'user_' . $this->id . '_' . $randSocketId;
            $this->_randSocketId = $randSocketId;
            $this->save();
        }

        return (string)$randSocketId;
    }
}
