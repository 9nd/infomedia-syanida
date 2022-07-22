<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Template {

    var $template_data = array();
	private $username="";
	private $idlevel ="";
	private $nmlevel="";
	private $CI;

	
	function load($view, $view_data = array(), $return = FALSE) {
        $template = 'sistem/Template';
		$this->CI = & get_instance();
		
		 //memastikan jika user telah login,di tandai dengan adanya token
		 //fungsi ini tidak di simpan di controller karena akan menyebabkan loop saat melakukan redirect ke controller auth

		  if (!$this->CI->session->has_userdata('token')) {
			  $msg =  $this->CI->session->flashdata('auth_login');
			  if($msg !=='Opps..max 1 login per user, anda telah login pada perangkat yang lain'){
				//Di eksekusi saat browser di clear
				$this->CI->session->set_flashdata('auth_login','Opps..browser cleaning');
			  }
			 redirect('auth', 'refresh');
		  }	 else{

			 ////memastikan jika token valid/terdaftar ,mencegah token di isi manual
			 $token = $this->CI->session->userdata('token');
			 $logtime  = $this->CI->session->userdata('logtime');
			 
			 $valid = $this->CI->auth->is_valid_token($token,$logtime);
			 
			 if($valid=='false'){
				redirect('auth', 'refresh');	
			 }
		  
		 }

			
			//menyiapkan view_data dengan sisipan data
			$view_data = $this->_prepare_data($view_data);
				
			//jika yg di $view hanya berisi nama file view,tidak disi dalam bentuk array 
            if(!is_array($view)){
				$this->template_data['content_body'] = $this->CI->load->view($view, $view_data, TRUE);
			}else{
				foreach ($view as $key => $value) {
					if (!empty($value)) {
						$this->template_data[$key] = $this->CI->load->view($view[$key], $view_data, TRUE);
					}
				}
			}

		$id_user  		= $this->CI->_user_id;
		
		
		//id group server = 1
		$is_server = "false";
		
		if($id_user=="1"){
			$is_server = "true";
		}

		
	
		$ff = substr($_SERVER['SCRIPT_NAME'],1,strlen($_SERVER['SCRIPT_NAME']));
		$ff = str_replace("/index.php","",$ff);
		$fp = str_replace("index.php","",$ff);
		
		$this->template_data['is_server']				= $is_server;	
		$this->template_data['menu']					= $this->create_menu();
		$this->template_data['menu_notify_security']	= $this->create_notify_security();
		$this->template_data['fparent']					= $fp; //digunakan untuk mendeteksi jika app berada dalam subfolder	
		return $this->CI->load->view($template, $this->template_data, $return);
		
    }
	


	
	function _prepare_data($view_data){
		
		if(!is_array($view_data)){
			$view_data['title_page_big'] = '';
			$view_data['title_page_small'] = '';
		}else{
			
			if(element('title_page_big',$view_data)==NULL){
				$view_data['title_page_big'] = '';
			}
			if(element('title_page_small',$view_data)==NULL){
				$view_data['title_page_small'] = '';
			}
		}
		return $view_data;
	}
	

	
	function create_menu(){
		  $this->CI 				= & get_instance();
		  $this->CI->load->model('sys/Sys_authorized_menu_model','auth_menu');
		  
		  $mm['auth_menu']			= $this->CI->auth_menu;	
		  return $this->CI->load->view('sistem/Menu',$mm,TRUE);
	}
	
	function create_notify_security(){
		 $this->CI = & get_instance();
		 $result="";
		 //memastikan hanya user configurator yang dapat melihat menu ini
		 if($this->CI->_user_id=='1'){
			$mc =0;
			
			
			
			
			
			$msg="";
				//notify Debug enabled
				$i= './file_sec/debug';
				if(file_exists($i) ){ 
					$content= file_get_contents($i);
					if($content=='on'){
							$msg .='<a href="#" class="dropdown-item d-flex">
								    <span class="avatar mr-3 align-self-center" style="background-image: url('.base_url().'YbsService/get_picture_profile/'.$this->CI->_token .')"></span>
								    <div>
									 <div class="small text-muted"><i class="fe fe-alert-triangle text-red">  Error Report is Enable, Danger for production</i> </div>
									
								    </div>
								    </a>';
							$mc	= $mc + 1;	
					}
				}

		
			
		
			 $str_o ='<div class="dropdown d-none d-md-flex">
						<a class="nav-link icon icon-shake-jump" data-toggle="dropdown">
						<i class="fe fe-alert-triangle text-red"> </i>
						<span class="nav-unread-message ">'.$mc.'</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">';
						
			$str_c='	</div>
					</div>';
					
			if($mc==0){
				$result = "";	
			}else{
				$result = $str_o . $msg . $str_c;	
			}
		
				
			 
			 
		 }
		 return $result;
	}
	

	

}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */