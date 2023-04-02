<?php

class Mastermodel extends CI_Model {



    public function sendEMailMER($from='',$to='',$cc="",$bcc="",$subject='',$message='',$attachment="",$attachment_name="") {
        //$this->load->config('email');
        //$this->load->model('Mastermodel');
        $config['useragent']    = "CodeIgniter";
        $config['mailpath']     = "/usr/sbin/sendmail";
        $config['protocol']     = 'smtp';
        //$config['protocol']   = 'mail';
        $config['smtp_host']    = 'ssl://smtp.sendgrid.net';
        //$config['smtp_host']  = 'smtp.sendgrid.net';
        $config['smtp_user']    = '';//'';
        $config['smtp_pass']    = '';
        $config['smtp_port']    = '465';       
        $config['smtp_timeout'] = '5';  
        $config['smtp_crypto']  = '';  
        $config['wordwrap']     = TRUE;   
        $config['wrapchars']    = '76';   
        $config['mailtype']     = 'html';
        $config['charset']      = 'utf-8';
        $config['multipart']    = 'mixed';
        $config['alt_message']  = '';
        $config['validate']     = FALSE;
        $config['priority']     = '3';
        $config['newline']      = "\n";
        //$config['newline']      = "\r\n";
        $config['crlf']         = "\n";
        //$config['crlf']         = "\r\n";
        $config['send_multipart'] = TRUE;
        $config['bcc_batch_mode'] = FALSE;
        $config['bcc_batch_mode'] = 200;
        


        $this->email->initialize($config);
        $this->email->from($from);        
        $this->email->to($to);

        if(!empty($cc) && is_array($cc)){
            foreach ($cc as $ccemail) {
                $this->email->cc($ccemail);
            }
        } else{
            $this->email->cc($cc);
        }

        if(!empty($bcc) && is_array($bcc)){
            foreach ($bcc as $bccemail) {
                $this->email->bcc($bccemail);
            }
            $bcc = implode(',', $bcc);
        } else{
            $this->email->bcc($bcc);
        }
        
        $this->email->subject($subject);
        $this->email->message($message); 
        //$this->email->addAttachment($attachment,$attachment_name); 
        //if($this->email->send()){
                
        //return true;
        if($this->email->send()){
            return true;
        }else{
            return false;
        }
    }

        
    public function master_insert($tablename,$data) {
        $this->db->insert($tablename, $data);
        //echo $this->db->last_query();exit;
        return $this->db->insert_id();
    }

    public function getDropdown($tbl_name,$tble_flieds,$condition) {
       $this->db->select($tble_flieds);
       $this->db->from($tbl_name);
       $this->db->where("($condition)");
       $query = $this->db-> get();   
       if($query->num_rows() > 0){
         return $query->result();
       }
       else{
         return false;
       }
    }

    public function compareCommentData($patype,$app_id)
    {
        $this->db->select('tat.test_id,tat.app_id,it.test_name');
        $this->db->from('tbl_appointment_tests as tat');
        $this->db->join('individual_test as it','it.test_id = tat.test_id');
        $this->db->where('tat.app_id',$app_id);
        $this->db->where('tat.test_type',$patype);
        $this->db->order_by('tat.app_id DESC');
        //$this->db->limit(1);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if($query->num_rows() >0){
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function newcompareData($newtest)
    {
        $this->db->select('test_id,test_name');
        $this->db->from('individual_test');
        $this->db->where('test_id IN('.$newtest.')');
        //$this->db->order_by('test_id DESC');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if($query->num_rows() >0){
            return $query->result_array();
        }else{
            return false;
        }
    }
 
