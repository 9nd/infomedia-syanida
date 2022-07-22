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
class Lockscreen extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    // $this->load->model('Custom_model/Cache_data_model', 'cache_data');
    $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
    $this->load->model('Custom_model/Sys_user_log_in_out_table_model', 'Sys_log');
    $this->load->model('sys/Sys_user_log_model', 'log_login');
  }

  public function index()
  {
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $now = date('Y-m-d');
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    if ($idlogin) {
      if (isset($_GET['ket'])) {
        $log_data = array(
          'id_user' => $logindata->id_user,
          'agentid' => $data['userdata']->agentid,
          'ket' => $_GET['ket'],
          'login_time' => date('Y-m-d H:i:s'),
        );
        $this->Sys_log->add($log_data);
        redirect('Lockscreen', 'refresh');
      } else {
        $this->load->view('lockscreen', $data);
      }
    }else{
      redirect('Auth', 'refresh');
    }
  }
  public function login()
  {

    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $this->load->model('sys/Authorization', 'model');
    $post = $this->input->post();
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    if ($post) {
      $data_check = array(
        'nmuser' => $data['userdata']->nmuser,
        'passuser' => _generate($post['password'])
      );
      $data_token = $this->model->is_valid_password($data_check);
      if ($data_token) {

        $log_where = array(
          'id_user' => $logindata->id_user,
          'agentid' => $data['userdata']->agentid,
        );
        $log = $this->Sys_log->get_row($log_where, array("id"), array("id" => "DESC"));
        $log_update = array(
          'logout_time' => date('Y-m-d H:i:s'),
        );
        $this->Sys_log->edit(array("id" => $log->id), $log_update);

        redirect('Home', 'refresh');
      } else {
        redirect('Lockscreen?status=Salah Password', 'refresh');
      }
    } else {
      echo 1;
    }
  }
}
