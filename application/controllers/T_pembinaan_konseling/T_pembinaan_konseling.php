<?php
require APPPATH . '/controllers/T_pembinaan_konseling/T_pembinaan_konseling_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class T_pembinaan_konseling extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('T_pembinaan_konseling/T_pembinaan_konseling_model', 'tmodel');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->log_key = 'log_T_pembinaan_batl';
		$this->log_key = 'log_T_pembinaan_konseling';
		$this->title = new T_pembinaan_konseling_config();
	}


	public function index()
	{
		$data = array(
			'title_page_big'		=> 'DAFTAR',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'T_pembinaan_konseling/T_pembinaan_konseling/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'T_pembinaan_konseling/T_pembinaan_konseling/create',
			'link_update'			=> site_url() . 'T_pembinaan_konseling/T_pembinaan_konseling/update',
			'link_delete'			=> site_url() . 'T_pembinaan_konseling/T_pembinaan_konseling/delete_multiple',
		);
		$data["batl"] = $this->db->query("SELECT * FROM t_pembinaan_konseling")->result();
		$this->template->load('T_pembinaan_konseling/T_pembinaan_konseling_list', $data);
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
	public function detail()
	{
		$id = $_GET['id'];
		$data = array(
			'title_page_big'		=> 'Buat Baru',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'T_pembinaan_konseling/T_pembinaan_konseling/create_action',
			'link_back'				=> $this->agent->referrer(),
		);
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$filter_agent = array("opt_level" => 8,  "tl !=" => "-",  "kategori" => "REG");
		$data['data'] = $this->db->query("SELECT * FROM t_pembinaan_konseling WHERE id=$id")->row();
		if (isset($data['data'])) {
			$data['nama_konseling'] = $this->penerima($data['data']->nama_konseling);
			$data['konselor'] = $this->penerima($data['data']->konselor);
			$data['get_jenis'] = $this->jenis($data['data']->jenis_pembinaan);
			$data['nik_konselor'] = $this->user($data['data']->konselor);
			$data['nik_penerima'] = $this->user($data['data']->nama_konseling);
		}
		$data['list_agent_d'] = $this->Sys_user_table_model->get_results($filter_agent);
		$data['ctrl'] = $this;
		$this->template->load('T_pembinaan_konseling/T_pembinaan_konseling_form_detail', $data);
	}
	public function ambilform()
	{
		$data['nama_konseling'] = $_GET['nama_konseling'];
		$data['konselor'] = $_GET['konselor'];
		$data['bulan_tahun'] = $_GET['bulan_tahun'];
		$data['data_performance'] = $_GET['data_performance'];
		$data['ketidaksesuaian'] = $_GET['ketidaksesuaian'];
		$data['jenis_pembinaan'] = $_GET['jenis_pembinaan'];
		$data['komitmen_perbaikan'] = $_GET['komitmen_perbaikan'];
		$data['nama_penerima'] = $this->penerima($data['nama_konseling']);
		$data['nama_pemberi'] = $this->penerima($data['konselor']);
		$data['get_jenis'] = $this->jenis($data['jenis_pembinaan']);
		$data['nik_konselor'] = $this->user($data['konselor']);
		$data['nik_penerima'] = $this->user($data['nama_konseling']);
		$data['ctrl'] = $this;
		$this->load->view('T_pembinaan_konseling/formakonseling', $data);
	}
	public function penerima($agentid)
	{
		$qry = $this->db->query("SELECT * FROM sys_user WHERE agentid='$agentid'")->row();
		$nama = $qry->nama;
		return $nama;
	}
	public function user($agentid)
	{
		$qry = $this->db->query("SELECT * FROM sys_user WHERE agentid='$agentid'")->row();
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
			'link_save'				=> site_url() . 'T_pembinaan_konseling/T_pembinaan_konseling/create_action',
			'link_back'				=> $this->agent->referrer(),
		);
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$filter_agent = array("opt_level" => 8,  "tl !=" => "-",  "kategori" => "REG");
		$data['list_agent_d'] = $this->Sys_user_table_model->get_results($filter_agent);
		$this->template->load('T_pembinaan_konseling/T_pembinaan_konseling_form', $data);
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
		if ($success) {

			$this->load->library('telegram');

			$agentid = $val['nama_konseling'];
			$pesan = "<b>Konseling telah ditambahkan</b> 
Tanggal  : " . $val['bulan_tahun'] . " 
Agentid penerima : " . $val['nama_konseling'] . " 
Konselor : " . $val['konselor'] . " 
Data Performance : " . $val['data_performance'] . "
Ketidak Sesuaian : " . $val['ketidaksesuaian'] . "
Jenis Pembinaan : " . $jenis_pembinaan . "
Komitmen : " . $val['komitmen_perbaikan'];

			$query = $this->db->query("SELECT agentid, opt_level, chat_id_telegram, tl FROM sys_user WHERE agentid='$agentid'")->row();
			$querytl = $this->db->query("SELECT agentid, opt_level, chat_id_telegram FROM sys_user WHERE agentid='$query->tl'")->row();
			if ($query->chat_id_telegram != "" || $query->chat_id_telegram != NULL) {
				$this->telegram->send_manual($pesan, $query->agentid, $query->opt_level, $query->chat_id_telegram);
				$this->telegram->send_manual($pesan, $querytl->agentid, $querytl->opt_level, $querytl->chat_id_telegram);
			}
		}
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
				'link_save'				=> site_url() . 'T_pembinaan_konseling/T_pembinaan_konseling/update_action',
				'link_back'				=> $this->agent->referrer(),
				'data'					=> $row,
				'id'					=> $id_generate,
			);

			$this->template->load('T_pembinaan_konseling/T_pembinaan_konseling_form', $data);
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
