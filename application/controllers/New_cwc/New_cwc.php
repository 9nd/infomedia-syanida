<?php
require APPPATH . '/controllers/New_cwc/New_cwc_config.php';
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
class New_cwc extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('sys/Sys_user_log_model', 'log_login');
    $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
    $this->load->model('Custom_model/Dapros_infomedia_model', 'distribution');
    // $this->load->model('Custom_model/Dapros_model', 'distribution');
    $this->infomedia = $this->load->database('infomedia', TRUE);
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $this->load->model('Custom_model/Sys_user_log_in_out_table_model', 'Sys_log');
    if ($data['userdata']->opt_level == 8) {
      $log_where = array(
        'id_user' => $logindata->id_user,
        'agentid' => $data['userdata']->agentid,
      );
      $log = $this->Sys_log->get_row($log_where, array("id,logout_time"), array("id" => "DESC"));
      if ($log) {
        if ($log->logout_time == '') {
          redirect('Lockscreen', 'refresh');
        }
      }
    }
    $this->log_key = 'log_New_cwc';
    $this->title = new New_cwc_config();
  }
  public function index()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'New_cwc/input_cwc';

    $this->load->view($view, $data);
  }
  public function edit()
  {
    $id = $_GET['id'];
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $data['datana'] = $this->infomedia->query("SELECT * FROM v2_trans_profiling WHERE id='$id'")->row();
    $view = 'New_cwc/edit_cwc';

    $this->load->view($view, $data);
  }

  public function insertdata()
  {
    //agentid
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $agentid = $userdata->agentid;
    //
    if (isset($agentid)) {
      $lup = date("Y-m-d H:i:s");
      $datainsert = array(
        'no_telp' => $_POST['no_telp'],
        'no_internet' => $_POST['no_internet'],
        'ncli' => $_POST['ncli'],
        'no_indri' => $_POST['no_indri'],
        'nama_pelanggan' => $_POST['nama_pelanggan'],
        'relasi' => $_POST['relasi'],
        'jk' => $_POST['jk'],
        'no_hp' => $_POST['no_hp'],
        'no_hp_lain' => $_POST['no_hp_lain'],
        'wa' => $_POST['wa'],
        'email_utama' => $_POST['email_utama'],
        'email_lain' => $_POST['email_lain'],
        'fb' => $_POST['fb'],
        'tw' => $_POST['tw'],
        'ig' => $_POST['ig'],
        'v_nama' => $_POST['v_nama'],
        'v_alamat' => $_POST['v_alamat'],
        'v_kota' => $_POST['v_kota'],
        'v_kecepatan' => $_POST['v_kecepatan'],
        'v_tagihan' => $_POST['v_tagihan'],
        'tp_bayar' => $_POST['tp_bayar'],
        'th_pasang' => $_POST['th_pasang'],
        'v_email' => $_POST['v_email'],
        'v_sms' => $_POST['v_sms'],
        'opsi_call' => $_POST['opsi_call'],
        'kat_call' => $_POST['kat_call'],
        'sub_call' => $_POST['sub_call'],
        'status_call' => $_POST['status_call'],
        'keterangan' => $_POST['keterangan'],
        'veri_upd' => $agentid,
        'veri_lup' => $lup,
        'lup' => $lup
      );
      $insertdata = $this->infomedia->insert('v2_trans_profiling', $datainsert);
      if ($insertdata) {
        $onload = 'berhasil disimpan';
      }
    } else {
      $onload = 'login terlebih dahulu';
    }
    echo "<script>
			alert('" . $onload . "');	
			window.location = '" . base_url() . "New_cwc/New_cwc';
			</script>";
  }
  public function updatedata()
  {
    //agentid
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $agentid = $userdata->agentid;
    //
    $id = $_POST['id'];
    $datana =  $this->infomedia->query("SELECT * FROM v2_trans_profiling WHERE id='$id'")->row();
    if ($datana->id == $id) {
      $inserttolog = $this->infomedia->query("INSERT INTO v2_trans_profiling_log ('id_trans_profiling',
      'idx',
      'no_telp',
      'no_internet',
      'ncli',
      'nama_pelanggan',
      'relasi',
      'jk',
      'no_hp',
      'no_hp_lain',
      'wa',
      'email_utama',
      'email_lain',
      'fb',
      'tw',
      'ig',
      'v_nama',
      'v_alamat',
      'v_kota',
      'v_kecepatan',
      'v_tagihan',
      'tp_bayar',
      'th_pasang',
      'v_email',
      'v_sms',
      'opsi_call',
      'kat_call',
      'sub_call',
      'status_call',
      'veri_upd',
      'veri_lup',
      'lup',
      'keterangan',
      'no_indri',
      'reason_decline',
      'date_insert'
      )
      SELECT 'id_trans_profiling',
      'idx',
      'no_telp',
      'no_internet',
      'ncli',
      'nama_pelanggan',
      'relasi',
      'jk',
      'no_hp',
      'no_hp_lain',
      'wa',
      'email_utama',
      'email_lain',
      'fb',
      'tw',
      'ig',
      'v_nama',
      'v_alamat',
      'v_kota',
      'v_kecepatan',
      'v_tagihan',
      'tp_bayar',
      'th_pasang',
      'v_email',
      'v_sms',
      'opsi_call',
      'kat_call',
      'sub_call',
      'status_call',
      'veri_upd',
      'veri_lup',
      'lup',
      'keterangan',
      'no_indri',
      'reason_decline',
      CURRENT_TIMESTAMP()
      FROM v2_trans_profiling
      WHERE v2_trans_profiling.id = $id;");
      if (isset($agentid)) {
        $lup = date("Y-m-d H:i:s");
        $dataupdate = array(
          'no_telp' => $_POST['no_telp'],
          'no_internet' => $_POST['no_internet'],
          'ncli' => $_POST['ncli'],
          'no_indri' => $_POST['no_indri'],
          'nama_pelanggan' => $_POST['nama_pelanggan'],
          'relasi' => $_POST['relasi'],
          'jk' => $_POST['jk'],
          'no_hp' => $_POST['no_hp'],
          'no_hp_lain' => $_POST['no_hp_lain'],
          'wa' => $_POST['wa'],
          'email_utama' => $_POST['email_utama'],
          'email_lain' => $_POST['email_lain'],
          'fb' => $_POST['fb'],
          'tw' => $_POST['tw'],
          'ig' => $_POST['ig'],
          'v_nama' => $_POST['v_nama'],
          'v_alamat' => $_POST['v_alamat'],
          'v_kota' => $_POST['v_kota'],
          'v_kecepatan' => $_POST['v_kecepatan'],
          'v_tagihan' => $_POST['v_tagihan'],
          'tp_bayar' => $_POST['tp_bayar'],
          'th_pasang' => $_POST['th_pasang'],
          'v_email' => $_POST['v_email'],
          'v_sms' => $_POST['v_sms'],
          'opsi_call' => $_POST['opsi_call'],
          'kat_call' => $_POST['kat_call'],
          'sub_call' => $_POST['sub_call'],
          'status_call' => $_POST['status_call'],
          'keterangan' => $_POST['keterangan'],
          'veri_upd' => $agentid,
          'veri_lup' => $lup,
          'lup' => $lup
        );

        $this->infomedia->where('id', $id);
        $updatedatanya = $this->infomedia->update('v2_trans_profiling', $dataupdate);
        if ($updatedatanya) {
          $onload = 'berhasil diupdate';
        }
      } else {
        $onload = 'login terlebih dahulu';
      }
    }

    echo "<script>
			alert('" . $onload . "');	
			window.location = '" . base_url() . "New_cwc/New_cwc/history_call';
			</script>";
  }
  public function report()
  {
    $start_filter = date('Y-m-d');
    $end_filter = date('Y-m-d');

    $start_filter = $_GET['start'];
    $end_filter = $_GET['end'];
    $agentid = $_GET['agentid'];

    $this->load->model('sys/Sys_user_log_model', 'log_login');
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $filter_agent = array("opt_level" => 8, "tl !=" => "-");
    $data['user_categori'] = '-';
    if ($userdata->opt_level == 8) {
      $filter_agent = array("agentid" => $userdata->agentid);
      $data['user_categori'] = $userdata->opt_level;
    }
    if ($userdata->opt_level == 9) {
      $filter_agent = array("tl" => $userdata->agentid);
      $data['user_categori'] = $userdata->opt_level;
    }


    $data['list_agent_d'] = $this->Sys_user_table_model->get_results($filter_agent);
    //$data['list_agent_d'] = $this->qc->get_results($filter_agent);
    $this->load->model('Custom_model/Sys_user_log_in_out_table_model', 'Sys_log');


    if (isset($agentid)) {
      if ($agentid) {
        if (count($_GET['agentid']) > 1) {
          $n_agent_pick = count($_GET['agentid']);
          foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
            if ($k_agentid == 0) {
              $filter_agent = " AND (agentid = '$v_agentid'";
              $where_agent_multi = "AND ( agentid = '$v_agentid'";
            } else {
              if ($k_agentid == ($n_agent_pick - 1)) {
                $where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' )";
                $filter_agent = $filter_agent . " OR agentid = '$v_agentid' )";
              } else {
                $where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' ";
                $filter_agent = $filter_agent . " OR agentid = '$agentid' ";
              }
            }
          }
          $where_agent['or_where_null'] = array($where_agent_multi);
        } else {
          if ($agentid[0] != '0') {
            $where_agent['agentid'] = $agentid[0];
            $filter_agent = " AND agentid = '$agentid[0]' ";
            $where_agent_multi = "AND ( agentid = '$agentid[0]')";
          }
        }
      }
    }
    if (!isset($where_agent_multi)) {
      $where_agent_multi = "";
    }


    $this->load->view('New_cwc/report', $data);
  }
  public function pencarian_kontak()
  {
    $data['type'] = $_GET['type'];
    $data['value'] = $_GET['value'];


    $this->load->view('New_cwc/multi_contact', $data);
  }
  public function multi_contact_list()
  {
    $type = $_GET['type'];
    $value = $_GET['value'];
    if ($value != '') {
      $data['on4'] = $this->on4($type, $value);
      $data['salper'] = $this->salper($type, $value);
      $data['reguler'] = $this->reguler($type, $value);
    }



    $this->load->view('New_cwc/multi_contact_list', $data);
  }

  public function on4($type, $value)
  {
    $curl = curl_init();
    if ($type = 'no_inet') {
      $type = 'indihome_num';
    } else {
      $type = 'no_telepon';
    }

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://apion4nas.infomedia.co.id/api/v2/internal_tcare/report/indihome_check',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('field' => $type, 'data' => $value),
      CURLOPT_HTTPHEADER => array(
        'authorization: Basic b2N0X3RlbGtvbWNhcmVAaW5mb21lZGlhLmNvLmlkOjFuZm9tZWRpQDIwMTg=',
        'x-dreamfactory-api-key: f18adc021d480b5c451e22e3e6fbfc8f455a54b1c8b0eb2f8072eb0412487710'
      ),
    ));

    $response = curl_exec($curl);

    $data = json_encode($response);
    return $response;
  }

  public function salper($type, $value)
  {
    $curl = curl_init();


    curl_setopt_array($curl, array(
      CURLOPT_URL => '10.194.5.20/Risma/api/index.php?function=get_profiling_data',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('s' => $value),
      CURLOPT_HTTPHEADER => array(
        'track_id: MYID-2122207051451',
        'Authorization: Basic dVByb2ZpbGxpbmc6NHAxNHBSMGYxTGxpTjY='
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $data = json_encode($response);
    return $response;
  }

  public function reguler($type, $value)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://10.194.51.88/dashboard/app/api/Public_Access/cari_kontak',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('nointernet' => $value),
      CURLOPT_HTTPHEADER => array(
        'Cookie: power_system=04cl8pcnhf0lilb13094vfl4r7npn74i'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);


    $data = json_encode($response);
    return $response;
  }
  public function history_call()
  {
    $start_filter = date('Y-m-d');
    $end_filter = date('Y-m-d');

    $start_filter = $_GET['start'];
    $end_filter = $_GET['end'];
    $agentid = $_GET['agentid'];

    $this->load->model('sys/Sys_user_log_model', 'log_login');
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $filter_agent = array("opt_level" => 8, "tl !=" => "-");
    $data['user_categori'] = '-';
    if ($userdata->opt_level == 8) {
      $filter_agent = array("agentid" => $userdata->agentid);
      $data['user_categori'] = $userdata->opt_level;
    }
    if ($userdata->opt_level == 9) {
      $filter_agent = array("tl" => $userdata->agentid);
      $data['user_categori'] = $userdata->opt_level;
    }


    $data['list_agent_d'] = $this->Sys_user_table_model->get_results($filter_agent);
    $this->load->model('Custom_model/Sys_user_log_in_out_table_model', 'Sys_log');


    if (isset($agentid)) {
      if ($agentid) {
        if (count($_GET['agentid']) > 1) {
          $n_agent_pick = count($_GET['agentid']);
          foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
            if ($k_agentid == 0) {
              $filter_agent = " AND (agentid = '$v_agentid'";
              $where_agent_multi = "AND ( agentid = '$v_agentid'";
            } else {
              if ($k_agentid == ($n_agent_pick - 1)) {
                $where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' )";
                $filter_agent = $filter_agent . " OR agentid = '$v_agentid' )";
              } else {
                $where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' ";
                $filter_agent = $filter_agent . " OR agentid = '$agentid' ";
              }
            }
          }
          $where_agent['or_where_null'] = array($where_agent_multi);
        } else {
          if ($agentid[0] != '0') {
            $where_agent['agentid'] = $agentid[0];
            $filter_agent = " AND agentid = '$agentid[0]' ";
            $where_agent_multi = "AND ( agentid = '$agentid[0]')";
          }
        }
      }
    }
    if (!isset($where_agent_multi)) {
      $where_agent_multi = "";
    }


    $this->load->view('New_cwc/history_call', $data);
  }

  public function report_list()
  {
    $data['controller'] = $this;
    $start_filter = date('Y-m-d');
    $end_filter = date('Y-m-d');
    if (isset($_GET['start']) && isset($_GET['end'])) {
      $start_filter = $_GET['start'];
      $end_filter = $_GET['end'];
      $agentid = $_GET['agentid'];
      $where_agent = array("kategori" == "REG");
      $filter_agent = "";

      $this->load->model('sys/Sys_user_log_model', 'log_login');
      $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
      $idlogin = $this->session->userdata('idlogin');
      $logindata = $this->log_login->get_by_id($idlogin);

      $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

      if (isset($agentid)) {
        if ($agentid) {
          if (count($_GET['agentid']) > 1) {
            $n_agent_pick = count($_GET['agentid']);
            foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
              if ($k_agentid == 0) {
                $filter_agent = " AND (agentid = '$v_agentid'";
                $where_agent_multi = "AND ( agentid = '$v_agentid'";
              } else {
                if ($k_agentid == ($n_agent_pick - 1)) {
                  $where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' )";
                  $filter_agent = $filter_agent . " OR agentid = '$v_agentid' )";
                } else {
                  $where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' ";
                  $filter_agent = $filter_agent . " OR agentid = '$agentid' ";
                }
              }
            }
            $where_agent['or_where_null'] = array($where_agent_multi);
          } else {
            if ($agentid[0] != '0') {
              $where_agent['agentid'] = $agentid[0];
              $filter_agent = " AND agentid = '$agentid[0]'";
              $where_agent_multi = "AND ( agentid = '$agentid[0]')";
            }
          }
        }
      }
      if (!isset($where_agent_multi)) {
        // $where_agent_multi = "agentid = '" . $agentid[0] . "'";
        $where_agent_multi = "";
      }


      $data['datanya'] = $this->infomedia->query("SELECT * FROM v2_trans_profiling WHERE  DATE( lup ) BETWEEN '$start_filter' AND '$end_filter'  $where_agent_multi  ")->result();
    }


    $data['start'] = $_GET['start'];
    $data['end'] = $_GET['end'];
    $this->load->view('New_cwc/report_list', $data);
  }
  public function history_call_list()
  {
    $data['controller'] = $this;
    $start_filter = date('Y-m-d');
    $end_filter = date('Y-m-d');
    if (isset($_GET['start']) && isset($_GET['end'])) {
      $start_filter = $_GET['start'];
      $end_filter = $_GET['end'];
      $agentid = $_GET['agentid'];
      $where_agent = array("kategori" == "REG");
      $filter_agent = "";

      $this->load->model('sys/Sys_user_log_model', 'log_login');
      $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
      $idlogin = $this->session->userdata('idlogin');
      $logindata = $this->log_login->get_by_id($idlogin);

      $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

      if (isset($agentid)) {
        if ($agentid) {
          if (count($_GET['agentid']) > 1) {
            $n_agent_pick = count($_GET['agentid']);
            foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
              if ($k_agentid == 0) {
                $filter_agent = " AND (agentid = '$v_agentid'";
                $where_agent_multi = "AND ( agentid = '$v_agentid'";
              } else {
                if ($k_agentid == ($n_agent_pick - 1)) {
                  $where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' )";
                  $filter_agent = $filter_agent . " OR agentid = '$v_agentid' )";
                } else {
                  $where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' ";
                  $filter_agent = $filter_agent . " OR agentid = '$agentid' ";
                }
              }
            }
            $where_agent['or_where_null'] = array($where_agent_multi);
          } else {
            if ($agentid[0] != '0') {
              $where_agent['agentid'] = $agentid[0];
              $filter_agent = " AND agentid = '$agentid[0]'";
              $where_agent_multi = "AND ( agentid = '$agentid[0]')";
            }
          }
        }
      }
      if (!isset($where_agent_multi)) {
        // $where_agent_multi = "agentid = '" . $agentid[0] . "'";
        $where_agent_multi = "";
      }


      $data['datanya'] = $this->infomedia->query("SELECT * FROM v2_trans_profiling WHERE  DATE( lup ) BETWEEN '$start_filter' AND '$end_filter'  $where_agent_multi  AND sub_call<>13")->result();
    }


    $data['start'] = $_GET['start'];
    $data['end'] = $_GET['end'];
    $this->load->view('New_cwc/history_call_list', $data);
  }
}
