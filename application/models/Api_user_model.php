<?php 
class Api_user_model extends CI_Model
{
    public function __construct() { 

        parent::__construct();
        $this->email_address = 'mail@example.com';
        $this->email_tittle  = 'Gigs';
        $this->logo_front    = base_url().'assets/images/logo.png';
        $this->site_name     = 'Gigs';
        $this->base_domain   = base_url();
    }
    
     public function check_email($email)
    {        
        $query = $this->db->query("SELECT * FROM `members` WHERE `email` = '$email';");
 
        $result = $query->num_rows();
        return $result;          
    } 

    public function check_username($username)
    {        
        $query = $this->db->query("SELECT * FROM `members` WHERE `username` = '$username';");
        $result = $query->num_rows();
        return $result;          
    }


     public  function getRows($id = ""){
        
        if(!empty($id)){
            $query = $this->db->get_where('members', array('USERID' => $id,'USERID !=' => 1));
            return $query->row_array();
        }else{
            $query = $this->db->get_where('members', array('USERID !=' => 1));
            return $query->result_array();
        }
    } 
    public function getCountry(){

        $this->db->select('id,country');
        $this->db->from('country');
        $this->db->where( array('country_status' => 1));
        return $this->db->get()->result_array();
    }

    public function getCountryState($id){
        $this->db->select('state_id,state_name');
        $this->db->from('states');
        $this->db->where(array('state_status' => 1,'country_id'=>$id));
        return $this->db->get()->result_array();
    }

