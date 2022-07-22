<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Digital_channel_model extends CI_Model {
   public $id;	
   function __construct(){
        parent::__construct();
   }	
	
	public function json(){
		$this->datatables->select('
			digital_channel.id as id,
			digital_channel.channel as channel,
			digital_channel.template as template,
			digital_channel.konten_1 as konten_1,
			digital_channel.konten_2 as konten_2,
			digital_channel.konten_3 as konten_3,
			digital_channel.konten_4 as konten_4,
			digital_channel.konten_5 as konten_5,
			digital_channel.status as status,
			digital_channel.last_update as last_update,
			digital_channel.userid as userid,
			template_dc.id as template_dc_id,
			template_dc.template as template_dc_template,
			template_dc.jumlah_konten as jumlah_konten,
			template_dc.kode_template as kode_template,
			statusna.id as statusna_id,
			statusna.status as statusna_status,
			userupdate.id as userupdate_id,
			userupdate.nmuser as nmuser,
			userupdate.passuser as passuser,
			userupdate.opt_level as opt_level,
			userupdate.opt_status as opt_status,
			userupdate.picture as picture,
			userupdate.nama as nama,
			userupdate.agentid as agentid,
			userupdate.kategori as kategori,
			userupdate.tl as tl,
			userupdate.nik_absensi as nik_absensi,
			userupdate.agent_mos as agent_mos,
		');
		
		$this->datatables->from('digital_channel');
	
		$this->datatables->join('template_digital_channel template_dc','template_dc.id=digital_channel.template','LEFT'); 
	
		$this->datatables->join('sys_status statusna','statusna.id=digital_channel.status','LEFT'); 
	
		$this->datatables->join('sys_user userupdate','userupdate.id=digital_channel.userid','LEFT'); 

		
		
		//mengembalikan dalam bentuk array
		$q =  json_decode($this->datatables->generate(),true);
		return $q;
	}
	

   public function get_all(){
		$afield = array(
			'digital_channel.id as id',
			'digital_channel.channel as channel',
			'digital_channel.template as template',
			'digital_channel.konten_1 as konten_1',
			'digital_channel.konten_2 as konten_2',
			'digital_channel.konten_3 as konten_3',
			'digital_channel.konten_4 as konten_4',
			'digital_channel.konten_5 as konten_5',
			'digital_channel.status as status',
			'digital_channel.last_update as last_update',
			'digital_channel.userid as userid',
			'template_dc.id as template_dc_id',
			'template_dc.template as template_dc_template',
			'template_dc.jumlah_konten as jumlah_konten',
			'template_dc.kode_template as kode_template',
			'statusna.id as statusna_id',
			'statusna.status as statusna_status',
			'userupdate.id as userupdate_id',
			'userupdate.nmuser as nmuser',
			'userupdate.passuser as passuser',
			'userupdate.opt_level as opt_level',
			'userupdate.opt_status as opt_status',
			'userupdate.picture as picture',
			'userupdate.nama as nama',
			'userupdate.agentid as agentid',
			'userupdate.kategori as kategori',
			'userupdate.tl as tl',
			'userupdate.nik_absensi as nik_absensi',
			'userupdate.agent_mos as agent_mos',
		
		);
		$this->db->select($afield);
		$this->db->join('template_digital_channel template_dc','template_dc.id=digital_channel.template','LEFT'); 
		$this->db->join('sys_status statusna','statusna.id=digital_channel.status','LEFT'); 
		$this->db->join('sys_user userupdate','userupdate.id=digital_channel.userid','LEFT'); 

		$this->db->order_by('digital_channel.id', 'ASC');
		return $this->db->get('digital_channel')->result_array();
   }


	public function get_by_id($id){
		$afield = array(
			'digital_channel.id as id',
			'digital_channel.channel as channel',
			'digital_channel.template as template',
			'digital_channel.konten_1 as konten_1',
			'digital_channel.konten_2 as konten_2',
			'digital_channel.konten_3 as konten_3',
			'digital_channel.konten_4 as konten_4',
			'digital_channel.konten_5 as konten_5',
			'digital_channel.status as status',
			'digital_channel.last_update as last_update',
			'digital_channel.userid as userid',
			'template_dc.id as template_dc_id',
			'template_dc.template as template_dc_template',
			'template_dc.jumlah_konten as jumlah_konten',
			'template_dc.kode_template as kode_template',
			'statusna.id as statusna_id',
			'statusna.status as statusna_status',
			'userupdate.id as userupdate_id',
			'userupdate.nmuser as nmuser',
			'userupdate.passuser as passuser',
			'userupdate.opt_level as opt_level',
			'userupdate.opt_status as opt_status',
			'userupdate.picture as picture',
			'userupdate.nama as nama',
			'userupdate.agentid as agentid',
			'userupdate.kategori as kategori',
			'userupdate.tl as tl',
			'userupdate.nik_absensi as nik_absensi',
			'userupdate.agent_mos as agent_mos',
		
		);
		$this->db->select($afield);
		$this->db->join('template_digital_channel template_dc','template_dc.id=digital_channel.template','LEFT'); 
		$this->db->join('sys_status statusna','statusna.id=digital_channel.status','LEFT'); 
		$this->db->join('sys_user userupdate','userupdate.id=digital_channel.userid','LEFT'); 

		$this->db->where('digital_channel.id', $id);
		$this->db->order_by('digital_channel.id', 'ASC');
		return $this->db->get('digital_channel')->row();
   }


	/* Memastikan data yg dibuat tidak kembar/sama,
	   fungsi ini sebagai pengganti fungsi primary key dr db,
	   krn primary key sudah di gunakan untuk column id.
	   -create : id di kosongkan.
	   -update : id di isi dengan id data yg di proses.	
	*/	
	function if_exist($id,$data){
		$this->db->where('digital_channel.id <>',$id);

		$q = $this->db->get_where('digital_channel', $data)->result_array();
		
		if(count($q)>0){
			return true;
		}else{
			return false;
		}		

	

	}


	function insert($data){
	
	    /* transaction rollback */
		$this->db->trans_start();
		
		$this->db->insert('digital_channel', $data);		
		/* id primary yg baru saja di input*/
		$this->id = $this->db->insert_id(); 
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false
	}

	function update($id,$data){

		/* transaction rollback */
		$this->db->trans_start();

		$this->db->where('digital_channel.id', $id);
		$this->db->update('digital_channel', $data);
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
	}

	function delete_multiple($data){
		/* transaction rollback */
		$this->db->trans_start();
		
		if(!empty($data)){
			$this->db->where_in('digital_channel.id',$data);	
	
			$this->db->delete('digital_channel');
		}
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
		
	}


};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-12-15 07:45:24 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
