<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Monthly_report_monthly_moss_model extends CI_Model {
   public $id;	
   function __construct(){
        parent::__construct();
   }	
	
	public function json(){
		$this->datatables->select('
			monthly_report_monthly_moss.id as id,
			monthly_report_monthly_moss.tahun as tahun,
			monthly_report_monthly_moss.bulan as bulan,
			monthly_report_monthly_moss.last_update as last_update,
			monthly_report_monthly_moss.best_agent as best_agent,
			monthly_report_monthly_moss.best_teamleader as best_teamleader,
			monthly_report_monthly_moss.verified_best_agent as verified_best_agent,
			monthly_report_monthly_moss.verified_best_teamleader as verified_best_teamleader,
			monthly_report_monthly_moss.best_agent_moss as best_agent_moss,
			monthly_report_monthly_moss.slg_best_agent_moss as slg_best_agent_moss,
			monthly_report_monthly_moss.best_teamleader_moss as best_teamleader_moss,
			monthly_report_monthly_moss.slg_best_teamleader_moss as slg_best_teamleader_moss,
			monthly_report_monthly_moss.verified as verified,
			monthly_report_monthly_moss.co as co,
			monthly_report_monthly_moss.contacted as contacted,
			monthly_report_monthly_moss.not_contacted as not_contacted,
			monthly_report_monthly_moss.hp_email as hp_email,
			monthly_report_monthly_moss.hp_only as hp_only,
			monthly_report_monthly_moss.agent_1 as agent_1,
			monthly_report_monthly_moss.agent_1_num as agent_1_num,
			monthly_report_monthly_moss.agent_2 as agent_2,
			monthly_report_monthly_moss.agent_2_num as agent_2_num,
			monthly_report_monthly_moss.agent_3 as agent_3,
			monthly_report_monthly_moss.agent_3_num as agent_3_num,
			monthly_report_monthly_moss.agent_4 as agent_4,
			monthly_report_monthly_moss.agent_4_num as agent_4_num,
			monthly_report_monthly_moss.agent_5 as agent_5,
			monthly_report_monthly_moss.agent_5_num as agent_5_num,
			monthly_report_monthly_moss.agent_6 as agent_6,
			monthly_report_monthly_moss.agent_6_num as agent_6_num,
			monthly_report_monthly_moss.agent_online as agent_online,
			monthly_report_monthly_moss.slg as slg,
			monthly_report_monthly_moss.slfc as slfc,
		');
		
		$this->datatables->from('monthly_report_monthly_moss');

		
		
		//mengembalikan dalam bentuk array
		$q =  json_decode($this->datatables->generate(),true);
		return $q;
	}
	

   public function get_all(){
		$afield = array(
			'monthly_report_monthly_moss.id as id',
			'monthly_report_monthly_moss.tahun as tahun',
			'monthly_report_monthly_moss.bulan as bulan',
			'monthly_report_monthly_moss.last_update as last_update',
			'monthly_report_monthly_moss.best_agent as best_agent',
			'monthly_report_monthly_moss.best_teamleader as best_teamleader',
			'monthly_report_monthly_moss.verified_best_agent as verified_best_agent',
			'monthly_report_monthly_moss.verified_best_teamleader as verified_best_teamleader',
			'monthly_report_monthly_moss.best_agent_moss as best_agent_moss',
			'monthly_report_monthly_moss.slg_best_agent_moss as slg_best_agent_moss',
			'monthly_report_monthly_moss.best_teamleader_moss as best_teamleader_moss',
			'monthly_report_monthly_moss.slg_best_teamleader_moss as slg_best_teamleader_moss',
			'monthly_report_monthly_moss.verified as verified',
			'monthly_report_monthly_moss.co as co',
			'monthly_report_monthly_moss.contacted as contacted',
			'monthly_report_monthly_moss.not_contacted as not_contacted',
			'monthly_report_monthly_moss.hp_email as hp_email',
			'monthly_report_monthly_moss.hp_only as hp_only',
			'monthly_report_monthly_moss.agent_1 as agent_1',
			'monthly_report_monthly_moss.agent_1_num as agent_1_num',
			'monthly_report_monthly_moss.agent_2 as agent_2',
			'monthly_report_monthly_moss.agent_2_num as agent_2_num',
			'monthly_report_monthly_moss.agent_3 as agent_3',
			'monthly_report_monthly_moss.agent_3_num as agent_3_num',
			'monthly_report_monthly_moss.agent_4 as agent_4',
			'monthly_report_monthly_moss.agent_4_num as agent_4_num',
			'monthly_report_monthly_moss.agent_5 as agent_5',
			'monthly_report_monthly_moss.agent_5_num as agent_5_num',
			'monthly_report_monthly_moss.agent_6 as agent_6',
			'monthly_report_monthly_moss.agent_6_num as agent_6_num',
			'monthly_report_monthly_moss.agent_online as agent_online',
			'monthly_report_monthly_moss.slg as slg',
			'monthly_report_monthly_moss.slfc as slfc',
		
		);
		$this->db->select($afield);

		$this->db->order_by('monthly_report_monthly_moss.id', 'ASC');
		return $this->db->get('monthly_report_monthly_moss')->result_array();
   }


	public function get_by_id($id){
		$afield = array(
			'monthly_report_monthly_moss.id as id',
			'monthly_report_monthly_moss.tahun as tahun',
			'monthly_report_monthly_moss.bulan as bulan',
			'monthly_report_monthly_moss.last_update as last_update',
			'monthly_report_monthly_moss.best_agent as best_agent',
			'monthly_report_monthly_moss.best_teamleader as best_teamleader',
			'monthly_report_monthly_moss.verified_best_agent as verified_best_agent',
			'monthly_report_monthly_moss.verified_best_teamleader as verified_best_teamleader',
			'monthly_report_monthly_moss.best_agent_moss as best_agent_moss',
			'monthly_report_monthly_moss.slg_best_agent_moss as slg_best_agent_moss',
			'monthly_report_monthly_moss.best_teamleader_moss as best_teamleader_moss',
			'monthly_report_monthly_moss.slg_best_teamleader_moss as slg_best_teamleader_moss',
			'monthly_report_monthly_moss.verified as verified',
			'monthly_report_monthly_moss.co as co',
			'monthly_report_monthly_moss.contacted as contacted',
			'monthly_report_monthly_moss.not_contacted as not_contacted',
			'monthly_report_monthly_moss.hp_email as hp_email',
			'monthly_report_monthly_moss.hp_only as hp_only',
			'monthly_report_monthly_moss.agent_1 as agent_1',
			'monthly_report_monthly_moss.agent_1_num as agent_1_num',
			'monthly_report_monthly_moss.agent_2 as agent_2',
			'monthly_report_monthly_moss.agent_2_num as agent_2_num',
			'monthly_report_monthly_moss.agent_3 as agent_3',
			'monthly_report_monthly_moss.agent_3_num as agent_3_num',
			'monthly_report_monthly_moss.agent_4 as agent_4',
			'monthly_report_monthly_moss.agent_4_num as agent_4_num',
			'monthly_report_monthly_moss.agent_5 as agent_5',
			'monthly_report_monthly_moss.agent_5_num as agent_5_num',
			'monthly_report_monthly_moss.agent_6 as agent_6',
			'monthly_report_monthly_moss.agent_6_num as agent_6_num',
			'monthly_report_monthly_moss.agent_online as agent_online',
			'monthly_report_monthly_moss.slg as slg',
			'monthly_report_monthly_moss.slfc as slfc',
		
		);
		$this->db->select($afield);

		$this->db->where('monthly_report_monthly_moss.id', $id);
		$this->db->order_by('monthly_report_monthly_moss.id', 'ASC');
		return $this->db->get('monthly_report_monthly_moss')->row();
   }


	/* Memastikan data yg dibuat tidak kembar/sama,
	   fungsi ini sebagai pengganti fungsi primary key dr db,
	   krn primary key sudah di gunakan untuk column id.
	   -create : id di kosongkan.
	   -update : id di isi dengan id data yg di proses.	
	*/	
	function if_exist($id,$data){
		$this->db->where('monthly_report_monthly_moss.id <>',$id);

		$q = $this->db->get_where('monthly_report_monthly_moss', $data)->result_array();
		
		if(count($q)>0){
			return true;
		}else{
			return false;
		}		

	

	}


	function insert($data){
	
	    /* transaction rollback */
		$this->db->trans_start();
		
		$this->db->insert('monthly_report_monthly_moss', $data);		
		/* id primary yg baru saja di input*/
		$this->id = $this->db->insert_id(); 
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false
	}

	function update($id,$data){

		/* transaction rollback */
		$this->db->trans_start();

		$this->db->where('monthly_report_monthly_moss.id', $id);
		$this->db->update('monthly_report_monthly_moss', $data);
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
	}

	function delete_multiple($data){
		/* transaction rollback */
		$this->db->trans_start();
		
		if(!empty($data)){
			$this->db->where_in('monthly_report_monthly_moss.id',$data);	
	
			$this->db->delete('monthly_report_monthly_moss');
		}
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
		
	}


};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-06-16 00:21:50 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
