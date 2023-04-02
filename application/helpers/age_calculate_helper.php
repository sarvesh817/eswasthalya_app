<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('get_age')) {   
    function get_age($dob) {
        $CI = & get_instance();
        if($dob !=''){
            //print_r(date("m"));exit;
            list($year, $month, $day) = explode("-", $dob);
            $year_diff  = date("Y") - $year;

            if($month > date("m")){
                $month_diff = $month - date("m");    
            }else if($month < date("m")){
                $month_diff = date("m") - $month;
            }else{
                $month_diff = date("m") - $month;
            }
            
            $day_diff   = date("d") - $day;
            
            if($month_diff < 0){
                $year_diff--;
            }else if(($month_diff == 0) && ($day_diff < 0)){
                $year_diff--;
            }

            //$age = $year_diff.'-Year, '.$month_diff.'-Month, '.$day_diff.'-Days';
            $age = $year_diff;
            return $age;
            
        }else{
            return 'NA';
        }        
    }
}