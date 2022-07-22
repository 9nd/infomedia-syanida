<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_v2
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
        $this->load->model('Custom_model/Layanan_moss_model', 'layanan_moss');
        $this->load->model('Custom_model/T_produk_moss_model', 'product_moss');
        $this->load->model('Custom_model/Indibox_forcall_3p_model', 'indibox_forcall_3p');
    }
    function get_daily_performance_reg()
    {
        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);

        $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $where_agent = array("opt_level" => 8, "kategori" => "REG", 'tl !=' => "-");
        if ($userdata->opt_level < 8) {
            $where_agent = array("opt_level" => 8, "kategori" => "REG");
        }

        $now = date('Y-m-d');
        $data['agent'] = $this->sys_user->get_results($where_agent, array("nama,agentid"));

        $start = date('Y-m-d');
        $end = date('Y-m-d');
        $start = $now;
        $start = $_GET['start'];
        $end = $_GET['end'];
        if ($_GET['start']) {

            $query_trans_profiling_verifikasi = $this->trans_profiling->live_query(
                "SELECT veri_upd FROM trans_profiling
                    WHERE DATE(lup) >= '$start' AND DATE(lup) <= '$end'  AND veri_call=13
                "
            );
        } else {

            $start = date('Y-m-d');
            $query_trans_profiling_verifikasi = $this->trans_profiling_daily->live_query(
                "SELECT veri_upd FROM trans_profiling_daily 
                    WHERE DATE(lup) = '$start' AND veri_call=13
                "
            );
        }




        $data_verified = $query_trans_profiling_verifikasi->result_array();
        $value_agent = array();
        if ($data['agent']['num'] > 0) {
            foreach ($data['agent']['results'] as $ag) {
                $value_agent[$ag->agentid] = count($this->filter_by_value($data_verified, 'veri_upd', $ag->agentid));
                // $value_agent[$ag->agentid]=count($this->filter_by_value($data_verified, 'veri_upd', $ag->agentid));
            }
        }

        arsort($value_agent);
        $rating_agent = array_slice($value_agent, 0, 6);
        $n = 1;
        foreach ($rating_agent as $k => $v) {
            // echo $k."<br>";
            $json['agent'][$n] = $this->sys_user->get_row_array(array("agentid" => $k));
            $json['agent'][$n]['picture'] = $json['agent'][$n]['picture'];
            $json['agent'][$n]['num'] = $v;
            $n++;
        }
        // echo $json;
        echo json_encode($json);
    }

    function get_profiling_reguler()
    {
        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);

        $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $where_agent = array("opt_level" => 8, "kategori" => "REG", 'tl !=' => "-");
        if ($userdata->opt_level < 8) {
            $where_agent = array("opt_level" => 8, "kategori" => "REG");
        }


        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $agent = $this->sys_user->get_results($where_agent, array("nama,agentid,picture"));
        $start = $_GET['start'];
        $end = $_GET['end'];
        $tabel = "trans_profiling_daily";
        if (isset($_GET['start'])) {
            $start = $_GET['start'];
            if ($start != date('Y-m-d')) {
                $tabel = "trans_profiling";
            }
        } else {
            $start = date('Y-m-d');
            $tabel = "trans_profiling_daily";
        }
        $call_order = $this->report_cache->get_sum(array('date' => $start), "total_order_call");
        if ($_GET['start']) {
            $query_trans_profiling = $this->$tabel->live_query(
                "SELECT * FROM $tabel  WHERE  DATE_FORMAT(lup ,'%Y-%m-%d') >= '$start' AND DATE_FORMAT(lup ,'%Y-%m-%d') <= '$end' "

            );
        } else {

            $start = date('Y-m-d');

            $query_trans_profiling = $this->$tabel->live_query(
                "
                SELECT * FROM $tabel WHERE DATE(lup) = '" . $start . "' "

            );
        }


        // $q_wo = $this->trans_profiling->live_query(
        //     "SELECT
        //     count(*) as num_wo
        // FROM
        //     dbprofile_validate_forcall_3p
        // WHERE
        //     (
        //         update_by IS NOT NULL
        //         AND update_by != 'BARU'
        // AND update_by != 'baru'
        //         AND update_by != ''
        //     )
        // AND ISNULL(lup) "

        // );
        // $r_wo = $q_wo->row_array();
        $wo = 325364;
        $no = 1;
        $total = array();
        $total['contacted'] = 0;
        $total['uncontacted'] = 0;
        $agent_online = 0;
        for ($i = 1; $i < 16; $i++) {
            $total[$i] = 0;
        }
        $best_agent = array();
        $rating_ag = array();
        if ($agent['num'] > 0) {
            $sub_total_contacted = 0;
            $sub_total_uncontacted = 0;
            foreach ($agent['results'] as $ag) {
                $data_agent = $this->filter_by_value($query_trans_profiling->result_array(), 'veri_upd', $ag->agentid);
                // $verified = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
                //  $verified = $this->filter_by_value(array(), 'update_by', $ag->agentid);
                $verified = $this->filter_by_value($data_agent, 'veri_call', '13');
                $opsi['opsi_1'] = count($this->filter_by_value($data_agent, 'opsi_call', '1')) + $opsi['opsi_1'];
                $opsi['opsi_2'] = count($this->filter_by_value($data_agent, 'opsi_call', '2')) + $opsi['opsi_2'];
                $opsi['opsi_3'] = count($this->filter_by_value($data_agent, 'opsi_call', '3')) + $opsi['opsi_3'];
                $opsi['opsi_4'] = count($this->filter_by_value($data_agent, 'opsi_call', '4')) + $opsi['opsi_4'];
                $opsi['opsi_5'] = count($this->filter_by_value($data_agent, 'opsi_call', '5')) + $opsi['opsi_5'];
                $rating_ag[$ag->agentid] = count($verified);
                $best_agent[$ag->agentid]['val'] = count($verified);
                $best_agent[$ag->agentid]['numna'] = count($verified) . " Verified";
                $best_agent[$ag->agentid]['picture'] = $ag->picture;
                $jk['l'] = count($this->filter_by_value_jk($verified, 'veri_keterangan', 'L')) + $jk['l'];
                $jk['p'] = count($this->filter_by_value_jk($verified, 'veri_keterangan', 'P')) + $jk['p'];
                for ($r = 1; $r <= 7; $r++) {
                    $platinum_billing = $this->filter_by_value_param($verified, 'billing', 'platinum');
                    $platinum = $this->filter_by_value_date($platinum_billing, 'waktu_psb', 3, '>=');
                    $regional['platinum']['reg_' . $r] = count($this->filter_by_regional($platinum, 'no_speedy', $r)) + $regional['platinum']['reg_' . $r];

                    $silver_billing = $this->filter_by_value_param($verified, 'billing', 'silver');
                    $silver = $this->filter_by_value_date($silver_billing, 'waktu_psb', 18, '>=');
                    $regional['silver']['reg_' . $r] = count($this->filter_by_regional($silver, 'no_speedy', $r)) + $regional['silver']['reg_' . $r];

                    $gold_billing = $this->filter_by_value_param($verified, 'billing', 'gold');
                    $gold = $this->filter_by_value_date($gold_billing, 'waktu_psb', 18, '>');
                    $regional['gold']['reg_' . $r] = count($this->filter_by_regional($gold, 'no_speedy', $r)) + $regional['gold']['reg_' . $r];

                    $bronze_billing = $this->filter_by_value_param($verified, 'billing', 'bronze');
                    $bronze = $this->filter_by_value_date($bronze_billing, 'waktu_psb', 18, '<=');
                    $regional['bronze']['reg_' . $r] = count($this->filter_by_regional($bronze, 'no_speedy', $r)) + $regional['bronze']['reg_' . $r];
                }
                $payment = $this->filter_by_value($data_agent, 'veri_call', '13');


                $status_1 = count($this->filter_by_value($data_agent, 'veri_call', '1'));
                $status_3 = count($this->filter_by_value($data_agent, 'veri_call', '3'));
                $status_12 = count($this->filter_by_value($data_agent, 'veri_call', '12'));
                $status_2 = count($this->filter_by_value($data_agent, 'veri_call', '2'));
                $status_4 = count($this->filter_by_value($data_agent, 'veri_call', '4'));
                $status_7 = count($this->filter_by_value($data_agent, 'veri_call', '7'));
                $status_11 = count($this->filter_by_value($data_agent, 'veri_call', '11'));
                $status_10 = count($this->filter_by_value($data_agent, 'veri_call', '10'));
                $status_14 = count($this->filter_by_value($data_agent, 'veri_call', '14'));
                $status_8 = count($this->filter_by_value($data_agent, 'veri_call', '8'));
                $status_9 = count($this->filter_by_value($data_agent, 'veri_call', '9'));
                $status_15 = count($this->filter_by_value($data_agent, 'veri_call', '15'));
                $sub_total_contacted = $status_1 + count($verified) + $status_3 + $status_12 + $status_11;
                $sub_total_uncontacted = $status_15 + $status_9 + $status_8 + $status_4 + $status_7 + $status_10 + $status_14 + $status_2;
                $total['contacted'] = $total['contacted'] + $sub_total_contacted;
                $total['uncontacted'] = $total['uncontacted'] + $sub_total_uncontacted;
                $hp_email = $this->filter_by_hp_email($verified, array("handphone", "email"), array("08", "@"));
                $hp_only = $this->filter_by_hp_only($verified, array("handphone", "email"), array("08", "@"));
                $total['hp_email'] = $total['hp_email'] + count($hp_email);
                $total['hp_only'] = $total['hp_only'] + count($hp_only);
                $total[1] = $status_1 + $total[1];
                $total[2] = $status_2 + $total[2];
                $total[3] = $status_3 + $total[3];
                $total[4] = $status_4 + $total[4];
                $total[5] = $status_5 + $total[5];
                $total[6] = $status_6 + $total[6];
                $total[7] = $status_7 + $total[7];
                $total[8] = $status_8 + $total[8];
                $total[9] = $status_9 + $total[9];
                $total[10] = $status_10 + $total[10];
                $total[11] = $status_11 + $total[11];
                $total[12] = $status_12 + $total[12];
                $total[13] = count($verified) + $total[13];
                $total[14] = $status_14 + $total[14];
                $total[15] = $status_15 + $total[15];
                $total[16] = $status_16 + $total[16];
                $no++;
                if (($sub_total_contacted + $sub_total_uncontacted) > 0) {
                    $agent_online = $agent_online + 1;
                }
            }
        }
        $value_not = array('not_15' => $total[15], 'not_8' => $total[8], 'not_9' => $total[9], 'not_4' => $total[4], 'not_7' => $total[7],  'not_10' => $total[10], 'not_14' => $total[14], 'not_2' => $total[2]);
        arsort($value_not);
        $not = array(
            'not_4' => "Salah Sambung",
            'not_7' => "Isolir",
            // 'not_11' => "Decline",
            'not_10' => "Rejected",
            'not_14' => "Reject By System",
            'not_8' => "Mailbox",
            'not_9' => "Telepon Sibuk",
            'not_15' => "Cabut",
            'not_2' => "RNA"
        );
        $rating_not = array_slice($value_not, 0, 3);
        $rt = 0;
        $rate3 = 0;
        foreach ($rating_not as $idna => $valna) {
            $total['not']['urut_' . $rt]['valna'] = number_format($valna);
            $total['not']['urut_' . $rt]['textna'] = $not[$idna];
            $rate3 = $rate3 + $valna;
            $rt++;
        }
        $total['not']['other'] = $total['uncontacted'] - $rate3;
        $total['convention_rate'] = number_format(($total['13'] / ($total['contacted'])) * 100);
        $total['hp_email_rate'] = number_format((($total['hp_email'] / $total['13']) * 100), 2);
        $total['hp_only_rate'] = number_format((($total['hp_only'] / $total['13']) * 100), 2);
        for ($i = 1; $i < 16; $i++) {
            $total['status_' . $i] = number_format($total[$i]);
        }

        // printing result in days format 
        $total['wo'] = number_format($wo);


        $total['contacted_rate'] = number_format(($total['contacted'] / ($total['uncontacted'] + $total['contacted'])) * 100);
        $total['uncontacted_rate'] = number_format(($total['uncontacted'] / ($total['uncontacted'] + $total['contacted'])) * 100);

        $total['callorder'] = number_format($total['uncontacted'] + $total['contacted']);
        $total['contacted'] = number_format($total['contacted']);
        $total['uncontacted'] = number_format($total['uncontacted']);

        $total['hp_email'] = number_format($total['hp_email']);
        $total['hp_only'] = number_format($total['hp_only']);
        if ($agent_online < 0) {
            $agent_online = 0;
        }
        $total['agent_online'] = $agent_online;

        $total['regional'] = $regional;
        $jk['total'] = $jk['l'] + $jk['p'];
        $jk['l'] = number_format((($jk['l'] / $jk['total']) * 100), 2) . "%";
        $jk['p'] = number_format((($jk['p'] / $jk['total']) * 100), 2) . "%";
        $total['jk'] = $jk;


        $opsi['total'] = $opsi['opsi_1'] + $opsi['opsi_2'] + $opsi['opsi_3'] + $opsi['opsi_4']+ $opsi['opsi_5'];
        $opsi['opsi_1'] = number_format((($opsi['opsi_1'] / $opsi['total']) * 100), 2) . "%";
        $opsi['opsi_2'] = number_format((($opsi['opsi_2'] / $opsi['total']) * 100), 2) . "%";
        $opsi['opsi_3'] = number_format((($opsi['opsi_3'] / $opsi['total']) * 100), 2) . "%";
        $opsi['opsi_4'] = number_format((($opsi['opsi_4'] / $opsi['total']) * 100), 2) . "%";
        $opsi['opsi_5'] = number_format((($opsi['opsi_5'] / $opsi['total']) * 100), 2) . "%";
        $total['opsi'] = $opsi;

        arsort($rating_ag);
        $rating_agent = array_slice($rating_ag, 0, 3);
        $n = 1;
        foreach ($rating_agent as $k => $v) {
            // echo $k."<br>";
            $json['picture_' . $n] = $best_agent[$k]['picture'];
            $json['numna_' . $n] = number_format($v);
            $n++;
        }
        $total['best_agent'] = $json;
        $query_dapros = $this->trans_profiling->live_query(
            "SELECT count(*) as jumlah_data FROM dbprofile_validate_forcall_3p WHERE
            (ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '')
            AND (ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '') AND
         status = 0 
            "
        );
        $data_dapros = $query_dapros->row_array();
        $total['dapros'] = number_format($data_dapros['jumlah_data'] + $wo);
        echo json_encode($total);
    }
    function get_payment()
    {
        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);

        $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $where_agent = array("opt_level" => 8, "kategori" => "REG", 'tl !=' => "-");
        if ($userdata->opt_level < 8) {
            $where_agent = array("opt_level" => 8, "kategori" => "REG");
        }


        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $agent = $this->sys_user->get_results($where_agent, array("nama,agentid,picture"));
        $start = $_GET['start'];
        $end = $_GET['end'];
        $start = date('Y-m-d');
        $tabel = "trans_profiling_daily";
        if (isset($_GET['start'])) {
            $start = $_GET['start'];
            if ($start != date('Y-m-d')) {
                $tabel = "trans_profiling";
            }
        } else {
            $start = date('Y-m-d');
            $tabel = "trans_profiling_daily";
        }
        $data['query_payment'] = $this->$tabel->live_query(
            "SELECT
            payment,COUNT(*) as num
            FROM
            $tabel 
            WHERE
              
            date(lup) = '$start'
            AND veri_call='13'
            
            GROUP BY
            payment
              "
        )->result();
        $total['status_payment'] = array(
            'Banking - CR' => 0,
            'Banking - DB' => 0,
            'ecommerce' => 0,
            'minimarket' => 0,
            'telkom dan pos' => 0,
            'psb' => 0,
            'others' => 0,
        );
        if (count($data['query_payment']) > 0) {
            foreach ($data['query_payment'] as $payment) {
                $total['status_payment'][$payment->payment] = $payment->num;
            }
        }
        $total['payment']['bank'] = $total['status_payment']['Banking - CR'] + $total['status_payment']['Banking - DB'];
        $total['payment']['ecommerce'] = $total['status_payment']['ecommerce'];
        $total['payment']['minimarket'] = $total['status_payment']['minimarket'];
        $total['payment']['office'] = $total['status_payment']['telkom dan pos'];
        $total['payment']['psb'] = $total['status_payment']['psb'];
        $total['payment']['others'] = $total['status_payment']['others'];
        echo json_encode($total);
    }
    function get_grafik_verified()
    {
        // $data['controller'] = $this;
        // $start_filter = date('Y-m-d');
        $now = date('Y-m-d');
        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);

        $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $where_agent = array("opt_level" => 8, "kategori" => "REG", 'tl !=' => "-");
        if ($userdata->opt_level < 8) {
            $where_agent = array("opt_level" => 8, "kategori" => "REG");
        }

        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        // $json = file_get_contents('http://10.194.194.61/dashboard/data/get_data_callorder.php');
        // $data_json = json_decode($json);
        // $call_order = $data_json->result[0]->callorder;
        // $call_order = $this->report_cache->get_sum(array("date" => date('Y-m-d')), "total_order_call");
        $agent = $this->sys_user->get_results($where_agent, array("nama,agentid"));
        $start = date('Y-m-d');
        $end = date('Y-m-d');
        $call_order = $this->report_cache->get_sum(array('date' => $start), "total_order_call");

        $start = $now;
        $start = $_GET['start'];
        $end = $_GET['end'];
        if ($_GET['start']) {

            $query_trans_profiling = $this->trans_profiling->live_query(
                "SELECT veri_call,veri_upd,handphone,email,HOUR(lup) as hour_lup FROM trans_profiling WHERE DATE(lup) >= '$start' AND DATE(lup) <= '$end' "

            );
        } else {

            $start = date('Y-m-d');
            $query_trans_profiling = $this->trans_profiling_daily->live_query(
                "SELECT veri_call,veri_upd,handphone,email,HOUR(lup) as hour_lup FROM trans_profiling_daily WHERE DATE(lup) = '" . $start . "' "
            );
        }



        $no = 1;
        $total = array();
        for ($i = 0; $i <= 20; $i++) {
            $total['data']['Verified'][$i] = 0;
        }
        foreach ($query_trans_profiling->result_array() as $th) {
            for ($i = 0; $i <= 20; $i++) {
                if ($th['veri_call'] == 13) {
                    if ($th['hour_lup'] == $i + 7) {
                        $total['data']['Verified'][$i] = $total['data']['Verified'][$i] + 1;
                    }
                }
            }
        }


        echo json_encode($total);
    }
    function get_grafik_verified_custom()
    {
        // $data['controller'] = $this;
        // $start_filter = date('Y-m-d');
        // $now = date('Y-m-d');
        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);

        $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $where_agent = array("opt_level" => 8, "kategori" => "REG", 'tl !=' => "-");
        if ($userdata->opt_level < 8) {
            $where_agent = array("opt_level" => 8, "kategori" => "REG");
        }

        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        // $json = file_get_contents('http://10.194.194.61/dashboard/data/get_data_callorder.php');
        // $data_json = json_decode($json);
        // $call_order = $data_json->result[0]->callorder;
        // $call_order = $this->report_cache->get_sum(array("date" => date('Y-m-d')), "total_order_call");
        $agent = $this->sys_user->get_results($where_agent, array("nama,agentid"));
        $start = $_GET['start'];
        $end = $_GET['end'];
        if ($start == date('Y-m-d') && $end == date('Y-m-d')) {
            $call_order = $this->report_cache->get_sum(array('date' => $start), "total_order_call");
            $query_trans_profiling = $this->trans_profiling->live_query(
                "SELECT count(*) as jumlah,DAY(lup) as day_lup FROM trans_profiling_verifikasi WHERE DATE(lup) = '" . $start . "' GROUP BY day_lup"

            );
        } else {
            $query_trans_profiling = $this->trans_profiling->live_query(
                "SELECT count(*) as jumlah,DAY(lup) as day_lup FROM trans_profiling_verifikasi WHERE DATE(lup) >= '" . $start . "' AND DATE(lup) <= '" . $end . "' GROUP BY day_lup"
            );
        }

        $no = 1;
        $total = array();
        for ($i = 0; $i <= 31; $i++) {
            $total['data']['Verified'][$i] = 0;
        }
        foreach ($query_trans_profiling->result_array() as $th) {
            for ($i = 0; $i <= 31; $i++) {
                if ($th['day_lup'] == $i) {
                    $total['data']['Verified'][$i] = (int) $th['jumlah'];
                }
            }
        }


        echo json_encode($total);
    }
    function get_best_agent_moss()
    {
        // $data['controller'] = $this;
        // $start_filter = date('Y-m-d');
        $now = date("Y-m", strtotime("-1 months"));
        $tahun = date("Y", strtotime("-1 months"));
        $bulan = date("m", strtotime("-1 months"));
        $where_agent = array("opt_level" => 8, "kategori" => "MOS", 'tl !=' => "-");

        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        ///check report cache
        $report_cache_count = $this->monthly_report->get_count(array("tahun" => $tahun, "bulan" => $bulan, "best_agent_moss !=" => NULL, "best_teamleader_moss !=" => NULL, "best_agent_moss !=" => "", "best_teamleader_moss !=" => ""));
        if ($report_cache_count == 0) {
            $tl = $this->sys_user->get_results(array("opt_level" => 9), array("nama,agentid"));
            $data_tl = array();
            $num_tl = array();
            if ($tl['num'] > 0) {
                foreach ($tl['results'] as $tdata) {
                    $data_tl[$tdata->agentid] = 0;
                    $num_tl[$tdata->agentid] = 0;
                }
            }
            $agent = $this->sys_user->get_results($where_agent, array("nama,agentid,tl"));
            $query_trans_profiling = $this->trans_profiling->live_query(
                "SELECT update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg  FROM trans_profiling_validasi_mos 
             WHERE DATE_FORMAT(lup ,'%Y-%m') = '$now' 
            "
            );
            // $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
            //     "SELECT update_by,no_handpone,email FROM trans_profiling_verifikasi 
            //      WHERE DATE_FORMAT(lup ,'%Y-%m-%d') = '$now' 
            //     "
            // );
            $data_profiling = $query_trans_profiling->result_array();
            $value_agent = array();
            if ($agent['num'] > 0) {
                foreach ($agent['results'] as $ag) {

                    $data_agent = $this->filter_by_value($data_profiling, 'update_by', $ag->agentid);
                    if (count($data_agent) > 0) {
                        $value_agent[$ag->agentid] = (array_sum(array_column($data_agent, 'slg')) / count($data_agent)) / 60;

                        if ($ag->tl != "") {
                            $data_tl[$ag->tl] = $data_tl[$ag->tl] + $value_agent[$ag->agentid];
                            $num_tl[$ag->tl] = $num_tl[$ag->tl] + 1;
                        }
                    }
                }
            }
            if ($tl['num'] > 0) {
                foreach ($tl['results'] as $tdata) {
                    if ($data_tl[$tdata->agentid] > 0 && $num_tl[$tdata->agentid]) {
                        $value_tl[$tdata->agentid] = $data_tl[$tdata->agentid] / $num_tl[$tdata->agentid];
                        // echo $value_tl[$tdata->agentid]."<br>";
                    }
                }
            }
            asort($value_tl);
            asort($value_agent);
            $rating_agent = array_slice($value_agent, 0, 1);
            $rating_tl = array_slice($value_tl, 0, 1);
            $n = 1;
            foreach ($rating_agent as $k => $v) {
                // echo $k."<br>";
                $json['agent'][$n] = $this->sys_user->get_row_array(array("agentid" => $k));
                $json['agent'][$n]['picture'] = $json['agent'][$n]['picture'];
                $json['agent'][$n]['num'] = number_format($v, 2);
                $this->monthly_report->edit(array("tahun" => $tahun, "bulan" => $bulan), array("best_agent_moss" => $k, "slg_best_agent_moss" => $v));
                $n++;
            }
            $n = 1;
            foreach ($rating_tl as $k => $v) {
                // echo $k."<br>";
                $json['tl'][$n] = $this->sys_user->get_row_array(array("agentid" => $k));
                $json['tl'][$n]['picture'] = $json['tl'][$n]['picture'];
                $json['tl'][$n]['num'] = number_format($v, 2);
                $this->monthly_report->edit(array("tahun" => $tahun, "bulan" => $bulan), array("best_teamleader_moss" => $k, "slg_best_teamleader_moss" => $v));
                $n++;
            }
        } else {
            $report_cache_data = $this->monthly_report->get_row(array("tahun" => $tahun, "bulan" => $bulan));
            $json['agent'][1] = $this->sys_user->get_row_array(array("agentid" => $report_cache_data->best_agent_moss));
            $json['agent'][1]['picture'] = $json['agent'][1]['picture'];
            $json['agent'][1]['num'] = number_format($report_cache_data->slg_best_agent_moss, 2);
            $json['tl'][1] = $this->sys_user->get_row_array(array("agentid" => $report_cache_data->best_teamleader_moss));
            $json['tl'][1]['picture'] = $json['tl'][1]['picture'];
            $json['tl'][1]['num'] = number_format($report_cache_data->slg_best_teamleader_moss, 2);
        }


        echo json_encode($json);
    }
    function get_grafik_moss()
    {
        // $data['controller'] = $this;
        // $start_filter = date('Y-m-d');
        $now = date('Y-m-d');

        $where_agent = array("opt_level" => 8);

        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        // $json = file_get_contents('http://10.194.194.61/dashboard/data/get_data_callorder.php');
        // $data_json = json_decode($json);
        // $call_order = $data_json->result[0]->callorder;
        $call_order = $this->report_cache->get_sum(array("date" => date('Y-m-d')), "total_order_call");
        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);

        $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $start = $_GET['start'];
        $end = $_GET['end'];
        if ($start == $end) {

            $query_trans_profiling = $this->trans_profiling_verifikasi->live_query(
                "SELECT update_by,no_handpone,email,reason_call,HOUR(lup) as hour_lup, HOUR(tgl_insert) as hour_insert FROM trans_profiling_validasi_mos 
                WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') = '$start' 
                "
            );
        } else {
            $query_trans_profiling = $this->trans_profiling_verifikasi->live_query(
                "SELECT update_by,no_handpone,email,reason_call,HOUR(lup) as hour_lup, HOUR(tgl_insert) as hour_insert FROM trans_profiling_validasi_mos 
                WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') >= '$start' AND DATE_FORMAT(tgl_insert ,'%Y-%m-%d') <= '$end'
                "
            );
        }
        $no = 1;
        $total = array();
        for ($i = 0; $i <= 23; $i++) {
            $total['data']['Verified'][$i] = 0;
            $total['data']['Waiting'][$i] = 0;
            $total['data']['Not Contacted'][$i] = 0;
        }
        foreach ($query_trans_profiling->result_array() as $th) {
            for ($i = 0; $i <= 23; $i++) {
                if ($th['reason_call'] == 13) {
                    if ($th['hour_lup'] == $i) {
                        $total['data']['Verified'][$i] = $total['data']['Verified'][$i] + 1;
                    }
                }
                // if ($th['reason_call'] == 15 || $th['reason_call'] == 9 || $th['reason_call'] == 8 || $th['reason_call'] == 4 || $th['reason_call'] == 7 || $th['reason_call'] == 11 || $th['reason_call'] == 10 || $th['reason_call'] == 14 || $th['reason_call'] == 2) {
                //     if ($th['hour_lup'] == $i) {
                //         $total['data']['Not Contacted'][$i] = $total['data']['Not Contacted'][$i] + 1;
                //     }
                // }
                if ($th['hour_lup'] == $i) {
                    $total['data']['Waiting'][$i] = $total['data']['Waiting'][$i] + 1;
                }
            }
        }


        echo json_encode($total);
    }
    function get_best_agent()
    {
        // $data['controller'] = $this;
        // $start_filter = date('Y-m-d');

        $now = date("Y-m", strtotime("-" . date('d') . " days"));
        $tahun = date("Y", strtotime("-" . date('d') . " days"));
        $bulan = date("m", strtotime("-" . date('d') . " days"));
        // echo date("m", strtotime($bulan));
        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);

        $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $where_agent = array("opt_level" => 8, "kategori" => "REG", 'tl !=' => "-");
        if ($userdata->opt_level < 8) {
            $where_agent = array("opt_level" => 8, "kategori" => "REG", 'tl !=' => "-");
        }


        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');

        ///check report cache
        $report_cache_count = $this->monthly_report->get_count(array("tahun" => $tahun, "bulan" => $bulan, "best_agent !=" => NULL, "best_teamleader !=" => NULL, "best_agent !=" => "", "best_teamleader !=" => ""));
        if ($report_cache_count == 0) {
            $tl = $this->sys_user->get_results(array("opt_level" => 9), array("nama,agentid"));
            $data_tl = array();
            $num_tl = array();
            if ($tl['num'] > 0) {
                foreach ($tl['results'] as $tdata) {
                    $data_tl[$tdata->agentid] = 0;
                    $num_tl[$tdata->agentid] = 0;
                }
            }
            $agent = $this->sys_user->get_results($where_agent, array("nama,agentid,tl"));
            $query_trans_profiling = $this->trans_profiling->live_query(
                "SELECT verified as veri_call,update_by as veri_upd,no_handpone as handphone,email FROM trans_profiling_verifikasi 
                WHERE DATE_FORMAT(lup ,'%Y-%m') = '$now' GROUP BY idx
                "
            );
            $data_profiling = $query_trans_profiling->result_array();
            $value_agent = array();
            if ($agent['num'] > 0) {
                foreach ($agent['results'] as $ag) {

                    $data_agent = $this->filter_by_value($data_profiling, 'veri_upd', $ag->agentid);
                    // $verified = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
                    //  $verified = $this->filter_by_value(array(), 'update_by', $ag->agentid);
                    $verified = $this->filter_by_value($data_agent, 'veri_call', '1');
                    $hp_email = count($this->filter_by_hp_email($verified, array("handphone", "email"), array("08", "@")));
                    $hp_only = count($this->filter_by_hp_only($verified, array("handphone", "email"), array("08", "@")));
                    $value_agent[$ag->agentid] = $hp_email + $hp_only;
                    if ($ag->tl != "") {
                        $data_tl[$ag->tl] = $data_tl[$ag->tl] + $value_agent[$ag->agentid];
                        $num_tl[$ag->tl] = $num_tl[$ag->tl] + 1;
                    }
                }
            }
            if ($tl['num'] > 0) {
                foreach ($tl['results'] as $tdata) {
                    $value_tl[$tdata->agentid] = $data_tl[$tdata->agentid] / $num_tl[$tdata->agentid];
                }
            }
            arsort($value_tl);
            arsort($value_agent);
            $rating_agent = array_slice($value_agent, 0, 1);
            $rating_tl = array_slice($value_tl, 0, 1);
            $n = 1;
            foreach ($rating_agent as $k => $v) {
                // echo $k."<br>";
                $json['agent'][$n] = $this->sys_user->get_row_array(array("agentid" => $k));
                $json['agent'][$n]['picture'] = $json['agent'][$n]['picture'];
                $json['agent'][$n]['num'] = number_format($v);
                $this->monthly_report->edit(array("tahun" => $tahun, "bulan" => $bulan), array("best_agent" => $k, "verified_best_agent" => $v));
                $n++;
            }
            $n = 1;
            foreach ($rating_tl as $k => $v) {
                // echo $k."<br>";
                $json['tl'][$n] = $this->sys_user->get_row_array(array("agentid" => $k));
                $json['tl'][$n]['picture'] = $json['tl'][$n]['picture'];
                $json['tl'][$n]['num'] = number_format($v);
                $this->monthly_report->edit(array("tahun" => $tahun, "bulan" => $bulan), array("best_teamleader" => $k, "verified_best_teamleader" => $v));
                $n++;
            }
        } else {
            $report_cache_data = $this->monthly_report->get_row(array("tahun" => $tahun, "bulan" => $bulan));
            $json['agent'][1] = $this->sys_user->get_row_array(array("agentid" => $report_cache_data->best_agent));
            $json['agent'][1]['picture'] = $json['agent'][1]['picture'];
            $json['agent'][1]['num'] = number_format($report_cache_data->verified_best_agent);
            $json['tl'][1] = $this->sys_user->get_row_array(array("agentid" => $report_cache_data->best_teamleader));
            $json['tl'][1]['picture'] = $json['tl'][1]['picture'];
            $json['tl'][1]['num'] = number_format($report_cache_data->verified_best_teamleader);
        }


        echo json_encode($json);
    }

    function get_daily_performance_moss()
    {

        // $data['controller'] = $this;
        // $start_filter = date('Y-m-d');
        $now = date('Y-m-d');

        $where_agent = array("opt_level" => 8, "kategori" => "MOS", 'tl !=' => "-");

        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $agent = $this->sys_user->get_results($where_agent, array("nama,agentid"));
        $start = $_GET['start'];
        $end = $_GET['end'];
        if ($_GET['start']) {

            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg  FROM trans_profiling_validasi_mos 
                 WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') >= '$start' AND DATE_FORMAT(tgl_insert ,'%Y-%m-%d') <= '$end'
                "
            );
        } else {
            $start = date('Y-m-d');
            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg  FROM trans_profiling_validasi_mos 
                 WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') = '$start' 
                "
            );
        }
        if ($agent['num'] > 0) {
            foreach ($agent['results'] as $ag) {
                $data_agent = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
                if (count($data_agent) > 0) {

                    $value_agent[$ag->agentid] = number_format((array_sum(array_column($data_agent, 'slg')) / count($data_agent)) / 60, 2);
                }
            }
        }
        asort($value_agent);
        $rating_agent = array_slice($value_agent, 0, 6);
        $n = 1;
        foreach ($rating_agent as $k => $v) {
            // echo $k."<br>";
            $json['agent'][$n] = $this->sys_user->get_row_array(array("agentid" => $k));
            $json['agent'][$n]['picture'] = $json['agent'][$n]['picture'];
            $json['agent'][$n]['num'] = $v;
            $n++;
        }
        // echo $json;
        echo json_encode($json);
    }
    function get_daily_performance_indibox()
    {

        // $data['controller'] = $this;
        // $start_filter = date('Y-m-d');
        $now = date('Y-m-d');

        $where_agent = array("opt_level" => 8, "kategori" => "MOS", 'tl !=' => "-");

        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $agent = $this->sys_user->get_results($where_agent, array("nama,agentid"));
        $start = $_GET['start'];
        $end = $_GET['end'];
        if ($_GET['start']) {

            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg  FROM trans_profiling_validasi_mos 
                 WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') >= '$start' AND DATE_FORMAT(tgl_insert ,'%Y-%m-%d') <= '$end' AND sumber='IndiBox'
                "
            );
        } else {
            $start = date('Y-m-d');
            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg  FROM trans_profiling_validasi_mos 
                 WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') = '$start'  AND sumber='IndiBox'
                "
            );
        }
        if ($agent['num'] > 0) {
            foreach ($agent['results'] as $ag) {
                $data_agent = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
                if (count($data_agent) > 0) {

                    $value_agent[$ag->agentid] = number_format((array_sum(array_column($data_agent, 'slg')) / count($data_agent)) / 60, 2);
                }
            }
        }
        asort($value_agent);
        $rating_agent = array_slice($value_agent, 0, 6);
        $n = 1;
        foreach ($rating_agent as $k => $v) {
            // echo $k."<br>";
            $json['agent'][$n] = $this->sys_user->get_row_array(array("agentid" => $k));
            $json['agent'][$n]['picture'] = $json['agent'][$n]['picture'];
            $json['agent'][$n]['num'] = $v;
            $n++;
        }
        // echo $json;
        echo json_encode($json);
    }
    function get_profiling_mos()
    {
        // $data['controller'] = $this;
        // $start_filter = date('Y-m-d');
        $now = date('Y-m-d');

        $where_agent = array("opt_level" => 8, "kategori" => "MOS", 'tl !=' => "-");

        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $layanan_moss = $this->layanan_moss->get_results();
        $product_moss = $this->product_moss->get_results();
        $agent = $this->sys_user->get_results($where_agent, array("nama,agentid"));
        // $query_trans_profiling = $this->trans_profiling->live_query(
        //     "SELECT veri_call,veri_upd,handphone,email FROM trans_profiling 
        //     WHERE DATE_FORMAT(lup ,'%Y-%m-%d') = '$now' 
        //     "
        // );
        $start = $now;
        $start = $_GET['start'];
        $end = $_GET['end'];
        if ($_GET['start']) {
            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT *,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg,TIMESTAMPDIFF(SECOND, tgl_insert, click_time) as slfc  FROM trans_profiling_validasi_mos 
                 WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') >= '$start' AND DATE_FORMAT(tgl_insert ,'%Y-%m-%d') <= '$end'
                "
            );
        } else {
            $start = date('Y-m-d');
            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT *,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg,TIMESTAMPDIFF(SECOND, tgl_insert, click_time) as slfc  FROM trans_profiling_validasi_mos 
                 WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') = '$start' 
                "
            );
        }
        // $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
        //     "SELECT *,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg,TIMESTAMPDIFF(SECOND, tgl_insert, click_time) as slfc  FROM trans_profiling_validasi_mos 
        //          WHERE DATE(tgl_insert) = '$start' 
        //         "
        // );

        $no = 1;
        $total = array();
        $total['contacted'] = 0;
        $total['uncontacted'] = 0;
        $total['sum'] = 0;
        $total['slfc'] = 0;
        $total['count'] = 0;
        $agent_online = 0;
        for ($i = 1; $i < 16; $i++) {
            $total[$i] = 0;
        }
        if ($agent['num'] > 0) {
            $sub_total_contacted = 0;
            $sub_total_uncontacted = 0;
            foreach ($agent['results'] as $ag) {

                // $data_agent = $this->filter_by_value($query_trans_profiling->result_array(), 'veri_upd', $ag->agentid);
                $data_agent = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
                // $data_mos = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
                $verified = $this->filter_by_value($data_agent, 'reason_call', 13);

                if ($layanan_moss['num'] > 0) {
                    foreach ($layanan_moss['results'] as $lm) {
                        $total['layanan_moss'][$lm->layanan] = count($this->filter_by_value($verified, 'layanan', $lm->name)) + $total['layanan_moss'][$lm->layanan];
                    }
                }
                $total['sum'] = $total['sum'] + array_sum(array_column($data_agent, 'slg'));
                $total['slfc'] = $total['slfc'] + array_sum(array_column($data_agent, 'slfc'));
                $total['count'] = $total['count'] + count($data_agent);
                $status_1 = count($this->filter_by_value($data_agent, 'reason_call', '1'));
                // $verified = $this->filter_by_value($data_agent, 'veri_call', '13');
                // $status_13=count($this->filter_by_value($data_agent, 'veri_call', '13'));
                $status_3 = count($this->filter_by_value($data_agent, 'reason_call', '3'));
                $status_12 = count($this->filter_by_value($data_agent, 'reason_call', '12'));
                $status_2 = count($this->filter_by_value($data_agent, 'reason_call', '2'));
                $status_4 = count($this->filter_by_value($data_agent, 'reason_call', '4'));
                $status_7 = count($this->filter_by_value($data_agent, 'reason_call', '7'));
                $status_11 = count($this->filter_by_value($data_agent, 'reason_call', '11'));
                $status_10 = count($this->filter_by_value($data_agent, 'reason_call', '10'));
                $status_14 = count($this->filter_by_value($data_agent, 'reason_call', '14'));
                $status_8 = count($this->filter_by_value($data_agent, 'reason_call', '8'));
                $status_9 = count($this->filter_by_value($data_agent, 'reason_call', '9'));
                $status_15 = count($this->filter_by_value($data_agent, 'reason_call', '15'));
                $status_16 = count($this->filter_by_value($data_agent, 'reason_call', '16'));
                $sub_total_contacted = $status_1 + count($verified) + $status_3 + $status_12 + $status_11;
                $sub_total_uncontacted = $status_16 + $status_15 + $status_8 + $status_9 + $status_4 + $status_7 + $status_10 + $status_14 + $status_2;
                $total['contacted'] = $total['contacted'] + $sub_total_contacted;
                $total['uncontacted'] = $total['uncontacted'] + $sub_total_uncontacted;
                $total[1] = $status_1 + $total[1];
                $total[2] = $status_2 + $total[2];
                $total[3] = $status_3 + $total[3];
                $total[4] = $status_4 + $total[4];
                $total[5] = $status_5 + $total[5];
                $total[6] = $status_6 + $total[6];
                $total[7] = $status_7 + $total[7];
                $total[8] = $status_8 + $total[8];
                $total[9] = $status_9 + $total[9];
                $total[10] = $status_10 + $total[10];
                $total[11] = $status_11 + $total[11];
                $total[12] = $status_12 + $total[12];
                $total[13] = count($verified) + $total[13];
                $total[14] = $status_14 + $total[14];
                $total[15] = $status_15 + $total[15];
                $total[16] = $status_16 + $total[16];
                if (($sub_total_contacted + $sub_total_uncontacted) > 0) {
                    $agent_online = $agent_online + 1;
                }
                $no++;
            }
        }
        $total['convention_rate'] = number_format(($total['13'] / ($total['contacted'])) * 100);
        for ($i = 1; $i < 16; $i++) {
            $total['status_' . $i] = number_format($total[$i]);
        }
        $total['callorder'] = number_format($total['uncontacted'] + $total['contacted']);
        $total['contacted_rate'] = number_format(($total['contacted'] / ($total['uncontacted'] + $total['contacted'])) * 100);
        $total['uncontacted_rate'] = number_format(($total['uncontacted'] / ($total['uncontacted'] + $total['contacted'])) * 100);
        $total['contacted'] = number_format($total['contacted']);
        $total['uncontacted'] = number_format($total['uncontacted']);
        $total['arpu'] = number_format($total['arpu']);
        $total['revenue'] = number_format($total['revenue']);

        $slg_minute = ($total['sum'] / $total['count']) / 60;
        $kelebihan_detik = (($total['sum'] / $total['count']) - (intval($slg_minute, 0) * 60));
        $total['slg'] = intval($slg_minute, 0) . "." . intval($kelebihan_detik);
        // $total['slg'] = $slg_minute;
        $slfc_minute = ($total['slfc'] / $total['count']) / 60;
        $kelebihan_detik_slfc = (($total['slfc'] / $total['count']) - (intval($slfc_minute, 0) * 60));
        $total['slfc'] = intval($slfc_minute, 0) . "." . intval($kelebihan_detik_slfc);
        if ($agent_online < 0) {
            $agent_online = 0;
        }
        $total['agent_online'] = $agent_online;
        $value_not = array('not_15' => $total[15], 'not_8' => $total[8], 'not_9' => $total[9], 'not_4' => $total[4], 'not_7' => $total[7], 'not_10' => $total[10], 'not_14' => $total[14], 'not_2' => $total[2]);
        arsort($value_not);
        $not = array(
            'not_4' => "Salah Sambung",
            'not_7' => "Isolir",
            // 'not_11' => "Decline",
            'not_10' => "Rejected",
            'not_14' => "Reject By System",
            'not_8' => "Mailbox",
            'not_9' => "Telepon Sibuk",
            'not_15' => "Cabut",
            'not_2' => "RNA"
        );
        $rating_not = array_slice($value_not, 0, 3);
        $rt = 0;
        $rate3 = 0;
        foreach ($rating_not as $idna => $valna) {
            $total['not']['urut_' . $rt]['valna'] = $valna;
            $total['not']['urut_' . $rt]['textna'] = $not[$idna];
            $rate3 = $rate3 + $valna;
            $rt++;
        }
        $total['not']['other'] = $total['uncontacted'] - $rate3;
        echo json_encode($total);
    }
    function get_profiling_indibox()
    {
        // $data['controller'] = $this;
        // $start_filter = date('Y-m-d');
        $now = date('Y-m-d');

        $where_agent = array("opt_level" => 8, "kategori" => "MOS", 'tl !=' => "-");

        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $layanan_moss = $this->layanan_moss->get_results();
        $product_moss = $this->product_moss->get_results();
        $agent = $this->sys_user->get_results($where_agent, array("nama,agentid"));
        // $query_trans_profiling = $this->trans_profiling->live_query(
        //     "SELECT veri_call,veri_upd,handphone,email FROM trans_profiling 
        //     WHERE DATE_FORMAT(lup ,'%Y-%m-%d') = '$now' 
        //     "
        // );
        $start = $now;
        $start = $_GET['start'];
        $end = $_GET['end'];
        if ($_GET['start']) {
            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT *,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg,TIMESTAMPDIFF(SECOND, tgl_insert, click_time) as slfc  FROM trans_profiling_validasi_mos 
                 WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') >= '$start' AND DATE_FORMAT(tgl_insert ,'%Y-%m-%d') <= '$end' AND sumber='IndiBox'
                "
            );
        } else {
            $start = date('Y-m-d');
            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT *,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg,TIMESTAMPDIFF(SECOND, tgl_insert, click_time) as slfc  FROM trans_profiling_validasi_mos 
                 WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') = '$start' AND sumber='IndiBox'
                "
            );
        }
        // $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
        //     "SELECT *,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg,TIMESTAMPDIFF(SECOND, tgl_insert, click_time) as slfc  FROM trans_profiling_validasi_mos 
        //          WHERE DATE(tgl_insert) = '$start' 
        //         "
        // );

        $no = 1;
        $total = array();
        $total['contacted'] = 0;
        $total['uncontacted'] = 0;
        $total['sum'] = 0;
        $total['slfc'] = 0;
        $total['count'] = 0;
        $agent_online = 0;
        for ($i = 1; $i < 16; $i++) {
            $total[$i] = 0;
        }
        if ($agent['num'] > 0) {
            $sub_total_contacted = 0;
            $sub_total_uncontacted = 0;
            foreach ($agent['results'] as $ag) {

                // $data_agent = $this->filter_by_value($query_trans_profiling->result_array(), 'veri_upd', $ag->agentid);
                $data_agent = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
                // $data_mos = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
                $verified = $this->filter_by_value($data_agent, 'reason_call', 13);


                $total['sum'] = $total['sum'] + array_sum(array_column($data_agent, 'slg'));
                $total['slfc'] = $total['slfc'] + array_sum(array_column($data_agent, 'slfc'));
                $total['count'] = $total['count'] + count($data_agent);
                $status_1 = count($this->filter_by_value($data_agent, 'reason_call', '1'));
                // $verified = $this->filter_by_value($data_agent, 'veri_call', '13');
                // $status_13=count($this->filter_by_value($data_agent, 'veri_call', '13'));
                $status_3 = count($this->filter_by_value($data_agent, 'reason_call', '3'));
                $status_12 = count($this->filter_by_value($data_agent, 'reason_call', '12'));
                $status_2 = count($this->filter_by_value($data_agent, 'reason_call', '2'));
                $status_4 = count($this->filter_by_value($data_agent, 'reason_call', '4'));
                $status_7 = count($this->filter_by_value($data_agent, 'reason_call', '7'));
                $status_11 = count($this->filter_by_value($data_agent, 'reason_call', '11'));
                $status_10 = count($this->filter_by_value($data_agent, 'reason_call', '10'));
                $status_14 = count($this->filter_by_value($data_agent, 'reason_call', '14'));
                $status_8 = count($this->filter_by_value($data_agent, 'reason_call', '8'));
                $status_9 = count($this->filter_by_value($data_agent, 'reason_call', '9'));
                $status_15 = count($this->filter_by_value($data_agent, 'reason_call', '15'));
                $sub_total_contacted = $status_1 + count($verified) + $status_3 + $status_12 + $status_11;
                $sub_total_uncontacted = $status_15 + $status_8 + $status_9 + $status_4 + $status_7 + $status_10 + $status_14 + $status_2;
                $total['contacted'] = $total['contacted'] + $sub_total_contacted;
                $total['uncontacted'] = $total['uncontacted'] + $sub_total_uncontacted;
                $total[1] = $status_1 + $total[1];
                $total[2] = $status_2 + $total[2];
                $total[3] = $status_3 + $total[3];
                $total[4] = $status_4 + $total[4];
                $total[5] = $status_5 + $total[5];
                $total[6] = $status_6 + $total[6];
                $total[7] = $status_7 + $total[7];
                $total[8] = $status_8 + $total[8];
                $total[9] = $status_9 + $total[9];
                $total[10] = $status_10 + $total[10];
                $total[11] = $status_11 + $total[11];
                $total[12] = $status_12 + $total[12];
                $total[13] = count($verified) + $total[13];
                $total[14] = $status_14 + $total[14];
                $total[15] = $status_15 + $total[15];
                $total[16] = $status_16 + $total[16];
                if (($sub_total_contacted + $sub_total_uncontacted) > 0) {
                    $agent_online = $agent_online + 1;
                }
                $no++;
            }
        }
        $total['convention_rate'] = number_format(($total['13'] / ($total['contacted'])) * 100);
        for ($i = 1; $i < 16; $i++) {
            $total['status_' . $i] = number_format($total[$i]);
        }
        $total['callorder'] = number_format($total['uncontacted'] + $total['contacted']);
        $total['contacted_rate'] = number_format(($total['contacted'] / ($total['uncontacted'] + $total['contacted'])) * 100);
        $total['uncontacted_rate'] = number_format(($total['uncontacted'] / ($total['uncontacted'] + $total['contacted'])) * 100);
        $total['contacted'] = number_format($total['contacted']);
        $total['uncontacted'] = number_format($total['uncontacted']);
        $total['arpu'] = number_format($total['arpu']);
        $total['revenue'] = number_format($total['revenue']);

        $slg_minute = ($total['sum'] / $total['count']) / 60;
        $kelebihan_detik = (($total['sum'] / $total['count']) - (intval($slg_minute, 0) * 60));
        $total['slg'] = intval($slg_minute, 0) . "." . intval($kelebihan_detik);
        // $total['slg'] = $slg_minute;
        $slfc_minute = ($total['slfc'] / $total['count']) / 60;
        $kelebihan_detik_slfc = (($total['slfc'] / $total['count']) - (intval($slfc_minute, 0) * 60));
        $total['slfc'] = intval($slfc_minute, 0) . "." . intval($kelebihan_detik_slfc);
        if ($agent_online < 0) {
            $agent_online = 0;
        }
        $total['agent_online'] = $agent_online;
        $value_not = array('not_15' => $total[15], 'not_8' => $total[8], 'not_9' => $total[9], 'not_4' => $total[4], 'not_7' => $total[7], 'not_10' => $total[10], 'not_14' => $total[14], 'not_2' => $total[2]);
        arsort($value_not);
        $not = array(
            'not_4' => "Salah Sambung",
            'not_7' => "Isolir",
            // 'not_11' => "Decline",
            'not_10' => "Rejected",
            'not_14' => "Reject By System",
            'not_8' => "Mailbox",
            'not_9' => "Telepon Sibuk",
            'not_15' => "Cabut",
            'not_2' => "RNA"
        );
        $rating_not = array_slice($value_not, 0, 3);
        $rt = 0;
        $rate3 = 0;
        foreach ($rating_not as $idna => $valna) {
            $total['not']['urut_' . $rt]['valna'] = $valna;
            $total['not']['urut_' . $rt]['textna'] = $not[$idna];
            $rate3 = $rate3 + $valna;
            $rt++;
        }
        $total['not']['other'] = $total['uncontacted'] - $rate3;
        echo json_encode($total);
    }
    function get_regional_daily($start_filter, $end_filter)
    {
        $regional[1] = $this->trans_profiling->live_query("
		select count(*) as num_rows FROM trans_profiling_daily WHERE
		IF(pstn1 ='' OR ISNULL(pstn1),SUBSTR(no_speedy, 2, 1) = 1,
		(pstn1 LIKE '0627%' OR pstn1 LIKE '0629%' OR pstn1 LIKE '0702%' OR
		pstn1 LIKE '0641%' OR pstn1 LIKE '0642%' OR pstn1 LIKE '0643%' OR
		pstn1 LIKE '0644%' OR pstn1 LIKE '0645%' OR 
		pstn1 LIKE '0646%' OR pstn1 LIKE '0650%' OR pstn1 LIKE '0651%' OR
		pstn1 LIKE '0652%' OR pstn1 LIKE '0653%' OR pstn1 LIKE '0654%' OR
		pstn1 LIKE '0655%' OR pstn1 LIKE '0656%' OR pstn1 LIKE '0657%' OR
		pstn1 LIKE '0658%' OR pstn1 LIKE '0659%' OR pstn1 LIKE '061%' OR
		pstn1 LIKE '0620%' OR pstn1 LIKE '0621%' OR pstn1 LIKE '0622%' OR
		pstn1 LIKE '0623%' OR pstn1 LIKE '0624%' OR pstn1 LIKE '0625%' OR 
		pstn1 LIKE '0626%' OR pstn1 LIKE '0627%' OR pstn1 LIKE '0628%' OR 
		pstn1 LIKE '0630%' OR pstn1 LIKE '0631%' OR pstn1 LIKE '0632%' OR 
		pstn1 LIKE '0633%' OR pstn1 LIKE '0634%' OR pstn1 LIKE '0635%' OR 
		pstn1 LIKE '0636%' OR pstn1 LIKE '0638%' OR pstn1 LIKE '0639%' OR 
		pstn1 LIKE '0751%' OR pstn1 LIKE '0752%' OR pstn1 LIKE '0753%' OR 
		pstn1 LIKE '0754%' OR pstn1 LIKE '0755%' OR pstn1 LIKE '0756%' OR 
		pstn1 LIKE '0757%' OR pstn1 LIKE '0759%' OR pstn1 LIKE '0760%' OR 
		pstn1 LIKE '0761%' OR pstn1 LIKE '0762%' OR pstn1 LIKE '0763%' OR 
		pstn1 LIKE '0764%' OR pstn1 LIKE '0765%' OR pstn1 LIKE '0766%' OR 
		pstn1 LIKE '0767%' OR pstn1 LIKE '0768%' OR pstn1 LIKE '0769%' OR 
		pstn1 LIKE '0771%' OR pstn1 LIKE '0772%' OR pstn1 LIKE '0773%' OR 
		pstn1 LIKE '0776%' OR pstn1 LIKE '0777%' OR pstn1 LIKE '0778%' OR 
		pstn1 LIKE '0779%' OR pstn1 LIKE '0740%' OR pstn1 LIKE '0741%' OR 
		pstn1 LIKE '0742%' OR pstn1 LIKE '0743%' OR pstn1 LIKE '0744%' OR 
		pstn1 LIKE '0745%' OR pstn1 LIKE '0746%' OR pstn1 LIKE '0747%' OR 
		pstn1 LIKE '0748%' OR pstn1 LIKE '0711%' OR pstn1 LIKE '0712%' OR 
		pstn1 LIKE '0713%' OR pstn1 LIKE '0714%' OR pstn1 LIKE '0730%' OR 
		pstn1 LIKE '0731%' OR pstn1 LIKE '0733%' OR pstn1 LIKE '0734%' OR 
		pstn1 LIKE '0735%' OR pstn1 LIKE '0715%' OR pstn1 LIKE '0716%' OR 
		pstn1 LIKE '0717%' OR pstn1 LIKE '0718%' OR pstn1 LIKE '0719%' OR 
		pstn1 LIKE '0732%' OR pstn1 LIKE '0736%' OR pstn1 LIKE '0737%' OR 
		pstn1 LIKE '0738%' OR pstn1 LIKE '0739%' OR pstn1 LIKE '0721%' OR 
		pstn1 LIKE '0722%' OR pstn1 LIKE '0723%' OR pstn1 LIKE '0724%' OR 
		pstn1 LIKE '0725%' OR pstn1 LIKE '0726%' OR pstn1 LIKE '0727%' OR 
		pstn1 LIKE '0728%' OR pstn1 LIKE '0729%' OR pstn1 LIKE'11%'
		))");
        $regional[2] = $this->trans_profiling->live_query("
		select count(*) as num_rows FROM trans_profiling_daily WHERE
		IF(pstn1 ='' OR ISNULL(pstn1),SUBSTR(no_speedy, 2, 1) = 2,
		(pstn1 LIKE '021%' OR pstn1 LIKE '0254%' OR pstn1 LIKE '0251%' OR pstn1 LIKE '12%'))");
        $regional[3] = $this->trans_profiling->live_query("
		select count(*) as num_rows FROM trans_profiling_daily WHERE
		IF(pstn1 ='' OR ISNULL(pstn1),SUBSTR(no_speedy, 2, 1) = 3,
		(pstn1 LIKE '0252%' OR pstn1 LIKE '0253%' OR pstn1 LIKE '022%' OR 
pstn1 LIKE '0231%' OR pstn1 LIKE '0232%' OR pstn1 LIKE '0233%' OR 
pstn1 LIKE '0234%' OR pstn1 LIKE '0255%' OR pstn1 LIKE '0257%' OR 
pstn1 LIKE '0260%' OR pstn1 LIKE '0261%' OR pstn1 LIKE '0262%' OR 
pstn1 LIKE '0263%' OR pstn1 LIKE '0264%' OR pstn1 LIKE '0265%' OR 
pstn1 LIKE '0266%' OR pstn1 LIKE '0267%' OR pstn1 LIKE '13%'))");
        $regional[4] = $this->trans_profiling->live_query("
		select count(*) as num_rows FROM trans_profiling_daily WHERE
		IF(pstn1 ='' OR ISNULL(pstn1),SUBSTR(no_speedy, 2, 1) = 4,
		(pstn1 LIKE '024%' OR pstn1 LIKE '0271%' OR
pstn1 LIKE '0272%' OR pstn1 LIKE '0273%' OR pstn1 LIKE '0275%' OR
pstn1 LIKE '0276%' OR pstn1 LIKE '0280%' OR 
pstn1 LIKE '0281%' OR pstn1 LIKE '0282%' OR pstn1 LIKE '0283%' OR
pstn1 LIKE '0284%' OR pstn1 LIKE '0285%' OR pstn1 LIKE '0286%' OR
pstn1 LIKE '0287%' OR pstn1 LIKE '0289%' OR pstn1 LIKE '0291%' OR
pstn1 LIKE '0292%' OR pstn1 LIKE '0293%' OR pstn1 LIKE '0294%' OR
pstn1 LIKE '0295%' OR pstn1 LIKE '0296%' OR pstn1 LIKE '0297%' OR
pstn1 LIKE '0298%' OR pstn1 LIKE '0274%' OR pstn1 LIKE '14%'))");
        $regional[5] = $this->trans_profiling->live_query("
		select count(*) as num_rows FROM trans_profiling_daily WHERE
		IF(pstn1 ='' OR ISNULL(pstn1),SUBSTR(no_speedy, 2, 1) = 5,
		(pstn1 LIKE '031%' OR pstn1 LIKE '0321%' OR
pstn1 LIKE '0322%' OR pstn1 LIKE '0323%' OR pstn1 LIKE '0324%' OR
pstn1 LIKE '0325%' OR pstn1 LIKE '0327%' OR 
pstn1 LIKE '0328%' OR pstn1 LIKE '0331%' OR pstn1 LIKE '0332%' OR
pstn1 LIKE '0333%' OR pstn1 LIKE '0334%' OR pstn1 LIKE '0335%' OR
pstn1 LIKE '0336%' OR pstn1 LIKE '0338%' OR pstn1 LIKE '0341%' OR
pstn1 LIKE '0342%' OR pstn1 LIKE '0343%' OR pstn1 LIKE '0351%' OR
pstn1 LIKE '0352%' OR pstn1 LIKE '0353%' OR pstn1 LIKE '0354%' OR
pstn1 LIKE '0355%' OR pstn1 LIKE '0356%' OR pstn1 LIKE '0357%'
OR pstn1 LIKE '0358%' OR pstn1 LIKE '15%'))");
        $regional[6] = $this->trans_profiling->live_query("
		select count(*) as num_rows FROM trans_profiling_daily WHERE
		IF(pstn1 ='' OR ISNULL(pstn1),SUBSTR(no_speedy, 2, 1) = 6,
		(pstn1 LIKE '0561%' OR pstn1 LIKE '0562%' OR
pstn1 LIKE '0563%' OR pstn1 LIKE '0564%' OR pstn1 LIKE '0565%' OR
pstn1 LIKE '0567%' OR pstn1 LIKE '0568%' OR 
pstn1 LIKE '0513%' OR pstn1 LIKE '0519%' OR pstn1 LIKE '0522%' OR
pstn1 LIKE '0525%' OR pstn1 LIKE '0526%' OR pstn1 LIKE '0528%' OR
pstn1 LIKE '0531%' OR pstn1 LIKE '0532%' OR pstn1 LIKE '0534%' OR
pstn1 LIKE '0536%' OR pstn1 LIKE '0537%' OR pstn1 LIKE '0538%' OR
pstn1 LIKE '0539%' OR pstn1 LIKE '0511%' OR pstn1 LIKE '0512%' OR
pstn1 LIKE '0517%' OR pstn1 LIKE '0518%' OR
pstn1 LIKE '0526%' OR pstn1 LIKE '0527%' OR pstn1 LIKE '0541%' OR
pstn1 LIKE '0542%' OR pstn1 LIKE '0543%' OR pstn1 LIKE '0545%' OR
pstn1 LIKE '0548%' OR pstn1 LIKE '0549%' OR pstn1 LIKE '0551%' OR
pstn1 LIKE '0552%' OR pstn1 LIKE '0553%' OR pstn1 LIKE '0554%' OR
pstn1 LIKE '0556%' OR pstn1 LIKE '16%'))");
        $regional[7] = $this->trans_profiling->live_query("
		select count(*) as num_rows FROM trans_profiling_daily WHERE
		IF(pstn1 ='' OR ISNULL(pstn1),SUBSTR(no_speedy, 2, 1) = 7,
		(pstn1 LIKE '0361%' OR pstn1 LIKE '0362%' OR
pstn1 LIKE '0363%' OR pstn1 LIKE '0365%' OR pstn1 LIKE '0366%' OR
pstn1 LIKE '0368%' OR pstn1 LIKE '0364%' OR 
pstn1 LIKE '0370%' OR pstn1 LIKE '0371%' OR pstn1 LIKE '0372%' OR
pstn1 LIKE '0373%' OR pstn1 LIKE '0374%' OR pstn1 LIKE '0376%' OR
pstn1 LIKE '0380%' OR pstn1 LIKE '0381%' OR pstn1 LIKE '0382%' OR
pstn1 LIKE '0383%' OR pstn1 LIKE '0384%' OR pstn1 LIKE '0385%' OR
pstn1 LIKE '0386%' OR pstn1 LIKE '0387%' OR pstn1 LIKE '0388%' OR
pstn1 LIKE '0389%' OR pstn1 LIKE '0430%' OR pstn1 LIKE '0431%' OR 
pstn1 LIKE '0432%' OR pstn1 LIKE '0434%' OR pstn1 LIKE '0438%' OR 
pstn1 LIKE '0435%' OR pstn1 LIKE '0443%' OR pstn1 LIKE '0450%' OR 
pstn1 LIKE '0451%' OR pstn1 LIKE '0452%' OR pstn1 LIKE '0453%' OR 
pstn1 LIKE '0457%' OR pstn1 LIKE '0458%' OR pstn1 LIKE '0461%' OR 
pstn1 LIKE '0462%' OR pstn1 LIKE '0463%' OR pstn1 LIKE '0464%' OR 
pstn1 LIKE '0465%' OR pstn1 LIKE '0422%' OR pstn1 LIKE '0426%' OR 
pstn1 LIKE '0428%' OR pstn1 LIKE '0474%' OR pstn1 LIKE '0410%' OR 
pstn1 LIKE '0442%' OR pstn1 LIKE '0455%' OR pstn1 LIKE '0411%' OR 
pstn1 LIKE '0413%' OR pstn1 LIKE '0445%' OR pstn1 LIKE '0475%' OR 
pstn1 LIKE '0414%' OR pstn1 LIKE '0417%' OR pstn1 LIKE '0418%' OR 
pstn1 LIKE '0419%' OR pstn1 LIKE '0420%' OR pstn1 LIKE '0421%' OR 
pstn1 LIKE '0422%' OR pstn1 LIKE '0423%' OR pstn1 LIKE '0427%' OR 
pstn1 LIKE '0428%' OR pstn1 LIKE '0471%' OR pstn1 LIKE '0473%' OR 
pstn1 LIKE '0481%' OR pstn1 LIKE '0482%' OR pstn1 LIKE '0484%' OR 
pstn1 LIKE '0485%' OR pstn1 LIKE '0401%' OR pstn1 LIKE '0402%' OR 
pstn1 LIKE '0403%' OR pstn1 LIKE '0404%' OR pstn1 LIKE '0405%' OR 
pstn1 LIKE '0408%' OR pstn1 LIKE '0910%' OR pstn1 LIKE '0911%' OR 
pstn1 LIKE '0913%' OR pstn1 LIKE '0914%' OR pstn1 LIKE '0915%' OR 
pstn1 LIKE '0916%' OR pstn1 LIKE '0917%' OR pstn1 LIKE '0918%' OR 
pstn1 LIKE '0921%' OR pstn1 LIKE '0922%' OR pstn1 LIKE '0923%' OR 
pstn1 LIKE '0924%' OR pstn1 LIKE '0927%' OR pstn1 LIKE '0929%' OR 
pstn1 LIKE '0931%' OR pstn1 LIKE '0901%' OR pstn1 LIKE '0902%' OR 
pstn1 LIKE '0951%' OR pstn1 LIKE '0952%' OR pstn1 LIKE '0955%' OR 
pstn1 LIKE '0956%' OR pstn1 LIKE '0957%' OR pstn1 LIKE '0966%' OR 
pstn1 LIKE '0967%' OR pstn1 LIKE '0969%' OR pstn1 LIKE '0971%' OR 
pstn1 LIKE '0975%' OR pstn1 LIKE '0980%' OR pstn1 LIKE '0981%' OR 
pstn1 LIKE '0983%' OR pstn1 LIKE '0984%' OR pstn1 LIKE '0985%' OR 
pstn1 LIKE '0986%' OR pstn1 LIKE '17%'))");
        for ($r = 1; $r < 8; $r++) {
            $regi = $regional[$r]->row_array();
            if ($regi) {
                $return[$r] = $regi['num_rows'];
            } else {
                $return[$r] = 0;
            }
        }
        return $return;
    }
    function get_slg_mos()
    {
        // $data['controller'] = $this;
        // $start_filter = date('Y-m-d');
        $now = date('Y-m-d');

        $where_agent = array("opt_level" => 8, "kategori" => "MOS", 'tl !=' => "-");

        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $agent = $this->sys_user->get_results($where_agent, array("nama,agentid"));
        // $query_trans_profiling = $this->trans_profiling->live_query(
        //     "SELECT veri_call,veri_upd,handphone,email FROM trans_profiling 
        //     WHERE DATE_FORMAT(lup ,'%Y-%m-%d') = '$now' 
        //     "
        // );
        $start = $_GET['start'];
        $end = $_GET['end'];
        if ($_GET['start']) {
            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT  update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg,TIMESTAMPDIFF(SECOND, tgl_insert, click_time) as slfc  FROM trans_profiling_validasi_mos 
                 WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') >= '$start' AND DATE_FORMAT(tgl_insert ,'%Y-%m-%d') <= '$end'
                "
            );
        } else {
            $start = date('Y-m-d');
            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT  update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg,TIMESTAMPDIFF(SECOND, tgl_insert, click_time) as slfc  FROM trans_profiling_validasi_mos 
                 WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') = '$start' 
                "
            );
        }
        // $start = date('Y-m-d');
        // $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
        //     "SELECT update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg,TIMESTAMPDIFF(SECOND, tgl_insert, click_time) as slfc  FROM trans_profiling_validasi_mos 
        //          WHERE DATE(tgl_insert) = '$start'  "
        // );

        $no = 1;
        $total = array();
        $total['sum'] = 0;
        $total['slfc'] = 0;
        $total['count'] = 0;
        if ($agent['num'] > 0) {
            foreach ($agent['results'] as $ag) {

                // $data_agent = $this->filter_by_value($query_trans_profiling->result_array(), 'veri_upd', $ag->agentid);
                $data_agent = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
                // $data_mos = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
                $total['sum'] = $total['sum'] + array_sum(array_column($data_agent, 'slg'));
                $total['slfc'] = $total['slfc'] + array_sum(array_column($data_agent, 'slfc'));
                $total['count'] = $total['count'] + count($data_agent);
                $no++;
            }
        }
        $slg_minute = ($total['sum'] / $total['count']) / 60;
        $kelebihan_detik = (($total['sum'] / $total['count']) - (intval($slg_minute, 0) * 60));
        $total['slg'] = intval($slg_minute, 0) . "." . intval($kelebihan_detik);
        // $total['slg'] = $slg_minute;
        $slfc_minute = ($total['slfc'] / $total['count']) / 60;
        $kelebihan_detik_slfc = (($total['slfc'] / $total['count']) - (intval($slfc_minute, 0) * 60));
        $total['slfc'] = intval($slfc_minute, 0) . "." . intval($kelebihan_detik_slfc);


        // $total['slfc'] = number_format(($total['slfc'] / $total['count']) / 60, 2);
        echo json_encode($total);
    }
    function get_slg_indibox()
    {
        // $data['controller'] = $this;
        // $start_filter = date('Y-m-d');
        $now = date('Y-m-d');

        $where_agent = array("opt_level" => 8, "kategori" => "MOS", 'tl !=' => "-");

        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $agent = $this->sys_user->get_results($where_agent, array("nama,agentid"));
        // $query_trans_profiling = $this->trans_profiling->live_query(
        //     "SELECT veri_call,veri_upd,handphone,email FROM trans_profiling 
        //     WHERE DATE_FORMAT(lup ,'%Y-%m-%d') = '$now' 
        //     "
        // );
        $start = $_GET['start'];
        $end = $_GET['end'];
        if ($_GET['start']) {
            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT  update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg,TIMESTAMPDIFF(SECOND, tgl_insert, click_time) as slfc  FROM trans_profiling_validasi_mos 
                 WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') >= '$start' AND DATE_FORMAT(tgl_insert ,'%Y-%m-%d') <= '$end' AND sumber='IndiBox'
                "
            );
        } else {
            $start = date('Y-m-d');
            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT  update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg,TIMESTAMPDIFF(SECOND, tgl_insert, click_time) as slfc  FROM trans_profiling_validasi_mos 
                 WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') = '$start' AND sumber='IndiBox'
                "
            );
        }
        // $start = date('Y-m-d');
        // $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
        //     "SELECT update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg,TIMESTAMPDIFF(SECOND, tgl_insert, click_time) as slfc  FROM trans_profiling_validasi_mos 
        //          WHERE DATE(tgl_insert) = '$start'  "
        // );

        $no = 1;
        $total = array();
        $total['sum'] = 0;
        $total['slfc'] = 0;
        $total['count'] = 0;
        if ($agent['num'] > 0) {
            foreach ($agent['results'] as $ag) {

                // $data_agent = $this->filter_by_value($query_trans_profiling->result_array(), 'veri_upd', $ag->agentid);
                $data_agent = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
                // $data_mos = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
                $total['sum'] = $total['sum'] + array_sum(array_column($data_agent, 'slg'));
                $total['slfc'] = $total['slfc'] + array_sum(array_column($data_agent, 'slfc'));
                $total['count'] = $total['count'] + count($data_agent);
                $no++;
            }
        }
        $slg_minute = ($total['sum'] / $total['count']) / 60;
        $kelebihan_detik = (($total['sum'] / $total['count']) - (intval($slg_minute, 0) * 60));
        $total['slg'] = intval($slg_minute, 0) . "." . intval($kelebihan_detik);
        // $total['slg'] = $slg_minute;
        $slfc_minute = ($total['slfc'] / $total['count']) / 60;
        $kelebihan_detik_slfc = (($total['slfc'] / $total['count']) - (intval($slfc_minute, 0) * 60));
        $total['slfc'] = intval($slfc_minute, 0) . "." . intval($kelebihan_detik_slfc);


        // $total['slfc'] = number_format(($total['slfc'] / $total['count']) / 60, 2);
        echo json_encode($total);
    }
    // function get_slg_mos()
    // {
    //     // $data['controller'] = $this;
    //     // $start_filter = date('Y-m-d');
    //     $now = date('Y-m-d');



    //     $this->load->model('sys/Sys_user_log_model', 'log_login');
    //     $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
    //     $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
    //     $idlogin = $this->session->userdata('idlogin');
    //     $logindata = $this->log_login->get_by_id($idlogin);

    //     $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
    //     $where_agent = array("agentid" => $userdata->agentid);
    //     $agent = $this->sys_user->get_results($where_agent, array("nama,agentid"));
    //     $start = $_GET['start'];
    //     $end = $_GET['end'];
    //     if ($start == $end) {

    //         $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
    //             "SELECT update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg  FROM trans_profiling_validasi_mos 
    //              WHERE DATE_FORMAT(lup ,'%Y-%m-%d') = '$start' AND (keterangan NOT LIKE '%galmit%' AND keterangan NOT LIKE '%gagal submit%')
    //             "
    //         );
    //     } else {
    //         $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
    //             "SELECT update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg  FROM trans_profiling_validasi_mos 
    //              WHERE DATE_FORMAT(lup ,'%Y-%m-%d') => '$start' AND DATE_FORMAT(lup ,'%Y-%m-%d') <= '$end' AND (keterangan NOT LIKE '%galmit%' AND keterangan NOT LIKE '%gagal submit%')
    //             "
    //         );
    //     }
    //     $no = 1;
    //     $total = array();
    //     $total['sum'] = 0;
    //     $total['count'] = 0;
    //     if ($agent['num'] > 0) {
    //         foreach ($agent['results'] as $ag) {
    //             // $data_agent = $this->filter_by_value($query_trans_profiling->result_array(), 'veri_upd', $ag->agentid);
    //             $data_agent = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
    //             // $data_mos = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
    //             $total['sum'] = $total['sum'] + array_sum(array_column($data_agent, 'slg'));
    //             $total['count'] = $total['count'] + count($data_agent);

    //             $no++;
    //         }
    //     }
    //     $total['slg'] = number_format(($total['sum'] / $total['count']) / 60, 2);
    //     echo json_encode($total);
    // }
    function get_waiting()
    {
        // $data['controller'] = $this;
        // $start_filter = date('Y-m-d');
        $now = date('Y-m-d');

        $where_agent = array("opt_level" => 8);

        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        // $json = file_get_contents('http://10.194.194.61/dashboard/data/get_data_callorder.php');
        // $data_json = json_decode($json);
        // $call_order = $data_json->result[0]->callorder;
        $call_order = $this->report_cache->get_sum(array("date" => date('Y-m-d')), "total_order_call");
        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);

        $query_trans_profiling = $this->trans_profiling_verifikasi->live_query(
            "SELECT tgl_insert FROM trans_profiling_validasi_mos 
             WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') = '$now' AND status = 0 AND reason_call = 0
            "
        );
        $data['waiting'] = count($query_trans_profiling->result_array());


        echo json_encode($data);
    }
    function get_waiting_indibox()
    {
        // $data['controller'] = $this;
        // $start_filter = date('Y-m-d');
        $data['waiting'] = $this->indibox_forcall_3p->live_query("SELECT count(*) as jumlah FROM indibox_forcall_3p WHERE `status_call` = '0' ")->row()->jumlah;



        echo json_encode($data);
    }
    function get_data_list()
    {
        $data['controller'] = $this;
        $start_filter = date('Y-m-d');
        $end_filter = date('Y-m-d');
        // if (isset($_GET['start']) && isset($_GET['end'])) {
        // $start_filter = $_GET['start'];
        // $end_filter = $_GET['end'];
        // $agentid = $_GET['agentid'];

        $data['status'] = $this->status_call->get_results();
        $where_agent_all = array("opt_level" => 8, '(kategori = "REG" OR kategori="MOS")' => null, 'tl !=' => "-");
        $where_agent_reg = array("opt_level" => 8, 'kategori' => "REG", 'tl !=' => "-");
        $where_agent_moss = array("opt_level" => 8, 'kategori' => "MOS", 'tl !=' => "-");

        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);

        $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $data['userdata'] = $userdata;

        if ($userdata->opt_level == 8) {
            // $where_agent['agentid'] =$userdata->agentid;

        }

        if ($userdata->opt_level == 9) {
            $where_agent_moss['tl'] = $userdata->agentid;
            $where_agent_reg['tl'] = $userdata->agentid;
            $where_agent_all['tl'] = $userdata->agentid;
        }

        if ($userdata->opt_level == 7) {
            $where_agent_reg = array("opt_level" => 8, 'kategori' => "REG");
            $where_agent_moss = array("opt_level" => 8, 'kategori' => "MOS");
            $where_agent_all = array("opt_level" => 8, '(kategori = "REG" OR kategori="MOS")' => null, 'tl !=' => "-");
        }
        $data['agent_reg'] = $this->sys_user->get_results($where_agent_reg, array("nama,agentid,tl"));
        $data['agent_moss'] = $this->sys_user->get_results($where_agent_moss, array("nama,agentid,tl"));
        $data['agent_all'] = $this->sys_user->get_results($where_agent_all, array("nama,agentid,tl"));

        $filter = array();
        $start = $_GET['start'];
        $end = $_GET['end'];
        if ($userdata->opt_level == 8) {
            $data['query_trans_profiling']  = $this->trans_profiling_daily->live_query(
                "SELECT veri_call,veri_upd,handphone,email FROM trans_profiling_daily WHERE DATE(lup) = '" . $start . "'"

            );
        } else {
            if ($start == date('Y-m-d') && $end == date('Y-m-d')) {
                $data['query_trans_profiling']  = $this->trans_profiling_daily->live_query(
                    "SELECT veri_call,veri_upd,handphone,email FROM trans_profiling_daily WHERE DATE(lup) = '" . $start . "'"

                );
            } else {
                $data['query_trans_profiling']  = $this->trans_profiling->live_query(
                    "SELECT veri_call,veri_upd,handphone,email FROM trans_profiling WHERE DATE(lup) >= '" . $start . "' AND DATE(lup) <= '" . $end . "' GROUP BY idx"
                );
            }
        }

        $this->load->view('front-end/landing-page/dashboard_v2/list_area', $data);
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
    function filter_by_value_param($array, $index,  $param)
    {
        if (is_array($array) && count($array) > 0) {
            foreach (array_keys($array) as $key) {
                $temp[$key] = $array[$key][$index];

                $numna = intval(str_replace(",", "", $temp[$key]));

                switch ($param) {
                    case "platinum":
                        if ($numna >= 700000) {
                            $newarray[$key] = $array[$key];
                        }
                        break;
                    case "gold":
                        if ($numna < 700000 && $numna >= 500000) {
                            $newarray[$key] = $array[$key];
                        }
                        break;
                    case "silver":
                        if ($numna < 500000) {
                            $newarray[$key] = $array[$key];
                        }
                        break;
                    case "bronze":
                        if ($numna < 700000) {
                            $newarray[$key] = $array[$key];
                        }
                        break;
                }
            }
        }
        return $newarray;
    }
    function filter_by_value_jk($array, $index,  $param)
    {
        if (is_array($array) && count($array) > 0) {
            foreach (array_keys($array) as $key) {
                $temp[$key] = $array[$key][$index];

                $numna =  strtoupper(substr($temp[$key], 0, 1));

                switch ($param) {
                    case "L":
                        if ($numna == 'L') {
                            $newarray[$key] = $array[$key];
                        }
                        break;
                    case "P":
                        if ($numna == 'P') {
                            $newarray[$key] = $array[$key];
                        }
                        break;
                }
            }
        }
        return $newarray;
    }
    function filter_by_value_date($array, $index, $value, $param)
    {
        if (is_array($array) && count($array) > 0) {
            foreach (array_keys($array) as $key) {
                $temp[$key] = $array[$key][$index];
                $numna = $this->month_count($temp[$key], DATE('Y-m-d'));
                switch ($param) {
                    default:
                        if ($numna == $value) {
                            $newarray[$key] = $array[$key];
                        }
                        break;
                    case ">=":
                        if ($numna >= $value) {
                            $newarray[$key] = $array[$key];
                        }
                        break;
                    case ">":
                        if ($numna >= $value) {
                            $newarray[$key] = $array[$key];
                        }
                        break;
                    case "<=":
                        if ($numna <= $value) {
                            $newarray[$key] = $array[$key];
                        }
                        break;
                }
            }
        }
        return $newarray;
    }
    function filter_by_regional($array, $index, $value)
    {
        if (is_array($array) && count($array) > 0) {
            foreach (array_keys($array) as $key) {
                $temp[$key] = substr($array[$key][$index], 1, 1);

                if ($temp[$key] == $value) {
                    $newarray[$key] = $array[$key];
                }
            }
        }
        return $newarray;
    }
    function sum_change_text_number($array, $index)
    {
        $numna = 0;
        if (is_array($array) && count($array) > 0) {
            foreach (array_keys($array) as $key) {
                $temp[$key] = $array[$key][$index];
                if (substr($temp[$key], -3) == ",00") {
                    $temp[$key] = str_replace(",00", "", $temp[$key]);
                }
                $temp[$key] = str_replace(".", "", $temp[$key]);
                $numna = $numna + intval($temp[$key]);
            }
        }
        return $numna;
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
    function month_count($year_start, $now)
    {
        $date1 = $year_start . '-01-01';
        $date2 = $now;

        $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
        return $diff;
    }
}
