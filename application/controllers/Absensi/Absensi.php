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
class Absensi extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    // $this->load->model('Custom_model/Cache_data_model', 'cache_data');
    // $this->load->model('Absensi/Absensi_model', 't_absensi');
    $this->load->model('Custom_model/Tahun_model', 'tahun');
    $this->load->model('Custom_model/T_absensi_model', 't_absensi');
    //  $this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling_verifikasi');
    $this->load->model('Custom_model/Trans_profiling_daily_model', 'trans_profiling_daily');
    $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
    $this->load->model('Custom_model/Shift_moss_model', 'shift_moss');
    $this->load->model('sys/Sys_user_log_model', 'log_login');
    
    //$this->load->library('curl');
  }

  public function Absensi()
  {



    //curlstart
    //$today = date('d/m/y');
    //$today = '01/03/2020';  


    $start = date('d/m/y', strtotime($_GET['start']));


    $post = array(
      'dtstart' => $start,
      'status' => 0
    );

    $postout = array(
      'dtstart' => $start,
      'status' => 1
    );

    //in
    // $ch = curl_init('http://10.194.52.142/absensi/lpr_date.php');
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    // $response = curl_exec($ch);
    // curl_close($ch);

    // //out
    // $chout = curl_init('http://10.194.52.142/absensi/lpr_date.php');
    // curl_setopt($chout, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($chout, CURLOPT_POSTFIELDS, $postout);
    // $responseout = curl_exec($chout);
    // curl_close($chout);


    // $pecah = explode('<td bgcolor="#9FE89B"><table border="1" align="top">', $response);
    // $pecahout = explode('<td bgcolor="#9FE89B"><table border="1" align="top">', $responseout);


    // //$a = 1;
    // $n = 0;
    // $today = date('Y-m-d');
    // if (isset($_GET['start'])) {
    //   $start = $_GET['start'];
    //   //    $end = $_GET['end'];
    // } else {
    //   $start = date('Y-m-d');
    //   //   $start = date('Y-m-d');
    // }




    // foreach ($pecah as $isi) {
    //   if ($n >= 1) {
    //     $pecahgbr = explode('<img border="0" src="', $response);
    //     $pecahgambarin = explode('" width="150" height="200" align="center">', $pecahgbr[$n]);

    //     $gbrin = $pecahgambarin[0];
    //     $namagambar = explode('/Pictures/', $gbrin);

    //     $pecahnm = explode('<font size="4" face="Stencil, Verdana">', $isi);
    //     $pecahnama = explode('</font>', $pecahnm[2]);
    //     $pecahnik = explode('</font>', $pecahnm[4]);
    //     $pecahdept = explode('</font>', $pecahnm[6]);
    //     $pecahstat = explode('</font>', $pecahnm[8]);
    //     $pecahtime = explode('</font>', $pecahnm[10]);

    //     $queryselect = "SELECT * FROM t_absensi where date(waktu_in)='$start' AND nik='$pecahnik[0]';";
    //     $result = $this->db->query($queryselect);
    //     $resulta = $result->num_rows();

    //     $queryagentid = $this->db->query("SELECT * FROM sys_user where nik_absensi='$pecahnik[0]'");
    //     $resultagnetid = $queryagentid->row();

    //     if ($queryagentid->num_rows() != null) {
    //       $agentidin = $resultagnetid->agentid;

    //       $url = 'http://10.194.52.142/Pictures/' . $namagambar[1];
    //       $img = './images/user_profile/absen/' . $namagambar[1];
    //       file_put_contents($img, file_get_contents($url));
    //     } else {
    //       $agentidin = "";
    //     }

    //     if ($resulta == 0) { //tambahin if (methode == 0){jangan ditambah}else{ditambah}
    //       $query = "INSERT INTO t_absensi (nama, nik, stts, waktu_in, agentid, picture) VALUES ( '" . $pecahnama[0] . "','" . $pecahnik[0] . "',
    //     'in', '" . $pecahtime[0] . "', '" . $agentidin . "', './images/user_profile/absen/$namagambar[1]' )";
    //       $eksekusi = $this->db->query($query);



    //       if (!$query) {
    //         echo "gagal menambahkan data";
    //       }
    //     }
    //   }

    //   $n++;
    // }



    // //out
    // $n = 0;
    // $today = date('Y-m-d');
    // foreach ($pecahout as $isiout) {
    //   if ($n >= 1) {
    //     $pecahgbr = explode('<img border="0" src="', $responseout);
    //     $pecahgambarin = explode('" width="150" height="200" align="center">', $pecahgbr[$n]);

    //     $gbrin = $pecahgambarin[0];
    //     $namagambar = explode('/Pictures/', $gbrin);

    //     $pecahnmout = explode('<font size="4" face="Stencil, Verdana">', $isiout);
    //     $pecahnamaout = explode('</font>', $pecahnmout[2]);
    //     $pecahnikout = explode('</font>', $pecahnmout[4]);
    //     $pecahdept = explode('</font>', $pecahnmout[6]);
    //     $pecahstat = explode('</font>', $pecahnmout[8]);
    //     $pecahtimeout = explode('</font>', $pecahnmout[10]);

    //     $queryselectout = "SELECT * FROM t_absensi where date(waktu_in)='$start' AND nik='$pecahnikout[0]' AND stts='out';";
    //     $resultout = $this->db->query($queryselectout);
    //     $resultouta = $resultout->num_rows();

    //     $queryagentidout = $this->db->query("SELECT * FROM sys_user where nik_absensi='$pecahnikout[0]'");
    //     $resultagnetidout = $queryagentidout->row();

    //     if ($queryagentidout->num_rows() != null) {
    //       $agentidout = $resultagnetidout->agentid;
    //     } else {
    //       $agentidout = "";
    //     }



    //     if ($resultouta == 0) {
    //       $queryout = "INSERT INTO t_absensi (nama, nik, stts, waktu_in, agentid, picture) VALUES ( '" . $pecahnamaout[0] . "','" . $pecahnikout[0] . "',
    //     'out', '" . $pecahtimeout[0] . "', '" . $agentidout . "', './images/user_profile/absen/$namagambar[1]' )";
    //       $eksekusiout = $this->db->query($queryout);

    //       if (!$queryout) {
    //         echo "gagal menambahkan data";
    //       }
    //     }
    //   }
    //   $n++;
    // }


    $this->absensi_dashboard();
  }

  public function Absensi_dashboard()
  {

    $view = 'front-end/landing-page/dashboard_v2/Absensi';
    $data['title_page_big']     =   '';
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

    if (isset($_GET['start'])) {
      $start = $_GET['start'];
      $data['start'] = $_GET['start'];
    } else {
      $start = date('Y-m-d');
      $data['start'] = $start;
    }

    $data['agent_reg'] = $this->Sys_user_table_model->get_results(array("opt_level" => 8, "kategori" => "REG", "tl !=" => "-"));
    $data['list_absen_reg'] = array();
    foreach ($data['agent_reg']['results'] as $reg) {
      
      $agent_moss=$this->Sys_user_table_model->live_query("
      select * FROM sys_user_moss
      WHERE 
      DATE(periode_start) <= '" . $start . "' AND DATE(periode_end) >= '" . $start . "'
      AND agentid = '".$reg->agentid_mos."'
      ");
      // $data['agent']=$reg;
      $data_moss=$agent_moss->row();
      if($data_moss){
        $shift=$this->shift_moss->get_row(array("id"=>$data_moss->shift));
        $in=$this->t_absensi->get_count(array("date(waktu_in)"=>$start,"stts"=>'in',"agentid"=>$reg->agentid_mos));
        if($in > 0){
          $data_in=$this->t_absensi->get_row(array("date(waktu_in)"=>$start,"stts"=>'in',"agentid"=>$reg->agentid_mos),array("*,time(waktu_in) as waktu_masuk"),array("waktu_in"=>"ASC"));
          $data['list_absen']['moss'][$reg->agentid]['in']=$data_in->waktu_in;
          $data['list_absen']['moss'][$reg->agentid]['out']=$this->t_absensi->get_row(array("date(waktu_in)"=>$start,"stts"=>'out',"agentid"=>$reg->agentid_mos),array("*"),array("waktu_in"=>"DESC"))->waktu_in;
          $to_time = strtotime($start." ".$data_in->waktu_masuk);
          $from_time = strtotime($start." ".$shift->start);
          $late=round(abs($to_time - $from_time) / 60,2);
          $data['list_absen']['moss'][$reg->agentid]['late']="-";
          if($late > 0){
            $data['list_absen']['moss'][$reg->agentid]['late']=round(abs($to_time - $from_time) / 60,2);
            // $data['jumlah']['moss']['late']=$reg;
          }
          $data['agent'][$reg->agentid]['in']=$data['list_absen']['moss'][$reg->agentid]['in'];
          $data['agent'][$reg->agentid]['out']=$data['list_absen']['moss'][$reg->agentid]['out'];
          $data['agent'][$reg->agentid]['late']="-";
          $data['agent'][$reg->agentid]['type']='MOSS';
          $data['agent'][$reg->agentid]['lokasi']=$data_in->methode;
        }
        $data['jumlah']['moss']['agent'][$reg->agentid]=$reg;
      }else{
        $in=$this->t_absensi->get_count(array("date(waktu_in)"=>$start,"stts"=>'in',"nik"=>$reg->nik_absensi));
       if($in > 0){
          $data_in=$this->t_absensi->get_row(array("date(waktu_in)"=>$start,"stts"=>'in',"nik"=>$reg->nik_absensi),array("*,time(waktu_in) as waktu_masuk"),array("waktu_in"=>"ASC"));
          $data['list_absen']['reg'][$reg->agentid]['in']=$data_in->waktu_in;
          $data['list_absen']['reg'][$reg->agentid]['out']=$this->t_absensi->get_row(array("date(waktu_in)"=>$start,"stts"=>'out',"nik"=>$reg->nik_absensi),array("*"),array("waktu_in"=>"DESC"))->waktu_in;
          
          $to_time = strtotime($start." ".$data_in->waktu_masuk);
          $from_time = strtotime($start." 08:01:00");
          $durasi=$to_time - $from_time;
          $late=round(abs($to_time - $from_time) / 60,2);
          if($durasi > 0){
            $data['list_absen']['reg'][$reg->agentid]['late']=round(abs($to_time - $from_time) / 60,2);
            $data['jumlah']['reg']['late'][$reg->agentid]=$reg;
          }
          $data['agent'][$reg->agentid]['in']=$data['list_absen']['reg'][$reg->agentid]['in'];
          $data['agent'][$reg->agentid]['out']=$data['list_absen']['reg'][$reg->agentid]['out'];
          $data['agent'][$reg->agentid]['late']=$data['list_absen']['reg'][$reg->agentid]['late'];
          $data['agent'][$reg->agentid]['type']='REG';
          $data['agent'][$reg->agentid]['lokasi']=$data_in->methode;
        }
        
        
        $data['jumlah']['reg']['agent'][$reg->agentid]=$reg;
     }
    }

    $this->template->load($view, $data);
  }
  public function Absensi_dashboard_old()
  {

    $view = 'front-end/landing-page/dashboard_v2/Absensi';
    $data['title_page_big']     =   '';
    $idlogin = $this->session->userdata('idlogin');
    $logindata = $this->log_login->get_by_id($idlogin);
    $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));


    // $data['tllia'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLLIA"));
    //  $data['tlita'] = $this->Sys_user_table_model->get_row(array("agentid" => "AR180293"));
    //  $data['tlateu'] = $this->Sys_user_table_model->get_row(array("agentid" => "TLATEU"));

    if (isset($_GET['start'])) {
      $start = $_GET['start'];
      //$end = $_GET['end'];
    } else {
      $start = date('Y-m-d');
      //  $end = date('Y-m-d');
    }
    $data['hitung'] = $this->t_absensi->live_query("SELECT sys_user.nama, sys_user.kategori, sys_user.opt_level, t_absensi.waktu_in, t_absensi.stts
    FROM sys_user
    LEFT JOIN t_absensi
    ON sys_user.nik_absensi = t_absensi.nik
    where  sys_user.opt_level=8 
    AND sys_user.kategori = 'REG'
    AND sys_user.tl != '-'
    AND t_absensi.methode = 1
    AND (date(t_absensi.waktu_in) = '$start' OR date(t_absensi.waktu_in) IS NULL)
    AND STR_TO_DATE(time(t_absensi.waktu_in), '%H:%i:%s') < '08:00:00'
    AND (t_absensi.stts = 'in' OR t_absensi.stts IS NULL)
    GROUP BY sys_user.nama");
    $data['hasilquery'] = $data['hitung']->num_rows();
    $data['hitung2'] = $this->t_absensi->live_query("SELECT sys_user.nama, sys_user.kategori, sys_user.opt_level, t_absensi.waktu_in, t_absensi.stts
    FROM sys_user
    LEFT JOIN t_absensi
    ON sys_user.nik_absensi = t_absensi.nik
    where  sys_user.opt_level=8 
    AND sys_user.kategori = 'REG'
    AND sys_user.tl != '-'
    AND t_absensi.methode = 1
    AND (date(t_absensi.waktu_in) = '$start' OR date(t_absensi.waktu_in) IS NULL)
    AND (STR_TO_DATE(time(t_absensi.waktu_in), '%H:%i:%s') > '08:00:00')
    AND (t_absensi.stts = 'in' OR t_absensi.stts IS NULL)
    GROUP BY sys_user.nama     
    ");
    $data['hasilquery2'] = $data['hitung2']->num_rows();
    $data['datauserreg'] = $this->t_absensi->live_query("SELECT
    sys_user.opt_level,
    sys_user.nik_absensi,
    t_absensi.stts,
    t_absensi.waktu_in,
    sys_user.nama,
    t_absensi.nama
    FROM
    sys_user
    LEFT JOIN t_absensi ON t_absensi.nik = sys_user.nik_absensi
    WHERE sys_user.opt_level = 8
    AND sys_user.tl != '-'
    AND t_absensi.methode = 1
    ");



    $queryregabsen = $this->t_absensi->live_query("SELECT * FROM sys_user where opt_level=8 AND kategori='REG' AND tl != '-'");
    $data['regabsen'] = $queryregabsen->num_rows();
    $data['moss_hadir'] = 0;
    $start = date('Y-m-d');
    $end = date('Y-m-d');
    $querymossabsen = $this->t_absensi->live_query("
    SELECT * FROM sys_user_moss a 
    WHERE DATE(a.periode_start) <= '$start' AND  DATE(a.periode_end) >= '$end'
    ");
    $data['mossabsen'] = $querymossabsen->num_rows();

    if ($data['mossabsen'] > 0) {
      foreach ($querymossabsen->result() as $d_absen) {
        $querymosshadir_hadir = $this->t_absensi->live_query("
        SELECT * FROM t_absensi 
        WHERE agentid = '$d_absen->agentid'
        AND DATE(waktu_in)='$start'
        ");
        if ($querymosshadir_hadir->num_rows() > 0) {
          $data['moss_hadir'] = $data['moss_hadir'] + 1;
        }
      }
    }

    if (isset($_GET['start'])) {
      $data['start'] = $_GET['start'];
      //  $data['end'] = $_GET['end'];
    } else {
      $data['start'] = date('Y-m-d');
      //  $data['end'] = date('Y-m-d');
    }
    $data['jml_agent'] = $this->Sys_user_table_model->get_count(array("opt_level" => 8, "kategori" => 'REG', "tl !=" => '-'));
    $this->template->load($view, $data);
  }
}
