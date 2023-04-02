<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EclinicFeedback extends CI_Controller{
  
    public function __construct()
    {
       parent::__construct();
	   date_default_timezone_set('Asia/Kolkata');
	   $this->load->model('Homemodel','',TRUE);
	   $this->load->model('Mastermodel','',TRUE);
    }

    /* Start Feedback */
    public function add_feedback(){
        //$data['working_list']= $this->home_model->select($uid,"feedback");        
        $data['middle'] = 'add_feedback';
        $uid = $this->session->userdata('user_id');
		$data['doctor_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		if(!empty($this->session->userdata('user_id'))) {
		    
		    if($this->input->get('id') !=''){
                $id=$this->input->get('id');
                $data['feedbackDala'] = $this->db->where('id',$id)->get('feedback')->row();
            }else{
                $id = $this->input->get('id');
                $data['feedbackDala'] = '';
            }
            
            $data['feedbackid'] = $id;
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/add-feedback',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
    }

    public function add_feedbackData(){
        $userid = $this->session->userdata('user_id');
        parse_str($_POST['formdata'],$formdata);
        $subject = $formdata['subject'];
        $description = $formdata['description'];
        $post_data = array('user_id'=>$userid,'subject'=>$subject, 'description' => $description);
        $model_res = $this->Mastermodel->master_insert('feedback',$post_data);
        if($model_res){
            $response = array('success'=>'1','msg'=>'Records has been added successfully.');
		}else{
			$response = array('success'=>'0','msg'=>'Problem in data update.');
		}
		echo json_encode($response); exit();
    } 
     
     
    public function update_feedbackData(){
        parse_str($_POST['formdata'],$formdata);
        $id = $formdata['feedbackID'];
        $subject = $formdata['subject'];
        $description = $formdata['description'];
        $post_data = array('subject' => $subject, 'description' => $description ); 
        $model_res = $this->Mastermodel->master_update('feedback',$post_data,'id='.$id);
        if($model_res){
            $response = array('success'=>'1','msg'=>'Records has been updated successfully.');
		}else{
			$response = array('success'=>'0','msg'=>'Problem in data update.');
		}
		echo json_encode($response); exit();
    }

    public function all_feedback(){
        $uid = $this->session->userdata('user_id');
        $data['feedback_list'] = $this->Mastermodel->master_get('feedback','user_id="'.$uid.'"', '*');
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
        $data['middle'] = 'all_feedback';
        if(!empty($this->session->userdata('user_id'))) {
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/all-feedback',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
    }  

    public function delete_feedback(){
        $id = $this->input->post('id');
        $model_res= $this->Mastermodel->master_delete("feedback",'id="'.$id.'"');    
        if($model_res){
            $response = array('success'=>'1','msg'=>'Records has been deleted Successfully.');
		}else{
			$response = array('success'=>'0','msg'=>'Problem in data update.');
		}
		echo json_encode($response); exit();
     }
 //End Feedback 
}
