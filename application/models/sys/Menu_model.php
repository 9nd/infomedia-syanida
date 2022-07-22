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
class Menu_model extends CI_Model {
  
	private $show = 1;
	private $active = 1;
	private $nonactive=0;
	private $hide = 0;
	private $id_super_admin=1;
	private $id_block;
	
	function __construct(){
        parent::__construct();
		$this->id_block = array();
		
		for($x=0; $x<6;$x++){
		  $this->id_block[$x] = $x+1;
		}
    }
	
    public function get_all(){
	  $afield = array(
		'sys_menu.id',
		'sys_menu.name',
		'sys_menu.icon',
		'sys_menu.id_form',
		'sys_menu.is_parent',
		'sys_form.link',
	  );	
	
	  $this->db->select($afield);
	  $this->db->join('sys_form','sys_form.id=sys_menu.id_form','left');
      $query=$this->db->get('sys_menu');
	  $this->db->order_by('name', "ASC");
      return $query->result_array();
    }
	
	
	public function get_by_id($id){
	  $afield = array(
		'sys_menu.id',
		'sys_menu.name',
		'sys_menu.icon',
		'sys_menu.id_form',
		'sys_menu.is_parent',
		'sys_form.link',
	  );	
		
	
	  $this->db->select($afield);
	  $this->db->join('sys_form','sys_form.id=sys_menu.id_form','left');	
	  $this->db->where('sys_menu.id',$id);
	 return $this->db->get('sys_menu')->row();
	}
	
	public function get_parent_menu(){
		  $afield = array(
			'sys_menu.id',
			'sys_menu.name',
			'sys_menu.icon',
			'sys_menu.id_form',
			'sys_menu.is_parent',
			'sys_form.link',
		  );	
			
	
		$this->db->select($afield);
		$this->db->join('sys_form','sys_form.id=sys_menu.id_form','left');	
		$this->db->where_not_in('sys_menu.id',$this->id_block);
		$this->db->where('is_parent','0');
		$this->db->order_by('name', "ASC");
		return $this->db->get('sys_menu')->result_array();
	}
	
	public function get_child_menu($id_parent){
		  $afield = array(
			'sys_menu.id',
			'sys_menu.name',
			'sys_menu.icon',
			'sys_menu.id_form',
			'sys_menu.is_parent',
			'sys_form.link',
		  );	
	
		$this->db->select($afield);
		$this->db->join('sys_form','sys_form.id=sys_menu.id_form','left');	
		
		$this->db->where('is_parent',$id_parent);
		$this->db->order_by('sys_form.id', "ASC");
		return $this->db->get('sys_menu')->result_array();
	}
	
	
	public function haschild($id_parent){
		$this->db->where('is_parent',$id_parent);
		$x = $this->db->get('sys_menu')->row();
		
		if($x){
			return true;
		}else{
			return false;
		}
	}
	
	public function get_all_child_menu(){
		  $afield = array(
			'sys_menu.id',
			'sys_menu.name',
			'sys_menu.icon',
			'sys_menu.id_form',
			'sys_menu.is_parent',
			'sys_form.link',
		  );	
	
	
		$this->db->select($afield);
		
		//bug data tidak bisa di tampilkan ketika sys_form sdh terhapus
		$this->db->join('sys_form','sys_form.id=sys_menu.id_form','LEFT');
		$this->db->where_not_in('sys_menu.id',$this->id_block);
		$this->db->where('sys_menu.is_parent <>','0');
		$this->db->order_by('sys_form.id', "DESC");
		return $this->db->get('sys_menu')->result_array();
	}
	
	public function insert($data){
		$this->db->trans_start(); 
		
		$this->db->insert('sys_menu',$data);
		$id_menu = $this->db->insert_id(); 
		
		//auto insert configurator
		$auth = array(
			'id_menu' 	=> $id_menu,
			'id_level'	=> $this->id_super_admin,
		);
		
		$this->db->insert('sys_authorized_menu',$auth);
		
		$this->db->trans_complete();
		return $this->db->trans_status();
		
		
	}
	
	public function update($id,$data){
		$this->db->where('id',$id);
		
		$this->db->where_not_in('sys_menu.id',$this->id_block);
		$this->db->update('sys_menu',$data);
	}
	
	public function delete_multiple($data){
		$this->db->trans_start(); 
		
		$this->db->where_in('id',$data);
		$id_block=array(1,2,3,4,5,6);
		$this->db->where_not_in('sys_menu.id',$id_block);
		$this->db->delete('sys_menu');
		
		$this->db->where_in('id_menu',$data);
		$id_block=array(1,2,3,4,5,6);
		$this->db->where_not_in('id_menu',$id_block);
		$this->db->delete('sys_authorized_menu');
		
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	
	
	
	
	

       
}
