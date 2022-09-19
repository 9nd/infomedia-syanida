<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form_General
 *
 * @author Dhiya
 */
class Dokumentasi_109 extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

	public function index(){
	
	}
	
	
	public function general(){
		$data['page'] = "general";
		$data['title_dokumentasi'] = "<b>Introduce</b>";

		$data['body_dokumentasi'] =$this->load->view("sistem/dokumentasi/1.0.9/General",null,TRUE);
		
		$this->template->load('sistem/dokumentasi/1.0.9/Template_dokumentasi',$data);
		
	}
	
	public function system_requirtment(){
		$data['page'] = "requirtment";
		$data['title_dokumentasi'] = "System Requirtment";

		$data['body_dokumentasi'] =$this->load->view("sistem/dokumentasi/1.0.9/System_requirtment",null,TRUE);
		
		$this->template->load('sistem/dokumentasi/1.0.9/Template_dokumentasi',$data);
	}
	
	
	
	public function pengaturan_menu(){
		$data['page'] = "pengaturan_menu";
		$data['title_dokumentasi'] = "Pengaturan Menu";

		$data['body_dokumentasi'] = $this->load->view("sistem/dokumentasi/1.0.9/Pengaturan_menu",null,TRUE);
		
		$this->template->load('sistem/dokumentasi/1.0.9/Template_dokumentasi',$data);
	}
	
	
	public function pengaturan_template(){
		$data['page'] = "pengaturan_template";
		$data['title_dokumentasi'] = "Pengaturan Template";
		$data['body_dokumentasi'] = $this->load->view("sistem/dokumentasi/1.0.9/Pengaturan_template",null,TRUE);
		$this->template->load('sistem/dokumentasi/1.0.9/Template_dokumentasi',$data);
	}
	
	public function registrasi_form(){
		$data['page'] = "registrasi_form";
		$data['title_dokumentasi'] = "Registrasi Form";
		$data['body_dokumentasi'] = $this->load->view("sistem/dokumentasi/1.0.9/Registrasi_form",null,TRUE);
		$this->template->load('sistem/dokumentasi/1.0.9/Template_dokumentasi',$data);
	}
	
	public function level_konfigurasi(){
		$data['page'] = "level_konfigurasi";
		$data['title_dokumentasi'] = "Level Konfigurasi";
		$data['body_dokumentasi'] = $this->load->view("sistem/dokumentasi/1.0.9/Level_konfigurasi",null,TRUE);
		$this->template->load('sistem/dokumentasi/1.0.9/Template_dokumentasi',$data);
	}
	
	public function user_konfigurasi(){
		$data['page'] = "user_konfigurasi";
		$data['title_dokumentasi'] = "User Konfigurasi";
		$data['body_dokumentasi'] = $this->load->view("sistem/dokumentasi/1.0.9/User_konfigurasi",null,TRUE);
		$this->template->load('sistem/dokumentasi/1.0.9/Template_dokumentasi',$data);
	}
	
	public function crud_generator(){
		$data['page'] = "crud_generator";
		$data['title_dokumentasi'] = "CRUD Generator";
		$data['body_dokumentasi'] = $this->load->view("sistem/dokumentasi/1.0.9/Crud_generator",null,TRUE);
		$this->template->load('sistem/dokumentasi/1.0.9/Template_dokumentasi',$data);
	}
	
	public function error_report(){
		$data['page'] = "error_report";
		$data['title_dokumentasi'] = "Error Report";
		$data['body_dokumentasi'] = $this->load->view("sistem/dokumentasi/1.0.9/Error_report",null,TRUE);
		$this->template->load('sistem/dokumentasi/1.0.9/Template_dokumentasi',$data);
	}
	
	public function csrf_protection(){
		$data['page'] = "csrf_protection";
		$data['title_dokumentasi'] = "CSRF Protection";
		$data['body_dokumentasi'] = $this->load->view("sistem/dokumentasi/1.0.9/Csrf_protection",null,TRUE);
		$this->template->load('sistem/dokumentasi/1.0.9/Template_dokumentasi',$data);
	}
	
	public function front_end(){
		$data['page'] = "front_end";
		$data['title_dokumentasi'] = "Access Front End";
		$data['body_dokumentasi'] = $this->load->view("sistem/dokumentasi/1.0.9/Front_end",null,TRUE);
		$this->template->load('sistem/dokumentasi/1.0.9/Template_dokumentasi',$data);
	}
	
	public function page_maintenance(){
		$data['page'] = "page_maintenance";
		$data['title_dokumentasi'] = "Page Maintenance";
		$data['body_dokumentasi'] = $this->load->view("sistem/dokumentasi/1.0.9/Page_maintenance",null,TRUE);
		$this->template->load('sistem/dokumentasi/1.0.9/Template_dokumentasi',$data);
	}
	
	public function panduan_form(){
		$data['page'] = "panduan_form";
		$data['title_dokumentasi'] = "Panduan Membuat Form";
		$data['link_tahap_lanjut'] =  base_url()."sistem/Dokumentasi_109/panduan_form_lanjutan";
		$data['body_dokumentasi'] = $this->load->view("sistem/dokumentasi/1.0.9/Panduan_membuat_form",$data,TRUE);
		$this->template->load('sistem/dokumentasi/1.0.9/Template_dokumentasi',$data);
	}
	
	public function panduan_form_lanjutan(){
		$data['page'] = "panduan_form";
		$data['title_dokumentasi'] = "Panduan Membuat Form";
		$data['link_tahap_lanjut'] = base_url()."sistem/Dokumentasi_109/panduan_form_lanjutan";
		$data['body_dokumentasi'] = $this->load->view("sistem/dokumentasi/1.0.9/Panduan_membuat_form_2",$data,TRUE);
		$this->template->load('sistem/dokumentasi/1.0.9/Template_dokumentasi',$data);
	}
	
	public function panduan_upload_file(){
		$data['page'] = "panduan_upload_file";
		$data['title_dokumentasi'] = "Panduan Upload File";
		$data['body_dokumentasi'] = $this->load->view("sistem/dokumentasi/1.0.9/Panduan_upload_file",$data,TRUE);
		$this->template->load('sistem/dokumentasi/1.0.9/Template_dokumentasi',$data);
	}
	

}
