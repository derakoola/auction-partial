<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\Api\V1\MakeResponse;
use App\Http\Requests\Api\V1\User\LoginUserRequest;
use App\Http\Requests\Api\V1\User\RegisterUserRequest;
use App\Jobs\Api\V1\User\LoginUserJob;
use App\Jobs\Api\V1\General\SendEmailVerificationTokenJob;
use App\Jobs\Api\V1\General\SendPhoneVerificationTokenJob;
use App\Jobs\Api\V1\User\StoreUserJob;

class UserController extends Controller
{

    /**
     * @param RegisterUserRequest $request
     * @return array
     */
    public function register(RegisterUserRequest $request)
    {
        // get data
        $data = $request->only([
            'firstName',
            'lastName',
            'email',
            'username',
            'password',
            'phone',
            'hardwareToken',
            'deviceModel',
            'osVersion',
            'appVersion'
        ]);

        // store user info
        $user = $this->dispatchNow(new StoreUserJob($data));
        if ($user['status'] != 'ok') {
            return (array)$user;
        }
        $user = $user['data']['user'];

        // send email to user to verify email address
        $this->dispatchNow(new SendEmailVerificationTokenJob($user));

        // send text to user to verify phone number
        $this->dispatchNow(new SendPhoneVerificationTokenJob($user));

        // return response
        return MakeResponse::handle([
            MakeResponse::Status => MakeResponse::Ok,
            MakeResponse::Tag => 'userRegistered',
        ]);
    }


    /**
     * @param LoginUserRequest $request
     * @return array
     */
    public function login(LoginUserRequest $request)
    {
        // get data
        $data = $request->only([
            'username',
            'password',
            'hardwareToken',
            'deviceModel',
            'osVersion',
            'appVersion'
        ]);

        // return response
        $data = (array)$this->dispatchNow(new LoginUserJob($data));
        return $data;
    }
}
