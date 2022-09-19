<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wallboard_tam extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tam_bsd/Cc147_main_users_extended_model', 'users_extended');
    }
    public function get_data_list()
    {
        $date=date('Y-m-d');
        // $date = date('2020-02-26');
        $query = $this->users_extended->live_query(
            "SELECT
            *
        FROM
            app_tam_data2 AS d
        JOIN cc147_main_users_extended AS u ON u.user1 = d.login
        WHERE
            u.user5 = 'BSD'
            AND (
                jenis='Upgrade Indihome' OR jenis='Mini Pack' OR jenis='IndiBOX' OR 
                jenis='STB Tambahan' OR jenis='Indihome 2P to 3P' OR jenis='Home Wifi'
                )
            AND DATE(tgl) = '$date'
        "
        );
        $result = $query->result_array();
        $data['count'] = count($result);
        $data['contacted'] = count($this->filter_by_value($result, 'status', 'Contacted'));
        $data['contacted_rate'] = number_format((($data['contacted'] / ($data['count'])) * 100), 2);
        $data['agree'] = $this->filter_by_value($result, 'kategori', 'Agree');
        $data['agree'] = count($this->filter_by_value($data['agree'], 'input', 'New'));
        $data['agree_rate'] = number_format((($data['agree'] / ($data['contacted'])) * 100), 2);


        $query = $this->users_extended->live_query(
            "SELECT
            *
        FROM
            app_tam_data2 AS d
        JOIN cc147_main_users_extended AS u ON u.user1 = d.login
        WHERE
            u.user5 = 'BSD'
            AND (
                jenis='Upgrade Indihome' OR jenis='Mini Pack' OR jenis='IndiBOX' OR 
                jenis='STB Tambahan' OR jenis='Indihome 2P to 3P' OR jenis='Home Wifi'
                )
            AND DATE(tgl) = '$date'
            GROUP BY d.login
        "
        );
        $data['agent_online'] = $query->num_rows();

        // $date_approve = date("Y-m-d", strtotime('-1 days'));
        $date_approve = date("2020-02-25", strtotime('-1 days'));
        $query = $this->users_extended->live_query(
            "SELECT
            *
        FROM
            app_tam_data2 AS d
        JOIN cc147_main_users_extended AS u ON u.user1 = d.login
        WHERE
            u.user5 = 'BSD'
            AND (
                jenis='Upgrade Indihome' OR jenis='Mini Pack' OR jenis='IndiBOX' OR 
                jenis='STB Tambahan' OR jenis='Indihome 2P to 3P' OR jenis='Home Wifi'
                )
            AND d.valid = 'Valid'
            AND DATE(tgl) = '$date_approve'
        "
        );

        $d_approve = $query->result_array();
        $data['approve'] = count($d_approve);
        $query = $this->users_extended->live_query(
            "SELECT
            *
        FROM
            app_tam_data2 AS d
        JOIN cc147_main_users_extended AS u ON u.user1 = d.login
        WHERE
            u.user5 = 'BSD'
            AND d.kategori = 'Agree'
            AND d.input = 'New'
            AND (
                jenis='Upgrade Indihome' OR jenis='Mini Pack' OR jenis='IndiBOX' OR 
                jenis='STB Tambahan' OR jenis='Indihome 2P to 3P' OR jenis='Home Wifi'
                )
            AND DATE(tgl) = '$date_approve'
        "
        );
        $data['agree_yesterday'] = $query->num_rows();
        $rule = array("Upgrade Indihome", "Mini Pack", "IndiBOX", "STB Tambahan", "Indihome 2P to 3P", "Home Wifi");
        for ($r2 = 0; $r2 < 6; $r2++) {
            $data['bagi_approve'][$r2] = count($this->filter_by_value($d_approve, 'jenis', $rule[$r2]));
        }
        $data['approve_rate'] = number_format((($data['approve'] / ($data['agree_yesterday'])) * 100), 2);
        echo json_encode($data);
    }
    public function get_data_regional()
    {
        $date=date('Y-m-d');
        // $date = date('2020-02-26');
        $query = $this->users_extended->live_query(
            "SELECT
            d.reg as reg,d.jenis as jenis
        FROM
            app_tam_data2 AS d
        JOIN cc147_main_users_extended AS u ON u.user1 = d.login
        WHERE
             (
                jenis='Upgrade Indihome' OR jenis='Mini Pack' OR jenis='IndiBOX' OR 
                jenis='STB Tambahan' OR jenis='Indihome 2P to 3P' OR jenis='Home Wifi'
                )
                AND d.valid = 'Valid'
            AND DATE(tgl) = '$date'
        "
        );
        $result = $query->result_array();
        $romawi = array("I", "II", "III", "IV", "V", "VI", "VII");
        $rule = array("Upgrade Indihome", "Mini Pack", "IndiBOX", "STB Tambahan", "Indihome 2P to 3P", "Home Wifi");
        for ($r = 0; $r <= 7; $r++) {
            $data_q['regional'][$r] = $this->filter_by_value($result, 'reg', $romawi[$r]);
        }

        for ($rl = 0; $rl < 7; $rl++) {
            for ($r2 = 0; $r2 < 6; $r2++) {
                $data['regional'][$rl][$r2] = count($this->filter_by_value($data_q['regional'][$rl], 'jenis', $rule[$r2]));
            }
        }

        echo json_encode($data);
    }
    public function get_data_site()
    {
        // $date=date('Y-m-d');
        $date1 = date('Y-m-') . '01';
        $date2 = date('Y-m-d');
        $query = $this->users_extended->live_query(
            "SELECT
            u.user5 as user5,d.jenis as jenis
        FROM
            app_tam_data2 AS d
        JOIN cc147_main_users_extended AS u ON u.user1 = d.login
        WHERE
             (
                jenis='Upgrade Indihome' OR jenis='Mini Pack' OR jenis='IndiBOX' OR 
                jenis='STB Tambahan' OR jenis='Indihome 2P to 3P' OR jenis='Home Wifi'
                )
                AND d.valid = 'Valid'
            AND DATE(tgl) >= '$date1' AND DATE(tgl) <= '$date2'
        "
        );
        $result = $query->result_array();
        $romawi = array("CW", "BSD", "MEDAN", "BANDUNG", "Semarang", "Malang", "Makassar");
        $rule = array("Upgrade Indihome", "Mini Pack", "IndiBOX", "STB Tambahan", "Indihome 2P to 3P", "Home Wifi");
        for ($r = 0; $r <= 7; $r++) {
            $data_q['site'][$r] = $this->filter_by_value($result, 'user5', $romawi[$r]);
        }

        for ($rl = 0; $rl < 7; $rl++) {
            for ($r2 = 0; $r2 < 6; $r2++) {
                $data['site'][$rl][$r2] = count($this->filter_by_value($data_q['site'][$rl], 'jenis', $rule[$r2]));
            }
        }

        echo json_encode($data);
    }
    public function get_data_grafik()
    {
        $rule = array("Upgrade Indihome", "Mini Pack", "IndiBOX", "STB Tambahan", "Indihome 2P to 3P", "Home Wifi");
       
        for ($r2 = 0; $r2 < 6; $r2++) {
            $v = $rule[$r2];
            for ($i = 0; $i <= 27; $i++) {
                $date2 = date('Y-m-' . sprintf("%02d", $i+1));
                $data_q = 0;
                $query = $this->users_extended->live_query(
                    "SELECT
                *
            FROM
                app_tam_data2 AS d
            JOIN cc147_main_users_extended AS u ON u.user1 = d.login
            WHERE
                u.user5 = 'BSD' AND
                (
                jenis='Upgrade Indihome' OR jenis='Mini Pack' OR jenis='IndiBOX' OR 
                jenis='STB Tambahan' OR jenis='Indihome 2P to 3P' OR jenis='Home Wifi'
                )
                AND
                d.jenis = '$v'
                    AND d.valid = 'Valid'
                AND DATE(d.tgl) = '$date2'
            "
                );
                // $data_q = $query->result_array();


                $data['grafik'][$rule[$r2]][$i] = count($query->result_array());
            }
        }

        echo json_encode($data);
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
}
