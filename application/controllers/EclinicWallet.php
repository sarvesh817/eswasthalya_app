<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EclinicWallet extends MY_Controller {

	public function __construct(){
	   parent::__construct();
	   date_default_timezone_set('Asia/Kolkata');
	   $this->load->model('Homemodel','',TRUE);
	   $this->load->model('Mastermodel','',TRUE);	   
	}
	 
	public function index() {

		$uid = $this->session->userdata('user_id');
		$data['eclinic_info_edit'] = $this->Mastermodel->master_get('tbl_eclinic','user_id="'.$uid.'"', '*');
		$data['walletData'] = $this->Mastermodel->master_get('tbl_user_wallet','user_id="'.$uid.'"', '*');
		$data['transactionHistory'] = $this->Mastermodel->master_get('tbl_wallet_transaction_history','user_id="'.$uid.'"', '*');
		//echo '<pre>'; print_r($data['transactionHistory']);exit;
		
		if(!empty($this->session->userdata('user_id'))) {
			$DrAvailability='No';
			$this->load->view('template/header',$data);
			$this->load->view('eclinic-panel/wallet',$data);
			$this->load->view('template/footer',$data);	
		}else {
			redirect('login', 'refresh');
		}
    }
}

?>
