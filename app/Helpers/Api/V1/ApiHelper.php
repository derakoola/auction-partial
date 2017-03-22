<?php

namespace App\Helpers\Api\V1;

class ApiHelper
{

    /**
     * @param $items
     * @return array
     */
    public static function getSimplePaginate($items)
    {
        return [
            'count' => (int)$items->count(),
            'currentPage' => (int)$items->currentPage(),
            'firstItem' => (int)$items->firstItem(),
            'hasMorePages' => (int)$items->hasMorePages(),
            'lastItem' => (int)$items->lastItem(),
            'perPage' => (int)$items->perPage()
        ];
    }


    /**
     * @param $items
     * @return array
     */
    public static function getPaginate($items)
    {
        return [
            'count' => (int)$items->count(),
            'currentPage' => (int)$items->currentPage(),
            'firstItem' => (int)$items->firstItem(),
            'hasMorePages' => (int)$items->hasMorePages(),
            'lastItem' => (int)$items->lastItem(),
            'lastPage' => (int)$items->lastPage(),
            'perPage' => (int)$items->perPage(),
            'total' => (int)$items->total()
        ];
    }


    /**
     * @param bool $commaSeparated
     * @return array|string
     */
    public static function getAuctionStatuses($commaSeparated = false)
    {
        $data = [
            'saved',
            'onFire',
            'finished'
        ];

        if ($commaSeparated) {
            return (string)implode(',', $data);
        }

        return (array)$data;
    }


    /**
     * @param bool $commaSeparated
     * @return array|string
     */
    public static function getLotTypes($commaSeparated = false)
    {
        $data = [
            'live',
            'periodic',
            'charity'
        ];


        if ($commaSeparated) {
            return (string)implode(',', $data);
        }

        return (array)$data;
    }


    /**
     * @param bool $commaSeparated
     * @return array|string
     */
    public static function getAuctionTypes($commaSeparated = false)
    {
        $data = [
            'live',
            'periodic',
            'charity'
        ];

        if ($commaSeparated) {
            return (string)implode(',', $data);
        }

        return (array)$data;
    }


    /**
     * @param bool $commaSeparated
     * @return array|string
     */
    public static function getBidTypes($commaSeparated = false)
    {
        $data = [
            'manual',
            'auto'
        ];

        if ($commaSeparated) {
            return (string)implode(',', $data);
        }

        return (array)$data;
    }


    /**
     * @param bool $commaSeparated
     * @return array|string
     */
    public static function getBidAcceptanceTypes($commaSeparated = false)
    {
        $data = [
            'manual',
            'auto'
        ];

        if ($commaSeparated) {
            return (string)implode(',', $data);
        }

        return (array)$data;
    }

    /**
     * @param bool $commaSeparated
     * @param bool $justKeys
     * @return array|string
     */
    public static function getLocales($commaSeparated = false, $justKeys = false)
    {
        $data = [
            'fa' => ['name' => 'Persian', 'script' => 'Arab', 'native' => 'پارسی', 'regional' => 'fa_IR'],
            'en' => ['name' => 'English', 'script' => 'Latn', 'native' => 'English', 'regional' => 'en_GB'],
        ];

        if ($justKeys) {
            $data = array_keys($data);
        }

        if ($commaSeparated) {
            return (string)implode(',', $data);
        }

        return (array)$data;
    }


    /**
     * @param $from
     * @param $to
     * @param $amount
     * @return int
     */
    public static function convert($from, $to, $amount)
    {
        $from = strtolower($from);
        $to = strtolower($to);
        if ($from == $to) {
            return (int)$amount;
        }

        $currencies = self::getCurrencies();
        $from = $currencies[$from];


        $amount = $from['values'][$to] * $amount;

        return (int)round($amount);
    }


    /**
     * @param bool $commaSeparated
     * @param bool $justKeys
     * @return array|string
     */
    public static function getCurrencies($commaSeparated = false, $justKeys = false)
    {
        $toman = 4000;
        $irr = $toman * 10;

        $data = [
            'usd' => [
                "_order" => 1,
                'title' => 'U.S. Dollar',
                'symbol_left' => '$',
                'symbol_right' => '',
                'decimal_place' => 2,
                'values' => [
                    'irr' => $irr,
                    'toman' => $toman,
                ],
                'decimal_point' => '.',
                "thousand_point" => ",",
                'code' => 'USD',
            ],
            'irr' => [
                "_order" => 2,
                'title' => 'ریال',
                'symbol_left' => '',
                'symbol_right' => 'ریال',
                'decimal_place' => 0,
                'values' => [
                    'usd' => (1 / $irr),
                    'toman' => (1 / 10),
                ],
                'decimal_point' => '.',
                "thousand_point" => "،",
                'code' => 'IRR'
            ],
            'toman' => [
                "_order" => 3,
                'title' => 'تومان',
                'symbol_left' => '',
                'symbol_right' => 'تومان',
                'decimal_place' => 0,
                'values' => [
                    'usd' => (1 / $toman),
                    'irr' => 10,
                ],
                'decimal_point' => '.',
                "thousand_point" => "،",
                'code' => 'Toman',
            ],
        ];

        if ($justKeys) {
            $data = array_keys($data);
        }

        if ($commaSeparated) {
            return (string)implode(',', $data);
        }

        return (array)$data;
    }

    /**
     * @param array $bidRules
     * @return array|bool
     */
    public static function validateBidRules(array $bidRules)
    {
        ksort($bidRules);

        // validate int
        foreach ($bidRules as $key => $bidRule) {
            $bidRule = (int)$bidRule;
            if ($bidRule < 1) {
                return false;
            }
            $bidRules[$key] = $bidRule;
        }

        // check last item
        end($bidRules);
        $key = key($bidRules);
        reset($bidRules);
        if ($bidRules[$key] != 999999999999999) {
            $bidRules[$key] = 999999999999999;
        }

        // check steps
        foreach ($bidRules as $bidRule) {
            if (!isset($previousRule)) {
                $previousRule = $bidRule;
                continue;
            }

            if ($previousRule > $bidRule) {
                return false;
            }
        }

        return $bidRules;
    }


    /**
     * @param string|null $stage
     * @return null|string
     */
    public static function getNextStage($stage = null)
    {
        switch ($stage) {
            default:
                $nextStage = 'firstCall';
                break;
            case '':
                $nextStage = 'firstCall';
                break;
            case 'firstCall':
                $nextStage = 'secondCall';
                break;
            case 'secondCall':
                $nextStage = 'thirdCall';
                break;
            case 'thirdCall':
                $nextStage = 'sold';
                break;
            case 'sold':
                $nextStage = 'noMoreStage';
                break;
        }

        return $nextStage;
    }


    /**
     * @return int
     */
    public static function defaultPaginate()
    {
        return 10;
    }


    /**
     * @return array
     */
    public static function socketConnectionInfo()
    {
        $url = explode("/", url('/'));
        $host = $url[0] . '//' . $url[2];

        return [
            'host' => env("SOCKET_HOST",$host),
            'port' =>env("SOCKET_PORT",8890),
            'channel' => ''
        ];
    }

}
