<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_system extends CI_Controller {

    function __construct(){
        parent::__construct();
    }
	
	public function index(){
		
	}
	
	public function style(){
		$data = array();
		$data['title_page_big'] = "Pengaturan Template";
		$data['link_update_login_setting'] = site_url().'sistem/Template_system/update_login_setting/'.$this->_token;
		$data['link_update_template_setting'] = site_url().'sistem/Template_system/update_template_setting/'.$this->_token;
		$data['link_set_login_style']	= site_url().'sistem/Template_system/set_login_style/'.$this->_token;
		$this->template->load("sistem/Pengaturan_template_system",$data);
	}
	
	public function set_login_style($token){
		if($token ==$this->_token && $this->_user_id==1){
			$data = $this->input->post("data_ajax",TRUE);
			$val =json_decode($data,TRUE);
			
			$i= './application/config/config_ybs.php';
					
			if( !file_exists($i) ) die("File not found");
			$content= file_get_contents($i);

			$nc = str_replace("\$config['login_style']='".$this->_appinfo['login_style']."';",
								"\$config['login_style']='".$val['login_style']."';",$content);
			write_file($i,$nc);						
			
			$o = new Outputview();
			$o->success="true";
			$o->message=	$val['login_style'] ." berhasil di set"; 
			echo $o->result();
			
		}else{
			redirect("Auth");	
		}	
	}
	
	public function update_login_setting($token){
		if($token ==$this->_token && $this->_user_id==1){
			
			$data = $this->input->post("data_ajax",TRUE);
			$val =json_decode($data,TRUE);
			
				$row="";
				$this->load->model('sys/Sys_service_storage_model','tstor');
				$row = $this->tstor->get_file_temp_bytime($this->_user_id,$val['login_logo']);
				
				$path_source="";
				$path_dest="";
				
				if($row){
					$path_source = "./temp_upload/".$row->name;
					$val['ext'] = strtolower($val['ext']);
					if($val['ext'] !==".png" && $val['ext'] !==".jpg" && $val['ext'] !==".svg" && $val['ext'] !==".jpeg" ){
						$val['ext'] =".png";
					}
					$path_dest   = "./images/logo/login".$val['ext'];
				}
				
				
				try{
					
					if(is_file($path_source)){
						copy($path_source,$path_dest);
					}
					
					$i= './application/config/config_ybs.php';
					
					if( !file_exists($i) ) die("File not found");
					$content= file_get_contents($i);

					$nc = str_replace("\$config['login_title_bar']='".$this->_appinfo['login_title_bar']."';",
										"\$config['login_title_bar']='".$val['login_title_bar']."';",$content);
										
					$nc1 = str_replace("\$config['login_title_box']='".$this->_appinfo['login_title_box']."';",
										"\$config['login_title_box']='".$val['login_title_box']."';",$nc);					
							
					$nc2 = $nc1;			
					if($val['login_logo'] !==""){
						$nc2 = str_replace("\$config['login_logo']='".$this->_appinfo['login_logo']."';",
										"\$config['login_logo']='login".$val['ext']."';",$nc1);			
					}					
										
					$nc3 = str_replace("\$config['login_logo_size']='".$this->_appinfo['login_logo_size']."';",
										"\$config['login_logo_size']='".$val['login_logo_size']."';",$nc2);
										
										
					$nc4 = str_replace("\$config['login_label_user']='".$this->_appinfo['login_label_user']."';",
										"\$config['login_label_user']='".$val['login_label_user']."';",$nc3);	
					
					$nc5 = str_replace("\$config['login_label_password']='".$this->_appinfo['login_label_password']."';",
										"\$config['login_label_password']='".$val['login_label_password']."';",$nc4);	

					$nc6 = str_replace("\$config['login_label_button']='".$this->_appinfo['login_label_button']."';",
										"\$config['login_label_button']='".$val['login_label_button']."';",$nc5);											
					
					write_file($i,$nc6);
				
					
				} catch(Exception $e) {
					$o = new Outputview();
					$o->success="false";
					$o->message="Error". $e->message; 
					echo $o->result();
					return;
				}
				
				
				
			
			
			
			
			
			$o = new Outputview();
			$o->success="true";
			$o->message="Data Berhasil di simpan"; 
			echo $o->result();
		
			
			
		}else{
			redirect("Auth");
		}
	}
	
	
	public function update_template_setting($token){
		if($token ==$this->_token && $this->_user_id==1){
		$data = $this->input->post("data_ajax",FALSE);
		$data = str_replace(["script","'","delete","update","insert","fetch"],"",$data);
		$val =json_decode($data,TRUE);
			
				$row="";
				$this->load->model('sys/Sys_service_storage_model','tstor');
				$row = $this->tstor->get_file_temp_bytime($this->_user_id,$val['template_logo']);
				
				$path_source="";
				$path_dest="";
				
				if($row){
					$path_source = "./temp_upload/".$row->name;
					$val['ext'] = strtolower($val['ext']);
					if($val['ext'] !==".png" && $val['ext'] !==".jpg" && $val['ext'] !==".svg" && $val['ext'] !==".jpeg" ){
						$val['ext'] =".png";
					}
					$path_dest   = "./images/logo/logo".$val['ext'];
				}
				
				
				try{
					
					if(is_file($path_source)){
						copy($path_source,$path_dest);
					}
					
					$i= './application/config/config_ybs.php';
					
					if( !file_exists($i) ) die("File not found");
					$content= file_get_contents($i);

					$nc = str_replace("\$config['template_title_bar']='".$this->_appinfo['template_title_bar']."';",
										"\$config['template_title_bar']='".$val['template_title_bar']."';",$content);
											
					
					$nc1 = $nc;			
					if($val['template_logo'] !==""){
						$nc1 = str_replace("\$config['template_logo']='".$this->_appinfo['template_logo']."';",
										"\$config['template_logo']='logo".$val['ext']."';",$nc);			
					}							
					
					$nc2 = str_replace("\$config['template_logo_size']='".$this->_appinfo['template_logo_size']."';",
										"\$config['template_logo_size']='".$val['template_logo_size']."';",$nc1);
										
					$nc3 = str_replace("\$config['template_footer_left']='".$this->_appinfo['template_footer_left']."';",
										"\$config['template_footer_left']='".$val['template_footer_left']."';",$nc2);	
					
					$nc4 = str_replace("\$config['template_footer_right']='".$this->_appinfo['template_footer_right']."';",
										"\$config['template_footer_right']='".$val['template_footer_right']."';",$nc3);	

														
					
					write_file($i,$nc4);
				
					
				} catch(Exception $e) {
					$o = new Outputview();
					$o->success="false";
					$o->message="Error". $e->message; 
					echo $o->result();
					return;
				}
				
				
				
			
			
			
			
			
			$o = new Outputview();
			$o->success="true";
			$o->message="Data Berhasil di simpan";
			echo $o->result();

		}else{
			redirect("Auth");
		}
	}
	
	
	
	
	private function change_config($file_name){
		$i= './application/config/config_ybs.php';
			
			if( !file_exists($i) ) die("File not found");
			$content= file_get_contents($i);

			$nc = str_replace("\$config['login_logo']='".$this->_appinfo['login_logo']."';",
								"\$config['login_logo']='$file_name';",$content);
			
			write_file($i,$nc);
	}
	
	
	
}