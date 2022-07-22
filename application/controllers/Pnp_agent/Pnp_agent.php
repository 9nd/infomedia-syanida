<?php
require APPPATH . '/controllers/Distribution/Distribution_config.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pnp_agent extends CI_Controller
{
    private $log_key, $log_temp, $title;
    function __construct()
    {
        parent::__construct();

        $this->log_key = 'log_Distributon';
        $this->title = new Distribution_config();
        $this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Siakad_ujian_model', 'pnp');
        $this->load->model('Custom_model/Siakad_ujian_agent_model', 'ujian_agent');
        $this->load->model("Custom_model/Siakad_jawaban_ujian_model", "jawaban_ujian");
        $this->load->model("Custom_model/Siakad_jawaban_agent_model", "jawaban_agent");
    }


    public function index()
    {
        $post = $this->input->get();
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);
        $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $no = 0;

        $data['data'] = $this->pnp->get_results($post);
        $data['post'] = $post;
        $this->template->load('Pnp/List_agent', $data);
    }

    public function detail($id = false)
    {

        $data = array();
        ////hak akses load///
        ////get data
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);
        $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $data['ujian'] = $this->pnp->get_row(array("id" => $id), array("*"));
        $data['belum'] = true;
        $data['sudah'] = true;
        if (date("Y-m-d H:i:s") <= $data['ujian']->waktu_mulai) {
            $data['belum'] = false;
        }
        if (date("Y-m-d H:i:s") >= $data['ujian']->waktu_selesai) {
            $data['sudah'] = false;
        }
        if ($this->ujian_agent->get_count(array("veri_upd" => $userdata->agentid, "id_soal" => $id)) == 0) {
            $data_input = array(
                "veri_upd" => $userdata->agentid,
                "id_soal" => $id,
                "waktu_mulai" => date("Y-m-d H:i:s"),
                "waktu_tersisa" => $this->get_time_string_minute($data['ujian']->durasi_waktu),
            );
            $this->ujian_agent->add($data_input);
        }
        $data['ujian_agent'] = $this->ujian_agent->get_row(array("veri_upd" => $userdata->agentid, "id_soal" => $id));

        $data['controller'] = $this;
        $this->load->view('Pnp/detail_agent', $data);
    }
    function change_duration()
    {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            $where = array();
            if ($this->ujian_agent->get_count(array("id_soal" => $post['id_soal'], "veri_upd" => $post['veri_upd'])) > 0) {
                $where = array(
                    "id_soal" => $post['id_soal'],
                    "veri_upd" => $post['veri_upd'],
                );
                $this->ujian_agent->edit($where, $post);
            } else {
                $this->ujian_agent->add($post);
            }
        }
    }

    function data_proses()
    {
        $data = array();
        $post = $this->input->post();
        $data['num_soal'] = $this->pnp->get_row(array("id" => $post['id_soal']), array("jumlah_soal"))->jumlah_soal;
        $data['num_jawaban'] = $this->jawaban_agent->get_count(array("id_soal" => $post['id_soal'], "veri_upd" => $post['veri_upd']));
        $data['persen'] = $data['num_jawaban'] / $data['num_soal'] * 100;
        $this->load->view('Pnp/proses', $data);
    }
    function input_jawaban()
    {

        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            $where = array();
            $post['jawaban'] = $this->conver_jawaban($post['jawaban']);
            if ($this->jawaban_agent->get_count(array("id_soal" => $post['id_soal'], "veri_upd" => $post['veri_upd'], "urutan" => $post['urutan'])) > 0) {
                $where = array(
                    "id_soal" => $post['id_soal'],
                    "veri_upd" => $post['veri_upd'],
                    "urutan" => $post['urutan'],
                );
                $this->jawaban_agent->edit($where, $post);
            } else {
                $this->jawaban_agent->add($post);
            }
        }
    }
    function get_time_string_second($seconds)
    {
        return date('H:i:s', strtotime("2000-01-01 + $seconds SECONDS"));
    }

    function get_time_string_minute($minutes)
    {
        return date('H:i:s', strtotime("2000-01-01 + $minutes MINUTES"));
    }

    function conver_jawaban($jwb)
    {
        switch ($jwb) {
            case "A":
                return 1;
                break;
            case "B":
                return 2;
                break;
            case "C":
                return 3;
                break;
            case "D":
                return 4;
                break;
            case "E":
                return 5;
                break;
            case 1:
                return "A";
                break;
            case 2:
                return "B";
                break;
            case 3:
                return "C";
                break;
            case 4:
                return "D";
                break;
            case 5:
                return "E";
                break;
        }
    }
};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-02-08 07:42:27 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
