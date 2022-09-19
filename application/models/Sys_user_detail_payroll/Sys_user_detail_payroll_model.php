<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sys_user_detail_payroll_model extends CI_Model {
   public $id;	
   function __construct(){
        parent::__construct();
   }	
	
	public function json(){
		$this->datatables->select('
			sys_user_detail_payroll.id as id,
			sys_user_detail_payroll.agentid as agentid,
			sys_user_detail_payroll.bulan as bulan,
			sys_user_detail_payroll.hk as hk,
			sys_user_detail_payroll.kehadiran as kehadiran,
			sys_user_detail_payroll.contacted as contacted,
			sys_user_detail_payroll.verified as verified,
			sys_user_detail_payroll.reward as reward,
			sys_user_detail_payroll.pendidikan as pendidikan,
			sys_user_detail_payroll.foreign as foreign,
			sys_user_detail_payroll.score as score,
			sys_user_detail_payroll.level as level,
			sys_user_detail_payroll.akomodasi as akomodasi,
			sys_user_detail_payroll.tunj_transport as tunj_transport,
			sys_user_detail_payroll.komisi as komisi,
			sys_user_detail_payroll.tunj_level as tunj_level,
			sys_user_detail_payroll.tunj_jabatan as tunj_jabatan,
			sys_user_detail_payroll.thp_leveling as thp_leveling,
			sys_user_detail_payroll.ot_moss as ot_moss,
			sys_user_detail_payroll.other_fee as other_fee,
			sys_user_detail_payroll.tunjangan_skill as tunjangan_skill,
			sys_user_detail_payroll.lebih_hpemail as lebih_hpemail,
			sys_user_detail_payroll.lebih_emailonly as lebih_emailonly,
			sys_user_detail_payroll.lebih_rp as lebih_rp,
			sys_user_detail_payroll.tot_thp as tot_thp,
		');
		
		$this->datatables->from('sys_user_detail_payroll');

		
		
		//mengembalikan dalam bentuk array
		$q =  json_decode($this->datatables->generate(),true);
		return $q;
	}
	

   public function get_all(){
		$afield = array(
			'sys_user_detail_payroll.id as id',
			'sys_user_detail_payroll.agentid as agentid',
			'sys_user_detail_payroll.bulan as bulan',
			'sys_user_detail_payroll.hk as hk',
			'sys_user_detail_payroll.kehadiran as kehadiran',
			'sys_user_detail_payroll.contacted as contacted',
			'sys_user_detail_payroll.verified as verified',
			'sys_user_detail_payroll.reward as reward',
			'sys_user_detail_payroll.pendidikan as pendidikan',
			'sys_user_detail_payroll.foreign as foreign',
			'sys_user_detail_payroll.score as score',
			'sys_user_detail_payroll.level as level',
			'sys_user_detail_payroll.akomodasi as akomodasi',
			'sys_user_detail_payroll.tunj_transport as tunj_transport',
			'sys_user_detail_payroll.komisi as komisi',
			'sys_user_detail_payroll.tunj_level as tunj_level',
			'sys_user_detail_payroll.tunj_jabatan as tunj_jabatan',
			'sys_user_detail_payroll.thp_leveling as thp_leveling',
			'sys_user_detail_payroll.ot_moss as ot_moss',
			'sys_user_detail_payroll.other_fee as other_fee',
			'sys_user_detail_payroll.tunjangan_skill as tunjangan_skill',
			'sys_user_detail_payroll.lebih_hpemail as lebih_hpemail',
			'sys_user_detail_payroll.lebih_emailonly as lebih_emailonly',
			'sys_user_detail_payroll.lebih_rp as lebih_rp',
			'sys_user_detail_payroll.tot_thp as tot_thp',
		
		);
		$this->db->select($afield);

		$this->db->order_by('sys_user_detail_payroll.id', 'ASC');
		return $this->db->get('sys_user_detail_payroll')->result_array();
   }


	public function get_by_id($id){
		$afield = array(
			'sys_user_detail_payroll.id as id',
			'sys_user_detail_payroll.agentid as agentid',
			'sys_user_detail_payroll.bulan as bulan',
			'sys_user_detail_payroll.hk as hk',
			'sys_user_detail_payroll.kehadiran as kehadiran',
			'sys_user_detail_payroll.contacted as contacted',
			'sys_user_detail_payroll.verified as verified',
			'sys_user_detail_payroll.reward as reward',
			'sys_user_detail_payroll.pendidikan as pendidikan',
			'sys_user_detail_payroll.foreign as foreign',
			'sys_user_detail_payroll.score as score',
			'sys_user_detail_payroll.level as level',
			'sys_user_detail_payroll.akomodasi as akomodasi',
			'sys_user_detail_payroll.tunj_transport as tunj_transport',
			'sys_user_detail_payroll.komisi as komisi',
			'sys_user_detail_payroll.tunj_level as tunj_level',
			'sys_user_detail_payroll.tunj_jabatan as tunj_jabatan',
			'sys_user_detail_payroll.thp_leveling as thp_leveling',
			'sys_user_detail_payroll.ot_moss as ot_moss',
			'sys_user_detail_payroll.other_fee as other_fee',
			'sys_user_detail_payroll.tunjangan_skill as tunjangan_skill',
			'sys_user_detail_payroll.lebih_hpemail as lebih_hpemail',
			'sys_user_detail_payroll.lebih_emailonly as lebih_emailonly',
			'sys_user_detail_payroll.lebih_rp as lebih_rp',
			'sys_user_detail_payroll.tot_thp as tot_thp',
		
		);
		$this->db->select($afield);

		$this->db->where('sys_user_detail_payroll.id', $id);
		$this->db->order_by('sys_user_detail_payroll.id', 'ASC');
		return $this->db->get('sys_user_detail_payroll')->row();
   }


	/* Memastikan data yg dibuat tidak kembar/sama,
	   fungsi ini sebagai pengganti fungsi primary key dr db,
	   krn primary key sudah di gunakan untuk column id.
	   -create : id di kosongkan.
	   -update : id di isi dengan id data yg di proses.	
	*/	
	function if_exist($id,$data){
		$this->db->where('sys_user_detail_payroll.id <>',$id);

		$q = $this->db->get_where('sys_user_detail_payroll', $data)->result_array();
		
		if(count($q)>0){
			return true;
		}else{
			return false;
		}		

	

	}


	function insert($data){
	
	    /* transaction rollback */
		$this->db->trans_start();
		
		$this->db->insert('sys_user_detail_payroll', $data);		
		/* id primary yg baru saja di input*/
		$this->id = $this->db->insert_id(); 
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false
	}

	function update($id,$data){

		/* transaction rollback */
		$this->db->trans_start();

		$this->db->where('sys_user_detail_payroll.id', $id);
		$this->db->update('sys_user_detail_payroll', $data);
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
	}

	function delete_multiple($data){
		/* transaction rollback */
		$this->db->trans_start();
		
		if(!empty($data)){
			$this->db->where_in('sys_user_detail_payroll.id',$data);	
	
			$this->db->delete('sys_user_detail_payroll');
		}
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
		
	}


};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2021-01-06 13:01:24 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
