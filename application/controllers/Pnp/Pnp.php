<?php
require APPPATH . '/controllers/Distribution/Distribution_config.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pnp extends CI_Controller
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
        $this->load->model("Custom_model/Siakad_jawaban_ujian_model", "jawaban_ujian");
        $this->load->model("Custom_model/Siakad_jawaban_agent_model", "jawaban_agent");
        $this->load->model('Custom_model/Siakad_ujian_agent_model', 'ujian_agent');
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
        $this->template->load('Pnp/List', $data);
    }
    public function upload_pnp()
    {
        $data = array(
            'title_page_big'        => 'UPLOAD DATA PNP',
            'title'                    => $this->title,
            'link_create_multiple'            => site_url() . 'Pnp/Pnp/create_multiple',
            'link_download_template_dapros'    => site_url() . 'Pnp/Pnp/download_template_user/' . $this->_token,
            'link_upload_template'            => site_url() . 'Pnp/Pnp/upload_template_user/' . $this->_token,
        );
        $this->template->load('Pnp/Index', $data);
    }
    public function upload_template_user()
    {
        $post = $this->input->post();
        $tm = time();
        $config['upload_path']          = './images/user_profile/pnp/';
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 60000000;
        $config['file_name']            = time() . ".pdf";
        $config['overwrite']            = TRUE;


        $this->load->library('upload', $config);

        $o = array();
        if (!$this->upload->do_upload('inputfile')) {

            $em = $this->upload->display_errors();
            $em = str_replace('You did not select a file to upload.', 'Tidak ada file yang di pilih', $em);

            $o['success']     = 'false';
            $o['message']    = $em;
            $o['elementid'] = '#inputfile';
            $o = json_encode($o);
            echo $o;
            return;
        } else {
            $path_file = $config['file_name'];
            $data_insert = array(
                'judul' => $post['judul'],
                'waktu_mulai' => $post['waktu_mulai'],
                'waktu_selesai' => $post['waktu_selesai'],
                'durasi_waktu' => $post['durasi_waktu'],
                'tanggal' => $post['tanggal'],
                'catatan' => $post['catatan'],
                'jumlah_soal' => $post['jumlah_soal'],
                'soal' => $path_file
            );
            $this->pnp->add($data_insert);
            redirect(base_url() . "Pnp/Pnp");
        }
    }
    public function detail($id = false)
    {

        $data = array();
        ////hak akses load///
        ////get data
        $data['ujian'] = $this->pnp->get_row(array("id" => $id), array("*"));
        $data['controller'] = $this;
        $this->load->view('Pnp/detail', $data);
    }
    public function hasil($id = false)
    {

        $data = array();
        ////hak akses load///
        ////get data
        $data['datanya'] = $this->pnp->get_row(array("id" => $id), array("*"));
        $data['agent'] = $this->sys_user->get_results(array("tl !=" => "-", "opt_level" => 8, "kategori" => "REG"));
        $data['controller'] = $this;
        $this->template->load('Pnp/hasil', $data);
    }
    function data_proses()
    {
        $data = array();
        $post = $this->input->post();
        $data['num_soal'] = $this->pnp->get_row(array("id" => $post['id_soal']), array("jumlah_soal"))->jumlah_soal;
        $data['num_jawaban'] = $this->jawaban_ujian->get_count(array("id_soal" => $post['id_soal']));
        $data['persen'] = $data['num_jawaban'] / $data['num_soal'] * 100;
        $data['ujian'] = $this->pnp->get_row(array("id" => $post['id_soal']), array("*"));
        $this->load->view('Pnp/proses', $data);
    }
    function input_jawaban()
    {

        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            $where = array();
            $post['jawaban'] = $this->conver_jawaban($post['jawaban']);
            if ($this->jawaban_ujian->get_count(array("id_soal" => $post['id_soal'], "urutan" => $post['urutan'])) > 0) {
                $where = array(
                    "id_soal" => $post['id_soal'],
                    "urutan" => $post['urutan'],
                );
                $this->jawaban_ujian->edit($where, $post);
            } else {
                $this->jawaban_ujian->add($post);
            };
        }
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
