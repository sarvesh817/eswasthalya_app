<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('appointmentAPIRemark')) {   
    function appointmentAPIRemark($app_id) {
    if($app_id !=""){
        $CI = & get_instance();
        $sql = "SELECT ar.a_remark AS appointmentRemark FROM tbl_appointment ta LEFT JOIN tbl_appt_remark ar ON ar.a_id = ta.app_id WHERE ar.a_id IN ('".$app_id."') ORDER BY ar.a_remark_id DESC LIMIT 1";
        $query = $CI->db->query($sql);  
        //echo $CI->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->result_array();            
        } else {
            return false;
        } 
     } else{
        return false;
     }
    }
}

if(!function_exists('caseAPIRemark')) {
    function caseAPIRemark($c_id) {
        $CI = & get_instance();
        $sql ='SELECT tcr.c_remark AS caseRemark FROM tbl_case tc LEFT JOIN tbl_case_remark tcr ON tcr.c_id=tc.c_id WHERE tcr.c_id="'.$c_id.'" ORDER BY tcr.c_remark_id DESC LIMIT 1';
        $query = $CI->db->query($sql); 
        //echo $CI->db->last_query();exit;      
         if ($query->num_rows() > 0) {
            return $query->result_array();            
        } else {
            return false;
        }
    }
}