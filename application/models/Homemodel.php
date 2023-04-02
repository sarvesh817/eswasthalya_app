<?PHP
class Homemodel extends CI_Model
{
	function insertData($tbl_name,$data_array,$sendid = NULL)
	 {
	 	$this->db->insert($tbl_name,$data_array);
	 	$result_id = $this->db->insert_id();
	 	if($sendid == 1)
	 	{
	 		return $result_id;
	 	}
	}
	

	function updateRecord($tableName, $data, $column, $value) {
		 $this->db->where("$column", $value);
		 $this->db->update($tableName, $data);
		 if ($this->db->affected_rows() > 0) {
		   return true;
		 } else {
		   return true;
		 }
   }
	
	function getCustomer(){
	   
	   $this->db->select('*');
	   $this->db->from('test_users as u');
	   $this->db->join('test_user_roles as r', 'u.UserId = r.UserId', 'left');
	   $this->db->where('r.RoleId', '4');	
	   $query = $this->db->get();	   
	   //print_r($query->result());exit;
	   if($query->num_rows() >= 1){
	     return $query->result();
	   }else{
	     return false;
	   }
	}


	
	function getDropdown($tbl_name,$tble_flieds){
	   
	   $this->db->select($tble_flieds);
	   $this->db->from($tbl_name);
	
	   $query = $this->db->get();
	
	   if($query->num_rows() >= 1)
	   {
	     return $query->result();
	   }
	   else
	   {
	     return false;
	   }
			
	}
	
	function getDropdownSelval($tbl_name,$tbl_id,$tble_flieds,$rec_id=NULL){
		//echo "in condition...";
	   /*echo $tbl_name."<br/>";
	   echo $tbl_id."<br/>";
	   echo $tble_flieds."<br/>";
	   echo $rec_id."<br/>";*/
	   
	   
	   $this->db->select($tble_flieds);
	   $this->db->from($tbl_name);
	   $this->db->where($tbl_id, $rec_id);
	
	   $query = $this->db->get();
		
	   //print_r($query->result());
	   //exit;
	   
	   
	   if($query->num_rows() >= 1)
	   {
	     return $query->result();
	   }
	   else
	   {
	     return false;
	   }
	}
	
	function getUsersdata($UserID){
		
	   $this->db->select('u.*,r.RoleId');
	   $this->db->from('test_users as u');
	   $this->db->join('test_user_roles as r', 'u.UserId = r.UserId', 'left');
	   $this->db->where('u.UserId', $UserID);
	
	   $query = $this->db->get();
	   
	   //print_r($query->result());
	   //exit;
	   if($query->num_rows() >= 1)
	   {
	     return $query->result();
	   }
	   else
	   {
	     return false;
	   }
		
	}
	
	
	function getUserswarehouse($UserID){
		
	   $this->db->select('w.*');
	   $this->db->from('test_customer_warehouse_details as w');
	   $this->db->where('w.UserId', $UserID);
	
	   $query = $this->db->get();
	   
	   //print_r($query->result());
	   //exit;
	   if($query->num_rows() >= 1)
	   {
	     return $query->result();
	   }
	   else
	   {
	     return false;
	   }
		
	}
	
	
	//Update customer by id
	 function updateUserId($datar,$eid)
	 {
		 $this->db->where('UserId', $eid);
		 $this->db->update('test_users',$datar);
		 
		 if ($this->db->affected_rows() > 0)
			{
			  return true;
			}
		 else
			{
			  return true;
			} 
		 
	 }
	 
	function updateUserRole($tbl_name,$role_data,$id){
	 	$this->db->where('UserId', $id);
     	$this->db->delete('test_user_roles');
     	
     	$this->insertData($tbl_name,$role_data);
     	
	}
	 
	 
	function updateWarehouseDetail($datar,$eid){
		 $this->db->where('customer_warehouse_id', $eid);
		 $this->db->update('test_customer_warehouse_details',$datar);
		 
		 if ($this->db->affected_rows() > 0)
			{
			  return true;
			}
		 else
			{
			  return true;
			} 
		 
	}
	 
