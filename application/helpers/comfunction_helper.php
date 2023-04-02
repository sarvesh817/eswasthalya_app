<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('dcTAT')) {    
    function dcTAT($dc_id) {
        $CI = & get_instance();
        $sql ="SELECT ROUND(AVG(DATEDIFF(closure_approval_date_time,app_date_time)),2) AS dctat,COUNT(app_id) AS ttlapp FROM tbl_appointment WHERE app_status='Completed' AND report_status='Completed' AND closure_approval_date_time IS NOT NULL AND closure_approval_date_time !='0000-00-00 00:00:00' AND dc_id=".$dc_id;
        $query = $CI->db->query($sql);       
         if ($query->num_rows() > 0) {
            return $query->result_array();           
        } else {
            return 'NA';
        }
    }
}

if( !function_exists('apache_request_headers') ) {
    function apache_request_headers() {
      $arh = array();
      $rx_http = '/\AHTTP_/';
      foreach($_SERVER as $key => $val) {
        if( preg_match($rx_http, $key) ) {
          $arh_key = preg_replace($rx_http, '', $key);
          $rx_matches = array();
          
          $rx_matches = explode('_', $arh_key);
          if( count($rx_matches) > 0 and strlen($arh_key) > 2 ) {
            foreach($rx_matches as $ak_key => $ak_val) $rx_matches[$ak_key] = ucfirst($ak_val);
            $arh_key = implode('-', $rx_matches);
          }
          $arh[$arh_key] = $val;
        }
      }
      return( $arh );
    }
}

if(!function_exists('maskingNumber')) {
    function maskingNumber($remarks) {
        $laststring = substr($remarks,-4);
        $Fiststring = substr($remarks,0,-4);
        $masks = strlen($Fiststring);
        $result = substr($Fiststring, 0, -$masks) . str_repeat('*', $masks);
        $result = $result.$laststring;
        return $result;
    }
}

if (!function_exists('convertDMYT_YMDT')) {   
    function convertDMY_YMD($datetime){        
        $datetime = explode('/',$datetime);
        $Ytime = explode(" ", $datetime[2]);
        $time = '';        
        if(!empty($Ytime) && count($Ytime)>1 && in_array('PM', $Ytime) ){
            $hourse = explode(":", $Ytime[1]); 
            if($hourse[0]<12){
                $hours = $hourse[0]+12;                
            } else{
                $hours = $hourse[0];
            }
            if(count($hourse)==3 && $hourse[2]!="")
                $time =  $hours.":".$hourse[1].":".$hourse[2];
            else
                $time =  $hours.":".$hourse[1].":00";

            $datetime = $Ytime[0]."-".$datetime[1]."-".$datetime[0]." ".$time;
        } 
        else if(!empty($Ytime) && count($Ytime)>1 && in_array('AM', $Ytime)){
            $hourse = explode(":", $Ytime[1]);             
            if(count($hourse)==3 && $hourse[2]!="")
                $time =  $Ytime[1];
            else
                $time =  $hourse[0].":".$hourse[1].":00";
            $datetime = $Ytime[0]."-".$datetime[1]."-".$datetime[0]." ".$time;
        } 
        else if(!empty($Ytime) && count($Ytime)>1){
            $hourse = explode(":", $Ytime[1]);             
            if(count($hourse)==3 && $hourse[2]!="")
                $time =  $Ytime[1];
            else
                $time =  $hourse[0].":".$hourse[1].":00";        

            $datetime = $Ytime[0]."-".$datetime[1]."-".$datetime[0]." ".$time;
        } else{
            $datetime = $Ytime[0]."-".$datetime[1]."-".$datetime[0];
        }   
        return $datetime;
    

    }
}
   
    
if(!function_exists('callWithiTwoHours')) {   
    function callWithiTwoHours($case_id='') {
        $CI = & get_instance();
        $sql="SELECT tcr.c_remark_id,TIMESTAMPDIFF(MINUTE, IF(TIME(tc.created_at)<'20:00:00',tc.created_at, CONCAT(DATE(tc.created_at + INTERVAL 1 DAY),' 09:00:00')),tcr.created_at) AS difft FROM tbl_case tc LEFT JOIN tbl_case_remark tcr ON tc.c_id=tcr.c_id WHERE remarks_type='TELECALLING' AND tc.c_id=".$case_id." HAVING difft <=121 ORDER BY tcr.created_at ASC LIMIT 1";               
        $query = $CI->db->query($sql);       
        
        if($query->num_rows() > 0) {
            //$data = $query->result_array();
            return "Yes";            
         } else {
            return 'No';
         }        
    }
}
if(!function_exists('totalAutoDialedCalls')) {   
    function totalAutoDialedCalls($case_id,$casetype) {
        $CI = & get_instance();
        $sql="SELECT COUNT(cc_id) AS ttlCalls FROM clicktocall_details WHERE case_id = $case_id AND call_type='SCHEDULE' AND c_type='".$casetype."' AND call_id LIKE 'UDIAL%'";               
        $query = $CI->db->query($sql);       
        
        if($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data[0]['ttlCalls'];
         } else {
            return '0';
         }        
    }
}


if (!function_exists('getBusinessChannels')) {   
    function getBusinessChannels() {
        $CI = & get_instance();
        $chanelles = [];
        $CI->db->select('channel_id,business_channel');
        $CI->db->from('business_channel');        
        $CI->db->where('status','Active'); 
        $query = $CI->db->get();
        //echo $CI->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $chnneldata = $query->result_array();
            foreach ($chnneldata as $Channelkey => $channels) {
                $chanelles[$channels['channel_id']] = $channels['business_channel'];
            }
            return $chanelles;

        } else {
            return $chanelles;
        }
    }
}

if (!function_exists('individualTestsName')) {   
    function individualTestsName($test_id='') {
        $CI = & get_instance();
        $CI->db->select('test_id,test_name');
        $CI->db->from('individual_test');        
        $CI->db->where('is_deleted','No');        
        if($test_id !=''){
            $CI->db->where('test_id',$test_id);
        }
        $query = $CI->db->get();
        //echo $CI->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data[0]['test_name'];
        } else {
            return 'NA';
        }        
    }
}

if (!function_exists('getDoorKnockStatus')) {   
    function getDoorKnockStatus($case_code = '') {
        $CI = & get_instance();
        // $query = $CI->db->query("SELECT GROUP_CONCAT(ta.door_knock) as door_knock  FROM tbl_case as tc LEFT JOIN tbl_appointment as ta ON tc.c_id = ta.c_id WHERE tc.is_deleted='No' AND ta.is_deleted='No' AND ta.app_status NOT IN('Cancelled') AND tc.case_code = '$case_code'");
        //remove case code initials
        $c_id = str_replace(array('WX0','WX','wx0','wx'), '', $case_code);
        $query = $CI->db->query("SELECT GROUP_CONCAT(door_knock) as door_knock  FROM tbl_appointment WHERE is_deleted = 'No' AND app_status NOT IN('Cancelled') AND c_id = '$c_id'");
        
        //$query = $CI->db->get();
        //echo $CI->db->last_query();exit;
        if(!empty($query)) {
            if ($query->num_rows() > 0) {
                $data = $query->row();
                $door_knock = explode(',',$data->door_knock);
                
				if(in_array('Yes',$door_knock)){
					return 'Yes';
				}else if(in_array('No',$door_knock)){
					return 'No';
				}else{
                   return 'NA'; 
                }
            } else {
                return 'NA';
            }        
        }else{
            return 'NA';
        }       
    }
}

if (!function_exists('caseAppointment')) {   
    function caseAppointment($case_id='') {
        $CI = & get_instance();
        $appdate =[];
        $sql = "SELECT DATE_FORMAT(app_date_time,'%d/%m/%Y %h-%i-%s') AS app_date_time FROM tbl_appointment  WHERE c_id = '".$case_id."' AND is_deleted = 'No' AND (app_status = 'Completed' OR app_status = 'Scheduled')";               
        $query = $CI->db->query($sql);       
        
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            foreach ($data as $Akey => $Avalue) {
                $appdate[] = $Avalue['app_date_time'];
            }
            $Appdate = implode('<br/>', $appdate);
            return $Appdate;
            
         } else {
            return '';
         }        
    }
}

if (!function_exists('packageTestsName')) {   
    function packageTestsName($test_id='') {
        $CI = & get_instance();
        $CI->db->select('test_pack_id,package_name');
        $CI->db->from('test_package');        
        $CI->db->where('is_deleted','No');        
        if($test_id !=''){
            $CI->db->where('test_pack_id',$test_id);
        }
        $query = $CI->db->get();
        //echo $CI->db->last_query();exit;
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data[0]['package_name'];
        } else {
            return 'NA';
        }        
    }
}

/*if (!function_exists('getCustomerLang')) {   
    function getCustomerLang($lang_id) {
        
        $CI = & get_instance();
        $sql = "SELECT GROUP_CONCAT(lang_name) AS custLangName FROM tbl_language WHERE ( lang_id IN (".$lang_id.") OR lang_name ='".$lang_id."' )";
        $query = $CI->db->query($sql);    
        //echo $CI->db->last_query();exit;  
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data[0]['custLangName'];
         } else {
            return 'NA';
         }
    }
}*/

if (!function_exists('getTier')) {   
    function getTier($tier_id) {
        $CI = & get_instance();
        $sql = "SELECT Tier FROM tier_details WHERE id ='".$tier_id."'";
        $query = $CI->db->query($sql);       
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data[0]['Tier'];
         } else {
            return 'NA';
         }
    }
}

if (!function_exists('getUpdatedBy')) {   
    function getUpdatedBy() {
        $CI = & get_instance();  
        $option = '<option value="">--Select--</option>';    
        $condition = "c.updated_by !=0 AND c.case_status IN('Fresh Case','Call Later - Customer asked to call back','Call Later - Customer phone switched off','Call Later - Customer not answering/available','Call Later - Customer Not Responding','Appointment Confirmed','Appointment Missed - Reschedule Appointment','Appointment Related - Partial Medicals pending','Medicals Done - Report Awaited','Reports rec’d - QC Pending','DC sent Incorrect/Incomplete Report')";        
        $sql = "SELECT u.user_id,u.name FROM tbl_case c INNER JOIN user u ON c.updated_by =u.user_id WHERE ". $condition ." GROUP BY c.updated_by";
        $query = $CI->db->query($sql);       
        if ($query->num_rows() > 0) {
            
            $updatedby = $query->result_array();
            foreach ($updatedby as $updkey => $updvalue) {
               $option .= '<option value="'.$updvalue['user_id'].'">'.$updvalue['name'].'</option>';
            }            
            return $option;
         } else {
            return $option;
         }
    }
}