       /*
     * Insert user data
     */
    public function insert($data = array()) {

        $insert = $this->db->insert('members', $data);
        if($insert){

         $username = $data['username'];                                                          
        $url_encypted = urlencode($this->encryptor('encrypt',$username));
        $url= base_url().'activate_account/'.$url_encypted;                                         
        $this->load->model('templates_model');
        $message='';
        $welcomemessage='';
        $bodyid=13;
        $tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);       
        $body=$tempbody_details['template_content'];
        $body = str_replace('{base_url}', $this->base_domain, $body);
        $body = str_replace('{base_image}',$this->logo_front, $body);
        $body = str_replace('{USER_NAME}', $username, $body);
        $body = str_replace('{sitetitle}',$this->site_name, $body);
        $body = str_replace('{SUBMIT_LINK}', $url, $body);
        $message ='<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
            <tr>
                <td></td>
                <td width="600" style="box-sizing: border-box; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
                    <div style="box-sizing: border-box; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                        <table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff">
                            <tr>
                                <td style="box-sizing: border-box; vertical-align: top; text-align: left; margin: 0; padding: 20px;" valign="top">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="text-align:center;">
                                                <a href="{base_url}" target="_blank"><img src="'.$this->logo_front.'" style="width:90px" /></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>'.$body.'</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <div style="box-sizing: border-box; width: 100%; clear: both; color: #999; margin: 0; padding: 15px 15px 0 15px;">
                            <table width="100%">
                                <tr>
                                    <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0;" align="center" valign="top">
                                        &copy; '.date("Y").' <a href="'.$this->base_domain.'" target="_blank" style="color:#bbadfc;" target="_blank">'.$this->site_name.'</a> All Rights Reserved.
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
        </table>';        

        $this->load->helper('file');  
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->from($this->email_address,$email_tittle); 
        $this->email->to($data['email']); 
        $this->email->subject('Welcome and thank you for joining '.$this->site_name);
        $this->email->message($message);
        $this->email->send();
        return $this->db->insert_id();

        }else{
            return false;
        }
    }

    public function forgot_password($email_id){

                $query = $this->db->query("SELECT username,verified,status FROM  `members` WHERE  `email` =  '$email_id'");
                $username = $query->row_array();
                if (!empty($username)) {
                    if ($username['verified'] == 0 && $username['status'] == 0) { 

                $username = trim($username['username']);        
                $url_encypted = urlencode($this->encryptor('encrypt',$username));
                $query = $this->db->query("Update  `members` SET forget='$url_encypted' WHERE  `email` =  '$email_id'");
                $url=base_url().'change_password/'.$url_encypted;                  
                
                $this->load->model('templates_model');
                    $message='';                    
                    $bodyid=14;
                    $tempbody_details= $this->templates_model->get_usertemplate_data($bodyid);
                    $body=$tempbody_details['template_content'];
                    $body = str_replace('{sitetitle}',$this->site_name, $body);
                    $body = str_replace('{base_url}', $this->base_domain, $body);
                    $body = str_replace('{base_image}',$this->base_domain.'/'.$this->logo_front, $body);
                    $body = str_replace('{USER_NAME}', $username, $body);
                    $body = str_replace('{SUBMIT_LINK}', $url, $body);

                    $message ='<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
                                <tr>
                                    <td></td>
                                    <td width="600" style="box-sizing: border-box; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
                                        <div style="box-sizing: border-box; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                                            <table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff">
                                                <tr>
                                                    <td style="box-sizing: border-box; vertical-align: top; text-align: left; margin: 0; padding: 20px;" valign="top">
                                                        <table width="100%" cellpadding="0" cellspacing="0">
                                                            <tr>
                                                                <td style="text-align:center;">
                                                                    <a href="{base_url}" target="_blank"><img src="'.$this->logo_front.'" style="width:90px" /></a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>'.$body.'</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div style="box-sizing: border-box; width: 100%; clear: both; color: #999; margin: 0; padding: 15px 15px 0 15px;">
                                                <table width="100%">
                                                    <tr>
                                                        <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0;" align="center" valign="top">
                                                            &copy; '.date("Y").' <a href="'.$this->base_domain.'" target="_blank" style="color:#bbadfc;" target="_blank">'.$this->site_name.'</a> All Rights Reserved.
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>';                       
                    $this->load->helper('file');  
                    $this->load->library('email');
                    $this->email->set_newline("\r\n");                   
                    $this->email->from($this->email_address,$this->email_tittle); 
                    $this->email->to($email_id); 
                    $this->email->subject('Forgot Password on '.$this->site_name);
                    $this->email->message($message);
                    $this->email->send();
                    return 1;

                    }else{
                        return 3; // Not Activete Account 
                    }
                }else{
                    return 2;
                }
                

    }
    
    public function check_login($username,$password)
    {



        $this->db->select('USERID AS userid, email,username,fullname,user_timezone,verified,status,city,address,zipcode,lang_speaks,country,state,profession,contact,description,user_profile_image,user_thumb_image');
        $this->db->from('members');
        $this->db->where('password',md5($password));
        $this->db->where("(`email` = '$username' OR `username` = '$username')");       
        $result =  $this->db->get()->row_array();
         
        return $result;
    }

     function encryptor($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    //pls set your unique hashing key
    $secret_key = 'muni';
    $secret_iv = 'muni123';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    //do the encyption given text/string/number
    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        //decrypt the given text/string/number
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
    }

    public function getprofession(){

        $this->db->select('id,profession_name');
        $this->db->from('profession');
        $this->db->where( array('status' => 0));
        $this->db->order_by('profession_name ', 'asc');
        return  $this->db->get()->result_array();
         

    }

     public function chnage_pssword($current_password,$new_password,$id) {
         
         $records = $this->db->where(array('USERID' =>$id, 'password'=>md5($current_password)))->count_all_results('members');
         if ($records==1) {
            $this->db->where('USERID',$id);
            $this->db->update('members', array('password' =>md5($new_password) ));
            return 1; // success 
         }else{
            return 2;  // Fail 
         }
    }
    public function paypal_setting($paypalemail,$user_id){

          $valid_result  = $this->db->where(array('USERID' =>$user_id ))->count_all_results('members');

        if($valid_result == 1){
         $records = $this->db->where(array('user_id' =>$user_id))->count_all_results('bank_account');
         if($records == 0){
            
            $this->db->insert('bank_account',array('paypal_email_id'=>$paypalemail,'user_id' =>$user_id));
            return 1;
         }elseif($records == 1){
            $this->db->where('user_id',$user_id);
            $this->db->update('bank_account',array('paypal_email_id'=>$paypalemail));
            return 2;
         }   
         }else{
            return 0;
         }

    }
    public function setting_profile_update($data,$user_id){
        $data = array_filter($data); 
        if(!empty($data)){
            $this->db->where('USERID',$user_id);
            return $this->db->update('members', $data);    
        }else{
            return FALSE;
        }
        
    }

     public function edit_profile($userid){

        $this->db->select('USERID AS userid, email,username,fullname,user_timezone,verified,status,city,address,IF(zipcode="0" ,"",zipcode) as zipcode,lang_speaks,country,state AS state_id,S.state_name,profession,contact,description,user_profile_image,user_thumb_image');
        $this->db->from('members');
        $this->db->join('states AS S', 'S.state_id = members.state', 'left');
        $this->db->where('USERID',$userid);
        $result =  $this->db->get()->row_array();
        return $result;

    }
            
}
?>