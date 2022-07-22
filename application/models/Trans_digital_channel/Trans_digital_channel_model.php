<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_digital_channel_model extends CI_Model {
   public $id;	
   function __construct(){
        parent::__construct();
   }	
	
	public function json(){
		$this->datatables->select('
			trans_digital_channel.id as id,
			trans_digital_channel.digital_channel as digital_channel,
			trans_digital_channel.template as template,
			trans_digital_channel.konten_1 as konten_1,
			trans_digital_channel.konten_2 as konten_2,
			trans_digital_channel.konten_3 as konten_3,
			trans_digital_channel.konten_4 as konten_4,
			trans_digital_channel.konten_5 as konten_5,
			trans_digital_channel.konten as konten,
			trans_digital_channel.distribution as distribution,
			trans_digital_channel.veri_call as veri_call,
			trans_digital_channel.delivery as delivery,
			dc.id as dc_id,
			dc.channel as channel,
			dc.template as dc_template,
			dc.konten_1 as dc_konten_1,
			dc.konten_2 as dc_konten_2,
			dc.konten_3 as dc_konten_3,
			dc.konten_4 as dc_konten_4,
			dc.konten_5 as dc_konten_5,
			dc.status as status,
			dc.last_update as last_update,
			dc.userid as userid,
			tdc.id as tdc_id,
			tdc.template as tdc_template,
			tdc.jumlah_konten as jumlah_konten,
			tdc.kode_template as kode_template,
		');
		
		$this->datatables->from('trans_digital_channel');
	
		$this->datatables->join('digital_channel dc','dc.id=trans_digital_channel.digital_channel','LEFT'); 
	
		$this->datatables->join('template_digital_channel tdc','tdc.id=trans_digital_channel.template','LEFT'); 

		
		
		//mengembalikan dalam bentuk array
		$q =  json_decode($this->datatables->generate(),true);
		return $q;
	}
	

   public function get_all(){
		$afield = array(
			'trans_digital_channel.id as id',
			'trans_digital_channel.digital_channel as digital_channel',
			'trans_digital_channel.template as template',
			'trans_digital_channel.konten_1 as konten_1',
			'trans_digital_channel.konten_2 as konten_2',
			'trans_digital_channel.konten_3 as konten_3',
			'trans_digital_channel.konten_4 as konten_4',
			'trans_digital_channel.konten_5 as konten_5',
			'trans_digital_channel.konten as konten',
			'trans_digital_channel.distribution as distribution',
			'trans_digital_channel.veri_call as veri_call',
			'trans_digital_channel.delivery as delivery',
			'dc.id as dc_id',
			'dc.channel as channel',
			'dc.template as dc_template',
			'dc.konten_1 as dc_konten_1',
			'dc.konten_2 as dc_konten_2',
			'dc.konten_3 as dc_konten_3',
			'dc.konten_4 as dc_konten_4',
			'dc.konten_5 as dc_konten_5',
			'dc.status as status',
			'dc.last_update as last_update',
			'dc.userid as userid',
			'tdc.id as tdc_id',
			'tdc.template as tdc_template',
			'tdc.jumlah_konten as jumlah_konten',
			'tdc.kode_template as kode_template',
		
		);
		$this->db->select($afield);
		$this->db->join('digital_channel dc','dc.id=trans_digital_channel.digital_channel','LEFT'); 
		$this->db->join('template_digital_channel tdc','tdc.id=trans_digital_channel.template','LEFT'); 

		$this->db->order_by('trans_digital_channel.id', 'ASC');
		return $this->db->get('trans_digital_channel')->result_array();
   }


	public function get_by_id($id){
		$afield = array(
			'trans_digital_channel.id as id',
			'trans_digital_channel.digital_channel as digital_channel',
			'trans_digital_channel.template as template',
			'trans_digital_channel.konten_1 as konten_1',
			'trans_digital_channel.konten_2 as konten_2',
			'trans_digital_channel.konten_3 as konten_3',
			'trans_digital_channel.konten_4 as konten_4',
			'trans_digital_channel.konten_5 as konten_5',
			'trans_digital_channel.konten as konten',
			'trans_digital_channel.distribution as distribution',
			'trans_digital_channel.veri_call as veri_call',
			'trans_digital_channel.delivery as delivery',
			'dc.id as dc_id',
			'dc.channel as channel',
			'dc.template as dc_template',
			'dc.konten_1 as dc_konten_1',
			'dc.konten_2 as dc_konten_2',
			'dc.konten_3 as dc_konten_3',
			'dc.konten_4 as dc_konten_4',
			'dc.konten_5 as dc_konten_5',
			'dc.status as status',
			'dc.last_update as last_update',
			'dc.userid as userid',
			'tdc.id as tdc_id',
			'tdc.template as tdc_template',
			'tdc.jumlah_konten as jumlah_konten',
			'tdc.kode_template as kode_template',
		
		);
		$this->db->select($afield);
		$this->db->join('digital_channel dc','dc.id=trans_digital_channel.digital_channel','LEFT'); 
		$this->db->join('template_digital_channel tdc','tdc.id=trans_digital_channel.template','LEFT'); 

		$this->db->where('trans_digital_channel.id', $id);
		$this->db->order_by('trans_digital_channel.id', 'ASC');
		return $this->db->get('trans_digital_channel')->row();
   }


	/* Memastikan data yg dibuat tidak kembar/sama,
	   fungsi ini sebagai pengganti fungsi primary key dr db,
	   krn primary key sudah di gunakan untuk column id.
	   -create : id di kosongkan.
	   -update : id di isi dengan id data yg di proses.	
	*/	
	function if_exist($id,$data){
		$this->db->where('trans_digital_channel.id <>',$id);

		$q = $this->db->get_where('trans_digital_channel', $data)->result_array();
		
		if(count($q)>0){
			return true;
		}else{
			return false;
		}		

	

	}


	function insert($data){
	
	    /* transaction rollback */
		$this->db->trans_start();
		
		$this->db->insert('trans_digital_channel', $data);		
		/* id primary yg baru saja di input*/
		$this->id = $this->db->insert_id(); 
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false
	}

	function update($id,$data){

		/* transaction rollback */
		$this->db->trans_start();

		$this->db->where('trans_digital_channel.id', $id);
		$this->db->update('trans_digital_channel', $data);
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
	}

	function delete_multiple($data){
		/* transaction rollback */
		$this->db->trans_start();
		
		if(!empty($data)){
			$this->db->where_in('trans_digital_channel.id',$data);	
	
			$this->db->delete('trans_digital_channel');
		}
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
		
	}


};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-12-15 07:56:57 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
