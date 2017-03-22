<?php

namespace App\Helpers\Api\V1;

class PersianLetter
{

    /**
     * @param $text
     * @return string
     */
    public static function changeToPersian($text)
    {
        if (is_null($text) || $text == '') {
            return $text;
        }

        $find = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $replace = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $text = (string)str_replace($find, $replace, $text);

        $find = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $replace = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $text = (string)str_replace($find, $replace, $text);

        $text = (string)str_replace('ي', 'ی', $text);
        $text = (string)str_replace('ﯼ', 'ی', $text);
        $text = (string)str_replace('ى', 'ی', $text);
        $text = (string)str_replace('ة', 'ه', $text);
        return (string)str_replace('ك', 'ک', $text);
    }
    

    /**
     * @param $text
     * @return string
     */
    public static function changeToEnglish($text)
    {
        if (is_null($text) || $text == '') {
            return $text;
        }

        $find = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $replace = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $text = (string)str_replace($find, $replace, $text);

        $find = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $replace = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return (string)str_replace($find, $replace, $text);
    }
}
