<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sys_Maintenance_model extends CI_Model
{


    function __construct()
    {
        parent::__construct();
    }

	
	public function get_time_maintenance(){
		$this->db->where('actual_finish',0);
		return $this->db->get('sys_maintenance_schedule')->row();
	}
	
	public function get_maintenance_mode(){
		$this->db->select('mode');
		$this->db->where('id',1);
		$mode = $this->db->get('sys_maintenance_mode')->row();
		return $mode->mode;
	}
	
	public function set_mode_on(){
		$data = array('mode'=>1);
		$this->db->where('id',1);
		$this->db->update('sys_maintenance_mode',$data);
	}
	
	public function set_mode_off(){
		$data = array('mode'=>0);
		$this->db->where('id',1);
		$this->db->update('sys_maintenance_mode',$data);
	}
	
	
	public function get_all(){
		$this->db->order_by('sys_maintenance_schedule.start', 'DESC');
		return $this->db->get('sys_maintenance_schedule')->result();
	}
	
	public function get_all_ip(){
		$this->db->select('ip_address');
		$this->db->order_by('sys_maintenance_ip.id', 'DESC');
		return $this->db->get('sys_maintenance_ip')->result_array();
	}
	
	
	public function insert($data){
		$this->db->trans_start(); 
		
		$exp = array('actual_finish'=>time());
		
		$this->db->where('actual_finish',"0");
		$this->db->update('sys_maintenance_schedule',$exp);
		

		
		$this->db->insert('sys_maintenance_schedule', $data);	
		
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	
	public function stop_maintenance($id,$data){
		$this->db->trans_start();
		$this->db->where('sys_maintenance_schedule.id',$id);
		$this->db->update('sys_maintenance_schedule',$data);
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
	}
	
	public function delete_schedule($data){
		/* transaction rollback */
		$this->db->trans_start();
		
		if(!empty($data)){
			$this->db->where_in('sys_maintenance_schedule.id',$data);	
	
			$this->db->delete('sys_maintenance_schedule');
		}
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
		
	}

	
}
