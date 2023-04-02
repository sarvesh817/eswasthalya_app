<?PHP
class Loginmodel extends CI_Model {
	
	public function login($username,$password){
		$whr = "user_name ='".$username."' && password='".$password."' ";		
		$this->db->select('user_id, user_name, email_id, first_name , last_name, role_id,driver_id');
		$this->db->from('tbl_admin_users');
		$this->db->where($whr);
		$this->db->limit(1);
		$query = $this->db->get();		
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
		
	}
	
	public function getContentForgetPass($eid)
	{
		$this -> db -> select('fromemail,toemail,subject,content,eid');
		$this -> db -> from('tbl_emailcontents');
		$this -> db -> where('eid', $eid);
		$query = $this -> db -> get();	  
		if($query -> num_rows() >= 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	
	}
	
	public function forgotpass($email){
		
		$whr = "email = '".$email."' ";		
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($whr);
		$this->db->limit(1);

		$query = $this->db->get();
		
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
		
	}
	
	public function updateRecord($datar,$eid){
		$this->db->where('user_id', $eid);
		$this->db->update('user',$datar);	
		/*print_r($this->db->last_query());	exit;*/		 
		if ($this->db->affected_rows() > 0){
			  return true;
		}else{
		  return true;
		} 
	}
	public function updateRecordBYIP($datar,$eid){
		$this->db->where('ip_address', $eid);
		$this->db->update('user',$datar);	
		/*print_r($this->db->last_query());	exit;*/		 
		if ($this->db->affected_rows() > 0){
			  return true;
		}else{
		  return true;
		} 
	}
	
	
}
?>
