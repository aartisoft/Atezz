<?php 
class User_login_model extends CI_Model{
    public function check_login($username,$password)
    {
        $query = $this->db->query("SELECT * FROM `members` WHERE (`email` = '$username' OR `username` = '$username') AND `password` = md5('$password') ;");
        $result = $query->row_array();     
        return $result;
    }
	public function check_facebook_login($email_id,$id)
	{
	$query = $this->db->query("SELECT * FROM `members` WHERE (`facebook_id` = $id OR email = '$email_id') AND `status` = 0 ");	
	$result = $query->row_array();
	return $result ;
	}
	public function check_google_login($email_id,$id)
	{
	$query = $this->db->query("SELECT * FROM `members` WHERE (`google_id` = $id OR email = '$email_id') AND `status` = 0 ");	
	$result = $query->row_array();
	return $result ;
	}
}
?>