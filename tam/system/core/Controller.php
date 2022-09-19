<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2018, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2018, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;
	public $_user_id;
	public $_user_name;
	public $_user_picture;
	public $_user_level_id;
	public $_user_level_name;
	public $_user_form_id;
	public $_user_form_code;
	public $_user_form_name;
	public $_user_form_shortcut;
	public $_is_dashboard;
	public $_token;
	public $_appinfo;
	public $_separator_a;
	public $_router;
	public $_methode_register_name;
	
	
	

	
	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{

		
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
		
		$this->config->load('config_ybs', TRUE);
		$this->_appinfo = $this->config->item("config_ybs");
		$this->_router  = $this->router->default_controller;
		
		header("X-XSS-Protection: 1; mode=block");
		header("X-Powered-By: Block Engine");
		header("X-Frame-Options: DENY");
		header("X-Content-Type-Options: nosniff");
		header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
		
		
		
		
		//jika link di akses melalui halaman login dan memiliki token
			
			if($this->session->has_userdata('token')){
				
				$this->load->model('sys/Authorization','auth');
				
				$this->_token					= 	$this->session->userdata('token');
				
				$logtime   						= 	$this->session->userdata('logtime');
				$data_user 						=   $this->auth->get_user_data($this->_token,$logtime); 		// ----------> request db 1

				if(count($data_user)>0){
					$this->_user_id 			= 	$data_user[0]['id'];
					$this->_user_name 			= 	$data_user[0]['nmuser'];
					$this->_user_level_id 		= 	$data_user[0]['opt_level'];
					$this->_user_level_name		=	$data_user[0]['nmlevel'];
					$this->_user_picture		= 	$data_user[0]['picture'];
					$this->_separator_a			=   "53d25_52e22";
				}else{
					$this->session->set_flashdata('auth_login','Opps..max 1 login per user, anda telah login pada perangkat yang lain');
					$this->session->unset_userdata('token');
					return;
				}	
				
				
			}
			
			$this->is_valid_autform();
		
	}
	
	
		private function is_valid_autform(){

			$data_link = explode('/',uri_string());
			$initial_module="";
			$url_link = uri_string();//"";
		
			if(count($data_link)>3){
				$url_link = $data_link[0] .'/'.$data_link[1].'/'.$data_link[2];
			}

			//menguji link
			$this->load->model('sys/Sys_user_model','tuser');
			$idm = $this->tuser->get_by_id($this->_user_id);
			
	
			
			if($idm==NULL){			
			  

			  if($this->session->userdata('log_logx')==NULL){
				  //$this->session->userdata('log_logx')==NULL adalah nilai ketika usernya berhasil Login, 
				  //OR User login di dua device yang berbeda, 
				  //OR cache browser di clearkan, 
				  //OR user id nya tidak valid
					$msg =  $this->session->flashdata('auth_login');
					if($msg !=='Opps..max 1 login per user, anda telah login pada perangkat yang lain'){
						$this->session->set_flashdata('auth_login','Opps..browser cleaning');
					 }
					 return;
				  
				  
			  }else{
				  //$this->session->userdata('log_logx')!== NULL adalah nilai sebelum melakukan login,
				  //kondisi ini adalah percobaan request tanpa melalui login terlebih dahulu 
				  //atau pada saat halaman login di load
				  
				  
			
		
				 if($url_link=="auth" || $url_link=="" || $url_link=="Auth"){
					 //kondisi saat halaman login di load
					 //mengizinkan proses selanjutnya berjalan
					 return;
				 }else{
					
					//kondisi saat request dilakukan tanpa login terlebih dahulu
					
					//mendapatkan variable routes
					$def_route = $this->router->default_controller;
					$route	   = explode("/",$def_route);

					switch ($data_link[0]){
						
						//////mengecek apakah yang di akses adalah api
						case  "api" :
						
							//memastikan yg di akses api public
							// if(count($data_link)>1){
								// if($data_link[1]=="Public_Access"){
									//////kondisi dimana yang di akses adalah api public
									// return;
								// }else{
									//////kondisi dimana yang di akses bukan api public
									//////sementara di disable dulu
									// redirect("Auth"); 
							//	}
								
							//}else{
								//////kondisi dimana yg diakses hanyalah folder api
								//redirect("Auth"); 
							//}
								return;
						break;
						
						
						
						//mengecek apakah yang di akses adalah routes
						case $route[0] :
							return;
						break;
						
						default :
						redirect("Auth"); 
					}
					 
					 
					 
					
				 }				
				  	
			  }
			  
			  
			}
			
	
	
			
			//Kondisi khusus untuk function refresh_table
			//karena function refresh_table langsung di akses ketika
			//halaman list data di load maka pengecekan otorisasinya
			//berdasarkan url halalam list datanya,,
			//dalam hal ini url refresh_table tidak masuk dalam registrasi
			$s_url = $url_link;
			if(count($data_link)>=3){
				if($data_link[2]=="refresh_table"){
					$s_url = str_replace("/refresh_table","",$s_url);
				}
			}
			
		    $valid = $this->auth->get_idform($s_url);

			
			//jika id form di temukan maka count valid > 0
			if(count($valid)>0){
				

				$this->_user_form_id 		= $valid[0]['id'];
				$this->_user_form_code 		= $valid[0]['code'];
				$this->_user_form_name 		= $valid[0]['form_name'];
				$this->_user_form_shortcut 	= $valid[0]['shortcut'];
				
				$this->load->model('sys/Sys_dashboard_model','model_dashboard');
				$this->_is_dashboard = $this->model_dashboard->is_dashboard($this->_user_form_id,$this->_user_id);	
				
				$valid = $this->auth->is_valid_auth_link($this->_user_level_id,$this->_user_form_id );
				
				if(!$valid){	
					if (!$this->input->is_ajax_request()) {
						$this->session->set_flashdata('auth_form','Opps..  tidak ada otorisasi !');
						redirect($this->agent->referrer());
					}else{
						redirect('sistem/Form_error'); 
					}	
				}else{
					//jika valid
				}	
				
			}else{
			   //Kondisi Ketika User berhasil login yang kemudian 
			   //melakukan Request terhadap URL yang tidak di registrasi
			   //untuk form2 bersifat public namun tetap hanya dapat di akses oleh user login saja..
			   //maka tidak di lakukan action apapun.
			   

			}	
	}
	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}

}
