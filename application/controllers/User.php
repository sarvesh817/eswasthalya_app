<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends MY_Controller {

	public function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
		$this->load->model('user_model');
		$this->load->model('mastermodel','',TRUE);
    }
    
    public function userList(){

    	//print_r($this->session->userdata('mer_type_id'));

    	if( $this->privilegeduser->hasPrivilege("ListUser") || $this->userprivileged->hasUserPrivilege("ListUser") ){
    		//$subroleId = $this->session->userdata('subrole_id');
			$data['user_list'] = $this->user_model->getData();
			$data['header']	= 'User List | Medical App Solutions Pvt. Ltd.';
			$this->load->view('template/header',$data);
			$this->load->view('user/index');
			$this->load->view('template/footer');
		}else if($this->privilegeduser->hasPrivilege("doctorList") || $this->userprivileged->hasUserPrivilege("doctorList")){
			$doctor['doctor_list'] = $this->user_model->getDoctorList();
			$doctor['header']	= 'Doctor List | Medical App Solutions Pvt. Ltd.';
			$this->load->view('template/header',$doctor);
			$this->load->view('user/index');
			$this->load->view('template/footer');
		}else{
			redirect('login', 'refresh');
		}
	}


	public function doctorList(){
		$doctor['doctor_list'] = $this->user_model->getDoctorList();
		$doctor['header']	= 'Doctor List | Eswasthalya';
		$this->load->view('template/header',$doctor);
		$this->load->view('user/doctor-list');
		$this->load->view('template/footer');
	}



    public function addDoctorView(){
		//$data['role'] = $this->mastermodel->master_get("roles",'role_id IN (1,2,3)');
		//$data['state'] = $this->mastermodel->master_get("tbl_states",'1=1');
		//$data['doc_quali'] = $this->mastermodel->master_get("doctor_qualification",'is_deleted="No"','edu_id,qualification');		
		$data['header'] = 'User Register | Eswasthalya App';
		//$this->load->view('template/header', $data);
		$this->load->view('user/user-register', $data);
		//$this->load->view('template/footer');
	}


	public function submitForm() {

		parse_str($_POST['formdata'],$formdata);
		if(isset($formdata['email']) && $formdata['email'] !=''){
			$condition = "email = '".gowelEncrypt($formdata['email'])."'";			
			$check_name = $this->mastermodel->master_get("user",$condition);
			if( is_array($check_name) && count($check_name) >= 1){
				echo json_encode(array("success"=>"0",'msg'=>'Username Already Taken, Try With Another!'));exit;
			}
		}
		
		if(isset($formdata['contact']) && $formdata['contact'] !=''){
			$condition = "contact = '".gowelEncrypt($formdata['contact'])."'";			
			$check_contact = $this->mastermodel->master_get("user",$condition);
			if( is_array($check_contact) && count($check_contact) >= 1){
				echo json_encode(array("success"=>"0",'msg'=>'This Contact Number Allready Exist with Another User!'));exit;
			}
		}

		$data = array();
		$date = date("Y-m-d h:i:s");
		if(isset($formdata['email']) && $formdata['email'] !=""){
			$email_id = strtolower($formdata['email']);
			$data['email'] = gowelEncrypt($email_id);
			$REMARKS['Email'] = $formdata['email'];
		}
		
		if(isset($formdata['contact']) && $formdata['contact'] !=""){
			$contact = strtolower($formdata['contact']);
			$data['contact'] = gowelEncrypt($contact);
			$REMARKS['Contact Number'] = $formdata['contact'];
		}

		$data['name'] = $formdata['first_name'].' '.$formdata['last_name'];
		$REMARKS['Name'] = $formdata['first_name'].' '.$formdata['last_name'];

		$generated_password = $formdata['password'];
		$md5_generated_password = md5($generated_password);
		$data['password'] = $md5_generated_password;

		$result = 0;

		$data['created_at'] = $date;
		
		$data['user_type'] = $formdata['profile_type'];
		$REMARKS['User Type'] = $formdata['profile_type'];
		
	    $FourDigitRandomNumber = mt_rand(1111,9999);
	    $data['email_otp'] = $FourDigitRandomNumber;	
		

		$result = $this->mastermodel->master_insert('user',$data);
		//`id`, `profile_type`, `first_name`, `last_name`, `email`, `password`, `status`, `checked_term_condition`, `created_at`
		$user_id = $result;
        $this->session->set_userdata('emailverifyuser', $user_id);
		if($result > 0){
            
            
             $emailContent = '';
             $from_email = "kraushan6102@gmail.com"; 
             $to_email = $email_id; //$this->input->post('email');
             $name = $formdata['first_name'].''.$formdata['last_name'];
             $this->load->library('email'); 
             $this->email->from($from_email, 'Eswasthalya Portal'); 
             $this->email->to($to_email);
             $this->email->subject('Eswasthalya Email Verification OTP'); 
             $emailContent .= "Email Verification Code ".$FourDigitRandomNumber."</a>";
             //Send mail 
             $this->email->message($emailContent);
                 
            $this->email->send();
			$response = array('success'=>'1','msg'=>'Account has been created Successfully.','emailotp'=>'Sent the OTP to your registered email address.');
		}else{
			$response = array('success'=>'0','msg'=>'Problem in data update.');
		}
		echo json_encode($response); exit();
		
		
        echo"<pre>";print_r($result);exit;
          
          
		$URemarks=[];
		foreach ($REMARKS as $Ckey => $Cvalue) {
			$URemarks[] = "<b>".$Ckey ."</b>: ". $Cvalue;
		}
		//echo"<pre>";print_r($URemarks);exit;
		$URemarks = implode(' | ',$URemarks);
		$review['user_remark'] ="<b>New ".$result." Record Inserted/Updated Successfully:</b><br/> ". $URemarks;
		$review['user_id'] = $result;				
		$review['created_at'] = date('Y-m-d H:i:s');
		//$caseRemark = $this->mastermodel->master_insert('user_report_remark',$case_review);
		if($result > 0){
			$link = $from = $to = $subject = $cc = $bcc = '';
			$link = base_url();
			$response = array('success'=>'1','msg'=>'Record Inserted/Updated Successfully.');
		}else{
			$response = array('success'=>'0','msg'=>'Problem in data update.');
		}
		echo json_encode($response); exit();
	}
	
	public function emailVerify() {
	    $this->load->model('loginmodel','',TRUE);
		parse_str($_POST['formdata'],$formdata);
		$data = array();
		$date = date("Y-m-d h:i:s");
		$num1 = $formdata['num1'];
		$num2 = $formdata['num2'];
		$num3 = $formdata['num3'];
		$num4 = $formdata['num4'];
		$uid= $formdata['euserid'];
		$emailOTP = $num1.$num2.$num3.$num4;
		$user_details = $this->mastermodel->master_get('user',"email_otp ='$emailOTP' AND user_id = '$uid'",'user_id');
		if(!empty($user_details) && $user_details !=false) {
			$user_id = $user_details[0]['user_id'];
			$fpwd_data['email_verify_status']= 1;
			$fpwd_data['email_verify_date']= date("Y-m-d h:i:s");
			$FourDigitRandomNumber = mt_rand(1111,9999);
	        $fpwd_data['mobile_otp'] = $FourDigitRandomNumber;
			$fpwd_updateRecord = $this->loginmodel->updateRecord($fpwd_data, $user_id);
			$this->session->unset_userdata('emailverifyuser');	
            $this->session->set_userdata('mobileverifyuser', $user_id);
            $this->session->set_userdata('mobileverifyuserotp', $FourDigitRandomNumber);
			$response = array('success'=>'1','msg'=>'Email Verification has been Successfully.');
		} else{
		    $response = array('success'=>'0','msg'=>'Email OTP Do not Matched.');
	    }	

		echo json_encode($response); exit();
		
	}
	
    public function mobileVerify() {
	    $this->load->model('loginmodel','',TRUE);
		parse_str($_POST['formdata'],$formdata);
		$data = array();
		$date = date("Y-m-d h:i:s");
		$num1 = $formdata['num1'];
		$num2 = $formdata['num2'];
		$num3 = $formdata['num3'];
		$num4 = $formdata['num4'];
		$uid= $formdata['muserid'];
		$mobileOTP = $num1.$num2.$num3.$num4;
		$user_details = $this->mastermodel->master_get('user',"mobile_otp ='$mobileOTP' AND user_id = '$uid'",'user_id');
		if(!empty($user_details) && $user_details !=false) {
			$user_id = $user_details[0]['user_id'];
			$fpwd_data['mobile_verify_status']= 1;
			$fpwd_data['mobile_verify_date']= date("Y-m-d h:i:s");
			$fpwd_updateRecord = $this->loginmodel->updateRecord($fpwd_data, $user_id);
			$this->session->unset_userdata('mobileverifyuser');
			$this->session->unset_userdata('mobileverifyuserotp');
			$response = array('success'=>'1','msg'=>'Mobile Verification has been Successfully.');
		} else{
		    $response = array('success'=>'0','msg'=>'Mobile OTP Do not Matched.');
	    }	

		echo json_encode($response); exit();
		
	}

	
	public function addNewUser(){
		$data['state'] = $this->mastermodel->master_get("tbl_states",'1=1');
		$data['header'] = 'Add New User | Medical App Solutions Pvt. Ltd.';
		$this->load->view('template/header',$data);
		$this->load->view('user/addUser');
		$this->load->view('template/footer');
	}

	public function editUser($id = NULL){
		//print_r($_POST);exit;
		$key_id = $_REQUEST['text'];
		$convertKey = base64_decode(strtr($key_id, '-_', '+/'));
		$explodeUserID = explode('=', $convertKey);
		$user_id = $explodeUserID[1];
		if(is_numeric($user_id) && $user_id > 0){
			if ($this->privilegeduser->hasPrivilege("editUserProfile") || $this->userprivileged->hasUserPrivilege("editUserProfile")){
				$result['action'] = 'Add';
				$result['users'] = array();
				$result['subrole'] = array(); 
				$result['seldc'] ='';
			   	$result['statewisedc'] ='';
	   			
			    $result['business_channel'] = getBusinessChannels();
			   	$result['users'] = $this->mastermodel->master_get("user",'user_id='.$user_id);
				$result['subrole'] = $this->mastermodel->master_get("subroles",'role_id='.$result['users'][0]['role_id']);
				
			   	if(!empty($result['users'])){
			   		if($result['users'][0]['user_type'] =='DCUSER'){
				   		$user_type_id = $result['users'][0]['user_type_id'] !=''?$result['users'][0]['user_type_id']:0;
				   		$userstates   =	$result['users'][0]['state_id'] !=''?$result['users'][0]['state_id']:0;		   		
				   		$result['seldc'] = $this->mastermodel->master_get("diagnostic_center",'is_deleted="No" AND dc_id='.$user_type_id,"dc_id,center_name");
				   		$result['statewisedc'] = $this->mastermodel->master_get("diagnostic_center",'is_deleted="No" AND state IN ('.$userstates.')',"dc_id,center_name");
			   		}
			   	}
			   	$result['mer_types'] = $this->mastermodel->getTableRecords('mer_types',"mer_id,mer_type,status,mer_for","status='Active'");
			   	$result['branch'] = $this->mastermodel->master_get("branch");
			   	$result['role'] = $this->mastermodel->master_get("roles",'role_id IN (1,2,3)');
			   	$result['state'] = $this->mastermodel->master_get("tbl_states",'1=1');
			   	$result['reporting_person'] = $this->mastermodel->getTableRecords('user u JOIN subroles sr ON u.subrole_id=sr.subrole_id',"user_id,name,subrole","u.subrole_id IN (8,9,14,17,19) AND u.status='Approved'");
			   	//$result['ic'] = $this->mastermodel->master_get("insurance_company",'is_deleted="No"');
			   	$result['header'] = 'Edit User Detail | Medical App Solutions Pvt. Ltd.';
			   	$this->load->view('template/header', $result);
			   	$this->load->view('user/addEdit');
			   	$this->load->view('template/footer');
		 	}else{
			   	redirect('home', 'refresh');
		 	}
		}else{
			redirect('404_override', 'refresh'); exit();
		}
			
	}

	public function lockUnlockAccount(){
		$user_id = $this->input->post('user_id');
		$data_try = $this->input->post('data_try');
		if(!empty($user_id)){
			if($data_try=="Locked"){
				$data['incorrect_try'] = "4";	
				$color="#f70606";
				$title = "Click to UnLock";
				$data_try1 ="UnLocked";

			} else if($data_try=="UnLocked"){
				$data['incorrect_try'] = "0";	
				$color="#52c1e8";
				$title = "Click to Lock";
				$data_try1 ="Locked";
			}
			$this->user_model->updateRecord('user', $data, 'user_id', $user_id);
		}
		echo  "<span class='incorrecttry' data-try='".$data_try1."' data-userid='".$user_id."' title='".$title."' style='cursor: pointer;color:".$color.";'>".$data_try."</span>";
	}



	public function submitForm_old() {
		if(array_key_exists('HTTP_X_REQUESTED_WITH',$_SERVER) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && ($this->privilegeduser->hasPrivilege("addUser") || $this->userprivileged->hasUserPrivilege("addUser")) ){
			
			$this->load->helper('email_configure');
			parse_str($_POST['formdata'],$formdata);

			if(isset($formdata['email']) && $formdata['email'] !=''){

				$condition = "email = '".gowelEncrypt($formdata['email'])."'";			
				if(array_key_exists('user_id',$formdata) && $formdata['user_id'] > 0){
					$condition .= " &&  user_id != ".$formdata['user_id'];
					$condition .= " &&  user_type != 'CUSTOMER'";
				}			
				$check_name = $this->mastermodel->master_get("user",$condition);
				if( is_array($check_name) && count($check_name) >= 1){
					echo json_encode(array("success"=>"0",'msg'=>'Username Already Taken, Try With Another!'));exit;
				}
			}


			$data = array();
			$passwordhistorydata = array();		
			$date = date("Y-m-d H:i:s");
			$stateids=[];
		
			if(isset($formdata['state']) && $formdata['state'] !=''){
				
				if(in_array('All', $formdata['state']) || $formdata['state'] == 'All'){

					$state_id=$this->mastermodel->master_get('tbl_states',' 1=1','state_id');
					foreach ($state_id as $stateKey => $stateVal) {
						$stateids[]= $stateVal['state_id'];
					}
					$data['state_id'] = implode(',', $stateids);
					$REMARKS['State'] = getStateName($data['state_id']);				

				}else{
					$stateids = $formdata['state'];
					$data['state_id'] =implode(",",$formdata['state']);
					$REMARKS['State'] = getStateName($data['state_id']);
				}
			}
		
			$welBranch = [];
			$wel_branch_id = [];

			//print_r($stateids); exit();
			
			for ($st=0; $st <count($stateids) ; $st++) { 

				$stat_id = $stateids[$st];
				$branch = $this->mastermodel->getTableRecords('branch',"branch_name,branch_id","FIND_IN_SET(".$stat_id.",state_id)");				
				if(!empty($branch) && $branch !=false){
					foreach ($branch as $WBIkey => $WBIvalue) {
						$branch_id = $WBIvalue['branch_id'];
						if(!in_array($branch_id, $wel_branch_id) ){
							$welBranch[]     = $WBIvalue['branch_name'];
							$wel_branch_id[] = $branch_id;	
						}
					}					
				}
			}

			//print_r($welBranch); exit();

			if(isset($formdata['branch']) && $formdata['branch']!=''){

				if($formdata['branch'][0] == "All"){
					$data['wel_branch_id'] = implode(',', $wel_branch_id);
					$data['branch'] = implode(',', $welBranch);
					$REMARKS['Branch'] = $data['branch'];
				}else{
					$wel_branchID = [];
					$welBlist = implode("','", $formdata['branch']);		
					$brancID = $this->mastermodel->master_get("branch","branch_name IN('".$welBlist."')",'branch_id');
					if(!empty($brancID) && $brancID !=false){
						foreach ($brancID as $BIDkey => $BIDvalue) {
							$wel_branchID[] = $BIDvalue['branch_id'];
						}	
					}

					$data['wel_branch_id'] = implode(',', $wel_branchID);
					$data['branch'] = implode(',',$formdata['branch']);
					$REMARKS['Branch'] = $data['branch'];
				}

			} else{				
				$data['branch'] = implode(',', $welBranch);
				//$REMARKS['Branch'] = $data['branch'];
			}
			
			if(isset($formdata['role_id']) && $formdata['role_id'] == 3){
				$branch_str = '';
				
				$data['user_type'] = 'SUPERADMIN';
				if(isset($formdata['subrole_id']) && $formdata['subrole_id'] !=15){
					$data['user_type_id'] =0 ;	
				
				}

				if(isset($formdata['gwlempid']) && $formdata['gwlempid'] !=""){
					$data['gwlempid'] = $formdata['gwlempid'];
				}
								
			} else if(isset($formdata['role_id']) && $formdata['role_id'] == 1){
				$DCuserType_id = $formdata['dc_id'];
				$data['user_type_id'] = $DCuserType_id;
				$data['user_type'] = 'DCUSER';
				$data['gwlempid'] ='';
				$center_details = $this->mastermodel->master_get("diagnostic_center","dc_id =".$formdata['dc_id']);	
				//echo"<pre>";print_r($center_details);exit;

			}else if(isset($formdata['role_id']) && $formdata['role_id'] == 2){
				$ICuserType_id = $formdata['ic_id'];
				$data['user_type_id'] = implode(',',$ICuserType_id);
				$data['user_type'] = 'ICUSER';
				$data['gwlempid'] ='';
			}
			//$REMARKS['dc_id'] = $formdata['dc_id'];
			
			$data['contact'] = $this->mastermodel->gowel_crypt($formdata['contact'],"e");

			$REMARKS['Contact'] = $formdata['contact'];

			if(isset($formdata['role_id'])){
				$data['role_id'] = $formdata['role_id'];
			}
			$REMARKS['Role Id'] = $formdata['role_id'];

			if(isset($formdata['subrole_id'])){
				$data['subrole_id'] = $formdata['subrole_id'];
			}
			$REMARKS['Subrole Id'] = $formdata['subrole_id'];

			if(isset($formdata['parent_id']) && $formdata['parent_id'] !=""){
				$data['parent_id'] = $formdata['parent_id'];
				$REMARKS['Parent Id'] = $formdata['parent_id'];
			}
			

			if(isset($formdata['business_channel'])){	
				if($formdata['business_channel'][0] == "All"){
					$data['business_channel'] = implode(",", getBusinessChannels());
				}else{					
					$data['business_channel'] = implode(',',$formdata['business_channel']);	
				}
				$REMARKS['Business Channel'] = $data['business_channel'];
			}
			
			
			if(isset($formdata['mer_type_id'])){

				if($formdata['mer_type_id'][0] == "All"){
					$mer_types = $this->mastermodel->getTableRecords('mer_types',"mer_id,mer_type,status,mer_for","status='Active'");
					$mt = [];
					foreach ($mer_types as $mtkey => $mtvalue) {
						$mt[] = $mtvalue['mer_id'];
					}
					$data['mer_type_id'] = implode(",", $mt);
					$REMARKS['Mer Type Id'] = $data['mer_type_id'];
				}else{					
					$data['mer_type_id'] = implode(',',$formdata['mer_type_id']);
					$REMARKS['Mer Type Id'] = $data['mer_type_id'];	
				}
			
			}

			if(isset($formdata['email']) && $formdata['email'] !=""){
				$email_id = strtolower($formdata['email']);
				$data['email'] = gowelEncrypt($email_id);
				$REMARKS['Email'] = $formdata['email'];
			}
			
			//print_r($data); exit();


			if(isset($formdata['ic_id'])){			
				$icIds =[];
				if($formdata['ic_id'][0] == ''){				
					$ic_details=$this->user_model->getAllICDetails();				
					foreach ($ic_details as $icKey => $icVal) {
						$icIds[] = $icVal['ic_id'];
					}
					$data['ic_id'] = implode(',', $icIds);	
					$REMARKS['IC Id'] = getICName($data['ic_id']);
				}else{
					$data['ic_id'] = implode(",",$formdata['ic_id']);
					$REMARKS['IC Id'] = getICName($data['ic_id']);
				}
			}
			
			$data['name'] = $formdata['name'];
			$REMARKS['Name'] = $formdata['name'];

			if($formdata['status']=='Rejected'){
				$this->db->query("DELETE FROM role_user WHERE user_id=".$formdata['user_id']);
			}

			if(isset($formdata['lpassword']) && $formdata['lpassword'] !=""){
				$generated_password = $formdata['lpassword'];
				$md5_generated_password = md5($generated_password);
				$data['password'] = $md5_generated_password;
			} else{
				$generated_password = $data['user_type']."gwl@123";
				$md5_generated_password = md5($generated_password);
			}

			$data['status'] = $formdata['status'];
			$REMARKS['Status'] = $formdata['status'];

			$data['designation'] = $formdata['designation'];
			$REMARKS['Designation'] = $formdata['designation'];

			$data['department'] = $formdata['department'];
			$REMARKS['Department'] = $formdata['department'];

			$data['function_area'] = $formdata['function'];
			$REMARKS['Function'] = $formdata['function'];

			$data['worklocation'] = $formdata['worklocation'];
			$REMARKS['Worklocation'] = $formdata['worklocation'];

			$data['joining_date_time'] = convertDMY_YMD($formdata['joining_date_time']);
			$REMARKS['Joining Date Time'] = convertDMY_YMD($formdata['joining_date_time']);

			$data['relieving_date_time'] = convertDMY_YMD($formdata['relieving_date_time']);
			$REMARKS['Relieving Date Time'] = convertDMY_YMD($formdata['relieving_date_time']);

			$data['password_set_date'] = date("Y-m-d H:i:s");
			$REMARKS['Password set date'] = date("Y-m-d H:i:s");
			
			$result = 0;
			if(array_key_exists('user_id',$formdata) && $formdata['user_id'] > 0){

				$lastprofile = $this->mastermodel->getTableRecords('user',"subrole_id","user_id=".$formdata['user_id']);
				$lastsubrole = $lastprofile[0]['subrole_id'];
				$newsubrole  = $formdata['subrole_id'];
				$REMARKS['Subrole Id']  = $formdata['subrole_id'];
				
				if($lastsubrole!=$newsubrole){
					$this->db->query("DELETE FROM role_user WHERE user_id=".$formdata['user_id']);
				}
				
				$user_field = array('name','user_type','gwlempid','address','branch','email','contact','state_id','business_channel','role_id','subrole_id','status','mer_type_id','designation','department','function_area','worklocation','joining_date_time','relieving_date_time');

				$user_field_name = array('User Name','User Profile','Emp ID','User Address','Weknext Branch','User Email','User Contact','User State','Business Channel','User Role','User Subrole','User Status','MER Type','User Designation','User Department','User Functional Area','User Worklocation','User Join Date','User Releiving Date');
				//print_r($formPostData);exit;
				$userDetails = $this->mastermodel->getTableRecords("user","name,user_type_id,user_type,gwlempid,address,branch,email,contact,state_id,business_channel,role_id,subrole_id,status,mer_type_id,designation,department,function_area,worklocation,joining_date_time,relieving_date_time","user_id=".$formdata['user_id']);
				
				if(!empty($userDetails) && $userDetails !=false){

					$user_type_id = $userDetails[0]['user_type_id'];

					foreach($userDetails as $user_data){
						for($a=0;$a<count($user_field);$a++){

							$existKey = $user_field[$a];
							
							if( $user_data[$user_field[$a]] != $formdata[$user_field[$a]] ){

								$old_value = $user_data[$user_field[$a]]; 
								$new_value = $formdata[$user_field[$a]];
								
								if($user_field[$a] == "ic_id" && $user_data[$user_field[$a]] !=''){
									$old_icName = $new_icName = [];
									$old_icId = $this->mastermodel->master_get('insurance_company','ic_id IN ('.$user_data[$user_field[$a]].')','name');

									foreach($old_icId as $val){
										$old_icName[] = $val['name'];
									}
									$old_value = implode(',', $old_icName);

									$new_icId = $this->mastermodel->master_get('insurance_company','ic_id IN ('.$data['ic_id'].')','name');										

									foreach($new_icId as $val){
										$new_icName[] = $val['name'];			
									}
									$new_value = implode(',', $new_icName);

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "name"){
									$old_value = $old_value; 
									$new_value = $new_value;

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "user_type"){
									$old_value = $old_value; 
									$new_value = $new_value;

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "gwlempid"){
									$old_value = $old_value; 
									$new_value = $new_value;

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "address"){
									$old_value = $old_value; 
									$new_value = $new_value;

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "branch"){
									$old_value = $old_value; 
									$new_value = $new_value;

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($dr_field[$a] == "email"){
									$old_value = gowelDcrypt($old_value); 
									$new_value = gowelDcrypt($new_value);
									
									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($dr_field[$a] == "contact"){
									$old_value = gowelDcrypt($old_value);
									$new_value = gowelDcrypt($new_value);
									
									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "state_id"){
									$old_state = $this->mastermodel->master_get('tbl_states',"state_id IN ('".$user_data[$user_field[$a]]."')");

									foreach($old_state as $val){
										$old_stateName[] = $val['state_name'];
										//$old_value = $val['state_name'];
									}
									$old_value = implode(',', $old_stateName);

									$new_state = $this->mastermodel->master_get('tbl_states',"state_id IN ('".$formdata[$user_field[$a]]."')");
									
									foreach($new_state as $val){
										$new_stateName[] = $val['state_name'];	
									}
									$new_value = implode(',', $new_stateName);

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "business_channel"){
									$old_value = $old_value; 
									$new_value = implode(',', $new_value);

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "role_id"){
									$old_value = $old_value; 
									$new_value = $new_value;

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "subrole_id"){
									$old_value = $old_value; 
									$new_value = $new_value;

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "status"){
									$old_value = $old_value; 
									$new_value = $new_value;

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "agent_campaign_id"){
									$old_value = $old_value; 
									$new_value = $new_value;

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "inbound_call"){
									$old_value = $old_value; 
									$new_value = $new_value;

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "outbound_call"){
									$old_value = $old_value; 
									$new_value = $new_value;

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "mer_type_id"){
									$old_MerName = $new_MerName = [];
									
									if(isset($user_data[$existKey]) && $user_data[$existKey] !=''){
										$old_merId = $this->mastermodel->master_get('mer_types','mer_id IN ('.$user_data[$existKey].')','mer_type');
									}else{
										$old_merId = '';
									}
									
									//print_r($old_merId);exit;
									foreach($old_merId as $val){
										$old_MerName[] = $val['mer_type'];
									}
									$old_value = implode(',', $old_MerName);

									$new_merId = $this->mastermodel->master_get('mer_types','mer_id IN ('.$data['mer_type_id'].')','mer_type');										

									foreach($new_merId as $val){
										$new_MerName[] = $val['mer_type'];			
									}
									$new_value = implode(',', $new_MerName);

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "designation"){
									$old_value = $old_value; 
									$new_value = $new_value;

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "department"){
									$old_value = $old_value; 
									$new_value = $new_value;

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "function_area"){
									$old_value = $old_value; 
									$new_value = $new_value;

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "worklocation"){
									$old_value = $old_value; 
									$new_value = $new_value;

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "joining_date_time"){
									$old_value = $old_value; 
									$new_value = $new_value;

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
								else if($user_field[$a] == "relieving_date_time"){
									$old_value = $old_value; 
									$new_value = $new_value;

									$updateDRRemark[] = $user_field_name[$a]." changed From ".$old_value." To ".$new_value;
								}
							}
						}
					}
				}
				//print_r($updateDRRemark);exit;
				if(!empty($updateDRRemark) && count($updateDRRemark)>0){
					
					$userPRemark['user_remark'] = implode(' | ', $updateDRRemark);
					$userPRemark['user_id'] = $formdata['user_id'];
					$userPRemark['created_at'] = date('Y-m-d H:i:s');
					$userPRemark['created_by'] = $this->session->userdata('user_id');
											
					$this->mastermodel->master_insert('user_report_remark',$userPRemark);	
				}

				$data['modified_at'] = $date;	
				$REMARKS['Modified at'] = $date;			
				$data['modified_by'] = $this->session->userdata('user_id');	
				$REMARKS['modified_by'] = $data['modified_by'];
				
				$data['fpbx_caller_id'] = $formdata['fpbx_caller_id'];			
				$REMARKS['FPBX Caller ID'] = $formdata['fpbx_caller_id'];	
				
				$result = $this->user_model->updateRecord('user', $data, 'user_id', $formdata['user_id']);
				$user_id =$formdata['user_id'];

				$passwordhistorydata['change_password'] = $md5_generated_password;
				$passwordhistorydata['user_id'] = $formdata['user_id'];
				$passwordhistorydata['created_at'] = $date;
				$passwordhistorydata['created_by'] = $this->session->userdata('user_id');

				$passwordHistory = $this->mastermodel->master_insert('password_history',$passwordhistorydata);

				$response = array('success'=>'1','msg'=>'Record Inserted/Updated Successfully.');
				//echo json_encode(array('success'=>'1','msg'=>'Record Inserted/Updated Successfully.')); exit;
				//echo"<pre>";print_r($result);exit;

			} else{

				
				$data['password'] = $md5_generated_password;
				$email_id = strtolower($formdata['email']);
				$data['email'] = gowelEncrypt($email_id);				
				$data['created_at'] = $date;
				$data['created_by'] = $this->session->userdata('user_id');
				$result = $this->mastermodel->master_insert('user',$data);
				$user_id = $result;
				$passwordhistorydata['change_password'] = $md5_generated_password;
				$passwordhistorydata['user_id'] = $result;
				$passwordhistorydata['created_at'] = $date;
				$passwordhistorydata['created_by'] = $this->session->userdata('user_id');
				$passwordHistory = $this->mastermodel->master_insert('password_history',$passwordhistorydata);

				$caseRemarks=[];
				foreach ($REMARKS as $Ckey => $Cvalue) {
					$caseRemarks[] = "<b>".$Ckey ."</b>: ". $Cvalue;
				}
				//echo"<pre>";print_r($caseRemarks);exit;
				$caseRemarks = implode(' | ',$caseRemarks);
				$case_review['user_remark'] ="<b>New ".$result." Record Inserted/Updated Successfully:</b><br/> ". $caseRemarks;
				$case_review['user_id'] = $result;				
				$case_review['created_at'] = date('Y-m-d H:i:s');
				$case_review['created_by'] = $this->session->userdata('user_id');
				//$case_review['user_remark'] ="Record Inserted/Updated Successfully";
				$caseRemark = $this->mastermodel->master_insert('user_report_remark',$case_review);

				$from_list = array(
					'WX – Bangalore' => 'wel.bangalore@gowelinfotech.com'
				);
				
				$wxcontact_list = array(
		            'WX – Bangalore'=> '9006775999'
		        );	
				
				if($result > 0){
					$link = $from = $to = $subject = $cc = $bcc = '';
					$link = base_url();
					
					switch ($data['user_type']){
						case "SUPERADMIN":
							$result_content = $this->mastermodel->master_get("tbl_emailcontents","mail_Key = 'GEN_USER_REGI'");
							if(is_array($result_content) && count($result_content) > 0){

								$from = $result_content[0]['fromemail'];
								$to = $formdata['email'];
								$cc	= 'ithelpdesk@gmail.com';
								$subject = $result_content[0]['subject'];
								$message = str_replace(array(		
									'{first_name}',
									'{email}',
									'{password}'
								), array(	
									$formdata['name'],
									$formdata['email'],
									$generated_password			
								), $result_content[0]['content']);
							}
						break;
								
						case "ICUSER":
						$result_content = $this->mastermodel->master_get("tbl_emailcontents","mail_Key = 'IC_USER_REGI'");
						$ic_details = $this->mastermodel->master_get("insurance_company","ic_id = ".$data['user_type_id']);
								
						if(is_array($result_content) && count($result_content) > 0 && is_array($ic_details) && count($ic_details) > 0){
							foreach($from_list as $key => $val){
								if( strpos(strtolower($key), strtolower($ic_details[0]['branch_office'])) !== false ) {
									$from = $val;
								break;   
								}else{
									$from = $result_content[0]['fromemail'];
								}
							}
							$to = $formdata['email'];
							$cc	= 'ithelpdesk@gmail.com';
							$subject = $result_content[0]['subject'];
							$message = str_replace(array(
								'{insurance_company_name}',		
								'{ic_username}',
								'{link}',
								'{password}'
							), array(
								$ic_details[0]['name'],
								$formdata['email'],
								$link,
								$generated_password			
							), $result_content[0]['content']);
						}
						break;
						default:
									
						
					}
					
					if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
						sendEMail($from,$to,$cc,$bcc,$subject,$message);
					}
					$response = array('success'=>'1','msg'=>'Record Inserted/Updated Successfully.');
					
				}else{
					$response = array('success'=>'0','msg'=>'Problem in data update.');
					
				}
			}

			echo json_encode($response); exit();

		}else{
			$response = array('success'=>'0','msg'=>'Problem in data update.');
			echo json_encode($response); exit();
		}
	}
	
	public function getSubrole() {
  		$subrole = '';
  		if(isset($_POST['subrole_id']) && $_POST['subrole_id'] !=''){
  			$subrole = $_POST['subrole_id'];
  		}
  		if(isset($_POST['role_id']) && $_POST['role_id'] !=''){
	   		$role_id = $this->input->post('role_id');
	   		$subrole_id = $this->session->userdata('subrole_id');
	   		if($subrole_id !=19){
	   			$result = $this->mastermodel->master_get("subroles",'role_id="'.$role_id.'" AND subrole_id NOT IN (8,19,20)');	
	   		} else{
	   			$result = $this->mastermodel->master_get("subroles",'role_id="'.$role_id.'"');	
	   		}
	   		
	   		//$users = $this->mastermodel->master_get("user",'user_id='.$this->session->userdata('user_id'));
	   		//echo"<pre>";print_r($users);exit;
	   		$option = '';
			$subrole_id = '';
		
			if(array_key_exists('subrole_id',$_REQUEST) && $_POST['subrole_id'] > 0){
				$subrole_id = $_REQUEST['subrole_id'];
			}
		
			if(is_array($result) && count($result) > 0){
				foreach ($result as $subroleKey => $subroleVal) {
					$sel = ($subrole == $subroleVal['subrole_id']) ? 'selected="selected"' : '';
					$option .= '<option value="'.$subroleVal['subrole_id'].'" '.$sel.'>'.$subroleVal['subrole'].'</option>';
				}				
			}
			echo json_encode(array("status"=>"success","option"=>$option));
			exit;
		}
  	}

	public function getAllDCNameList()
  	{
  		$this->load->model('user_model');  
  		//print_r($_POST);exit;	
  		$option = "<option value=''>--Select DC Name--</option>";
  		$stateids = [];
  		$state ="";
   		if($_POST['stateData'] !=''){
   			
   			if(in_array('All', $_POST['stateData']) || $_POST['stateData'] == 'All'){
   				$state_id=$this->mastermodel->master_get('tbl_states',' 1=1','state_id');
				foreach ($state_id as $stateKey => $stateVal) {
					$stateids[]= $stateVal['state_id'];
				}
				$state = implode(',', $stateids);
   			}
   			else{
   				$state = implode(',', $_POST['stateData']);
   			}
   			//echo $state; exit();
   			
   			$dcNameList = $this->user_model->getAllDCSNameList($state);
	   		foreach($dcNameList as $dcKey => $dcVal){
	   			$option .= "<option value='".$dcVal['dc_id']."'>".$dcVal['center_name']."</option>";
	   		}
   		}  		
   		echo $option;  		
  	}

  	public function getUserRoles(){
  		$options = '';
  		if(isset($_POST) && $_POST['profileT']){
  			$profiletype = $this->input->post('profileT');
	  		if(isset($profiletype) && $profiletype !=''){
	  			$surolesL = $this->mastermodel->getTableRecords('subroles',"subrole_id,subrole","role_id=".$profiletype,"");
	  			$options = '<option value="">Select</option>';
		  		if(!empty($surolesL) && $surolesL !=false){
		  			foreach ($surolesL as $SRkey => $SRvalue) {
		  				$options .= '<option value="'.$SRvalue['subrole_id'].'">'.$SRvalue['subrole'].'</option>';
		  			}
		  		}
	  		}
	  		 
  		}else{
  			$options .='<option value="">Select Roles</option>';
  		}
  		echo json_encode(array("status"=>"success","option"=>$options));
  		//echo $options;  		 
  	}
	public function getUserList(){
  		$role_id = $this->input->post('role_id');
  		$subrolesid = $this->input->post('subrolesid');
  		$surolesL   = $this->mastermodel->getTableRecords('user',"user_id,name","role_id=".$role_id." AND subrole_id=".$subrolesid,"");
  		$options    = '<option value="">Select</option>';
  		if(!empty($surolesL) && $surolesL !=false){
  			foreach ($surolesL as $SRkey => $SRvalue) {
  				$options .='<option value="'.$SRvalue['user_id'].'">'.$SRvalue['name'].'</option>';
  			}
  		}
  		echo json_encode(array("status"=>"success","option"=>$options));
  		//echo $options;  
  	}
   

  	public function getSubPermission(){

  		$user_id = $this->input->post('user_id');
  		$permissions = $this->mastermodel->getTableRecords("permissions","permission_id,permission","status='Active'");
		$subpermissions = $this->mastermodel->getTableRecords("subpermissions","subpermissions_id,permission_id,subpermission","status='Active'");
		$userpermissions = $this->mastermodel->getTableRecords("role_user","user_id,permission_id,subpermissions_id","user_id=".$user_id,"");		
		$permission_id=[];
		$subpermissions_id=[];
		if(!empty($userpermissions) && $userpermissions !=false){
		foreach ($userpermissions as $subperkey => $subpervalue) {
			$subpermissions_id[] = $subpervalue['subpermissions_id'];
			$permission_id[] 	 = $subpervalue['permission_id'];
		}
		$subpermissions_id = $subpermissions_id;
		$permission_id = array_unique($permission_id);
	} else{
		$subpermissions_id = [];
		$permission_id = [];
	}

		$perm ='';
  		if(is_array($permissions) && count($permissions) > 0){ 
			foreach($permissions as $prkey => $prval){
			
		$perm .='<h4 style="width: 100%; float: left;border-bottom: 1px dotted #e2dcdc">';
			if(in_array($prval['permission_id'], $permission_id)) { $selc="checked"; } else{$selc="";} 
		$perm .= '<input type="checkbox" value="'.$prval['permission_id'].'" name="permission_id['.$prval['permission_id'].']" '.$selc.' />'.$prval['permission'];
		$perm .='</h4><ul style="list-style: none;float: left;">';

				if(is_array($subpermissions) && count($subpermissions) > 0){
					foreach ($subpermissions as $subprkey => $subprvalue) {
						if($prval['permission_id'] == $subprvalue['permission_id']){							
							$perm .= '<li style="float:left; width:20em;">';
							if(in_array($subprvalue["subpermissions_id"], $subpermissions_id)){
								$perm .=  '<input type="checkbox" name="subpermissions_id['.$prval["permission_id"].'][]" value="'.$subprvalue["subpermissions_id"].'" checked="checked">';
							} else{
								$perm .= '<input type="checkbox" name="subpermissions_id['.$prval["permission_id"].'][]" value="'.$subprvalue["subpermissions_id"].'" >';
							}
							$perm .= $subprvalue["subpermission"].'</li>';

						}
					}					
				} 
			
			$perm .= '</ul><br/>';
		} 
	}
	echo $perm;
  	}

  	public function usersPermission(){

  		if($this->privilegeduser->hasPrivilege("usersPermission") || $this->userprivileged->hasUserPrivilege("usersPermission")){
			$user_id = $this->session->userdata('user_id');
			//$result['usertype'] = ['SUPERADMIN','ICUSER','ICAGENT','DCUSER','DCAGENT'];
			$result['subroles'] = $this->mastermodel->getTableRecords("subroles","subrole_id,role_id,subrole","1=1");
			$result['roles'] = $this->mastermodel->getTableRecords("roles","role_id,name","1=1");
			$result['permissions'] = $this->mastermodel->getTableRecords("permissions","permission_id,permission","status='Active'");
			$result['subpermissions'] = $this->mastermodel->getTableRecords("subpermissions","subpermissions_id,permission_id,subpermission","status='Active'");
			$userpermissions = $this->mastermodel->getTableRecords("role_user","user_id,permission_id,subpermissions_id","user_id=".$user_id,"");
			//echo "<pre>"; print_r($result['userpermissions']); exit();		
			$permission_id=[];
			$subpermissions_id=[];
			if(!empty($userpermissions) && $userpermissions!=false){

				foreach ($userpermissions as $subperkey => $subpervalue) {
					$subpermissions_id[] = $subpervalue['subpermissions_id'];
					$permission_id[] 	 = $subpervalue['permission_id'];
				}

				$result['subpermissions_id'] = $subpermissions_id;
				$result['permission_id'] = array_unique($permission_id);
			
			} else{
				$result['subpermissions_id'] = [];
				$result['permission_id'] = [];	
			}

			$this->load->view('template/header.php');
			$this->load->view('user/users-permission', $result);
			$this->load->view('template/footer.php');

		} else{
			redirect("404_override", 'refresh');
		}
	}
	 
	public function userPermissionData(){	 	
	 	parse_str($_POST['formdata'], $formdata);
		//echo"<pre>";print_r($formdata); exit();
	 	if(!empty($formdata) && $formdata !=''){
	 		$user_id = $formdata['users_id'];
		 	if(array_key_exists('subpermissions_id', $formdata)){
		 		$subpermissions = $formdata['subpermissions_id'];
		 	} else{
		 		$subpermissions =[];
		 	}

		 	if(!empty($user_id) && $user_id >0){
		 		$data['user_id'] = $user_id;
		 		$deleteRecord = $this->user_model->getDeleteRecord($user_id);
		 		if($deleteRecord >0 && !empty($subpermissions)){
		 			foreach ($subpermissions as $permissions => $subpermission) {
				 		$data['permission_id'] = $permissions;
				 		foreach ($subpermission as $buspkey => $subPvalue) {
				 			$data['subpermissions_id'] = $subPvalue;
				 			$this->user_model->insertNewPermissionRecord($data);
				 		}
				 	}
				 	echo json_encode(array("status"=>"success","msg"=>'Successfully Inserted/Updated Record...'));exit;
		 		} else{
		 			echo json_encode(array("status"=>"success","msg"=>'Successfully Inserted/Updated Record...'));exit;
		 		}
		 		
		 	}
	 	}else{
	 		echo json_encode(array("status"=>"success","msg"=>'Something went wrong...'));exit;
	 	}
	 	
	}

	public function checkAccountStatus(){

		$user_id = $this->session->userdata('user_id');
		$Logstatu = "OK";
		if($user_id !="" && $user_id>0){
			$accSts = $this->mastermodel->getTableRecords('user',"status,incorrect_try","user_id=$user_id");
			if(!empty($accSts) && $accSts !=false){
				
				$status = $accSts[0]['status'];
				$incorrect_try = $accSts[0]['incorrect_try'];

				if($status=='Rejected' || $status=='Pending'){
					session_destroy();
					$Logstatu = "deactivated";
				} else if($incorrect_try>3){
					session_destroy();
					$Logstatu = "deactivated";
				} else{
					$Logstatu = "OK";
				}
			} else{
				session_destroy();
				$Logstatu = "deactivated";
			}
		
		} else{
			//session_destroy();
			$Logstatu = "sessionexpired";			
		}
		echo json_encode(array('status'=>$Logstatu)) ;
	}

	public function addDoctorView_old(){
		$data['role'] = $this->mastermodel->master_get("roles",'role_id IN (1,2,3)');
		$data['state'] = $this->mastermodel->master_get("tbl_states",'1=1');
		/*$data['doc_language'] = $this->mastermodel->master_get("tbl_language",'is_deleted="No"');*/
		$data['doc_quali'] = $this->mastermodel->master_get("doctor_qualification",'is_deleted="No"','edu_id,qualification');		
		$data['reporting_person'] = $this->mastermodel->getTableRecords('user u JOIN subroles sr ON u.subrole_id=sr.subrole_id',"user_id,name,subrole","u.subrole_id IN (27) AND u.status='Approved'");

		$data['header'] = 'Add New User | Eswasthalya App';
		$this->load->view('template/header', $data);
		$this->load->view('user/add-Doctor');
		$this->load->view('template/footer');
	}

	public function getCities(){
		//echo"<pre>";print_r($_POST);exit;
		$this->load->model('Mastermodel');
		$state_id = $this->input->post('stateID');
		if(isset($state_id) && $state_id !=''){
			$result = $this->Mastermodel->master_get("tbl_cities",'state_id='.$state_id);
			if(!empty($result) && $result != false){
				$option = '<option value="">--Select--</option>';
				foreach ($result as $key => $value) {
					$option .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
				}
			}
			echo $option;
		}
		
  	}

	public function addDoctor(){
		//echo"<pre>";print_r($_POST);print_r($_FILES);exit;
		$this->load->helper('email_configure');
		$formDrAdd = $this->input->post();

		$targetPath = '/assets/doctorFiles/';
		$uploadLocation = FILE_PATH.$targetPath;

		if(isset($formDrAdd['lpassword']) && $formDrAdd['lpassword'] !=""){
			$generated_password = $formDrAdd['lpassword'];
			$md5_generated_password = md5($generated_password);
			
		} else{
			$generated_password = '123456';//mt_rand(10000,100000);
        	$md5_generated_password = md5($generated_password);
		}		
        
        $role = $this->mastermodel->master_get('roles','role_id ="'.$formDrAdd['role_id'].'"','name');
        $icRemark['Role Name'] = $role[0]['name'];

        $subroleE = $this->mastermodel->master_get('subroles','subrole_id ="'.$formDrAdd['subrole_id'].'"','subrole');
        $icRemark['Sub Role'] = $subroleE[0]['subrole'];

        $icRemark['Status'] = $formDrAdd['status'];
        $icRemark['Dr Name'] = $formDrAdd['doc_name'];
        $icRemark['Email'] = $formDrAdd['email'];
        $icRemark['Dr Contact'] = $formDrAdd['doc_contact'];

        $icRemark['Dr Regn No'] = $formDrAdd['doc_regn_no'];
        $icRemark['Dr Address'] = $formDrAdd['doc_address'];
        $icRemark['Dr Area'] = $formDrAdd['doc_area'];
        
        $stateN = $this->mastermodel->master_get('tbl_states','state_id ="'.$formDrAdd['state'].'"','state_name');
        $icRemark['State Name'] = $stateN[0]['state_name'];
        
        $cityY = $this->mastermodel->master_get('tbl_cities','id ="'.$formDrAdd['doc_city'].'"','name');
        $icRemark['City Name'] = $cityY[0]['name'];

        if(isset($_POST['ic_id']) && $_POST['ic_id'] !=''){
       		$ic_id = implode(',', $_POST['ic_id']);
       		$icListT = [];
       		$icList = $this->mastermodel->master_get('insurance_company','ic_id IN ('.$ic_id.')','name');
       		foreach ($icList as $key => $value) {
       			$icListT[] = $value['name'];
       		}
       		$icRemark['IC Name'] = implode(',', $icListT);
        }

        if(isset($_POST['dr_url']) && $_POST['dr_url'] !=''){
        	$dr_url = $_POST['dr_url'];
       		$icRemark['Doctor URL'] = $dr_url;
        }

        if(isset($_POST['customer_url']) && $_POST['customer_url'] !=''){
        	$customer_url = $_POST['customer_url'];
       		$icRemark['Customer URL'] = $customer_url;
        }

        if(!empty($_POST['doc_type']) && $_POST['doc_type'] !=''){
       		$doc_type = implode(',', $_POST['doc_type']);
       		$icRemark['Dr Priority Type1'] = $doc_type;
        }

        if(!empty($_POST['alt_contact']) && $_POST['alt_contact'] !=''){
       		$altContact = gowelEncrypt($_POST['alt_contact']);
       		$icRemark['Dr Alter Mobile No'] = $altContact;
        }else{
        	$altContact = '';
        }

        if(!empty($_POST['doc_type_priority2']) && $_POST['doc_type_priority2'] !=''){
       		$doc_type_priority2 = implode(',', $_POST['doc_type_priority2']);
       		$icRemark['Dr Priority Type2'] = $doc_type_priority2;
        }else{
        	$doc_type_priority2 = '';
        }

        if(!empty($_POST['dr_type']) && $_POST['dr_type'][0] !=''){
        	
        	$doc_type1 = implode("','", $_POST['dr_type']);
        	$doc_type2 = implode("','", $_POST['dr_type_priority2']);

        	$docMER = $doc_type1."','".$doc_type2; 
        	$mer_type_id = [];
        	$mer_typeids = $this->mastermodel->getTableRecords('mer_types',"mer_id,mer_type,status,mer_for","status='Active' AND mer_type IN ('".$docMER."')");
        	//echo $this->db->last_query(); exit();
        	if (!empty($mer_typeids) && $mer_typeids !=false) {
        		foreach($mer_typeids as $mer_type=>$merId){
        			$mer_type_id[] = $merId['mer_id'];
        		}
        	}
			$drmer_type = implode(',', $mer_type_id);
		
		} else{
			$drmer_type ='1,3';
		}



        if(!empty($_POST['doc_lang']) && $_POST['doc_lang'] !=''){
        	$doc_lang = implode(',', $_POST['doc_lang']);        	

	        $langID = $this->mastermodel->master_get('tbl_language','lang_id IN ('.$doc_lang.')','lang_name');
	        foreach ($langID as $key => $value) {
	        	$langName[] = $value['lang_name'];
	        }
	        $langG = implode(',', $langName);
	        $icRemark['Lang Name'] = $langG;
        }

        if(!empty($_POST['doc_qualification']) && $_POST['doc_qualification'] !=''){
        	$dcoQualification = implode(',', $_POST['doc_qualification']);        	

	        $eduID = $this->mastermodel->master_get('doctor_qualification','edu_id IN ('.$dcoQualification.')','qualification');
	        foreach ($eduID as $key => $value) {
	        	$qualification[] = $value['qualification'];
	        }
	        $qualificationName = implode(',', $qualification);
	        $icRemark['Qualification'] = $qualificationName;
        }

        if(!empty($_POST['accountNo']) && $_POST['accountNo'] !=''){
        	$accountNo = $_POST['accountNo'];
        	$icRemark['Account No'] = $accountNo;
        }else{
        	$accountNo = '';
        }

        if(!empty($_POST['bankName']) && $_POST['bankName'] !=''){
        	$bankName = $_POST['bankName'];
        	$icRemark['Bank Name'] = $bankName;
        }else{
        	$bankName = '';
        }

        if(!empty($_POST['acccountHolderName']) && $_POST['acccountHolderName'] !=''){
        	$acccountHolderName = $_POST['acccountHolderName'];
        	$icRemark['Account Holder Namw'] = $acccountHolderName;
        }else{
        	$acccountHolderName = '';
        }

        if(!empty($_POST['bankBranch']) && $_POST['bankBranch'] !=''){
        	$bankBranch = $_POST['bankBranch'];
        	$icRemark['Bank Branch Name'] = $bankBranch;
        }else{
        	$bankBranch = '';
        }

        if(!empty($_POST['IFSCCode']) && $_POST['IFSCCode'] !=''){
        	$IFSCCode = $_POST['IFSCCode'];
        	$icRemark['IFSC Code'] = $IFSCCode;
        }else{
        	$IFSCCode = '';
        }

        if(!empty($_POST['teleRate']) && $_POST['teleRate'] !=''){
        	$teleRate = $_POST['teleRate'];
        	$icRemark['Tele Rate'] = $teleRate;
        }else{
        	$teleRate = '';
        }

        if(!empty($_POST['videoRate']) && $_POST['videoRate'] !=''){
        	$videoRate = $_POST['videoRate'];
        	$icRemark['Video Rate'] = $videoRate;
        }else{
        	$videoRate = '';
        }

        if(!empty($_POST['drPanCard']) && $_POST['drPanCard'] !=''){
        	$drPanCard = $_POST['drPanCard'];
        	$icRemark['Pan Card'] = $drPanCard;
        }else{
        	$drPanCard = '';
        }
        $icRemark['Dr Remark'] = $formDrAdd['doc_remark'];
        //echo"<pre>";print_r($icRemark);exit;
        if(!empty($_FILES) && isset($_FILES['doc_digi_sign']['name']) && $_FILES['doc_digi_sign']['name'] !=''){
        	$imgName = str_replace(" ","",$_FILES['doc_digi_sign']['name']);
			$imgTmpName = $_FILES['doc_digi_sign']['tmp_name'];
			$imgSize = $_FILES['doc_digi_sign']['size'];
			$imgType = $_FILES['doc_digi_sign']['type'];

			$allowed_extensions = array("image/jpg","image/jpeg","image/png");
			if(!in_array($imgType,$allowed_extensions)){
				echo "<script>alert('Invalid format.Please Upload Only jpg | jpeg | png format allowed');</script>";exit;
			}else{
				$newFileName = date('d-m-Y').'_'.time().'_'.$imgName;
				$uploadedTo = $uploadLocation.$newFileName;
				if(!file_exists($uploadedTo)){
					$moveFile = move_uploaded_file($imgTmpName, $uploadedTo);
					if($moveFile == true ){
						$docDigi = $newFileName;
					}
				}else{
					echo "<script>alert('File Already Exist...Rename file and retry');</script>";exit;
				}
			}
        }else{
        	echo "<script>alert('Select Doctor Digital Signature');</script>";exit;
        }

        if(!empty($_FILES) && isset($_FILES['doc_profile_pic']['name']) && $_FILES['doc_profile_pic']['name'] !=''){
        	$imgName2 = str_replace(" ","",$_FILES['doc_profile_pic']['name']);
			$imgTmpName2 = $_FILES['doc_profile_pic']['tmp_name'];
			$imgSize = $_FILES['doc_profile_pic']['size'];
			$imgType = $_FILES['doc_profile_pic']['type'];

			$allowed_extensions2 = array("image/jpg","image/jpeg","image/png");
			if(!in_array($imgType,$allowed_extensions2)){
				echo "<script>alert('Invalid format.Please Upload Only jpg | jpeg | png format allowed');</script>";exit;
			}else{
				$newFileName2 = date('d-m-Y').'_'.time().'_'.$imgName2;
				$uploadedTo2 = $uploadLocation.$newFileName2;
				if(!file_exists($uploadedTo2)){
					$moveFilePro = move_uploaded_file($imgTmpName2, $uploadedTo2);
					if($moveFilePro == true ){
						$docProfile = $newFileName2;
					}
				}else{
					echo "<script>alert('File Already Exist...Rename file and retry');</script>";exit;
				}				
			}
        }else{
        	echo "<script>alert('Select Doctor Profile Pic');</script>";exit;
        }

        if(isset($_FILES['drPanCardCert']['name']) && $_FILES['drPanCardCert']['name'] !=''){
        	$imgName2 = str_replace(" ","",$_FILES['drPanCardCert']['name']);
			$imgTmpName2 = $_FILES['drPanCardCert']['tmp_name'];
			$imgSize = $_FILES['drPanCardCert']['size'];
			$imgType = $_FILES['drPanCardCert']['type'];

			$allowed_extensions_pan = array("image/jpg","image/jpeg","image/png","application/pdf");
			if(!in_array($imgType,$allowed_extensions_pan)){
				echo "<script>alert('Invalid format.Please Upload Only jpg | jpeg | png | pdf format allowed');</script>";exit;
			}else{
				$newFileName2 = date('d-m-Y').'_'.time().'_'.$imgName2;
				$uploadedTo2 = $uploadLocation.$newFileName2;
				if(!file_exists($uploadedTo2)){
					$moveFilePro = move_uploaded_file($imgTmpName2, $uploadedTo2);
					if($moveFilePro == true ){
						$drPanCardCertificate = $newFileName2;
					}
				}else{
					echo "<script>alert('File Already Exist...');</script>";exit;
				}								
			}
        }else{
        	$drPanCardCertificate = '';
        }

        if(isset($_FILES['drCancelledCheque']['name']) && $_FILES['drCancelledCheque']['name'] !=''){
        	$imgName2 = $_FILES['drCancelledCheque']['name'];
			$imgTmpName2 = $_FILES['drCancelledCheque']['tmp_name'];
			$imgSize = $_FILES['drCancelledCheque']['size'];
			$imgType = $_FILES['drCancelledCheque']['type'];

			$allowed_extensions_cheque = array("image/jpg","image/jpeg","image/png","application/pdf");
			if(!in_array($imgType,$allowed_extensions_cheque)){
				echo "<script>alert('Invalid format.Please Upload Only jpg | jpeg | png | pdf format allowed');</script>";exit;
			}else{
				$newFileName2 = date('d-m-Y').'_'.time().'_'.$imgName2;
				$uploadedTo2 = $uploadLocation.$newFileName2;
				if(!file_exists($uploadedTo2)){
					$moveFilePro = move_uploaded_file($imgTmpName2, $uploadedTo2);
					if($moveFilePro == true ){
						$drCancelledChequed = $newFileName2;
					}
				}else{
					echo "<script>alert('File Already Exist...');</script>";exit;
				}								
			}
        }else{
        	$drCancelledChequed = '';
        }

        if(isset($_FILES['drRegnCertificate']['name']) && $_FILES['drRegnCertificate']['name'] !=''){
        	$imgName2 = $_FILES['drRegnCertificate']['name'];
			$imgTmpName2 = $_FILES['drRegnCertificate']['tmp_name'];
			$imgSize = $_FILES['drRegnCertificate']['size'];
			$imgType = $_FILES['drRegnCertificate']['type'];

			$allowed_extensions_regnCert = array("image/jpg","image/jpeg","image/png","application/pdf");
			if(!in_array($imgType,$allowed_extensions_regnCert)){
				echo "<script>alert('Invalid format.Please Upload Only jpg | jpeg | png | pdf format allowed');</script>";exit;
			}else{
				$newFileName2 = date('d-m-Y').'_'.time().'_'.$imgName2;
				$uploadedTo2 = $uploadLocation.$newFileName2;
				if(!file_exists($uploadedTo2)){
					$moveFilePro = move_uploaded_file($imgTmpName2, $uploadedTo2);
					if($moveFilePro == true ){
						$drRegnCert = $newFileName2;
					}
				}else{
					echo "<script>alert('File Already Exist...');</script>";exit;
				}								
			}
        }else{
        	$drRegnCert = '';
        }

        if(isset($_FILES['drKYCRegistration']['name']) && $_FILES['drKYCRegistration']['name'] !=''){
        	$imgName2 = $_FILES['drKYCRegistration']['name'];
			$imgTmpName2 = $_FILES['drKYCRegistration']['tmp_name'];
			$imgSize = $_FILES['drKYCRegistration']['size'];
			$imgType = $_FILES['drKYCRegistration']['type'];

			$allowed_extensions_regnCert = array("image/jpg","image/jpeg","image/png","application/pdf");
			if(!in_array($imgType,$allowed_extensions_regnCert)){
				echo "<script>alert('Invalid format.Please Upload Only jpg | jpeg | png | pdf format allowed');</script>";exit;
			}else{
				$newFileName2 = date('d-m-Y').'_'.time().'_'.$imgName2;
				$uploadedTo2 = $uploadLocation.$newFileName2;
				if(!file_exists($uploadedTo2)){
					$moveFilePro = move_uploaded_file($imgTmpName2, $uploadedTo2);
					if($moveFilePro == true ){
						$drKYCRegn = $newFileName2;
					}
				}else{
					echo "<script>alert('File Already Exist...');</script>";exit;
				}								
			}
        }else{
        	$drKYCRegn = '';
        }

        if(isset($_FILES['drBankDeclaration']['name']) && $_FILES['drBankDeclaration']['name'] !=''){
        	$imgName2 = $_FILES['drBankDeclaration']['name'];
			$imgTmpName2 = $_FILES['drBankDeclaration']['tmp_name'];
			$imgSize = $_FILES['drBankDeclaration']['size'];
			$imgType = $_FILES['drBankDeclaration']['type'];

			$allowed_extensions_regnCert = array("image/jpg","image/jpeg","image/png","application/pdf");
			if(!in_array($imgType,$allowed_extensions_regnCert)){
				echo "<script>alert('Invalid format.Please Upload Only jpg | jpeg | png | pdf format allowed');</script>";exit;
			}else{
				$newFileName2 = date('d-m-Y').'_'.time().'_'.$imgName2;
				$uploadedTo2 = $uploadLocation.$newFileName2;
				if(!file_exists($uploadedTo2)){
					$moveFilePro = move_uploaded_file($imgTmpName2, $uploadedTo2);
					if($moveFilePro == true ){
						$drBankDecla = $newFileName2;
					}
				}else{
					echo "<script>alert('File Already Exist...');</script>";exit;
				}								
			}
        }else{
        	$drBankDecla = '';
        }

        if(isset($_FILES['drPANDeclaration']['name']) && $_FILES['drPANDeclaration']['name'] !=''){
        	$imgName2 = $_FILES['drPANDeclaration']['name'];
			$imgTmpName2 = $_FILES['drPANDeclaration']['tmp_name'];
			$imgSize = $_FILES['drPANDeclaration']['size'];
			$imgType = $_FILES['drPANDeclaration']['type'];

			$allowed_extensions_regnCert = array("image/jpg","image/jpeg","image/png","application/pdf");
			if(!in_array($imgType,$allowed_extensions_regnCert)){
				echo "<script>alert('Invalid format.Please Upload Only jpg | jpeg | png | pdf format allowed');</script>";exit;
			}else{
				$newFileName2 = date('d-m-Y').'_'.time().'_'.$imgName2;
				$uploadedTo2 = $uploadLocation.$newFileName2;
				if(!file_exists($uploadedTo2)){
					$moveFilePro = move_uploaded_file($imgTmpName2, $uploadedTo2);
					if($moveFilePro == true ){
						$drPanDecla = $newFileName2;
					}
				}else{
					echo "<script>alert('File Already Exist...');</script>";exit;
				}								
			}
        }else{
        	$drPanDecla = '';
        }
        
        //print_r($docDigi['doc_digi_sign']);print_r($docProfile['doc_profile_pic']);exit;
		if(isset($_POST) && $_POST !=''){
			$doctorProfile = array(
				"dr_name" => $_POST['doc_name'],
				"dr_qualification" => $dcoQualification,
				"edu_id" => $dcoQualification,
				"dr_regn_no" => $_POST['doc_regn_no'],
				"dr_pan_no" => gowelEncrypt($drPanCard),
				"dr_email" => gowelEncrypt($_POST['email']),
				"dr_contact" => gowelEncrypt($_POST['doc_contact']),
				"dr_alt_contact" => $altContact,
				"dr_area" => $_POST['doc_area'],
				"dr_address" => $_POST['doc_address'],
				"dr_city" => $_POST['doc_city'],
				"dr_state" => $_POST['state'],
				"dr_lang" => $doc_lang,
				"dr_type" => $doc_type,
				"dr_type_priority2" => $doc_type_priority2,
				"dr_profile_pic" => $docProfile,
				"dr_digital_signature" => $docDigi,
				"dr_regn_cert" => $drRegnCert,
				"dr_cancelled_cheque" => $drCancelledChequed,
				"dr_pan_card_cert" => $drPanCardCertificate,
				"dr_kyc_regn" => $drKYCRegn,
				"dr_bank_declaration" => $drBankDecla,
				"dr_pan_declaration" => $drPanDecla,
				"dr_account_no"=>$accountNo,
				"dr_bank_name"=>$bankName,
				"dr_acccount_holder_name"=>$acccountHolderName,
				"dr_bank_branch"=>$bankBranch,
				"dr_ifsc_code"=>$IFSCCode,
				"dr_tele_rate"=>$teleRate,
				"dr_video_rate"=>$videoRate,
				"status" => 'Active',
				"created_at" => date('Y-m-d H:i:s'),
				"fpbx_caller_id"=>$_POST['fpbx_caller_id'],
				"created_by" => $this->session->userdata('user_id')
			);
			$doctorInsertedProfile = $this->user_model->insertDoctorRecord('doctor_profile',$doctorProfile);


			if($doctorInsertedProfile > 0){

				$doctorUserT = array(
					"user_type_id" => $doctorInsertedProfile,
					"user_type" => "DOCTOR",
					"parent_id" => $_POST['parent_id'],
					"dc_parent_id" => 0,
					"address" => $_POST['doc_address'],
					"branch" => 0,
					"wel_branch_id" => 0,
					"name" => $_POST['doc_name'],
					"email" => gowelEncrypt($_POST['email']),
					"contact" => gowelEncrypt($_POST['doc_contact']),
					"ic_id" => $ic_id,
					"state_id" => $_POST['state'],
					"business_channel" => 0,
					"role_id" => $_POST['role_id'],
					"subrole_id" => $_POST['subrole_id'],
					"password" => $md5_generated_password,
					"created_at" => date('Y-m-d H:i:s'),
					"created_by" => $this->session->userdata('user_id'),
					"status" => $_POST['status'],
					"mer_type_id" =>$drmer_type,
					"logged_in" => 0,
					"incorrect_try" => 0,
					"ip_address" => $_SERVER['REMOTE_ADDR'],
					"fpbx_caller_id"=>$_POST['fpbx_caller_id'],
				);
				$doctorUserInserted = $this->user_model->insertDoctorRecord('user',$doctorUserT);
				
				if(isset($_POST['video_url']) && $_POST['video_url'] !=''){
					$videoUrl = array(
						'dr_id' => $doctorInsertedProfile,
						'dr_url' => $dr_url,
						'customer_url' => $customer_url,
						'room_id' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('user_id')
					);
					
					$this->user_model->insertDoctorRecord('doctor_video_url',$videoUrl);
				}

				if($doctorUserInserted > 0){

					$drRemarks=[];
					foreach ($icRemark as $Ckey => $Cvalue) {
						$drRemarks[] = "<b>".$Ckey ."</b>: ". $Cvalue;
					}
					$drRemarks = implode(' | ',$drRemarks);
					//print_r($drRemarks);exit;
					$dr_review['dr_id'] = $doctorInsertedProfile;
					$dr_review['dr_remark'] ="<b>New Doctor Registered with details:</b><br/> ". $drRemarks;
					$dr_review['created_at'] = date('Y-m-d H:i:s');
					$dr_review['created_by'] = $this->session->userdata('user_id');
					$this->mastermodel->master_insert('doctor_remark',$dr_review);

					$link = '';
					//$link = 'https://insurance.gmail.com/files/welnexplus.apk';
					$result_content = $this->mastermodel->master_get("tbl_emailcontents","mail_Key='DR_USER_REGI'");
					$from = $result_content[0]['fromemail'];
					$to = $_POST['email'];
					$cc	= 'ithelpdesk@gmail.com';
					$bcc = '';
					$subject = $result_content[0]['subject'];
					$message = str_replace(array(		
						'{doc_name}',
						'{link}',
						'{doc_username}',
						'{doc_password}'
					), array(	
						$_POST['doc_name'],
						$link,
						$_POST['email'],
						$generated_password
					), $result_content[0]['content']);

					if(!empty($from) && !empty($to) && !empty($subject) && !empty($message)){
						sendEMail($from,$to,$cc,$bcc,$subject,$message);
					}


					//Link to download APP https://insurance.gmail.com/files/welnexplus.apk
					$sms_content_dr = 'Dear Doctor welcome to Medical App Solutions! You have been successfully registered. Please find below your Login Credentials :- User Login: '.$_POST['email'].' and User Password: '.$generated_password;

					//trigger_sms2($_POST['doc_contact'], $sms_content_dr);
					
					redirect(URL.'user-list','refresh');
				}				
			}			
		}else{
			echo "<script>alert('Please provide input field data...');</script>";exit;
		}
	}

	public function editDoctorView(){
		$key_id = $_REQUEST['text'];
		$convertKey = base64_decode(strtr($key_id, '-_', '+/'));
		$explodeUserID = explode('=', $convertKey);
		$user_id = $explodeUserID[1];
		//print_r($user_id);exit;
		if(is_numeric($user_id) && $user_id > 0){
			if($this->privilegeduser->hasPrivilege("editDoctor") || $this->userprivileged->hasUserPrivilege("editDoctor")){
				
				$data['users'] = $this->mastermodel->master_get("user",'user_type = "DOCTOR" AND user_id='.$user_id);
				$data['doctorProfile'] = $this->mastermodel->master_get("doctor_profile",'dr_id='.$data['users'][0]['user_type_id']);
				$dr_id = $data['doctorProfile'][0]['dr_id'];
				$drstate = $data['doctorProfile'][0]['dr_state'];
				$data['drCity'] = $this->mastermodel->master_get("tbl_cities",'state_id IN ('.$data['doctorProfile'][0]['dr_state'].')');
				
			   	$data['role'] = $this->mastermodel->master_get("roles",'role_id IN (1,2,3)');
				$data['state'] = $this->mastermodel->master_get("tbl_states",'1=1');
				$data['branch'] = $this->mastermodel->master_get("branch");
				$data['ic'] = $this->mastermodel->master_get("insurance_company",'is_deleted="No"');
				$data['doc_language'] = $this->mastermodel->master_get("tbl_language",'is_deleted="No"');
				$data['doc_quali'] = $this->mastermodel->master_get("doctor_qualification",'is_deleted="No"','edu_id,qualification');

				$data['doc_url'] = $this->mastermodel->master_get("doctor_video_url",'dr_id='.$dr_id,'dr_id,video_url,customer_video_url,video_url2,customer_video_url2');

				$data['reporting_person'] = $this->mastermodel->getTableRecords('user u JOIN subroles sr ON u.subrole_id=sr.subrole_id',"user_id,name,subrole","u.subrole_id IN (27) AND u.status='Approved'");
				//echo"<pre>";print_r($data['doc_url']);exit;
				$data['header'] = 'Edit Doctor User | Medical App';
				$this->load->view('template/header', $data);
				$this->load->view('editDoctor');
				$this->load->view('template/footer');
			}else{
				redirect('home', 'refresh'); exit();
			}
		}else{
			redirect('404_override', 'refresh'); exit();
		}
	}

	public function editDoctorSubmit(){

		if($this->session->userdata('user_id') > 0){
			if(array_key_exists('HTTP_X_REQUESTED_WITH',$_SERVER) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
				if($this->privilegeduser->hasPrivilege("editDoctor") || $this->userprivileged->hasUserPrivilege("editDoctor")){
					$formPostData = $this->input->post();
					$updateDRRemark = array();
					$financeRemark = [];
					//echo"<pre>";
					//print_r($formPostData['dr_url']);
					//print_r($_FILES);
					//exit;
					if(!empty($formPostData)){
						$targetPath = '/assets/doctorFiles/';
						$uploadLocation = FILE_PATH.$targetPath;

						$doctorDetails = $this->mastermodel->getTableRecords("doctor_profile dp LEFT JOIN user ud ON ud.user_type_id=dp.dr_id","dp.*,ud.ic_id","ud.user_type='DOCTOR' AND dp.dr_id=".$formPostData['user_type_id']);
						//$doctorDetails = $this->mastermodel->master_get("doctor_profile",'dr_id='.$formPostData['user_type_id']);
				        //echo"<pre>";print_r($doctorDetails);exit;
				        $dr_id = $formPostData['user_type_id'];
				        if(isset($formPostData['doc_remark']) && $formPostData['doc_remark'] !=''){
				        	$updateDRRemark[] = $formPostData['doc_remark'];
				        }
				        
				        if(isset($formPostData['ic_id']) && $formPostData['ic_id'] !=''){
				       		$ic_id = implode(',', $formPostData['ic_id']);
				        }

				        if(!empty($formPostData['dr_type']) && $formPostData['dr_type'] !=''){
				       		$doc_type = implode(',', $formPostData['dr_type']);
				       		$formPostData['dr_type'] = $doc_type;
				        }

				        if(!empty($formPostData['dr_type_priority2']) && $formPostData['dr_type_priority2'] !=''){
				       		$doc_type_priority2 = implode(',', $formPostData['dr_type_priority2']);
				       		$formPostData['dr_type_priority2'] = $doc_type_priority2;
				        }else{
				        	$doc_type_priority2 = "";
				        }

				        if(!empty($_POST['dr_type']) && $_POST['dr_type'][0] !=''){
        	
				        	$doc_type1 = implode("','", $_POST['dr_type']);
				        	$doc_type2 = implode("','", $_POST['dr_type_priority2']);

				        	$docMER = $doc_type1."','".$doc_type2; 
				        	$mer_type_id = [];
				        	$mer_typeids = $this->mastermodel->getTableRecords('mer_types',"mer_id,mer_type,status,mer_for","status='Active' AND mer_type IN ('".$docMER."')");
				        	//echo $this->db->last_query(); exit();
				        	if (!empty($mer_typeids) && $mer_typeids !=false) {
				        		foreach($mer_typeids as $mer_type=>$merId){
				        			$mer_type_id[] = $merId['mer_id'];
				        		}
				        	}
							$drmer_type = implode(',', $mer_type_id); 
						
						} else{
							$drmer_type ='1,3';
						}

				        

						if(!empty($formPostData['dr_lang']) && $formPostData['dr_lang'] !=''){
				        	$doc_lang = implode(',', $formPostData['dr_lang']);
				        	$formPostData['dr_lang'] = $doc_lang;
				        }

				        if(!empty($formPostData['dr_qualification']) && $formPostData['dr_qualification'] !=''){
				        	$dcoQualification = implode(',', $formPostData['dr_qualification']);
				        	$formPostData['dr_qualification'] = $dcoQualification;
				        }else{
				        	$dcoQualification = '';
				        }

				        if(!empty($formPostData['dr_account_no']) && $formPostData['dr_account_no'] !=''){
				        	$accountNo = $formPostData['dr_account_no'];
				        }else{
				        	$accountNo = '';
				        }

				        if(!empty($formPostData['dr_bank_name']) && $formPostData['dr_bank_name'] !=''){
				        	$bankName = $formPostData['dr_bank_name'];
				        }else{
				        	$bankName = '';
				        }

				        if(!empty($formPostData['dr_acccount_holder_name']) && $formPostData['dr_acccount_holder_name'] !=''){
				        	$acccountHolderName = $formPostData['dr_acccount_holder_name'];
				        }else{
				        	$acccountHolderName = '';
				        }

				        if(!empty($formPostData['dr_bank_branch']) && $formPostData['dr_bank_branch'] !=''){
				        	$bankBranch = $formPostData['dr_bank_branch'];
				        }else{
				        	$bankBranch = '';
				        }

				        if(!empty($formPostData['dr_ifsc_code']) && $formPostData['dr_ifsc_code'] !=''){
				        	$IFSCCode = $_POST['dr_ifsc_code'];
				        }else{
				        	$IFSCCode = '';
				        }

				        if(!empty($formPostData['dr_tele_rate']) && $formPostData['dr_tele_rate'] !=''){
				        	$teleRate = $formPostData['dr_tele_rate'];
				        }else{
				        	$teleRate = '';
				        }

				        if(!empty($formPostData['dr_video_rate']) && $formPostData['dr_video_rate'] !=''){
				        	$videoRate = $formPostData['dr_video_rate'];
				        }else{
				        	$videoRate = '';
				        }

				        if(!empty($formPostData['dr_pan_no']) && $formPostData['dr_pan_no'] !=''){
				        	$drPanCardD = gowelEncrypt($formPostData['dr_pan_no']);
				        	$formPostData['dr_pan_no'] = $drPanCardD;
				        }else{
				        	$drPanCardD = '';
				        }

				        if(!empty($formPostData['dr_contact']) && $formPostData['dr_contact'] !=''){
				        	$drContact = gowelEncrypt($formPostData['dr_contact']);
				        	$formPostData['dr_contact'] = $drContact;
				        }else{
				        	$drContact = '';
				        }

				        if(!empty($formPostData['dr_alt_contact']) && $formPostData['dr_alt_contact'] !=''){
				        	$drAltContact = gowelEncrypt($formPostData['dr_alt_contact']);
				        	$formPostData['dr_alt_contact'] = $drAltContact;
				        }else{
				        	$drAltContact = '';
				        }	

				        if($formPostData['status'] == 'Rejected' || $formPostData['status'] == 'Pending'){
				        	$dr_status = 'InActive';
				        }else{
				        	$dr_status = 'Active';
				        }

				        if(isset($_FILES['dr_digital_signature']['name']) && $_FILES['dr_digital_signature']['name'] !=''){
				        	$imgName = str_replace(" ","",$_FILES['dr_digital_signature']['name']);
							$imgTmpName = $_FILES['dr_digital_signature']['tmp_name'];
							$imgSize = $_FILES['dr_digital_signature']['size'];
							$imgType = $_FILES['dr_digital_signature']['type'];

							$allowed_extensions = array("image/jpg","image/jpeg","image/png");
							if(!in_array($imgType,$allowed_extensions)){
								echo json_encode(array('status'=>203,'msg'=>'Invalid format.Please Upload Only jpg | jpeg | png format allowed'));exit;
							}else{
								$newFileName = date('d-m-Y').'_'.time().'_'.$imgName;
								$uploadedTo = $uploadLocation.$newFileName;
								if(!file_exists($uploadedTo)){
									$moveFile = move_uploaded_file($imgTmpName, $uploadedTo);
									if($moveFile == true ){
										$docDigi = $newFileName;
									}
								}else{
									echo json_encode(array('status'=>203,'msg'=>'File Already Exist...'));exit;
								}
							}
				        }else{
				        	$docDigi = $doctorDetails[0]['dr_digital_signature'];
				        }

				        if(isset($_FILES['dr_profile_pic']['name']) && $_FILES['dr_profile_pic']['name'] !=''){
				        	$imgName2 = str_replace(" ","",$_FILES['dr_profile_pic']['name']);
							$imgTmpName2 = $_FILES['dr_profile_pic']['tmp_name'];
							$imgSize = $_FILES['dr_profile_pic']['size'];
							$imgType = $_FILES['dr_profile_pic']['type'];

							$allowed_extensions2 = array("image/jpg","image/jpeg","image/png");
							if(!in_array($imgType,$allowed_extensions2)){
								echo json_encode(array('status'=>203,'msg'=>'Invalid format.Please Upload Only jpg | jpeg | png format allowed'));exit;
							}else{
								$newFileName2 = date('d-m-Y').'_'.time().'_'.$imgName2;
								$uploadedTo2 = $uploadLocation.$newFileName2;
								if(!file_exists($uploadedTo2)){
									$moveFilePro = move_uploaded_file($imgTmpName2, $uploadedTo2);
									if($moveFilePro == true ){
										$docProfile = $newFileName2;
									}
								}else{
									echo json_encode(array('status' =>203,'msg'=>'File Already Exist...'));exit;
								}								
							}
				        }else{
				        	$docProfile = $doctorDetails[0]['dr_profile_pic'];;
				        }

				        if(isset($_FILES['dr_pan_card_cert']['name']) && $_FILES['dr_pan_card_cert']['name'] !=''){
				        	$imgName2 = str_replace(" ","", $_FILES['dr_pan_card_cert']['name']);
							$imgTmpName2 = $_FILES['dr_pan_card_cert']['tmp_name'];
							$imgSize = $_FILES['dr_pan_card_cert']['size'];
							$imgType = $_FILES['dr_pan_card_cert']['type'];

							$allowed_extensions_pan = array("image/jpg","image/jpeg","image/png","application/pdf");
							if(!in_array($imgType,$allowed_extensions_pan)){
								echo json_encode(array('status'=>203,'msg'=>'Invalid format.Please Upload Only jpg | jpeg | png | pdf format allowed'));exit;
							}else{
								$newFileName2 = date('d-m-Y').'_'.time().'_'.$imgName2;
								$uploadedTo2 = $uploadLocation.$newFileName2;
								if(!file_exists($uploadedTo2)){
									$moveFilePro = move_uploaded_file($imgTmpName2, $uploadedTo2);
									if($moveFilePro == true ){
										$drPanCardCertificate = $newFileName2;
									}
								}else{
									echo json_encode(array('status' =>203,'msg'=>'File Already Exist...'));exit;
								}								
							}
				        }else{
				        	$drPanCardCertificate = $doctorDetails[0]['dr_pan_card_cert'];;
				        }

				        if(isset($_FILES['dr_cancelled_cheque']['name']) && $_FILES['dr_cancelled_cheque']['name'] !=''){
				        	$imgName2 = str_replace(" ","",$_FILES['dr_cancelled_cheque']['name']);
							$imgTmpName2 = $_FILES['dr_cancelled_cheque']['tmp_name'];
							$imgSize = $_FILES['dr_cancelled_cheque']['size'];
							$imgType = $_FILES['dr_cancelled_cheque']['type'];

							$allowed_extensions_cheque = array("image/jpg","image/jpeg","image/png","application/pdf");
							if(!in_array($imgType,$allowed_extensions_cheque)){
								echo json_encode(array('status'=>203,'msg'=>'Invalid format.Please Upload Only jpg | jpeg | png | pdf format allowed'));exit;
							}else{
								$newFileName2 = date('d-m-Y').'_'.time().'_'.$imgName2;
								$uploadedTo2 = $uploadLocation.$newFileName2;
								if(!file_exists($uploadedTo2)){
									$moveFilePro = move_uploaded_file($imgTmpName2, $uploadedTo2);
									if($moveFilePro == true ){
										$drCancelledChequed = $newFileName2;
									}
								}else{
									echo json_encode(array('status' =>203,'msg'=>'File Already Exist...'));exit;
								}								
							}
				        }else{
				        	$drCancelledChequed = $doctorDetails[0]['dr_cancelled_cheque'];;
				        }

				        if(isset($_FILES['dr_regn_cert']['name']) && $_FILES['dr_regn_cert']['name'] !=''){
				        	$imgName2 = $_FILES['dr_regn_cert']['name'];
							$imgTmpName2 = $_FILES['dr_regn_cert']['tmp_name'];
							$imgSize = $_FILES['dr_regn_cert']['size'];
							$imgType = $_FILES['dr_regn_cert']['type'];

							$allowed_extensions_regnCert = array("image/jpg","image/jpeg","image/png","application/pdf");
							if(!in_array($imgType,$allowed_extensions_regnCert)){
								echo json_encode(array('status'=>203,'msg'=>'Invalid format.Please Upload Only jpg | jpeg | png | pdf format allowed'));exit;
							}else{
								$newFileName2 = date('d-m-Y').'_'.time().'_'.$imgName2;
								$uploadedTo2 = $uploadLocation.$newFileName2;
								if(!file_exists($uploadedTo2)){
									$moveFilePro = move_uploaded_file($imgTmpName2, $uploadedTo2);
									if($moveFilePro == true ){
										$drRegnCert = $newFileName2;
									}
								}else{
									echo json_encode(array('status' =>203,'msg'=>'File Already Exist...'));exit;
								}								
							}
				        }else{
				        	$drRegnCert = $doctorDetails[0]['dr_regn_cert'];;
				        }

				        if(isset($_FILES['dr_kyc_regn']['name']) && $_FILES['dr_kyc_regn']['name'] !=''){
				        	$imgName2 = $_FILES['dr_kyc_regn']['name'];
							$imgTmpName2 = $_FILES['dr_kyc_regn']['tmp_name'];
							$imgSize = $_FILES['dr_kyc_regn']['size'];
							$imgType = $_FILES['dr_kyc_regn']['type'];

							$allowed_extensions_regnCert = array("image/jpg","image/jpeg","image/png","application/pdf");
							if(!in_array($imgType,$allowed_extensions_regnCert)){
								echo json_encode(array('status'=>203,'msg'=>'Invalid format.Please Upload Only jpg | jpeg | png | pdf format allowed'));exit;
							}else{
								$newFileName2 = date('d-m-Y').'_'.time().'_'.$imgName2;
								$uploadedTo2 = $uploadLocation.$newFileName2;
								if(!file_exists($uploadedTo2)){
									$moveFilePro = move_uploaded_file($imgTmpName2, $uploadedTo2);
									if($moveFilePro == true ){
										$drKYCRegn = $newFileName2;
									}
								}else{
									echo json_encode(array('status' =>203,'msg'=>'File Already Exist...'));exit;
								}								
							}
				        }else{
				        	$drKYCRegn = $doctorDetails[0]['dr_kyc_regn'];;
				        }

				        if(isset($_FILES['dr_bank_declaration']['name']) && $_FILES['dr_bank_declaration']['name'] !=''){
				        	$imgName2 = $_FILES['dr_bank_declaration']['name'];
							$imgTmpName2 = $_FILES['dr_bank_declaration']['tmp_name'];
							$imgSize = $_FILES['dr_bank_declaration']['size'];
							$imgType = $_FILES['dr_bank_declaration']['type'];

							$allowed_extensions_regnCert = array("image/jpg","image/jpeg","image/png","application/pdf");
							if(!in_array($imgType,$allowed_extensions_regnCert)){
								echo json_encode(array('status'=>203,'msg'=>'Invalid format.Please Upload Only jpg | jpeg | png | pdf format allowed'));exit;
							}else{
								$newFileName2 = date('d-m-Y').'_'.time().'_'.$imgName2;
								$uploadedTo2 = $uploadLocation.$newFileName2;
								if(!file_exists($uploadedTo2)){
									$moveFilePro = move_uploaded_file($imgTmpName2, $uploadedTo2);
									if($moveFilePro == true ){
										$drBankDeclara = $newFileName2;
									}
								}else{
									echo json_encode(array('status' =>203,'msg'=>'File Already Exist...'));exit;
								}								
							}
				        }else{
				        	$drBankDeclara = $doctorDetails[0]['dr_bank_declaration'];;
				        }

				        if(isset($_FILES['dr_pan_declaration']['name']) && $_FILES['dr_pan_declaration']['name'] !=''){
				        	$imgName2 = $_FILES['dr_pan_declaration']['name'];
							$imgTmpName2 = $_FILES['dr_pan_declaration']['tmp_name'];
							$imgSize = $_FILES['dr_pan_declaration']['size'];
							$imgType = $_FILES['dr_pan_declaration']['type'];

							$allowed_extensions_regnCert = array("image/jpg","image/jpeg","image/png","application/pdf");
							if(!in_array($imgType,$allowed_extensions_regnCert)){
								echo json_encode(array('status'=>203,'msg'=>'Invalid format.Please Upload Only jpg | jpeg | png | pdf format allowed'));exit;
							}else{
								$newFileName2 = date('d-m-Y').'_'.time().'_'.$imgName2;
								$uploadedTo2 = $uploadLocation.$newFileName2;
								if(!file_exists($uploadedTo2)){
									$moveFilePro = move_uploaded_file($imgTmpName2, $uploadedTo2);
									if($moveFilePro == true ){
										$drPanDeclara = $newFileName2;
									}
								}else{
									echo json_encode(array('status' =>203,'msg'=>'File Already Exist...'));exit;
								}								
							}
				        }else{
				        	$drPanDeclara = $doctorDetails[0]['dr_pan_declaration'];;
				        }

				        $dr_field = array('ic_id','dr_name','dr_qualification','dr_regn_no','dr_pan_no','dr_contact','dr_alt_contact','dr_area','dr_address','dr_city','dr_state','dr_lang','dr_type','dr_type_priority2','dr_account_no','dr_bank_name','dr_acccount_holder_name','dr_bank_branch','dr_ifsc_code','dr_tele_rate','dr_video_rate','fpbx_caller_id');

						$dr_field_name = array('IC','Doctor Name','Doctor Qualification','Doctor Regn No','Doctor Pan Card','Doctor Primary Contact','Doctor Secondary Contact','Doctor Area','Doctor Address','Doctor City','Doctor State','Doctor Language','Doctor Primary Priority','Doctor Secondary Priority','Doctor A/c No','Doctor Bank Name','Doctor Account Holder Name','Doctor Bank Branch','Doctor IFSC Code','Doctor Tele Rate','Doctor Video Rate','FPBX Caller ID');
						//print_r($formPostData);exit;
						
						foreach($doctorDetails as $dr_data){
							for($a=0;$a<count($dr_field);$a++){
								if( $dr_data[$dr_field[$a]] != $formPostData[$dr_field[$a]] ){

									$old_value = $dr_data[$dr_field[$a]]; 
									$new_value = $formPostData[$dr_field[$a]];
									
									if($dr_field[$a] == "ic_id"){
										$old_icName = $new_icName = [];
										$old_icId = $this->mastermodel->master_get('insurance_company','ic_id IN ('.$dr_data[$dr_field[$a]].')','name');										

										foreach($old_icId as $val){
											$old_icName[] = $val['name'];
										}
										$old_value = implode(',', $old_icName);

										$new_icId = $this->mastermodel->master_get('insurance_company','ic_id IN ('.$ic_id.')','name');										

										foreach($new_icId as $val){
											$new_icName[] = $val['name'];			
										}
										$new_value = implode(',', $new_icName);

										$updateDRRemark[] = $dr_field_name[$a]." changed From ".$old_value." To ".$new_value;
									}

									else if($dr_field[$a] == "dr_lang"){
										$old_lang = $this->mastermodel->master_get('tbl_language','lang_id IN ('.$dr_data[$dr_field[$a]].')','lang_name');
										$old_langName = [];

										foreach($old_lang as $val){
											$old_langName[] = $val['lang_name'];
										}
										$old_value = implode(',', $old_langName);

										$new_lang = $this->mastermodel->master_get('tbl_language','lang_id IN ('.$formPostData[$dr_field[$a]].')','lang_name');
										$new_langName = [];

										foreach($new_lang as $val){
											$new_langName[] = $val['lang_name'];			
										}
										$new_value = implode(',', $new_langName);

										$updateDRRemark[] = $dr_field_name[$a]." changed From ".$old_value." To ".$new_value;
									}
									else if($dr_field[$a] == "dr_qualification"){
										$old_quali = $this->mastermodel->master_get('doctor_qualification','edu_id IN ('.$dr_data[$dr_field[$a]].')','qualification');
										$old_qualification = [];

										foreach($old_quali as $val){
											$old_qualification[] = $val['qualification'];
										}
										$old_value = implode(',', $old_qualification);

										$new_quali = $this->mastermodel->master_get('doctor_qualification','edu_id IN ('.$formPostData[$dr_field[$a]].')','qualification');
										$new_qualification = [];

										foreach($new_quali as $val){
											$new_qualification[] = $val['qualification'];			
										}
										$new_value = implode(',', $new_qualification);

										$updateDRRemark[] = $dr_field_name[$a]." changed From ".$old_value." To ".$new_value;
									}
									else if($dr_field[$a] == "dr_state"){
										$old_state = $this->mastermodel->master_get('tbl_states',"state_id =".$dr_data[$dr_field[$a]]);
										foreach($old_state as $val){
											$old_value = $val['state_name'];
										}

										$new_state = $this->mastermodel->master_get('tbl_states',"state_id =".$formPostData[$dr_field[$a]]);
										foreach($new_state as $val){
											$new_value = $val['state_name'];			
										}

										$updateDRRemark[] = $dr_field_name[$a]." changed From ".$old_value." To ".$new_value;
									}
									else if($dr_field[$a] == "dr_city"){
										$old_city = $this->mastermodel->master_get('tbl_cities', 'id = '.$dr_data[$dr_field[$a]],'name');
										foreach($old_city as $val){
											$old_value = $val['name'];
										}

										$new_city = $this->mastermodel->master_get('tbl_cities','id='.$formPostData[$dr_field[$a]],'name');
										foreach($new_city as $val){
											$new_value = $val['name'];			
										}

										$updateDRRemark[] = $dr_field_name[$a]." changed From ".$old_value." To ".$new_value;
									}
									else if($dr_field[$a] == "dr_pan_no"){
										$old_value = gowelDcrypt($old_value);
										$new_value = gowelDcrypt($new_value);
										$updateDRRemark[] = $dr_field_name[$a]." changed From ".$old_value." To ".$new_value;
										$financeRemark[] = $dr_field_name[$a]." changed From ".$old_value." To ".$new_value;
									}
									else if($dr_field[$a] == "dr_regn_no"){
										$old_value = $old_value;
										$new_value = $new_value;
										$financeRemark[] = $dr_field_name[$a]." changed From ".$old_value." To ".$new_value;	
									}
									else if($dr_field[$a] == "dr_tele_rate"){
										$old_value = $old_value;
										$new_value = $new_value;
										$financeRemark[] = $dr_field_name[$a]." changed From ".$old_value." To ".$new_value;	
									}
									else if($dr_field[$a] == "dr_video_rate"){
										$old_value = $old_value;
										$new_value = $new_value;
										$financeRemark[] = $dr_field_name[$a]." changed From ".$old_value." To ".$new_value;	
									}
									else if($dr_field[$a] == "dr_contact"){
										$old_value = gowelDcrypt($old_value);
										$new_value = gowelDcrypt($new_value);
										$updateDRRemark[] = $dr_field_name[$a]." changed From ".$old_value." To ".$new_value;
									}
									else if($dr_field[$a] == "dr_alt_contact"){
										$old_value = gowelDcrypt($old_value);
										$new_value = gowelDcrypt($new_value);
										$updateDRRemark[] = $dr_field_name[$a]." changed From ".$old_value." To ".$new_value;
									}						
									else{
										$updateDRRemark[] = $dr_field_name[$a]." changed From ".$old_value." To ".$new_value;
									}									
								}
							}
						}
						//echo"<pre>";print_r($updateDRRemark);exit;
						//echo"<pre>";print_r($financeRemark);exit;
						if(!empty($updateDRRemark) && count($updateDRRemark)>0){
							$drRemark['dr_id'] = $dr_id;
							$drRemark['dr_remark'] = implode(' | ', $updateDRRemark);
							$drRemark['created_at'] = date('Y-m-d H:i:s');
							$drRemark['created_by'] = $this->session->userdata('user_id');
							$this->mastermodel->master_insert('doctor_remark',$drRemark);	
						}

						if(!empty($financeRemark) && count($financeRemark)>0){
							$finRemark['fin_remark'] = implode(' | ', $financeRemark);
							$finRemark['fin_created_at'] = date('Y-m-d H:i:s');
							$finRemark['fin_created_by'] = $this->session->userdata('user_id');
							$this->user_model->updateRecord('doctor_profile', $finRemark, 'dr_id', $dr_id);
						}
						

						$updateProfile = array(
							"dr_name" => $formPostData['dr_name'],
							"dr_qualification" => $dcoQualification,
							"edu_id" => $dcoQualification,
							"dr_regn_no" => $formPostData['dr_regn_no'],
							"dr_pan_no" => $drPanCardD,
							"dr_email" => gowelEncrypt($formPostData['email']),
							"dr_contact" => $drContact,
							"dr_alt_contact" => $drAltContact,
							"dr_area" => $formPostData['dr_area'],
							"dr_address" => $formPostData['dr_address'],
							"dr_city" => $formPostData['dr_city'],
							"dr_state" => $formPostData['dr_state'],
							"dr_lang" => $doc_lang,
							"dr_type" => $doc_type,
							"dr_type_priority2" => $doc_type_priority2,
							"dr_profile_pic" => $docProfile,
							"dr_digital_signature" => $docDigi,
							"dr_regn_cert" => $drRegnCert,
							"dr_cancelled_cheque" => $drCancelledChequed,
							"dr_pan_card_cert" => $drPanCardCertificate,
							"dr_kyc_regn" => $drKYCRegn,
							"dr_bank_declaration" => $drBankDeclara,
							"dr_pan_declaration" => $drPanDeclara,
							"dr_account_no"=>$accountNo,
							"dr_bank_name"=>$bankName,
							"dr_acccount_holder_name"=>$acccountHolderName,
							"dr_bank_branch"=>$bankBranch,
							"dr_ifsc_code"=>$IFSCCode,
							"dr_tele_rate"=>$teleRate,
							"dr_video_rate"=>$videoRate,
							"status" => $dr_status,
							"updated_at" => date('Y-m-d H:i:s'),
							"updated_by" => $this->session->userdata('user_id'),
							"fpbx_caller_id"=>$formPostData['fpbx_caller_id']
						);
						$lastUpdateddoctor = $this->user_model->updateRecord('doctor_profile', $updateProfile, 'dr_id', $formPostData['user_type_id']);
						//$doctorInsertedProfile = $this->user_model->insertDoctorRecord('doctor_profile',$doctorProfile);

						if($lastUpdateddoctor){
							$updateUser = array(
								"user_type_id" => $formPostData['user_type_id'],
								"user_type" => "DOCTOR",
								"parent_id" =>$_POST['parent_id'],
								"dc_parent_id" => 0,
								"address" => $formPostData['dr_address'],
								"branch" => 0,
								"wel_branch_id" => 0,
								"name" => $formPostData['dr_name'],
								"email" => gowelEncrypt($formPostData['email']),
								"contact" => $drContact,
								"ic_id" => $ic_id,
								"state_id" => $formPostData['dr_state'],
								"business_channel" => 0,
								"role_id" => $formPostData['role_id'],
								"subrole_id" => $formPostData['subrole_id'],
								"mer_type_id" => $drmer_type,
								"modified_at" => date('Y-m-d H:i:s'),
								"modified_by" => $this->session->userdata('user_id'),
								"status" => $formPostData['status'],
								"fpbx_caller_id"=>$formPostData['fpbx_caller_id']
							);


							if(isset($formPostData['lpassword']) && $formPostData['lpassword'] !=""){
								$generated_password = $formPostData['lpassword'];
								$updateUser['password'] = md5($generated_password);
							}

							$lastUpdatedUser = $this->user_model->updateRecord('user', $updateUser, 'user_id', $formPostData['user_id']);
							
							if(isset($formPostData['dr_url']) && $formPostData['dr_url'] !=''){
								//echo"ASIF";exit;
								$urlExist = $this->mastermodel->getTableRecords('doctor_video_url',"dr_id","dr_id=".$formPostData['user_type_id']);
								//print_r($urlExist);exit;
								if(!empty($urlExist) && $urlExist != false){
									$updateURL['video_url'] = $formPostData['dr_url'];
									$updateURL['customer_video_url'] = $formPostData['customer_url'];
									$updateURL['video_url2'] = $formPostData['dr_url2'];
									$updateURL['customer_video_url2'] = $formPostData['customer_url2'];
									$updateURL['updated_at'] = date('Y-m-d H:i:s');
									$updateURL['updated_by'] = $this->session->userdata('user_id');
									$this->user_model->updateRecord('doctor_video_url', $updateURL, 'dr_id', $formPostData['user_type_id']);
								}else{
									$insertURL['dr_id'] = $formPostData['user_type_id'];
									$insertURL['room_id'] = 1;
									$insertURL['video_url'] = $formPostData['dr_url'];
									$insertURL['customer_video_url']=$formPostData['customer_url'];
									$insertURL['video_url2'] = $formPostData['dr_url2'];
									$insertURL['customer_video_url2'] = $formPostData['customer_url2'];
									$insertURL['created_at'] = date('Y-m-d H:i:s');
									$insertURL['created_by'] = $this->session->userdata('user_id');
									$this->mastermodel->master_insert('doctor_video_url',$insertURL);
								}
									
							}							

							if($lastUpdatedUser > 0){
								echo json_encode(array('status'=>200,'msg'=>'Successfully Updated Record...'));exit;
							}
						}
					}
				}else{
					echo json_encode(array('status'=>203,'msg'=>'You are not authorized user...'));exit;
				}
			}else{
				echo json_encode(array('status'=>203,'msg'=>'Bad Request...'));exit;
			}
		}else{
			echo json_encode(array('status'=>203,'msg'=>'Your session has been expired. Please login again...','url'=>'login'));exit;
		}	
	}


	public function getAllUsersData(){
		if($this->session->userdata('user_id')>0){
			if($this->privilegeduser->hasPrivilege("exportUser") || $this->userprivileged->hasUserPrivilege("exportUser")){
				$doctorCOLS = array('User_id','User TYPE','EMP Code','NAME','Login User','Contact','Agent Campaign Id','Inbound Call','Outbound Call','BRANCH','IC Name','MER Type','Status');
				
				
				$csvdata  = $this->user_model->getDetails('user',"user_id,user_type,gwlempid,name,email,contact,agent_campaign_id,inbound_call,outbound_call,branch,ic_id,mer_type_id,status","status='Approved' AND user_type='SUPERADMIN'");
				//print_r($csvdata); exit();

				$alllist = array();
				foreach ($csvdata as $key => $drvalue) {
					$list = array();
					
					$list['user_id'] = $drvalue['user_id'];
					$list['user_type'] = $drvalue['user_type'];
					$list['GWL_EMPID'] = $drvalue['gwlempid'];
					$list['NAME'] = $drvalue['name'];
					$list['email'] = gowelDcrypt($drvalue['email']);
					$list['contact'] = gowelDcrypt($drvalue['contact']);
					$list['agent_campaign_id'] = $drvalue['agent_campaign_id'];
					$list['inbound_call'] = $drvalue['inbound_call'];
					$list['outbound_call'] = $drvalue['outbound_call'];
					$list['Branch'] = $drvalue['branch'];
					$ics = explode(",",$drvalue['ic_id']);
					$icName = [];
					if(!empty($ics)){
						for ($ic=0; $ic <count($ics) ; $ic++) { 
							$icName[] = getICName($ics[$ic]);
						}
					}
					$list['icName'] = implode(",",$icName);
					$mer_type_id = explode(",", $drvalue['mer_type_id']);
					$mertypes = [];

					if(!empty($mer_type_id) && $drvalue['mer_type_id'] !=""){
						$mers = $drvalue['mer_type_id'];
						$merType = $this->mastermodel->getTableRecords("mer_types","GROUP_CONCAT(mer_type) AS mer_type","mer_id IN(".$mers.")");
						$list['MerType'] = $merType[0]['mer_type'];
					} else{
						$list['MerType'] = "";
					}
					
					$list['status'] = $drvalue['status'];
					
					array_push($alllist, $list);
				}	

				ob_end_clean();
				header('Content-Type: text/csv; charset=utf-8');  
				header('Content-Disposition: attachment; filename=ActiveUsers.csv');
				$output = fopen("php://output", "w");
				fputcsv($output, $doctorCOLS);

				foreach ($alllist as $fields) {
					fputcsv($output, $fields);			
				}
				fclose($output);
			}			
		}else{
			redirect('login','refresh');
		}
	}

	public function getAvailableDoctorList(){
		$data['header'] = 'Available Doctors List | Medical App';
		$data['doctor_list'] = $this->mastermodel->getTableRecords('user AS usr LEFT JOIN doctor_profile dp ON usr.user_type_id=dp.dr_id',"usr.user_id,dp.dr_id,usr.name,usr.contact,dp.dr_type, dp.dr_type_priority2, dp.dr_qualification,dp.dr_lang, usr.inbound_call,usr.outbound_call,usr.availability,usr.last_loggedin","usr.status='Approved' AND usr.user_type='DOCTOR'");
		//echo "<pre>"; print_r($data);
		if($this->session->userdata('user_id')>0){
			$this->load->view('template/header');
		} else{
			$this->load->view('template/CCSheader');
		}
		$this->load->view('user/availabledoctorlist', $data);
		$this->load->view('template/footer');

	}
	
	
	public function sendsms(){

            // Account details
            $apiKey = urlencode('NTM3NzUyNTY2YjU0NzczMjc3NDM2YzY5NWE0MzcyNDc=');
            // Message details
            $numbers = array(918700761707, 918527916545);
            $sender = urlencode('TXTLCL');
            $message = rawurlencode('6500');
             
            $numbers = implode(',', $numbers);
             
            // Prepare data for POST request
            $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
            // Send the POST request with cURL
            $ch = curl_init('https://api.textlocal.in/send/');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            // Process your response here
            echo $response;

	}
	  
}

?>
