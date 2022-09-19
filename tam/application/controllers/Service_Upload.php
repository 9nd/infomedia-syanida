<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*	Class ini di akses melalui Client Ajax.
*	
*
*/
class Service_Upload extends CI_Controller {
    private $path_temp;
	public function __construct() {
        parent::__construct();
		$this->load->model('sys/Sys_service_upload_model','tmodel');
		$this->load->model('sys/Sys_service_storage_model','tstor');
		$this->path_temp = './temp_upload/';
    }


	public function index(){
		
	}

	public function upload($token){
		if($token==$this->_token){
				sleep(1);
				$p 				= $this->input->post('path_upload',TRUE);
				$autosave 		= $this->input->post('autosave',TRUE);

				
				$path_target	= '';
				$path_file		= '';
				
				if($p==""){
					$path_file='./upload_files/';
				}else{
					$path_file='./upload_files/'.$p.'/';
				}
				
				$path_target = $path_file;
				
				
				if($autosave=='false'){
					$path_file=$this->path_temp;
				}
					
				$path_file	 = preg_replace('/([^:])(\/{2,})/', '$1/', $path_file); 
				$path_target = preg_replace('/([^:])(\/{2,})/', '$1/', $path_target); 
			
				_createFolder($path_file);
				_createFolder($path_target);

				$time_post = time();
				$config['upload_path']          = $path_file;
				//jika melakukan perubahan
				//pastikan extension vidio berada paling awal,jika tidak akan menyebabkan error
                $config['allowed_types']        = 'ogv|wmv|mov|mpg|mp4|avi|mpeg|mp3|wav|png|jpg|jpeg|img|bmp|gif|ico|svg|txt|doc|docx|xls|xlsx|ppt|pptx|pdf|zip|rar|iso';
                $config['max_size']             = 512000; //bytes (500 Mb)
				$config['overwrite']			= TRUE;
				$config['encrypt_name']			= TRUE;
				
				
                $this->load->library('upload', $config);	
				
				$data = array();
				 if ( !$this->upload->do_upload('file')){
							$em = $this->upload->display_errors();
							$em = str_replace('<p>','',$em);
							$em = str_replace('</p>','',$em);
							$em = str_replace('You did not select a file to upload.','Tidak ada file yang di pilih',$em);
							$em = str_replace('The uploaded file exceeds the maximum allowed size in your PHP configuration file.','Opps,melebihi batas upload !! check configurasi anda (upload_max_filesize)',$em);
							$em = str_replace('The file you are attempting to upload is larger than the permitted size.','Opps file terlalu besar,block by server,max size 5 Mb',$em);
							$em = str_replace('The filetype you are attempting to upload is not allowed.','Type file ini tidak dizinkan !! hubungi administrator anda',$em);
							$em = str_replace('The upload path does not appear to be valid.','Lokasi upload tidak valid..hubungi administrator anda',$em);
							
							$data['success'] 	= 'false';
							$data['message'] 	= $em;
							$data['elementid'] 	= '#file';
							$data['sec_val']	=  $this->security->get_csrf_token_name()."=".$this->security->get_csrf_hash()."&";
							$data = json_encode($data);
							echo $data;
							return;		
					}else{
					
			
						if($autosave=='true'){
							$path_picture = $config['upload_path'];
						
							$success  = $this->tmodel->upload_file(	$this->_user_id,
																	$path_picture,
																	$this->upload->data('orig_name'),
																	$this->upload->data('file_name'),		
																	$this->upload->data('file_ext'),
																	$time_post
																);
						}else{
						
							$success  = $this->tmodel->upload_file_temp(	$this->_user_id,
																			$path_target,
																			$this->upload->data('orig_name'),
																			$this->upload->data('file_name'),		
																			$this->upload->data('file_ext'),
																			$time_post
																		);
						}
						

						
						if($success){
							$data['success'] 		= 'true';
							$data['message'] 		= $this->tmodel->insert_id ;
							$data['time_post']		= $time_post;
							$data['orig_name']		= $this->upload->data('orig_name');	
							$data['ext']			= $this->upload->data('file_ext');	
							$data['elementid'] 		= '';
							$data['sec_val']		=  $this->security->get_csrf_token_name()."=".$this->security->get_csrf_hash()."&";
							$data = json_encode($data);
							echo $data;
							return;		
						}else{
							if(file_exists($path_picture.$this->upload->data('file_name'))){
								unlink($path_picture.$this->upload->data('file_name'));
							}
							$data['success'] 		= 'false';
							$data['message'] 		= 'Opps gagal menyimpan file';
							$data['elementid']		= '';
							$data['sec_val']		=  $this->security->get_csrf_token_name()."=".$this->security->get_csrf_hash()."&";
							$data = json_encode($data);
							echo $data;
							return;		
						}
						
						
						
					}
			
		}else{
			//	jika mencoba request tanpa otorisasi.
			 redirect('Auth');
		}
	}
	
	
	
	
	public function save_temp($token){
		if($token==$this->_token){
			$data = $this->input->get('data_ajax',true);
			$val  = json_decode($data,true);
			$val  = explode(" ",$val['time']);
			
			foreach($val as $k){
				$success = $this->tstor->move_temp($this->_user_id,$k);
				if($success){
					$path_source 	= $this->path_temp . $this->tstor->file_moved_name;
					$path_dest   	= $this->tstor->file_moved_path . $this->tstor->file_moved_name;
					
					if(file_exists($path_source)){
						rename($path_source, $path_dest);
					}
					
				}
			}
			

			$o = new Outputview();
			$o->success = 'true';
			echo $o->result();
		}else{
			//	jika mencoba request tanpa otorisasi.
			//  redirect('https://www.polri.go.id/');
		}	
	}
	
