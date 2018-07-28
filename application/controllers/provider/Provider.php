<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Provider extends CI_Controller{

    public function __construct() {

    parent::__construct();

    $this->load->model('Provider_panel_model');


    }

	public function index (){	     
		$dados['Titulo'] = 'Teste de Título';
		$dados['Conteudo'] = 'Abriu Aquiiii!';

    	$this->load->view('provider/provider', $dados);

    }


	public function Login (){	 
    	$this->Provider_panel_model->salvar();
    }
}


?>