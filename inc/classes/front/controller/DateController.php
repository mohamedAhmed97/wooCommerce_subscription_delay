<?php

namespace Inc\classes\front\controller;
final class DateController 
{
    public static function calcuate_date($date)
    {
        $next_date = strtotime($date);
        $today = strtotime(date("Y-m-d"));
        // number of days 
        $diff = abs(($next_date - $today)) / 60 / 60 / 24;
        return $diff;
    }
}
