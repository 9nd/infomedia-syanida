<?php
require APPPATH . '/controllers/Pengajuan_absen/Pengajuan_absen_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Pengajuan_absen extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('T_absensi/T_absensi_model', 'tmodel');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->library('upload');
		$this->log_key = 'log_Pengajuan_absen';
		$this->title = new Pengajuan_absen_config();
	}


	public function index()
	{
		$data = array(
			'title_page_big'		=> 'Absent Management',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'T_absensi/T_absensi/refresh_table/' . $this->_token,
			'link_update'			=> site_url() . 'T_absensi/T_absensi/update',
			'link_delete'			=> site_url() . 'T_absensi/T_absensi/delete_multiple',
			'link_save'				=> site_url() . 'Pengajuan_absen/Pengajuan_absen/create_action',
			'link_back'				=> $this->agent->referrer()
		);
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));


		if ($userdata->opt_level == 11 || $userdata->opt_level == 1 ) {
			$data['query'] = $this->tmodel->live_query("
				SELECT 
				*, 
				date(waktu_in) as tanggal
				FROM t_absensi WHERE 
				(stts='Sakit' OR stts='Izin')
				");
		} else if($userdata->opt_level == 9){
			$data['query'] = $this->tmodel->live_query("
			SELECT
			sys_user.tl,
			sys_user.agentid AS agentidsys,
			t_absensi.*,
			date( t_absensi.waktu_in ) AS tanggal 
		FROM
			t_absensi
			JOIN sys_user ON t_absensi.agentid = sys_user.agentid
		WHERE 
		 sys_user.tl = '$userdata->agentid'
				");
		}else{
			$data['query'] = $this->tmodel->live_query("
				SELECT 
				*, 
				date(waktu_in) as tanggal
				FROM t_absensi WHERE 
				agentid = '$userdata->agentid'
				AND
				(stts='Sakit' OR stts='Izin')
				");
		}
		$data['Sys_user_table_model'] = $this->Sys_user_table_model;

		$this->template->load('Pengajuan_absen/Pengajuan_absen_list', $data);
	}

	public function approve($id)
	{
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		

	if($userdata->opt_level==8){
		redirect('Home');
	}else{
		$this->tmodel->live_query("UPDATE t_absensi
		SET approve_adm = 'Approved'
		WHERE id = $id ");
		redirect('Pengajuan_absen/Pengajuan_absen/index');
	}
}
	public function notapprove($id)
	{
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		

		if($userdata->opt_level==8){
			redirect('Home');
		}else{
		$this->tmodel->live_query("UPDATE t_absensi
		SET approve_adm = 'Not Approve'
		WHERE id = $id ");
		redirect('Pengajuan_absen/Pengajuan_absen/index');
	}
	}
	
	public function approvetl($id)
	{
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		

		if($userdata->opt_level==8){
			redirect('Home');
		}else{
		$this->tmodel->live_query("UPDATE t_absensi
		SET approve_tl = 'Approved'
		WHERE id = $id ");
		redirect('Pengajuan_absen/Pengajuan_absen/index');
	}
	}
	
	public function notapprovetl($id)
	{
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		

		if($userdata->opt_level==8){
			redirect('Home');
		}else{
		$this->tmodel->live_query("UPDATE t_absensi
		SET approve_tl = 'Not Approve'
		WHERE id = $id ");
		redirect('Pengajuan_absen/Pengajuan_absen/index');
	}
	}

	

	public function create()
	{
		$data = array(
			'title_page_big'		=> 'Buat Baru',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'Pengajuan_absen/Pengajuan_absen/create_action',
			'link_back'				=> $this->agent->referrer(),
		);

		$this->template->load('Pengajuan_absen/Pengajuan_absen_form', $data);
	}

	public function insertdata()
	{
		$agentid   = $this->input->post('agentid');
		$stts   = $this->input->post('stts');
		$waktu_in   = $this->input->post('waktu_in');
		$photo   = $this->input->post('photo');
		$reason   = $this->input->post('reason');

		// get foto
		$tm = time();
		$config['upload_path'] = 'upload_files/pengajuan_absen/';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size'] = '1024';  //1MB max
		$config['max_width'] = '4480'; // pixel
		$config['max_height'] = '4480'; // pixel
		//$config['file_name'] = $_FILES['fotopost']['name'];
		$config['file_name']			= $this->input->post('agentid') . '_' . $tm . '.jpg';
		$this->upload->initialize($config);
		$agentdata = $this->Sys_user_table_model->get_row(array("agentid" => $agentid));

		if (!empty($_FILES['photo']['name'])) {
			if ($this->upload->do_upload('photo')) {
				$foto = $this->upload->data();
				$data = array(
					'agentid'       => $agentid,
					'stts'       => $stts,
					'waktu_in'       => $waktu_in,
					'picture' => $config['file_name'],
					'nik' => $agentdata->nik_absensi,
					'nama' => $agentdata->nama,
					'reason' => $reason
				);
				$this->tmodel->insert($data);
				redirect('Pengajuan_absen/Pengajuan_absen/index');
			} else {
				die("gagal upload");
			}
		} else {
			echo "tidak masuk";
		}
	}

	
};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-04-01 09:25:43 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/