if (!function_exists('getUpdatedByClosedAppList')) {   
    function getUpdatedByClosedAppList() {
        $CI = & get_instance();  
        $option = '<option value="">--Select--</option>';            
        $sql = "SELECT u.user_id,u.name FROM `tbl_appointment` app JOIN `user` u ON app.`updated_by` = u.`user_id` WHERE app.app_status='Completed' AND app.report_status='Completed' AND u.status='Approved' GROUP BY app.updated_by";
        $query = $CI->db->query($sql);       
        if ($query->num_rows() > 0) {            
            $updatedby = $query->result_array();
            foreach ($updatedby as $updkey => $updvalue) {
               $option .= '<option value="'.$updvalue['user_id'].'">'.$updvalue['name'].'</option>';
            }            
            return $option;
         } else {
            return $option;
         }
    }
}

if (!function_exists('getMERCompletedBy')) {   
    function getMERCompletedBy($created_by) {
        $completedBY="NA";
        $CI = & get_instance();
        $sql = "SELECT name FROM user WHERE user_type NOT IN ('DCUSER','ICUSER','DCAGENT') AND user_id=".$created_by;        
        $query = $CI->db->query($sql);
        if ($query->num_rows() > 0) {
            $data = $query->result_array();            
            $completedBY =  $data[0]['name'];
        } else{
             $completedBY = 'NA';
        }
        
        return $completedBY;     

    }
         
}

if (!function_exists('getDoctorName')) {   
    function getDoctorName($dr_id) {
        $CI = & get_instance();
        $sql = "SELECT dr_name FROM doctor_profile WHERE dr_id ='".$dr_id."'";
        $query = $CI->db->query($sql);       
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data[0]['dr_name'];
         } else {
            return 'NA';
         }
    }
}

if (!function_exists('getDoctorQualification')) {   
    function getDoctorQualification($edu_id) {
        $CI = & get_instance();
        if($edu_id !=""){

            $sql = "SELECT GROUP_CONCAT(qualification) AS doctorQualification FROM doctor_qualification WHERE edu_id IN (".$edu_id.")";
            $query = $CI->db->query($sql);    
            //echo $CI->db->last_query();exit;  
            if ($query->num_rows() > 0) {
                $data = $query->result_array();
                return $data[0]['doctorQualification'];
             } else {
                return 'NA';
             }
        }else{ return "NA";}
    }
}

if (!function_exists('getBranchName')) {   
    function getBranchName($branch_id) {
        $CI = & get_instance();
        if($branch_id !=""){

            $sql = "SELECT GROUP_CONCAT(branch_name) AS branch FROM branch WHERE branch_id IN (".$branch_id.")";
            $query = $CI->db->query($sql);    
            //echo $CI->db->last_query();exit;  
            if ($query->num_rows() > 0) {
                $data = $query->result_array();
                return $data[0]['branch'];
             } else {
                return 'NA';
             }
        }else{ 
            return "NA";
        }
    }
}

if (!function_exists('getUserName')) {   
    function getUserName($user_id) {
        $CI = & get_instance();
        $sql = "SELECT name FROM user WHERE user_id ='".$user_id."'";
        $query = $CI->db->query($sql);       
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data[0]['name'];
         } else {
            return 'NA';
         }
    }
}

if (!function_exists('getCityName')) {   
    function getCityName($city_id) {
        $CI = & get_instance();
        $sql = "SELECT name FROM tbl_cities WHERE id ='".$city_id."'";
        $query = $CI->db->query($sql);       
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data[0]['name'];
         } else {
            return 'NA';
         }
    }
}

if (!function_exists('getStateName')) {   
    function getStateName($state_id) {
        $CI = & get_instance();
        $sql = "SELECT state_name FROM tbl_states WHERE state_id ='".$state_id."'";
        $query = $CI->db->query($sql);       
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data[0]['state_name'];
         } else {
            return 'NA';
         }
    }
}
if (!function_exists('getStateZone')) {   
    function getStateZone($state_id) {
        $CI = & get_instance();
        $sql = "SELECT zone FROM tbl_states WHERE state_id ='".$state_id."'";
        $query = $CI->db->query($sql);       
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data[0]['zone'];
         } else {
            return '';
         }
    }
}

if (!function_exists('getICName')) {   
    function getICName($ic_id) {
        $CI = & get_instance();
        $sql = "SELECT name FROM insurance_company WHERE ic_id ='".$ic_id."'";
        $query = $CI->db->query($sql);       
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data[0]['name'];
         } else {
            return 'NA';
         }
    }
}

if (!function_exists('getDCName')) {   
    function getDCName($dc_id) {
        $CI = & get_instance();
        $sql = "SELECT center_name FROM diagnostic_center WHERE dc_id ='".$dc_id."'";
        $query = $CI->db->query($sql);       
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data[0]['center_name'];
         } else {
            return 'NA';
         }
    }
}

if(!function_exists('getMBTests')) {
    function getMBTests($c_id) {
        $CI = & get_instance();
        $sql = "SELECT tests FROM bulk_uploaded_tests WHERE c_id ='".$c_id."'";
        $query = $CI->db->query($sql);       
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data[0]['tests'];
         } else {
            return 'NA';
         }
    }
}

if (!function_exists('scheduled_tests')) {   
    function scheduled_tests($app_id='') {
        if($app_id !=''){
            $CI = & get_instance();
            $sql = "SELECT GROUP_CONCAT(tn.test_name SEPARATOR ',') AS 'scheduled_tests' FROM tbl_appointment_tests AS ct LEFT JOIN individual_test AS tn ON tn.test_id = ct.test_id  WHERE ct.app_id ='".$app_id."'";
            $query = $CI->db->query($sql);  
            if ($query->num_rows() > 0) {
                $data = $query->result_array();
                return $data[0]['scheduled_tests'];
             } else {
                return 'NA';
             }        
        } else{
            return 'NA';
        }
    }
}

if (!function_exists('scheduled_tests_price')) {   
    function scheduled_tests_price($app_id='') {
        if($app_id !=''){
            $CI = & get_instance();
            $sql = "SELECT GROUP_CONCAT(it.test_price SEPARATOR ',') AS 'ScheduledTestsPrice', GROUP_CONCAT(it.hni_test_price SEPARATOR ',') AS 'ScheduledHNITestsPrice', GROUP_CONCAT(it.test_name SEPARATOR ',') AS TestName FROM tbl_appointment_tests AS tat LEFT JOIN individual_test AS it ON it.test_id = tat.test_id LEFT JOIN test_package AS tp ON tp.test_pack_id=tat.package_id WHERE tat.app_id = '".$app_id."'";

            $query = $CI->db->query($sql);  
            if ($query->num_rows() > 0) {
                $data = $query->result_array();
                return $data;
             } else {
                return 'NA';
             }        
        } else{
            return 'NA';
        }
    }
}

if (!function_exists('gridPackageTestPrice')) {   
    function gridPackageTestPrice($c_id='',$ctype='') {
        if($c_id !=''){
            $CI = & get_instance();            
            $sql = "SELECT tc.ic_id,tp.test_pack_id,tp.test_include,tp.package_price,tp.hni_package_price,GROUP_CONCAT(tct.test_id SEPARATOR ',') AS TESTID  FROM tbl_case AS tc LEFT JOIN test_package AS tp ON tp.test_pack_id = tc.package_test LEFT JOIN tbl_case_tests AS tct ON tct.c_id = tc.c_id WHERE tc.c_id = '".$c_id."'";
            $query = $CI->db->query($sql);
            //echo $CI->db->last_query();exit; 
            if ($query->num_rows() > 0) {
                $data = $query->result_array();
                $testPData = $data[0]['test_include'];
                $alltest = $data[0]['TESTID'];
                $testPData = preg_replace('/[^A-Za-z0-9,\-]/', '', $testPData);
                //print_r($testPData); exit();       

                $NormalRs = [];
                $HNIRs = [];
                $notinpack = 0;
                if($testPData !='' && $data[0]['ic_id'] !=8){                    
                    $NormalRs[] = gowelDcrypt($data[0]['package_price']);
                    $HNIRs[]    = gowelDcrypt($data[0]['hni_package_price']);
                    $notinpack = $testPData;

                } else if($testPData !=''){
                    $NormalRs[] = gowelDcrypt($data[0]['package_price']);
                    $HNIRs[]    = gowelDcrypt($data[0]['package_price']);
                    $notinpack = 0;
                } else{
                    $NormalRs = [];
                    $HNIRs = [];
                    $notinpack = 0;
                }
                
            if($alltest !="" ){
               $sql2 = "SELECT test_price,hni_test_price,insurance_co FROM `individual_test` WHERE test_type='Normal' AND test_id IN(".$alltest.") AND test_id NOT IN(".$notinpack.")";
               
                    $query2 = $CI->db->query($sql2);
                    $data2 = $query2->result_array();
                    foreach ($data2 as $gkey => $gvalue) {

                        if($gvalue['insurance_co'] != 8){
                            $NormalRs[] =  gowelDcrypt($gvalue['test_price']);
                            $HNIRs[] =     gowelDcrypt($gvalue['hni_test_price']);
                        } else{
                            $NormalRs[] =  gowelDcrypt($gvalue['test_price']);
                            $HNIRs[] =     gowelDcrypt($gvalue['test_price']);
                        }
                    }
                }

                $NORMAL = array_sum($NormalRs);
                $HNI = array_sum($HNIRs);      

                if($ctype =="HNI"){
                    return $HNI; 
                }else{
                    return $NORMAL;
                }

             } else {
                return 'NA';
             }        
        } else{
            return 'NA';
        }
    }
}

