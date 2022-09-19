<?php
require APPPATH . '/controllers/T_pembinaan/T_pembinaan_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class T_pembinaan extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('T_pembinaan/T_pembinaan_model', 'tmodel');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('Status_call/Status_call_model', 'Status_call_model');
		$this->load->model('sys/Sys_user_log_model', 'log_login');

		$this->infomedia = $this->load->database('infomedia', TRUE);
		$this->log_key = 'log_T_pembinaan';
		$this->title = new T_pembinaan_config();
	}


	public function index()
	{
		$data = array(
			'title_page_big'		=> 'Rekap Pembinaan',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'T_pembinaan/T_pembinaan/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'T_pembinaan/T_pembinaan/create',
			'link_update'			=> site_url() . 'T_pembinaan/T_pembinaan/update',
			'link_delete'			=> site_url() . 'T_pembinaan/T_pembinaan/delete_multiple',
		);
		$start = date('Y-m-d');
		$end = date('Y-m-d');
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start = $_GET['start'];
			$end = $_GET['end'];
		}
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$filter_agent = array("opt_level" => 8, "tl !=" => "-");
		$data['list_agent_d'] = $this->Sys_user_table_model->get_results($filter_agent);


		$this->template->load('T_pembinaan/T_pembinaan_list', $data);
	}

	function get_data_list()
	{

		$data = array(
			'title_page_big'		=> 'Rekap Pembinaan',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'T_pembinaan/T_pembinaan/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'T_pembinaan/T_pembinaan/create',
			'link_update'			=> site_url() . 'T_pembinaan/T_pembinaan/update',
			'link_delete'			=> site_url() . 'T_pembinaan/T_pembinaan/delete_multiple',
		);

		$data['controller'] = $this;
		$start = date('Y-m-d');
		$end = date('Y-m-d');
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start = $_GET['start'];
			$end = $_GET['end'];


			$idlogin = $this->session->userdata('idlogin');
			$logindata = $this->log_login->get_by_id($idlogin);

			$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

			$data['tpembinaan'] = $this->db->query("SELECT * FROM t_pembinaan WHERE jenis IS NULL AND tanggal_pembinaan BETWEEN '$start' AND '$end' ")->result_array();
			$idlogin = $this->session->userdata('idlogin');
			$logindata = $this->log_login->get_by_id($idlogin);
			$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
			$filter_agent = array("opt_level" => 8, "tl !=" => "-");
			$data['list_agent_d'] = $this->Sys_user_table_model->get_results($filter_agent);
		}
		$this->load->view('T_pembinaan/T_pembinaan_area', $data);
	}

	public function detail($id)
	{

		$row = $this->tmodel->get_by_id($id);
		//echo var_dump($row);
		if ($row) {
			$data = array(
				'title_page_big'		=> 'Detail',
				'title'					=> $this->title,
				'link_save'				=> site_url() . 'T_pembinaan/T_pembinaan/update_action',
				'link_back'				=> $this->agent->referrer(),
				'data'					=> $row,
				'id'					=> $id,
			);

			$this->template->load('T_pembinaan/T_pembinaan_detail', $data);
		} else {
			redirect($this->agent->referrer());
		}
	}
	public function get_detailed()
	{
		$agentidget = $_GET["agentid"];
		if (isset($agentidget)) {
			$data['query'] = $this->db->query("SELECT * FROM t_pembinaan WHERE agentid = '$agentidget' AND jenis is null")->result();
			$data['controller'] = $this;
			$data['agentidget'] = $agentidget;
			$this->load->view('T_pembinaan/T_pembinaan_detail', $data);
		} else {
			echo "
			<script>alert('mon maaf data tidak ada')</script>
			";
		}
	}

	public function update($id)
	{


		$row = $this->tmodel->get_by_id($id);


		if ($row) {
			$data = array(
				'title_page_big'		=> 'Edit',
				'title'					=> $this->title,
				'link_save'				=> site_url() . 'T_pembinaan/T_pembinaan/update_action',
				'link_back'				=> $this->agent->referrer(),
				'data'					=> $row,
			);
			$idlogin = $this->session->userdata('idlogin');
			$logindata = $this->log_login->get_by_id($idlogin);
			$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
			$filter_agent = array("opt_level" => 8, "tl !=" => "-");
			$agentid = $data['userdata']->agentid;
			if ($data['userdata']->opt_level == 9) {
				$filter_agent = array("opt_level" => 8, "tl !=" => "-", "tl =" => "$agentid");
			}
			$data['list_agent_d'] = $this->Sys_user_table_model->get_results($filter_agent);
			$this->template->load('T_pembinaan/T_pembinaan_form', $data);
		} else {
			// redirect($this->agent->referrer());
			echo "else";
		}
	}



	public function create($id = false)
	{
		$data = array(
			'title_page_big'		=> 'Buat Baru',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'T_pembinaan/T_pembinaan/create_action',
			'link_back'				=> $this->agent->referrer(),
		);
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$data['id_forcall'] = $id;
		$agentid = $data['userdata']->agentid;
		$filter_agent = array("opt_level" => 8, "tl !=" => "-");
		if ($data['userdata']->opt_level == 9) {
			$filter_agent = array("opt_level" => 8, "tl !=" => "-", "tl =" => "$agentid");
		}
		$data['list_agent_d'] = $this->Sys_user_table_model->get_results($filter_agent);

		$this->template->load('T_pembinaan/T_pembinaan_form', $data);
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
		if (!$o->not_empty($val['tingkat_pembinaan'], '#tingkat_pembinaan')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['tanggal_pembinaan'], '#tanggal_pembinaan')) {
			echo $o->result();
			return;
		}



		//mencegah data kosong
		if (!$o->not_empty($val['keterangan'], '#keterangan')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['agentid'], '#agentid')) {
			echo $o->result();
			return;
		}

		unset($val['id']);
		$success = $this->tmodel->insert($val);
		echo $o->auto_result($success);
	}



	public function update_action()
	{
		$data 	= $this->input->post('data_ajax', true);
		$val	= json_decode($data, true);
		$this->log_temp		= $this->session->tempdata($val['id']);
		$val['id']				= _decode_id($val['id'], $this->log_temp);

		$o		= new Outputview();


		//mencegah data kosong
		if (!$o->not_empty($val['tingkat_pembinaan'], '#tingkat_pembinaan')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['tanggal_pembinaan'], '#tanggal_pembinaan')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['keterangan'], '#keterangan')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['agentid'], '#agentid')) {
			echo $o->result();
			return;
		}


		$success = $this->tmodel->update($val['id'], $val);
		echo $o->auto_result($success);
	}

	function deletekasus()
	{
		$id = $_POST['del_id'];
		if (isset($id)) {
			$this->db->query("DELETE FROM t_pembinaan WHERE id='$id'");
		}
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
/* Generated by YBS CRUD Generator 2020-11-23 15:22:32 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
