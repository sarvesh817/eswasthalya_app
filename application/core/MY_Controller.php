<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('Mobile_Detect');
        $usersessid = $this->session->userdata('user_id');   
        
        $usersallow = [973,51242,109171,107928,27303];
        

    }


}