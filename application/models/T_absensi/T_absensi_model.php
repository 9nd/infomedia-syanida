<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_absensi_model extends CI_Model {
   public $id;	
   function __construct(){
        parent::__construct();
   }	
	
	public function json(){
		$this->datatables->select('
			t_absensi.id as id,
			t_absensi.nama as nama,
			t_absensi.nik as nik,
			t_absensi.stts as stts,
			t_absensi.waktu_in as waktu_in,
			t_absensi.picture as picture,
			t_absensi.update_by as update_by,
			t_absensi.latitude as latitude,
			t_absensi.longitude as longitude,
			t_absensi.agentid as agentid,
			nikagent.id as nikagent_id,
			nikagent.nmuser as nmuser,
			nikagent.passuser as passuser,
			nikagent.opt_level as opt_level,
			nikagent.opt_status as opt_status,
			nikagent.picture as nikagent_picture,
			nikagent.nama as nikagent_nama,
			nikagent.agentid as nikagent_agentid,
			nikagent.kategori as kategori,
			nikagent.tl as tl,
			nikagent.nik_absensi as nik_absensi,
			statusagent.id as statusagent_id,
			statusagent.keterangan as keterangan,
			statusagent.kode as kode,
		');
		
		$this->datatables->from('t_absensi');
	
		$this->datatables->join('sys_user nikagent','nikagent.id=t_absensi.nik','LEFT'); 
	
		$this->datatables->join('status_absen statusagent','statusagent.id=t_absensi.stts','LEFT'); 

		
		
		//mengembalikan dalam bentuk array
		$q =  json_decode($this->datatables->generate(),true);
		return $q;
	}
	

   public function get_all(){
		$afield = array(
			't_absensi.id as id',
			't_absensi.nama as nama',
			't_absensi.nik as nik',
			't_absensi.stts as stts',
			't_absensi.waktu_in as waktu_in',
			't_absensi.picture as picture',
			't_absensi.update_by as update_by',
			't_absensi.latitude as latitude',
			't_absensi.longitude as longitude',
			't_absensi.agentid as agentid',
			'nikagent.id as nikagent_id',
			'nikagent.nmuser as nmuser',
			'nikagent.passuser as passuser',
			'nikagent.opt_level as opt_level',
			'nikagent.opt_status as opt_status',
			'nikagent.picture as nikagent_picture',
			'nikagent.nama as nikagent_nama',
			'nikagent.agentid as nikagent_agentid',
			'nikagent.kategori as kategori',
			'nikagent.tl as tl',
			'nikagent.nik_absensi as nik_absensi',
			'statusagent.id as statusagent_id',
			'statusagent.keterangan as keterangan',
			'statusagent.kode as kode',
		
		);
		$this->db->select($afield);
		$this->db->join('sys_user nikagent','nikagent.id=t_absensi.nik','LEFT'); 
		$this->db->join('status_absen statusagent','statusagent.id=t_absensi.stts','LEFT'); 

		$this->db->order_by('t_absensi.id', 'ASC');
		return $this->db->get('t_absensi')->result_array();
   }


	public function get_by_id($id){
		$afield = array(
			't_absensi.id as id',
			't_absensi.nama as nama',
			't_absensi.nik as nik',
			't_absensi.stts as stts',
			't_absensi.waktu_in as waktu_in',
			't_absensi.picture as picture',
			't_absensi.update_by as update_by',
			't_absensi.latitude as latitude',
			't_absensi.longitude as longitude',
			't_absensi.agentid as agentid',
			'nikagent.id as nikagent_id',
			'nikagent.nmuser as nmuser',
			'nikagent.passuser as passuser',
			'nikagent.opt_level as opt_level',
			'nikagent.opt_status as opt_status',
			'nikagent.picture as nikagent_picture',
			'nikagent.nama as nikagent_nama',
			'nikagent.agentid as nikagent_agentid',
			'nikagent.kategori as kategori',
			'nikagent.tl as tl',
			'nikagent.nik_absensi as nik_absensi',
			'statusagent.id as statusagent_id',
			'statusagent.keterangan as keterangan',
			'statusagent.kode as kode',
		
		);
		$this->db->select($afield);
		$this->db->join('sys_user nikagent','nikagent.id=t_absensi.nik','LEFT'); 
		$this->db->join('status_absen statusagent','statusagent.id=t_absensi.stts','LEFT'); 

		$this->db->where('t_absensi.id', $id);
		$this->db->order_by('t_absensi.id', 'ASC');
		return $this->db->get('t_absensi')->row();
   }


	/* Memastikan data yg dibuat tidak kembar/sama,
	   fungsi ini sebagai pengganti fungsi primary key dr db,
	   krn primary key sudah di gunakan untuk column id.
	   -create : id di kosongkan.
	   -update : id di isi dengan id data yg di proses.	
	*/	
	function if_exist($id,$data){
		$this->db->where('t_absensi.id <>',$id);

		$q = $this->db->get_where('t_absensi', $data)->result_array();
		
		if(count($q)>0){
			return true;
		}else{
			return false;
		}		

	

	}


	function insert($data){
	
	    /* transaction rollback */
		$this->db->trans_start();
		
		$this->db->insert('t_absensi', $data);		
		/* id primary yg baru saja di input*/
		$this->id = $this->db->insert_id(); 
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false
	}

	function update($id,$data){

		/* transaction rollback */
		$this->db->trans_start();

		$this->db->where('t_absensi.id', $id);
		$this->db->update('t_absensi', $data);
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
	}

	function delete_multiple($data){
		/* transaction rollback */
		$this->db->trans_start();
		
		if(!empty($data)){
			$this->db->where_in('t_absensi.id',$data);	
	
			$this->db->delete('t_absensi');
		}
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
		
	}


};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-04-01 09:25:43 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
