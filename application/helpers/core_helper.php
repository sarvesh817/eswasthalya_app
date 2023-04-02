<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	if(!function_exists('apache_request_headers') ) {
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
	
	if (!function_exists('validate_inputCSV')) {
	    function validate_inputCSV($string) {
			
			$output = str_replace( array( '\'', '"',',' , ';', '<', '>','=','-','+','@','_','HYPERLINK','cmd','&','?','/','//','\\','|','||','[',']','{','}','$','*','!',"'","|","#",'^','%','.','(',')','()','cmd','ping',"’",':','IMPORTXML','CONCAT','`','\x00','-\x20',';' ), ' ', $string);
	  	
			return $output;
		}
	}


if (!function_exists('updateSMSRemarks')) {
	function updateSMSRemarks($to,$smsRemark,$c_id="",$app_id="",$sms_key="", $sms_parent_id="", $pageid="") {
		$CI =& get_instance();		    
		$CI->load->model('mastermodel');
		date_default_timezone_set('Asia/Kolkata');

		if(isset($c_id) && $c_id !=''){$caseID = $c_id;}else{$caseID = 0;}
		if(isset($app_id) && $app_id !=''){$appID = $app_id;}else{$appID = 0;}
    	if(isset($sms_parent_id) && $sms_parent_id !=''){$smsParentID = $sms_parent_id;}else{$smsParentID = 0;}
    	if(isset($sms_key) && $sms_key !=''){$smsKEY = $sms_key;}else{$smsKEY = '';}

    	$smsApptRemark = $smsRemark;

        if($pageid =="cron"){
         	$smsApptRemark['created_by'] = 0;
         	$sent_smsApptInserted = $CI->mastermodel->master_insert('sent_sms',$smsApptRemark);

            if($c_id !="" || $app_id !=""){				                        
            //if($app_id !=""){				                        
                $smsButton = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsModal" id="sent_sms" name="sent_sms" data-sent_sms_id="'.$sent_smsApptInserted.'"> View SMS</button>';
                $remarkSMSContent = array(
                    'a_id' => $app_id,
                    'a_remark' => "SMS Sent Successfully ".$smsButton,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => 0
                );
                $remarkLastInserted = $CI->mastermodel->master_insert('tbl_appt_remark',$remarkSMSContent);				                        
            }
        }

        if($pageid=="REPORT_SMSLINK"){

         	$smsApptRemark['created_by'] = $CI->session->userdata('user_id');
         	$sentReportSMSLinkInserted = $CI->mastermodel->master_insert('sent_sms',$smsApptRemark);

         	if($c_id !="" || $app_id !=""){

                $reportSMSLinkBtn = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsModal" id="sent_sms" name="sent_sms" data-sent_sms_id="'.$sentReportSMSLinkInserted.'">View SMS</button>';
                $remarkReportSMSLinkContent = array(
                    'a_id' => $app_id,
                    'r_remark' => $sms_key." SMS Sent Successfully ".$reportSMSLinkBtn,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $CI->session->userdata('user_id')
                );
                $remarkLastInserted = $CI->mastermodel->master_insert('tbl_report_remark',$remarkReportSMSLinkContent);
            }
        }

        if($pageid=="AppointmentConfirmed"){

         	$smsApptRemark['created_by'] = $CI->session->userdata('user_id');
         	$appointmentSMSInserted = $CI->mastermodel->master_insert('sent_sms',$smsApptRemark);

         	if($c_id !="" || $app_id !=""){

                $appointmentSMSBtn = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsModal" id="sent_sms" name="sent_sms" data-sent_sms_id="'.$appointmentSMSInserted.'">View SMS</button>';
                $remarkAppointmentSMSContent = array(
                    'a_id' => $app_id,
                    'a_remark' => $sms_key." SMS Sent Successfully ".$appointmentSMSBtn,
                    'case_status' => 'Appointment Confirmed',
                    'remarks_type' => 'APPTCONFIRM',
                    'app_status' => 'Completed',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $CI->session->userdata('user_id')
                );
                $remarkLastInserted = $CI->mastermodel->master_insert('tbl_appt_remark',$remarkAppointmentSMSContent);
            }
        }

        if($pageid=="AddAppointment"){

         	$smsApptRemark['created_by'] = $CI->session->userdata('user_id');
         	$appointmentSMSInserted = $CI->mastermodel->master_insert('sent_sms',$smsApptRemark);

         	if($c_id !="" || $app_id !=""){

                $appointmentSMSBtn = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsModal" id="sent_sms" name="sent_sms" data-sent_sms_id="'.$appointmentSMSInserted.'">View SMS</button>';
                $remarkAppointmentSMSContent = array(
                    'a_id' => $app_id,
                    'a_remark' => $sms_key." SMS Sent Successfully ".$appointmentSMSBtn,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $CI->session->userdata('user_id')
                );
                $remarkLastInserted = $CI->mastermodel->master_insert('tbl_appt_remark',$remarkAppointmentSMSContent);
            }
        }

        if($pageid=="ReportClosed"){

         	$smsApptRemark['created_by'] = $CI->session->userdata('user_id');
         	$reportCloseInserted = $CI->mastermodel->master_insert('sent_sms',$smsApptRemark);

         	if($c_id !="" || $app_id !=""){

                $reportCLoseBtn = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsModal" id="sent_sms" name="sent_sms" data-sent_sms_id="'.$reportCloseInserted.'">View SMS</button>';
                $remarkReportCloseContent = array(
                    'a_id' => $app_id,
                    'r_remark' => $sms_key." SMS Sent Successfully ".$reportCLoseBtn,
                    'remarks_type' => 'REPORTCLOSED',
                    'case_status' => 'Closed - Reports submitted to insurer',
                    'report_status' => 'Completed',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $CI->session->userdata('user_id')
                );
                $remarkLastInserted = $CI->mastermodel->master_insert('tbl_report_remark',$remarkReportCloseContent);
            }
        }

        if($pageid=="MedicalDone"){

         	$smsApptRemark['created_by'] = $CI->session->userdata('user_id');
         	$appointmentSMSInserted = $CI->mastermodel->master_insert('sent_sms',$smsApptRemark);

         	if($c_id !="" || $app_id !=""){

                $appointmentSMSBtn = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsModal" id="sent_sms" name="sent_sms" data-sent_sms_id="'.$appointmentSMSInserted.'">View SMS</button>';
                $remarkAppointmentSMSContent = array(
                    'a_id' => $app_id,
                    'r_remark' => $sms_key." SMS Sent Successfully ".$appointmentSMSBtn,
                    'remarks_type' => 'AUTO',
                    'case_status' => 'Medicals Done - Report Awaited',
                    'report_status' => 'Pending',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $CI->session->userdata('user_id')
                );
                $remarkLastInserted = $CI->mastermodel->master_insert('tbl_report_remark',$remarkAppointmentSMSContent);
            }
        }

        if($pageid=="AppointmentMissed"){

         	$smsApptRemark['created_by'] = $CI->session->userdata('user_id');
         	$appointmentSMSInserted = $CI->mastermodel->master_insert('sent_sms',$smsApptRemark);

         	if($c_id !="" || $app_id !=""){

                $appointmentSMSBtn = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsModal" id="sent_sms" name="sent_sms" data-sent_sms_id="'.$appointmentSMSInserted.'">View SMS</button>';
                $remarkAppointmentSMSContent = array(
                    'a_id' => $app_id,
                    'a_remark' => $sms_key." SMS Sent Successfully ".$appointmentSMSBtn,
                    'remarks_type' => 'APPTMISSED',
                    'case_status' => 'Appointment Missed - Reschedule Appointment',
                    'app_status' => 'Reschedule',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $CI->session->userdata('user_id')
                );
                $remarkLastInserted = $CI->mastermodel->master_insert('tbl_appt_remark',$remarkAppointmentSMSContent);
            }
        }

        if($pageid=="NotInterestedAgent"){

         	$smsApptRemark['created_by'] = $CI->session->userdata('user_id');
         	$appointmentSMSInserted = $CI->mastermodel->master_insert('sent_sms',$smsApptRemark);

         	if($c_id !=""){

                $appointmentSMSBtn = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsModal" id="sent_sms" name="sent_sms" data-sent_sms_id="'.$appointmentSMSInserted.'">View SMS</button>';
                $remarkAppointmentSMSContent = array(
                    'c_id' => $c_id,
                    'c_remark' => $sms_key." SMS Sent Successfully ".$appointmentSMSBtn,
                    'remarks_type' => 'AUTO',
                    'case_status' => '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $CI->session->userdata('user_id')
                );
                $remarkLastInserted = $CI->mastermodel->master_insert('tbl_case_remark',$remarkAppointmentSMSContent);
            }
        }

        if($pageid=="NotResponseAgent"){

         	$smsApptRemark['created_by'] = $CI->session->userdata('user_id');
         	$appointmentSMSInserted = $CI->mastermodel->master_insert('sent_sms',$smsApptRemark);

         	if($c_id !=""){

                $appointmentSMSBtn = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsModal" id="sent_sms" name="sent_sms" data-sent_sms_id="'.$appointmentSMSInserted.'">View SMS</button>';
                $remarkAppointmentSMSContent = array(
                    'c_id' => $c_id,
                    'c_remark' => $sms_key." SMS Sent Successfully ".$appointmentSMSBtn,
                    'remarks_type' => 'AUTO',
                    'case_status' => 'Call Later - Customer Not Responding',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $CI->session->userdata('user_id')
                );
                $remarkLastInserted = $CI->mastermodel->master_insert('tbl_case_remark',$remarkAppointmentSMSContent);
            }
        }

        if($pageid=="NotResponseCust"){

         	$smsApptRemark['created_by'] = $CI->session->userdata('user_id');
         	$appointmentSMSInserted = $CI->mastermodel->master_insert('sent_sms',$smsApptRemark);

         	if($c_id !=""){

                $appointmentSMSBtn = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsModal" id="sent_sms" name="sent_sms" data-sent_sms_id="'.$appointmentSMSInserted.'">View SMS</button>';
                $remarkAppointmentSMSContent = array(
                    'c_id' => $c_id,
                    'c_remark' => $sms_key." SMS Sent Successfully ".$appointmentSMSBtn,
                    'remarks_type' => 'AUTO',
                    'case_status' => 'Call Later - Customer Not Responding',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $CI->session->userdata('user_id')
                );
                $remarkLastInserted = $CI->mastermodel->master_insert('tbl_case_remark',$remarkAppointmentSMSContent);
            }
        }

        if($pageid == "FeedBackURL"){

         	$smsApptRemark['created_by'] = $CI->session->userdata('user_id');
         	$feedBackLinkInserted = $CI->mastermodel->master_insert('sent_sms',$smsApptRemark);

         	if($c_id !="" || $app_id !=""){

                $feedBackLinkBtn = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsModal" id="sent_sms" name="sent_sms" data-sent_sms_id="'.$feedBackLinkInserted.'">View SMS</button>';
                $remarkFeedBackLinkContent = array(
                    'a_id' => $app_id,
                    'r_remark' => $sms_key." SMS Sent Successfully ".$feedBackLinkBtn,
                    'remarks_type' => 'FEEDBACKURL',
                    'case_status' => 'Closed - Reports submitted to insurer',
                    'report_status' => 'Completed',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $CI->session->userdata('user_id')
                );
                $remarkLastInserted = $CI->mastermodel->master_insert('tbl_report_remark',$remarkFeedBackLinkContent);
            }
        }

        if($pageid=="BulkUpload"){
        	$smsApptRemark['created_by'] = $CI->session->userdata('user_id');
         	$sent_smsBulkUploadInserted = $CI->mastermodel->master_insert('sent_sms',$smsApptRemark);

         	if($c_id !=""){

                $BulkUploadLinkBtn = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsModal" id="sent_sms" name="sent_sms" data-sent_sms_id="'.$sent_smsBulkUploadInserted.'">View SMS</button>';
                $remarkBulkUploadContent = array(
                    'c_id' => $c_id,
                    'c_remark' => $sms_key." SMS Sent Successfully ".$BulkUploadLinkBtn,
                    'case_status' => 'Fresh Case',
                    'remarks_type' => 'BULKUPLOAD',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $CI->session->userdata('user_id')
                );
                $remarkLastInserted = $CI->mastermodel->master_insert('tbl_case_remark',$remarkBulkUploadContent);
            }

            if($app_id !=""){
            	$smsBulkUploadApptButton = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsModal" id="sent_sms" name="sent_sms" data-sent_sms_id="'.$sent_smsBulkUploadInserted.'">View SMS</button>';
                $remarkSMSBulkUploadApptContent = array(
                    'a_id' => $app_id,
                    'case_status' => 'Appointment Confirmed',
                    'remarks_type' => 'BULKUPLOAD',
                    'a_remark' => "SMS Sent via Bulk Upload Successfully ".$smsBulkUploadApptButton,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $CI->session->userdata('user_id')
                );
            	$remarkApptLastInserted = $CI->mastermodel->master_insert('tbl_appt_remark',$remarkSMSBulkUploadApptContent);
            }
        }

        if($pageid=="ManualCaseAdd"){
        	$smsApptRemark['created_by'] = $CI->session->userdata('user_id');
        	
         	$sent_smsBulkUploadInserted = $CI->mastermodel->master_insert('sent_sms',$smsApptRemark);

         	if($c_id !=""){

                $BulkUploadLinkBtn = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsModal" id="sent_sms" name="sent_sms" data-sent_sms_id="'.$sent_smsBulkUploadInserted.'">View SMS</button>';
                $remarkBulkUploadContent = array(
                    'c_id' => $c_id,
                    'c_remark' => $sms_key." SMS Sent Successfully ".$BulkUploadLinkBtn,
                    'case_status' => 'Fresh Case',
                    'remarks_type' => 'BULKUPLOAD',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $CI->session->userdata('user_id')
                );
                $remarkLastInserted = $CI->mastermodel->master_insert('tbl_case_remark',$remarkBulkUploadContent);
            }
        }

        if($pageid=="MER"){
        	//print_r($app_id);exit;
        	if($app_id !="" && $c_id == ""){

        		$smsApptRemark['created_by'] = $CI->session->userdata('user_id');
             	$sent_smsMERApptInserted = $CI->mastermodel->master_insert('sent_sms',$smsApptRemark);
            	if($sent_smsMERApptInserted > 0){
            		$smsMERAButton = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsMERModal" id="sent_MERsms" name="sent_sms" data-sent_sms_id="'.$sent_smsMERApptInserted.'">View SMS</button>';
                    $remarkMERASMSCContent = array(
                        'mer_app_id' => $app_id,
                        'mer_appt_remark' => $sms_key." SMS Sent Successfully ".$smsMERAButton,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $CI->session->userdata('user_id')
                    );
                    $remarkCLastInserted = $CI->mastermodel->master_insert('mer_appt_remark',$remarkMERASMSCContent);
            	}

        	} else if($c_id !="" && $app_id == ""){
        		$smsApptRemark['created_by'] = $CI->session->userdata('user_id');
             	$sent_smsMERCInserted = $CI->mastermodel->master_insert('sent_sms',$smsApptRemark);
            	if($sent_smsMERCInserted > 0){
            		$smsMERButton = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsMERModal" id="sent_MERsms" name="sent_sms" data-sent_sms_id="'.$sent_smsMERCInserted.'">View SMS</button>';
                    $remarkMERSMSCContent = array(
                        'c_id' => $c_id,
                        'mer_remark' => $sms_key." SMS Sent Successfully ".$smsMERButton,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $CI->session->userdata('user_id')
                    );
                    $remarkCLastInserted = $CI->mastermodel->master_insert('mer_case_remark',$remarkMERSMSCContent);
            	}
        	}else if($c_id !='' && $app_id !=''){
        		$smsApptRemark['created_by'] = $CI->session->userdata('user_id');
             	$sent_smsMERApptInserted = $CI->mastermodel->master_insert('sent_sms',$smsApptRemark);
            	if($sent_smsMERApptInserted > 0){
            		$smsMERAButton = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsMERModal" id="sent_MERsms" name="sent_sms" data-sent_sms_id="'.$sent_smsMERApptInserted.'">View SMS</button>';
                    $remarkMERASMSCContent = array(
                        'mer_app_id' => $app_id,
                        'mer_appt_remark' => $sms_key." SMS Sent Successfully ".$smsMERAButton,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $CI->session->userdata('user_id')
                    );
                    $remarkCLastInserted = $CI->mastermodel->master_insert('mer_appt_remark',$remarkMERASMSCContent);
            	}
        	}
        	
        }

        if($pageid =="MER_OTP_VIDEO"){
        	$smsApptRemark['created_by'] = $CI->session->userdata('user_id');
         	$sent_smsMERApptInserted = $CI->mastermodel->master_insert('sent_sms',$smsApptRemark);
        	
        	if($sent_smsMERApptInserted > 0){
        		$smsMERAButton = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsMERModal" id="sent_MERsms" name="sent_sms" data-sent_sms_id="'.$sent_smsMERApptInserted.'">View SMS</button>';
                $remarkMERASMSCContent = array(
                    'mer_app_id' => $app_id,
                    'mer_appt_remark' => "OTP Sent Successfully ".$smsMERAButton,
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $CI->session->userdata('user_id')
                );
                $remarkCLastInserted = $CI->mastermodel->master_insert('mer_appt_remark',$remarkMERASMSCContent);
        	}
        }

	    if($pageid ==""){

	    	$smsApptRemark['created_by'] = $CI->session->userdata('user_id');
	     	$sent_smsApptInserted = $CI->mastermodel->master_insert('sent_sms',$smsApptRemark);

	        $checkLogs = explode('/', $REFERAL_URL);
	        if(is_array($checkLogs) && !empty($checkLogs)){

	            $getAppt_Controller = $checkLogs[3];
	            if(array_key_exists(4, $checkLogs)){
	            	$getStr = $checkLogs[4]; //print_r($getStr);exit;
	                $getMethod = explode('?', $getStr); //print_r($getMethod);exit;
	                $getMethodName = $getMethod[0];	

	            }else{
					$getMethodName ="";		                	
	            }				                

	           						
	            if($getAppt_Controller == 'appointment' && $getMethodName == 'addEdit'){
	            	if($c_id !="" || $app_id !=""){ 				                        
	            	//if($app_id !=""){ 				                        
	                    $smsApptButton = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsModal" id="sent_sms" name="sent_sms" data-sent_sms_id="'.$sent_smsApptInserted.'">View SMS</button>';
	                    $remarkSMSApptContent = array(
	                        'a_id' => $app_id,
	                        'a_remark' => "SMS Sent Successfully ".$smsApptButton,
	                        'created_at' => date('Y-m-d H:i:s'),
	                        'created_by' => $CI->session->userdata('user_id')
	                    );
	                	$remarkApptLastInserted = $CI->mastermodel->master_insert('tbl_appt_remark',$remarkSMSApptContent);				                                      
	                }
	            }else if($getAppt_Controller == 'appointment' && $getMethodName == 'addReport'){
	                if($c_id !="" || $app_id !=""){
	                //if($app_id !=""){
	                    $smsREPOButton = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsModal" id="sent_sms" name="sent_sms" data-sent_sms_id="'.$sent_smsApptInserted.'">View SMS</button>';

	                    $remarkMailContent = array(
	                        'a_id' => $app_id,
	                        'r_remark' => "SMS Sent Successfully ".$smsREPOButton,
	                        'created_at' => date('Y-m-d H:i:s'),
	                        'created_by' => $CI->session->userdata('user_id')
	                    );
	                    $remarkLastInserted = $CI->mastermodel->master_insert('tbl_report_remark',$remarkMailContent);
	                }
	            }else if($getAppt_Controller == 'cases'){				                	
	                if($c_id !="" || $app_id !=""){				                       
	                //if($c_id !=""){				                       
	                    $smsCButton = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsModal" id="sent_sms" name="sent_sms" data-sent_sms_id="'.$sent_smsApptInserted.'">View SMS</button>';
	                    $remarkSMSCContent = array(
	                        'c_id' => $c_id,
	                        'c_remark' => "SMS Sent Successfully ".$smsCButton,
	                        'created_at' => date('Y-m-d H:i:s'),
	                        'created_by' => $CI->session->userdata('user_id')
	                    );
	                    $remarkCLastInserted = $CI->mastermodel->master_insert('tbl_case_remark',$remarkSMSCContent);				                            
	                }
	            }else{
	            	
	            	if($c_id !=""){		
	            			                        
	                    $smsFDBKButton = '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#smsModal" id="sent_sms" name="sent_sms" data-sent_sms_id="'.$sent_smsApptInserted.'">View SMS</button>';
	                    $remarkSMSFDBKContent = array(
	                        'c_id' => $c_id,
	                        'c_remark' => "SMS Sent Successfully ".$smsFDBKButton,
	                        'created_at' => date('Y-m-d H:i:s'),
	                        'created_by' => $CI->session->userdata('user_id')
	                    );
	                    $remarkCFDBKLastInserted = $CI->mastermodel->master_insert('tbl_case_remark',$remarkSMSFDBKContent);				                        
	                }
	            }
	          
	        }
	    }
		        
	}
}

	if (!function_exists('getSentSMSStatus')) {
		function getSMSStatus($message_id){
			//print_r($message_id);exit;
			$curl = curl_init();
	        curl_setopt_array($curl, array(
	        CURLOPT_URL =>'https://api.ap.kaleyra.io/v1/HXAP1636111382IN/messages/status?message_ids='.$message_id.'&api-key=Aebc12bb79cecc469fc48a451657b3c01',
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_ENCODING => "",
	        CURLOPT_MAXREDIRS => 10,
	        CURLOPT_TIMEOUT => 0,
	        CURLOPT_FOLLOWLOCATION => false,
	        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	        CURLOPT_CUSTOMREQUEST => "GET",           
	        ));
	        $response = curl_exec($curl);
	        //$err = curl_error($curl);	        
	        return $response;
	        curl_close($curl);
		}
	}

 	

	if (!function_exists('getTruncatedCCNumber')) {  
		function getTruncatedCCNumber($ccNum){
		   return str_replace(range(0,9), "X", substr($ccNum, 0, -4)) .  substr($ccNum, -4);
		}
	}

	if (!function_exists('telephoneReplceTwodigit')) { 
		function telephoneReplceTwodigit($str){
			return $str;
		}
	}

	if(!function_exists('case_change_mail')){
		function case_change_mail($data)  {

			//print_r($data);

			$CI =& get_instance();		    
			$CI->load->model('appointment/appointmentmodel');
			$CI->load->model('mastermodel');
			date_default_timezone_set('Asia/Kolkata');
		    $c_id = $data['c_id'];
		    $d_id = 0;
		    $error_type='';
		    $app_id = isset($data['app_id']) ? $data['app_id'] : 0;
		    $user_id = $CI->session->userdata('user_id');
		    
		    $errorTypeData	= $CI->appointmentmodel->getDetails('tbl_appointment','error_type','c_id='.$c_id.' AND app_id='.$app_id);
		    if(!empty($errorTypeData)){
		    	$error_type = $errorTypeData[0]->error_type;
		    }
			$email_systemuserdetails = $CI->appointmentmodel->getDetails('user','user_id,name','user_id = '.$user_id);
			
			if($app_id > 0)	{
				$email_appointmentdetails	= $CI->mastermodel->master_get('tbl_appointment','app_id = '.$app_id,'app_date_time, visit_type,dc_id,app_id');
				if(is_array($email_appointmentdetails) && count($email_appointmentdetails) > 0){
					$d_id = $email_appointmentdetails[0]['dc_id'];
				} 
			}			

			$dc_id = isset($data['dc_id']) ? $data['dc_id'] : $d_id;

			if($dc_id > 0){
				$email_diagnostic_center = $CI->appointmentmodel->getDCData($dc_id);
			}

			$from_list = array(
				'WX – Bangalore' 	=> 'wel.bangalore@gmail.com'
			);

			$wxcontact_list = array(
				'WX – Bangalore'	=> '9006775999'
			);

			
			if(isset($email_appointmentdetails) && is_array($email_appointmentdetails)){
				$email_app_date = date( 'Y-m-d',strtotime(str_replace('/', '-',$email_appointmentdetails[0]['app_date_time'])));
				$email_app_time = date('h:i a',strtotime(str_replace('/', '-',$email_appointmentdetails[0]['app_date_time'])));
			}else{
				$email_app_date = '';
				$email_app_time = '';
			}
			
			//echo $c_id; exit();

			$email_casedetails	= $CI->appointmentmodel->getCaseData($c_id);

			//print_r($email_casedetails); exit();

			$ta_code = "WX".str_pad($c_id, 6, "0", STR_PAD_LEFT);				
			$ic_id = $email_casedetails[0]['ic_id'];

			if($ic_id ==2){
				$email_application_no  = $CI->mastermodel->gowel_crypt($email_casedetails[0]['pivotal_application_no'],"d");
			} else{
				$email_application_no  = $CI->mastermodel->gowel_crypt($email_casedetails[0]['application_no'],"d");
			}

			$email_follow_up_date_time =  date( 'Y-m-d h:i a',strtotime(str_replace('/', '-',$email_casedetails[0]['follow_up_date_time'])));
			$email_ic_name = $email_casedetails[0]['ic_name'];
			$email_ic_contact  = $CI->mastermodel->gowel_crypt($email_casedetails[0]['ic_contact'],"d");
			$email_rec_from_name=$email_casedetails[0]['rec_from_name'];
			$email_ic_email_ids  = $CI->mastermodel->gowel_crypt($email_casedetails[0]['ic_contact'],"d");
			$email_rec_from_emailid = $CI->mastermodel->gowel_crypt($email_casedetails[0]['rec_from_emailid'],"d");
			$email_rec_from_contact = !empty($email_casedetails[0]['rec_from_phonenumber']) ? $email_casedetails[0]['rec_from_phonenumber'] : '';
			$email_rec_from_contact = $CI->mastermodel->gowel_crypt($email_rec_from_contact, "d");
			$email_rec_from_contact = $email_rec_from_contact;
			$email_diagnostic_center_center_landline_number = '';
			$email_diagnostic_center_cp_contact_number = '';
			$email_diagnostic_center_address = '';
			$email_diagnostic_center_name = '';
			
			if(isset($email_diagnostic_center) && is_array($email_diagnostic_center) && count($email_diagnostic_center) > 0) {
				//appointment wise
				$email_diagnostic_center_name =  $email_diagnostic_center[0]['center_name'];
				$email_diagnostic_center_center_landline_number = $CI->mastermodel->gowel_crypt($email_diagnostic_center[0]['center_landline_number'],"d");
				$email_diagnostic_center_cp_contact_number = $CI->mastermodel->gowel_crypt($email_diagnostic_center[0]['cp_contact_number'],"d");
				
				if(is_array($email_appointmentdetails) && $email_appointmentdetails[0]['visit_type'] == 'Center'){
					$email_diagnostic_center_address = $email_diagnostic_center[0]['address'];
				}else{
					$email_diagnostic_center_address = '';
				}
			}
			
			$cust_id = 0;
			$cust_type = '';
			
			if(!empty($email_casedetails[0]['spouse_id']))	{
				$email_fullname = $email_casedetails[0]['spouse_firstname']." ".$email_casedetails[0]['spouse_lastname'];
				$email_mobile = $CI->mastermodel->gowel_crypt($email_casedetails[0]['spouse_mobile'],"d");
				$email_address = $CI->mastermodel->gowel_crypt($email_casedetails[0]['spouse_add'],"d");
			    $to_email = $CI->mastermodel->gowel_crypt($email_casedetails[0]['spouse_email'],"d");
			    $cust_id = $email_casedetails[0]['spouse_id'];
			   
			    $email_state="";
			    $cust_type = 'spouse';
				
				if($email_casedetails[0]['spouse_gender'] == 'Female')	{
					$email_gender =  $email_casedetails[0]['spouse_gender'].'<br /><style type="text/css">p { margin-bottom: 0.25cm; direction: ltr; line-height: 120%; text-align: left; }p.western {  }p.ctl { font-family: "Times New Roman"; }a:link { color: rgb(0, 0, 255); }</style>
						<font face="Arial, serif"><font size="1" style="font-size: 8pt"><span style="background: #ffff00">Kindly Note: Medicals needs to be mandatorily conducted by Female Technician only</span></font></font>';
				}else{
					$email_gender =  $email_casedetails[0]['spouse_gender'];
				}
			}else{
				$email_fullname = $email_casedetails[0]['cust_firstname']." ".$email_casedetails[0]['cust_lastname'];
				$email_mobile = $CI->mastermodel->gowel_crypt($email_casedetails[0]['cust_mobile'],"d");
				$email_address = $CI->mastermodel->gowel_crypt($email_casedetails[0]['cust_add'],"d");
				$to_email = $CI->mastermodel->gowel_crypt($email_casedetails[0]['cust_email'],"d");
				$cust_id = $email_casedetails[0]['cust_id'];
				$email_city=$email_casedetails[0]['cust_city'];
				$email_state="";
				$cust_type = 'customer';
				
				if($email_casedetails[0]['cust_gender'] == 'Female'){
					$email_gender =  $email_casedetails[0]['cust_gender'].'<br /><style type="text/css">p { margin-bottom: 0.25cm; direction: ltr; line-height: 120%; text-align: left; }p.western {  }p.ctl { font-family: "Times New Roman"; }a:link { color: rgb(0, 0, 255); }</style>
						<font face="Arial, serif"><font size="1" style="font-size: 8pt"><span style="background: #ffff00">Kindly Note: Medicals needs to be mandatorily conducted by Female Technician only</span></font></font>';
				}else{
					$email_gender =  $email_casedetails[0]['cust_gender'];
				}
		    }
		    
		    $alltest = '';
		    if(isset($data['Individual']) &&  isset($data['Package_test'])){
				//appointment wise 
				$alltestarray = array_merge($data['Individual'],$data['Package_test']);
				if(is_array($alltestarray) && count($alltestarray) > 0){
					$email_testname = $CI->appointmentmodel->getAllTest($alltestarray);
					if(is_array($email_testname) && count($email_testname) > 0){
						 $alltest .= $email_testname[0]['test'];
					}	
				}
			}else{
				//Case all test
				$alltest = $email_casedetails[0]['medical_test'] ." <br>Package : ".$email_casedetails[0]['package_name']; 
			}
		   
		   	$sys_username = $sys_branch =  $sys_contact = '';
			
			if(is_array($email_systemuserdetails) && count($email_systemuserdetails) > 0) {
				$sys_username = $email_systemuserdetails[0]->name;				
				$sys_branch =  $email_casedetails[0]['branch'];
				if(array_key_exists($sys_branch,$wxcontact_list)){
					$sys_contact = $wxcontact_list[$sys_branch];
				}
			}
			
			if($email_casedetails[0]['cust_id'] != ""){
				//$email_state = $CI->mastermodel->master_get('customer, tbl_states',' customer.state=tbl_states.state_id AND customer_id = '.$email_casedetails[0]['cust_id'],'tbl_states.state_name ');
				$email_state = $CI->mastermodel->getTableRecords("customer cust JOIN tbl_states s ON cust.state=s.state_id","s.state_name","cust.customer_id=".$email_casedetails[0]['cust_id']);
				//print_r($email_state);
				if(!empty($email_state) &&  $email_state !=false){
					foreach($email_state as $state_data){
						$email_state=$state_data['state_name'];
					}
				} else{
					$email_state ="";
				}
			}

			$alltest_appointment = '';			
			
			if(isset($data['app_id']) && $data['app_id'] !=''){
				$alltest_id=$CI->mastermodel->master_get('tbl_appointment_tests','app_id='.$data['app_id'],'test_id');
				if(!empty($alltest_id) && $alltest_id != false){
					foreach($alltest_id as $alltest_id){
						$test_name=$CI->mastermodel->master_get('individual_test','test_id='.$alltest_id['test_id'],'test_name');
						$alltest_appointment .=$test_name[0]['test_name'].", ";
					}
				}
				
			}

			//print_r($data['key']); exit();
			
			switch($data['key']) { 
		 		case "UNASSIGNED_CASES_BRANCH":		 	
		 			//print_r($data['to_mail']);exit; 
		 			$result_content1 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'UNASSIGNED_CASES_BRANCH'");
					if(is_array($result_content1) && count($result_content1) > 0){
		 				$system_date=date('Y/m/d H:i:s');
						$table="<table border='1'><thead>
								<th>TA Code</th><th>Application Number</th><th>Customer name</th><th>Insurance Company</th><th>Tests/Packages</th><th>City</th><th>State</th></thead><tbody>";
						$table.="<td>WX".str_pad($c_id, 6, "0", STR_PAD_LEFT)."</td><td>".$email_application_no."</td>";
						$table.="<td>".$email_fullname."</td>";
						$table.="<td>".$email_casedetails[0]['ic_name']."</td>";
						$table.="<td>". $alltest_appointment."</td>";
						$table.="<td>".$email_casedetails[0]['cust_city']."</td>";
						$table.="<td>".$email_state."</td>";
						$table.="</tr>";
						$table.="</tbody></table>";
						$bcc=""; $cc="";
						if(isset($data['key']) && $data['key'] == 'UNASSIGNED_CASES_BRANCH' && $data['to_mail'] !=''){
							$to = $data['to_mail'];
						}else{
							$to = $from_list[$email_casedetails[0]['branch']];	
						}						
						$from ="info@gmail.com";
						$subject = $result_content1[0]->subject;
						$message = str_replace(array('{Case Management_Case list_Wx Branch}','{table}'), array($sys_branch,$table), $result_content1[0]->content);					
						
						if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
							$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
						}						
					}
				break;
				case "Call Later - Customer Not Responding":
					$result_content1 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'STATUS_NOT_RESPONDING_ADVISOR'");
					if(is_array($result_content1) && count($result_content1) > 0){
						$from = $to = $subject = $cc = $bcc = '';						
						if(array_key_exists($email_casedetails[0]['branch'],$from_list)){
						 	$from = $from_list[$email_casedetails[0]['branch']];
							$cc = $from_list[$email_casedetails[0]['branch']];
						}else{
							$from = $result_content1[0]->fromemail;
						}
						$to = $email_rec_from_emailid;
						$subject = str_replace(array(	
							'{application_number}',
							'{customer_name}'
						), array(
							$email_application_no,
							$email_fullname,		
						), $result_content1[0]->subject);
						
						$message = str_replace(array(		
							'{customer_name}',
							'{application_number}',
							'{wx_branch_contact_no}',
							'{wx_branch}'
						), array(
							$email_fullname,
							$email_application_no,
							$sys_branch,
							$sys_contact	
						), $result_content1[0]->content);
					}
					 
					if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
						$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
					}
					  
				  	//sms tigger//				  	
				  	$sms = $CI->appointmentmodel->getdatadetails("tbl_smscontents","sms_Key = 'STATUS_NOT_RESPONDING_ADVISOR_SMS' AND ic_id=0");
				  	if(is_array($sms) && count($sms) > 0 && $email_rec_from_contact != "") {				  		
					 	$sms_content = str_replace(array(
					 		'{received_from_Name}',
							'{customer_name}',
							'{Branch_contacts}.'
						), array(
							$email_rec_from_name,
							$email_fullname,
							$sys_contact
						), $sms[0]->content);						
						
						trigger_sms2($email_rec_from_contact,$sms_content);
				  	}
									  	
					$result_content2 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'STATUS_NOT_RESPONDING_CUSTOMER'");
					if(is_array($result_content2) && count($result_content2) > 0){
						$from = $to = $subject = $cc = $bcc = '';						
						if(array_key_exists($email_casedetails[0]['branch'],$from_list)){
						 	$from = $from_list[$email_casedetails[0]['branch']];
							$cc = $from_list[$email_casedetails[0]['branch']];
						}else{
						 	$from = $result_content2[0]->fromemail;
						}
						$to = $to_email;
						$link = '<a href="'.base_url().'">'.base_url().'</a>';
						$subject = str_replace(array(	
							'{application_number}',
							'{insurance_company_name}'
						), array(	
							$email_application_no,
							$email_casedetails[0]['ic_name'],		
						), $result_content2[0]->subject);
						
						$message = str_replace(array(
							'{ic_mobile}',
							'{insurance_company_name}',		
							'{application_number}',
							'{wx_branch_contact_no}',
							'{Assigned Executive}',
							'{link}',
							'{Assigned Executive Name}',
							'{WX – Branch name}',
							'{Contact no}'
						), array(
							$email_ic_contact,
							$email_ic_name,
							$email_application_no,
							$sys_contact,
							$sys_username,
							$link,
							$sys_username,
							$sys_branch,
							$sys_contact
						), $result_content2[0]->content);
					}				
					
					if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
						$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
				 	}
					
				break;
				    
			 	case "Appointment Missed - Reschedule Appointment" :
					$result_content1 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'STATUS_APPOINTMENT_MISSED_ADVISOR'");
					if(is_array($result_content1) && count($result_content1) > 0){
						$from = $to = $subject = $cc = $bcc = '';						
						if(array_key_exists($email_casedetails[0]['branch'],$from_list)){
						 	$from = $from_list[$email_casedetails[0]['branch']];
							$cc = $from_list[$email_casedetails[0]['branch']];							 
						}else{
						 	$from = $result_content1[0]->fromemail;
						}
						$to = $email_rec_from_emailid;
						$subject = str_replace(array(	
							'{application_number}',
							'{customer_name}'
						), array(	
							$email_application_no,
							$email_fullname,		
						), $result_content1[0]->subject);
						
						$message = str_replace(array(		
							'{Medical_type}',
							'{customer_name}',
							'{application_number}',
							'{appointment_data}',
							'{appointment_time}',
							'{center_name}',
							'{wx_branch_contact_no}',
							'{wx_branch}'
						), array(
							$email_casedetails[0]['case_type'],
							$email_fullname,
							$email_application_no,
							$email_app_date,
							$email_app_time,
							$email_diagnostic_center[0]['center_name'],
							$sys_contact,
							$sys_branch
						), $result_content1[0]->content);
					}
					
					if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
						//$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
				 	}					
			    break;

			 	case "Call Later - Customer asked to call back" :
					$result_content1 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'STATUS_CALL_LATER_ADVISOR'");
					if(is_array($result_content1) && count($result_content1) > 0){
						$from = $to = $subject = $cc = $bcc = '';
						if(array_key_exists($email_casedetails[0]['branch'],$from_list)){
							 	$from = $from_list[$email_casedetails[0]['branch']];
								$cc = $from_list[$email_casedetails[0]['branch']];
						}else{
							$from = $result_content1[0]->fromemail;
						}
						$to = $email_rec_from_emailid;
						$subject = str_replace(array(	
							'{application_number}',
							'{customer_name}'
						), array(	
							$email_application_no,
							$email_fullname,		
						), $result_content1[0]->subject);
							
						$message = str_replace(array(		
							'{customer_name}',
							'{application_number}',
							'{follow_up_date_time}',
							'{wx_contact_number}'
						), array(
							$email_fullname,
							$email_application_no,
							$email_follow_up_date_time,
							$sys_contact
						), $result_content1[0]->content);
					}
						
					if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)) {
						$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
					}
				break;
						
			 	case "Closed - Reports submitted to insurer" :
					$attachment_code =  "";
					$feedbacklink = rtrim(strtr(base64_encode($c_id), '+/', '-_'), '=');

					//$cases_medical_awaited_appointments	= $CI->mastermodel->master_get('tbl_appointment','c_id = '.$c_id);
					$cases_medical_awaited_appointments	= $CI->mastermodel->getTableRecords('tbl_appointment','app_id,dc_id,c_id, app_status, report_status', 'c_id='.$c_id,"");
					$app_id = $cases_medical_awaited_appointments[0]['app_id'];
					$diagnostic_center = [];
					$dc_center = [];

					if(is_array($cases_medical_awaited_appointments) && count($cases_medical_awaited_appointments) > 0){
					   	foreach($cases_medical_awaited_appointments as $key1 => $val1){
					   		$reports = $CI->mastermodel->master_get('tbl_app_report','app_id = '.$val1['app_id']);
							if(is_array($reports) && count($reports) > 0){
							   	foreach($reports as $rkey => $rval){
									$CI->email->attach(DOC_ROOT_FRONT."/reports/".$rval['reportname']);
							   	}								   
							}
							if($val1['app_status'] =='Completed' && $val1['report_status'] =='Completed'){
								$dc_center[] = $val1['dc_id'];								
							}
						}
					}
					$dcs = implode(',', $dc_center);
					$dd = $CI->mastermodel->getTableRecords('diagnostic_center','center_name', 'dc_id IN('.$dcs.')',"");
					foreach($dd as $ddkey1 => $ddval1){
						$diagnostic_center[] = $ddval1['center_name'];
					}
					$diagnostic_center = implode(',', $diagnostic_center);
			 
					$result_content1 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'STATUS_REPORTS_CLOSED_INSURER'");
					if(is_array($result_content1) && count($result_content1) > 0) {
						$from = $to = $subject = $cc = $bcc = '';
						$branch_email_val = (!empty($from_list[$email_casedetails[0]['branch']])) ? $from_list[$email_casedetails[0]['branch']] : '';
						$branch_no_val = (!empty($wxcontact_list[$email_casedetails[0]['branch']])) ? $wxcontact_list[$email_casedetails[0]['branch']] : '';
						
						$from = $result_content1[0]->fromemail;					
						$cc .= 'reports@gmail.com';

						$subject = str_replace(array(	
						'{application_number}',
						'{customer_name}'
						), array(	
						$email_application_no,
						$email_fullname,		
						), $result_content1[0]->subject);
						
						$message = str_replace(array(
						'{insurance_company_name}',		
						'{customer_name}',
						'{application_number}',
						'{test}',
						'{wx_branch}',
						'{wx_branch_contact_no}',
						'{wx_branch_emaiid}'
						), array(
						$email_ic_name,
						$email_fullname,
						$email_application_no,
						$alltest,
						$sys_branch,
						$branch_no_val,
						$branch_email_val
						), $result_content1[0]->content);

						if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
							$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);						
					 	}
					}
					//as per email of Suresh L Advisor email stopped for aviva					
					$result_content2 = [];
					if($ic_id != 20){ 
						$result_content2 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'STATUS_REPORTS_CLOSED_ADVISOR'");
					}	
						
					if(is_array($result_content2) && count($result_content2) > 0){
						$from = $to = $subject = $cc = $bcc = '';
						if(array_key_exists($email_casedetails[0]['branch'],$from_list)){
						 	$from = $from_list[$email_casedetails[0]['branch']];
						 	$cc = $from_list[$email_casedetails[0]['branch']];
						}else{
						 	$from = $result_content2[0]->fromemail;
						}
						$to = $email_rec_from_emailid;
						$subject        = str_replace(array(	
						'{application_number}',
						'{customer_name}'
						), array(	
						$email_application_no,
						$email_fullname,		
						), $result_content2[0]->subject);
						
						$message        = str_replace(array(
						'{customer_name}',
						'{application_number}',
						'{test}',
						'{wx_branch}',
						'{wx_branch_contact_no}'
						), array(
						$email_fullname,
						$email_application_no,
						$alltest,
						$sys_branch,
						$sys_contact
						), $result_content2[0]->content);

						if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
							$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
					 	}
				 	}
				 	
				 	$icArray = [5,7,19,16];
				 	if(!in_array($ic_id, $icArray)){
						$FBcc = $CI->mastermodel->gowel_crypt($email_casedetails[0]['cust_mobile'],"d");
						$custno = explode(',', $FBcc);
						$sms_key = 'CUST_FEEDBACK';
						$feedBSMS = "Dear ".$email_fullname.", Greetings ! We Thank you for your kind cooperation in completing the medicals. We request you to share your feedback with us through the below link. https://insurance.gmail.com/custfeedback/".$feedbacklink;							
						//tigger_sms($custno[0],$feedBSMS,$c_id,$app_id,$sms_key,'','FeedBackURL');	
					}				
						 
				break;						
				case "Escalated to Insurance Co - Customer Not Interested":
					$result_content1 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'STATUS_NOT_INTERESTED_ADVISOR'");
					if(is_array($result_content1) && count($result_content1) > 0){
						$from = $to = $subject = $cc = $bcc = '';
						if(array_key_exists($email_casedetails[0]['branch'],$from_list)){
						 	$from = $from_list[$email_casedetails[0]['branch']];
						 	$cc = $from_list[$email_casedetails[0]['branch']];
						}else{
						 	$from = $result_content1[0]->fromemail;
						}
						$to = $email_rec_from_emailid;
							
						$subject = str_replace(array(	
							'{application_number}',
							'{customer_name}'
						), array(
							$email_application_no,
							$email_fullname,		
						), $result_content1[0]->subject);
					
						$message = str_replace(array(		
							'{customer_name}',
							'{application_number}',
							'{wx_contact_number}',
							'{Assigned_Executive}'
						), array(
							$email_fullname,
							$email_application_no,
							$sys_contact,
							$sys_username
						), $result_content1[0]->content);
					}
					
					if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
						$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
					}
					 
					$CI->email->clear(TRUE); 
					$result_content2 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'STATUS_ESCALATED_TO_INSURANCE_COMPANY_CUSTOMER_NOT_INTERESTED_ADVISOR'");
					if(is_array($result_content2) && count($result_content2) > 0){
						$from = $to = $subject = $cc = $bcc = '';
						if(array_key_exists($email_casedetails[0]['branch'],$from_list)){
						 	$from = $from_list[$email_casedetails[0]['branch']];
							$cc = $from_list[$email_casedetails[0]['branch']];
						}else{
						 	$from = $result_content2[0]->fromemail;
						}
						$to = $email_rec_from_emailid;
				
						$subject = str_replace(array(	
							'{application_number}',
							'{Salutation}',
							'{customer_name}'
						), array(	
							$email_application_no,
							'',
							$email_fullname,		
						), $result_content2[0]->subject);
						
						$message = str_replace(array(
							'{Salutation}',
							'{customer_name}',
							'{username}',
							'{wx_branch}',
							'{wx_branch_contact_no}',
						), array(
							'',
							$email_fullname,
							$sys_username,
							$sys_branch,
							$sys_contact
						), $result_content2[0]->content);
					}
					
					if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
					   $CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
					}
					//sms tigger//
					$sms = $CI->appointmentmodel->getdatadetails("tbl_smscontents","sms_Key = 'STATUS_NOT_INTERESTED_ADVISOR_SMS' AND ic_id=0");
					if(is_array($sms) && count($sms) > 0 && $email_rec_from_contact != ""){
						$sms_content = str_replace(array(
							'{Case_received_Name}',		
							'{customer_name}',
							'{Branch_contacts}'
						), array(
							$email_rec_from_name,
							$email_fullname,
							$sys_contact
						), $sms[0]->content);						
												
						trigger_sms2($email_rec_from_contact,$sms_content);

				  	}
					//sms tigger//
					 
			    break;
			  
			   	case "Escalated to Insurance Co - Customer No Show":
			        $result_content1 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'STATUS_ESCALATED_TO_INSURANCE_COMPANY_CUSTOMER_NO_SHOW_ADVISOR'");
					if(is_array($result_content1) && count($result_content1) > 0){
						$from = $to = $subject = $cc = $bcc = '';
						if(array_key_exists($email_casedetails[0]['branch'],$from_list)){
							$from = $from_list[$email_casedetails[0]['branch']];
							$cc = $from_list[$email_casedetails[0]['branch']];
						}else{
							$from = $result_content1[0]->fromemail;
						}
						$to = $email_rec_from_emailid;
						$subject = str_replace(array(	
							'{application_number}',
							'{Salutation}',
							'{customer_name}'
						), array(	
							$email_application_no,
							'',
							$email_fullname,		
						), $result_content1[0]->subject);
						
						$message = str_replace(array(
							'{Salutation}',
							'{customer_name}',
							'{username}',
							'{wx_branch}',
							'{wx_branch_contact_no}',
						), array(
							'',
							$email_fullname,
							$sys_username,
							$sys_branch,
							$sys_contact
						), $result_content1[0]->content);
					}
					
					if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
						$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
					}
		        break;
				
			  	case "Escalated to Insurance Co - Customer Not Responding/Wrong Number":
			        $result_content1 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'STATUS_ESCALATED_TO_INSURANCE_COMPANY_CUSTOMER_NOT_RESPONDING_WRONG_NUMBER_ADVISOR'");
					if(is_array($result_content1) && count($result_content1) > 0){
						$from = $to = $subject = $cc = $bcc = '';
						if(array_key_exists($email_casedetails[0]['branch'],$from_list)){
						 	$from = $from_list[$email_casedetails[0]['branch']];
							$cc = $from_list[$email_casedetails[0]['branch']];
						}else{
						 	$from = $result_content1[0]->fromemail;
						}
						$to = $email_rec_from_emailid;
											
						$subject = str_replace(array(	
							'{application_number}',
							'{Salutation}',
							'{customer_name}'
						), array(	
							$email_application_no,
							'',
							$email_fullname,		
						), $result_content1[0]->subject);
						
						$message = str_replace(array(
							'{Case_Management_Case_list_Name}',
							'{Case_Management_Case_list_Application number}',
							'{Case Management _Case list_Wx_Contact Number}',
							'{username}',
							'{wx_branch}',
							'{wx_branch_contact_no}',
						), array(
							$email_fullname,	
							$email_application_no,
							$sys_contact,
							$sys_username,
							$sys_branch,
							$sys_contact
						), $result_content1[0]->content);
					}
					
					if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
						$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
					}
					 
		        break;
			  	case "Escalated to Insurance Co - Customer Not Co-operating":
					$result_content1 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'STATUS_ESCALATED_TO_INSURANCE_COMPANY_CUSTOMER_NOT_COOPERATING_ADVISOR'");
						if(is_array($result_content1) && count($result_content1) > 0){
							$from = $to = $subject = $cc = $bcc = '';
							if(array_key_exists($email_casedetails[0]['branch'],$from_list)){
								$from = $from_list[$email_casedetails[0]['branch']];
								$cc = $from_list[$email_casedetails[0]['branch']];
							}else{
								$from = $result_content1[0]->fromemail;
							}
							$to = $email_rec_from_emailid;
							
							$subject = str_replace(array(	
								'{application_number}',
								'{Salutation}',
								'{customer_name}'
							), array(	
								$email_application_no,
								'',
								$email_fullname,		
							), $result_content1[0]->subject);
							
							$message = str_replace(array(
								'{Salutation}',
								'{customer_name}',
								'{username}',
								'{wx_branch}',
								'{wx_branch_contact_no}',
							), array(
								'',
								$email_fullname,
								$sys_username,
								$sys_branch,
								$sys_contact
							), $result_content1[0]->content);
						}
						
						if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
							$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
						}
					break;
				
					case "Escalated to Insurance Co - Other TPA Completed":
						$result_content1 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'STATUS_ESCALATED_TO_INSURANCE_COMPANY_OTHER_TPA_COMPLETED_ADVISOR'");
						if(is_array($result_content1) && count($result_content1) > 0){
							$from = $to = $subject = $cc = $bcc = '';
							if(array_key_exists($email_casedetails[0]['branch'],$from_list)){
								$from = $from_list[$email_casedetails[0]['branch']];
								$cc = $from_list[$email_casedetails[0]['branch']];
							}else{
								$from = $result_content1[0]->fromemail;
							}
							$to = $email_rec_from_emailid;
								
						   	$subject = str_replace(array(	
								'{application_number}',
								'{Salutation}',
								'{customer_name}'
							), array(	
								$email_application_no,
								'',
								$email_fullname,		
							), $result_content1[0]->subject);
								
							$message = str_replace(array(
								'{Salutation}',
								'{customer_name}',
								'{username}',
								'{wx_branch}',
								'{wx_branch_contact_no}',
							), array(
								'',
								$email_fullname,
								$sys_username,
								$sys_branch,
								$sys_contact
							), $result_content1[0]->content);
						}
							
						if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
							$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
						}
					break;
							
					case "Escalated to Insurance Co - Unable to find DC":
						$result_content1 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'STATUS_ESCALATED_TO_INSURANCE_COMPANY_UNABLE_TO_FIND_DC_ADVISOR'");
						if(is_array($result_content1) && count($result_content1) > 0){
							$from = $to = $subject = $cc = $bcc = '';
							if(array_key_exists($email_casedetails[0]['branch'],$from_list)){
								$from = $from_list[$email_casedetails[0]['branch']];
								$cc = $from_list[$email_casedetails[0]['branch']];
							}else{
								$from = $result_content1[0]->fromemail;
							}
							$to = $email_rec_from_emailid;
									
							$subject = str_replace(array(	
								'{application_number}',
								'{Salutation}',
								'{customer_name}'
							), array(	
								$email_application_no,
								'',
								$email_fullname,		
							), $result_content1[0]->subject);
								
							$message = str_replace(array(
								'{Salutation}',
								'{customer_name}',
								'{username}',
								'{wx_branch}',
								'{wx_branch_contact_no}',
							), array(
								'',
								$email_fullname,
								$sys_username,
								$sys_branch,
								$sys_contact
							), $result_content1[0]->content);
						}
								
						if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
							$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
						}
					break;
								
				    case "Cancelled by Insurance Company - Customer cancelled policy":
						$result_content1 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'STATUS_CANCELLED_BY_INSURANCE_COMPANY_CUSTOMER_CANCELLED_POLICY_ADVISOR'");
						if(is_array($result_content1) && count($result_content1) > 0){
							$from = $to = $subject = $cc = $bcc = '';
							if(array_key_exists($email_casedetails[0]['branch'],$from_list)){
								$from = $from_list[$email_casedetails[0]['branch']];
								$cc = $from_list[$email_casedetails[0]['branch']];
							}else{
								$from = $result_content1[0]->fromemail;
							}
							$to = $email_rec_from_emailid;
								
							$subject = str_replace(array(	
								'{application_number}',
								'{Salutation}',
								'{customer_name}'
							), array(	
								$email_application_no,
								'',
								$email_fullname,		
							), $result_content1[0]->subject);
								
							$message = str_replace(array(
								'{Salutation}',
								'{customer_name}',
								'{username}',
								'{wx_branch}',
								'{wx_branch_contact_no}',
							), array(
								'',
								$email_fullname,
								$sys_username,
								$sys_branch,
								$sys_contact
							), $result_content1[0]->content);
						}
							
						if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)) {
							$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
						}
					break;
							
				 	case "Cancelled by Insurance Company - Customer Not Interested":
						$result_content1 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'STATUS_CANCELLED_BY_INSURANCE_COMPANY_CUSTOMER_NOT_INTERESTED_ADVISOR'");
						if(is_array($result_content1) && count($result_content1) > 0){
							$from = $to = $subject = $cc = $bcc = '';
							if(array_key_exists($email_casedetails[0]['branch'],$from_list)){
								$from = $from_list[$email_casedetails[0]['branch']];
								$cc = $from_list[$email_casedetails[0]['branch']];
							}else{
								$from = $result_content1[0]->fromemail;
							}
							$to = $email_rec_from_emailid;
							
							$subject = str_replace(array(	
								'{application_number}',
								'{Salutation}',
								'{customer_name}'
							), array(	
								$email_application_no,
								'',
								$email_fullname,		
							), $result_content1[0]->subject);
							
							$message = str_replace(array(
								'{Salutation}',
								'{customer_name}',
								'{username}',
								'{wx_branch}',
								'{wx_branch_contact_no}',
							), array(
								'',
								$email_fullname,
								$sys_username,
								$sys_branch,
								$sys_contact
							), $result_content1[0]->content);
						}
						
						if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
							$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
						}
						 
					break;
					
					case "Cancelled by Insurance Company - Other TPA completed":
						$result_content1 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'STATUS_CANCELLED_BY_INSURANCE_COMPANY_OTHER_TPA_COMPLETED_ADVISOR'");
						if(is_array($result_content1) && count($result_content1) > 0){
							$from = $to = $subject = $cc = $bcc = '';
							if(array_key_exists($email_casedetails[0]['branch'],$from_list)){
								$from = $from_list[$email_casedetails[0]['branch']];
								$cc = $from_list[$email_casedetails[0]['branch']];
							}else{
								$from = $result_content1[0]->fromemail;
							}
							$to = $email_rec_from_emailid;
							$subject = str_replace(array(	
								'{application_number}',
								'{Salutation}',
								'{customer_name}'
							), array(	
								$email_application_no,
								'',
								$email_fullname,		
							), $result_content1[0]->subject);
							
							$message = str_replace(array(
								'{Salutation}',
								'{customer_name}',
								'{username}',
								'{wx_branch}',
								'{wx_branch_contact_no}',
							), array(
								'',
								$email_fullname,
								$sys_username,
								$sys_branch,
								$sys_contact
							), $result_content1[0]->content);
						}
						
						if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
							$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
						}
					break;
					
					case "Cancelled by Insurance Company - No DC / Unable to complete":
						$result_content1 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'STATUS_CANCELLED_BY_INSURANCE_COMPANY_NO_DC_UNABLE_TO_COMPLETE_ADVISOR'");
						if(is_array($result_content1) && count($result_content1) > 0){
							$from = $to = $subject = $cc = $bcc = '';
							if(array_key_exists($email_casedetails[0]['branch'],$from_list)){
								$from = $from_list[$email_casedetails[0]['branch']];
								$cc = $from_list[$email_casedetails[0]['branch']];
							}else{
								$from = $result_content1[0]->fromemail;
							}
							$to = $email_rec_from_emailid;
							
							$subject = str_replace(array(	
								'{application_number}',
								'{Salutation}',
								'{customer_name}'
							), array(	
								$email_application_no,
								'',
								$email_fullname,		
							), $result_content1[0]->subject);
							
							$message = str_replace(array(
								'{Salutation}',
								'{customer_name}',
								'{username}',
								'{wx_branch}',
								'{wx_branch_contact_no}',
							), array(
								'',
								$email_fullname,
								$sys_username,
								$sys_branch,
								$sys_contact
							), $result_content1[0]->content);
						}
						
						if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
							$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
						}
					break;
						
			  		case "QC Error": //appointmnet Report status
			        	$result_content1 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'STATUS_QC_ERROR_GOWELL_BRANCH_GOWELL_BRANCH'");
						if(is_array($result_content1) && count($result_content1) > 0){
							$from = $to = $subject = $cc = $bcc = '';
							$from="reports@gmail.com";
							
							if(array_key_exists($email_casedetails[0]['branch'],$from_list)){
								$to = $from_list[$email_casedetails[0]['branch']];
								$cc = $CI->mastermodel->WX_branch_manager($email_casedetails[0]['branch']);
							}
							$bcc = '';
							$subject = str_replace(array(	
								'{application_number}'
							), array(	
								$email_application_no
							), $result_content1[0]->subject);
						
							$message = str_replace(array(
								'{wx_branch}',
								'{application_number}',
								'{error_type}',
								'{customer_name}'
							), array(
								$sys_branch,
								$email_application_no,
								$error_type,
								$email_fullname
							), $result_content1[0]->content);
						}
					
						if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
							$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
					 	}
			        break;			        
			    	case "Complete": //appointmnet Report status
						$result_content3 = $CI->appointmentmodel->getdatadetails("tbl_emailcontents","mail_Key = 'CUST_FEEDBACK'");
						$from = $to = $subject = $cc = $bcc = '';
						if(is_array($result_content3) && count($result_content3) > 0 && $ic_id!=7) {
							
							$link_key = base64_encode($cust_id)."@@@@@@".base64_encode($cust_type)."@@@@@@".base64_encode($c_id)."@@@@@@".base64_encode($dc_id);
							$link = base_url()."login/rateyo/".$link_key; 
							if(array_key_exists($email_casedetails[0]['branch'],$from_list)){
							 	$from = $from_list[$email_casedetails[0]['branch']];
								//$cc = $from_list[$email_casedetails[0]['branch']];
							}else{
								$from = $result_content3[0]->fromemail;
							}
							$to = $email_rec_from_emailid;
							
							$subject = str_replace(array(	
								'{application_number}'
							), array(	
								$email_application_no	
							), $result_content3[0]->subject);
							
							$message = str_replace(array(
								'{customer_name}',
								'{insurance_company_name}',
								'{application_number}',
								'{center_name}',
								'{link}',
								'{wx_branch_email_id}',
								'{wx_branch_contact_no}'
							), array(
								$email_fullname,
								$email_ic_name,
								$email_application_no,
								'',
								$link,
								$sys_branch,
								$sys_contact
							), $result_content3[0]->content);
						}
					 
						if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
							$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);
					 	}


					break;       
			  	default:
				//do something else again
				break;     		
			}
		}  
	}

	if(!function_exists('email_trigger')){
		function email_trigger($from,$to,$subject,$message,$cc='',$bcc=''){		 
	    	$CI  =& get_instance();
	     	$CI->load->model('mastermodel');
	     	$CI->mastermodel->sendEMail($from,$to,$cc,$bcc,$subject,$message);			
		}
	} 

	function autoCaseStatusChange($c_id, $app_id = '', $dc_id = '') {

		date_default_timezone_set('Asia/Kolkata');
	 	try{
			$CI  =& get_instance();
			$CI->load->model('appointment/appointmentmodel');
			$CI->load->model('mastermodel');
			$case_status = $CI->mastermodel->master_get("tbl_case","c_id =".$c_id,'case_status,videography,ic_id');
			$old_case_status = $videography = $ic_id = '';
			$user_id = $CI->session->userdata('user_id');
			if(!empty($case_status) && $case_status !=false){
				foreach($case_status as $data){
		   			$old_case_status = $data['case_status'];
					$videography = $data['videography'];
		   			$ic_id = $data['ic_id'];
				}
			}
			$appointment = $CI->appointmentmodel->getReportStatus($c_id);
			$appointmentstatus = $CI->appointmentmodel->getAppointmentStatus($c_id);	

			if($videography == "Yes"){
				$case_count = $CI->mastermodel->master_get('tbl_case_tests, tbl_case','tbl_case.c_id=tbl_case_tests.c_id AND tbl_case_tests.c_id='.$c_id.' AND tbl_case.is_deleted="No" AND tbl_case_tests.test_id NOT IN(1168,1086,1143,910)','count(*) as count');
			}else{
				$case_count = $CI->mastermodel->master_get('tbl_case_tests, tbl_case','tbl_case.c_id=tbl_case_tests.c_id AND tbl_case_tests.c_id='.$c_id.' And tbl_case.is_deleted="No"','count(*) as count');
			}
			

			$case_package_count = $CI->mastermodel->master_get('test_package, tbl_case','tbl_case.package_test=test_package.test_pack_id And tbl_case.c_id='.$c_id.' And tbl_case.is_deleted="No"','test_package.test_include');

			$ttt = preg_replace("/[^a-zA-Z0-9,]/", "", $case_package_count[0]['test_include']);
			$case_package_count = explode(",",$ttt);			

			if(!empty($case_package_count) && $case_package_count[0] !=''){
				//unset MER tests from package_test to match the count
				if($ic_id == 3 AND $videography == "Yes"){
					
					$key1 = array_search('1168', $case_package_count);
					unset($case_package_count[$key1]);
				}else if($ic_id == 16 AND $videography == "Yes"){
					
					$key1 = array_search('1086', $case_package_count);
					unset($case_package_count[$key1]);
					
					$key2 = array_search('1143', $case_package_count);
					unset($case_package_count[$key1]);
					
				}else if($ic_id == 18 AND $videography == "Yes"){
					$key1 = array_search('910', $case_package_count);
					unset($case_package_count[$key1]);
				}
				
				$case_package_count = count($case_package_count); 
			} else{
				$case_package_count=0;
			}
			if(!empty($case_count)){
				$case_count = $case_count[0]['count'];
				
			} else{
				$case_count = 0;	
			}			
			$case_count = $case_count + $case_package_count;
			
			/*Countnumber tests in case
			Count number tests in appointment*/
			$appointment_count = $CI->mastermodel->master_get('tbl_appointment_tests, tbl_appointment','tbl_appointment.is_deleted="No" AND tbl_appointment_tests.c_id='.$c_id.' AND tbl_appointment_tests.app_id=tbl_appointment.app_id','count(*) as count');
			
			$appointment_count = (int)$appointment_count[0]['count'];
			/*Count number tests in appointment*/
			//echo $case_count ."==". $appointment_count; exit();
			$date = date('Y-m-d H:i:s');

			if(is_array($appointment) && $appointment !=false){

				$a_status = array_unique(explode(",",$appointmentstatus[0]['App Status']));
				$r_status = array_unique(explode(",",$appointment[0]['Report Status']));

				$case['updated_at'] = $date;		
				$case['updated_by'] = $user_id;

				if(in_array('Cancelled',$a_status) && count($a_status) == 1) {
					//echo 'Escalated to Insurance Co - Customer No Show'; //old status
					$case = array();
				   	$case['case_status'] = 'Cancelled by Insurance Company - Customer Not Interested';
				   	$returnPMCaseStatus = $case['case_status'];
				   	$case['gwl_case_status'] = '15';				   	
				   	$case['ic_case_status'] = '1';				   	
				   	$case['esc_cancelled_at'] = $date;				   			   
				   	$result = $CI->mastermodel->remarks_cases('Case Status',$old_case_status,$case['case_status'],$c_id);	

				   	$CI->appointmentmodel->updateRecord('tbl_case', $case, 'c_id', $c_id);
	   
				   	$cancelled_appointment = $CI->mastermodel->master_get("tbl_appointment","c_id = ".$c_id." AND app_status = 'Cancelled'");
					if(is_array($cancelled_appointment) && count($cancelled_appointment) > 0) {
						foreach($cancelled_appointment as $key => $value) {
							$report_status = array();
							$report_status['report_status'] = 'NA';
							$report_status['updated_at'] = $date;
							$CI->appointmentmodel->updateRecord('tbl_appointment', $report_status, 'app_id', $value['app_id']);
					   	}
				   	}
				}
				else if(in_array('Reschedule',$a_status) && count($a_status) == 1){
				    $case = array();
				   	$case['case_status'] = 'Appointment Missed - Reschedule Appointment';
				   	$returnPMCaseStatus = $case['case_status'];
				   	$case['gwl_case_status'] = '7';				   
				   	$result=$CI->mastermodel->remarks_cases('Case Status',$old_case_status,$case['case_status'],$c_id);
				   	$CI->appointmentmodel->updateRecord('tbl_case', $case, 'c_id', $c_id);				  
	   			}
	   			else if(in_array('Reschedule',$a_status) && (in_array('Pending', $r_status) || in_array('NA', $r_status)) || $case_count>$appointment_count) {			
					$case = array();
				   	$case['case_status'] = 'Appointment Related - Partial Medicals Pending';
				   	$returnPMCaseStatus = $case['case_status'];
				   	$case['gwl_case_status'] = '8';
				   	$result=$CI->mastermodel->remarks_cases('Case Status',$old_case_status,$case['case_status'],$c_id);
				   	$CI->appointmentmodel->updateRecord('tbl_case', $case, 'c_id', $c_id);
				}
				else if(( (in_array('Completed',$r_status) || in_array('NA',$r_status) ) && !in_array('Pending',$r_status) && !in_array('Recd - Awaiting QC',$r_status) && !in_array('QC Error',$r_status) )  && !in_array('Scheduled',$a_status) && !in_array('Reschedule',$a_status) && (in_array('Completed',$a_status)) ) {
				   	//echo "Closed - Reports submitted to insurer"; && $case_count == $appointment_count
				   	$case = array();
				   	$case['case_status'] = 'Closed - Reports submitted to insurer';
				   	$returnPMCaseStatus = $case['case_status'];
				   	$case['gwl_case_status'] = '24';
				   	$case['ic_case_status']  = '';
				    $caseCompletion_H = (int) date('H',strtotime($date));
					$caseCompletion_M = (int) date('i',strtotime($date));
					$caseCompletion_S = (int) date('s',strtotime($date));
					$ttotalBackMnts = ($caseCompletion_H*60*60) + ($caseCompletion_M*60)+$caseCompletion_S+2;
					
					if($caseCompletion_H >=0 && $caseCompletion_H <=6){
						$completion_date_time = date('Y-m-d H:i:s',strtotime($date ."-$ttotalBackMnts seconds") );
					} else{
						$completion_date_time = $date;
					}
				   	$case['closed_medicals_completed_reports_date'] = $completion_date_time;

				   	$result=$CI->mastermodel->remarks_cases('Case Status',$old_case_status,$case['case_status'],$c_id);	   
				   	$CI->appointmentmodel->updateRecord('tbl_case', $case, 'c_id', $c_id);

				   	/*trigger email */
				   	$data = array();
				   	$data['c_id'] = $c_id;
				   	$data['key'] = $case['case_status'];
				    $CI->appointmentmodel->recursiveCall('case_change_mail',$data);
				   	//case_change_mail($data);
				   	/*trigger email */
				   
				}
				else if((in_array('Completed',$a_status) || in_array('Cancelled',$a_status)) && in_array('Recd - Awaiting QC',$r_status) && !in_array('QC Error',$r_status) && !in_array('Pending',$r_status))	{
				   	//echo "Reports rec’d - QC Pending";
				   	$case = array();
				   	$case['case_status'] = 'Reports rec’d - QC Pending';
				   	$returnPMCaseStatus = $case['case_status'];
				   	$case['gwl_case_status'] = '22';						   	
				   	$result=$CI->mastermodel->remarks_cases('Case Status',$old_case_status,$case['case_status'],$c_id);	   
				   	$CI->appointmentmodel->updateRecord('tbl_case', $case, 'c_id', $c_id);

				}
				else if((in_array('Completed',$a_status) || in_array('Cancelled',$a_status)) && (in_array('Recd - Awaiting QC',$r_status) || in_array('QC Error',$r_status)) && !in_array('Pending',$r_status))	{
				   	$case = array();
				   	$case['case_status'] = 'DC sent Incorrect/Incomplete Report';
				   	$returnPMCaseStatus = $case['case_status'];
				   	$case['gwl_case_status'] = '23';
				   	$case['ic_case_status'] = '241';
				   	$result=$CI->mastermodel->remarks_cases('Case Status',$old_case_status,$case['case_status'],$c_id);
				   	$CI->appointmentmodel->updateRecord('tbl_case', $case, 'c_id', $c_id);
				} 
				else if((in_array('Completed',$a_status) || in_array('Cancelled',$a_status)) && in_array('Pending',$r_status) && !in_array('Scheduled', $a_status) && !in_array('Reschedule', $a_status) && !in_array('Pending', $a_status)) {
				   	//echo "Medicals Done - Report Awaited";exit();
				   	$case = array();
				   	$case['case_status'] = 'Medicals Done - Report Awaited';
				   	$returnPMCaseStatus = $case['case_status'];
				   	$case['gwl_case_status'] = '21';					   	
				   	$case['ic_case_status'] = '9';
				   	$result=$CI->mastermodel->remarks_cases('Case Status',$old_case_status,$case['case_status'],$c_id);
				   	$CI->appointmentmodel->updateRecord('tbl_case', $case, 'c_id', $c_id);

				   	$sms =$CI->appointmentmodel->getdatadetails("tbl_smscontents","sms_Key='STATUS_MEDICALS_DONE_REPORTS_AWAITED_ADVISOR_SMS' AND ic_id=0");
				
				   	if(is_array($sms) && count($sms) > 0 ) {
						
						$sms_result = $CI->mastermodel->master_get('tbl_appointment, tbl_case ,customer','tbl_case.c_id='.$c_id.' AND tbl_case.c_id=tbl_appointment.c_id AND customer.customer_id=tbl_case.cust_id','tbl_case.rec_from_name,customer.first_name, tbl_case.rec_from_phonenumber, tbl_case.application_no, tbl_case.ic_id,tbl_case.pivotal_application_no');

						$sms_result[0]['rec_from_phonenumber'] = $CI->mastermodel->gowel_crypt($sms_result[0]['rec_from_phonenumber'],'d');
						
						if($sms_result[0]['ic_id']==2){
							$application_no = $CI->mastermodel->gowel_crypt($sms_result[0]['pivotal_application_no'],"d");
						}else{
							$application_no = $CI->mastermodel->gowel_crypt($sms_result[0]['application_no'],"d");
						}

					   	$sms_content = str_replace(array(		
						   '{Case_received_Name}',
						   '{Case_owner}',
						   '{Application_number}'
						), array(
							$sms_result[0]['rec_from_name'],
							$sms_result[0]['first_name'],
							$application_no 
						), $sms[0]->content);					   

						trigger_sms2($sms_result[0]['rec_from_phonenumber'],$sms_content);
					}

				} else if(in_array('Pending',$a_status)) {
					$case = array();
					$case['case_status'] = 'UNASSIGNED';
					$returnPMCaseStatus = $case['case_status'];
					$case['gwl_case_status'] = '27';					   	
					$CI->appointmentmodel->updateRecord('tbl_case', $case, 'c_id', $_POST['c_id']);
				} else{
					$case = array();
					$case['case_status'] = 'Appointment Confirmed';
					$returnPMCaseStatus = $case['case_status'];
					$case['gwl_case_status'] = "6";						    
					$result=$CI->mastermodel->remarks_cases('Case Status',$old_case_status,'Appointment Confirmed',$c_id);
					$CI->appointmentmodel->updateRecord('tbl_case', $case, 'c_id', $_POST['c_id']);
				}
			}
			return $returnPMCaseStatus;	   
			//return true;	   
		}catch(Exception $ex){
			return $ex->getMessage();
		}
	}

	

	if(!function_exists('DC_registration')){
    	function DC_registration($data){
    		$CI = & get_instance();
    		$CI->load->model('cases/Casesmodel');
			$sms = $CI->Casesmodel->getdatadetails("tbl_smscontents","sms_Key = 'DC_REGI_SMS' AND ic_id=0");
			if(is_array($sms) && count($sms) > 0 ){
				$sms_content = str_replace(array(
					'{center_name}',
					'{center_id}',
					'{Branch_phone_number}'
				), array(
					$data['center_name'],
					$data['center_id'],
					$data['contact']
				), $sms[0]->content);
			 	//trigger_sms2($data['contact'],$sms_content);
			}

			$sms = $CI->Casesmodel->getdatadetails("tbl_smscontents","sms_Key = 'DC_USER_REGI_USERNAME_SMS' AND ic_id=0");
			if(is_array($sms) && count($sms) > 0 ){
				$sms_content = str_replace(array(
					'{username}',
					'{password}'
				), array(
					$data['username'],
					$data['password'],
				), $sms[0]->content);
			 	//trigger_sms2($data['contact'],$sms_content);
			}
			
    	}
	}

	if(!function_exists('change_pm_date')){
		function change_pm_date($date){
			if (strpos($date, 'PM') !== false) {
				$date=explode(" ",$date);
				$time=explode(":",$date[1]);
				if($time[0]<12){
					$time[0]=$time[0]+12;
				}else{
					$time[0]="00";
				}
				array_push($time,"00");
				$time=implode(":",$time);
				$date[1]=$time;
				$date=implode(" ",$date);
				$date=str_replace("PM","",$date);
			}else{
				$date=str_replace("AM","",$date);
				$date=explode(" ",$date);
				$time=explode(":",$date[1]);
				array_push($time,"00");
				$time=implode(":",$time);
				$date[1]=$time;
				$date=implode(" ",$date);
			}
			$date=str_replace("/","-",$date);
			return $date;
		}
	}

	if(!function_exists('phpmailer')){
		function phpmailer($from='',$to='',$cc='',$bcc='',$subject='',$message='',$attachment='',$attachment_name='',$addto=''){

			$CI  =& get_instance();
			$CI->load->library("phpmailer_library");
			$mail = $CI->phpmailer_library->load();
			// Passing `true` enables exceptions
			try {	
				//Server settings		  
				$mail->isSMTP();						// Set mailer to use SMTP
				$mail->SMTPDebug = 0;               	// Enable verbose debug output    
				$mail->SMTPAuth = true;             	// Enable SMTP authentication     
				$mail->SMTPSecure = 'ssl';         		//Enable TLS encryption, `ssl` also accepted
				$mail->Host = 'ssl://smtp.sendgrid.net';// Specify main and backup SMTP servers
				//$mail->Host = 'smtp.sendgrid.net';  	// Specify main and backup SMTP servers
				$mail->Port = 465;                  	// TCP port to connect to
				$mail->isHTML(true);                	// Set email format to HTML
				//$mail->Username = ''; 	// SMTP username
				//$mail->Password = '';  		// SMTP password
				$mail->Username  = '';
        		$mail->Password  = '';
			
				//Recipients
				$mail->setFrom($from, $from);
				$mail->addAddress($to, $to);

				if(!empty($addto) && is_array($addto)){
					foreach ($addto as $key => $addtoT) {
						$mail->addAddress($addtoT, $addtoT);
					}
				}else{
					$mail->addAddress($addto, $addto);
				}
				/*if($addto != ''){
					$mail->addAddress($addto, $addto);
				}*/
			    
		    	// Add a recipient
		    	if(!empty($cc) && is_array($cc)){
		    		foreach($cc as $ccs){
				   		$mail->addCC($ccs,$ccs);
					}
				}else{
					$mail->addCC($cc,$cc);
				}

				if(!empty($bcc) && is_array($bcc)){
		    		foreach($bcc as $bccs){
				   		$mail->addBcc($bccs,$bccs);
					}
				}else{
					$mail->addBcc($bcc,$bcc);
				}
				
				//Attachments
				$mail->addAttachment($attachment,$attachment_name); 
							
				//Content				
				$mail->Subject = $subject;
				$mail->Body    = $message;
				//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				//print_r($cc);exit;
				if($mail->send()){
					return true;
				}else{
					return false;
				}
				//return 'Send Mail';
			} catch (Exception $e) {
				//return  'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
			}
		}
	}

	if(!function_exists('phpmailerV2')){
		function phpmailerV2($from='',$to='',$cc='',$bcc='',$subject='',$message='',$attachment='',$attachment_name='',$addto=''){

			$CI  =& get_instance();
			$CI->load->library("phpmailer_library");
			$mail = $CI->phpmailer_library->load();
			// Passing `true` enables exceptions
			try {	
				//Server settings		  
				$mail->isSMTP();						// Set mailer to use SMTP
				$mail->SMTPDebug = 0;               	// Enable verbose debug output    
				$mail->SMTPAuth = true;             	// Enable SMTP authentication     
				$mail->SMTPSecure = 'tls';         		//Enable TLS encryption, `ssl` also accepted
				// $mail->Host = 'ssl://smtp.sendgrid.net';// Specify main and backup SMTP servers
				$mail->Host = 'smtp.sendgrid.net';// Specify main and backup SMTP servers
				$mail->Port = 587;                  	// TCP port to connect to
				$mail->isHTML(true);                	// Set email format to HTML
				//$mail->Username = ''; 	// SMTP username
				//$mail->Password = '';  		// SMTP password
				$mail->Username  = '';
        		$mail->Password  = '';
			
				//Recipients
				$mail->setFrom($from, $from);
				$mail->addAddress($to, $to);

				if(!empty($addto) && is_array($addto)){
					foreach ($addto as $key => $addtoT) {
						$mail->addAddress($addtoT, $addtoT);
					}
				}else{
					$mail->addAddress($addto, $addto);
				}
				/*if($addto != ''){
					$mail->addAddress($addto, $addto);
				}*/
			    
		    	// Add a recipient
		    	if(!empty($cc) && is_array($cc)){
		    		foreach($cc as $ccs){
				   		$mail->addCC($ccs,$ccs);
					}
				}else{
					$mail->addCC($cc,$cc);
				}

				if(!empty($bcc) && is_array($bcc)){
		    		foreach($bcc as $bccs){
				   		$mail->addBcc($bccs,$bccs);
					}
				}else{
					$mail->addBcc($bcc,$bcc);
				}
				
				//Attachments
				$mail->addAttachment($attachment,$attachment_name); 
							
				//Content				
				$mail->Subject = $subject;
				$mail->Body    = $message;
				//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				//print_r($cc);exit;
				if($mail->send()){
					return true;
				}else{
					return false;
				}
				//return 'Send Mail';
			} catch (Exception $e) {
				//return  'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
			}
		}
	}

