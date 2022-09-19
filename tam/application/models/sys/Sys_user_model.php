<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sys_user_model extends CI_Model
{

    public $table = 'sys_user';
    public $id = 'id';
    public $order = 'DESC';
	
	private $id_super_admin=1;

    function __construct()
    {
        parent::__construct();
    }

	public function json(){
		$this->datatables->select('
			 sys_user.id,
			 sys_user.nama,
			 sys_user.agentid,
			 sys_user.kategori,
			 sys_user.nmuser,
			 sys_user.opt_level,
			 sys_user.opt_status,
			 sys_level.nmlevel,
			 sys_status.status,
			 sys_user.picture,
			 sys_user.tl,
		');
		
		$this->datatables->from('sys_user');
		$this->datatables->join('sys_level','sys_level.id=sys_user.opt_level','LEFT'); 
		$this->datatables->join('sys_status','sys_status.id=sys_user.opt_status','LEFT'); 
		
		
		//mengembalikan dalam bentuk array
		$q =  json_decode($this->datatables->generate(),true);
		return $q;
	}
	
	
	
    // get all
    function get_all()
    {
		$afield=array(
			 $this->table.'.id',
			 $this->table.'.nama',
			 $this->table.'.kategori',
			 $this->table.'.agentid',
			 $this->table.'.nmuser',
			 $this->table.'.opt_level',
			 $this->table.'.opt_status',
			 'sys_level.nmlevel',
			 'sys_status.status',
			 $this->table.'.picture',
			 $this->table.'.tl',
		);
		
		$this->db->join('sys_level','sys_level.id=sys_user.opt_level','left');
		$this->db->join('sys_status','sys_status.id=sys_user.opt_status','left');
		$this->db->select($afield);
		$this->db->order_by($this->table.'.'.$this->id, $this->order);
		return $this->db->get($this->table)->result();
    }
	
	

    // get data by id
    function get_by_id($id)
    {
		$afield=array(
		 $this->table.'.id',
		 $this->table.'.nama',
		 $this->table.'.kategori',
		 $this->table.'.agentid',
		 $this->table.'.nmuser',
		 $this->table.'.passuser',
		 $this->table.'.opt_level',
		 $this->table.'.picture',
		 $this->table.'.opt_status',
		 $this->table.'.tl',
		 'sys_level.nmlevel',
		 'sys_status.status',
		);
	$this->db->select($afield);
	$this->db->join('sys_level','sys_level.id=sys_user.opt_level','left');
	$this->db->join('sys_status','sys_status.id=sys_user.opt_status','left');
	$this->db->where($this->table.'.'.$this->id, $id);
    return $this->db->get($this->table)->row();
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

		$this->db->where_not_in($this->table.'.'.'id',$id);
		$q=$this->db->get_where($this->table, $data)->result_array();
		if(count($q)>0){
			return true;
		}else{
			return false;
		}		
	}	

	
		
	
	
	
	// get picture by id for delete
    function get_picture_byid($id)
    {
		$afield=array(
		 $this->table.'.picture',
		);
		$this->db->select($afield);
		$this->db->where_in($this->table.'.'.$this->id, $id);
		$this->db->where_not_in($this->id,$this->id_super_admin);
		return $this->db->get($this->table)->result();
    }
	
	function get_picture_for_update_byid($id){
		$afield=array(
		 $this->table.'.picture',
		);
		$this->db->select($afield);
		$this->db->where_in($this->table.'.'.$this->id, $id);
		return $this->db->get($this->table)->row();
    }
	
	

	 // get total rows by
    function total_rows_by($field,$data) {
        $this->db->where($field, $data);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }
	
	// get total otorisasi_form
    function total_otorisasi_form($idlevel,$idmodule) {
		
        $this->db->where_in('id_level', $idlevel);
		$this->db->where_in('id_module', $idmodule);
		$this->db->from('sys_authorized');
        return $this->db->count_all_results();
    }
    
	function nama_module_akses($idlevel,$idmodule){
		$afield=array(
		 'sys_mod.nmmodul',
		 'sys_mod.initial',
		);
		$this->db->select($afield);
		$this->db->where_in('sys_authorized.id_level', $idlevel);
		$this->db->where_in('sys_authorized.id_module', $idmodule);
		$this->db->join('sys_mod','sys_authorized.id_module=sys_mod.idmodule','left');
		$this->db->distinct();
		$this->db->from('sys_authorized');
		return $this->db->get($this->table)->result();
	}
	
	function get_id_module_akses($idgroup){
		$afield=array(
		 'sys_usergroup_mod.id_module',
		);
		$this->db->select($afield);
		$this->db->where('sys_usergroup_mod.id_usergroup', $idgroup);
		return $this->db->get('sys_usergroup_mod')->result_array();
	}
	
	
	
    // get total rows
    function total_rows($q = NULL) {
        // $this->db->like('id', $q);
		// $this->db->or_like('nmuser', $q);
		// $this->db->or_like('passuser', $q);
		// $this->db->or_like('opt_level', $q);
		// $this->db->or_like('opt_usergroup', $q);
		// $this->db->or_like('idkaryawan', $q);
		// $this->db->or_like('opt_status', $q);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

  
    // insert data
    function insert($data)
    {
		$this->db->trans_start(); 
		
		//insert for get id user
        $this->db->insert($this->table, $data);
		$val_iduser = $this->db->insert_id(); 
		
		//copy picture with new name
		if($data['picture']!=="-" && $data['picture']!=="default.png"){
			$pic = explode('xx_xx',$data['picture']);
			$fpic_name =  $val_iduser .'xx_xx'. $pic[1];
			$fpic_path = './images/user_profile/'.$fpic_name;
			
			//jika foto di folder temp ditemukan
			if(is_file($data['picture'])){
				copy($data['picture'],$fpic_path);
				//update table user
				$data['picture'] = $fpic_name;
				$this->db->where($this->id, $val_iduser);
				$this->db->update($this->table, $data);
			}else{
				unset($data['picture']);
				$this->db->where($this->id, $val_iduser);
				$this->db->update($this->table, $data);
			}

		}
		
		$this->db->trans_complete();
		return $this->db->trans_status();
    }
	
	function insert_multiple($data){
		$this->db->trans_start();

		 $this->db->insert_batch($this->table, $data);
		
		
		$this->db->trans_complete();
		return $this->db->trans_status();	
	}

		
	function update_pass($id, $data){
		//update table user
		$this->db->trans_start(); 
		
		$this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
		
		$this->db->trans_complete();
		return $this->db->trans_status();
	}	


    // update data
    function update($id, $data)
    {
		$this->db->trans_start(); 
		
		//mencegah perubahan level dan status user super admin 
		if($id==$this->id_super_admin){
			$data['opt_status']=1;
			$data['opt_level']=1;
		}	
		
		//copy picture with new name
		if($data['picture']!=="-" && $data['picture']!=="default.png"){
			$pic = explode('xx_xx',$data['picture']);
			$fpic_name =  $id .'xx_xx'. $pic[1];
			$fpic_path = './images/user_profile/'.$fpic_name;
			
			//jika foto di folder temp ditemukan
			if(is_file($data['picture'])){
				copy($data['picture'],$fpic_path);
		
				//remove oldpicture & temp picture
				$old_picture	=  './images/user_profile/'. $data['oldpicture'];
				
				if($data['oldpicture'] !=='default.png'){
					if(file_exists($old_picture)){
						unlink($old_picture);
					}
				}
				
				if(file_exists($data['picture'])){
					unlink($data['picture']);
				}
				
				
				
				unset($data['oldpicture']);
				
				//update table user
				$data['picture'] = $fpic_name;
				$this->db->where($this->id, $id);
				$this->db->update($this->table, $data);
			}else{
				unset($data['oldpicture']);
				unset($data['picture']);
				//update table user
				$this->db->where($this->id, $id);
				$this->db->update($this->table, $data);
			}

		}else{
			unset($data['picture']);
			unset($data['oldpicture']);
			//update table user
			$this->db->where($this->id, $id);
			$this->db->update($this->table, $data);
		}

		
		
	
		
		$this->db->trans_complete();
		return $this->db->trans_status();
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
		$this->db->where_not_in($this->id,$this->id_super_admin);
        $this->db->delete($this->table);
    }

	// delete multiple data
	function delete_multiple($data){
		if(!empty($data)){
				
				//get picture name for prepare delete
				$pic_name = $this->get_picture_byid($data);
				
				$this->db->trans_start();
				//delete tbl user
				$this->db->where_in($this->id,$data);
				$this->db->where_not_in($this->id,$this->id_super_admin);
				$this->db->delete($this->table);
				
				//delete tbl userlogin
				$this->db->where_in('iduser',$data);
				$this->db->where_not_in('iduser',$this->id_super_admin);
				$this->db->delete('sys_userlogin');
				
				//delete tbl dashboard
				$this->db->where_in('id_user',$data);
				$this->db->where_not_in('id_user',$this->id_super_admin);
				$this->db->delete('sys_dashboard');
				
				$this->db->trans_complete();
				//delete file
				foreach($pic_name as $file){
					$pic ='images/user_profile/'.$file->picture;
					if(is_file($pic)){
						if($file->picture !=="default.png"){
							unlink($pic);
						}
					}
				}
				
				
		}		

	}	
	
}
