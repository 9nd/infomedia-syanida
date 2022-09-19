<?php
require APPPATH . '/controllers/T_pembinaan_nonq/T_pembinaan_nonq_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class T_pembinaan_nonq extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('T_pembinaan_nonq/T_pembinaan_nonq_model', 'tmodel');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->log_key = 'log_T_pembinaan_nonq';
		$this->title = new T_pembinaan_nonq_config();
	}


	public function index()
	{
		$data = array(
			'title_page_big'		=> 'DAFTAR',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'T_pembinaan_nonq/T_pembinaan_nonq/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'T_pembinaan_nonq/T_pembinaan_nonq/create',
			'link_update'			=> site_url() . 'T_pembinaan_nonq/T_pembinaan_nonq/update',
			'link_delete'			=> site_url() . 'T_pembinaan_nonq/T_pembinaan_nonq/delete_multiple',
		);
		$data["batl"] = $this->db->query("SELECT * FROM t_pembinaan_nonq GROUP BY agentid, tanggal_pembinaan")->result();
		$this->template->load('T_pembinaan_nonq/T_pembinaan_nonq_list', $data);
	}

	public function hapus()
	{
		$delete_id = $_POST["delete_id"];
		$this->db->query("DELETE FROM t_pembinaan_nonq WHERE id='$delete_id'");
	}

	public function get_kasus()
	{
		$agentid = $_GET['agentid'];
		$tanggal = $_GET['tanggal'];
		$data["datanya"] = $this->db->query("SELECT * FROM t_pembinaan_nonq WHERE agentid='$agentid' AND tanggal_pembinaan='$tanggal'");
		$data["ctrl"] = $this;
		$this->load->view('T_pembinaan_nonq/tabledata', $data);
	}

	public function updatep()
	{

		$penyuluhan = $_POST["penyuluhan"];
		$tingkat_pembinaan = $_POST["tingkat_pembinaan"];
		$agentid = $_POST["agentid"];
		$tanggal = $_POST["tanggal"];
		$data = array(
			"tingkat_pembinaan" => $tingkat_pembinaan,
			"penyuluhan" => $penyuluhan
		);
		if ($agentid != "" && $tanggal != "") {
			$this->db->where('agentid', $agentid);
			$this->db->where('tanggal_pembinaan', $tanggal);
			$update = $this->db->update('t_pembinaan_nonq', $data);
		}
		// 	if ($agentid != "" && $tanggal != "") {
		// 		$this->db->query("UPDATE t_pembinaan SET tingkat_pembinaan='$jenis_pembinaan' WHERE agentid='$agentid' AND tanggal_pembinaan='$tanggal' ");


		if ($update) {
			$namatk = $this->jenis($tingkat_pembinaan);
			$this->load->library('telegram');
			$pesan = "<b>Coaching Non Quality ditambahkan</b> 
	Tanggal: " . $tanggal . " 
	penyuluhan : " . $penyuluhan . "
	agentid : " . $agentid . "
	coaching : " . $namatk;

			$query = $this->db->query("SELECT agentid, opt_level, chat_id_telegram, tl FROM sys_user WHERE agentid='$agentid'")->row();
			$querytl = $this->db->query("SELECT agentid, opt_level, chat_id_telegram FROM sys_user WHERE agentid='$query->tl'")->row();
			if ($query->chat_id_telegram != "" || $query->chat_id_telegram != NULL) {
				$this->telegram->send_manual($pesan, $query->agentid, $query->opt_level, $query->chat_id_telegram);
				$this->telegram->send_manual($pesan, $querytl->agentid, $querytl->opt_level, $querytl->chat_id_telegram);
			}
		}
	}
	public function refresh_table($token)
	{
		if ($token == $this->_token) {
			$row = $this->tmodel->json();

			//encode id 
			$tm = time();
			$this->session->set_userdata($this->log_key, $tm);
			$x = 0;
			foreach ($row['data'] as $val) {
				$idgenerate = _encode_id($val['id'], $tm);
				$row['data'][$x]['id'] = $idgenerate;
				$x++;
			}

			$o = new Outputview();
			$o->success	= 'true';
			$o->serverside	= 'true';
			$o->message	= $row;

			echo $o->result();
		} else {
			redirect('Auth');
		}
	}

	public function insertk()
	{
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

		if (isset($_POST["agentid"]) && isset($_POST["tanggal"])) {
			$tanggal = $_POST["tanggal"];
			$agentid = $_POST["agentid"];
			$tanggalk = $_POST["tanggalk"];
			$parameter = $_POST["parameter"];
			$no_hp = $_POST["no_hp"];
			$detail_not_approve = $_POST["detail_not_approve"];
			$input_by = $data['userdata']->agentid;
			$data = array(
				"agentid" => "$agentid",
				"tanggal_pembinaan" => "$tanggal",
				"tglk" => "$tanggalk",
				"paramk" => "$parameter",
				"nohpk" => "$no_hp",
				"detailnotk" => "$detail_not_approve",
				"input_by" => "$input_by"
			);
			$this->db->insert("t_pembinaan_nonq", $data);
		}
	}
	public function detail()
	{
		$id = $_GET['id'];
		$data = array(
			'title_page_big'		=> 'Buat Baru',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'T_pembinaan_nonq/T_pembinaan_nonq/create_action',
			'link_back'				=> $this->agent->referrer(),
		);
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$filter_agent = array("opt_level" => 8,  "tl !=" => "-",  "kategori" => "REG");
		$data['data'] = $this->db->query("SELECT * FROM T_pembinaan_nonq WHERE id=$id")->row();
		if (isset($data['data'])) {
			$data['nama_konseling'] = $this->penerima($data['data']->nama_konseling);
			$data['konselor'] = $this->penerima($data['data']->konselor);
			$data['get_jenis'] = $this->jenis($data['data']->jenis_pembinaan);
			$data['nik_konselor'] = $this->user($data['data']->konselor);
			$data['nik_penerima'] = $this->user($data['data']->nama_konseling);
		}
		$data['list_agent_d'] = $this->Sys_user_table_model->get_results($filter_agent);
		$data['ctrl'] = $this;
		$this->template->load('T_pembinaan_nonq/T_pembinaan_nonq_form_detail', $data);
	}
	public function ambilform()
	{
		$data['tanggal'] = $_GET['tanggal'];
		$data['penerima'] = $_GET['agentid'];
		$tanggal = $_GET['tanggal'];
		$agent = $_GET['agentid'];
		$tl = $this->db->query("SELECT * FROM sys_user WHERE agentid='$agent'")->row()->tl;
		$tk = $this->db->query("SELECT tingkat_pembinaan FROM t_pembinaan_nonq WHERE agentid='$agent' AND tanggal_pembinaan='$tanggal'")->row()->tingkat_pembinaan;
		$data['atasan'] = $this->user($tl);
		$data['penyuluhan'] = $this->penyuluhan($agent, $tanggal);
		$data['cases'] = $this->cases($agent, $tanggal);
		$data['actionplan'] = $this->ap($agent, $tanggal);
		if (isset($tk)) {
			$data['tkpembinaan'] = $this->jenis($tk);
		}

		$data['ctrl'] = $this;
		$this->load->view('T_pembinaan_nonq/formakonseling', $data);
		// var_dump($data['cases']);
	}
	public function penerima($agentid)
	{
		$qry = $this->db->query("SELECT * FROM sys_user WHERE agentid='$agentid'")->row();
		$nama = $qry->nama;
		return $nama;
	}
	public function penyuluhan($agent, $tanggal)
	{
		$qry = $this->db->query("SELECT penyuluhan FROM t_pembinaan_nonq WHERE agentid='$agent' AND tanggal_pembinaan='$tanggal' LIMIT 1")->row();
		$nama = $qry->penyuluhan;
		return $nama;
	}
	public function ap($agent, $tanggal)
	{
		$qry = $this->db->query("SELECT ap FROM t_pembinaan_nonq WHERE agentid='$agent' AND tanggal_pembinaan='$tanggal' LIMIT 1")->row();
		$nama = $qry->ap;
		return $nama;
	}
	public function cases($agent, $tanggal)
	{
		$qry = array();
		$qry = $this->db->query("SELECT * FROM t_pembinaan_nonq WHERE agentid='$agent' AND tanggal_pembinaan='$tanggal'")->result();
		return $qry;
	}

	public function user($agentid)
	{
		$qry = $this->db->query("SELECT * FROM sys_user WHERE agentid='$agentid'")->row()->nama;
		return $qry;
	}
	public function jenis($jenis)
	{
		$qry = $this->db->query("SELECT * FROM t_pembinaan_kode WHERE kode='$jenis'")->row();
		$nama = $qry->nama_pembinaan;
		return $nama;
	}

	public function create()
	{
		$data = array(
			'title_page_big'		=> 'Buat Baru',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'T_pembinaan_nonq/T_pembinaan_nonq/create_action',
			'link_back'				=> $this->agent->referrer(),
		);
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$filter_agent = array("opt_level" => 8,  "tl !=" => "-",  "kategori" => "REG");
		$data['list_agent_d'] = $this->Sys_user_table_model->get_results($filter_agent);
		$this->template->load('T_pembinaan_nonq/T_pembinaan_nonq_form', $data);
	}

	public function create_action()
	{
		$data 	= $this->input->post('data_ajax', true);
		$val	= json_decode($data, true);
		$o		= new Outputview();

		/* 
		*	untuk mengganti message output
		* tambahkan perintah : $o->message = 'isi pesan'; 
 		* sebelum perintah validasi.
		* ex.
		* 	$o->message = 'halo ini pesan baru';
		* 	if(!$o->not_empty($val['descriptions'],'#descriptions')){
		*		echo $o->result();	
		*		return;
		*  	}
		*
		*/
		unset($val['id']);
		$success = $this->tmodel->insert($val);
		echo $o->auto_result($success);
		$jenis_pembinaan = $this->jenis($val['jenis_pembinaan']);
		// 		if ($success) {

		// 			$this->load->library('telegram');

		// 			$agentid = $val['nama_konseling'];
		// 			$pesan = "<b>Konseling telah ditambahkan</b> 
		// Tanggal  : " . $val['bulan_tahun'] . " 
		// Agentid penerima : " . $val['nama_konseling'] . " 
		// Konselor : " . $val['konselor'] . " 
		// Data Performance : " . $val['data_performance'] . "
		// Ketidak Sesuaian : " . $val['ketidaksesuaian'] . "
		// Jenis Pembinaan : " . $jenis_pembinaan . "
		// Komitmen : " . $val['komitmen_perbaikan'];

		// 			$query = $this->db->query("SELECT agentid, opt_level, chat_id_telegram, tl FROM sys_user WHERE agentid='$agentid'")->row();
		// 			$querytl = $this->db->query("SELECT agentid, opt_level, chat_id_telegram FROM sys_user WHERE agentid='$query->tl'")->row();
		// 			if ($query->chat_id_telegram != "" || $query->chat_id_telegram != NULL) {
		// 				$this->telegram->send_manual($pesan, $query->agentid, $query->opt_level, $query->chat_id_telegram);
		// 				$this->telegram->send_manual($pesan, $querytl->agentid, $querytl->opt_level, $querytl->chat_id_telegram);
		// 			}
		// 		}
	}

	public function update($id)
	{
		$id 				= $this->security->xss_clean($id);
		$id_generate		= $id;

		/** proses decode id 
		 * important !! tempdata digunakan sbagai antisipasi
		 * perubahan session saat membuka tab baru secara bersamaan
		 **/
		$this->log_temp	= $this->session->userdata($this->log_key);
		$this->session->set_tempdata($id, $this->log_temp, 300);

		//mengembalikan id asli
		$id = _decode_id($id, $this->log_temp);

		$row = $this->tmodel->get_by_id($id);

		if ($row) {
			$data = array(
				'title_page_big'		=> 'Buat Baru',
				'title'					=> $this->title,
				'link_save'				=> site_url() . 'T_pembinaan_nonq/T_pembinaan_nonq/update_action',
				'link_back'				=> $this->agent->referrer(),
				'data'					=> $row,
				'id'					=> $id_generate,
			);

			$this->template->load('T_pembinaan_nonq/T_pembinaan_nonq_form', $data);
		} else {
			redirect($this->agent->referrer());
		}
	}

	public function update_action()
	{
		$data 	= $this->input->post('data_ajax', true);
		$val	= json_decode($data, true);
		$this->log_temp		= $this->session->tempdata($val['id']);
		$val['id']				= _decode_id($val['id'], $this->log_temp);

		$o		= new Outputview();

		/* 
		*	untuk mengganti message output
		* tambahkan perintah : $o->message = 'isi pesan'; 
 		* sebelum perintah validasi.
		* ex.
		* 	$o->message = 'halo ini pesan baru';
		* 	if(!$o->not_empty($val['descriptions'],'#descriptions')){
		*		echo $o->result();	
		*		return;
		*  	}
		*
		*/


		$success = $this->tmodel->update($val['id'], $val);
		echo $o->auto_result($success);
	}

	public function delete_multiple()
	{
		$data = $this->input->get('data_ajax', true);
		$val = json_decode($data, true);
		$data = explode(',', $val['data_delete']);

		//get key generate
		$log_id = $this->session->userdata($this->log_key);
		$xx = 0;
		foreach ($data as $value) {
			$value =  _decode_id($value, $log_id);
			//menganti ke id asli
			$data[$xx] = $value;
			$xx++;
		}

		$success = $this->tmodel->delete_multiple($data);

		$o = new Outputview();

		//create message
		if ($success) {
			$o->success 	= 'true';
			$o->message	= 'Data berhasil di hapus !';
		} else {
			$o->success 	= 'false';
			$o->message	= 'Opps..Gagal menghapus data !!';
		}


		echo $o->result();
	}
};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2021-03-02 14:02:28 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
