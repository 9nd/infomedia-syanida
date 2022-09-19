<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wallboard_tam extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tam_bsd/Cc147_main_users_extended_model', 'users_extended');
        $this->load->model('Tam_bsd/Report_cache_tam_model', 'report_cache_tam');
    }
    public function get_data_list()
    {
        $date = date('Y-m-d');
        // $date = date('2020-02-26');
        if (isset($_GET['site']) && $_GET['site'] != 'All') {
            $query = $this->users_extended->live_query(
                "SELECT
            d.status,jenis,tgl,input,kategori
        FROM
            app_tam_data2 AS d
            JOIN cc147_main_users_extended AS u ON u.user1 = d.login
        WHERE
            u.user5 = '" . $_GET['site'] . "' AND
            (
                d.jenis='Upgrade Indihome' OR d.jenis='Mini Pack' OR d.jenis='IndiBOX' OR 
                d.jenis='STB Tambahan' OR d.jenis='Indihome 2P to 3P' OR d.jenis='Home Wifi'
                )
            AND DATE(d.tgl) = '$date'
        "
            );
        } else {
            $query = $this->users_extended->live_query(
                "SELECT
            d.status,jenis,tgl,input,kategori
        FROM
            app_tam_data2 AS d
        WHERE
            (
                jenis='Upgrade Indihome' OR jenis='Mini Pack' OR jenis='IndiBOX' OR 
                jenis='STB Tambahan' OR jenis='Indihome 2P to 3P' OR jenis='Home Wifi'
                )
            AND DATE(tgl) = '$date'
        "
            );
        }
        $result = $query->result_array();
        $data['data_consume'] = count($result);
        $data['contacted'] = count($this->filter_by_value($result, 'status', 'Contacted'));
        $data['contacted_rate'] = number_format((($data['contacted'] / ($data['data_consume'])) * 100), 2);
        $data['agree'] = $this->filter_by_value($result, 'kategori', 'Agree');
        $data['agree'] = count($this->filter_by_value($data['agree'], 'input', 'New'));
        $data['agree_rate'] = number_format((($data['agree'] / ($data['contacted'])) * 100), 2);

        if (isset($_GET['site']) && $_GET['site'] != 'All') {
            $query = $this->users_extended->live_query(
                "SELECT
            d.status,d.jenis,d.tgl,d.input,kategori
        FROM
            app_tam_data2 AS d
            JOIN cc147_main_users_extended AS u ON u.user1 = d.login
        WHERE
                u.user5 = '" . $_GET['site'] . "'
             AND (
                d.jenis='Upgrade Indihome' OR d.jenis='Mini Pack' OR d.jenis='IndiBOX' OR 
                d.jenis='STB Tambahan' OR d.jenis='Indihome 2P to 3P' OR d.jenis='Home Wifi'
                )
            AND DATE(d.tgl) = '$date'
            GROUP BY d.login
        "
            );
        } else {
            $query = $this->users_extended->live_query(
                "SELECT
            d.status,jenis,tgl,input,kategori
        FROM
            app_tam_data2 AS d
        WHERE
             (
                jenis='Upgrade Indihome' OR jenis='Mini Pack' OR jenis='IndiBOX' OR 
                jenis='STB Tambahan' OR jenis='Indihome 2P to 3P' OR jenis='Home Wifi'
                )
            AND DATE(tgl) = '$date'
            GROUP BY d.login
        "
            );
        }
        $data['agent_online'] = $query->num_rows();
        $date_approve = date("Y-m-d", strtotime('-1 days'));
        // $date_approve = date("2020-02-25", strtotime('-1 days'));
        if (isset($_GET['site']) && $_GET['site'] != 'All') {
            $query = $this->users_extended->live_query(
                "SELECT
     d.status,d.jenis,d.tgl,d.input,d.kategori
 FROM
     app_tam_data2 AS d
     JOIN cc147_main_users_extended AS u ON u.user1 = d.login
        WHERE
                u.user5 = '" . $_GET['site'] . "'
     AND
     (
         d.jenis='Upgrade Indihome' OR d.jenis='Mini Pack' OR d.jenis='IndiBOX' OR 
         d.jenis='STB Tambahan' OR d.jenis='Indihome 2P to 3P' OR d.jenis='Home Wifi'
         )
     AND d.valid = 'Valid'
     AND DATE(d.tgl) = '$date_approve'
 "
            );
        } else {
            $query = $this->users_extended->live_query(
                "SELECT
     d.status,jenis,tgl,input,kategori
 FROM
     app_tam_data2 AS d
 WHERE
     (
         jenis='Upgrade Indihome' OR jenis='Mini Pack' OR jenis='IndiBOX' OR 
         jenis='STB Tambahan' OR jenis='Indihome 2P to 3P' OR jenis='Home Wifi'
         )
     AND d.valid = 'Valid'
     AND DATE(tgl) = '$date_approve'
 "
            );
        }
        $d_approve = $query->result_array();
        $data['approve'] = count($d_approve);
        if (isset($_GET['site']) && $_GET['site'] != 'All') {
            $query = $this->users_extended->live_query(
                "SELECT
     d.*
 FROM
     app_tam_data2 AS d
     JOIN cc147_main_users_extended AS u ON u.user1 = d.login
 WHERE
    u.user5 = '" . $_GET['site'] . "' AND
      d.kategori = 'Agree'
     AND d.input = 'New'
     AND (
         d.jenis='Upgrade Indihome' OR d.jenis='Mini Pack' OR d.jenis='IndiBOX' OR 
         d.jenis='STB Tambahan' OR d.jenis='Indihome 2P to 3P' OR d.jenis='Home Wifi'
         )
     AND DATE(tgl) = '$date_approve'
 "
            );
        } else {
            $query = $this->users_extended->live_query(
                "SELECT
     *
 FROM
     app_tam_data2 AS d
 WHERE
      d.kategori = 'Agree'
     AND d.input = 'New'
     AND (
         jenis='Upgrade Indihome' OR jenis='Mini Pack' OR jenis='IndiBOX' OR 
         jenis='STB Tambahan' OR jenis='Indihome 2P to 3P' OR jenis='Home Wifi'
         )
     AND DATE(tgl) = '$date_approve'
 "
            );
        }
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
        $date = date('Y-m-d');
        // $date = date('2020-02-26');
        $query = $this->users_extended->live_query(
            "SELECT sum(d.jml) as jml_approve,regional,jenis FROM report_cache_tam as d
            WHERE       
         d.date = '$date' GROUP BY regional,jenis
        "
        );
        $data_reg = $query->result_array();

        if (count($data_reg) > 0) {
            foreach ($data_reg as $dt) {
                $data_r['regional'][$dt['regional']][$dt['jenis']] = $dt['jml_approve'];
            }
        }

        $romawi = array(0 => "I", 1 => "II", 2 => "III", 3 => "IV", 4 => "V", 5 => "VI", 6 => "VII");
        $rule = array(0 => "Upgrade Indihome", 1 => "Mini Pack", 2 => "IndiBOX", 3 => "STB Tambahan", 4 => "Indihome 2P to 3P", 5 => "Home Wifi");

        for ($rl = 0; $rl < 7; $rl++) {
            for ($r2 = 0; $r2 < 6; $r2++) {
                if (isset($data_r['regional'][$romawi[$rl]][$rule[$r2]])) {
                    $data['regional'][$rl][$r2] = $data_r['regional'][$romawi[$rl]][$rule[$r2]];
                } else {
                    $data['regional'][$rl][$r2] = 0;
                }
            }
        }

        echo json_encode($data);
    }
    public function get_data_site()
    {
        $date = date('Y-m-d');
        $date1 = date('Y-m-') . '01';
        $date2 = date('Y-m-d');
        // $date = date('2020-02-26');
        $query = $this->users_extended->live_query(
            "SELECT sum(d.jml) as jml_approve,jenis,u.user5 as user5 FROM report_cache_tam as d
            JOIN cc147_main_users_extended AS u ON u.user1 = d.login
            WHERE       
            -- d.date >= '$date1' AND d.date <= '$date2'
            d.date = '$date'
          GROUP BY user5,jenis
        "
        );
        $data_reg = $query->result_array();

        if (count($data_reg) > 0) {
            foreach ($data_reg as $dt) {
                $data_q['site'][$dt['user5']][$dt['jenis']] = $dt['jml_approve'];
            }
        }
        $romawi = array(0 => "CW", 1 => "BSD", 2 => "MEDAN", 3 => "BANDUNG", 4 => "Semarang", 5 => "Malang", 6 => "Makassar");
        $rule = array(0 => "Upgrade Indihome", 1 => "Mini Pack", 2 => "IndiBOX", 3 => "STB Tambahan", 4 => "Indihome 2P to 3P", 5 => "Home Wifi");

        for ($rl = 0; $rl < 7; $rl++) {
            for ($r2 = 0; $r2 < 6; $r2++) {
                if ($data_q['site'][$romawi[$rl]][$rule[$r2]] > 0) {
                    $data['site'][$rl][$r2] = $data_q['site'][$romawi[$rl]][$rule[$r2]];
                } else {
                    $data['site'][$rl][$r2] = 0;
                }
            }
        }

        echo json_encode($data);
    }
    public function get_data_grafik()
    {
        $rule = array("Upgrade Indihome", "Mini Pack", "IndiBOX", "STB Tambahan", "Indihome 2P to 3P", "Home Wifi");

        for ($r2 = 0; $r2 < 6; $r2++) {
            $v = $rule[$r2];
            for ($i = 0; $i <= 31; $i++) {
                $date2 = date('Y-m-' . sprintf("%02d", $i + 1));
                $data_q = 0;
                if (isset($_GET['site']) && $_GET['site'] != 'All') {

                    $query = $this->users_extended->live_query(
                        "select sum(d.jml) as jumlah_data 
                    FROM report_cache_tam AS d 
                    JOIN cc147_main_users_extended AS u ON u.user1 = d.login
                    WHERE
                    u.user5 = '" . $_GET['site'] . "' AND
                    d.date = '$date2' AND d.jenis='$v' "
                    );
                } else {

                    $query = $this->users_extended->live_query(
                        "select sum(d.jml) as jumlah_data FROM report_cache_tam AS d WHERE d.date = '$date2' AND d.jenis='$v' "
                    );
                }
                $data_q = $query->row_array();
                if ($data_q['jumlah_data'] > 0) {
                    $data['grafik'][$rule[$r2]][$i] = (int) $data_q['jumlah_data'];
                } else {
                    $data['grafik'][$rule[$r2]][$i] = 0;
                }
            }
        }

        echo json_encode($data);
    }
    function get_revenue()
    {
        $date1 = date('Y-m-') . '01';
        $date2 = date('Y-m-t');
        $date = date('Y-m-d');
        if (isset($_GET['site']) && $_GET['site'] != 'All') {
            $query_md = $this->users_extended->live_query(
                "SELECT
     sum(d.add_on_tsel) as revenue
 FROM
     app_tam_data2 AS d
     JOIN cc147_main_users_extended AS u ON u.user1 = d.login
 WHERE
        u.user5 = '" . $_GET['site'] . "' AND
     (
         d.jenis='Upgrade Indihome' OR d.jenis='Mini Pack' OR d.jenis='IndiBOX' OR 
         d.jenis='STB Tambahan' OR d.jenis='Indihome 2P to 3P' OR d.jenis='Home Wifi'
         )
         AND d.valid='Valid'
     AND DATE(d.tgl) >= '$date1' AND DATE(d.tgl) <= '$date2'
 "
            );
        } else {
            $query_md = $this->users_extended->live_query(
                "SELECT
     sum(d.add_on_tsel) as revenue
 FROM
     app_tam_data2 AS d
 WHERE
     (
         d.jenis='Upgrade Indihome' OR d.jenis='Mini Pack' OR d.jenis='IndiBOX' OR 
         d.jenis='STB Tambahan' OR d.jenis='Indihome 2P to 3P' OR d.jenis='Home Wifi'
         )
         AND d.valid='Valid'
     AND DATE(d.tgl) >= '$date1' AND DATE(d.tgl) <= '$date2'
 "
            );
        }
        $data['revenue_md'] = number_format($query_md->row_array()['revenue']);
        if (isset($_GET['site']) && $_GET['site'] != 'All') {

            $query_d = $this->users_extended->live_query(
                "SELECT
     sum(d.add_on_tsel) as revenue
 FROM
     app_tam_data2 AS d
     JOIN cc147_main_users_extended AS u ON u.user1 = d.login
 WHERE
        u.user5 = '" . $_GET['site'] . "' AND
     (
         d.jenis='Upgrade Indihome' OR d.jenis='Mini Pack' OR d.jenis='IndiBOX' OR 
         d.jenis='STB Tambahan' OR d.jenis='Indihome 2P to 3P' OR d.jenis='Home Wifi'
         )
         AND d.valid='Valid'
     AND DATE(d.tgl) = '$date'
 "
            );
        } else {
            $query_d = $this->users_extended->live_query(
                "SELECT
     sum(d.add_on_tsel) as revenue
 FROM
     app_tam_data2 AS d
 WHERE
     (
         d.jenis='Upgrade Indihome' OR d.jenis='Mini Pack' OR d.jenis='IndiBOX' OR 
         d.jenis='STB Tambahan' OR d.jenis='Indihome 2P to 3P' OR d.jenis='Home Wifi'
         )
         AND d.valid='Valid'
     AND DATE(d.tgl) = '$date'
 "
            );
        }
        $data['revenue_d'] = number_format($query_d->row_array()['revenue']);
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
