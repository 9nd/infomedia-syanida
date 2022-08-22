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
class Analitics extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
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
    $this->load->model('Custom_model/Trans_profiling_last_month_model', 'trans_profiling_last_month');
    $this->load->model('Custom_model/T_produk_moss_model', 'product_moss');
    $this->load->model('Custom_model/Cdr_model', 'cdr');
    $this->load->model('Custom_model/Cdr_daily_model', 'cdr_daily');
    $this->load->model('Custom_model/Recording_daily_model', 'recording_daily');
    $this->load->model('Custom_model/Monthly_report_monthly_model', 'monthly_report');
  }
  public function locationna()
  {
?>
    <html>

    <head>
      <title> Google Maps API: Mengubah Latitude Longitude Menjadi Alamat dengan Geocoder </title>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArzOgrCZ3XQYr1quYyucFr0Vs424P9DPg&callback=initialize" async defer></script>
      <script type="text/javascript">
        function initialize() {
          var latlng = {
            lat: -6.262581048548821,
            lng: 106.86614602804184
          };
          var geocoder = new google.maps.Geocoder;
          geocoder.geocode({
            'location': latlng
          }, function(results, status) {
            if (status === 'OK') {
              if (results[0]) {
                rs = results[0].formatted_address;
              } else {
                rs = 'No results found';
              }
            } else {
              rs = 'Geocoder failed due to: ' + status;
            }
            alert(rs);
          });
        }
      </script>
    </head>

    <body> </body>

    </html>
<?php
  }
  function dayNumber($date = '')
  {
    if ($date == '') {
      $t = date('d-m-Y');
    } else {
      $t = date('d-m-Y', strtotime($date));
    }

    $dayName = strtolower(date("D", strtotime($t)));
    $dayNum = strtolower(date("d", strtotime($t)));
    $return = floor(($dayNum - 1) / 7) + 1;
    return $return;
  }



  public function summary_report()
  {
    $view = 'analitics/summary_report';
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

    $post = $this->input->get();
    $data['controller'] = $this;
    $data['title_page_big'] =   '';
    $data['monthly_target'] = 200000;
    $bulan = date('m');
    $tahun = date('Y');
    $tahun_now=date('Y');
    if (isset($post['tahun']) && $post['tahun'] < $tahun_now) {
      $tahun = $post['tahun'];
      $bulan = 12;
    }
    $data['target'] = $bulan * $data['monthly_target'];
    $contacted = array(1, 13, 3, 12, 11);
    $uncontacted = array(15, 9, 8, 4, 7, 10, 14, 2);
    $day = 22;
    $target = 110;
    $office_hours = 8;
    // $data['agent_online'] = 64;
    $filter_condition = "";
    $data['condition'] = 1;
    if (isset($post['condition']) && $post['condition'] == 2) {
      $filter_condition = " AND sys_user.tl != '-' ";
      $data['condition'] = 2;
    }
    $data['last_update'] = $this->trans_profiling_daily->live_query(
      "SELECT
        last_update
      FROM
        summary_trans_profiling 
      LIMIT 1
      "
    )->row()->last_update;

    $data['agent_online'] = $this->Sys_user_table_model->get_count(array("kategori" => "REG", "opt_level" => 8));

    //SUMMARY REPORT YTD///
    if ($data['condition'] == 2) {
      $data['actual_verified'] = $this->trans_profiling_daily->live_query(
        "SELECT
          sum(jumlah) as numna
        FROM
          summary_trans_profiling 
          LEFT JOIN sys_user ON sys_user.agentid = summary_trans_profiling.veri_upd 
        WHERE
          summary_trans_profiling.tahun = $tahun 
          AND summary_trans_profiling.veri_call=13
          AND sys_user.kategori = 'REG'
          AND sys_user.opt_level=8
          $filter_condition
        "
      )->row()->numna;
      $data['monthly_actual_verified'] = $this->trans_profiling_daily->live_query(
        "SELECT
          bulan,sum(jumlah) as numna
        FROM
          summary_trans_profiling 
          LEFT JOIN sys_user ON sys_user.agentid = summary_trans_profiling.veri_upd 
        WHERE
          summary_trans_profiling.tahun = $tahun 
          AND summary_trans_profiling.veri_call=13
          AND sys_user.kategori = 'REG'
          AND sys_user.opt_level=8
          $filter_condition
          GROUP BY bulan
        "
      )->result();
      ///END SUMMARY REPORT YTD///
      ////performance//
      $data['data_perofmance'] = $this->trans_profiling_daily->live_query(
        "SELECT
      summary_trans_profiling.bulan,
      sum( summary_trans_profiling.jumlah ) AS oc,
      SUM(
      IF
      ( summary_trans_profiling.veri_call IN ( 1, 13, 3, 12, 11 ), jumlah, 0 )) AS contacted,
      SUM(
      IF
      ( summary_trans_profiling.veri_call IN ( 15, 9, 8, 4, 7, 10, 14, 2 ), jumlah, 0 )) AS not_contacted,
      SUM(
      IF
      ( summary_trans_profiling.veri_call = 13, jumlah, 0 )) AS numna 
    FROM
      summary_trans_profiling 
      LEFT JOIN sys_user ON sys_user.agentid = summary_trans_profiling.veri_upd 
    WHERE
    summary_trans_profiling.tahun = $tahun 
      AND sys_user.kategori = 'REG' 
      AND sys_user.opt_level = 8 
      $filter_condition
     
    GROUP BY
    summary_trans_profiling.bulan
    ORDER BY summary_trans_profiling.bulan ASC
    "
      )->result();
      $data['summary_peformance'] = array();
      if (count($data['data_perofmance']) > 0) {
        foreach ($data['data_perofmance'] as $fr) {
          $data['summary_peformance'][$fr->bulan]['oc'] = $fr->oc;
          $data['summary_peformance'][$fr->bulan]['contacted'] = $fr->contacted;
          $data['summary_peformance'][$fr->bulan]['not_contacted'] = $fr->not_contacted;
          $data['summary_peformance'][$fr->bulan]['verified'] = $fr->numna;
        }
      }
      //end performance///
    } else {
      $data['actual_verified'] = $this->trans_profiling_daily->live_query(
        "SELECT
          sum(verified) as numna
        FROM
          monthly_report_monthly 
        WHERE
         tahun = $tahun 
        "
      )->row()->numna;
      $data['monthly_actual_verified'] = $this->trans_profiling_daily->live_query(
        "SELECT
          CAST(bulan+1 AS SIGNED) as bulan,verified as numna,co as oc,contacted,not_contacted
        FROM
        monthly_report_monthly 
        WHERE
          tahun = $tahun 
            -- $filter_condition
          GROUP BY bulan
        "
      )->result();
      $data['summary_peformance'] = array();
      if (count($data['monthly_actual_verified']) > 0) {
        foreach ($data['monthly_actual_verified'] as $fr) {
          $data['summary_peformance'][$fr->bulan]['oc'] = $fr->oc;
          $data['summary_peformance'][$fr->bulan]['contacted'] = $fr->contacted;
          $data['summary_peformance'][$fr->bulan]['not_contacted'] = $fr->not_contacted;
          $data['summary_peformance'][$fr->bulan]['verified'] = $fr->numna;
        }
      }
    }


    ///SUMMARY REPORT MTD///
    if (isset($post['tahun']) && $post['tahun'] < $tahun_now) {
      $bulanma=$bulan-1;
       $data['actual_verified_mtd'] = $this->trans_profiling_daily->live_query(
        "SELECT
          verified as numna
        FROM
        monthly_report_monthly 
        WHERE
        monthly_report_monthly.tahun = $tahun 
          AND monthly_report_monthly.bulan=$bulanma
        "
      )->row()->numna;
    } else {
      $data['actual_verified_mtd'] = $this->trans_profiling_daily->live_query(
        "SELECT
          sum(jumlah) as numna
        FROM
          summary_trans_profiling 
          LEFT JOIN sys_user ON sys_user.agentid = summary_trans_profiling.veri_upd 
        WHERE
          summary_trans_profiling.tahun = $tahun 
          AND summary_trans_profiling.bulan=$bulan
          AND summary_trans_profiling.veri_call=13
          AND sys_user.kategori = 'REG'
          AND sys_user.opt_level=8
          $filter_condition
        "
      )->row()->numna;
    }

    $data['monthly_actual_verified_mtd'] = $this->trans_profiling_daily->live_query(
      "SELECT
        date as bulan ,sum(jumlah) as numna
      FROM
        monthly_summary_trans_profiling 
        LEFT JOIN sys_user ON sys_user.agentid = monthly_summary_trans_profiling.veri_upd 
      WHERE
      monthly_summary_trans_profiling.veri_call=13
        AND sys_user.kategori = 'REG'
        AND sys_user.opt_level=8
        $filter_condition
        GROUP BY date
      "
    )->result();
    ///END SUMMARY REPORT MTD///


    ///EKSTRAK///
    $data['verified_perbulan'] = array();
    $data['mtd_verified_perbulan'] = array();
    if (count($data['monthly_actual_verified']) > 0) {
      foreach ($data['monthly_actual_verified'] as $m) {
        $data['verified_perbulan'][$m->bulan] = $m->numna;
      }
    }
    if (count($data['monthly_actual_verified_mtd']) > 0) {
      foreach ($data['monthly_actual_verified_mtd'] as $m) {
        $data['mtd_verified_perbulan'][$m->bulan] = $m->numna;
      }
    }
    $data['persen_kenaikan_verified'] = number_format(($data['verified_perbulan'][$bulan] / $data['verified_perbulan'][$bulan - 1]) * 100);
    $data['mtd_persen_kenaikan_verified'] = number_format(($data['mtd_verified_perbulan'][date('Y-m-d')] / $data['mtd_verified_perbulan'][date('Y-m-d', strtotime("-1 days"))]) * 100);
    if ($data['persen_kenaikan_verified'] > 100) {
      $data['persen_kenaikan_verified'] = "+" . ($data['persen_kenaikan_verified'] - 100);
      $data['style_kenaikan_verified'] = "primary";
    } else {
      $data['persen_kenaikan_verified'] = "-" . (100 - $data['persen_kenaikan_verified']);
      $data['style_kenaikan_verified'] = "danger";
    }
    if ($data['mtd_persen_kenaikan_verified'] > 100) {
      $data['mtd_persen_kenaikan_verified'] = "+" . ($data['mtd_persen_kenaikan_verified'] - 100);
      $data['mtd_style_kenaikan_verified'] = "primary";
    } else {
      $data['mtd_persen_kenaikan_verified'] = "-" . (100 - $data['mtd_persen_kenaikan_verified']);
      $data['mtd_style_kenaikan_verified'] = "danger";
    }
    ///END EKSTRAK///


    $data['tahun'] = $tahun;
    $data['bulan'] = $bulan;
    $this->load->view($view, $data);
  }
  public function weekle_report()
  {
    $date_now = date('Y-m-29');
    $date_now = strtotime($date_now);
    $date = strtotime("-7 day", $date);
    $date2 = strtotime("-7 day", $date);
    $date3 = strtotime("-7 day", $date2);
    $date4 = strtotime("-7 day", $date3);
    echo date('Y-m-d', strtotime('last monday', $date_now));
  }
  public function summary_kpi()
  {
    $view = 'analitics/summary_kpi';
    $post = $this->input->get();
    $data['controller'] = $this;
    $data['title_page_big'] =   '';
    $data['monthly_target'] = 200000;
    $bulan = date('m');
    $tahun = date('Y');
    if (isset($post['year']) && $post['year'] > 0) {
      $tahun = $post['year'];
    }
    if (isset($post['month']) && $post['month'] > 0) {
      $bulan = $post['month'];
    }
    $data['target'] = $bulan * $data['monthly_target'];
    $contacted = array(1, 13, 3, 12, 11);
    $uncontacted = array(15, 9, 8, 4, 7, 10, 14, 2);
    $data['absensi'] = $this->trans_profiling_daily->live_query(
      "SELECT
      DATE( waktu_in )  as tglna,
      count(*) 
    FROM
      `t_absensi`
      LEFT JOIN sys_user ON sys_user.agentid = t_absensi.agentid 
    WHERE
      YEAR( waktu_in ) =  '$tahun' 
      AND MONTH( waktu_in ) = '$bulan' 
      AND stts = 'in' 
      AND sys_user.kategori = 'REG' 
      AND sys_user.opt_level = 8 
      AND sys_user.tl != '-'
      AND methode=1
    GROUP BY
      DATE(waktu_in)
    HAVING count(waktu_in) > 30
      "
    )->result();
    $tanggalna = array();
    $tgl_hk = array();
    $agentna = 0;
    if (count($data['absensi']) > 0) {
      foreach ($data['absensi'] as $absensi) {



        $data['detail_absensi'] = $this->trans_profiling_daily->live_query(
          "SELECT
          t_absensi.agentid,count(*)
        FROM
          t_absensi 
          LEFT JOIN sys_user ON sys_user.agentid = t_absensi.agentid 
        WHERE
          stts = 'in' 
          AND sys_user.kategori = 'REG' 
          AND sys_user.opt_level = 8 
          AND sys_user.tl != '-' 
          AND methode = 1 
          AND DATE( waktu_in ) = '$absensi->tglna' 
          GROUP BY t_absensi.agentid
            "
        )->result();
        $agentna = count($data['detail_absensi']) + $agentna;
        $tanggalna[$absensi->tglna] = count($data['detail_absensi']);
        $tgl_hk[$absensi->tglna] = $tanggalna[$absensi->tglna];
      }
    }
    $day = count($tgl_hk);
    $agent_online = $agentna;
    $target = 110;
    $office_hours = 8;

    $filter_condition = "";
    $data['condition'] = 1;
    $filter_agent = array("kategori" => "REG", "opt_level" => 8);
    if (isset($post['condition']) && $post['condition'] == 2) {
      $filter_condition = " AND sys_user.tl != '-' ";
      $filter_agent['tl !='] = "-";
      $data['condition'] = 2;
      $data['agent_online'] = $agentna;
    } else {
      $data['agent_online'] = 64 * $day;
    }

    if ($data['condition'] == 2) {

      ////performance//
      $data['data_perofmance'] = $this->trans_profiling_daily->live_query(
        "SELECT
      summary_trans_profiling.bulan,
      sum( summary_trans_profiling.jumlah ) AS oc,
      SUM(
      IF
      ( summary_trans_profiling.veri_call IN ( 1, 13, 3, 12, 11 ), jumlah, 0 )) AS contacted,
      SUM(
      IF
      ( summary_trans_profiling.veri_call IN ( 15, 9, 8, 4, 7, 10, 14, 2 ), jumlah, 0 )) AS not_contacted,
      SUM(
      IF
      ( summary_trans_profiling.veri_call = 13, jumlah, 0 )) AS numna 
    FROM
      summary_trans_profiling 
      LEFT JOIN sys_user ON sys_user.agentid = summary_trans_profiling.veri_upd 
    WHERE
    summary_trans_profiling.tahun = $tahun 
      AND sys_user.kategori = 'REG' 
      AND sys_user.opt_level = 8 
      $filter_condition
     
    GROUP BY
    summary_trans_profiling.bulan
    ORDER BY summary_trans_profiling.bulan ASC
    "
      )->result();
      $data['summary_peformance'] = array();
      if (count($data['data_perofmance']) > 0) {
        foreach ($data['data_perofmance'] as $fr) {
          $data['summary_peformance'][$fr->bulan]['oc'] = $fr->oc;
          $data['summary_peformance'][$fr->bulan]['contacted'] = $fr->contacted;
          $data['summary_peformance'][$fr->bulan]['not_contacted'] = $fr->not_contacted;
          $data['summary_peformance'][$fr->bulan]['verified'] = $fr->numna;
        }
      }
      //end performance///
    } else {
      $data['monthly_actual_verified'] = $this->trans_profiling_daily->live_query(
        "SELECT
          CAST(bulan+1 AS SIGNED) as bulan,verified as numna,co as oc,contacted,not_contacted
        FROM
        monthly_report_monthly 
        WHERE
          tahun = $tahun 
          AND CAST(bulan+1 AS SIGNED) = $bulan
            -- $filter_condition
          GROUP BY bulan
        "
      )->result();
      $data['summary_peformance'] = array();
      if (count($data['monthly_actual_verified']) > 0) {
        foreach ($data['monthly_actual_verified'] as $fr) {
          $data['summary_peformance'][$fr->bulan]['oc'] = $fr->oc;
          $data['summary_peformance'][$fr->bulan]['contacted'] = $fr->contacted;
          $data['summary_peformance'][$fr->bulan]['not_contacted'] = $fr->not_contacted;
          $data['summary_peformance'][$fr->bulan]['verified'] = $fr->numna;
        }
      }
    }
    $data['oc'] = $data['summary_peformance'][$bulan]['oc'];
    $data['verified'] = $data['summary_peformance'][$bulan]['verified'];
    $data['contacted'] = $data['summary_peformance'][$bulan]['contacted'];
    $data['rec'] = $this->trans_profiling_daily->live_query(
      "SELECT
      SUM(duration ) AS dur, 
      COUNT(dst ) AS rec, 
        COUNT( DISTINCT dst ) AS numna 
      FROM
        `cdr`
      WHERE
        YEAR ( calldate ) = $tahun AND
        MONTH ( calldate ) = $bulan
    "
    )->row();
    $data['fcc'] = $this->trans_profiling_daily->live_query(
      "SELECT
      dst ,sum(duration),count( dst )
    FROM
      `cdr` 
    WHERE
      YEAR ( calldate ) = $tahun 
      AND MONTH ( calldate ) = $bulan 
    GROUP BY
      dst 
    HAVING count(dst) = 1 AND sum(duration) > 60
    ORDER BY sum(duration) DESC
    "
    )->result();

    $data['cfa'] = ($data['oc'] / $data['agent_online']);
    $data['cfh'] = ($data['oc'] / $data['agent_online']) / 8;
    $data['cfn'] = $data['rec']->rec / $data['rec']->numna;
    $data['aht'] = ($data['rec']->dur / $data['rec']->numna) / 60;
    $data['hitrate'] = ($data['verified'] / ($data['oc'] - $data['verified'])) * 100;
    $data['cvr'] = ($data['verified'] / ($data['oc'])) * 100;
    $data['svr'] = ($data['verified'] / ($data['contacted'])) * 100;
    $data['lcr'] = ($data['contacted'] / ($data['oc'])) * 100;
    $data['ppa'] = (($data['verified'] / $data['agent_online']));
    $data['call_rate'] = $data['rec']->dur / (($data['agent_online'] * $office_hours) * 60);
    $data['ecip'] = ($data['verified'] / $data['monthly_target']) * 100;
    $data['fcc'] = count($data['fcc']);
    $data['tahun'] = $tahun;
    $data['bulan'] = $tahun;
    $this->load->view($view, $data);
  }
  public function kpi()
  {
    $view = 'analitics/kpi';
    $data['controller'] = $this;
    $data['title_page_big']     =   '';
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $data['agent'] = $this->Sys_user_table_model->get_results(array("opt_level" => 8, "kategori" => "REG", "tl !=" => "-"));

    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      $data['end'] = $_GET['end'];
      $data['end_tgl'] = $_GET['end'];
      $table_recording = "cdr";
      $table_trans_profiling = "trans_profiling_last_month";
      $time1 = strtotime('08:00:00');
      $time2 = strtotime('20:00:00');
      $data['end'] = date($data['end'] . ' 23:59:00');
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
      $data['end_tgl'] = date('Y-m-d');
      $table_recording = "recording_daily";
      $table_trans_profiling = "trans_profiling_daily";
      $time1 = strtotime('08:00:00');
      $time2 = strtotime(DATE('H:i:s'));
      $data['end'] = date('Y-m-d H:i:s');
    }
    // echo $data['end'];
    // $data['end'] = $last_recording->calldate;
    $time2 = strtotime(date("H:i:s", strtotime($data['end'])));
    $duration = abs($time2 - $time1);
    $duration_2 = round(abs($time2 - $time1) / 3600, 2);
    ////DAPROS SESSION
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
    $wo = $r_wo['num_wo'];


    //PEFORMANCE SESSION
    $summary_peformance = $this->summary_peformance($data['start'], $data['end'], $userdata);
    $detail_no_hp_veri = $this->$table_trans_profiling->get_results_array(array('veri_call' => 13, 'DATE(lup) >=' => $data['start'], 'lup <=' => $data['end']), array("handphone"));
    $no_hp_veri = array_values($detail_no_hp_veri['results']);
    //RECORDING SESSION//
    $ext_agent = $this->get_ext($data['agent'], $data['start']);
    $query_total_hit = $this->recording_daily->live_query(
      "
      select dst,count(*) as num FROM $table_recording WHERE DATE(calldate) >= '" . $data['start'] . "'
      AND calldate <= '" . $data['end'] . "'
      GROUP BY dst
      "
    );
    $data['total_dial_by_number'] = $query_total_hit->num_rows();
    $data['sum_dial'] = $this->$table_recording->get_sum(array("DATE(calldate) >=" => $data['start'], "calldate <=" => $data['end']), "duration");
    $data['count_dial'] = $this->$table_recording->get_count(array("DATE(calldate) >=" => $data['start'], "calldate <=" => $data['end']));

    $first_call_close = $this->trans_profiling_daily->live_query("
      SELECT
        dst
      FROM
      $table_recording 
      WHERE DATE(calldate) >= '" . $data['start'] . "'
      AND calldate <= '" . $data['end'] . "'
      GROUP BY
        dst 
      HAVING
        COUNT( DISTINCT uniqueid ) >1
    ");
    $call_close = $this->trans_profiling_daily->live_query("
      SELECT
      dst,COUNT( DISTINCT uniqueid ) AS countmid 
      FROM
      $table_recording 
      WHERE DATE(calldate) >= '" . $data['start'] . "'
      AND calldate <= '" . $data['end'] . "'
      GROUP BY
        dst 
      HAVING
        COUNT( DISTINCT uniqueid ) >0
    ");
    $sum_call = 0;
    if (count($call_close->result_array()) > 0) {
      foreach ($call_close->result_array() as $call_close_s) {
        $sum_call = $sum_call + $call_close_s['countmid'];
      }
    }

    $no_hp_fcc = array_values($first_call_close->result_array());

    ////BREAK SESSION
    $afk = $this->get_afk($data['start'], $data['end'], $userdata);
    /**********effetive time **********/
    $data['effective_time'] = $this->get_effective_time($table_trans_profiling, $table_recording);
    // echo $data['effective_time']['total']['aht_sum']."/".$data['effective_time']['total']['aht_count'];
    $response['aht'] = number_format(($data['effective_time']['total']['aht_sum'] / $data['effective_time']['total']['aht_count']) / 60, 2);

    /**********end effetive time **********/
    $response['agent_online'] = count($summary_peformance['agent']);

    $data['oncallrate'] = ($data['sum_dial'] / 60) / ((($duration * $response['agent_online']) / 60) - $afk['total']) * 100;
    $data['firstcallclose'] = count(array_intersect_assoc($no_hp_veri, $no_hp_fcc));
    $data['avg_call_per_account'] = number_format($sum_call / count($call_close->result_array()), 2);
    $data['list_closure_rate'] = number_format(($summary_peformance['contacted'] / $summary_peformance['oc']) * 100, 2);

    $response['verified'] = ($summary_peformance['status_call'][13]);
    $response['contacted'] = ($summary_peformance['contacted']);
    $response['cvr'] = number_format(($summary_peformance['status_call'][13] / $summary_peformance['contacted']) * 100, 2);
    $response['list_call'] = ($wo + $summary_peformance['oc']);
    $response['oc'] = $summary_peformance['oc'];
    $response['dial'] = $summary_peformance['oc'];
    $response['not_contacted'] = $summary_peformance['uncontacted'];
    $response['close_lead'] = ($summary_peformance['oc'] - $summary_peformance['status_call'][13]);
    $response['hitrate_close'] = number_format(($summary_peformance['status_call'][13]) / ($summary_peformance['oc'] - $summary_peformance['status_call'][13]) * 100);
    $response['hitrate_used'] = number_format((($summary_peformance['status_call'][13]) / $summary_peformance['oc']) * 100, 2);
    $response['lcr'] = number_format(($summary_peformance['contacted'] / ($wo + $summary_peformance['oc'])) * 100, 2);
    $response['on_call_rate'] = number_format($data['oncallrate'], 2);
    $response['firstcallclose'] = $data['firstcallclose'];
    $response['avg_call_per_account'] = $data['avg_call_per_account'];
    $response['avg_call_length'] = number_format($data['aht'], 2);
    $response['status_rating'] = $summary_peformance['status_rating'];

    $response['call_per_hours'] = $summary_peformance['cph'];
    $response['ppa'] = number_format($response['verified'] / $response['agent_online'], 2);
    ///// LOG SESSION
    $data['log_call'] = $this->get_log_call();

    //// END LOG SESSION///
    $data['list_periode'] = new DatePeriod(
      new DateTime(date('Y-m-d', strtotime(date('Y-m-d') . "-7 days"))),
      new DateInterval('P1D'),
      new DateTime(date('Y-m-d'))
    );
    foreach ($data['list_periode'] as $key => $value) {

      $tgl = $value->format('Y-m-d');

      $response['log_veri'][$tgl] = $data['log_call']['log_veri'][$tgl];
      $response['log_contacted'][$tgl] = $data['log_call']['log_contacted'][$tgl];
      $response['log_not_contacted'][$tgl] = $data['log_call']['log_not_contacted'][$tgl];
      $response['log_oc'][$tgl] = $data['log_call']['log_oc'][$tgl];
    }



    ///// DAPROS///
    ////DAPROS//
    $data['query_dapros'] = $this->trans_profiling->live_query(
      "SELECT count(*) as jumlah_data FROM dbprofile_validate_forcall_3p WHERE
  (ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '')
  AND (ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '') AND
status = 0 
  "
    );
    $data_dapros = $data['query_dapros']->row_array();
    $response['dapros'] = $data_dapros['jumlah_data'];

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
    $response['wo'] = $r_wo['num_wo'];


    ////TL ///
    $response['tl'] = $summary_peformance['tl'];
    $response['agent'] = $summary_peformance['agent'];
    $response['duration'] = $duration_2;

    ///// END TL ///

    /////AGENT STATUS///
    $response['agent_status_break'] = $this->agent_status($data['start'], $data['end'], $response['agent']);

    ////END AGENT STATUS///

    ////PEAK HOUR///
    $response['peak_hours'] = $this->peak_hours($table_trans_profiling, $data['start'], $data['end']);
    ////END PEAK HOURS///

    //// GENERAL DATA////
    $response['general_data'] = $this->general_data($data['start'], $data['end']);
    //// END GENERAL DATA///
    $response['arpu'] = $this->grade($table_trans_profiling, $data['start'], $data['end']);

    /////REGIONAL//
    $response['regional'] = $this->regional($table_trans_profiling, $data['start'], $data['end']);
    ///END REGIONAL//

    // echo "<br>";
    $response['last_update'] = $this->trans_profiling_daily->get_row(array(), array("*"), array("lup" => "DESC"));
    $response['all_agent'] = $data['agent']['num'];
    $response['start'] = $data['start'];
    $response['end'] = $data['end_tgl'];
    $response['controller'] = $this;
    $this->load->view($view, $response);
  }

  // function get_verified_quality($trans_profiling_daily = 'trans_profiling_daily', $tabel_recording = 'recording_daily', $start, $end)
  function get_verified_quality($trans_profiling_daily = 'trans_profiling_daily', $tabel_recording = 'recording_daily', $start, $end, $agentid = false)
  {
    $filter_agent = "";
    if ($agentid) {
      $filter_agent = " AND veri_upd = '$agentid' ";
    }
    $data['no_hp'] = $this->trans_profiling_daily->live_query("
      select handphone,no_speedy,veri_upd,
      count(*) AS num FROM $trans_profiling_daily WHERE DATE(lup) >= '$start' AND DATE(lup) <= '$end' AND veri_call=13  
      $filter_agent
      GROUP BY
      handphone
    ")->result();
    $response = array();
    if (count($data['no_hp']) > 0) {
      foreach ($data['no_hp'] as $row_veri) {
        $rec = $this->trans_profiling_daily->live_query("
            select dst,count(*) AS num,SUM(duration) AS sumna FROM $tabel_recording WHERE dst = '61$row_veri->handphone' AND
            DATE(calldate) >= '$start' AND DATE(calldate) <= '$end' GROUP BY dst
          ")->row();
        $fralertinput = $this->trans_profiling_daily->live_query("	
          select count(DISTINCT no_handphone) AS hitung FROM t_fraud_alert_check WHERE no_handphone = '$row_veri->handphone' 	
        ")->row();

        if ($fralertinput->hitung == "0") {
          $number_lain = $this->trans_profiling_verifikasi->live_query("
        select no_speedy FROM trans_profiling_verifikasi WHERE no_handpone = '$row_veri->handphone' AND no_speedy <> '$row_veri->no_speedy'
        ")->num_rows();
        }
        /***********SUMMARY */
        $response['fraudinput_count'] = $fralertinput->hitung + $response['fraudinput_count'];
        $response['rec_count'] = $rec->num + $response['rec_count'];
        $response['rec_sum'] = $rec->sumna + $response['rec_sum'];
        $response['dup'] = $number_lain + $response['dup'];
        // echo $row_veri->handphone . "<br>";
        // echo "count : " . $rec->num . " | sum : " . $rec->sumna . " | dup : " . $number_lain . "<br>";

        /*******AGENT */
        $response[$row_veri->veri_upd]['count'] = $rec->num + $response[$row_veri->veri_upd]['count'];
        $response[$row_veri->veri_upd]['sum'] = $rec->sumna + $response[$row_veri->veri_upd]['sum'];
        $response[$row_veri->veri_upd]['dup'] = $number_lain + $response[$row_veri->veri_upd]['dup'];
        $response[$row_veri->veri_upd]['detail'][$row_veri->handphone]['çount'] = $rec->num;
        $response[$row_veri->veri_upd]['detail'][$row_veri->handphone]['sum'] = $rec->sumna;
        $response[$row_veri->veri_upd]['detail'][$row_veri->handphone]['dup'] = $number_lain;

        //****HANDPHONE */
        $response['rec_hp'][$row_veri->handphone]['çount'] = $rec->num;
        $response['rec_hp'][$row_veri->handphone]['sum'] = $rec->sumna;
        $response['rec_hp'][$row_veri->handphone]['dup'] = $number_lain;
        $response['rec_hp'][$row_veri->handphone]['agentid'] = $row_veri->veri_upd;
      }
    }

    return $response;
  }
  public function kpi_agent()
  {
    $view = 'analitics/kpi_agent';
    $data['controller'] = $this;
    $data['title_page_big']     =   '';
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    // $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => 231));
    $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    // $userdata = $this->Sys_user_table_model->get_row(array("id" => 231));
    $data['agent'] = $this->Sys_user_table_model->get_results(array("opt_level" => 8, "kategori" => "REG", "tl !=" => "-"));
    $response['last_update'] = $this->trans_profiling_daily->get_row(array(), array("*"), array("lup" => "DESC"));

    $data['start'] = date('Y-m-d');
    $data['end'] = date('Y-m-d');
    $start = date('Y-m-d');
    $end = date('Y-m-d');
    $data['end_tgl'] = date('Y-m-d');
    $table_recording = "recording_daily";
    $table_trans_profiling = "trans_profiling_daily";
    $time1 = strtotime('08:00:00');
    $time2 = strtotime(DATE('H:i:s'));
    $data['end'] = date('Y-m-d H:i:s');
    $time2 = strtotime(date("H:i:s", strtotime($data['end'])));
    $duration = abs($time2 - $time1);
    $response['duration_2'] = round(abs($time2 - $time1) / 3600, 2);
    $response['last_veri'] = $this->trans_profiling_daily->get_row(array("veri_upd" => $userdata->agentid, "veri_call" => 13), array("*"), array("lup" => "ASC"));
    $response['ext'] = $this->$table_recording->get_row(array("dst" => "61" . $response['last_veri']->handphone))->src;
    $summary_peformance = $this->summary_peformance($data['start'], $data['end'], $userdata, $userdata->agentid);
    $data['sum_dial'] = $this->$table_recording->get_sum(array("src" => $response['ext'], "DATE(calldate) >=" => $data['start'], "calldate <=" => $data['end']), "duration");
    $afk = $this->get_afk($data['start'], $data['end'], $userdata, $userdata->agentid);
    $response['agent_status_break'] = $this->agent_status($data['start'], $data['end'], 1, $userdata->agentid);

    $response['verified'] = ($summary_peformance['status_call'][13]);
    $response['contacted'] = ($summary_peformance['contacted']);
    $response['cvr'] = number_format(($summary_peformance['status_call'][13] / $summary_peformance['contacted']) * 100, 2);
    $response['oc'] = $summary_peformance['oc'];
    $response['dial'] = $summary_peformance['oc'];
    $response['not_contacted'] = $summary_peformance['uncontacted'];
    $response['status_rating_agent'] = $summary_peformance['status_rating_agent'];
    $response['agent'] = $summary_peformance['agent'];


    $response['oncallrate'] = ($data['sum_dial'] / 60) / ((($duration * 1) / 60) - $afk['agent'][$userdata->agentid]['total']) * 100;

    $data['query_hpemail'] = $this->trans_profiling_last_month->live_query(
      "SELECT
      veri_upd,COUNT(*) as num
      FROM
      $table_trans_profiling 
        LEFT JOIN sys_user a ON a.agentid = $table_trans_profiling.veri_upd
      WHERE
        
       a.opt_level=8
      AND a.tl != '-'
      AND a.kategori='REG'
      AND email LIKE '%@%' 
	    AND handphone LIKE '08%'
      AND date(lup) >= '$start'
      AND date(lup) <= '$end'
      AND veri_call='13'
      AND veri_upd='$userdata->agentid'
      
      GROUP BY
        veri_upd
        "
    )->result();
    $data['query_hponly'] = $this->trans_profiling_last_month->live_query(
      "SELECT
      veri_upd,COUNT(*) as num
      FROM
      $table_trans_profiling 
        LEFT JOIN sys_user a ON a.agentid = $table_trans_profiling.veri_upd
      WHERE
        
       a.opt_level=8
      AND a.tl != '-'
      AND a.kategori='REG'
      AND email NOT LIKE '%@%' 
	    AND handphone  LIKE '08%'
      AND date(lup) >= '$start'
      AND date(lup) <= '$end'
      AND veri_call='13'
      AND veri_upd='$userdata->agentid'
      GROUP BY
        veri_upd
        "
    )->result();
    if (count($data['query_hpemail']) > 0) {
      foreach ($data['query_hpemail'] as $row_he) {
        $data['agent'][$row_he->veri_upd]['hpemail'] = $row_he->num;
        $response['hpemail'] = $row_he->num + $response['hpemail'];
      }
    }
    if (count($data['query_hponly']) > 0) {
      foreach ($data['query_hponly'] as $row_he) {
        $data['agent'][$row_he->veri_upd]['hponly'] = $row_he->num;
        $response['hponly'] = $row_he->num + $response['hponly'];
      }
    }

    ///// LOG SESSION
    $data['log_call'] = $this->get_log_call($userdata->agentid);

    //// END LOG SESSION///
    $data['list_periode'] = new DatePeriod(
      new DateTime(date('Y-m-d', strtotime(date('Y-m-d') . "-7 days"))),
      new DateInterval('P1D'),
      new DateTime(date('Y-m-d'))
    );
    foreach ($data['list_periode'] as $key => $value) {

      $tgl = $value->format('Y-m-d');

      $response['log_veri'][$tgl] = $data['log_call']['log_veri'][$tgl];
      $response['log_contacted'][$tgl] = $data['log_call']['log_contacted'][$tgl];
      $response['log_not_contacted'][$tgl] = $data['log_call']['log_not_contacted'][$tgl];
      $response['log_oc'][$tgl] = $data['log_call']['log_oc'][$tgl];
    }

    $response['all_agent'] = $data['agent']['num'];
    $response['start'] = $data['start'];
    $response['end'] = $data['end_tgl'];
    $response['agentid'] = $userdata->agentid;
    $response['duration'] = $response['duration_2'];
    $response['controller'] = $this;
    $this->load->view($view, $response);
  }

  function by_ncli($trans_profiling_daily = 'trans_profiling_daily', $start, $end, $agentid = false)
  {
    $filter_agent = "";
    if ($agentid) {
      $filter_agent = " AND veri_upd = '$agentid' ";
    }
    $data['ncli'] = $this->trans_profiling_daily->live_query("
        select 
        veri_call,
        LENGTH( ncli ) as lengthna,
        SUBSTR( ncli, 1, 2 ) as nclina,
        count(*) AS num FROM $trans_profiling_daily WHERE DATE(lup) >= '$start' AND DATE(lup) <= '$end'  
        $filter_agent 
        GROUP BY
        veri_call,
        LENGTH( ncli ),
        SUBSTR(ncli,1,2)
      ")->result();
    $response = array();
    if (count($data['ncli']) > 0) {
      foreach ($data['ncli'] as $r) {
        $response['ncli'][$r->nclina][$r->lengthna][$r->veri_call] = $r->num;
        $response['ncli'][$r->nclina][$r->lengthna]['oc'] = $r->num + $response['ncli'][$r->nclina][$r->lengthna]['oc'];
      }
    }
    return $response;
  }
  function by_sumber($start, $end, $agentid = false)
  {
    $filter_agent = "";
    if ($agentid) {
      $filter_agent = " AND veri_upd = '$agentid' ";
    }
    $data['sumber'] = $this->trans_profiling_verifikasi->live_query("
    select sumber,veri_call,count(*) as num FROM trans_profiling_detail WHERE DATE(lup) >= '$start' AND DATE(lup) <= '$end' $filter_agent GROUP BY sumber,veri_call
    ")->result();
    $response = array();
    if (count($data['sumber']) > 0) {
      foreach ($data['sumber'] as $r) {
        $response['sumber'][$r->sumber][$r->veri_call] = $r->num;
        $response['sumber'][$r->sumber]['oc'] = $r->num + $response[$r->sumber]['oc'];
        $response['oc'] = $r->num + $response['oc'];
      }
    }

    return $response;
  }
  public function data_dis()
  {
    $view = 'analitics/data';
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    if (isset($_POST['start'])) {
      $table_trans_profiling = "trans_profiling_daily";
      $data['start'] = $_POST['start'];
      $data['end'] = $_POST['end'];
      $data['end_tgl'] = $_POST['end'];
      $table_recording = "recording_daily";
      if ($_POST['start'] != date('Y-m-d')) {
        $table_trans_profiling = "trans_profiling_monthly";
      }
    } else {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
      $data['end_tgl'] = date('Y-m-d');
      $table_recording = "recording_daily";
      $table_trans_profiling = "trans_profiling_daily";
    }
    $start = $data['start'];
    $end = $data['end_tgl'];
    $agentid = false;
    if (isset($_POST['agentid'])) {
      if ($_POST['agentid'] != '0') {
        $agentid = $_POST['agentid'];
        $response['agent_filter'] = $agentid;
      }
    }
    $where_agent = array("opt_level" => 8, "kategori" => "REG", "tl !=" => "-");
    if ($userdata->opt_level == 9) {
      $where_agent['tl'] = $userdata->agentid;
    }
    $data['controller'] = $this;
    $data['title_page_big']     =   '';

    $response['agent'] = $this->Sys_user_table_model->get_results($where_agent);
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
    $response['wo'] = $r_wo['num_wo'];
    $rec = $this->trans_profiling_daily->live_query("
            select count(*) AS num,SUM(duration) AS sumna FROM $table_recording WHERE 
            DATE(calldate) >= '$start' AND DATE(calldate) <= '$end' 
          ")->row();
    $response['num_rec'] = $rec->num;
    $response['sum_rec'] = $rec->sumna;
    $response['sumber'] = $this->by_sumber($data['start'], $data['end'], $agentid);
    $response['ncli'] = $this->by_ncli($table_trans_profiling, $data['start'], $data['end'], $agentid);
    $response['rec'] = $this->get_verified_quality($table_trans_profiling, $table_recording, $data['start'], $data['end'], $agentid);

    $response['last_update'] = $this->trans_profiling_daily->get_row(array(), array("*"), array("lup" => "DESC"));
    $response['start'] = $data['start'];
    $response['end'] = $data['end_tgl'];
    $response['controller'] = $this;
    $this->load->view($view, $response);
  }
  public function agent_status($start, $end, $agent, $agentid = false)
  {
    if ($start == date('Y-m-d')) {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
    } else {

      $data['start'] = $start;
      $data['end'] = $end;
    }
    $filter_agent = "";
    $waktuna = "TIMESTAMP(DATE( sys_user_log_in_out.login_time ),'17:00:00') ";
    if ($agentid != false) {
      $filter_agent = " AND sys_user.agentid='$agentid'";
      $waktuna = " TIMESTAMP(DATE( sys_user_log_in_out.login_time ),'20:00:00') ";
    }
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
      DATE( sys_user_log_in_out.login_time ) >= '" . $data['start'] . "' AND
      DATE( sys_user_log_in_out.login_time ) <= '" .  $data['end'] . "' 
      AND sys_user_log_in_out.login_time  <= $waktuna
      AND sys_user_log_in_out.login_time  >= TIMESTAMP(DATE( sys_user_log_in_out.login_time ),'08:00:00') 
      AND sys_user_log_in_out.logout_time IS NOT NULL 
      AND sys_user.kategori = 'REG' 
      AND sys_user.tl != '-' 
      AND sys_user.opt_level = 8 
      $filter_agent
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

    $data['break']['max'] = count($agent) * 75;
    $data['break']['max_agent'] = 75;
    $data['break']['break_persen'] = number_format(($data['break']['total'] / $data['break']['max']) * 100, 2);
    // $data['break']['break_agent_persen'] = number_format(($data['break']['agent'][$userdata->agentid]['total'] / $data['break']['max_agent']) * 100, 2);
    /// end break ///
    return $data;
  }

  public function get_effective_time($table_trans_profiling = 'trans_profiling_daily', $tabel_recording = 'recording_daily')
  {
    $return = array();
    $return['total']['aht_count'] = 0;
    $return['total']['aht_sum'] = 0;
    $agent = $this->Sys_user_table_model->get_results(array("opt_level" => 8, "kategori" => "REG", "tl !=" => "-"));
    $query_trans_profiling = $this->trans_profiling_daily->live_query(
      "SELECT veri_call,veri_upd,handphone,email,idx,pstn1,DATE(lup) as date_lup FROM $table_trans_profiling WHERE veri_call=13"
    );

    $data_profiling = $query_trans_profiling->result_array();
    if ($agent['num'] > 0) {
      foreach ($agent['results'] as $ag) {
        $data_verified = $this->filter_by_value($data_profiling, 'veri_upd', $ag->agentid);

        $return[$ag->agentid]['veri_aht'] = $this->get_recording($data_verified, $tabel_recording);
        $return[$ag->agentid]['aht_count'] = array_sum(array_column($return[$ag->agentid]['veri_aht'], 'aht_count'));
        $return[$ag->agentid]['aht_sum'] = array_sum(array_column($return[$ag->agentid]['veri_aht'], 'aht_sum'));

        $return['total']['aht_count'] = $return['total']['aht_count'] + $return[$ag->agentid]['aht_count'];
        $return['total']['aht_sum'] = $return['total']['aht_sum'] + $return[$ag->agentid]['aht_sum'];
      }
    }





    return $return;
  }



  public function get_recording($data_verified, $tabel_recording = 'recording_daily')
  {
    $return = array();
    $n = 0;
    if (count($data_verified) > 0) {
      $n1 = 0;
      foreach ($data_verified as $veri) {
        $hp = $veri['handphone'];
        // $pstn = $veri['pstn'];
        if ($n1 != 0) {
          $list_of_hp = $list_of_hp . ",'61" . $hp . "'";
        } else {
          $list_of_hp =  "'" . $hp . "'";
        }
        $n1++;
        // $query_hp = $this->trans_profiling_daily->live_query(
        //   "SELECT dst,sum(duration) as sum_duration,count(duration) as count_duration FROM $tabel_recording WHERE dst='61$hp' GROUP BY dst"
        // );
        // $query_pstn = $this->trans_profiling_daily->live_query(
        //   "SELECT dst,sum(duration) as sum_duration,count(duration) as count_duration FROM $tabel_recording WHERE dst='61$pstn'  GROUP BY dst"
        // );
        // $rhp = $query_hp->row();
        // $rpstn = $query_pstn->row();
        // $aht_v = 0;
        // $aht_n = 0;
        // if (count($rhp) > 0) {
        //   foreach ($rhp as $drc) {
        //     $aht_n++;
        //     $aht_v = $aht_v + $drc['duration'];
        //     // $veri['recording'][] = $drc;
        //   }
        // }
        // if (count($rpstn) > 0) {
        //   foreach ($rpstn as $drc) {
        //     $aht_n++;
        //     $aht_v = $aht_v + $drc['duration'];
        //     // $veri['recording'][] = $drc;
        //   }
        // }

        // $veri['aht_count'] = $rhp->count_duration + $rpstn->count_duration;
        // $veri['aht_sum'] = $rhp->sum_duration + $rpstn->sum_duration;
        // $veri['aht'] = $aht_v / $aht_n;
        // $return[] = $veri;
      }
      $query_hp = $this->trans_profiling_daily->live_query(
        "SELECT sum(duration) as sum_duration,count(duration) as count_duration FROM $tabel_recording WHERE dst IN ($list_of_hp)"
      );
      $rhp = $query_hp->row();
      $veri['aht_count'] = $rhp->count_duration;
      $veri['aht_sum'] = $rhp->sum_duration;
      $veri['aht'] = $veri['aht_sum'] / $veri['aht_count'];
      $return[] = $veri;
    }
    return $return;
  }
  function filter_by_value($array, $index, $value)
  {
    $newarray = array();
    if (is_array($array) && count($array) > 0) {
      foreach (array_keys($array) as $key) {
        $temp[$key] = $array[$key][$index];

        if ($temp[$key] == $value) {
          $newarray[$key] = $array[$key];
        }
      }
    }
    return $newarray;
  }
  function summary_peformance($start, $end, $userdata, $agent_id = false, $tl = false)
  {
    if ($start == date('Y-m-d')) {
      $data['start'] = date('Y-m-d');
      $data['end'] = date('Y-m-d');
      $tabel = "trans_profiling_daily";

      $time1 = strtotime('08:00:00');
      $time2 = strtotime(DATE('H:i:s'));
    } else {

      $data['start'] = $start;
      $data['end'] = $end;
      $tabel = "trans_profiling_last_month";
      $time1 = strtotime('08:00:00');
      $time2 = strtotime('20:00:00');
    }
    $filter_agent = "";

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
      AND lup <= '$end'
      $filter_agent
      GROUP BY
        veri_upd,veri_call
        "
    )->result();


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
    $data['status_rating'] = array_slice($status_call, 0, 4);
    $data['status_rating_agent'] = array_slice($status_call_agent, 0, 7);
    $data['agent_rating'] = array_slice($data['peformance'], 0, 7);
    $data['best_agent'] = array_slice($data['peformance'], 0, 1);

    $duration = round(abs($time2 - $time1) / 3600, 2);
    $data['duration'] = round(abs($time2 - $time1) / 3600, 2);
    // echo $data['oc']."/".$duration."/agent :".count($data['agent']);
    $data['cph'] = intval(($data['oc'] / count($data['agent'])) / $duration);
    $data['cph_persen'] = number_format(($data['cph'] / 100) * 100, 2);
    $data['cph_agent'] = intval($data['agent'][$userdata->agentid]['oc'] / $duration);
    $data['cph_agent_persen'] = number_format(($data['cph_agent'] / 100) * 100, 2);
    $data['target'] = count($data['agent']) * 110;
    $data['target_persen'] = number_format(($data['status_call'][13] / $data['target']) * 100, 2);
    $data['target_agent'] = 110;
    $data['target_agent_persen'] = number_format(($data['agent'][$userdata->agentid][13] / $data['target_agent']) * 100, 2);
    // $data['call_per_hours']=number_format($data['oc'] / ($duration/60),2);
    return $data;
  }

  function get_ext($data_agent, $start)
  {
    $data = array();
    if ($data_agent['num'] > 0) {
      foreach ($data_agent['results'] as $n => $row) {
        $veri_last = $this->trans_profiling_daily->get_row(array("veri_upd" => $row->agentid, "DATE(lup)" => $start, "veri_call" => 13));
        if ($veri_last) {
          $no_hp_last = $veri_last->handphone;
          $pstn_last = $veri_last->pstn1;
          $ext = $this->cdr_daily->get_row(array("dst" => "61" . $no_hp_last));
          $extention = "";
          if ($ext) {
            $extention = $ext->src;
          } else {
            $ext = $this->cdr_daily->get_row(array("dst" => "61" . $pstn_last));
            if ($ext) {
              $extention = $ext->src;
            }
          }
          $data[$row->agentid]['ext'] = $extention;
        }
      }
    }
    return $data;
  }

  function get_afk($start, $end, $userdata, $agentid = false)
  {
    ////break ///
    $filter_agent = "";
    if ($agentid != false) {
      $filter_agent = " AND sys_user.agentid='$agentid' ";
    }
    $data = array();
    $aux_status = $this->trans_profiling_last_month->live_query("
    SELECT
    sys_user.agentid,sys_user.tl,ket,
      
      sum(TIMESTAMPDIFF( SECOND, sys_user_log_in_out.login_time, sys_user_log_in_out.logout_time )) AS aux 
    FROM
      sys_user_log_in_out
      JOIN sys_user ON sys_user.id = sys_user_log_in_out.id_user 
    WHERE
      DATE( sys_user_log_in_out.login_time ) >= '" . $start . "' AND
      sys_user_log_in_out.login_time  <= '" . $end . "' 
      AND sys_user_log_in_out.login_time  <= TIMESTAMP(DATE( sys_user_log_in_out.login_time ),'17:00:00') 
      AND sys_user_log_in_out.login_time  >= TIMESTAMP(DATE( sys_user_log_in_out.login_time ),'08:00:00') 
      AND sys_user_log_in_out.logout_time IS NOT NULL 
      AND sys_user.kategori = 'REG' 
      AND sys_user.tl != '-' 
      AND sys_user.opt_level = 8 
      $filter_agent
    GROUP BY
    sys_user.agentid,sys_user_log_in_out.ket
    ");
    foreach ($aux_status->result_array() as $r_aux) {
      $data['agent'][$r_aux['agentid']] = $data['agent'][$r_aux['agentid']] + $r_aux['aux'];
      $data['agent'][$r_aux['agentid']]['total'] = $data['agent'][$r_aux['agentid']]['total'] + $r_aux['aux'];
      $data['agent'][$r_aux['agentid']][$r_aux['ket']] = $data['agent'][$r_aux['agentid']][$r_aux['ket']] + $r_aux['aux'];
      $data['tl'][$r_aux['tl']] = $data['tl'][$r_aux['tl']] + $r_aux['aux'];
      $data[$r_aux['ket']] = $data[$r_aux['ket']] + $r_aux['aux'];
      $data['total'] = $data['total'] + $r_aux['aux'];
    }

    $data['total'] = $data['total'] / 60;
    $data['max'] = count($data['agent']) * 75;
    $data['max_agent'] = 75;
    $data['break_persen'] = number_format(($data['total'] / $data['max']) * 100, 2);
    $data['break_agent_persen'] = number_format(($data['agent'][$userdata->agentid]['total'] / $data['max_agent']) * 100, 2);
    /// end break ///
    return $data;
  }

  function get_log_call($agentid = false)
  {
    $filter_agent = "";
    if ($agentid != false) {
      $filter_agent = " AND veri_upd='$agentid'";
    }
    $data = array();
    $log_veri = $this->trans_profiling_last_month->live_query("
    SELECT
      date( lup ) as lupna,
      count(*) as num
    FROM
      trans_profiling_last_month 
    WHERE
    DATE(lup)>=DATE(NOW()) - INTERVAL 7 DAY
      AND veri_call = 13 
      $filter_agent
    GROUP BY
      date(lup)
      ORDER BY lup DESC
    ");

    $log_contacted = $this->trans_profiling_last_month->live_query("
    SELECT
      date( lup ) as lupna,
      count(*) as num
    FROM
    trans_profiling_last_month 
    WHERE
    DATE(lup)>=DATE(NOW()) - INTERVAL 7 DAY
      AND (veri_call = 1 OR veri_call = 13 OR veri_call = 3 OR veri_call = 12 OR veri_call = 11) 
      $filter_agent
    GROUP BY
      date(lup)
      ORDER BY lup DESC
    ");
    $log_not_contacted = $this->trans_profiling_last_month->live_query("
    SELECT
      date( lup ) as lupna,
      count(*) as num
    FROM
    trans_profiling_last_month 
    WHERE
    DATE(lup)>=DATE(NOW()) - INTERVAL 7 DAY
      AND (veri_call = 15 OR veri_call = 9 OR veri_call = 8 OR veri_call = 4 OR veri_call = 7 OR veri_call = 10 OR veri_call = 14 OR veri_call = 2) 
      $filter_agent
      GROUP BY
      date(lup)
      ORDER BY lup DESC
    ");
    $log_oc = $this->trans_profiling_last_month->live_query("
    SELECT
      date( lup ) as lupna,
      count(*) as num
    FROM
    trans_profiling_last_month 
    WHERE
    DATE(lup)>=DATE(NOW()) - INTERVAL 7 DAY
    $filter_agent
    GROUP BY
      date(lup)
      ORDER BY lup DESC
    ");

    $log_veri = $log_veri->result();
    $log_contacted = $log_contacted->result();
    $log_not_contacted = $log_not_contacted->result();
    $log_oc = $log_oc->result();
    if (count($log_veri) > 0) {
      foreach ($log_veri as $lv) {
        $data['log_veri'][$lv->lupna] = $data['log_veri'][$lv->lupna] + $lv->num;
      }
    }
    if (count($log_contacted) > 0) {
      foreach ($log_contacted as $lv) {
        $data['log_contacted'][$lv->lupna] = $data['log_contacted'][$lv->lupna] + $lv->num;
      }
    }
    if (count($log_not_contacted) > 0) {
      foreach ($log_not_contacted as $lv) {
        $data['log_not_contacted'][$lv->lupna] = $data['log_not_contacted'][$lv->lupna] + $lv->num;
      }
    }
    if (count($log_oc) > 0) {
      foreach ($log_oc as $lv) {
        $data['log_oc'][$lv->lupna] = $data['log_oc'][$lv->lupna] + $lv->num;
      }
    }
    return $data;
  }

  function peak_hours($table_trans_profiling = 'trans_profiling_daily', $start, $end)
  {
    $contacted = array(1, 13, 3, 12, 11);
    $query_trans_profiling = $this->trans_profiling_daily->live_query(
      "SELECT HOUR(lup) as hour_lup,veri_call,count(*) as num FROM $table_trans_profiling WHERE DATE(lup) >= '" . $start . "' AND DATE(lup) <= '" . $end . "' GROUP BY HOUR(lup),veri_call "
    );
    $total = array();
    for ($i = 8; $i <= 20; $i++) {
      $total['verified'][$i] = 0;
      $total['contacted'][$i] = 0;
      $total['all_call'][$i] = 0;
    }
    foreach ($query_trans_profiling->result_array() as $th) {
      for ($i = 8; $i <= 20; $i++) {
        if ($th['hour_lup'] == $i) {
          $total['all_call'][$i] = $total['all_call'][$i] + $th['num'];
        }
        if ($th['hour_lup'] == $i && $th['veri_call'] == 13) {
          $total['verified'][$i] = $total['verified'][$i] + $th['num'];
        }
        if ($th['hour_lup'] == $i && in_array($th['veri_call'], $contacted)) {
          $total['contacted'][$i] = $total['contacted'][$i] + $th['num'];
        }
      }
    }
    for ($i = 8; $i <= 20; $i++) {
      $total['rate_contacted'][$i] = intval(($total['contacted'][$i] / $total['all_call'][$i]) * 100);
    }
    return $total;
  }
  function general_data($start, $end)
  {
    $response['opsi_call'] = $this->trans_profiling->live_query("
      select opsi_call,count(*) as num FROM trans_profiling_detail WHERE DATE(lup) >= '$start' AND DATE(lup) <= '$end' AND veri_call=13 AND (sumber <> 'ProfillingMos' AND sumber <> '') GROUP BY opsi_call 
    ")->result_array();
    $response['jk'] = $this->trans_profiling->live_query("
      select jk,count(*) as num FROM trans_profiling_detail WHERE DATE(lup) >= '$start' AND DATE(lup) <= '$end' AND veri_call=13  AND (sumber <> 'ProfillingMos' AND sumber <> '') GROUP BY jk 
    ")->result_array();
    $response['payment'] = $this->trans_profiling->live_query("
      select payment,count(*) as num FROM trans_profiling_detail WHERE DATE(lup) >= '$start' AND DATE(lup) <= '$end' AND veri_call=13  AND (sumber <> 'ProfillingMos' AND sumber <> '') GROUP BY payment 
    ")->result_array();
    $response['kec_speedy'] = $this->trans_profiling->live_query("
      select kec_speedy,count(*) as num FROM trans_profiling_detail WHERE DATE(lup) >= '$start' AND DATE(lup) <= '$end' AND veri_call=13  AND (sumber <> 'ProfillingMos' AND sumber <> '') GROUP BY kec_speedy   ORDER BY kec_speedy ASC
    ")->result_array();
    return $response;
  }

  function regional($trans_profiling_daily = 'trans_profiling_daily', $start, $end)
  {
    $response['regional'] = $this->trans_profiling_daily->live_query("
      select SUBSTR(no_speedy, 2, 1) as regional,
      count(*) AS num FROM $trans_profiling_daily WHERE DATE(lup) >= '$start' AND DATE(lup) <= '$end' AND veri_call=13  
      GROUP BY
      SUBSTR(no_speedy, 2, 1)
    ")->result_array();
    return $response;
  }
  function grade($trans_profiling_daily = 'trans_profiling_daily', $start, $end)
  {
    $query = $this->trans_profiling_daily->live_query('
      select 
      TIMESTAMPDIFF(
        MONTH,
        CONCAT(
          SUBSTR( waktu_psb,- 4, 4 ),
          "-",
        IF
          (
            SUBSTR( waktu_psb,- 7, 2 ) IS NULL 
            OR SUBSTR( waktu_psb,- 7, 2 ) = "",
            "01",
          SUBSTR( waktu_psb,- 7, 2 )),
          "-01" 
        ),
      CURDATE()) as arpu,
        billing
       FROM ' . $trans_profiling_daily . ' WHERE DATE(lup) >= "' . $start . '" AND DATE(lup) <= "' . $end . '" AND veri_call=13  
      
    ')->result();
    $response = $this->master_grade($query);
    return $response;
  }
  function master_grade($query)
  {
    $response = array(
      'platinum' => 0,
      'gold' => 0,
      'silver' => 0,
      'blue' => 0
    );
    if (count($query) > 0) {
      foreach ($query as $row) {
        switch (true) {
          case ($row->arpu >= 3 && intval($row->billing) >= 700000):
            $response['platinum'] = $response['platinum'] + 1;
            break;
          case ($row->arpu >= 18 && intval($row->billing) >= 500000 && intval($row->billing) < 700000):
            $response['gold'] = $response['gold'] + 1;
            break;
          case ($row->arpu >= 18 && intval($row->billing) < 500000):
            $response['silver'] = $response['silver'] + 1;
            break;
          default:
            $response['blue'] = $response['blue'] + 1;
            break;
        }
      }
    }
    return $response;
  }
}
