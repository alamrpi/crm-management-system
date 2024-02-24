<?php

namespace App\Utility;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Helpers
{
    public static function SerialCalculateForPage($recordPerPage){
        return (request()->input('page', '1') - 1) * $recordPerPage;
    }

    /**
     * @throws \Exception
     */
    public static function GetAgencyId()
    {
        $user = Auth::user();
        if($user != null)
           return $user->agency_id;

        throw new \Exception("Agency Id not found. May be user not login");
    }

    public static function ConvertDateFormat(string $date, $format = "d/m/y")
    {
        return date($format, strtotime($date));
    }

    public static function DateHumanReadable(string $date)
    {
        $pastDateTime = Carbon::parse($date);
        return $pastDateTime->diffForHumans(Carbon::now());
    }
    public static function GetFirstChar($name)
    {
        return str_split($name, 1)[0];
    }

    public static function getParamValue($paramName)
    {
        return Route::input($paramName);
    }

    public static function getUserId(){
        return Auth::id();
    }

    public static function replaceUserName($content, $user_id, $user_name)
    {
        return str_replace('[-user_name-]', Auth::id() == $user_id ? 'You' : $user_name, $content);
    }

    public static function throughError($message, $code = 0){
        if ($code)
            throw new \RuntimeException($message, $code);
        throw new \RuntimeException($message);
    }

    public static function getDatesArray(int $month, $year){
        $range = date('t', mktime(0, 0, 0, $month, 1, $year));
        return range(1, $range);
    }
}
