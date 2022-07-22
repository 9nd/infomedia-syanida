<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Custom_model/Tahun_model', 'tahun');
        $this->load->model('Absensi/Absensi_model', 't_absensi');
    }


    function get_data_listabsensi()
    {
        $data['controller'] = $this;
        $start_filter = date('Y-m-d');
        $end_filter = date('Y-m-d');
        $start_filter = $_GET['start'];
        // $end_filter = $_GET['end'];
        //  $agentid = $_GET['agentid'];
        $data['start_filter'] = $_GET['start'];
        // $data['end_filter'] = $_GET['end'];

        $data['absensi'] = $this->t_absensi->get_results(array(
            'date(waktu_in) >=' => $start_filter

        ), array('*'), array(), array());




        $data['sysuserreg'] = $this->t_absensi->live_query("select * from sys_user WHERE opt_level = 8 AND kategori='REG' AND tl IS NOT NULL AND tl <> '-'");
        $data['sysusermos'] = $this->t_absensi->live_query("select * from sys_user where opt_level = 8 AND kategori = 'MOS' AND tl IS NOT NULL AND tl <> '-'");
        $data['controller']  = $this;


        $this->load->view('front-end/landing-page/dashboard_v2/list_absensi', $data);
    }


    function get_grafik()
    {
        $current_date = date('Y/m/d');
        /*
        for ($a = 1; $a > 32; $a++) {
            $b = $this->t_absensi->live_query("select * from t_absensi where day(waktu_in) = '$a' AND STR_TO_DATE(time(waktu_in), '%H:%i:%s') < '08:00:00' AND nama NOT LIKE '%MOSS%' AND stts='in'")->num_rows();
            
        }     
        */


        for ($x = 1; $x <= 31; $x++) {
            $on[$x] = $this->t_absensi->live_query("SELECT sys_user.nama, sys_user.kategori, sys_user.opt_level, t_absensi.waktu_in, t_absensi.stts
            FROM sys_user
            LEFT JOIN t_absensi
            ON sys_user.nik_absensi = t_absensi.nik
            where  sys_user.opt_level=8
            AND sys_user.kategori = 'REG'
            AND STR_TO_DATE(time(t_absensi.waktu_in), '%H:%i:%s') <= '08:00:00'
                AND MONTH(waktu_in) = MONTH(CURDATE())
                AND day(waktu_in) = '$x'
            AND t_absensi.stts = 'in'
            ")->num_rows();
        }

        for ($x = 1; $x <= 31; $x++) {
            $out[$x] = $this->t_absensi->live_query("SELECT sys_user.nama, sys_user.kategori, sys_user.opt_level, t_absensi.waktu_in, t_absensi.stts
            FROM sys_user
            LEFT JOIN t_absensi
            ON sys_user.nik_absensi = t_absensi.nik
            where  sys_user.opt_level=8
            AND sys_user.kategori = 'REG'
            AND STR_TO_DATE(time(t_absensi.waktu_in), '%H:%i:%s') > '08:00:00'
                AND MONTH(waktu_in) = MONTH(CURDATE())
                AND day(waktu_in) = '$x'
            AND t_absensi.stts = 'in'
            ")->num_rows();
        }


        $data['data'] = array(
            'OnTIme' => array(
                $on[1], $on[2], $on[3], $on[4], $on[5], $on[6], $on[7], $on[8], $on[9], $on[10], $on[11], $on[12], $on[13], $on[14], $on[15], $on[16], $on[17], $on[18], $on[19], $on[20], $on[21], $on[22], $on[23], $on[24], $on[25], $on[26], $on[27], $on[28], $on[29], $on[30], $on[31]
            ),
            'Late' => array(
                $out[1], $out[2], $out[3], $out[4], $out[5], $out[6], $out[7], $out[8], $out[9], $out[10], $out[11], $out[12], $out[13], $out[14], $out[15], $out[16], $out[17], $out[18], $out[19], $out[20], $out[21], $out[22], $out[23], $out[24], $out[25], $out[26], $out[27], $out[28], $out[29], $out[30], $out[31]

            )
        );

        echo json_encode($data);
    }
    function get_grafik_absensi_yearly()
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
}
