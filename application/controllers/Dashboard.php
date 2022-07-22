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
  function get_sshcode(){
    echo sha1('INFOMEDIA#sms_telkom#12312321341#Telkom147#NUSANTARA');
  }
  function get_hascode2(){
    $hash=sha1('INFOMEDIA#123123213#NUSANTARA');
    echo $hash;
  }

  // public function index()
  // {
  //   $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
  //   $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
  //   $now = date('Y-m-d');
  //   $where_jadwal = array("tanggal" => $now);
  //   $data['jadwal_leader_on_duty'] = date('Y-m-d');
  //   $data['nama_leader_on_duty'] = "";
  //   $data['picture_leader_on_duty'] = "default.png";
  //   $data['jadwal'] = $this->leader_on_duty->get_row($where_jadwal, array("agentid"));
  //   if ($data['jadwal']) {
  //     $where_agent = array("agentid" => $data['jadwal']->agentid);
  //     $data['agent'] = $this->sys_user->get_row($where_agent, array("nama,picture"));
  //     $data['nama_leader_on_duty'] = $data['agent']->nama;
  //     $data['picture_leader_on_duty'] = $data['agent']->picture;
  //   }

  //   $this->load->view('front-end/landing-page/dashboard/index', $data);
  // }
  // public function agency()
  // {
  //   $this->load->view('front-end/landing-page/agency/index');
  // }
  // public function get_call_order()
  // {
  //   $data['callorder'] = $this->cache_data->get_row(array("kode" => "CALLORDER"))->value;
  //   $data['connected'] = $this->cache_data->get_row(array("kode" => "CONNECT"))->value;
  //   $data['notconnect'] = $this->cache_data->get_row(array("kode" => "NOTCONNECT"))->value;
  //   echo json_encode($data);
  // }
  // public function wallboard()
  // {
  //   $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
  //   $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
  //   $now = date('Y-m-d');
  //   $where_jadwal = array("tanggal" => $now);
  //   $data['jadwal_leader_on_duty'] = date('Y-m-d');
  //   $data['nama_leader_on_duty'] = "";
  //   $data['picture_leader_on_duty'] = "default.png";
  //   $data['jadwal'] = $this->leader_on_duty->get_row($where_jadwal, array("agentid"));
  //   if ($data['jadwal']) {
  //     $where_agent = array("agentid" => $data['jadwal']->agentid);
  //     $data['agent'] = $this->sys_user->get_row($where_agent, array("nama,picture"));
  //     $data['nama_leader_on_duty'] = $data['agent']->nama;
  //     $data['picture_leader_on_duty'] = $data['agent']->picture;
  //   }

  //   $this->load->view('front-end/landing-page/dashboard/wallboard', $data);
  // }
  // public function wallboard_moss()
  // {
  //   $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
  //   $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
  //   $now = date('Y-m-d');
  //   $where_jadwal = array("tanggal" => $now);
  //   $data['jadwal_leader_on_duty'] = date('Y-m-d');
  //   $data['nama_leader_on_duty'] = "";
  //   $data['picture_leader_on_duty'] = "default.png";
  //   $data['jadwal'] = $this->leader_on_duty->get_row($where_jadwal, array("agentid"));
  //   if ($data['jadwal']) {
  //     $where_agent = array("agentid" => $data['jadwal']->agentid);
  //     $data['agent'] = $this->sys_user->get_row($where_agent, array("nama,picture"));
  //     $data['nama_leader_on_duty'] = $data['agent']->nama;
  //     $data['picture_leader_on_duty'] = $data['agent']->picture;
  //   }

  //   $this->load->view('front-end/landing-page/dashboard/wallboard_moss', $data);
  // }
  // public function wallboard_reguler()
  // {
  //   $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
  //   $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
  //   $now = date('Y-m-d');
  //   $where_jadwal = array("tanggal" => $now);
  //   $data['jadwal_leader_on_duty'] = date('Y-m-d');
  //   $data['nama_leader_on_duty'] = "";
  //   $data['picture_leader_on_duty'] = "default.png";
  //   $data['jadwal'] = $this->leader_on_duty->get_row($where_jadwal, array("agentid"));
  //   if ($data['jadwal']) {
  //     $where_agent = array("agentid" => $data['jadwal']->agentid);
  //     $data['agent'] = $this->sys_user->get_row($where_agent, array("nama,picture"));
  //     $data['nama_leader_on_duty'] = $data['agent']->nama;
  //     $data['picture_leader_on_duty'] = $data['agent']->picture;
  //   }

  //   $this->load->view('front-end/landing-page/dashboard/wallboard_reg', $data);
  // }
  // public function wallboard_reguler_v2()
  // {
  //   $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
  //   $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
  //   $now = date('Y-m-d');
  //   if (isset($_GET['start'])) {
  //     $data['start'] = $_GET['start'];
  //     $data['end'] = $_GET['end'];
  //   } else {
  //     $data['start'] = date('Y-m-d');
  //     $data['end'] = date('Y-m-d');
  //   }

  //   $where_jadwal = array("tanggal" => $now);
  //   $data['jadwal_leader_on_duty'] = date('Y-m-d');
  //   $data['nama_leader_on_duty'] = "";
  //   $data['picture_leader_on_duty'] = "default.png";
  //   $data['jadwal'] = $this->leader_on_duty->get_row($where_jadwal, array("agentid"));
  //   if ($data['jadwal']) {
  //     $where_agent = array("agentid" => $data['jadwal']->agentid);
  //     $data['agent'] = $this->sys_user->get_row($where_agent, array("nama,picture"));
  //     $data['nama_leader_on_duty'] = $data['agent']->nama;
  //     $data['picture_leader_on_duty'] = $data['agent']->picture;
  //   }

  //   $this->load->view('front-end/landing-page/dashboard/wallboard_reg_v2', $data);
  // }
  // public function wallboard_moss_v2()
  // {
  //   $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
  //   $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
  //   $now = date('Y-m-d');
  //   if (isset($_GET['start'])) {
  //     $data['start'] = $_GET['start'];
  //     $data['end'] = $_GET['end'];
  //   } else {
  //     $data['start'] = date('Y-m-d');
  //     $data['end'] = date('Y-m-d');
  //   }
  //   $where_jadwal = array("tanggal" => $now);
  //   $data['jadwal_leader_on_duty'] = date('Y-m-d');
  //   $data['nama_leader_on_duty'] = "";
  //   $data['picture_leader_on_duty'] = "default.png";
  //   $data['jadwal'] = $this->leader_on_duty->get_row($where_jadwal, array("agentid"));
  //   if ($data['jadwal']) {
  //     $where_agent = array("agentid" => $data['jadwal']->agentid);
  //     $data['agent'] = $this->sys_user->get_row($where_agent, array("nama,picture"));
  //     $data['nama_leader_on_duty'] = $data['agent']->nama;
  //     $data['picture_leader_on_duty'] = $data['agent']->picture;
  //   }

  //   $this->load->view('front-end/landing-page/dashboard/wallboard_moss_v2', $data);
  // }
  // public function dashboard()
  // {

  //   $view = 'front-end/landing-page/dashboard/dashboard';
  //   $data['title_page_big']     =   '';
  //   $idlogin = $this->session->userdata('idlogin');
  //   $logindata = $this->log_login->get_by_id($idlogin);
  //   $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
  //   $data['tllia'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLLIA"));
  //   $data['tlita'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLITA"));
  //   $data['tlateu'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLATEU"));
  //   if (isset($_GET['start'])) {
  //     $data['start'] = $_GET['start'];
  //     $data['end'] = $_GET['end'];
  //   } else {
  //     $data['start'] = date('Y-m-d');
  //     $data['end'] = date('Y-m-d');
  //   }
  //   $this->template->load($view, $data);
  // }
}
