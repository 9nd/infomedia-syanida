<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generate_report_cache_tam extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Custom_model/Status_call_model', 'status_call');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling');
        $this->load->model('Custom_model/Report_cache_model', 'report_cache');
        $this->load->model('Tam_bsd/Cc147_main_users_extended_model', 'users_extended');
        $this->load->model('Tam_bsd/Report_cache_tam_model', 'report_cache_tam');
    }

    public function generate_report($date = false)
    {
        $data = array();
        // $number_add=$this->input->get('number_add');

        if (!$date) {
            $date = date('Y-m-d');
            $date_1 = date('Y-m-d') . ' 00:00:00';
            $date_2 = date('Y-m-d') . ' 23:59:59';
        } else {
            $date_1 = $date . ' 00:00:00';
            $date_2 = $date . ' 23:59:59';
        }
        $status = array(
            "approve" => array(
                "valid" => "Valid"
            ),
        );
        $query = $this->users_extended->live_query(
            "SELECT
                *,DATE(tgl) as date_tgl
            FROM
                app_tam_data2 
            WHERE
                (
                    jenis='Upgrade Indihome' OR jenis='Mini Pack' OR jenis='IndiBOX' OR 
                    jenis='STB Tambahan' OR jenis='Indihome 2P to 3P' OR jenis='Home Wifi'
                    )
                AND tgl BETWEEN '" . $date_1 . "' AND '" . $date_2 . " '
                AND valid = 'Valid'
            "
        );

        $data_input = array();
        $last_date = false;
        $n = 0;

        foreach ($query->result_array() as $row) {
            foreach ($status as $r_status => $v_status) {
                $stat = 0;
                foreach ($v_status as $f_status => $gv_status) {
                    if ($row[$f_status] == $gv_status) {
                        $stat++;
                    }
                }
                if ($stat == count($v_status)) {
                    $cek = $this->report_cache_tam->get_row(array(
                        'login' => $row['login'],
                        'date' => $row['date_tgl'],
                        'status' => $r_status,
                        'jenis' => $row['jenis'],
                        'regional' => $row['reg']
                    ));
                    if ($cek) {
                        $jumlah = $cek->jml + 1;
                    } else {
                        $jumlah = 1;
                    }
                    if ($cek) {
                        $where = array(
                            'login' => $row['login'],
                            'date' => $row['date_tgl'],
                            'status' => $r_status,
                            'jenis' => $row['jenis'],
                            'regional' => $row['reg'],
                        );
                        $data_insert = array("jml" => $jumlah);
                        $this->report_cache_tam->edit($where, $data_insert);
                    } else {
                        $data_insert = array(
                            'login' => $row['login'],
                            'date' => $row['date_tgl'],
                            'status' => $r_status,
                            'jenis' => $row['jenis'],
                            'regional' => $row['reg'],
                            'jml' => $jumlah
                        );

                        $this->report_cache_tam->add($data_insert);
                    }
                }
            }
            $n++;
        }



        $this->load->view('Custom_view/Generate_report_tam', $data);
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
