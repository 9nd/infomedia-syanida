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

class Monev extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    // $this->load->model('Custom_model/Cache_data_model', 'cache_data');
    $this->load->model('Custom_model/Tahun_model', 'tahun');
    $this->load->model('Custom_model/Cache_monev_realtime_model', 'cache_modev_realtime');
    $this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling_verifikasi');
    $this->load->model('Custom_model/Trans_profiling_validasi_mos_model', 'trans_profiling_validasi_mos');
    $this->load->model('Custom_model/Trans_profiling_daily_model', 'trans_profiling_daily');
    $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
    $this->load->model('Custom_model/Sys_user_log_in_out_table_model', 'Sys_log');
    $this->load->model('sys/Sys_user_log_model', 'log_login');
    $this->load->model('Absensi/Absensi_model', 't_absensi');
    $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    $this->load->model('Custom_model/Cdr_model', 'cdr');
    $this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling');
    $this->load->model('Custom_model/Cdr_daily_model', 'cdr_daily');
    $this->load->model('Custom_model/Recording_daily_model', 'recording_daily');
    $this->load->model('Custom_model/T_handle_time_model', 'T_handle_time_model');

    $this->load->model('Custom_model/Status_call_model', 'status_call');
    $this->load->model('Custom_model/Sys_user_log_login_model', 'sys_user_log_login');
    $this->load->model('Custom_model/Sys_user_log_in_out_table_model', 'Sys_log');
    $this->load->model('Custom_model/Sys_user_moss_model', 'Sys_user_moss');
    $this->load->model('Custom_model/Cache_location_model', 'Cache_location');
    // $this->load->model('Custom_model/Asterisk_model', 'Asterisk');
  }
  public function map_monev()
  {

    $view = 'monev/map_monev';
    $data['title_page_big']     =   '';
    $start_filter = $_GET['start'];
    $end_filter = $_GET['end'];
    $agentid = $_GET['agentid'];

    $where_agent = array("opt_level" => 8, "tl !=" => "-");

    $this->load->model('sys/Sys_user_log_model', 'log_login');
    $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);

    $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $start_filter = date('Y-m-d');
    $end_filter = date('Y-m-d');
    if (isset($_GET['start']) && isset($_GET['end'])) {
      $start_filter = $_GET['start'];
      $end_filter = $_GET['end'];
    }

    $data = array(
      'title_page_big'    => 'Monitoring Location Of Agent',
      'title'          => "Agent Location Periode " . $start_filter . " To " . $end_filter,
    );
    $data['start'] = $start_filter;
    $data['end'] = $end_filter;
    $data['status'] = $this->status_call->get_results();
    $filter_agent = array("(sys_user.opt_level=8 OR sys_user.opt_level=9)" => null, "(sys_user.kategori = 'REG' OR sys_user.kategori = 'TL') AND sys_user.tl != '-' " => null);
    if ($userdata->opt_level == 8) {
      $agentid[0] = $userdata->agentid;
    }
    $data['user_categori'] = '-';
    if ($userdata->opt_level == 8) {
      $filter_agent = array("agentid" => $userdata->agentid);
      $data['user_categori'] = $userdata->opt_level;
    }
    if ($userdata->opt_level == 9) {
      $filter_agent = array("tl" => $userdata->agentid);
      $data['user_categori'] = $userdata->opt_level;
    }
    if ($userdata->opt_level == 7) {
      // $filter_agent = array("tl" => $userdata->agentid);
      $data['user_categori'] = $userdata->opt_level;
    }
    $where_agent_multi = "";
    $data['list_agent'] = $this->sys_user->get_results($filter_agent);
    $data['tl'] = $this->Sys_user_table_model->get_results(array("opt_level" => 9));
    $data['list_tl'] = array();
    if ($data['tl']['num'] > 0) {
      foreach ($data['tl']['results'] as $data_tl) {
        $data['list_tl'][$data_tl->nmuser] = $data_tl->nama;
      }
    }
    $filter_agent = "";

    if (isset($agentid)) {

      if ($agentid) {
        if (count($_GET['agentid']) > 1) {
          $n_agent_pick = count($_GET['agentid']);
          foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
            if ($k_agentid == 0) {
              $where_agent_multi = "( sys_user.agentid = '$v_agentid'";
            } else {
              if ($k_agentid == ($n_agent_pick - 1)) {
                $where_agent_multi = $where_agent_multi . " OR sys_user.agentid = '$v_agentid' )";
              } else {
                $where_agent_multi = $where_agent_multi . " OR sys_user.agentid = '$v_agentid' ";
              }
            }
          }
        } else {
          if ($agentid[0] != '0') {
            // echo $agentid[0];
            $where_agent_multi = " AND sys_user.agentid = '$agentid[0]'";
          }
        }
      }
    }




    $this->load->library('googlemaps');
    $config = array();
    $config['center'] = "-6.9284463,107.6693543";
    $config['zoom'] = 11;
    $config['map_height'] = "800px";
    $config['geocodeCaching'] = TRUE;
    $this->googlemaps->initialize($config);

    $absensi = $this->t_absensi->live_query("
    SELECT
    t_absensi.* ,sys_user.nama as nama_agent,sys_user.opt_level as level_user
FROM
	`t_absensi` LEFT JOIN sys_user ON sys_user.agentid=t_absensi.agentid
WHERE
	DATE( waktu_in ) >= '$start_filter' 
	AND DATE( waktu_in ) <= '$end_filter' 
  AND stts = 'in' 
  AND methode = '1' 
  AND (sys_user.opt_level=8 OR sys_user.opt_level=9)
  AND (sys_user.kategori = 'REG' OR sys_user.kategori = 'TL')
AND sys_user.tl != '-'
	
  $where_agent_multi
  GROUP BY agentid
  ORDER BY waktu_in ASC
    ")->result();
    if (count($absensi) > 0) {
      foreach ($absensi as $ab) {
        $data['absen_detail'][$ab->agentid] = array('waktu_in' => $ab->waktu_in);
        if ($ab->latitude == "" ||  $ab->latitude == "0" || $ab->latitude == "NaN") {
          $data['agent_disable'][] = $ab->agentid;
        } else {
          $marker = array();
          $marker['infowindow_content'] = $ab->agentid . " : " . $ab->nama_agent;
          // $data['absen_detail'][$ab->agentid]['location']=$this->marker_cache($ab->latitude,$ab->longitude);

          $where = array("latitude" => $ab->latitude, "longitude" => $ab->longitude);
          $cek = $this->Cache_location->get_count($where);
          if ($cek == 0) {
            $data['cache_location'][] = array("latitude" => $ab->latitude, "longitude" => $ab->longitude);
            $data['absen_detail'][$ab->agentid]['location'] = array(
              "latitude" => $ab->latitude,
              "longitude" => $ab->longitude,
              "kel" => 'Saving...',
              "kec" => 'Saving...',
              "city" => 'Saving...',
              "state" => 'Saving...',
              "country" => 'Saving...',
            );
          } else {
            $data['absen_detail'][$ab->agentid]['location'] = $this->Cache_location->get_row_array($where);
          }
          $marker['position'] = $ab->latitude . "," . $ab->longitude;
          if ($ab->level_user == 9) {
            $marker['icon'] = 'http://maps.google.com/mapfiles/kml/paddle/blu-circle.png';
            // $marker['icon_size'] = '20,30';
          }

          $this->googlemaps->add_marker($marker);
        }
      }
    }

    $absensi_wfo = $this->t_absensi->live_query("
    SELECT
    t_absensi.* ,sys_user.nama as nama_agent
FROM
	`t_absensi` LEFT JOIN sys_user ON sys_user.agentid=t_absensi.agentid
WHERE
	DATE( waktu_in ) >= '$start_filter' 
	AND DATE( waktu_in ) <= '$end_filter' 
  AND stts = 'in' 
  AND methode = '0' 
  AND (sys_user.opt_level=8 OR sys_user.opt_level=9)
  AND (sys_user.kategori = 'REG' OR sys_user.kategori = 'TL')
	AND sys_user.tl != '-'
  $where_agent_multi
  GROUP BY agentid
  ORDER BY waktu_in ASC
    ")->result();
    if (count($absensi_wfo) > 0) {
      foreach ($absensi_wfo as $ab) {
        $data['absen_detail'][$ab->agentid] = array('waktu_in' => $ab->waktu_in);

        $data['agent_wfo'][] = $ab->agentid;
      }
    }
    $data['summary'] = array(
      "state" => 0,
      "city" => 0,
      "kec" => 0,
      "kel" => 0
    );
    foreach ($data['summary'] as $field => $valna) {

      $get_loc = $this->t_absensi->live_query("
    select $field,count(*) as numna FROM cache_location
LEFT JOIN t_absensi ON t_absensi.latitude = cache_location.latitude 
	WHERE DATE(t_absensi.waktu_in)='$start_filter'
 GROUP BY $field
    ")->num_rows();
      $data['summary'][$field] = $get_loc;
    }

    $data['online'] = count($absensi);
    $data['disable'] = count($data['agent_disable']);
    $data['map'] = $this->googlemaps->create_map();

    $this->template->load($view, $data);
  }
  public function cache_location()
  {
    $post = $this->input->get();
    $where = array("latitude" => $post['latitude'], "longitude" => $post['longitude']);
    $sub = substr($post['state'], -6);
    $stat = str_replace($sub, "", $post['state']);
    $insert = array(
      "latitude" => $post['latitude'],
      "longitude" => $post['longitude'],
      "longitude" => $post['longitude'],
      "kel" => $post['kel'],
      "kec" => $post['kec'],
      "city" => $post['city'],
      "state" => $stat,
      "country" => $post['country'],
    );
    $cek = $this->Cache_location->get_count($where);
    if ($cek == 0) {
      $this->Cache_location->add($insert);
    }
  }
  // public function marker_cache($lat = "0", $long = "0")
  // {
  //   $data_location = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&key=AIzaSyBnlP1DNuEP9kJ5KfqZ_7lmFlMRQln1mqM";
  //   // $data_location = "https://maps.googleapis.com/maps/api/geocode/json?latlng=-6.857951,107.5395226&key=AIzaSyBnlP1DNuEP9kJ5KfqZ_7lmFlMRQln1mqM";
  //   $data = file_get_contents($data_location);
  //   $data = json_decode($data);
  //   $response = array();
  //   if (isset($data->results[1]->formatted_address)) {
  //     $detail = explode(",", $data->results[1]->formatted_address);
  //     // $kec_ex=explode(" ",$detail[0]);
  //     $response['kelurahan'] = $detail[1];
  //     $response['kecamatan'] = $detail[2];
  //     $response['kota'] = $detail[3];
  //     $response['provinsi'] = $detail[4];
  //   }
  //   // echo $data->results[1]->formatted_address;
  //   return $response;
  // }
  public function realtime_monev()
  {

    $view = 'monev/realtime_monev';
    $data['title_page_big']     =   '';
    $data['cache_monev_realtime'] = $this->cache_modev_realtime->get_row_array(array("id" => 1));
    $data['daily'] = $this->agent_peformance();
    $data['absensi'] = $this->agent_status();
    $data['aux'] = $this->agent_aux();

    $data['wfh_num'] = count($data['absensi']['kehadiran']['WFH']);
    $data['wfh_data'] = $data['absensi']['kehadiran']['WFH'];
    $data['wfo_num'] = count($data['absensi']['kehadiran']['WFO']);
    $data['wfo_data'] = $data['absensi']['kehadiran']['WFO'];
    $data['duty_num'] = $data['wfh_num'] + $data['wfo_num'];
    $data['offline_num'] = count($data['absensi']['kehadiran']['OFFLINE']);
    $data['offline_data'] = $data['absensi']['kehadiran']['OFFLINE'];
    $data['logout_num'] = count(array_unique($data['absensi']['status']['LOGOUT']));
    $data['logout_data'] = array_unique($data['absensi']['status']['LOGOUT']);
    $data['aux_num'] = $data['aux']['num'];
    $data['aux_total'] = $data['aux']['total'];
    $data['aux_total_status'] = $data['aux']['total_status'];
    $data['aux_sub_total'] = $data['aux']['sub_total'];
    $data['aux_data'] = $data['aux']['data'];
    $data['aux_detail'] = $data['aux']['detail'];
    $data['aux_all_status'] = $data['aux']['all_status'];

    // $idle_data = array_diff($data['daily']['peformance']['idle'], $data['logout_data']);
    $data['idle_data'] = $data['daily']['peformance']['idle'];
    $afk = array();
    //  array_merge($data['logout_data'], $data['aux_data'], $data['idle_data']);
    if ($data['logout_num'] > 0) {
      $data['idle_data'] = array_diff($data['idle_data'], $data['logout_data']);
      $afk = $data['logout_data'];
    }
    if ($data['aux_num'] > 0) {
      $data['idle_data'] = array_diff($data['idle_data'], $data['aux_data']);
      $afk = array_merge($afk, $data['aux_data']);
    }
    if (count($data['idle_data']) > 0) {
      $afk = array_merge($afk, $data['idle_data']);
    }
    // $data['idle_detail'] = $data['idle_data']['peformance'];
    // $data['idle_data'] = $data['daily']['peformance']['idle'];
    $data['idle_num'] = count($data['idle_data']);


    $afk_unix = array_unique($afk);
    $data['aval_num'] = $data['duty_num'] - count($afk_unix);
    $data['agent_status'] = $data['daily']['peformance'];
    $data['agent'] = $this->Sys_user_table_model->get_results(array("opt_level" => 8, "kategori" => "REG", "tl !=" => "-"));
    $data['tl'] = $this->Sys_user_table_model->get_results(array("opt_level" => 9));
    $data['list_tl'] = array();
    if ($data['tl']['num'] > 0) {
      foreach ($data['tl']['results'] as $data_tl) {
        $data['list_tl'][$data_tl->nmuser] = $data_tl->nama;
      }
    }
    if (($data['duty_num'] - count($afk_unix)) < 0) {
      $avln = 0;
      $data['aval_num'] = 0;
    }
    $now = date('Y-m-d');
    $data['asterisk']=$this->recording_daily->live_query("SELECT src,count(*) as numna FROM recording_daily GROUP BY src")->result();
    $data['cdr'] = array();
    if (count($data['asterisk']) > 0) {
      foreach ($data['asterisk'] as $ast) {
        $src = $ast->src;
        $agna = $this->t_absensi->live_query("SELECT * FROM maping_eyebeam WHERE src='$src' ")->row();
        $data['cdr'][$agna->agentid] = $ast->numna;
      }
    }
    ////RECORDING///
    $data['effective_time'] = $this->get_effective_time('trans_profiling_daily', 'recording_daily');
    $data['aht'] = number_format(($data['effective_time']['total']['aht_sum'] / $data['effective_time']['total']['aht_count']) / 60, 2);

    ////END RECORDING///

    $data['cache'] = array(
      'duty_num' => $data['cache_monev_realtime']['duty_num'] - $data['duty_num'],
      'wfh_num' => $data['cache_monev_realtime']['wfh_num'] - $data['wfh_num'],
      'wfo_num' => $data['cache_monev_realtime']['wfo_num'] - $data['wfo_num'],
      'offline_num' => $data['cache_monev_realtime']['offline_num'] - $data['offline_num'],
      'logout_num' => $data['cache_monev_realtime']['logout_num'] - $data['logout_num'],
      'aux_num' => $data['cache_monev_realtime']['aux_num'] - $data['aux_num'],
      'aval_num' => $avln,
      'idle_num' => $data['cache_monev_realtime']['idle_num'] - $data['idle_num'],
      'aht' => $data['cache_monev_realtime']['aht'] - $data['aht']
    );

    ///oncall//
    $oncall = $this->T_handle_time_model->get_results(array(), array("*"));
    if ($oncall['num'] > 0) {
      foreach ($oncall['results'] as $row) {
        $data['oncall'][$row->agentid] = $row->proses_time;
        $data['oncall_data'][] = $row->agentid;
      }
    }

    ///oncall//
    $this->template->load($view, $data);

    $update_data = array(
      'duty_num' => $data['duty_num'],
      'wfh_num' => $data['wfh_num'],
      'wfo_num' => $data['wfo_num'],
      'offline_num' => $data['offline_num'],
      'logout_num' => $data['logout_num'],
      'aux_num' => $data['aux_num'],
      'aval_num' => $data['aval_num'],
      'idle_num' => $data['idle_num'],
      'pray' => number_format($data['aux_sub_total']['Pray']),
      'toilet' => number_format($data['aux_sub_total']['Toilet']),
      'lunch' => number_format($data['aux_sub_total']['Break']),
      'handsup' => number_format($data['aux_sub_total']['Handsup']),
      'aht' => number_format($data['aht'], 2),
      'last_update' => date('Y-m-d H:i:s')
    );
    $this->cache_modev_realtime->edit(array("id" => 1), $update_data);
  }
  public function get_oncall($online)
  {
    ///oncall//
    $data['aval_num'] = $online;
    $data['agent'] = $this->Sys_user_table_model->get_results(array("opt_level" => 8, "kategori" => "REG", "tl !=" => "-"));
    if ($data['agent']['num'] > 0) {
      foreach ($data['agent']['results'] as $as) {
        $data['oncall'][$as->agentid] = "Available";
        // $data['aval_num']=$data['aval_num']+1;
      }
    }
    $oncall = $this->T_handle_time_model->get_results(array(), array("*"));
    if ($oncall['num'] > 0) {
      foreach ($oncall['results'] as $row) {
        $date = new DateTime($row->proses_time);
        $date2 = new DateTime(date('Y-m-d H:i:s'));

        $diff = $date2->getTimestamp() - $date->getTimestamp();
        $data['oncall'][$row->agentid] = "On Call : " . date('i:s', $diff);
      }
    }
    $data['aval_num'] = $data['aval_num'] - $oncall['num'];
    $data['oncall_num'] = $oncall['num'];
    echo json_encode($data);
    ///oncall//
  }
  public function realtime_monev_moss()
  {

    $view = 'monev/realtime_monev_moss';
    $data['title_page_big']     =   '';
    $data['cache_monev_realtime'] = $this->cache_modev_realtime->get_row_array(array("id" => 2));
    $data['daily'] = $this->agent_peformance_moss();
    $data['absensi'] = $this->agent_status_moss();
    $data['aux'] = $this->agent_aux_moss();

    $data['wfh_num'] = count($data['absensi']['kehadiran']['WFH']);
    $data['wfh_data'] = $data['absensi']['kehadiran']['WFH'];
    $data['wfo_num'] = count($data['absensi']['kehadiran']['WFO']);
    $data['wfo_data'] = $data['absensi']['kehadiran']['WFO'];
    $data['duty_num'] = $data['wfh_num'] + $data['wfo_num'];
    $data['offline_num'] = count($data['absensi']['kehadiran']['OFFLINE']);
    $data['offline_data'] = $data['absensi']['kehadiran']['OFFLINE'];
    $data['logout_num'] = count(array_unique($data['absensi']['status']['LOGOUT']));
    $data['logout_data'] = array_unique($data['absensi']['status']['LOGOUT']);
    $data['aux_num'] = $data['aux']['num'];
    $data['aux_data'] = $data['aux']['data'];
    $data['aux_detail'] = $data['aux']['detail'];
    $data['aux_all_status'] = $data['aux']['all_status'];
    $data['aux_sub_total'] = $data['aux']['sub_total'];

    // $idle_data = array_diff($data['daily']['peformance']['idle'], $data['logout_data']);
    $data['idle_data'] = $data['daily']['peformance']['idle'];
    $afk = array();
    //  array_merge($data['logout_data'], $data['aux_data'], $data['idle_data']);
    if ($data['logout_num'] > 0) {
      $data['idle_data'] = array_diff($data['idle_data'], $data['logout_data']);
      $afk = $data['logout_data'];
    }
    if ($data['aux_num'] > 0) {
      $data['idle_data'] = array_diff($data['idle_data'], $data['aux_data']);
      $afk = array_merge($afk, $data['aux_data']);
    }
    if (count($data['idle_data']) > 0) {
      $afk = array_merge($afk, $data['idle_data']);
    }
    // $data['idle_detail'] = $data['idle_data']['peformance'];
    // $data['idle_data'] = $data['daily']['peformance']['idle'];
    $data['idle_num'] = count($data['idle_data']);


    $afk_unix = array_unique($afk);
    $data['aval_num'] = $data['duty_num'] - count($afk_unix);
    $data['agent_status'] = $data['daily']['peformance'];
    $data['agent'] = $this->Sys_user_table_model->get_results(array("opt_level" => 8, "kategori" => "MOS", "tl !=" => "-"));
    $data['tl'] = $this->Sys_user_table_model->get_results(array("opt_level" => 9));
    $data['list_tl'] = array();
    if ($data['tl']['num'] > 0) {
      foreach ($data['tl']['results'] as $data_tl) {
        $data['list_tl'][$data_tl->nmuser] = $data_tl->nama;
      }
    }
    if (($data['duty_num'] - count($afk_unix)) < 0) {
      $avln = 0;
      $data['aval_num'] = 0;
    }
    $data['cache'] = array(
      'duty_num' => $data['cache_monev_realtime']['duty_num'] - $data['duty_num'],
      'wfh_num' => $data['cache_monev_realtime']['wfh_num'] - $data['wfh_num'],
      'wfo_num' => $data['cache_monev_realtime']['wfo_num'] - $data['wfo_num'],
      'offline_num' => $data['cache_monev_realtime']['offline_num'] - $data['offline_num'],
      'logout_num' => $data['cache_monev_realtime']['logout_num'] - $data['logout_num'],
      'aux_num' => $data['cache_monev_realtime']['aux_num'] - $data['aux_num'],
      'aval_num' => $avln,
      'idle_num' => $data['cache_monev_realtime']['idle_num'] - $data['idle_num'],

    );
    $this->template->load($view, $data);
    $update_data = array(
      'duty_num' => $data['duty_num'],
      'wfh_num' => $data['wfh_num'],
      'wfo_num' => $data['wfo_num'],
      'offline_num' => $data['offline_num'],
      'logout_num' => $data['logout_num'],
      'aux_num' => $data['aux_num'],
      'aval_num' => $data['aval_num'],
      'idle_num' => $data['idle_num'],
      'pray' => number_format($data['aux_sub_total']['Pray']),
      'toilet' => number_format($data['aux_sub_total']['Toilet']),
      'lunch' => number_format($data['aux_sub_total']['Break']),
      'handsup' => number_format($data['aux_sub_total']['Handsup']),
      'last_update' => date('Y-m-d H:i:s')
    );
    $this->cache_modev_realtime->edit(array("id" => 2), $update_data);
  }
  public function periode_monev()
  {
    $view = 'monev/periode_monev';
    $data['title_page_big']     =   '';
    $data['cache_monev_realtime'] = $this->cache_modev_realtime->get_row_array(array("id" => 1));
    $data['daily'] = $this->agent_peformance();
    $data['absensi'] = $this->agent_status();
    $data['aux'] = $this->agent_aux();

    $data['wfh_num'] = count($data['absensi']['kehadiran']['WFH']);
    $data['wfh_data'] = $data['absensi']['kehadiran']['WFH'];
    $data['wfo_num'] = count($data['absensi']['kehadiran']['WFO']);
    $data['wfo_data'] = $data['absensi']['kehadiran']['WFO'];
    $data['duty_num'] = $data['wfh_num'] + $data['wfo_num'];
    $data['offline_num'] = count($data['absensi']['kehadiran']['OFFLINE']);
    $data['offline_data'] = $data['absensi']['kehadiran']['OFFLINE'];
    $data['logout_num'] = count(array_unique($data['absensi']['status']['LOGOUT']));
    $data['logout_data'] = array_unique($data['absensi']['status']['LOGOUT']);
    $data['aux_num'] = $data['aux']['num'];
    $data['aux_data'] = $data['aux']['data'];
    $data['aux_detail'] = $data['aux']['detail'];
    $data['aux_all_status'] = $data['aux']['all_status'];
    $data['aux_total_status'] = $data['aux']['total'];

    // $idle_data = array_diff($data['daily']['peformance']['idle'], $data['logout_data']);
    $data['idle_data'] = $data['daily']['peformance']['idle'];
    $afk = array();
    //  array_merge($data['logout_data'], $data['aux_data'], $data['idle_data']);
    if ($data['logout_num'] > 0) {
      $data['idle_data'] = array_diff($data['idle_data'], $data['logout_data']);
      $afk = $data['logout_data'];
    }
    if ($data['aux_num'] > 0) {
      $data['idle_data'] = array_diff($data['idle_data'], $data['aux_data']);
      $afk = array_merge($afk, $data['aux_data']);
    }
    if (count($data['idle_data']) > 0) {
      $afk = array_merge($afk, $data['idle_data']);
    }
    // $data['idle_detail'] = $data['idle_data']['peformance'];
    // $data['idle_data'] = $data['daily']['peformance']['idle'];
    $data['idle_num'] = count($data['idle_data']);


    $afk_unix = array_unique($afk);
    $data['aval_num'] = $data['duty_num'] - count($afk_unix);
    $data['agent_status'] = $data['daily']['peformance'];
    $data['agent'] = $this->Sys_user_table_model->get_results(array("opt_level" => 8, "kategori" => "REG", "tl !=" => "-"));
    $data['cache'] = array(
      'duty_num' => $data['cache_monev_realtime']['duty_num'] - $data['duty_num'],
      'wfh_num' => $data['cache_monev_realtime']['wfh_num'] - $data['wfh_num'],
      'wfo_num' => $data['cache_monev_realtime']['wfo_num'] - $data['wfo_num'],
      'offline_num' => $data['cache_monev_realtime']['offline_num'] - $data['offline_num'],
      'logout_num' => $data['cache_monev_realtime']['logout_num'] - $data['logout_num'],
      'aux_num' => $data['cache_monev_realtime']['aux_num'] - $data['aux_num'],
      'aval_num' => $data['cache_monev_realtime']['aval_num'] - $data['aval_num'],
      'idle_num' => $data['cache_monev_realtime']['idle_num'] - $data['idle_num']

    );

    /**********effetive time **********/
    $data['effective_time'] = $this->get_effective_time();

    $data['aht'] = $data['effective_time']['total']['aht_sum'] / $data['effective_time']['total']['aht_count'];

    /**********end effetive time **********/


    $this->template->load($view, $data);
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

  function agent_peformance()
  {

    $agent = $this->Sys_user_table_model->get_results(array("opt_level" => 8, "kategori" => "REG", "tl !=" => "-"));
    $total = array();
    $return = array();
    if ($agent['num'] > 0) {
      foreach ($agent['results'] as $ag) {
        $return[$ag->agentid] = array();
        for ($i = 1; $i <= 16; $i++) {
          $filter = array(
            "veri_upd" => $ag->agentid,
            "veri_call" => $i,
            "DATE(lup)" => date('Y-m-d')
          );

          $return['peformance'][$ag->agentid][$i] = $this->trans_profiling_daily->get_count($filter);

          $return['peformance']['total'][$i] = $return['peformance']['total'][$i] + $return['peformance'][$ag->agentid][$i];
        }
        $filter = array(
          "veri_upd" => $ag->agentid,
          "DATE(lup)" => date('Y-m-d')
        );
        $row_data = $this->trans_profiling_daily->get_row($filter, array("lup,TIMESTAMPDIFF(
          SECOND,
          lup,
          CURRENT_TIMESTAMP
      ) AS idle"), array("lup" => "DESC"));

        if ($row_data) {
          $return['peformance'][$ag->agentid]['last_update'] = $row_data->lup;

          // echo $diff;
          $last_aux_status = $this->Sys_log->live_query("Select logout_time FROM sys_user_log_in_out where logout_time IS NOT NULL AND agentid='" . $ag->agentid . "' ORDER BY id DESC");

          $row_last_aux_status = $last_aux_status->row()->logout_time;
          if (strtotime($row_last_aux_status) > strtotime($row_data->lup)) {
            $diff = strtotime(date("Y-m-d H:i:s")) - strtotime($row_last_aux_status);
            if ($diff > 300) {
              $return['peformance']['idle'][] = $ag->agentid;
            }
            $idle_timena = $diff;
          } else {
            if ($row_data->idle > 300) {
              $return['peformance']['idle'][] = $ag->agentid;
            }
            $idle_timena = $row_data->idle;
          }

          $return['peformance'][$ag->agentid]['idle'] = $idle_timena;
        }
        $data_in = $this->t_absensi->get_row(array("date(waktu_in)" => date('Y-m-d'), "stts" => 'in', "nik" => $ag->nik_absensi), array("*,time(waktu_in) as waktu_masuk"), array("waktu_in" => "ASC"));
        $return['peformance'][$ag->agentid]['in'] = $data_in->waktu_masuk;
        $return['peformance'][$ag->agentid]['out'] = $this->t_absensi->get_row(array("date(waktu_in)" => date('Y-m-d'), "stts" => 'out', "nik" => $ag->nik_absensi), array("*,,time(waktu_in) as waktu_masuk"), array("waktu_in" => "DESC"))->waktu_masuk;

        $return['peformance'][$ag->agentid]['data'] = $ag;
      }
    }
    return $return;
  }
  function agent_peformance_moss()
  {

    $agent = $this->Sys_user_table_model->get_results(array("opt_level" => 8, "kategori" => "MOS", "tl !=" => "-"));
    $total = array();
    $return = array();
    if ($agent['num'] > 0) {
      foreach ($agent['results'] as $ag) {
        $return[$ag->agentid] = array();
        for ($i = 1; $i <= 16; $i++) {
          $filter = array(
            "update_by" => $ag->agentid,
            "reason_call" => $i,
            "DATE(lup)" => date('Y-m-d')
          );

          $return['peformance'][$ag->agentid][$i] = $this->trans_profiling_validasi_mos->get_count($filter);

          $return['peformance']['total'][$i] = $return['peformance']['total'][$i] + $return['peformance'][$ag->agentid][$i];
        }
        $filter = array(
          "update_by" => $ag->agentid,
          "DATE(lup)" => date('Y-m-d')
        );
        $row_data = $this->trans_profiling_validasi_mos->get_row($filter, array("lup,TIMESTAMPDIFF(
          SECOND,
          lup,
          CURRENT_TIMESTAMP
      ) AS idle"), array("lup" => "DESC"));

        if ($row_data) {
          $return['peformance'][$ag->agentid]['last_update'] = $row_data->lup;

          // echo $diff;
          $last_aux_status = $this->Sys_log->live_query("Select logout_time FROM sys_user_log_in_out where logout_time IS NOT NULL AND agentid='" . $ag->agentid . "' ORDER BY id DESC");

          $row_last_aux_status = $last_aux_status->row()->logout_time;
          if (strtotime($row_last_aux_status) > strtotime($row_data->lup)) {
            $diff = strtotime(date("Y-m-d H:i:s")) - strtotime($row_last_aux_status);
            if ($diff > 300) {
              $return['peformance']['idle'][] = $ag->agentid;
            }
            $idle_timena = $diff;
          } else {
            if ($row_data->idle > 300) {
              $return['peformance']['idle'][] = $ag->agentid;
            }
            $idle_timena = $row_data->idle;
          }

          $return['peformance'][$ag->agentid]['idle'] = $idle_timena;
        }
        $data_in = $this->t_absensi->get_row(array("date(waktu_in)" => date('Y-m-d'), "stts" => 'in', "nik" => $ag->nik_absensi), array("*,time(waktu_in) as waktu_masuk"), array("waktu_in" => "ASC"));
        $return['peformance'][$ag->agentid]['in'] = $data_in->waktu_masuk;
        $return['peformance'][$ag->agentid]['out'] = $this->t_absensi->get_row(array("date(waktu_in)" => date('Y-m-d'), "stts" => 'out', "nik" => $ag->nik_absensi), array("*,,time(waktu_in) as waktu_masuk"), array("waktu_in" => "DESC"))->waktu_masuk;

        $return['peformance'][$ag->agentid]['data'] = $ag;
      }
    }
    return $return;
  }
  function agent_status()
  {
    $agent = $this->Sys_user_table_model->get_results(array("opt_level" => 8, "kategori" => "REG", "tl !=" => "-"));
    $total = array();
    $return = array();
    if ($agent['num'] > 0) {
      foreach ($agent['results'] as $ag) {
        $absen_kantor = $this->t_absensi->get_count(array("nik" => $ag->nik_absensi, "stts" => "in", "methode" => 0, "DATE(waktu_in)" => date('Y-m-d')));
        $absen_aplikasi = $this->t_absensi->get_count(array("nik" => $ag->nik_absensi, "stts" => "in", "methode" => 1, "DATE(waktu_in)" => date('Y-m-d')));
        $out_kantor = $this->t_absensi->get_count(array("nik" => $ag->nik_absensi, "stts" => "out", "methode" => 0, "DATE(waktu_in)" => date('Y-m-d '), "TIME(waktu_in) >" => '09:00:00'));
        $out_aplikasi = $this->t_absensi->get_count(array("nik" => $ag->nik_absensi, "stts" => "out", "methode" => 1, "DATE(waktu_in)" => date('Y-m-d'), "TIME(waktu_in) >" => '09:00:00'));
        if ($absen_kantor > 0) {
          $return['kehadiran']['WFO'][] = $ag->agentid;
          if ($out_kantor > 0) {
            $return['status']['LOGOUT'][] = $ag->agentid;
          }
        }
        if ($absen_kantor == 0 && $absen_aplikasi > 0) {
          $return['kehadiran']['WFH'][] = $ag->agentid;
        }
        if ($out_aplikasi > 0 || $out_kantor > 0) {
          $return['status']['LOGOUT'][] = $ag->agentid;
        }
        if ($absen_kantor == 0 && $absen_aplikasi == 0) {
          $return['kehadiran']['OFFLINE'][] = $ag->agentid;
        }
      }
    }
    return $return;
  }
  function agent_status_moss()
  {
    $agent = $this->Sys_user_table_model->get_results(array("opt_level" => 8, "kategori" => "MOS", "tl !=" => "-"));
    $total = array();
    $return = array();
    if ($agent['num'] > 0) {
      foreach ($agent['results'] as $ag) {
        $absen_kantor = $this->t_absensi->get_count(array("nik" => $ag->nik_absensi, "stts" => "in", "methode" => 0, "DATE(waktu_in)" => date('Y-m-d')));
        $absen_aplikasi = $this->t_absensi->get_count(array("nik" => $ag->nik_absensi, "stts" => "in", "methode" => 1, "DATE(waktu_in)" => date('Y-m-d')));
        $out_kantor = $this->t_absensi->get_count(array("nik" => $ag->nik_absensi, "stts" => "out", "methode" => 0, "DATE(waktu_in)" => date('Y-m-d ')));
        $out_aplikasi = $this->t_absensi->get_count(array("nik" => $ag->nik_absensi, "stts" => "out", "methode" => 1, "DATE(waktu_in)" => date('Y-m-d')));
        if ($absen_kantor > 0) {
          $return['kehadiran']['WFO'][] = $ag->agentid;
          if ($out_kantor > 0) {
            $return['status']['LOGOUT'][] = $ag->agentid;
          }
        }
        if ($absen_kantor == 0 && $absen_aplikasi > 0) {
          $return['kehadiran']['WFH'][] = $ag->agentid;
        }
        if ($out_aplikasi > 0 || $out_kantor > 0) {
          $return['status']['LOGOUT'][] = $ag->agentid;
        }
        if ($absen_kantor == 0 && $absen_aplikasi == 0) {
          $return['kehadiran']['OFFLINE'][] = $ag->agentid;
        }
      }
    }
    return $return;
  }
  function agent_aux()
  {
    $return = array();
    $aux = $this->Sys_log->live_query("Select sys_user_log_in_out.agentid,sys_user_log_in_out.ket,sys_user.nama,TIMESTAMPDIFF(SECOND,sys_user_log_in_out.login_time,CURRENT_TIMESTAMP) AS aux,sys_user_log_in_out.login_time from sys_user_log_in_out JOIN sys_user ON sys_user.id = sys_user_log_in_out.id_user where DATE(sys_user_log_in_out.login_time) = '" . date('Y-m-d') . "'  AND sys_user_log_in_out.ket != '' AND ISNULL(sys_user_log_in_out.logout_time) AND sys_user.kategori='REG' AND sys_user.tl != '-' AND sys_user.opt_level = 8 GROUP BY sys_user_log_in_out.agentid ORDER BY sys_user_log_in_out.id DESC ");
    $status_aux = array("Break", "Pray", "Toilet", "Handsup");
    foreach ($status_aux as $k => $v) {
      $return['total'][$v] = 0;
      $aux_status = $this->Sys_log->live_query("Select sys_user_log_in_out.agentid,sys_user.nama,sum(TIMESTAMPDIFF(SECOND,sys_user_log_in_out.login_time,sys_user_log_in_out.logout_time)) AS aux from sys_user_log_in_out JOIN sys_user ON sys_user.id = sys_user_log_in_out.id_user where DATE(sys_user_log_in_out.login_time) = '" . date('Y-m-d') . "' AND sys_user_log_in_out.ket = '" . $v . "' AND sys_user_log_in_out.logout_time IS NOT NULL AND sys_user.kategori='REG' AND sys_user.tl != '-' AND sys_user.opt_level = 8 GROUP BY sys_user_log_in_out.agentid");
      $aux_detail = $this->Sys_log->live_query("Select sys_user_log_in_out.agentid,sys_user.nama,sum(TIMESTAMPDIFF(SECOND,sys_user_log_in_out.login_time,sys_user_log_in_out.logout_time)) AS aux from sys_user_log_in_out JOIN sys_user ON sys_user.id = sys_user_log_in_out.id_user where sys_user_log_in_out.login_time >= TIMESTAMP('" . date('Y-m-d') . "','08:00:00') AND sys_user_log_in_out.login_time <= TIMESTAMP('" . date('Y-m-d') . "','17:00:00') AND sys_user_log_in_out.ket = '" . $v . "' AND sys_user_log_in_out.logout_time IS NOT NULL AND sys_user.kategori='REG' AND sys_user.tl != '-' AND sys_user.opt_level = 8 GROUP BY sys_user_log_in_out.agentid");
      if ($aux_status->num_rows() > 0) {
        foreach ($aux_status->result_array() as $axd) {
          $return['all_status'][$axd['agentid']][$v] = $axd['aux'];
          if ($axd['aux'] > 0) {
            $return['total_status'][$v] = $return['total_status'][$v] + 1;
          }
          $return['total'][$v] = $return['total'][$v] + $axd['aux'];
        }
      }
      if ($aux_detail->num_rows() > 0) {
        foreach ($aux_detail->result_array() as $axd) {
          $return['all_status'][$axd['agentid']][$v . "_"] = $axd['aux'];
        }
      }
    }
    $return['num'] = $aux->num_rows();
    if ($aux->num_rows() > 0) {
      foreach ($aux->result_array() as $ax) {
        $return['data'][] = $ax['agentid'];
        $return['detail'][$ax['agentid']] = $ax;
        $status_aux = array("Break", "Pray", "Toilet", "Handsup");
        foreach ($status_aux as $k => $v) {
          if ($v == $ax['ket']) {
            $return['sub_total'][$v] = $return['sub_total'][$v] + 1;
          }
        }
      }
    }
    return $return;
  }
  function agent_aux_moss()
  {
    $return = array();
    $aux = $this->Sys_log->live_query("Select sys_user_log_in_out.agentid,sys_user_log_in_out.ket,sys_user.nama,TIMESTAMPDIFF(SECOND,sys_user_log_in_out.login_time,CURRENT_TIMESTAMP) AS aux from sys_user_log_in_out JOIN sys_user ON sys_user.id = sys_user_log_in_out.id_user where DATE(sys_user_log_in_out.login_time) = '" . date('Y-m-d') . "'  AND sys_user_log_in_out.ket != '' AND ISNULL(sys_user_log_in_out.logout_time) AND sys_user.kategori='MOS' AND sys_user.tl != '-' AND sys_user.opt_level = 8 GROUP BY sys_user_log_in_out.agentid ORDER BY sys_user_log_in_out.id DESC ");
    $status_aux = array("Break", "Pray", "Toilet", "Handsup");
    foreach ($status_aux as $k => $v) {
      $return['total'][$v] = 0;
      $aux_status = $this->Sys_log->live_query("Select sys_user_log_in_out.agentid,sys_user.nama,sum(TIMESTAMPDIFF(SECOND,sys_user_log_in_out.login_time,sys_user_log_in_out.logout_time)) AS aux from sys_user_log_in_out JOIN sys_user ON sys_user.id = sys_user_log_in_out.id_user where DATE(sys_user_log_in_out.login_time) = '" . date('Y-m-d') . "' AND sys_user_log_in_out.ket = '" . $v . "' AND sys_user_log_in_out.logout_time IS NOT NULL AND sys_user.kategori='MOS' AND sys_user.tl != '-' AND sys_user.opt_level = 8 GROUP BY sys_user_log_in_out.agentid");
      $aux_detail = $this->Sys_log->live_query("Select sys_user_log_in_out.agentid,sys_user.nama,sum(TIMESTAMPDIFF(SECOND,sys_user_log_in_out.login_time,sys_user_log_in_out.logout_time)) AS aux from sys_user_log_in_out JOIN sys_user ON sys_user.id = sys_user_log_in_out.id_user where sys_user_log_in_out.login_time >= TIMESTAMP('" . date('Y-m-d') . "','08:00:00') AND sys_user_log_in_out.login_time <= TIMESTAMP('" . date('Y-m-d') . "','17:00:00') AND sys_user_log_in_out.ket = '" . $v . "' AND sys_user_log_in_out.logout_time IS NOT NULL AND sys_user.kategori='MOS' AND sys_user.tl != '-' AND sys_user.opt_level = 8 GROUP BY sys_user_log_in_out.agentid");
      if ($aux_status->num_rows() > 0) {
        foreach ($aux_status->result_array() as $axd) {
          $return['all_status'][$axd['agentid']][$v] = $axd['aux'];
          $return['total'][$v] = $return['total'][$v] + $axd['aux'];
        }
      }
      if ($aux_detail->num_rows() > 0) {
        foreach ($aux_detail->result_array() as $axd) {
          $return['all_status'][$axd['agentid']][$v . "_"] = $axd['aux'];
        }
      }
    }
    $return['num'] = $aux->num_rows();
    if ($aux->num_rows() > 0) {
      foreach ($aux->result_array() as $ax) {
        $return['data'][] = $ax['agentid'];
        $return['detail'][$ax['agentid']] = $ax;
        $status_aux = array("Break", "Pray", "Toilet", "Handsup");
        foreach ($status_aux as $k => $v) {
          if ($v == $ax['ket']) {
            $return['sub_total'][$v] = $return['sub_total'][$v] + 1;
          }
        }
      }
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
  function filter_by_hp_email($array, $index, $value)
  {
    $newarray = array();
    if (is_array($array) && count($array) > 0) {
      foreach (array_keys($array) as $key) {
        if (is_array($index) && count($index) > 0) {
          $email = 0;
          $handphone = 0;
          foreach ($index as $idx => $idv) {
            $temp[$key] = $array[$key][$idv];

            if ($idv == "email") {
              if (stripos($temp[$key], $value[$idx]) !== false) {
                // if (stripos($temp[$key], $value[$idx]) !== true) {
                $email = 1;
              }
            }
            if ($idv == "handphone") {
              if (stripos($temp[$key], $value[$idx]) !== false) {
                // if (stripos($temp[$key], $value[$idx]) !== true) {

                $handphone = 1;
              }
            }
            if ($email == 1 && $handphone == 1) {
              $newarray[$key] = $array[$key];
            }
          }
        }
      }
    }
    return $newarray;
  }
  function filter_by_hp_only($array, $index, $value)
  {
    $newarray = array();
    if (is_array($array) && count($array) > 0) {
      foreach (array_keys($array) as $key) {
        if (is_array($index) && count($index) > 0) {
          $email = 0;
          $handphone = 0;
          foreach ($index as $idx => $idv) {
            $temp[$key] = $array[$key][$idv];

            if ($idv == "email") {
              if ($temp[$key] == '') {
                // if (stripos($temp[$key], $value[$idx]) !== true) {
                $email = 1;
              }
            }
            if ($idv == "handphone") {
              if (stripos($temp[$key], $value[$idx]) !== false) {
                // if (stripos($temp[$key], $value[$idx]) !== true) {

                $handphone = 1;
              }
            }
            if ($email == 1 && $handphone == 1) {
              $newarray[$key] = $array[$key];
            }
          }
        }
      }
    }
    return $newarray;
  }
}
