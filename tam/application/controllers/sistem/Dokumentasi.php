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
class Dokumentasi extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

	public function index(){
	
	}
	
	
	public function petunjuk_penggunaan(){
		$data['title_page_big'] = "Petunjuk Penggunaan";
		$data['link_tahap_lanjut'] = site_url().'sistem/Dokumentasi/petunjuk_penggunaan_tahap_lanjut'	;
		$this->template->load('sistem/dokumentasi/Petunjuk_penggunaan',$data);
	}
	
	public function petunjuk_penggunaan_tahap_lanjut(){
		$data['title_page_big'] = "Petunjuk Penggunaan";
		$data['link_tahap_dasar'] = site_url().'sistem/Dokumentasi/petunjuk_penggunaan';	
		$this->template->load('sistem/dokumentasi/Petunjuk_penggunaan_lanjutan',$data);
	}

	public function sample_icon(){
		$data['title_page_big'] = "Sample Icon";		
		$this->template->load('sistem/dokumentasi/Sample_icon',$data);
	}
	
	public function sample_element(){
		$data['title_page_big'] = "Sample Element";		
		$data['link_dropzone'] = site_url().'sistem/Dokumentasi/sample_element_dropzone';
		$data['link_chartjs'] = site_url().'sistem/Dokumentasi/sample_chartjs';
		$this->template->load('sistem/dokumentasi/Sample_element',$data);
	}
	
	public function sample_element_dropzone(){
		$data['title_page_big'] = "Sample Element";		
		$this->template->load('sistem/dokumentasi/Sample_element_dropzone',$data);
	}
	
	public function sample_chartjs(){
		$data['title_page_big'] = "Sample Chart JS";		
		$this->template->load('sistem/dokumentasi/Sample_element_chartjs',$data);
	}
	

}
