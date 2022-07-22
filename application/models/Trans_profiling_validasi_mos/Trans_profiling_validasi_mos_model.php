<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_profiling_validasi_mos_model extends CI_Model {
   public $id;	
   function __construct(){
        parent::__construct();
   }	
	
	public function json(){
		$this->datatables->select('
			trans_profiling_validasi_mos.idx as idx,
			trans_profiling_validasi_mos.ncli as ncli,
			trans_profiling_validasi_mos.no_pstn as no_pstn,
			trans_profiling_validasi_mos.no_speedy as no_speedy,
			trans_profiling_validasi_mos.nama_pelanggan as nama_pelanggan,
			trans_profiling_validasi_mos.relasi as relasi,
			trans_profiling_validasi_mos.no_handpone as no_handpone,
			trans_profiling_validasi_mos.verfi_handphone as verfi_handphone,
			trans_profiling_validasi_mos.email as email,
			trans_profiling_validasi_mos.verfi_email as verfi_email,
			trans_profiling_validasi_mos.facebook as facebook,
			trans_profiling_validasi_mos.twitter as twitter,
			trans_profiling_validasi_mos.nama_pastel as nama_pastel,
			trans_profiling_validasi_mos.alamat as alamat,
			trans_profiling_validasi_mos.kota as kota,
			trans_profiling_validasi_mos.regional as regional,
			trans_profiling_validasi_mos.update_by as update_by,
			trans_profiling_validasi_mos.lup as lup,
			trans_profiling_validasi_mos.sumber as sumber,
			trans_profiling_validasi_mos.tgl_insert as tgl_insert,
			trans_profiling_validasi_mos.is_3p as is_3p,
			trans_profiling_validasi_mos.layanan as layanan,
			trans_profiling_validasi_mos.reason_call as reason_call,
			trans_profiling_validasi_mos.status as status,
			trans_profiling_validasi_mos.keterangan as keterangan,
			trans_profiling_validasi_mos.tgl_bayar as tgl_bayar,
			trans_profiling_validasi_mos.waktu_bayar as waktu_bayar,
			trans_profiling_validasi_mos.kecepatan as kecepatan,
			trans_profiling_validasi_mos.tagihan as tagihan,
			trans_profiling_validasi_mos.click_time as click_time,
		');
		
		$this->datatables->from('trans_profiling_validasi_mos');

		
		
		//mengembalikan dalam bentuk array
		$q =  json_decode($this->datatables->generate(),true);
		return $q;
	}
	

   public function get_all(){
		$afield = array(
			'trans_profiling_validasi_mos.idx as idx',
			'trans_profiling_validasi_mos.ncli as ncli',
			'trans_profiling_validasi_mos.no_pstn as no_pstn',
			'trans_profiling_validasi_mos.no_speedy as no_speedy',
			'trans_profiling_validasi_mos.nama_pelanggan as nama_pelanggan',
			'trans_profiling_validasi_mos.relasi as relasi',
			'trans_profiling_validasi_mos.no_handpone as no_handpone',
			'trans_profiling_validasi_mos.verfi_handphone as verfi_handphone',
			'trans_profiling_validasi_mos.email as email',
			'trans_profiling_validasi_mos.verfi_email as verfi_email',
			'trans_profiling_validasi_mos.facebook as facebook',
			'trans_profiling_validasi_mos.twitter as twitter',
			'trans_profiling_validasi_mos.nama_pastel as nama_pastel',
			'trans_profiling_validasi_mos.alamat as alamat',
			'trans_profiling_validasi_mos.kota as kota',
			'trans_profiling_validasi_mos.regional as regional',
			'trans_profiling_validasi_mos.update_by as update_by',
			'trans_profiling_validasi_mos.lup as lup',
			'trans_profiling_validasi_mos.sumber as sumber',
			'trans_profiling_validasi_mos.tgl_insert as tgl_insert',
			'trans_profiling_validasi_mos.is_3p as is_3p',
			'trans_profiling_validasi_mos.layanan as layanan',
			'trans_profiling_validasi_mos.reason_call as reason_call',
			'trans_profiling_validasi_mos.status as status',
			'trans_profiling_validasi_mos.keterangan as keterangan',
			'trans_profiling_validasi_mos.tgl_bayar as tgl_bayar',
			'trans_profiling_validasi_mos.waktu_bayar as waktu_bayar',
			'trans_profiling_validasi_mos.kecepatan as kecepatan',
			'trans_profiling_validasi_mos.tagihan as tagihan',
			'trans_profiling_validasi_mos.click_time as click_time',
		
		);
		$this->db->select($afield);

		$this->db->order_by('trans_profiling_validasi_mos.id', 'ASC');
		return $this->db->get('trans_profiling_validasi_mos')->result_array();
   }


	public function get_by_id($id){
		$afield = array(
			'trans_profiling_validasi_mos.idx as idx',
			'trans_profiling_validasi_mos.ncli as ncli',
			'trans_profiling_validasi_mos.no_pstn as no_pstn',
			'trans_profiling_validasi_mos.no_speedy as no_speedy',
			'trans_profiling_validasi_mos.nama_pelanggan as nama_pelanggan',
			'trans_profiling_validasi_mos.relasi as relasi',
			'trans_profiling_validasi_mos.no_handpone as no_handpone',
			'trans_profiling_validasi_mos.verfi_handphone as verfi_handphone',
			'trans_profiling_validasi_mos.email as email',
			'trans_profiling_validasi_mos.verfi_email as verfi_email',
			'trans_profiling_validasi_mos.facebook as facebook',
			'trans_profiling_validasi_mos.twitter as twitter',
			'trans_profiling_validasi_mos.nama_pastel as nama_pastel',
			'trans_profiling_validasi_mos.alamat as alamat',
			'trans_profiling_validasi_mos.kota as kota',
			'trans_profiling_validasi_mos.regional as regional',
			'trans_profiling_validasi_mos.update_by as update_by',
			'trans_profiling_validasi_mos.lup as lup',
			'trans_profiling_validasi_mos.sumber as sumber',
			'trans_profiling_validasi_mos.tgl_insert as tgl_insert',
			'trans_profiling_validasi_mos.is_3p as is_3p',
			'trans_profiling_validasi_mos.layanan as layanan',
			'trans_profiling_validasi_mos.reason_call as reason_call',
			'trans_profiling_validasi_mos.status as status',
			'trans_profiling_validasi_mos.keterangan as keterangan',
			'trans_profiling_validasi_mos.tgl_bayar as tgl_bayar',
			'trans_profiling_validasi_mos.waktu_bayar as waktu_bayar',
			'trans_profiling_validasi_mos.kecepatan as kecepatan',
			'trans_profiling_validasi_mos.tagihan as tagihan',
			'trans_profiling_validasi_mos.click_time as click_time',
		
		);
		$this->db->select($afield);

		$this->db->where('trans_profiling_validasi_mos.id', $id);
		$this->db->order_by('trans_profiling_validasi_mos.id', 'ASC');
		return $this->db->get('trans_profiling_validasi_mos')->row();
   }


	/* Memastikan data yg dibuat tidak kembar/sama,
	   fungsi ini sebagai pengganti fungsi primary key dr db,
	   krn primary key sudah di gunakan untuk column id.
	   -create : id di kosongkan.
	   -update : id di isi dengan id data yg di proses.	
	*/	
	function if_exist($id,$data){
		$this->db->where('trans_profiling_validasi_mos.id <>',$id);

		$q = $this->db->get_where('trans_profiling_validasi_mos', $data)->result_array();
		
		if(count($q)>0){
			return true;
		}else{
			return false;
		}		

	

	}


	function insert($data){
	
	    /* transaction rollback */
		$this->db->trans_start();
		
		$this->db->insert('trans_profiling_validasi_mos', $data);		
		/* id primary yg baru saja di input*/
		$this->id = $this->db->insert_id(); 
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false
	}

	function update($id,$data){

		/* transaction rollback */
		$this->db->trans_start();

		$this->db->where('trans_profiling_validasi_mos.id', $id);
		$this->db->update('trans_profiling_validasi_mos', $data);
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
	}

	function delete_multiple($data){
		/* transaction rollback */
		$this->db->trans_start();
		
		if(!empty($data)){
			$this->db->where_in('trans_profiling_validasi_mos.id',$data);	
	
			$this->db->delete('trans_profiling_validasi_mos');
		}
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
		
	}


};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-05-04 22:46:06 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
