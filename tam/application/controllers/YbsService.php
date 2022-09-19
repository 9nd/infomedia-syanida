<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class YbsService extends CI_Controller {
    
	public function __construct() {
        parent::__construct();
		$this->load->model('sys/YbsService_Model','tmodel');
    }


	public function index(){
		
	}

	public function combobox_data(){
		
		$data = $this->input->get('data_ajax',true);
		$val  = json_decode($data,true);
		if(	!isset($val['tk']) || 
			!isset($val['t'])  || 
			!isset($val['fs']) || 
			!isset($val['w'])  || 
			!isset($val['wv'])){
			return;
		}

		if($val['tk']== $this->_token){
				
				$row = $this->tmodel->get_data_combobox($val['t'],$val['fs'],$val['w'],$val['wv']);
				
				$a = array();
				$a['text'] = '--Pilih Data--';
				$a['value'] = 'null';
				array_unshift($row,$a);
				
				
				
				
				$o = new Outputview();
				$o->success = 'true';
				$o->message = $row;
				echo $o->result();
		}else{
				//hahaha...
				//jika mencoba request tanpa otorisasi.
				//redirect('https://www.polri.go.id/');
		}
	}
	
	
	public function get_picture_profile($token){
		
		if($token==$this->_token){
				$name	= "./images/user_profile/". $this->_user_picture;
				// Quick check to verify that the file exists
				if( !file_exists($name) ) die("File not found");
					$this->load->helper('download');
					$f= file_get_contents($name);
					force_download($this->_token,$f);
		}
			
	}
	
	
	//fungsi ini hanya di gunakan oleh user configurator
	public function get_picture($data){
		//$this->_token.$this->_separator_a.user_picture
		$xx  = explode($this->_separator_a,$data);
		if(count($xx)<2){
			return;
		}
		
		if($xx[0]==$this->_token && $this->_user_id==1){
				$name	= "./images/user_profile/". $xx[1];
				// Quick check to verify that the file exists
				if( !file_exists($name) ) die("File not found");
					$this->load->helper('download');
					$f= file_get_contents($name);
					force_download($this->_token,$f);
		}
			
	}
	
	
	public function get_default_picture_profile($token){
		
		if($token==$this->_token){
				$name	= "./images/user_profile/default.png";
				// Quick check to verify that the file exists
				if( !file_exists($name) ) die("File not found");
					$this->load->helper('download');
					$f= file_get_contents($name);
					force_download($this->_token,$f);
		}
			
	}
	//fungsi ini hanya di gunakan oleh user configurator
	public function get_foto_agent($data){
		//$this->_token.$this->_separator_a.user_picture
		// $xx  = explode($this->_separator_a,$data);
		// if(count($xx)<2){
		// 	return;
		// }
		
		// if($xx[0]==$this->_token){
				$name	= "./images/user_profile/". $data;
				// Quick check to verify that the file exists
				if( !file_exists($name) ) die("File not found");
					$this->load->helper('download');
					$f= file_get_contents($name);
					force_download($this->_token,$f);
		// }
			
	}
	
	

	
	
}