    public function master_postdata_insert($tablename, $postData) {
        $fields = $this->db->list_fields($tablename);
        foreach ($postData as $key => $val) {
            if (in_array($key, $fields)) {
                $data[$key] = $val;
            }
        }
        $this->db->insert($tablename, $data);
        return $this->db->insert_id();
    }
	public function master_batch_insert($tablename,$arrData)
	{
		if($arrData)
		{
			if($this->db->insert_batch($tablename, $arrData))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
	}
	
	public function master_postdata_update($tablename,$postData,$where=false) {

        if ($where) {
            if (is_array($where)) {
                $this->db->where($where);
            } else {
                $this->db->where($where, NULL, FALSE);
            }
		$fields = $this->db->list_fields($tablename);
        foreach ($postData as $key => $val) {
            if (in_array($key, $fields)) {
                $data[$key] = $val;
            }
        }
            $this->db->update($tablename, $data);
            
        }

        return true;
    }
  
   
    public function master_update($tablename,$data,$where=false) {
     
        if ($where) {
            if (is_array($where)) {
                $this->db->where($where);
            } else {
                $this->db->where($where, NULL, FALSE);
            }
            $this->db->update($tablename, $data);
            //echo $this->db->last_query();exit;
        }

        return true;
    }
   
    public function master_delete($tablename, $where=false) {
    	if ($where) {
            if (is_array($where)) {
                $this->db->where($where);
            } else {
                $this->db->where($where, NULL, FALSE);
            }
        	
        	$this->db->delete($tablename);
       	 	return true;
        }
        
    }

    function getTableRecords($table,$column_name="",$condition="",$group_by="",$start="",$recordperpage="",$order_by="") {
        
        $cols = '*'; $where = 'WHERE 1=1';
       
        if($column_name !=''){
           $cols = $column_name;
        } else{
            $cols = "*";
        }

        if($condition !=''){
            $where = "WHERE ". $condition;
        }

        if($group_by !='' && $group_by !=0){
            $group_by = $group_by;
        } 

        if($order_by !=""){
            //$this->db->order_by($order_by);
            $order_by = $order_by;
        }

        if($recordperpage !=""){
            $limit = " LIMIT ".$start.",".$recordperpage;
        } else{
            $limit ="";
        }
        $sql = $this->db->query("SELECT ".$cols." FROM ".$table." ".$where." ".$group_by." ".$order_by." ".$limit);
        //echo $this->db->last_query(); exit;         
        if ($sql->num_rows() > 0) {
           return $sql->result_array();
        } else {
           return false;
        }
    }
    
    public function master_get($tablename,$where = false,$select = false,$result_count=false,$offset=0,$join = false,$perpage=false,$search = false,$group_by=false,$distinct=false,$like=false, $order_by = false, $order_by_field_name = false) {
        	
		/*==== Where Clause ===*/	
        if ($where) {
			if (is_array($where)) {
                $this->db->where($where);
            }
            else{
                $this->db->where($where, NULL, FALSE);
            }
        }
		/*==== Order by Clause ===*/
        if ($order_by && $order_by_field_name) {
            $this->db->order_by($order_by_field_name, $order_by);
        }
		/*==== Join Clause ===*/
        if ($join) {
            if (count($join) > 0) {
                foreach ($join as $key => $value) {
                    $explode = explode('|', $value);
                    $this->db->join($key, $explode[0], $explode[1]);
                }
            }
        }

		/*==== Select Clause ===*/
        if ($select) {
            $this->db->select($select,FALSE);
        } else {
            $this->db->select('*');
        }
		/*==== Result set Count Clause ===*/
		if ($result_count) {
           $this->db->from($tablename);
		   return $this->db->count_all_results();
        }
		/*==== Perpage Clause ===*/
		if ($perpage) {
			$this->db->limit($perpage);
		}
		/*==== Group by Clause ===*/
		if ($group_by) {
			if (is_array($group_by)) {
                $this->db->group_by($group_by);
            }
            else{
                $this->db->group_by($group_by);
            }
		}
		
		/*==== Distinct Clause ===*/
		if ($distinct) {
			$this->db->distinct();
		}
		
		/*==== Like Clause ===*/
		if ($like) {
            foreach ($like as $key => $value) {
                $this->db->like($key, $value);
            }
        }
		
        $query = $this->db->get($tablename);
		
		//print_r($this->db->last_query()); exit;
		
		/*==== Return Clause ===*/
		if ($query->num_rows()==0)
		{
			return FALSE;
		}
		if($offset > 1)
		{
			return $query->result_array();
		}
		if ($query->num_rows()==1)
		{
			return $query->result_array(); 
		}
		if ($query->num_rows() > 1)
		{
			return $query->result_array();
		}
		
        
    }



    public function master_get2($tablename,$where = false,$select = false) {
            
        /*==== Where Clause ===*/   
        if ($where) {
            if (is_array($where)) {
                $this->db->where($where);
            }
            else{
                $this->db->where($where, NULL, FALSE);
            }
        }

        $this->db->order_by('c_id', 'desc');

        /*==== Select Clause ===*/
        if ($select) {
            $this->db->select($select,FALSE);
        } else {
            $this->db->select('*');
        }


        $this->db->limit(1);


        $query = $this->db->get($tablename);
        
        //print_r($this->db->last_query()); exit;
        /*==== Return Clause ===*/
        if ($query->num_rows()==0)
        {
            return FALSE;
        }
        if ($query->num_rows()==1)
        {
            return $query->result_array(); 
        }
        if ($query->num_rows() > 1)
        {
            return $query->result_array();
        }
        
        
    }


     public function master_get3($tablename,$where = false,$select = false) {
            
        /*==== Where Clause ===*/   
        if ($where) {
            if (is_array($where)) {
                $this->db->where($where);
            }
            else{
                $this->db->where($where, NULL, FALSE);
            }
        }


        $this->db->order_by('c_id', 'desc');

        /*==== Select Clause ===*/
        if ($select) {
            $this->db->select($select,FALSE);
        } else {
            $this->db->select('*');
        }

        $query = $this->db->get($tablename);
        
        //print_r($this->db->last_query()); exit;
        /*==== Return Clause ===*/
        if ($query->num_rows()==0)
        {
            return FALSE;
        }
        if ($query->num_rows()==1)
        {
            return $query->result_array(); 
        }
        if ($query->num_rows() > 1)
        {
            return $query->result_array();
        }
        
        
    }

	
	
	
    public function master_max_id($column_name, $tablename) {
        $this->db->select_max($column_name);
        $query = $this->db->get($tablename);
        $row = $query->row_array();
        return $row[$column_name];
    }
	 
   
	public function gowel_crypt($string, $action = 'e' ) {
		// you may change these values to your own
		$secret_key = 'my_simple_secret_key';
		$secret_iv = 'my_simple_secret_iv';
	 
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$key = hash( 'sha256', $secret_key );
		$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	 
		if( $action == 'e' ) {
			$output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
		}
		else if( $action == 'd' ){
			$output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
		}
	 
		return $output;
	}

	   

    public function comPagination($totalrecord,$recperpage,$controller,$funcname)
    {    
        $this->load->library('pagination');
        $config = array();
        if($controller !='')
           $config["base_url"] = URL.$controller."/".$funcname;
        else
           $config["base_url"] = URL.$funcname;
       
        $config["total_rows"] = $totalrecord;
        $config["per_page"] = $recperpage;
        $config["uri_segment"] = 3;
        $config["use_page_numbers"] = TRUE;
        $config["full_tag_open"] = '<ul class="pagination">';
        $config["full_tag_close"] = '</ul>';
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config['next_link'] = '&raquo;';
        $config["next_tag_open"] = '<li>';
        $config["next_tag_close"] = '</li>';
        $config["prev_link"] = "&laquo;";
        $config["prev_tag_open"] = "<li>";
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a href=''>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $config["num_links"] = 3;
        //print_r($config); exit();

        $this->pagination->initialize($config);         
        $ppagination = $this->pagination->create_links();   
        return $ppagination;
    } 
	
	public function comDcPagination($totalrecord,$recperpage,$folder,$controller,$funcname)
    {    
        $this->load->library('pagination');
        $config = array();
        if($controller !='')
           $config["base_url"] = URL.$folder."/".$controller."/".$funcname;
        else
           $config["base_url"] = URL.$funcname;
       
        $config["total_rows"] = $totalrecord;
        $config["per_page"] = $recperpage;
        $config["uri_segment"] = 3;
        $config["use_page_numbers"] = TRUE;
        $config["full_tag_open"] = '<ul class="pagination">';
        $config["full_tag_close"] = '</ul>';
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config['next_link'] = '&raquo;';
        $config["next_tag_open"] = '<li>';
        $config["next_tag_close"] = '</li>';
        $config["prev_link"] = "&laquo;";
        $config["prev_tag_open"] = "<li>";
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a href=''>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $config["num_links"] = 3;
        // print_r($config); exit();

        $this->pagination->initialize($config);         
        $ppagination = $this->pagination->create_links();   
        return $ppagination;
    }

    public function get_value($table,$condition){
        $this->db->select('*');
        $this->db->from("".$table."");
        $this->db->where("".$condition."");

        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }

    }

