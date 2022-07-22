<?php
class Keamanan extends CI_Controller {

    public function __construct() {
        parent::__construct();
      	$this->load->library('user_agent');
    }

    public function error_report() {
		$i= './file_sec/debug';
		$check="";
		if( !file_exists($i) ) die("File not found");
		$content= file_get_contents($i);
		
		if($content=='on'){
			$check = "checked";
		}else{
			$content="off";
		}
	
		$data = array(
			'title_page_big'			=> 'Enabled / Disabled Reporting',
			'link_change_report'		=> site_url().'sistem/keamanan/toggled_error_report',
			'select_reset'				=> $check, 
			'value'						=> $content,
		);
		
		$this->template->load('sistem/keamanan/Error_Report',$data);
	}
	
	

	
	public function csrf_protection(){
		$i= './file_sec/csrf';
		$check="";
		if( !file_exists($i) ) die("File not found");
		$content= file_get_contents($i);
		
		if($content=='on'){
			$check = "checked";
		}else{
			$content="off";
		}
	
		$data = array(
			'title_page_big'			=> 'Enabled / Disabled Csrf_Protection',
			'link_change'				=> site_url().'sistem/Keamanan/toggle_csrf',
			'select_reset'				=> $check, 
			'value'						=> $content,
		);
		
		
		$this->template->load('sistem/keamanan/Csrf_Protection',$data);
	}
	
	
	public function toggle_csrf(){
		$data 	= $this->input->post('data_ajax',true);
		$val	= json_decode($data,true);
		
		$o = new Outputview;
		if($val['token']==$this->_token && $this->_user_id==1){
			//mengambil data index dan melakukan perubahan
			
			$i= './application/config/config.php';
			
			if( !file_exists($i) ) die("File not found");
			$content= file_get_contents($i);
			
			$deb = 'off';
			if($val['reset']=='on'){
				$nc = str_replace("\$config['csrf_protection'] = FALSE;",
								  "\$config['csrf_protection'] = TRUE;",$content);
				$deb='on';				  
			}else{
				$nc = str_replace("\$config['csrf_protection'] = TRUE;",
								  "\$config['csrf_protection'] = FALSE;",$content);
			}
		
			$success1 = write_file('./file_sec/csrf',$deb);			
			$success  = write_file($i,$nc);
		
		    $o->success='true';
			$o->message= 'Settingan di ubah..';
			echo $o->result();
		
		}else{
			redirect('auth');
		}
	}
	
	
	public function access_front_end(){
		$this->load->helper('directory');
		$d_map = directory_map(APPPATH.'/controllers/',1);
		
		$folder_controller = array();
		$file_controller = array();
		$y=0;
		foreach($d_map as $key=>$val){
			//mendapatkan folder controller kecuali folder sistem
			if(substr($val,-1)==DIRECTORY_SEPARATOR  && $val !=='sistem' . DIRECTORY_SEPARATOR
				&& $val !=='api' . DIRECTORY_SEPARATOR){
				$folder_controller[$y]  = str_replace(DIRECTORY_SEPARATOR,'',$val);
				$y++;
			}
			
			//mendapatkan file controller parent
			if( $val !=='Home.php' &&	
				$val !=='index.html' &&
				$val !=='Service_Storage.php' &&	
				$val !=='Service_Upload.php' &&	
				$val !=='YbsService.php' &&					
				substr($val,-1)!==DIRECTORY_SEPARATOR){
				
				$name = str_replace('.php',"",$val);	
				$file_controller[$y]  = $name;
				$y++;
			
			}
		}
		
		
		//get default function routes
		$routes = $this->router->default_controller;
		
		$function = explode('/',$routes);
		$select="index";
		$selected_file = $function[0];
		
		if(count($function)==2){
			$select = $function[1];
		}
		
		
		$data = array();
		$data['title_page_big'] = "Setting Front End";
		$data['file_controller'] = $file_controller;
		$data['folder_controller']=$folder_controller;
		$data['link_getfunction'] =  site_url().'sistem/Keamanan/getfunction/'.$this->_token;
		$data['selected_function'] = $select;
		$data['selected_file']= $selected_file;
		$data['link_setrouter'] = site_url().'sistem/Keamanan/setrouter/'.$this->_token;
		$data['link_back'] = site_url().'sistem/Pengaturan';
		$this->template->load('sistem/keamanan/Front_End',$data);
	}
	
	
	public function getfunction($token){
		if($token==$this->_token && $this->_user_id==1){
			$data = $this->input->get('data_ajax',true);
			$val  = json_decode($data,true);
			
			$ar = array();
		
			if(strtolower($val['file'])=="auth"){
				$ar[0] = "index";
			}else{
				$this->load->file(APPPATH.'/controllers/'.$val['file'].'.php');
				$ar = get_class_methods($val['file']);		

				/////mencegah methode ini di tampilkan
				$x=0;
				foreach($ar as $key=>$val){
					if($val=='__construct' || $val=='get_instance'){
						unset($ar[$x]);
					}
					$x++;
				}
			}
			
			
			$o = new Outputview();
			$o->success = 'true';
			$o->message = $ar;
			echo $o->result();
			
		}else{
			redirect('auth');
		}
	}
	
	
	