if (!function_exists('isMERExist')) {   
    function isMERExist($c_id='') {
        if($c_id !=''){
            $CI = & get_instance();            
            $sql = "SELECT tp.`test_include`,GROUP_CONCAT(tct.`test_id` SEPARATOR ',') AS TESTID  FROM tbl_case AS tc LEFT JOIN test_package AS tp ON tp.`test_pack_id` = tc.`package_test` LEFT JOIN tbl_case_tests AS tct ON tct.`c_id` = tc.`c_id` WHERE tc.c_id = '".$c_id."'";
            $query = $CI->db->query($sql);
            //echo $CI->db->last_query();exit; 
            if ($query->num_rows() > 0) {
                $data = $query->result_array();
                $testPData = $data[0]['test_include'];
                $testIData = $data[0]['TESTID'];
                $testPData = preg_replace('/[^A-Za-z0-9,\-]/', '', $testPData);
                $alltest ="";
                $isexist = 100;
                
                if($testIData !="" && $testPData !=""){
                    $alltest = $testPData.",".$testIData;    
                } else if($testIData =="" && $testPData !=""){
                    $alltest = $testPData;    
                } elseif($testIData !="" && $testPData ==""){
                    $alltest = $testIData;    
                } else{
                    $alltest =0;
                }
                if($alltest !="" && $alltest !=0){
                    $tt = explode(',', $alltest);
                    $totaltest = count($tt);
                    if(in_array(196, $tt) && $totaltest > 1){
                        $isexist = $isexist+80;
                    }
                }
                return $isexist;
            }
        }
    }
}

if (!function_exists('Indiviual_tests')) {   
    function Indiviual_tests($c_id) {
        $CI = & get_instance();
        $sql = "SELECT GROUP_CONCAT(tn.test_name SEPARATOR ',') AS 'Indiviual' FROM tbl_case_tests AS ct LEFT JOIN individual_test AS tn ON tn.test_id = ct.test_id WHERE ct.`c_id` ='".$c_id."'";
        $query = $CI->db->query($sql);          
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data[0]['Indiviual'];
        } else {
            return 'NA';
        }        
    }
}

