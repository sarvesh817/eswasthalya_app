<?php
class user_model extends CI_Model {
	
    public function __construct(){        
        parent::__construct();
		$this->load->database();
	}
	
	function getData(){
		//print_r($subroleId);exit;
		$sql = $this->db->query("SELECT u.*, r.name as 'role', sr.subrole as 'subrole' FROM user as u LEFT JOIN roles as r ON(u.role_id = r.role_id) LEFT JOIN subroles as sr ON(sr.subrole_id = u.subrole_id) WHERE 1 = 1 AND u.user_type NOT IN ('CUSTOMER','DCUSER')"); // ,'DCUSER'
		//print_r($this->db->last_query($sql));exit;		
		if ($sql->num_rows() > 0) {
		    return $sql->result_array();
		} else {
		    return false;
		}  
	}
	public function getCaseRemarks($id){
		if($id !=''){
			$this->db->select('ur.*,ud.name as changed_by');
			$this->db->from('user_report_remark as ur');
			$this->db->join('user as ud', 'ud.user_id=ur.created_by', 'left');
			$this->db->where('ur.user_id',$id);
			$this->db->order_by('ur.user_remark_id', 'DESC');

			$query = $this->db->get();
			// echo $this->db->last_query();exit;
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return false;
			}
		}else{
			return false;
		}
	}

	function getDoctorList(){
		//print_r($subroleId);exit;
		$sql = $this->db->query("SELECT u.*, r.name as 'role', sr.subrole as 'subrole' FROM user as u LEFT JOIN roles as r ON(u.role_id = r.role_id) LEFT JOIN subroles as sr ON(sr.subrole_id = u.subrole_id) WHERE subrole='DOCTOR' AND u.user_type NOT IN ('CUSTOMER','DCUSER')");
		//print_r($this->db->last_query($sql));exit;		
		if ($sql->num_rows() > 0) {
		    return $sql->result_array();
		} else {
		    return false;
		}  
	}
	
	function getDropdown($tbl_name,$tble_flieds,$condition){
	   	$this->db->select($tble_flieds);
	   	$this->db->from($tbl_name);
	   	$this->db->where("($condition)");
	
	   	$query = $this->db->get();	
	   	if($query->num_rows() >= 1){
			return $query->result();
	    }else{
			return false;
	   	}
	}
	
	function getDetails($tbl_name,$tble_flieds,$condition)
	{
		$this->db->select($tble_flieds);
		$this->db->from($tbl_name);
		$this->db->where("($condition)");
		
		$query = $this->db->get();		
	   	if($query -> num_rows() >= 1){
			return $query->result_array();
	   	}else{
			return array();
	   	}
	}
	
    function getFormdata($ID) {
		$this->db->select('i.*');
		$this->db->from('tbl_appointment as i');
		$this->db->where('i.app_id', $ID);
		$query = $this->db->get();
		if ($query->num_rows() >= 1) {
			return $query->result_array();
		} else {
			return false;
		}
    }
    
    public function updateRecord($tableName, $data, $column, $value) {
		$this->db->where("$column", $value);
		$this->db->update($tableName, $data);
		//print_r($this->db->last_query());exit;
		if ($this->db->affected_rows() > 0) {
		   return true;
		} else {
		   return true;
		}
    }
    
    public function getAllDCSNameList($state='') {
    	$this->db->select('dc_id,center_name');
    	$this->db->from('diagnostic_center');
    	if($state !=''){
    		$this->db->where('state IN('.$state.')');
    	}
    	$query = $this->db->get();
    	//echo $this->db->last_query();exit;
    	if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}
    	
    }

    public function getDeleteRecord($user_id){
    	$this->db->where('user_id', $user_id);
		$this->db->delete('`role_user`');
		//echo $this->db->last_query();exit;
		if($this->db->affected_rows() > 0) {
		   return true;
		}else{
		   return true;
		}
    }

    public function insertNewPermissionRecord($UserData){
    	$this->db->insert('role_user',$UserData);
	   	//echo $this->db->last_query();exit;
		return $this->db->insert_id();
    }

    public function insertDoctorRecord($table,$doctorData){
    	$this->db->insert($table, $doctorData);
	   	return $this->db->insert_id();
    }

    public function getAllChangedDRRemark($dr_id){
		$this->db->select('drr.dr_remark,drr.created_at,ud.name');
    	$this->db->from('doctor_remark as drr');
    	$this->db->join('user as ud','ud.user_id=drr.created_by');
    	$this->db->where('drr.dr_id',$dr_id);
    	$this->db->order_by('drr.created_at','DESC');
    	$query = $this->db->get();
    	//echo $this->db->last_query();exit;
    	if($query->num_rows()>0){
    		return $query->result_array();
    	}else{
    		return false;
    	}
	}

	public function getAllVMDoctorList(){
		$sql = $this->db->query("SELECT ud.user_id,dp.dr_id,dp.dr_name,dp.dr_regn_no,dp.dr_pan_no,dp.dr_address,dp.dr_city,dp.dr_state,dp.dr_account_no,dp.dr_bank_name,dp.dr_acccount_holder_name,dp.dr_bank_branch,dp.dr_ifsc_code,dp.dr_tele_rate,dp.dr_video_rate,dp.dr_type,dp.fin_remark,dp.fin_created_at,dp.fin_created_by,ud.user_type,ud.status,ud.email,ud.contact,ud.agent_campaign_id,ud.inbound_call,ud.outbound_call FROM doctor_profile dp LEFT JOIN user ud ON ud.user_type_id = dp.dr_id WHERE ud.status = 'Approved' AND ud.user_type = 'DOCTOR' AND dp.status = 'Active'");
		//print_r($this->db->last_query($sql));exit;		
		if ($sql->num_rows() > 0) {
		    return $sql->result_array();
		} else {
		    return false;
		}
	}
	
}


