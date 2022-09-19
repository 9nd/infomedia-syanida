<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {



	public function index()
	
	{
		$this->load->model('sys/Sys_user_model','muser');
		$this->load->model('sys/Sys_level_model','mlevel');
		$this->load->model('sys/User_Log_model','muser_log');
		$data = array(
			'title_page_big'			=> 'Pengaturan Sistem',
			'link_menu_management' 		=> site_url().'sistem/Pengaturan_tampilan/menu_management',
			'link_pengaturan_template'	=> site_url().'sistem/Template_system/style',
			'link_logo_konfigurasi' 	=> site_url().'sistem/Pengaturan_tampilan/logo_konfigurasi',
			'link_level_konfigurasi'	=> site_url().'sistem/Pengaturan_level',
			'link_registrasi_form'		=> site_url().'sistem/Registrasi_form',
			'link_user_konfigurasi'		=> site_url().'sistem/Pengaturan_pengguna',
			'link_crud_generator'		=> site_url().'sistem/Crud_generator',
			'link_error_report'			=> site_url().'sistem/Keamanan/error_report',
			'link_monitoring_injection'	=> site_url().'sistem/Keamanan/monitoring_injection',
			'link_csrf_protection'		=> site_url().'sistem/Keamanan/csrf_protection',
			'link_access_front_end'		=> site_url().'sistem/Keamanan/access_front_end',
			'link_maintenance_setting'	=> site_url().'sistem/Maintenance/maintenance_setting_list',
			'link_login_activity'		=> site_url().'sistem/User_Log',
			'total_users'				=> $this->muser->total_rows(),
			'total_level'				=> $this->mlevel->total_rows(),
			'total_aktifitas'			=> $this->muser_log->total_rows(),
			
		);
		
		$this->template->load('sistem/Pengaturan',$data);
	}
	

	
	
}
