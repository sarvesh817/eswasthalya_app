<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SuperadminDoctor extends MY_Controller {

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
            $this->db->join('tbl_doctors cd','cd.user_id  = tc.user_id','left');
            $this->db->order_by('tc.user_id','asc');
            $this->db->where('tc.user_type','DOCTOR');
            $this->db->where_not_in('cd.user_id','');
            $res = $this->db->get();
            //echo $this->db->last_query();exit;
            $count=$res->num_rows();  
            if ($count>0) {
    			$response=$res->result_array(); 
    			$data['doctorListData']= $response;
            }else{
                $data['doctorListData']='';
            }
            
            //echo '<pre>'; print_r($data['doctorListData']);exit;

			$this->load->view('template/header',$data);
			$this->load->view('superadmin/doctor-list',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function doctorProfileView() {
		$uid = $this->session->userdata('user_id');
		$did = $this->uri->segment(3);
		$data['doctor_profile_data'] = $this->Mastermodel->master_get('tbl_doctors','id="'.$did.'"', '*');
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('superadmin/doctor-profile',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	
	public function updateStatus(){
	    
	    $status  = $this->input->post("status");
	    $id  = $this->input->post("id");
		$formData['status'] =$status; 
		$formData['modified_at'] = date("Y-m-d h:i:s"); 
	    $model_res = $this->Mastermodel->master_update('user',$formData,'user_id='.$id);
        if($model_res){
            $response = array('status'=>'1','msg'=>'Status Changed successfully.');
		}else{
			$response = array('status'=>'0','msg'=>'Problem in data update error.');
		}
		
		echo json_encode($response); exit();
	}
}