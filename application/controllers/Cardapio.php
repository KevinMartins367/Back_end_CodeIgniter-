<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cardapio extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
    {
        parent::__construct();
        $this->load->model('CardapioModel', 'cardapio', TRUE);
		$this->load->helper('url');
    } 
	 
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	public function get_cardapio($id){
		$pratos = $this->cardapio->get_pratos($id);
		$response = array();
		foreach($pratos as $res){
			$prato = array();
			$prato["id"] = $res->id;
			$prato["nome"] = $res->nome;
			$prato["tipo"] = $res->tipo;
			$prato["ingredientes"] = $res->ingredientes;
			$prato["preco"] = "15";
			$prato["imgurl"] = $res->img_url;			
			array_push($response, $prato);
		}
		echo json_encode($response);
	}
	
	
}