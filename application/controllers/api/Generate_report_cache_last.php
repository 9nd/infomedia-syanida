<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generate_report_cache extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Custom_model/Dapros_infomedia_model', 'distribution');
        // $this->load->model('Custom_model/Dapros_model', 'distribution');
        $this->load->model('Custom_model/Status_call_model', 'status_call');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling');
        $this->load->model('Custom_model/Trans_profiling_daily_model', 'trans_profiling_daily');
        $this->load->model('Custom_model/Trans_profiling_monthly_model', 'trans_profiling_monthly');
        $this->load->model('Custom_model/Trans_profiling_last_month_model', 'trans_profiling_last_month');
        $this->load->model('Custom_model/Report_cache_model', 'report_cache');
        $this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling_verifikasi');
    }

    // public function generate_report($date)
    // {
    //     $data = array();
    //     if ($date) {
    //         $date_1 = $date . ' 00:00:00';
    //         $date_2 = $date . ' 23:59:59';
    //     } else {
    //         $date_1 = date('Y-m-d') . ' 00:00:00';
    //         $date_2 = date('Y-m-d') . ' 23:59:59';
    //     }

    //     $query_trans_profiling = $this->trans_profiling->live_query(
    //         "SELECT veri_call,handphone,email,DATE(lup) as date_lup FROM trans_profiling WHERE lup BETWEEN '" . $date_1 . "' AND '" . $date_2 . "' ORDER BY lup ASC
    //             "
    //     );
    //     $data_input = array();
    //     $last_date = false;
    //     $n = 0;
    //     foreach ($query_trans_profiling->result_array() as $dl) {
    //         if ($last_date) {
    //             if ($dl['date_lup'] != $last_date) {
    //                 $data_insert = $data_input[$last_date];
    //                 if ($this->report_cache->get_count(array('date' => $last_date)) == 0) {
    //                     $this->report_cache->add($data_insert);
    //                 } else {
    //                     $this->report_cache->edit(array('date' => $last_date), $data_insert);
    //                 }
    //             }
    //         }
    //         $last_date = $dl['date_lup'];
    //         $data_input[$dl['date_lup']]['date'] = $last_date;
    //         $data_input[$dl['date_lup']]['total_order_call'] = $data_input[$dl['date_lup']]['total_order_call'] + 1;
    //         for ($status = 1; $status <= 16; $status++) {
    //             if ($dl['veri_call'] == $status) {
    //                 $data_input[$dl['date_lup']]['status_' . $status] = $data_input[$dl['date_lup']]['status_' . $status] + 1;
    //                 if ($dl['veri_call'] == 13) {
    //                     $check = $this->check_hp_email($dl['handphone'], $dl['email']);

    //                     if ($check == 1) {
    //                         $data_input[$dl['date_lup']]['hp_email'] = $data_input[$dl['date_lup']]['hp_email'] + 1;
    //                     } else {
    //                         if ($check == 2) {
    //                             $data_input[$dl['date_lup']]['hp_only'] = $data_input[$dl['date_lup']]['hp_only'] + 1;
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //         $n++;
    //     }
    //     if ($last_date == date('Y-m-d')) {
    //         $data_insert = $data_input[$last_date];
    //         $data_insert['last_update'] = date('Y-m-d H:i:s');
    //         if ($this->report_cache->get_count(array('date' => $last_date)) == 0) {
    //             $this->report_cache->add($data_insert);
    //         } else {
    //             $this->report_cache->edit(array('date' => $last_date), $data_insert);
    //         }
    //     }else{
    //         $data_insert = $data_input[$last_date];
    //         $data_insert['last_update'] = date('Y-m-d H:i:s');
    //         if ($this->report_cache->get_count(array('date' => $last_date)) == 0) {
    //             $this->report_cache->add($data_insert);
    //         } else {
    //             $this->report_cache->edit(array('date' => $last_date), $data_insert);
    //         }
    //     }
    //     $this->load->view('Custom_view/generate_report', $data);
    // }

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


        $cek_num = $this->trans_profiling_daily->get_count(array("DATE(lup)" => $date));
        $limit_query = $limit + 1;
        if ($cek_num == 0) {
            if ($date == date('Y-m-d')) {
                $this->trans_profiling_daily->delete(array("DATE(lup) !=" => $date));
            }
            $this->trans_profiling_monthly->delete(array("DATE_FORMAT(lup, '%Y-%m') <" => $ym));
            $this->trans_profiling_last_month->delete(array("DATE_FORMAT(lup, '%Y-%m') <" => $last_month));
            $query = $this->trans_profiling->live_query(
                "SELECT
                    *
                FROM
                    trans_profiling 
                WHERE
                lup BETWEEN '$date_1' AND '$date_2' LIMIT $limit_query offset $offset
                "
            );
        } else {
            // $last_idx=$this->trans_profiling_daily->get_row(array(),array("idx"),array("idx"=>"DESC"));
            $query = $this->trans_profiling->live_query(
                "SELECT
                    *
                FROM
                    trans_profiling 
                WHERE
                lup BETWEEN '$date_1' AND '$date_2' LIMIT $limit_query offset $offset
                "
            );
        }



        foreach ($query->result_array() as $val) {
            $check = $this->trans_profiling_daily->get_count(array("idx" => $val['idx']));
            $check_mothly = $this->trans_profiling_monthly->get_count(array("idx" => $val['idx']));
            $check_last_month = $this->trans_profiling_last_month->get_count(array("idx" => $val['idx']));
            if ($check > 0) {
                $this->trans_profiling_daily->delete(array("idx" => $val['idx']));
                 if ($date == date('Y-m-d')) {
                    $this->trans_profiling_daily->add($val);
                }

            } else {
                if ($date == date('Y-m-d')) {
                    $this->trans_profiling_daily->add($val);
                }

            }
            if ($check_mothly > 0) {
                $this->trans_profiling_monthly->delete(array("idx" => $val['idx']));
                $this->trans_profiling_monthly->add($val);
            } else {
                $this->trans_profiling_monthly->add($val);
            }
            if ($check_last_month > 0) {
                $this->trans_profiling_last_month->delete(array("idx" => $val['idx']));
                $this->trans_profiling_last_month->add($val);
            } else {
                $this->trans_profiling_last_month->add($val);
            }
            // $data_post=$val;
            // $ch = curl_init('https://sy-anida.com/api/Trans_profiling/users');
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $data_post);
            // $response = curl_exec($ch);
            // curl_close($ch);
        }
        // echo $jumlah_data;
        $offset = $offset + $limit;
        if ($offset > $jumlah_data) {
            if ($date != date('Y-m-d')) {

                $next_day = date('Y-m-d', strtotime($date . "+1 days"));
                $offset = 0;
                $query_num_next = $this->trans_profiling->live_query(
                    "SELECT
                        count(idx) as jumlah_data
                    FROM
                        trans_profiling 
                    WHERE
                    lup BETWEEN '$next_day 00:00:00' AND '$next_day 23:59:59' 
                    "
                );
                $data_query_num = $query_num_next->row_array();
                $jumlah_data = $data_query_num['jumlah_data'];
                $data['link'] = base_url() . "api/Generate_report_cache/generate_report_v2/" . $next_day . "/" . $limit . "/" . $offset . "/" . $jumlah_data;
                $this->load->view('Custom_view/count_down', $data);
            } else {
                $query_num_next = $this->trans_profiling->live_query(
                    "SELECT
                        count(idx) as jumlah_data
                    FROM
                        trans_profiling 
                    WHERE
                    lup BETWEEN '$date_1' AND '$date_2' 
                    "
                );
                $data_query_num = $query_num_next->row_array();
                $jumlah_data = $data_query_num['jumlah_data'];

                $data['link'] = base_url() . "api/Generate_report_cache/generate_report_v2/" . $date . "/" . $limit . "/" . $offset_lama . "/" . $jumlah_data;
                if (date('H') == "21") {
                    $this->load->model('Custom_model/Cdr_model', 'cdr');
                    $check_cdr = $this->cdr->get_count(array("DATE(calldate)" => $date));
                    if ($check_cdr == 0) {
                        $data['link'] = base_url() . "api/Generate_report_cache/save_crd_daily/" . $date . "/" . $limit . "/" . $offset . "/" . $jumlah_data;
                    }
                }
                $this->load->view('Custom_view/count_down', $data);
            }
        } else {
            $data['link'] = base_url() . "api/Generate_report_cache/generate_report_v2/" . $date . "/" . $limit . "/" . $offset . "/" . $jumlah_data;
            $this->load->view('Custom_view/count_down', $data);
        }


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
    public function save_crd_daily($date = false, $limit = 100, $offset = 0, $jumlah_data = false)
    {
        $date = date('Y-m-d');
        $this->load->model('Custom_model/Cdr_model', 'cdr');
        $this->load->model('Custom_model/Cdr_daily_model', 'cdr_daily');
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

        $this->cdr_daily->truncate();
        // Will dump a beauty json :3
        $n = 0;
        if ($result) {
            $data = json_decode($result, true);
            if (count($data['Data Asterisk Profilling']) > 0) {
                foreach ($data['Data Asterisk Profilling'] as $data_insert) {
                    // if ($data_insert['disposition'] == 'ANSWERED') {
                    if (substr($data_insert['dst'], 0, 2) == '61') {
                        $check = $this->cdr->get_count(array("uniqueid" => $data_insert['uniqueid']));
                        if ($check == 0) {
                            $this->cdr->add($data_insert);
                        }
                        $check_daily = $this->cdr_daily->get_count(array("uniqueid" => $data_insert['uniqueid']));
                        if ($check_daily == 0) {
                            $this->cdr_daily->add($data_insert);
                        }
                    }
                    // }

                    $n++;
                }
            }
        }
        $data['link'] = base_url() . "api/Generate_report_cache/save_crd_daily";


        $this->load->view('Custom_view/count_down', $data);
    }
    public function save_to_recording($date = false, $limit = 100, $offset = 0, $jumlah_data = false)
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
            $this->recording_daily->delete(array("DATE(calldate) !=" => $date));
        // }
       
        // Will dump a beauty json :3
        $n = 0;
        if ($result) {
            $data = json_decode($result, true);
            if (count($data['Data Asterisk Profilling']) > 0) {
                foreach ($data['Data Asterisk Profilling'] as $data_insert) {
                    // if ($data_insert['disposition'] == 'ANSWERED') {
                    if (substr($data_insert['dst'], 0, 2) == '61') {
                        $check = $this->recording_daily->get_count(array("uniqueid" => $data_insert['uniqueid']));
                        if ($check == 0) {
                            $this->recording_daily->add($data_insert);
                        }
                    }
                    // }

                    $n++;
                }
            }
        }
        $data['link'] = base_url() . "api/Generate_report_cache/save_to_cdr";


        $this->load->view('Custom_view/count_down', $data);
    }
    public function save_to_cdr($limit = 100, $offset = 0, $jumlah_data = false)
    {
        $date = date('Y-m-d');
        $this->load->model('Custom_model/Cdr_model', 'cdr');
        $this->load->model('Custom_model/Cdr_daily_model', 'cdr_daily');
        $this->load->model('Custom_model/Recording_daily_model', 'recording_daily');
        $result = $this->recording_daily->get_results_array(array("status_update" => 0), array("*"), array("limit" => $limit, "offset" => $offset), array("id" => "ASC"));
        $n = 0;
        $offset = $offset + $limit;
        if ($jumlah_data == false) {
            $jumlah_data = $this->recording_daily->get_count(array("status_update" => 0));
            $this->cdr_daily->delete(array("DATE(calldate) !=" => $date));
        }

        if ($offset <= $jumlah_data) {


            if ($result['num'] > 0) {

                foreach ($result['results'] as $data_insert) {
                    // if ($data_insert['disposition'] == 'ANSWERED') {
                    if (substr($data_insert['dst'], 0, 2) == '61') {
                        unset($data_insert['status_update']);
                        unset($data_insert['id']);
                        $check = $this->cdr->get_count(array("uniqueid" => $data_insert['uniqueid']));
                        if ($check == 0) {
                            $this->cdr->add($data_insert);
                        }
                        $check_daily = $this->cdr_daily->get_count(array("uniqueid" => $data_insert['uniqueid']));
                        if ($check_daily == 0) {
                            $this->cdr_daily->add($data_insert);
                        }
                        $this->recording_daily->edit(array("uniqueid"=>$data_insert['uniqueid']),array("status_update"=>1));
                    }
                    // }

                    $jumlah_data++;
                }
            }
            $data['link'] = base_url() . "api/Generate_report_cache/save_to_cdr/".$limit."/".$offset."/".$jumlah_data;
        }else{
            $data['link'] = base_url() . "api/Generate_report_cache/save_to_recording";
        }
        
        $this->load->view('Custom_view/count_down', $data);
    }
    function go_public_api()
    {
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
};
