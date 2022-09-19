<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_profiling_model extends CI_Model {
   public $id;	
   function __construct(){
        parent::__construct();
   }	
	
	public function json(){
		$this->datatables->select('
			trans_profiling.id as id,
			trans_profiling.idx as idx,
			trans_profiling.ncli as ncli,
			trans_profiling.nama as nama,
			trans_profiling.pstn1 as pstn1,
			trans_profiling.no_speedy as no_speedy,
			trans_profiling.kepemilikan as kepemilikan,
			trans_profiling.facebook as facebook,
			trans_profiling.verfi_fb as verfi_fb,
			trans_profiling.twitter as twitter,
			trans_profiling.verfi_twitter as verfi_twitter,
			trans_profiling.relasi as relasi,
			trans_profiling.email as email,
			trans_profiling.verfi_email as verfi_email,
			trans_profiling.lup_email as lup_email,
			trans_profiling.email_lain as email_lain,
			trans_profiling.handphone as handphone,
			trans_profiling.verfi_handphone as verfi_handphone,
			trans_profiling.lup_handphone as lup_handphone,
			trans_profiling.nama_pastel as nama_pastel,
			trans_profiling.alamat as alamat,
			trans_profiling.kota as kota,
			trans_profiling.waktu_psb as waktu_psb,
			trans_profiling.kec_speedy as kec_speedy,
			trans_profiling.billing as billing,
			trans_profiling.payment as payment,
			trans_profiling.tgl_lahir as tgl_lahir,
			trans_profiling.status as status,
			trans_profiling.profiling_by as profiling_by,
			trans_profiling.click_sms as click_sms,
			trans_profiling.click_email as click_email,
			trans_profiling.ip_address as ip_address,
			trans_profiling.date_created as date_created,
			trans_profiling.hub_pemilik as hub_pemilik,
			trans_profiling.veri_distribusi as veri_distribusi,
			trans_profiling.veri_count as veri_count,
			trans_profiling.veri_status as veri_status,
			trans_profiling.veri_call as veri_call,
			trans_profiling.veri_keterangan as veri_keterangan,
			trans_profiling.veri_upd as veri_upd,
			trans_profiling.veri_lup as veri_lup,
			trans_profiling.lup as lup,
			trans_profiling.click_session as click_session,
			trans_profiling.division as division,
			trans_profiling.witel as witel,
			trans_profiling.kandatel as kandatel,
			trans_profiling.regional as regional,
			trans_profiling.veri_system as veri_system,
			trans_profiling.nik as nik,
			trans_profiling.no_kk as no_kk,
			trans_profiling.nama_ibu_kandung as nama_ibu_kandung,
			trans_profiling.path as path,
			trans_profiling.instagram as instagram,
			trans_profiling.handphone_lain as handphone_lain,
			trans_profiling.opsi_call as opsi_call,
			statuscall.id as statuscall_id,
			statuscall.id_reason as id_reason,
			statuscall.nama_reason as nama_reason,
			sysuser.id as sysuser_id,
			sysuser.nmuser as nmuser,
			sysuser.passuser as passuser,
			sysuser.opt_level as opt_level,
			sysuser.opt_status as opt_status,
			sysuser.picture as picture,
			sysuser.nama as sysuser_nama,
			sysuser.agentid as agentid,
		');
		
		$this->datatables->from('trans_profiling');
	
		$this->datatables->join('status_call statuscall','statuscall.id=trans_profiling.veri_call','LEFT'); 
	
		$this->datatables->join('sys_user sysuser','sysuser.id=trans_profiling.veri_upd','LEFT'); 

		
		
		//mengembalikan dalam bentuk array
		$q =  json_decode($this->datatables->generate(),true);
		return $q;
	}
	

   public function get_all(){
		$afield = array(
			'trans_profiling.id as id',
			'trans_profiling.idx as idx',
			'trans_profiling.ncli as ncli',
			'trans_profiling.nama as nama',
			'trans_profiling.pstn1 as pstn1',
			'trans_profiling.no_speedy as no_speedy',
			'trans_profiling.kepemilikan as kepemilikan',
			'trans_profiling.facebook as facebook',
			'trans_profiling.verfi_fb as verfi_fb',
			'trans_profiling.twitter as twitter',
			'trans_profiling.verfi_twitter as verfi_twitter',
			'trans_profiling.relasi as relasi',
			'trans_profiling.email as email',
			'trans_profiling.verfi_email as verfi_email',
			'trans_profiling.lup_email as lup_email',
			'trans_profiling.email_lain as email_lain',
			'trans_profiling.handphone as handphone',
			'trans_profiling.verfi_handphone as verfi_handphone',
			'trans_profiling.lup_handphone as lup_handphone',
			'trans_profiling.nama_pastel as nama_pastel',
			'trans_profiling.alamat as alamat',
			'trans_profiling.kota as kota',
			'trans_profiling.waktu_psb as waktu_psb',
			'trans_profiling.kec_speedy as kec_speedy',
			'trans_profiling.billing as billing',
			'trans_profiling.payment as payment',
			'trans_profiling.tgl_lahir as tgl_lahir',
			'trans_profiling.status as status',
			'trans_profiling.profiling_by as profiling_by',
			'trans_profiling.click_sms as click_sms',
			'trans_profiling.click_email as click_email',
			'trans_profiling.ip_address as ip_address',
			'trans_profiling.date_created as date_created',
			'trans_profiling.hub_pemilik as hub_pemilik',
			'trans_profiling.veri_distribusi as veri_distribusi',
			'trans_profiling.veri_count as veri_count',
			'trans_profiling.veri_status as veri_status',
			'trans_profiling.veri_call as veri_call',
			'trans_profiling.veri_keterangan as veri_keterangan',
			'trans_profiling.veri_upd as veri_upd',
			'trans_profiling.veri_lup as veri_lup',
			'trans_profiling.lup as lup',
			'trans_profiling.click_session as click_session',
			'trans_profiling.division as division',
			'trans_profiling.witel as witel',
			'trans_profiling.kandatel as kandatel',
			'trans_profiling.regional as regional',
			'trans_profiling.veri_system as veri_system',
			'trans_profiling.nik as nik',
			'trans_profiling.no_kk as no_kk',
			'trans_profiling.nama_ibu_kandung as nama_ibu_kandung',
			'trans_profiling.path as path',
			'trans_profiling.instagram as instagram',
			'trans_profiling.handphone_lain as handphone_lain',
			'trans_profiling.opsi_call as opsi_call',
			'statuscall.id as statuscall_id',
			'statuscall.id_reason as id_reason',
			'statuscall.nama_reason as nama_reason',
			'sysuser.id as sysuser_id',
			'sysuser.nmuser as nmuser',
			'sysuser.passuser as passuser',
			'sysuser.opt_level as opt_level',
			'sysuser.opt_status as opt_status',
			'sysuser.picture as picture',
			'sysuser.nama as sysuser_nama',
			'sysuser.agentid as agentid',
		
		);
		$this->db->select($afield);
		$this->db->join('status_call statuscall','statuscall.id=trans_profiling.veri_call','LEFT'); 
		$this->db->join('sys_user sysuser','sysuser.id=trans_profiling.veri_upd','LEFT'); 

		$this->db->order_by('trans_profiling.id', 'ASC');
		return $this->db->get('trans_profiling')->result_array();
   }


	public function get_by_id($id){
		$afield = array(
			'trans_profiling.id as id',
			'trans_profiling.idx as idx',
			'trans_profiling.ncli as ncli',
			'trans_profiling.nama as nama',
			'trans_profiling.pstn1 as pstn1',
			'trans_profiling.no_speedy as no_speedy',
			'trans_profiling.kepemilikan as kepemilikan',
			'trans_profiling.facebook as facebook',
			'trans_profiling.verfi_fb as verfi_fb',
			'trans_profiling.twitter as twitter',
			'trans_profiling.verfi_twitter as verfi_twitter',
			'trans_profiling.relasi as relasi',
			'trans_profiling.email as email',
			'trans_profiling.verfi_email as verfi_email',
			'trans_profiling.lup_email as lup_email',
			'trans_profiling.email_lain as email_lain',
			'trans_profiling.handphone as handphone',
			'trans_profiling.verfi_handphone as verfi_handphone',
			'trans_profiling.lup_handphone as lup_handphone',
			'trans_profiling.nama_pastel as nama_pastel',
			'trans_profiling.alamat as alamat',
			'trans_profiling.kota as kota',
			'trans_profiling.waktu_psb as waktu_psb',
			'trans_profiling.kec_speedy as kec_speedy',
			'trans_profiling.billing as billing',
			'trans_profiling.payment as payment',
			'trans_profiling.tgl_lahir as tgl_lahir',
			'trans_profiling.status as status',
			'trans_profiling.profiling_by as profiling_by',
			'trans_profiling.click_sms as click_sms',
			'trans_profiling.click_email as click_email',
			'trans_profiling.ip_address as ip_address',
			'trans_profiling.date_created as date_created',
			'trans_profiling.hub_pemilik as hub_pemilik',
			'trans_profiling.veri_distribusi as veri_distribusi',
			'trans_profiling.veri_count as veri_count',
			'trans_profiling.veri_status as veri_status',
			'trans_profiling.veri_call as veri_call',
			'trans_profiling.veri_keterangan as veri_keterangan',
			'trans_profiling.veri_upd as veri_upd',
			'trans_profiling.veri_lup as veri_lup',
			'trans_profiling.lup as lup',
			'trans_profiling.click_session as click_session',
			'trans_profiling.division as division',
			'trans_profiling.witel as witel',
			'trans_profiling.kandatel as kandatel',
			'trans_profiling.regional as regional',
			'trans_profiling.veri_system as veri_system',
			'trans_profiling.nik as nik',
			'trans_profiling.no_kk as no_kk',
			'trans_profiling.nama_ibu_kandung as nama_ibu_kandung',
			'trans_profiling.path as path',
			'trans_profiling.instagram as instagram',
			'trans_profiling.handphone_lain as handphone_lain',
			'trans_profiling.opsi_call as opsi_call',
			'statuscall.id as statuscall_id',
			'statuscall.id_reason as id_reason',
			'statuscall.nama_reason as nama_reason',
			'sysuser.id as sysuser_id',
			'sysuser.nmuser as nmuser',
			'sysuser.passuser as passuser',
			'sysuser.opt_level as opt_level',
			'sysuser.opt_status as opt_status',
			'sysuser.picture as picture',
			'sysuser.nama as sysuser_nama',
			'sysuser.agentid as agentid',
		
		);
		$this->db->select($afield);
		$this->db->join('status_call statuscall','statuscall.id=trans_profiling.veri_call','LEFT'); 
		$this->db->join('sys_user sysuser','sysuser.id=trans_profiling.veri_upd','LEFT'); 

		$this->db->where('trans_profiling.id', $id);
		$this->db->order_by('trans_profiling.id', 'ASC');
		return $this->db->get('trans_profiling')->row();
   }


	/* Memastikan data yg dibuat tidak kembar/sama,
	   fungsi ini sebagai pengganti fungsi primary key dr db,
	   krn primary key sudah di gunakan untuk column id.
	   -create : id di kosongkan.
	   -update : id di isi dengan id data yg di proses.	
	*/	
	function if_exist($id,$data){
		$this->db->where('trans_profiling.id <>',$id);

		$q = $this->db->get_where('trans_profiling', $data)->result_array();
		
		if(count($q)>0){
			return true;
		}else{
			return false;
		}		

	

	}


	function insert($data){
	
	    /* transaction rollback */
		$this->db->trans_start();
		
		$this->db->insert('trans_profiling', $data);		
		/* id primary yg baru saja di input*/
		$this->id = $this->db->insert_id(); 
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false
	}

	function update($id,$data){

		/* transaction rollback */
		$this->db->trans_start();

		$this->db->where('trans_profiling.id', $id);
		$this->db->update('trans_profiling', $data);
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
	}

	function delete_multiple($data){
		/* transaction rollback */
		$this->db->trans_start();
		
		if(!empty($data)){
			$this->db->where_in('trans_profiling.id',$data);	
	
			$this->db->delete('trans_profiling');
		}
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
		
	}


};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-01-12 20:31:04 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
