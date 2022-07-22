<?php
class Scoring extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Custom_model/Custom_model', 'Custom_model');
    }

    public function index()
    {

        $now = date('Y-m-d');
        $data['max'] = 12;
        $data['raw'] = $this->Custom_model->live_query("SELECT ncli,no_internet,no_handphone,email,kategori,lup,TIMESTAMPDIFF(MONTH, tanggal, '$now') as durasi FROM log_interaction  GROUP BY ncli,no_internet ORDER BY lup ASC")->result();
        $heat = $this->Custom_model->live_query("SELECT kategori,TIMESTAMPDIFF(MONTH, tanggal, '$now') as durasi,count(id) as jumlahna FROM log_interaction GROUP BY kategori,TIMESTAMPDIFF(MONTH, tanggal, '$now')")->result();
        $data['heat'] = array();
        if (count($heat) > 0) {
            foreach ($heat as $row) {
                $data['heat'][$row->kategori]['dr_' . $row->durasi] =  $row->jumlahna;
                // echo $row->kategori."-".$row->durasi."-".$row->jumlahna."<br>";
            }
        }

        $data['uniq'] = $this->Custom_model->live_query("SELECT ncli,no_internet FROM log_interaction GROUP BY ncli,no_internet")->num_rows();
        $data['trafic'] = $this->Custom_model->live_query("SELECT * FROM log_interaction ")->num_rows();

        $this->load->view('Scoring/dashboard', $data);
    }
    function get_data_profiling()
    {
        $query = $this->Custom_model->live_query("SELECT *,DATE(lup) as datena FROM trans_profiling_verified_sample  ORDER BY LUP DESC LIMIT 20000")->result();
        if (count($query) > 0) {
            foreach ($query as $row) {
                $cek = $this->Custom_model->live_query("SELECT * FROM log_interaction WHERE key_id ='$row->idx'  AND kategori='Profiling' ")->result();
                if (count($cek) == 0) {
                    $data_insert = array(
                        "ncli" => $row->ncli,
                        "no_internet" => $row->no_speedy,
                        "no_handphone" => $row->handphone,
                        "email" => $row->email,
                        "lup" => $row->lup,
                        "channel" => 1,
                        "kategori" => 'Profiling',
                        "tanggal" => $row->datena,
                        "key_id" => $row->idx,
                    );
                    $this->Custom_model->add('log_interaction', $data_insert);
                }
            }
        }
    }
    function get_data_moss()
    {
        $query = $this->Custom_model->live_query("SELECT *,DATE(lup) as datena FROM trans_profiling_validasi_mos_sample")->result();
        if (count($query) > 0) {
            foreach ($query as $row) {
                $cek = $this->Custom_model->live_query("SELECT * FROM log_interaction WHERE key_id ='$row->idx' AND kategori='MOSS' ")->result();
                if (count($cek) == 0) {
                    $data_insert = array(
                        "ncli" => $row->ncli,
                        "no_internet" => $row->no_speedy,
                        "no_handphone" => $row->no_handpone,
                        "email" => $row->email,
                        "lup" => $row->lup,
                        "channel" => 1,
                        "kategori" => 'MOSS',
                        "tanggal" => $row->datena,
                        "key_id" => $row->idx,
                    );
                    $this->Custom_model->add('log_interaction', $data_insert);
                }
            }
        }
    }
}
