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
class YbsService_Model extends CI_Model {
  

	
	function __construct(){
        parent::__construct();
    }
	

	
    public function get_data_combobox($table_name,$field_show,$where,$value_where){
		
		$afs = explode(",",$field_show);
		
		$con='CONCAT('.$afs[0];
		$str = "";
		 $x =0;
		foreach($afs as $val){
			if($x>0){
				$str .=  ', " - " ,'. $val ;
			}
			
			$x++;
		}
		
		
		$final  = $con . $str . ") as text";
		
		
		//$field_show = $field_show . ' as text';
		$afield = array(
			'id as value',
			//$field_show,
			$final,
		);	
	
		$this->db->select($afield);
		if($where !==""){
		   $this->db->where($where,$value_where);
		}
	 
		$query=$this->db->get($table_name);
		return $query->result_array();
    }
	
	
	
	
	

       
}
