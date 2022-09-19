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
class Analisa extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
    $this->load->model('sys/Sys_user_log_model', 'log_login');
    $this->load->model('Custom_model/Dapros_infomedia_model', 'distribution');
    //$this->load->library('curl');
  }
  public function data_cabut($limit = 10, $offset = 0, $sumber = false, $jumlah_data = false, $berhasil = 0)
  {
    $filter = array();
    // $filter["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '')"] = null;
    // $filter["(ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '')"] = null;
    $filter["(ISNULL(payment_status) OR payment_status = '')"] = null;
    $filter['status'] = 0;
    $filter['status2'] = 0;
    $filter['status3'] = 0;
    // $filter['payment_status'] = 0;
    if ($sumber) {
      $filter['sumber'] = $sumber;
    }
    if ($sumber) {

      $jml_data = 0;
      $data_dapros = $this->distribution->get_results($filter, array("*"), array("limit" => $limit, "offset" => $offset));
      $no_speedy = "";
      $no = 1;
      if ($data_dapros['num'] > 0) {
        $key = '';
        foreach ($data_dapros['results'] as $row) {


          if ($row->no_speedy != "") {
            if ($data_dapros['num'] == $no) {
              $key = $key . $row->no_speedy;
              $single_key = $row->no_speedy;
            } else {
              $key = $key . $row->no_speedy . "\r\n";
              $single_key = $row->no_speedy;
            }
          } else {
            if ($data_dapros['num'] == $no) {
              $key = $key . $row->no_pstn;
              $single_key = $row->no_pstn;
            } else {
              $key = $key . $row->no_pstn . "\r\n";
              $single_key = $row->no_pstn;
            }
          }
          $data_detail[$single_key] = array(
            'ncli' => $row->ncli,
            'no_pstn' => $row->no_pstn,
            'no_speedy' => $row->no_speedy,
            'sumber' => $row->sumber,
            'no_tgl' => $row->no_tgl
          );
          $no++;
        }
        // echo $key;
        ////proses curl
        $post = array(
          'speedy' => $key,
          'Do+Query' => 'Do+Query'
        );
        // $ch = curl_init('http://10.16.7.5/pcf/i_payment.php?nd=131159150769');
        $ch = curl_init('http://10.2.20.5/pcf/epayment_getData.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);
        $data['respon_curl'] = $response;

        $data_hasil = explode("\r\n", $key);
        if (count($data_hasil)) {
          foreach ($data_hasil as $r_row) {
            $eid = explode($r_row, $response);
            $date_now = strtoupper(date('MY'));
            // echo "eid : ".count($eid)."<br>"; 
            ///epayment 1
            if (count($eid) > 1) {
              ///GET DETAIL DATA///
              $all_td = explode('<td', $eid[1]);
              $all_td_close = explode('>', $all_td[1]);
              $all_td_pelanggan = explode('</td', $all_td_close[1]);
              $nama_pelanggan = preg_replace('/[^A-Za-z0-9\-]/', '', $all_td_pelanggan[0]);

              $all_td_close = explode('>', $all_td[3]);
              $all_td_bayar = explode('</td', $all_td_close[1]);
              $last_bulan_bayar = preg_replace('/[^A-Za-z0-9\-]/', '', $all_td_bayar[0]);

              $all_td_close = explode('>', $all_td[3]);
              $all_td_bayar = explode('</td', $all_td_close[1]);
              $tgl_last_bayar = preg_replace('/[^A-Za-z0-9\-]/', '', $all_td_bayar[0]);

              $all_td_close = explode('>', $all_td[9]);
              $all_td_status = explode('</td', $all_td_close[1]);
              $status_code = preg_replace('/[^A-Za-z0-9\-]/', '', $all_td_status[0]);
              // echo strtoupper($date_now)."|".strtoupper($last_bulan_bayar);
              if (strtoupper($date_now) != strtoupper($last_bulan_bayar)) {
                $status = 3;
                $status_forcall = 4;
              } else {
                if ($status_code > 2) {
                  $status = 3;
                  $status_forcall = 4;
                } else {
                  $status = $status_code;
                }
              }
              // echo $status."<br>";
              $last_update = date('Y-m-d H:i:s');

              $data_update = array(
                'payment_status' => $status,
                'last_bulan_bayar' => $last_bulan_bayar,
                'tgl_last_bayar' => $tgl_last_bayar,
                'last_update' => $last_update,
              );
              if ($status == 3) {
                $data_update['status'] = 4;
              }

              if (isset($data_detail[$r_row])) {
                $where = $data_detail[$r_row];
                // echo "WHERE : <br>ncli ".$where['ncli']."<br>no_pstn ".$where['no_pstn']."<br>no_speedy ".$where['no_speedy']."<br>sumber ".$where['sumber']."<br>no_tgl ".$where['no_tgl'];
                // echo "<br>UPDATE : <br>payment_status ".$data_update['payment_status']."<br>last_bulan_bayar ".$data_update['last_bulan_bayar']."<br>tgl_last_bayar ".$data_update['tgl_last_bayar']."<br>last_update ".$data_update['last_update']."<br><br>";
                $return = $this->distribution->edit($where, $data_update);
                if ($return) {
                  $jml_data++;
                }
              }
            }
          }
        }
      }
      // echo "JML DATA : " . $jml_data;
      if (!$jumlah_data) {
        $jumlah_data = $this->distribution->get_count($filter);
      }
      $berhasil = $berhasil + $jml_data;
      $offset = $offset + $limit;
      if ($berhasil >= $jumlah_data) {
        $data['sumber'] = $sumber;
        $data['berhasil'] = $berhasil;
        $view = 'Analisa/analisa_data_cabut';
        $this->template->load($view, $data);
      } else {
        $data['link'] = base_url() . "Analisa/Analisa/data_cabut/" . $limit . "/" . $offset . "/" . $sumber . "/" . $jumlah_data . "/" . $berhasil;
        $this->load->view('Custom_view/count_down', $data);
      }
    } else {
      if ($_POST['sumber']) {
        $filter['sumber']=$_POST['sumber'];
        $jumlah_data = $this->distribution->get_count($filter);
        $data['link'] = base_url() . "Analisa/Analisa/data_cabut/" . $limit . "/0/" . $_POST['sumber'] . "/" . $jumlah_data . "/0";
        $this->load->view('Custom_view/count_down', $data);
      } else {
        
        $view = 'Analisa/analisa_data_cabut';
        $this->template->load($view, $data);
      }
    }
  }
  public function data_cabut_old()
  {
    $filter = array();
    $filter["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '')"] = null;
    $filter["(ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '')"] = null;
    $filter['status'] = 0;
    $filter['status2'] = 0;
    $filter['status3'] = 0;
    $post = array(
      'speedy' => '131159150769',
      'Do+Query' => 'Do+Query'
    );
    $data_dapros = $this->distribution->get_results($filter, array("*"), array("limit" => 10, "offset" => 0));

    ////proses curl
    //in
    // $ch = curl_init('http://10.16.7.5/pcf/i_payment.php?nd=131159150769');
    $ch = curl_init('http://10.2.20.5/pcf/epayment_getData.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $response = curl_exec($ch);
    curl_close($ch);
    $data['respon_curl'] = $response;

    $eid = explode('eid', $response);
    $date_now = strtoupper(date('M Y'));
    ///epayment 1
    $status = "BELUM CABUT";
    if (count($eid) > 2) {

      $get_last_payment = explode('mgrid', $eid[1]);
      $ext1 = explode("'>", $get_last_payment[1]);
      $last_payment = strtoupper($ext1[1]);



      if ($date_now != $last_payment) {
        $status = "BELUM CABUT";
      } else {
        if (count($eid) > 3) {
          $get_date_payment = explode('mgrid', $eid[3]);
          $ext1 = explode("'>", $get_date_payment[8]);
          $date_payment = $ext1[1];
          if ($date_payment == "") {
            $status = "BELUM CABUT";
          }
        }
      }
      echo $last_payment . "-" . $date_payment . "-" . $status;
      /*
      belum cabut
      -last payment di bulan berjalan
      -jika payment count 1, last payment = bulan berjalan tahun berjalan
      -jika payment count 2, last payment = bulan berjalan tahun berjalan

      cabut
      -jika payment count 3, last payment = bulan berjalan tahun berjalan
      */
    }
    // echo count($html);
    // if (count($perrow > 0)) {
    //   foreach ($perrow as $d_perrow) {
    //     $per_td = explode('<td class="mgrid" valign="top">', $d_perrow);
    //     if (count($per_td) > 0) {
    //       foreach ($per_td as $d_per_td) {
    //         $pertd_single=explode('</td>', $d_per_td);
    //         echo $pertd_single[0] . "<br>";
    //       }
    //     }
    //     echo "<hr><br><br>";
    //   }
    // }
    $view = 'Analisa/analisa_data_cabut';
    // $this->template->load($view, $data);
  }
}
