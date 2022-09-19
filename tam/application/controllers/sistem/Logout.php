<?php

//include 'SerialGen.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginHome
 *
 * @author Dhiya
 */
class Logout extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->library('session');
        
    }

    public function index() {
        $this->logout();
    }

    

	private function logout(){
		//create log logout
		$idlogin = 	$this->session->userdata('idlogin');

		$this->load->model('sys/Sys_user_log_model','log_login');
		$this->log_login->create_log_logout($idlogin);
		
         $this->session->sess_destroy();
		 redirect('Auth', 'refresh');
    }
  

}
