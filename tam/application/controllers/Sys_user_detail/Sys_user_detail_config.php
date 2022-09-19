<?php
require APPPATH . 'controllers/sistem/General_title.php';
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sys_user_detail_config {
	


   function __construct(){
	   /* title */
	    $this->general		= new General_title();
		$this->sys_user_detail_id	= 'ID';
		$this->sys_user_detail_agentid	= 'AGENTID';
		$this->sys_user_detail_alamat	= 'ALAMAT';
		$this->sys_user_detail_tempat_lahir	= 'TEMPAT_LAHIR';
		$this->sys_user_detail_tanggal_lahir	= 'TANGGAL_LAHIR';
		$this->sys_user_detail_tanggal_gabung	= 'TANGGAL_GABUNG';
		$this->sys_user_detail_jenis_kelamin	= 'JENIS_KELAMIN';
		$this->sys_user_detail_email	= 'EMAIL';
		$this->sys_user_detail_status_perkawinan	= 'STATUS_PERKAWINAN';
		$this->sys_user_detail_kelurahan	= 'KELURAHAN';
		$this->sys_user_detail_kecamatan	= 'KECAMATAN';
		$this->sys_user_detail_kabupaten_kota	= 'KABUPATEN_KOTA';
		$this->sys_user_detail_provinsi	= 'PROVINSI';
		$this->sys_user_detail_no_hp	= 'NO_HP';
		$this->sys_user_detail_no_hp_lain	= 'NO_HP_LAIN';
		$this->sys_user_detail_no_ktp	= 'NO_KTP';
		$this->sys_user_detail_pendidikan	= 'PENDIDIKAN';
		$this->sys_user_detail_jurusan	= 'JURUSAN';
		$this->sys_user_detail_sekolah	= 'SEKOLAH';
		$this->sys_user_detail_tahun_lulus	= 'TAHUN_LULUS';
		$this->sys_user_detail_no_rekening	= 'NO_REKENING';
		$this->sys_user_detail_nama_bank	= 'NAMA_BANK';
		$this->sys_user_detail_npwp	= 'NPWP';
		$this->sysuser_id	= 'SYSUSER_ID';
		$this->sysuser_nmuser	= 'NMUSER';
		$this->sysuser_passuser	= 'PASSUSER';
		$this->sysuser_opt_level	= 'OPT_LEVEL';
		$this->sysuser_opt_status	= 'OPT_STATUS';
		$this->sysuser_picture	= 'PICTURE';
		$this->sysuser_nama	= 'NAMA';
		$this->sysuser_agentid	= 'SYSUSER_AGENTID';
		$this->sysuser_kategori	= 'KATEGORI';
		$this->sysuser_tl	= 'TL';
		$this->jeniskelamin_id	= 'JENISKELAMIN_ID';
		$this->jeniskelamin_jenis_kelamin	= 'JENISKELAMIN_JENIS_KELAMIN';
		$this->statusperkawinan_id	= 'STATUSPERKAWINAN_ID';
		$this->statusperkawinan_status_perkawinan	= 'STATUSPERKAWINAN_STATUS_PERKAWINAN';

		
		
		
		/*field_alias_database db*/
		$this->f_id	= 'id';
		$this->f_agentid	= 'agentid';
		$this->f_alamat	= 'alamat';
		$this->f_tempat_lahir	= 'tempat_lahir';
		$this->f_tanggal_lahir	= 'tanggal_lahir';
		$this->f_tanggal_gabung	= 'tanggal_gabung';
		$this->f_jenis_kelamin	= 'jenis_kelamin';
		$this->f_email	= 'email';
		$this->f_status_perkawinan	= 'status_perkawinan';
		$this->f_kelurahan	= 'kelurahan';
		$this->f_kecamatan	= 'kecamatan';
		$this->f_kabupaten_kota	= 'kabupaten_kota';
		$this->f_provinsi	= 'provinsi';
		$this->f_no_hp	= 'no_hp';
		$this->f_no_hp_lain	= 'no_hp_lain';
		$this->f_no_ktp	= 'no_ktp';
		$this->f_pendidikan	= 'pendidikan';
		$this->f_jurusan	= 'jurusan';
		$this->f_sekolah	= 'sekolah';
		$this->f_tahun_lulus	= 'tahun_lulus';
		$this->f_no_rekening	= 'no_rekening';
		$this->f_nama_bank	= 'nama_bank';
		$this->f_npwp	= 'npwp';
		$this->f_sysuser_id	= 'sysuser_id';
		$this->f_nmuser	= 'nmuser';
		$this->f_passuser	= 'passuser';
		$this->f_opt_level	= 'opt_level';
		$this->f_opt_status	= 'opt_status';
		$this->f_picture	= 'picture';
		$this->f_nama	= 'nama';
		$this->f_sysuser_agentid	= 'sysuser_agentid';
		$this->f_kategori	= 'kategori';
		$this->f_tl	= 'tl';
		$this->f_jeniskelamin_id	= 'jeniskelamin_id';
		$this->f_jeniskelamin_jenis_kelamin	= 'jeniskelamin_jenis_kelamin';
		$this->f_statusperkawinan_id	= 'statusperkawinan_id';
		$this->f_statusperkawinan_status_perkawinan	= 'statusperkawinan_status_perkawinan';

		
		
		
		/* CONFIG FORM LIST */
		/* field_alias_database => $title */	
		$this->table_column =array(
			$this->f_id	=> $this->sys_user_detail_id,
			$this->f_agentid	=> $this->sys_user_detail_agentid,
			$this->f_alamat	=> $this->sys_user_detail_alamat,
			$this->f_tempat_lahir	=> $this->sys_user_detail_tempat_lahir,
			$this->f_tanggal_lahir	=> $this->sys_user_detail_tanggal_lahir,
			$this->f_tanggal_gabung	=> $this->sys_user_detail_tanggal_gabung,
			$this->f_jenis_kelamin	=> $this->sys_user_detail_jenis_kelamin,
			$this->f_email	=> $this->sys_user_detail_email,
			$this->f_status_perkawinan	=> $this->sys_user_detail_status_perkawinan,
			$this->f_kelurahan	=> $this->sys_user_detail_kelurahan,
			$this->f_kecamatan	=> $this->sys_user_detail_kecamatan,
			$this->f_kabupaten_kota	=> $this->sys_user_detail_kabupaten_kota,
			$this->f_provinsi	=> $this->sys_user_detail_provinsi,
			$this->f_no_hp	=> $this->sys_user_detail_no_hp,
			$this->f_no_hp_lain	=> $this->sys_user_detail_no_hp_lain,
			$this->f_no_ktp	=> $this->sys_user_detail_no_ktp,
			$this->f_pendidikan	=> $this->sys_user_detail_pendidikan,
			$this->f_jurusan	=> $this->sys_user_detail_jurusan,
			$this->f_sekolah	=> $this->sys_user_detail_sekolah,
			$this->f_tahun_lulus	=> $this->sys_user_detail_tahun_lulus,
			$this->f_no_rekening	=> $this->sys_user_detail_no_rekening,
			$this->f_nama_bank	=> $this->sys_user_detail_nama_bank,
			$this->f_npwp	=> $this->sys_user_detail_npwp,
			$this->f_sysuser_id	=> $this->sysuser_id,
			$this->f_nmuser	=> $this->sysuser_nmuser,
			$this->f_passuser	=> $this->sysuser_passuser,
			$this->f_opt_level	=> $this->sysuser_opt_level,
			$this->f_opt_status	=> $this->sysuser_opt_status,
			$this->f_picture	=> $this->sysuser_picture,
			$this->f_nama	=> $this->sysuser_nama,
			$this->f_sysuser_agentid	=> $this->sysuser_agentid,
			$this->f_kategori	=> $this->sysuser_kategori,
			$this->f_tl	=> $this->sysuser_tl,
			$this->f_jeniskelamin_id	=> $this->jeniskelamin_id,
			$this->f_jeniskelamin_jenis_kelamin	=> $this->jeniskelamin_jenis_kelamin,
			$this->f_statusperkawinan_id	=> $this->statusperkawinan_id,
			$this->f_statusperkawinan_status_perkawinan	=> $this->statusperkawinan_status_perkawinan,
		);

	}

};









/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-02-07 09:33:58 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/

