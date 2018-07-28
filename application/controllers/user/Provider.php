<?php 
class Provider extends CI_Controller{

	public function __construct() {

		parent::__construct();  
		$this->load->helper('currency');
		$this->load->library('paypal_lib');

		$this->load->model('gigs_model');

		$this->load->model('user_panel_model');
	}


	public function index(){
		$this->view->('provider/index');
	}




}

?>