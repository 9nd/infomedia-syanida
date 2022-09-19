<?php
require APPPATH . '/controllers/Input_absen/Input_absen_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Input_absen extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Input_absen/Input_absen_model', 'tmodel');
		$this->load->model('Absensi/Absensi_model', 'absensi');
		$this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
		//$this->log_key ='log_Leader_on_duty';
		$this->log_key = 'log_Input_absen';
		$this->title = new Input_absen_config();
	}


	public function index()
	{
		$data = array(
			'title_page_big'		=> 'Input Absen',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'input_absen/input_absen/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'input_absen/input_absen/create',
			//'link_generate'			=> site_url().'input_absen/input_absen/generate',
			'link_update'			=> site_url() . 'input_absen/input_absen/update',
			'link_delete'			=> site_url() . 'input_absen/input_absen/delete_multiple',
		);
		$filter_agent = array("kategori" => "REG");
		$data['list_agent_d'] = $this->sys_user->get_results($filter_agent);
		//echo $data['list_agent_d']['num'];

		$this->template->load('input_absen/input_absen_list', $data);
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

	public function create()
	{
		$data = array(
			'title_page_big'		=> 'Buat Baru',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'Input_absen/Input_absen/create_action',
			'link_back'				=> $this->agent->referrer(),
		);

		$filter_agent = array("kategori" => "REG");
		$data['list_agent_d'] = $this->sys_user->get_results($filter_agent);

		$this->template->load('Input_absen/Input_absen_form', $data);
	}
	public function generate()
	{
		$data = array(
			'title_page_big'		=> 'Generate',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'Input_absen/Input_absen/generate_action',
			'link_back'				=> $this->agent->referrer(),
		);

		$this->template->load('Input_absen/Input_absen_generate', $data);
	}

	public function create_action()
	{
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
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
		$id = $val['id'];
		//mencegah data kosong
		if (!$o->not_empty($val['nik'], '#nik')) {
			echo $o->result();
			return;
		}
		$row = $this->sys_user->get_row(array('nik_absensi' => $val['nik']));
		$val['nama'] = $row->nama;



		//mencegah data kosong
		if (!$o->not_empty($val['waktu_in'], '#waktu_in')) {
			echo $o->result();
			return;
		}

		

		if (!$o->not_empty($val['stts'], '#stts')) {
			echo $o->result();
			return;
		}
		$val['update_by']=$logindata->id_user;


		unset($val['id']);
		$this->absensi->delete(array("nik"=>$val['nik'],"DATE(waktu_in)"=>$val['waktu_in']));
		$val['waktu_in'] = $val['waktu_in'] . " 00:00:00";
		$success = $this->tmodel->insert($val);
		
		echo $o->auto_result($success);
	}


	public function update($id)
	{
		$id 				= $this->security->xss_clean($id);
		$id_generate		= $id;



		/** proses decode id 
		 * important !! tempdata digunakan sbagai antisipasi
		 * perubahan session saat membuka tab baru secara bersamaan
		 **/
		// echo $this->log_key;
		$this->log_temp	= $this->session->userdata($this->log_key);
		$this->session->set_tempdata($id, $this->log_temp, 300);

		//mengembalikan id asli

		$id = _decode_id($id, $this->log_temp);

		$row = $this->tmodel->get_by_id($id);


		if ($row) {
			$data = array(
				'title_page_big'		=> 'Buat Baru',
				'title'					=> $this->title,
				'link_save'				=> site_url() . 'Input_absen/Input_absen/update_action',
				'link_back'				=> $this->agent->referrer(),
				'data'					=> $row,
				'id'					=> $id_generate,
			);
			$filter_agent = array("kategori" => "REG");
			$data['list_agent_d'] = $this->sys_user->get_results($filter_agent);
			$this->template->load('Input_absen/Input_absen_form', $data);
		} else {
			redirect($this->agent->referrer());
		}
	}

	public function update_action()
	{
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
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
		$row = $this->sys_user->get_row(array('nik_absensi' => $val['nik']));
		$val['nama'] = $row->nama;
		//mencegah data kosong
		if (!$o->not_empty($val['nik'], '#nik')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['waktu_in'], '#waktu_in')) {
			echo $o->result();
			return;
		}
		//mencegah data kosong
		if (!$o->not_empty($val['stts'], '#stts')) {
			echo $o->result();
			return;
		}

		$val['update_by']=$logindata->id_user;
		
		$this->absensi->delete(array("nik"=>$val['nik'],"DATE(waktu_in)"=>$val['waktu_in']));
		$val['waktu_in'] = $val['waktu_in'] . " 00:00:00";
		unset($val['id']);
		$success = $this->tmodel->insert($val);
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
/* Generated by YBS CRUD Generator 2020-01-31 15:28:46 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
