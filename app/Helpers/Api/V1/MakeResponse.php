<?php

namespace App\Helpers\Api\V1;

use Illuminate\Support\Facades\Request;

class MakeResponse
{

    const Ok = 'ok';
    const Fail = 'fail';
    const Expire = 'expire';
    const Error = 'error';
    const Status = 'status';
    const Message = 'message';
    const Data = 'data';
    const Action = 'action';
    const Tag = 'tag';
    const Params = 'params';


    /**
     * @param array $data
     * @return array
     */
    public static function handle(array $data = [])
    {
        // check status
        if (!isset($data[self::Status])) {
            $data[self::Status] = self::Error;
        }

        // check tag
        if (!isset($data[self::Tag])) {
            $data[self::Tag] = 'error';
        }

        // set message
        $data[self::Message] = '';
        if (isset($data[self::Params])) {
            $data[self::Message] = trans('api_v1.' . $data[self::Tag], $data[self::Params]);
            unset($data[self::Params]);
        } else {
            $data[self::Message] = trans('api_v1.' . $data[self::Tag]);
        }

        // set data
        if (!isset($data[self::Data])) {
            $data[self::Data] = (object)[];
        } else {
            $data[self::Data] = (array)$data[self::Data];
        }

        $requests = Request::segments();
        unset($requests[0]);


        // set version
        if (!isset($requests[1])) {
            $requests[1] = 'v1';
        }
        $data['apiVersion'] = (int)str_replace('v', '', $requests[1]);
        unset($requests[1]);

        // set action
        $action = strtolower($requests[2]);
        unset($requests[2]);
        foreach ($requests as $request) {
            if (strlen($request) < 24) {
                $action .= ucfirst($request);
            }
        }
        $data['action'] = camel_case($action);

        return (array)$data;
    }
}
