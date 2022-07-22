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
class Analitics_moss extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Custom_model/Tahun_model', 'tahun');
    $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
    $this->load->model('sys/Sys_user_log_model', 'log_login');
    $this->load->model('Custom_model/Layanan_moss_model', 'layanan_moss');
    $this->load->model('Custom_model/Status_call_model', 'status_call');
    $this->load->model('Custom_model/T_produk_moss_model', 'product_moss');
    $this->load->model('Custom_model/Cdr_model', 'cdr');
    $this->load->model('Custom_model/Cdr_daily_model', 'cdr_daily');
    $this->load->model('Custom_model/Cdr_last_month_model', 'cdr_last_month');
    $this->load->model('Custom_model/Recording_daily_model', 'recording_daily');
    $this->load->model('Custom_model/Trans_profiling_validasi_mos_model', 'validasi_mos');
    $this->load->model('Custom_model/Trans_profiling_daily_model', 'trans_profiling_daily');
  }
  public function analitics()
  {
    $view = 'analitics_moss/analitics';
    $data['controller'] = $this;
    $data['title_page_big']     =   '';
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $data['agent'] = $this->Sys_user_table_model->get_results(array("opt_level" => 8, "kategori" => "MOS", "tl !=" => "-"));

    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
    }


    $response['peformance'] = $this->get_peformance($data['start'], $data['end']);
    $response['status_breakdown'] = $this->get_status_breakdown($data['start'], $data['end']);

    // echo "<br>";
    $response['last_update'] = $this->trans_profiling_daily->get_row(array(), array("*"), array("lup" => "DESC"));

    $response['start'] = $data['start'];
    $response['end'] = $data['end_tgl'];
    $response['controller'] = $this;
    $this->load->view($view, $response);
  }
  function get_peformance($start, $end)
  {
    $data_peformance = $this->validasi_mos->live_query("SELECT
      count( idx ) AS oc,
      sum(
      IF
      ( reason_call IN ( 1, 13, 3, 12, 11 ), 1, 0 )) AS contacted,
      sum(
      IF
      ( reason_call IN ( 15, 9, 8, 4, 7, 10, 14, 2 ), 1, 0 )) AS not_contacted,
      sum(
    IF
    ( reason_call = 13, 1, 0 )) AS numna ,
    SUM(
      IF
    ( (keterangan NOT LIKE '%galmit%' OR keterangan NOT LIKE '%gagal submit%'),TIMESTAMPDIFF(SECOND, tgl_insert, lup),0)
      ) AS slg ,
    SUM(
      IF
    ( (keterangan NOT LIKE '%galmit%' OR keterangan NOT LIKE '%gagal submit%'),TIMESTAMPDIFF(SECOND, tgl_insert, click_time),0)
    ) AS slfc
    
    FROM
    trans_profiling_validasi_mos 
    WHERE
    DATE(tgl_insert) >= '$start'
    AND DATE(tgl_insert) <= '$end'
    AND update_by <> 'SYS'
    ")->row();
    $data['summary_performance'] = $data_peformance;
    return $data;
  }
  function get_status_breakdown($start, $end)
  {
    $status_breakdown = $this->validasi_mos->live_query("SELECT
     reason_call, count( idx ) AS numna
    FROM
    trans_profiling_validasi_mos 
    WHERE
    DATE(tgl_insert) >= '$start'
    AND DATE(tgl_insert) <= '$end'
    AND update_by <> 'SYS'
    GROUP BY reason_call
    ORDER BY count( idx ) DESC
    ")->result();
    $data['status_breakdown'] = $status_breakdown;
    return $data;
  }

  function waktu_format($seconds)
  {
    $hours = floor($seconds / 3600);
    $mins = floor($seconds / 60 % 60);
    $secs = floor($seconds % 60);
    $timeFormat = sprintf('%02d:%02d', $mins, $secs);
    return $timeFormat;
  }
}
