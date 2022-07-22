<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Outputapi {
   public $success,$message,$token_request_name ,$token_request_value;
   private $CI;
   

   public function __construct() {
		   $this->CI = &get_instance();
           $this->success='';
           $this->message='';
		   $this->token_request_name		= 	$this->CI->security->get_csrf_token_name();
		   $this->token_request_value		=   $this->CI->security->get_csrf_hash();
   }
   
    public function reset_variable(){
		   $this->success='';
           $this->message='';
           $this->token_request_name='';
		   $this->token_request_value='';
	}
   
  
    public function result(){
		$r = json_encode($this);
		$this->reset_variable();
       return  $r;
   }
   
   
   
   
   
   
}
