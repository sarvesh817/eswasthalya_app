<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {


	public function __construct() {
	 	parent::__construct();	 
	 	date_default_timezone_set('Asia/Kolkata');  	   	   	 
	}

	 public function index()
	 {
	   if($this->session->userdata('user_id') > 0) {
			
		    $USERTYPE = $this->session->userdata('type');
		    if($USERTYPE =='SUPERADMIN'){
               redirect('home/index', 'refresh');
            }else if($USERTYPE =='DOCTOR'){
                redirect('doctors/dashboard', 'refresh');
            }else if($USERTYPE =='ECLINIC'){
                redirect('eclinic/dashboard', 'refresh');
            }else{
                
            }  
	    } else{
	 		$this->load->view('login/login');
	    }
	 }


	public function loginNow(){	

		$this->load->model('mastermodel','',TRUE);
		$this->load->model('loginmodel','',TRUE);	
		if(isset($_SERVER['REMOTE_ADDR'])){
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		$formPostData = $this->input->post();
	    $formPostData = $this->security->xss_clean($formPostData);
		$email_id = strtolower(trim($formPostData['email']));
		//$email = $this->mastermodel->gowel_crypt($email_id,"e");
		$email = gowelEncrypt($email_id);
		$password = $this->input->post('password',TRUE); 
		$ip_address = $this->input->ip_address();	
		$login_token = md5(uniqid("100_ID", true));
        
		if($email =="" && $password ==""){
			$this->session->set_flashdata('item','Enter Username and Password !');
			redirect('login'); exit();
		}
		if($email ==""){
			$this->session->set_flashdata('item','Please Enter Username first !');
			redirect('login'); exit();
		}
		if($password ==""){
			$this->session->set_flashdata('item','Please Enter Password first !');
			redirect('login'); exit();
		}
		
		$password = md5($password);
		$user_details = $this->mastermodel->master_get('user',"user_type IN('DOCTOR','ECLINIC','PATIENT') AND email='$email' AND password = '$password'",'user_id, user_type, name, email, status, contact, role_id, subrole_id, password_set_date, last_loggedin, logged_in,availability');
		   
		   //echo"<pre>";print_r($user_details);exit;

		if(!empty($user_details) && $user_details !=false) {

			$USER_TYPE = $user_details[0]['user_type'];
			$user_id = $user_details[0]['user_id'];		

			//$Wlisted_ips = unserialize(WHITE_LISTED_IP);

			if($USER_TYPE=='CUSTOMER'){
				$this->session->set_flashdata('item','Currently we are facing problems with your login, please try after some time.');
				redirect('login');
			
			}else{
				$this->authenticateUaser($user_details);
			}

		} else{
			if(is_numeric($email_id)){
				$user_details = $this->mastermodel->master_get('user',"contact='$email' and status ='Approved'",'user_id');
			}else{
				$user_details = $this->mastermodel->master_get('user',"email='$email' and status ='Approved'",'user_id');
			}

			if($user_details){

				$user_id = $user_details[0]['user_id'];
				$incorrect['incorrect_try'] = $user_details[0]['incorrect_try'] + 1;
				$this->loginmodel->updateRecord($incorrect, $user_details[0]['user_id']);
				$this->updateUserlog($user_id,$login_token,'FAILED');

				if($incorrect['incorrect_try'] <= 3){
					$this->session->set_flashdata('item','Invalid password');
					redirect('login');						
				}else{
					$this->session->set_flashdata('item','Your account has been locked due to 3 wrong attempts. Please reset your password');
					redirect('login');								
				}
			}else{
				$this->session->set_flashdata('item','Invalid Email ID/User has been not exist/approved yet');
				redirect('login');							
			}
	    }			
    }


	public function authenticateUaser($user_details){

		$this->load->model('mastermodel','',TRUE);
		$this->load->model('loginmodel','',TRUE);	

		$browser = $this->agent->browser();											
		$ip_address = $this->input->ip_address();						 	
		$login_token = md5(uniqid("100_ID", true));
		$expire = time()+32400; 
		$path  = '/';  
		$secure = TRUE;	
		setcookie("esws_secretkey", $login_token,$expire,$path,".http://localhost/eswasthalya_app",$secure,'httpOnly');
		session_regenerate_id(false);

		$USER_TYPE = $user_details[0]['user_type'];
		$user_id = $user_details[0]['user_id'];	
		
		$this->userprivileged->getByUserdata($user_details[0]['user_id']);
		$this->privilegeduser->getByUsername($user_details[0]['user_id']);
		//echo "test";print_r($user_details);exit;
		$this->session->set_userdata(array(
			'user_id'       => $user_details[0]['user_id'],
			'name'      	=> $user_details[0]['name'],
			'email'       	=> $this->mastermodel->gowel_crypt($user_details[0]['email'],"d"),
			'userContact'   => $this->mastermodel->gowel_crypt($user_details[0]['contact'],"d"),
			'type'          => $user_details[0]['user_type'],
			'status'          => $user_details[0]['status'],
			'role_id'       => $user_details[0]['role_id'],
			'subrole_id'    => $user_details[0]['subrole_id'],
			'LOGGED_IN'     => TRUE,
			'last_loggedin' => $user_details[0]['last_loggedin'],
			'logged_in_count' => $user_details[0]['logged_in'] + 1,
			'is_loggedin' 	=> 1,										
			'loginToken' 	=> $login_token,
			'userAgent' 	=> $browser,
			'ipAddress' 	=> $ip_address,
			'ibavailability' => "Busy",
			'loggedin_time' => time()
		));	

			$update['last_loggedin'] = date('Y-m-d H:i:s');
			$update['ip_address'] = $ip_address;
			$update['logged_in'] = $user_details[0]['logged_in'] + 1;
			$update['is_loggedin'] = 1;
			$update['login_token'] = $login_token;	
			$update['incorrect_try'] = 0;
			$update['availability'] = 'Busy';
			$this->loginmodel->updateRecord($update, $user_details[0]['user_id']);
			$this->updateUserlog($user_id,$login_token,'SUCCESS');
			
			$todayDate = date('Y-m-d');
			$password_set_date = $user_details[0]['password_set_date'];

			$start_date = strtotime($password_set_date);
			$end_date = strtotime($todayDate);
			$diffdate = ($end_date - $start_date)/60/60/24;

			/*if($user_details[0]['logged_in'] == 0 || $diffdate >=30){
				redirect('changepassword','refresh'); exit; 
			} else{
							
			}*/
			$USERTYPE = $this->session->userdata('type');
		    if($USERTYPE =='SUPERADMIN'){
               redirect('home/index', 'refresh');
            }else if($USERTYPE =='DOCTOR'){
                redirect('doctors/dashboard', 'refresh');
            }else if($USERTYPE =='ECLINIC'){
                redirect('eclinic/dashboard', 'refresh');
            }else{
                
            }  
	}

	public function updateUserlog($user_id,$login_token,$status){
		$this->load->model('mastermodel','',TRUE);	
		
		$ip_address = $this->input->ip_address();
		$browser = $this->agent->browser();
		$browser_version = $this->agent->version();
		$os = $this->agent->platform();
		$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip_address"));
	    $country = $geo["geoplugin_countryName"];
	    $city = $geo["geoplugin_city"];
	    $login_location = $country . ", " . $city;

	    $userlog['user_id'] = $user_id;
		$userlog['ip_address'] = $ip_address;
		$userlog['userAgent'] = $browser;
		$userlog['browser_version'] = $browser_version;
		$userlog['os'] = $os;
		$userlog['login_token'] = $login_token;
		$userlog['login_location'] = $login_location;
		$userlog['login_time'] = date('Y-m-d h:i:s');
		$userlog['action'] = 'LOGIN';
		$userlog['status'] = $status;
		$this->mastermodel->master_insert('userlog',$userlog);
		return true;
	}
	
    public function forgotpassword() {

		$this->load->model('mastermodel','',TRUE);	
		$this->load->model('loginmodel','',TRUE);
		parse_str($_POST['formdata'],$formdata);
		$email = $formdata['email'];
		$email_id = strtolower(trim($email));

		$email = $this->mastermodel->gowel_crypt($email_id,"e");
		$passwordd = $formdata['new_password'];
		$password = md5($passwordd);

		if(!empty($email_id)){
		    $result = $this->mastermodel->master_get('user',"email='$email'",'*');
			//$result = $this->loginmodel->doctor_forgotpass($email);
			if($result)	{
			    $fpwd_data['password']= $password;
				$fpwd_data['created_at']= date("Y-m-d h:i:s");
				
				//$fpwd_updateRecord = $this->loginmodel->updateDoctRecord($fpwd_data, $result[0]->id);
				$fpwd_updateRecord = $this->loginmodel->updateRecord($fpwd_data, $result[0]['user_id']);
				
				$link = '';
				if($fpwd_updateRecord)
				{
					echo json_encode(array("success"=>true,"msg"=>'Password has been changed')); exit;
					
				}else{
				    echo json_encode(array("success"=>false,"msg"=>'Problem while sending mail..',"link"=>$link)); exit;
				}
				
			}
			else{
				echo json_encode(array("success"=>false,"msg"=>'Invalid Email ID.')); exit;
			}
		}
		else
		{
			echo json_encode(array("success"=>false,"msg"=>'Please enter Email ID.'));
			exit;
		}
	}
	
	
	
    
	public function logout() {
		
		$this->load->model('mastermodel','',TRUE);
		 $Logstatu = "sessionexpired";

		if(isset($_REQUEST['user']) && $_REQUEST['user'] !="" && isset($_REQUEST['lotk']) && $_REQUEST['lotk'] !=""){
			$user_id = $_REQUEST['user'];	
			$username = $_REQUEST['usr'];
			$login_token = $_REQUEST['lotk'];
			$userlog['logout_time'] = date('Y-m-d H:i:s');
			$userlog['action'] = "LOGOUT";		
			$availability = "InActive"; 
	        $event = "false";	
		}
		//exit();
		redirect(URL.'login','refresh');
	}

	public function profileResetPassView(){

		$this->load->view('template/header');
		$this->load->view('login/profile_reset');
		$this->load->view('template/footer');
	}

	public function checkOldPassword(){
		$this->load->model('mastermodel','',TRUE);	
		$id = $this->input->post('user_id');
		$old_password = $this->input->post('old_password');
		$checkPass = md5($old_password);
		//print_r($checkPass);exit;
		$get_result_user = $this->mastermodel->master_get('user','user_id = '.$id);
		if(isset($get_result_user) && count($get_result_user) > 0 && $get_result_user !=''){
			if($checkPass == $get_result_user[0]['password']){
				echo json_encode(array('msg'=>'Password Matched'));exit;
			}else{
				echo json_encode(array('msg'=>'Password Not Matched.'));exit;
			}
		}else{
			echo json_encode(array('success'=>false,'msg'=>'Error in resetting password.'));exit;
		}
	}

	public function reset_ProfilePassword()	{		
		$this->load->model('loginmodel','',TRUE);
		$id = $_POST['key'];
		$new_password = $_POST['new_password'];
		$data = array();
		if(!empty($id) && $id != ""){
			$data['password'] = md5($new_password);
			$data['incorrect_try'] = 0;
			$res = $this->loginmodel->updateRecord($data,$id);				 
			if(!empty($res)){
				/*Update Log Table*/
				$this->load->model('mastermodel','',TRUE);
				$userlog['logout_time'] = date('Y-m-d H:i:s');
				$userlog['action'] = "LOGOUT";
				$login_token = $this->session->userdata('loginToken');
				$logout = $this->mastermodel->master_update('userlog',$userlog,'user_id='.$id.' AND login_token != "'.$login_token.'" AND action = "LOGIN"');
				/*Update Log Table End*/
				
				$this->session->sess_destroy();
				redirect(URL.'login','refresh');
			}
		}
    }

    public function pageNotFound(){
    	$this->load->view('template/header');
		$this->load->view('login/error_pnf');
		$this->load->view('template/footer');
    }
    public function NoDataFound(){
    	$this->load->view('template/header');
		$this->load->view('login/error_pnf');
		$this->load->view('template/footer');
    }

 
}
