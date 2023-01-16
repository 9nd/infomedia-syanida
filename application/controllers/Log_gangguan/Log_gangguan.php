<?php
require APPPATH . '/controllers/Log_gangguan/Log_gangguan_config.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Log_gangguan extends CI_Controller
{
    private $log_key, $log_temp, $title;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $this->load->model('Custom_model/Dapros_infomedia_model', 'distribution');
        // $this->load->model('Custom_model/Dapros_model', 'distribution');
        $this->load->model('Custom_model/Sumber_model', 'sumber');
        $this->load->model('Custom_model/Landing_page_model', 'landing_page');
        $this->load->model('Custom_model/Failover_model', 'failover');
        $this->load->model('Custom_model/Campaign_model', 'campaign');
        $this->load->model('M_log_gangguan');
        $this->title = new Log_gangguan_config();
        $this->infomedia = $this->load->database('infomedia', TRUE);
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);
        $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $this->load->model('Custom_model/Sys_user_log_in_out_table_model', 'Sys_log');
        if ($data['userdata']->opt_level == 8) {
            $log_where = array(
                'id_user' => $logindata->id_user,
                'agentid' => $data['userdata']->agentid,
            );
            $log = $this->Sys_log->get_row($log_where, array("id,logout_time"), array("id" => "DESC"));
            if ($log) {
                if ($log->logout_time == '') {
                    redirect('Lockscreen', 'refresh');
                }
            }
        }
    }
    public function index()
    {
        $data['title'] = "Log gangguan";
        $dari = $_POST['dari'];
        $sampai = $_POST['sampai'];
        if (isset($_POST['dari']) && isset($_POST['sampai'])) {
            $where =  "WHERE date(tanggal) >= '$dari' AND date(tanggal) <= '$sampai'";
        } else {
            $where = "";
        }
        $data['laporan'] = $this->db->query("SELECT * FROM t_log_problem  $where")->result();
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);
        $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        // $data['log_gangguan'] = $this->M_log_gangguan->get_data_log_gangguan('t_log_problem')->result();
        $data['log_gangguan'] = $this->M_log_gangguan->get_nama_tl()->result();
        $this->load->view('Komponen/header', $data);
        $this->load->view('Log_gangguan/Log_gangguan', $data);
        $this->load->view('Komponen/footer');
    }

    public function tambahDataLogGangguan()
    {
        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);
        $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $data['title'] = "Tambah Data Log gangguan";
        // $data['no_ticket']=$this->M_log_gangguan->get_no_ticket();
        $this->load->view('Komponen/header', $data);
        $this->load->view('Log_gangguan/v_tambah_log_gangguan', $data);
        $this->load->view('Komponen/footer');
    }

    public function tambahDataLogGangguanAksi()
    {
        $this->_rulesloggangguan();
        if ($this->form_validation->run() == FALSE) {
            $this->tambahDataLogGangguan();
        } else {
            $cektiket = $this->db->select("no_ticket_ioc")->from('t_log_problem')->where("no_ticket_ioc", $this->input->post("no_ticket_ioc"))->get()->result_array();
            if (!empty($cektiket)) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>No.Tiket IOC sudah ada!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times</span>
            </button>
            </div>');
                $this->load->model('sys/Sys_user_log_model', 'log_login');
                $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
                $idlogin = $this->session->userdata('idlogin');
                $logindata = $this->log_login->get_by_id($idlogin);
                $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
                $data['title'] = "Tambah Data Log gangguan";
                $this->load->view('Komponen/header', $data);
                $this->load->view('Log_gangguan/v_tambah_log_gangguan', $data);
                $this->load->view('Komponen/footer');
            } else {
                $data = array(
                    'nama_tl'                 => $this->input->post('nama_tl'),
                    'kategori_gangguan'       => $this->input->post('kategori_gangguan'),
                    'detail_kendala'          => $this->input->post('detail_kendala'),
                    'agentid'                 => $this->input->post('agentid'),
                    'tanggal'                 => $this->input->post('tanggal'),
                    'no_ticket'               => $this->input->post('no_ticket'),
                    'no_ticket_ioc'           => $this->input->post('no_ticket_ioc'),
                    'evidence'                => 'no_image.jpg',
                    'status'                  => $this->input->post('status'),

                );
                $this->M_log_gangguan->insert_data_log_gangguan($data, 't_log_problem');
                $id = $this->db->insert_id();

                $file_name = 'upload_foto_evidence-' . $id;
                $config['upload_path']          = './assets/uploads/log_problemwfh';
                $config['allowed_types']        = 'gif|jpeg|png|jpg';
                $config['overwrite']            = true;
                $config['file_name']            = $file_name;
                $config['max_size']             = 10000;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('evidence')) {
                    $error = array('error' => $this->upload->display_errors());
                    $view = 'Log_gangguan/log_gangguan';
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil ditambahkan!, tetapi gambar tidak berhasil di upload</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times</span>
                </button>
                </div>');
                    // $view = 'Log_gangguan/log_gangguan';
                    $view = 'Log_gangguan/log_gangguan';
                } else {
                    $data = $this->upload->data();
                    $this->db->set('evidence', $data['file_name']);
                    $this->db->where('id', $id);
                    $this->db->update('t_log_problem');
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil ditambahkan!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times</span>
                </button>
                </div>');
                    // $view = 'Log_gangguan/log_gangguan';
                    $view = 'Log_gangguan/log_gangguan';
                }
                //cek lagi
                redirect($view);
            }
        }
    }

    public function updateDataLogGangguan($id)
    {
        $data['title'] = "Ubah Data Log gangguan";
        $where = array('id' => $id);
        $data['log_gangguan'] = $this->db->query("SELECT * FROM t_log_problem WHERE id='$id'")->result();
        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);
        $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $this->load->view('Komponen/header', $data);
        $this->load->view('Log_gangguan/v_ubah_log_gangguan', $data);
        $this->load->view('Komponen/footer');
    }

    public function updateDataLogGangguanAksi()
    {
        $this->_rulesloggangguan($this->input->post('evidence'));
        if ($this->form_validation->run() == FALSE) {
            $id = $this->input->post('id');
            $this->updateDataLogGangguan($id);
        } else {
            $data = array(
                "nama_tl"              => $this->input->post("nama_tl"),
                "agentid"              => $this->input->post("agentid"),
                "kategori_gangguan"    => $this->input->post("kategori_gangguan"),
                "detail_kendala"       => $this->input->post("detail_kendala"),
                "tanggal"              => $this->input->post("tanggal"),
                "no_ticket"            => $this->input->post("no_ticket"),
                "no_ticket_ioc"        => $this->input->post("no_ticket_ioc"),
                "evidence"             => $this->input->post("evidence"),
                "status"               => $this->input->post("status")
            );
            if ($_FILES['evidence']['name'] != "") {
                //Set Configuration Upload File
                $filename = "update_evidence-" . $this->input->post("id");
                $config['upload_path'] = './assets/uploads/log_problemwfh';
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['overwrite'] = true;
                $config['file_name'] = $filename;
                $config['max_size'] = 100000;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('evidence')) {
                    $fname = $this->upload->data('file_name');

                    $dt_update = array(
                        "nama_tl"              => $this->input->post("nama_tl"),
                        "agentid"              => $this->input->post("agentid"),
                        "kategori_gangguan"    => $this->input->post("kategori_gangguan"),
                        "detail_kendala"       => $this->input->post("detail_kendala"),
                        "tanggal"              => $this->input->post("tanggal"),
                        "no_ticket"            => $this->input->post("no_ticket"),
                        "no_ticket_ioc"        => $this->input->post("no_ticket_ioc"),
                        "status"               => $this->input->post("status"),
                        "evidence"             => $fname
                    );

                    $this->db->where('id', $this->input->post("id"));
                    $this->db->update("t_log_problem", $dt_update);
                } else {
                    print_r($this->upload->display_errors('', ''));
                    die;
                }
            } else {

                $dt_update = array(
                    "nama_tl"              => $this->input->post("nama_tl"),
                    "agentid"              => $this->input->post("agentid"),
                    "kategori_gangguan"    => $this->input->post("kategori_gangguan"),
                    "detail_kendala"       => $this->input->post("detail_kendala"),
                    "tanggal"              => $this->input->post("tanggal"),
                    "no_ticket"            => $this->input->post("no_ticket"),
                    "no_ticket_ioc"        => $this->input->post("no_ticket_ioc"),
                    "status"               => $this->input->post("status"),
                    "tanggal_selesai"      => $this->input->post("status") == "1" ? date("Y-m-d H:i:s") : $this->input->post("status"),
                    "keterangan"           => $this->input->post("status") == "1" ? "Ticket Close" : $this->input->post("status"),
                    "solusi"               => $this->input->post("solusi")
                    // "tanggal_selesai"      => date('Y-m-d H:i:s')
                    // "evidence"             => $this->input->post("evidence")

                );
                $this->db->where('id', $this->input->post("id"));
                $this->db->update("t_log_problem", $dt_update);
            }
            // ganti redirect
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil di ubah!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times</span>
            </button>
            </div>');
            $view = 'Log_gangguan/log_gangguan';
            redirect($view);
        }
    }

    public function deleteDataLogGangguan($id)
    {
        $where = array('id' => $id);
        $this->M_log_gangguan->delete_data_log_gangguan($where, 't_log_problem');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data berhasil dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times</span>
            </button>
            </div>');
        $view = 'Log_gangguan/log_gangguan';
        redirect($view);
    }

    public function _rulesloggangguan($edit = '')
    {
        $this->form_validation->set_rules('nama_tl', 'nama_tl', 'required');
        $this->form_validation->set_rules('agentid', 'agentid', 'required');
        $this->form_validation->set_rules('kategori_gangguan', 'kategori_gangguan', 'required');
        $this->form_validation->set_rules('detail_kendala', 'detail_kendala', 'required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
        $this->form_validation->set_rules('no_ticket', 'no_ticket', 'required');
        if ($edit != '') {
            $this->form_validation->set_rules('evidence', 'evidence', 'required');
            $this->form_validation->set_rules('no_ticket_ioc', 'no_ticket', 'required');
        }
    }

    /*Filter Laporan*/
    public function filter_log_gangguan()
    {
        $dari = $this->input->post('dari');
        $sampai = $this->input->post('sampai');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Filter Log Gangguan";
            $this->load->view('Komponen/header', $data);
            $this->load->view('Log_gangguan/v_filter_log_gangguan', $data);
            $this->load->view('Komponen/footer');
        } else {
            $data['laporan'] = $this->db->query("SELECT * FROM t_log_problem WHERE date(tanggal) >= '$dari' AND date(tanggal) <= '$sampai'")->result();

            $data['title'] = "Hasil Filter Laporan";
            $this->load->view('Komponen/header', $data);
            $this->load->view('Log_gangguan/log_gangguan', $data);
            $this->load->view('Komponen/footer');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('dari', 'Dari_tanggal', 'required');
        $this->form_validation->set_rules('sampai', 'Sampai_tanggal', 'required');
    }
}
