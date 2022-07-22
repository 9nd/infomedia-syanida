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
class Message extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
		$data =array(
			//'title_page_big'				=> 'Message',
			'link_refresh_table'			=> site_url().'sistem/Message/refresh_table'.$this->_token,
			'link_create'					=> site_url().'sistem/Message/create',
			'link_delete'					=> site_url().'sistem/Message/delete_multiple',
			'link_update'					=> site_url().'sistem/Message/update',
		);
		
		$this->template->load('sistem/Message/Message_form',$data);
    }
	
	public function create(){
		
	}
	
	public function create_action(){
		
	}
	
	public function update($id){
		
	}
	
	public function update_action(){
		
	}
	
	public function delete_multiple(){
		
	}
	
	public function refresh_table(){
		
	}
	

}
