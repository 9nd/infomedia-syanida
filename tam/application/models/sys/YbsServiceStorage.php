<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
*	Class ini hanya di akses Oleh Controller.
*	untuk keperluan internal server	
*	
*
*/
class YbsServiceStorage extends CI_Model {
  

	function __construct(){
        parent::__construct();
		$this->load->model('sys/Sys_service_storage_model','tstor');
		$this->load->helper('file');
    }
	
	
	/**
	*	Fungsi  mengambil informasi file
	*	private = TRUE (hanya dapat mengakses file yg di upload oleh user yang bersangkutan)
	*/
	public function get_access_file($data,$private=TRUE){
			
			if($data=='' || $data ==null || $data ==0){
					$data = array();
					$dt = array(
						'type'		=> '',	
						'link'		=> '',
						'orig_name'	=> '',
						'time'		=> '',
					);
				
					$data[] = $dt;
					return $data;
			}
			
			if(!is_array($data)){	
				$data = explode(" ",$data);
			}
			
			$row;
			if($private){
				$row  = $this->tstor->get_all_file_bytime($this->_user_id,$data);
			}else{
				$row  = $this->tstor->get_all_file_bytime("",$data,FALSE);
			}
			
			
			$data = array();	
			foreach($row as $val){
				$file  		= $val->file_path . $val->name;
				$mime  		= get_mime_by_extension($file);
				$url_link   = "";
				if($private){
					$url_link 	= site_url().'Service_Storage/get_file/'.$this->_token . '_' . $val->time;
				}else{
					$url_link 	= site_url().'Service_Storage/get_general_file/'.$this->_token . '_' . $val->time;
				}
				
				
				
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
			return $data;
	}
	
	
	
	public function remove_file($time,$private=TRUE){
		
		$file;
		if($private){
			$file  = $this->tstor->get_file_bytime($this->_user_id,$time);
		}else{
			$file  = $this->tstor->get_file_bytime("",$time,FALSE);
		}
		
		
			
		//menghapus file jika ada
		$success 	= $this->_delete_file($file);
			
		//memastikan jika file berhasil di hapus 
		if($success	== 'true'){
			if($private){
				$this->tstor->delete_file_bytime($this->_user_id,$time);
			}else{
				$this->tstor->delete_file_bytime("",$time,FALSE);
			}	
			
			
			return true;
		}else{
			return false;
		}

	}
	
	
	private function _delete_file($file){
		$success ='true';

		if(isset($file)){
			if(file_exists($file->file_path . $file->name)){
				if(!unlink($file->file_path . $file->name)){
					$success='false';
				}
			}
					
		}

		return $success;
	}
	

   
}
