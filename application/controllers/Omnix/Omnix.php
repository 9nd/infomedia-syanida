<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form_General
 *
 * @author Dhiya
 */
class Omnix extends CI_Controller
{

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
    }

    public function index()
    {
        if ($_POST['tombol'] == "") {
            $_POST['tombol'] = "search";
        } else {
            $_POST['tombol'] =  $_POST['tombol'];
        }
        $tombol = $_POST['tombol'];
        if ($tombol == "search") {
            $dari = $_POST['dari'];
            $sampai = $_POST['sampai'];
            if (isset($_POST['dari']) && isset($_POST['sampai'])) {
                $where =  "AND date(tanggal_pengerjaan) BETWEEN '$dari' AND '$sampai'";
                $dari = $dari;
                $sampai = $sampai;
            } else {
                $where = "";
                $dari = date("Y-m-d");
                $sampai = date("Y-m-d");
            }
            $idlogin = $this->session->userdata('idlogin');
            $logindata = $this->log_login->get_by_id($idlogin);
            $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
            $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
            $agent_id = false;
            $data['optlevel'] = $userdata->opt_level;
            if ($userdata->opt_level == 8) {
                $agent_id = $userdata->agentid;
                if (isset($_POST['dari']) && isset($_POST['sampai'])) {
                    $dari = $dari;
                    $sampai = $sampai;
                } else {
                    $dari = date("Y-m-d");
                    $sampai = date("Y-m-d");
                }
            }
            $usersz =  $data['userdata'];
            $data['title'] = "Omnix Multichannel Profiling";
            if ($usersz->agentid != "" || $usersz->agentid != NULL) {
                $data['omnix_report'] = $this->M_omnix->get_data_omnix($agent_id, $optlevel, 't_omnix_report', $where, $dari, $sampai);
                $this->load->view('Komponen/header', $data);
                $this->load->view('Omnix/Omnix', $data);
                $this->load->view('Komponen/footer', $userdata);
            } else {
                redirect('auth', refresh);
            }
        } elseif ($tombol == "export_done") {
            $this->export_done();
            // echo "else";
        } else {
            $this->export();
        }
    }
    public function tambahDataOmnix()
    {
        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);
        $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $data['title'] = "Tambah Data Omnix Multichannel Profiling";
        // $data['no_ticket']=$this->M_log_gangguan->get_no_ticket();
        $usersz =  $data['userdata'];
        if ($usersz->agentid != "" || $usersz->agentid != NULL) {
            $this->load->view('Komponen/header', $data);
            $this->load->view('Omnix/v_tambah_omnix', $data);
            $this->load->view('Komponen/footer');
        } else {
            redirect('auth', refresh);
        }
    }

    public function tambahOmnixAksi()
    {
        $data = array(
            'tanggal_pengerjaan'  => $this->input->post('tanggal_pengerjaan'),
            'tanggal_call_indri'  => $this->input->post('tanggal_call_indri'),
            'no_internet'         => $this->input->post('no_internet'),
            'hp_1'                => $this->input->post('hp_1'),
            'hp_2'                => $this->input->post('hp_2'),
            'hp_3'                => $this->input->post('hp_3'),
            'email_1'             => $this->input->post('email_1'),
            'email_2'             => $this->input->post('email_2'),
            'email_3'             => $this->input->post('email_3'),
            'reason_omnix'        => $this->input->post('reason_omnix'),
            'channel_available'   => $this->input->post('channel_available'),
            'wa_kirim'            => $this->input->post('wa_kirim'),
            'status_wa'           => $this->input->post('status_wa'),
            'email_kirim'         => $this->input->post('email_kirim'),
            'status_email'        => $this->input->post('status_email'),
            'instagram'           => $this->input->post('instagram'),
            'status_ig'           => $this->input->post('status_ig'),
            'facebook'            => $this->input->post('facebook'),
            'status_fb'           => $this->input->post('status_fb'),
            'twitter'             => $this->input->post('twitter'),
            'status_tw'           => $this->input->post('status_tw'),
            'keterangan'          => $this->input->post('keterangan'),
            'agentid'             => $this->input->post('agentid'),
            'status'              => $this->input->post('status'),
        );
        $this->M_omnix->tambahomnix($data);
        $this->session->set_flashdata('notif', '<div id="notifikasi" class="alert alert-success" role="alert"> Data Berhasil ditambahkan </div>');
        redirect('Omnix/omnix');
    }

    //Omnix//
    public function updateDataOmnix($id)
    {
        $this->load->model('sys/Sys_user_log_model', 'log_login');
        $this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);
        $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $data['title'] = "Ubah Data Omnix";
        $where = array('id' => $id);
        $data['omnix_report'] = $this->db->query("SELECT * FROM t_omnix_report WHERE id='$id'")->result();
	$usersz =  $data['userdata'];
        if ($usersz->agentid != "" || $usersz->agentid != NULL) {
	   $this->load->view('Komponen/header', $data);
           $this->load->view('Omnix/v_ubah_omnix', $data);
           $this->load->view('Komponen/footer');
	}else{
	   redirect('auth', refresh);
	}
       
    }
    //Update Omnix//
    public function updateOmnixAksi()
    {
        $data = array(
            "tanggal_pengerjaan" => $_POST['tanggal_pengerjaan'],
            "tanggal_call_indri" => $_POST['tanggal_call_indri'],
            "no_internet"        => $_POST['no_internet'],
            "hp_1"               => $_POST['hp_1'],
            "hp_2"               => $_POST['hp_2'],
            "hp_3"               => $_POST['hp_3'],
            "email_1"            => $_POST['email_1'],
            "email_2"            => $_POST['email_2'],
            "email_3"            => $_POST['email_3'],
            "reason_omnix"       => $_POST['reason_omnix'],
            "channel_available"  => $_POST['channel_available'],
            "wa_kirim"           => $_POST['wa_kirim'],
            "status_wa"          => $_POST['status_wa'],
            "email_kirim"        => $_POST['email_kirim'],
            "status_email"       => $_POST['status_email'],
            "instagram"          => $_POST['instagram'],
            "status_ig"          => $_POST['status_ig'],
            "facebook"           => $_POST['facebook'],
            "status_fb"          => $_POST['status_fb'],
            "twitter"            => $_POST['twitter'],
            "status_tw"          => $_POST['status_tw'],
            "keterangan"         => $_POST['keterangan'],
            "agentid"            => $_POST['agentid'],
            "status"             => $_POST['status'],

            // "update_time"     =>date("Y-m-d H:i:s"),
            // "status_approve"  =>$this->input->post('status_merchant')== "4" ? "Belum Disetujui" : $this->input->post("status_merchant"),


        );
        $this->db->where('id', $_POST['id']);
        $this->db->update('t_omnix_report', $data);
        $this->session->set_flashdata('sukses', '<div id="notifikasi" class="alert alert-success" role="alert"> Data Berhasil diedit </div>');
        redirect('Omnix/Omnix');
    }
    //Update Omnix//

    /*Export Excel Omnix*/
    public function export()
    {

        // Load plugin PHPExcel nya
        include APPPATH . 'third_party/PHPExcel.php';

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();

        // Settingan awal fil excel
        $excel->getProperties()->setCreator('Profiling Consumer')
            ->setLastModifiedBy('Team Leader')
            ->setTitle("Data Omnix")
            ->setSubject("Pengguna")
            ->setDescription("DATA OMNIX MULTICHANNEL PROFILING")
            ->setKeywords("Data Omnix");

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "OMNIX MULTICHANNEL PROFILING"); // Set kolom A1 dengan tulisan "DATA PENGGUNA"
        $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "TANGGAL PENGERJAAN "); // Set kolom B3 dengan tulisan "TGL PENGERJAAN"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "TANGGAL CALL INDRI"); // Set kolom C3 dengan tulisan "TGL CALL INDRI"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "NO INTERNET"); // Set kolom D3 dengan tulisan "NO INTERNET"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "HP 1"); // Set kolom E3 dengan tulisan "NO HP"
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "HP 2"); // Set kolom E3 dengan tulisan "NO HP"
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "HP 3"); // Set kolom E3 dengan tulisan "NO HP"
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "EMAIL 1"); // Set kolom E3 dengan tulisan "EMAIL"
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "EMAIL 2"); // Set kolom E3 dengan tulisan "EMAIL"
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "EMAIL 3"); // Set kolom E3 dengan tulisan "EMAIL"
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "REASON OMNIX"); // Set kolom E3 dengan tulisan "REASON"
        $excel->setActiveSheetIndex(0)->setCellValue('L3', "CHANNEL AVAILABLE"); // Set kolom E3 dengan tulisan "CHANNEL"
        $excel->setActiveSheetIndex(0)->setCellValue('M3', "WHATSAPP KIRIM"); // Set kolom E3 dengan tulisan "WHATSAPP"
        $excel->setActiveSheetIndex(0)->setCellValue('N3', "STATUS WHATSAPP"); // Set kolom E3 dengan tulisan "WHATSAPP STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "EMAIL KIRIM"); // Set kolom E3 dengan tulisan "EMAIL"
        $excel->setActiveSheetIndex(0)->setCellValue('P3', "STATUS EMAIL"); // Set kolom E3 dengan tulisan "EMAIL STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('Q3', "INSTAGRAM"); // Set kolom E3 dengan tulisan "INSTAGRAM"
        $excel->setActiveSheetIndex(0)->setCellValue('R3', "STATUS INSTAGRAM"); // Set kolom E3 dengan tulisan "INSTAGRAM STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('S3', "FACEBOOK"); // Set kolom E3 dengan tulisan "INSTAGRAM STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('T3', "STATUS FACEBOOK"); // Set kolom E3 dengan tulisan "INSTAGRAM STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('U3', "TWITTER"); // Set kolom E3 dengan tulisan "INSTAGRAM STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('V3', "STATUS TWITTER"); // Set kolom E3 dengan tulisan "INSTAGRAM STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('W3', "TELEGRAM"); // Set kolom E3 dengan tulisan "INSTAGRAM STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('X3', "KETERANGAN"); // Set kolom E3 dengan tulisan "INSTAGRAM STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('Y3', "AGENT"); // Set kolom E3 dengan tulisan "INSTAGRAM STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('Z3', "STATUS"); // Set kolom E3 dengan tulisan "INSTAGRAM STATUS"


        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('T3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('U3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('V3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('W3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('X3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('Y3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('Z3')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data Omnix
        $dari = $_POST['dari'];
        $sampai = $_POST['sampai'];
        if (isset($_POST['dari']) && isset($_POST['sampai'])) {
            $where =  "AND date(tanggal_pengerjaan) BETWEEN '$dari' AND '$sampai'";
            $dari = $dari;
            $sampai = $sampai;
        } else {
            $where = "";
            $dari = date("Y-m-d");
            $sampai = date("Y-m-d");
        }
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);
        $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $agent_id = false;
        $data['optlevel'] = $userdata->opt_level;
        if ($userdata->opt_level == 8) {
            $agent_id = $userdata->agentid;
            if (isset($_POST['dari']) && isset($_POST['sampai'])) {
                $dari = $dari;
                $sampai = $sampai;
            } else {
                $dari = date("Y-m-d");
                $sampai = date("Y-m-d");
            }
        }
        $optlevel = $userdata->opt_level;
        $omnix_report = $this->M_omnix->get_data_omnix($agent_id, $optlevel, 't_omnix_report', $where, $dari, $sampai);

        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($omnix_report as $data) { // Lakukan looping pada variabel siswa
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->tanggal_pengerjaan);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->tanggal_call_indri);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->no_internet);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->hp_1);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->hp_2);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->hp_3);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data->email_1);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data->email_2);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data->email_3);

            //reason
            if ($data->reason_omnix == "1") {
                $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, 'Ada di Omnix');
            }
            if ($data->reason_omnix == "0") {
                $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, 'Tidak Ada di Omnix');
            }
            if ($data->reason_omnix == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, '-');
            }
            //reason end

            //Channel Available
            if ($data->channel_available == "5") {
                $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, 'Telegram');
            }
            if ($data->channel_available == "4") {
                $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, 'Whatsapp');
            }
            if ($data->channel_available == "3") {
                $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, 'Instagram');
            }
            if ($data->channel_available == "2") {
                $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, 'Facebook');
            }
            if ($data->channel_available == "1") {
                $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, 'Twitter');
            }
            if ($data->channel_available == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, '-');
            }
            //Channel Available

            //Wa Kirim
            if ($data->wa_kirim != "") {
                $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, $data->wa_kirim);
            }
            if ($data->wa_kirim == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, '-');
            }
            //Wa Kirim End 

            //Status Wa 
            if ($data->status_wa == "1") {
                $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, 'WhatsApp Succesfully Sent');
            }
            if ($data->status_wa == "0") {
                $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, 'WhatsApp Failed Sent');
            }
            if ($data->status_wa == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, '-');
            }
            //Status Wa End 

            //Email Kirim
            if ($data->email_kirim != "") {
                $excel->setActiveSheetIndex(0)->setCellValue('O' . $numrow, $data->email_kirim);
            }
            if ($data->email_kirim == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('O' . $numrow, '-');
            }
            //Email Kirim End 

            //Status Email 
            if ($data->status_email == "1") {
                $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, 'Email Succesfully Sent');
            }
            if ($data->status_email == "0") {
                $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, 'Email Failed Sent');
            }
            if ($data->status_email == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, '-');
            }
            //Status Email End

            //Instagram Kirim
            if ($data->instagram != "") {
                $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, $data->instagram);
            }
            if ($data->instagram == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, '-');
            }
            //Instagram Kirim End 

            //Status Instagram 
            if ($data->status_ig == "1") {
                $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, 'Instagram Succesfully Sent');
            }
            if ($data->status_ig == "0") {
                $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, 'Instagram Failed Sent');
            }
            if ($data->status_ig == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, '-');
            }
            //Status Instagram End

            //Facebook Kirim
            if ($data->facebook != "") {
                $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, $data->facebook);
            }
            if ($data->facebook == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, '-');
            }
            //Facebook Kirim End 

            //Status Facebook 
            if ($data->status_fb == "1") {
                $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, 'Facebook Succesfully Sent');
            }
            if ($data->status_fb == "0") {
                $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, 'Facebook Failed Sent');
            }
            if ($data->status_fb == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, '-');
            }
            //Status Facebook End

            //Twitter Kirim
            if ($data->twitter != "") {
                $excel->setActiveSheetIndex(0)->setCellValue('U' . $numrow, $data->twitter);
            }
            if ($data->twitter == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('U' . $numrow, '-');
            }
            //Twitter Kirim End 

            //Status Twitter 
            if ($data->status_tw == "1") {
                $excel->setActiveSheetIndex(0)->setCellValue('V' . $numrow, 'Twitter Succesfully Sent');
            }
            if ($data->status_tw == "0") {
                $excel->setActiveSheetIndex(0)->setCellValue('V' . $numrow, 'Twitter Failed Sent');
            }
            if ($data->status_tw == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('V' . $numrow, '-');
            }
            //Status Twitter End

            //Telegram
            if ($data->keterangan_telegram != "") {
                $excel->setActiveSheetIndex(0)->setCellValue('W' . $numrow, $data->keterangan_telegram);
            }
            if ($data->keterangan_telegram == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('W' . $numrow, '-');
            }
            //Telegram End 

            //Keterangan
            if ($data->keterangan != "") {
                $excel->setActiveSheetIndex(0)->setCellValue('X' . $numrow, $data->keterangan);
            }
            if ($data->keterangan == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('X' . $numrow, '-');
            }
            //Keterangan End 

            $excel->setActiveSheetIndex(0)->setCellValue('Y' . $numrow, $data->agentid);

            //Status Pengerjaan 
            if ($data->status == "1") {
                $excel->setActiveSheetIndex(0)->setCellValue('Z' . $numrow, 'On Progress');
            }
            if ($data->status == "2") {
                $excel->setActiveSheetIndex(0)->setCellValue('Z' . $numrow, 'Done');
            }
            //Status Pengerjaan End

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('R' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('S' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('T' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('U' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('V' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('W' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('X' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('Y' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('Z' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom F
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(30); // Set width kolom G
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30); // Set width kolom H
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('M')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('N')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('P')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('Q')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('R')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('S')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('T')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('U')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('V')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('W')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('X')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('Y')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('Z')->setWidth(30); // Set width kolom I

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Data Omnix");
        $excel->setActiveSheetIndex(0);

        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data_Omnix.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
        // var_dump($agent_id);
        // var_dump($optlevel); 
        // var_dump($where); 
        // var_dump($dari); 
        // var_dump($sampai); 

    }

    /*End Export Excel OMNIX*/

    /*Export Excel Omnix Status Done*/
    public function export_done()
    {

        // Load plugin PHPExcel nya
        include APPPATH . 'third_party/PHPExcel.php';

        // Panggil class PHPExcel nya
        $excel = new PHPExcel();

        // Settingan awal fil excel
        $excel->getProperties()->setCreator('Profiling Consumer')
            ->setLastModifiedBy('Team Leader')
            ->setTitle("Data Omnix")
            ->setSubject("Pengguna")
            ->setDescription("DATA OMNIX MULTICHANNEL PROFILING STATUS DONE")
            ->setKeywords("Data Omnix");

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "OMNIX MULTICHANNEL PROFILING"); // Set kolom A1 dengan tulisan "DATA PENGGUNA"
        $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "TANGGAL PENGERJAAN "); // Set kolom B3 dengan tulisan "TGL PENGERJAAN"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "TANGGAL CALL INDRI"); // Set kolom C3 dengan tulisan "TGL CALL INDRI"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "NO INTERNET"); // Set kolom D3 dengan tulisan "NO INTERNET"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "HP 1"); // Set kolom E3 dengan tulisan "NO HP"
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "HP 2"); // Set kolom E3 dengan tulisan "NO HP"
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "HP 3"); // Set kolom E3 dengan tulisan "NO HP"
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "EMAIL 1"); // Set kolom E3 dengan tulisan "EMAIL"
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "EMAIL 2"); // Set kolom E3 dengan tulisan "EMAIL"
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "EMAIL 3"); // Set kolom E3 dengan tulisan "EMAIL"
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "REASON OMNIX"); // Set kolom E3 dengan tulisan "REASON"
        $excel->setActiveSheetIndex(0)->setCellValue('L3', "CHANNEL AVAILABLE"); // Set kolom E3 dengan tulisan "CHANNEL"
        $excel->setActiveSheetIndex(0)->setCellValue('M3', "WHATSAPP KIRIM"); // Set kolom E3 dengan tulisan "WHATSAPP"
        $excel->setActiveSheetIndex(0)->setCellValue('N3', "STATUS WHATSAPP"); // Set kolom E3 dengan tulisan "WHATSAPP STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "EMAIL KIRIM"); // Set kolom E3 dengan tulisan "EMAIL"
        $excel->setActiveSheetIndex(0)->setCellValue('P3', "STATUS EMAIL"); // Set kolom E3 dengan tulisan "EMAIL STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('Q3', "INSTAGRAM"); // Set kolom E3 dengan tulisan "INSTAGRAM"
        $excel->setActiveSheetIndex(0)->setCellValue('R3', "STATUS INSTAGRAM"); // Set kolom E3 dengan tulisan "INSTAGRAM STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('S3', "FACEBOOK"); // Set kolom E3 dengan tulisan "INSTAGRAM STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('T3', "STATUS FACEBOOK"); // Set kolom E3 dengan tulisan "INSTAGRAM STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('U3', "TWITTER"); // Set kolom E3 dengan tulisan "INSTAGRAM STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('V3', "STATUS TWITTER"); // Set kolom E3 dengan tulisan "INSTAGRAM STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('W3', "TELEGRAM"); // Set kolom E3 dengan tulisan "INSTAGRAM STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('X3', "KETERANGAN"); // Set kolom E3 dengan tulisan "INSTAGRAM STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('Y3', "AGENT"); // Set kolom E3 dengan tulisan "INSTAGRAM STATUS"
        $excel->setActiveSheetIndex(0)->setCellValue('Z3', "STATUS"); // Set kolom E3 dengan tulisan "INSTAGRAM STATUS"


        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('T3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('U3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('V3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('W3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('X3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('Y3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('Z3')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data Omnix

        $dari = $_POST['dari'];
        $sampai = $_POST['sampai'];
        if (isset($_POST['dari']) && isset($_POST['sampai'])) {
            $where =  "AND date(tanggal_pengerjaan) BETWEEN '$dari' AND '$sampai' AND status='2'";
            $dari = $dari;
            $sampai = $sampai;
        } else {
            $where = "";
            $dari = date("Y-m-d");
            $sampai = date("Y-m-d");
        }
        $idlogin = $this->session->userdata('idlogin');
        $logindata = $this->log_login->get_by_id($idlogin);
        $data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
        $agent_id = false;
        $data['optlevel'] = $userdata->opt_level;
        if ($userdata->opt_level == 8) {
            $agent_id = $userdata->agentid;
            if (isset($_POST['dari']) && isset($_POST['sampai'])) {
                $dari = $dari;
                $sampai = $sampai;
            } else {
                $dari = date("Y-m-d");
                $sampai = date("Y-m-d");
            }
        }
        $optlevel = $userdata->opt_level;
        $omnix_report = $this->M_omnix->get_data_omnix_status_done($agent_id, $optlevel, 't_omnix_report', $where, $dari, $sampai);


        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($omnix_report as $data) { // Lakukan looping pada variabel siswa
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->tanggal_pengerjaan);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->tanggal_call_indri);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->no_internet);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->hp_1);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->hp_2);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->hp_3);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data->email_1);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data->email_2);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data->email_3);

            //reason
            if ($data->reason_omnix == "1") {
                $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, 'Ada di Omnix');
            }
            if ($data->reason_omnix == "0") {
                $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, 'Tidak Ada di Omnix');
            }
            if ($data->reason_omnix == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, '-');
            }
            //reason end

            //Channel Available
            if ($data->channel_available == "5") {
                $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, 'Telegram');
            }
            if ($data->channel_available == "4") {
                $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, 'Whatsapp');
            }
            if ($data->channel_available == "3") {
                $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, 'Instagram');
            }
            if ($data->channel_available == "2") {
                $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, 'Facebook');
            }
            if ($data->channel_available == "1") {
                $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, 'Twitter');
            }
            if ($data->channel_available == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, '-');
            }
            //Channel Available

            //Wa Kirim
            if ($data->wa_kirim != "") {
                $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, $data->wa_kirim);
            }
            if ($data->wa_kirim == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, '-');
            }
            //Wa Kirim End 

            //Status Wa 
            if ($data->status_wa == "1") {
                $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, 'WhatsApp Succesfully Sent');
            }
            if ($data->status_wa == "0") {
                $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, 'WhatsApp Failed Sent');
            }
            if ($data->status_wa == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, '-');
            }
            //Status Wa End 

            //Email Kirim
            if ($data->email_kirim != "") {
                $excel->setActiveSheetIndex(0)->setCellValue('O' . $numrow, $data->email_kirim);
            }
            if ($data->email_kirim == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('O' . $numrow, '-');
            }
            //Email Kirim End 

            //Status Email 
            if ($data->status_email == "1") {
                $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, 'Email Succesfully Sent');
            }
            if ($data->status_email == "0") {
                $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, 'Email Failed Sent');
            }
            if ($data->status_email == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, '-');
            }
            //Status Email End

            //Instagram Kirim
            if ($data->instagram != "") {
                $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, $data->instagram);
            }
            if ($data->instagram == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, '-');
            }
            //Instagram Kirim End 

            //Status Instagram 
            if ($data->status_ig == "1") {
                $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, 'Instagram Succesfully Sent');
            }
            if ($data->status_ig == "0") {
                $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, 'Instagram Failed Sent');
            }
            if ($data->status_ig == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, '-');
            }
            //Status Instagram End

            //Facebook Kirim
            if ($data->facebook != "") {
                $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, $data->facebook);
            }
            if ($data->facebook == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, '-');
            }
            //Facebook Kirim End 

            //Status Facebook 
            if ($data->status_fb == "1") {
                $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, 'Facebook Succesfully Sent');
            }
            if ($data->status_fb == "0") {
                $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, 'Facebook Failed Sent');
            }
            if ($data->status_fb == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, '-');
            }
            //Status Facebook End

            //Twitter Kirim
            if ($data->twitter != "") {
                $excel->setActiveSheetIndex(0)->setCellValue('U' . $numrow, $data->twitter);
            }
            if ($data->twitter == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('U' . $numrow, '-');
            }
            //Twitter Kirim End 

            //Status Twitter 
            if ($data->status_tw == "1") {
                $excel->setActiveSheetIndex(0)->setCellValue('V' . $numrow, 'Twitter Succesfully Sent');
            }
            if ($data->status_tw == "0") {
                $excel->setActiveSheetIndex(0)->setCellValue('V' . $numrow, 'Twitter Failed Sent');
            }
            if ($data->status_tw == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('V' . $numrow, '-');
            }
            //Status Twitter End

            //Telegram
            if ($data->keterangan_telegram != "") {
                $excel->setActiveSheetIndex(0)->setCellValue('W' . $numrow, $data->keterangan_telegram);
            }
            if ($data->keterangan_telegram == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('W' . $numrow, '-');
            }
            //Telegram End 

            //Keterangan
            if ($data->keterangan != "") {
                $excel->setActiveSheetIndex(0)->setCellValue('X' . $numrow, $data->keterangan);
            }
            if ($data->keterangan == "") {
                $excel->setActiveSheetIndex(0)->setCellValue('X' . $numrow, '-');
            }
            //Keterangan End 

            $excel->setActiveSheetIndex(0)->setCellValue('Y' . $numrow, $data->agentid);

            //Status Pengerjaan 
            if ($data->status == "1") {
                $excel->setActiveSheetIndex(0)->setCellValue('Z' . $numrow, 'On Progress');
            }
            if ($data->status == "2") {
                $excel->setActiveSheetIndex(0)->setCellValue('Z' . $numrow, 'Done');
            }
            //Status Pengerjaan End

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('L' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('M' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('N' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('O' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('P' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('Q' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('R' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('S' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('T' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('U' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('V' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('W' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('X' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('Y' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('Z' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom F
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(30); // Set width kolom G
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30); // Set width kolom H
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('M')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('N')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('P')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('Q')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('R')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('S')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('T')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('U')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('V')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('W')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('X')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('Y')->setWidth(30); // Set width kolom I
        $excel->getActiveSheet()->getColumnDimension('Z')->setWidth(30); // Set width kolom I

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Data Omnix");
        $excel->setActiveSheetIndex(0);

        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data_Omnix.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
        // var_dump($agent_id);
        // var_dump($optlevel); 
        // var_dump($where); 
        // var_dump($dari); 
        // var_dump($sampai); 

    }
    /*End Export Excel OMNIX Status Done*/
}
