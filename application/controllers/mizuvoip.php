<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class mizuvoip extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        // $this->load->model('Custom_model/Dapros_infomedia_model', 'distribution');
        $this->load->model('Custom_model/Data_lead_model', 'data_lead');
        $this->load->model('Custom_model/Failover_model', 'failover');
        $this->load->model('Custom_model/Campaign_model', 'campaign');
        $this->load->model('Custom_model/Dapros_model', 'dapros');
    }
   
}
