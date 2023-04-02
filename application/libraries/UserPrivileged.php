<?php

class UserPrivileged {
    // override User method
    public function getByUserdata($user_id) {

		$con = mysqli_connect("localhost","root","","icnllvue_eswasthalya_dbs");

    	$user_subprivilage = array();
    	$user_privilage = array();				
			
		$sql = mysqli_query($con,"SELECT t2.subpermission FROM role_user as t1 JOIN subpermissions as t2 ON t1.subpermissions_id = t2.subpermissions_id WHERE t1.user_id = '$user_id'");
		
		$sql1 = mysqli_query($con,"SELECT t2.permission FROM role_user as t1 JOIN permissions as t2 ON t1.permission_id = t2.permission_id WHERE t1.user_id = '$user_id' GROUP BY t1.permission_id");	

 		while($row = mysqli_fetch_array($sql)){
 			$user_subprivilage[$row['subpermission']] = true;
 		}
 		
 		while($row = mysqli_fetch_array($sql1)){
 			$user_subprivilage[$row['permission']] = true;
 		}  
 		
 		$_SESSION["useradmin"]["users_subprivilage"] = $user_subprivilage;
 		$_SESSION["useradmin"]["users_privilage"] = $user_privilage;      
		
    }
     // check if user has a specific privilege
    public function hasUserPrivilege($perm) {  
        if(isset($_SESSION["webadmin"]["user_subprivilage"])){
            $user_privilage = $_SESSION["useradmin"]["users_subprivilage"];
            return isset($user_privilage[$perm]);
        }
        else{            
            return false;
        }  


    }    
}

?>
