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
class Crud_generator_model extends CI_Model {

	function __construct(){
        parent::__construct();
    }

	function get_table_list(){
		$table = $this->db->list_tables();
		$table_list = array();
		$x=0;
		foreach($table as $val){
			$ex = explode('_',$val);
			if($ex[0] <> 'sysx' ){
				$table_list[$x] = $val;
				$x++;
			}
		}
		return $table_list;
	}

	
	function get_field_info($table_name){
		return $this->db->field_data($table_name);
	}
	
	function create_field_user_input($table_name){
		$this->load->dbforge();
		if (!$this->db->field_exists('user_input', $table_name)){
				$fields = array( 'user_input' => array('type' => 'INT'));
				$this->dbforge->add_column($table_name, $fields);
		}
		
	}
	
	function get_count($table_name){
      return$this->db->count_all($table_name);
	}

	
}	