<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurante extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('RestauranteModel', 'restaurante', TRUE);
		$this->load->helper('url');
    } 
	 
	public function get_restaurante(){
		// executa a funcao get_restaurante no nosso model
		$restaurantes = $this->restaurante->get_restaurantes();	
		// declara uma varialvel como array para retorno do json	
		$response = array();
		// foreach para percorrer o array que foi retornado do banco de dados
		foreach($restaurantes as $res){
			// declara um novo array para colocar restaurante por restaruante
			$restaurante = array();
			$restaurante["id"] = $res->id_restaurante;
			$restaurante["nome"] = $res->nome;
			$restaurante["telefone"] = $res->telefone;
			$restaurante["imgurl"] = $res->img_url;			
			array_push($response, $restaurante);
		}
		// faz parce do array para json 
		// OBS: O formato do Json deve corresponder com objeto no seu aplicativo
		// por exemplo deve se conter um objeto Restaurante que contem as variaveis
		//	id,nome,telefone,imgurl
		echo json_encode($response);
	}
	
	
}