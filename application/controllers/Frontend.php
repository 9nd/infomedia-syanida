<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form_General
 *
 * @author Dhiya
 */
class Frontend extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
		$this->load->view('front-end/landing-page/agency/index');
    }
	
	
	

		

}
