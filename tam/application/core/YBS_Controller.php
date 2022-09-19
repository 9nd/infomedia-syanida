<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SerialGen
 *
 * @author Dhiya
 */
class YBS_Controller extends CI_Controller {

    private $delimeter = "(++++++)";
    private $elements_name = '';
    private $elements_value = '';


    public function __construct() {
             parent::__construct();
    }
	
	function _get_initial_module(){
				$arr = explode("/",uri_string());
					if(count($arr)>1){
						return $arr[0]."/";
					}
				return "";
	}

    public function _generateData($str = "ssmxs") {
        $info = getdate();
        $first = $info['seconds'] * 77;
        $end = $info['seconds'] * 35;
        $step1 = base64_encode(rand(1000, 5000) . $first . $str . $end);
        return $step1;
    }


    public function _getpost($element_name) {
        if ($element_name == NULL) {
            return $this->input->post(NULL,TRUE);
        } else {
            return $this->input->post($element_name,TRUE);
        }
    }

    public function _getpost_all_element() {
		
        $data = $this->_getpost(NULL);
        foreach ($data as $key => $value) {
            $this->elements_name = $this->elements_name . $this->delimeter . $key;
			$xx = $this->security->xss_clean($this->elements_value);
            $this->elements_value = $xx . $this->delimeter . $value;
        }
		return $data;
    }
	


    public function _get_element_names() {
        return explode($this->delimeter, $this->elements_name);
    }

    public function _get_element_values() {
        return explode($this->delimeter, $this->elements_value);
    }

	
	
	
}
