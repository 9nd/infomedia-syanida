<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LogActivity {
   
   private $CI;
   
   public function activity(){
	  $this->CI = &get_instance();

	  if($this->CI->session->userdata('idlogin')){

		//url bypass 
		$url = 	$this->detection_link();
		
		$word = array(
					'api/Public_Access/get_logo_template',
					'YbsService/get_picture_profile',
					'YbsService/get_picture',
					'YbsService/combobox_data',
					'api/Public_Access/get_logo_title_bar',
					'api/Public_Access/jqr',
					'api/Public_Access/bot',
					'api/Public_Access/get_logo_login',
					'/refresh_table/',
					'Service_Upload/clear_temp/',
					);
		
		$pass=false;	
		foreach($word as $val){
			if(strpos($url,$val) !== false){
				$pass=true;
			}
			
		}				
		
		if($pass==true){
			return;
		}
		  
		$this->CI->load->model('sys/User_Log_detail_model','tdetail_activity');
		$d = array(
				'id_login'			=> 	$this->CI->session->userdata('idlogin'),
				'url_access'		=>	$url,
				'type_request'		=>  $this->detection_type_req(),
				'os_access'			=>  $this->detection_os(),
				'ip_address_access'	=>	$this->detection_ip(),
				'time_access'		=>  time(),
		); 
		  
		  
		  $this->CI->tdetail_activity->insert($d);
	  }
	  

   }
   
   
  



private function detection_browser(){
		if ($this->CI->agent->is_browser())
		{
				$agent = $this->CI->agent->browser().' '.$this->CI->agent->version();
		}
		elseif ($this->CI->agent->is_robot())
		{
				$agent = $this->CI->agent->robot();
		}
		elseif ($this->CI->agent->is_mobile())
		{
				$agent = $this->CI->agent->mobile();
		}
		else
		{
				$agent = $_SERVER['HTTP_USER_AGENT'];
		}

		return $agent;
	}
	
	private function detection_ip(){
		return $this->CI->input->ip_address();
	}
	private function detection_os(){
		return $this->CI->agent->platform(); // Platform info (Windows, Linux, Mac, etc.)
	}

	private function detection_link(){
		return base_url(). uri_string();
	}
	private function detection_data_post(){
		return $this->CI->input->post(NULL,TRUE);
	}
	private function detection_data_get(){
		return $this->CI->input->get(NULL,TRUE);
	}
	private function detection_type_req(){
		return $this->CI->input->method();
	}
	private function detection_time_request(){
		return $this->CI->input->request_headers();
	}



  
}