	public function setrouter($token){
		if($token ==$this->_token && $this->_user_id==1){
				$data 	= $this->input->post('data_ajax',true);
				$val	= json_decode($data,true);
				
				
				if($val['fc'] !=="" && $val['function'] !=""){
					$function = "";
					$df = strtolower($val['function']);
					
					if($df!=="index"){
						$function = "/".$df;
					}
					
					$new_route = $val['fc'].$function;
					
					$i= './application/config/routes.php';
			
					if( !file_exists($i) ) die("File not found");
					$content= file_get_contents($i);
					
					$def_route = $this->router->default_controller;
				
					$nc = str_replace("\$route['default_controller'] = '".$def_route."';",
										  "\$route['default_controller'] = '".$new_route."';",$content);
								
					$success  = write_file($i,$nc);
					
					$o = new Outputview();
					$o->success = 'true';
					$o->message = 'Front_End Berhasil di update';
					echo $o->result();
					
				}else{
					redirect("auth");
				}
				
				
				
		}else{
			redirect("auth");
		}
	}
	
	
	
	
	
	
	private function detection_browser(){
		if ($this->agent->is_browser())
		{
				$agent = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
				$agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
				$agent = $this->agent->mobile();
		}
		else
		{
				$agent = 'Unidentified User Agent';
		}

		echo $agent;
	}
	
	private function detection_ip(){
		echo $this->input->ip_address();
	}
	private function detection_os(){
		echo $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.)
	}

	private function detection_link(){
		echo base_url(). uri_string();
	}
	private function detection_data_post(){
		echo var_dump($this->input->post(NULL,TRUE));
	}
	private function detection_data_get(){
		echo var_dump($this->input->post(NULL,TRUE));
	}
	private function detection_type_req(){
		echo $this->input->method();
	}
	private function detection_time_request(){
		echo var_dump($this->input->request_headers());
	}
	
	
	
	
	public function toggled_error_report(){
		$data 	= $this->input->post('data_ajax',true);
		$val	= json_decode($data,true);
		
		$o = new Outputview;
		if($val['token']==$this->_token && $this->_user_id==1){
			//mengambil data index dan melakukan perubahan
			
			$i= './index.php';
			if( !file_exists($i) ) die("File not found");
			$content= file_get_contents($i);
			
			$deb = 'off';
			if($val['ereport']=='on'){
				$nc = str_replace("define('ENVIRONMENT', isset(\$_SERVER['CI_ENV']) ? \$_SERVER['CI_ENV'] : 'production');",
								  "define('ENVIRONMENT', isset(\$_SERVER['CI_ENV']) ? \$_SERVER['CI_ENV'] : 'development');",$content);
				$deb='on';				  
			}else{
				$nc = str_replace("define('ENVIRONMENT', isset(\$_SERVER['CI_ENV']) ? \$_SERVER['CI_ENV'] : 'development');",
								  "define('ENVIRONMENT', isset(\$_SERVER['CI_ENV']) ? \$_SERVER['CI_ENV'] : 'production');",$content);
			}
		
			$success1 = write_file('./file_sec/debug',$deb);			
			$success  = write_file($i,$nc);
		
		    $o->success='true';
			$o->message= 'Settingan di ubah..';
			echo $o->result();
		
		}else{
			redirect('auth');
		}
	}
	
	
	
}