<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi_form extends CI_Controller {

    function __construct(){
        parent::__construct();
		$this->load->model('sys/Sys_form_model','tmodel');
		$this->load->helper('directory');
    }

	public function index(){
		$data = array(
			'title_page_big'			=> 'Registrasi URL / FORM',
			'link_refresh_table'		=> site_url().'sistem/Registrasi_form/refresh_table/'.$this->_token,
			'link_create'				=> site_url().'sistem/Registrasi_form/create',
			'link_update'				=> site_url().'sistem/Registrasi_form/update',
			'link_delete'				=> site_url().'sistem/Registrasi_form/delete_multiple',
		);
		
		$this->template->load('sistem/Registrasi_form_list',$data);
	}
	
	
	public function create(){
		
		$d_map = directory_map(APPPATH.'/controllers/',1);
		

		$folder_controller = array();
		$y=0;
		foreach($d_map as $key=>$val){
			//mendapatkan folder controller kecuali folder sistem
			
			if(substr($val,-1)==DIRECTORY_SEPARATOR  && $val !=='sistem' . DIRECTORY_SEPARATOR
				&& $val !=='api' . DIRECTORY_SEPARATOR){
				$folder_controller[$y]  = str_replace(DIRECTORY_SEPARATOR,'',$val);
				$y++;
			}
		}
		
	

		$data = array(
			'title_page_big'			=> 'Registrasi Baru',
			'id'						=> '',
			'form_name'					=> '',
			'code'						=> '',
			'link'						=> '',
			'link_save'					=> site_url().'sistem/Registrasi_form/create_action',
			'link_back'					=> site_url().'sistem/Registrasi_form',
			'link_getfunction'			=> site_url().'sistem/Registrasi_form/getfunction/'.$this->_token,
			'link_getfile'				=> site_url().'sistem/Registrasi_form/get_file/'.$this->_token,

			'folder_controller'			=> $folder_controller,
			'selected_folder'			=> 'pilih_folder',
			'selected_file'				=> '',
			'selected_function'			=> '',
			'selected_shortcut'			=> '1',
			
		);

		$this->template->load('sistem/Registrasi_form_form',$data);
	}
	
	
	public function create_action(){
		$data = $this->input->post('data_ajax',true);
		$val  = json_decode($data,true);
		unset($val['id']);
		unset($val['select-folder']);
		
		$o = new Outputview();
		
		//memastikan kembali inputan
		if($val['form_name']==""){
			$o->success 	= 'false';
			$o->message 	= 'Nama Form Belum disi !';
			$o->elementid	= '#input-nama-form';
			echo $o->result(); 
			return;
		}
		
		if($val['code']==""){
			$o->success		= 'false';
			$o->message 	= 'Kode Form Belum disi !';
			$o->elementid	= '#input-kode-form';
			echo $o->result(); 
			return;
		}
		
		
		$code = array(
			'code' =>$val['code'],
		);
	
		$exist = $this->tmodel->if_exist('',$code);
		if($exist){
			$o->success 	= 'false';
			$o->message 	= 'Kode Form Sudah Digunakan !';
			$o->elementid	= '#input-kode-form';
			echo $o->result(); 
			return;
		}
		

		if($val['link']==""){
			$o->success		= 'false';
			$o->message  	= 'Link URL tidak boleh kosong !';
			echo $o->result();  
			return;
		}
		
		
		$link = array(
			'link' =>$val['link'],
		);
	
		$exist = $this->tmodel->if_exist('',$link);
		if($exist){
			$o->success	 	= 'false';
			$o->message 	= 'URL "'.$val['link'].'" sudah Di Registrasi sebelumnya! gunakan URL lain';
			$o->elementid	= '';
			echo $o->result();   
			return;
		}
		
		
		$this->tmodel->insert($val);
		
		$o->success 	= 'true';
		$o->message 	= 'Data berhasil di simpan';
		echo $o->result(); 
	} 
	
	
	
	
	public function update($id){
		$id 		= $this->security->xss_clean($id);
		$idgenerate	= $id;
		
		//mendapatkan key generate
		$log_key 	= $this->session->userdata('log_registrasi_form');
		
		//important !! tempdata digunakan sbagai antisipasi
		//perubahan session log_table_form saat membuka tab baru secara bersamaan
		//tempdata otomatis di hapus setelah 5 menit
		$this->session->set_tempdata($id,$log_key,300);
		
		//mengembalikan id asli
		$id	= _decode_id($id,$log_key);
		
		//mengecek id
		$row		= $this->tmodel->get_by_id($id);
		
		//memastikan jika id memiliki data
		if($row){
			$as	= explode('/',$row->link);
			$selected_folder;
			$selected_file;
			$selected_function;
			switch(count($as)){
				// case 1:
					// $selected_folder 	= 'parent';
					// $selected_file 		= $as[0];
					// $selected_function	= "index";
					// break;
				case 2:
					$selected_folder 	= $as[0];
					$selected_file 		= $as[1];
					$selected_function	= "index";
					break;
				case 3:
					$selected_folder 	= $as[0];
					$selected_file 		= $as[1];
					$selected_function	= $as[2];
					break;
			}
			
			
			$d_map = directory_map(APPPATH.'/controllers/',1);
			$folder_controller = array();
			$y=0;
			foreach($d_map as $key=>$val){
				//mendapatkan folder controller kecuali folder sistem
				if(substr($val,-1)==DIRECTORY_SEPARATOR && $val !=='sistem'.DIRECTORY_SEPARATOR
					&& $val !=='api'.DIRECTORY_SEPARATOR){
					$folder_controller[$y]  = str_replace(DIRECTORY_SEPARATOR,'',$val);
					$y++;
				}
			}
			
			
			$data = array(
			'title_page_big'			=> 'Update Data',
			'id'						=> $idgenerate,
			'form_name'					=> $row->form_name,
			'code'						=> $row->code,
			'link'						=> $row->link,
			'link_back'					=> site_url().'sistem/Registrasi_form',
			'selected_shortcut'			=> $row->shortcut,
			'folder_controller'			=> $folder_controller,
			'selected_folder'			=> $selected_folder,
			'selected_file'				=> $selected_file,
			'selected_function'			=> $selected_function,
			
			'link_getfunction'			=> site_url().'sistem/Registrasi_form/getfunction/'.$this->_token,
			'link_save'					=> site_url().'sistem/Registrasi_form/update_action',
			'link_getfile'				=> site_url().'sistem/Registrasi_form/get_file/'.$this->_token,
		);
		

		$this->template->load('sistem/Registrasi_form_form',$data);
		}else{
			redirect($this->agent->referrer());	
		}
		
	}
	
	
	public function update_action(){
		$data 		= $this->input->post('data_ajax',true);
		$val		= json_decode($data,true);
		
		//mendapatkan kembali log_key
		$log_key	= $this->session->tempdata($val['id']);
		
		$id	= _decode_id($val['id'],$log_key);
		unset($val['id']);
		unset($val['select-folder']);
		unset($val['undefined']);
		
		
		//memastikan id terdaftar
		$row = $this->tmodel->get_by_id($id);
		$o = new Outputview();
		if($row){

		//memastikan kembali inputan
		if($val['form_name']==""){
			$o->success 	= 'false';
			$o->message 	= 'Nama Form Belum disi !';
			$o->elementid	= '#input-nama-form';
			echo $o->result(); 
			return;
		}
		
		if($val['code']==""){
			$o->success 	= 'false';
			$o->message 	= 'Kode Form Belum disi !';
			$o->elementid	= '#input-kode-form';
			echo $o->result(); 
			return;
		}
		
		
		$code = array(
			'code' =>$val['code'],
		);
	
		$exist = $this->tmodel->if_exist($id,$code);
		if($exist){
			$o->success 	= 'false';
			$o->message 	= 'Kode Form Sudah Digunakan !';
			$o->elementid	= '#input-kode-form';
			echo $o->result(); 
			return;
		}
		

		if($val['link']==""){
			$o->success 	= 'false';
			$o->message 	= 'Link URL tidak boleh kosong !';
			echo $o->result(); 
			return;
		}
		
		
		$link = array(
			'link' =>$val['link'],
		);
	
		$exist = $this->tmodel->if_exist($id,$link);
		if($exist){
			$o->success 	= 'false';
			$o->message 	= 'URL "'.$val['link'].'" sudah Di Registrasi sebelumnya! gunakan URL lain';
			$o->elementid	= '';
			echo $o->result(); 
			return;
		}
		
		$this->tmodel->update($id,$val);
		$o->success 	= 'true';
		$o->message	= "Data berhasil di update";
		echo $o->result();
		return;
		
		}else{
			$o->success 	= 'false';
			$o->message	= "Opss..gagal melakukan update!";
			echo $o->result();
			return;
		}	
		
	}
	
	
	// public function refresh_table($token){
		// if($token==$this->_token && $this->_user_id==1){
			// $row = $this->tmodel->get_all();
			
			// $tm = time();
			// $this->session->set_userdata('log_registrasi_form',$tm);
			// $x = 0;
			// foreach($row as $val){
				// $idgenerate = _encode_id($val['id'],$tm);
				// $row[$x]['id'] = $idgenerate;
				// $x++;
			// }
			
			// $o= new Outputview();
			// $o->success = 'true';
			// $o->message = $row;
			// echo $o->result();
		// }else{
			// redirect('Auth');
		// }		
	// }
	
	
	public function refresh_table($token){
		if($token==$this->_token && $this->_user_id==1){
			$row = $this->tmodel->json();
			
			//encode id 
			$tm = time();
			$this->session->set_userdata('log_registrasi_form',$tm);
			$x = 0;
			foreach($row['data'] as $val){
				$idgenerate = _encode_id($val['id'],$tm);
				$row['data'][$x]['id'] = $idgenerate;
				$x++;
			}
			
			$o = new Outputview();
			$o->success	= 'true';
			$o->serverside	= 'true';
			$o->message	= $row;
			
			echo $o->result();
			

		}else{
			redirect('Auth');
		}
	}
	
	
	public function delete_multiple(){
		$data=$this->input->get('data_ajax',TRUE);
		$val=json_decode($data,TRUE);
		$data = explode(',',$val['data_delete']);

		//get key generate
		$log_id = $this->session->userdata('log_registrasi_form');
		$xx=0;
		foreach($data as $value){
			$value =  _decode_id($value,$log_id);
			//menganti ke id asli
			$data[$xx] = $value;
			$xx++;	
		}
		
		$this->tmodel->delete_multiple($data);
		
		
		
		$o = new Outputview();
		$o->success = 'true';
		$o->message = 'Registrasi URL / FORM di hapus';
		echo $o->result();
	}
	
	
	public function getfunction($token){
		if($token==$this->_token && $this->_user_id==1){
			$data = $this->input->get('data_ajax',true);
			$val  = json_decode($data,true);
			
			$ar= array();
				$this->load->file(APPPATH.'/controllers/'.$val['folder'].'/'.$val['name'].'.php');
				$ar = get_class_methods($val['name']);		

			//mencegah methode ini di tampilkan
			$x=0;
			foreach($ar as $key=>$val){
				if($val=='__construct' || $val=='get_instance'){
					unset($ar[$x]);
				}
				$x++;
			}
			
			$o = new Outputview();
			$o->success = 'true';
			$o->message = $ar;
			 
			echo $o->result();
		}else{
			redirect('Auth');
		}
	}

	public function get_file($token){
		if($token==$this->_token && $this->_user_id==1){
			$data = $this->input->get('data_ajax',true);
			$val  = json_decode($data,true);
			
			$d_map;
			// if($val['name']=='parent'){
				// $d_map = directory_map(APPPATH.'/controllers/',true);
			// }else{
				$d_map = directory_map(APPPATH.'/controllers/'.$val['name'].'/');
			// }
			
			$url_parent=array();
			$x=0;
			foreach($d_map as $key=>$val){
				//mencegah index html di tampilkan
				if($val !=="index.html" ){
					
					$name = str_replace('.php',"",$val);
					if(substr($name,-1)!==DIRECTORY_SEPARATOR && $name !=='auth'){
						$aname = explode('_',$name);
						//mencegah file config di tampilkan
						if(count($aname)>1){
							if($aname[count($aname)-1]!=='config'){
								$url_parent[$x] = $name;
								$x++;
							}
						}else{
								$url_parent[$x] = $name;
								$x++;
						}
						
					
					}
				
				}
			}
			
			$o = new Outputview();
			$o->success = 'true';
			$o->message = $url_parent;
			echo $o->result();
		}else{
			redirect('Auth');
		}

	}
	
	
}	