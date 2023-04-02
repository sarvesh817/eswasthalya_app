
<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('convertDateTimetoSql')) {   
    function convertDateTimetoSql($date_time) {    	
        $d = explode('/',$date_time); 
        $d2 = explode('-',$date_time);
        $newDate ='';
        if( count($d)>1 ) {
          $dm1 = $d[0]; $dm2 = $d[1]; $Y = $d[2];  
          $date1 = $dm1."-".$dm2."-".$Y; 
          $year = date("Y", strtotime($date1));
          //if($year ==1970 || $year ==1900){
          if($year == 1900){
            $date1 = $dm2."-".$dm1."-".$Y;  
          }
          $newDate = date("Y-m-d", strtotime($date1));
        } 
        else if(count($d2)>1){
            $dm1 = $d2[0]; $dm2 = $d2[1]; $Y = $d2[2];  
            $date1 = $dm1."-".$dm2."-".$Y;
            $year = date("Y", strtotime($date1));
            //if($year ==1970 || $year ==1900){
            if($year == 1900){
                $date1 = $dm2."-".$dm1."-".$Y;  
            }
          $newDate = date("Y-m-d", strtotime($date1));
        } else if(is_numeric($date_time)){
            $unix_date = ($date_time - 25569) * 86400;
            $excel_date = 25569 + ($unix_date / 86400);
            $unix_date = ($excel_date - 25569) * 86400;
            $newDate = gmdate("Y-m-d", $unix_date);
        } else{
           $newDate = date("Y-m-d");
        }
    return $newDate;

    }
}

if (!function_exists('getRecordDetails')) {   
    function getRecordDetails($tavle,$colname,$condiopns) {          
       $CI = & get_instance();
       $sql = "SELECT ".$colname." FROM ".$tavle." WHERE ".$condiopns." LIMIT 1";
        $query = $CI->db->query($sql);
        //echo $CI->db->last_query();exit; 
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data[0][$colname];
         } else {
            return '0';
         }
    }

}
if (!function_exists('getAllRecordDetails')) {   
    function getAllRecordDetails($tavle,$colname,$condiopns) {
      $colnames=[];
      $CI = & get_instance();
      $sql = "SELECT ".$colname." FROM ".$tavle." WHERE ".$condiopns;
      $query = $CI->db->query($sql);
      //echo $CI->db->last_query();exit; 
      if ($query->num_rows() > 0) {
        $data = $query->result_array();
        foreach ($data as $MERkey => $MERvalue) {
          $colnames[] = $MERvalue[$colname];
        }
        return $colnames;    

      } else {
        return $colnames;
      }

    }
}

if(!function_exists('getcustomerFeddback')){
    function getcustomerFeddback($tableName,$coloumnName,$condition){
        $CI = & get_instance();
        $sql = "SELECT ".$coloumnName." FROM ".$tableName." WHERE ".$condition;
        $query = $CI->db->query($sql);
        //echo $CI->db->last_query();exit; 
        if ($query->num_rows() > 0) {
            return $query->result_array();
            //$data = $query->result_array();
            //return $data[0][$coloumnName];
        } else {
            return false;
        }
    }
}