//Exide Api Data Start
	if (!function_exists('WX_Contact')) {
	    function WX_Contact($Branch) {
	    	
	        $sys_contact="9006775999"; 
	        $wxcontact_list = array(
	            'WX – Bangalore'	=> '9006775999',
	        );	
	        if(array_key_exists($Branch,$wxcontact_list))
	        {
	            $sys_contact = $wxcontact_list[$Branch];
	        }
	        return $sys_contact;
	    }
	}

	if (!function_exists('WX_emails')) {
	    function WX_emails($Branch) {
	    	$sys_contact ="info@gmail.com";
	        $wxcontact_list = array(
	            'WX – Bangalore' 	=> 'wel.bangalore@gmail.com',	            
	        );	
	        if(array_key_exists($Branch,$wxcontact_list))
	        {
	            $sys_contact = $wxcontact_list[$Branch];
	        }
	        return $sys_contact;
	   	}
	}

	if (!function_exists('WX_branch_manager')){
		function WX_branch_manager($Branch){
			$sys_contact ="";
	        $wxcontact_list = array(
	            'WX – Bangalore'	=> 'raushank@gmail.com'
	        );	
	        if(array_key_exists($Branch,$wxcontact_list))
	        {
	            $sys_contact = $wxcontact_list[$Branch];
	        }
	        return $sys_contact;
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

	if (!function_exists('getMasterRecords')) {   
	    function getMasterRecords($tableName,$colName,$condition) {    
	        $CI = & get_instance();
	        $sql = "SELECT ".$colName." FROM ".$tableName." WHERE ".$condition;
	        $query = $CI->db->query($sql);  
	        //echo $CI->db->last_query();exit;     
	        if($query->num_rows() > 0) {
	        $data = $query->result_array();
	            return $data;
	        } else {
	            return false;
	        }
	    }
	}

	if (!function_exists('commonInsertRecords')) {   
	    function commonInsertRecords($tableName,$data) {    
			$CI = & get_instance();
	        $CI->db->insert($tableName, $data);
	        return $CI->db->insert_id();
	    }
	}

	if (!function_exists('updateRecord')) {
	    function updateRecord($tableName,$data,$columnName,$value) { 
	        $CI = & get_instance();
	        $CI->db->where("$columnName", $value);
	        $CI->db->update($tableName, $data);
	        //echo $this->db->last_query();exit;
	        if ($CI->db->affected_rows() > 0) {
	            return true;
	        } else {
	            return false;
	        }
	    }
	}


	
	/**For Auto Logout From All Browser**/
	if (!function_exists('auto_logout_when_change_password')) {
		function auto_logout_when_change_password() {
			$CI = & get_instance();
			$user_id = $CI->session->userdata('user_id');
			$login_token = $CI->session->userdata('loginToken');
			$CI->load->model('mastermodel','',TRUE);
			$data['user_logs'] = $CI->mastermodel->getTableRecords("userlog","user_id,action","user_id='$user_id' AND action='LOGOUT' AND login_token='$login_token'","");	
			if(!empty($data['user_logs']) && count($data['user_logs']) > 0){
				
				$userlog['logout_time'] = date('Y-m-d H:i:s');
				$userlog['action'] = "LOGOUT";
		
				unset($_SESSION["webadmin"]);
				unset($_SESSION["useradmin"]);
				unset($_COOKIE["gwl_secretkey"]);
				$CI->session->sess_destroy();
				
				//echo "<script>alert('Your password has been changed from other browser, please login again to access account')</script>";
				redirect('login');
			}
		}
	}

	

//Exide Api Data End
