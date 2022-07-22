<?php
require APPPATH . 'controllers/sistem/General_title.php';
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_profiling_validasi_mos_config {
	


   function __construct(){
	   /* title */
	    $this->general		= new General_title();
		$this->trans_profiling_validasi_mos_idx	= 'IDX';
		$this->trans_profiling_validasi_mos_ncli	= 'NCLI';
		$this->trans_profiling_validasi_mos_no_pstn	= 'NO_PSTN';
		$this->trans_profiling_validasi_mos_no_speedy	= 'NO_SPEEDY';
		$this->trans_profiling_validasi_mos_nama_pelanggan	= 'NAMA_PELANGGAN';
		$this->trans_profiling_validasi_mos_relasi	= 'RELASI';
		$this->trans_profiling_validasi_mos_no_handpone	= 'NO_HANDPONE';
		$this->trans_profiling_validasi_mos_verfi_handphone	= 'VERFI_HANDPHONE';
		$this->trans_profiling_validasi_mos_email	= 'EMAIL';
		$this->trans_profiling_validasi_mos_verfi_email	= 'VERFI_EMAIL';
		$this->trans_profiling_validasi_mos_facebook	= 'FACEBOOK';
		$this->trans_profiling_validasi_mos_twitter	= 'TWITTER';
		$this->trans_profiling_validasi_mos_nama_pastel	= 'NAMA_PASTEL';
		$this->trans_profiling_validasi_mos_alamat	= 'ALAMAT';
		$this->trans_profiling_validasi_mos_kota	= 'KOTA';
		$this->trans_profiling_validasi_mos_regional	= 'REGIONAL';
		$this->trans_profiling_validasi_mos_update_by	= 'UPDATE_BY';
		$this->trans_profiling_validasi_mos_lup	= 'LUP';
		$this->trans_profiling_validasi_mos_sumber	= 'SUMBER';
		$this->trans_profiling_validasi_mos_tgl_insert	= 'TGL_INSERT';
		$this->trans_profiling_validasi_mos_is_3p	= 'IS_3P';
		$this->trans_profiling_validasi_mos_layanan	= 'LAYANAN';
		$this->trans_profiling_validasi_mos_reason_call	= 'REASON_CALL';
		$this->trans_profiling_validasi_mos_status	= 'STATUS';
		$this->trans_profiling_validasi_mos_keterangan	= 'KETERANGAN';
		$this->trans_profiling_validasi_mos_tgl_bayar	= 'TGL_BAYAR';
		$this->trans_profiling_validasi_mos_waktu_bayar	= 'WAKTU_BAYAR';
		$this->trans_profiling_validasi_mos_kecepatan	= 'KECEPATAN';
		$this->trans_profiling_validasi_mos_tagihan	= 'TAGIHAN';
		$this->trans_profiling_validasi_mos_click_time	= 'CLICK_TIME';

		
		
		
		/*field_alias_database db*/
		$this->f_idx	= 'idx';
		$this->f_ncli	= 'ncli';
		$this->f_no_pstn	= 'no_pstn';
		$this->f_no_speedy	= 'no_speedy';
		$this->f_nama_pelanggan	= 'nama_pelanggan';
		$this->f_relasi	= 'relasi';
		$this->f_no_handpone	= 'no_handpone';
		$this->f_verfi_handphone	= 'verfi_handphone';
		$this->f_email	= 'email';
		$this->f_verfi_email	= 'verfi_email';
		$this->f_facebook	= 'facebook';
		$this->f_twitter	= 'twitter';
		$this->f_nama_pastel	= 'nama_pastel';
		$this->f_alamat	= 'alamat';
		$this->f_kota	= 'kota';
		$this->f_regional	= 'regional';
		$this->f_update_by	= 'update_by';
		$this->f_lup	= 'lup';
		$this->f_sumber	= 'sumber';
		$this->f_tgl_insert	= 'tgl_insert';
		$this->f_is_3p	= 'is_3p';
		$this->f_layanan	= 'layanan';
		$this->f_reason_call	= 'reason_call';
		$this->f_status	= 'status';
		$this->f_keterangan	= 'keterangan';
		$this->f_tgl_bayar	= 'tgl_bayar';
		$this->f_waktu_bayar	= 'waktu_bayar';
		$this->f_kecepatan	= 'kecepatan';
		$this->f_tagihan	= 'tagihan';
		$this->f_click_time	= 'click_time';

		
		
		
		/* CONFIG FORM LIST */
		/* field_alias_database => $title */	
		$this->table_column =array(
			$this->f_idx	=> $this->trans_profiling_validasi_mos_idx,
			$this->f_ncli	=> $this->trans_profiling_validasi_mos_ncli,
			$this->f_no_pstn	=> $this->trans_profiling_validasi_mos_no_pstn,
			$this->f_no_speedy	=> $this->trans_profiling_validasi_mos_no_speedy,
			$this->f_nama_pelanggan	=> $this->trans_profiling_validasi_mos_nama_pelanggan,
			$this->f_relasi	=> $this->trans_profiling_validasi_mos_relasi,
			$this->f_no_handpone	=> $this->trans_profiling_validasi_mos_no_handpone,
			$this->f_verfi_handphone	=> $this->trans_profiling_validasi_mos_verfi_handphone,
			$this->f_email	=> $this->trans_profiling_validasi_mos_email,
			$this->f_verfi_email	=> $this->trans_profiling_validasi_mos_verfi_email,
			$this->f_facebook	=> $this->trans_profiling_validasi_mos_facebook,
			$this->f_twitter	=> $this->trans_profiling_validasi_mos_twitter,
			$this->f_nama_pastel	=> $this->trans_profiling_validasi_mos_nama_pastel,
			$this->f_alamat	=> $this->trans_profiling_validasi_mos_alamat,
			$this->f_kota	=> $this->trans_profiling_validasi_mos_kota,
			$this->f_regional	=> $this->trans_profiling_validasi_mos_regional,
			$this->f_update_by	=> $this->trans_profiling_validasi_mos_update_by,
			$this->f_lup	=> $this->trans_profiling_validasi_mos_lup,
			$this->f_sumber	=> $this->trans_profiling_validasi_mos_sumber,
			$this->f_tgl_insert	=> $this->trans_profiling_validasi_mos_tgl_insert,
			$this->f_is_3p	=> $this->trans_profiling_validasi_mos_is_3p,
			$this->f_layanan	=> $this->trans_profiling_validasi_mos_layanan,
			$this->f_reason_call	=> $this->trans_profiling_validasi_mos_reason_call,
			$this->f_status	=> $this->trans_profiling_validasi_mos_status,
			$this->f_keterangan	=> $this->trans_profiling_validasi_mos_keterangan,
			$this->f_tgl_bayar	=> $this->trans_profiling_validasi_mos_tgl_bayar,
			$this->f_waktu_bayar	=> $this->trans_profiling_validasi_mos_waktu_bayar,
			$this->f_kecepatan	=> $this->trans_profiling_validasi_mos_kecepatan,
			$this->f_tagihan	=> $this->trans_profiling_validasi_mos_tagihan,
			$this->f_click_time	=> $this->trans_profiling_validasi_mos_click_time,
		);

	}

};









/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-05-04 22:46:06 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/

