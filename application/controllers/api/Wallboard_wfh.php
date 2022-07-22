<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wallboard_wfh
extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling');
        $this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling_verifikasi');
        $this->load->model('Custom_model/Trans_profiling_daily_model', 'trans_profiling_daily');
        $this->load->model('Custom_model/Tahun_model', 'tahun');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $this->load->model('Custom_model/Monthly_report_cache_model', 'monthly_report');
        $this->load->model('Custom_model/Status_call_model', 'status_call');
        $this->load->model('Custom_model/Report_cache_model', 'report_cache');
        $this->load->model('Custom_model/Trans_profiling_last_month_model', 'trans_profiling_last_month');
    }
    public function get_all(){
        $report = new Wallboard_reguler;
		$report->run()->render();
    }


    // function get_idle_agent()
    // {

    //     $where_agent = array("opt_level" => 8, "kategori" => "REG");
    //     $now = date('Y-m-d');
    //     $data['agent'] = $this->sys_user->get_results($where_agent, array("nama,agentid"));

    //     $start = $_GET['start'];
    //     $end = $_GET['end'];
        
    //     $value_agent = array();
    //     if ($data['agent']['num'] > 0) {
    //         foreach ($data['agent']['results'] as $ag) {
    //             $query_trans_profiling_verifikasi = $this->trans_profiling_daily->live_query(
    //                 "SELECT TIMESTAMPDIFF(SECOND, lup, NOW()) as idle_time FROM trans_profiling_daily 
    //                  WHERE veri_upd='$ag->agentid' ORDER BY lup DESC limit 1 ;
    //                 "
    //             );
    //             if($query_trans_profiling_verifikasi->num_rows() > 0){
    //                 $value_agent[$ag->agentid]=$query_trans_profiling_verifikasi->row()->idle_time;
    //             }
                
    //         }
    //     }

    //     arsort($value_agent);
    //     $rating_agent = array_slice($value_agent, 0, 4);
    //     $n = 1;
    //     foreach ($rating_agent as $k => $v) {
    //         // echo $k."<br>";
    //         $json['agent'][$n] = $this->sys_user->get_row_array(array("agentid" => $k));
    //         $json['agent'][$n]['picture'] = $json['agent'][$n]['picture'];
    //         $json['agent'][$n]['num'] = $v;
    //         $n++;
    //     }
    //     // echo $json;
    //     echo json_encode($json);
    // }

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
}
