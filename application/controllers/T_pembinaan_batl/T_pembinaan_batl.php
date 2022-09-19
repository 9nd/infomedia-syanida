<?php
require APPPATH . '/controllers/T_pembinaan_batl/T_pembinaan_batl_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class T_pembinaan_batl extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('T_pembinaan_batl/T_pembinaan_batl_model', 'tmodel');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->log_key = 'log_T_pembinaan_batl';
		$this->title = new T_pembinaan_batl_config();
	}


	public function index()
	{
		$data = array(
			'title_page_big'		=> 'List of BATL',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'T_pembinaan_batl/T_pembinaan_batl/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'T_pembinaan_batl/T_pembinaan_batl/create',
			'link_update'			=> site_url() . 'T_pembinaan_batl/T_pembinaan_batl/update',
			'link_delete'			=> site_url() . 'T_pembinaan_batl/T_pembinaan_batl/delete_multiple',
		);
		$data["batl"] = $this->db->query("SELECT * FROM t_pembinaan_batl")->result();

		$this->template->load('T_pembinaan_batl/T_pembinaan_batl_list', $data);
	}



	public function create()
	{
		$data = array(
			'title_page_big'		=> 'Buat Baru',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'T_pembinaan_batl/T_pembinaan_batl/create_action',
			'link_back'				=> $this->agent->referrer(),
		);
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$filter_agent = array("opt_level" => 8,  "tl !=" => "-",  "kategori" => "REG");
		$data['list_agent_d'] = $this->Sys_user_table_model->get_results($filter_agent);
		$this->template->load('T_pembinaan_batl/T_pembinaan_batl_form', $data);
	}
	public function detail()
	{
		$id = $_GET['id'];
		$data = array(
			'title_page_big'		=> 'Buat Baru',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'T_pembinaan_batl/T_pembinaan_batl/create_action',
			'link_back'				=> $this->agent->referrer(),
		);
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$filter_agent = array("opt_level" => 8,  "tl !=" => "-",  "kategori" => "REG");
		$data['data'] = $this->db->query("SELECT * FROM t_pembinaan_batl WHERE id=$id")->row();
		if (count($data['data']) > 0) {
			$data['nama_penerima'] = $this->penerima($data['data']->penerima_teguran);
			$data['nama_pemberi'] = $this->penerima($data['data']->pemberi_teguran);
		}
		$data['list_agent_d'] = $this->Sys_user_table_model->get_results($filter_agent);
		$this->template->load('T_pembinaan_batl/T_pembinaan_batl_form_detail', $data);
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

		//mencegah data kosong
		if (!$o->not_empty($val['penerima_teguran'], '#penerima_teguran')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['pemberi_teguran'], '#pemberi_teguran')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['tanggal_teguran'], '#tanggal_teguran')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['isi_teguran_lisan'], '#isi_teguran_lisan')) {
			echo $o->result();
			return;
		}

		unset($val['id']);
		$success = $this->tmodel->insert($val);
		echo $o->auto_result($success);
		if ($success) {

			$this->load->library('telegram');

			$agentid = $val['penerima_teguran'];
			$pesan = "<b>BATL telah ditambahkan</b> 
Tanggal teguran : " . $val['tanggal_teguran'] . " 
Penerima teguran: " . $val['penerima_teguran'] . " 
Pemberi teguran : " . $val['pemberi_teguran'] . "
Isi Teguran Lisan : " . $val['isi_teguran_lisan'] . "
Pertimbangan Tindakan : " . $val['pertimbangan_tindakan'] . "
Komitmen : " . $val['komitmen'];

			$query = $this->db->query("SELECT agentid, opt_level, chat_id_telegram, tl FROM sys_user WHERE agentid='$agentid'")->row();
			$querytl = $this->db->query("SELECT agentid, opt_level, chat_id_telegram FROM sys_user WHERE agentid='$query->tl'")->row();
			if ($query->chat_id_telegram != "" || $query->chat_id_telegram != NULL) {
				$this->telegram->send_manual($pesan, $query->agentid, $query->opt_level, $query->chat_id_telegram);
				$this->telegram->send_manual($pesan, $querytl->agentid, $querytl->opt_level, $querytl->chat_id_telegram);
			}
		}
		
	}

	public function ambilform()
	{
		$data['penerima_teguran'] = $_GET['penerima_teguran'];
		$data['pemberi_teguran'] = $_GET['pemberi_teguran'];
		$data['tanggal_teguran'] = $_GET['tanggal_teguran'];
		$data['isi_teguran_lisan'] = $_GET['isi_teguran_lisan'];
		$data['pertimbangan_tindakan'] = $_GET['pertimbangan_tindakan'];
		$data['komitmen'] = $_GET['komitmen'];
		$data['verifikasi'] = $_GET['verifikasi'];
		$data['evidance'] = $_GET['evidance'];
		$data['nama_penerima'] = $this->penerima($data['penerima_teguran']);
		$data['nama_pemberi'] = $this->penerima($data['pemberi_teguran']);
		$this->load->view('T_pembinaan_batl/formabatl', $data);
	}

	public function penerima($agentid)
	{
		$qry = $this->db->query("SELECT * FROM sys_user WHERE agentid='$agentid'")->row();
		$nama = $qry->nama;
		return $nama;
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
				'link_save'				=> site_url() . 'T_pembinaan_batl/T_pembinaan_batl/update_action',
				'link_back'				=> $this->agent->referrer(),
				'data'					=> $row,
				'id'					=> $id_generate,
			);

			$this->template->load('T_pembinaan_batl/T_pembinaan_batl_form', $data);
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

		//mencegah data kosong
		if (!$o->not_empty($val['penerima_teguran'], '#penerima_teguran')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['pemberi_teguran'], '#pemberi_teguran')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['tanggal_teguran'], '#tanggal_teguran')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['isi_teguran_lisan'], '#isi_teguran_lisan')) {
			echo $o->result();
			return;
		}


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
/* Generated by YBS CRUD Generator 2021-03-01 09:07:06 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