    public function generateRandomString($length,$url,$c_id=""){
        $chars = "abcdfghjkmnpqrstvwxyz|ABCDFGHJKLMNPQRSTVWXYZ|0123456789";
        $sets = explode('|', $chars);
        $all = '';
        $randString = '';
        foreach($sets as $set){
            $randString .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for($i = 0; $i < $length - count($sets); $i++){
            $randString .= $all[array_rand($all)];
        }
        $randString = str_shuffle($randString);

        $id = $this->insertUrlInDB($url, $randString,$c_id);        
        return $randString;
    }

    public function insertUrlInDB($url, $code,$c_id=""){                
        $data = array("c_id"=>$c_id,"long_url" => $url,"short_code" => $code,"hits" => 0,"created_at" => date("Y-m-d H:i:s"));    
        $lasturl = $this->master_insert("short_urls",$data);
    }

    public function sessionHijack(){
         $browser = $this->agent->browser(); 
        $ipda    = $this->input->ip_address(); 
      //echo $_COOKIE['ci_gwl_secretkey'];
        if(!isset($_COOKIE['gwl_secretkey'])){          
            return false;
        } else if($this->session->userdata('userAgent') !== $browser){
            return false;
        } else if($this->session->userdata('ipAddress') !== $ipda ){
            return false;
        } else{
            return true;
        }
    }


   
    function getDCDetails($dc_id){
	   $where = array(
            'dc.dc_id'=>$dc_id,
        );
        $this->db->select('dc.*,tc.name as city_name,ts.state_name');
        $this->db->from('diagnostic_center dc');
        $this->db->join('tbl_states ts','ts.state_id  = dc.state','left');
        $this->db->join('tbl_cities tc','tc.id  = dc.city','left');
        $this->db->order_by('dc.dc_id','desc');
        $this->db->where($where);
        $this->db->limit(1);
        $res = $this->db->get();
        $error = $this->db->error();
		$data = array();
        if ($error['code'] == 0) {
            if ($res->num_rows() > 0) {
                $data = $res->row();
            } 
        }
		return $data;
    }
   
    public function activateCallingVendor($vendor){

        $InAllCallS = array('call_status'=>'InActive');
        $this->db->where("call_status", 'Active');
        $this->db->update('calling_vendor', $InAllCallS);

        if($vendor=='Knowlarity'){
           $this->db->where("vendor_name",'Knowlarity');
        }
        if($vendor=='ubona'){
           $this->db->where("vendor_name",'UbonaNew');
        }

        $AKAllCallS = array('call_status'=>'Active','active_at'=>date('Y-m-d H:i:s'));
        $this->db->update('calling_vendor', $AKAllCallS);
        return true;
    }

    


    public function updateAvailability($username,$availability,$log){

        $browser = $this->agent->browser();                                         
        $ip_address  = $this->input->ip_address();                           
        $login_token = $this->session->userdata('loginToken');
        $user_id     = $this->session->userdata('user_id');
        if($availability !="InActive") {
            $_SESSION['Agentavailability'] = $availability;

            $userlog['user_id'] = $user_id;
            $userlog['ip_address'] = $ip_address;
            $userlog['userAgent']  = $browser;
            $userlog['login_token']  = $login_token;
            $userlog['login_time'] = date('Y-m-d H:i:s');
            $userlog['action'] = 'Active';
            $userlog['vendor'] = '';
            $this->master_insert('inboundcall_log',$userlog);

        } else{
            $userlog['logout_time'] = date('Y-m-d H:i:s');
            $userlog['action'] = 'InActive';
            $this->master_update('inboundcall_log',$userlog,"user_id=$user_id AND login_token='".$login_token."'");
            unset($_SESSION["Agentavailability"]);
        }
        $res = ['status'=>200,'msg'=>'logout successfully'];

        return $res;
    }



    public function getAllExecutiveList($branch=''){        
        if( $branch !=''){
            $con = " user_type='SUPERADMIN' AND subrole_id IN(9,10,14,15,17,21) AND status='Approved' AND FIND_IN_SET('".$branch."',branch)";       
        } else{
            $con="role_id=3 AND status='Approved' AND subrole_id IN(9,10,14,15,17,21)";
        }

        $sql = $this->db->query("SELECT user_id,name,user_type,branch,role_id,subrole_id,status FROM user WHERE ".$con);
        //echo $this->db->last_query();exit;
        if($sql->num_rows() > 0){
            return $sql->result_array();
        } else{
            return false;
        }
    }


} // End Class Block


