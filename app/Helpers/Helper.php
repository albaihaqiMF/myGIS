<?php

namespace App\Helpers;

use Carbon\Carbon;
use DateTime;

class Helper
{
    public static function diffTime($time2, $time1 = null)
    {
        $fdate = $time1 ?? today();
        $tdate = $time2;
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $formatedInterval = ($interval->format('%a') * 24 * 60)
            + ($interval->format('%h') * 60)
            + $interval->format('%i');

        return $formatedInterval;
    }

    public static function getAge($date)
    {
        return Carbon::parse($date)->diff(today())->format('%m months and %d days');
    }
}
