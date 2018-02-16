<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('Modelo', 'banco', TRUE);
				$this->load->helper('url');
     }

	public function cadastrar_usuario_ionic(){
		$msg = "";
		$request = array();
		$json = file_get_contents('php://input');
  	$request = json_decode($json, true);
  	$nome = "";
  	$email = "";
		$password = "";
    	if(!empty($request)){

    		foreach ($request as $key => $val){
		        if($key == "nome"){
		        	$nome = $val;
		        }else if($key == "email"){
		        	$email = $val;
		        }else if($key == "password"){
							$password = password_hash($val, PASSWORD_DEFAULT);
		        }else{
							$msg = "valor enviado invalido";
						}
		    }

				$dados = array(
					'nome' => $nome,
					'email' => $email,
					'password' => $password
				);

				if($this->db->insert('usuarios_app', $dados)){
					$insert_id = $this->db->insert_id();
					$msg = $insert_id."|sucesso";
				}else{
					$msg = "Ocorreu algum erro";
				}
			} else{
		    $msg = "Erro ao enviar os dados";
			}
			echo $msg;
	}
	//-------------------------------------------------------
	public function login_ionic(){
		$msg = "";
		$request = array();
		$json = file_get_contents('php://input');
    	$request = json_decode($json, true);
    	$email = "";
			$password = "";
    	if(!empty($request))
    	{
    		foreach ($request as $key => $val)
    		{
					  if($key == "email"){
		        	$email = $val;
		        }else
		        if($key == "password"){
		        	$password = $val;
		        }else{
							$msg = "valor enviado invalido";
						}
		    }
				$retornoLogin = $this->banco->validate_login($email,$password);
				if($retornoLogin){
					foreach($retornoLogin as $ret)
					$user_id = $ret->id;
					$msg = $user_id."|sucesso";
				}else{
					$msg = "Email ou senha inválidos";
				}
		}
		else
		{
		    $msg = "Erro ao enviar os dados";
		}
		echo $msg;
	}


}
