<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CardapioModel extends CI_Model
{
   function __construct()
   {
        parent::__construct();
   }
	function get_cardapio($id){				
		$this->db->where('restaurante_id', $id);
        $query = $this->db->get('prato');
        if ($query->num_rows() > 0) 
        {
            $data = $query->result();
            return $data;
        }
        else
            return array();

   }
}