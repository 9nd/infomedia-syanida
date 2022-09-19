<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling');
        $this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling_verifikasi');
        $this->load->model('Custom_model/Tahun_model', 'tahun');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $this->load->model('Custom_model/Monthly_report_cache_model', 'monthly_report');
        $this->load->model('Custom_model/Status_call_model', 'status_call');
        $this->load->model('Custom_model/Report_cache_model', 'report_cache');
    }
    
    function get_profiling_reguler()
    {

        $where_agent = array("opt_level" => 8, "kategori" => "REG");

        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $agent = $this->sys_user->get_results($where_agent, array("nama,agentid"));
        $start = $_GET['start'];
        $end = $_GET['end'];
        if($start == date('Y-m-d') && $end == date('Y-m-d')){
            $call_order = $this->report_cache->get_sum(array('date' =>$start), "total_order_call");
            $query_trans_profiling = $this->trans_profiling->live_query(
                "SELECT veri_call,veri_upd,handphone,email FROM trans_profiling ORDER BY lup DESC limit " . $call_order
                
            );
        }else{
            $query_trans_profiling = $this->trans_profiling->live_query(
                "SELECT veri_call,veri_upd,handphone,email FROM trans_profiling WHERE DATE(lup) >= '".$start."' AND DATE(lup) <= '".$end."'"
            );
        }
       

        $no = 1;
        $total = array();
        $total['contacted'] = 0;
        $total['uncontacted'] = 0;
        $agent_online = 0;
        for ($i = 1; $i < 16; $i++) {
            $total[$i] = 0;
        }
        if ($agent['num'] > 0) {
            $sub_total_contacted = 0;
            $sub_total_uncontacted = 0;
            foreach ($agent['results'] as $ag) {
                $data_agent = $this->filter_by_value($query_trans_profiling->result_array(), 'veri_upd', $ag->agentid);
                // $verified = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
                //  $verified = $this->filter_by_value(array(), 'update_by', $ag->agentid);
                $verified = $this->filter_by_value($data_agent, 'veri_call', '13');
                $status_1 = count($this->filter_by_value($data_agent, 'veri_call', '1'));
                $status_3 = count($this->filter_by_value($data_agent, 'veri_call', '3'));
                $status_12 = count($this->filter_by_value($data_agent, 'veri_call', '12'));
                $status_2 = count($this->filter_by_value($data_agent, 'veri_call', '2'));
                $status_4 = count($this->filter_by_value($data_agent, 'veri_call', '4'));
                $status_7 = count($this->filter_by_value($data_agent, 'veri_call', '7'));
                $status_11 = count($this->filter_by_value($data_agent, 'veri_call', '11'));
                $status_10 = count($this->filter_by_value($data_agent, 'veri_call', '10'));
                $status_14 = count($this->filter_by_value($data_agent, 'veri_call', '14'));
                $sub_total_contacted = $status_1 + count($verified) + $status_3 + $status_12;
                $sub_total_uncontacted = $status_4 + $status_7 + $status_11 + $status_10 + $status_14 + $status_2;
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
        $total['convention_rate'] = number_format(($total['13'] / ($total['contacted'])) * 100);
        $total['hp_email_rate'] = intval(($total['hp_email'] / $total['13']) * 100);
        $total['hp_only_rate'] = intval(($total['hp_only'] / $total['13']) * 100);
        for ($i = 1; $i < 16; $i++) {
            $total['status_' . $i] = number_format($total[$i]);
        }

        $total['wo'] = number_format(24000 - ($total['uncontacted'] + $total['contacted']));
        $total['contacted_rate'] = number_format(($total['contacted'] / ($total['uncontacted'] + $total['contacted'])) * 100);
        $total['uncontacted_rate'] = number_format(($total['uncontacted'] / ($total['uncontacted'] + $total['contacted'])) * 100);

        $total['callorder'] = number_format($total['uncontacted'] + $total['contacted']);
        $total['contacted'] = number_format($total['contacted']);
        $total['uncontacted'] = number_format($total['uncontacted']);

        $total['hp_email'] = number_format($total['hp_email']);
        $total['hp_only'] = number_format($total['hp_only']);
        $total['agent_online'] = $agent_online;

        echo json_encode($total);
    }
    function get_profiling_mos()
    {
        // $data['controller'] = $this;
        // $start_filter = date('Y-m-d');
        $now = date('Y-m-d');

        $where_agent = array("opt_level" => 8, "kategori" => "MOS");

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
        if($start == $end){
            
            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg,TIMESTAMPDIFF(SECOND, tgl_insert, click_time) as slfc  FROM trans_profiling_validasi_mos 
                 WHERE DATE_FORMAT(lup ,'%Y-%m-%d') = '$start' 
                "
            );
        }else{
            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg,TIMESTAMPDIFF(SECOND, tgl_insert, click_time) as slfc  FROM trans_profiling_validasi_mos 
                 WHERE DATE_FORMAT(lup ,'%Y-%m-%d') => '$start' AND DATE_FORMAT(lup ,'%Y-%m-%d') <= '$end'
                "
            );
        }
        
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
                $sub_total_contacted = $status_1 + count($verified) + $status_3 + $status_12;
                $sub_total_uncontacted = $status_4 + $status_7 + $status_11 + $status_10 + $status_14 + $status_2;
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
        $total['slg'] = number_format(($total['sum'] / $total['count']) / 60, 2);
        $total['slfc'] = number_format(($total['slfc'] / $total['count']) / 60, 2);
        $total['agent_online'] = $agent_online;
        echo json_encode($total);
    }
    function get_slg_mos()
    {
        // $data['controller'] = $this;
        // $start_filter = date('Y-m-d');
        $now = date('Y-m-d');



        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);

        $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $where_agent = array("agentid" => $userdata->agentid);
        $agent = $this->sys_user->get_results($where_agent, array("nama,agentid"));
        $start = $_GET['start'];
        $end = $_GET['end'];
        if($start == $end){
            
            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg  FROM trans_profiling_validasi_mos 
                 WHERE DATE_FORMAT(lup ,'%Y-%m-%d') = '$start' 
                "
            );
        }else{
            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg  FROM trans_profiling_validasi_mos 
                 WHERE DATE_FORMAT(lup ,'%Y-%m-%d') => '$start' AND DATE_FORMAT(lup ,'%Y-%m-%d') <= '$end'
                "
            );
        }
        $no = 1;
        $total = array();
        $total['sum'] = 0;
        $total['count'] = 0;
        if ($agent['num'] > 0) {
            foreach ($agent['results'] as $ag) {
                // $data_agent = $this->filter_by_value($query_trans_profiling->result_array(), 'veri_upd', $ag->agentid);
                $data_agent = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
                // $data_mos = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
                $total['sum'] = $total['sum'] + array_sum(array_column($data_agent, 'slg'));
                $total['count'] = $total['count'] + count($data_agent);

                $no++;
            }
        }
        $total['slg'] = number_format(($total['sum'] / $total['count']) / 60, 2);
        echo json_encode($total);
    }
    function get_grafik_verified_yearly()
    {
        $tahun = $this->tahun->get_results();
        $now = date('Y-m-d');
        if ($tahun['num'] > 0) {
            foreach ($tahun['results'] as $th) {

                for ($i = 0; $i <= 11; $i++) {
                    ////check report cache//
                    $monthly_report = $this->monthly_report->get_count(array("tahun" => $th->tahun, "bulan" => $i + 1));
                    if ($monthly_report > 0) {

                        $report_cache = $this->monthly_report->get_row(array("tahun" => $th->tahun, "bulan" => $i + 1), array("verified,DATE_FORMAT(last_update ,'%Y-%m-%d') as last_update_date"));
                        if ($report_cache->last_update_date == $now) {
                            $data['data'][$th->tahun][$i] = intval($report_cache->verified);
                        } else {
                            $data['data'][$th->tahun][$i] = $this->trans_profiling_verifikasi->get_count(array("YEAR(lup)" => $th->tahun, "MONTH(lup)" => $i + 1));
                            $data_update = array(
                                'verified' => $data['data'][$th->tahun][$i],
                                'last_update' => date("Y-m-d h:i:sa")
                            );
                            $this->monthly_report->edit(array("tahun" => $th->tahun, "bulan" => $i + 1), $data_update);
                        }
                    } else {
                        $data['data'][$th->tahun][$i] = $this->trans_profiling_verifikasi->get_count(array("YEAR(lup)" => $th->tahun, "MONTH(lup)" => $i + 1));
                        $data_insert = array(
                            'tahun' => $th->tahun,
                            'bulan' => $i + 1,
                            'verified' => $data['data'][$th->tahun][$i],
                            'last_update' => date("Y-m-d h:i:sa")
                        );
                        $this->monthly_report->add($data_insert);
                    }
                }
            }
        }

        echo json_encode($data);
    }
    function get_grafik_verified()
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
        // $call_order = $this->report_cache->get_sum(array("date" => date('Y-m-d')), "total_order_call");
        $agent = $this->sys_user->get_results($where_agent, array("nama,agentid"));
        $start = $_GET['start'];
        $end = $_GET['end'];
        if($start == date('Y-m-d') && $end == date('Y-m-d')){
            $call_order = $this->report_cache->get_sum(array('date' =>$start), "total_order_call");
            $query_trans_profiling = $this->trans_profiling->live_query(
                "SELECT veri_call,veri_upd,handphone,email,HOUR(lup) as hour_lup FROM trans_profiling ORDER BY lup DESC limit " . $call_order
                
            );
        }else{
            $query_trans_profiling = $this->trans_profiling->live_query(
                "SELECT veri_call,veri_upd,handphone,email,HOUR(lup) as hour_lup FROM trans_profiling WHERE DATE(lup) >= '".$start."' AND DATE(lup) <= '".$end."'"
            );
        }
        
        $no = 1;
        $total = array();
        for ($i = 0; $i <= 23; $i++) {
            $total['data']['Verified'][$i] = 0;
        }
        foreach ($query_trans_profiling->result_array() as $th) {
            for ($i = 0; $i <= 23; $i++) {
                if ($th['veri_call'] == 13) {
                    if ($th['hour_lup'] == $i) {
                        $total['data']['Verified'][$i] = $total['data']['Verified'][$i] + 1;
                    }
                }
            }
        }


        echo json_encode($total);
    }
    function get_grafik_tl()
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
        if($start == date('Y-m-d') && $end == date('Y-m-d')){
            $call_order = $this->report_cache->get_sum(array('date' =>$start), "total_order_call");
            $query_trans_profiling = $this->trans_profiling->live_query(
                "SELECT veri_call,veri_upd,handphone,email,HOUR(lup) as hour_lup FROM trans_profiling ORDER BY lup DESC limit " . $call_order
                
            );
        }else{
            $query_trans_profiling = $this->trans_profiling->live_query(
                "SELECT veri_call,veri_upd,handphone,email,HOUR(lup) as hour_lup FROM trans_profiling WHERE DATE(lup) >= '".$start."' AND DATE(lup) <= '".$end."'"
            );
        }
        
        $no = 1;
        $total = array();
        for ($i = 0; $i <= 23; $i++) {
            $total['data']['Verified'][$i] = 0;
        }
        foreach ($query_trans_profiling->result_array() as $th) {
            for ($i = 0; $i <= 23; $i++) {
                if ($th['veri_call'] == 13) {
                    if ($th['hour_lup'] == $i) {
                        $agent = $this->Sys_user_table_model->get_row(array("agentid" => $th['veri_upd']));
                        if ($agent->tl == $userdata->agentid) {
                            $total['data']['Verified'][$i] = $total['data']['Verified'][$i] + 1;
                        }
                    }
                }
            }
        }


        echo json_encode($total);
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
        if($start == $end){
            
            $query_trans_profiling = $this->trans_profiling_verifikasi->live_query(
                "SELECT update_by,no_handpone,email,reason_call,HOUR(lup) as hour_lup, HOUR(tgl_insert) as hour_insert FROM trans_profiling_validasi_mos 
                WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') = '$start' 
                "
            );
        }else{
            $query_trans_profiling = $this->trans_profiling_verifikasi->live_query(
                "SELECT update_by,no_handpone,email,reason_call,HOUR(lup) as hour_lup, HOUR(tgl_insert) as hour_insert FROM trans_profiling_validasi_mos 
                WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') => '$start' AND DATE_FORMAT(tgl_insert ,'%Y-%m-%d') <= '$end'
                "
            );
        }
        $no = 1;
        $total = array();
        for ($i = 0; $i <= 23; $i++) {
            $total['data']['Verified'][$i] = 0;
            $total['data']['Waiting'][$i] = 0;
        }
        foreach ($query_trans_profiling->result_array() as $th) {
            for ($i = 0; $i <= 23; $i++) {
                if ($th['reason_call'] == 13) {
                    if ($th['hour_lup'] == $i) {
                        $total['data']['Verified'][$i] = $total['data']['Verified'][$i] + 1;
                    }
                }
                if ($th['hour_lup'] == $i) {
                    $total['data']['Waiting'][$i] = $total['data']['Waiting'][$i] + 1;
                }
            }
        }


        echo json_encode($total);
    }
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
    function get_daily_performance_reg()
    {

        $where_agent = array("opt_level" => 8, "kategori" => "REG");
        $now = date('Y-m-d');
        $data['agent'] = $this->sys_user->get_results($where_agent, array("nama,agentid"));

        $start = $_GET['start'];
        $end = $_GET['end'];
        if($start == date('Y-m-d') && $end == date('Y-m-d')){
            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT update_by FROM trans_profiling_verifikasi 
                 WHERE DATE_FORMAT(lup ,'%Y-%m-%d') = '$start' 
                "
            );
        }else{
            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT update_by FROM trans_profiling_verifikasi 
                 WHERE DATE_FORMAT(lup ,'%Y-%m-%d') >= '$start'  AND DATE_FORMAT(lup ,'%Y-%m-%d') <= '$end'
                "
            );
        }

        
        $data_verified = $query_trans_profiling_verifikasi->result_array();
        $value_agent = array();
        if ($data['agent']['num'] > 0) {
            foreach ($data['agent']['results'] as $ag) {
                $value_agent[$ag->agentid] = count($this->filter_by_value($data_verified, 'update_by', $ag->agentid));
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
    function get_daily_performance_moss()
    {

        // $data['controller'] = $this;
        // $start_filter = date('Y-m-d');
        $now = date('Y-m-d');

        $where_agent = array("opt_level" => 8, "kategori" => "MOS");

        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $agent = $this->sys_user->get_results($where_agent, array("nama,agentid"));
        $start = $_GET['start'];
        $end = $_GET['end'];
        if($start == $end){
            
            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg  FROM trans_profiling_validasi_mos 
                 WHERE DATE_FORMAT(lup ,'%Y-%m-%d') = '$start' 
                "
            );
        }else{
            $query_trans_profiling_verifikasi = $this->trans_profiling_verifikasi->live_query(
                "SELECT update_by,no_handpone,email,reason_call,TIMESTAMPDIFF(SECOND, tgl_insert, lup) as slg  FROM trans_profiling_validasi_mos 
                 WHERE DATE_FORMAT(lup ,'%Y-%m-%d') => '$start' AND DATE_FORMAT(lup ,'%Y-%m-%d') <= '$end'
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
    function get_best_agent()
    {
        // $data['controller'] = $this;
        // $start_filter = date('Y-m-d');
        $now = date("Y-m", strtotime("-1 months"));
        $tahun = date("Y", strtotime("-1 months"));
        $bulan = date("m", strtotime("-1 months"));
        $where_agent = array("opt_level" => 8, "kategori" => "REG");

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
                "SELECT veri_call,veri_upd,handphone,email FROM trans_profiling 
                WHERE DATE_FORMAT(lup ,'%Y-%m') = '$now'
                "
            );
            $data_profiling = $query_trans_profiling->result_array();
            $value_agent = array();
            if ($agent['num'] > 0) {
                foreach ($agent['results'] as $ag) {

                    $data_agent = $this->filter_by_value($data_profiling, 'veri_upd', $ag->agentid);
                    // $verified = $this->filter_by_value($query_trans_profiling_verifikasi->result_array(), 'update_by', $ag->agentid);
                    //  $verified = $this->filter_by_value(array(), 'update_by', $ag->agentid);
                    $verified = $this->filter_by_value($data_agent, 'veri_call', '13');
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
    function get_best_agent_moss()
    {
        // $data['controller'] = $this;
        // $start_filter = date('Y-m-d');
        $now = date("Y-m", strtotime("-1 months"));
        $tahun = date("Y", strtotime("-1 months"));
        $bulan = date("m", strtotime("-1 months"));
        $where_agent = array("opt_level" => 8, "kategori" => "MOS");

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
        $where_agent_reg = array("opt_level" => 8, 'kategori' => "REG");
        $where_agent_moss = array("opt_level" => 8, 'kategori' => "MOS");

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
        }
        $data['agent_reg'] = $this->sys_user->get_results($where_agent_reg, array("nama,agentid,tl"));
        $data['agent_moss'] = $this->sys_user->get_results($where_agent_moss, array("nama,agentid,tl"));

        $filter = array();
        $start = $_GET['start'];
        $end = $_GET['end'];
        if($userdata->opt_level == 8){
            $call_order = $this->report_cache->get_sum(array('date' =>$start), "total_order_call");
            $data['query_trans_profiling']  = $this->trans_profiling->live_query(
                "SELECT veri_call,veri_upd,handphone,email FROM trans_profiling ORDER BY lup DESC limit " . $call_order
                
            );
        }else{
            if($start == date('Y-m-d') && $end == date('Y-m-d')){
                $call_order = $this->report_cache->get_sum(array('date' =>$start), "total_order_call");
                $data['query_trans_profiling']  = $this->trans_profiling->live_query(
                    "SELECT veri_call,veri_upd,handphone,email FROM trans_profiling ORDER BY lup DESC limit " . $call_order
                    
                );
            }else{
                $data['query_trans_profiling']  = $this->trans_profiling->live_query(
                    "SELECT veri_call,veri_upd,handphone,email FROM trans_profiling WHERE DATE(lup) >= '".$start."' AND DATE(lup) <= '".$end."'"
                );
            }
        }
        
        $this->load->view('front-end/landing-page/dashboard/list_area', $data);
    }
    function get_dapros()
    {
        $data['query_dapros'] = $this->trans_profiling->live_query(
            "SELECT count(*) as jumlah_data FROM dbprofile_validate_forcall_3p WHERE status = 0
            "
        );
        $data_dapros = $data['query_dapros']->row_array();
        $json['jumlah_data']=$data_dapros['jumlah_data'];
        echo json_encode($json);
    }
    function get_dapros_grapik()
    {
        $data['query_dapros'] = $this->trans_profiling->live_query(
            "SELECT count(*) as jumlah_data,sumber FROM dbprofile_validate_forcall_3p WHERE status = 0 GROUP BY sumber
            "
        );
        $dapros = $data['query_dapros']->result_array();
        foreach ($dapros as $dt) {
            $json['jumlah_data'][] = intval($dt['jumlah_data']);
            if ($dt['sumber'] == "") {
                $json['categories'][] = "Tanpa Sumber";
            } else {
                $json['categories'][] = $dt['sumber'];
            }
        }
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
}
