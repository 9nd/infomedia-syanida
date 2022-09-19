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
class Dashboard extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    // $this->load->model('Custom_model/Cache_data_model', 'cache_data');
    $this->load->model('Custom_model/Tahun_model', 'tahun');
    $this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling_verifikasi');
    $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
    $this->load->model('sys/Sys_user_log_model', 'log_login');
  }

  
  public function wallboard_reguler_v2()
  {
    
    $now = date('Y-m-d');
    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
    }

    $this->load->view('front-end/landing-page/dashboard/wallboard_tam', $data);
  }
  
  public function dashboard()
  {

    $view = 'front-end/landing-page/dashboard/dashboard';
    $data['title_page_big']     =   '';
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $data['tllia'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLLIA"));
    $data['tlita'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLITA"));
    $data['tlateu'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLATEU"));
    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
    }
    $this->template->load($view, $data);
  }
}
