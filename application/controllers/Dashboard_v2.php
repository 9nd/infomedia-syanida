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

class Dashboard_v2 extends CI_Controller
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

  public function wallboard_reguler_v2()
  {
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $now = date('Y-m-d');
    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
    }

    $where_jadwal = array("tanggal" => $now);
    $data['jadwal_leader_on_duty'] = date('Y-m-d');
    $data['nama_leader_on_duty'] = "";
    $data['picture_leader_on_duty'] = "default.png";
    $data['jadwal'] = $this->leader_on_duty->get_row($where_jadwal, array("agentid"));
    if ($data['jadwal']) {
      $where_agent = array("agentid" => $data['jadwal']->agentid);
      $data['agent'] = $this->sys_user->get_row($where_agent, array("nama,picture"));
      $data['nama_leader_on_duty'] = $data['agent']->nama;
      $data['picture_leader_on_duty'] = $data['agent']->picture;
    }

    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_reg_v2', $data);
  }
  public function wallboard_reguler_v3()
  {
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $now = date('Y-m-d');
    $tabel = "trans_profiling_daily";
    // $now = '2020-07-20';
    $data['cache_monev_realtime'] = $this->cache_modev_realtime->get_row_array(array("id" => 1));
    if (isset($_GET['start'])) {
      $now = $_GET['start'];

      if ($now != date('Y-m-d')) {
        // $tabel = "trans_profiling";
        // $absen = $this->trans_profiling_daily->live_query(
        //   "SELECT t_absensi.agentid FROM t_absensi LEFT JOIN sys_user a ON a.agentid = t_absensi.agentid WHERE a.kategori='REG' AND DATE(t_absensi.waktu_in) = '$now' AND t_absensi.stts='in' GROUP BY t_absensi.agentid"
        // )->result();
        // $data['cache_monev_realtime']['aval_num'] = count($absen);
        // $data['cache_monev_realtime']['lunch'] = 0;
        // $data['cache_monev_realtime']['idle_num'] = 0;
        // $data['cache_monev_realtime']['toilet'] = 0;
        // $data['cache_monev_realtime']['pray'] = 0;

        $tabel = "trans_profiling_last_month";
        $absen = $this->trans_profiling_daily->live_query(
          "SELECT trans_profiling_last_month.veri_upd FROM trans_profiling_last_month LEFT JOIN sys_user a ON a.agentid = trans_profiling_last_month.veri_upd WHERE a.kategori='REG' AND DATE(trans_profiling_last_month.lup) = '$now' GROUP BY trans_profiling_last_month.veri_upd"
        )->result();
        $data['cache_monev_realtime']['aval_num'] = count($absen);
        $data['cache_monev_realtime']['lunch'] = 0;
        $data['cache_monev_realtime']['idle_num'] = 0;
        $data['cache_monev_realtime']['toilet'] = 0;
        $data['cache_monev_realtime']['pray'] = 0;

      }
    } else {
      $now = date('Y-m-d');
      $tabel = "trans_profiling_daily";
    }
    $where_jadwal = array("tanggal" => $now);
    $data['jadwal_leader_on_duty'] = date('Y-m-d');
    $data['nama_leader_on_duty'] = "";
    $data['picture_leader_on_duty'] = "default.png";
    $data['jadwal'] = $this->leader_on_duty->get_row($where_jadwal, array("agentid"));
    if ($data['jadwal']) {
      $where_agent = array("agentid" => $data['jadwal']->agentid);
      $data['agent'] = $this->sys_user->get_row($where_agent, array("nama,picture"));
      $data['nama_leader_on_duty'] = $data['agent']->nama;
      $data['picture_leader_on_duty'] = $data['agent']->picture;
    }




    $query_trans_profiling = $this->$tabel->live_query(
      "SELECT veri_call,veri_upd,handphone,email,HOUR(lup) as hour_lup FROM $tabel WHERE DATE(lup) = '" . $now . "' AND veri_call=13 "
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

    $query_trans_profiling = $this->$tabel->live_query(
      "SELECT veri_call,veri_upd,handphone,email,HOUR(lup) as hour_lup FROM $tabel WHERE DATE(lup) = '" . $now . "' AND (veri_call=1 OR veri_call= 13 OR veri_call=  3 OR veri_call=  12) "
    );
    $total = array();
    for ($i = 8; $i <= 20; $i++) {
      $total['contacted'][$i] = 0;
    }
    foreach ($query_trans_profiling->result_array() as $th) {
      for ($i = 8; $i <= 20; $i++) {
        if ($th['hour_lup'] == $i) {
          $total['contacted'][$i] = $total['contacted'][$i] + 1;
        }
      }
    }
    $data['contacted'] = $total;
    $query_trans_profiling = $this->$tabel->live_query(
      "SELECT veri_call,veri_upd,handphone,email,HOUR(lup) as hour_lup FROM $tabel WHERE DATE(lup) = '" . $now . "' "
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
      $total['rate_contacted'][$i] = intval(($data['contacted']['contacted'][$i] / $data['grafik_all_call']['all_call'][$i]) * 100);
    }
    $data['rate_contacted'] = $total;

    $data['last_update'] = $this->trans_profiling_daily->get_row(array(), array("*"), array("lup" => "DESC"));


    $data['now'] = $now;
    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_reg_v3', $data);
  }

  public function wallboard_reguler_indri()
  {
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $now = date('Y-m-d');
    $tabel = "v2_trans_profiling_daily";
    // $now = '2020-07-20';
    $data['cache_monev_realtime'] = $this->cache_modev_realtime->get_row_array(array("id" => 1));
    if (isset($_GET['start'])) {
      $now = $_GET['start'];

      if ($now != date('Y-m-d')) {
       

        $tabel = "trans_profiling_last_month";
        $absen = $this->trans_profiling_daily->live_query(
          "SELECT trans_profiling_last_month.veri_upd FROM trans_profiling_last_month LEFT JOIN sys_user a ON a.agentid = trans_profiling_last_month.veri_upd WHERE a.kategori='REG' AND DATE(trans_profiling_last_month.lup) = '$now' GROUP BY trans_profiling_last_month.veri_upd"
        )->result();
        $data['cache_monev_realtime']['aval_num'] = count($absen);
        $data['cache_monev_realtime']['lunch'] = 0;
        $data['cache_monev_realtime']['idle_num'] = 0;
        $data['cache_monev_realtime']['toilet'] = 0;
        $data['cache_monev_realtime']['pray'] = 0;

      }
    } else {
      $now = date('Y-m-d');
      $tabel = "trans_profiling_daily";
    }
    $where_jadwal = array("tanggal" => $now);
    $data['jadwal_leader_on_duty'] = date('Y-m-d');
    $data['nama_leader_on_duty'] = "";
    $data['picture_leader_on_duty'] = "default.png";
    $data['jadwal'] = $this->leader_on_duty->get_row($where_jadwal, array("agentid"));
    if ($data['jadwal']) {
      $where_agent = array("agentid" => $data['jadwal']->agentid);
      $data['agent'] = $this->sys_user->get_row($where_agent, array("nama,picture"));
      $data['nama_leader_on_duty'] = $data['agent']->nama;
      $data['picture_leader_on_duty'] = $data['agent']->picture;
    }




    $query_trans_profiling = $this->$tabel->live_query(
      "SELECT veri_call,veri_upd,handphone,email,HOUR(lup) as hour_lup FROM $tabel WHERE DATE(lup) = '" . $now . "' AND veri_call=13 "
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

    $query_trans_profiling = $this->$tabel->live_query(
      "SELECT veri_call,veri_upd,handphone,email,HOUR(lup) as hour_lup FROM $tabel WHERE DATE(lup) = '" . $now . "' AND (veri_call=1 OR veri_call= 13 OR veri_call=  3 OR veri_call=  12) "
    );
    $total = array();
    for ($i = 8; $i <= 20; $i++) {
      $total['contacted'][$i] = 0;
    }
    foreach ($query_trans_profiling->result_array() as $th) {
      for ($i = 8; $i <= 20; $i++) {
        if ($th['hour_lup'] == $i) {
          $total['contacted'][$i] = $total['contacted'][$i] + 1;
        }
      }
    }
    $data['contacted'] = $total;
    $query_trans_profiling = $this->$tabel->live_query(
      "SELECT veri_call,veri_upd,handphone,email,HOUR(lup) as hour_lup FROM $tabel WHERE DATE(lup) = '" . $now . "' "
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
      $total['rate_contacted'][$i] = intval(($data['contacted']['contacted'][$i] / $data['grafik_all_call']['all_call'][$i]) * 100);
    }
    $data['rate_contacted'] = $total;

    $data['last_update'] = $this->trans_profiling_daily->get_row(array(), array("*"), array("lup" => "DESC"));


    $data['now'] = $now;
    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_reg_v3', $data);
  }
  public function wallboard_wfh_v2()
  {
    $data = array();
    $report = new Wallboard_wfh;
    $data['report'] = $report->run();

    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_wfh_v2', $data);
  }
  public function wallboard_grafik_v2()
  {
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $now = date('Y-m-d');
    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
    }

    $where_jadwal = array("tanggal" => $now);
    $data['jadwal_leader_on_duty'] = date('Y-m-d');
    $data['nama_leader_on_duty'] = "";
    $data['picture_leader_on_duty'] = "default.png";
    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_grafik_v2', $data);
  }
  public function wallboard_moss_v2()
  {
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $now = date('Y-m-d');
    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
    }
    $where_jadwal = array("tanggal" => $now);
    $data['jadwal_leader_on_duty'] = date('Y-m-d');
    $data['nama_leader_on_duty'] = "";
    $data['picture_leader_on_duty'] = "default.png";
    $data['jadwal'] = $this->leader_on_duty->get_row($where_jadwal, array("agentid"));
    if ($data['jadwal']) {
      $where_agent = array("agentid" => $data['jadwal']->agentid);
      $data['agent'] = $this->sys_user->get_row($where_agent, array("nama,picture"));
      $data['nama_leader_on_duty'] = $data['agent']->nama;
      $data['picture_leader_on_duty'] = $data['agent']->picture;
    }

    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_moss_v2', $data);
  }
  public function wallboard_moss_v3()
  {
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $now = date('Y-m-d');
    $data['cache_monev_realtime'] = $this->cache_modev_realtime->get_row_array(array("id" => 2));
    if (isset($_GET['start'])) {
      $now = $_GET['start'];
      if ($now != date('Y-m-d')) {
        $absen = $this->trans_profiling_daily->live_query(
          "SELECT t_absensi.agentid FROM t_absensi LEFT JOIN sys_user a ON a.agentid = t_absensi.agentid WHERE a.kategori='MOS' AND DATE(t_absensi.waktu_in) = '$now' AND t_absensi.stts='in' GROUP BY t_absensi.agentid"
        )->result();
        $data['cache_monev_realtime']['aval_num'] = count($absen);
        $data['cache_monev_realtime']['lunch'] = 0;
        $data['cache_monev_realtime']['idle_num'] = 0;
        $data['cache_monev_realtime']['toilet'] = 0;
        $data['cache_monev_realtime']['pray'] = 0;
      }
    } else {
      $now = date('Y-m-d');
    }
    $where_jadwal = array("tanggal" => $now);
    $data['jadwal_leader_on_duty'] = date('Y-m-d');
    $data['nama_leader_on_duty'] = "";
    $data['picture_leader_on_duty'] = "default.png";
    $data['jadwal'] = $this->leader_on_duty->get_row($where_jadwal, array("agentid"));
    if ($data['jadwal']) {
      $where_agent = array("agentid" => $data['jadwal']->agentid);
      $data['agent'] = $this->sys_user->get_row($where_agent, array("nama,picture"));
      $data['nama_leader_on_duty'] = $data['agent']->nama;
      $data['picture_leader_on_duty'] = $data['agent']->picture;
    }
    $data['layanan_moss'] = $this->layanan_moss->get_results();

    $query_trans_profiling = $this->trans_profiling_verifikasi->live_query(
      "SELECT update_by,no_handpone,email,reason_call,HOUR(lup) as hour_lup, HOUR(tgl_insert) as hour_insert FROM trans_profiling_validasi_mos 
      WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') = '$now'  AND update_by <> 'SYS'
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

    ///log veri///

    $log_veri = $this->trans_profiling->live_query("
SELECT
  date( lup ) as lupna,
  produk_mos,
  count(*) as num
FROM
trans_profiling_validasi_mos 
WHERE
DATE(lup)>=DATE('$now') - INTERVAL 7 DAY
  AND reason_call = 13 
  AND jenis_aktivasi='agent'
GROUP BY
  date(lup),produk_mos
  ORDER BY lup DESC
");
    ///end log veri///
    $data['jumlah_aktivasi'] = 0;
    $data['log_product_moss'] = $log_veri->result();
    if (count($data['log_product_moss']) > 0) {
      foreach ($data['log_product_moss'] as $rev_moss) {
        $pro = $this->product_moss->get_row(array("kode_chanel" => $rev_moss->produk_mos));
        if ($pro) {
          if ($rev_moss->lupna == $now) {
            $data['jumlah_aktivasi'] = $data['jumlah_aktivasi'] + $rev_moss->num;
          }
          $data['revenue'][$rev_moss->lupna] = ($rev_moss->num * $pro->harga) + $data['revenue'][$rev_moss->lupna];
          // echo $rev_moss->lupna . "-" . ($rev_moss->num * $pro->harga) . "<br>";
        }
      }
    }
    // $data['jumlah_aktivasi']=count($data['revenue']);
    $data['revenue'] = array_reverse($data['revenue']);




    $log_veri = $this->trans_profiling->live_query("
    SELECT
    date(lup) as lupna,avg(REPLACE(IF(SUBSTR( tagihan, - 3, 3 ) =  ',00', REPLACE(tagihan, ',00', ''),tagihan), '.', '')) AS textna
     
  FROM
    trans_profiling_validasi_mos 
  WHERE
  DATE(lup)>=DATE('$now') - INTERVAL 7 DAY
    AND reason_call = 13
    GROUP BY
    date(lup)
    ORDER BY lup DESC
");
    ///end log veri///

    $data['log_arpu_moss'] = $log_veri->result();
    if (count($data['log_arpu_moss']) > 0) {
      foreach ($data['log_arpu_moss'] as $rev_moss) {
        $data['arpu'][$rev_moss->lupna] = $rev_moss->textna + $data['arpu'][$rev_moss->lupna];
        // echo $rev_moss->lupna . "-" . ($rev_moss->num * $pro->harga) . "<br>";
      }
    }
    $data['arpu'] = array_reverse($data['arpu']);

    $kemarin = date("Y-m-d", strtotime($now . ' + 5 days'));
    $data['persen_kenaikan_revenue'] = number_format(($data['revenue'][$now] / $data['revenue'][$kemarin]) * 100);
    $data['persen_kenaikan_arpu'] = number_format(($data['arpu'][$now] / $data['arpu'][$kemarin]) * 100);
    if ($data['persen_kenaikan_revenue'] > 100) {
      $data['persen_kenaikan_revenue'] = "+" . ($data['persen_kenaikan_revenue'] - 100);
      $data['style_kenaikan_revenue'] = "primary";
    } else {
      $data['persen_kenaikan_revenue'] = "-" . (100 - $data['persen_kenaikan_revenue']);
      $data['style_kenaikan_revenue'] = "danger";
    }
    if ($data['persen_kenaikan_arpu'] > 100) {
      $data['persen_kenaikan_arpu'] = "+" . ($data['persen_kenaikan_arpu'] - 100);
      $data['style_kenaikan_arpu'] = "primary";
    } else {
      $data['persen_kenaikan_arpu'] = "-" . (100 - $data['persen_kenaikan_arpu']);
      $data['style_kenaikan_arpu'] = "danger";
    }
    $data['last_update'] = $this->trans_profiling_daily->get_row(array(), array("*"), array("lup" => "DESC"));
    $data['now'] = $now;
    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_moss_v3', $data);
  }
  public function wallboard_indibox()
  {
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $now = date('Y-m-d');
    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
    }
    $where_jadwal = array("tanggal" => $now);
    $data['jadwal_leader_on_duty'] = date('Y-m-d');
    $data['nama_leader_on_duty'] = "";
    $data['picture_leader_on_duty'] = "default.png";
    $data['jadwal'] = $this->leader_on_duty->get_row($where_jadwal, array("agentid"));
    if ($data['jadwal']) {
      $where_agent = array("agentid" => $data['jadwal']->agentid);
      $data['agent'] = $this->sys_user->get_row($where_agent, array("nama,picture"));
      $data['nama_leader_on_duty'] = $data['agent']->nama;
      $data['picture_leader_on_duty'] = $data['agent']->picture;
    }
    $data['layanan_moss'] = $this->layanan_moss->get_results();

    $query_trans_profiling = $this->trans_profiling_verifikasi->live_query(
      "SELECT update_by,no_handpone,email,reason_call,HOUR(lup) as hour_lup, HOUR(tgl_insert) as hour_insert FROM trans_profiling_validasi_mos 
      WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') = '$now'  AND sumber = 'IndiBox'
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
    $data['cache_monev_realtime'] = $this->cache_modev_realtime->get_row_array(array("id" => 2));
    ///log veri///


    $kemarin = date("Y-m-d", strtotime("-1 days"));

    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_indibox', $data);
  }
  public function dashboard()
  {

    $view = 'front-end/landing-page/dashboard_v2/dashboard';
    $data['title_page_big']     =   '';
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $data['tllia'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLLSN"));
    $data['tlita'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLAR"));
    $data['tlateu'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLNW"));
    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
    }
    $this->template->load($view, $data);
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
  public function dashboard_v2()
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
    $log_veri = $this->trans_profiling_last_month->live_query("
    SELECT
      date( lup ) as lupna,
      count(*) as num
    FROM
      trans_profiling_monthly 
    WHERE
    DATE(lup)>=DATE(NOW()) - INTERVAL 7 DAY
      AND veri_call = 13 
      $filter_log
    GROUP BY
      date(lup)
      ORDER BY lup DESC
    ");




    $data['log_veri'] = $log_veri->result();
    $this->template->load($view, $data);
  }

  public function wallboard_verified()
  {
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $now = date('Y-m-d');
    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
    }
    $start = $data['start'];
    $end = $data['end'];
    $reguler = $this->trans_profiling->live_query(
      "SELECT count(*) as jumlah,DATE(lup) as day_lup FROM trans_profiling_verifikasi WHERE DATE(lup) >= '" . $start . "' AND DATE(lup) <= '" . $end . "' GROUP BY day_lup "
    );
    $moss = $this->trans_profiling->live_query(
      "SELECT count(*) as jumlah,DATE(lup) as day_lup FROM trans_profiling_validasi_mos 
      WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') >= '$start' AND DATE_FORMAT(tgl_insert ,'%Y-%m-%d') <= '$end' AND reason_call=13 GROUP BY day_lup
      "
    );
    $data['reg'] = $reguler->result_array();

    $data['moss'] = $moss->result_array();

    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_verified', $data);
  }
  public function wallboard_telkom()
  {
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $now = date('Y-m-d');
    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
    }


    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_telkom', $data);
  }
  public function realtime_monev()
  {

    $view = 'front-end/landing-page/dashboard_v2/realtime_monev';
    $data['title_page_big']     =   '';
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $data['tllia'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLLIA"));
    $data['tlita'] = $this->Sys_user_table_model->get_row(array("agentid" => "AR180293"));
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
  public function wallboard_reguler()
  {
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $this->load->model('Custom_model/Monthly_report_monthly_model', 'monthly_report');
    $now = date('Y-m-d');
    $data['tahun'] = date("Y");
    if (isset($_GET['bulan'])) {
      $data['bulan'] = $_GET['bulan'];
    } else {
      $data['bulan'] = date("m") - 2;
    }
    if (isset($_GET['tahun'])) {
      $data['tahun'] = $_GET['tahun'];
    } else {
      $data['tahun'] = date("Y");
    }


    $where_jadwal = array("tanggal" => $now);
    $data['jadwal_leader_on_duty'] = date('Y-m-d');
    $data['nama_leader_on_duty'] = "";
    $data['picture_leader_on_duty'] = "default.png";
    $data['jadwal'] = $this->leader_on_duty->get_row($where_jadwal, array("agentid"));


    $data['datana'] = $this->monthly_report->get_row(array("tahun" => $data['tahun'], "bulan" => $data['bulan']), array("*"));
    // $data['datana'] = $this->monthly_report->get_row(array("tahun"=>$data['tahun'],"bulan"=>$data['bulan']),array("*"));
    $q_wo = $this->trans_profiling->live_query(
      "SELECT
      count(*) as num_wo
  FROM
      dbprofile_validate_forcall_3p
  WHERE
      (
          update_by IS NOT NULL
          AND update_by != 'BARU'
  AND update_by != 'baru'
          AND update_by != ''
      )
  AND ISNULL(lup) "

    );
    $r_wo = $q_wo->row_array();
    $data['wo'] = $r_wo['num_wo'];

    $data['agent_data_1'] = $this->sys_user->get_row(array("agentid" => $data['datana']->agent_1), array("nama,picture"));
    $data['agent_data_2'] = $this->sys_user->get_row(array("agentid" => $data['datana']->agent_2), array("nama,picture"));
    $data['agent_data_3'] = $this->sys_user->get_row(array("agentid" => $data['datana']->agent_3), array("nama,picture"));
    if ($data['jadwal']) {
      $where_agent = array("agentid" => $data['jadwal']->agentid);
      $data['agent'] = $this->sys_user->get_row($where_agent, array("nama,picture"));
      $data['nama_leader_on_duty'] = $data['agent']->nama;
      $data['picture_leader_on_duty'] = $data['agent']->picture;
    }

    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_reg', $data);
  }

  public function wallboard_moss()
  {
    $now = date('Y-m-d');
    $data['tahun'] = date("Y");
    if (isset($_GET['bulan'])) {
      $data['bulan'] = $_GET['bulan'];
$data['bulan'] =$_GET['bulan']+1;
    } else {
      $data['bulan'] = date("m") - 2;
    }

if (isset($_GET['tahun'])) {
      $data['tahun'] = $_GET['tahun'];
    } else {
      $data['tahun'] = date("Y");
    }
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Leader_on_duty_table_model', 'leader_on_duty');
    $now = date('Y-m-d');
    if (isset($_GET['bulan'])) {
      $start = $data['tahun'] . "-" . $data['bulan'] . '-01';
      $end = date("Y-m-t", strtotime($data['tahun'] . "-" . $data['bulan'] . '-' . '01'));
    } else {
      $start = date('Y-m') . '-01';
      $end = date('Y-m-t');
    }
    $kemarin = date("Y-m-d", strtotime($end . "-1 days"));
    $where_jadwal = array("tanggal" => $now);
    $data['jadwal_leader_on_duty'] = date('Y-m-d');
    $data['nama_leader_on_duty'] = "";
    $data['picture_leader_on_duty'] = "default.png";
    $data['jadwal'] = $this->leader_on_duty->get_row($where_jadwal, array("agentid"));
    if ($data['jadwal']) {
      $where_agent = array("agentid" => $data['jadwal']->agentid);
      $data['agent'] = $this->sys_user->get_row($where_agent, array("nama,picture"));
      $data['nama_leader_on_duty'] = $data['agent']->nama;
      $data['picture_leader_on_duty'] = $data['agent']->picture;
    }
    $data['layanan_moss'] = $this->layanan_moss->get_results();

    $query_trans_profiling = $this->trans_profiling_verifikasi->live_query(
      "SELECT update_by,no_handpone,email,reason_call,HOUR(lup) as hour_lup, HOUR(tgl_insert) as hour_insert FROM trans_profiling_validasi_mos 
      WHERE DATE(tgl_insert) >= '$start' AND DATE(tgl_insert) <= '$end'  AND update_by <> 'SYS'
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
    $data['cache_monev_realtime'] = $this->cache_modev_realtime->get_row_array(array("id" => 2));
    ///log veri///
    $log_veri = $this->trans_profiling->live_query("
SELECT
  date( lup ) as lupna,
  produk_mos,
  count(*) as num
FROM
trans_profiling_validasi_mos 
WHERE
DATE(lup)>='$end' - INTERVAL 7 DAY
  AND reason_call = 13 
  AND jenis_aktivasi='agent' 
GROUP BY
  date(lup),produk_mos
  ORDER BY lup DESC
");

    $log_veri_all = $this->trans_profiling->live_query("
SELECT
   produk_mos,
  count(*) as num
FROM
trans_profiling_validasi_mos 
WHERE
DATE(lup) >= '$start' AND DATE(lup) <= '$end'
  AND reason_call = 13 
  AND jenis_aktivasi='agent' 
GROUP BY
  produk_mos
  ORDER BY lup DESC
");
    ///end log veri///
    $data['jumlah_aktivasi'] = 0;
    $data['revenue'] = 0;
    $data['log_product_moss'] = $log_veri_all->result();
    if (count($data['log_product_moss']) > 0) {
      foreach ($data['log_product_moss'] as $rev_moss) {
        $pro = $this->product_moss->get_row(array("kode_chanel" => $rev_moss->produk_mos));
        if ($pro) {
          //if ($rev_moss->lupna >= $start && $rev_moss->lupna <= $end) {
            $data['jumlah_aktivasi'] = $data['jumlah_aktivasi'] + $rev_moss->num;
          //}
          $data['revenue']= ($rev_moss->num * $pro->harga) + $data['revenue'];
          // echo $rev_moss->lupna . "-" . ($rev_moss->num * $pro->harga) . "<br>";
        }
      }
    }

    // $data['jumlah_aktivasi'] = count($data['revenue']);
    // $data['revenue'] = array_reverse($data['revenue']);




    $log_veri = $this->trans_profiling->live_query("
    SELECT
    avg(REPLACE(IF(SUBSTR( tagihan, - 3, 3 ) =  ',00', REPLACE(tagihan, ',00', ''),tagihan), '.', '')) AS textna
     
  FROM
    trans_profiling_validasi_mos 
  WHERE
  DATE(lup) >= '$start' AND DATE(lup) <= '$end'
    AND reason_call = 13
    ORDER BY lup DESC
");
    ///end log veri///

    $data['log_arpu_moss'] = $log_veri->result();
    if (count($data['log_arpu_moss']) > 0) {
      foreach ($data['log_arpu_moss'] as $rev_moss) {
        $data['arpu'] = $rev_moss->textna + $data['arpu'];
        // echo $rev_moss->lupna . "-" . ($rev_moss->num * $pro->harga) . "<br>";
      }
    }
    // $data['arpu'] = array_reverse($data['arpu']);


    $data['persen_kenaikan_revenue'] = number_format(($data['revenue'][$end] / $data['revenue'][$kemarin]) * 100);
    $data['persen_kenaikan_arpu'] = number_format(($data['arpu'][$end] / $data['arpu'][$kemarin]) * 100);
    if ($data['persen_kenaikan_revenue'] > 100) {
      $data['persen_kenaikan_revenue'] = "+" . ($data['persen_kenaikan_revenue'] - 100);
      $data['style_kenaikan_revenue'] = "primary";
    } else {
      $data['persen_kenaikan_revenue'] = "-" . (100 - $data['persen_kenaikan_revenue']);
      $data['style_kenaikan_revenue'] = "danger";
    }
    if ($data['persen_kenaikan_arpu'] > 100) {
      $data['persen_kenaikan_arpu'] = "+" . ($data['persen_kenaikan_arpu'] - 100);
      $data['style_kenaikan_arpu'] = "primary";
    } else {
      $data['persen_kenaikan_arpu'] = "-" . (100 - $data['persen_kenaikan_arpu']);
      $data['style_kenaikan_arpu'] = "danger";
    }
    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_moss_v1', $data);
  }
  public function wallboard_public()
  {
    $data['jadwal_leader_on_duty'] = date('Y-m-d');
    $data['nama_leader_on_duty'] = "";
    $data['picture_leader_on_duty'] = "default.png";
    if (isset($_GET['bulan'])) {
      $data['bulan'] = $_GET['bulan'];
    } else {
      $data['bulan'] = $data['bulan'] = 5;;
    }

    $this->load->view('front-end/landing-page/dashboard_v2/wallboard_public', $data);
  }
}
