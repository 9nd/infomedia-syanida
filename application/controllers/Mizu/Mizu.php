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
class Mizu extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('sys/Sys_user_log_model', 'log_login');
    $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
    // $this->load->model('Custom_model/Dapros_infomedia_model', 'distribution');
    $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
    $this->load->model('Custom_model/T_handle_time_model', 'T_handle_time_model');
    $this->load->model('Custom_model/Custom_model', 'Custom_model');
    // $this->infomedia = $this->load->database('infomedia', TRUE);
    $this->infomedia = $this->load->database('default', TRUE);
  }
  public function index()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Mizu/dialpage_syanida';
    $data['status_agent'] = $this->Custom_model->live_query("select * FROM agent_status WHERE userid='$logindata->id_user'")->row();

    $status_agent = $data['status_agent'];
    $data_aux = $this->Custom_model->live_query("SELECT * FROM aux WHERE aux_val='$status_agent->agent_status'")->row();
    if ($data_aux) {
      $data['data_aux'] = $this->Custom_model->live_query("SELECT * FROM aux WHERE id='$data_aux->id'")->row();
    }

    $this->load->view($view, $data);
  }
  // public function get_phonenumber()
  // {
  //   $idlogin = $this->session->userdata('idlogin');
  //   $logindata = $this->log_login->get_by_id($idlogin);
  //   $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
  //   $data = $this->Custom_model->live_query("SELECT * FROM dbprofile_validate_forcall_3p_auto WHERE status=0 LIMIT 1")->row();
  //   if ($data) {
  //     echo $data->number_hp;
  //     $this->Custom_model->live_query("UPDATE dbprofile_validate_forcall_3p_auto SET status=1 WHERE id='" . $data->id . "'");
  //   } else {
  //     echo 0;
  //   }
  // }
  public function get_ticket()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $agent_id = $data['userdata']->agentid;
    $data = $this->infomedia->query("SELECT * FROM dbprofile_validate_forcall_3p_auto WHERE status=0 AND update_by='$agent_id'")->row();
    $response['no_hp'] = "";
    $response['status'] = "kosong";
    if ($data) {
      $response['no_hp'] = '61' . $data->no_handpone;
      // $response['no_hp'] = '61081221609591';
      $response['status'] = "ada";
      $this->infomedia->query("UPDATE dbprofile_validate_forcall_3p_auto SET status=5 WHERE id='" . $data->id . "'");
      $response['calling_pty'] = $response['no_hp'];
      // $response['calling_pty'] = '61081221609591';
      $response['id'] = $data->id;
    }
    $response['pbx_campaign_id'] = rand();
    $response['limit'] = 1;
    $response['categorie_id'] = 1;

    $response['unique_key'] = rand();

    echo json_encode($response);
  }
  public function getext()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $user_id = $logindata->id_user;
    $q = "select * FROM maping_eyebeam WHERE user_id = $user_id";
    $datana = $this->Custom_model->live_query($q)->row();
    $res = array();
    $response = array(
      "server" => $datana->server,
      "username" => $datana->username,
      "password" => $datana->password,
      "id" => $datana->id,
    );
    if ($response) {
      echo json_encode($response);
    }
  }
  public function updstat() //TODO setup update RNA dll
  {
    $post = $this->input->post();
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $user_id = $logindata->id_user;
    $agent_status = $post['agent_status'];
    $status_duration = $post['status_duration'];
    $connected_number = $post['connected_number'];
    $aux_id = $post['aux_id'];
    $date = DATE('Y-m-d');
    $date_time = DATE('Y-m-d H:i:s');
    $status_ready = 0;
    $status_aux = 0;
    $aux = 0;
    if ($agent_status == "Ready" || $agent_status == "Call Disconnected") {
      $status_ready = 1;
    }
    if ($aux_id != 0) {
      $status_aux = 1;
      $aux = $aux_id;
    }
    $cek = $this->Custom_model->live_query("select count(*) as numna FROM realtime_status WHERE userid = '$user_id' AND agent_status='$agent_status' AND DATE(last_update) = '$date' ")->row()->numna;
    $cek_agent = $this->Custom_model->live_query("select count(*) as numna FROM agent_status WHERE userid = '$user_id' ")->row()->numna;
    if ($cek == 0) {
      $this->Custom_model->live_query("INSERT INTO realtime_status (userid,agent_status,status_duration,connected_number,last_update)VALUES('$user_id','$agent_status',$status_duration,'$connected_number','$date')");
    } else {
      $rowna = $this->Custom_model->live_query("select status_duration FROM realtime_status WHERE userid = '$user_id' AND agent_status='$agent_status' AND DATE(last_update) = '$date' ")->row()->status_duration;
      $status_duration_cek = intval($rowna) + intval($status_duration);
      $this->Custom_model->live_query("UPDATE realtime_status SET agent_status = '$agent_status',status_duration= $status_duration_cek,connected_number='$connected_number' WHERE userid='$user_id' AND agent_status='$agent_status' AND DATE(last_update) = '$date'");
    }
    if ($cek_agent == 0) {
      $this->Custom_model->live_query("INSERT INTO agent_status (userid,agent_status,status_duration,last_update,status_ready,status_aux,aux)VALUES('$user_id','$agent_status',$status_duration,'$date',$status_ready,$status_aux,'$aux')");
    } else {
      $this->Custom_model->live_query("UPDATE agent_status SET agent_status = '$agent_status',status_duration= $status_duration,last_update='$date_time',status_ready=$status_ready,status_aux=$status_aux,aux='$aux' WHERE userid='$user_id'");
    }
    echo 1;
  }
  public function aux() //TODO setup update RNA dll
  {
    $post = $this->input->post();
    $aux_val = $post['aux_val'];
    $campaign_id = $post['campaign_id'];
    $key_val = $post['key_val'];
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $user_id = $logindata->id_user;

    $this->Custom_model->live_query("INSERT INTO aux_status (aux_val,campaign_id,key_val)VALUES('$aux_val','$campaign_id','$key_val')");
  }
  public function get_formna()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $userdata = $data['userdata'];
    $post = $this->input->post();
    $id = $post['id'];
    $data['forcall'] = $this->infomedia->query("SELECT * FROM dbprofile_validate_forcall_3p_auto WHERE id='$id' ")->row();
    $ncli = $data['forcall']->ncli;
    $phone = $data['forcall']->no_pstn;
    $data['ucapan'] = $this->Custom_model->live_query("SELECT * FROM t_script where status = 'aktif'")->row();

    $data['datahc'] = $this->infomedia->query("SELECT * FROM trans_profiling_verifikasi where ncli='$ncli' and no_pstn='$phone'");
    $data['verifagnt'] = $this->infomedia->query("SELECT COUNT(1) as jml FROM trans_profiling_verifikasi WHERE update_by='$userdata->agentid' and lup BETWEEN '$today' AND '$vtoday'")->row();
    $data['datanya'] = $this->infomedia->query("CALL sp_get_notel_auto('$phone','$userdata->agentid','$ncli')")->row();
    if (!$data['datanya']) {
      echo "<script>
      alert('maaf, data tidak tersedia');
     
      </script>";
    }
    if ($data['datanya']->status == 1) {
      echo "<script>
      alert('data yang anda pilih sudah verified');
      
      </script>";
    }
    // var_dump($data['datanya']);
    if (count($data['datanya']) > 0) {
      $view = "Mizu/form";

      return $this->load->view($view, $data);
    } else {
      echo "<script>
      alert('data not available');
     
      </script>";
    }
  }
  function set_session()
  {
    $random_char = 1;
    $characters = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
    $keys = array();
    while (count($keys) < 8) {
      $x = mt_rand(0, count($characters) - 1);
      if (!in_array($x, $keys)) {
        $keys[] = $x;
      }
    }
    foreach ($keys as $key) {
      $random_char .= $characters[$key];
    }
    $today = date('mdH');
    $var_tiket = $today . $random_char;

    return $var_tiket;
  }
  // function set_mos_to_telkom($ncli, $nd, $nama, $relasi, $hp, $email, $kota, $facebook, $twitter)
  function get_token_moss()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://apigw.telkom.co.id:7777/invoke/pub.apigateway.oauth2/getAccessToken",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => '{
				"grant_type":"client_credentials",
				"client_id":"432b96ed-00bc-40b8-ba28-29582561e35e",
				"client_secret":"8b27a24e-98d0-4dde-aaf4-c18bfe2dfe07"
				}',
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        'Content-Type: application/json',
        "postman-token: 7be6d429-43ee-cd2c-61dc-3d36c10f72dc"
      ),
    ));

    $response = curl_exec($curl);
    $response = json_decode($response);
    return $response->access_token;
  }
  function set_mos_to_telkom_rest($ncli, $nd, $nama, $relasi, $hp, $email, $kota, $facebook, $twitter, $regional = '')
  {
    $curl = curl_init();
    $token = $this->get_token_moss();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://apigw.telkom.co.id:7777/ws/telkom-eai-insertVerifiedProfile/1.0/insertVerifiedProfile",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => '{
				"P_NCLI": "' . $ncli . '",
				"P_ND": "' . $nd . '",
				"P_NAMA" : "' . $nama . '",
				"P_RELASI": "' . $relasi . '",
				"P_HP" : "' . $hp . '",
				"P_SUMBER" : "INFOMEDIA_MOSS",
				"P_EMAIL":"' . $email . '",
				"P_KOTA":"' . $kota . '"
			}
			',
      CURLOPT_HTTPHEADER => array(
        'Accept: application/json',
        "cache-control: no-cache",
        'Content-Type: application/json',
        "postman-token: 7be6d429-43ee-cd2c-61dc-3d36c10f72dc",
        "Authorization: Bearer $token"
      ),
    ));

    $response = curl_exec($curl);
    $response = json_decode($response);
    // return $response;
    if ($response->insertVerifiedProfileResponse->outResult == 2) {
      return $response->insertVerifiedProfileResponse->outMessage;
    } else {
      return $response;
    }
  }
  public function submitData()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $idx = $_POST['idx'];

    $lup = date("Y-m-d H:i:s");
    $random_num = $this->set_session();
    $status = 0;
    if ($_POST['labelvalidated'] == "valid") {
      $status = 1;
    }
    $bysistem = $this->input->post('bysistem');


    $pc = $_SERVER['REMOTE_ADDR'];

    $click_session = trim($_POST['click_session']);


    //moss

    ///////reguler/////

    if ($userdata->agentid != NULL) {
      if ($_POST['otpphone']  == "") {
        $_POST['otpphone'] = $_POST['code_handphone'];
      }
      if ($_POST['otpemail']  == "") {
        $_POST['otpemail'] = $_POST['code_email'];
      }
      if ($click_session == "") {
        $data1 = array(
          'pstn1'  =>  $_POST['no_pstn'],
          'no_speedy' =>  $_POST['no_speedy'],
          'ncli'  =>  $_POST['ncli'],
          'nama'  =>  $_POST['nama_pelanggan'],
          'kepemilikan'  =>  $_POST['relasi'],
          'facebook'  =>  $_POST['facebook'],
          'twitter'  =>  $_POST['twitter'],
          'verfi_email'  =>  $_POST['otpemail'],
          'email'  =>  $_POST['email'],
          'handphone'  =>  $_POST['no_handpone'],
          'email_lain'  =>  $_POST['email_lainnya'],
          'verfi_handphone'  =>  $_POST['otpphone'],
          'nama_pastel'  =>  $_POST['nama_pastel'],
          'alamat'  =>  $_POST['alamat'],
          'kota'  =>  $_POST['kota'],
          'kec_speedy'  =>  $_POST['kec_speedy'],
          'billing'  =>  $_POST['billing'],
          'payment'  =>  $_POST['payment'],
          'waktu_psb'  =>  $_POST['waktu_psb'],
          'veri_call'  =>  $_POST['veri_call'],
          'veri_status'  =>  $_POST['veri_status'],
          'veri_keterangan'  =>  $_POST['keterangan'],
          'handphone_lain'  =>  $_POST['handphone_lainnya'],
          'click_session'  =>  $random_num,
          'veri_upd'  =>  $userdata->agentid,
          'veri_lup'  =>  $lup,
          'lup'  =>  $lup,
          'ip_address'  =>  $pc,
          'status'  =>  $status,
          'veri_system'  =>  $_POST['bysistem'],
          'veri_count'  =>  '1',
          'opsi_call'  =>  $_POST['opsi_call']

        );
        $this->infomedia->insert('trans_profiling', $data1);
        $insert_id = $this->infomedia->insert_id();

        if (!isset($_POST['emailtambahan1'])) {
          $emailtambahan1 = "";
        } else {
          $emailtambahan1 = $_POST['emailtambahan1'];
        }
        if (!isset($_POST['emailtambahan2'])) {
          $emailtambahan2 = "";
        } else {
          $emailtambahan2 = $_POST['emailtambahan2'];
        }
        if (!isset($_POST['emailtambahan3'])) {
          $emailtambahan3 = "";
        } else {
          $emailtambahan3 = $_POST['emailtambahan3'];
        }
        if (!isset($_POST['hptambahan1'])) {
          $hptambahan1 = "";
        } else {
          $hptambahan1 = $_POST['hptambahan1'];
        }
        if (!isset($_POST['hptambahan2'])) {
          $hptambahan2 = "";
        } else {
          $hptambahan2 = $_POST['hptambahan2'];
        }
        if (!isset($_POST['hptambahan3'])) {
          $hptambahan3 = "";
        } else {
          $hptambahan3 = $_POST['hptambahan3'];
        }
        if ($insert_id != 0) {
          $data11 = array(
            'pstn1'  =>  $_POST['no_pstn'],
            'no_speedy' =>  $_POST['no_speedy'],
            'ncli'  =>  $_POST['ncli'],
            'nama'  =>  $_POST['nama_pelanggan'],
            'kepemilikan'  =>  $_POST['relasi'],
            'facebook'  =>  $_POST['facebook'],
            'twitter'  =>  $_POST['twitter'],
            'verfi_email'  =>  $_POST['otpemail'],
            'email'  =>  $_POST['email'],
            'handphone'  =>  $_POST['no_handpone'],
            'email_lain'  =>  $_POST['email_lainnya'],
            'verfi_handphone'  =>  $_POST['otpphone'],
            'nama_pastel'  =>  $_POST['nama_pastel'],
            'alamat'  =>  $_POST['alamat'],
            'kota'  =>  $_POST['kota'],
            'kec_speedy'  =>  $_POST['kec_speedy'],
            'billing'  =>  $_POST['billing'],
            'payment'  =>  $_POST['payment'],
            'waktu_psb'  =>  $_POST['waktu_psb'],
            'veri_call'  =>  $_POST['veri_call'],
            'veri_status'  =>  $_POST['veri_status'],
            'veri_keterangan'  =>  $_POST['keterangan'],
            'handphone_lain'  =>  $_POST['handphone_lainnya'],
            'reason_decline'  =>  $_POST['reason_decline'],
            'idx'  =>  $insert_id,
            'email3'  =>  $emailtambahan1,
            'email4'  =>  $emailtambahan2,
            'email5'  =>  $emailtambahan3,
            'hp3'  =>  $hptambahan1,
            'hp4'  => $hptambahan2,
            'hp5'  =>  $hptambahan3,
            'sumber'  =>  $_POST['sumber'],
            'jk'  =>  $_POST['jk'],
            'click_session'  =>  $random_num,
            'veri_upd'  =>  $userdata->agentid,
            'veri_lup'  =>  $lup,
            'lup'  =>  $lup,
            'ip_address'  =>  $pc,
            'status'  =>  $status,
            'veri_system'  =>  $_POST['bysistem'],
            'veri_count'  => '1',
            'opsi_call'  =>  $_POST['opsi_call']
          );
          $this->infomedia->insert('trans_profiling_detail', $data11);
          $onload = "Data Not Verified, Sukses disimpan";
        }



        if ($_POST['nama_pelanggan'] != "" && $_POST['veri_status'] == 1 &&  $_POST['veri_call'] == 13 &&  $_POST['ncli'] != substr($_POST['ncli'], 0, 2)) {
          if ($_POST['otpemail'] != "" || $_POST['otpphone'] != "") {

            $data1 = array(
              'no_pstn'  =>  $_POST['no_pstn'],
              'no_speedy' =>  $_POST['no_speedy'],
              'ncli'  =>  $_POST['ncli'],
              'nama_pelanggan'  =>  $_POST['nama_pelanggan'],
              'relasi'  =>  $_POST['relasi'],
              'status_handpone'  =>  $_POST['otpphone'],
              'no_handpone'  =>  $_POST['no_handpone'],
              'email'  =>  $_POST['email'],
              'status_email'  =>  $_POST['otpemail'],
              'facebook'  =>  $_POST['facebook'],
              'twitter'  =>  $_POST['twitter'],
              'nama_pastel'  =>  $_POST['nama_pastel'],
              'alamat'  =>  $_POST['alamat'],
              'kota'  =>  $_POST['kota'],
              'regional'  =>  $_POST['regional'],
              'update_by'  =>  $userdata->agentid,
              'lup'  =>  $lup,
              'is_last'  =>  '0',
              'sumber'  =>  '0'

            );
            $this->infomedia->insert('trans_profiling_verifikasi', $data1);
            $onload = "Data verifikasi, Sukses disimpan";
          } elseif ($_POST['bysistem'] == 1) {
            $verfi_handphone = $_POST['code_handphone'];
            $verfi_email = $_POST['code_email'];
            $data1 = array(
              'no_pstn'  =>  $_POST['no_pstn'],
              'no_speedy' =>  $_POST['no_speedy'],
              'ncli'  =>  $_POST['ncli'],
              'nama_pelanggan'  =>  $_POST['nama_pelanggan'],
              'relasi'  =>  $_POST['relasi'],
              'status_handpone'  =>  $verfi_handphone,
              'no_handpone'  =>  $_POST['no_handpone'],
              'email'  =>  $_POST['email'],
              'status_email'  =>  $verfi_email,
              'facebook'  =>  $_POST['facebook'],
              'twitter'  =>  $_POST['twitter'],
              'nama_pastel'  =>  $_POST['nama_pastel'],
              'alamat'  =>  $_POST['alamat'],
              'kota'  =>  $_POST['kota'],
              'regional'  =>  $_POST['regional'],
              'update_by'  =>  $userdata->agentid,
              'lup'  =>  $lup,
              'is_last'  =>  '0',
              'sumber'  =>  '0'
            );
            $this->infomedia->insert('trans_profiling_verifikasi', $data1);
            $onload = "Data verifikasi by system, Sukses disimpan";
          } else {
            $onload = "Kode Email/Handphone Tidak diisi, Verifikasi tidak sukses disimpan";
          }
        }
      } else {
        if ($_POST['otpphone']  == "") {
          $_POST['otpphone'] = $_POST['code_handphone'];
        }
        if ($_POST['otpemail']  == "") {
          $_POST['otpemail'] = $_POST['code_email'];
        }
        $data1 = array(
          'pstn1'  =>  $_POST['no_pstn'],
          'no_speedy' =>  $_POST['no_speedy'],
          'ncli'  =>  $_POST['ncli'],
          'nama'  =>  $_POST['nama_pelanggan'],
          'kepemilikan'  =>  $_POST['relasi'],
          'facebook'  =>  $_POST['facebook'],
          'twitter'  =>  $_POST['twitter'],
          'verfi_email'  =>  $_POST['otpemail'],
          'email'  =>  $_POST['email'],
          'veri_count' => 0,
          'handphone'  =>  $_POST['no_handpone'],
          'email_lain'  =>  $_POST['email_lainnya'],
          'verfi_handphone'  =>  $_POST['otpphone'],
          'nama_pastel'  =>  $_POST['nama_pastel'],
          'alamat'  =>  $_POST['alamat'],
          'kota'  =>  $_POST['kota'],
          'kec_speedy'  =>  $_POST['kec_speedy'],
          'billing'  =>  $_POST['billing'],
          'payment'  =>  $_POST['payment'],
          'waktu_psb'  =>  $_POST['waktu_psb'],
          'veri_call'  =>  $_POST['veri_call'],
          'veri_status'  =>  $_POST['veri_status'],
          'veri_keterangan'  =>  $_POST['keterangan'],
          'handphone_lain'  =>  $_POST['handphone_lainnya'],
          'veri_upd'  =>  $userdata->agentid,
          'veri_lup'  =>  $lup,
          'lup'  =>  $lup,
          'ip_address'  =>  $pc,
          'status'  =>  $status,
          'veri_system'  =>  $_POST['bysistem'],
          'opsi_call'  =>  $_POST['opsi_call']
        );
        $this->infomedia->where('click_session', $_POST['click_session']);
        $this->infomedia->update('trans_profiling', $data1);

        if (!isset($_POST['emailtambahan1'])) {
          $emailtambahan1 = "";
        } else {
          $emailtambahan1 = $_POST['emailtambahan1'];
        }
        if (!isset($_POST['emailtambahan2'])) {
          $emailtambahan2 = "";
        } else {
          $emailtambahan2 = $_POST['emailtambahan2'];
        }
        if (!isset($_POST['emailtambahan3'])) {
          $emailtambahan3 = "";
        } else {
          $emailtambahan3 = $_POST['emailtambahan3'];
        }
        if (!isset($_POST['hptambahan1'])) {
          $hptambahan1 = "";
        } else {
          $hptambahan1 = $_POST['hptambahan1'];
        }
        if (!isset($_POST['hptambahan2'])) {
          $hptambahan2 = "";
        } else {
          $hptambahan2 = $_POST['hptambahan2'];
        }
        if (!isset($_POST['hptambahan3'])) {
          $hptambahan3 = "";
        } else {
          $hptambahan3 = $_POST['hptambahan3'];
        }

        $data11 = array(
          'pstn1'  =>  $_POST['no_pstn'],
          'no_speedy' =>  $_POST['no_speedy'],
          'ncli'  =>  $_POST['ncli'],
          'nama'  =>  $_POST['nama_pelanggan'],
          'kepemilikan'  =>  $_POST['relasi'],
          'facebook'  =>  $_POST['facebook'],
          'twitter'  =>  $_POST['twitter'],
          'verfi_email'  =>  $_POST['otpemail'],
          'email'  =>  $_POST['email'],
          'veri_count' => 0,
          'handphone'  =>  $_POST['no_handpone'],
          'email_lain'  =>  $_POST['email_lainnya'],
          'verfi_handphone'  =>  $_POST['otpphone'],
          'nama_pastel'  =>  $_POST['nama_pastel'],
          'alamat'  =>  $_POST['alamat'],
          'kota'  =>  $_POST['kota'],
          'kec_speedy'  =>  $_POST['kec_speedy'],
          'billing'  =>  $_POST['billing'],
          'payment'  =>  $_POST['payment'],
          'waktu_psb'  =>  $_POST['waktu_psb'],
          'veri_call'  =>  $_POST['veri_call'],
          'veri_status'  =>  $_POST['veri_status'],
          'veri_keterangan'  =>  $_POST['keterangan'],
          'handphone_lain'  =>  $_POST['handphone_lainnya'],
          'reason_decline'  =>  $_POST['reason_decline'],
          'veri_upd'  =>  $userdata->agentid,
          'veri_lup'  =>  $lup,
          'lup'  =>  $lup,
          'ip_address'  =>  $pc,
          'status'  =>  $status,
          'veri_system'  =>  $_POST['bysistem'],
          'opsi_call'  =>  $_POST['opsi_call'],
          'email3'  =>  $emailtambahan1,
          'email4'  =>  $emailtambahan2,
          'email5'  =>  $emailtambahan3,
          'hp3'  =>  $hptambahan1,
          'hp4'  => $hptambahan2,
          'hp5'  =>  $hptambahan3,
          'sumber'  =>  $_POST['sumber'],
          'jk'  =>  $_POST['jk']
        );
        $this->infomedia->where('click_session',  $_POST['click_session']);
        $this->infomedia->update('trans_profiling_detail', $data11);
        if ($_POST['veri_status'] != 3) {
          if ($_POST['nama_pelanggan'] != "" && $_POST['veri_status'] == "1" && $_POST['ncli'] != substr($_POST['ncli'], 0, 2)) {
            if ($_POST['otpemail'] != "" || $_POST['otpphone'] != "") {
              $data1 = array(
                'no_pstn'  =>  $_POST['no_pstn'],
                'no_speedy' =>  $_POST['no_speedy'],
                'ncli'  =>  $_POST['ncli'],
                'nama_pelanggan'  =>  $_POST['nama_pelanggan'],
                'relasi'  =>  $_POST['relasi'],
                'status_handpone'  =>  $_POST['otpphone'],
                'no_handpone'  =>  $_POST['no_handpone'],
                'email'  =>  $_POST['email'],
                'status_email'  =>  $_POST['otpemail'],
                'facebook'  =>  $_POST['facebook'],
                'twitter'  =>  $_POST['twitter'],
                'nama_pastel'  =>  $_POST['nama_pastel'],
                'alamat'  =>  $_POST['alamat'],
                'kota'  =>  $_POST['kota'],
                'regional'  =>  $_POST['regional'],
                'update_by'  =>  $userdata->agentid,
                'lup'  =>  $lup,
                'is_last'  =>  '0',
                'sumber'  =>  '0'

              );
              $this->infomedia->insert('trans_profiling_verifikasi', $data1);
              $onload = "Data verifikasi, Sukses disimpan";
            } elseif ($_POST['bysistem'] == 1) {
              $verfi_handphone = $_POST['code_handphone'];
              $verfi_email = $_POST['code_email'];
              $data1 = array(
                'no_pstn'  =>  $_POST['no_pstn'],
                'no_speedy' =>  $_POST['no_speedy'],
                'ncli'  =>  $_POST['ncli'],
                'nama_pelanggan'  =>  $_POST['nama_pelanggan'],
                'relasi'  =>  $_POST['relasi'],
                'status_handpone'  =>  $verfi_handphone,
                'no_handpone'  =>  $_POST['no_handpone'],
                'email'  =>  $_POST['email'],
                'status_email'  =>  $verfi_email,
                'facebook'  =>  $_POST['facebook'],
                'twitter'  =>  $_POST['twitter'],
                'nama_pastel'  =>  $_POST['nama_pastel'],
                'alamat'  =>  $_POST['alamat'],
                'kota'  =>  $_POST['kota'],
                'regional'  =>  $_POST['regional'],
                'update_by'  =>  $userdata->agentid,
                'lup'  =>  $lup,
                'verified'  =>  '1',
                'is_last'  =>  '0',
                'sumber'  =>  '0'

              );
              $this->infomedia->insert('trans_profiling_verifikasi', $data1);
              $onload = "Data verifikasi by Sistem, Sukses disimpan";
            } else {
              $onload = "Kode Email/Handphone Tidak diisi, Verifikasi tidak sukses disimpan";
            }
          }
        }
      }

      $dataupdate = array(
        'status'  =>  $_POST['veri_status'],
        'lup' => $lup,
        'no_handpone' => $_POST['no_handpone'],
        'nama_pelanggan' => $_POST['nama_pelanggan'],
        'email' => $_POST['email'],
        'keterangan' => $_POST['keterangan']
      );

      $this->infomedia->where('update_by', $userdata->agentid);

      if ($_GET['phone'] == "") {
        $dataupdate['no_pstn'] = $_POST['no_pstn'];
        $this->infomedia->where('no_speedy', $_POST['no_speedy']);
      } else {
        $this->infomedia->where('no_pstn', $_GET['phone']);
      }

      // $this->infomedia->where("(no_pstn = '$no_pstn' OR no_speedy = '$no_speedy')");
      $this->infomedia->update('dbprofile_validate_forcall_3p_auto', $dataupdate);
      $response = array(
        "id" => $insert_id
      );
      echo json_encode($response);
    }
  }
}
