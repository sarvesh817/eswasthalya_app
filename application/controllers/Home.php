<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct(){
	   parent::__construct();
	   date_default_timezone_set('Asia/Kolkata');
	   $this->load->model('Homemodel','',TRUE);
	   $this->load->model('Mastermodel','',TRUE);	   
	}

	 
	public function index() {

		$detail['USER_ID'] = $this->session->userdata('user_id');
		$detail['USER_TYPE'] = $this->session->userdata('type');
		$detail['USER_TYPE_ID'] = $this->session->userdata('type_id');
		$branch = $this->session->userdata('branch');
		$detail['BRANCH'] = $branch;
		$detail['ROLE'] = $this->session->userdata('role_id');
		$detail['SUBROLE'] = $this->session->userdata('subrole_id');
		$detail['NAME'] = $this->session->userdata('name');
		$ic_ids = $this->session->userdata('ic_id');
		$detail['ic_id'] = $ic_ids;
		$detail['state_id'] = $this->session->userdata('state_id');	
		$business_channel = $this->session->userdata('business_channel');		
		$detail['business_channel'] = $business_channel;

		//echo "<pre>"; print_r($detail); exit;

		if(!empty($this->session->userdata('user_id'))) {
				
			$DrAvailability='No';

			$this->load->view('template/header.php');
			$this->load->view('superadmin/dashboard',$detail);
			$this->load->view('template/footer.php');	
		}else {
			redirect('login', 'refresh');
		}
	}

	public function dashboard() {
		$detail['USER_ID'] = $this->session->userdata('user_id');
		$detail['USER_TYPE'] = $this->session->userdata('type');
		$detail['USER_TYPE_ID'] = $this->session->userdata('type_id');
		$detail['ROLE'] = $this->session->userdata('role_id');
		$detail['SUBROLE'] = $this->session->userdata('subrole_id');
		$detail['NAME'] = $this->session->userdata('name');
		$detail['state_id'] = $this->session->userdata('state_id');	

		//$lastnintyDate = date('Y-m-d') -"30 days";	

		if(!empty($this->session->userdata('user_id'))) {
			
			$DrAvailability='No';
			$hdfc_doctor_users = ['246699'];
			if(in_array($detail['USER_ID'],$hdfc_doctor_users)){
				$user_id = $detail['USER_ID'];
				$detail['DrAvailability'] = $this->Mastermodel->getTableRecords("user","user_availability","user_id='".$user_id."'");
				if(!empty($detail['DrAvailability'])){
					$DrAvailability = $detail['DrAvailability'][0]['user_availability'];
				}
				$this->session->set_userdata('DrAvailability',$DrAvailability);
			}
			
			if($this->userprivileged->hasUserPrivilege("Dashboard")) {

				$todayaDate = date('Y-m-d');
				$thirtyDaysBDate = date('Y-m-d', strtotime('-30 days'));
				$currmonthDaysBDate = date('Y-m-01');

				$detail['opencasesdata'] = $this->Mastermodel->getTableRecords("tbl_case","count(c_id) AS totalOpen","is_deleted='No' AND case_status IN ('".$allopenstatus."') AND ic_id IN (".$ic_ids.") AND branch IN ('".$branch."') AND business_channel IN ('".$businessChannel."')");

				$AllStatuswiseCase = $this->Mastermodel->getTableRecords("tbl_case","case_status,count(c_id) AS ttlcases","is_deleted='No' AND ic_id IN (".$ic_ids.") AND branch IN ('".$branch."') AND business_channel IN ('".$businessChannel."') AND case_status NOT IN ('Appointment Confirmed','Closed - Reports submitted to insurer') AND DATE(created_at)>='".$currmonthDaysBDate."' AND DATE(created_at)<='".$todayaDate."'"," GROUP BY case_status");

				$detail['StatuswiseCase'] = array_merge($AppntScheduleCase,$CURRMClosedCase,$AllStatuswiseCase);

				

				//echo "<pre>"; print_r($detail); exit();
				$this->load->view('template/header.php');
				$this->load->view('home/dashboard',$detail);
				$this->load->view('template/footer.php');

			} else{
				$this->load->view('template/header.php');
				$this->load->view('home/index',$detail);
				$this->load->view('template/footer.php');	
			}
		}
		else{		
			redirect('login', 'refresh');
		}
	}



	public function logout() {
	 	$this->load->model('loginmodel','',TRUE);
	 	$user_id = $this->session->userdata('user_id');	
	 	$username = $this->session->userdata('email');	
	 	
		$update['is_loggedin'] = 0;
		$update['availability'] = 'Offline';
		$this->loginmodel->updateRecord($update, $user_id);

		$userlog['logout_time'] = date('Y-m-d H:i:s');
		$userlog['action'] = "LOGOUT";

		if(isset($_SESSION['loginToken'])  && $_SESSION['loginToken'] !=""){
			$login_token = $this->session->userdata('loginToken');		
			$logout = $this->Mastermodel->master_update('userlog',$userlog,'user_id='.$user_id.' AND login_token="'.$login_token.'"');
			
			unset($_SESSION["webadmin"]);
			unset($_SESSION["useradmin"]);
			unset($_COOKIE["gwl_secretkey"]);
			$this->session->sess_destroy();

		} else{
			
			unset($_SESSION["webadmin"]);
			unset($_SESSION["useradmin"]);
			unset($_COOKIE["gwl_secretkey"]);
			$this->session->sess_destroy();
		}
		
	   	redirect('login', 'refresh');

	}

	public function getAllStateList(){
		$html = "";
		$getState = $this->Mastermodel->getTableRecords("tbl_states","state_id,state_name AS stateName");
		if(!empty($getState) && $getState != false){
			$html .= '<option value="">--Select State--</option>';
			foreach ($getState as $key => $value) { 
				$html .= '<option value="'.$value['state_id'].'">'.$value['stateName'].'</option>';
			}
		}
		echo json_encode(array('status'=>'200','data'=>$html));exit;
	}


	public function getCityList(){
		$state_id = $this->input->post('state_id');
		$html = '';
		$stateWiseCity = $this->Mastermodel->getTableRecords("tbl_cities","id AS cityId,name AS cityName","state_id='".$state_id."'");
		if(!empty($stateWiseCity)){
			$html .= '<option value="">--Select City--</option>';
			foreach ($stateWiseCity as $key => $value) { 
				$html .= '<option value="'.$value['cityId'].'">'.$value['cityName'].'</option>';
			}
		}
		echo json_encode(array('status'=>'200','data'=>$html));
		exit;
	}


}

?>
