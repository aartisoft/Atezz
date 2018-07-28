<?php 



class Projeto_solidario extends CI_Controller{

    public function __construct() {

        parent::__construct();  
        $this->load->helper('currency');
        $this->load->library('paypal_lib');

        $this->load->model('gigs_model');

        $this->load->model('user_panel_model');

        

        $this->load->helper('favourites');

        $common_settings = gigs_settings();
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
        $this->smtp_config           = smtp_mail_config();

        $result = gigs_settings();


          $uid = '';

            if(isset($this->session->userdata)){

                $userid = $this->session->userdata; 

                if(isset($userid['SESSION_USER_ID'])){

                    $uid = $userid['SESSION_USER_ID']; 

                    
                    $verify_user = $this->user_panel_model->verify_Premium($uid); 
                    $this->data['verify_user_premium'] = $uid;

                }

            }


        $this->data['theme'] = 'user';              

        $this->data['slogan']                    = $this->user_panel_model->get_slogan();

        $this->data['list_plans']                = $this->user_panel_model->get_plan();

        $this->data['footer_main_menu']          = $this->user_panel_model->footer_main_menu();

        $this->data['footer_sub_menu']           = $this->user_panel_model->footer_sub_menu();

        $this->data['system_setting']            = $this->user_panel_model->system_setting();    

        $this->data['policy_setting']            = $this->user_panel_model->policy_setting();   

        $this->data['categories_subcategories']  = $this->user_panel_model->categories_subcategories();

        //$this->data['rupee_dollar_rate']         = $this->user_panel_model->get_rupee_dollar_rate();

        

        //$this->data['country_list']              = $this->user_panel_model->country_list(); 

        

        //$this->email_address='mail@example.com';

        //$this->email_tittle='Gigs';

        //$this->logo_front=base_url().'assets/images/logo.png';

        //$this->site_name ='gigs';

        

        //$this->secret_key = '';

        //$this->publishable_key = '';



        //$publishable_key =  '';

        //$secret_key =  '';

        //$live_publishable_key =  '';

        //$live_secret_key =  '' ;



        if(!empty($result))

        {

            foreach($result as $data){

                if($data['key'] == 'email_address'){

                    $this->email_address = !empty($data['value']) ? $data['value'] : 'mail@example.com' ;

                }

                if($data['key'] == 'email_tittle'){

                    $this->email_tittle = !empty($data['value']) ? $data['value'] : 'Gigs' ;

                }

                if($data['key'] == 'admin_commision'){

                    $this->admin_commision = !empty($data['value']) ? $data['value'] : '0' ;

                }

                if($data['key'] == 'base_domain'){

                    $this->base_domain = $data['value'];

                }

                if($data['key'] == 'logo_front'){

                    $this->logo_front = $data['value'];

                }

                if($data['key'] == 'site_name' ||  $data['key'] == 'website_name'){

                    $this->site_name = $data['value'];

                }





                if($data['key'] == 'live_publishable_key'){

                    $live_publishable_key = $data['value'];

                }



                if($data['key'] == 'live_secret_key'){

                    $live_secret_key = $data['value'];

                }





                if($data['key'] == 'publishable_key'){

                    $publishable_key = $data['value'];

                }



                if($data['key'] == 'secret_key'){

                    $secret_key = $data['value'];

                }

                if($data['key'] == 'stripe_option'){

                    $stripe_option = $data['value'];

                }



                $this->data['currency_option'] = 'USD';

                if($data['key']=='currency_option'){

                    $this->data['currency_option'] =$data['value'];

                }

         

            }



            if($stripe_option == 1){

                $this->publishable_key = $publishable_key;

                $this->secret_key      = $secret_key;

            }

            if($stripe_option == 2){

                $this->publishable_key = $live_publishable_key;

                $this->secret_key      = $live_secret_key; 

            }

        }

        //$rupee_dollar_rate                         = $this->data['rupee_dollar_rate'];

        // if(($this->session->userdata('time_zone')))

        // {       

        //     $this->data['time_zone'] = $this->session->userdata('time_zone');        

        //     $this->data['full_country_name'] = $this->session->userdata('full_country_name');

        //     $this->data['country_name'] = $this->session->userdata('country_name');       

        //     // Start Here always get DB Currency Rate And Set into Session

        //     //  $this->session->set_userdata('dollar_rate',$rupee_dollar_rate['dollar_rate']); 

        //     //  $this->session->set_userdata('rupee_rate',$rupee_dollar_rate['indian_rate']);

        //     // End  

        //     $this->data['dollar_rate'] = $this->session->userdata('dollar_rate');  

        //     $this->data['rupee_rate'] = $this->session->userdata('rupee_rate'); 

        // }        

        // else             

        // {

            // $user_ip = getenv('REMOTE_ADDR');     

        /*$this->data['dollar_rate']            =  $rupee_dollar_rate['dollar_rate'] ;  

        $this->data['rupee_rate']           =  $rupee_dollar_rate['indian_rate']; */

        // if(isset($this->data['dollar_rate'])){

        //     $this->session->set_userdata('dollar_rate',$this->data['dollar_rate']);     

        // }

        // if(isset($this->data['rupee_rate'])){

        //     $this->session->set_userdata('rupee_rate',$this->data['rupee_rate']);               

        // }

    // }





    // $gig_price = $this->gigs_model->gig_price();

    // $this->data['gig_price'] = $gig_price['value'];

    // $extra_gig_price = $this->gigs_model->gig_price();

    // $this->data['extra_gig_price'] = $extra_gig_price['value'];

}

public function index($offset=0)

{  

    

    $uid = '';


    $this->data['page_title'] = 'Buy Service';


    $this->load->library('pagination');

    $config['base_url'] = base_url().'projeto_solidario';

    $config['per_page'] = 16;                

    $config['total_rows'] =  $this->gigs_model->buy_service(0,0,0,$uid);   

    $this->data['total_records'] = $config['total_rows']; 



    $config['uri_segment'] = 2;     

    $config['full_tag_open'] = '<ul class="pagination">';

    $config['full_tag_close'] = '</ul>';

        //$config['reuse_query_string'] = TRUE;

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

    $this->data['list'] =   $this->gigs_model->buy_service(1,$offset,$config['per_page'],$uid);       

    $this->data['user_favorites'] = $this->gigs_model->add_favourites();

    $this->data['module'] = 'projeto_solidario';

    $this->data['page'] = 'index';

    $this->data['search_value'] = 'Projetos Solidários';   

    $this->data['search_type'] = 'Location';

    $this->data['total_results'] =count($this->data['list']);

    $this->load->vars($this->data);    

    $this->load->view($this->data['theme'] . '/template'); 



} 

}

    ?>