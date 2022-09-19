<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generate_report_cache extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Custom_model/Status_call_model', 'status_call');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling');
        $this->load->model('Custom_model/Report_cache_model', 'report_cache');
    }

    public function generate_report($date)
    {
        $data = array();
        // $number_add=$this->input->get('number_add');
        $date_1 = $date.' 00:00:00';
        $date_2 = $date.' 23:59:59';
        if ($date) {
            $date_1 = date('Y-m-d').' 00:00:00';
            $date_2 = date('Y-m-d').' 23:59:59';
            $query_trans_profiling = $this->trans_profiling->live_query(
                "SELECT veri_call,handphone,email,DATE(lup) as date_lup FROM trans_profiling WHERE lup BETWEEN '".$date_1."' AND '".$date_2."' ORDER BY lup ASC
                "
            );
            $data_input = array();
            $last_date = false;
            $n = 0;
            foreach ($query_trans_profiling->result_array() as $dl) {
                if ($last_date) {
                    if ($dl['date_lup'] != $last_date) {



                        $data_insert = $data_input[$last_date];
                        if ($this->report_cache->get_count(array('date' => $last_date)) == 0) {
                            $this->report_cache->add($data_insert);
                        } else {
                            $this->report_cache->edit(array('date' => $last_date), $data_insert);
                        }
                    }
                }
                $last_date = $dl['date_lup'];
                $data_input[$dl['date_lup']]['date'] = $last_date;
                $data_input[$dl['date_lup']]['total_order_call'] = $data_input[$dl['date_lup']]['total_order_call'] + 1;
                for ($status = 1; $status <= 16; $status++) {
                    if ($dl['veri_call'] == $status) {
                        $data_input[$dl['date_lup']]['status_' . $status] = $data_input[$dl['date_lup']]['status_' . $status] + 1;
                        if ($dl['veri_call'] == 13) {
                            if (stripos($dl['email'], "@") !== false) {
                                $email = 1;
                            }
                            if (stripos($dl['handphone'], "08") !== false) {
                                $handphone = 1;
                            }
                            if ($email == 1 && $handphone == 1) {
                                $data_input[$dl['date_lup']]['hp_email'] = $data_input[$dl['date_lup']]['hp_email'] + 1;
                            } else {
                                if ($handphone == 1) {
                                    $data_input[$dl['date_lup']]['hp_only'] = $data_input[$dl['date_lup']]['hp_only'] + 1;
                                }
                            }
                        }
                    }
                }
                $n++;
            }
            if($last_date == date('Y-m-d')){
                $data_insert = $data_input[$last_date];
                if ($this->report_cache->get_count(array('date' => $last_date)) == 0) {
                    $this->report_cache->add($data_insert);
                } else {
                    $this->report_cache->edit(array('date' => $last_date), $data_insert);
                    // echo "updating data";
                }
            }
            // echo $n;
            
        } else {
            echo "Please input YEAR AND MONTH AND DAY";
            exit;
        }


        $this->load->view('Custom_view/generate_report', $data);
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
};
