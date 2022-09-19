<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginHome
 *
 * @Author Dhiya
 */

class Auth extends YBS_Controller {

    private $data;
	public $_old_label_name;
	public $_old_label_pass;

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->data = $this->set_attribute_data();
		
		if($this->session->has_userdata('token')){
			redirect('Home','refresh');
		}
    }

    public function index() {
		$ga = $this->_getpost_all_element();
		if($ga){
			$elname = $this->_get_element_names();
			$elval	= $this->_get_element_values();
			
			$element_iduser 	= _decode_id($elname[1] ,$this->session->userdata('log_logx'));
			$element_passuser 	= _decode_id($elname[2] ,$this->session->userdata('log_logx'));

			$this->data['element_name_iduser'] 		=	$elname[1];
			$this->data['element_name_password']	=	$elname[2]; 
			
			$err_message_username = array(
            'required' => '* nama pengguna tidak boleh kosong'
			);

			$err_message_password = array(
            'required' => '* sandi tidak boleh kosong'
			);
			
			
			$this->form_validation->set_rules($elname[1], 'Username', 'required', $err_message_username);
			$this->form_validation->set_rules($elname[2], 'Password', 'required', $err_message_password);
	
			$this->_old_label_name = $elname[1];
			$this->_old_label_pass = $elname[2];
			
			
			if ($this->form_validation->run() == FALSE) {
				// $this->data['title_bar'] 		= "YBS Application | Log in";
				// $this->load->view('sistem/Login', $this->data);
			       $this->random_view_login();
			}else{

					if($element_iduser !== 10255236585){
						$this->random_view_login();
						return;
					}
					if($element_passuser !== 35258565255){
						$this->random_view_login();
						return;
					}

					$element_value['nmuser'] = $elval[1];
					$element_value['passuser'] = _generate($elval[2]);
					
					
					$this->load->model('sys/Authorization', 'model');
					$data_token = $this->model->get_token($element_value);
					
					if($data_token!==false){
					
						$this->session->set_userdata('token', $data_token['token']);
						$this->session->set_userdata('logtime', $data_token['time']);
						
						//menghapus log_logx sebagai penanda sukses login
						//log_lox ini di baca juga pada core controller
						$this->session->unset_userdata('log_logx');
						$this->session->unset_userdata('login_loop');
						
						//create log login
						$this->load->model('sys/Sys_user_log_model','log_login');
						
						$log_data = array();
						$log_data['id_user'] 		=   $data_token['iduser'];
						$log_data['login_time'] 	=	$data_token['time'];
						$log_data['ip'] 			=	$this->input->ip_address();
						$log_data['browser'] 		=	$this->get_browser_client();
						$log_data['os']				=   $this->agent->platform(); 
						
						$this->log_login->create_log_login($log_data);
						
						$this->session->set_userdata('idlogin',$this->log_login->id);
						
						redirect('Home','refresh');
					}else{
						// dijalankan saat username / password tidak sesuai
						
						if($this->session->has_userdata('login_loop')){
							$x = $this->session->userdata('login_loop');
							$x++;
							
							$this->session->set_userdata('login_loop',$x);
						}else{
							$this->session->set_userdata('login_loop','1');
						}
						
						
						$data = $this->session->userdata('login_loop');
						
						if($data <= 2 ){
							$this->session->set_flashdata('auth_login','opps..User atau Sandi salah. Coba lagi');
						}else if($data > 2 && $data <= 4){
							$this->session->set_flashdata('auth_login','waduh..salah lagi');
						}else if($data > 4 && $data <= 6){
							$this->session->set_flashdata('auth_login','jika tidak berhasil login..hubungi Admin anda..');
						}else if($data ==7){
							$this->session->set_userdata('login_loop',"1");
						}
						
						$this->random_view_login();
					}
					
			}
			
			return;
		}else{
			//di jalankan saat pertama halaman login di panggil
			
			$this->_old_label_name = "";
			$this->_old_label_pass = "";
			$this->random_view_login();
			
			
		}
		
    }
	
	private function random_view_login(){

			$tm = time();
			$this->session->set_userdata('log_logx',$tm);
			$this->data['element_name_iduser'] 		= _encode_id('10255236585',$this->session->userdata('log_logx'));
			$this->data['element_name_password'] 	= _encode_id('35258565255',$this->session->userdata('log_logx'));
			$this->data['link_login']				= site_url('Auth');
			$this->load->view('front-end/login/'.$this->_appinfo['login_style'], $this->data);
	}
	



    private function set_attribute_data() {
        return array(
            'element_name_iduser' => '',
            'element_name_password' => '',
            'element_value_iduser' => '',
            'element_value_password' => '',
            'title_bar' => '',
        );
    }
	
	private function get_browser_client(){
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
				$agent = $_SERVER['HTTP_USER_AGENT'];
		}

		return $agent;
	}

}
