<?php 
class Payment_gateway extends CI_Controller {
    public $data;
	
    public function __construct() {
        parent::__construct();
        $this->data['theme'] = 'admin';
        $this->data['module'] = 'payment_gateways';
        $this->load->model('admin_panel_model'); 
		      
    }

    public function index($offset = 0) {      
       $this->load->library('pagination');
        $config['base_url'] = site_url("admin/payment_gateway/");
        $config['per_page'] = 15;
				 
        $config['total_rows'] = $this->db->count_all_results('payment_gateways');
		
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
       // $this->payment_gateway->initialize($config);
        $this->data['page'] = 'index';
       // $this->data['links'] = $this->payment_gateway->create_links();
        $this->data['list'] = $this->admin_panel_model->all_payment_gateway($offset,$config['per_page']);
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }	
	
	public function create()
	{
		
		if($this->input->post('form_submit'))	
		{
			//print_r($this->input->post());exit;
			$data['gateway_name'] = $this->input->post('gateway_name');
			$data['gateway_type'] = $this->input->post('gateway_type');
			$data['api_key'] = $this->input->post('api_key');
			$data['value'] = $this->input->post('value');
			$data['status'] = $this->input->post('status');
			if($this->db->insert('payment_gateways',$data))
			{
			$message='<div class="alert alert-success text-center fade in" id="flash_succ_message">Payment Gateway create successfully.</div>';
			}
			$this->session->set_flashdata('message',$message);
			redirect(base_url().'admin/payment_gateway');			
		}
		   $this->data['page'] = 'create';
		   $this->load->vars($this->data);
	       $this->load->view($this->data['theme'] . '/template');
	}

	public function edit($id)
	{
		if($this->input->post('form_submit'))	
		{
			$data['gateway_name'] = $this->input->post('gateway_name');
			$data['gateway_type'] = $this->input->post('gateway_type');
			$data['api_key'] = $this->input->post('api_key');
			$data['value'] = $this->input->post('value');
			$data['status'] = $this->input->post('status');
			$this->db->where('id',$id);
			if($this->db->update('payment_gateways',$data))
			{
			$message='<div class="alert alert-success text-center fade in" id="flash_succ_message">Payment gateway edit successfully.</div>';
			}
			$this->session->set_flashdata('message',$message);
			redirect(base_url().'admin/payment_gateway');	
		}
		   $this->data['list'] =	$this->admin_panel_model->edit_payment_gateway($id);
		   $this->data['page'] =    'edit';
		   $this->load->vars($this->data);
	       $this->load->view($this->data['theme'] . '/template');
		
	}
	
	public function delete()
	{
		$id = $this->input->post('tbl_id'); 
		$this->db->where('id',$id);
		if($this->db->delete('payment_gateways'))
		{
		 $message='<div class="alert alert-success text-center fade in" id="flash_succ_message">Payment Gateway deleted successfully.</div>';
			
			echo 1;
		}
		   $this->session->set_flashdata('message',$message);
	}
	
	
}

?>