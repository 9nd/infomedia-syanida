<?php


if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Banding extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
		$this->load->model('Custom_model/qc_model', 'qc');
		$this->load->model('Banding/Banding_model', 'banding');
		$this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling');
		$this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling_verifikasi');
		$this->load->model('Custom_model/Trans_profiling_daily_model', 'trans_profiling_daily');
		$this->load->model('Custom_model/Cdr_model', 'cdr');
	}

	public function index()
	{
		$data = array(
			'title_page_big'		=> 'Banding',
			'title'					=> $this->title
		);

		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$data['controller'] = $this;
		$data['user_categori'] = '-';
		if ($userdata->opt_level == 9) {
			$agent = $this->db->query("SELECT * FROM sys_user WHERE tl = '$userdata->agentid'")->result();
			foreach ($agent as $dataagnt) {
				$filteragnt = "qc.agentid = '$dataagnt->agentid'";
				$filteragnts = $filteragnt . " OR qc.agentid = '$dataagnt->agentid'";
			}
		}
		if ($userdata->opt_level == 8) {
			$data['tdkvalid'] = $this->qc->live_query("SELECT * FROM qc WHERE status_approve = 0 AND agentid = '$userdata->agentid'");
		} else if ($userdata->opt_level == 9) {
			$data['tdkvalid'] = $this->qc->live_query("SELECT
			qc.*,
			sys_user.agentid AS agentsys,
			sys_user.tl 
		FROM
			qc
			INNER JOIN sys_user ON sys_user.agentid = qc.agentid
		WHERE
			status_approve = '0' AND
			($filteragnts)
			");
		} else {
			$data['tdkvalid'] = $this->qc->live_query("SELECT
			qc.*,
			sys_user.agentid AS agentsys,
			sys_user.tl 
		FROM
			qc
			INNER JOIN sys_user ON sys_user.agentid = qc.agentid
			WHERE status_approve = '0'");
		}
		$this->template->load('Banding/Banding_list_by_ajax', $data);
	}

	public function lihat_temuan(){


		$data = array(
			'title_page_big'		=> 'Detail',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'Qc/Qc/update_action',
			'link_back'				=> $this->agent->referrer(),
		);

		$data['data_qc'] = $this->qc->get_row(array("id" => $_GET['id']));
		$ncli = $data['data_qc']->ncli;
		$agentid = $data['data_qc']->agentid;
		$lup = $data['data_qc']->lup;

		$filter_agent = " AND trans_profiling.veri_upd = '$agentid'";
		$data['query_trans_profiling'] = $this->trans_profiling->live_query(
			"SELECT trans_profiling.*,DATE_FORMAT(trans_profiling.lup ,'%Y-%m-%d') as lup_date FROM trans_profiling 
			WHERE trans_profiling.lup = '$lup'
			AND trans_profiling.veri_call='13'
			AND trans_profiling.veri_upd='$agentid'
			AND trans_profiling.ncli='$ncli'
			$filter_agent
			GROUP BY idx
			"			);
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


		$this->template->load('Banding/edit_form_qc', $data);
	}

	public function qc_list()
	{

		// POST data
		$postData = $this->input->post();

		// Get data
		$data = $this->banding->get_notapp($postData);

		echo json_encode($data);
	}
	function Banding()
	{
		$id = $_POST['del_id'];
		$reason_banding = $_POST['reason_banding'];
		$this->db->query("UPDATE qc SET reason_banding = '$reason_banding', tanggal_banding = SYSDATE() WHERE id='$id'");
	}
	function Approve()
	{
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		if ($userdata->opt_level ==  9) {
			$field = "reason_tl";
		} else if ($userdata->opt_level == 10) {
			$field = "reason_qcb";
		}
		$id = $_POST['del_id'];
		$reason_banding = $_POST['reason_banding'];
		if ($userdata->opt_level == 9 || $userdata->opt_level == 10) {
			if($userdata->opt_level == 9){
				$colom = "app_tl";
			}elseif($userdata->opt_level == 10){
				$colom = "app_qc";
			}
			$this->db->query("UPDATE qc SET $field = '$reason_banding', tanggal_tl = SYSDATE(), $colom = 1 WHERE id='$id'");
		}
	}
	function Detail()
	{
		$data = array(
			'title_page_big'		=> 'Detail',
			'title'					=> $this->title,
			'link_back'				=> $this->agent->referrer(),
		);

		$data['data_qc'] = $this->qc->get_row(array("id" => $_GET['id']));
		$ncli = $data['data_qc']->ncli;
		$agentid = $data['data_qc']->agentid;
		$lup = $data['data_qc']->lup;

		$filter_agent = " AND trans_profiling.veri_upd = '$agentid'";
		$data['query_trans_profiling'] = $this->trans_profiling->live_query(
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
		$data['controller'] = $this;
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$data['loginid'] = $this->log_login->get_by_id($idlogin);


		$this->template->load('Banding/detail_form_qc', $data);
	}
};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-01-12 19:58:23 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
