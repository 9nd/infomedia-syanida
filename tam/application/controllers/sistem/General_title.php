<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class General_title {
	public $button_create;
	public $button_create_desc;
	public $button_save;
	public $button_edit;
	public $button_delete;
	public $button_delete_desc;
	public $button_cancel;
	public $button_apply;
	public $button_back;
	public $button_close;
	public $desc_required;
	

   function __construct(){
	    $this->button_create 			= 'Buat Baru';
		$this->button_create_desc 		= 'create new';
		$this->button_save 				= 'Simpan';
		$this->button_edit 				= 'Ubah';
		$this->button_cancel 			= 'Batal';
		$this->button_delete 			= 'Hapus';
		$this->button_delete_desc 		= 'Hapus yang dicentang';
		$this->button_apply 			= 'Setuju';
		$this->button_back 				= 'Kembali';
		$this->button_close 			= 'Tutup';
		$this->desc_required			= 'wajib di isi..';
	}

};








/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging_system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
