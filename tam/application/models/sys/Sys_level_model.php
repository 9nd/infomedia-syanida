<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sys_level_model extends CI_Model
{

    public $table 					= 'sys_level';
	public $table_authorized 		= 'sys_authorized';
	public $table_authorized_menu	= 'sys_authorized_menu';
    public $id 						= 'id';
    public $order 					= 'ASC';
	
	
	private $id_super_admin = 1;
	private $show = 1;
	private $active = 1;
	private $nonactive=2;
	private $hide = 2;
	private $max_default_level = 75;

    function __construct()
    {
        parent::__construct();
    }
	
	public function json(){
		$this->datatables->select('
			sys_level.id,
			sys_level.nmlevel,
			sys_level.opt_status,
			sys_status.status,
		');
		
		$this->datatables->from($this->table);
		$this->datatables->join('sys_status','sys_status.id=sys_level.opt_status','LEFT'); 
		
		//mengembalikan dalam bentuk array
		$q =  json_decode($this->datatables->generate(),true);
		return $q;
	}

    // get all
    function get_all()
    {
		$afield=array(
		 'sys_level.id',
		 'sys_level.nmlevel',
		 'sys_level.opt_status',
		 'sys_status.status',
		);
		$this->db->join('sys_status','sys_status.id=sys_level.opt_status','left');
		$this->db->select($afield);
		$this->db->order_by($this->table.'.'.$this->id, $this->order);
		return $this->db->get($this->table)->result_array();
    }

	
	
	
    // get data by id
    function get_by_id($id)
    {
		$afield=array(
		 'sys_level.id',
		 'sys_level.nmlevel',
		 'sys_level.opt_status',
		 'sys_status.status',
		);
	$this->db->select($afield);
	$this->db->join('sys_status','sys_status.id=sys_level.opt_status','left');
	$this->db->where($this->table.'.'.$this->id, $id);
    return $this->db->get($this->table)->row();
    }
	
	function get_by_idgroup($idgroup){
		$afield=array(
		 'sys_level.id',
		 'sys_level.nmlevel',
		 'sys_level.opt_status',
		 'sys_level.opt_usergroup',
		 'sys_status.status',
		);
	$this->db->select($afield);
	$this->db->join('sys_status','sys_status.id=sys_level.opt_status','left');
	$this->db->where($this->table . '.opt_usergroup', $idgroup);
    return $this->db->get($this->table)->result();
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

		$this->db->where_not_in('sys_level.id',$id);
		$q=$this->db->get_where('sys_level', $data)->result_array();
		if(count($q)>0){
			return true;
		}else{
			return false;
		}		
	}		
	
	
	
	function get_form_code($idlevel=""){
		//mengambil id module
		$this->load->model('sys/sys_mod_model','mod');
		$this->load->model('sys/sys_authorized_model','authorized');
		
		$data_module = $this->mod->get_all();
		$data=array();
		foreach($data_module as $value){
			$form_table = $value->initial.'_form';
			
			$afield=array(
			 $form_table.'.id',
			 $form_table.'.code',
			 $form_table.'.link',
			 $form_table.'.form_name',
			);
			
			$this->db->select($afield);
			$res = $this->db->get($form_table)->result();
			
			foreach($res as $value_form){
				$value_form->initial =  $value->initial;
				$value_form->module_name =  $value->nmmodul;
				$value_form->id_module = $value->idmodule;
				$value_form->is_valid = $this->authorized->is_valid_auth_link($idlevel,$value_form->id_module,$value_form->id);
			}
			
			$data[$form_table]=$res;
		
		}
		
		return $data;
	}
	
	function get_form_byinitial($initial_module="",$idlevel=""){
	    $this->load->model('sys/sys_mod_model','mod');
		$this->load->model('sys/sys_authorized_model','authorized');

		$data_module = $this->mod->get_by_initial($initial_module);
		
		
		$data=array();

		foreach($data_module as $value){
			$form_table = $value->initial.'_form';
			
			$afield=array(
			 $form_table.'.id',
			 $form_table.'.code',
			// $form_table.'.link',
			 $form_table.'.form_name',
			 $form_table.'.shortcut',
			);
			
			$this->db->select($afield);
			$res = $this->db->get($form_table)->result();
			
			//menyisipkan initial,module_name,id_module dan is valid ke dalam array form
			foreach($res as $value_form){
				$value_form->initial =  $value->initial;
				$value_form->module_name =  $value->nmmodul;
				$value_form->id_module = $value->idmodule;
				$value_form->is_valid = $this->authorized->is_valid_auth_link($idlevel,$value_form->id_module,$value_form->id);
			}
			
			$data[$form_table]=$res;
		
		}
		
		return $data;
	}
	
	function get_form_byidmodules($idmodules="",$idlevel=""){
	    $this->load->model('sys/sys_mod_model','mod');
		$this->load->model('sys/sys_authorized_model','authorized');

		$data_module = $this->mod->get_by_idmodules($idmodules);
		
		
		$data=array();

		foreach($data_module as $value){
			$form_table = $value->initial.'_form';
			
			$afield=array(
			 $form_table.'.id',
			 $form_table.'.code',
			 $form_table.'.link',
			 $form_table.'.form_name',
			 $form_table.'.shortcut',
			);
			
			$this->db->select($afield);
			$res = $this->db->get($form_table)->result();
			
			//menyisipkan initial,module_name,id_module dan is valid ke dalam array form
			foreach($res as $value_form){
				$value_form->initial =  $value->initial;
				$value_form->module_name =  $value->nmmodul;
				$value_form->id_module = $value->idmodule;
				$value_form->is_valid = $this->authorized->is_valid_auth_link($idlevel,$value_form->id_module,$value_form->id);
			}
			
			$data[$form_table]=$res;
		
		}
		
		return $data;
	}
	
	
	
	

	
	function get_data_module($id_group){
		$afield=array(
		 'sys_usergroup_mod.id_module',
		 'sys_mod.nmmodul',
		 'sys_mod.idmodule',
		 'sys_mod.initial',
		);
		$this->db->select($afield);
		$this->db->join('sys_mod','sys_mod.idmodule=sys_usergroup_mod.id_module','left');
		$this->db->where('sys_usergroup_mod.id_usergroup', $id_group);
		return $this->db->get('sys_usergroup_mod')->result();
	}
	
	
	
    
    // get total rows
    function total_rows($q = NULL) {
        // $this->db->like('id', $q);
		// $this->db->or_like('nmlevel', $q);
		// $this->db->or_like('opt_status', $q);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    
    // insert data
    function insert($data){

		$val = $data;
		
		//prepare data table level
		$data_level = array(
			'nmlevel'=> $val['nmlevel'],
			'opt_status'=>$val['status'],
		);
		
		$this->db->trans_start(); 
		
		//insert table level		
		$this->db->insert($this->table, $data_level);
		$val_idlevel = $this->db->insert_id(); 
		
		
		$id_form = $val['form'];
		$id_menu = $val['menu'];
		if($id_form!==""){
			$id_form = explode(",",$id_form);
			foreach($id_form as $value_arr){
				$data_author = array(
					'id_level'=> $val_idlevel,
					'id_form'=> $value_arr,
				);
				$this->db->insert($this->table_authorized, $data_author);	
			}
		}
		
		if($id_menu!==""){
			$id_menu = explode(",",$id_menu);
			foreach($id_menu as $value_arr){
				$data_menu = array(
					'id_level'=> $val_idlevel,
					'id_menu'=> $value_arr,
				);
				$this->db->insert($this->table_authorized_menu, $data_menu);	
			}
		}
		
		
		
		$this->db->trans_complete();
		return $this->db->trans_status();
    }

    // update data
    function update($val){

		$id_level = $val['id'];

		//mencegah perubahan status super admin
		if($id_level==$this->id_super_admin){
			$val['status']=1;
		}		
		
		//prepare data table level
		$data_level = array(
			'nmlevel'=> $val['nmlevel'],
			'opt_status'=>$val['status'],
		);
        
		$this->db->trans_start(); 
		
		//UPDATE TABLE LEVEL
		$this->db->where($this->id, $id_level);
		$this->db->update($this->table, $data_level);
		//------
		
		//DELETE TABLE AUTHORIZED BY ID LEVEL
		//BLOCK DELETE SUPER ADMIN & FORM SISYEM DEFAULT 1-30
		if($id_level==$this->id_super_admin){
			$q_del_url = " DELETE FROM " . $this->table_authorized .
						 " WHERE id_level='".$this->id_super_admin."' AND id_form > '".$this->max_default_level."' ";
			$this->db->query($q_del_url);
			
			$q_del_menu = " DELETE FROM " . $this->table_authorized_menu .
						  " WHERE id_level='".$this->id_super_admin."' AND id_menu > '".$this->max_default_level."' ";
			$this->db->query($q_del_menu);
			
		}else{
		  $this->db->where('id_level', $id_level);	
		  $this->db->delete($this->table_authorized);
		  
		  $this->db->where('id_level', $id_level);	
		  $this->db->delete($this->table_authorized_menu);
		}	
      
		//------
		
		//re insert auhorization
		$val_id = $val['form'];
		if($val_id!==""){
			$val_id = explode(",",$val_id);
			foreach($val_id as $value_arr){
				
						$data_author=array();
						//BLOCK RE INSERT FORM SISYEM DEFAULT SUPER ADMIN
						if($id_level==$this->id_super_admin){
							
							//idform di bawah 100 tidak di input guna mencegah double input
							if($value_arr <= $this->max_default_level ){
							}else{
								$data_author['id_level']=$id_level;
								$data_author['id_form']=$value_arr;
							}
						
						}else{
								$data_author['id_level']=$id_level;
								$data_author['id_form']=$value_arr;
						}	
						
						if(!empty($data_author)){
							$this->db->insert($this->table_authorized, $data_author);		
						}
				
			}
		}
		
		//re insert auhorization menu
		$val_id = $val['menu'];
		if($val_id!==""){
			$val_id = explode(",",$val_id);
			foreach($val_id as $value_arr){
				
						$data_author=array();
						//BLOCK RE INSERT FORM SISYEM DEFAULT SUPER ADMIN
						if($id_level==$this->id_super_admin){
							
							//idform di bawah 100 tidak di input guna mencegah double input
							if($value_arr <= 100){
							}else{
								$data_author['id_level']=$id_level;
								$data_author['id_menu']=$value_arr;
							}
						
						}else{
								$data_author['id_level']=$id_level;
								$data_author['id_menu']=$value_arr;
						}	
						
						if(!empty($data_author)){
							$this->db->insert($this->table_authorized_menu, $data_author);		
						}
				
			}
		}
		
		$this->db->trans_complete();
		return $this->db->trans_status();
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
		//BLOCK DELETE SUPER ADMIN
		$this->db->where_not_in($this->id,$this->id_super_admin);
        $this->db->delete($this->table);
    }

	// delete multiple data
	function delete_multiple($data){
		if(!empty($data)){
				$this->load->model('sys/sys_authorized_model','authorized');
				$this->db->trans_start();

				$this->db->where_in($this->id,$data);
				//BLOCK DELETE SUPER ADMIN
				$this->db->where_not_in($this->id,$this->id_super_admin);
				$this->db->delete($this->table);
				
				$this->db->where_in('id_level',$data);
				$this->db->where_not_in('id_level',$this->id_super_admin);
				$this->db->delete($this->table_authorized_menu);
				
				$this->db->where_in('id_level',$data);
				$this->db->where_not_in('id_level',$this->id_super_admin);
				$this->db->delete($this->table_authorized);

				
				$this->db->trans_complete();
		}		
	}	
}

/* End of file Sys_level_model.php */
/* Location: ./application/models/Sys_level_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-02-23 16:48:34 */
/* http://harviacode.com */