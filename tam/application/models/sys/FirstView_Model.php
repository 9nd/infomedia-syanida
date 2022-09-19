<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Authorization
 *
 * @author Dhiya
 */
class FirstView_Model extends CI_Model {
    
    public function  get_firstview(){
      $query=$this->db->get('sys_firstview');	  
	  $value = $query->result_array()[0];	  
	  
	  $data = $this->get_menu_name($value['initial'],$value['id_menu']);
	  $data['initial'] = $value['initial'];
	  return $data; 
    }
	
	private function get_menu_name($initial,$idmenu){
		 $this->db->where('id',$idmenu);
		 $query=$this->db->get($initial.'_menu');
		 return $query->result_array()[0];	
	}
	
	

    
}
