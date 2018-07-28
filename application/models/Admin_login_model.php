<?php 
class admin_login_model extends CI_Model
{
    public function is_valid_login($username,$password)
            {
        $query = $this->db->query("SELECT ADMINID FROM `administrators` WHERE `username` = '".$username."' AND `password` = '".md5($password)."'; ");
	   $result = $query->row_array();
        return $result;        
            }    
    public function is_valid_password($id,$password)
            {
        $query = $this->db->query("SELECT ADMINID FROM `administrators` WHERE `ADMINID` = '".$id."' AND `password` = md5('".$password."'); ");
        $result = $query->num_rows();         
        return $result;        
            }        
     
            
}
?>