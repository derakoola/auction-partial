<?php

namespace App\Jobs\Api\V1\User;

use App\Helpers\Api\V1\MakeResponse;
use App\Helpers\Api\V1\PersianLetter;
use App\Jobs\Api\V1\Job;
use App\Models\Api\V1\User;

class StoreUserJob extends Job
{
    private $data;

    /**
     * UserStoreJob constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }


    /**
     * @return array
     */
    public function handle()
    {
        $user = new User();
        $user->firstName = PersianLetter::changeToPersian($this->data['firstName']);
        $user->lastName = PersianLetter::changeToPersian($this->data['lastName']);
        $user->_email = $this->data['email'];
        $user->_emailVerifyToken = md5(md5(md5(time() . $this->data['firstName'] . uniqid() . rand())));
        $user->username = $this->data['username'];
        $user->password = bcrypt($this->data['password']);
        $user->_phone = $this->data['phone'];
        $user->_phoneVerifyToken = rand(10000, 99999);
        $user->hardwareToken = $this->data['hardwareToken'];
        $user->deviceModel = $this->data['deviceModel'];
        $user->osVersion = $this->data['osVersion'];
        $user->appVersion = $this->data['appVersion'];

        $user->save();

        return MakeResponse::handle([
            MakeResponse::Status => MakeResponse::Ok,
            MakeResponse::Tag => 'userStored',
            MakeResponse::Data => ['user' => $user]
        ]);
    }
}
