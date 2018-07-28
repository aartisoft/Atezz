<?php 
class Orders extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->data['theme'] = 'admin';
        $this->data['module'] = 'orders'; 
		$this->load->model('admin_panel_model');       
        }
    public function index($start=0)
    {
		$this->load->library('pagination');
        $config['base_url'] = base_url("admin/orders/");
        $config['total_rows'] = $this->db->count_all('payments');
        $config['per_page'] = 15;

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
        $this->data['page'] = 'index';
        $this->data['list'] = $this->admin_panel_model->get_allpayment_list($start,$config['per_page']);
		$this->data['links'] = $this->pagination->create_links();
		$data['admin_notification_status'] = 0;
		$this->db->where('admin_notification_status',1);
		$this->db->update('payments',$data);
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');        
    }
	 public function completed_orders($st=0)
    {
		$this->load->library('pagination');
        $config['base_url'] = base_url("admin/completed_orders/");
        $config['per_page'] = 15;
        $config['total_rows'] = $this->admin_panel_model->get_completepayment_list(0,$st,$config['per_page']);
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
        $this->data['links'] = $this->pagination->create_links();
        $this->data['page'] = 'complete';
        $this->data['list'] = $this->admin_panel_model->get_completepayment_list(1,$st,$config['per_page']);
		$data['admin_notification_status'] = 0;
		$this->db->where('admin_notification_status',1);
		$this->db->update('payments',$data);
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');        
    }
	 public function pending_orders($st=0)
    {
		$this->load->library('pagination');
        $config['base_url'] = base_url("admin/pending_orders/");
        $config['per_page'] = 15;
		$config['total_rows'] = $this->admin_panel_model->get_Pendingpayment_list(0,$st,$config['per_page']); 
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
        $this->data['links'] = $this->pagination->create_links();
        $this->data['page'] = 'pending';
        $this->data['list'] = $this->admin_panel_model->get_Pendingpayment_list(1,$st,$config['per_page']);
		$data['admin_notification_status'] = 0;
		$this->db->where('admin_notification_status',1);
		$this->db->update('payments',$data);
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');        
    }
	 public function cancel_orders($st=0)
    {
		$this->load->library('pagination');
        $config['base_url'] = base_url("admin/cancel_orders/");
        $config['per_page'] = 15;
        $config['total_rows'] = $this->admin_panel_model->get_cancelpayment_list(0,$st,$config['per_page']);

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
        $this->data['links'] = $this->pagination->create_links();
        $this->data['page'] = 'cancel';
        $this->data['list'] = $this->admin_panel_model->get_cancelpayment_list(1,$st,$config['per_page']);
		$data['admin_notification_status'] = 0;
		$this->db->where('admin_notification_status',1);
		$this->db->update('payments',$data);
        $this->load->vars($this->data);
		 
        $this->load->view($this->data['theme'].'/template');        
    }
	 public function decline_orders($st=0)
    {
		$this->load->library('pagination');
        $config['base_url'] = base_url("admin/decline_orders/");
        $config['per_page'] = 15;
        $config['total_rows'] = $this->admin_panel_model->get_declinepayment_list(0,$st,$config['per_page']);
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
        $this->data['links'] = $this->pagination->create_links();
        $this->data['page'] = 'decline';
        $this->data['list'] = $this->admin_panel_model->get_declinepayment_list(1,$st,$config['per_page']);
		$data['admin_notification_status'] = 0;
		$this->db->where('admin_notification_status',1);
		$this->db->update('payments',$data);
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');        
    }
	public function edit_order($id)
    {
        $this->data['page'] = 'edit_request';
        $this->data['list'] = $this->admin_panel_model->edit_request($id);
        $this->data['parent_category'] = $this->admin_panel_model->categories();
        $this->data['child_category'] = $this->admin_panel_model->categories();
        if($this->input->post('form_submit'))
        {         
        $data['req_desc'] = $this->input->post('req_desc');
        $data['main_cat'] = $this->input->post('parent_category');
        $data['sub_cat'] = $this->input->post('child_category');
        $data['delivery_time'] = $this->input->post('delivery_time');
        $data['amount'] = $this->input->post('amount');
        $data['status'] = $this->input->post('status');         
        $this->load->library('common');
        if (isset($_FILES) && isset($_FILES['request_file']['name']) && !empty($_FILES['request_file']['name'])) {                   
        $uploaded_file_name = $_FILES['request_file']['name'];
        $filename = isset($uploaded_file_name) ? $uploaded_file_name : '';              
        $upload_sts = $this->common->global_file_upload('uploads/request_files/','request_file', time().$filename);         
        if (isset($upload_sts['success']) && $upload_sts['success'] == 'y') {
        $uploaded_file_path = "uploads/request_files/".$upload_sts['data']['file_name'];              
        $image_url=$uploaded_file_path; 
        $data['uploaded_file'] = $image_url;        
            }
            }
        $this->db->where('id',$id);
        if($this->db->update('request',$data))
        {
            redirect(base_url().'admin/request');
        }    
        }
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/template');                
    }
    public function delete_order()
    {
        $id = $this->input->post('tbl_id');
        $this->db->where('id',$id);
        if($this->db->delete('request'))
        {
            echo 1;
        }        
    }
	public function update_payment_status()
	{
		$id = $this->input->post('id'); 
        $data['payment_status'] = 2;
		$data['notification_paycomplete'] = 1;
		$this->db->where('id',$id);
		if($this->db->update('payments',$data))
		{
            echo 1;
        } 
		else
		{
			echo 2;
		}
	}
	
	
			public function can_payment()
	{
		if($this->input->post('submit')){ 			
	
		   $current_time= date('Y-m-d H:i:s');
	   	  $rate=$this->input->post('gigs_rate');
		   $email   = $this->input->post('buyer_email');
		   $item_id   = $this->input->post('extra_gig_row_id');
		   $users_tbl_id=1;
		  

				$this->cancel_buy($item_id,$rate,$users_tbl_id,$email);
		}
	}
	
				public function declined_paymrent()
	{
		if($this->input->post('submit')){ 			
		   $from_timezone = $this->session->userdata('time_zone');
		   date_default_timezone_set($from_timezone); 
		   $current_time= date('Y-m-d H:i:s');
	   	  $rate=$this->input->post('gigs_rate');
		   $email   = $this->input->post('buyer_email');
		   $item_id   = $this->input->post('extra_gig_row_id');
		   $users_tbl_id=1;
		  

				$this->declined_buy($item_id,$rate,$users_tbl_id,$email);
		}
	}
	
	
	
	
	
	function declined_buy($id,$amount,$user_id,$email){
		 $this->config->load('paypallib_config');
		 $this->config->set_item('business', $email);
		 $this->load->library('paypal_lib');
		
		//Set variables for paypal form
		$returnURL =base_url('/admin/orders/decline_success/'.$id); //payment success url
		$cancelURL = base_url('/admin/orders/paypal_decline'); //payment cancel url
		$notifyURL = base_url().'admin/orders/ipn'; //ipn url
		//get particular product data
		//$product = $this->product->getRows($id);
		$userID = $user_id; //current user id
		$name ='Amount Process to Buyer';
		 $this->paypal_lib->add_field('return', $returnURL);
		 $this->paypal_lib->add_field('cancel_return', $cancelURL);
		 $this->paypal_lib->add_field('notify_url', $notifyURL);
		 $this->paypal_lib->add_field('item_name', $name);
		 $this->paypal_lib->add_field('custom', $userID);
	       $this->paypal_lib->add_field('item_number',  $id);
		 $this->paypal_lib->add_field('amount',  $amount);		
		//$this->paypal_lib->image($logo);

		
		$this->paypal_lib->paypal_auto_form();
	}
	
		
	function cancel_buy($id,$amount,$user_id,$email){
		 $this->config->load('paypallib_config');
		 $this->config->set_item('business', $email);
		 $this->load->library('paypal_lib');
		
		//Set variables for paypal form
		$returnURL =base_url('/admin/release_payments/cancel_success/'.$id); //payment success url
		$cancelURL = base_url('/admin/release_payments/paypal_cancel'); //payment cancel url
		$notifyURL = base_url().'admin/release_payments/ipn'; //ipn url
		//get particular product data
		//$product = $this->product->getRows($id);
		$userID = $user_id; //current user id
		$name ='Amount Process to Buyer';
		 $this->paypal_lib->add_field('return', $returnURL);
		 $this->paypal_lib->add_field('cancel_return', $cancelURL);
		 $this->paypal_lib->add_field('notify_url', $notifyURL);
		 $this->paypal_lib->add_field('item_name', $name);
		 $this->paypal_lib->add_field('custom', $userID);
	       $this->paypal_lib->add_field('item_number',  $id);
		 $this->paypal_lib->add_field('amount',  $amount);		
		//$this->paypal_lib->image($logo);

		
		$this->paypal_lib->paypal_auto_form();
	}
	 function cancel_success(){
	  
		$paypalInfo =  $this->input->get();
		//$paypalInfo =  $this->input->get();
        $user_pay_id = $this->input->get('Ad');
        $message='';       
		
	     $uid = $this->uri->segment(4);	
		 
		 $data['pay_status'] = 'Payment Processed';
		$this->db->where('id',$uid);
		$this->db->update('payments',$data);
	    redirect(base_url().'admin/decline_orders');
		redirect(base_url().'admin/cancel_orders');
		
	 }
	 
	 	 function decline_success(){
	  
		$paypalInfo =  $this->input->get();
		//$paypalInfo =  $this->input->get();
        $user_pay_id = $this->input->get('Ad');
        $message='';       
		
	     $uid = $this->uri->segment(4);	
	    $data['pay_status'] = 'Payment Processed';
		$this->db->where('id',$uid);
		$this->db->update('payments',$data);
	    redirect(base_url().'admin/decline_orders');
	 }
	 
	 function paypal_cancel(){
        redirect(base_url().'admin/cancel_orders');
	 }
	 
	 
	 function paypal_decline(){
        redirect(base_url().'admin/decline_orders');
	 }
	 public function purchase_success($payment_id)
	 { 
	 	 $this->data['purchase_details'] 		   =	$this->gigs_model->purchase_completed($payment_id);
    	 $this->data['page_title'] 				   =    'Thanks for purchasing';
	 	 $this->data['module']	  				   =    'purchase_success';
		 $this->data['page']	   				   =    'index';
     	 $this->load->vars($this->data);
         $this->load->view($this->data['theme'].'/template');		 
	 }
	 
	 function ipn(){
		  
		//paypal return transaction details array
		$paypalInfo	= $this->input->post();

		$data['user_id'] = $paypalInfo['custom'];
		$data['product_id']	= $paypalInfo["item_number"];
		$data['txn_id']	= $paypalInfo["txn_id"];
		$data['payment_gross'] = $paypalInfo["payment_gross"];
		$data['currency_code'] = $paypalInfo["mc_currency"];
		$data['payer_email'] = $paypalInfo["payer_email"];
		$data['payment_status']	= $paypalInfo["payment_status"];

		$paypalURL = $this->paypal_lib->paypal_url;		
		$result	= $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
		
		//redirect(base_url());
		//check whether the payment is verified
		if(preg_match("/VERIFIED/i",$result)){
		    //insert the transaction data into the database
			//$this->product->insertTransaction($data);
		    $table_data['transaction_id'] = $TRANSACTIONID;
			$table_data['transaction_status'] = 1;
			$table_data['transaction_date'] = date('Y-m-d H:i:s');
			$this->db->update('payments', $table_data, "id = " . $user_pay_id);
		}
    }
    
}
?>