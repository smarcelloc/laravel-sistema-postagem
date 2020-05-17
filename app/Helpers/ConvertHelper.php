<?php

namespace App\Helpers;

use DateTime;
use DateTimeZone;

class ConvertHelper
{
    public static function title($value)
    {
        return mb_convert_case($value, MB_CASE_TITLE);
    }

    public static function lower($value)
    {
        return mb_convert_case($value, MB_CASE_LOWER);
    }

    public static function upper($value)
    {
        return mb_convert_case($value, MB_CASE_UPPER);
    }

    public static function datetime($value, $timezone = 'UTC', $format = 'd/m/Y H:i')
    {
        $datetime = new DateTime($value);
        $datetime->setTimezone(new DateTimeZone($timezone));


        return  $datetime->format($format) . ($datetime->format('I') == '1' ? ' Horário de verão':'');

    }

    public static function date($value, $format = 'd/m/Y')
    {
        return date($format, strtotime($value));
    }
}