	function delRecord($tbl_name,$tbl_id,$record_id){
		 $this->db->where($tbl_id, $record_id);
	     $this->db->delete($tbl_name); 
		 if($this->db->affected_rows() >= 1)
	   {
	     return true;
	   }
	   else
	   {
	     return false;
	   }
	}
	 
	 
	function delcustomer($id){
		$this->db->where('UserId', $id);
	    $this->db->delete('test_customer_supplier'); 
	     
	    $this->db->where('UserId', $id);
	    $this->db->delete('test_customer_warehouse_details'); 
	     
	 	$this->db->where('UserId', $id);
	    $this->db->delete('test_user_roles');

	    $this->db->where('UserId', $id);
	    $this->db->delete('test_users');
		
	    if($this->db->affected_rows() >= 1)
	    {
	      return true;
	    }
	    else
	    {
	     return false;
	    }
	}

	public function getRCloseData($casegroup,$caseType){
	 	$data =0;
	 	if($casegroup !="" && $caseType=="PM") {
	 		$query = "SELECT COUNT(tc.c_id) AS ttlCosed FROM tbl_case AS tc WHERE tc.c_id IN($casegroup) AND case_status IN ('Closed - Reports submitted to insurer')";	
	 	} else if($casegroup !="" && $caseType=="VM") {
	 		$query = "SELECT COUNT(tc.c_id) AS ttlCosed FROM mer_case AS tc WHERE tc.c_id IN($casegroup) AND mer_case_status IN ('Closed - submitted to insurance')";	
	 	}else{
	 		$query="";
	 	}
	 	if ($query !="") {
	 		
	 		$result = $this->db->query($query);		
			if($result->num_rows() >= 1){
			 $Rdata =  $result->result_array();
			 $data =  $Rdata[0]['ttlCosed'];
			}
			else{
				 $data =0;
			}

	 	} else{
	 		$data =0;
	 	}
	 	return $data;
	}

	public function getICWiseClosedData($ic_id,$caseType){
	 	 $data=0;
	 	if($ic_id !="") {
	 		
	 		$todayaDate = date('Y-m-d');
			$currmonthDaysBDate = date('Y-m-01');
			$business_channel = $this->session->userdata('business_channel');	
	 		$businessChannel  = str_replace(',', "','", $business_channel);

	 		$branch = $this->session->userdata('branch');
	 		$branch = explode(',', $branch);
			$branch = implode("','",$branch);
			
			if ($caseType=="PM") {
				$query = "SELECT COUNT(tc.c_id) AS ttlCosed FROM tbl_case AS tc WHERE tc.is_deleted='No' AND tc.ic_id IN ($ic_id) AND tc.branch IN ('".$branch."') AND tc.business_channel IN ('".$businessChannel."') AND case_status IN ('Closed - Reports submitted to insurer') AND DATE(closed_medicals_completed_reports_date)>='".$currmonthDaysBDate."' AND DATE(closed_medicals_completed_reports_date)<='".$todayaDate."'";

			} else if ($caseType=="VM") {
				$query = "SELECT COUNT(tc.c_id) AS ttlCosed FROM mer_case AS tc WHERE tc.is_deleted='No' AND tc.ic_id IN ($ic_id)  AND mer_case_status IN ('Closed - submitted to insurance') AND DATE(mer_closed_date)>='".$currmonthDaysBDate."' AND DATE(mer_closed_date)<='".$todayaDate."'";
			
			} else{
				$query ="";
			}

			if ($query !="") {
	 			$result = $this->db->query($query);		
				if($result->num_rows() >= 1){
				 $Rdata =  $result->result_array();
				 $data =  $Rdata[0]['ttlCosed'];
				}
				else{
					 $data =0;
				}

			} else{
				$data=0;
			}

	 	} else{
	 		$data =0;
	 	}
		return $data;
	 }

