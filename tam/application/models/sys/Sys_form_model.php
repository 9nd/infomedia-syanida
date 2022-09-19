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
class Sys_form_model extends CI_Model {
	private $id_block;
	private $max_default_level = 75;
	function __construct(){
        parent::__construct();
		
		//mencegah perubahan pada sistem
		$this->id_block = array();
		for($x=0; $x< $this->max_default_level;$x++){
		  $this->id_block[$x] = $x+1;
		}
    }
	
	
	public function json(){
		$this->datatables->select('
			 sys_form.id,
			 sys_form.code,
			 sys_form.link,
			 sys_form.form_name,
			 sys_form.shortcut,
		');
		
		$this->datatables->from('sys_form');
		$this->datatables->where_not_in('id',$this->id_block);
		
		
		
		//mengembalikan dalam bentuk array
		$q =  json_decode($this->datatables->generate(),true);
		return $q;
	}
	
    public function get_all(){
	  //menecegah no link di tampilkan	
	  $this->db->where_not_in('id',$this->id_block);		
      $query=$this->db->get('sys_form');
      return $query->result_array();
    }
	
	/* Memastikan data yg dibuat tidak kembar/sama,
	   fungsi ini sebagai pengganti fungsi primary key dr db,
	   krn primary key sudah di gunakan untuk column id,
	   untuk memastikan data yg exist bukan data yang sementara di proses
	   maka di gunakan fungsi " where_not_in ".
	   -create : id di kosongkan.
	   -update : id di isi dengan id data yg di proses.	
	*/	
	function if_exist($id,$data){

		$this->db->where_not_in('sys_form.id',$id);
		$q=$this->db->get_where('sys_form', $data)->result_array();
		if(count($q)>0){
			return true;
		}else{
			return false;
		}		
	}	
	
	public function get_all_by_shortcut($shortcut){
	  $this->db->where('shortcut',$shortcut);
	  $this->db->where_not_in('id',$this->id_block);		
	  $query=$this->db->get('sys_form');
      return $query->result_array();
	}
	
	public function get_by_id($id){
		$this->db->where('id',$id);
		return $this->db->get('sys_form')->row();
	}
	
	public function get_parent_menu(){
		$this->db->where('is_parent','0');
		return $this->db->get('sys_menu')->result_array();
	}
	
	public function get_child_menu($id_parent){
		$this->db->where('is_parent',$id_parent);
		return $this->db->get('sys_menu')->result_array();
	}
	
	
	
	public function insert($data){
		$this->db->trans_start();
		
		$this->db->insert('sys_form',$data);
		$id_form = $this->db->insert_id();
		
		
		//auto input otorisasi untuk configurator
		$data = array(
		 'id_form'  => $id_form,
		 'id_level' => 1, //level configurator
		);
		$this->db->insert('sys_authorized',$data);
		
		$this->db->trans_complete();
		return $this->db->trans_status();
		
	}
	
	public function update($id,$data){
		$this->db->where('id',$id);
		$this->db->update('sys_form',$data);
	}
	
	public function delete_multiple($data){
		//$id block di buat beda dengan $this->id_block di atas,
		//pencegahan tahap akhir jika $this->id_block di ubah..
		// $id_block = array();
		// for($x=0; $x<30;$x++){
		  // $id_block[$x] = $x+1;
		// }
		
		$this->db->where_in('id',$data);
		$this->db->where_not_in('id',$this->id_block);	
		$this->db->delete('sys_form');
	}
	
	
	
	
	
	

       
}