	public function clear_temp($token){
		if($token==$this->_token){
		
			$row = $this->tstor->get_all_file_temp($this->_user_id);
			$atime = array();
			foreach($row as $val){
				$ftemp ='./temp_upload/' . $val['name'];
				if(file_exists($ftemp)){
					if(unlink($ftemp)){
						//mendapatkan informasi file yang di hapus.
						$atime[] =  $val['time'];
					}
				}
			}
			
			//menghapus database file yang telah terhapus
			if(!empty($atime)){
				$this->tstor->delete_all_temp_bytime($this->_user_id,$atime);
			}
			$o = new Outputview();
			$o->success = 'true';
			$o->message = "clear temp upload..";
			echo $o->result();
		}	
	}
	
	public function remove_upload($token){
		if($token==$this->_token){
			$data 		= $this->input->get('data_ajax',true);
			$val  		= json_decode($data,true);	
			
			//mendapatkan nama file upload
			$file 		= $this->tstor->get_file_bytime($this->_user_id,$val['upload_id']);

			
			//menghapus file jika ada
			$message = "";
			$success 	= $this->_delete_file($file);
			
			//memastikan jika file berhasil di hapus 
			if($success	== 'true'){
				$this->tstor->delete_file_bytime($this->_user_id,$val['upload_id']);
				
				if(isset($val['relation']) && $val['relation'] !=="" && $val['field'] !=="" && $val['action'] !== ""){
					
					
					
					switch(strtolower($val['action'])){
						case 'update' :
						$this->tstor->update_file_relation($val);
						break;
						
						case 'delete' :
							$this->tstor->delete_file_relation($val);
						break;
							
					}
				}
				
				
				
				$message = "Remove file..";
			}else{
				$message = "Opps..gagal menghapus file..";
			}
				
			
			$o = new Outputview();
			$o->success = $success;
			$o->message = $message;
			echo $o->result();
			return;
			
		}else{
				//jika mencoba request tanpa otorisasi.
				//redirect('https://www.polri.go.id/');
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