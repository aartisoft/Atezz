<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Gigs extends REST_Controller {

    public function __construct() { 
        parent::__construct();
		//load user model
        $this->load->model('api_gigs_model','gigs');
          $this->load->helper('favourites');
        $common_settings = gigs_settings();
        $this->default_currency = 'USD';
        if(!empty($common_settings)){
          foreach($common_settings as $datas){
            if($datas['key']=='currency_option'){
             $default_currency = $datas['value'];
            }
         }
        }
        $this->load->helper('currency');
        $this->default_currency      = $default_currency;
        $this->default_currency_sign = currency_sign($default_currency);
        
     }

	public function index_get($id = '') {
		
		$favourites_gig_ids = '';
		$device_type =  $this->input->get('device_type');
		$device_type = strtolower($device_type);
		if(!empty($id)){
			$favourites_gig_ids = $this->gigs->favourites_gig_ids($id);
		}
		$data = array();
		$data['base_url'] 			= base_url();
		$data['popular_gigs_image'] = $this->gigs->popular_gigs_image();
		$data['categories'] 		= $this->gigs->categories();
		$popular_gigs_list			= $this->gigs->popular_gigs_list($id);
		$recent_gigs_list			= $this->gigs->recent_gigs_list($id);

		if(!empty($favourites_gig_ids)){
			if(!empty($popular_gigs_list)){
				$popular_gigs_list = favorites_check($popular_gigs_list,$favourites_gig_ids);		
			}
			if(!empty($recent_gigs_list)){
				$recent_gigs_list = favorites_check($recent_gigs_list,$favourites_gig_ids);		
			}
			
		}
		$data['popular_gigs_list']	= $popular_gigs_list;
		$data['recent_gigs_list']	= $recent_gigs_list;
		
		$final_data = ($device_type == 'ios')?$data:[$data];
     	//set the response and exit
		//OK (200) being the HTTP response code
		$this->response([
						'code' => 200,
						'status' => TRUE,
						'message' => 'SUCCESS',
						'primary' => $final_data
					], REST_Controller::HTTP_OK);
	}

	public function categories_get() {

		$categories = $this->gigs->allcategories();
		if(!empty($categories)){
			$this->response([
						'code' => 200,
						'status' => TRUE,
						'message' => 'SUCCESS',
						'primary' => $categories
					], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'No category were found.'
			], REST_Controller::HTTP_OK);
		}
	}
	public function categories_post() {

		$id     		 = $this->post('category_id');
		$userid 		 = $this->post('user_id');
		$sub_category_id = $this->post('sub_category_id');
		$services		 = $this->post('services');
		$records 		 = $this->gigs->categoriesandgigs($id,$sub_category_id,$userid,$services);	
		
		if(!empty($records)){
			$this->response([
						'code' => 200,
						'status' => TRUE,
						'message' => 'SUCCESS',
						'data' => $records
					], REST_Controller::HTTP_OK);
			
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'No category were found.',
				'data' => []
			], REST_Controller::HTTP_OK);
		}
	}

	public function create_gigs_post() {
	
		$params  = $this->input->post(); 
	
		if(!empty($params['user_id']) && !empty($params['title']) && !empty($params['gig_price']) && !empty($params['delivering_time']) && !empty($params['category_id']) && !empty($params['image']) && !empty($params['gig_details']) && !empty($params['work_option']) && !empty($params['terms_conditions']) && (strtolower($params['super_fast_delivery'])=='no' || (!empty($params['super_fast_delivery_desc']) && !empty($params['super_fast_delivery_date']) && !empty($params['super_fast_charges'])) ) ) {
			$params['status'] = 1; // Waiting state	
			$result 	      = $this->gigs->create_gigs($params);  
    	if($result==1){

    		//set the response and exit
					$this->response([
						'code' => 200,
						'status' => TRUE,
						'message' => 'The Gigs created successfully.'
					], REST_Controller::HTTP_OK);

    	}elseif($result==2){
    		//set the response and exit
					$this->response([
						'code' => 404,
						'status' => FALSE,
						'message' => 'Something is wrong please try again later.'
					], REST_Controller::HTTP_OK);
    	}elseif($result==3){
    		//set the response and exit
					$this->response([
						'code' => 404,
						'status' => FALSE,
						'message' => 'Already gig title  taken by someone'
					], REST_Controller::HTTP_OK);
    	}

    	}else{
            $this->response("Provide complete information to create gigs.", REST_Controller::HTTP_OK);
		}
	}
	public function update_gigs_post() {
	
		$params  = $this->input->post(); 
		
		if(!empty($params['gig_id']) && !empty($params['user_id']) && !empty($params['title']) && !empty($params['gig_price']) && !empty($params['delivering_time']) && !empty($params['category_id']) && !empty($params['image']) && !empty($params['gig_details']) && !empty($params['work_option']) && !empty($params['terms_conditions']) && (strtolower($params['super_fast_delivery'])=='no' || (!empty($params['super_fast_delivery_desc']) && !empty($params['super_fast_delivery_date']) && !empty($params['super_fast_charges']) ) ) ) {
			$result 	      = $this->gigs->update_gigs($params);  
    	if($result==1){

    		//set the response and exit
					$this->response([
						'code' => 200,
						'status' => TRUE,
						'message' => 'The Gigs update successfully.'
					], REST_Controller::HTTP_OK);

    	}elseif($result==2){
    		//set the response and exit
					$this->response([
						'code' => 404,
						'status' => FALSE,
						'message' => 'Something is wrong please try again later.'
					], REST_Controller::HTTP_OK);
    	}elseif($result==3){
    		//set the response and exit
					$this->response([
						'code' => 404,
						'status' => FALSE,
						'message' => 'Already gig title  taken by someone'
					], REST_Controller::HTTP_OK);
    	}

    	}else{
            $this->response("Provide complete information to update the gig.", REST_Controller::HTTP_OK);
		}
	}

	public function edit_gigs_post(){

		if($this->post('user_id')!="" && $this->post('gig_id')!=""){
			$params  = $this->post();
			$records = array();
			$records = $this->gigs->edit_details($params); 
			if(!empty($records)){
					$this->response([
						'code' => 200,
						'status' => TRUE,
						'message' => 'SUCCESS',
						'data' => [$records ]
				], REST_Controller::HTTP_OK);
			}else{
					$this->response([
						'code' => 404,
						'status' => TRUE,
						'message' => 'No records were found',
						'data' => [] 
				], REST_Controller::HTTP_OK);	
			}
			

		}else{
			$this->response([
						'code' => 404,
						'status' => FALSE,
						'message' => 'Input Params Missing'
				], REST_Controller::HTTP_OK);
		}

	}

	public function search_gig_post(){

		if($this->input->post()){
			$params    = $this->input->post();
			$gigs_list = $this->gigs->search_data($params); 

			if(!empty($gigs_list)){
				$this->response([
						'code' => 200,
						'status' => TRUE,
						'message' => 'SUCCESS',
						'data' => $gigs_list
					], REST_Controller::HTTP_OK);
		 }else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'No gigs were found.'
			], REST_Controller::HTTP_OK);
		 }
		}
	}
	public function gigs_list_get($userid=0) {
		
		if(!empty($userid)){
			$favourites_gig_ids = $this->gigs->favourites_gig_ids($userid);
		}

		$gigs_list = $this->gigs->gigs_list($userid);
		if(!empty($favourites_gig_ids)){
			if(!empty($gigs_list)){
				$gigs_list = favorites_check($gigs_list,$favourites_gig_ids);		
			}
		}
		if(!empty($gigs_list)){
			$this->response([
						'code' => 200,
						'status' => TRUE,
						'message' => 'SUCCESS',
						'data' => $gigs_list
					], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'No gigs were found.'
			], REST_Controller::HTTP_OK);
		}
	}

	public function my_gigs_get($userid=0) {

		if(!empty($userid)){
			$favourites_gig_ids = $this->gigs->favourites_gig_ids($userid);
		}
		$my_gigs_list = $this->gigs->my_gigs_list($userid);
		if(!empty($favourites_gig_ids)){
			if(!empty($my_gigs_list)){
				$my_gigs_list = favorites_check($my_gigs_list,$favourites_gig_ids);		
			}
		}
		if(!empty($my_gigs_list)){
			$this->response([
						'code' => 200,
						'status' => TRUE,
						'message' => 'SUCCESS',
						'data' => $my_gigs_list
					], REST_Controller::HTTP_OK);
		}else{
			//set the response and exit
			//NOT_FOUND (404) being the HTTP response code
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'No gigs were found.'
			], REST_Controller::HTTP_OK);
		}
	}
	
	public function gigs_details_post(){

		 $userid  = $this->post('userid');
		 $gig_id  = $this->post('gig_id');

		$gig_details = $this->gigs->gigs_details($userid,$gig_id);
		
		if(!empty($gig_details)){
			$this->response([
						'code' => 200,
						'status' => TRUE,
						'message' => 'SUCCESS',
						'data' => [$gig_details]
					], REST_Controller::HTTP_OK);
		}else{
			//set the response and exit
			//NOT_FOUND (404) being the HTTP response code
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'Something is wrong.',
				'data' => []
			], REST_Controller::HTTP_OK);
		}

	}
	public function seller_buyer_review_post(){

		 $userid  = ''; //$this->post('userid');
		 $gig_id  = $this->post('gig_id');
		$seller_buyer_review = $this->gigs->seller_buyer_review($userid,$gig_id,0);
	
		if(!empty($seller_buyer_review)){
			//set the response and exit
			//OK (200) being the HTTP response code
			$this->response([
						'code' => 200,
						'status' => TRUE,
						'message' => 'SUCCESS',
						'data' => $seller_buyer_review
					], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'No details were found.',
				'data' => []
			], REST_Controller::HTTP_OK);
		}

	}

	public function add_favourites_post(){
		
		if($this->post()) {
			$data['gig_id'] = $this->post('gig_id');
  			$data['user_id'] = $this->post('user_id');        
  			$result  = $this->gigs->add_favourites($data);
			if($result){
					$this->response([
							'code' => 200,
							'status' => TRUE,
							'message' => 'Favourites details added successfully.',
						], REST_Controller::HTTP_OK);	
				}else{
					$this->response([
						'code' => 404,
						'status' => FALSE,
						'message' => 'Something is wrong.',
					], REST_Controller::HTTP_OK);	
				}
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'Favourites details missing',
			], REST_Controller::HTTP_OK);
		}	
	}	

	public function remove_favourites_post(){
		
		if($this->post()) {	
			$gig_id = $this->input->post('gig_id');
  			$user_id = $this->input->post('user_id');   
			$result  = $this->gigs->remove_favourites($gig_id,$user_id);
			if($result){
				$this->response([
						'code' => 200,
						'status' => TRUE,
						'message' => 'Favourites has been removed successfully.',
					], REST_Controller::HTTP_OK);	
			}else{
				$this->response([
					'code' => 404,
					'status' => FALSE,
					'message' => 'Something is wrong.',
				], REST_Controller::HTTP_OK);	
			}

		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'Favourites details missing',
			], REST_Controller::HTTP_OK);
		}

	}
	public function favourites_gigs_post(){
		
		if($this->post()) {	
			$user_id = $this->input->post('user_id');  
			
			if(!empty($user_id)){
					$favourites_gig_ids = $this->gigs->favourites_gig_ids($user_id);
			} 

			$records  = $this->gigs->favourites_gigs($user_id);

			if(!empty($favourites_gig_ids)){
				if(!empty($records)){
					$records = favorites_check($records,$favourites_gig_ids);		
				}
			}
		
			if(!empty($records)){
				$this->response([
						'code' => 200,
						'status' => TRUE,
						'message' => 'SUCCESS',
						'data' => $records
					], REST_Controller::HTTP_OK);	
			}else{
				$this->response([
						'code' => 404,
						'status' => TRUE,
						'message' => 'No records were NOT_FOUND',
						'data' => []
					], REST_Controller::HTTP_OK);	
			}

		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'Something is wrong.',
			], REST_Controller::HTTP_OK);
		}

	}
	public function last_visit_post(){
		if($this->post()) {	
			$params = $this->post();
			if(!empty($params['user_id']) && !empty($params['gig_id']) ){
				
				$user_id = $params['user_id'];
				$gig_id = $params['gig_id'];
				$records  = $this->gigs->last_visited_update($user_id,$gig_id);
				if($records){
					$this->response([
						'code' => 200,
						'status' => TRUE,
						'message' => 'SUCCESS',
					], REST_Controller::HTTP_OK);		
				}else{
					$this->response([
						'code' => 404,
						'status' => TRUE,
						'message' => 'Something is wrong',
					], REST_Controller::HTTP_OK);		
				}
				

			}else{
			
            $this->response("Provide complete information to update last visit.", REST_Controller::HTTP_OK);
		 }
		}
	}
		public function last_visited_gigs_post(){
		
		if($this->post()) {	
			$user_id = $this->input->post('user_id'); 
			if(!empty($user_id)){
				$favourites_gig_ids = $this->gigs->favourites_gig_ids($user_id);
			} 
			$records  = $this->gigs->last_visited_gigs($user_id);
			if(!empty($favourites_gig_ids)){
				if(!empty($records)){
					$records = favorites_check($records,$favourites_gig_ids);		
				}
			}

			if(!empty($records)){
				$this->response([
						'code' => 200,
						'status' => TRUE,
						'message' => 'SUCCESS',
						'data' => $records
					], REST_Controller::HTTP_OK);	
			}else{
				$this->response([
						'code' => 404,
						'status' => TRUE,
						'message' => 'No records were found',
						'data' => []
					], REST_Controller::HTTP_OK);	
			}

		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'Something is wrong.',
			], REST_Controller::HTTP_OK);
		}

	}

	public function my_gig_activity_post(){

		$user_id = $this->post('user_id'); 
		if(!empty($user_id)){
			
			//$records['my_purchases_total'] = $this->gigs->get_user_orders_total($user_id); 
			$records['my_purchases'] 	   = $this->gigs->get_user_orders($user_id); 
			//$records['my_sale_total']	   = $this->gigs->get_selluser_details_total($user_id);
			$records['my_sale']      	   = $this->gigs->get_selluser_details($user_id);
			//$records['my_payments_total']  = $this->gigs->getuser_wallets_details_total($user_id);
			$records['my_payments']  	   = $this->gigs->getuser_wallets_details($user_id);
			$records['wallet_balance']     = $this->gigs->wallet_balance($user_id);

			$this->response([
				'code' => 200,
				'status' => TRUE,
				'message' => 'SUCCESS',
				'data' => $records
			], REST_Controller::HTTP_OK);	
			
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'User info missing.',
			], REST_Controller::HTTP_OK);
		}
	}
	public function seller_reviews_post(){

		$user_id = $this->post('user_id'); 
		if(!empty($user_id)){
			$reviews = array();
			$records  = $this->gigs->seller_reviews($user_id);
			if(!empty($records)){
					$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'SUCCESS',
					'data' => $records
				], REST_Controller::HTTP_OK);	
			}else{
				$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'No result were found',
				'data' => $reviews
			], REST_Controller::HTTP_OK);	
			}
			
			
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'User info missing.',
			], REST_Controller::HTTP_OK);
		}
	}
	 
	public function buyer_cancel_post(){
		$params = $this->post();

		
		if(!empty($params['order_id']) && !empty($params['cancel_reason']) && !empty($params['paypal_email']) && !empty($params['user_id']) && !empty($params['time_zone'])){

			$result = $this->gigs->change_gigs_status($params);
			if($result==1){
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'Buyer gig jas been cancelled.',
				], REST_Controller::HTTP_OK);		
			}else{
				$this->response([
					'code' => 404,
					'status' => FALSE,
					'message' => 'Something is wrong, please try again later.',
				], REST_Controller::HTTP_OK);		
			}
			
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'Buyer cancel info missing.',
			], REST_Controller::HTTP_OK);
		}
	}

	 
	public function seefeedback_post(){
		$params = $this->post();
 
		if(!empty($params['from_user_id']) && !empty($params['to_user_id']) && !empty($params['gig_id']) && !empty($params['order_id']) && !empty($params['user_id'])){

			$result = $this->gigs->seefeedback($params);
			if(!empty($result)){
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'Feed Back',
					'data' => $result
				], REST_Controller::HTTP_OK);		
			}
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'seefeedback info missing.',
			], REST_Controller::HTTP_OK);
		}
	}
	
	public function sale_order_status_post(){
		$params = $this->post();

		if(!empty($params['order_id']) && !empty($params['order_status']) && !empty($params['time_zone']) ){
			$params['val'] = 1;
			$result = $this->gigs->sale_change_gigs_status($params);
			if($result==1){
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'Order status has been changed successfully.',
				], REST_Controller::HTTP_OK);		
			}elseif($result==2){
				$this->response([
					'code' => 404,
					'status' => FALSE,
					'message' => 'Something is wrong, please try again later',
				], REST_Controller::HTTP_OK);		
			}
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'sale order change info missing.',
			], REST_Controller::HTTP_OK);
		}
	}

	public function withdram_details_post(){

		$params = $this->post();
		if(!empty($params['order_id']) && !empty($params['user_id'])){
			$user_id  = $params['user_id'];
			$count = $this->gigs->account_checking($user_id);
			if($count>0){
			$id = $params['order_id'];
			$params['val'] = 1;

			$records = $this->gigs->withdram_details($id);
			if(!empty($records)){
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'Order status has been changed successfully.',
					'data' =>$records,
				], REST_Controller::HTTP_OK);		
			}else{
				$this->response([
					'code' => 404,
					'status' => FALSE,
					'message' => 'Something is wrong, please try again later',
				], REST_Controller::HTTP_OK);		
			}
		 }else{
		 	$this->response([
					'code' => 404,
					'status' => FALSE,
					'message' => 'You have not entered your bank account details. Please add your account payment details.',
				], REST_Controller::HTTP_OK);		
		 }
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'withdram info missing.',
			], REST_Controller::HTTP_OK);
		}
	}

	public function withdram_payment_request_post(){

		$params = $this->post();

		if(!empty($params['order_id'])){
			$params['val'] = 1;
			$id = $params['order_id'];

			$records = $this->gigs->payment_request($id);
			if($records==1){
				$status_array = array('payment_status'=>1,'msg'=>'Payment Request','order_id'=>$id);
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'withdraw request has been send successfully.',
					'data' => $status_array,
					
					
				], REST_Controller::HTTP_OK);		
			}elseif($records==2){
				$this->response([
					'code' => 404,
					'status' => FALSE,
					'message' => 'Something is wrong, please try again later',
					'data' => [],
				], REST_Controller::HTTP_OK);		
			}
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'withdram request info missing.',
				'data' => [],
			], REST_Controller::HTTP_OK);
		}
	}

	public function leave_feedback_post(){	
		
		$type = $this->post('type');
		if($type == 1){
			$this->purchases_feedback(); // Buyer Feedback
		}
		if($type == 2){
			$this->seller_feedback(); // Seller Feedback
		}
		
	}

	public function purchases_feedback(){
			
			$params = $this->post();
			
		if(!empty($params['from_user_id']) && !empty($params['to_user_id']) && !empty($params['gig_id']) && !empty($params['order_id']) && !empty($params['comment']) && !empty($params['rating']) && !empty($params['time_zone'])){

			$result = $this->gigs->save_purchase_feedback($params);
			if($result==1){
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'Feedback saved successfully.',
				], REST_Controller::HTTP_OK);		
			}else{
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'Something is wrong, please try again later',
				], REST_Controller::HTTP_OK);		
			}
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'Buyer feedback info missing.',
			], REST_Controller::HTTP_OK);
		}
	}
		
	
	public function seller_feedback(){

		$params = $this->post();

		if(!empty($params['from_user_id']) && !empty($params['to_user_id']) && !empty($params['gig_id']) && !empty($params['order_id']) && !empty($params['comment']) && !empty($params['rating']) && !empty($params['time_zone'])){
			
			$records = $this->gigs->save_feedback($params);
			if($records==1){
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'Seller feedback updated successfully.',
				], REST_Controller::HTTP_OK);		
			}elseif($records==2){
				$this->response([
					'code' => 404,
					'status' => FALSE,
					'message' => 'Something is wrong, please try again later',
				], REST_Controller::HTTP_OK);		
			}
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'seller feedback info missing.',
			], REST_Controller::HTTP_OK);
		}
	}

	public function multiple_withdraw_post(){
		
		$params = $this->post();

		if(!empty($params['user_id']) && !empty($params['order_ids'])){
			$result = 0;
			$result = $this->gigs->multiple_withdraw($params);
			if($result==1){
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'Multiple withdraw has been updated',
				], REST_Controller::HTTP_OK);	
			}else{
				$this->response([
					'code' => 404,
					'status' => FALSE,
					'message' => 'Something is wrong, please try again later',
				], REST_Controller::HTTP_OK);	
			}
			

		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'Multiple withdraw info missing',
			], REST_Controller::HTTP_OK);
		}
	}
	public function accept_buyer_request_post(){
		
		$params = $this->post();

		if(!empty($params['time_zone']) && !empty($params['order_id'])){
			$result = 0;
			$result = $this->gigs->accept_buyer_request($params);
			if($result==1){
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'Cancel has been accepted',
				], REST_Controller::HTTP_OK);	
			}else{
				$this->response([
					'code' => 404,
					'status' => FALSE,
					'message' => 'Something is wrong, please try again later',
				], REST_Controller::HTTP_OK);	
			}
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'Cancel info missing',
			], REST_Controller::HTTP_OK);
		}
	}

	public function overall_withdraw_post(){
		
		$params = $this->post();

		if(!empty($params['user_id'])){
			$result = 0;
			$user_id = $params['user_id'];
			
			$result = $this->gigs->overall_payment_request($user_id);
			if($result==1){
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'Withdraw request has been send',
				], REST_Controller::HTTP_OK);	
			}else{
				$this->response([
					'code' => 404,
					'status' => FALSE,
					'message' => 'Something is wrong, please try again later',
				], REST_Controller::HTTP_OK);	
			}
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'Withdraw info missing',
			], REST_Controller::HTTP_OK);
		}
	}
	public function messages_post(){
			
		$params = $this->post();
		if(!empty($params['user_id'])){
			$result = 0;
			$user_id = $params['user_id'];

			$last_userid = $this->gigs->last_chater($user_id);
			$records = $this->gigs->chart_user_details($user_id);

			if(!empty($records)){
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'SUCCESS',
					'last_chat_user_id' =>$last_userid,
					'data' =>$records
				], REST_Controller::HTTP_OK);	
			}else{
				$this->response([
					'code' => 404,
					'status' => FALSE,
					'message' => 'Something is wrong, please try again later',
				], REST_Controller::HTTP_OK);	
			}
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'Message user info missing',
			], REST_Controller::HTTP_OK);
		}

	}

