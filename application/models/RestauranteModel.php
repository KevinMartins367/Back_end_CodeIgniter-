<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class RestauranteModel extends CI_Model
{
   function __construct()
   {
        parent::__construct();
   }
   function get_restaurantes(){	
		//Inicio da montagem do select 
		$this->db->select('res.id as id_restaurante, 
		res.nome as nome, 
		res.pedido_url as pedido_url, 
		res.tipo as tipo, 
		res.telefone as telefone, 
		res.celular as celular, 
		res.endereco as endereco, 
		res.flag_pedido_cadastrado as flag_pedido_cadastrado, 
		res.latitude as latitude, 
		res.longitude as longitude, 
		foto.img_url as img_url');
		
		//Seta from
        $this->db->from('restaurante as res');
		//Seta o Join com a tabela de fotos
        $this->db->join('restaurante_foto as foto', 'res.id = foto.restaurante_id');
		//Executa a query
        $query = $this->db->get();
		//Verifica se retornou alguma informacao
        if ($query->num_rows() > 0)
        {
            $data = $query->result();
			//Retorna o resultado da query
            return $data;
        }
        else
            return array();				
	}
}