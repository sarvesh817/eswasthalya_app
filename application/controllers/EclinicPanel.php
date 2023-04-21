<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EclinicPanel extends MY_Controller {

	public function __construct(){
	   parent::__construct();
	   date_default_timezone_set('Asia/Kolkata');
	   $this->load->model('Homemodel','',TRUE);
	   $this->load->model('Mastermodel','',TRUE);    
	}
	 
	public function index() {
        $data['header_title'] = 'Eclinic Dashboard';
		$uid = $this->session->userdata('user_id');
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/dashboard',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}

	public function profile() {
		$uid = $this->session->userdata('user_id');
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		//echo '<pre>'; print_r($data['eclinic_info_edit']); exit;
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/profile',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	
	public function edit_profile() {
		$uid = $this->session->userdata('user_id');
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		//echo '<pre>'; print_r($data['eclinic_info_edit']); exit;
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/edit-profile',$data);
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
        $contact = $this->session->userdata('userContact');
        $this->db->where('user_id',$uid);     
        $eclinic_info_edit = $this->db->get('tbl_eclinic')->row_array();
        //print_r($eclinic_info_edit); exit;
        
            $frmData = $this->input->post();
            //echo '<pre>'; print_r($frmData); exit;
            $formdata['name']= $name;
            $formdata['emailid']= $email;
            $formdata['contact']= $contact;
            $formdata['facilities']= $frmData['facilities'];
            $formdata['qualification']= $frmData['qualification'];
            $formdata['experience']= $frmData['experience'];
            $formdata['pancard']= $frmData['pancard'];
            $formdata['adhaar_card']= $frmData['adhaar_card'];
            $formdata['website']= $frmData['website'];
            $formdata['franchisee_validity']= $frmData['franchisee_validity'];
            $formdata['address']= $frmData['address'];
            $formdata['about']= $frmData['about'];
            $formdata['account_holder']= $frmData['account_holder'];
            $formdata['account_number']= $frmData['account_number'];
            $formdata['bank_name']= $frmData['bank_name'];
            $formdata['ifsc_code']= $frmData['ifsc_code'];
            
            $formdata['created_at']= date("Y-m-d h:i:s");
            if($eclinic_info_edit < 1){
                $formdata['user_id']= $uid;
            }   
            
            //echo '<pre>'; print_r($formdata); exit;
            
            if (@$_FILES['photo']['size'] != 0) {
	            $upload_dir = 'img/eclinic_upload/';
	            if (!is_dir($upload_dir)) {
	                mkdir($upload_dir);
	            }
	            $config['upload_path'] = $upload_dir;
	            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
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
	        
	        if (@$_FILES['franchisee']['size'] != 0) {
	            $upload_dir = 'img/eclinic_upload/';
	            if (!is_dir($upload_dir)) {
	                mkdir($upload_dir);
	            }
	            $config['upload_path'] = $upload_dir;
	            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
	            $farray3 = explode(".", $_FILES["franchisee"]["name"]);

	            $config['file_name'] = basename(substr(md5(rand()), 0, 10) . time() . '.' . $farray3[1]);
	            $config['overwrite'] = false;
	            $this->load->library('upload', $config);
				$this->upload->initialize($config);
	            if (!$this->upload->do_upload('franchisee')) {
	                $error = array('error' => $this->upload->display_errors());
	            } else {
	                $this->upload_data['franchisee'] = $this->upload->data();
	                $profile_image = $this->upload_data['franchisee'];
					$formdata['franchisee'] = $profile_image['file_name'];
					$formdata['franchisee_date']= date("Y-m-d h:i:s");
	            }
	        }
	        
	        
	        if (@$_FILES['qualification_documents']['size'] != 0) {
	            $upload_dir = 'img/eclinic_upload/';
	            if (!is_dir($upload_dir)) {
	                mkdir($upload_dir);
	            }
	            $config['upload_path'] = $upload_dir;
	            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
	            $farray3 = explode(".", $_FILES["qualification_documents"]["name"]);

	            $config['file_name'] = basename(substr(md5(rand()), 0, 10) . time() . '.' . $farray3[1]);
	            $config['overwrite'] = false;
	            $this->load->library('upload', $config);
				$this->upload->initialize($config);
	            if (!$this->upload->do_upload('qualification_documents')) {
	                $error = array('error' => $this->upload->display_errors());
	            } else {
	                $this->upload_data['qualification_documents'] = $this->upload->data();
	                $profile_image = $this->upload_data['qualification_documents'];
					$formdata['qualification_documents'] = $profile_image['file_name'];
					$formdata['qua_documents_date']= date("Y-m-d h:i:s");
	            }
	        }
	        
	        
	        if (@$_FILES['ownership']['size'] != 0) {
	            $upload_dir = 'img/eclinic_upload/';
	            $config['upload_path'] = $upload_dir;
	            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
	            $farray3 = explode(".", $_FILES["ownership"]["name"]);

	            $config['file_name'] = basename(substr(md5(rand()), 0, 10) . time() . '.' . $farray3[1]);
	            $config['overwrite'] = false;
	            $this->load->library('upload', $config);
				$this->upload->initialize($config);
	            if (!$this->upload->do_upload('ownership')) {
	                $error = array('error' => $this->upload->display_errors());
	            } else {
	                $this->upload_data['ownership'] = $this->upload->data();
	                $profile_image = $this->upload_data['ownership'];
					$formdata['ownership'] = $profile_image['file_name'];
					$formdata['ownership_date']= date("Y-m-d h:i:s");
	            }
	        }
            
            if($eclinic_info_edit > 0){
                $model_res = $this->Mastermodel->master_update('tbl_eclinic',$formdata,'user_id='.$uid);
                if($model_res > 0) {             
                    redirect(base_url('eclinic/profile'));
                }else {
                    redirect(base_url('eclinic/edit-profile'));        
                }
                
            }else{
                
                $model_res = $this->Mastermodel->master_insert('tbl_eclinic',$formdata);
                if($model_res > 0) {             
                    redirect(base_url('eclinic/profile'));
                }else {
                    redirect(base_url('eclinic/edit-profile'));        
                }
            } 
        //redirect(base_url('doctors-panel/edit-profile'));     
    }
    
    public function update_column_profile($ciid){
        
        if($ciid ==1){
           	$formdata['franchisee']= ''; 
        }
        if($ciid ==2){
           	$formdata['qualification_documents']= ''; 
        }
        
        if($ciid ==3){
            $formdata['ownership']= '';
        }
        
        $uid = $this->session->userdata('user_id');
        $model_res = $this->Mastermodel->master_update('tbl_eclinic',$formdata,'user_id='.$uid);
        if($model_res > 0){
            redirect(base_url('eclinic/profile/'));  
        }else{
            alert("Deletion Failed");                    
        }

    }
    
    public function patient_dashboard() {
		$uid = $this->session->userdata('user_id');
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/patient-dashboard',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function patient_new_register() {
		$uid = $this->session->userdata('user_id');
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/new-register',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
    
    public function consultation_history() {
		$uid = $this->session->userdata('user_id');
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/consultation-history',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function single_patient() {
		$uid = $this->session->userdata('user_id');
		$pid = $this->uri->segment(3);
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		$data['patient_details'] = $this->db->where('id',$pid)->where('user_id',$uid)->get('tbl_patient')->row();
		
		$data['appointment_data'] = $this->Mastermodel->master_get('tbl_book_appointment','patient_id="'.$pid.'"', '*');
		
		//echo '<pre>'; print_r($data['appointment_data']);exit;
		
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/single-patient',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function patient_medical_history_details() {
	    
		$uid = $this->session->userdata('user_id');
		$pid = $this->uri->segment(3);

		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"  ', '*');
		
		$data['patient_details'] = $this->db->where('id',$pid)->where('user_id',$uid)->get('tbl_patient')->row();
		
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/patient-medical-history-details',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function savePmhData(){
	    
        $userid = $this->session->userdata('user_id');
        $SaveData['user_id'] = $userid;
        $pid = $this->input->post('pid');
        $checkpatientHistory = $this->db->where('pid',$pid)->where('user_id',$userid)->get('tbl_patient_medical_history')->row();
        
        //echo '<pre>'; print_r($checkpatientHistory);exit;

        $SaveData['form_json_data'] = json_encode($this->input->post());
        
        $SaveData['smoking'] = $this->input->post('smoking');
        $SaveData['alcohol'] = $this->input->post('alcohol');
        $SaveData['sleep'] = $this->input->post('sleep');
        $SaveData['allergy'] = $this->input->post('allergy');
        $SaveData['bowel_bladder_habits'] = $this->input->post('bowel_bladder_habits');
        $SaveData['appetite'] = $this->input->post('appetite'); 
        
        $SaveData['breathlessness1'] = $this->input->post('breathlessness1');
        $SaveData['palpitations'] = $this->input->post('palpitations');
        $SaveData['chest_pain'] = $this->input->post('chest_pain');
        $SaveData['fainting1'] = $this->input->post('fainting1');
        $SaveData['ankle_edema'] = $this->input->post('ankle_edema');
        
        $SaveData['headache'] = $this->input->post('headache');
        $SaveData['dizziness'] = $this->input->post('dizziness');
        $SaveData['fainting2'] = $this->input->post('fainting2');
        $SaveData['tremors'] = $this->input->post('tremors');
        $SaveData['seizure'] = $this->input->post('seizure');
        $SaveData['tinnitus'] = $this->input->post('tinnitus');
        $SaveData['deafness'] = $this->input->post('deafness');
        $SaveData['vision_loss'] = $this->input->post('vision_loss');
        $SaveData['memory_loss'] = $this->input->post('memory_loss');
        
        $SaveData['joint_pain'] = $this->input->post('joint_pain');
        $SaveData['immobility'] = $this->input->post('immobility');
        $SaveData['redness'] = $this->input->post('redness');
        $SaveData['swelling1'] = $this->input->post('swelling1');
        
        $SaveData['multiple_sexual_partners'] = $this->input->post('multiple_sexual_partners');
        $SaveData['libido'] = $this->input->post('libido');
        $SaveData['burning_micturition'] = $this->input->post('burning_micturition');
        $SaveData['painful_micturition'] = $this->input->post('painful_micturition');
        $SaveData['overactive_bladder'] = $this->input->post('overactive_bladder');
        $SaveData['incontinence'] = $this->input->post('incontinence');
        $SaveData['bloody_urine'] = $this->input->post('bloody_urine');
        $SaveData['lmp'] = $this->input->post('lmp');
        $SaveData['white_discharge'] = $this->input->post('white_discharge');
        $SaveData['foul_smelling_secretions'] = $this->input->post('foul_smelling_secretions');
        $SaveData['itching'] = $this->input->post('itching');
        $SaveData['periods_duration'] = $this->input->post('periods_duration');
        $SaveData['dysmenorrhoea'] = $this->input->post('dysmenorrhoea');
        $SaveData['painful_coitus'] = $this->input->post('painful_coitus');
        
        $SaveData['heartburn'] = $this->input->post('heartburn');
        $SaveData['acidity'] = $this->input->post('acidity');
        $SaveData['nausea'] = $this->input->post('nausea');
        $SaveData['vomiting'] = $this->input->post('vomiting');
        $SaveData['pain_abdomen'] = $this->input->post('pain_abdomen');
        $SaveData['indigestion'] = $this->input->post('indigestion');
        $SaveData['change_stool_color'] = $this->input->post('change_stool_color');
        
        $SaveData['cough'] = $this->input->post('cough');
        $SaveData['blood_sputum'] = $this->input->post('blood_sputum');
        $SaveData['breathlessness2'] = $this->input->post('breathlessness2');
        $SaveData['painful_breathing'] = $this->input->post('painful_breathing');
        
        $SaveData['heat_intolerance'] = $this->input->post('heat_intolerance');
        $SaveData['cold_intolerance'] = $this->input->post('cold_intolerance');
        $SaveData['heavy_sweating'] = $this->input->post('heavy_sweating');
        $SaveData['polydypsia'] = $this->input->post('polydypsia');
        $SaveData['polyuria'] = $this->input->post('polyuria');
        
        $SaveData['mental_state'] = $this->input->post('mental_state');
        $SaveData['cyanosis'] = $this->input->post('cyanosis');
        $SaveData['clubbing'] = $this->input->post('clubbing');
        $SaveData['pallor'] = $this->input->post('pallor');
        $SaveData['icterus'] = $this->input->post('icterus');
        $SaveData['lymphadenopathy'] = $this->input->post('lymphadenopathy');
        $SaveData['edema'] = $this->input->post('edema');
        $SaveData['bodybuilt'] = $this->input->post('bodybuilt');
        $SaveData['gait'] = $this->input->post('gait');
        $SaveData['height'] = $this->input->post('height');
        $SaveData['weight'] = $this->input->post('weight');
        
        $SaveData['temperature'] = $this->input->post('temperature');
        $SaveData['pulse'] = $this->input->post('pulse');
        $SaveData['blood_pressure'] = $this->input->post('blood_pressure');
        $SaveData['respiratory_rate'] = $this->input->post('respiratory_rate');
        $SaveData['rbs'] = $this->input->post('rbs');
        $SaveData['sp02'] = $this->input->post('sp02');
        
        $SaveData['pulse2'] = $this->input->post('pulse2');
        $SaveData['heart_sounds'] = $this->input->post('heart_sounds');
        $SaveData['jvp'] = $this->input->post('jvp');
        $SaveData['chest_wall'] = $this->input->post('chest_wall');
        $SaveData['engorged_veins'] = $this->input->post('engorged_veins');
        
        $SaveData['chest_shape'] = $this->input->post('chest_shape');
        $SaveData['chest_movement'] = $this->input->post('chest_movement');
        $SaveData['auscultation'] = $this->input->post('auscultation');
        $SaveData['percussion1'] = $this->input->post('percussion1');
        $SaveData['trachea_position'] = $this->input->post('trachea_position');
        $SaveData['vocal_fremitus'] = $this->input->post('vocal_fremitus');
        
        $SaveData['palpation'] = $this->input->post('palpation');
        $SaveData['percussion2'] = $this->input->post('percussion2');
        $SaveData['ascitis'] = $this->input->post('ascitis');
        $SaveData['splenomegaly'] = $this->input->post('splenomegaly');
        $SaveData['hepatomegaly'] = $this->input->post('hepatomegaly');
        $SaveData['tenderness'] = $this->input->post('tenderness');
        $SaveData['hernia1'] = $this->input->post('hernia1');
        $SaveData['skin_changes'] = $this->input->post('skin_changes');
        $SaveData['swelling2'] = $this->input->post('swelling2');
        
        $SaveData['skin_changes1'] = $this->input->post('skin_changes1');
        $SaveData['phimosis'] = $this->input->post('phimosis');
        $SaveData['paraphimosis'] = $this->input->post('paraphimosis');
        $SaveData['hypospadias'] = $this->input->post('hypospadias');
        $SaveData['hernia2'] = $this->input->post('hernia2');
        
        $SaveData['skin_changes2'] = $this->input->post('skin_changes2');
        $SaveData['joint_swelling'] = $this->input->post('joint_swelling');
        $SaveData['tenderness'] = $this->input->post('tenderness');
        $SaveData['deformity'] = $this->input->post('deformity');
        $SaveData['restricted_mobility'] = $this->input->post('restricted_mobility');
        $SaveData['reflexes'] = $this->input->post('reflexes');
        
        $SaveData['speech'] = $this->input->post('speech');
        $SaveData['power_limbs'] = $this->input->post('power_limbs');
        $SaveData['touch_sensation'] = $this->input->post('touch_sensation');
        $SaveData['knee_jerk_reflex'] = $this->input->post('knee_jerk_reflex');
        $SaveData['ankle_reflex'] = $this->input->post('ankle_reflex');
        $SaveData['cranial_examination'] = $this->input->post('cranial_examination');
        
        $SaveData['created_at'] = date("Y-m-d h:i:s");
        
        //echo '<pre>'; print_r($SaveData); exit;
        
        if(!empty($checkpatientHistory) && $checkpatientHistory != false){
            
            $pmh_id = $checkpatientHistory->pmh_id;
            $model_res = $this->Mastermodel->master_update('tbl_patient_medical_history',$SaveData,'pmh_id='.$pmh_id);
            //$model_res = $this->Mastermodel->master_insert('tbl_patient_medical_history',$SaveData);
            if($model_res){
                $response = array('status'=>'1','msg'=>'Records has been updated successfully.','pid'=>$pid);
    		}else{
    			$response = array('status'=>'0','msg'=>'Problem in data update error.');
    		}
            
        }else{
            
            $SaveData['pid'] = $this->input->post('pid');
            
            $model_res = $this->Mastermodel->master_insert('tbl_patient_medical_history',$SaveData);
            if($model_res){
                $response = array('status'=>'1','msg'=>'Records has been added successfully.','pid'=>$pid);
    		}else{
    			$response = array('status'=>'0','msg'=>'Problem in data add error.');
    		}
        }

		echo json_encode($response); exit();
		
    } 
	
    public function appointments() {
		$uid = $this->session->userdata('user_id');
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		$data['appoint_list'] = $this->Mastermodel->master_get('tbl_book_appointment','user_id="'.$uid.'"', '*');
		$data['specialization_list'] = $this->Mastermodel->master_get('tbl_speciality','status=1', '*');  
		
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/appointments',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	 public function book_new_appointment() {
		$uid = $this->session->userdata('user_id');

		if(isset($_POST['submit_book_appoint'])){
					extract($_POST);
					$created_at=date('m/d/Y');      
					$get_day= $this->db->where('id',$slot_id)->get('slot_management')->row_array();
					if($get_day['week_days']==date('l')){
						$app_date=date('d/m/Y');       
					}else{
						$app_date=date('Y/m/d', strtotime($get_day['week_days']));      
					}  
					$formdata=array('week_days'=>$get_day['week_days'],'appointment_date'=>$app_date,'user_id'=>$uid,'speciality'=>$speciality,'doctor_id'=>$doctor_id,'slot_id'=>$slot_id,'patient_id'=>$patient_id,'patient_name'=>$patient_name,'created_at'=>$created_at);     
					$model_res = $this->Mastermodel->master_insert('tbl_book_appointment',$formdata);         
					if($model_res > 0) {             
						redirect(base_url('eclinic/appointments'));
					}else {
						redirect(base_url('eclinic/book-new-appointment'));           
					}

		}
  
		$uid = $this->session->userdata('user_id');
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		$data['slot_list'] = $this->Mastermodel->master_get('slot_management','', '*');
		$data['slot_list_wd'] = $this->Mastermodel->master_get('slot_management','', 'week_days');
		
		//$data['specialization_list'] = $this->Mastermodel->master_get('tbl_speciality','status','1');
		$data['specialization_list'] = $this->Mastermodel->master_get('tbl_speciality','status=1', '*'); 
			
	//	echo $this->db->last_query(); die; 
		if(!empty($this->session->userdata('user_id'))) {  
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/book-new-appointment',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function fetch_dependent_doctors()   
    {
        $speciality_val = $this->input->post("speciality_val"); 
        //$model_response = $this->Mastermodel->master_get('tbl_doctors','user_type="DOCTOR"', '*');
		$model_response = $this->Mastermodel->master_get('tbl_doctors','specialization="'.$speciality_val.'"', '*'); 
		
		
		/*$this->db->select("chat.id,chat.name,chat.email,chat.phone,chat.date,post.post");
          $this->db->from('user as urs');
          $this->db->join('tbl', 'chat.id = post.id');
          $query = $this->db->get();
    
        if($query->num_rows() != 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }*/

        if(!empty($model_response)){
			echo "<option value=''> Please Select Doctors</option>";            
           foreach ($model_response as $mr) {
            echo "<option   value='" . $mr['user_id'] . "'>" . $mr['name'] . "</option>";         
           } 
        }else{
            echo "<option value=''> Select Doctors</option>";
        }
		//echo $this->db->last_query(); die;    
        
    }

	public function fetch_dependent_slots(){
		$user_id=$_POST['user_id'];  
		$slot_list = $this->Mastermodel->master_get('slot_management','user_id="'.$user_id.'"', '*'); 
		if(!empty($slot_list)){
			 ?>
				 
				<?php 
				if(isset($slot_list) && $slot_list !=''){ 
				$i=1; 
				foreach($slot_list  as $sl) {
					$today_date=date('d/m/Y');
					$i++;
					if($sl['week_days'] == date('l')){                  
					?>
					<input type="radio" id="<?=$i?>_slot" class="weekday" name="slot_id"      
						value="<?=$sl['id']?>"/>        
					<label for="<?=$i?>_slot"><?php echo $sl['start_time'];?> - <?php echo $sl['end_time'];?></label>      
					<?php
					}   
					}
					} ?>     

				 
			 <?php 
        }else{
            echo "<center><b>Slots not available</b></option>";      
        }
	}


	public function fetch_dependent_slots_other()   
    {
		$doctor_id  = $this->input->post("doctor_id");      
		if($_POST['date_range']){
			$date_range  = $this->input->post("date_range");     
			$date_exploded=explode("-",$date_range); 
			$start_date=trim($date_exploded[0]);  
			$end_date=trim($date_exploded[1]);           
			$timestamp=date("Y-m-d", strtotime($start_date));        
			@$find_start_week_day=date('l', strtotime($timestamp));    
			$timestamp2=date("Y-m-d", strtotime($end_date));     
		    @$find_end_week_day=date('l', strtotime($timestamp2));  
			
			if(@$find_start_week_day<$find_end_week_day){
				$slot_list = $this->Mastermodel->master_get('slot_management','user_id='.$doctor_id.' and week_days between "'.$find_start_week_day.'" AND "'.$find_end_week_day.'"', '*');  
			}else{
				$slot_list = $this->Mastermodel->master_get('slot_management','user_id='.$doctor_id.' and week_days between "'.$find_end_week_day.'" AND "'.$find_start_week_day.'"', '*');  
			}
		//echo $this->db->last_query(); die;                 
		}
		if($slot_list){

			if(isset($slot_list) && $slot_list !=''){  
				$Monday=array();
				$Tuesday=array();
				 $Wednesday=array();
				  $Thrusday=array();
				   $Friday=array();
					$Saturday=array();
					 $Sunday=array();
					 $j=1;
		  foreach($slot_list  as $sl) {
			$today_date=date("d/m/Y");
			  $j++;
			 
			  
				   if ($sl['week_days']=="Monday") {
$Monday[] .="<input type='radio' id='<?=$j?>_slot' class='weekday' name='slot_id' value='".$sl['id']."'><label for='<?=$j?>_slot'>".$sl['start_time']."-".$sl['end_time']."</label>";
				   } else if($sl['week_days']=="Tuesday"){
	  
$Tuesday[] .="<input type='radio' id='<?=$j?>_slot' class='weekday' name='slot_id' value='".$sl['id']."'><label for='<?=$j?>_slot'>".$sl['start_time']."-".$sl['end_time']."</label>";

				   }else if($sl['week_days']=="Wednesday"){
				   
$Wednesday[] .="<input type='radio' id='<?=$j?>_slot' class='weekday' name='slot_id' value='".$sl['id']."'><label for='<?=$j?>_slot'>".$sl['start_time']."-".$sl['end_time']."</label>";
				   }else if($sl['week_days']=="Thrusday"){
$Thrusday[] .="<input type='radio' id='<?=$j?>_slot' class='weekday' name='slot_id' value='".$sl['id']."'><label for='<?=$j?>_slot'>".$sl['start_time']."-".$sl['end_time']."</label>";
				   }else if($sl['week_days']=="Friday"){
$Friday[] .="<input type='radio' id='<?=$j?>_slot' class='weekday' name='slot_id' value='".$sl['id']."'><label for='<?=$j?>_slot'>".$sl['start_time']."-".$sl['end_time']."</label>";
				   } else if($sl['week_days']=="Saturday"){
$Saturday[] .="<input type='radio' id='<?=$j?>_slot' class='weekday' name='slot_id' value='".$sl['id']."'><label for='<?=$j?>_slot'>".$sl['start_time']."-".$sl['end_time']."</label>";
				   }else if($sl['week_days']=="Sunday"){
$Sunday[] .="<input type='radio' id='<?=$j?>_slot' class='weekday' name='slot_id' value='".$sl['id']."'><label for='<?=$j?>_slot'>".$sl['start_time']."-".$sl['end_time']."</label>";
				   }
			   
			}
		  }
			 


?>


		  <div class="row"> 
		  <?php if(!empty($Monday)){ ?>  
		 <label><b>Monday</b></label>  
		  <?php 
		  
		  foreach($Monday as $md){
				 
				 echo $md;
			  
		  } } ?>
		  
		  <?php if(!empty($Tuesday)){ ?>
		 <label><b>Tuesday</b></label>  
		  <?php 
		  
		  foreach($Tuesday as $ts){
				 
				 echo $ts;
			  
		  } } ?>
		  
		  
		  <?php if(!empty($Wednesday)){ ?>
		 <label><b>Wednesday</b></label>  
		  <?php 
		  
		  foreach($Wednesday as $wednes){
				 
				 echo $wednes;
			  
		  } } ?>
		  
		  
		  <?php if(!empty($Thrusday)){ ?>
		 <label><b>Thursday</b></label>  
		  <?php 
		  
		  foreach($Thrusday as $thrus){
				 
				 echo $thrus;
			  
		  } } ?>
		  
		  
		  <?php if(!empty($Friday)){ ?>
		 <label><b>Friday</b></label>  
		  <?php 
		  
		  foreach($Friday as $frid){
				 
				 echo $frid;
			  
		  } } ?>
		  
		  
		  <?php if(!empty($Saturday)){ ?>
		 <label><b>Saturday</b></label>  
		  <?php 
		  
		  foreach($Saturday as $satur){
				 
				 echo $satur;
			  
		  } } ?>
		  
		  <?php if(!empty($Sunday)){ ?>
		 <label><b>Sunday</b></label>  
		  <?php 
		  
		  foreach($Sunday as $sunday){
				 
				 echo $sunday;
			  
		  } } ?>
	   </div>  
			          
		 
		  <?php                   
		  	 
			}else{ ?>
				<tr>    
			<td>No Data </td>   
			</tr>   
				<?php
			}   
    }

	

	public function fetch_dependent_appointment()   
    {
		$doctor_id  = $this->input->post("doctor_id");      
		if($_POST['date_range']){
			$date_range  = $this->input->post("date_range");     
			$date_exploded=explode("-",$date_range); 
			$start_date=trim($date_exploded[0]);    
			$end_date=trim($date_exploded[1]);           
			$model_response = $this->Mastermodel->master_get('tbl_book_appointment','created_at between "'.$start_date.'" AND "'.$end_date.'"', '*');  
			//echo $this->db->last_query(); die;  
		}else{
			$model_response = $this->Mastermodel->master_get('tbl_book_appointment','doctor_id ='.$doctor_id.'', '*');  
		}
		if($model_response){
			$i=1;   
		foreach ($model_response as $al) {
			$this->db->where('user_id',$al['doctor_id']);                
			$fetch_doctor=$this->db->get('user')->row_array();  
			$this->db->where('id',$al['slot_id']);                  
			$fetch_slot=$this->db->get('slot_management')->row_array(); 
			?>          
			<tr>    
			<td><?=$i++?></td>
			<td><a href="<?php echo base_url(); ?>eclinic/single-patient" data-bs-toggle="modal" data-bs-target="#otpstaticBackdrop">PID00<?=$al['patient_id']?></a></td>
			<td><?=$al['patient_name']?></td>
			<td><?=$fetch_doctor['name']?></td>  
			<td><?=$al['speciality']?></td>
			<td>APP00<?=$al['id']?></td>
			<td><?=$fetch_slot['start_time'].'-'.$fetch_slot['end_time']?></td>               
			<td><span class="status-info btn btn-warning">Pending</span></td>
			<td>
			  <a href="#" class="btn btn-primary modal-btn" data-bs-toggle="tooltip" title="View Invoice"><i class="fa-solid fa-video"></i> Connect Dr.</a>
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

	public function fetch_dependent_patient(){
		$pid  = $this->input->post("pid"); 
		$model_response = $this->Mastermodel->master_get('tbl_patient','id ='.$pid.'', '*');
		$fourRandomDigit = mt_rand(1000,9999);
		
		if($model_response){
		    
		    $formdata['mobile_otp_verification'] =$fourRandomDigit;
		    $model_res = $this->Mastermodel->master_update('tbl_patient',$formdata,'id='.$pid);
		    
            $response = array('success'=>'1','msg'=>'Verify successfully.','pid'=>$pid , 'pname'=>$model_response[0]['full_name'] , 'pmobile'=>$model_response[0]['mobile'],'otp'=>$fourRandomDigit);
		}else{
			$response = array('success'=>'0','msg'=>'Pid not exist !!!.','otp'=>$fourRandomDigit);
		}
		echo json_encode($response); exit();

	}
	
	
	public function sendPatientOTP(){
		$mobile  = $this->input->post("mobile");
		$fourRandomDigit = mt_rand(1000,9999);
		$formData['mobile_number'] =$mobile; 
		$formData['otp'] =$fourRandomDigit; 
		$formData['created_at'] = date("Y-m-d h:i:s"); 
		$model_res = $this->Mastermodel->master_insert('tbl_patient_otp_verification',$formData);
		if($model_res > 0){
            $response = array('success'=>'1','msg'=>'OTP Send Registered mobile Number '.$mobile,'otpid'=>$model_res,'otp'=>$fourRandomDigit);
		}else{
			$response = array('success'=>'0','msg'=>'Pid not exist !!!.');
		}
		echo json_encode($response); exit();
	}
	
	public function verifyPatientOTP(){
		$otpid  = $this->input->post("otpid");
		$otp  = $this->input->post("otp");

		$model_res = $this->Mastermodel->master_get('tbl_patient_otp_verification','id='.$otpid.' AND otp="'.$otp.'"', '*');
		
		if($model_res){
            $response = array('success'=>'1','msg'=>'Mobile Number Verified');
		}else{
			$response = array('success'=>'0','msg'=>'Something went wrong !!!.');
		}
		echo json_encode($response); exit();
	}
    
    
    public function wallet() {
		$uid = $this->session->userdata('user_id');
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/wallet',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function referral() {
		$uid = $this->session->userdata('user_id');
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/referral',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function add_new_referral() {
	   
		   
		$uid = $this->session->userdata('user_id');
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/add-new-referral',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function savenewreferralData(){
		  
        $userid = $this->session->userdata('user_id');

        if (@$_FILES['document']['size'] != 0) {
            $upload_dir = 'img/referral_documents/';
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
            $farray3 = explode(".", $_FILES["document"]["name"]);

            $config['file_name'] = basename(substr(md5(rand()), 0, 10) . time() . '.' . $farray3[1]);
            $config['overwrite'] = false;
            $this->load->library('upload', $config);
			$this->upload->initialize($config);
            if (!$this->upload->do_upload('document')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $this->upload_data['document'] = $this->upload->data();
                $profile_image = $this->upload_data['document'];
				$document = $profile_image['file_name'];
				
				$SaveData['document'] = $document;
            }
        }
        
        $SaveData['user_id'] = $userid;
        $SaveData['pid'] = $this->input->post('pid');
        $SaveData['purpose'] = $this->input->post('purpose');
        $SaveData['budget'] = $this->input->post('budget');
        $SaveData['refferal_type_id'] = $this->input->post('refferal_type_id');
        $SaveData['hospital'] = $this->input->post('hospital');
        $SaveData['created_at'] = date("Y-m-d h:i:s");
        $SaveData['type'] =$_POST['type'];
        
        
        //echo "<pre>"; print_r($SaveData); exit;

        $model_res = $this->Mastermodel->master_insert('tbl_referral',$SaveData);
        if($model_res){
            $response = array('status'=>'1','msg'=>'Records has been added successfully.');
		}else{
			$response = array('status'=>'0','msg'=>'Problem in data update.');
		}
		echo json_encode($response); exit();
		
    } 
    
 
	public function accounting() {
		$uid = $this->session->userdata('user_id');
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/accounting',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}

    public function medicine() {
		$uid = $this->session->userdata('user_id');
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/medicine',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function all_feedback() {
		$uid = $this->session->userdata('user_id');
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/all-feedback',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function add_feedback() {
		$uid = $this->session->userdata('user_id');
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/add-feedback',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
	}
	
	public function setting() {
		$uid = $this->session->userdata('user_id');
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/setting',$data);
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
	
	
	public function PatientSecVerify(){
        $userid = $this->session->userdata('user_id');
        parse_str($_POST['formdata'],$formdata);
        $pidd = $formdata['pid'];
        $pid =str_replace(array('PID0000','PID000','PID00','PID0','PID'), '', $pidd);
        $pin1 = $formdata['pin1'];
        $pin2 = $formdata['pin2'];
        $pin3 = $formdata['pin3'];
        $pin4 = $formdata['pin4'];
        $finalPin = $pin1.$pin2.$pin3.$pin4;
  
        $model_res = $this->db->where('id',$pid)->where('user_id',$userid)->where('secret_pin',$finalPin)->get('tbl_patient')->row();

        if($model_res){
            $response = array('success'=>'1','msg'=>'Pin Verify successfully.','pid'=>$pid);
		}else{
			$response = array('success'=>'0','msg'=>'Pin Not Matched try again !!!.');
		}
		echo json_encode($response); exit();
    }
    
    
    
    // Author Name : Raushan Kr yadav Added data: 01-04-2023
    
    public function clickToCall(){
		echo $dr_id  = $this->input->post("dr_id"); 
		echo $pid  = $this->input->post("pid");
		echo $app_id  = $this->input->post("app_id");
		exit;
		$formdata['doctor_id'] = $dr_id;
		$formdata['patient_id'] = $pid;
		$formdata['app_id'] = $app_id;
		$formdata['app_start_time'] = '';
		$formdata['app_end_time'] = '';
		$formdata['app_url'] = '';
		$formdata['created_at'] = date("Y-m-d h:i:s");
		$model_res = $this->Mastermodel->master_insert('tbl_click_to_call',$formdata);
		if($model_res){
            $response = array('success'=>'1','msg'=>'Request send successfully.','request_id'=>$model_res);
		}else{
			$response = array('success'=>'0','msg'=>'Request not exist !!!.');
		}
		echo json_encode($response); exit();
	}
	
    
	

}

?>
