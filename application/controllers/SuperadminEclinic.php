<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SuperadminEclinic extends MY_Controller {

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
            $this->db->select('tc.user_type,tc.status,cd.*');
            $this->db->from('user tc');
            $this->db->join('tbl_eclinic cd','cd.user_id  = tc.user_id','left');
            $this->db->order_by('tc.user_id','asc');
            $this->db->where('tc.user_type','ECLINIC');
            $this->db->where_not_in('cd.user_id','');
            $res = $this->db->get();
            //echo $this->db->last_query();exit;
            $count=$res->num_rows();  
            if ($count>0) {
    			$response=$res->result_array(); 
    			$data['eclinicListData']= $response;
            }else{
                $data['eclinicListData']='';
            }

			$this->load->view('template/header',$data);
			$this->load->view('superadmin/eclinic-list',$data);
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