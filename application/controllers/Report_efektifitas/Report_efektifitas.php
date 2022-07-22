<?php

use GuzzleHttp\Psr7\Response;

require APPPATH . '/controllers/Report_efektifitas/Report_efektifitas_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Report_efektifitas extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Custom_model/Status_call_model', 'status_call');
		$this->load->model('Custom_model/T_absensi_model', 't_absensi');
		$this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
		$this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling');
		$this->title = new Report_efektifitas_config();
	}

	public function index()
	{
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);

		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$start_filter = date('Y-m-d');
		$end_filter = date('Y-m-d');
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
		}
		$data = array(
			'title_page_big'		=> 'Report Efectivitas',
			'title'					=> "Report Efectivitas " . $start_filter . " Sampai " . $end_filter,
		);
		$data['controller'] = $this;

		$filter_agent = array("opt_level" => 8, "tl !=" => "-", "kategori" => "REG");
		if ($userdata->opt_level == 8) {
			$filter_agent = array("agentid" => $userdata->agentid);
			$data['user_categori'] = $userdata->opt_level;
		}
		$data['list_agent'] = $this->sys_user->get_results($filter_agent);

		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
			$data['recording'] = $this->get_recording($start_filter, $end_filter);
			$data['aux'] = $this->agent_aux($start_filter, $end_filter);
		}
		$data['level'] = $userdata->opt_level;
		$this->template->load('Report_efektifitas/Report_efektifitas_list', $data);
	}
	function get_recording($start_filter, $end_filter)
	{
		$recordingna = $this->t_absensi->live_query("
		SELECT me.agentid,count(*) as dialna,sum(duration) as durasina FROM cdr
		LEFT JOIN maping_eyebeam me ON me.src = cdr.src
		WHERE DATE(cdr.calldate) >= '$start_filter' AND DATE(cdr.calldate) <= '$end_filter' 
		GROUP BY me.agentid
		")->result_array();
		$redording_array = array();
		if (count($recordingna) > 0) {
			foreach ($recordingna as $rc) {
				$redording_array[$rc['agentid']]['dialna'] = $rc['dialna'];
				$redording_array[$rc['agentid']]['durasina'] = $rc['durasina'];
			}
		}
		$answered = $this->t_absensi->live_query("
		SELECT me.agentid,count(*) as dialna FROM cdr
		LEFT JOIN maping_eyebeam me ON me.src = cdr.src
		WHERE DATE(cdr.calldate) >= '$start_filter' AND DATE(cdr.calldate) <= '$end_filter' AND disposition='ANSWERED'
		GROUP BY me.agentid
		")->result_array();
		$answered_array = array();
		if (count($answered) > 0) {
			foreach ($answered as $rc) {
				$answered_array[$rc['agentid']]['dialna'] = $rc['dialna'];
			}
		}
		$datena = $this->t_absensi->live_query("
		SELECT me.agentid,DATE(cdr.calldate) FROM cdr
		LEFT JOIN maping_eyebeam me ON me.src = cdr.src
		WHERE DATE(cdr.calldate) >= '$start_filter' AND DATE(cdr.calldate) <= '$end_filter' 
		GROUP BY me.agentid,DATE(cdr.calldate)
		")->result_array();
		$datena_array = array();
		if (count($datena) > 0) {
			foreach ($datena as $rc) {
				$datena_array[$rc['agentid']]['datena'] = $datena_array[$rc['agentid']]['datena'] + 1;
			}
		}
		$return = array(
			"recording" => $redording_array,
			"answered" => $answered_array,
			"nod" => $datena_array
		);
		return $return;
	}

	function agent_aux($start_filter, $end_filter)
	{
		$return = array();
		$status_aux = array("Break", "Pray", "Toilet", "Handsup");

		if ($start_filter != $end_filter) {
			foreach ($status_aux as $k => $v) {
				$begin = new DateTime($start_filter);
				$end = new DateTime($end_filter);

				$interval = DateInterval::createFromDateString('1 day');
				$period = new DatePeriod($begin, $interval, $end);

				foreach ($period as $dt) {
					$datena = $dt->format("Y-m-d");
					$aux_detail = $this->t_absensi->live_query("Select sys_user_log_in_out.agentid,sys_user.nama,sum(TIMESTAMPDIFF(SECOND,sys_user_log_in_out.login_time,sys_user_log_in_out.logout_time)) AS aux from sys_user_log_in_out JOIN sys_user ON sys_user.id = sys_user_log_in_out.id_user where sys_user_log_in_out.login_time >= TIMESTAMP('" . $datena . "','08:00:00') AND sys_user_log_in_out.login_time <= TIMESTAMP('" . $datena . "','17:00:00') AND sys_user_log_in_out.ket = '" . $v . "' AND sys_user_log_in_out.logout_time IS NOT NULL AND sys_user.kategori='REG' AND sys_user.tl != '-' AND sys_user.opt_level = 8 GROUP BY sys_user_log_in_out.agentid");

					if ($aux_detail->num_rows() > 0) {
						foreach ($aux_detail->result_array() as $axd) {
							$return['all_status'][$axd['agentid']][$v . "_"] = $axd['aux'] + $return['all_status'][$axd['agentid']][$v . "_"];
						}
					}
				}
			}
		} else {
			$start = new DateTime($start_filter);
			$datena = $start->format("Y-m-d");
			foreach ($status_aux as $k => $v) {
				$aux_detail = $this->t_absensi->live_query("Select sys_user_log_in_out.agentid,sys_user.nama,sum(TIMESTAMPDIFF(SECOND,sys_user_log_in_out.login_time,sys_user_log_in_out.logout_time)) AS aux from sys_user_log_in_out JOIN sys_user ON sys_user.id = sys_user_log_in_out.id_user where sys_user_log_in_out.login_time >= TIMESTAMP('" . $datena . "','08:00:00') AND sys_user_log_in_out.login_time <= TIMESTAMP('" . $datena . "','17:00:00') AND sys_user_log_in_out.ket = '" . $v . "' AND sys_user_log_in_out.logout_time IS NOT NULL AND sys_user.kategori='REG' AND sys_user.tl != '-' AND sys_user.opt_level = 8 GROUP BY sys_user_log_in_out.agentid");

				if ($aux_detail->num_rows() > 0) {
					foreach ($aux_detail->result_array() as $axd) {
						$return['all_status'][$axd['agentid']][$v . "_"] = $axd['aux'];
					}
				}
			}
		}
		return $return;
	}
};
