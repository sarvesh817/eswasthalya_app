<?php
class Eclinic_model extends CI_Model
{

    public function get_register_details($post_data)
    {
        $this->db->where('email', $post_data['email']);
        $query = $this->db->get('doctors_profile'); 
        if ($query->num_rows() > 0) {
            return 2;
        } else {
            $db_res = $this->db->insert('doctors_profile', $post_data);   
            if ($db_res) {
                return 1;
            } else {
                return 0;
            }

        }
    }

    public function save_new_patient($table,$post_data)   
    {     
		$this->db->where('user_id', $post_data['doctors_id']);  
        $query = $this->db->get($table);  
        if ($query->num_rows() > 0) {
            
            $this->db->where("doctors_id", $post_data['doctors_id']);    
		    $this->db->update($table, $post_data);  
            if ($this->db->affected_rows() > 0) 
			return 2;
        } else {       
			$db_res = $this->db->insert($table, $post_data);
            //echo $this->db->last_query(); die;     
            if ($db_res) {
				return 1;
                 
            } else {
                return 0;  
            }

        }
    }
    

    public function get_doctors_list($id)
    {
        $this->db->where('id',$id);             
        $this->db->select('*');     
        return $this->db->get('doctors_profile')->row_array();        
    }

    public function schedule_working_list($id)
    {
        $this->db->where('user_id',$id);               
        $this->db->select('*');     
        return $this->db->get('schedule_working')->result_array();           
    }



    public function save_schedule_working($table,$post_data){   
        $db_res = $this->db->insert($table, $post_data);
            if ($db_res) {
				return 1;
                 
            } else {
                return 0;  
            }
    }

    public function get_login_details_verify($post_data)
    {
        $this->db->where('email', $post_data['email']);
        $db_res1 = $this->db->get('doctors_profile')->num_rows();
        if ($db_res1 < 1) {
            return 2;
        } else {
            $this->db->where('email', $post_data['email']);
            $this->db->where('status', "1");
            $db_res = $this->db->get('doctors_profile')->num_rows();
            if ($db_res) {
                return 1;
            } else {
                return 0;
            }
        }
    }

    public function get_login_details($post_data)
    {
        $this->db->where('email', $post_data['email']);
        $this->db->where('password', $post_data['password']);
        $db_res = $this->db->get('doctors_profile')->num_rows();
        if ($db_res) {
            return 1;
        } else {
            return 0;
        }

    }

    

    public function get_email_verify($insert_id)
    {
        $this->db->where('status', '');
        $this->db->where('id', $insert_id);
        $fetch_user = $this->db->get("doctors_profile")->num_rows();
        if ($fetch_user > 0) {
            $this->db->set('status', '1');
            $this->db->where('id', $insert_id);
            return $this->db->update('doctors_profile');
        } else {
            return 2;
        }
    }
    
    /* Start common dynamic functions list */  

    public function select($id,$table) 
    {
        $this->db->where('user_id',$id);               
        $this->db->select('*');     
        return $this->db->get($table)->result_array();           
    }
    
    public function select_all($table) 
    {
        $this->db->select('*');     
        return $this->db->get($table)->result_array();             
    }

    public function select_with_id($id,$table)
    {
        $this->db->where('id',$id);               
        $this->db->select('*');     
        return $this->db->get($table)->row_array();                 
    }

    public function insert($table,$post_data){    
        $db_res = $this->db->insert($table, $post_data);
            if($db_res)  return 1; 
            else return 0;  
    }
    
    public function update($table,$post_data,$edit_id){      
        $this->db->where("id", $edit_id);
        $this->db->update($table, $post_data);    
        if ($this->db->affected_rows() > 0) 
        return 1;  
    }

    public function delete($table,$edit_id){
        return $this->db->where('id',$edit_id)->delete($table);                        
    }


public function delete_all($table,$profile_id){
        return $this->db->where('user_id',$profile_id)->delete($table);                               
    }
    
    /* END common dynamic functions list */ 
    
     public function update_column_profile($table,$ciid,$userid){
        if($ciid==1){
            $update_col="signature";
        }else if($ciid==2){
            $update_col="joining_letter";
        }else if($ciid==3){
            $update_col="other_document";
        }
        $post_data=array($update_col=>"");     
        return $this->db->where('doctorsid',$userid)->update($table,$post_data);   
    }
     

    public function dd($data){
        echo "<pre>";
        print_r($data);
        die;
    }
}
