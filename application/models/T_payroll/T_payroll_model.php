<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_payroll_model extends CI_Model {
   public $id;	
   function __construct(){
        parent::__construct();
   }	
	
	public function json(){
		$this->datatables->select('
			t_payroll.id as id,
			t_payroll.agentid as agentid,
			t_payroll.kehadiran as kehadiran,
			t_payroll.contacted as contacted,
			t_payroll.verified as verified,
			t_payroll.tenur as tenur,
			t_payroll.pendidikan as pendidikan,
			t_payroll.score as score,
			t_payroll.level as level,
			t_payroll.akomodasi as akomodasi,
			t_payroll.t_trasnport as t_trasnport,
			t_payroll.komisi as komisi,
			t_payroll.tunj_level as tunj_level,
			t_payroll.tunj_jabatan as tunj_jabatan,
			t_payroll.thp_leveling as thp_leveling,
			t_payroll.ot_moss as ot_moss,
			t_payroll.other_fee as other_fee,
			t_payroll.tunj_skill as tunj_skill,
			t_payroll.perbantuan_hpemail as perbantuan_hpemail,
			t_payroll.perbantuan_hponly as perbantuan_hponly,
			t_payroll.nominal_perbantuan as nominal_perbantuan,
			t_payroll.total_thp as total_thp,
			t_payroll.non_thp as non_thp,
			t_payroll.benefit_lain as benefit_lain,
			t_payroll.m_fee as m_fee,
			t_payroll.headcount as headcount,
		');
		
		$this->datatables->from('t_payroll');

		
		
		//mengembalikan dalam bentuk array
		$q =  json_decode($this->datatables->generate(),true);
		return $q;
	}
	

   public function get_all(){
		$afield = array(
			't_payroll.id as id',
			't_payroll.agentid as agentid',
			't_payroll.kehadiran as kehadiran',
			't_payroll.contacted as contacted',
			't_payroll.verified as verified',
			't_payroll.tenur as tenur',
			't_payroll.pendidikan as pendidikan',
			't_payroll.score as score',
			't_payroll.level as level',
			't_payroll.akomodasi as akomodasi',
			't_payroll.t_trasnport as t_trasnport',
			't_payroll.komisi as komisi',
			't_payroll.tunj_level as tunj_level',
			't_payroll.tunj_jabatan as tunj_jabatan',
			't_payroll.thp_leveling as thp_leveling',
			't_payroll.ot_moss as ot_moss',
			't_payroll.other_fee as other_fee',
			't_payroll.tunj_skill as tunj_skill',
			't_payroll.perbantuan_hpemail as perbantuan_hpemail',
			't_payroll.perbantuan_hponly as perbantuan_hponly',
			't_payroll.nominal_perbantuan as nominal_perbantuan',
			't_payroll.total_thp as total_thp',
			't_payroll.non_thp as non_thp',
			't_payroll.benefit_lain as benefit_lain',
			't_payroll.m_fee as m_fee',
			't_payroll.headcount as headcount',
		
		);
		$this->db->select($afield);

		$this->db->order_by('t_payroll.id', 'ASC');
		return $this->db->get('t_payroll')->result_array();
   }


	public function get_by_id($id){
		$afield = array(
			't_payroll.id as id',
			't_payroll.agentid as agentid',
			't_payroll.kehadiran as kehadiran',
			't_payroll.contacted as contacted',
			't_payroll.verified as verified',
			't_payroll.tenur as tenur',
			't_payroll.pendidikan as pendidikan',
			't_payroll.score as score',
			't_payroll.level as level',
			't_payroll.akomodasi as akomodasi',
			't_payroll.t_trasnport as t_trasnport',
			't_payroll.komisi as komisi',
			't_payroll.tunj_level as tunj_level',
			't_payroll.tunj_jabatan as tunj_jabatan',
			't_payroll.thp_leveling as thp_leveling',
			't_payroll.ot_moss as ot_moss',
			't_payroll.other_fee as other_fee',
			't_payroll.tunj_skill as tunj_skill',
			't_payroll.perbantuan_hpemail as perbantuan_hpemail',
			't_payroll.perbantuan_hponly as perbantuan_hponly',
			't_payroll.nominal_perbantuan as nominal_perbantuan',
			't_payroll.total_thp as total_thp',
			't_payroll.non_thp as non_thp',
			't_payroll.benefit_lain as benefit_lain',
			't_payroll.m_fee as m_fee',
			't_payroll.headcount as headcount',
		
		);
		$this->db->select($afield);

		$this->db->where('t_payroll.id', $id);
		$this->db->order_by('t_payroll.id', 'ASC');
		return $this->db->get('t_payroll')->row();
   }


	/* Memastikan data yg dibuat tidak kembar/sama,
	   fungsi ini sebagai pengganti fungsi primary key dr db,
	   krn primary key sudah di gunakan untuk column id.
	   -create : id di kosongkan.
	   -update : id di isi dengan id data yg di proses.	
	*/	
	function if_exist($id,$data){
		$this->db->where('t_payroll.id <>',$id);

		$q = $this->db->get_where('t_payroll', $data)->result_array();
		
		if(count($q)>0){
			return true;
		}else{
			return false;
		}		

	

	}


	function insert($data){
	
	    /* transaction rollback */
		$this->db->trans_start();
		
		$this->db->insert('t_payroll', $data);		
		/* id primary yg baru saja di input*/
		$this->id = $this->db->insert_id(); 
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false
	}

	function update($id,$data){

		/* transaction rollback */
		$this->db->trans_start();

		$this->db->where('t_payroll.id', $id);
		$this->db->update('t_payroll', $data);
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
	}

	function delete_multiple($data){
		/* transaction rollback */
		$this->db->trans_start();
		
		if(!empty($data)){
			$this->db->where_in('t_payroll.id',$data);	
	
			$this->db->delete('t_payroll');
		}
		
		$this->db->trans_complete();
		return $this->db->trans_status(); //return true or false	
		
	}


};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2021-02-02 09:55:54 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