public function buyer_chat_post(){
		
		$params = $this->post();

		if(!empty($params['sell_gigs_userid']) && !empty($params['chat_message_content']) && !empty($params['user_id'])){
			$result = 0;
			$result = $this->gigs->save_buyerchat($params);

			if($result==1){
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'Contact message has been send',
				], REST_Controller::HTTP_OK);	
			}else{
				$this->response([
					'code' => 404,
					'status' => FALSE,
					'message' => 'Something is wrong, please try again later',
				], REST_Controller::HTTP_OK);	
			}
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'Buyer chat info missing',
			], REST_Controller::HTTP_OK);
		}
	}

	public function chat_details_post(){
		
		$params = $this->post();

		if(!empty($params['from_user_id']) && !empty($params['to_user_id'])){
			$result = 0;
			$f_user = $params['from_user_id'];
			$t_user = $params['to_user_id'];
			$page = $params['page'];
			$result = $this->gigs->get_chat_details($f_user,$t_user,$page);
			if($result){
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'SUCCESS',
					'data' => $result
				], REST_Controller::HTTP_OK);	
			}else{
				$this->response([
					'code' => 404,
					'status' => FALSE,
					'message' => 'Something is wrong, please try again later',
				], REST_Controller::HTTP_OK);	
			}
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'Chat user info missing',
			], REST_Controller::HTTP_OK);
		}
	}
	
	 

	// Push Notification API 
	
	public function push_notification_post(){
		
		$params = $this->post();
		$API_details  = $this->gigs->settings();
		$include_player = $this->gigs->player_ids($params['user_id']);
		$include_player_ids = $include_player['device_id'];

        if($include_player['device']!='browser'){ // Stop Browser notiticfications 


		if(!empty($API_details['one_signal_app_id']) && !empty($API_details['one_signal_reset_key']) && !empty($params['user_id']) && !empty($params['message'])){

			$data = array();	 
			$data['user_id'] = $params['user_id'];
			$data['message'] = $params['message'];
			$data['app_id'] = $API_details['one_signal_app_id'];
			$data['reset_key'] = $API_details['one_signal_reset_key'];
			$data['include_player_ids'] = $include_player_ids;
			$data['additional_data'] = array();
		 	$result = send_message($data);
			$result = (array)json_decode($result);
		 	
			if(is_array($result)){
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'SUCCESS',
					'data' => $result
				], REST_Controller::HTTP_OK);	
			}else{
				$this->response([
					'code' => 404,
					'status' => FALSE,
					'message' => 'Something is wrong, please try again later',
				], REST_Controller::HTTP_OK);	
			}
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'Push notification info missing',
			], REST_Controller::HTTP_OK);
		}
	}

	}

	public function user_chat_post(){

		$params = $this->post();
		

		if(!empty($params['from_user_id']) && !empty($params['to_user_id']) && !empty($params['message'])){
   	  		
   	  		$result  = $this->gigs->chat_update($params);
			if(is_array($result)){
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'SUCCESS',
					'data' => $result
				], REST_Controller::HTTP_OK);	
			}else{
				$this->response([
					'code' => 404,
					'status' => FALSE,
					'message' => 'Something is wrong, please try again later',
				], REST_Controller::HTTP_OK);	
			}
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'Chat info missing',
			], REST_Controller::HTTP_OK);
		}
	}

	public function save_device_id_post(){
		$params = $this->post();
		if(!empty($params['device_id']) && !empty($params['user_id'])){
			$result  = $this->gigs->save_device_id($params);
			if($result == 1 ){
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'SUCCESS'
				], REST_Controller::HTTP_OK);	
			}else{
				$this->response([
					'code' => 404,
					'status' => FALSE,
					'message' => 'Something is wrong, please try again later',
				], REST_Controller::HTTP_OK);	
			}
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'Device ID or User id missing',
			], REST_Controller::HTTP_OK);
		}	
	}

	public function buy_now_post(){
		
		$params = $this->post();

		if (!empty($params['gig_id']) && !empty($params['seller_id']) && !empty($params['gig_rate']) && !empty($params['buyer_id']) && !empty($params['total_delivery_days']) ) {

			$data_array = json_decode($params['options'],true);
			$datas = array();

			$i = 0 ;
			$extra_gig_amount = 0 ;
			if(!empty($data_array)){
			foreach ($data_array as  $value) {
				
				$extra_gigs_amount = $value['extra_gigs_amount'];
				$extra_gig_amount += $extra_gigs_amount;
				$data_string = $value['extra_gigs'].'___'.$value['gigs_id'].'___'.$this->default_currency_sign.'___'.$extra_gigs_amount.'___'.$value['extra_gigs_delivery'];
				$datas[$i]['gig_id'] = $params['gig_id'];
				$datas[$i]['user_id'] = $params['buyer_id'];
				$datas[$i]['currency_type'] = $this->default_currency;
				$datas[$i]['options'] = json_encode($data_string);
				$datas[$i]['status'] = '1';	
				++$i;
			}
		}
			$params['extra_gig_row_id'] = '""';
			if(!empty($datas)){
				$extra_gig_row_id  = $this->gigs->user_request_gigs($datas);	
				if(is_array($extra_gig_row_id)){
					$params['extra_gig_row_id'] = '"'.implode(',', $extra_gig_row_id).'"';
				}
			}
			unset($params['options']);
			$records  = $this->gigs->buy_now_gig($params,$extra_gig_amount);
			
			if(!empty($records)){
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'SUCCESS',
					'data' => $records
				], REST_Controller::HTTP_OK);	
			}else{
				$this->response([
					'code' => 404,
					'status' => FALSE,
					'message' => 'Something is wrong, please try again later',
				], REST_Controller::HTTP_OK);	
			 }
			}else{

			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'Buy info missing',
			], REST_Controller::HTTP_OK);
		}	
	}

	public function paypal_success_post(){
		
		$params = $this->post();

		if (!empty($params['paypal_uid']) && !empty($params['item_number'])) {
				
			$records  = $this->gigs->paypal_success($params);

			if(!empty($records)){
				$this->response([
					'code' => 200,
					'status' => TRUE,
					'message' => 'SUCCESS',
					'data' => $records
				], REST_Controller::HTTP_OK);	
			}else{
				$this->response([
					'code' => 404,
					'status' => FALSE,
					'message' => 'Something is wrong, please try again later',
				], REST_Controller::HTTP_OK);	
			 }
			}else{

			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'PayPal Return info missing',
			], REST_Controller::HTTP_OK);
		}	
	}


	public function footer_get() {

		$footer = $this->gigs->GetAllFooter();
		if(!empty($footer)){
			$this->response([
						'code' => 200,
						'status' => TRUE,
						'message' => 'SUCCESS',
						'primary' => $footer
					], REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'code' => 404,
				'status' => FALSE,
				'message' => 'No category were found.'
			], REST_Controller::HTTP_OK);
		}
	}

    public function payment_gateways_get() {

        $gateways = $this->gigs->GetAllPaymentGateway();
        if(!empty($gateways)){
            $this->response([
                        'code' => 200,
                        'status' => TRUE,
                        'message' => 'SUCCESS',
                        'primary' => $gateways
                    ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'code' => 404,
                'status' => FALSE,
                'message' => 'No payment gateway were found.'
            ], REST_Controller::HTTP_OK);
        }
    }

    public function currencies_get() {

        $currencies = $this->gigs->get_currencies();
        if(!empty($currencies)){
            $this->response([
                        'code' => 200,
                        'status' => TRUE,
                        'message' => 'SUCCESS',
                        'primary' => $currencies
                    ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'code' => 404,
                'status' => FALSE,
                'message' => 'No currencies were found.'
            ], REST_Controller::HTTP_OK);
        }
    }

 
}

?>
