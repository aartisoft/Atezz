<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Provider_panel_model extends CI_Model{

    public function __construct() {
    	parent::__construct();	
    }

    public function salvar(){
    	echo ('salvo');
    }

}
?>