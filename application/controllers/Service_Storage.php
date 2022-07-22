<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*	Class ini di akses melalui Client Ajax.
*	
*
*/
class Service_Storage extends CI_Controller {
    private $path_temp;
	public function __construct() {
        parent::__construct();
		$this->load->model('sys/Sys_service_storage_model','tmodel');
		$this->path_temp 		= './temp_upload/';
		$this->load->helper('file');
    }


	public function index(){
		
		
	}

	
	public function get_access_file($token){
		if($token==$this->_token){
			$data = $this->input->get('data_ajax',true);
			$val  = json_decode($data,true);
			
			$val  = explode(" ",$val['time']);
			
			if($val=='' || $val ==null){
				$o = new Outputview();
				$o->success = 'false';
				$o->message = 'Opps tidak ada data..';
				echo $o->result();
				return;
			}
			$row  = $this->tmodel->get_all_file_bytime($this->_user_id,$val);
			
			$data = array();	
			
			
			foreach($row as $val){
				$file  		= $val->file_path . $val->name;
				$mime  		= get_mime_by_extension($file);
				$url_link 	= site_url().'Service_Storage/get_file/'.$this->_token . '_' . $val->time;
				$types		= explode('/',$mime);
				$type		= "";
				$orig_name	= $val->orig_name;
				switch($types[0]){
					case  'image' :
						$type = "image";
						break;
					case  'video' :
						$type = "vidio";
						break;
					case  'audio' :
						$type = "audio";
						break;
					default :
						$type = "application";
				}
				
				$dt = array(
					'type'		=> $type,	
					'link'		=> $url_link,
					'orig_name'	=> $orig_name,
					'time'		=> $val->time,
				);
				
				$data[] = $dt;
			}
			$o = new Outputview();
			$o->success = 'true';
			$o->message = json_encode($data);
			echo $o->result();
		}else{
			//	jika mencoba request tanpa otorisasi.
			//  redirect('https://www.polri.go.id/');
		}
	}
	
	
	public function get_access_file_temp($token){
		if($token==$this->_token){
			$data = $this->input->get('data_ajax',true);
			$val  = json_decode($data,true);
			$val  = explode(" ",$val['time']);
			
			if($val=='' || $val ==null){
				$o = new Outputview();
				$o->success = 'false';
				$o->message = 'Opps tidak ada data..';
				echo $o->result();
				return;
			}
			$row  = $this->tmodel->get_all_file_temp_bytime($this->_user_id,$val);
			
			$data = array();	
			
			
			foreach($row as $val){
				$file  		= $val->file_path . $val->name;
				$mime  		= get_mime_by_extension($file);
				$url_link 	= site_url().'Service_Storage/get_files_temp/'.$this->_token . '_' . $val->time;
				$types		= explode('/',$mime);
				$type		= "";
				$orig_name	= $val->orig_name;
				switch($types[0]){
					case  'image' :
						$type = "image";
						break;
					case  'video' :
						$type = "vidio";
						break;
					case  'audio' :
						$type = "audio";
						break;
					default :
						$type = "application";
				}
				
				$dt = array(
					'type'		=> $type,	
					'link'		=> $url_link,
					'orig_name'	=> $orig_name,
					'time'		=> $val->time,
				);
				
				$data[] = $dt;
			}
			$o = new Outputview();
			$o->success = 'true';
			$o->message = json_encode($data);
			echo $o->result();
		}else{
			//	jika mencoba request tanpa otorisasi.
			//  redirect('https://www.polri.go.id/');
		}
	}
	
	
	
	
	
	public function get_file($token){
		$t = explode("_",$token);
		if(count($t)!==2){
			return;
		}
		
		if($t[0]==$this->_token){
			$time 	= $t[1];
			$row 	= $this->tmodel->get_file_bytime($this->_user_id,$time);
			if($row){
				$name	= $row->file_path . $row->name;
				// Quick check to verify that the file exists
				if( !file_exists($name) ) die("File not found");
					$this->load->helper('download');
					$f= file_get_contents($name);
					force_download($row->orig_name,$f);
			}
			
		}
		
	}
	
	public function get_files_temp($token){
		$t = explode("_",$token);
		if(count($t)!==2){
			return;
		}
		
		if($t[0]==$this->_token){
			$time 	= $t[1];
			$row 	= $this->tmodel->get_file_temp_bytime($this->_user_id,$time);
			if($row){
				$name	= "./temp_upload/" . $row->name;
				// Quick check to verify that the file exists
				
				if( !file_exists($name) ) die("File not found".var_dump($row));
					$this->load->helper('download');
					$f= file_get_contents($name);
					force_download($row->orig_name,$f,TRUE);
			}
			
		}
		
	}
	
	public function get_general_file($token){
		$t = explode("_",$token);
		if(count($t)!==2){
			return;
		}
		
		if($t[0]==$this->_token){
			$time 	= $t[1];
			$row 	= $this->tmodel->get_file_bytime('',$time,FALSE);
			if($row){
				$name	= $row->file_path . $row->name;
				// Quick check to verify that the file exists
				if( !file_exists($name) ) die("File not found");
					$this->load->helper('download');
					$f= file_get_contents($name);
					force_download($row->orig_name,$f);
			}
		}
		
	}
	
	public function get_file_temp($data){
		$ex = explode($this->_separator_a,$data);
		if(count($ex)!==2){
			return;
		}
		if($ex[0]==$this->_token){
			
			$name= "./temp_upload/".$ex[1] ;
			if( !file_exists($name) ) die("File not found");
					$this->load->helper('download');
					$f= file_get_contents($name);
					force_download($ex[1],$f);
		}else{
			redirect("Auth");
		}
	}
	
	

	
	
}