if (!function_exists('reportRemarks')) {   
    function reportRemarks($app_id='') {
    if($app_id !=""){
        $CI = & get_instance();
        $sql = "SELECT tr.r_remark,tr.created_at,tr.created_by FROM tbl_appointment a LEFT JOIN tbl_report_remark tr  ON tr.a_id = a.app_id WHERE tr.a_id='".$app_id."' ORDER BY tr.r_remark_id DESC LIMIT 1";
        $query = $CI->db->query($sql);  

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

if (!function_exists('appointmentRemark')) {   
    function appointmentRemark($app_id='') {
    if($app_id !=""){
        $CI = & get_instance();
        $sql = "SELECT ar.a_remark,ar.created_at,ar.created_by FROM tbl_appointment a LEFT JOIN tbl_appt_remark ar ON ar.a_id = a.app_id WHERE ar.a_id='".$app_id."' ORDER BY ar.a_remark_id DESC LIMIT 1";
        $query = $CI->db->query($sql);   
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

if (!function_exists('caseRemark')) {   
    function caseRemark($c_id,$remarks_type='') {

        $CI = & get_instance();

        if(isset($remarks_type) && $remarks_type !=''){
            $remarks_type = "AND tcr.remarks_type='".$remarks_type."'";
        }
        
        $sql ="SELECT tcr.c_remark_id,tcr.c_id,tcr.c_remark,tcr.created_at,tcr.created_by FROM tbl_case c LEFT JOIN tbl_case_remark tcr ON tcr.c_id=c.c_id WHERE tcr.c_id='".$c_id."' $remarks_type ORDER BY tcr.c_remark_id DESC LIMIT 1";
        $query = $CI->db->query($sql);       
         if ($query->num_rows() > 0) {
            return $query->result_array();            
        } else {
            return false;
        }
    }
}

if (!function_exists('lastManualCaseRemarkForPPMC')) {   
    function lastManualCaseRemarkForPPMC($c_id) {
        $CI = & get_instance();
        $sql ="SELECT tcr.c_remark_id,tcr.c_id,tcr.c_remark,tcr.created_at,tcr.created_by FROM tbl_case_remark tcr WHERE tcr.c_id='".$c_id."' AND tcr.remarks_type='MANUAL' ORDER BY tcr.c_remark_id DESC LIMIT 1";
        $query = $CI->db->query($sql);       
         if ($query->num_rows() > 0) {
            $data = $query->result_array(); 
            return $data[0]['c_remark'];
        } else {
            return 'NA';
        }
    }
}
if (!function_exists('latestManualCaseRemarkForPPMC')) {   
    function latestManualCaseRemarkForPPMC($c_id) {
        $CI = & get_instance();
        $sql ="SELECT tcr.c_remark_id,tcr.c_id,tcr.c_remark,tcr.created_at,tcr.created_by FROM tbl_case_remark tcr WHERE tcr.c_id='".$c_id."' AND tcr.remarks_type='MANUAL' AND tcr.case_status IN ('Customer is not interested','Wrong/Invalid number','Do not call','Customer has cancelled/wants to cancel the policy','Customer is not cooperating') ORDER BY tcr.c_remark_id DESC LIMIT 1";
        $query = $CI->db->query($sql);       
         if ($query->num_rows() > 0) {
            $data = $query->result_array(); 
            return $data[0]['c_remark'];
        } else {
            return 'NA';
        }
    }
}
if (!function_exists('firstCallDatetimeRemark')) {   
    function firstCallDatetimeRemark($app_id='') {
        if($app_id !=""){
            $CI = & get_instance();
            $sql = "SELECT ar.a_remark,ar.created_at,ar.created_by FROM tbl_appointment a LEFT JOIN tbl_appt_remark ar ON ar.a_id=a.app_id WHERE ar.a_id='".$app_id."' AND ar.case_status ='Appointment Confirmed' AND ar.app_status='Scheduled' ORDER BY ar.a_remark_id ASC LIMIT 1";
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

if (!function_exists('callAttemptforCallLater')) {   
    function callAttemptforCallLater($c_id) {
        $CI = & get_instance();
        $sql ="SELECT COUNT(tcr.c_remark_id) AS call_attempt FROM tbl_case c LEFT JOIN tbl_case_remark tcr ON tcr.c_id=c.c_id WHERE tcr.c_id='".$c_id."' AND tcr.case_status IN ('Call Later - Customer Not Responding','Call Later - Customer asked to call back','Call Later - Customer not answering/available','Call Later - Customer phone switched off') ORDER BY tcr.c_remark_id DESC LIMIT 1";
        $query = $CI->db->query($sql);       
         if ($query->num_rows() > 0) {
            return $query->result_array();            
        } else {
            return false;
        }
    }
}

if (!function_exists('callAttemptforAppointmentMissed')) {   
    function callAttemptforAppointmentMissed($c_id) {
        $CI = & get_instance();
        $sql ="SELECT tar.a_remark_id,ta.app_id,tar.app_status,tar.case_status,COUNT(tar.a_remark_id) AS call_attempt FROM tbl_appt_remark tar LEFT JOIN tbl_appointment ta ON ta.app_id=tar.a_id WHERE ta.c_id=".$c_id." AND tar.app_status = 'Reschedule' AND tar.case_status = 'Appointment Missed - Reschedule Appointment' GROUP BY ta.app_id ORDER BY tar.a_remark_id DESC";
        $query = $CI->db->query($sql);       
        //echo $CI->db->last_query();exit;
         if ($query->num_rows() > 0) {
            return $query->result_array();            
        } else {
            return false;
        }
    }
}

if (!function_exists('callAttemptforMER')) {   
    function callAttemptforMER($c_id) {
        $CI = & get_instance();
        $sql ="SELECT COUNT(mer_remark_id) AS call_attempt FROM mer_case_remark WHERE case_status IN ('Appointment Scheduled') AND c_id = '".$c_id."' ORDER BY mer_remark_id DESC LIMIT 1 ";
        $query = $CI->db->query($sql);       
         if ($query->num_rows() > 0) {
            $data = $query->result_array();            
            return $data[0]['call_attempt'];
        } else {
            return false;
        }
    }
}

if (!function_exists('lastCaseRemarkForMER')) {   
    function lastCaseRemarkForMER($c_id) {
        $CI = & get_instance();
        $sql ="SELECT tcr.mer_remark_id,tcr.c_id,tcr.mer_remark,tcr.created_at,tcr.created_by FROM mer_case_remark tcr WHERE tcr.c_id='".$c_id."' ORDER BY tcr.mer_remark_id DESC LIMIT 1";
        $query = $CI->db->query($sql);       
         if ($query->num_rows() > 0) {
            $data = $query->result_array(); 
            //print_r($data);exit;           
            return $data[0]['mer_remark'];
        } else {
            return false;
        }
    }
}

if (!function_exists('lastManualCaseRemarkForMER')) {   
    function lastManualCaseRemarkForMER($c_id) {
        $CI = & get_instance();
        $sql ="SELECT tcr.mer_remark_id,tcr.c_id,tcr.mer_remark,tcr.created_at,tcr.created_by FROM mer_case_remark tcr WHERE tcr.c_id='".$c_id."' AND remarks_type='MANUAL' ORDER BY tcr.mer_remark_id DESC LIMIT 1";
        $query = $CI->db->query($sql);       
         if ($query->num_rows() > 0) {
            $data = $query->result_array(); 
            //print_r($data);exit;           
            return $data[0]['mer_remark'];
        } else {
            return 'NA';
        }
    }
}

if(!function_exists('getICPriceDetails')){
    function getICPriceDetails($ic_id){
        $CI = & get_instance();
        $sql ="SELECT * FROM insurance_company ic WHERE ic.ic_id=".$ic_id;
        $query = $CI->db->query($sql);
        //echo $CI->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return $query->result_array();            
        } else {
            return false;
        }
    }
}

if (!function_exists('gowelEncrypt')) {   
    function gowelEncrypt($string) {        
        $secret_key = 'my_simple_secret_key';
        $secret_iv = 'my_simple_secret_iv';  
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );        
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        return $output;
    }
}

if (!function_exists('gowelDcrypt')) {   
    function gowelDcrypt($string) {     
        $secret_key = 'my_simple_secret_key';
        $secret_iv = 'my_simple_secret_iv';  
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );    
        return $output;
    }
}

if (!function_exists('gowelDcrypt_AES128CBC')) {   
    function gowelDcrypt_AES128CBC($string,$encrypKey) {
        
        //$OPENSSL_CIPHER_NAME = "aes-128-cbc";
        $OPENSSL_CIPHER_NAME = "AES-128-CBC";
        $CIPHER_KEY_LEN = 16; //128 bits
        $secret_key = $encrypKey;

        $iv = "";

        if (strlen($secret_key) < $CIPHER_KEY_LEN) {
            //0 pad to len 16
            $iv = str_pad($secret_key, $CIPHER_KEY_LEN, "0"); 
        }
        
        if (strlen($secret_key) > $CIPHER_KEY_LEN) {
            //truncate to 16 bytes
            $iv = substr($secret_key, 0, $CIPHER_KEY_LEN); 
        }

        $decryptedData = openssl_decrypt(base64_decode($string), $OPENSSL_CIPHER_NAME, $secret_key, OPENSSL_RAW_DATA,$iv);
        //print_r($decryptedData);exit;
        return $decryptedData;
    }
}

if (!function_exists('gowelDcrypt_AES128CBC_PKCS7PADDING')) {   
    function gowelDcrypt_AES128CBC_PKCS7PADDING($string,$encrypKey) {
        
        $OPENSSL_CIPHER_NAME = "AES-128-CBC";
        $secret_key = utf8_encode($encrypKey);
        $iv = $secret_key;
        $data = urldecode($string);
        $encryptedString = base64_decode($data);
        $decryptedData = openssl_decrypt($encryptedString, $OPENSSL_CIPHER_NAME, $secret_key, OPENSSL_RAW_DATA,$iv);
        //print_r($decryptedData);exit;
        return $decryptedData;
    }
}

if (!function_exists('gowelEncrypt_AES128CBC_PKCS7PADDING')) {   
    function gowelEncrypt_AES128CBC_PKCS7PADDING($string,$encrypKey) {

        $OPENSSL_CIPHER_NAME = "AES-128-CBC";
        $secret_key = utf8_encode($encrypKey);
        $iv = $secret_key;
        $decryptedData = openssl_encrypt($string, $OPENSSL_CIPHER_NAME, $secret_key, OPENSSL_RAW_DATA,$iv);        
        $data = base64_encode($decryptedData);
        $encryptedString = urlencode($data);
        return $encryptedString;
    }
}

if (!function_exists('gowelDcrypt_AES128CBC_PKCS7PADDING')) {   
    function gowelDcrypt_AES128CBC_PKCS7PADDING($string,$encrypKey) {
        
        $OPENSSL_CIPHER_NAME = "AES-128-CBC";
        $secret_key = utf8_encode($encrypKey);
        $iv = $secret_key;
        $data = urldecode($string);
        $encryptedString = base64_decode($data);
        $decryptedData = openssl_decrypt($encryptedString, $OPENSSL_CIPHER_NAME, $secret_key, OPENSSL_RAW_DATA,$iv);
        //print_r($decryptedData);exit;
        return $decryptedData;
    }
}

if(!function_exists('workingDays')){
    function workingDays($from, $to) {
        $workingDays = [1,2,3,4,5,6];
        $holidayDays = ["*-01-01", "*-01-26", "*-05-01", "*-08-15", "*-10-02"];
        $from = new DateTime($from);
        $to = new DateTime($to);
        $to->modify('+0 day');
        $interval = new DateInterval('P1D');
        $periods = new DatePeriod($from, $interval, $to);
        $days = 0;
        foreach ($periods as $period) {
            if (!in_array($period->format('N'), $workingDays)) continue;
            if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
            if (in_array($period->format('*-m-d'), $holidayDays)) continue;
            $days++;
        }
        return $days;
    }
}

if(!function_exists('getCaseStatus')){
    function getCaseStatus($casetype=''){

    $case_status = [
        "all" => ["Fresh Case","Call Later - Customer asked to call back","Call Later - Customer phone switched off","Call Later - Customer not answering/available","Call Later - Customer Not Responding","Appointment Confirmed","Appointment Missed - Reschedule Appointment","Appointment Related - Partial Medicals pending","Escalated to Insurance Co - Customer No Show","Escalated to Insurance Co - Customer Not Interested","Escalated to Insurance Co - Customer Not Responding/Wrong Number","Escalated to Insurance Co - Customer Not Co-operating","Escalated to Insurance Co - Other TPA Completed","Escalated to Insurance Co - Unable to find DC","Cancelled by Insurance Company - Customer Not Interested","Cancelled by Insurance Company - Customer Not Responding/Wrong number","Cancelled by Insurance Company - Customer cancelled policy","Cancelled by Insurance Company - Other TPA completed","Cancelled by Insurance Company - No DC / Unable to complete","Dummy Case - No Action Required","Medicals Done - Report Awaited","Reports rec’d - QC Pending","DC sent Incorrect/Incomplete Report","Closed - Reports submitted to insurer","Escalated to insurer - Insurance company intervention required","Immediate Action","UNASSIGNED","Cancelled by Insurance Company","Incorrect MER","MER Completed - QC Pending","Missed Appointment - Rescheduled Appointment","Appointment Scheduled","Closed - submitted to insurance","DC Closed - Lockdown","Client want medicals post lockdown","Client wants home visit - DC not available","Customer is not interested","Customer is not cooperating","Customer has cancelled/wants to cancel the policy","Wrong/Invalid number","Network Issue - Customer","Customer already completed MER - BY Other TPA","Other Discrepency","Others out of scope","Highlighted to IC – Change in DC","Highlighted to IC – Change in Visit Type","Highlighted to IC – Change in Appointment Date and Time","DOB Mismatch of Customer","Do not call","Escalated to Insurance Co - Policy cancelled as per the customer","Escalated to Insurance Co - Customer not aware of medicals","Escalated to Insurance Co - Medicals done by other policy no","Escalated to Insurance Co - Agent confirmed medicals not required","Escalated to Insurance Co - Agent confirmed policy cancelled","Escalated to Insurance Co - Customer is out of country","Escalated to Insurance Co - Max attempts done for the case","Escalated to Insurance Co - Due to COVID 19 customer not ready for medicals","Escalated to Insurance Co - Agent/RM will come back for medicals","Customer wants Video Health Assessment","Moved to Contactless Health Assessment","Call Later - Sales phone switched off","Appointment Related - Partial Medicals pending - Client Lapse","Appointment Related - Partial Medicals pending - DC Lapse","Customer wants to talk to sales","Medicals done against different policy with other IC & Reports submitted to ICICI Pru","Ringing not received - Sales","Wrong Number - Sales","Client not interested - Sales","Closed/Cancelled as per Insurers Request","As confirmed by Customer, Vkyc already completed"],

        "open" => ["Fresh Case","Call Later - Customer asked to call back","Call Later - Customer phone switched off","Call Later - Customer not answering/available","Call Later - Customer Not Responding","Appointment Confirmed","Appointment Missed - Reschedule Appointment","Appointment Related - Partial Medicals pending","Medicals Done - Report Awaited","Reports rec’d - QC Pending","DC sent Incorrect/Incomplete Report","Immediate Action","UNASSIGNED","Incorrect MER","MER Completed - QC Pending","Missed Appointment - Rescheduled Appointment","Appointment Scheduled","DC Closed - Lockdown","Client want medicals post lockdown","Client wants home visit - DC not available","Customer is not interested","Customer is not cooperating","Customer has cancelled/wants to cancel the policy","Wrong/Invalid number","Network Issue - Customer","Customer already completed MER - BY Other TPA","Other Discrepency","Others out of scope","DOB Mismatch of Customer","Do not call","Customer wants Video Health Assessment","Call Later - Sales phone switched off","Appointment Related - Partial Medicals pending - Client Lapse","Appointment Related - Partial Medicals pending - DC Lapse","Customer wants to talk to sales","Medicals done against different policy with other IC & Reports submitted to ICICI Pru","Ringing not received - Sales","Wrong Number - Sales","Client not interested - Sales","As confirmed by Customer, Vkyc already completed"],

        "escalated" => ["Escalated to Insurance Co - Customer No Show","Escalated to Insurance Co - Customer Not Interested","Escalated to Insurance Co - Customer Not Responding/Wrong Number","Escalated to Insurance Co - Customer Not Co-operating","Escalated to Insurance Co - Other TPA Completed","Escalated to Insurance Co - Unable to find DC","Cancelled by Insurance Company - Customer Not Interested","Cancelled by Insurance Company - Customer Not Responding/Wrong number","Cancelled by Insurance Company - Customer cancelled policy","Cancelled by Insurance Company - Other TPA completed","Cancelled by Insurance Company - No DC / Unable to complete","Dummy Case - No Action Required","Escalated to insurer - Insurance company intervention required","Cancelled by Insurance Company","Highlighted to IC – Change in DC","Highlighted to IC – Change in Visit Type","Highlighted to IC – Change in Appointment Date and Time","Escalated to Insurance Co - Policy cancelled as per the customer","Escalated to Insurance Co - Customer not aware of medicals","Escalated to Insurance Co - Medicals done by other policy no","Escalated to Insurance Co - Agent confirmed medicals not required","Escalated to Insurance Co - Agent confirmed policy cancelled","Escalated to Insurance Co - Customer is out of country","Escalated to Insurance Co - Max attempts done for the case","Escalated to Insurance Co - Due to COVID 19 customer not ready for medicals","Escalated to Insurance Co - Agent/RM will come back for medicals","Moved to Contactless Health Assessment","Closed/Cancelled as per Insurers Request"],        

        "close" => ['Closed - Reports submitted to insurer']
    ];
        if($casetype !=''){
            return $case_status[$casetype];        
        }
        else{
            return $case_status;
        }
    }
}

if(!function_exists('getCaseStatusByCase')){
    function getCaseStatusByCase($status_type='',$case_type='') {
        $CI = & get_instance();
        $casestatus = [];
        $condi = ' status =1';

        if($status_type !="" && $status_type !='all'){
            $condi .=' AND status_type="'.$status_type.'"';
        }
        if($case_type !=""){
            $condi .=' AND FIND_IN_SET("'.$case_type.'",case_type)';   
        }

        $sql ="SELECT id,case_status FROM gwl_case_status WHERE ". $condi;
        $query = $CI->db->query($sql);    
        //echo $CI->db->last_query();exit;
         if ($query->num_rows() > 0) {
                $stats = $query->result_array(); 
                foreach ($stats as $CSkey => $CSvalue) {
                    $casestatus[] = $CSvalue['case_status'];
                }
            return $casestatus;
        } else {
            return false;
        }
    }
}

if(!function_exists('getETLIFEStatus')){    
    function getETLIFEStatus($gwl_case_status,$ic_id){
        $etlife_case_status = array(
            'Call Later - Customer asked to call back'=>'Call Later',
            'Call Later - Customer phone switched off'=>'Customer phone switched off',
            'Call Later - Customer not answering/available'=>'Number not Reachable',
            'Call Later - Customer Not Responding'=>'Number not responding',
            'Appointment Confirmed'=>'Appointment fixed',
            'Appointment Missed - Reschedule Appointment'=>'No Show',
            'Appointment Related - Partial Medicals pending'=>'Partial medical done',
            'Escalated to Insurance Co - Customer No Show'=>'No Show',
            'Escalated to Insurance Co - Customer Not Interested'=>'Customer Not Interested',
            'Escalated to Insurance Co - Customer Not Responding/Wrong Number'=>'Wrong number',
            'Escalated to Insurance Co - Customer Not Co-operating'=>'Customer Not Interested',
            'Escalated to Insurance Co - Other TPA Completed'=>'Cancelled by Insurance Company',
            'Escalated to Insurance Co - Unable to find DC'=>'Insurance Co. intervention Required',
            'Cancelled by Insurance Company - Customer Not Interested'=>'Customer Not Interested',
            'Cancelled by Insurance Company - Customer Not Responding/Wrong number'=>'Wrong number',
            'Cancelled by Insurance Company - Customer cancelled policy'=>'Customer cancelled policy',
            'Cancelled by Insurance Company - Other TPA completed'=>'Cancelled by Insurance Company',
            'Cancelled by Insurance Company - No DC / Unable to complete'=>'Cancelled by Insurance Company',
            'Dummy Case - No Action Required'=>'Duplicate Entry / Simultaneous Case',
            'Medicals Done - Report Awaited'=>'Medical Done & Report Awaited',
            'Reports rec’d - QC Pending'=>'Medical Done & Report Awaited',
            'DC sent Incorrect/Incomplete Report'=>'Medical Done & Report Awaited',
            'Closed - Reports submitted to insurer'=>'Report Dispatch',
            'Immediate Action'=>'Immediate Action',
            'UNASSIGNED'=>'UNASSIGNED',
            'Fresh Case'=>'Fresh Case'
        );

        $ABHI_STATUS= array(
            'Appointment Confirmed'=>'Appointment fixed',
            'Appointment Related - Partial Medicals pending'=>'Appointment Related - Partial Medicals pending',
            'Cancelled by Insurance Company - Customer Not Interested'=>'Cancelled by ABHI',
            'Cancelled by Insurance Company - Customer Not Responding/Wrong number'=>'Cancelled by ABHI',
            'Cancelled by Insurance Company - Customer cancelled policy'=>'Cancelled by ABHI',
            'Cancelled by Insurance Company - Other TPA completed'=>'Cancelled by ABHI',
            'Cancelled by Insurance Company - No DC / Unable to complete'=>'Cancelled by ABHI',
            'Cancelled by Insurance Company'=>'Cancelled by ABHI',
            'Escalated to Insurance Co - Unable to find DC'=>'Constraint Location',
            'DC Closed - Lockdown'=>'Constraint Location',
            'Client wants home visit - DC not available'=>'Constraint Location',
            'Dummy Case - No Action Required'=>'Dummy Case - No Action Required',
            'Fresh Case'=>'Fresh Case',
            'Immediate Action'=>'Fresh Case',
            'UNASSIGNED'=>'Fresh Case',
            'Escalated to Insurance Co - Customer No Show'=>'No Show',
            'Escalated to Insurance Co - Customer Not Interested'=>'To be clarified by ABHI',
            'Escalated to Insurance Co - Customer Not Responding/Wrong Number'=>'To be clarified by ABHI',
            'Escalated to Insurance Co - Customer Not Co-operating'=>'To be clarified by ABHI',
            'Escalated to Insurance Co - Other TPA Completed'=>'To be clarified by ABHI',
            'Reports rec’d - QC Pending'=>'Medical done and report awaited',
            'DC sent Incorrect/Incomplete Report'=>'Medical done and report awaited',
            'Appointment Missed - Reschedule Appointment'=>'No Show',
            'Call Later - Customer phone switched off'=>'Non Contactable',
            'Call Later - Customer not answering/available'=>'Non Contactable',
            'Call Later - Customer Not Responding'=>'Non Contactable',
            'Call Later - Customer asked to call back'=>'Recall later',
            'Medicals Done - Report Awaited'=>'Medical done and report awaited',
            'Closed - Reports submitted to insurer'=>'Report uploaded',
            'Escalated to insurer - Insurance company intervention required'=>'To be clarified by ABHI',
            'Client want medicals post lockdown'=>'To be clarified by ABHI',
            'Customer is not interested'=>'To be clarified by ABHI',
            'Customer is not cooperating'=>'To be clarified by ABHI',
            'Customer has cancelled/wants to cancel the policy'=>'To be clarified by ABHI',
            'Wrong/Invalid number'=>'To be clarified by ABHI',
            'Highlighted to IC – Change in DC'=>'To be clarified by ABHI',
            'Highlighted to IC – Change in Visit Type'=>'To be clarified by ABHI',
            'Highlighted to IC – Change in Appointment Date and Time'=>'To be clarified by ABHI'
        );
        
// Changes in MIS below changes requested by email as per new requirment 07/06/2019

        $forall_case_status = array(
            'Call Later - Customer asked to call back'=>'Call Later',
            'Call Later - Customer phone switched off'=>'Customer Not Responding',
            'Call Later - Customer not answering/available'=>'Customer Not Responding',
            'Call Later - Customer Not Responding'=>'Customer not responding',
            'Appointment Confirmed'=>'Appointment Confirmed',
            'Appointment Missed - Reschedule Appointment'=>'No Show',
            'Appointment Related - Partial Medicals pending'=>'Partial medical pending',
            'Escalated to Insurance Co - Customer No Show'=>'Escalated to Insurance Co',
            'Escalated to Insurance Co - Customer Not Interested'=>'Escalated to Insurance Co',
            'Escalated to Insurance Co - Customer Not Responding/Wrong Number'=>'Escalated to Insurance Co',
            'Escalated to Insurance Co - Customer Not Co-operating'=>'Escalated to Insurance Co',
            'Escalated to Insurance Co - Other TPA Completed'=>'Escalated to Insurance Co',
            'Escalated to Insurance Co - Unable to find DC'=>'Escalated to Insurance Co',
            'Cancelled by Insurance Company - Customer Not Interested'=>'Cancelled by Insurance Company',
            'Cancelled by Insurance Company - Customer Not Responding/Wrong number'=>'Cancelled by Insurance Company',
            'Cancelled by Insurance Company - Customer cancelled policy'=>'Cancelled by Insurance Company',
            'Cancelled by Insurance Company - Other TPA completed'=>'Cancelled by Insurance Company',
            'Cancelled by Insurance Company - No DC / Unable to complete'=>'Cancelled by Insurance Company',
            'Dummy Case - No Action Required'=>'Duplicate Entry / Simultaneous Case',
            'Medicals Done - Report Awaited'=>'Medical Done & Report Awaited',
            'Reports rec’d - QC Pending'=>'Awaiting Summary & Interpretation',
            'DC sent Incorrect/Incomplete Report'=>'DC sent Incorrect/Incomplete Report',
            'Closed - Reports submitted to insurer'=>'Closed - Reports submitted to insurer',
            'Immediate Action'=>'Immediate Action',
            'UNASSIGNED'=>'UNASSIGNED',
            'Fresh Case'=>'Fresh Case'
        );

        
        if($ic_id==6 && array_key_exists($gwl_case_status,$etlife_case_status) ) {
            return $etlife_case_status[$gwl_case_status];
        }if($ic_id==7 && array_key_exists($gwl_case_status,$ABHI_STATUS) ) {
            return $ABHI_STATUS[$gwl_case_status];
        } else if(array_key_exists($gwl_case_status,$forall_case_status) ){
            return $forall_case_status[$gwl_case_status];
        } else{
            return $gwl_case_status;
        }
        
    }
}

if(!function_exists('getBhartiAxaStatus')){    
    function getBhartiAxaStatus($gwl_case_status){
        $case_status = array(
            'Fresh Case'=>'To be Contacted',
            'Call Later - Customer asked to call back'=>'Recall Later',
            'Call Later - Customer phone switched off'=>'No Not responding',
            'Call Later - Customer not answering/available'=>'No Not responding',
            'Call Later - Customer Not Responding'=>'No Not responding',
            'Escalated to Insurance Co - Customer No Show'=>'Insurer intervention required',
            'Escalated to Insurance Co - Customer Not Interested'=>'Insurer intervention required',
            'Escalated to Insurance Co - Customer Not Responding/Wrong Number'=>'Insurer intervention required',
            'Escalated to Insurance Co - Customer Not Co-operating'=>'Insurer intervention required',
            'Escalated to Insurance Co - Other TPA Completed'=>'Insurer intervention required',
            'Cancelled by Insurance Company - Customer Not Interested'=>'Case cancelled by insurance company',
            'Cancelled by Insurance Company - Customer Not Responding/Wrong number'=>'Case cancelled by insurance company',
            'Cancelled by Insurance Company - Customer cancelled policy'=>'Case cancelled by insurance company',
            'Cancelled by Insurance Company - Other TPA completed'=>'Case cancelled by insurance company',
            'Dummy Case - No Action Required'=>'Dummy Case - No Action Required',
            'Immediate Action'=>'Immediate Action',
            'UNASSIGNED'=>'UNASSIGNED',
            'Cancelled by Insurance Company'=>'Case cancelled by insurance company',
            'Incorrect MER'=>'QC Pending',
            'MER Completed - QC Pending'=>'QC Pending',
            'Missed Appointment - Rescheduled Appointment'=>'Missed Appointment - Rescheduled Appointment',
            'Appointment Scheduled'=>'Appointment Scheduled',
            'Closed - submitted to insurance'=>'Completed',
            'Customer is not interested'=>'Customer Not cooperating',
            'Customer is not cooperating'=>'Customer Not cooperating',
            'Customer has cancelled/wants to cancel the policy'=>'Customer Not cooperating',
            'Wrong/Invalid number'=>'Wrong Number',
            'Network Issue - Customer'=>'No Not responding',
            'Customer already completed MER - BY Other TPA'=>'Customer already completed MER - BY Other TPA',
            'Other Discrepency'=>'Other Discrepency',
            'Others out of scope'=>'Others out of scope',
            'DOB Mismatch of Customer'=>'DOB Mismatch of Customer',
            'Escalated to Insurance Co - Max attempts done for the case'=>'Insurer intervention required',
            'Closed/Cancelled as per Insurers Request'=>'Case cancelled by insurance company',
            'As confirmed by Customer, Vkyc already completed'=>'As confirmed by Customer, Vkyc already completed',
        );

        if(array_key_exists($gwl_case_status,$case_status) ){
            return $case_status[$gwl_case_status];
        } else{
            return $gwl_case_status;
        }
        
    }
}

if(!function_exists('getNivaBupaAHCCategory')){    
    function getNivaBupaAHCCategory($gwl_case_status){
		//Others
        $case_status = array(
            'Cancelled by Insurance Company'=>'Cancelled by Insurance company',
            'Medicals completed by other agencies/TPA'=>'NA',
            'Report sent under former application number'=>'Report closed',
            'Duplicate entry'=>'NA',
            'Reports uploaded'=>'Report closed',
            '2nd Appointment fixed'=>'2nd Appointment confirmed',
            '1st Appointment fixed '=>'NA',
            '3rd Appointment fixed'=>'NA',
            'Medicals done and Reports awaited'=>'Report pending',
            '1st Appointment missed'=>'No Show',
            '2nd Appointment missed'=>'NA',
            '3rd Appointment missed'=>'NA',
            'Recall Later'=>'Call back customer',
            'Customer contact no. Wrong'=>'NA',
            'Customer not picking up the medical team call'=>'NA',
            'Client not contactable/No. switched off'=>'NA',
            'Appointment missed by DC /Doctor'=>'NA',
            'Partial medicals done due to DC problem/Doctor problem'=>'Report pending',
            'Partial medicals done as customer is unfit for medical/Client problem'=>'NA',
            'Client not cooperating for medicals'=>'NA',
            'Customer asked to contact Agent/Advisor/IRM/Insurance company'=>'NA',
            'To be Contacted'=>'Call back customer',
            'Insurance Co. intervention Required'=>'Escalated to Insurance company',
            'Report On Hold'=>'NA',
            'Pending for ID proof/documentation'=>'Report pending',
            'DC Closed - Lockdown'=>'NA',
            'Client want medicals post lockdown'=>'NA',
            'Client wants home visit - DC not available'=>'NA',
            'Customer is not interested'=>'NA',
            'Customer is not cooperating'=>'NA',
            'Customer has cancelled/wants to cancel the policy'=>'NA',
            'Wrong/Invalid number'=>'NA',
            'DOB Mismatch of Customer'=>'NA',
            'Do not call'=>'NA',
            'Cancelled by Insurance Company - Customer Not Interested'=>'Cancelled by Insurance company',
            'Customer request'=>'NA',
            'Reports rec’d - QC Pending'=>'Report pending',
            'Customer not picking up the medical team call'=>'Report pending',
        );

        if(array_key_exists($gwl_case_status,$case_status) ){
            return $case_status[$gwl_case_status];
        } else{
            return $gwl_case_status;
        }
        
    }
}

if(!function_exists('getClientCaseStatus')){
    function getClientCaseStatus($ic_id,$id,$gwlStatus=''){
         $CI = & get_instance();
         $ststu=""; 
         if($gwlStatus!=""){

            $sql ="SELECT ics.case_status FROM ic_case_status ics JOIN gwl_case_status gcs ON gcs.id=ics.gwl_case_status_id WHERE ic_id=".$ic_id." AND gcs.case_status='".$gwlStatus."'";    
            $query = $CI->db->query($sql); 
            if ($query->num_rows() > 0) {
                $result =  $query->result_array();            
                $ststu =  $result[0]['case_status'];
            } else{
                $ststu="";
            }
       
         } else if($id !="" && $id!=0){
          
            $sql ="SELECT case_status FROM ic_case_status WHERE ic_id=".$ic_id." AND id=".$id;
            $query = $CI->db->query($sql); 
            if ($query->num_rows() > 0) {
                $result =  $query->result_array();            
                $ststu =  $result[0]['case_status'];
            } else{
                $ststu =  "";
            }
         
         } else{
            $ststu =  "";
         }

        return $ststu;    
     }
}

if(!function_exists('getMERTypes')){
    function getMERTypes(){
        $CI = & get_instance();
        $allowMerType = $CI->session->userdata('mer_type_id');
        if ($allowMerType=="") {
            $allowMerType='1,2,3,4,5,6,7,8,9,10';
        }        
        $sql ="SELECT mer_id,mer_type FROM mer_types WHERE status='Active' AND mer_id IN($allowMerType)";
        $query = $CI->db->query($sql);
        if ($query->num_rows() > 0) {
            $result =  $query->result_array();            
            return $result;
        } else {
            return false;
        }
    }
}

if(!function_exists('getMERTypeCaseStatus')){
    function getMERTypeCaseStatus($case_type){
        $CI = & get_instance();
        if($case_type !='NORMAL'){
            $sql ="SELECT id,case_status FROM gwl_case_status WHERE FIND_IN_SET('Tele MER',case_type)";
        } else{
            $sql ="SELECT id,case_status FROM gwl_case_status WHERE FIND_IN_SET('Medical Type',case_type)";
        }
        $query = $CI->db->query($sql);       
         if ($query->num_rows() > 0) {
            $result =  $query->result_array();            
            return $result;
        } else {
            return false;
        }
    }
}

if(!function_exists('getMERTypeICCaseStatus')){
    function getMERTypeICCaseStatus($case_type){
        $CI = & get_instance();
        if($case_type != 'NORMAL'){
            $sql ="SELECT id,case_status FROM gwl_case_status WHERE FIND_IN_SET('Tele MER',case_type) AND case_status NOT IN('Customer already completed MER - BY Other TPA','As confirmed by Customer, Vkyc already completed','Escalated to Insurance Co - Max attempts done for the case','Customer has cancelled/wants to cancel the policy')";
        } else{
            $sql ="SELECT id,case_status FROM gwl_case_status WHERE FIND_IN_SET('Medical Type',case_type)";
        }
        $query = $CI->db->query($sql);       
         if ($query->num_rows() > 0) {
            $result =  $query->result_array();            
            return $result;
        } else {
            return false;
        }
    }
}

if(!function_exists('getMisColomns')){
    function getMisColomns($miscolkey){
		
	//ichead13


    
    $mailcols = [
        "GWLALL" => ['Insurance Name','Customer Profile','Application No/Proposal No','Case Type','Case ID/TA Code','Case For','Customer Name','Case Owner Name','Gender','Customer DOB','Customer Contact No','Customer Email','Customer Address','Customer Pincode','City', 'State', 'Tier', 'Zone','Total Calls to Customer','Case Rec`d Date','Case Effective Date and Time','Appointment Fixed Date','Case Effective TAT','Appointment Date','Appointment time','Closure/Approval Date','Closure/Approval Time','Report Upload Date','Report Upload By','Appointment Scheduled Date','Appointment Scheduled By','QC Report Date','Case Completion Date','Appointment Scheduled TAT','Appointment Closure TAT','QC Closure TAT','Case Completion TAT','Medical Test','Scheduled Tests','Case status','Client Status','Case Follow-up Date','Case Follow-up Time','DC ID','DC Name','DC PAN','DC City','Type of visit', 'Appointment Status', 'Report Status','Photo Uploaded','Photo ID Proof Uploaded','Geo Tag','Outsourced','Outsourced Test','File Uploaded (Yes/No)','Branch Name','Assigned Agent Name','Business Channel','Special/International','Case Entry Date & time',"Case Rec'd Mode",'Policy No.','Interpretation','CMO Decision','Cardiologist Name','MER Dr Name','MER Dr Reg No','Dr Qualifications','Disclosure Report','Summary','Last updated Case Remarks','Last updated Case Remarks Date','Last updated Case by - User','SFYP Pushed date','Member Id','Medical Id','Sales Agent/Sender Request','Sales Agent Contact','Customer Corporate Name','Cust Called within 2 hrs','Sales Call attemp','Client ID Proof','Client ID Proof Number','DOOR KNOCK ELIGIBLE','DOOR KNOCK/FORCE FIXATION','REASONS FOR DOOR KNOCK/FORCE FIXATION FAILURE','Rescheduled/Cancelled By','Rescheduled/Cancelled By Remark' ,'Customer Connected','Connected Via'],

        ];  

        return $mailcols[$miscolkey];
    }
}


/******************************Only for Summery Sheet *********************************/


if (!function_exists('IndiviualTestsCode')) {   
    function IndiviualTestsCode($c_id) {
        $CI = & get_instance();
        $sql = "SELECT GROUP_CONCAT(tn.test_code SEPARATOR ',') AS 'test_code' FROM tbl_case_tests AS ct LEFT JOIN individual_test AS tn ON tn.test_id = ct.test_id WHERE ct.`c_id` ='".$c_id."'";
        $query = $CI->db->query($sql);          
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data[0]['test_code'];
        } else {
            return 'NA';
        }        
    }
}

if (!function_exists('getPackageTests')) {   
    function getPackageTests($package_id,$ic_id) {
        $CI = & get_instance();
        $sql = "SELECT GROUP_CONCAT(TRIM(t.test_code)) AS test_code FROM test_package AS p LEFT JOIN test_package_relation AS tpr ON tpr.test_pack_id = p.test_pack_id LEFT JOIN individual_test AS t ON tpr.test_id = t.test_id WHERE p.pack_insurance_co=".$ic_id." AND p.test_pack_id=".$package_id." AND t.is_deleted='No'";
        $query = $CI->db->query($sql);          
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data[0]['test_code'];
        } else {
            return 'NA';
        }        
    }
}

if (!function_exists('getCompletedTest')) {   
    function getCompletedTest($ic_id) {
        $CI = & get_instance();
        $sql = "SELECT  GROUP_CONCAT(tn.test_code SEPARATOR ',') AS 'test_code' FROM tbl_appointment_tests AS ct  LEFT JOIN individual_test AS tn ON tn.test_id = ct.test_id LEFT JOIN tbl_appointment ta ON ct.app_id=ta.app_id WHERE ta.c_id=".$ic_id. " AND ta.app_status='Completed'";
        $query = $CI->db->query($sql);          
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data[0]['test_code'];
        } else {
            return 'NA';
        }        
    }
}

if (!function_exists('scheduledTestsCode')) {   
    function scheduledTestsCode($app_id='') {
        if($app_id !=''){
            $CI = & get_instance();
            $sql = "SELECT GROUP_CONCAT(tn.test_code SEPARATOR ',') AS 'test_code' FROM tbl_appointment_tests AS ct LEFT JOIN individual_test AS tn ON tn.test_id = ct.test_id  WHERE ct.app_id ='".$app_id."'";
            $query = $CI->db->query($sql);  
            if ($query->num_rows() > 0) {
                $data = $query->result_array();
                return $data[0]['test_code'];
             } else {
                return 'NA';
             }        
        } else{
            return 'NA';
        }
    }
}

if (!function_exists('scheduledTestsCodeName')) {   
    function scheduledTestsCodeName($app_id='') {
        if($app_id !=''){
            $CI = & get_instance();
            $sql = "SELECT tn.test_code,tn.test_name FROM tbl_appointment_tests AS ct LEFT JOIN individual_test AS tn ON tn.test_id = ct.test_id  WHERE ct.app_id ='".$app_id."'";
            $query = $CI->db->query($sql);  
            //echo $CI->db->last_query();exit;
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return false;
            }        
        } else{
            return 'NA';
        }
    }
}

if (!function_exists('getAll_Pkg_Test')) {   
    function getAll_Pkg_Test($test_pack_id,$ic_id) {
        if($test_pack_id !='' && $ic_id != ''){  
            $CI = & get_instance();
            $sql = "SELECT test_pack_id,package_name,test_include FROM test_package WHERE test_pack_id IN (".$test_pack_id.") AND pack_insurance_co=".$ic_id;
            $query = $CI->db->query($sql);
            //echo $CI->db->last_query();exit;
            if ($query->num_rows() > 0) {
                return $query->result_array();
                //return $data[0]['package_name'];
            } else {
                return false;
            }   
        }else{
            return 'NA';
        }     
        
    }
}

if (!function_exists('getAll_Indi_Test')) {   
    function getAll_Indi_Test($test_id,$ic_id) {
        if($test_id !='' && $ic_id != ''){
            $CI = & get_instance();
            $sql = "SELECT test_id,test_name FROM individual_test WHERE test_id IN (".$test_id.") AND insurance_co=".$ic_id;
            $query = $CI->db->query($sql); 
            //echo $CI->db->last_query();exit; 
            if ($query->num_rows() > 0) {
                return $query->result_array();
                //return $data[0]['test_name'];
            } else {
                return false;
            }
        }else{
            return 'NA';
        }
    }
}

if (!function_exists('getLangName')) {   
    function getLangName($lang_id='') {
        $CI = & get_instance();
        if($lang_id !=''){
            $lang = explode(',', $lang_id);   
            $cond =[];        
            for($l=0; $l<count($lang); $l++){
                if(is_numeric($lang[$l])){
                    $cond[] = "tl.lang_id= ".$lang[$l];
                } else{
                    $cond[] = "tl.lang_name='".$lang[$l]."'";
                }
            }
            if(!empty($cond)){
                $condition = " WHERE (" .implode(' OR ', $cond).")";
                
            } else{
                $condition="";
            }
            

            $sql = "SELECT GROUP_CONCAT(tl.lang_name SEPARATOR ',') AS 'lang_name' FROM tbl_language AS tl $condition";
            $query = $CI->db->query($sql);
            //echo $CI->db->last_query();exit;  
            if ($query->num_rows() > 0) {
                $data = $query->result_array();
                return $data[0]['lang_name'];
             } else {
                return 'NA';
             }        
        } else{
            return 'NA';
        }
    }
}

if (!function_exists('getTeleMerReportreatedAT')) {   
    function getTeleMerReportreatedAT($c_id) {
        if($c_id !=''){
            $CI = & get_instance();
            $sql = "SELECT mra.report_created_at AS files_uploaded_date FROM mer_reports_audio AS mra WHERE mra.mer_c_id ='".$c_id."' AND ( FIND_IN_SET('PDFReport', mra.report_type) OR FIND_IN_SET('MPDFReport', mra.report_type) OR FIND_IN_SET('Media', mra.report_type) ) GROUP BY mra.mer_c_id ORDER BY mra.id DESC";
            $query = $CI->db->query($sql);  
            //echo $CI->db->last_query();exit;
            if ($query->num_rows() > 0) {
                $data = $query->result_array();
                return $data[0]['files_uploaded_date'];
            } else {
                return false;
            }        
        } else{
            return 'NA';
        }
    }
}

if (!function_exists('getTeleVideoPrice')) {   
    function getTeleVideoPrice($c_id,$ic_id,$mer_type) {
        if($c_id !=''){
            $CI = & get_instance();
            $sql = "SELECT ic.video_mer_charge_normal,ic.tele_mer_charge_normal,ic.telemer,ic.videomer FROM mer_case tc LEFT JOIN insurance_company ic  ON ic.ic_id = tc.ic_id WHERE tc.mer_type='".$mer_type."' AND ic.ic_id = ".$ic_id." AND tc.c_id =".$c_id;
            $query = $CI->db->query($sql);  
            //echo $CI->db->last_query();exit;
            if ($query->num_rows() > 0) {
                return $query->result_array();
                // $data =  return $data[0]['files_uploaded_date'];
            } else {
                return false;
            }        
        } else{
            return 'NA';
        }
    }
}

if(!function_exists('getETLIColomns')){
    function getETLIColomns($miscolkey){
        
        $mailcols = [
            "gwl0" => ['Insurance Name','Customer Profile','Application No/Proposal No','Case Type','Case ID/TA Code','Case For','Customer Name','Case Owner Name','Gender','Customer Address','City', 'State', 'Tier', 'Zone','Case Rec`d Date','Appointment Fixed Date','Appointment Date','Appointment time','Closure/Approval Date','Closure/Approval Time','Report Upload Date','QC Report Date','Case Completion Date','Appointment Scheduled TAT','Appointment Closure TAT','QC Closure TAT','Case Completion TAT','Medical Test','Scheduled Tests','Case status','Client Status','Case Follow-up Date','Case Follow-up Time','DC ID','DC Name','DC City','Type of visit', 'Appointment Status', 'Report Status','Photo Uploaded','Photo ID Proof Uploaded','File Uploaded (Yes/No)','Branch Name','Assigned Agent Name','Business Channel','Special/International','Case Entry Date & time',"Case Rec'd Mode",'Policy No.','Interpretation','CMO Decision','Cardiologist Name','MER Dr Name','MER Dr Reg No','Dr Qualifications','Disclosure Report','Summary','Last updated Case Remarks','Last updated Case Remarks Date','Last updated Case by - User','SFYP Pushed date','Member Id','Medical Id'],
            "ichead6" => ['Upload Status','GWL Branch','Case Intimation Date','GWL Control No','Application No/Policy No','Client Contact Details','Client Name','Client Location','CITY','DC No','DC Name','EDT Test Name','GWL Test Name','Home Visit','Appointment Time','Appointment Date','Case Status','Present Remarks','Pending Remarks','Scan Date','Product Type','Location Type','First called Date and Time','Medicals Uploaded Date and Time','Client Email Id','Gender','Age','Calling Attempts','No Of Time Appointment Schedule','HNI','Amount','Escort Charge','Extra Cost']
        ];       
        return $mailcols[$miscolkey];
    }
}

if (!function_exists('getIncorrectMERReason')) {   
    function getIncorrectMERReason($c_id,$remarks_type) {
        if($c_id !=''){
            $CI = & get_instance();
            $sql = "SELECT mer_remark FROM mer_case_remark WHERE remarks_type='".$remarks_type."' AND case_status='Incorrect MER' AND c_id =".$c_id." ORDER BY mer_remark_id DESC LIMIT 1";
            $query = $CI->db->query($sql);  
            //echo $CI->db->last_query();exit;
            if ($query->num_rows() > 0) {
                $data = $query->result_array();
                return $data[0]['mer_remark'];
            } else {
                return false;
            }        
        } else{
            return 'NA';
        }
    }
}

if (!function_exists('apptICICILombardTatHour')) {   
    function apptICICILombardTatHour($c_id) {
        if($c_id !=''){
            $CI = & get_instance();
            $sql = "SELECT TIME_FORMAT(TIMEDIFF(ta.app_confirm_at,tc.effective_date), '%H:%i:%s') AS tat_in_hour, tc.c_id, tc.effective_date, tc.rec_from_date, ta.app_confirm_at FROM tbl_case tc LEFT JOIN tbl_appointment ta ON ta.c_id=tc.c_id WHERE tc.c_id=".$c_id." AND tc.ic_id = 5";
            
            $query = $CI->db->query($sql);       
            //echo $CI->db->last_query();exit;
            if ($query->num_rows() > 0) {
                $data = $query->result_array(); 
                return $data[0]['tat_in_hour'];           
            } else {
                return '00:00:00';
            }
        }else{
            return '00:00:00';
        }
        
    }
}
    
    if (!function_exists('getPhysicalVideographyTestID')) {   
        function getPhysicalVideographyTestID($insurance_co) {
            $CI = & get_instance();
            $sql = "SELECT test_id FROM individual_test WHERE test_name = 'Physical Videography' AND insurance_co ='".$insurance_co."' AND status = 'Active'";
            $query = $CI->db->query($sql);       
            if ($query) {
                if ($query->num_rows() > 0) {
                    $data = $query->row();
                    return $data->test_id;
                } else {
                    return 0;
                }
            }else{
                return 0;
            }
        }
    }
	
	if(!function_exists('dc_update_location')){
    	function dc_update_location($data){
    		$CI = & get_instance();
    		$CI->load->model('cases/Casesmodel');
    		$text = rtrim(strtr(base64_encode("id=".$data['dc_id']), '+/', '-_'), '=');
    		$subdomain = "insurance";
    		$encode_dc = $text;
    		$sms = $CI->Casesmodel->getdatadetails("tbl_smscontents","sms_Key = 'DC_UPDATE_GOOGLE_LOCATION_SMS_KEY' AND ic_id=0");
			if(is_array($sms) && count($sms) > 0 ){
				$sms_content = str_replace(array(
					'{subdomain}',
					'{encode_dc}'
				), array(
					$subdomain,
					$encode_dc,
				), $sms[0]->content);
			 	trigger_sms2($data['contact'],$sms_content);
			}
			
			return 1;
			
    	}
	}

    if (!function_exists('getCampaignList')) {   
        function getCampaignList($CampaignBranch) {
            $Campaignarray = [                
                //'Central_Operations'=>'10000001', 'Physical_Customer_Feedback_calling'=>'70008003', 'Central_Operations_Outbound'=>'10000018', 'IndiaFirst_Life_Ins_Inbound'=>'10000025', 'HDFC_Campaign'=>'10000019','KLI_OB'=>'10000027'
                
                //'Central_Operations'=>'10000001', 'Virtual_Appointment_scheduling'=>'70008001', 'Virtual_Appointment_time_calling'=>'70008002', 'Telephonic_MER_PMLI'=>'10000004', 'Verification_Outbound'=>'10000021', 'Verification_Inbound'=>'10000022', 'Telephonic_MER_Inbound'=>'10000024''
                
                "Central_OperationPM" => ['Physical_Customer_Feedback_calling'=>'70008003'],

                "Central_OperationVM" => ['Central_Operations'=>'10000001', 'Virtual_Appointment_scheduling'=>'70008001', 'Virtual_Appointment_time_calling'=>'70008002','Telephonic_MER_PMLI'=>'10000004','Veriright_IFL_VPV_calling'=>'70008065','Veriright_HDFC_ITR_Calling'=>'70008065','Veriright_PIVC_and_Payout_calling'=>'70008065','Veriright_Annuities_calling'=>'70008065','Veriright_Vcheck_Calling'=>'70008064'],

                "WX_Delhi2" =>['Max_Niva_Bhupa_Delhi_Appointment_Scheduling'=>'70008052', 'Max_Niva_Bhupa_Delhi_Appointment_confirmation'=>'70008053', 'Max_Niva_Bhupa_Delhi_Appointment_ReConfirmation'=>'70008054', 'Max_Niva_Bhupa_Delhi_Report_follow_up_with_DC'=>'70008055' ],
                
                "WX_Ahmedabad" => ['Ahmedabad_Branch'=>'10000014', 'Ahmedabad_Branch_Appointment_Scheduling'=>'70008044', 'Ahmedabad_Branch_Appointment_confirmation'=>'70008045', 'Ahmedabad_Branch_Appointment_ReConfirmation' => '70008046', 'Ahmedabad_Branch_Report_follow_up_with_DC'=>'70008047'],
                
                "WX_Hyderabad" => ['AndhraPradesh_Branch_Appointment_Scheduling'=>'70008024', 'AndhraPradesh_Branch_Appointment_confirmation'=>'70008025', 'AndhraPradesh_Branch_Appointment_ReConfirmation'=>'70008026', 'AndhraPradesh_Branch_Report_follow_up_with_DC'=>'70008027', 'AndhraPradesh_Branch'=>'10000009', 'AndhraPradesh_Branch_OB'=>'10000023' ],
                
                "WX_Bangalore" => ['Karnataka_Branch_Appointment_Scheduling'=>'70008012', 'Karnataka_Branch_Appointment_confirmation'=>'70008013', 'Karnataka_Branch_Appointment_ReConfirmation'=>'70008014', 'Karnataka_Branch_Report_follow_up_with_DC'=>'70008015', 'Karnataka_Branch'=>'10000006' ],
                
                "WX_Delhi" => ['Delhi_Branch'=>'10000005', 'Delhi_Branch_Appointment_Scheduling'=>'70008008', 'Delhi_Branch_Appointment_confirmation'=>'70008009', 'Delhi_Branch_Appointment_ReConfirmation'=>'70008010', 'Delhi_Branch_Report_follow_up_with_DC'=>'70008011', 'MaxBhupa_Delhi'=>'10000015'],
                
                "WX_Jammu" => ['Jammu_Branch'=>'10000013', 'Jammu_Branch_Appointment_Scheduling'=>'70008040', 'Jammu_Branch_Appointment_confirmation'=>'70008041', 'Jammu_Branch_Appointment_ReConfirmation'=>'70008042', 'Jammu_Branch_Report_follow_up_with_DC'=>'70008043'],
                
                "WX_Kochi" => ['Kerala_Branch_Appointment_Scheduling'=>'70008028', 'Kerala_Branch_Appointment_confirmation'=>'70008029', 'Kerala_Branch_Appointment_ReConfirmation'=>'70008030', 'Kerala_Branch_Report_follow_up_with_DC'=>'70008031','Kerala_Branch'=>'10000010'],
                
                "WX_Kolkata" => ['Kolkata_Branch'=>'10000007', 'Kolkata_Branch_Appointment_Scheduling'=>'70008016', 'Kolkata_Branch_Appointment_confirmation'=>'70008017', 'Kolkata_Branch_Appointment_ReConfirmation'=>'70008018', 'Kolkata_Branch_Report_follow_up_with_DC'=>'70008019'],
                
                "WX_Lucknow" => ['Lucknow_Branch_Appointment_Scheduling'=>'70008032', 'Lucknow_Branch_Appointment_confirmation'=>'70008033', 'Lucknow_Branch_Appointment_ReConfirmation'=>'70008034', 'Lucknow_Branch_Report_follow_up_with_DC'=>'70008035', 'Lucknow_Branch'=>'10000011','TermBuddyBajajAlliaz'=>'10000020'],
                
                "WX_Mumbai" => ['Mumbai_Branch'=>'10000002', 'Mumbai_Branch_Appointment_Scheduling'=>'70008004', 'Mumbai_Branch_Appointment_confirmation'=>'70008005', 'Mumbai_Branch_Appointment_ReConfirmation'=>'70008006', 'Mumbai_Branch_Report_follow_up_with_DC'=>'70008007'],
                
                "WX_Punjab" => ['Chandigarh_Branch_Appointment_confirmation'=>'70008021', 'Chandigarh_Branch_Appointment_ReConfirmation'=>'70008022', 'Chandigarh_Branch_Report_follow_up_with_DC'=>'70008023', 'Chandigarh_Branch_Appointment_Scheduling'=>'70008020', 'Chandigarh_Branch'=>'10000008'],
                
                "WX_Srinagar" => ['Srinagar_Branch_Appointment_Scheduling'=>'70008048', 'Srinagar_Branch_Appointment_confirmation'=>'70008049', 'Srinagar_Branch_Appointment_ReConfirmation'=>'70008050', 'Srinagar_Branch_Report_follow_up_with_DC'=>'70008051', 'Srinagar_Branch'=>'10000016'],
                
                "WX_Chennai" => ['Tamil_Nadu_Branch_Appointment_Scheduling'=>'70008036', 'Tamil_Nadu_Branch_Appointment_confirmation'=>'70008037', 'Tamil_Nadu_Branch_Appointment_ReConfirmation'=>'70008038', 'Tamil_Nadu_Branch_Report_follow_up_with_DC'=>'70008039', 'TamilNadu_Branch'=>'10000012'],
                "WX_Welleazy" => ['Welleazy_Appointment_Scheduling'=>'70008056', 'Welleazy_Appointment_confirmation'=>'70008057', 'Welleazy_Appointment_ReConfirmation'=>'70008058', 'Welleazy_Report_follow_up_with_DC'=>'70008059'],
				
				"WX_Jaipur" => ['Jaipur_Branch_Appointment_Scheduling'=>'70008060', 'Jaipur_Branch_Appointment_confirmation'=>'70008061', 'Jaipur_Branch_Appointment_ReConfirmation'=>'70008062', 'Jaipur_Branch_Report_follow_up_with_DC'=>'70008063'],
                
                "Others" => ['Test_Campaign'=>'70007000', 'Test_Predictive'=>'70007001']
            ];
            
            if($CampaignBranch !=""){
                $campList = $Campaignarray[$CampaignBranch];
            } else{
                $campList =[];
            }
            return $campList;

        }
    }
	
	if (!function_exists('getICLogo')) {   
		function getICLogo($ic_id) {
			$logos = array(
				"1"=>'img/logo.png'
			);
			if(isset($logos[$ic_id])){
				return $logos[$ic_id];
			}else{
				return "";
			}
			 
			
		}
	}
	
	if (!function_exists('scheduled_tests_codes')) {   
		function scheduled_tests_codes($app_id='') {
			if($app_id !=''){
				$CI = & get_instance();
				$sql = "SELECT GROUP_CONCAT(tn.test_code SEPARATOR ',') AS 'scheduled_tests' FROM tbl_appointment_tests AS ct LEFT JOIN individual_test AS tn ON tn.test_id = ct.test_id  WHERE ct.app_id ='".$app_id."' AND ct.package_id='0' UNION SELECT GROUP_CONCAT(DISTINCT tp.package_name SEPARATOR ',') AS 'scheduled_tests' FROM tbl_appointment_tests AS ct LEFT JOIN test_package AS tp ON tp.test_pack_id = ct.package_id  WHERE ct.app_id ='".$app_id."' AND ct.package_id !='0'";
				$query = $CI->db->query($sql);  
				
				if ($query->num_rows() > 0) {
					$data = $query->result_array();
					
					$values=array_column($data,"scheduled_tests");
					$data[0]['scheduled_tests']="" . implode ( ",", $values ) . "";
					
					return $data[0]['scheduled_tests'];
				 } else {
					return '';
				 }        
			} else{
				return '';
			}
		}
	}


	function numberTowords(float $amount){
        $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
        // Check if there is any number after decimal
        $amt_hundred = null;
        $count_length = strlen($num);
        $x = 0;
        $string = array();
        $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
        $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
        while( $x < $count_length ) {
           $get_divider = ($x == 2) ? 10 : 100;
           $amount = floor($num % $get_divider);
           $num = floor($num / $get_divider);
           $x += $get_divider == 10 ? 1 : 2;
            if ($amount) {
                $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
                $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
                $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
                '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
                '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
            }else $string[] = null;
        }
        $implode_to_Rupees = implode('', array_reverse($string));
        $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
        " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
        return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
    }
