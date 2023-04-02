<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DoctorsPanel extends MY_Controller {

	public function __construct(){
	   parent::__construct();
	   date_default_timezone_set('Asia/Kolkata');
	   $this->load->model('Homemodel','',TRUE);
	   $this->load->model('Mastermodel','',TRUE);	   
	   $this->load->model('doctor_model');	      
	}

	 
	public function index() {

		$uid = $this->session->userdata('user_id'); 
		
		$data['doctor_info_edit'] = $this->Mastermodel->master_get('tbl_doctors','user_id="'.$uid.'"', '*');
		$todaydate = date('m/d/Y');
		$data['appointment_data'] = $this->Mastermodel->master_get('tbl_book_appointment','doctor_id="'.$uid.'" AND created_at = "'.$todaydate.'" ', '*');
		
		$tomm_date = date('Y-m-d');
        $tomm_date = $tomm_date;
    	$where = array(
            'doctor_id'=>$uid,
            'DATE(created_at)'=>$tomm_date,
        );
		
	    $data['callData'] = $this->db->where($where)->order_by("id","desc")->limit(1)->get('tbl_click_to_call')->row();
	    //echo $this->db->last_query() ;
	    //print_r($data['callData']); exit;
		
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('doctors-panel/dashboard',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function single_patient() {
		$uid = $this->session->userdata('user_id');
		$pid = $this->uri->segment(3);
		$data['doctor_info_edit'] = $this->Mastermodel->master_get('tbl_doctors','user_id="'.$uid.'"', '*');
		$data['patient_details'] = $this->db->where('id',$pid)->get('tbl_patient')->row();
		$data['appointment_data'] = $this->Mastermodel->master_get('tbl_book_appointment','patient_id="'.$pid.'"', '*');
		
		//echo '<pre>'; print_r($data['patient_details']);exit;
		
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('doctors-panel/single-patient',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function write_prescription() {
		$uid = $this->session->userdata('user_id');
		$pid = $this->uri->segment(3);
		$data['patient_details'] = $this->db->where('id',$pid)->get('tbl_patient')->row();
		$data['doctor_info_edit'] = $this->Mastermodel->master_get('tbl_doctors','user_id="'.$uid.'"', '*');
		
		//echo '<pre>'; print_r($data['patient_details']);exit;
		
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('doctors-panel/write-prescription',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function savePrescriptionData(){
	    
        $userid = $this->session->userdata('user_id');
        //$pid = $this->uri->segment(3);
        $SaveData['user_id'] = $userid;
        $pid = $this->input->post('pid');
        $checkPrescription = $this->db->where('pid',$pid)->where('user_id',$userid)->get('tbl_prescription')->row();

        $SaveData['add_clinical_notes'] = $this->input->post('add_clinical_notes');
        $SaveData['differential_diagnose'] = $this->input->post('differential_diagnose');
        $SaveData['medicine'] = $this->input->post('medicine');
        $SaveData['strength'] = $this->input->post('strength');
        $SaveData['dose'] = $this->input->post('dose');
        $SaveData['frequency'] = $this->input->post('frequency'); 
        $SaveData['duration'] = $this->input->post('duration');
        $SaveData['instruction'] = $this->input->post('instruction');
        $SaveData['advice'] = $this->input->post('advice');
        $SaveData['lab_investigation'] = $this->input->post('lab_investigation');
        

        //echo '<pre>'; print_r($SaveData); exit;
        
        if(!empty($checkPrescription) && $checkPrescription != false){
            $SaveData['modify_at'] = date("Y-m-d h:i:s");
            $prs_id = $checkPrescription->id;
            $model_res = $this->Mastermodel->master_update('tbl_prescription',$SaveData,'id='.$prs_id);
            //$model_res = $this->Mastermodel->master_insert('tbl_patient_medical_history',$SaveData);
            if($model_res){
                $response = array('status'=>'1','msg'=>'Records has been updated successfully.','pid'=>$pid);
    		}else{
    			$response = array('status'=>'0','msg'=>'Problem in data update error.');
    		}
            
        }else{
            
            $SaveData['pid'] = $this->input->post('pid');
            $SaveData['app_id'] = $this->input->post('appid');
            $SaveData['created_at'] = date("Y-m-d h:i:s");
            
            $model_res = $this->Mastermodel->master_insert('tbl_prescription',$SaveData);
            if($model_res){
                $response = array('status'=>'1','msg'=>'Records has been added successfully.','pid'=>$pid);
    		}else{
    			$response = array('status'=>'0','msg'=>'Problem in data add error.');
    		}
        }
    } 
	
	
	public function consultation_history() {
		$uid = $this->session->userdata('user_id');
		$data['doctor_info_edit'] = $this->Mastermodel->master_get('tbl_doctors','user_id="'.$uid.'"', '*');
		
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('doctors-panel/consultation-history',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	
	public function schedule_working_hours() {
	      
	  	$uid = $this->session->userdata('user_id');
	    
		$data['doctor_info_edit'] = $this->Mastermodel->master_get('tbl_doctors','user_id="'.$uid.'"', '*');
		
            if(isset($_POST['submit_schedule'])) { 
                 
                extract($_POST);
                $this->db->where('user_id',$uid);  
                $fetch_weekdays=$this->Mastermodel->master_get('schedule_working');   
                 
               if($fetch_weekdays){
                 foreach($fetch_weekdays as $wd) {

                    $val2[]=$wd['week_days'];     
                 }  
                    $diff_array = array_diff($week_days, $val2);  
                }else{
                     $diff_array=@$week_days; 
                 }
                 
                 if (is_array($diff_array))
                {
                    foreach($diff_array as $wd) {
                    $post_data = array('user_id'=>$uid,
                    'week_days'=>$wd, 'start_time' => $start_time, 'end_time' => $end_time );   
                    
                     
                    $model_res = $this->Mastermodel->master_insert('schedule_working',$post_data);

                    
                    }
                }  
                //for slot logic loop created here
                $t1 = strtotime($start_time);
                $t2 = strtotime($end_time);  

                 $subtract_minutes=  floor((($t2 - $t1))/60); 
                 $divided_val=$subtract_minutes/15; 
                 if (is_float($divided_val)) {
                    $round_loop = floor($divided_val)+1;
                }else{
                     $round_loop = $divided_val;    
                 }
                
               strtotime($end_time . ' +15 minutes');
               for($i=1;$i<=$round_loop;$i++){
                        if($i==$round_loop){
                            $adding15_min=$end_time;    
                        }else{
                            $addingFiveMinutes= strtotime($start_time.' + 15 minute');
                            $adding15_min=date('h:i', $addingFiveMinutes);   
                        }
 
                        $post_data = array('user_id'=>$uid,'availability'=>'Available','week_days'=>@$wd,      
                        'start_time' => date('h:i A', strtotime($start_time)), 'end_time' => date('h:i A', strtotime($adding15_min)) );   

                        $this->db->insert('slot_management', $post_data);    
						//echo $this->db->last_query(); die;        
                        $addingFiveMinutes2= strtotime($start_time.' + 15 minute');
                        $start_time=date('H:i', $addingFiveMinutes2);       
                    }  
                 // dd($post_data);       
                //alert("Saved Successfully","/doctors-panel/schedule-working");                
               /// redirect(base_url('doctors-panel/schedule-working-hours'));
            }
            $data['working_list'] = $this->Mastermodel->master_get('schedule_working','	user_id="'.$uid.'"', '*');
            //$data['working_list']= $this->home_model->select($userid,"schedule_working");      
            $data['middle'] = 'schedule-working-hours'; 
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('doctors-panel/schedule-working-hours',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}

	public function fetch_dependent_datewise_data(){
	
		$selected_date  = $this->input->post("selected_date");      
		$future_date  = $this->input->post("future_date");      
		 
		$model_response = $this->Mastermodel->master_get('slot_management','week_days ="'.$selected_date.'"', '*');  
		//echo $this->db->last_query(); die;  
		 $encoded_date=base64_encode(date("d/m/Y", strtotime($future_date)));  
		if($model_response){  
			$i=1;   
		 
			foreach($model_response as $wl) {     
			?>          
			 <tr>
                  <td> <?=date("d/m/Y", strtotime($future_date));?></td>            
                  <td> <?=$wl['availability']?></td>
                  <td><?=$wl['start_time']?></td>       
                  <td> <?=$wl['end_time']?></td>               
                  <td>  
                    <a href="<?=base_url('/doctors/update-sm/'.$wl['id'].'/'.$encoded_date)?>" class="btn btn-primary modal-btn" title="Edit"><i class="bi bi-pen"></i></a>
                    <a href="<?=base_url('/doctors/delete-sm/'.$wl['id'])?>" class="btn btn-danger modal-btn" title="Delete"><i class="bi bi-trash"></i></a>
                  </td>
                </tr>   
		  <?php                   
		  	  }
			}else{ ?>
				<tr>    
			<td>No Data </td>   
			</tr>   
				<?php
			}   

	}
	
	 public function update_sw(){
            
            $usertype = $this->session->userdata('type');
            $userid = $this->session->userdata('user_id');
            $this->db->where('user_id',$userid); 
            $data['doctor_info_edit']=$this->db->get('tbl_doctors')->row_array();    
            $data['doctor_info'] = $this->doctor_model->get_doctors_list($userid); 
        
            
            if(isset($_POST['submit_schedule'])) {  
               
                extract($_POST);
                $post_data = array('start_time' => $start_time, 'end_time' => $end_time );   
                $model_res= $this->doctor_model->update("schedule_working",$post_data, $this->uri->segment(3));        
				redirect('doctors/schedule-working-hours','refresh');                          
            } 
            $edit_id= $this->uri->segment(3);    
            $data['update_sw']= $this->doctor_model->select_with_id($edit_id,"schedule_working");   
           
            
            $this->load->view('template/header',$data);
			$this->load->view('doctors-panel/schedule-working-hours',$data);
			$this->load->view('template/footer',$data);	
        }

        public function delete_sw(){
            $edit_id= $this->uri->segment(3);        
            $model_res= $this->doctor_model->delete("schedule_working", $edit_id);    
            if($model_res){
				redirect('doctors/schedule-working-hours','refresh'); 
            }       

        }
    //End Schedule Working    
	
	public function slot_management() {
		$uid = $this->session->userdata('user_id');
		$data['doctor_info_edit'] = $this->Mastermodel->master_get('tbl_doctors','user_id="'.$uid.'"', '*');
		$data['slot_management_list']= $this->doctor_model->select($uid,"slot_management");  
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('doctors-panel/slot-management',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function wallet() {
		$uid = $this->session->userdata('user_id');
		$data['doctor_info_edit'] = $this->Mastermodel->master_get('tbl_doctors','user_id="'.$uid.'"', '*');
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('doctors-panel/wallet',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	 public function update_sm(){  
         $usertype = $this->session->userdata('type');
        $userid = $this->session->userdata('user_id');
        $this->db->where('user_id',$userid); 
        $data['doctor_info_edit']=$this->db->get('tbl_doctors')->row_array();    
        $data['doctor_info'] = $this->doctor_model->get_doctors_list($userid); 
        if(isset($_POST['submit_slot'])) {         
            extract($_POST);
            $post_data = array('user_id'=>$userid, 'availability' => $availability, 'start_time' => $start_time, 'end_time' => $end_time );   
            $model_res= $this->doctor_model->update("slot_management",$post_data, $this->uri->segment(3));        
			redirect('doctors/slot-management','refresh');        
        }
        $edit_id= $this->uri->segment(3);    
        $data['update_sw']= $this->doctor_model->select_with_id($edit_id,"slot_management");  
        $this->load->view('template/header',$data);
		$this->load->view('doctors-panel/slot-management',$data);
		$this->load->view('template/footer',$data);	
    }

    public function delete_sm(){
        $edit_id= $this->uri->segment(3);        
        $model_res= $this->doctor_model->delete("slot_management", $edit_id);    
        if($model_res){
			redirect('doctors/slot-management','refresh');     
        }         

    }

	public function delete_all_appointments(){
        $userid = $this->session->userdata('user_id');
        $model_res= $this->doctor_model->delete_all("slot_management",$userid);           
        if($model_res){
			redirect('doctors/slot-management','refresh');                     
		} 
    }
	
	
	public function profile() {
		$uid = $this->session->userdata('user_id');
		$data['doctor_info_edit'] = $this->Mastermodel->master_get('tbl_doctors','user_id="'.$uid.'"', '*');
		//echo '<pre>'; print_r($data['doctor_info_edit']);exit;
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('doctors-panel/profile',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	
	public function edit_profile() {
		$uid = $this->session->userdata('user_id');
		$data['doctor_info_edit'] = $this->Mastermodel->master_get('tbl_doctors','user_id="'.$uid.'"', '*');
		
		$data['specialityData'] = $this->Mastermodel->master_get('tbl_speciality','status="'.'1'.'"', '*');
		
		//echo '<pre>'; print_r($data['specialityData']);exit;
		
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('doctors-panel/edit-profile',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	
	public function profile_update()
    {
        $uid = $this->session->userdata('user_id');
        $name = $this->session->userdata('name');
        $email = $this->session->userdata('email');
        
        $this->db->where('user_id',$uid);     
        $doctor_info_edit = $this->db->get('tbl_doctors')->row_array();
        //print_r($doctor_info_edit); exit;
        
            $frmData = $this->input->post();
            //echo '<pre>'; print_r($frmData); exit;
            $formdata['name']= $name;
            $formdata['emailid']= $email;
            $formdata['father_name']= $frmData['father_name'];
            $formdata['marital_status']= $frmData['marital_status'];
            $formdata['blood_group']= $frmData['blood_group'];
            $formdata['gender']= $frmData['gender'];
            $formdata['birth_date']= $frmData['birth_date'];
            $formdata['contact_no']= $frmData['contact_no'];
            $formdata['specialization']= $frmData['specialization'];
            $formdata['current_address']= $frmData['current_address'];
            $formdata['permanent_address']= $frmData['permanent_address'];
            $formdata['qualification']= $frmData['qualification'];
            $formdata['work_experience']= $frmData['work_experience'];
            $formdata['pan_number']= $frmData['pan_number'];
            $formdata['aadhar_number']= $frmData['aadhar_number'];
            $formdata['basic_salary']= $frmData['basic_salary'];
            $formdata['contract_type']= $frmData['contract_type'];
            $formdata['your_self']= $frmData['your_self'];
            $formdata['bank_branch_name']= $frmData['bank_branch_name'];
            $formdata['account_title']= $frmData['account_title'];
            $formdata['bank_account']= $frmData['bank_account'];
            $formdata['bank_name']= $frmData['bank_name'];
            $formdata['ifsc_code']= $frmData['ifsc_code'];
            $formdata['created_at']= date("Y-m-d h:i:s");
            
            if($doctor_info_edit < 1){
                $formdata['user_id']= $uid;
            }   
            
            //echo '<pre>'; print_r($formdata); exit;
            
            if (@$_FILES['photo']['size'] != 0) {
	            $upload_dir = 'img/doctor_upload/';
	            if (!is_dir($upload_dir)) {
	                mkdir($upload_dir);
	            }
	            $config['upload_path'] = $upload_dir;
	            $config['allowed_types'] = 'jpg|jpeg|png';
	            $farray3 = explode(".", $_FILES["photo"]["name"]);

	            $config['file_name'] = basename(substr(md5(rand()), 0, 10) . time() . '.' . $farray3[1]);
	            $config['overwrite'] = false;
	            $this->load->library('upload', $config);
				$this->upload->initialize($config);
	            if (!$this->upload->do_upload('photo')) {
	                $error = array('error' => $this->upload->display_errors());
	            } else {
	                $this->upload_data['photo'] = $this->upload->data();
	                $profile_image = $this->upload_data['photo'];
					$formdata['photo'] = $profile_image['file_name'];
	            }
	        }
            
           
	        
	        if (@$_FILES['signature']['size'] != 0) {
	            $upload_dir = 'img/doctor_upload/';
	            if (!is_dir($upload_dir)) {
	                mkdir($upload_dir);
	            }
	            $config['upload_path'] = $upload_dir;
	            $config['allowed_types'] = 'jpg|jpeg|png';
	            $farray3 = explode(".", $_FILES["signature"]["name"]);

	            $config['file_name'] = basename(substr(md5(rand()), 0, 10) . time() . '.' . $farray3[1]);
	            $config['overwrite'] = false;
	            $this->load->library('upload', $config);
				$this->upload->initialize($config);
	            if (!$this->upload->do_upload('signature')) {
	                $error = array('error' => $this->upload->display_errors());
	            } else {
	                $this->upload_data['signature'] = $this->upload->data();
	                $profile_image = $this->upload_data['signature'];
					$formdata['signature'] = $profile_image['file_name'];
					$formdata['signature_date']= date("d-m-Y h:i:s");
	            }
	        }
	        
	        
	        if (@$_FILES['joining_letter']['size'] != 0) {
	            $upload_dir = 'img/doctor_upload/';
	            if (!is_dir($upload_dir)) {
	                mkdir($upload_dir);
	            }
	            $config['upload_path'] = $upload_dir;
	            $config['allowed_types'] = 'jpg|jpeg|png';
	            $farray3 = explode(".", $_FILES["joining_letter"]["name"]);

	            $config['file_name'] = basename(substr(md5(rand()), 0, 10) . time() . '.' . $farray3[1]);
	            $config['overwrite'] = false;
	            $this->load->library('upload', $config);
				$this->upload->initialize($config);
	            if (!$this->upload->do_upload('joining_letter')) {
	                $error = array('error' => $this->upload->display_errors());
	            } else {
	                $this->upload_data['joining_letter'] = $this->upload->data();
	                $profile_image = $this->upload_data['joining_letter'];
					$formdata['joining_letter'] = $profile_image['file_name'];
					$formdata['joining_date']= date("d-m-Y h:i:s");
	            }
	        }
	        
	        
	        if (@$_FILES['other_document']['size'] != 0) {
	            $upload_dir = 'img/doctor_upload/';
	            $config['upload_path'] = $upload_dir;
	            $config['allowed_types'] = 'jpg|jpeg|png';
	            $farray3 = explode(".", $_FILES["other_document"]["name"]);

	            $config['file_name'] = basename(substr(md5(rand()), 0, 10) . time() . '.' . $farray3[1]);
	            $config['overwrite'] = false;
	            $this->load->library('upload', $config);
				$this->upload->initialize($config);
	            if (!$this->upload->do_upload('other_document')) {
	                $error = array('error' => $this->upload->display_errors());
	            } else {
	                $this->upload_data['other_document'] = $this->upload->data();
	                $profile_image = $this->upload_data['other_document'];
					$formdata['other_document'] = $profile_image['file_name'];
					$formdata['document_date']= date("d-m-Y h:i:s");
	            }
	        }
	        

            
            if($doctor_info_edit > 0){
                $model_res = $this->Mastermodel->master_update('tbl_doctors',$formdata,'user_id='.$uid);
                
                if($model_res > 0) {             
                    redirect(base_url('doctors/profile'));
                }else {
                    redirect(base_url('doctors/edit-profile'));        
                }
                
            }else{
                
                $model_res = $this->Mastermodel->master_insert('tbl_doctors',$formdata);
                if($model_res > 0) {             
                    redirect(base_url('doctors/profile'));
                }else {
                    redirect(base_url('doctors/edit-profile'));        
                }
                
            } 

           
        //redirect(base_url('doctors-panel/edit-profile'));     
    }


    public function update_column_profile($ciid){
        
        if($ciid ==1){
           	$formdata['signature']= ''; 
        }
        if($ciid ==2){
           	$formdata['joining_letter']= ''; 
        }
        
        if($ciid ==3){
            $formdata['other_document']= '';
        }
        
        $uid = $this->session->userdata('user_id');
        $model_res = $this->Mastermodel->master_update('tbl_doctors',$formdata,'user_id='.$uid);
        if($model_res > 0){
            redirect(base_url('doctors/profile/'));  
        }else{
            alert("Deletion Failed");                    
        }

    }
    
	public function setting() {
		$uid = $this->session->userdata('user_id');
		$data['doctor_info_edit'] = $this->Mastermodel->master_get('tbl_doctors','user_id="'.$uid.'"', '*');
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('doctors-panel/setting',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function support_ticket() {
		$uid = $this->session->userdata('user_id');
		$data['doctor_info_edit'] = $this->Mastermodel->master_get('tbl_doctors','user_id="'.$uid.'"', '*');
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('doctors-panel/wallet',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	

}

?>
