<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generate_report_cache extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // $this->load->model('Custom_model/Dapros_infomedia_model', 'distribution');
        $this->load->model('Custom_model/Dapros_model', 'distribution');
        $this->load->model('Custom_model/Status_call_model', 'status_call');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling');
        $this->load->model('Custom_model/Trans_profiling_daily_model', 'trans_profiling_daily');
        $this->load->model('Custom_model/Trans_profiling_monthly_model', 'trans_profiling_monthly');
        $this->load->model('Custom_model/Trans_profiling_last_month_model', 'trans_profiling_last_month');
        $this->load->model('Custom_model/Report_cache_model', 'report_cache');
        $this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling_verifikasi');
        $this->load->model('Custom_model/Indibox_forcall_3p_model', 'indibox_forcall_3p');
    }

    public function automation_distribution()
    {
        $hp = $this->distribution->edit(array("update_by" => "DC", "no_handpone LIKE '08%' " => NULL), array("update_by" => "DC_WA"));
        $email = $this->distribution->edit(array("update_by" => "DC", "no_handpone NOT LIKE '08%' " => NULL, "email LIKE '%@%' " => NULL), array("update_by" => "DC_EMAIL"));
        $wa_fail = $this->distribution->edit(array("update_by" => "DC_WA_FAIL", "no_handpone LIKE '08%' " => NULL), array("update_by" => "DC_SMS"));
        $email_fail = $this->distribution->edit(array("update_by" => "DC_SMS_FAIL", "email LIKE '%@%' " => NULL), array("update_by" => "DC_EMAIL"));
        $obc = $this->distribution->edit(array("update_by" => "DC_SMS_FAIL", "email NOT LIKE '%@%' " => NULL), array("update_by = NULL" => NULL));
        $obc = $this->distribution->edit(array("update_by" => "DC_EMAIL_FAIL", "email LIKE '%@%' " => NULL), array("update_by = NULL" => NULL));
        $obc = $this->distribution->edit(array("update_by" => "DC"), array("update_by" => ""));
        $data['link'] = base_url() . "api/Generate_report_cache/automation_distribution";
        $this->load->view('Custom_view/count_down', $data);
    }
    public function generate_report_v2($date = false, $limit = 100, $offset = 0, $jumlah_data = false)
    {
        $data = array();
        $offset_lama = $offset;
        // $number_add=$this->input->get('number_add');
        $ym = date("Y-m");
        $last_month = date("Y-m", strtotime("-1 months"));
        if (!$date) {
            $date = date('Y-m-d');
            $date_1 = date('Y-m-d') . ' 00:00:00';
            $date_2 = date('Y-m-d') . ' 23:59:59';
            $query_num = $this->trans_profiling->live_query(
                "SELECT
                    count(idx) as jumlah_data
                FROM
                    trans_profiling 
                WHERE
                lup BETWEEN '$date_1' AND '$date_2'
                "
            );
            $data_query_num = $query_num->row_array();
            $jumlah_data = $data_query_num['jumlah_data'];
        } else {
            $date_1 = $date . ' 00:00:00';
            $date_2 = $date . ' 23:59:59';
            if (!$jumlah_data) {
                $query_num = $this->trans_profiling->live_query(
                    "SELECT
                        count(idx) as jumlah_data
                    FROM
                        trans_profiling 
                    WHERE
                    lup BETWEEN '$date_1' AND '$date_2' 
                    "
                );
                $data_query_num = $query_num->row_array();
                $jumlah_data = $data_query_num['jumlah_data'];
            }
        }


        $cek_num = $this->trans_profiling->live_query("select count(*) as numna FROM trans_profiling_daily WHERE DATE(lup) = '$date' ")->row();
        if ($cek_num->numna == 0) {
            if ($date == date('Y-m-d')) {
                $this->trans_profiling->live_query("TRUNCATE TABLE  trans_profiling_daily");
            }
        }
        $query = "REPLACE INTO trans_profiling_daily (
            id,
            idx,
            ncli,
            nama,
            pstn1,
            no_speedy,
            kepemilikan,
            facebook,
            verfi_fb,
            twitter,
            verfi_twitter,
            relasi,
            email,
            verfi_email,
            lup_email,
            email_lain,
            handphone,
            verfi_handphone,
            lup_handphone,
            nama_pastel,
            alamat,
            kota,
            waktu_psb,
            kec_speedy,
            billing,
            payment,
            tgl_lahir,
            STATUS,
            profiling_by,
            click_sms,
            click_email,
            ip_address,
            date_created,
            hub_pemilik,
            veri_distribusi,
            veri_count,
            veri_status,
            veri_call,
            veri_keterangan,
            veri_upd,
            veri_lup,
            lup,
            click_session,
            division,
            witel,
            kandatel,
            regional,
            veri_system,
            nik,
            no_kk,
            nama_ibu_kandung,
            path,
            instagram,
            handphone_lain,
            opsi_call,
            jk,
            email3,
            email4,
            email5,
            hp3,
            hp4,
            hp5,
            sumber 
        ) SELECT
        id,
        idx,
        ncli,
        nama,
        pstn1,
        no_speedy,
        kepemilikan,
        facebook,
        verfi_fb,
        twitter,
        verfi_twitter,
        relasi,
        email,
        verfi_email,
        lup_email,
        email_lain,
        handphone,
        verfi_handphone,
        lup_handphone,
        nama_pastel,
        alamat,
        kota,
        waktu_psb,
        kec_speedy,
        billing,
        payment,
        tgl_lahir,
        STATUS,
        profiling_by,
        click_sms,
        click_email,
        ip_address,
        date_created,
        hub_pemilik,
        veri_distribusi,
        veri_count,
        veri_status,
        veri_call,
        veri_keterangan,
        veri_upd,
        veri_lup,
        lup,
        click_session,
        division,
        witel,
        kandatel,
        regional,
        veri_system,
        nik,
        no_kk,
        nama_ibu_kandung,
        path,
        instagram,
        handphone_lain,
        opsi_call,
        jk,
        email3,
        email4,
        email5,
        hp3,
        hp4,
        hp5,
        sumber 
        
        FROM
            trans_profiling_detail 
        WHERE
            lup BETWEEN '$date_1' 
            AND '$date_2'";




        // echo $jumlah_data;
        $query_num = $this->trans_profiling->live_query($query);

        $data['link'] = base_url() . "api/Generate_report_cache/generate_report_v2";
        $this->load->view('Custom_view/count_down', $data);


        /*****************START ABSENSI*******/
        $start = date('d/m/y');



        $post = array(
            'dtstart' => $start,
            'status' => 0
        );

        $postout = array(
            'dtstart' => $start,
            'status' => 1
        );

        //in
        $ch = curl_init('http://10.194.52.142/absensi/lpr_date.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $response = curl_exec($ch);
        curl_close($ch);

        //out
        $chout = curl_init('http://10.194.52.142/absensi/lpr_date.php');
        curl_setopt($chout, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($chout, CURLOPT_POSTFIELDS, $postout);
        $responseout = curl_exec($chout);
        curl_close($chout);

        $pecah = explode('<td bgcolor="#9FE89B"><table border="1" align="top">', $response);
        $pecahout = explode('<td bgcolor="#9FE89B"><table border="1" align="top">', $responseout);
        //$pecahout = explode('<td bgcolor="#9FE89B"><table border="1" align="top">', $response);


        //$a = 1;
        $n = 0;
        $today = date('Y-m-d');
        if (isset($_GET['start'])) {
            $start = $_GET['start'];
            //    $end = $_GET['end'];
        } else {
            $start = date('Y-m-d');
            //   $start = date('Y-m-d');
        }

        foreach ($pecah as $isi) {
            if ($n >= 1) {
                $pecahgbr = explode('<img border="0" src="', $response);
                $pecahgambarin = explode('" width="150" height="200" align="center">', $pecahgbr[$n]);

                $gbrin = $pecahgambarin[0];
                $namagambar = explode('/Pictures/', $gbrin);
                $pecahnm = explode('<font size="4" face="Stencil, Verdana">', $isi);
                $pecahnama = explode('</font>', $pecahnm[2]);
                $pecahnik = explode('</font>', $pecahnm[4]);
                $pecahdept = explode('</font>', $pecahnm[6]);
                $pecahstat = explode('</font>', $pecahnm[8]);
                $pecahtime = explode('</font>', $pecahnm[10]);


                $queryselect = "SELECT * FROM t_absensi where date(waktu_in)='$start' AND nik='$pecahnik[0]' AND methode=0;";
                $result = $this->db->query($queryselect);
                $resulta = $result->num_rows();

                $queryagentid = $this->db->query("SELECT * FROM sys_user where nik_absensi='$pecahnik[0]'");
                $resultagnetid = $queryagentid->row();

                if ($queryagentid->num_rows() != null) {
                    $agentidin = $resultagnetid->agentid;

                    $url = 'http://10.194.52.142/Pictures/' . $namagambar[1];
                    $img = './images/user_profile/absen/' . $namagambar[1];
                    file_put_contents($img, file_get_contents($url));
                } else {
                    $agentidin = "";
                }

                if ($queryagentid->num_rows() != null) {
                    $agentidin = $resultagnetid->agentid;
                } else {
                    $agentidin = "";
                }

                if ($resulta == 0) {
                    $query = "INSERT INTO t_absensi (nama, nik, stts, waktu_in, agentid,methode,picture) VALUES ( '" . $pecahnama[0] . "','" . $pecahnik[0] . "',
              'in', '" . $pecahtime[0] . "', '" . $agentidin . "',0, './images/user_profile/absen/$namagambar[1]' )";
                    $eksekusi = $this->db->query($query);

                    if (!$query) {
                        echo "gagal menambahkan data";
                    }
                }
            }
            $n++;
        }


        //out
        $n = 0;
        $today = date('Y-m-d');
        foreach ($pecahout as $isiout) {
            if ($n >= 1) {
                $pecahgbr = explode('<img border="0" src="', $responseout);
                $pecahgambarin = explode('" width="150" height="200" align="center">', $pecahgbr[$n]);

                $gbrin = $pecahgambarin[0];
                $namagambar = explode('/Pictures/', $gbrin);

                $pecahnmout = explode('<font size="4" face="Stencil, Verdana">', $isiout);
                $pecahnamaout = explode('</font>', $pecahnmout[2]);
                $pecahnikout = explode('</font>', $pecahnmout[4]);
                $pecahdept = explode('</font>', $pecahnmout[6]);
                $pecahstat = explode('</font>', $pecahnmout[8]);
                $pecahtimeout = explode('</font>', $pecahnmout[10]);

                $queryselectout = "SELECT * FROM t_absensi where date(waktu_in)='$start' AND nik='$pecahnikout[0]' AND stts='out'  AND methode=0;";
                $resultout = $this->db->query($queryselectout);
                $resultouta = $resultout->num_rows();

                $queryagentidout = $this->db->query("SELECT * FROM sys_user where nik_absensi='$pecahnikout[0]'");
                $resultagnetidout = $queryagentidout->row();

                if ($queryagentidout->num_rows() != null) {
                    $agentidout = $resultagnetidout->agentid;
                } else {
                    $agentidout = "";
                }



                if ($resultouta == 0) {
                    $queryout = "INSERT INTO t_absensi (nama, nik, stts, waktu_in, agentid,methode,picture) VALUES ( '" . $pecahnamaout[0] . "','" . $pecahnikout[0] . "',
              'out', '" . $pecahtimeout[0] . "', '" . $agentidout . "',0 , './images/user_profile/absen/$namagambar[1]')";
                    $eksekusiout = $this->db->query($queryout);

                    if (!$queryout) {
                        echo "gagal menambahkan data";
                    }
                }
            }
            $n++;
        }

        /*****END ABSENSI */
    }
    // public function save_crd_daily($date = false, $limit = 100, $offset = 0, $jumlah_data = false)
    // {
    //     $date = date('Y-m-d');
    //     $this->load->model('Custom_model/Cdr_model', 'cdr');
    //     $this->load->model('Custom_model/Cdr_daily_model', 'cdr_daily');
    //     $url = "10.194.22.170/API/profilling_ahtcall.php";
    //     //  Initiate curl
    //     $ch = curl_init();
    //     // Will return the response, if false it print the response
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     // Set the url
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     // Execute
    //     $result = curl_exec($ch);
    //     // Closing
    //     curl_close($ch);

    //     $this->cdr_daily->truncate();
    //     // Will dump a beauty json :3
    //     $n = 0;
    //     if ($result) {
    //         $data = json_decode($result, true);
    //         if (count($data['Data Asterisk Profilling']) > 0) {
    //             foreach ($data['Data Asterisk Profilling'] as $data_insert) {
    //                 // if ($data_insert['disposition'] == 'ANSWERED') {
    //                 if (substr($data_insert['dst'], 0, 2) == '61') {
    //                     $check = $this->cdr->get_count(array("uniqueid" => $data_insert['uniqueid']));
    //                     if ($check == 0) {
    //                         $this->cdr->add($data_insert);
    //                     }
    //                     $check_daily = $this->cdr_daily->get_count(array("uniqueid" => $data_insert['uniqueid']));
    //                     if ($check_daily == 0) {
    //                         $this->cdr_daily->add($data_insert);
    //                     }
    //                 }
    //                 // }

    //                 $n++;
    //             }
    //         }
    //     }
    //     $data['link'] = base_url() . "api/Generate_report_cache/save_crd_daily";


    //     $this->load->view('Custom_view/count_down', $data);
    // }
    public function save_to_recording()
    {
        $date = date('Y-m-d');
        $this->load->model('Custom_model/Cdr_model', 'cdr');
        $this->load->model('Custom_model/Cdr_daily_model', 'cdr_daily');
        $this->load->model('Custom_model/Recording_daily_model', 'recording_daily');
        $url = "10.194.22.170/API/profilling_ahtcall.php";
        //  Initiate curl
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, $url);
        // Execute
        $result = curl_exec($ch);
        // Closing
        curl_close($ch);
        // if ($date == date('Y-m-d')) {
            
        $cek_num = $this->recording_daily->live_query("select count(*) as numna FROM recording_daily WHERE DATE(calldate) = '$date' ")->row();
        if ($cek_num->numna == 0) {
            if ($date == date('Y-m-d')) {
                $this->recording_daily->live_query("TRUNCATE TABLE  recording_daily");
            }
        }
        // }

        // Will dump a beauty json :3
        $n = 0;
        if ($result) {
            $data = json_decode($result, true);
            if (count($data['Data Asterisk Profilling']) > 0) {
                foreach ($data['Data Asterisk Profilling'] as $data_insert) {

                    if (substr($data_insert['dst'], 0, 2) == '61') {
                        $this->recording_daily->replace($data_insert);
                    }
                    $n++;
                }
            }
        }
        $query="REPLACE INTO cdr ( calldate, src, dst, duration, billsec, disposition, uniqueid, recordingfile ) SELECT
        calldate,
        src,
        dst,
        duration,
        billsec,
        disposition,
        uniqueid,
        recordingfile FROM recording_daily";
        $this->recording_daily->live_query($query);
        // $data['link'] = base_url() . "api/Generate_report_cache/save_to_recording";
        // $this->load->view('Custom_view/count_down', $data);
    }
    
    function check_time()
    {
        $diff = NOW() - strtotime('2020-04-17 11:40:35');
        echo $diff;
    }
    function filter_by_value($array, $index, $value)
    {
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
    function check_hp_email($hp, $email)
    {

        $stat_email = 0;
        $stat_hp = 0;
        if (stripos($email, "@") !== false) {
            // if (stripos($temp[$key], $value[$idx]) !== true) {
            $stat_email = 1;
        }

        if (stripos($hp, "08") !== false) {
            // if (stripos($temp[$key], $value[$idx]) !== true) {
            $stat_hp = 1;
        }
        if ($stat_email == 1 && $stat_hp == 1) {
            return 1;
        } else {
            if ($stat_email == 0 && $stat_hp == 1) {
                return 2;
            }
        }
    }
    function update_duplicate($limit = 100, $offset = 0, $jumlah = false, $count_update = 0)
    {


        $total = 0;

        // if ($post['limit']) {
        $filter = array();
        $filter["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '')"] = null;
        $filter["(ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '')"] = null;
        $filter['status'] = 0;
        // $filter['status2'] = 0;
        // $filter['status3'] = 0;

        $dapros = $this->distribution->get_results($filter, array('ncli,no_pstn,no_speedy,count(*) as jumlah_ncli'), array("limit" => $limit, "offset" => $offset), array("ncli" => "DESC"), 'ncli,IF(no_pstn ="" OR ISNULL(no_pstn), no_speedy, no_pstn) ', array("jumlah_ncli >" => 1));
        // echo $dapros['num'];
        if (!$jumlah) {
            $n_dapros = $this->distribution->get_count($filter);

            $jumlah = $n_dapros;
        }
        $offset = $offset + $limit;
        if ($dapros['num'] > 0) {

            foreach ($dapros['results'] as $val) {

                if ($val->no_pstn == "") {
                    $where = array(
                        'ncli' => $val->ncli,
                        "(no_pstn = '' OR no_pstn = null)" => NULL,
                        'no_speedy' => $val->no_speedy,
                    );
                    $cabut = $this->loadBillData($val->no_speedy);
                } else {
                    $where = array(
                        'ncli' => $val->ncli,
                        'no_pstn' => $val->no_pstn,
                    );
                }
                $where["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '')"] = null;
                $where["(ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '')"] = null;
                $where['status'] = 0;
                // $where['status2'] = 0;
                // $where['status3'] = 0;
                $data_update = array("duplicate_ncli" => 1);


                $update = $this->distribution->edit($where, $data_update, ($val->jumlah_ncli - 1), array("no_tgl" => "DESC"));
                if ($update) {
                    $total = $total + ($val->jumlah_ncli - 1);
                }
            }
        }
        // }
        // echo $total;
        $count_update = $count_update + $limit;
        if ($count_update > $jumlah) {
            $offset = 0;
        }

        $data['link'] = base_url() . "api/Generate_report_cache/update_duplicate/" . $limit . "/" . $offset . "/" . $jumlah . "/" . $count_update;
        $this->load->view('Custom_view/count_down', $data);
    }
    public function clear_cabut($limit = 100, $offset = 0, $jumlah = false, $count_update = 0)
    {
        $filter = array();
        $filter["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '')"] = null;
        $filter["(ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '')"] = null;
        $filter['status'] = 0;
        $dapros = $this->distribution->get_results($filter, array('ncli,no_pstn,no_speedy'), array("limit" => $limit, "offset" => $offset));
        // echo $dapros['num'];
        if (!$jumlah) {
            $n_dapros = $this->distribution->get_count($filter);

            $jumlah = $n_dapros;
        }
        $offset = $offset + $limit;
        if ($dapros['num'] > 0) {

            foreach ($dapros['results'] as $val) {
                if ($val->no_pstn == "") {
                    $where = array(
                        'ncli' => $val->ncli,
                        'no_speedy' => $val->no_speedy,
                    );
                    $cabut = $this->loadBillData($val->no_speedy);
                } else {
                    $where = array(
                        'ncli' => $val->ncli,
                        'no_pstn' => $val->no_pstn,
                    );
                    $cabut = $this->loadBillData($val->no_speedy);
                }
                $where["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '')"] = null;
                $where["(ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '')"] = null;
                $where['status'] = 0;
                // $where['status2'] = 0;
                // $where['status3'] = 0;
                if ($cabut == 'CABUT') {
                    $data_update = array("status" => 4);
                    $update = $this->distribution->edit($where, $data_update);
                }
            }
        }
        $count_update = $count_update + $limit;
        if ($count_update > $jumlah) {
            $offset = 0;
        }

        $data['link'] = base_url() . "api/Generate_report_cache/clear_cabut/" . $limit . "/" . $offset . "/" . $jumlah . "/" . $count_update;
        $this->load->view('Custom_view/count_down', $data);
    }
    public function clear_double_verified($limit = 100, $offset = 0, $jumlah = false, $count_update = 0)
    {
        $filter = array();
        $filter["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '')"] = null;
        $filter["(ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '')"] = null;
        $filter['status'] = 0;
        $dapros = $this->distribution->get_results($filter, array('ncli,no_pstn,no_speedy'), array("limit" => $limit, "offset" =>  $offset));
        // echo $dapros['num'];
        if (!$jumlah) {
            $n_dapros = $this->distribution->get_count($filter);

            $jumlah = $n_dapros;
        }
        $offset = $offset + $limit;
        if ($dapros['num'] > 0) {

            foreach ($dapros['results'] as $val) {
                if ($val->no_pstn == "") {
                    $where = array(
                        'ncli' => $val->ncli,
                        'no_speedy' => $val->no_speedy,
                    );
                } else {
                    $where = array(
                        'ncli' => $val->ncli,
                        'no_pstn' => $val->no_pstn,
                    );
                }
                $where_veri = $where;
                $where_veri['DATE(lup) >='] = '2020-01-01';
                $where_veri['verified'] = 1;
                $veri = $this->trans_profiling_verifikasi->get_count($where_veri);
                // $where['status2'] = 0;
                // $where['status3'] = 0;
                if ($veri > 0) {
                    $data_update = array("status" => 5);
                    $update = $this->distribution->edit($where, $data_update);
                }
            }
        }
        $count_update = $count_update + $limit;
        if ($count_update > $jumlah) {
            $offset = 0;
        }

        $data['link'] = base_url() . "api/Generate_report_cache/clear_double_verified/" . $limit . "/" . $offset . "/" . $jumlah . "/" . $count_update;
        $this->load->view('Custom_view/count_down', $data);
    }
    public function loadBillData($inet)
    {
        $url = "http://i-payment.telkom.co.id/script/intag_search_trems.php?phone=$inet&rname=&raddr=&rphone=&via=TREMS";
        $return = "";
        $payload = file_get_contents($url);
        $status = "BELUM CABUT";
        if (strpos($payload, "silakan hubungi helpdesk") !== false || strpos($payload, "tidak mempunyai billing") !== false || strpos($payload, "No such host") !== false) {
            $return = $return . "<tr><td>" . $inet . "</td><td>no data</td><td>no data</td><td>no data</td><td>no data</td><td>no data</td><td>no data</td><td>no data</td></tr>";
        } else {
            $dom = new domDocument;
            @$dom->loadHTML($payload);
            $dom->preserveWhiteSpace = true;
            $dom_ee = $dom->getElementsByTagName('table');
            $tab = $dom_ee[1];
            $date_payment = false;
            for ($k = 0; $k <= $tab->getElementsByTagName('tr')->length; $k++) {
                //billing payload
                $tableid = $dom_ee[0];
                $dataid = array();
                $tidee = $tableid->getElementsByTagName('tr');
                $row0 = $tidee[0];

                //billing payload
                $tables = $dom_ee[1];
                $tidee = $tables->getElementsByTagName('tr');
                $rows = $tidee[0];
                $rows = $rows->parentNode->removeChild($rows);
                $rows = $tidee[0];
                for ($i = 0; $i < $rows->childNodes->length; $i++) {
                    $tds = $rows->getElementsByTagName('td');
                    $load = $tds[$i]->textContent;


                    if ($i == 8) {
                        $load = preg_replace('/,/', '', $load);
                        if ($load == "") {
                            $date_payment = true;
                        }
                    }

                    if ($k == 0) {
                        if ($i == 1) {
                            $load = preg_replace('/,/', '', $load);
                            $last_payment = $load;
                        }
                    }
                };
                $date_now = strtoupper(date('M Y'));
                if ($date_now != strtoupper($last_payment)) {

                    if ($k == 0) {
                        $status = "CABUT";
                    }
                } else {
                    if ($k == 3) {
                        if ($date_payment) {
                            $status = "CABUT";
                        }
                    }
                }
            }
        }
        // echo $return;
        return $status;
    }
    public function grab_indibox()
    {
        require_once('./assets/googlesheets/vendor/autoload.php');
        //Reading data from spreadsheet.

        $sheet = array(
            "FB Ads Suvarna" => array(
                "sheet" => "FB Ads Suvarna",
                "tanggal" => "A",
                "ad_set" => "B",
                "name" => "C",
                "phone" => "D",
                "email" => "E",
                "paket" => "G",
                "no_indihome" => "H",
                "no_pstn" => "I",
                "nama_pastel" => "J",
                "alamat" => "K",
                "status_call" => "L",
                "kecepatan" => "M",
                "epayment" => "N",
                "lokasi_pembayaran" => "O",
                "tahun_pasang" => "P",
                "status_followup" => "Q",
                "keterangan" => false
            ),
            "Landing Page" => array(
                "sheet" => "Landing Page",
                "tanggal" => "B",
                "ad_set" => false,
                "name" => "E",
                "phone" => "F",
                "email" => "D",
                "paket" => "G",
                "no_indihome" => "I",
                "no_pstn" => "H",
                "nama_pastel" => "J",
                "alamat" => "K",
                "status_call" => "L",
                "kecepatan" => "M",
                "epayment" => "N",
                "lokasi_pembayaran" => "O",
                "tahun_pasang" => "P",
                "status_followup" => false,
                "keterangan" => "Q"
            ),
            "Welcome Page Indihome" => array(
                "sheet" => "Welcome Page Indihome",
                "tanggal" => "B",
                "ad_set" => false,
                "name" => "E",
                "phone" => "F",
                "email" => "D",
                "paket" => "G",
                "no_indihome" => "I",
                "no_pstn" => "H",
                "nama_pastel" => "J",
                "alamat" => "K",
                "status_call" => "L",
                "kecepatan" => "M",
                "epayment" => "N",
                "lokasi_pembayaran" => "O",
                "tahun_pasang" => "P",
                "status_followup" => false,
                "keterangan" => "Q"
            ),
            "Leads Google Ads" => array(
                "sheet" => "Leads Google Ads",
                "tanggal" => "B",
                "ad_set" => false,
                "name" => "E",
                "phone" => "F",
                "email" => "D",
                "paket" => "G",
                "no_indihome" => "I",
                "no_pstn" => "H",
                "nama_pastel" => "J",
                "alamat" => "K",
                "status_call" => "L",
                "kecepatan" => "M",
                "epayment" => "N",
                "lokasi_pembayaran" => "O",
                "tahun_pasang" => "P",
                "status_followup" => false,
                "keterangan" => "Q"
            )
        );
        $alpha = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');



        $client = new \Google_Client();

        $client->setApplicationName('Google Sheets and PHP');

        $client->setScopes(array(\Google_Service_Sheets::SPREADSHEETS));

        $client->setAccessType('offline');

        $client->setAuthConfig('./assets/googlesheets/credentials.json');
        $insert_num = 0;
        if (count($sheet) > 0) {
            foreach ($sheet as $vsheet => $dshet) {
                $service = new Google_Service_Sheets($client);
                // $spreadsheetId = "1Xa8Pq-c-fKdetQx0lxATZJ2Rz7hY8AdRuLdS42j13lw"; //It is present in your URL
                $spreadsheetId = "1d0mp4NM7ccifbHBDgd7YXHqZo0MPVycEecBqNCV3rn8"; //It is present in your URL

                $get_range = $vsheet . "!A1:Q10000";

                $response = $service->spreadsheets_values->get($spreadsheetId, $get_range);

                $values = $response->getValues();

                if (empty($values)) {
                    print "No data found.\n";
                } else {
                    $n = 0;
                    foreach ($values as $row) {
                        if ($n > 0) {
                            // Print columns A and E, which correspond to indices 0 and 4.

                            $data_insert = array();
                            foreach ($dshet as $field_sheet => $value_sheet) {
                                if ($value_sheet != false) {
                                    $rowna = array_search($value_sheet, $alpha);
                                    $data_insert[$field_sheet] = $row[$rowna];
                                }
                                $data_insert["sheet"] = $vsheet;
                            }
                            $data_insert["row"] = $n;

                            $cek_num = $this->indibox_forcall_3p->get_count(array("sheet" => $vsheet, "row" => $n));
                            if ($cek_num > 0) {
                                $data_insert['last_update'] = date('Y-m-d H:i:s');
                                if ($data_insert['status_call'] == "") {
                                    $data_insert['status_call'] = 0;
                                }
                                $this->indibox_forcall_3p->edit(array("sheet" => $vsheet, "row" => $n), $data_insert);
                            } else {
                                if ($data_insert['status_call'] == "") {
                                    $data_insert['status_call'] = 0;
                                }
                                $data_insert['add_date'] = date('Y-m-d H:i:s');
                                $this->indibox_forcall_3p->add($data_insert);
                            }

                            $insert_num++;
                        }


                        $n++;
                    }
                }
            }
        }
        echo $insert_num;
    }
    public function grab_indibox_php5()
    {
        require_once('./assets/googlesheets_php5/src/Google/autoload.php');
        //Reading data from spreadsheet.

        $client = new Google_Client();
        $client->setApplicationName("Client_Library_Examples");
        $client->setDeveloperKey("YOUR_APP_KEY");

        $service = new Google_Service_Books($client);
        // $optParams = array('filter' => 'free-ebooks');
        // $results = $service->volumes->listVolumes('Henry David Thoreau', $optParams);
        var_dump($result);
        // foreach ($results as $item) {
        //     echo $item['volumeInfo']['title'], "<br /> \n";
        // }
    }
};
