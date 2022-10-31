<?php
require APPPATH . '/controllers/Report_profiling/Report_profiling_config.php';


if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Qc_indri extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Custom_model/Status_call_model', 'status_call');
		$this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
		// $this->load->model('Custom_model/Trans_profiling_model', 'trans_profiling');
		$this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling');
		$this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling_verifikasi');
		$this->load->model('Custom_model/Trans_profiling_daily_model', 'trans_profiling_daily');
		// $this->load->model('Custom_model/Asterisk_infomedia_model', 'asterisk');
		$this->load->model('Custom_model/Cdr_model', 'cdr');
		$this->load->model('Custom_model/qc_model', 'qc');
		$this->db = $this->load->database('default', TRUE);


		$this->title = new Report_profiling_config();
	}

	////render by ajax
	public function index()
	{
		$data = array(
			'title_page_big'		=> 'Quality control',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'Status_call/Status_call/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'Status_call/Status_call/create',
			'link_update'			=> site_url() . 'Status_call/Status_call/update',
			'link_delete'			=> site_url() . 'Status_call/Status_call/delete_multiple',
		);
		$start_filter = date('Y-m-d');
		$end_filter = date('Y-m-d');
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
			$agentid = $_GET['agentid'];
		}
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$filter_agent = array("opt_level" => 8);
		$data['user_categori'] = '-';

		$data['list_agent_d'] = $this->sys_user->get_results($filter_agent);
		$this->load->model('Custom_model/Sys_user_log_in_out_table_model', 'Sys_log');

		$this->template->load('qc/Qc_list_by_ajax', $data);
	}

	// function check_verified()
	// {
	// 	$data = array(
	// 		'title_page_big'		=> 'Quality control',
	// 		'title'					=> $this->title,
	// 		'link_refresh_table'	=> site_url() . 'Status_call/Status_call/refresh_table/' . $this->_token,
	// 		'link_create'			=> site_url() . 'Status_call/Status_call/create',
	// 		'link_update'			=> site_url() . 'Status_call/Status_call/update',
	// 		'link_delete'			=> site_url() . 'Status_call/Status_call/delete_multiple',
	// 	);
	// 	$start_filter = date('Y-m-d');
	// 	$end_filter = date('Y-m-d');
	// 	if (isset($_GET['start']) && isset($_GET['end'])) {
	// 		$start_filter = $_GET['start'];
	// 		$end_filter = $_GET['end'];
	// 		$agentid = $_GET['agentid'];
	// 	}
	// 	$this->load->model('sys/Sys_user_log_model', 'log_login');
	// 	$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
	// 	$idlogin = $this->session->userdata('idlogin');
	// 	$logindata = $this->log_login->get_by_id($idlogin);
	// 	$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
	// 	$filter_agent = array("opt_level" => 8);
	// 	$data['user_categori'] = '-';

	// 	$data['list_agent_d'] = $this->sys_user->get_results($filter_agent);
	// 	$this->load->model('Custom_model/Sys_user_log_in_out_table_model', 'Sys_log');

	// 	$this->template->load('qc/Qc_agent_by_ajax', $data);
	// }
	function get_data_list()
	{
		$data['controller'] = $this;
		$start_filter = date('Y-m-d');
		if (isset($_GET['start'])) {
			$start_filter = $_GET['start'];


			$data['status'] = $this->status_call->get_results();
			$where_agent = array("opt_level" => 8);
			$filter_agent = "";

			$this->load->model('sys/Sys_user_log_model', 'log_login');
			$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
			$idlogin = $this->session->userdata('idlogin');
			$logindata = $this->log_login->get_by_id($idlogin);

			$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

			if ($userdata->opt_level == 8) {
				$agentid[0] = $userdata->agentid;
			}


			if ($userdata->opt_level == 9) {
				$where_agent['tl'] = $userdata->agentid;
			}
			$data['agent'] = $this->sys_user->get_results($where_agent, array("nama,agentid"));
			$filter = array();
			$data['query_trans_profiling'] = $this->trans_profiling_daily->live_query(
				"SELECT trans_profiling_last_month.* FROM trans_profiling_last_month 
				WHERE DATE(trans_profiling_last_month.lup) = '$start_filter'
				AND trans_profiling_last_month.veri_call='13'
				"
			);
		}
		$this->load->view('qc/agent_area', $data);
	}
	// function get_data_verified()
	// {
	// 	$data['controller'] = $this;
	// 	$start_filter = date('Y-m-d');
	// 	$end_filter = date('Y-m-d');
	// 	if (isset($_GET['start']) && isset($_GET['end'])) {
	// 		$start_filter = $_GET['start'];
	// 		$end_filter = $_GET['end'];
	// 		$agentid = $_GET['agentid'];

	// 		$data['status'] = $this->status_call->get_results();
	// 		$where_agent = array("opt_level" => 8);
	// 		$filter_agent = "";

	// 		$this->load->model('sys/Sys_user_log_model', 'log_login');
	// 		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
	// 		$idlogin = $this->session->userdata('idlogin');
	// 		$logindata = $this->log_login->get_by_id($idlogin);

	// 		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

	// 		if (isset($agentid)) {

	// 			$where_agent['agentid'] = $agentid;
	// 			$filter_agent = " AND trans_profiling_last_month.veri_upd = '$agentid'";
	// 			$filter_agent_veri = " AND update_by = '$agentid'";
	// 		}
	// 		if ($userdata->opt_level == 9) {
	// 			$where_agent['tl'] = $userdata->agentid;
	// 		}
	// 		$data['agent'] = $this->sys_user->get_results($where_agent, array("nama,agentid"));
	// 		$filter = array();
	// 		$data['query_trans_profiling'] = $this->trans_profiling_daily->live_query(
	// 			"SELECT trans_profiling_last_month.* FROM trans_profiling_last_month 
	// 			WHERE DATE_FORMAT(trans_profiling_last_month.lup ,'%Y-%m-%d') >= '$start_filter' 
	// 			AND DATE_FORMAT(trans_profiling_last_month.lup ,'%Y-%m-%d') <= '$end_filter'
	// 			AND trans_profiling_last_month.veri_call='13'
	// 			$filter_agent
	// 			GROUP BY idx
	// 			ORDER BY trans_profiling_last_month.nama ASC
	// 			"
	// 		);
	// 	}
	// 	$this->load->view('qc/agent_area', $data);
	// }
	function edit_form_approve()
	{
		$data = array(
			'title_page_big'		=> 'Edit Quality Control ',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'Qc/Qc/update_action',
			'link_back'				=> $this->agent->referrer(),
		);

		$data['data_qc'] = $this->qc->get_row(array("id" => $_GET['id']));
		$ncli = $data['data_qc']->ncli;
		$agentid = $data['data_qc']->agentid;
		$lup = $data['data_qc']->lup;

		$filter_agent = " AND trans_profiling.veri_upd = '$agentid'";
		$data['query_trans_profiling'] = $this->db->live_query(
			"SELECT trans_profiling.*,DATE_FORMAT(trans_profiling.lup ,'%Y-%m-%d') as lup_date FROM trans_profiling 
			WHERE trans_profiling.lup = '$lup'
			AND trans_profiling.veri_call='13'
			AND trans_profiling.veri_upd='$agentid'
			AND trans_profiling.ncli='$ncli'
			$filter_agent
			GROUP BY idx
			"
		);
		$data['agent'] = $this->sys_user->get_row(array("agentid" => $agentid));
		$data['data'] = $data['query_trans_profiling']->row();
		$data['recording'] = false;
		// $data['q_recording'] = $this->cdr->get_row(array("dst" => "61" . $data['data']->handphone));
		// if (!$data['q_recording']) {
		// 	$data['q_recording'] = $this->cdr->get_row(array("dst" => "61" . $data['data']->pstn1));
		// }
		// if ($data['q_recording']) {
		// 	$data['recording'] = $data['q_recording']->recordingfile;
		// }
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$data['loginid'] = $this->log_login->get_by_id($idlogin);


		$this->template->load('qc/edit_form_qc', $data);
	}

	function form_approve()
	{
		$data = array(
			'title_page_big'		=> 'Quality Control ',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'Qc/Qc/create_action',
			'link_back'				=> $this->agent->referrer(),
		);
		$ncli = $_GET['ncli'];
		$agentid = $_GET['agentid'];
		$start_filter = $_GET['start'];
		$filter_agent = " AND trans_profiling.veri_upd = '$agentid'";
		$data['query_trans_profiling'] = $this->trans_profiling->live_query(
			"SELECT trans_profiling.* FROM trans_profiling
			WHERE DATE_FORMAT(trans_profiling.lup ,'%Y-%m-%d') >= '$start_filter' 
			AND trans_profiling.veri_call='13'
			AND trans_profiling.veri_upd='$agentid'
			AND trans_profiling.ncli='$ncli'
			$filter_agent
			GROUP BY idx"
		);
		$data['agent'] = $this->sys_user->get_row(array("agentid" => $agentid));
		$data['data'] = $data['query_trans_profiling']->row();
		$data['recording'] = false;
		// $data['q_recording'] = $this->cdr->get_row(array("dst" => "61" . $data['data']->handphone));
		// if (!$data['q_recording']) {
		// 	$data['q_recording'] = $this->cdr->get_row(array("dst" => "61" . $data['data']->pstn1));
		// }
		// if ($data['q_recording']) {
		// 	$data['recording'] = $data['q_recording']->recordingfile;
		// }

		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$idlogin = $this->session->userdata('idlogin');
		$data['loginid'] = $this->log_login->get_by_id($idlogin);

		$this->template->load('qc/form_qc', $data);
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
		$idlogin = $this->session->userdata('idlogin');
		$val['idlogin'] = $idlogin;
		$val['tanggal'] = date('Y-m-d H:i:s');
		$success = $this->qc->insert($val);
		if ($success && $val['status_approve'] == 0) {

			$this->load->library('telegram');

			$agentid = $val['agentid'];
			$pesan = "<b>Temuan QC</b> 
			Tanggal: " . $val['tanggal'] . " 
			reason_qa : " . $val['reason_qa'] . "
			note_qc : " . $val['note_qc'] . "
			agentid : " . $val['agentid'] . "
			ncli : " . $val['ncli'] . "
			pstn1 : " . $val['pstn1'] . "
			hp : " . $val['handphone'] . "
			email : " . $val['email'];

			$query = $this->db->query("SELECT agentid, opt_level, chat_id_telegram, tl FROM sys_user WHERE agentid='$agentid'")->row();
			$querytl = $this->db->query("SELECT agentid, opt_level, chat_id_telegram FROM sys_user WHERE agentid='$query->tl'")->row();
			if ($query->chat_id_telegram != "" || $query->chat_id_telegram != NULL) {
				$this->telegram->send_manual($pesan, $query->agentid, $query->opt_level, $query->chat_id_telegram);
				$this->telegram->send_manual($pesan, $querytl->agentid, $querytl->opt_level, $querytl->chat_id_telegram);
			}
		}
		echo $o->auto_result($success);
	}
	public function update_action()
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
		$idlogin = $this->session->userdata('idlogin');
		$val['idlogin'] = $idlogin;
		$id = $val['id'];
		unset($val['id']);
		$success = $this->qc->update($id, $val);
		echo $o->auto_result($success);
	}
	public function report()
	{
		$data = array(
			'title_page_big'		=> 'Report Quality Control',
			'title'					=> $this->title,
		);
		$start_filter = date('Y-m-d');
		$end_filter = date('Y-m-d');

		if (isset($_GET['start']) && isset($_GET['end'])) {

			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
		}
		$this->template->load('qc/report_ajax', $data);
	}
	function get_data_list_report()
	{
		$data['controller'] = $this;
		$start_filter = date('Y-m-d');
		$end_filter = date('Y-m-d');
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];

			$this->load->library('pagination');
			$config['base_url'] = base_url().'index.php/welcome/index/';
			$config['per_page'] = 10;
			$from = $this->uri->segment(3);
			$this->pagination->initialize($config);		
			$data['data_qc'] = $this->qc->get_results(array('DATE(lup) >=' => $start_filter, 'DATE(lup) <=' => $end_filter))->data($config['per_page'],$from);
		}
		$this->load->view('qc/list_area_report', $data);
	}
	function filter_by_value($array, $index, $value)
	{
		if (is_array($array) && count($array) > 0) {
			foreach (array_keys($array) as $key) {
				$temp[$key] = $array[$key][$index];

				if ($temp[$key] == $value) {
					$newarray[$key] = $array[$key];
				}
			}
		}
		return $newarray;
	}

	public function create_score_action()
	{
		$idlogin = $this->session->userdata('idlogin');
		$lup = date("Y-m-d H:i:s");
		$data = array(

			'qc_id'	=> $idlogin,
			'agent_id' =>  $_POST['agent_id'],
			'dial'	=>  $_POST['dial'],
			'skill_communication_1'	=>  $_POST['skill_communication_1'],
			'skill_communication_2'	=>  $_POST['skill_communication_2'],
			'skill_communication_3'	=>  $_POST['skill_communication_3'],
			'skill_communication_4'	=>  $_POST['skill_communication_4'],
			'skill_communication_5'	=>  $_POST['skill_communication_5'],
			'skill_communication_6'	=>  $_POST['skill_communication_6'],
			'skill_communication_7'	=>  $_POST['skill_communication_7'],
			'skill_communication_8'	=>  $_POST['skill_communication_8'],
			'validation_1'	=>  $_POST['validation_1'],
			'validation_2'	=>  $_POST['validation_2'],
			'validation_3'	=>  $_POST['validation_3'],
			'validation_4'	=>  $_POST['validation_4'],
			'validation_5'	=>  $_POST['validation_5'],
			'validation_6'	=>  $_POST['validation_6'],
			'validation_7'	=>  $_POST['validation_7'],
			'validation_8'	=>  $_POST['validation_8'],
			'validation_9'	=>  $_POST['validation_9'],
			'validation_10'	=>  $_POST['validation_10'],
			'validation_11'	=>  $_POST['validation_11'],
			'documentation_1'	=>  $_POST['documentation_1'],
			'documentation_2'	=>  $_POST['documentation_2'],
			'documentation_3'	=>  $_POST['documentation_3'],
			'keterangan'	=>  $_POST['keterangan'],
			'note'	=>  $_POST['note'],
			'aht_1'	=>  $_POST['aht_1'],
			'aht_2'	=>  $_POST['aht_2'],
			'aht_3'	=>  $_POST['aht_3'],
			'aht_4'	=>  $_POST['aht_4'],
			'aht_5'	=>  $_POST['aht_5'],
			'aht_6'	=>  $_POST['aht_6'],
			'aht_7'	=>  $_POST['aht_7'],
			'aht_8'	=>  $_POST['aht_8'],
			'tgl_taping'	=>  $lup,
			'tgl_respon_limit'	=>  $lup,

		);
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
		$success = $this->db->insert('tbl_score_qc', $data);
		$onload = "Data Berhasil Diupload, Sukses disimpan";
		$onload2 = "Data Gagal Di Upload, Silahkan Coba Lagi";
		if ($success) {
			echo "<script>
			alert('" . $onload . "');	
			</script>";
			$this->template->load('qc/Qc_list_by_ajax');
		} else {
			echo "<script>
			alert('" . $onload2 . "');	
			</script>";
			$this->template->load('qc/Qc_list_by_ajax');
		}
	}
};
