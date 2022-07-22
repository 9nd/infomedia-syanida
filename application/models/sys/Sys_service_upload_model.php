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
class Sys_service_upload_model extends CI_Model {
  
	public $insert_id;

	
	function __construct(){
        parent::__construct();
		
    }
	

	public function upload_file($user_id,$file_path,$orig_name,$name,$ext,$time){
		$d = array(
			'id_user'	=> $user_id,
			'file_path'	=> $file_path,
			'orig_name'	=> $orig_name,
			'name'		=> $name,
			'ext'		=> $ext,
			'time'		=> $time,	
		);
		$this->db->trans_start(); 
		$this->db->insert('sys_user_upload',$d);
		$this->insert_id = $this->db->insert_id();	
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	public function upload_file_temp($user_id,$target_path,$orig_name,$name,$ext,$time){
			$d = array(
			'id_user'		=> $user_id,
			'file_path'		=> $target_path,
			'orig_name'		=> $orig_name,
			'name'			=> $name,
			'ext'			=> $ext,
			'time'			=> $time,	
		);
		$this->db->trans_start(); 
		$this->db->insert('sys_user_upload_temp',$d);
		$this->insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	
	
	
	
	
	

       
}
