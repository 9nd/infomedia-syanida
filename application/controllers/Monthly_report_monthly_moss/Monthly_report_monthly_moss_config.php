<?php
require APPPATH . 'controllers/sistem/General_title.php';
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Monthly_report_monthly_moss_config {
	


   function __construct(){
	   /* title */
	    $this->general		= new General_title();
		$this->monthly_report_monthly_moss_id	= 'ID';
		$this->monthly_report_monthly_moss_tahun	= 'TAHUN';
		$this->monthly_report_monthly_moss_bulan	= 'BULAN';
		$this->monthly_report_monthly_moss_last_update	= 'LAST_UPDATE';
		$this->monthly_report_monthly_moss_best_agent	= 'BEST_AGENT';
		$this->monthly_report_monthly_moss_best_teamleader	= 'BEST_TEAMLEADER';
		$this->monthly_report_monthly_moss_verified_best_agent	= 'VERIFIED_BEST_AGENT';
		$this->monthly_report_monthly_moss_verified_best_teamleader	= 'VERIFIED_BEST_TEAMLEADER';
		$this->monthly_report_monthly_moss_best_agent_moss	= 'BEST_AGENT_MOSS';
		$this->monthly_report_monthly_moss_slg_best_agent_moss	= 'SLG_BEST_AGENT_MOSS';
		$this->monthly_report_monthly_moss_best_teamleader_moss	= 'BEST_TEAMLEADER_MOSS';
		$this->monthly_report_monthly_moss_slg_best_teamleader_moss	= 'SLG_BEST_TEAMLEADER_MOSS';
		$this->monthly_report_monthly_moss_verified	= 'VERIFIED';
		$this->monthly_report_monthly_moss_co	= 'CO';
		$this->monthly_report_monthly_moss_contacted	= 'CONTACTED';
		$this->monthly_report_monthly_moss_not_contacted	= 'NOT_CONTACTED';
		$this->monthly_report_monthly_moss_hp_email	= 'HP_EMAIL';
		$this->monthly_report_monthly_moss_hp_only	= 'HP_ONLY';
		$this->monthly_report_monthly_moss_agent_1	= 'AGENT_1';
		$this->monthly_report_monthly_moss_agent_1_num	= 'AGENT_1_NUM';
		$this->monthly_report_monthly_moss_agent_2	= 'AGENT_2';
		$this->monthly_report_monthly_moss_agent_2_num	= 'AGENT_2_NUM';
		$this->monthly_report_monthly_moss_agent_3	= 'AGENT_3';
		$this->monthly_report_monthly_moss_agent_3_num	= 'AGENT_3_NUM';
		$this->monthly_report_monthly_moss_agent_4	= 'AGENT_4';
		$this->monthly_report_monthly_moss_agent_4_num	= 'AGENT_4_NUM';
		$this->monthly_report_monthly_moss_agent_5	= 'AGENT_5';
		$this->monthly_report_monthly_moss_agent_5_num	= 'AGENT_5_NUM';
		$this->monthly_report_monthly_moss_agent_6	= 'AGENT_6';
		$this->monthly_report_monthly_moss_agent_6_num	= 'AGENT_6_NUM';
		$this->monthly_report_monthly_moss_agent_online	= 'AGENT_ONLINE';
		$this->monthly_report_monthly_moss_slg	= 'SLG';
		$this->monthly_report_monthly_moss_slfc	= 'SLFC';

		
		
		
		/*field_alias_database db*/
		$this->f_id	= 'id';
		$this->f_tahun	= 'tahun';
		$this->f_bulan	= 'bulan';
		$this->f_last_update	= 'last_update';
		$this->f_best_agent	= 'best_agent';
		$this->f_best_teamleader	= 'best_teamleader';
		$this->f_verified_best_agent	= 'verified_best_agent';
		$this->f_verified_best_teamleader	= 'verified_best_teamleader';
		$this->f_best_agent_moss	= 'best_agent_moss';
		$this->f_slg_best_agent_moss	= 'slg_best_agent_moss';
		$this->f_best_teamleader_moss	= 'best_teamleader_moss';
		$this->f_slg_best_teamleader_moss	= 'slg_best_teamleader_moss';
		$this->f_verified	= 'verified';
		$this->f_co	= 'co';
		$this->f_contacted	= 'contacted';
		$this->f_not_contacted	= 'not_contacted';
		$this->f_hp_email	= 'hp_email';
		$this->f_hp_only	= 'hp_only';
		$this->f_agent_1	= 'agent_1';
		$this->f_agent_1_num	= 'agent_1_num';
		$this->f_agent_2	= 'agent_2';
		$this->f_agent_2_num	= 'agent_2_num';
		$this->f_agent_3	= 'agent_3';
		$this->f_agent_3_num	= 'agent_3_num';
		$this->f_agent_4	= 'agent_4';
		$this->f_agent_4_num	= 'agent_4_num';
		$this->f_agent_5	= 'agent_5';
		$this->f_agent_5_num	= 'agent_5_num';
		$this->f_agent_6	= 'agent_6';
		$this->f_agent_6_num	= 'agent_6_num';
		$this->f_agent_online	= 'agent_online';
		$this->f_slg	= 'slg';
		$this->f_slfc	= 'slfc';

		
		
		
		/* CONFIG FORM LIST */
		/* field_alias_database => $title */	
		$this->table_column =array(
			$this->f_id	=> $this->monthly_report_monthly_moss_id,
			$this->f_tahun	=> $this->monthly_report_monthly_moss_tahun,
			$this->f_bulan	=> $this->monthly_report_monthly_moss_bulan,
			$this->f_last_update	=> $this->monthly_report_monthly_moss_last_update,
			$this->f_best_agent	=> $this->monthly_report_monthly_moss_best_agent,
			$this->f_best_teamleader	=> $this->monthly_report_monthly_moss_best_teamleader,
			$this->f_verified_best_agent	=> $this->monthly_report_monthly_moss_verified_best_agent,
			$this->f_verified_best_teamleader	=> $this->monthly_report_monthly_moss_verified_best_teamleader,
			$this->f_best_agent_moss	=> $this->monthly_report_monthly_moss_best_agent_moss,
			$this->f_slg_best_agent_moss	=> $this->monthly_report_monthly_moss_slg_best_agent_moss,
			$this->f_best_teamleader_moss	=> $this->monthly_report_monthly_moss_best_teamleader_moss,
			$this->f_slg_best_teamleader_moss	=> $this->monthly_report_monthly_moss_slg_best_teamleader_moss,
			$this->f_verified	=> $this->monthly_report_monthly_moss_verified,
			$this->f_co	=> $this->monthly_report_monthly_moss_co,
			$this->f_contacted	=> $this->monthly_report_monthly_moss_contacted,
			$this->f_not_contacted	=> $this->monthly_report_monthly_moss_not_contacted,
			$this->f_hp_email	=> $this->monthly_report_monthly_moss_hp_email,
			$this->f_hp_only	=> $this->monthly_report_monthly_moss_hp_only,
			$this->f_agent_1	=> $this->monthly_report_monthly_moss_agent_1,
			$this->f_agent_1_num	=> $this->monthly_report_monthly_moss_agent_1_num,
			$this->f_agent_2	=> $this->monthly_report_monthly_moss_agent_2,
			$this->f_agent_2_num	=> $this->monthly_report_monthly_moss_agent_2_num,
			$this->f_agent_3	=> $this->monthly_report_monthly_moss_agent_3,
			$this->f_agent_3_num	=> $this->monthly_report_monthly_moss_agent_3_num,
			$this->f_agent_4	=> $this->monthly_report_monthly_moss_agent_4,
			$this->f_agent_4_num	=> $this->monthly_report_monthly_moss_agent_4_num,
			$this->f_agent_5	=> $this->monthly_report_monthly_moss_agent_5,
			$this->f_agent_5_num	=> $this->monthly_report_monthly_moss_agent_5_num,
			$this->f_agent_6	=> $this->monthly_report_monthly_moss_agent_6,
			$this->f_agent_6_num	=> $this->monthly_report_monthly_moss_agent_6_num,
			$this->f_agent_online	=> $this->monthly_report_monthly_moss_agent_online,
			$this->f_slg	=> $this->monthly_report_monthly_moss_slg,
			$this->f_slfc	=> $this->monthly_report_monthly_moss_slfc,
		);

	}

};









/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-06-16 00:21:50 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/

