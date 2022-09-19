<?php
require APPPATH . 'controllers/sistem/General_title.php';
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dbprofile_verified_config {
	


   function __construct(){
	   /* title */
	    $this->general		= new General_title();
		$this->dbprofile_verified_NCLI	= 'NCLI';
		$this->dbprofile_verified_NO_PSTN	= 'NO_PSTN';
		$this->dbprofile_verified_NO_SPEEDY	= 'NO_SPEEDY';
		$this->dbprofile_verified_NAMA_PELANGGAN	= 'NAMA_PELANGGAN';
		$this->dbprofile_verified_RELASI	= 'RELASI';
		$this->dbprofile_verified_NO_HP	= 'NO_HP';
		$this->dbprofile_verified_STATUS_HP	= 'STATUS_HP';
		$this->dbprofile_verified_EMAIL	= 'EMAIL';
		$this->dbprofile_verified_STATUS_EMAIL	= 'STATUS_EMAIL';
		$this->dbprofile_verified_NAMA_PEMILIK	= 'NAMA_PEMILIK';
		$this->dbprofile_verified_ALAMAT	= 'ALAMAT';
		$this->dbprofile_verified_KOTA	= 'KOTA';
		$this->dbprofile_verified_REGIONAL	= 'REGIONAL';
		$this->dbprofile_verified_UPDATE_BY	= 'UPDATE_BY';
		$this->dbprofile_verified_TGL_VERIFIKASI	= 'TGL_VERIFIKASI';
		$this->dbprofile_verified_IS_LAST	= 'IS_LAST';
		$this->dbprofile_verified_SUMBER	= 'SUMBER';
		$this->dbprofile_verified_TGL_UPDATE	= 'TGL_UPDATE';
		$this->dbprofile_verified_DATRS	= 'DATRS';
		$this->dbprofile_verified_ALAMAT_KORESPONDENSI	= 'ALAMAT_KORESPONDENSI';
		$this->dbprofile_verified_FACEBOOK_ID	= 'FACEBOOK_ID';
		$this->dbprofile_verified_FACEBOOK	= 'FACEBOOK';
		$this->dbprofile_verified_TWITTER_ID	= 'TWITTER_ID';
		$this->dbprofile_verified_TWITTER	= 'TWITTER';
		$this->dbprofile_verified_TWITTER_FOLLOWER	= 'TWITTER_FOLLOWER';
		$this->dbprofile_verified_TWITTER_STATUS	= 'TWITTER_STATUS';
		$this->dbprofile_verified_NIK	= 'NIK';
		$this->dbprofile_verified_PATH_	= 'PATH_';
		$this->dbprofile_verified_INSTAGRAM	= 'INSTAGRAM';
		$this->dbprofile_verified_NAMA_LGKP	= 'NAMA_LGKP';
		$this->dbprofile_verified_AGAMA	= 'AGAMA';
		$this->dbprofile_verified_TGL_LHR	= 'TGL_LHR';
		$this->dbprofile_verified_TMPT_LHR	= 'TMPT_LHR';
		$this->dbprofile_verified_JENIS_KLMIN	= 'JENIS_KLMIN';
		$this->dbprofile_verified_JENIS_PKRJN	= 'JENIS_PKRJN';
		$this->dbprofile_verified_IS_INDIHOME	= 'IS_INDIHOME';
		$this->dbprofile_verified_NO_HP_1	= 'NO_HP_1';
		$this->dbprofile_verified_EMAIL_1	= 'EMAIL_1';
		$this->dbprofile_verified_STATUS_TELPON	= 'STATUS_TELPON';
		$this->dbprofile_verified_STATUS_INET	= 'STATUS_INET';
		$this->dbprofile_verified_NDOS	= 'NDOS';
		$this->dbprofile_verified_NO_HP_MYIH	= 'NO_HP_MYIH';
		$this->dbprofile_verified_NO_HP_BILLING	= 'NO_HP_BILLING';
		$this->dbprofile_verified_KET_MANJA	= 'KET_MANJA';
		$this->dbprofile_verified_LATITUDE	= 'LATITUDE';
		$this->dbprofile_verified_LONGITUDE	= 'LONGITUDE';

		
		
		
		/*field_alias_database db*/
		$this->f_NCLI	= 'NCLI';
		$this->f_NO_PSTN	= 'NO_PSTN';
		$this->f_NO_SPEEDY	= 'NO_SPEEDY';
		$this->f_NAMA_PELANGGAN	= 'NAMA_PELANGGAN';
		$this->f_RELASI	= 'RELASI';
		$this->f_NO_HP	= 'NO_HP';
		$this->f_STATUS_HP	= 'STATUS_HP';
		$this->f_EMAIL	= 'EMAIL';
		$this->f_STATUS_EMAIL	= 'STATUS_EMAIL';
		$this->f_NAMA_PEMILIK	= 'NAMA_PEMILIK';
		$this->f_ALAMAT	= 'ALAMAT';
		$this->f_KOTA	= 'KOTA';
		$this->f_REGIONAL	= 'REGIONAL';
		$this->f_UPDATE_BY	= 'UPDATE_BY';
		$this->f_TGL_VERIFIKASI	= 'TGL_VERIFIKASI';
		$this->f_IS_LAST	= 'IS_LAST';
		$this->f_SUMBER	= 'SUMBER';
		$this->f_TGL_UPDATE	= 'TGL_UPDATE';
		$this->f_DATRS	= 'DATRS';
		$this->f_ALAMAT_KORESPONDENSI	= 'ALAMAT_KORESPONDENSI';
		$this->f_FACEBOOK_ID	= 'FACEBOOK_ID';
		$this->f_FACEBOOK	= 'FACEBOOK';
		$this->f_TWITTER_ID	= 'TWITTER_ID';
		$this->f_TWITTER	= 'TWITTER';
		$this->f_TWITTER_FOLLOWER	= 'TWITTER_FOLLOWER';
		$this->f_TWITTER_STATUS	= 'TWITTER_STATUS';
		$this->f_NIK	= 'NIK';
		$this->f_PATH_	= 'PATH_';
		$this->f_INSTAGRAM	= 'INSTAGRAM';
		$this->f_NAMA_LGKP	= 'NAMA_LGKP';
		$this->f_AGAMA	= 'AGAMA';
		$this->f_TGL_LHR	= 'TGL_LHR';
		$this->f_TMPT_LHR	= 'TMPT_LHR';
		$this->f_JENIS_KLMIN	= 'JENIS_KLMIN';
		$this->f_JENIS_PKRJN	= 'JENIS_PKRJN';
		$this->f_IS_INDIHOME	= 'IS_INDIHOME';
		$this->f_NO_HP_1	= 'NO_HP_1';
		$this->f_EMAIL_1	= 'EMAIL_1';
		$this->f_STATUS_TELPON	= 'STATUS_TELPON';
		$this->f_STATUS_INET	= 'STATUS_INET';
		$this->f_NDOS	= 'NDOS';
		$this->f_NO_HP_MYIH	= 'NO_HP_MYIH';
		$this->f_NO_HP_BILLING	= 'NO_HP_BILLING';
		$this->f_KET_MANJA	= 'KET_MANJA';
		$this->f_LATITUDE	= 'LATITUDE';
		$this->f_LONGITUDE	= 'LONGITUDE';

		
		
		
		/* CONFIG FORM LIST */
		/* field_alias_database => $title */	
		$this->table_column =array(
			$this->f_NCLI	=> $this->dbprofile_verified_NCLI,
			$this->f_NO_PSTN	=> $this->dbprofile_verified_NO_PSTN,
			$this->f_NO_SPEEDY	=> $this->dbprofile_verified_NO_SPEEDY,
			$this->f_NAMA_PELANGGAN	=> $this->dbprofile_verified_NAMA_PELANGGAN,
			$this->f_RELASI	=> $this->dbprofile_verified_RELASI,
			$this->f_NO_HP	=> $this->dbprofile_verified_NO_HP,
			$this->f_STATUS_HP	=> $this->dbprofile_verified_STATUS_HP,
			$this->f_EMAIL	=> $this->dbprofile_verified_EMAIL,
			$this->f_STATUS_EMAIL	=> $this->dbprofile_verified_STATUS_EMAIL,
			$this->f_NAMA_PEMILIK	=> $this->dbprofile_verified_NAMA_PEMILIK,
			$this->f_ALAMAT	=> $this->dbprofile_verified_ALAMAT,
			$this->f_KOTA	=> $this->dbprofile_verified_KOTA,
			$this->f_REGIONAL	=> $this->dbprofile_verified_REGIONAL,
			$this->f_UPDATE_BY	=> $this->dbprofile_verified_UPDATE_BY,
			$this->f_TGL_VERIFIKASI	=> $this->dbprofile_verified_TGL_VERIFIKASI,
			$this->f_IS_LAST	=> $this->dbprofile_verified_IS_LAST,
			$this->f_SUMBER	=> $this->dbprofile_verified_SUMBER,
			$this->f_TGL_UPDATE	=> $this->dbprofile_verified_TGL_UPDATE,
			$this->f_DATRS	=> $this->dbprofile_verified_DATRS,
			$this->f_ALAMAT_KORESPONDENSI	=> $this->dbprofile_verified_ALAMAT_KORESPONDENSI,
			$this->f_FACEBOOK_ID	=> $this->dbprofile_verified_FACEBOOK_ID,
			$this->f_FACEBOOK	=> $this->dbprofile_verified_FACEBOOK,
			$this->f_TWITTER_ID	=> $this->dbprofile_verified_TWITTER_ID,
			$this->f_TWITTER	=> $this->dbprofile_verified_TWITTER,
			$this->f_TWITTER_FOLLOWER	=> $this->dbprofile_verified_TWITTER_FOLLOWER,
			$this->f_TWITTER_STATUS	=> $this->dbprofile_verified_TWITTER_STATUS,
			$this->f_NIK	=> $this->dbprofile_verified_NIK,
			$this->f_PATH_	=> $this->dbprofile_verified_PATH_,
			$this->f_INSTAGRAM	=> $this->dbprofile_verified_INSTAGRAM,
			$this->f_NAMA_LGKP	=> $this->dbprofile_verified_NAMA_LGKP,
			$this->f_AGAMA	=> $this->dbprofile_verified_AGAMA,
			$this->f_TGL_LHR	=> $this->dbprofile_verified_TGL_LHR,
			$this->f_TMPT_LHR	=> $this->dbprofile_verified_TMPT_LHR,
			$this->f_JENIS_KLMIN	=> $this->dbprofile_verified_JENIS_KLMIN,
			$this->f_JENIS_PKRJN	=> $this->dbprofile_verified_JENIS_PKRJN,
			$this->f_IS_INDIHOME	=> $this->dbprofile_verified_IS_INDIHOME,
			$this->f_NO_HP_1	=> $this->dbprofile_verified_NO_HP_1,
			$this->f_EMAIL_1	=> $this->dbprofile_verified_EMAIL_1,
			$this->f_STATUS_TELPON	=> $this->dbprofile_verified_STATUS_TELPON,
			$this->f_STATUS_INET	=> $this->dbprofile_verified_STATUS_INET,
			$this->f_NDOS	=> $this->dbprofile_verified_NDOS,
			$this->f_NO_HP_MYIH	=> $this->dbprofile_verified_NO_HP_MYIH,
			$this->f_NO_HP_BILLING	=> $this->dbprofile_verified_NO_HP_BILLING,
			$this->f_KET_MANJA	=> $this->dbprofile_verified_KET_MANJA,
			$this->f_LATITUDE	=> $this->dbprofile_verified_LATITUDE,
			$this->f_LONGITUDE	=> $this->dbprofile_verified_LONGITUDE,
		);

	}

};









/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-02-08 07:42:27 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/

