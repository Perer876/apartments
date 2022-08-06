<?php

namespace App\Utilities;

use Carbon\Carbon;

class Helpers
{
    static function calc_date($start_date, Int $amount, String $period)
    {
        $end_date = new Carbon($start_date);
    
        if($period == 'months')
        {
            $end_date->addMonths($amount);
        }
        else
        {
            $end_date->addYears($amount);
        }
        
        return $end_date;
    }
}
