<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sys_user_detail_model extends CI_Model {
   public $id;	
   function __construct(){
        parent::__construct();
   }	
	
	public function json(){
		$this->datatables->select('
			sys_user_detail.id as id,
			sys_user_detail.agentid as agentid,
			sys_user_detail.alamat as alamat,
			sys_user_detail.tempat_lahir as tempat_lahir,
			sys_user_detail.tanggal_lahir as tanggal_lahir,
			sys_user_detail.tanggal_gabung as tanggal_gabung,
			sys_user_detail.jenis_kelamin as jenis_kelamin,
			sys_user_detail.email as email,
			sys_user_detail.status_perkawinan as status_perkawinan,
			sys_user_detail.kelurahan as kelurahan,
			sys_user_detail.kecamatan as kecamatan,
			sys_user_detail.kabupaten_kota as kabupaten_kota,
			sys_user_detail.provinsi as provinsi,
			sys_user_detail.no_hp as no_hp,
			sys_user_detail.no_hp_lain as no_hp_lain,
			sys_user_detail.no_ktp as no_ktp,
			sys_user_detail.pendidikan as pendidikan,
			sys_user_detail.jurusan as jurusan,
			sys_user_detail.sekolah as sekolah,
			sys_user_detail.tahun_lulus as tahun_lulus,
			sys_user_detail.no_rekening as no_rekening,
			sys_user_detail.nama_bank as nama_bank,
			sys_user_detail.npwp as npwp,
			sysuser.id as sysuser_id,
			sysuser.nmuser as nmuser,
			sysuser.passuser as passuser,
			sysuser.opt_level as opt_level,
			sysuser.opt_status as opt_status,
			sysuser.picture as picture,
			sysuser.nama as nama,
			sysuser.agentid as sysuser_agentid,
			sysuser.kategori as kategori,
			sysuser.tl as tl,
			jeniskelamin.id as jeniskelamin_id,
			jeniskelamin.jenis_kelamin as jeniskelamin_jenis_kelamin,
			statusperkawinan.id as statusperkawinan_id,
			statusperkawinan.status_perkawinan as statusperkawinan_status_perkawinan,
		');
		
		$this->datatables->from('sys_user_detail');
	
		$this->datatables->join('sys_user sysuser','sysuser.id=sys_user_detail.agentid','LEFT'); 
	
		$this->datatables->join('jenis_kelamin jeniskelamin','jeniskelamin.id=sys_user_detail.jenis_kelamin','LEFT'); 
	
		$this->datatables->join('status_perkawinan statusperkawinan','statusperkawinan.id=sys_user_detail.status_perkawinan','LEFT'); 

		
		
		//mengembalikan dalam bentuk array
		$q =  json_decode($this->datatables->generate(),true);
		return $q;
	}
	

   public function get_all(){
		$afield = array(
			'sys_user_detail.id as id',
			'sys_user_detail.agentid as agentid',
			'sys_user_detail.alamat as alamat',
			'sys_user_detail.tempat_lahir as tempat_lahir',
			'sys_user_detail.tanggal_lahir as tanggal_lahir',
			'sys_user_detail.tanggal_gabung as tanggal_gabung',
			'sys_user_detail.jenis_kelamin as jenis_kelamin',
			'sys_user_detail.email as email',
			'sys_user_detail.status_perkawinan as status_perkawinan',
			'sys_user_detail.kelurahan as kelurahan',
			'sys_user_detail.kecamatan as kecamatan',
			'sys_user_detail.kabupaten_kota as kabupaten_kota',
			'sys_user_detail.provinsi as provinsi',
			'sys_user_detail.no_hp as no_hp',
			'sys_user_detail.no_hp_lain as no_hp_lain',
			'sys_user_detail.no_ktp as no_ktp',
			'sys_user_detail.pendidikan as pendidikan',
			'sys_user_detail.jurusan as jurusan',
			'sys_user_detail.sekolah as sekolah',
			'sys_user_detail.tahun_lulus as tahun_lulus',
			'sys_user_detail.no_rekening as no_rekening',
			'sys_user_detail.nama_bank as nama_bank',
			'sys_user_detail.npwp as npwp',
			'sysuser.id as sysuser_id',
			'sysuser.nmuser as nmuser',
			'sysuser.passuser as passuser',
			'sysuser.opt_level as opt_level',
			'sysuser.opt_status as opt_status',
			'sysuser.picture as picture',
			'sysuser.nama as nama',
			'sysuser.agentid as sysuser_agentid',
			'sysuser.kategori as kategori',
			'sysuser.tl as tl',
			'jeniskelamin.id as jeniskelamin_id',
			'jeniskelamin.jenis_kelamin as jeniskelamin_jenis_kelamin',
			'statusperkawinan.id as statusperkawinan_id',
			'statusperkawinan.status_perkawinan as statusperkawinan_status_perkawinan',
		
		);
		$this->db->select($afield);
		$this->db->join('sys_user sysuser','sysuser.id=sys_user_detail.agentid','LEFT'); 
		$this->db->join('jenis_kelamin jeniskelamin','jeniskelamin.id=sys_user_detail.jenis_kelamin','LEFT'); 
		$this->db->join('status_perkawinan statusperkawinan','statusperkawinan.id=sys_user_detail.status_perkawinan','LEFT'); 

		$this->db->order_by('sys_user_detail.id', 'ASC');
		return $this->db->get('sys_user_detail')->result_array();
   }


	public function get_by_id($id){
		$afield = array(
			'sys_user_detail.id as id',
			'sys_user_detail.agentid as agentid',
			'sys_user_detail.alamat as alamat',
			'sys_user_detail.tempat_lahir as tempat_lahir',
			'sys_user_detail.tanggal_lahir as tanggal_lahir',
			'sys_user_detail.tanggal_gabung as tanggal_gabung',
			'sys_user_detail.jenis_kelamin as jenis_kelamin',
			'sys_user_detail.email as email',
			'sys_user_detail.status_perkawinan as status_perkawinan',
			'sys_user_detail.kelurahan as kelurahan',
			'sys_user_detail.kecamatan as kecamatan',
			'sys_user_detail.kabupaten_kota as kabupaten_kota',
			'sys_user_detail.provinsi as provinsi',
			'sys_user_detail.no_hp as no_hp',
			'sys_user_detail.no_hp_lain as no_hp_lain',
			'sys_user_detail.no_ktp as no_ktp',
			'sys_user_detail.pendidikan as pendidikan',
			'sys_user_detail.jurusan as jurusan',
			'sys_user_detail.sekolah as sekolah',
			'sys_user_detail.tahun_lulus as tahun_lulus',
			'sys_user_detail.no_rekening as no_rekening',
			'sys_user_detail.nama_bank as nama_bank',
			'sys_user_detail.npwp as npwp',
			'sysuser.id as sysuser_id',
			'sysuser.nmuser as nmuser',
			'sysuser.passuser as passuser',
			'sysuser.opt_level as opt_level',
			'sysuser.opt_status as opt_status',
			'sysuser.picture as picture',
			'sysuser.nama as nama',
			'sysuser.agentid as sysuser_agentid',
			'sysuser.kategori as kategori',
			'sysuser.tl as tl',
			'jeniskelamin.id as jeniskelamin_id',
			'jeniskelamin.jenis_kelamin as jeniskelamin_jenis_kelamin',
			'statusperkawinan.id as statusperkawinan_id',
			'statusperkawinan.status_perkawinan as statusperkawinan_status_perkawinan',
		
		);
		$this->db->select($afield);
		$this->db->join('sys_user sysuser','sysuser.id=sys_user_detail.agentid','LEFT'); 
		$this->db->join('jenis_kelamin jeniskelamin','jeniskelamin.id=sys_user_detail.jenis_kelamin','LEFT'); 
		$this->db->join('status_perkawinan statusperkawinan','statusperkawinan.id=sys_user_detail.status_perkawinan','LEFT'); 

		$this->db->where('sys_user_detail.id', $id);
		$this->db->order_by('sys_user_detail.id', 'ASC');
		return $this->db->get('sys_user_detail')->row();
   }


	/* Memastikan data yg dibuat tidak kembar/sama,
	   fungsi ini sebagai pengganti fungsi primary key dr db,
	   krn primary key sudah di gunakan untuk column id.
	   -create : id di kosongkan.
	   -update : id di isi dengan id data yg di proses.	
	*/	
	function if_exist($id,$data){
		$this->db->where('sys_user_detail.id <>',$id);

		$q = $this->db->get_where('sys_user_detail', $data)->result_array();
		
		if(count($q)>0){
			return true;
		}else{
			return false;
		}		

	

	}


	function insert($data){
	
	    /* transaction rollback */
		$this->db->trans_start();
		
		$this->db->insert('sys_user_detail', $data);		
		/* id primary yg baru saja di input*/
		$this->id = $this->db->insert_id(); 
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false
	}

	function update($id,$data){

		/* transaction rollback */
		$this->db->trans_start();

		$this->db->where('sys_user_detail.id', $id);
		$this->db->update('sys_user_detail', $data);
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
	}

	function delete_multiple($data){
		/* transaction rollback */
		$this->db->trans_start();
		
		if(!empty($data)){
			$this->db->where_in('sys_user_detail.id',$data);	
	
			$this->db->delete('sys_user_detail');
		}
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
		
	}


};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-02-07 09:33:58 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
