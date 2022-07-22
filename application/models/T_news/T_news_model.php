<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_news_model extends CI_Model {
   public $id;	
   function __construct(){
        parent::__construct();
   }	
	
	public function json(){
		$this->datatables->select('
			t_news.id as id,
			t_news.id_sender as id_sender,
			t_news.optlevel_receiver as optlevel_receiver,
			t_news.title as title,
			t_news.kategori_news as kategori_news,
			t_news.isi_berita as isi_berita,
			t_news.tanggal_publish as tanggal_publish,
			t_news.status_publish as status_publish,
			nmuser.id as nmuser_id,
			nmuser.nmuser as nmuser,
			nmuser.passuser as passuser,
			nmuser.opt_level as opt_level,
			nmuser.opt_status as opt_status,
			nmuser.picture as picture,
			nmuser.nama as nama,
			nmuser.agentid as agentid,
			nmuser.kategori as kategori,
			nmuser.tl as tl,
			nmuser.nik_absensi as nik_absensi,
			optlvl.id as optlvl_id,
			optlvl.nmuser as optlvl_nmuser,
			optlvl.passuser as optlvl_passuser,
			optlvl.opt_level as optlvl_opt_level,
			optlvl.opt_status as optlvl_opt_status,
			optlvl.picture as optlvl_picture,
			optlvl.nama as optlvl_nama,
			optlvl.agentid as optlvl_agentid,
			optlvl.kategori as optlvl_kategori,
			optlvl.tl as optlvl_tl,
			optlvl.nik_absensi as optlvl_nik_absensi,
		');
		
		$this->datatables->from('t_news');
	
		$this->datatables->join('sys_user nmuser','nmuser.id=t_news.id_sender','LEFT'); 
	
		$this->datatables->join('sys_user optlvl','optlvl.id=t_news.optlevel_receiver','LEFT'); 

		
		
		//mengembalikan dalam bentuk array
		$q =  json_decode($this->datatables->generate(),true);
		return $q;
	}
	

   public function get_all(){
		$afield = array(
			't_news.id as id',
			't_news.id_sender as id_sender',
			't_news.optlevel_receiver as optlevel_receiver',
			't_news.title as title',
			't_news.kategori_news as kategori_news',
			't_news.isi_berita as isi_berita',
			't_news.tanggal_publish as tanggal_publish',
			't_news.status_publish as status_publish',
			'nmuser.id as nmuser_id',
			'nmuser.nmuser as nmuser',
			'nmuser.passuser as passuser',
			'nmuser.opt_level as opt_level',
			'nmuser.opt_status as opt_status',
			'nmuser.picture as picture',
			'nmuser.nama as nama',
			'nmuser.agentid as agentid',
			'nmuser.kategori as kategori',
			'nmuser.tl as tl',
			'nmuser.nik_absensi as nik_absensi',
			'optlvl.id as optlvl_id',
			'optlvl.nmuser as optlvl_nmuser',
			'optlvl.passuser as optlvl_passuser',
			'optlvl.opt_level as optlvl_opt_level',
			'optlvl.opt_status as optlvl_opt_status',
			'optlvl.picture as optlvl_picture',
			'optlvl.nama as optlvl_nama',
			'optlvl.agentid as optlvl_agentid',
			'optlvl.kategori as optlvl_kategori',
			'optlvl.tl as optlvl_tl',
			'optlvl.nik_absensi as optlvl_nik_absensi',
		
		);
		$this->db->select($afield);
		$this->db->join('sys_user nmuser','nmuser.id=t_news.id_sender','LEFT'); 
		$this->db->join('sys_user optlvl','optlvl.id=t_news.optlevel_receiver','LEFT'); 

		$this->db->order_by('t_news.id', 'ASC');
		return $this->db->get('t_news')->result_array();
   }


	public function get_by_id($id){
		$afield = array(
			't_news.id as id',
			't_news.id_sender as id_sender',
			't_news.optlevel_receiver as optlevel_receiver',
			't_news.title as title',
			't_news.kategori_news as kategori_news',
			't_news.isi_berita as isi_berita',
			't_news.tanggal_publish as tanggal_publish',
			't_news.status_publish as status_publish',
			'nmuser.id as nmuser_id',
			'nmuser.nmuser as nmuser',
			'nmuser.passuser as passuser',
			'nmuser.opt_level as opt_level',
			'nmuser.opt_status as opt_status',
			'nmuser.picture as picture',
			'nmuser.nama as nama',
			'nmuser.agentid as agentid',
			'nmuser.kategori as kategori',
			'nmuser.tl as tl',
			'nmuser.nik_absensi as nik_absensi',
			'optlvl.id as optlvl_id',
			'optlvl.nmuser as optlvl_nmuser',
			'optlvl.passuser as optlvl_passuser',
			'optlvl.opt_level as optlvl_opt_level',
			'optlvl.opt_status as optlvl_opt_status',
			'optlvl.picture as optlvl_picture',
			'optlvl.nama as optlvl_nama',
			'optlvl.agentid as optlvl_agentid',
			'optlvl.kategori as optlvl_kategori',
			'optlvl.tl as optlvl_tl',
			'optlvl.nik_absensi as optlvl_nik_absensi',
		
		);
		$this->db->select($afield);
		$this->db->join('sys_user nmuser','nmuser.id=t_news.id_sender','LEFT'); 
		$this->db->join('sys_user optlvl','optlvl.id=t_news.optlevel_receiver','LEFT'); 

		$this->db->where('t_news.id', $id);
		$this->db->order_by('t_news.id', 'ASC');
		return $this->db->get('t_news')->row();
   }


	/* Memastikan data yg dibuat tidak kembar/sama,
	   fungsi ini sebagai pengganti fungsi primary key dr db,
	   krn primary key sudah di gunakan untuk column id.
	   -create : id di kosongkan.
	   -update : id di isi dengan id data yg di proses.	
	*/	
	function if_exist($id,$data){
		$this->db->where('t_news.id <>',$id);

		$q = $this->db->get_where('t_news', $data)->result_array();
		
		if(count($q)>0){
			return true;
		}else{
			return false;
		}		

	

	}


	function insert($data){
	
	    /* transaction rollback */
		$this->db->trans_start();
		
		$this->db->insert('t_news', $data);		
		/* id primary yg baru saja di input*/
		$this->id = $this->db->insert_id(); 
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false
	}

	function update($id,$data){

		/* transaction rollback */
		$this->db->trans_start();

		$this->db->where('t_news.id', $id);
		$this->db->update('t_news', $data);
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
	}

	function delete_multiple($data){
		/* transaction rollback */
		$this->db->trans_start();
		
		if(!empty($data)){
			$this->db->where_in('t_news.id',$data);	
	
			$this->db->delete('t_news');
		}
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
		
	}


};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-03-31 12:57:58 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
