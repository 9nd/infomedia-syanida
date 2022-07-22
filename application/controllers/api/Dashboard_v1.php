<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_v1
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
        // $this->load->model('Custom_model/Monthly_report_cache_model', 'monthly_report');
        $this->load->model('Custom_model/Status_call_model', 'status_call');
        $this->load->model('Custom_model/Report_cache_model', 'report_cache');
        $this->load->model('Custom_model/Trans_profiling_last_month_model', 'trans_profiling_last_month');
        $this->load->model('Custom_model/Monthly_report_monthly_model', 'monthly_report');
        $this->load->model('Custom_model/Monthly_report_monthly_moss_model', 'monthly_report_moss');
    }
    function get_daily_performance_reg()
    {
        $bulan = $_GET['bulan'];
        $tahun = date('Y');
        $data_monthly_report = $this->monthly_report->get_row_array(array('bulan' => $bulan, "tahun" => $tahun));
        for ($i = 1; $i <= 6; $i++) {
            // echo $k."<br>";
            $json['agent'][$i] = $this->sys_user->get_row_array(array("agentid" => $data_monthly_report['agent_' . $i]));
            $json['agent'][$i]['picture'] = $json['agent'][$i]['picture'];
            $json['agent'][$i]['num'] = $data_monthly_report['agent_' . $i . '_num'];
        }
        // echo $json;
        echo json_encode($json);
    }
    function get_profiling_reguler()
    {
        $bulan = $_GET['bulan'];
        $tahun = date('Y');
        $data_monthly_report = $this->monthly_report->get_row_array(array('bulan' => $bulan, "tahun" => $tahun));

        // printing result in days format 
        $total['wo'] = number_format(0);
        $total['contacted'] = number_format($data_monthly_report['contacted']);
        $total['status_13'] = number_format($data_monthly_report['verified']);
        $total['uncontacted'] = number_format($data_monthly_report['not_contacted']);
       
        $total['callorder'] = number_format($data_monthly_report['not_contacted'] + $data_monthly_report['contacted']);
        
        $total['contacted_rate'] = number_format(($data_monthly_report['contacted'] / ($data_monthly_report['not_contacted'] + $data_monthly_report['contacted'])) * 100);
        $total['uncontacted_rate'] = number_format(($data_monthly_report['not_contacted'] / ($data_monthly_report['not_contacted'] + $data_monthly_report['contacted'])) * 100);

        $total['hp_email'] = number_format($data_monthly_report['hp_email']);
        $total['hp_only'] = number_format($data_monthly_report['hp_only']);
        $total['convention_rate'] = number_format(($data_monthly_report['verified'] / ($data_monthly_report['contacted'])) * 100);
        $total['hp_email_rate'] = intval(($total['hp_email'] / $total['status_13']) * 100);
        $total['hp_only_rate'] = intval(($total['hp_only'] / $total['status_13']) * 100);
        $total['agent_online'] = $data_monthly_report['agent_online'];

        echo json_encode($total);
    }
    function get_grafik_verified()
    {
        $bulan = $_GET['bulan'];
        $tahun = date('Y');

        for ($i = 0; $i <= 11; $i++) {
            $bulan = sprintf("%02d", $i);
            $data_monthly_report = $this->monthly_report->get_row_array(array('bulan' => $bulan, "tahun" => $tahun));
            $total['data']['Verified'][$i] = 0;
            if ($data_monthly_report) {
                $total['data']['Verified'][$i] = intval($data_monthly_report['verified']);
            }
        }
        echo json_encode($total);
    }
    function get_best_agent()
    {
        $bulan = $_GET['bulan'];
        $tahun = date('Y');
        $data_monthly_report = $this->monthly_report->get_row_array(array('bulan' => $bulan, "tahun" => $tahun));
        $json['agent'][1] = $this->sys_user->get_row_array(array("agentid" => $data_monthly_report['best_agent']));
        $json['agent'][1]['picture'] = $json['agent'][1]['picture'];
        $json['agent'][1]['num'] = number_format($data_monthly_report['verified_best_agent']);
        $json['tl'][1] = $this->sys_user->get_row_array(array("agentid" => $data_monthly_report['best_teamleader']));
        $json['tl'][1]['picture'] = $json['tl'][1]['picture'];
        $json['tl'][1]['num'] = number_format($data_monthly_report['verified_best_teamleader']);


        echo json_encode($json);
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
    
    function get_profiling_mos()
    {
        $bulan = $_GET['bulan'];
        $tahun = date('Y');
        $data_monthly_report = $this->monthly_report_moss->get_row_array(array('bulan' => $bulan, "tahun" => $tahun));

        // printing result in days format 
        $total['wo'] = number_format(0);
        $total['contacted'] = number_format($data_monthly_report['contacted']);
        $total['status_13'] = number_format($data_monthly_report['verified']);
        $total['uncontacted'] = number_format($data_monthly_report['not_contacted']);
       
        $total['callorder'] = number_format($data_monthly_report['not_contacted'] + $data_monthly_report['contacted']);
        
        $total['contacted_rate'] = number_format(($data_monthly_report['contacted'] / ($data_monthly_report['not_contacted'] + $data_monthly_report['contacted'])) * 100);
        $total['uncontacted_rate'] = number_format(($data_monthly_report['not_contacted'] / ($data_monthly_report['not_contacted'] + $data_monthly_report['contacted'])) * 100);

        $total['hp_email'] = number_format($data_monthly_report['hp_email']);
        $total['hp_only'] = number_format($data_monthly_report['hp_only']);
        $total['convention_rate'] = number_format(($data_monthly_report['verified'] / ($data_monthly_report['contacted'])) * 100);
        $total['hp_email_rate'] = intval(($total['hp_email'] / $total['status_13']) * 100);
        $total['hp_only_rate'] = intval(($total['hp_only'] / $total['status_13']) * 100);
        $total['agent_online'] = $data_monthly_report['agent_online'];
        $total['slg'] = number_format($data_monthly_report['slg'] , 2);
        $total['slfc'] = number_format($data_monthly_report['slfc'] , 2);

        echo json_encode($total);
    }
    function get_grafik_moss()
    {
        $bulan = $_GET['bulan'];
        $tahun = date('Y');

        for ($i = 0; $i <= 11; $i++) {
            $bulan = sprintf("%02d", $i);
            $data_monthly_report = $this->monthly_report_moss->get_row_array(array('bulan' => $bulan, "tahun" => $tahun));
            $total['data']['Verified'][$i] = 0;
            if ($data_monthly_report) {
                $total['data']['Verified'][$i] = intval($data_monthly_report['verified']);
            }
        }
        echo json_encode($total);
    }
    function get_daily_performance_moss()
    {
        $bulan = $_GET['bulan'];
        $tahun = date('Y');
        $data_monthly_report = $this->monthly_report_moss->get_row_array(array('bulan' => $bulan, "tahun" => $tahun));
        for ($i = 1; $i <= 6; $i++) {
            // echo $k."<br>";
            $json['agent'][$i] = $this->sys_user->get_row_array(array("agentid" => $data_monthly_report['agent_' . $i]));
            $json['agent'][$i]['picture'] = $json['agent'][$i]['picture'];
            $json['agent'][$i]['num'] = $data_monthly_report['agent_' . $i . '_num'];
        }
        // echo $json;
        echo json_encode($json);
    }
    function get_best_agent_moss()
    {
        $bulan = $_GET['bulan'];
        $tahun = date('Y');
        $data_monthly_report = $this->monthly_report_moss->get_row_array(array('bulan' => $bulan, "tahun" => $tahun));
        $json['agent'][1] = $this->sys_user->get_row_array(array("agentid" => $data_monthly_report['best_agent']));
        $json['agent'][1]['picture'] = $json['agent'][1]['picture'];
        $json['agent'][1]['num'] = number_format($data_monthly_report['verified_best_agent']);
        $json['tl'][1] = $this->sys_user->get_row_array(array("agentid" => $data_monthly_report['best_teamleader']));
        $json['tl'][1]['picture'] = $json['tl'][1]['picture'];
        $json['tl'][1]['num'] = number_format($data_monthly_report['verified_best_teamleader']);


        echo json_encode($json);
    }
}
