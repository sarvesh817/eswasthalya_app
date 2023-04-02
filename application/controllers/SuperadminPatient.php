<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SuperadminPatient extends MY_Controller {

	public function __construct(){
	   parent::__construct();
	   date_default_timezone_set('Asia/Kolkata');
	   $this->load->model('Homemodel','',TRUE);
	   $this->load->model('Mastermodel','',TRUE);	   
	   $this->load->model('doctor_model');	      
	}

	
	public function index() {
		$uid = $this->session->userdata('user_id');
		if(!empty($this->session->userdata('user_id'))) {
            $data['patientListData'] = $this->Mastermodel->master_get('tbl_patient','', '*');
            //echo '<pre>'; print_r($data['patientListData']);exit;

			$this->load->view('template/header',$data);
			$this->load->view('superadmin/patient-list',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function single_patient() {
		$uid = $this->session->userdata('user_id');
		$pid = $this->uri->segment(3);
		$data['patient_details'] = $this->Mastermodel->master_get('tbl_patient','id="'.$pid.'"', '*');
		//$data['patient_details'] = $this->db->where('id',$pid)->where('user_id',$uid)->get('tbl_patient')->row();
		$data['appointment_data'] = $this->Mastermodel->master_get('tbl_book_appointment','patient_id="'.$pid.'"', '*');
		
		//echo '<pre>'; print_r($data['appointment_data']);exit;
		
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('superadmin/single-patient',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function eclinicProfileView() {
		$uid = $this->session->userdata('user_id');
		$cid = $this->uri->segment(3);
		$data['eclinic_profile_data'] = $this->Mastermodel->master_get('tbl_eclinic','id="'.$cid.'"', '*');
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('superadmin/eclinic-profile',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
}