    public function calculateMTDBillingAmount($ic_id,$type){
		$data=0;
	 	$todayaDate = date('Y-m-d');
		$currmonthDaysBDate = date('Y-m-01');
	 	if ($ic_id !="") {

	 		$query = "SELECT GROUP_CONCAT(tc.c_id) AS casesgroup FROM tbl_case AS tc WHERE tc.is_deleted='No' AND tc.ic_id IN ($ic_id) AND case_status IN ('Closed - Reports submitted to insurer') AND DATE(closed_medicals_completed_reports_date)>='".$currmonthDaysBDate."' AND DATE(closed_medicals_completed_reports_date)<='".$todayaDate."'";

			$result = $this->db->query($query);		
			if ($result->num_rows() >= 1) {			 	
			 	$Rdata =  $result->result_array();
			 	$data  = $this->getTotalBilliSummery($Rdata[0]['casesgroup'],$type);
			}			
		} 
		return $data;
	 }



	 public function getTotalBilliSummery($c_ids,$type) {

		$TotalBillingAmount = [];
	 	$totalAmt = 0;
    	
    	$this->load->library("billingupdate");
    	$from_date = date("Y-m-01");
        $to_date = date("Y-m-d");
    	$condition1 =" c_id IN(".$c_ids.") AND DATE(case_completion_date)>='".$from_date."' AND DATE(case_completion_date)<='".$to_date."'";
		$Billdata = $this->billingupdate->getBillingList($condition1,"","");
		if($Billdata){

            while($obj = mysqli_fetch_assoc($Billdata)){

            	if ($type=="DC") {
            		$TotalBillingAmount[] 	= $obj['dc_total_charge'];
            	
            	} else if ($type=="CLIENT") {
            		$TotalBillingAmount[] 	= $obj['client_total_price'];
            	}

            }
            $totalAmt =  array_sum($TotalBillingAmount);

        }
        return $totalAmt;
    }
	 
	public function getBranchWiseClosedData($branch,$caseType){
	 	 $data=0;
	 	if($branch !="") {
	 		$business_channel = $this->session->userdata('business_channel');	
	 		$businessChannel  = str_replace(',', "','", $business_channel);

	 		$todayaDate = date('Y-m-d');
			$currmonthDaysBDate = date('Y-m-01');

	 		$query = "SELECT COUNT(tc.c_id) AS ttlCosed FROM tbl_case AS tc WHERE tc.is_deleted='No' AND tc.branch IN ('".$branch."') AND tc.business_channel IN ('".$businessChannel."') AND case_status IN ('Closed - Reports submitted to insurer') AND DATE(closed_medicals_completed_reports_date)>='".$currmonthDaysBDate."' AND DATE(closed_medicals_completed_reports_date)<='".$todayaDate."'";
	 			$result = $this->db->query($query);		
				if($result->num_rows() >= 1){
				 $Rdata =  $result->result_array();
				 $data = $Rdata[0]['ttlCosed'];
				}
				else{
					 $data =0;
				}

		 	} else{
		 		$data =0;
		 	}
		 	return $data;
	}

	public function getMERTypeWiseClosedData($merType,$caseType){
	 	 $data=0;
	 	if($merType !="") {
	 		
	 		$todayaDate = date('Y-m-d');
			$currmonthDaysBDate = date('Y-m-01');
	 		$query = "SELECT COUNT(tc.c_id) AS ttlCosed FROM mer_case AS tc WHERE tc.is_deleted='No' AND tc.mer_type IN ('".$merType."') AND mer_case_status IN ('Closed - submitted to insurance') AND DATE(mer_closed_date)>='".$currmonthDaysBDate."' AND DATE(mer_closed_date)<='".$todayaDate."'";
	 			$result = $this->db->query($query);		
				if($result->num_rows() >= 1){
				 $Rdata =  $result->result_array();
				 $data = $Rdata[0]['ttlCosed'];
				}
				else{
					 $data =0;
				}

		 	} else{
		 		$data =0;
		 	}
		 	return $data;
	}
	

	
 

}
?>