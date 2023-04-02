<?php

class Privilegeduser{
    // override User method
    public function getByUsername($user_id) {
		
		
		$con = mysqli_connect("localhost","root","","icnllvue_eswasthalya_dbs");      
    	$user_subprivilage = array();
    	$user_privilage = array();
		$sel_subroleid = mysqli_query($con,"select subrole_id from user where user_id='".$user_id."' ");
		
		$row_subrolid = mysqli_fetch_array($sel_subroleid);
		$subrole_id = $row_subrolid['subrole_id'];
	
		
		$sql = mysqli_query($con,"SELECT t2.subpermission FROM tbl_subrole_permissions as t1 JOIN subpermissions as t2 ON t1.subpermissions_id = t2.subpermissions_id WHERE t1.subrole_id = '$subrole_id'");
		
		$sql1 = mysqli_query($con,"SELECT t2.permission FROM tbl_subrole_permissions as t1 JOIN permissions as t2 ON t1.permission_id = t2.permission_id WHERE t1.subrole_id = '$subrole_id' GROUP BY t1.permission_id ");
		
		
		
 		while($row = mysqli_fetch_array($sql)){
 			$user_subprivilage[$row['subpermission']] = true;
 		}
 		
 		while($row = mysqli_fetch_array($sql1)){
 			$user_subprivilage[$row['permission']] = true;
 		}  
 		   
 		$_SESSION["webadmin"]["user_subprivilage"] = $user_subprivilage;
 		$_SESSION["webadmin"]["user_privilage"] = $user_privilage;      
		
    }
 


    // check if user has a specific privilege
    public function hasPrivilege($perm) {

    	//print_r($perm); exit;
    	if(isset($_SESSION["webadmin"]["user_subprivilage"])){
			$user_privilage = $_SESSION["webadmin"]["user_subprivilage"];
			return isset($user_privilage[$perm]); 
    	}
		else{			
			return false;
		}
    
    }
    
}
?>
