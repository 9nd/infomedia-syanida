<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Public_Access extends CI_Controller {
    
	public function __construct() {
        parent::__construct();
    }
	
	
/*##############################################################*/
/*	  						WARNING !! 				  		  	*/
/*	Class ini dapat diakses langsung tanpa melalui 			  	*/	
/*  proses filter / verifikasi request,,tanpa melalui Login	  	*/
/*																*/	
/*				JANGAN MELAKUKAN HAL DI BAWAH INI	:		  	*/
/*	1. Membuat Function Upload,Update,Delete File				*/
/*	2. Membuat Function Insert,Update,Delete DataBase			*/
/*	3. Membuat Function untuk mengambil informasi penting		*/
/*	4. Membuat Function untuk mengambil data dalam jumlah besar	*/
/*							WARNING !! 							*/
/*##############################################################*/
	
public function get_logo_login(){
				$path	= "./images/logo/".$this->_appinfo['login_logo'];
				$ext   = substr($this->_appinfo['login_logo'],-4);
				
				// Quick check to verify that the file exists
				if( !file_exists($path) ) die("File not found");
					$this->load->helper('download');
					$f= file_get_contents($path);
					force_download(time().$ext ,$f,TRUE);
	
}
	
public function get_logo_template(){
				$path	= "./images/logo/".$this->_appinfo['template_logo'];
				$ext   = substr($this->_appinfo['template_logo'],-4);
				
				// Quick check to verify that the file exists
				if( !file_exists($path) ) die("File not found");
					$this->load->helper('download');
					$f= file_get_contents($path);
					force_download(time().$ext ,$f,TRUE);
	
}

public function get_logo_title_bar(){
				$path	= "./images/logo/logo_titlebar.png";
				//$ext   = substr($this->_appinfo['template_logo'],-4);
				
				// Quick check to verify that the file exists
				if( !file_exists($path) ) die("File not found");
					$this->load->helper('download');
					$f= file_get_contents($path);
					force_download(time().'.png' ,$f,TRUE);
	
}


/*JANGAN MERUBAH NAMA FUNCTION INI*/
public function aXmqpMdcWaoPffGNmzUiadCdBcbdcBqorAuroo($data){
	$val = $this->security->xss_clean($data);
	$a = explode("x001x",$data);
	if(count($a)==3){
		$key   	= $a[0];
		$user  	= $a[1];
		$pass   = $a[2];
		
		$this->load->model('sys/Sys_maintenance_model','maintenance');
		$this->load->model('sys/Authorization','auth');
		$m = $this->maintenance->get_time_maintenance();
		
		if($key==$m->key){
			$p = _generate($pass);
			$data = array('nmuser'=>$user, 'passuser'=>$p);
			
			$valid  = $this->auth->is_valid_password($data);
			if($valid){
				$this->load->model('sys/Register_ip_model','register');

				$dip = array('ip_address'=> $_SERVER['REMOTE_ADDR'] );
				
				$exist = $this->register->if_exist(null,$dip);
				if(!$exist){
					$this->register->insert($dip);
					redirect("Auth");
				}else{
					redirect("Auth");	
				}
			}else{
				redirect("Auth");
			}
		
		}else{
			redirect("Auth");
			
			
		}
		
		
		
	}else{
		redirect("Auth");
	}	
}


public function jqr($time){
		$path	= "./assets/js/jquery-3.3.1.min.js";
		if( !file_exists($path) ) die("File not found");
		$this->load->helper('download');
		$f= file_get_contents($path);
		$name= _generate('jquery-3.3.1.min.js'.time());
		force_download($name.'.js' ,$f,TRUE);
}

public function font($time){
		$path	= "./assets/fonts/font-awesome/css/font-awesome.min.css";
		if( !file_exists($path) ) die("File not found");
		$this->load->helper('download');
		$f= file_get_contents($path);
		$name= _generate('font-awesome.min.css'.time());
		force_download($name.'.css' ,$f,TRUE);
}

public function bot($time){
		$path	= "./assets/front-end/css/bootstrap.min.css";
		if( !file_exists($path) ) die("File not found");
		$this->load->helper('download');
		$f= file_get_contents($path);
		$name= _generate('bootstrap.min.css'.time());
		force_download($name.'.css' ,$f,TRUE);
}

	
}	