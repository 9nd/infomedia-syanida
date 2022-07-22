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
class Dc extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('sys/Sys_user_log_model', 'log_login');
    $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
    $this->load->model('Custom_model/Dapros_infomedia_model', 'distribution');
    // $this->load->model('Custom_model/Dapros_model', 'distribution');
    $this->load->model('Custom_model/Sumber_model', 'sumber');
    $this->load->model('Custom_model/Landing_page_model', 'landing_page');
    $this->load->model('Custom_model/Failover_model', 'failover');
    $this->load->model('Custom_model/Campaign_model', 'campaign');
  }
  public function index()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Dc/dashboard';
    $this->load->view($view, $data);
  }
  public function campaign()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $data['campaign'] = $this->campaign->get_results(array("join" => array("landing_page" => "landing_page.id = campaign.landing_page_key")), array("campaign.*,landing_page.campaign_name as title_landing_page"));
    $view = 'Dc/campaign';

    $this->load->view($view, $data);
  }
  public function lp()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $data['landing_page'] = $this->landing_page->get_results();
    $view = 'Dc/lp';

    $this->load->view($view, $data);
  }
  public function lp_add()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

    $view = 'Dc/lp_add';
    $data['return'] = false;
    if (isset($_POST['title'])) {
      $data_insert = array(
        "title" => $_POST['title'],
        "link" => $_POST['link']
      );
      $input = $this->landing_page->add($data_insert);
      if ($input) {
        $data['return'] = "Landing Page Berhasil di Tambahkan.";
      }
    }

    $this->load->view($view, $data);
  }
  public function lp_update($id = false)
  {
    if ($id) {
      $idlogin = $this->session->userdata('idlogin');
      $logindata = $this->log_login->get_by_id($idlogin);
      $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

      $view = 'Dc/lp_update';
      $data['return'] = false;
      if (isset($_POST['title'])) {
        $data_insert = array(
          "link" => $_POST['link'],
          "title" => $_POST['title']
        );
        $input = $this->landing_page->update($id, $data_insert);
        if ($input) {
          $data['return'] = "Landing Page Berhasil di Update.";
        }
      }
      $data['landing_page'] = $this->landing_page->get_row(array("id" => $id));
      $this->load->view($view, $data);
    }
  }
  public function fo()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $data['failover'] = $this->failover->get_results();
    $view = 'Dc/fo';

    $this->load->view($view, $data);
  }
  public function fo_update($id = false)
  {
    if ($id) {
      $idlogin = $this->session->userdata('idlogin');
      $logindata = $this->log_login->get_by_id($idlogin);
      $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

      $view = 'Dc/fo_update';
      $data['return'] = false;
      if (isset($_POST['urutan'])) {
        $data_insert = array(
          "urutan" => $_POST['urutan'],
          "next" => $_POST['next']
        );
        $input = $this->failover->update($id, $data_insert);
        if ($input) {
          $data['return'] = "Failover Berhasil di Update.";
        }
      }
      $data['failover'] = $this->failover->get_row(array("id" => $id));
      $this->load->view($view, $data);
    }
  }
  public function campaign_add()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

    $data['landing_page'] = $this->landing_page->get_results();
    $view = 'Dc/campaign_add';
    $data['return'] = false;
    if (isset($_POST['title'])) {
      $data_insert = array(
        "status" => $_POST['status'],
        "title" => $_POST['title'],
        "date_online" => $_POST['date_online'],
        "template_sms" => $_POST['template_sms'],
        "tempalte_wa" => $_POST['tempalte_wa'],
        "template_email" => $_POST['template_email'],
        "landing_page" => $_POST['landing_page'],
      );
      $input = $this->campaign->add($data_insert);
      if ($input) {
        $data['return'] = "Campaign Berhasil di Tambahkan.";
      }
    }

    $this->load->view($view, $data);
  }
  public function campaign_update($id = false)
  {
    if ($id) {
      $idlogin = $this->session->userdata('idlogin');
      $logindata = $this->log_login->get_by_id($idlogin);
      $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

      $data['landing_page'] = $this->landing_page->get_results();
      $view = 'Dc/campaign_update';
      $data['return'] = false;
      if (isset($_POST['title'])) {
        $data_insert = array(
          "status" => $_POST['status'],
          "title" => $_POST['title'],
          "date_online" => $_POST['date_online'],
          "template_sms" => $_POST['template_sms'],
          "tempalte_wa" => $_POST['tempalte_wa'],
          "template_email" => $_POST['template_email'],
          "landing_page" => $_POST['landing_page'],
        );
        $input = $this->campaign->update($id, $data_insert);
        if ($input) {
          $data['return'] = "Campaign Berhasil di Update.";
        }
      }
      $data['campaign'] = $this->campaign->get_row(array("id" => $id));
      $this->load->view($view, $data);
    }
  }
  public function campaign_start($id = false, $status = 'Draf')
  {
    if ($id) {
      $idlogin = $this->session->userdata('idlogin');
      $logindata = $this->log_login->get_by_id($idlogin);
      $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

      $data['landing_page'] = $this->landing_page->get_results();
      $view = 'Dc/campaign_update';
      $data['return'] = false;

      $data_insert = array(
        "status" => $status,
        "date_online" => date('Y-m-d')
      );
      $input = $this->campaign->update($id, $data_insert);
      if ($input) {
        $data['return'] = "Campaign Berhasil di Update.";
      }
      $campaign = $this->campaign->get_row(array("id" => $id));
      redirect(site_url() . 'Dc/Dc/campaign?success_create_lead=1&info=Campaign ' . $campaign->title . ' Berhasil ' . $status . '.!');
    }
  }
  public function campaign_datalead($id)
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));


    $view = 'Dc/campaign_lead';
    $data['return'] = false;
    $data['create_lead'] = false;
    if (isset($_POST['sumber'])) {
      $filter = array();
      $filter["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '' )"] = null;
      $filter["(ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '' )"] = null;
      $filter['status'] = 0;
      $filter['status2'] = 0;
      $filter['status3'] = 0;
      if ($_POST['sumber'] != 'All') {
        $filter['sumber'] = $_POST['sumber'];
      }
      if ($_POST['regional'] != 'All') {
        $rg = $_POST['regional'];
        $filter["SUBSTRING( no_speedy, 2, 1 ) = '$rg' "] = NULL;
      }

      $filter_hp_email = $filter;
      $filter_hp_email["no_handpone LIKE '08%' "] = NULL;
      $filter_hp_email["email LIKE '%@%' "] = NULL;
      $data['hp_email'] = $this->distribution->get_count($filter_hp_email);

      $filter_hp_only = $filter;
      $filter_hp_only["no_handpone LIKE '08%' "] = NULL;
      $filter_hp_only["(email NOT LIKE '%@%' OR email = '' OR ISNULL(email)) "] = NULL;
      $data['hp_only'] = $this->distribution->get_count($filter_hp_only);

      $filter_email_only = $filter;
      $filter_email_only["(no_handpone NOT LIKE '08%' OR no_handpone = '' OR ISNULL(no_handpone))"] = NULL;
      $filter_email_only["email LIKE '%@%' "] = NULL;
      $data['email_only'] = $this->distribution->get_count($filter_email_only);

      $filter_no = $filter;
      $filter_no["(no_handpone = '' OR ISNULL(no_handpone) OR no_handpone NOT LIKE '08%') "] = NULL;
      $filter_no["(email = '' OR ISNULL(email) OR email NOT LIKE '%@%')"] = NULL;
      $data['no_hp_no_email'] = $this->distribution->get_count($filter_no);

      $data['create_lead'] = "?regional=" . $_POST['regional'] . "&sumber=" . $_POST['sumber'] . "&campaign=" . $id;
    }
    $data['campaign'] = $this->campaign->get_row(array("join" => array("landing_page" => "landing_page.id = campaign.landing_page"), "campaign.id" => $id), array("campaign.*,landing_page.title as title_landing_page"));
    $data['data_sumber'] = $this->sumber->live_query("SELECT sumber FROM sumber ")->result();
    // $data['data_sumber'] = $this->sumber->live_query("SELECT sumber FROM sumber GROUP BY sumber_parent")->result();
    $this->load->view($view, $data);
  }
  public function campaign_dashboard($id)
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $data['campaign'] = $this->campaign->get_row(array("id" => $id));

    $data['raw'] = $this->distribution->get_results(array("update_by" => 'DC-' . $id));
    $data['order'] = $this->distribution->get_count(array("update_by" => 'DC-' . $id));
    $data['progress_order'] = $this->distribution->get_count(array("update_by" => 'DC-' . $id, "status NOT IN (0,60,70,80)" => NULL));
    $data['percent_order'] = ($data['progress_order'] / $data['order']) * 100;
    $data['wa'] = $this->distribution->get_count(array("update_by" => 'DC-' . $id, "status IN (60,61,62,63) " => NULl));
    $data['progress_wa'] = $this->distribution->get_count(array("update_by" => 'DC-' . $id, "status IN (61,62,63)" => NULL));
    $data['percent_wa'] = ($data['progress_wa'] / $data['wa']) * 100;
    $data['sms'] = $this->distribution->get_count(array("update_by" => 'DC-' . $id, "status IN (70,71,72,73)" => NULl));
    $data['progress_sms'] = $this->distribution->get_count(array("update_by" => 'DC-' . $id, "status IN (71,72,73)" => NULL));
    $data['percent_sms'] = ($data['progress_sms'] / $data['sms']) * 100;
    $data['email'] = $this->distribution->get_count(array("update_by" => 'DC-' . $id, "status IN (80,81,82,83)" => NULL));
    $data['progress_email'] = $this->distribution->get_count(array("update_by" => 'DC-' . $id, "status IN (81,82,83)" => NULL));
    $data['percent_email'] = ($data['progress_email'] / $data['email']) * 100;
    $view = 'Dc/campaign_dashboard';
    $this->load->view($view, $data);
  }
  public function proses_campaign_lead()
  {
    if (isset($_GET['sumber'])) {
      $campaign = $this->campaign->get_row(array('id' => $_GET['campaign']));
      $filter = array();
      $filter["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '' )"] = null;
      $filter["(ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '' )"] = null;
      $filter['status'] = 0;
      $filter['status2'] = 0;
      $filter['status3'] = 0;
      if ($_GET['sumber'] != 'All') {
        $filter['sumber'] = $_GET['sumber'];
      }
      if ($_GET['regional'] != 'All') {
        $rg = $_GET['regional'];
        $filter["SUBSTRING( no_speedy, 2, 1 ) = '$rg' "] = NULL;
      }
      $update_field = array(
        'update_by' => 'DC-' . $_GET['campaign']
      );
      $data['hp_email'] = $this->distribution->edit($filter, $update_field);
      $jumlah_data = $this->distribution->get_count($update_field);
      $this->campaign->update($_GET['campaign'], array('data_lead' => $jumlah_data, 'data_lead_code' => 'DC-' . $_GET['campaign']));
    }

    redirect(site_url() . 'Dc/Dc/campaign?success_create_lead=1&info=Data Lead Untuk Campaign ' . $campaign->title . ' Berhasil Dibuat.!');
  }
  public function engine()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Dc/engine';

    if (isset($_POST['engine'])) {
      switch ($_POST['engine']) {
        case "email":
          $data['return_blast'] = $this->blast_email($_POST['receiver']);
          break;
        case "sms":
          $data['return_blast'] = $this->blast_sms($_POST['receiver']);
          if (!$data['return_blast']) {
            $data['return_blast'] = 'Sms Gagal Terkirim.';
          }
          break;
        case "wa":
          $data['return_blast'] = $this->blast_wa($_POST['receiver']);
          break;
      }
    } else {
      $data['return_blast'] = false;
    }
    $this->load->view($view, $data);
  }
  function dalalead()
  {
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    $view = 'Dc/datalead';


    $filter = array();
    $filter["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '' )"] = null;
    $filter["(ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '' )"] = null;
    $filter['status'] = 0;
    $filter['status2'] = 0;
    $filter['status3'] = 0;

    $filter_hp_email = $filter;
    $filter_hp_email["no_handpone LIKE '08%' "] = NULL;
    $filter_hp_email["email LIKE '%@%' "] = NULL;
    $data['hp_email'] = $this->distribution->get_count($filter_hp_email);

    $filter_hp_only = $filter;
    $filter_hp_only["no_handpone LIKE '08%' "] = NULL;
    $filter_hp_only["(email NOT LIKE '%@%' OR email = '' OR ISNULL(email)) "] = NULL;
    $data['hp_only'] = $this->distribution->get_count($filter_hp_only);

    $filter_email_only = $filter;
    $filter_email_only["(no_handpone NOT LIKE '08%' OR no_handpone = '' OR ISNULL(no_handpone))"] = NULL;
    $filter_email_only["email LIKE '%@%' "] = NULL;
    $data['email_only'] = $this->distribution->get_count($filter_email_only);

    $filter_no = $filter;
    $filter_no["(no_handpone = '' OR ISNULL(no_handpone) OR no_handpone NOT LIKE '08%') "] = NULL;
    $filter_no["(email = '' OR ISNULL(email) OR email NOT LIKE '%@%')"] = NULL;
    $data['no_hp_no_email'] = $this->distribution->get_count($filter_no);

    $query_regional = "
      SELECT sumber,SUBSTRING( no_speedy, 2, 1 ) as regionalna,count(*) as numna
      FROM dbprofile_validate_forcall_3p
       WHERE
      (ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '' )
      AND 
      (ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '' )
      AND status = 0 AND status2=0 AND status3=0
      GROUP BY sumber,SUBSTRING( no_speedy, 2, 1 )
    ";
    $data_regional = $this->distribution->live_query($query_regional)->result();
    $data['data_regional'] = array();
    $data['rating_sumber'] = array();
    if (count($data_regional) > 0) {
      foreach ($data_regional as $row) {
        $sumber = $this->sumber->get_row(array("sumber" => $row->sumber));
        if ($sumber) {
          $sumber = $sumber->sumber_parent;
        } else {
          $sumber = 'others';
        }
        if ($row->regionalna > 7 && $row->regionalna < 1) {
          $data['data_regional']['others'] = $data['data_regional']['others'] + $row->numna;
          $data['data_regional'][$sumber]['others'] = $row->numna;
        } else {
          $data['data_regional'][$row->regionalna] = $data['data_regional'][$row->regionalna] + $row->numna;
          $data['data_regional'][$sumber][$row->regionalna] = $row->numna;
        }
        $data['data_regional'][$sumber]['total'] = $data['data_regional'][$sumber]['total'] + $row->numna;
        $data['data_regional']['total'] = $row->numna + $data['data_regional']['total'];
      }
    }
    $data['data_sumber'] = $this->sumber->live_query("SELECT sumber_parent FROM sumber GROUP BY sumber_parent")->result();
    $this->load->view($view, $data);
  }

  //userdefined function for checking internet
  function check_internet($domain)
  {
    $file = @fsockopen($domain, 80); //@fsockopen is used to connect to a socket
    if ($file) {
      echo "You are connected to the internet.";
    } else {
      echo "You seem to be offline. Please check your internet connection.";
    }
  }
  function blast_email($email = false)
  {
    // $uri_image=base_url().'images/campaign_image/'.$image;
    $message = 'Email Digital Channel';
    $return = 'Gagal';
    $curl = curl_init();
    $url = "http://10.194.194.251/digital_media_profiling/index.php/api/send/email";
    $arr = array(
      // "email" => 'ahmadsadikin8888@gmail.com',
      "email" => $email,
      "subject" => "Digital Channel",
      "message" => $message
    );
    $data = http_build_query($arr);

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/x-www-form-urlencoded"
      ),
    ));

    $response = curl_exec($curl);
    $response = json_decode($response);

    if (isset($response->sts)) {
      $return = $response->message;
    }

    return $return;
  }
  function blast_wa($number = false)
  {
    $number = $this->hp($number);
    $return = 'Gagal';
    $curl = curl_init();
    $url = "https://webhook.infomedia.co.id/whatsapp/sendHSM";
    $data = '{
      "account_id": "628118800147",
      "to": "' . $number . '",
      "element_name": "147_caps_contact",
      "data": [
          {
              "1": "Test WA Digital Channel"
          }
      ]
  }';

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Partner_Token: d9dd329ce2d1d4047275c1251aa6c1eb18adcc9c43395af6ae776dddbd21a0b493fb728d61107438c0ea052b45507195'
      ),
    ));

    $response = curl_exec($curl);
    $response = json_decode($response);

    if (isset($response->sts)) {
      $return = $response->sts_msg;
      echo $response->sts_msg;
    }
    return $return;
  }
  // public function blast_sms($id = false, $number = false, $nama, $link)
  public function blast_sms($number = false)
  {
    $msisdn = $this->hp($number);
    $characters = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
    $keys = array();
    $random_num = "";
    while (count($keys) < 4) {
      $x = mt_rand(0, count($characters) - 1);
      if (!in_array($x, $keys)) {
        $keys[] = $x;
      }
    }
    foreach ($keys as $key) {
      $random_num .= $characters[$key];
    }
    $msg_id = $msisdn . date('YmdHis');
    $hash = sha1('INFOMEDIA#sms_telkom#' . $msg_id . '#INDIHOME#NUSANTARA');
    // $hash=sha1('INFOMEDIA#'.$msg_id.'#NUSANTARA');
    // $msg="Kode verifikasi data Anda adalah ".$random_num." silakan infokan kepada petugas  kami yang sedang menghubungi Bpk/Ibu. Tks";
    $msg = "Mau tetap update nonton film-film unggulan sekaligus dapat kecepatan internet yang makin cepat? Bisa! Berlangganan Minipack Channel TV dan Upgrade Speed dengan kecepatan 20 Mbps bisa Sobat dapatkan hanya dengan Rp45.000 per bulan! 
    Tunggu apa lagi? Yuk, Klik : https://bit.ly/3xjPiZV";

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://10.194.176.72/SMS.Telkom/SMS147_OTP/sendSMS",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "username=sms_telkom&password=infomedia&sender=INDIHOME&request_by=tlkm&recipient=" . $msisdn . "&msg_id=" . $msg_id . "&hash=" . $hash . "&message=" . $msg,
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/x-www-form-urlencoded",
        "postman-token: 7be6d429-43ee-cd2c-61dc-3d36c10f72dc"
      ),
    ));

    $response = curl_exec($curl);
    $response = json_decode($response);

    $err = curl_error($curl);

    curl_close($curl);



    if ($response->success == true) {
      $datana = $response->data->result;
      return $datana;
      // echo $datana->result;
    }
  }
  function hp($nohp)
  {
    // kadang ada penulisan no hp 0811 239 345
    $nohp = str_replace(" ", "", $nohp);
    // kadang ada penulisan no hp (0274) 778787
    $nohp = str_replace("(", "", $nohp);
    // kadang ada penulisan no hp (0274) 778787
    $nohp = str_replace(")", "", $nohp);
    // kadang ada penulisan no hp 0811.239.345
    $nohp = str_replace(".", "", $nohp);

    // cek apakah no hp mengandung karakter + dan 0-9
    if (!preg_match('/[^+0-9]/', trim($nohp))) {
      // cek apakah no hp karakter 1-3 adalah +62
      if (substr(trim($nohp), 0, 3) == '+62') {
        $hp = trim($nohp);
      }
      // cek apakah no hp karakter 1 adalah 0
      elseif (substr(trim($nohp), 0, 1) == '0') {
        $hp = '62' . substr(trim($nohp), 1);
      }
    }
    return $hp;
  }
}
