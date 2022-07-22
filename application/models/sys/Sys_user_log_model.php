<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sys_user_log_model extends CI_Model{

	public $id;
  

    function __construct()
    {
        parent::__construct();
    }
	public function get_by_id($id){
		$afield = array('*');
		$this->db->select($afield);

		$this->db->where('id', $id);
		return $this->db->get('sys_user_log_login')->row();
   }
	
	function create_log_login($data){
		$this->db->trans_start();
		
		
	
		$this->db->where('sys_user_log_login.id_user',$data['id_user']);
		$this->db->where('sys_user_log_login.logout_time',null);
		$dlogout = $this->db->get("sys_user_log_login")->row();
		
		if($dlogout){
			$dupl = array();
			$dupl['logout_time'] = time();
			$this->db->where('sys_user_log_login.id_user',$data['id_user']);
			$this->db->where('sys_user_log_login.logout_time',null);
			$this->db->update('sys_user_log_login', $dupl);
			
			$this->db->insert('sys_user_log_login', $data);
		}else{
			$this->db->insert('sys_user_log_login', $data);		
		}
		
		
		
		/* id primary yg baru saja di input*/
		$this->id = $this->db->insert_id(); 
	
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false
	}
	
	
	function create_log_logout($id_login){
			/* transaction rollback */
		$this->db->trans_start();
		$dlog = array();
		$dlog['logout_time']  = time();
		
		$this->db->where('sys_user_log_login.id', $id_login);
		$this->db->update('sys_user_log_login', $dlog);
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
	}
	
}
