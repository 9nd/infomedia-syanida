<?php
require APPPATH . 'controllers/sistem/General_title.php';
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_profiling_config {
	


   function __construct(){
	   /* title */
	    $this->general		= new General_title();
		$this->trans_profiling_id	= 'ID';
		$this->trans_profiling_idx	= 'IDX';
		$this->trans_profiling_ncli	= 'NCLI';
		$this->trans_profiling_nama	= 'NAMA';
		$this->trans_profiling_pstn1	= 'PSTN1';
		$this->trans_profiling_no_speedy	= 'NO_SPEEDY';
		$this->trans_profiling_kepemilikan	= 'KEPEMILIKAN';
		$this->trans_profiling_facebook	= 'FACEBOOK';
		$this->trans_profiling_verfi_fb	= 'VERFI_FB';
		$this->trans_profiling_twitter	= 'TWITTER';
		$this->trans_profiling_verfi_twitter	= 'VERFI_TWITTER';
		$this->trans_profiling_relasi	= 'RELASI';
		$this->trans_profiling_email	= 'EMAIL';
		$this->trans_profiling_verfi_email	= 'VERFI_EMAIL';
		$this->trans_profiling_lup_email	= 'LUP_EMAIL';
		$this->trans_profiling_email_lain	= 'EMAIL_LAIN';
		$this->trans_profiling_handphone	= 'HANDPHONE';
		$this->trans_profiling_verfi_handphone	= 'VERFI_HANDPHONE';
		$this->trans_profiling_lup_handphone	= 'LUP_HANDPHONE';
		$this->trans_profiling_nama_pastel	= 'NAMA_PASTEL';
		$this->trans_profiling_alamat	= 'ALAMAT';
		$this->trans_profiling_kota	= 'KOTA';
		$this->trans_profiling_waktu_psb	= 'WAKTU_PSB';
		$this->trans_profiling_kec_speedy	= 'KEC_SPEEDY';
		$this->trans_profiling_billing	= 'BILLING';
		$this->trans_profiling_payment	= 'PAYMENT';
		$this->trans_profiling_tgl_lahir	= 'TGL_LAHIR';
		$this->trans_profiling_status	= 'STATUS';
		$this->trans_profiling_profiling_by	= 'PROFILING_BY';
		$this->trans_profiling_click_sms	= 'CLICK_SMS';
		$this->trans_profiling_click_email	= 'CLICK_EMAIL';
		$this->trans_profiling_ip_address	= 'IP_ADDRESS';
		$this->trans_profiling_date_created	= 'DATE_CREATED';
		$this->trans_profiling_hub_pemilik	= 'HUB_PEMILIK';
		$this->trans_profiling_veri_distribusi	= 'VERI_DISTRIBUSI';
		$this->trans_profiling_veri_count	= 'VERI_COUNT';
		$this->trans_profiling_veri_status	= 'VERI_STATUS';
		$this->trans_profiling_veri_call	= 'VERI_CALL';
		$this->trans_profiling_veri_keterangan	= 'VERI_KETERANGAN';
		$this->trans_profiling_veri_upd	= 'VERI_UPD';
		$this->trans_profiling_veri_lup	= 'VERI_LUP';
		$this->trans_profiling_lup	= 'LUP';
		$this->trans_profiling_click_session	= 'CLICK_SESSION';
		$this->trans_profiling_division	= 'DIVISION';
		$this->trans_profiling_witel	= 'WITEL';
		$this->trans_profiling_kandatel	= 'KANDATEL';
		$this->trans_profiling_regional	= 'REGIONAL';
		$this->trans_profiling_veri_system	= 'VERI_SYSTEM';
		$this->trans_profiling_nik	= 'NIK';
		$this->trans_profiling_no_kk	= 'NO_KK';
		$this->trans_profiling_nama_ibu_kandung	= 'NAMA_IBU_KANDUNG';
		$this->trans_profiling_path	= 'PATH';
		$this->trans_profiling_instagram	= 'INSTAGRAM';
		$this->trans_profiling_handphone_lain	= 'HANDPHONE_LAIN';
		$this->trans_profiling_opsi_call	= 'OPSI_CALL';
		$this->statuscall_id	= 'STATUSCALL_ID';
		$this->statuscall_id_reason	= 'ID_REASON';
		$this->statuscall_nama_reason	= 'NAMA_REASON';
		$this->sysuser_id	= 'SYSUSER_ID';
		$this->sysuser_nmuser	= 'NMUSER';
		$this->sysuser_passuser	= 'PASSUSER';
		$this->sysuser_opt_level	= 'OPT_LEVEL';
		$this->sysuser_opt_status	= 'OPT_STATUS';
		$this->sysuser_picture	= 'PICTURE';
		$this->sysuser_nama	= 'SYSUSER_NAMA';
		$this->sysuser_agentid	= 'AGENTID';

		
		
		
		/*field_alias_database db*/
		$this->f_id	= 'id';
		$this->f_idx	= 'idx';
		$this->f_ncli	= 'ncli';
		$this->f_nama	= 'nama';
		$this->f_pstn1	= 'pstn1';
		$this->f_no_speedy	= 'no_speedy';
		$this->f_kepemilikan	= 'kepemilikan';
		$this->f_facebook	= 'facebook';
		$this->f_verfi_fb	= 'verfi_fb';
		$this->f_twitter	= 'twitter';
		$this->f_verfi_twitter	= 'verfi_twitter';
		$this->f_relasi	= 'relasi';
		$this->f_email	= 'email';
		$this->f_verfi_email	= 'verfi_email';
		$this->f_lup_email	= 'lup_email';
		$this->f_email_lain	= 'email_lain';
		$this->f_handphone	= 'handphone';
		$this->f_verfi_handphone	= 'verfi_handphone';
		$this->f_lup_handphone	= 'lup_handphone';
		$this->f_nama_pastel	= 'nama_pastel';
		$this->f_alamat	= 'alamat';
		$this->f_kota	= 'kota';
		$this->f_waktu_psb	= 'waktu_psb';
		$this->f_kec_speedy	= 'kec_speedy';
		$this->f_billing	= 'billing';
		$this->f_payment	= 'payment';
		$this->f_tgl_lahir	= 'tgl_lahir';
		$this->f_status	= 'status';
		$this->f_profiling_by	= 'profiling_by';
		$this->f_click_sms	= 'click_sms';
		$this->f_click_email	= 'click_email';
		$this->f_ip_address	= 'ip_address';
		$this->f_date_created	= 'date_created';
		$this->f_hub_pemilik	= 'hub_pemilik';
		$this->f_veri_distribusi	= 'veri_distribusi';
		$this->f_veri_count	= 'veri_count';
		$this->f_veri_status	= 'veri_status';
		$this->f_veri_call	= 'veri_call';
		$this->f_veri_keterangan	= 'veri_keterangan';
		$this->f_veri_upd	= 'veri_upd';
		$this->f_veri_lup	= 'veri_lup';
		$this->f_lup	= 'lup';
		$this->f_click_session	= 'click_session';
		$this->f_division	= 'division';
		$this->f_witel	= 'witel';
		$this->f_kandatel	= 'kandatel';
		$this->f_regional	= 'regional';
		$this->f_veri_system	= 'veri_system';
		$this->f_nik	= 'nik';
		$this->f_no_kk	= 'no_kk';
		$this->f_nama_ibu_kandung	= 'nama_ibu_kandung';
		$this->f_path	= 'path';
		$this->f_instagram	= 'instagram';
		$this->f_handphone_lain	= 'handphone_lain';
		$this->f_opsi_call	= 'opsi_call';
		$this->f_statuscall_id	= 'statuscall_id';
		$this->f_id_reason	= 'id_reason';
		$this->f_nama_reason	= 'nama_reason';
		$this->f_sysuser_id	= 'sysuser_id';
		$this->f_nmuser	= 'nmuser';
		$this->f_passuser	= 'passuser';
		$this->f_opt_level	= 'opt_level';
		$this->f_opt_status	= 'opt_status';
		$this->f_picture	= 'picture';
		$this->f_sysuser_nama	= 'sysuser_nama';
		$this->f_agentid	= 'agentid';

		
		
		
		/* CONFIG FORM LIST */
		/* field_alias_database => $title */	
		$this->table_column =array(
			$this->f_id	=> $this->trans_profiling_id,
			$this->f_idx	=> $this->trans_profiling_idx,
			$this->f_ncli	=> $this->trans_profiling_ncli,
			$this->f_nama	=> $this->trans_profiling_nama,
			$this->f_pstn1	=> $this->trans_profiling_pstn1,
			$this->f_no_speedy	=> $this->trans_profiling_no_speedy,
			$this->f_kepemilikan	=> $this->trans_profiling_kepemilikan,
			$this->f_facebook	=> $this->trans_profiling_facebook,
			$this->f_verfi_fb	=> $this->trans_profiling_verfi_fb,
			$this->f_twitter	=> $this->trans_profiling_twitter,
			$this->f_verfi_twitter	=> $this->trans_profiling_verfi_twitter,
			$this->f_relasi	=> $this->trans_profiling_relasi,
			$this->f_email	=> $this->trans_profiling_email,
			$this->f_verfi_email	=> $this->trans_profiling_verfi_email,
			$this->f_lup_email	=> $this->trans_profiling_lup_email,
			$this->f_email_lain	=> $this->trans_profiling_email_lain,
			$this->f_handphone	=> $this->trans_profiling_handphone,
			$this->f_verfi_handphone	=> $this->trans_profiling_verfi_handphone,
			$this->f_lup_handphone	=> $this->trans_profiling_lup_handphone,
			$this->f_nama_pastel	=> $this->trans_profiling_nama_pastel,
			$this->f_alamat	=> $this->trans_profiling_alamat,
			$this->f_kota	=> $this->trans_profiling_kota,
			$this->f_waktu_psb	=> $this->trans_profiling_waktu_psb,
			$this->f_kec_speedy	=> $this->trans_profiling_kec_speedy,
			$this->f_billing	=> $this->trans_profiling_billing,
			$this->f_payment	=> $this->trans_profiling_payment,
			$this->f_tgl_lahir	=> $this->trans_profiling_tgl_lahir,
			$this->f_status	=> $this->trans_profiling_status,
			$this->f_profiling_by	=> $this->trans_profiling_profiling_by,
			$this->f_click_sms	=> $this->trans_profiling_click_sms,
			$this->f_click_email	=> $this->trans_profiling_click_email,
			$this->f_ip_address	=> $this->trans_profiling_ip_address,
			$this->f_date_created	=> $this->trans_profiling_date_created,
			$this->f_hub_pemilik	=> $this->trans_profiling_hub_pemilik,
			$this->f_veri_distribusi	=> $this->trans_profiling_veri_distribusi,
			$this->f_veri_count	=> $this->trans_profiling_veri_count,
			$this->f_veri_status	=> $this->trans_profiling_veri_status,
			$this->f_veri_call	=> $this->trans_profiling_veri_call,
			$this->f_veri_keterangan	=> $this->trans_profiling_veri_keterangan,
			$this->f_veri_upd	=> $this->trans_profiling_veri_upd,
			$this->f_veri_lup	=> $this->trans_profiling_veri_lup,
			$this->f_lup	=> $this->trans_profiling_lup,
			$this->f_click_session	=> $this->trans_profiling_click_session,
			$this->f_division	=> $this->trans_profiling_division,
			$this->f_witel	=> $this->trans_profiling_witel,
			$this->f_kandatel	=> $this->trans_profiling_kandatel,
			$this->f_regional	=> $this->trans_profiling_regional,
			$this->f_veri_system	=> $this->trans_profiling_veri_system,
			$this->f_nik	=> $this->trans_profiling_nik,
			$this->f_no_kk	=> $this->trans_profiling_no_kk,
			$this->f_nama_ibu_kandung	=> $this->trans_profiling_nama_ibu_kandung,
			$this->f_path	=> $this->trans_profiling_path,
			$this->f_instagram	=> $this->trans_profiling_instagram,
			$this->f_handphone_lain	=> $this->trans_profiling_handphone_lain,
			$this->f_opsi_call	=> $this->trans_profiling_opsi_call,
			$this->f_statuscall_id	=> $this->statuscall_id,
			$this->f_id_reason	=> $this->statuscall_id_reason,
			$this->f_nama_reason	=> $this->statuscall_nama_reason,
			$this->f_sysuser_id	=> $this->sysuser_id,
			$this->f_nmuser	=> $this->sysuser_nmuser,
			$this->f_passuser	=> $this->sysuser_passuser,
			$this->f_opt_level	=> $this->sysuser_opt_level,
			$this->f_opt_status	=> $this->sysuser_opt_status,
			$this->f_picture	=> $this->sysuser_picture,
			$this->f_sysuser_nama	=> $this->sysuser_nama,
			$this->f_agentid	=> $this->sysuser_agentid,
		);

	}

};









/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-01-12 20:31:04 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/

