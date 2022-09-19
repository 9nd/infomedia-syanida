<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_performance_agent_model extends CI_Model {
   public $id;	
   function __construct(){
        parent::__construct();
   }	
	
	public function json(){
		$this->datatables->select('
			t_performance_agent.id as id,
			t_performance_agent.agentid as agentid,
			t_performance_agent.bulan as bulan,
			t_performance_agent.contactedr as contactedr,
			t_performance_agent.verifiedr as verifiedr,
			t_performance_agent.hpemailr as hpemailr,
			t_performance_agent.hpr as hpr,
			t_performance_agent.contactedm as contactedm,
			t_performance_agent.verifiedm as verifiedm,
			t_performance_agent.hpemailm as hpemailm,
			t_performance_agent.hpm as hpm,
			t_performance_agent.hadir as hadir,
			t_performance_agent.telat as telat,
			t_performance_agent.absen as absen,
			t_performance_agent.sakit as sakit,
			t_performance_agent.izin as izin,
			t_performance_agent.payrol as payrol,
			agentid.id as agentid_id,
			agentid.nmuser as nmuser,
			agentid.passuser as passuser,
			agentid.opt_level as opt_level,
			agentid.opt_status as opt_status,
			agentid.picture as picture,
			agentid.nama as nama,
			agentid.agentid as agentid_agentid,
			agentid.kategori as kategori,
			agentid.tl as tl,
			agentid.nik_absensi as nik_absensi,
			agentid.agentid_mos as agentid_mos,
		');
		
		$this->datatables->from('t_performance_agent');
	
		$this->datatables->join('sys_user agentid','agentid.id=t_performance_agent.agentid','LEFT'); 

		
		
		//mengembalikan dalam bentuk array
		$q =  json_decode($this->datatables->generate(),true);
		return $q;
	}
	

   public function get_all(){
		$afield = array(
			't_performance_agent.id as id',
			't_performance_agent.agentid as agentid',
			't_performance_agent.bulan as bulan',
			't_performance_agent.contactedr as contactedr',
			't_performance_agent.verifiedr as verifiedr',
			't_performance_agent.hpemailr as hpemailr',
			't_performance_agent.hpr as hpr',
			't_performance_agent.contactedm as contactedm',
			't_performance_agent.verifiedm as verifiedm',
			't_performance_agent.hpemailm as hpemailm',
			't_performance_agent.hpm as hpm',
			't_performance_agent.hadir as hadir',
			't_performance_agent.telat as telat',
			't_performance_agent.absen as absen',
			't_performance_agent.sakit as sakit',
			't_performance_agent.izin as izin',
			't_performance_agent.payrol as payrol',
			'agentid.id as agentid_id',
			'agentid.nmuser as nmuser',
			'agentid.passuser as passuser',
			'agentid.opt_level as opt_level',
			'agentid.opt_status as opt_status',
			'agentid.picture as picture',
			'agentid.nama as nama',
			'agentid.agentid as agentid_agentid',
			'agentid.kategori as kategori',
			'agentid.tl as tl',
			'agentid.nik_absensi as nik_absensi',
			'agentid.agentid_mos as agentid_mos',
		
		);
		$this->db->select($afield);
		$this->db->join('sys_user agentid','agentid.id=t_performance_agent.agentid','LEFT'); 

		$this->db->order_by('t_performance_agent.id', 'ASC');
		return $this->db->get('t_performance_agent')->result_array();
   }


	public function get_by_id($id){
		$afield = array(
			't_performance_agent.id as id',
			't_performance_agent.agentid as agentid',
			't_performance_agent.bulan as bulan',
			't_performance_agent.contactedr as contactedr',
			't_performance_agent.verifiedr as verifiedr',
			't_performance_agent.hpemailr as hpemailr',
			't_performance_agent.hpr as hpr',
			't_performance_agent.contactedm as contactedm',
			't_performance_agent.verifiedm as verifiedm',
			't_performance_agent.hpemailm as hpemailm',
			't_performance_agent.hpm as hpm',
			't_performance_agent.hadir as hadir',
			't_performance_agent.telat as telat',
			't_performance_agent.absen as absen',
			't_performance_agent.sakit as sakit',
			't_performance_agent.izin as izin',
			't_performance_agent.payrol as payrol',
			'agentid.id as agentid_id',
			'agentid.nmuser as nmuser',
			'agentid.passuser as passuser',
			'agentid.opt_level as opt_level',
			'agentid.opt_status as opt_status',
			'agentid.picture as picture',
			'agentid.nama as nama',
			'agentid.agentid as agentid_agentid',
			'agentid.kategori as kategori',
			'agentid.tl as tl',
			'agentid.nik_absensi as nik_absensi',
			'agentid.agentid_mos as agentid_mos',
		
		);
		$this->db->select($afield);
		$this->db->join('sys_user agentid','agentid.id=t_performance_agent.agentid','LEFT'); 

		$this->db->where('t_performance_agent.id', $id);
		$this->db->order_by('t_performance_agent.id', 'ASC');
		return $this->db->get('t_performance_agent')->row();
   }


	/* Memastikan data yg dibuat tidak kembar/sama,
	   fungsi ini sebagai pengganti fungsi primary key dr db,
	   krn primary key sudah di gunakan untuk column id.
	   -create : id di kosongkan.
	   -update : id di isi dengan id data yg di proses.	
	*/	
	function if_exist($id,$data){
		$this->db->where('t_performance_agent.id <>',$id);

		$q = $this->db->get_where('t_performance_agent', $data)->result_array();
		
		if(count($q)>0){
			return true;
		}else{
			return false;
		}		

	

	}


	function insert($data){
	
	    /* transaction rollback */
		$this->db->trans_start();
		
		$this->db->insert('t_performance_agent', $data);		
		/* id primary yg baru saja di input*/
		$this->id = $this->db->insert_id(); 
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false
	}

	function update($id,$data){

		/* transaction rollback */
		$this->db->trans_start();

		$this->db->where('t_performance_agent.id', $id);
		$this->db->update('t_performance_agent', $data);
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
	}

	function delete_multiple($data){
		/* transaction rollback */
		$this->db->trans_start();
		
		if(!empty($data)){
			$this->db->where_in('t_performance_agent.id',$data);	
	
			$this->db->delete('t_performance_agent');
		}
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
		
	}


};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-11-02 14:23:06 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
