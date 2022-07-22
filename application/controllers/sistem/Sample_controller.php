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
class Sample_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
		$data =array(
			'title_page_big'				=> 'Sample',
			'link_refresh_table'			=> site_url().'sistem/Sample_controller/refresh_table',
			'link_create'					=> site_url().'sistem/Sample_controller/create',
			'link_delete'					=> site_url().'sistem/Sample_controller/delete_multiple',
			'link_update'					=> site_url().'sistem/Sample_controller/update',
		);
		
		$this->template->load('sistem/List_empty',$data);
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
