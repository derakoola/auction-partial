<?php

namespace App\Http\Requests\Api\V1\User;

use App\Http\Requests\Api\V1\Request;

class RegisterUserRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'firstName' => 'required|string|min:1|max:255',
            'lastName' => 'required|string|min:1|max:255',
            'email' => 'required|email|unique:users',
            'username' => 'required|string|min:3|max:120|unique:users',
            'password' => 'required|string|min:3|max:255',
            'phone' => 'required|string|min:10|max:13|unique:users',
            'hardwareToken' => 'string|min:1|max:255',
            'deviceModel' => 'string|min:1|max:255',
            'osVersion' => 'string|min:1|max:255',
            'appVersion' => 'string|min:1|max:255'
        ];
    }
}
