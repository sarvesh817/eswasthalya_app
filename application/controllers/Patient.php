<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Patient extends CI_Controller
{
  
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->load->model('eclinic_model'); 
        $this->load->library('session');
        $this->load->helper('common');
		$this->load->model('Mastermodel','',TRUE);

    }

    public function index()
    {
        $usertype = $this->session->userdata('type');
        $uid = $this->session->userdata('user_id');
        $data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		$data['patient_list'] = $this->Mastermodel->master_get('tbl_patient','user_id="'.$uid.'"', '*');
        if(!empty($this->session->userdata('user_id'))) {
			$this->load->view('template/header',$data);
            $this->load->view('eclinic-panel/patient-list',$data);
            $this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
    }
    
    
    public function patient_register()
    {
        $usertype = $this->session->userdata('type');
        $uid = $this->session->userdata('user_id');
        $data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		$data['patient_list'] = $this->Mastermodel->master_get('tbl_patient','user_id="'.$uid.'"', '*');
        if(!empty($this->session->userdata('user_id'))) {
			$this->load->view('template/header',$data);
            $this->load->view('eclinic-panel/patient-register',$data);
            $this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
    }
    

	
	public function savepatientData(){
        $userid = $this->session->userdata('user_id');

        if (@$_FILES['profile_photo']['size'] != 0) {
            $upload_dir = 'img/eclinic_upload/';
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
            $farray3 = explode(".", $_FILES["profile_photo"]["name"]);

            $config['file_name'] = basename(substr(md5(rand()), 0, 10) . time() . '.' . $farray3[1]);
            $config['overwrite'] = false;
            $this->load->library('upload', $config);
			$this->upload->initialize($config);
            if (!$this->upload->do_upload('profile_photo')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $this->upload_data['profile_photo'] = $this->upload->data();
                $profile_image = $this->upload_data['profile_photo'];
				$profile_photo = $profile_image['file_name'];
				
				$SaveData['profile_photo'] = $profile_photo;
            }
        }
        
        $SaveData['user_id'] = $userid;
        $SaveData['full_name'] = $this->input->post('full_name');
        $SaveData['mobile'] = $this->input->post('mobile');
        $SaveData['email'] = $this->input->post('email');
        $SaveData['aadhar_no'] = $this->input->post('aadhar_no');
        $SaveData['secret_pin'] = $this->input->post('secret_pin');
        $SaveData['age'] = $this->input->post('age'); 
        $SaveData['gender'] = $this->input->post('gender');
        $SaveData['relative_name'] = $this->input->post('relative_name');
        $SaveData['relation'] = $this->input->post('relation');
        $SaveData['emergency_contact'] = $this->input->post('emergency_contact');
        $SaveData['emergency_person'] = $this->input->post('emergency_person');
        $SaveData['allergy'] = $this->input->post('allergy');
        $SaveData['marital_status'] = $this->input->post('marital_status');
        $SaveData['occupation'] = $this->input->post('occupation');
        $SaveData['health_insurance'] = $this->input->post('health_insurance');
        $SaveData['address'] = $this->input->post('address');
        $SaveData['created_at'] = date("Y-m-d h:i:s");

        $model_res = $this->Mastermodel->master_insert('tbl_patient',$SaveData);
        if($model_res){
            $response = array('status'=>'1','msg'=>'Records has been added successfully.');
		}else{
			$response = array('status'=>'0','msg'=>'Problem in data update.');
		}
		echo json_encode($response); exit();
		
    } 
    
    
    
  

}
