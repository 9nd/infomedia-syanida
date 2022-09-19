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
class Report extends CI_Controller
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
    $this->load->model('Custom_model/Trans_profiling_last_month_infomedia_model', 'Trans_profiling_last_month');
    $this->load->model('Custom_model/T_produk_moss_model', 'product_moss');
    $this->load->model('Custom_model/Cdr_model', 'cdr');
    $this->load->model('Custom_model/Cdr_daily_model', 'cdr_daily');
    $this->load->model('Custom_model/Recording_daily_model', 'recording_daily');
    $this->load->model('Custom_model/Trans_profiling_validasi_mos_model', 'validasi_mos');
  }
  // $date = date('Y-m-d');
  //   $date = strtotime($date);
  //   $date = strtotime("-7 day", $date);
  //   $date2 = strtotime("-7 day", $date);
  //   $date3 = strtotime("-7 day", $date2);
  //   $date4 = strtotime("-7 day", $date3);
  public function report()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Report_profiling/summary_report';
    $post = $this->input->get();
    $filter_condition = "";
    $data['condition'] = 1;
    $data['template'] = "monthly";
    $data['layanan'] = "reguler";
    $data['datena'] = date('Y-m-d');
    if (isset($post['condition']) && $post['condition'] == 2) {
      $filter_condition = " AND sys_user.tl != '-' ";
      $data['condition'] = 2;
    }
    if (isset($post['datena'])) {
      $data['datena'] = $post['datena'];
    }

    if (isset($post['template']) && ($post['template'] == "weekly" || $post['template'] == "daily")) {
      $data['grafik'] = $this->report_weekly($filter_condition, $data['datena'], $post['template']);
      $data['template'] = $post['template'];
    } else {
      $data['grafik'] = $this->report_monthly($filter_condition, $data['datena']);
    }
    $data['status_call'] = $this->status_call->get_results();
    $data['last_update'] = $this->trans_profiling_daily->get_row(array(), array("*"), array("lup" => "DESC"))->lup;
    $this->load->view($view, $data);
  }
  public function get_status_weekly()
  {
    $post = $this->input->get();
    // if (isset($post['datena'])) {
    $data['datena'] = $post['datena'];
    $data['template'] = $post['template'];
    $filter_condition = $post['filter_condition'];
    $veri_call = $post['veri_call'];
    // }
    $view = 'Report_profiling/get_status';
    $data['status'] = $this->report_status($filter_condition, $data['datena'], $data['template'],$veri_call);
    $data['veri_call'] = $veri_call;
    $data['titlena']=$this->status_call->get_row(array("id_reason"=>$veri_call))->nama_reason;
    $this->load->view($view, $data);
  }
  public function report_status($filter_condition, $date, $template = "weekly",$veri_call=13)
  {
    if (isset($filter_condition) && $filter_condition == 2) {
      $filter_condition = " AND sys_user.tl != '-' ";
    }else{
      $filter_condition ="";
    }
    $date_now = strtotime($date);
    $bulan = date('m', $date_now);
    $tahun = date('Y', $date_now);
    $w0 = date('Y-m-d', strtotime('last monday', $date_now));
    $w1 = date('Y-m-d', strtotime("-7 day", strtotime($w0)));
    $w2 = date('Y-m-d', strtotime("-7 day", strtotime($w1)));
    $w3 = date('Y-m-d', strtotime("-7 day", strtotime($w2)));
    $w4 = date('Y-m-d', strtotime("-7 day", strtotime($w3)));
    $bulanna_text = array(
      1 => "Jan",
      2 => "Feb",
      3 => "Mar",
      4 => "Apr",
      5 => "May",
      6 => "Jun",
      7 => "Jul",
      8 => "Aug",
      9 => "Sep",
      10 => "oct",
      11 => "Nov",
      12 => "Dec"
    );
    $last_week = date('Y-m-d', strtotime($w4));
    $new_week = date('Y-m-d', strtotime($date));
    // echo $w1."-".$w4;
    if ($template == 'daily') {
      $last_week = $w1;
    }
    $where = "DATE(db_profiling.trans_profiling.lup) >= '$last_week'
    AND DATE(db_profiling.trans_profiling.lup) <= '$new_week' ";
    $group_by = "DATE(db_profiling.trans_profiling.lup)";
    if ($template == "monthly") {
      $where = "YEAR(db_profiling.trans_profiling.lup) = '$tahun' ";
      $group_by = "MONTH(db_profiling.trans_profiling.lup)";
    }
    $data['data_performance'] = $this->trans_profiling_daily->live_query(
      "SELECT
        $group_by as bulan,db_profiling.trans_profiling.veri_call,count(*) as numna 
        FROM
        db_profiling.trans_profiling 
          LEFT JOIN sys_user ON sys_user.agentid = db_profiling.trans_profiling.veri_upd 
        WHERE
        $where
         AND sys_user.kategori = 'REG' 
          AND sys_user.opt_level = 8 
          $filter_condition
          AND db_profiling.trans_profiling.veri_call=$veri_call
        GROUP BY
        $group_by,db_profiling.trans_profiling.veri_call
        ORDER BY db_profiling.trans_profiling.lup ASC
      "
    )->result();
    
    $data['status_performance'] = array();

    if (count($data['data_performance']) > 0) {
      foreach ($data['data_performance'] as $fr) {

        if ($template == "monthly") {

          $data['status_performance']['axis_param'][$bulanna_text[$fr->bulan]] = $bulanna_text[$fr->bulan];
          $data['status_performance']['axis'][$bulanna_text[$fr->bulan]] = $bulanna_text[$fr->bulan];
          $data['status_performance'][$bulanna_text[$fr->bulan]]['axis'] = $bulanna_text[$fr->bulan];
          $data['status_performance'][$bulanna_text[$fr->bulan]]['_' . $fr->veri_call]['axis'] = $fr->veri_call;
          $data['status_performance'][$bulanna_text[$fr->bulan]]['_' . $fr->veri_call]['numna'] = $data['status_performance'][$bulanna_text[$fr->bulan]]['_' . $fr->veri_call]['numna'] + $fr->numna;
        } else {
          $m = date('m', strtotime($fr->bulan));
          $num_week = $this->weekOfMonth($fr->bulan);
          if ($num_week == '1next') {
            $m = date('m', strtotime('+7 day', strtotime($fr->bulan)));
            $num_week = 1;
          }
          $m = intval($m);
          $key = $num_week . "_" . $m;
          $axis = "W " . $num_week . " " . $bulanna_text[$m];
          if ($template == 'daily') {
            $key = $fr->bulan;
            $axis = $fr->bulan;
          }
          $data['status_performance']['axis_param'][$key] = $axis;
          $data['status_performance']['axis'][$key] = $axis;
          $data['status_performance'][$key]['axis'] = $axis;
          $data['status_performance'][$key]['_' . $fr->veri_call]['axis'] = $fr->veri_call;
          $data['status_performance'][$key]['_' . $fr->veri_call]['numna'] = $fr->numna + $data['status_performance'][$key]['_' . $fr->veri_call]['numna'];
        }
      }
    }
    return $data;
  }
  public function report_agent()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Report_profiling/summary_agent';
    $post = $this->input->get();
    $filter_condition = "";
    $data['condition'] = 1;
    $data['template'] = "monthly";
    $data['layanan'] = "reguler";
    $data['datena'] = date('Y-m-d');
    if (isset($post['condition']) && $post['condition'] == 2) {
      $filter_condition = " AND sys_user.tl != '-' ";
      $data['condition'] = 2;
    }
    if (isset($post['datena'])) {
      $data['datena'] = $post['datena'];
    }
    if (isset($post['template']) && $post['template'] == "weekly") {
      $data['template'] = "weekly";
    }
    $data['m'] = date('m', strtotime($data['datena']));
    $data['m'] = intval($data['m']);

    $data['agent'] = $this->trans_profiling_daily->live_query("
        select * FROM  sys_user WHERE 
        kategori = 'REG' 
        AND
        opt_level = 8 
        AND tl != '-'
    ")->result();
    // if (isset($post['template']) && $post['template'] == "weekly") {
    //   $data['grafik'] = $this->report_weekly($filter_condition, $data['datena']);
    //   $data['template'] = "weekly";
    // } else {
    //   $data['grafik'] = $this->report_monthly($filter_condition, $data['datena']);
    // }
    $data['utilisasi'] = $this->get_utilitas($data['datena'], $filter_condition, $data['template']);
    $data['target_call'] = $this->get_target_call($data['datena'], $filter_condition, $data['template']);
    $data['keterlambatan'] = $this->get_keterlambatan($data['datena'], $filter_condition, $data['template']);
    $data['kuality'] = $this->get_quality($data['datena'], $filter_condition, $data['template']);
    $data['peformance'] = $this->summary_kpi_agent($data['datena'], $filter_condition, $data['template']);


    $data['last_update'] = $this->trans_profiling_daily->get_row(array(), array("*"), array("lup" => "DESC"))->lup;
    $this->load->view($view, $data);
  }
  public function summary_kpi_agent($date, $filter_condition, $template = 'monthly')
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $tahun = date('Y', strtotime($date));
    $bulan = date('m', strtotime($date));
    $filter_template = "";
    $axis = "
    MONTH(waktu_in)
    ";
    $filter_template_peformance = "";
    $axis_peformance = "
    MONTH(date)
    ";
    $filter_template_cdr = "";
    $axis_cdr = "
    MONTH(calldate)
    ";
    if ($template == 'weekly') {
      $filter_template = " AND MONTH(waktu_in) = '$bulan'";
      $axis = "
        CONCAT(CASE 
        WHEN DAYOFMONTH(waktu_in) <= 10 THEN 1
        WHEN DAYOFMONTH( waktu_in ) > 10 AND DAYOFMONTH( waktu_in ) < 21 THEN 2
        ELSE 3
          END,'-',MONTH(waktu_in))
      ";
      $filter_template_peformance = " AND MONTH(date) = '$bulan'";
      $axis_peformance = "
        CONCAT(CASE 
        WHEN DAYOFMONTH(date) <= 10 THEN 1
        WHEN DAYOFMONTH( date ) > 10 AND DAYOFMONTH( date ) < 21 THEN 2
        ELSE 3
          END,'-',MONTH(date))
      ";
      $filter_template_cdr = " AND MONTH(calldate) = '$bulan'";
      $axis_cdr = "
        CONCAT(CASE 
        WHEN DAYOFMONTH(calldate) <= 10 THEN 1
        WHEN DAYOFMONTH( calldate ) > 10 AND DAYOFMONTH( calldate ) < 21 THEN 2
        ELSE 3
          END,'-',MONTH(calldate))
      ";
    }
    $bulanna = array(
      1 => "January",
      2 => "February",
      3 => "March",
      4 => "April",
      5 => "May",
      6 => "June",
      7 => "July",
      8 => "August",
      9 => "September",
      10 => "October",
      11 => "November",
      12 => "December"
    );
    $target = 110;
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
    $data_performance = $this->trans_profiling_daily->live_query(
      "SELECT
         sys_user.agentid agentna,$axis_peformance as bulan,
          sum( jumlah ) AS oc,
          SUM(
          IF
          ( veri_call IN ( 1, 13, 3, 12, 11 ), jumlah, 0 )) AS contacted,
          SUM(
          IF
          ( veri_call IN ( 15, 9, 8, 4, 7, 10, 14, 2 ), jumlah, 0 )) AS not_contacted,
          SUM(
        IF
        ( veri_call = 13, jumlah, 0 )) AS numna 
        FROM
        monthly_summary_trans_profiling 
          LEFT JOIN sys_user ON  (sys_user.agentid = veri_upd OR sys_user.agentid_mos = veri_upd) 
        WHERE
          YEAR(date) = $tahun
          $filter_template_peformance
         AND sys_user.kategori = 'REG' 
          AND sys_user.opt_level = 8 
          AND tl != '-'
          GROUP BY
          sys_user.agentid,$axis_peformance
        ORDER BY date ASC
      "
    )->result();

    if (count($data_performance) > 0) {
      foreach ($data_performance as $fr) {

        $data_log[$fr->agentna][$fr->bulan]['oc'] = $fr->oc;
        $data_log[$fr->agentna][$fr->bulan]['contacted'] = $fr->contacted;
        $data_log[$fr->agentna][$fr->bulan]['not_contacted'] = $fr->not_contacted;
        $data_log[$fr->agentna][$fr->bulan]['verified'] = $fr->numna;
      }
    }



    $hk = $this->trans_profiling_daily->live_query("
            select sys_user.agentid as agentna,$axis as bulan,DATE(waktu_in) as hk FROM t_absensi 
            LEFT JOIN sys_user ON sys_user.agentid = t_absensi.agentid 
            WHERE stts='in' 
            AND YEAR(waktu_in) = $tahun
            $filter_template
            AND sys_user.kategori = 'REG' 
            AND sys_user.opt_level = 8 
            AND tl != '-'
          GROUP BY sys_user.agentid,$axis,DATE(waktu_in)
    ")->result();
    if (count($hk) > 0) {
      foreach ($hk as $fr) {

        $data_log[$fr->agentna][$fr->bulan]['hk'] = $data[$fr->agentna][$fr->bulan]['hk'] + 1;
      }
    }

    $agent_absen = $this->trans_profiling_daily->live_query("
            select sys_user.agentid as agentna,$axis as bulan,count(t_absensi.agentid) as numna FROM t_absensi 
            LEFT JOIN sys_user ON sys_user.agentid = t_absensi.agentid 
            WHERE stts='in'
            AND YEAR(waktu_in) = $tahun
            $filter_template
            AND sys_user.kategori = 'REG' 
            AND sys_user.opt_level = 8 
            AND tl != '-'
          GROUP BY sys_user.agentid,$axis
    ")->result();
    if (count($agent_absen) > 0) {
      foreach ($agent_absen as $fr) {
        $data_log[$fr->agentna][$fr->bulan]['agent_absen'] = $fr->numna;
      }
    }



    $recording = $this->trans_profiling_daily->live_query("
    SELECT
    agentna,bulan,SUM(countna) as sumna,count(countna) as numcount
  FROM
    ( 
    SELECT maping_eyebeam.agentid as agentna,$axis_cdr AS bulan,dst,COUNT( uniqueid ) AS countna FROM cdr
    LEFT JOIN maping_eyebeam ON maping_eyebeam.src = cdr.src 
  WHERE
      YEAR(calldate) = $tahun
      $filter_template_cdr
      AND (dst <> '61V' OR dst <> '618')
      GROUP BY maping_eyebeam.agentid,$axis_cdr,dst 
    ) AS A 
    GROUP BY agentna,bulan
    ")->result();
    if (count($recording) > 0) {
      foreach ($recording as $fr) {

        $data_log[$fr->agentna][$fr->bulan]['recording']['sumna'] = $fr->sumna;
        $data_log[$fr->agentna][$fr->bulan]['recording']['numcount'] = $fr->numcount;
      }
    }
    $recording_duration = $this->trans_profiling_daily->live_query("
      SELECT
      maping_eyebeam.agentid as agentna,$axis_cdr AS bulan,SUM(duration) as sumna,count(uniqueid) as countna
    FROM
       cdr
       LEFT JOIN maping_eyebeam ON maping_eyebeam.src = cdr.src 
    WHERE
        YEAR(calldate) = $tahun
        $filter_template_cdr
        AND (dst <> '61V' OR dst <> '618')
        AND disposition = 'ANSWERED'
        GROUP BY maping_eyebeam.agentid,$axis_cdr
      ")->result();
    if (count($recording_duration) > 0) {
      foreach ($recording_duration as $fr) {
        $data_log[$fr->agentna][$fr->bulan]['recording_duration']['sumna'] = $fr->sumna;
        $data_log[$fr->agentna][$fr->bulan]['recording_duration']['countna'] = $fr->countna;
      }
    }
    $first_call_close = $this->trans_profiling_daily->live_query("
        SELECT
        maping_eyebeam.agentid as agentna,$axis_cdr as bulan,dst
        FROM
        cdr
        LEFT JOIN maping_eyebeam ON maping_eyebeam.src = cdr.src 
        WHERE 
          YEAR(calldate) = $tahun
          $filter_template_cdr
          AND (dst <> '61V' OR dst <> '618')
          AND disposition = 'ANSWERED'
        GROUP BY
        maping_eyebeam.agentid,$axis_cdr,dst 
        HAVING
          COUNT( DISTINCT uniqueid ) =1
      ")->result();
    if (count($first_call_close) > 0) {
      foreach ($first_call_close as $fr) {
        $data_log[$fr->agentna][$fr->bulan]['first_call_close'] = $data_log[$fr->agentna][$fr->bulan]['first_call_close'] + 1;
      }
    }
    $data['summary'] = array();

    if (count($data_log) > 0) {
      $before = "-";
      foreach ($data_log as $agentid => $datana_bulan) {
        foreach ($datana_bulan as $bulan => $datana) {
          $data[$agentid][$bulan]['axis'] = $bulan;
          $data[$agentid][$bulan]['agent_online'] = $datana['agent_absen'];
          $data[$agentid][$bulan]['hk'] = $datana['hk'];

          $data[$agentid][$bulan]['cfa'] = ($datana['oc'] / $datana['agent_absen']);

          $data[$agentid][$bulan]['cfn'] = $datana['recording']['sumna'] / $datana['recording']['numcount'];
          $data[$agentid][$bulan]['cfh'] = ($datana['oc'] / ($datana['agent_absen'] * 8));

          $data[$agentid][$bulan]['aht_num'] =  $datana['recording_duration']['sumna'] / $datana['recording_duration']['countna'];
          $slfc_minute = ($data[$agentid][$bulan]['aht_num']) / 60;
          $kelebihan_detik_slfc = (($data[$agentid][$bulan]['aht_num']) - (intval($slfc_minute, 0) * 60));
          $data[$agentid][$bulan]['aht'] = sprintf("%02d", intval($slfc_minute, 0)) . ":" . sprintf("%02d", intval($kelebihan_detik_slfc));
          $data[$agentid][$bulan]['hitrate'] = ($datana['verified'] / ($datana['oc'] - $datana['verified'])) * 100;
          $data[$agentid][$bulan]['lcr'] = ($datana['contacted'] / ($datana['oc'] + $wo)) * 100;
          $data[$agentid][$bulan]['fcc'] = $datana['first_call_close'];
          $data[$agentid][$bulan]['ppa'] = $datana['verified'] / $datana['agent_absen'];
          $data[$agentid][$bulan]['cvr'] = ($datana['verified'] / $datana['oc']) * 100;
          $data[$agentid][$bulan]['svr'] = ($datana['verified'] / $datana['contacted']) * 100;

          $data[$agentid][$bulan]['ecip'] = ($datana['verified'] / (($datana['agent_absen'] * $target))) * 100;
          $data[$agentid][$bulan]['call_rate'] = (($datana['recording_duration']['sumna'] / 60) / ((480 * $datana['agent_absen'])) * 100);

          if ($data[$agentid][$bulan]['ecip'] >= 90 && $data[$agentid][$bulan]['ecip'] <= 100) {

            $data['agent_best'][$agentid] = $data[$agentid][$bulan];
          }
        }
      }
    }
    if (count($data['agent_best']) > 0) {
      $kpi = array(
        "cfa" => array(
          "title" => "Calls per Agent",
          "number_format" => 0,
          "back" => "",
        ),
        "cfn" => array(
          "title" => "Calls per Account",
          "number_format" => 2,
          "back" => "",
        ),
        "cfh" => array(
          "title" => "Calls Per Hours",
          "number_format" => 0,
          "back" => "",
        ),
        "aht" => array(
          "title" => "AHT",
          "number_format" => 0,
          "back" => "",
        ),
        "hitrate" => array(
          "title" => "Hit Rate",
          "number_format" => 2,
          "back" => "%",
        ),
        "lcr" => array(
          "title" => "List Closure Rate",
          "number_format" => 2,
          "back" => "%",
        ),
        "fcc" => array(
          "title" => "First Call Close",
          "number_format" => 0,
          "back" => "",
        ),
        "ppa" => array(
          "title" =>  "PPA",
          "number_format" => 2,
          "back" => "",
        ),
        "cvr" => array(
          "title" =>  "Convertion Rate",
          "number_format" => 2,
          "back" => "%",
        ),
        "svr" => array(
          "title" =>  "Successful Rate",
          "number_format" => 2,
          "back" => "%",
        ),
        "ecip" => array(
          "title" =>  "Achievement Target",
          "number_format" => 2,
          "back" => "%",
        ),
        "call_rate" =>  array(
          "title" =>  "On-Call Rate",
          "number_format" => 2,
          "back" => "%",
        )
      );
      foreach ($data['agent_best'] as $agenna => $datana) {

        foreach ($kpi as $code => $data_kpi) {
          if ($code == "aht") {
            $data['agent_best']['aht'][$code] = $datana[$code];
          }
          $data['agent_best']['sum'][$code] = $datana[$code] + $data['agent_best']['sum'][$code];
          $data['agent_best']['count'][$code] = $data['agent_best']['count'][$code] + 1;
        }
      }
    }
    return $data;
  }
  public function get_target_call($date, $filter_condition, $template = "monthly")
  {
    $filter_condition = " AND sys_user.tl != '-' ";
    $data = array();
    $target = 110;
    $bobot = 30;
    $jumlah_entitas = 5;
    $tahun = date('Y', strtotime($date));
    $bulan = date('m', strtotime($date));
    $filter_template = "";
    $axis = "
    MONTH(waktu_in)
    ";
    $filter_template_peformance = "";
    $axis_peformance = "
    MONTH(date)
    ";
    if ($template == 'weekly') {
      $filter_template = " AND MONTH(waktu_in) = '$bulan'";
      $axis = "
        CONCAT(CASE 
        WHEN DAYOFMONTH(waktu_in) <= 10 THEN 1
        WHEN DAYOFMONTH( waktu_in ) > 10 AND DAYOFMONTH( waktu_in ) < 21 THEN 2
        ELSE 3
          END,'-',MONTH(waktu_in))
      ";
      $filter_template_peformance = " AND MONTH(date) = '$bulan'";
      $axis_peformance = "
        CONCAT(CASE 
        WHEN DAYOFMONTH(date) <= 10 THEN 1
        WHEN DAYOFMONTH( date ) > 10 AND DAYOFMONTH( date ) < 21 THEN 2
        ELSE 3
          END,'-',MONTH(date))
      ";
    }

    $hk = $this->trans_profiling_daily->live_query("
        select t_absensi.agentid as agentna,$axis as bulan,DATE(waktu_in) as hk FROM t_absensi 
        LEFT JOIN sys_user ON sys_user.agentid = t_absensi.agentid 
        WHERE stts='in' 
        AND YEAR(waktu_in) = $tahun
        $filter_template
        AND sys_user.kategori = 'REG' 
        AND sys_user.opt_level = 8 
      $filter_condition
      GROUP BY t_absensi.agentid,$axis,DATE(waktu_in)
    ")->result();
    if (count($hk) > 0) {
      foreach ($hk as $fr) {
        $data[$fr->agentna][$fr->bulan]['hk'] = $data[$fr->agentna][$fr->bulan]['hk'] + 1;
      }
    }
    $performance = $this->trans_profiling_daily->live_query(
      "SELECT
        sys_user.agentid as agentna,$axis_peformance as bulan,
          sum( jumlah ) AS verified
        FROM
        monthly_summary_trans_profiling 
          LEFT JOIN sys_user ON (sys_user.agentid = veri_upd OR sys_user.agentid_mos = veri_upd) 
        WHERE
        YEAR(date) = $tahun
         $filter_template_peformance
         AND sys_user.kategori = 'REG' 
          AND sys_user.opt_level = 8 
          AND veri_call=13
          $filter_condition
        GROUP BY
        sys_user.agentid,$axis_peformance
        ORDER BY bulan ASC
      "
    )->result();
    if (count($performance) > 0) {
      foreach ($performance as $fr) {
        $jumlah_target = ($target * $data[$fr->agentna][$fr->bulan]['hk']);
        $pencapaian = ($fr->verified / $jumlah_target) * 100;
        if ($pencapaian > 90) {
          $target_call = 5;
        } elseif ($pencapaian > 70) {
          $target_call = 4;
        } elseif ($pencapaian > 50) {
          $target_call = 3;
        } elseif ($pencapaian > 30) {
          $target_call = 2;
        } else {
          $target_call = 1;
        }
        $nilai = ($target_call * $bobot) / $jumlah_entitas;
        $data[$fr->agentna][$fr->bulan]['nilai'] = $nilai;
        $data[$fr->agentna][$fr->bulan]['pencapaian'] = $pencapaian;
        $data['bulan'][$fr->bulan]['sum'] = $data['bulan'][$fr->bulan]['sum'] + $pencapaian;
        $data['bulan'][$fr->bulan]['count'] = $data['bulan'][$fr->bulan]['count'] + 1;
      }
    }
    return $data;
  }
  public function get_keterlambatan($date, $filter_condition, $template = 'monthly')
  {
    $data = array();
    $tahun = date('Y', strtotime($date));
    $bulan = date('m', strtotime($date));
    $filter_template = "";
    $axis = "
    MONTH(waktu_in)
    ";
    if ($template == 'weekly') {
      $filter_template = " AND MONTH(waktu_in) = '$bulan'";
      $axis = "
      CONCAT(CASE 
            WHEN DAYOFMONTH(waktu_in) <= 10 THEN 1
            WHEN DAYOFMONTH( waktu_in ) > 10 AND DAYOFMONTH( waktu_in ) < 21 THEN 2
            ELSE 3
        END,'-',MONTH(waktu_in))
    ";
    }
    $agent_absen = $this->trans_profiling_daily->live_query("
      select t_absensi.agentid,waktu_in,$axis as bulan,DATE(waktu_in) as tanggalna FROM t_absensi 
      LEFT JOIN sys_user ON sys_user.agentid = t_absensi.agentid 
      WHERE 
      stts='in'
      AND YEAR(waktu_in) = $tahun
      $filter_template
      AND sys_user.kategori = 'REG' 
      AND sys_user.opt_level = 8 
    $filter_condition
    ")->result();
    if (count($agent_absen) > 0) {
      foreach ($agent_absen as $fr) {

        $to_time = strtotime($fr->waktu_in);
        $from_time = strtotime($fr->tanggalna . " 08:01:00");
        $durasi = $to_time - $from_time;

        if ($durasi > 0) {
          $data[$fr->agentid][$fr->bulan] = $data[$fr->agentid][$fr->bulan] + round(abs($to_time - $from_time) / 60, 2);
        }
      }
    }
    if (count($data)) {
      foreach ($data as $agentid => $data_bulan) {
        foreach ($data_bulan as $bulan => $valna) {
          $pencapaian = $valna;
          if ($pencapaian <= 0) {
            $lambat = 5;
          } elseif ($pencapaian <= 5) {
            $lambat = 2;
          } else {
            $lambat = 1;
          }
          $lambatna = ($lambat / 5) * 100;
          $data['bulan'][$bulan]['count'] = $data['bulan'][$bulan]['count'] + 1;
          $data['bulan'][$bulan]['sum'] = $lambatna + $data['bulan'][$bulan]['sum'];
        }
      }
    }

    return $data;
  }
  public function get_quality($date, $filter_condition, $template = "monthly")
  {
    $filter_condition = " AND sys_user.tl != '-' ";
    $data = array();
    $bobot = 30;
    $jumlah_entitas = 5;
    $tahun = date('Y', strtotime($date));
    $bulan = date('m', strtotime($date));
    $filter_template = "";
    $axis = "
    MONTH(qm_score.tanggal)
    ";
    if ($template == 'weekly') {
      $filter_template = " AND MONTH(qm_score.tanggal) = '$bulan'";
      $axis = "
      CONCAT(CASE 
            WHEN DAYOFMONTH(qm_score.tanggal) <= 10 THEN 1
            WHEN DAYOFMONTH( qm_score.tanggal ) > 10 AND DAYOFMONTH( qm_score.tanggal ) < 21 THEN 2
            ELSE 3
        END,'-',MONTH(qm_score.tanggal))
    ";
    }

    $quality = $this->trans_profiling_daily->live_query(
      "select
        qm_score.agentid as agentna,$axis as bulan,
        sum(IF(hasil = 1, bobot, 0 )) AS total ,
	      sum(IF(id_qm_score = 1, 1, 0 )) AS countna
        FROM
        qm_score 
          LEFT JOIN sys_user ON sys_user.agentid = qm_score.agentid 
        WHERE
         YEAR(qm_score.tanggal) = $tahun
         $filter_template
         AND sys_user.kategori = 'REG' 
          AND sys_user.opt_level = 8 
          $filter_condition
        GROUP BY
        sys_user.agentid,$axis
        ORDER BY tanggal ASC
      "
    )->result();
    if (count($quality) > 0) {
      foreach ($quality as $fr) {
        $pencapaian = ($fr->total / $fr->countna);
        if ($pencapaian > 90) {
          $target_call = 5;
        } elseif ($pencapaian > 70) {
          $target_call = 4;
        } elseif ($pencapaian > 50) {
          $target_call = 3;
        } elseif ($pencapaian > 30) {
          $target_call = 2;
        } else {
          $target_call = 1;
        }
        $nilai = ($target_call * $bobot) / $jumlah_entitas;

        $data[$fr->agentna][$fr->bulan]['nilai'] = $nilai;
        $data[$fr->agentna][$fr->bulan]['pencapaian'] = $pencapaian;
        $data['bulan'][$fr->bulan]['sum'] = $data['bulan'][$fr->bulan]['sum'] + $pencapaian;
        $data['bulan'][$fr->bulan]['count'] = $data['bulan'][$fr->bulan]['count'] + 1;
      }
    }
    return $data;
  }
  public function get_utilitas($date, $filter_condition, $template = "monthly")
  {
    $filter_condition = " AND sys_user.tl != '-' ";
    $data = array();
    $tahun = date('Y', strtotime($date));
    $bulan = date('m', strtotime($date));
    $bulanna_text = array(
      1 => "Jan",
      2 => "Feb",
      3 => "Mar",
      4 => "Apr",
      5 => "May",
      6 => "Jun",
      7 => "Jul",
      8 => "Aug",
      9 => "Sep",
      10 => "oct",
      11 => "Nov",
      12 => "Dec"
    );
    $filter_template = "";
    $axis = "
    MONTH(waktu_in)
    ";
    if ($template == 'weekly') {
      $filter_template = " AND MONTH(waktu_in) = '$bulan'";
      $axis = "
        CONCAT(CASE 
        WHEN DAYOFMONTH(waktu_in) <= 10 THEN 1
        WHEN DAYOFMONTH( waktu_in ) > 10 AND DAYOFMONTH( waktu_in ) < 21 THEN 2
        ELSE 3
          END,'-',MONTH(waktu_in))
      ";
    }
    $hk = $this->trans_profiling_daily->live_query("
    select t_absensi.agentid as agentna,$axis as bulan,DATE(waktu_in) as hk FROM t_absensi 
    LEFT JOIN sys_user ON sys_user.agentid = t_absensi.agentid 
    WHERE stts='in' 
    AND YEAR(waktu_in) = $tahun
    $filter_template
    AND sys_user.kategori = 'REG' 
    AND sys_user.opt_level = 8 
  $filter_condition
  GROUP BY t_absensi.agentid,$axis,DATE(waktu_in)
")->result();
    if (count($hk) > 0) {
      foreach ($hk as $fr) {
        $data[$fr->agentna][$fr->bulan]['hk'] = $data[$fr->agentna][$fr->bulan]['hk'] + 1;
      }
    }


    $agent_absen = $this->trans_profiling_daily->live_query("
      select t_absensi.agentid as agentna,$axis as bulan,count(t_absensi.id) as numna FROM t_absensi 
      LEFT JOIN sys_user ON sys_user.agentid = t_absensi.agentid 
      WHERE 
      stts='in'
      AND YEAR(waktu_in) = $tahun
      $filter_template
      AND sys_user.kategori = 'REG' 
      AND sys_user.opt_level = 8 
    $filter_condition
    GROUP BY t_absensi.agentid,$axis
    ")->result();
    if (count($agent_absen) > 0) {
      foreach ($agent_absen as $fr) {

        $pencapaian = $this->perhitungan_pencapaian($data[$fr->agentna][$fr->bulan]['hk'], $fr->numna);
        $data['bulan'][$fr->bulan]['count'] = $data['bulan'][$fr->bulan]['count'] + 1;
        $data['bulan'][$fr->bulan]['sum'] = $pencapaian['pencapaian'] + $data['bulan'][$fr->bulan]['sum'];
        $data['bulan'][$fr->bulan]['axis'] = $fr->bulan;
        $data[$fr->agentna][$fr->bulan] = $pencapaian;
      }
    }
    return $data;
  }
  public function perhitungan_pencapaian($hk, $realisasi)
  {
    $jam = 8;
    $menit = $jam * 60;
    $bobot = 30;
    $jumlah_entitas = 5;
    $target = $menit * $hk;
    $realisasi = $menit * $realisasi;
    $pencapaian = ($realisasi / $target) * 100;
    $utilitas = 0;
    if ($pencapaian >= 100) {
      $utilitas = 5;
    } elseif ($pencapaian >= 90) {
      $utilitas = 2;
    } else {
      $utilitas = 1;
    }
    $nilai = ($utilitas * $bobot) / $jumlah_entitas;
    $data['nilai'] = $nilai;
    $data['pencapaian'] = $pencapaian;
    return $data;
  }
  public function report_moss()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Report_profiling/summary_report_moss';
    $post = $this->input->get();
    $filter_condition = "";
    $data['condition'] = 1;
    $data['template'] = "monthly";
    $data['datena'] = date('Y-m-d');

    if (isset($post['datena'])) {
      $data['datena'] = $post['datena'];
    }

    $view = 'Report_profiling/summary_report_moss';
    if (isset($post['template']) && ($post['template'] == "weekly" || $post['template'] == "daily")) {
      $data['grafik'] = $this->report_weekly_moss($filter_condition, $data['datena'], $post['template']);

      $data['template'] = $post['template'];
    } else {
      // $data['revenue'] = $this->revenue_monthly_moss($filter_condition, $data['datena']);
      $data['grafik'] = $this->report_monthly_moss($filter_condition, $data['datena']);
    }
    $data['revenue'] = $this->revenue_weekly_moss($filter_condition, $data['datena'], $data['template']);
    $data['gagal_aktivasi'] = $this->gagal_aktivasi_moss($filter_condition, $data['datena'], $data['template']);

    $data['last_update'] = $this->trans_profiling_daily->get_row(array(), array("*"), array("lup" => "DESC"))->lup;
    $this->load->view($view, $data);
  }
  public function report_kpi()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Report_profiling/summary_kpi';
    $post = $this->input->get();
    $filter_condition = "";
    $data['condition'] = 1;
    $data['template'] = "monthly";
    $data['datena'] = date('Y-m-d');

    if (isset($post['condition']) && $post['condition'] == 2) {
      $filter_condition = " AND sys_user.tl != '-' ";
      $data['condition'] = 2;
    }
    if (isset($post['datena'])) {
      $data['datena'] = $post['datena'];
    }

    $view = 'Report_profiling/summary_kpi';
    $data['m'] = date('m', strtotime($data['datena']));
    $data['m'] = intval($data['m']);
    if (isset($post['template']) && $post['template'] == "weekly") {
      $bulanna_text = array(
        1 => "Jan",
        2 => "Feb",
        3 => "Mar",
        4 => "Apr",
        5 => "May",
        6 => "Jun",
        7 => "Jul",
        8 => "Aug",
        9 => "Sep",
        10 => "oct",
        11 => "Nov",
        12 => "Dec"
      );
      $m = date('m', strtotime($data['datena']));
      $num_week = $this->weekOfMonth($data['datena']);
      if ($num_week == '1next') {
        $m = date('m', strtotime('+7 day', strtotime($data['datena'])));
        $num_week = 1;
      }
      $data['m'] = $num_week . "-" . intval($m);
      $data['peformance'] = $this->summary_weekly_kpi($data['datena'], $filter_condition);
      $data['template'] = "weekly";
    } else {
      $data['peformance'] = $this->summary_kpi($data['datena'], $filter_condition);
    }
    $data['last_update'] = $this->trans_profiling_daily->get_row(array(), array("*"), array("lup" => "DESC"))->lup;
    $this->load->view($view, $data);
  }

  function weekOfMonth($date)
  {
    // estract date parts
    list($y, $m, $d) = explode('-', date('Y-m-d', strtotime($date)));

    // current week, min 1
    $w = 1;

    // for each day since the start of the month
    for ($i = 1; $i < $d; ++$i) {
      // if that day was a sunday and is not the first day of month
      if ($i > 1 && date('w', strtotime("$y-$m-$i")) == 0) {
        // increment current week
        ++$w;
      }
    }
    $mna = date('m', strtotime($date));
    if ($mna == '01') {
      if ($w > 5) {
        $w = '1next'; //So answer will be 1
      }
    } else {
      if ($w > 4) {
        $w = '1next'; //So answer will be 1
      }
    }

    // now return
    return $w;
  }
  function getweekOfMonth_2($date = false)
  {
    //Get the first day of the month.
    $date = "2021-01-31";
    // estract date parts
    list($y, $m, $d) = explode('-', date('Y-m-d', strtotime($date)));

    // current week, min 1
    $w = 1;

    // for each day since the start of the month
    for ($i = 1; $i < $d; ++$i) {
      // if that day was a sunday and is not the first day of month
      if ($i > 1 && date('w', strtotime("$y-$m-$i")) == 0) {
        // increment current week
        ++$w;
      }
    }

    // now return
    echo $w;
  }
  function getweekOfMonth($date = false)
  {
    $date = "2021-10-13";
    $date = new DateTime($date);
    $numweek = $date->format("W");
    $m = $date->format("m");
    if ($numweek > 4) {
      $WeekNo = $numweek - (4 * $m); // devide it with 7
    } else {
      $WeekNo = $numweek; // devide it with 7
    }

    echo $numweek . "-" . (4 * $m);
    echo "<br>" . $WeekNo;
    if ($WeekNo > 4) {
      $WeekNo = '1next'; //So answer will be 1
    }

    // return $WeekNo;
  }
  public function report_weekly_moss($filter_condition, $date, $template = 'weekly')
  {
    $date_now = strtotime($date);
    $w0 = date('Y-m-d', strtotime('last monday', $date_now));
    $w1 = date('Y-m-d', strtotime("-7 day", strtotime($w0)));
    $w2 = date('Y-m-d', strtotime("-7 day", strtotime($w1)));
    $w3 = date('Y-m-d', strtotime("-7 day", strtotime($w2)));
    $w4 = date('Y-m-d', strtotime("-7 day", strtotime($w3)));
    $bulanna_text = array(
      1 => "Jan",
      2 => "Feb",
      3 => "Mar",
      4 => "Apr",
      5 => "May",
      6 => "Jun",
      7 => "Jul",
      8 => "Aug",
      9 => "Sep",
      10 => "oct",
      11 => "Nov",
      12 => "Dec"
    );
    $last_week = date('Y-m-d', strtotime($w4));
    $new_week = date('Y-m-d', strtotime($date));
    // echo $w1."-".$w4;

    if ($template == 'daily') {
      $last_week = $w1;
    }
    $data['data_performance'] = $this->validasi_mos->live_query(
      "SELECT
        DATE(tgl_insert) as bulan,
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
        ( reason_call = 13 AND  (keterangan NOT LIKE '%galmit%' OR keterangan NOT LIKE '%gagal submit%'),TIMESTAMPDIFF(SECOND, tgl_insert, lup),0)
          ) AS slg ,
        SUM(
          IF
        ( reason_call = 13 AND  (keterangan NOT LIKE '%galmit%' OR keterangan NOT LIKE '%gagal submit%'),TIMESTAMPDIFF(SECOND, tgl_insert, click_time),0)
        ) AS slfc
        
        FROM
        trans_profiling_validasi_mos 
        WHERE
        DATE(tgl_insert) >= '$last_week'
        AND DATE(tgl_insert) <= '$new_week'
        AND update_by <> 'SYS'
        GROUP BY
        DATE(tgl_insert)
        ORDER BY tgl_insert ASC
      "
    )->result();
    $data['summary_performance'] = array();

    if (count($data['data_performance']) > 0) {
      foreach ($data['data_performance'] as $fr) {
        $m = date('m', strtotime($fr->bulan));
        $num_week = $this->weekOfMonth($fr->bulan);
        if ($num_week == '1next') {
          $m = date('m', strtotime('+7 day', strtotime($fr->bulan)));
          $num_week = 1;
        }
        $m = intval($m);
        $key = $num_week . "-" . $m;
        $axis = "W " . $num_week . " " . $bulanna_text[$m];
        if ($template == 'daily') {
          $key = $fr->bulan;
          $axis = $fr->bulan;
        }
        $data['summary_performance'][$key]['axis'] = $axis;
        $data['summary_performance'][$key]['oc'] = $fr->oc + $data['summary_performance'][$key]['oc'];
        $data['summary_performance'][$key]['contacted'] = $fr->contacted + $data['summary_performance'][$key]['contacted'];
        $data['summary_performance'][$key]['not_contacted'] = $data['summary_performance'][$key]['not_contacted'] + $fr->not_contacted;
        $data['summary_performance'][$key]['verified'] = $data['summary_performance'][$key]['verified'] + $fr->numna;
        $data['summary_performance'][$key]['slg'] = $data['summary_performance'][$key]['slg'] + $fr->slg;
        $data['summary_performance'][$key]['slfc'] = $data['summary_performance'][$key]['slfc'] + $fr->slfc;
      }
    }
    return $data;
  }
  public function gagal_aktivasi_moss($filter_condition, $date, $template = "weekly")
  {
    $date_now = strtotime($date);
    $w0 = date('Y-m-d', strtotime('last monday', $date_now));
    $bulan = date('m', $date_now);
    $tahun = date('Y', $date_now);
    $w1 = date('Y-m-d', strtotime("-7 day", strtotime($w0)));
    $w2 = date('Y-m-d', strtotime("-7 day", strtotime($w1)));
    $w3 = date('Y-m-d', strtotime("-7 day", strtotime($w2)));
    $w4 = date('Y-m-d', strtotime("-7 day", strtotime($w3)));
    $bulanna_text = array(
      1 => "Jan",
      2 => "Feb",
      3 => "Mar",
      4 => "Apr",
      5 => "May",
      6 => "Jun",
      7 => "Jul",
      8 => "Aug",
      9 => "Sep",
      10 => "oct",
      11 => "Nov",
      12 => "Dec"
    );
    $last_week = date('Y-m-d', strtotime($w4));
    $new_week = date('Y-m-d', strtotime($date));
    // echo $w1."-".$w4;
    $where = "DATE(tgl_insert) >= '$w0' ";
    $group_by = "DATE(tgl_insert)";

    if ($template == "monthly") {
      $where = "YEAR(tgl_insert) = '$tahun' ";
      $group_by = "MONTH(tgl_insert)";
    }
    $data['data_performance'] = $this->validasi_mos->live_query(
      "SELECT
        produk_mos,count(*) as numna
        FROM
        trans_profiling_validasi_mos 
        WHERE
        $where
        AND update_by <> 'SYS'
        AND jenis_aktivasi='pelanggan'
        AND reason_call = 13
        AND (sumber <> 'TVV')
        AND produk_mos <> '0'
        GROUP BY produk_mos
        ORDER BY count(*) DESC
      "
    )->result();
    $data['jumlah'] = $this->validasi_mos->live_query(
      "SELECT
        count(*) as numna
        FROM
        trans_profiling_validasi_mos 
        WHERE
        $where
        AND update_by <> 'SYS'
        AND jenis_aktivasi='pelanggan'
        AND reason_call = 13
        AND produk_mos <> '0'
        AND (sumber <> 'TVV')
      "
    )->row()->numna;
    $data['reason'] = array();
    $n = 0;
    if (count($data['data_performance']) > 0) {
      foreach ($data['data_performance'] as $fr) {
        if ($n > 3) {
          $data['reason']['Lain-lain']['axis'] = 'Lain-lain';
          $data['reason']['Lain-lain']['numna'] = $data['reason']['Lain-lain']['numna'] + $fr->numna;
        } else {
          $data['reason'][$fr->produk_mos]['axis'] = $fr->produk_mos;
          $data['reason'][$fr->produk_mos]['numna'] = $fr->numna;
        }
        $n++;
      }
    }
    return $data;
  }
  public function revenue_weekly_moss($filter_condition, $date, $template = 'weekly')
  {
    $date_now = strtotime($date);
    $bulan = date('m', $date_now);
    $tahun = date('Y', $date_now);
    $w0 = date('Y-m-d', strtotime('last monday', $date_now));
    $w1 = date('Y-m-d', strtotime("-7 day", strtotime($w0)));
    $w2 = date('Y-m-d', strtotime("-7 day", strtotime($w1)));
    $w3 = date('Y-m-d', strtotime("-7 day", strtotime($w2)));
    $w4 = date('Y-m-d', strtotime("-7 day", strtotime($w3)));
    $bulanna_text = array(
      1 => "Jan",
      2 => "Feb",
      3 => "Mar",
      4 => "Apr",
      5 => "May",
      6 => "Jun",
      7 => "Jul",
      8 => "Aug",
      9 => "Sep",
      10 => "oct",
      11 => "Nov",
      12 => "Dec"
    );
    $last_week = date('Y-m-d', strtotime($w4));
    $new_week = date('Y-m-d', strtotime($date));
    // echo $w1."-".$w4;
    if ($template == 'daily') {
      $last_week = $w1;
    }
    $where = "DATE(tgl_insert) >= '$last_week'
    AND DATE(tgl_insert) <= '$new_week' ";
    $group_by = "DATE(tgl_insert)";

    if ($template == "monthly") {
      $where = "YEAR(tgl_insert) = '$tahun' ";
      $group_by = "MONTH(tgl_insert)";
    }
    $data['data_performance'] = $this->validasi_mos->live_query(
      "SELECT
        $group_by as bulan,sum(a.harga) as numna,count(*) as countna
        FROM
        trans_profiling_validasi_mos LEFT JOIN infomedia_app.t_produk_moss a ON trans_profiling_validasi_mos.produk_mos = a.kode_chanel
        WHERE
        $where
        AND update_by <> 'SYS'
        AND jenis_aktivasi='agent'
        AND reason_call = 13
        GROUP BY
        $group_by
        ORDER BY tgl_insert ASC
      "
    )->result();
    $data['summary_revenue'] = array();

    if (count($data['data_performance']) > 0) {
      foreach ($data['data_performance'] as $fr) {

        if ($template == "monthly") {
          $data['summary_revenue'][$bulanna_text[$fr->bulan]]['axis'] = $bulanna_text[$fr->bulan];
          $data['summary_revenue'][$bulanna_text[$fr->bulan]]['revenue'] = $fr->numna + $data['summary_revenue'][$bulanna_text[$fr->bulan]]['revenue'];
          $data['summary_revenue'][$bulanna_text[$fr->bulan]]['count'] = $fr->countna + $data['summary_revenue'][$bulanna_text[$fr->bulan]]['count'];
        } else {
          $m = date('m', strtotime($fr->bulan));
          $num_week = $this->weekOfMonth($fr->bulan);
          if ($num_week == '1next') {
            $m = date('m', strtotime('+7 day', strtotime($fr->bulan)));
            $num_week = 1;
          }
          $m = intval($m);
          $key = $num_week . "-" . $m;
          $axis = "W " . $num_week . " " . $bulanna_text[$m];
          if ($template == 'daily') {
            $key = $fr->bulan;
            $axis = $fr->bulan;
          }
          $data['summary_revenue'][$key]['axis'] = $axis;
          $data['summary_revenue'][$key]['revenue'] = $fr->numna + $data['summary_revenue'][$key]['revenue'];
          $data['summary_revenue'][$key]['count'] = $fr->countna + $data['summary_revenue'][$key]['count'];
        }
      }
    }
    return $data;
  }
  function get_hourly_weekly_moss()
  {
    $post = $this->input->get();
    // if (isset($post['datena'])) {
    $data['datena'] = $post['datena'];
    $data['template'] = $post['template'];
    $filter_condition = $post['filter_condition'];
    // }
    $view = 'Report_profiling/get_hourly_moss';
    $data['hourly'] = $this->report_hourly_moss($filter_condition, $data['datena'], $data['template']);
    $data['filter_condition'] = $filter_condition;
    $this->load->view($view, $data);
  }
  public function report_hourly_moss($filter_condition, $date, $template = "weekly")
  {
    $date_now = strtotime($date);
    $bulan = date('m', $date_now);
    $tahun = date('Y', $date_now);
    $w0 = date('Y-m-d', strtotime('last monday', $date_now));
    $w1 = date('Y-m-d', strtotime("-7 day", strtotime($w0)));
    $w2 = date('Y-m-d', strtotime("-7 day", strtotime($w1)));
    $w3 = date('Y-m-d', strtotime("-7 day", strtotime($w2)));
    $w4 = date('Y-m-d', strtotime("-7 day", strtotime($w3)));
    $bulanna_text = array(
      1 => "Jan",
      2 => "Feb",
      3 => "Mar",
      4 => "Apr",
      5 => "May",
      6 => "Jun",
      7 => "Jul",
      8 => "Aug",
      9 => "Sep",
      10 => "oct",
      11 => "Nov",
      12 => "Dec"
    );
    $last_week = date('Y-m-d', strtotime($w4));
    $new_week = date('Y-m-d', strtotime($date));
    // echo $w1."-".$w4;
    if ($template == 'daily') {
      $last_week = $w1;
    }
    $where = "DATE(tgl_insert) >= '$last_week'
    AND DATE(tgl_insert) <= '$new_week' ";
    $group_by = "DATE(tgl_insert)";
    if ($template == "monthly") {
      $where = "YEAR(tgl_insert) = '$tahun' ";
      $group_by = "MONTH(tgl_insert)";
    }
    $data['data_performance'] = $this->validasi_mos->live_query(
      "SELECT
        $group_by as bulan,HOUR(tgl_insert) as hour_lup,
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
        sum(TIMESTAMPDIFF(SECOND, tgl_insert, lup)) AS slg ,
        sum(TIMESTAMPDIFF(SECOND, tgl_insert, click_time)) AS slfc 
        
        FROM
        trans_profiling_validasi_mos 
        WHERE
        $where
        AND update_by <> 'SYS'
        GROUP BY
        $group_by,HOUR(tgl_insert)
        ORDER BY tgl_insert ASC
      "
    )->result();
    $data['hourly_performance'] = array();

    if (count($data['data_performance']) > 0) {
      foreach ($data['data_performance'] as $fr) {

        if ($template == "monthly") {

          $data['hourly_performance']['axis_param'][$bulanna_text[$fr->bulan]] = $bulanna_text[$fr->bulan];
          $data['hourly_performance']['axis'][$bulanna_text[$fr->bulan]] = $bulanna_text[$fr->bulan];
          $data['hourly_performance'][$bulanna_text[$fr->bulan]]['axis'] = $bulanna_text[$fr->bulan];
          $data['hourly_performance'][$bulanna_text[$fr->bulan]]['_' . $fr->hour_lup]['axis'] = $fr->hour_lup;
          $data['hourly_performance'][$bulanna_text[$fr->bulan]]['_' . $fr->hour_lup]['oc'] = $data['hourly_performance'][$bulanna_text[$fr->bulan]]['_' . $fr->hour_lup]['oc'] + $fr->oc;
          $data['hourly_performance'][$bulanna_text[$fr->bulan]]['_' . $fr->hour_lup]['contacted'] = $data['hourly_performance'][$bulanna_text[$fr->bulan]]['_' . $fr->hour_lup]['contacted'] + $fr->contacted;
          $data['hourly_performance'][$bulanna_text[$fr->bulan]]['_' . $fr->hour_lup]['not_contacted'] = $data['hourly_performance'][$bulanna_text[$fr->bulan]]['_' . $fr->hour_lup]['not_contacted'] + $fr->not_contacted;
          $data['hourly_performance'][$bulanna_text[$fr->bulan]]['_' . $fr->hour_lup]['verified'] = $data['hourly_performance'][$bulanna_text[$fr->bulan]]['_' . $fr->hour_lup]['verified'] + $fr->numna;
        } else {
          $m = date('m', strtotime($fr->bulan));
          $num_week = $this->weekOfMonth($fr->bulan);
          if ($num_week == '1next') {
            $m = date('m', strtotime('+7 day', strtotime($fr->bulan)));
            $num_week = 1;
          }
          $m = intval($m);
          $key = $num_week . "_" . $m;
          $axis = "W " . $num_week . " " . $bulanna_text[$m];
          if ($template == 'daily') {
            $key = $fr->bulan;
            $axis = $fr->bulan;
          }
          $data['hourly_performance']['axis_param'][$key] = $axis;
          $data['hourly_performance']['axis'][$key] = $axis;
          $data['hourly_performance'][$key]['axis'] = $axis;
          $data['hourly_performance'][$key]['_' . $fr->hour_lup]['axis'] = $fr->hour_lup;
          $data['hourly_performance'][$key]['_' . $fr->hour_lup]['oc'] = $fr->oc + $data['hourly_performance'][$key]['_' . $fr->hour_lup]['oc'];
          $data['hourly_performance'][$key]['_' . $fr->hour_lup]['contacted'] = $fr->contacted + $data['hourly_performance'][$key]['_' . $fr->hour_lup]['contacted'];
          $data['hourly_performance'][$key]['_' . $fr->hour_lup]['not_contacted'] = $data['hourly_performance'][$key]['_' . $fr->hour_lup]['not_contacted'] + $fr->not_contacted;
          $data['hourly_performance'][$key]['_' . $fr->hour_lup]['verified'] = $data['hourly_performance'][$key]['_' . $fr->hour_lup]['verified'] + $fr->numna;

          $data['hourly_performance'][$key]['_' . $fr->hour_lup]['slg'] = $data['hourly_performance'][$key]['_' . $fr->hour_lup]['slg'] + $fr->slg;
          $data['hourly_performance'][$key]['_' . $fr->hour_lup]['slfc'] = $data['hourly_performance'][$key]['_' . $fr->hour_lup]['slfc'] + $fr->slfc;
        }
      }
    }
    return $data;
  }
  public function report_monthly_moss($filter_condition, $date)
  {
    $bulan = date('m', strtotime($date));
    $tahun = date('Y', strtotime($date));

    $bulanna = array(
      1 => "January",
      2 => "February",
      3 => "March",
      4 => "April",
      5 => "May",
      6 => "June",
      7 => "July",
      8 => "August",
      9 => "September",
      10 => "October",
      11 => "November",
      12 => "December"
    );
    $data['data_performance'] = $this->validasi_mos->live_query(
      "SELECT
        MONTH(tgl_insert) as bulan,
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
        ( reason_call = 13 AND  (keterangan NOT LIKE '%galmit%' OR keterangan NOT LIKE '%gagal submit%'),TIMESTAMPDIFF(SECOND, tgl_insert, lup),0)
          ) AS slg ,
        SUM(
          IF
        ( reason_call = 13 AND  (keterangan NOT LIKE '%galmit%' OR keterangan NOT LIKE '%gagal submit%'),TIMESTAMPDIFF(SECOND, tgl_insert, click_time),0)
        ) AS slfc
        FROM
        trans_profiling_validasi_mos 
        WHERE
         YEAR(tgl_insert) = $tahun
         AND update_by <> 'SYS'
        GROUP BY
        MONTH(tgl_insert)
        ORDER BY tgl_insert ASC
      "
    )->result();
    if (count($data['data_performance']) > 0) {
      foreach ($data['data_performance'] as $fr) {

        $data['summary_performance'][$fr->bulan]['axis'] = $bulanna[$fr->bulan];
        $data['summary_performance'][$fr->bulan]['oc'] = $fr->oc;
        $data['summary_performance'][$fr->bulan]['contacted'] = $fr->contacted;
        $data['summary_performance'][$fr->bulan]['not_contacted'] = $fr->not_contacted;
        $data['summary_performance'][$fr->bulan]['verified'] = $fr->numna;
        $data['summary_performance'][$fr->bulan]['slg'] = $fr->slg;
        $data['summary_performance'][$fr->bulan]['slfc'] = $fr->slfc;
      }
    }
    return $data;
  }
  public function report_weekly($filter_condition, $date, $template = 'weekly')
  {
    $date_now = strtotime($date);
    $w0 = date('Y-m-d', strtotime('last monday', $date_now));
    $w1 = date('Y-m-d', strtotime("-7 day", strtotime($w0)));
    $w2 = date('Y-m-d', strtotime("-7 day", strtotime($w1)));
    $w3 = date('Y-m-d', strtotime("-7 day", strtotime($w2)));
    $w4 = date('Y-m-d', strtotime("-7 day", strtotime($w3)));

    $bulanna_text = array(
      1 => "Jan",
      2 => "Feb",
      3 => "Mar",
      4 => "Apr",
      5 => "May",
      6 => "Jun",
      7 => "Jul",
      8 => "Aug",
      9 => "Sep",
      10 => "oct",
      11 => "Nov",
      12 => "Dec"
    );
    $last_week = date('Y-m-d', strtotime($w4));
    $new_week = date('Y-m-d', strtotime($w0));
    if ($template == 'daily') {
      $last_week = $w1;
    }
    // echo $w1."-".$w4;
    $data['data_performance'] = $this->trans_profiling_daily->live_query(
      "SELECT
        DATE(db_profiling.trans_profiling.lup) as bulan,
          count(db_profiling.trans_profiling.idx ) AS oc,
          sum(
          IF
          (db_profiling.trans_profiling.veri_call IN ( 1, 13, 3, 12, 11 ), 1, 0 )) AS contacted,
          sum(
          IF
          (db_profiling.trans_profiling.veri_call IN ( 15, 9, 8, 4, 7, 10, 14, 2 ), 1, 0 )) AS not_contacted,
          sum(
        IF
        (db_profiling.trans_profiling.veri_call = 13, 1, 0 )) AS numna 
        FROM
        db_profiling.trans_profiling 
          LEFT JOIN sys_user ON sys_user.agentid = db_profiling.trans_profiling.veri_upd 
        WHERE
        DATE(db_profiling.trans_profiling.lup) >= '$last_week'
        AND DATE(db_profiling.trans_profiling.lup) <= '$date'
         AND sys_user.kategori = 'REG' 
          AND sys_user.opt_level = 8 
          $filter_condition
        GROUP BY
        DATE(db_profiling.trans_profiling.lup)
        ORDER BY db_profiling.trans_profiling.lup ASC
      "
    )->result();
    $data['summary_performance'] = array();

    if (count($data['data_performance']) > 0) {
      foreach ($data['data_performance'] as $fr) {
        $m = date('m', strtotime($fr->bulan));
        $num_week = $this->weekOfMonth($fr->bulan);
        if ($num_week == '1next') {
          $m = date('m', strtotime('+7 day', strtotime($fr->bulan)));
          $num_week = 1;
        }
        $m = intval($m);

        $key = $num_week . "-" . $m;
        $axis = "W " . $num_week . " " . $bulanna_text[$m];
        if ($template == 'daily') {
          $key = $fr->bulan;
          $axis = $fr->bulan;
        }
        $data['summary_performance'][$key]['axis'] = $axis;
        $data['summary_performance'][$key]['oc'] = $fr->oc + $data['summary_performance'][$key]['oc'];
        $data['summary_performance'][$key]['contacted'] = $fr->contacted + $data['summary_performance'][$key]['contacted'];
        $data['summary_performance'][$key]['not_contacted'] = $data['summary_performance'][$key]['not_contacted'] + $fr->not_contacted;
        $data['summary_performance'][$key]['verified'] = $data['summary_performance'][$key]['verified'] + $fr->numna;
      }
    }
    return $data;
  }
  public function report_monthly($filter_condition, $date)
  {

    $bulan = date('m', strtotime($date));
    $tahun = date('Y', strtotime($date));

    $bulanna = array(
      1 => "January",
      2 => "February",
      3 => "March",
      4 => "April",
      5 => "May",
      6 => "June",
      7 => "July",
      8 => "August",
      9 => "September",
      10 => "October",
      11 => "November",
      12 => "December"
    );
    $data['data_performance'] = $this->trans_profiling_daily->live_query(
      "SELECT
        bulan,
          sum( jumlah ) AS oc,
          SUM(
          IF
          ( veri_call IN ( 1, 13, 3, 12, 11 ), jumlah, 0 )) AS contacted,
          SUM(
          IF
          ( veri_call IN ( 15, 9, 8, 4, 7, 10, 14, 2 ), jumlah, 0 )) AS not_contacted,
          SUM(
        IF
        ( veri_call = 13, jumlah, 0 )) AS numna 
        FROM
        summary_trans_profiling 
          LEFT JOIN sys_user ON sys_user.agentid = veri_upd 
        WHERE
         tahun = $tahun
          -- AND bulan = $bulan
         AND sys_user.kategori = 'REG' 
          AND sys_user.opt_level = 8 
          $filter_condition
        GROUP BY
        bulan
        ORDER BY bulan ASC
      "
    )->result();
    if (count($data['data_performance']) > 0) {
      foreach ($data['data_performance'] as $fr) {

        $data['summary_performance'][$fr->bulan]['axis'] = $bulanna[$fr->bulan];
        $data['summary_performance'][$fr->bulan]['oc'] = $fr->oc;
        $data['summary_performance'][$fr->bulan]['contacted'] = $fr->contacted;
        $data['summary_performance'][$fr->bulan]['not_contacted'] = $fr->not_contacted;
        $data['summary_performance'][$fr->bulan]['verified'] = $fr->numna;
      }
    }
    return $data;
  }
  public function summary_kpi($date, $filter_condition)
  {
    $tahun = date('Y', strtotime($date));
    $bulan = date('m', strtotime($date));
    $bulanna = array(
      1 => "January",
      2 => "February",
      3 => "March",
      4 => "April",
      5 => "May",
      6 => "June",
      7 => "July",
      8 => "August",
      9 => "September",
      10 => "October",
      11 => "November",
      12 => "December"
    );
    $target = 110;
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
    $data['data_performance'] = $this->trans_profiling_daily->live_query(
      "SELECT
         bulan,
          sum( jumlah ) AS oc,
          SUM(
          IF
          ( veri_call IN ( 1, 13, 3, 12, 11 ), jumlah, 0 )) AS contacted,
          SUM(
          IF
          ( veri_call IN ( 15, 9, 8, 4, 7, 10, 14, 2 ), jumlah, 0 )) AS not_contacted,
          SUM(
        IF
        ( veri_call = 13, jumlah, 0 )) AS numna 
        FROM
        summary_trans_profiling 
          LEFT JOIN sys_user ON sys_user.agentid = veri_upd 
        WHERE
         tahun = $tahun
         AND sys_user.kategori = 'REG' 
          AND sys_user.opt_level = 8 
          $filter_condition
          GROUP BY
          bulan
        ORDER BY bulan ASC
      "
    )->result();

    if (count($data['data_performance']) > 0) {
      foreach ($data['data_performance'] as $fr) {

        $data['summary_performance'][$fr->bulan]['oc'] = $fr->oc;
        $data['summary_performance'][$fr->bulan]['contacted'] = $fr->contacted;
        $data['summary_performance'][$fr->bulan]['not_contacted'] = $fr->not_contacted;
        $data['summary_performance'][$fr->bulan]['verified'] = $fr->numna;
      }
    }



    $hk = $this->trans_profiling_daily->live_query("
            select MONTH(waktu_in) as bulan,DATE(waktu_in) as hk FROM t_absensi 
            LEFT JOIN sys_user ON sys_user.agentid = t_absensi.agentid 
            WHERE stts='in' 
            AND YEAR(waktu_in) = $tahun
            AND sys_user.kategori = 'REG' 
            AND sys_user.opt_level = 8 
          $filter_condition
          GROUP BY MONTH(waktu_in),DATE(waktu_in)
    ")->result();
    if (count($hk) > 0) {
      foreach ($hk as $fr) {

        $data['summary_performance'][$fr->bulan]['hk'] = $data['summary_performance'][$fr->bulan]['hk'] + 1;
      }
    }

    $agent_absen = $this->trans_profiling_daily->live_query("
            select MONTH(waktu_in) as bulan,count(t_absensi.agentid) as numna FROM t_absensi 
            LEFT JOIN sys_user ON sys_user.agentid = t_absensi.agentid 
            WHERE stts='in'
            AND YEAR(waktu_in) = $tahun
            AND sys_user.kategori = 'REG' 
            AND sys_user.opt_level = 8 
          $filter_condition
          GROUP BY MONTH(waktu_in)
    ")->result();
    if (count($agent_absen) > 0) {
      foreach ($agent_absen as $fr) {
        $data['summary_performance'][$fr->bulan]['agent_absen'] = $fr->numna;
      }
    }



    $recording = $this->trans_profiling_daily->live_query("
    SELECT
    bulan,SUM(countna) as sumna,count(countna) as numcount
  FROM
    ( 
    SELECT MONTH(calldate) AS bulan,dst,COUNT( uniqueid ) AS countna FROM cdr
  WHERE
      YEAR(calldate) = $tahun
      AND (dst <> '61V' OR dst <> '618')
      GROUP BY MONTH(calldate),dst 
    ) AS A 
    GROUP BY bulan
    ")->result();
    if (count($recording) > 0) {
      foreach ($recording as $fr) {
        $data['summary_performance'][$fr->bulan]['recording']['sumna'] = $fr->sumna;
        $data['summary_performance'][$fr->bulan]['recording']['numcount'] = $fr->numcount;
      }
    }
    $recording_duration = $this->trans_profiling_daily->live_query("
      SELECT
      MONTH(calldate) AS bulan,SUM(duration) as sumna,count(uniqueid) as countna
    FROM
       cdr
    WHERE
        YEAR(calldate) = $tahun
        AND (dst <> '61V' OR dst <> '618')
        AND disposition = 'ANSWERED'
        GROUP BY MONTH(calldate)
      ")->result();
    if (count($recording_duration) > 0) {
      foreach ($recording_duration as $fr) {
        $data['summary_performance'][$fr->bulan]['recording_duration']['sumna'] = $fr->sumna;
        $data['summary_performance'][$fr->bulan]['recording_duration']['countna'] = $fr->countna;
      }
    }
    $first_call_close = $this->trans_profiling_daily->live_query("
        SELECT
          MONTH(calldate) as bulan,dst
        FROM
        cdr
        WHERE 
          YEAR(calldate) = $tahun
          AND (dst <> '61V' OR dst <> '618')
          AND disposition = 'ANSWERED'
        GROUP BY
         MONTH(calldate),dst 
        HAVING
          COUNT( DISTINCT uniqueid ) =1
      ")->result();
    if (count($first_call_close) > 0) {
      foreach ($first_call_close as $fr) {
        $data['summary_performance'][$fr->bulan]['first_call_close'] = $data['summary_performance'][$fr->bulan]['first_call_close'] + 1;
      }
    }
    $data['summary'] = array();

    if (count($data['summary_performance']) > 0) {
      $before = "-";
      foreach ($data['summary_performance'] as $bulan => $datana) {
        $data['summary'][$bulan]['before'] = $before;
        $data['summary'][$bulan]['axis'] = $bulanna[$bulan];
        $data['summary'][$bulan]['agent_online'] = $datana['agent_absen'];
        $data['summary'][$bulan]['hk'] = $datana['hk'];

        $data['summary'][$bulan]['cfa'] = ($datana['oc'] / $datana['agent_absen']);

        $data['summary'][$bulan]['cfn'] = $datana['recording']['sumna'] / $datana['recording']['numcount'];
        $data['summary'][$bulan]['cfh'] = ($datana['oc'] / ($datana['agent_absen'] * 8));

        $data['summary'][$bulan]['aht_num'] =  $datana['recording_duration']['sumna'] / $datana['recording_duration']['countna'];
        $slfc_minute = ($data['summary'][$bulan]['aht_num']) / 60;
        $kelebihan_detik_slfc = (($data['summary'][$bulan]['aht_num']) - (intval($slfc_minute, 0) * 60));
        $data['summary'][$bulan]['aht'] = sprintf("%02d", intval($slfc_minute, 0)) . ":" . sprintf("%02d", intval($kelebihan_detik_slfc));
        $data['summary'][$bulan]['hitrate'] = ($datana['verified'] / ($datana['oc'] - $datana['verified'])) * 100;
        $data['summary'][$bulan]['lcr'] = ($datana['contacted'] / ($datana['oc'] + $data['wo'])) * 100;
        $data['summary'][$bulan]['fcc'] = $datana['first_call_close'];
        $data['summary'][$bulan]['ppa'] = $datana['verified'] / $datana['agent_absen'];
        $data['summary'][$bulan]['cvr'] = ($datana['verified'] / $datana['oc']) * 100;
        $data['summary'][$bulan]['svr'] = ($datana['verified'] / $datana['contacted']) * 100;

        $data['summary'][$bulan]['ecip'] = ($datana['verified'] / (($datana['agent_absen'] * $target))) * 100;
        $data['summary'][$bulan]['call_rate'] = (($datana['recording_duration']['sumna'] / 60) / ((480 * $datana['agent_absen'])) * 100);
        $before = $bulan;
      }
    }
    return $data;
  }
  public function summary_weekly_kpi($date, $filter_condition)
  {
    $date_now = strtotime($date);
    $w0 = date('Y-m-d', strtotime('last monday', $date_now));
    $w1 = date('Y-m-d', strtotime("-7 day", strtotime($w0)));
    $w2 = date('Y-m-d', strtotime("-7 day", strtotime($w1)));
    $w3 = date('Y-m-d', strtotime("-7 day", strtotime($w2)));
    $w4 = date('Y-m-d', strtotime("-7 day", strtotime($w3)));

    $bulanna_text = array(
      1 => "Jan",
      2 => "Feb",
      3 => "Mar",
      4 => "Apr",
      5 => "May",
      6 => "Jun",
      7 => "Jul",
      8 => "Aug",
      9 => "Sep",
      10 => "oct",
      11 => "Nov",
      12 => "Dec"
    );
    $last_week = date('Y-m-d', strtotime($w4));
    $new_week = date('Y-m-d', strtotime($w0));
    $tahun = date('Y', strtotime($date));
    $bulan = date('m', strtotime($date));

    $target = 110;
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
    $data['data_performance'] = $this->trans_profiling_daily->live_query(
      "SELECT
         DATE(db_profiling.trans_profiling.lup) as bulan,
          count( idx ) AS oc,
          SUM(
          IF
          ( veri_call IN ( 1, 13, 3, 12, 11 ), 1, 0 )) AS contacted,
          SUM(
          IF
          ( veri_call IN ( 15, 9, 8, 4, 7, 10, 14, 2 ), 1, 0 )) AS not_contacted,
          SUM(
        IF
        ( veri_call = 13, 1, 0 )) AS numna 
        FROM
        db_profiling.trans_profiling 
          LEFT JOIN sys_user ON sys_user.agentid = veri_upd 
        WHERE
        DATE(db_profiling.trans_profiling.lup) >= '$last_week'
        AND DATE(db_profiling.trans_profiling.lup) <= '$date'
         AND sys_user.kategori = 'REG' 
          AND sys_user.opt_level = 8 
          $filter_condition
          GROUP BY
          DATE(db_profiling.trans_profiling.lup)
        ORDER BY lup ASC
      "
    )->result();

    if (count($data['data_performance']) > 0) {
      foreach ($data['data_performance'] as $fr) {
        $m = date('m', strtotime($fr->bulan));
        $num_week = $this->weekOfMonth($fr->bulan);
        if ($num_week == '1next') {
          $m = date('m', strtotime('+7 day', strtotime($fr->bulan)));
          $num_week = 1;
        }
        $m = intval($m);

        $data['summary_performance'][$num_week . "-" . $m]['oc'] = $data['summary_performance'][$num_week . "-" . $m]['oc'] + $fr->oc;
        $data['summary_performance'][$num_week . "-" . $m]['contacted'] = $data['summary_performance'][$num_week . "-" . $m]['contacted'] + $fr->contacted;
        $data['summary_performance'][$num_week . "-" . $m]['not_contacted'] = $data['summary_performance'][$num_week . "-" . $m]['not_contacted'] + $fr->not_contacted;
        $data['summary_performance'][$num_week . "-" . $m]['verified'] = $data['summary_performance'][$num_week . "-" . $m]['verified'] + $fr->numna;
      }
    }



    $hk = $this->trans_profiling_daily->live_query("
            select DATE(waktu_in) as bulan FROM t_absensi 
            LEFT JOIN sys_user ON sys_user.agentid = t_absensi.agentid 
            WHERE stts='in' 
            AND DATE(waktu_in) >= '$last_week'
        AND DATE(waktu_in) <= '$date'
            AND sys_user.kategori = 'REG' 
            AND sys_user.opt_level = 8 
          $filter_condition
          GROUP BY DATE(waktu_in)
    ")->result();
    if (count($hk) > 0) {
      foreach ($hk as $fr) {
        $m = date('m', strtotime($fr->bulan));
        $num_week = $this->weekOfMonth($fr->bulan);
        if ($num_week == '1next') {
          $m = date('m', strtotime('+7 day', strtotime($fr->bulan)));
          $num_week = 1;
        }
        $m = intval($m);

        $data['summary_performance'][$num_week . "-" . $m]['hk'] = $data['summary_performance'][$num_week . "-" . $m]['hk'] + 1;
      }
    }

    $agent_absen = $this->trans_profiling_daily->live_query("
            select DATE(waktu_in) as bulan,count(t_absensi.agentid) as numna FROM t_absensi 
            LEFT JOIN sys_user ON sys_user.agentid = t_absensi.agentid 
            WHERE stts='in'
            AND DATE(waktu_in) >= '$last_week'
        AND DATE(waktu_in) <= '$date'
            AND sys_user.kategori = 'REG' 
            AND sys_user.opt_level = 8 
          $filter_condition
          GROUP BY DATE(waktu_in)
    ")->result();
    if (count($agent_absen) > 0) {
      foreach ($agent_absen as $fr) {
        $m = date('m', strtotime($fr->bulan));
        $num_week = $this->weekOfMonth($fr->bulan);
        if ($num_week == '1next') {
          $m = date('m', strtotime('+7 day', strtotime($fr->bulan)));
          $num_week = 1;
        }
        $m = intval($m);

        $data['summary_performance'][$num_week . "-" . $m]['agent_absen'] = $data['summary_performance'][$num_week . "-" . $m]['agent_absen'] + $fr->numna;
      }
    }



    $recording = $this->trans_profiling_daily->live_query("
    SELECT
    bulan,SUM(countna) as sumna,count(countna) as numcount
  FROM
    ( 
    SELECT DATE(calldate) AS bulan,dst,COUNT( uniqueid ) AS countna FROM cdr
  WHERE
  DATE(calldate) >= '$last_week'
  AND DATE(calldate) <= '$date'
      AND (dst <> '61V' OR dst <> '618')
      GROUP BY DATE(calldate),dst 
    ) AS A 
    GROUP BY bulan
    ")->result();
    if (count($recording) > 0) {
      foreach ($recording as $fr) {
        $m = date('m', strtotime($fr->bulan));
        $num_week = $this->weekOfMonth($fr->bulan);
        if ($num_week == '1next') {
          $m = date('m', strtotime('+7 day', strtotime($fr->bulan)));
          $num_week = 1;
        }
        $m = intval($m);

        $data['summary_performance'][$num_week . "-" . $m]['recording']['sumna'] = $data['summary_performance'][$num_week . "-" . $m]['recording']['sumna'] + $fr->sumna;
        $data['summary_performance'][$num_week . "-" . $m]['recording']['numcount'] = $data['summary_performance'][$num_week . "-" . $m]['recording']['numcount'] + $fr->numcount;
      }
    }
    $recording_duration = $this->trans_profiling_daily->live_query("
      SELECT
      DATE(calldate) AS bulan,SUM(duration) as sumna,count(uniqueid) as countna
    FROM
       cdr
    WHERE
    DATE(calldate) >= '$last_week'
    AND DATE(calldate) <= '$date'
        AND (dst <> '61V' OR dst <> '618')
        AND disposition = 'ANSWERED'
        GROUP BY DATE(calldate)
      ")->result();
    if (count($recording_duration) > 0) {
      foreach ($recording_duration as $fr) {
        $m = date('m', strtotime($fr->bulan));
        $num_week = $this->weekOfMonth($fr->bulan);
        if ($num_week == '1next') {
          $m = date('m', strtotime('+7 day', strtotime($fr->bulan)));
          $num_week = 1;
        }
        $m = intval($m);

        $data['summary_performance'][$num_week . "-" . $m]['recording_duration']['sumna'] = $data['summary_performance'][$num_week . "-" . $m]['recording_duration']['sumna'] + $fr->sumna;
        $data['summary_performance'][$num_week . "-" . $m]['recording_duration']['countna'] = $data['summary_performance'][$num_week . "-" . $m]['recording_duration']['countna'] + $fr->countna;
      }
    }
    $first_call_close = $this->trans_profiling_daily->live_query("
        SELECT
          DATE(calldate) as bulan,dst
        FROM
        cdr
        WHERE 
        DATE(calldate) >= '$last_week'
        AND DATE(calldate) <= '$date'
          AND (dst <> '61V' OR dst <> '618')
          AND disposition = 'ANSWERED'
        GROUP BY
        DATE(calldate),dst 
        HAVING
          COUNT( DISTINCT uniqueid ) =1
      ")->result();
    if (count($first_call_close) > 0) {
      foreach ($first_call_close as $fr) {
        $m = date('m', strtotime($fr->bulan));
        $num_week = $this->weekOfMonth($fr->bulan);
        if ($num_week == '1next') {
          $m = date('m', strtotime('+7 day', strtotime($fr->bulan)));
          $num_week = 1;
        }
        $m = intval($m);

        $data['summary_performance'][$num_week . "-" . $m]['first_call_close'] = $data['summary_performance'][$num_week . "-" . $m]['first_call_close'] + 1;
      }
    }
    $data['summary'] = array();
    $u = 1;
    if (count($data['summary_performance']) > 0) {
      $before = "-";
      foreach ($data['summary_performance'] as $bulan => $datana) {
        $axisna = explode("-", $bulan);
        $data['summary'][$bulan]['before'] = $before;
        $data['summary'][$bulan]['axis'] = "W " . $axisna[0] . " " . $bulanna_text[$axisna[1]];
        $data['summary'][$bulan]['agent_online'] = $datana['agent_absen'];
        $data['summary'][$bulan]['hk'] = $datana['hk'];

        $data['summary'][$bulan]['cfa'] = ($datana['oc'] / $datana['agent_absen']);

        $data['summary'][$bulan]['cfn'] = $datana['recording']['sumna'] / $datana['recording']['numcount'];
        $data['summary'][$bulan]['cfh'] = ($datana['oc'] / ($datana['agent_absen'] * 8));

        $data['summary'][$bulan]['aht_num'] =  $datana['recording_duration']['sumna'] / $datana['recording_duration']['countna'];
        $slfc_minute = ($data['summary'][$bulan]['aht_num']) / 60;
        $kelebihan_detik_slfc = (($data['summary'][$bulan]['aht_num']) - (intval($slfc_minute, 0) * 60));
        $data['summary'][$bulan]['aht'] = sprintf("%02d", intval($slfc_minute, 0)) . ":" . sprintf("%02d", intval($kelebihan_detik_slfc));
        $data['summary'][$bulan]['hitrate'] = ($datana['verified'] / ($datana['oc'] - $datana['verified'])) * 100;
        $data['summary'][$bulan]['lcr'] = ($datana['contacted'] / ($datana['oc'] + $data['wo'])) * 100;
        $data['summary'][$bulan]['fcc'] = $datana['first_call_close'];
        $data['summary'][$bulan]['ppa'] = $datana['verified'] / $datana['agent_absen'];
        $data['summary'][$bulan]['cvr'] = ($datana['verified'] / $datana['oc']) * 100;
        $data['summary'][$bulan]['svr'] = ($datana['verified'] / $datana['contacted']) * 100;

        $data['summary'][$bulan]['ecip'] = ($datana['verified'] / (($datana['agent_absen'] * $target))) * 100;
        $data['summary'][$bulan]['call_rate'] = (($datana['recording_duration']['sumna'] / 60) / ((480 * $datana['agent_absen'])) * 100);

        $before = $bulan;
      }
    }
    return $data;
  }
  public function kpi()
  {
    $view = 'report/kpi';
    $data['controller'] = $this;
    $data['title_page_big']     =   '';
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $data['agent'] = $this->Sys_user_table_model->get_results(array("opt_level" => 8, "kategori" => "REG", "tl !=" => "-"));

    if (isset($_POST['start'])) {
      $data['start'] = '2020-08-01';
      $data['end'] = '2020-08-01';
      $data['end_tgl'] = '2020-08-31';
      $str = '2020-08-01'; // Missed semicolon here
      $time = strtotime($str);

      // You can now use date() functions with $time, like
      $bulan = date("m", $time); // Wednesday or whatever date it is  
      $tahun = date("Y", $time); // Wednesday or whatever date it is  
      $table_recording = "cdr_082020";
      $table_trans_profiling = "report_082020";
      $this->load->model('Report_model/' . ucwords($table_recording) . '_model', $table_recording);
      $this->load->model('Report_model/' . ucwords($table_trans_profiling) . '_model', $table_trans_profiling);
      $time1 = strtotime('08:00:00');
      $time2 = strtotime('20:00:00');
      $data['end'] = date($data['end'] . ' 23:59:00');
      // echo $data['end'];
      // $data['end'] = $last_recording->calldate;
      // $time2 = strtotime(date("H:i:s", strtotime($data['end'])));
      $duration = abs($time2 - $time1);
      // echo $duration;
      // exit();
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
      $summary_peformance = $this->summary_peformance($table_trans_profiling, $data['start'], $data['end'], $userdata);
      /**********effetive time **********/
      $data['effective_time'] = $this->get_effective_time($table_trans_profiling, $table_recording);
      $no_hp_veri = $data['effective_time']['hp_veri'];
      // echo $no_hp_veri;

      //RECORDING SESSION//
      // $ext_agent = $this->get_ext($data['agent'], $data['start']);
      $query_total_hit = $this->$table_recording->live_query(
        "
      select dst,count(*) as num FROM $table_recording WHERE DATE(calldate) >= '" . $data['start'] . "'
     
      GROUP BY dst
      "
      );

      $data['total_dial_by_number'] = $query_total_hit->num_rows();
      $data['sum_dial'] = $this->$table_recording->get_sum(array("DATE(calldate) >=" => $data['start']), "duration");
      $data['count_dial'] = $this->$table_recording->get_count(array("DATE(calldate) >=" => $data['start']));
      // echo $no_hp_veri;
      // exit();
      $first_call_close = $this->$table_recording->live_query("
      SELECT
        dst
      FROM
      $table_recording 
      WHERE 
       dst IN($no_hp_veri)
      GROUP BY
        dst 
      HAVING
        COUNT( DISTINCT id ) =1
    ")->result();
      $call_close = $this->$table_recording->live_query("
      SELECT
      dst,COUNT( DISTINCT id ) AS countmid 
      FROM
      $table_recording 
      WHERE DATE(calldate) >= '" . $data['start'] . "'
    
      GROUP BY
        dst 
      HAVING
        COUNT( DISTINCT id ) >0
    ");
      $sum_call = 0;
      if (count($call_close->result_array()) > 0) {
        foreach ($call_close->result_array() as $call_close_s) {
          $sum_call = $sum_call + $call_close_s['countmid'];
        }
      }



      ////BREAK SESSION
      $afk = $this->get_afk($data['start'], $data['end'], $userdata);


      // echo $data['effective_time']['total']['aht_sum']."/".$data['effective_time']['total']['aht_count'];
      $response['aht'] = number_format(($data['effective_time']['total']['aht_sum'] / $data['effective_time']['total']['aht_count']) / 60, 2);

      /**********end effetive time **********/

      $response['agent_online'] = count($summary_peformance['agent']);

      $data['oncallrate'] = (($data['sum_dial'] / 60) / ((($duration / 60) * 22) * $response['agent_online']) - $afk['total']) * 100;

      $data['firstcallclose'] = number_format(count($first_call_close));
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

      $response['achievement_target'] = $summary_peformance['status_call'][13] / ((110 * $response['agent_online']) * 22);
      // echo $response['achievement_target'];
      $response['call_per_hours'] = $summary_peformance['cph'];
      $response['ppa'] = number_format($response['verified'] / $response['agent_online']);

      ///// LOG SESSION
      $data['log_call'] = $this->get_log_call($table_trans_profiling);
      $response['log_call'] = $data['log_call'];
      //// END LOG SESSION///
      $data['list_periode'] = new DatePeriod(
        new DateTime('2020-08-01'),
        new DateInterval('P1D'),
        new DateTime('2020-08-31')
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
      $response['agent_status_break'] = $this->agent_status($data['start'], $data['end_tgl'], $response['agent']);

      ////END AGENT STATUS///

      ////PEAK HOUR///
      $response['peak_hours'] = $this->peak_hours($table_trans_profiling, $data['start'], $data['end']);

      // exit();
      ////END PEAK HOURS///

      //// GENERAL DATA////
      // $response['general_data'] = $this->general_data($data['start'], $data['end']);
      //// END GENERAL DATA///

      // $response['arpu'] = $this->grade($table_trans_profiling, $data['start'], $data['end']);


      /////REGIONAL//
      // $response['regional'] = $this->regional($table_trans_profiling, $data['start'], $data['end']);

      ///END REGIONAL//

      // echo "<br>";
      $response['last_update'] = $this->trans_profiling_daily->get_row(array(), array("*"), array("lup" => "DESC"));
      $response['all_agent'] = $data['agent']['num'];
      $response['start'] = $data['start'];
      $response['end'] = $data['end_tgl'];

      $response['controller'] = $this;
      // exit();
    }

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
      count(*) AS num FROM $trans_profiling_daily WHERE DATE(lup) >= '$start' AND veri_call=13  
      $filter_agent
      GROUP BY
      handphone
    ")->result();
    $response = array();
    if (count($data['no_hp']) > 0) {
      foreach ($data['no_hp'] as $row_veri) {
        $rec = $this->trans_profiling_daily->live_query("
            select dst,count(*) AS num,SUM(duration) AS sumna FROM $tabel_recording WHERE dst = '61$row_veri->handphone' AND
            DATE(calldate) >= '$start'  GROUP BY dst
          ")->row();

        $number_lain = $this->trans_profiling_verifikasi->live_query("
        select no_speedy FROM trans_profiling_verifikasi WHERE no_handpone = '$row_veri->handphone' AND no_speedy <> '$row_veri->no_speedy'
        ")->num_rows();
        /***********SUMMARY */
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
    // echo $data['end'];
    // $data['end'] = $last_recording->calldate;
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
    $datetime1 = date_create($data['start']);
    $datetime2 = date_create($data['end']);

    $interval = date_diff($datetime1, $datetime2);

    // $filter_agent = "";
    // if ($agentid != false) {
    //   $filter_agent = " AND sys_user.agentid='$agentid'";
    // }
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
      DATE( sys_user_log_in_out.login_time ) >= '" . $data['start'] . "'
      AND DATE( sys_user_log_in_out.login_time ) <= '" . $data['end'] . "'
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
    $data['break']['max'] = count($agent) * (75 * $interval->format('%a'));
    $data['break']['max_agent'] = 75;
    $data['break']['break_persen'] = number_format(($data['break']['total'] / $data['break']['max']) * 100, 2);
    // $data['break']['break_agent_persen'] = number_format(($data['break']['agent'][$userdata->agentid]['total'] / $data['break']['max_agent']) * 100, 2);
    /// end break ///
    return $data;
  }

  public function get_effective_time($table_trans_profiling = 'trans_profiling_daily', $tabel_recording = 'recording_daily')
  {
    $this->load->model('Report_model/Report_082020_model', 'report_082020');


    $return = array();
    $return['total']['aht_count'] = 0;
    $return['total']['aht_sum'] = 0;
    $agent = $this->Sys_user_table_model->get_results(array("opt_level" => 8, "kategori" => "REG", "tl !=" => "-"));
    $add_1 = '"';
    $add_2 = '"';

    $query_trans_profiling = $this->report_082020->live_query(
      "
      SELECT GROUP_CONCAT(CONCAT('#61',handphone,'#')) as list_hp FROM report_082020 WHERE veri_call=13"
    );

    $data_profiling = $query_trans_profiling->row();
    // exit(); 
    // if ($agent['num'] > 0) {
    //   foreach ($agent['results'] as $ag) {
    // $data_verified = $this->filter_by_value($data_profiling, 'veri_upd', $ag->agentid);
    // $list_hp=str_replace("#",'',$data_profiling->list_hp);
    $list_hp = str_replace("#", '"', $data_profiling->list_hp);


    $return['veri_aht'] = $this->get_recording($list_hp, $tabel_recording);
    $return['aht_count'] = array_sum(array_column($return['veri_aht'], 'aht_count'));
    $return['aht_sum'] = array_sum(array_column($return['veri_aht'], 'aht_sum'));

    $return['hp_veri'] = $list_hp;
    $return['total']['aht_count'] = $return['total']['aht_count'] + $return['aht_count'];
    $return['total']['aht_sum'] = $return['total']['aht_sum'] + $return['aht_sum'];

    //   }
    // }






    return $return;
  }



  public function get_recording($data_verified, $tabel_recording = 'recording_daily')
  {
    $return = array();
    $n = 0;

    $query_hp = $this->$tabel_recording->live_query(
      "SELECT sum(duration) as sum_duration,count(duration) as count_duration FROM $tabel_recording WHERE dst IN ($data_verified)"
    );
    $rhp = $query_hp->row();
    $veri['aht_count'] = $rhp->count_duration;
    $veri['aht_sum'] = $rhp->sum_duration;
    $veri['aht'] = $veri['aht_sum'] / $veri['aht_count'];
    $return[] = $veri;
    // }
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
  function summary_peformance($tabel, $start, $end, $userdata, $agent_id = false, $tl = false)
  {
    $this->load->model('Report_model/' . ucwords($tabel) . '_model', $tabel);

    $data['start'] = $start;
    $data['end'] = $end;
    $time1 = strtotime('08:00:00');
    $time2 = strtotime('20:00:00');
    $filter_agent = "";
    $datetime1 = date_create($data['start']);
    $datetime2 = date_create($data['end']);

    $interval = date_diff($datetime1, $datetime2)->format('%a');

    $data['query'] = $this->$tabel->live_query(
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
    $data['cph'] = intval(($data['oc'] / count($data['agent'])) / (22 * 8));
    $data['cph_persen'] = number_format(($data['cph'] / 100) * 100, 2);
    $data['cph_agent'] = intval($data['agent'][$userdata->agentid]['oc'] / $duration);
    $data['cph_agent_persen'] = number_format(($data['cph_agent'] / 100) * 100, 2);
    $data['target'] = count($data['agent']) * (110 * 22);
    $data['target_persen'] = number_format(($data['status_call'][13] / $data['target']) * 100, 2);
    $data['target_agent'] = 22 * 110;
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

  function get_log_call($table_trans_profiling, $agentid = false)
  {
    $filter_agent = "";
    if ($agentid != false) {
      $filter_agent = " AND veri_upd='$agentid'";
    }
    $data = array();
    $log_veri = $this->$table_trans_profiling->live_query("
    SELECT
      date( lup ) as lupna,
      count(*) as num
    FROM
      $table_trans_profiling 
    WHERE
     veri_call = 13 
      $filter_agent
    GROUP BY
      date(lup)
      ORDER BY lup DESC
    ");

    $log_contacted = $this->$table_trans_profiling->live_query("
    SELECT
      date( lup ) as lupna,
      count(*) as num
    FROM
    $table_trans_profiling 
    WHERE
    (veri_call = 1 OR veri_call = 13 OR veri_call = 3 OR veri_call = 12 OR veri_call = 11) 
      $filter_agent
    GROUP BY
      date(lup)
      ORDER BY lup DESC
    ");
    $log_not_contacted = $this->$table_trans_profiling->live_query("
    SELECT
      date( lup ) as lupna,
      count(*) as num
    FROM
    $table_trans_profiling 
    WHERE
     (veri_call = 15 OR veri_call = 9 OR veri_call = 8 OR veri_call = 4 OR veri_call = 7 OR veri_call = 10 OR veri_call = 14 OR veri_call = 2) 
      $filter_agent
      GROUP BY
      date(lup)
      ORDER BY lup DESC
    ");
    $log_oc = $this->$table_trans_profiling->live_query("
    SELECT
      date( lup ) as lupna,
      count(*) as num
    FROM
    $table_trans_profiling 
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
    $this->load->model('Report_model/' . ucwords($table_trans_profiling) . '_model', $table_trans_profiling);
    $contacted = array(1, 13, 3, 12, 11);
    $query_trans_profiling = $this->$table_trans_profiling->live_query(
      "SELECT HOUR(lup) as hour_lup,veri_call,count(*) as num FROM $table_trans_profiling WHERE DATE(lup) >= '" . $start . "'  GROUP BY HOUR(lup),veri_call "
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
    // $response['opsi_call'] = $this->trans_profiling->live_query("
    //   select opsi_call,count(*) as num FROM trans_profiling_detail WHERE DATE(lup) >= '$start' AND DATE(lup) <= '$end' AND veri_call=13 AND (sumber <> 'ProfillingMos' AND sumber <> '') GROUP BY opsi_call 
    // ")->result_array();
    // $response['jk'] = $this->trans_profiling->live_query("
    //   select jk,count(*) as num FROM trans_profiling_detail WHERE DATE(lup) >= '$start' AND DATE(lup) <= '$end' AND veri_call=13  AND (sumber <> 'ProfillingMos' AND sumber <> '') GROUP BY jk 
    // ")->result_array();
    // $response['payment'] = $this->trans_profiling->live_query("
    //   select payment,count(*) as num FROM trans_profiling_detail WHERE DATE(lup) >= '$start' AND DATE(lup) <= '$end' AND veri_call=13  AND (sumber <> 'ProfillingMos' AND sumber <> '') GROUP BY payment 
    // ")->result_array();
    // $response['kec_speedy'] = $this->trans_profiling->live_query("
    //   select kec_speedy,count(*) as num FROM trans_profiling_detail WHERE DATE(lup) >= '$start' AND DATE(lup) <= '$end' AND veri_call=13  AND (sumber <> 'ProfillingMos' AND sumber <> '') GROUP BY kec_speedy   ORDER BY kec_speedy ASC
    // ")->result_array();
    // return $response;
  }

  function regional($trans_profiling_daily = 'trans_profiling_daily', $start, $end)
  {
    $this->load->model('Report_model/' . ucwords($trans_profiling_daily) . '_model', $trans_profiling_daily);
    $response['regional'] = $this->$trans_profiling_daily->live_query("
      select SUBSTR(no_speedy, 2, 1) as regional,
      count(*) AS num FROM $trans_profiling_daily WHERE DATE(lup) >= '$start' AND veri_call=13  
      GROUP BY
      SUBSTR(no_speedy, 2, 1)
    ")->result_array();
    return $response;
  }
  function grade($trans_profiling_daily = 'trans_profiling_daily', $start, $end)
  {
    $this->load->model('Report_model/Report_082020_model', 'report_082020');
    $query = $this->report_082020->live_query('
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
       FROM report_082020 WHERE  veri_call=13  
      
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
      'bronze' => 0
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
            $response['bronze'] = $response['bronze'] + 1;
            break;
        }
      }
    }
    return $response;
  }
}
