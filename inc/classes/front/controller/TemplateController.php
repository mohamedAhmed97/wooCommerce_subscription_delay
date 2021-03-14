<?php

namespace Inc\classes\front\controller;

use Inc\classes\admin\controller\BaseController;

final class TemplateController extends BaseController
{
    public static function calcuate_date($date)
    {
        // $date = explode(" ", $date)[0];
        $next_date = strtotime($date);
        $today = strtotime(date("Y-m-d"));
        // number of days 
        $diff = abs(($next_date - $today)) / 60 / 60 / 24;
        return $diff;
    }
}
