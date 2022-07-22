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

// require APPPATH . "/reports/Wallboard_wfh.php";

class Dashboard_v3 extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    // $this->load->model('Custom_model/Cache_data_model', 'cache_data');
    $this->load->model('Custom_model/Tahun_model', 'tahun');
    $this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling_verifikasi');
    $this->load->model('Custom_model/Trans_profiling_daily_model', 'trans_profiling_daily');
    $this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling');
    $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
    $this->load->model('sys/Sys_user_log_model', 'log_login');
    $this->load->model('Custom_model/Cache_monev_realtime_model', 'cache_modev_realtime');
    $this->load->model('Custom_model/Layanan_moss_model', 'layanan_moss');
    $this->load->model('Custom_model/Status_call_model', 'status_call');
    $this->load->model('Custom_model/Trans_profiling_daily_model', 'trans_profiling_daily');
    $this->load->model('Custom_model/Trans_profiling_monthly_model', 'trans_profiling_monthly');
    // $this->load->model('Custom_model/Trans_profiling_last_month_model', 'trans_profiling_last_month');
    $this->load->model('Custom_model/Trans_profiling_last_month_infomedia_model', 'trans_profiling_last_month');
    $this->load->model('Custom_model/T_produk_moss_model', 'product_moss');
  }


  public function dashboard_v3()
  {

    $view = 'front-end/landing-page/dashboard_v2/dashboard_v2';
    $data['controller'] = $this;
    $data['title_page_big']     =   '';
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
      $tabel = "trans_profiling_last_month";
      $time1 = strtotime('08:00:00');
      $time2 = strtotime('20:00:00');
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
      $tabel = "trans_profiling_daily";
      $time1 = strtotime('08:00:00');
      $time2 = strtotime(DATE('H:i:s'));
    }
    $filter = "";
    switch ($data['userdata']->opt_level) {
      case "8":
        $filter_log = " AND veri_upd='$userdata->agentid' ";
        $view = 'front-end/landing-page/dashboard_v2/dashboard_v2_agent';

        break;
      case "9":
        // $filter=" AND a.tl='$userdata->tl' ";
        // $filter_log=" AND veri_upd='$userdata->agentid' ";
        break;
    }
    $start = $data['start'];
    $end = $data['end'];
    $data['query'] = $this->trans_profiling_last_month->live_query(
      "SELECT
      veri_upd,a.tl,veri_call,
      COUNT(*) as num
      FROM
      $tabel 
        LEFT JOIN sys_user a ON a.agentid = $tabel.veri_upd
      WHERE
        
       a.opt_level=8
      AND a.tl != '-'
      AND a.kategori='REG'
      AND date(lup) >= '$start'
      AND date(lup) <= '$end'
      $filter
      
      GROUP BY
        veri_upd,veri_call
        "
    )->result();
    $data['query_hpemail'] = $this->trans_profiling_last_month->live_query(
      "SELECT
      veri_upd,COUNT(*) as num
      FROM
      $tabel 
        LEFT JOIN sys_user a ON a.agentid = $tabel.veri_upd
      WHERE
        
       a.opt_level=8
      AND a.tl != '-'
      AND a.kategori='REG'
      AND email LIKE '%@%' 
	    AND handphone LIKE '08%'
      AND date(lup) >= '$start'
      AND date(lup) <= '$end'
      AND veri_call='13'
      $filter
      
      GROUP BY
        veri_upd
        "
    )->result();
    $data['query_hponly'] = $this->trans_profiling_last_month->live_query(
      "SELECT
      veri_upd,COUNT(*) as num
      FROM
      $tabel 
        LEFT JOIN sys_user a ON a.agentid = $tabel.veri_upd
      WHERE
        
       a.opt_level=8
      AND a.tl != '-'
      AND a.kategori='REG'
      AND email NOT LIKE '%@%' 
	    AND handphone  LIKE '08%'
      AND date(lup) >= '$start'
      AND date(lup) <= '$end'
      AND veri_call='13'
      $filter
      
      GROUP BY
        veri_upd
        "
    )->result();
    if (count($data['query_hpemail']) > 0) {
      foreach ($data['query_hpemail'] as $row_he) {
        $data['agent'][$row_he->veri_upd]['hpemail'] = $row_he->num;
        $data['hpemail'] = $row_he->num + $data['hpemail'];
      }
    }
    if (count($data['query_hponly']) > 0) {
      foreach ($data['query_hponly'] as $row_he) {
        $data['agent'][$row_he->veri_upd]['hponly'] = $row_he->num;
        $data['hponly'] = $row_he->num + $data['hponly'];
      }
    }
    if (count($data['query']) > 0) {
      foreach ($data['query'] as $row) {
        $data['tl'][$row->tl][$row->veri_call] = $data['tl'][$row->tl][$row->veri_call] + $row->num;
        $data['tl'][$row->tl]['oc'] = $data['tl'][$row->tl]['oc'] + $row->num;
        $data['tl'][$row->tl]['underteam'][$row->veri_upd] = 1;
        $data['agent'][$row->veri_upd][$row->veri_call] = $row->num;
        $data['agent'][$row->veri_upd]['oc'] = $data['agent'][$row->veri_upd]['oc'] + $row->num;

        if ($row->veri_call == 13) {
          $data['peformance'][$row->veri_upd] = $row->num;
        }

        $data['oc'] = $row->num + $data['oc'];
        $data['status_call'][$row->veri_call] = $data['status_call'][$row->veri_call] + $row->num;
        $data['status_call_text']["status_call_" . $row->veri_call] = $data['status_call_text']["status_call_" . $row->veri_call] + $row->num;
        $data['status_call_text_agent'][$row->veri_upd]["status_call_" . $row->veri_call] = $data['status_call_text_agent'][$row->veri_upd]["status_call_" . $row->veri_call]  + $row->num;
      }
    }
    $contacted = array(1, 13, 3, 12, 11);
    $uncontacted = array(15, 9, 8, 4, 7, 10, 14, 2);

    $data['contacted'] = $data['status_call'][1] + $data['status_call'][13] + $data['status_call'][3] + $data['status_call'][12] + $data['status_call'][11];
    $data['other_data_agent']['contacted'] = $data['agent'][$userdata->agentid][1] + $data['agent'][$userdata->agentid][13] + $data['agent'][$userdata->agentid][3] + $data['agent'][$userdata->agentid][12] + $data['agent'][$userdata->agentid][11];
    $data['uncontacted'] = $data['status_call'][15] + $data['status_call'][9] + $data['status_call'][8] + $data['status_call'][4] + $data['status_call'][7] + $data['status_call'][10] + $data['status_call'][14] + $data['status_call'][2];
    $data['other_data_agent']['uncontacted'] = $data['agent'][$userdata->agentid][15] + $data['agent'][$userdata->agentid][9] + $data['agent'][$userdata->agentid][8] + $data['agent'][$userdata->agentid][4] + $data['agent'][$userdata->agentid][7] + $data['agent'][$userdata->agentid][10] + $data['agent'][$userdata->agentid][14] + $data['agent'][$userdata->agentid][2];
    // $data['oc'] = array_sum($data['query']);
    $status_call = $data['status_call_text'];
    $status_call_agent = $data['status_call_text_agent'][$userdata->agentid];
    arsort($status_call_agent);
    arsort($status_call);
    arsort($data['peformance']);
    $data['status_rating'] = array_slice($status_call, 0, 7);
    $data['status_rating_agent'] = array_slice($status_call_agent, 0, 7);
    $data['agent_rating'] = array_slice($data['peformance'], 0, 7);
    $data['best_agent'] = array_slice($data['peformance'], 0, 1);

    $duration = round(abs($time2 - $time1) / 3600, 2);
    $data['duration'] = round(abs($time2 - $time1) / 3600, 2);
    $data['cph'] = intval(($data['oc'] / count($data['agent'])) / $duration);
    $data['cph_persen'] = number_format(($data['cph'] / 100) * 100, 2);
    $data['cph_agent'] = intval($data['agent'][$userdata->agentid]['oc'] / $duration);
    $data['cph_agent_persen'] = number_format(($data['cph_agent'] / 100) * 100, 2);
    $data['target'] = count($data['agent']) * 110;
    $data['target_persen'] = number_format(($data['status_call'][13] / $data['target']) * 100, 2);
    $data['target_agent'] = 110;
    $data['target_agent_persen'] = number_format(($data['agent'][$userdata->agentid][13] / $data['target_agent']) * 100, 2);
    // $data['cph_persen'] = 50;
    // echo $data['cph_persen'];



    ////grafik MOSS//
    $query_trans_profiling = $this->trans_profiling_verifikasi->live_query(
      "SELECT update_by,no_handpone,email,reason_call,HOUR(lup) as hour_lup, HOUR(tgl_insert) as hour_insert FROM trans_profiling_validasi_mos 
      WHERE 
      date(tgl_insert) >= '$start' 
      AND date(tgl_insert) <= '$end' 
      "
    );
    for ($i = 0; $i <= 23; $i++) {
      $data['grafik']['Verified'][$i] = 0;
      $data['grafik']['Waiting'][$i] = 0;
    }
    foreach ($query_trans_profiling->result_array() as $th) {
      for ($i = 0; $i <= 23; $i++) {
        if ($th['reason_call'] == 13) {
          if ($th['hour_lup'] == $i) {
            $data['grafik']['Verified'][$i] = $data['grafik']['Verified'][$i] + 1;
          }
        }
        if ($th['reason_call'] == 15 || $th['reason_call'] == 9 || $th['reason_call'] == 8 || $th['reason_call'] == 4 || $th['reason_call'] == 7 || $th['reason_call'] == 11 || $th['reason_call'] == 10 || $th['reason_call'] == 14 || $th['reason_call'] == 2) {
          if ($th['hour_lup'] == $i) {
            $data['grafik']['Not Contacted'][$i] = $data['grafik']['Not Contacted'][$i] + 1;
          }
        }
        if ($th['hour_lup'] == $i) {
          $data['grafik']['Waiting'][$i] = $data['grafik']['Waiting'][$i] + 1;
        }
      }
    }

    ///end grafik moss//

    ////grafik reguler//
    $query_trans_profiling = $this->trans_profiling_last_month->live_query(
      "SELECT veri_call,veri_upd,handphone,email,HOUR(lup) as hour_lup 
      FROM $tabel WHERE 
      DATE(lup) >= '" . $start . "' AND  DATE(lup) <= '" . $end . "' AND veri_call=13 "

    );
    $total = array();
    for ($i = 8; $i <= 20; $i++) {
      $total['verified'][$i] = 0;
    }
    foreach ($query_trans_profiling->result_array() as $th) {
      for ($i = 8; $i <= 20; $i++) {
        if ($th['hour_lup'] == $i) {
          $total['verified'][$i] = $total['verified'][$i] + 1;
        }
      }
    }
    $data['grafik_verified'] = $total;

    $query_trans_profiling = $this->trans_profiling_last_month->live_query(
      "SELECT veri_call,veri_upd,handphone,email,HOUR(lup) as hour_lup 
      FROM $tabel WHERE DATE(lup) >= '" . $start . "' AND  DATE(lup) <= '" . $end . "'
      AND (veri_call=1 OR veri_call= 13 OR veri_call=  3 OR veri_call=  12) "
    );
    $total = array();
    for ($i = 8; $i <= 20; $i++) {
      $total['grafik_contacted'][$i] = 0;
    }
    foreach ($query_trans_profiling->result_array() as $th) {
      for ($i = 8; $i <= 20; $i++) {
        if ($th['hour_lup'] == $i) {
          $total['grafik_contacted'][$i] = $total['grafik_contacted'][$i] + 1;
        }
      }
    }
    $data['grafik_contacted'] = $total;
    $query_trans_profiling = $this->trans_profiling_last_month->live_query(
      "SELECT veri_call,veri_upd,handphone,email,HOUR(lup) as hour_lup 
      FROM $tabel WHERE DATE(lup) >= '" . $start . "' AND  DATE(lup) <= '" . $end . "' "
    );
    $total = array();
    for ($i = 8; $i <= 20; $i++) {
      $total['all_call'][$i] = 0;
    }
    foreach ($query_trans_profiling->result_array() as $th) {
      for ($i = 8; $i <= 20; $i++) {
        if ($th['hour_lup'] == $i) {
          $total['all_call'][$i] = $total['all_call'][$i] + 1;
        }
      }
    }
    $data['grafik_all_call'] = $total;
    for ($i = 8; $i <= 20; $i++) {
      $total['rate_contacted'][$i] = intval(($data['grafik_contacted']['grafik_contacted'][$i] / $data['grafik_all_call']['all_call'][$i]) * 100);
    }
    $data['rate_contacted'] = $total;
    ///end grafik reguler

    $data['cache_monev_realtime'] = $this->cache_modev_realtime->get_row_array(array("id" => 1));

    ////break ///
    $aux_status = $this->trans_profiling_last_month->live_query("
    SELECT
    sys_user.agentid,sys_user.tl,ket,
      
      sum(TIMESTAMPDIFF( SECOND, sys_user_log_in_out.login_time, sys_user_log_in_out.logout_time )) AS aux 
    FROM
      sys_user_log_in_out
      JOIN sys_user ON sys_user.id = sys_user_log_in_out.id_user 
    WHERE
      DATE( sys_user_log_in_out.login_time ) >= '" . $start . "' AND
      DATE( sys_user_log_in_out.login_time ) <= '" . $end . "' 
      AND sys_user_log_in_out.login_time  <= TIMESTAMP(DATE( sys_user_log_in_out.login_time ),'17:00:00') 
      AND sys_user_log_in_out.login_time  >= TIMESTAMP(DATE( sys_user_log_in_out.login_time ),'08:00:00') 
      AND sys_user_log_in_out.logout_time IS NOT NULL 
      AND sys_user.kategori = 'REG' 
      AND sys_user.tl != '-' 
      AND sys_user.opt_level = 8 
    GROUP BY
    sys_user.agentid,sys_user_log_in_out.ket
    ");
    foreach ($aux_status->result_array() as $r_aux) {
      $data['break']['agent'][$r_aux['agentid']] = $data['break']['agent'][$r_aux['agentid']] + $r_aux['aux'];
      $data['break']['agent'][$r_aux['agentid']]['total'] = $data['break']['agent'][$r_aux['agentid']]['total'] + $r_aux['aux'];
      $data['break']['agent'][$r_aux['agentid']][$r_aux['ket']] = $data['break']['agent'][$r_aux['agentid']][$r_aux['ket']] + $r_aux['aux'];
      $data['break']['tl'][$r_aux['tl']] = $data['break']['tl'][$r_aux['tl']] + $r_aux['aux'];
      $data['break'][$r_aux['ket']] = $data['break'][$r_aux['ket']] + $r_aux['aux'];
      $data['break']['total'] = $data['break']['total'] + $r_aux['aux'];
    }
    $data['break']['total'] = $data['break']['total'] / 60;
    $data['break']['max'] = count($data['agent']) * 75;
    $data['break']['max_agent'] = 75;
    $data['break']['break_persen'] = number_format(($data['break']['total'] / $data['break']['max']) * 100, 2);
    $data['break']['break_agent_persen'] = number_format(($data['break']['agent'][$userdata->agentid]['total'] / $data['break']['max_agent']) * 100, 2);
    /// end break ///

    ///log veri///
    $log_veri = $this->log_veri($filter_log);
    $data['log_veri'] = $log_veri->result();

    $this->template->load($view, $data);
  }

  function log_veri($param)
  {
    $log_veri = $this->trans_profiling_last_month->live_query("
    SELECT
      date( lup ) as lupna,
      count(*) as num
    FROM
      trans_profiling_monthly 
    WHERE
    DATE(lup)>=DATE(NOW()) - INTERVAL 7 DAY
      AND veri_call = 13 
      $param
    GROUP BY
      date(lup)
      ORDER BY lup DESC
    ");
    return $log_veri;
  }

  function get_periode($time, $your_date, $table)
  {
    if ($time == 'today') {
      $timeSQL = ' Date($your_date)= CURDATE()';
    }
    if ($time == 'week') {
      $timeSQL = ' YEARWEEK($your_date)= YEARWEEK(CURDATE())';
    }
    if ($time == 'month') {
      $timeSQL = ' Year($your_date)=Year(CURDATE()) AND Month(`your_date`)= Month(CURDATE())';
    }
    $Sql = "SELECT * FROM  $table WHERE " . $timeSQL;
    return $Result = $this->db->query($Sql)->result_array();
  }
}
