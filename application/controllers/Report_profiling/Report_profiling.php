<?php
require APPPATH . '/controllers/Report_profiling/Report_profiling_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Report_profiling extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Custom_model/Status_call_model', 'status_call');
		$this->load->model('Custom_model/T_absensi_model', 't_absensi');
		$this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
		// $this->load->model('Custom_model/Trans_profiling_model', 'trans_profiling');
		$this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling');
		$this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling_verifikasi');
		$this->load->model('Custom_model/Trans_profiling_daily_model', 'trans_profiling_daily');
		$this->load->model('Custom_model/Sys_user_log_login_model', 'sys_user_log_login');
		$this->load->model('Custom_model/Sys_user_log_in_out_table_model', 'Sys_log');
		$this->load->model('Custom_model/Sys_user_moss_model', 'Sys_user_moss');
		$this->title = new Report_profiling_config();
	}




	////render by ajax
	// public function index()
	// {
	// 	$data = array(
	// 		'title_page_big'		=> 'Report Profiling',
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
	// 	if ($userdata->opt_level == 8) {
	// 		$filter_agent = array("agentid" => $userdata->agentid);
	// 		$data['user_categori'] = $userdata->opt_level;
	// 	}
	// 	if ($userdata->opt_level == 9) {
	// 		$filter_agent = array("tl" => $userdata->agentid);
	// 		$data['user_categori'] = $userdata->opt_level;
	// 	}
	// 	$data['list_agent_d'] = $this->sys_user->get_results($filter_agent);
	// 	$this->load->model('Custom_model/Sys_user_log_in_out_table_model', 'Sys_log');
	// 	if($userdata ->opt_level == 8){
	// 		$log_where = array(
	// 			'id_user'=>$logindata->id_user,
	// 			'agentid'=> $userdata ->agentid,
	// 		);
	// 		$log=$this->Sys_log->get_row($log_where,array("id,logout_time"),array("id"=>"DESC"));
	// 		if($log){
	// 			if($log->logout_time == ''){
	// 				redirect('Lockscreen', 'refresh');
	// 			}
	// 		}
	// 	}
	// 	$this->template->load('Report_profiling/Report_profiling_list_by_ajax', $data);
	// }
	////render by Server
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
			'title_page_big'		=> 'Report Profiling',
			'title'					=> "Report Profiling " . $start_filter . " Sampai " . $end_filter,
		);
		$data['controller'] = $this;

		$filter_agent = array("opt_level" => 8, "tl !=" => "-");
		if ($userdata->opt_level == 8) {
			$filter_agent = array("agentid" => $userdata->agentid);
			$data['user_categori'] = $userdata->opt_level;
		}
		$data['list_agent'] = $this->sys_user->get_results($filter_agent);

		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
			$agentid = $_GET['agentid'];

			$data['status'] = $this->status_call->get_results();
			$where_agent = array("opt_level" => 8, "tl !=" => "-");




			if ($userdata->opt_level == 8) {
				$agentid[0] = $userdata->agentid;
			}
			$data['user_categori'] = '-';
			if ($userdata->opt_level == 8) {
				$filter_agent = array("agentid" => $userdata->agentid);
				$data['user_categori'] = $userdata->opt_level;
			}
			if ($userdata->opt_level == 9) {
				$filter_agent = array("tl" => $userdata->agentid);
				$data['user_categori'] = $userdata->opt_level;
			}
			if ($userdata->opt_level == 7) {
				// $filter_agent = array("tl" => $userdata->agentid);
				$data['user_categori'] = $userdata->opt_level;
				$where_agent = array("opt_level" => 8);
			}

			$data['list_agent'] = $this->sys_user->get_results($filter_agent);
			$filter_agent = "";

			if (isset($agentid)) {

				if ($agentid) {
					if (count($_GET['agentid']) > 1) {
						$n_agent_pick = count($_GET['agentid']);
						foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
							if ($k_agentid == 0) {
								$filter_agent = " AND (trans_profiling.veri_upd = '$v_agentid'";
								$filter_agent_veri = " AND (update_by = '$v_agentid'";
								$where_agent_multi = "( agentid = '$v_agentid'";
							} else {
								if ($k_agentid == ($n_agent_pick - 1)) {
									$where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' )";
									$filter_agent = $filter_agent . " OR trans_profiling.veri_upd = '$v_agentid' )";
									$filter_agent_veri = $filter_agent_veri . " OR update_by = '$v_agentid' )";
								} else {
									$where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' ";
									$filter_agent = $filter_agent . " OR trans_profiling.veri_upd = '$v_agentid' ";
									$filter_agent_veri = $filter_agent_veri . " OR update_by = '$v_agentid' ";
								}
							}
						}
						$where_agent['or_where_null'] = array($where_agent_multi);
					} else {

						if ($agentid[0] != '0') {
							// echo $agentid[0];
							$where_agent['agentid'] = $agentid[0];
							$filter_agent = " AND trans_profiling.veri_upd = '$agentid[0]'";
							$filter_agent_veri = " AND update_by = '$agentid[0]'";
						}
					}
				}
			}
			if ($userdata->opt_level == 9) {
				$where_agent['tl'] = $userdata->agentid;
			}

			$agent = $this->sys_user->get_results($where_agent, array("nama,agentid,kategori,nik_absensi,id,tl"));
			$query_trans_profiling = $this->trans_profiling->live_query(
				"SELECT veri_call,veri_upd,handphone,email,DATE(lup) as date_lup FROM trans_profiling 
				WHERE DATE_FORMAT(trans_profiling.lup ,'%Y-%m-%d') >= '$start_filter' 
				AND DATE_FORMAT(trans_profiling.lup ,'%Y-%m-%d') <= '$end_filter'
				$filter_agent
				"
			);

			$no = 1;
			$total = array();
			$total['contacted'] = 0;
			$total['uncontacted'] = 0;
			$total['hp_email'] = 0;
			$total['hp_only'] = 0;
			$total['agent_online'] = 0;
			$total['reg']['duty'] = 0;
			$duty['wfh'] = 0;
			$duty['wfo'] = 0;
			for ($i = 1; $i < 16; $i++) {
				$total[$i] = 0;
			}
			$data_profiling = $query_trans_profiling->result_array();
			// $data_profiling_verifikasi=$query_trans_profiling_verifikasi->result_array();

			if ($agent['num'] > 0) {
				foreach ($agent['results'] as $ag) {
					$data['agent'][$ag->agentid]['data'] = $ag;

					$data_agent = $this->filter_by_value($data_profiling, 'veri_upd', $ag->agentid);
					$data['agent'][$ag->agentid]['verified'] = $this->filter_by_value($data_agent, 'veri_call', 13);

					$data['agent']['total'] = 0;
					$data['agent'][$ag->agentid]['total']=0;
					for ($i = 1; $i < 17; $i++) {
						$data['agent'][$ag->agentid][$i] = count($this->filter_by_value($data_agent, 'veri_call', $i));
						$total[$i] = $data['agent'][$ag->agentid][$i] + $total[$i];
						if ($ag->kategori == "REG") {
							$total['reg'][$i] = $data['agent'][$ag->agentid][$i] + $total['reg'][$i];
						}
						if ($ag->kategori == "MOS") {
							$total['moss'][$i] = $data['agent'][$ag->agentid][$i] + $total['moss'][$i];
						}
						$data['agent'][$ag->agentid]['total'] = $data['agent'][$ag->agentid]['total'] + $data['agent'][$ag->agentid][$i];
						$total['total'] = $total['total'] + $data['agent'][$ag->agentid][$i];
					}

					$data['agent'][$ag->agentid]['sub_total_contacted'] = $data['agent'][$ag->agentid][11]+ $data['agent'][$ag->agentid][1] + $data['agent'][$ag->agentid][13] + $data['agent'][$ag->agentid][3] + $data['agent'][$ag->agentid][12];
					$data['agent'][$ag->agentid]['sub_total_uncontacted'] = $data['agent'][$ag->agentid][16] +$data['agent'][$ag->agentid][15] +$data['agent'][$ag->agentid][9] +$data['agent'][$ag->agentid][8] +$data['agent'][$ag->agentid][4] + $data['agent'][$ag->agentid][7] +  $data['agent'][$ag->agentid][10] + $data['agent'][$ag->agentid][14] + $data['agent'][$ag->agentid][2];
					$total['contacted'] = $total['contacted'] + $data['agent'][$ag->agentid]['sub_total_contacted'];
					$total['uncontacted'] = $total['uncontacted'] + $data['agent'][$ag->agentid]['sub_total_uncontacted'];
					$data['agent'][$ag->agentid]['hp_email'] = count($this->filter_by_hp_email($data['agent'][$ag->agentid]['verified'], array("handphone", "email"), array("08", "@")));
					$data['agent'][$ag->agentid]['hp_only'] = count($this->filter_by_hp_only($data['agent'][$ag->agentid]['verified'], array("handphone", "email"), array("08", "@")));
					$total['hp_email'] = $total['hp_email'] + $data['agent'][$ag->agentid]['hp_email'];
					$total['hp_only'] = $total['hp_only'] + $data['agent'][$ag->agentid]['hp_only'];
					if ($ag->kategori == "REG") {
						$total['reg']['hp_email'] = $total['reg']['hp_email'] + $data['agent'][$ag->agentid]['hp_email'];
						$total['reg']['hp_only'] = $total['reg']['hp_only'] + $data['agent'][$ag->agentid]['hp_only'];
						$total['reg']['contacted'] = $total['reg']['contacted'] + $data['agent'][$ag->agentid]['sub_total_contacted'];
						$total['reg']['uncontacted'] = $total['reg']['uncontacted'] + $data['agent'][$ag->agentid]['sub_total_uncontacted'];
						$total['reg']['verified'] = $total['reg']['verified'] + $data['agent'][$ag->agentid][13];
					}
					if ($ag->kategori == "MOS") {
						$total['moss']['hp_email'] = $total['moss']['hp_email'] + $data['agent'][$ag->agentid]['hp_email'];
						$total['moss']['hp_only'] = $total['moss']['hp_only'] + $data['agent'][$ag->agentid]['hp_only'];
						$total['moss']['contacted'] = $total['moss']['contacted'] + $data['agent'][$ag->agentid]['sub_total_contacted'];
						$total['moss']['uncontacted'] = $total['moss']['uncontacted'] + $data['agent'][$ag->agentid]['sub_total_uncontacted'];
						$total['moss']['verified'] = $total['moss']['verified'] + $data['agent'][$ag->agentid][13];
					}
					if ($data['agent'][$ag->agentid]['sub_total_contacted'] > 0 || $data['agent'][$ag->agentid]['sub_total_uncontacted'] > 0) {
						$total['agent_online']++;
						if ($ag->kategori == "MOS") {
							$num_a = $this->Sys_user_moss->get_count(array("agentid" => $ag->agentid));
							if ($num_a > 0) {
								$total['moss']['duty']++;
							}
						}
						if ($ag->kategori == "REG") {
							if ($ag->tl != '-') {
								$total['reg']['duty']++;
							}
						}
					}

					////WFH
					$begin = new DateTime($start_filter);
					$end = new DateTime($end_filter);
					if ($ag->kategori == "REG") {
						for ($i = $begin; $i <= $end; date_modify($i, '+1 day')) {


							$datena = $i->format("Y-m-d");

							$data_agent_date = $this->filter_by_value($data_agent, 'date_lup', $datena);
							$num_wfo = $this->t_absensi->get_count(array("DATE(waktu_in)" => $datena, "nik" => $ag->nik_absensi, "methode" => 0));
							$num_wfh = $this->t_absensi->get_count(array("DATE(waktu_in)" => $datena, "nik" => $ag->nik_absensi, "methode" => 1));
							if ($num_wfo > 0) {
								for ($i = 1; $i < 17; $i++) {
									$data_agent_wfo[$i] = 0;
									$data_agent_wfo[$i] = count($this->filter_by_value($data_agent_date, 'veri_call', $i));
								}
								$contacted = ($data_agent_wfo[1] + $data_agent_wfo[13] + $data_agent_wfo[3] +$data_agent_wfo[11] + $data_agent_wfo[12]);
								$uncontacted = ($data_agent_wfo[16] +$data_agent_wfo[15] +$data_agent_wfo[8] +$data_agent_wfo[9] +$data_agent_wfo[4] + $data_agent_wfo[7] + $data_agent_wfo[10] + $data_agent_wfo[14] + $data_agent_wfo[2]);
								$data['agent_wfo']['contacted'] = $data['agent_wfo']['contacted'] + $contacted;
								$data['agent_wfo']['uncontacted'] = $data['agent_wfo']['uncontacted'] + $uncontacted;
								$data['agent_wfo']['verified'] = $data['agent_wfo']['verified'] + $data_agent_wfo[13];

								if ($contacted > 0 || $uncontacted > 0) {
									$aux = $this->Sys_log->get_sum(array("DATE(logout_time)" => $datena,"login_time >= TIMESTAMP('" . $datena . "','08:00:00')"=>null,"login_time <=TIMESTAMP('" . $datena . "','17:00:00')"=>null, "id_user" => $ag->id), "TIMESTAMPDIFF(SECOND, login_time, logout_time)");
									$data['agent_wfo']['aux'] = $data['agent_wfo']['aux'] + $aux;
									if ($ag->tl != '-') {
										$data['num_wfo']++;
									}
								}
							} else {
								for ($i = 1; $i < 17; $i++) {
									$data_agent_wfh[$i] = 0;
									$data_agent_wfh[$i] = count($this->filter_by_value($data_agent_date, 'veri_call', $i));
								}
								$contacted = ($data_agent_wfh[1] + $data_agent_wfh[13] + $data_agent_wfh[3] +$data_agent_wfh[11] + $data_agent_wfh[12]);
								$uncontacted = ($data_agent_wfh[16] +$data_agent_wfh[15] +$data_agent_wfh[8] +$data_agent_wfh[9] +$data_agent_wfh[4] + $data_agent_wfh[7] +  $data_agent_wfh[10] + $data_agent_wfh[14] + $data_agent_wfh[2]);
								$data['agent_wfh']['contacted'] = $data['agent_wfh']['contacted'] + $contacted;
								$data['agent_wfh']['uncontacted'] = $data['agent_wfh']['uncontacted'] + $uncontacted;
								$data['agent_wfh']['verified'] = $data['agent_wfh']['verified'] + $data_agent_wfh[13];
								if ($contacted > 0 || $uncontacted > 0) {
									$aux = $this->Sys_log->get_sum(array("DATE(logout_time)" => $datena,"login_time >= TIMESTAMP('" . $datena . "','08:00:00')"=>null,"login_time <=TIMESTAMP('" . $datena . "','17:00:00')"=>null, "id_user" => $ag->id), "TIMESTAMPDIFF(SECOND, login_time, logout_time)");
									$data['agent_wfh']['aux'] = $data['agent_wfh']['aux'] + $aux;
									if ($ag->tl != '-') {
										if ($num_wfh > 0) {

											$data['num_wfh']++;
										}
									}
								}
							}
						}
					}
					$no++;
				}
				if ($userdata->opt_level != 8 && $userdata->opt_level != 1) {
					$data['regional'] = $this->get_regional($start_filter, $end_filter, '-');
				}
			}
		}
		$data['total'] = $total;
		$data['level'] = $userdata->opt_level;
		$this->template->load('Report_profiling/Report_profiling_list', $data);
	}

	function get_regional($start_filter, $end_filter, $agent_id)
	{
		$regional[1] = $this->trans_profiling->live_query("
		select count(*) as num_rows FROM trans_profiling_verifikasi WHERE
		 DATE_FORMAT(lup ,'%Y-%m-%d') >= '$start_filter' 
		AND DATE_FORMAT(lup ,'%Y-%m-%d') <= '$end_filter' AND
		IF(no_pstn ='' OR ISNULL(no_pstn),SUBSTR(no_speedy, 2, 1) = 1,
		(no_pstn LIKE '0627%' OR no_pstn LIKE '0629%' OR no_pstn LIKE '0702%' OR
		no_pstn LIKE '0641%' OR no_pstn LIKE '0642%' OR no_pstn LIKE '0643%' OR
		no_pstn LIKE '0644%' OR no_pstn LIKE '0645%' OR 
		no_pstn LIKE '0646%' OR no_pstn LIKE '0650%' OR no_pstn LIKE '0651%' OR
		no_pstn LIKE '0652%' OR no_pstn LIKE '0653%' OR no_pstn LIKE '0654%' OR
		no_pstn LIKE '0655%' OR no_pstn LIKE '0656%' OR no_pstn LIKE '0657%' OR
		no_pstn LIKE '0658%' OR no_pstn LIKE '0659%' OR no_pstn LIKE '061%' OR
		no_pstn LIKE '0620%' OR no_pstn LIKE '0621%' OR no_pstn LIKE '0622%' OR
		no_pstn LIKE '0623%' OR no_pstn LIKE '0624%' OR no_pstn LIKE '0625%' OR 
		no_pstn LIKE '0626%' OR no_pstn LIKE '0627%' OR no_pstn LIKE '0628%' OR 
		no_pstn LIKE '0630%' OR no_pstn LIKE '0631%' OR no_pstn LIKE '0632%' OR 
		no_pstn LIKE '0633%' OR no_pstn LIKE '0634%' OR no_pstn LIKE '0635%' OR 
		no_pstn LIKE '0636%' OR no_pstn LIKE '0638%' OR no_pstn LIKE '0639%' OR 
		no_pstn LIKE '0751%' OR no_pstn LIKE '0752%' OR no_pstn LIKE '0753%' OR 
		no_pstn LIKE '0754%' OR no_pstn LIKE '0755%' OR no_pstn LIKE '0756%' OR 
		no_pstn LIKE '0757%' OR no_pstn LIKE '0759%' OR no_pstn LIKE '0760%' OR 
		no_pstn LIKE '0761%' OR no_pstn LIKE '0762%' OR no_pstn LIKE '0763%' OR 
		no_pstn LIKE '0764%' OR no_pstn LIKE '0765%' OR no_pstn LIKE '0766%' OR 
		no_pstn LIKE '0767%' OR no_pstn LIKE '0768%' OR no_pstn LIKE '0769%' OR 
		no_pstn LIKE '0771%' OR no_pstn LIKE '0772%' OR no_pstn LIKE '0773%' OR 
		no_pstn LIKE '0776%' OR no_pstn LIKE '0777%' OR no_pstn LIKE '0778%' OR 
		no_pstn LIKE '0779%' OR no_pstn LIKE '0740%' OR no_pstn LIKE '0741%' OR 
		no_pstn LIKE '0742%' OR no_pstn LIKE '0743%' OR no_pstn LIKE '0744%' OR 
		no_pstn LIKE '0745%' OR no_pstn LIKE '0746%' OR no_pstn LIKE '0747%' OR 
		no_pstn LIKE '0748%' OR no_pstn LIKE '0711%' OR no_pstn LIKE '0712%' OR 
		no_pstn LIKE '0713%' OR no_pstn LIKE '0714%' OR no_pstn LIKE '0730%' OR 
		no_pstn LIKE '0731%' OR no_pstn LIKE '0733%' OR no_pstn LIKE '0734%' OR 
		no_pstn LIKE '0735%' OR no_pstn LIKE '0715%' OR no_pstn LIKE '0716%' OR 
		no_pstn LIKE '0717%' OR no_pstn LIKE '0718%' OR no_pstn LIKE '0719%' OR 
		no_pstn LIKE '0732%' OR no_pstn LIKE '0736%' OR no_pstn LIKE '0737%' OR 
		no_pstn LIKE '0738%' OR no_pstn LIKE '0739%' OR no_pstn LIKE '0721%' OR 
		no_pstn LIKE '0722%' OR no_pstn LIKE '0723%' OR no_pstn LIKE '0724%' OR 
		no_pstn LIKE '0725%' OR no_pstn LIKE '0726%' OR no_pstn LIKE '0727%' OR 
		no_pstn LIKE '0728%' OR no_pstn LIKE '0729%' OR no_pstn LIKE'11%'
		))");
		$regional[2] = $this->trans_profiling->live_query("
		select count(*) as num_rows FROM trans_profiling_verifikasi WHERE
			 DATE_FORMAT(lup ,'%Y-%m-%d') >= '$start_filter' 
		AND DATE_FORMAT(lup ,'%Y-%m-%d') <= '$end_filter' AND
		IF(no_pstn ='' OR ISNULL(no_pstn),SUBSTR(no_speedy, 2, 1) = 2,
		(no_pstn LIKE '021%' OR no_pstn LIKE '0254%' OR no_pstn LIKE '0251%' OR no_pstn LIKE '12%'))");
		$regional[3] = $this->trans_profiling->live_query("
		select count(*) as num_rows FROM trans_profiling_verifikasi WHERE
		 DATE_FORMAT(lup ,'%Y-%m-%d') >= '$start_filter' 
		AND DATE_FORMAT(lup ,'%Y-%m-%d') <= '$end_filter' AND
		IF(no_pstn ='' OR ISNULL(no_pstn),SUBSTR(no_speedy, 2, 1) = 3,
		(no_pstn LIKE '0252%' OR no_pstn LIKE '0253%' OR no_pstn LIKE '022%' OR 
no_pstn LIKE '0231%' OR no_pstn LIKE '0232%' OR no_pstn LIKE '0233%' OR 
no_pstn LIKE '0234%' OR no_pstn LIKE '0255%' OR no_pstn LIKE '0257%' OR 
no_pstn LIKE '0260%' OR no_pstn LIKE '0261%' OR no_pstn LIKE '0262%' OR 
no_pstn LIKE '0263%' OR no_pstn LIKE '0264%' OR no_pstn LIKE '0265%' OR 
no_pstn LIKE '0266%' OR no_pstn LIKE '0267%' OR no_pstn LIKE '13%'))");
		$regional[4] = $this->trans_profiling->live_query("
		select count(*) as num_rows FROM trans_profiling_verifikasi WHERE
		 DATE_FORMAT(lup ,'%Y-%m-%d') >= '$start_filter' 
		AND DATE_FORMAT(lup ,'%Y-%m-%d') <= '$end_filter' AND
		IF(no_pstn ='' OR ISNULL(no_pstn),SUBSTR(no_speedy, 2, 1) = 4,
		(no_pstn LIKE '024%' OR no_pstn LIKE '0271%' OR
no_pstn LIKE '0272%' OR no_pstn LIKE '0273%' OR no_pstn LIKE '0275%' OR
no_pstn LIKE '0276%' OR no_pstn LIKE '0280%' OR 
no_pstn LIKE '0281%' OR no_pstn LIKE '0282%' OR no_pstn LIKE '0283%' OR
no_pstn LIKE '0284%' OR no_pstn LIKE '0285%' OR no_pstn LIKE '0286%' OR
no_pstn LIKE '0287%' OR no_pstn LIKE '0289%' OR no_pstn LIKE '0291%' OR
no_pstn LIKE '0292%' OR no_pstn LIKE '0293%' OR no_pstn LIKE '0294%' OR
no_pstn LIKE '0295%' OR no_pstn LIKE '0296%' OR no_pstn LIKE '0297%' OR
no_pstn LIKE '0298%' OR no_pstn LIKE '0274%' OR no_pstn LIKE '14%'))");
		$regional[5] = $this->trans_profiling->live_query("
		select count(*) as num_rows FROM trans_profiling_verifikasi WHERE
		 DATE_FORMAT(lup ,'%Y-%m-%d') >= '$start_filter' 
		AND DATE_FORMAT(lup ,'%Y-%m-%d') <= '$end_filter' AND
		IF(no_pstn ='' OR ISNULL(no_pstn),SUBSTR(no_speedy, 2, 1) = 5,
		(no_pstn LIKE '031%' OR no_pstn LIKE '0321%' OR
no_pstn LIKE '0322%' OR no_pstn LIKE '0323%' OR no_pstn LIKE '0324%' OR
no_pstn LIKE '0325%' OR no_pstn LIKE '0327%' OR 
no_pstn LIKE '0328%' OR no_pstn LIKE '0331%' OR no_pstn LIKE '0332%' OR
no_pstn LIKE '0333%' OR no_pstn LIKE '0334%' OR no_pstn LIKE '0335%' OR
no_pstn LIKE '0336%' OR no_pstn LIKE '0338%' OR no_pstn LIKE '0341%' OR
no_pstn LIKE '0342%' OR no_pstn LIKE '0343%' OR no_pstn LIKE '0351%' OR
no_pstn LIKE '0352%' OR no_pstn LIKE '0353%' OR no_pstn LIKE '0354%' OR
no_pstn LIKE '0355%' OR no_pstn LIKE '0356%' OR no_pstn LIKE '0357%'
OR no_pstn LIKE '0358%' OR no_pstn LIKE '15%'))");
		$regional[6] = $this->trans_profiling->live_query("
		select count(*) as num_rows FROM trans_profiling_verifikasi WHERE
		 DATE_FORMAT(lup ,'%Y-%m-%d') >= '$start_filter' 
		AND DATE_FORMAT(lup ,'%Y-%m-%d') <= '$end_filter' AND
		IF(no_pstn ='' OR ISNULL(no_pstn),SUBSTR(no_speedy, 2, 1) = 6,
		(no_pstn LIKE '0561%' OR no_pstn LIKE '0562%' OR
no_pstn LIKE '0563%' OR no_pstn LIKE '0564%' OR no_pstn LIKE '0565%' OR
no_pstn LIKE '0567%' OR no_pstn LIKE '0568%' OR 
no_pstn LIKE '0513%' OR no_pstn LIKE '0519%' OR no_pstn LIKE '0522%' OR
no_pstn LIKE '0525%' OR no_pstn LIKE '0526%' OR no_pstn LIKE '0528%' OR
no_pstn LIKE '0531%' OR no_pstn LIKE '0532%' OR no_pstn LIKE '0534%' OR
no_pstn LIKE '0536%' OR no_pstn LIKE '0537%' OR no_pstn LIKE '0538%' OR
no_pstn LIKE '0539%' OR no_pstn LIKE '0511%' OR no_pstn LIKE '0512%' OR
no_pstn LIKE '0517%' OR no_pstn LIKE '0518%' OR
no_pstn LIKE '0526%' OR no_pstn LIKE '0527%' OR no_pstn LIKE '0541%' OR
no_pstn LIKE '0542%' OR no_pstn LIKE '0543%' OR no_pstn LIKE '0545%' OR
no_pstn LIKE '0548%' OR no_pstn LIKE '0549%' OR no_pstn LIKE '0551%' OR
no_pstn LIKE '0552%' OR no_pstn LIKE '0553%' OR no_pstn LIKE '0554%' OR
no_pstn LIKE '0556%' OR no_pstn LIKE '16%'))");
		$regional[7] = $this->trans_profiling->live_query("
		select count(*) as num_rows FROM trans_profiling_verifikasi WHERE
		 DATE_FORMAT(lup ,'%Y-%m-%d') >= '$start_filter' 
		AND DATE_FORMAT(lup ,'%Y-%m-%d') <= '$end_filter' AND
		IF(no_pstn ='' OR ISNULL(no_pstn),SUBSTR(no_speedy, 2, 1) = 7,
		(no_pstn LIKE '0361%' OR no_pstn LIKE '0362%' OR
no_pstn LIKE '0363%' OR no_pstn LIKE '0365%' OR no_pstn LIKE '0366%' OR
no_pstn LIKE '0368%' OR no_pstn LIKE '0364%' OR 
no_pstn LIKE '0370%' OR no_pstn LIKE '0371%' OR no_pstn LIKE '0372%' OR
no_pstn LIKE '0373%' OR no_pstn LIKE '0374%' OR no_pstn LIKE '0376%' OR
no_pstn LIKE '0380%' OR no_pstn LIKE '0381%' OR no_pstn LIKE '0382%' OR
no_pstn LIKE '0383%' OR no_pstn LIKE '0384%' OR no_pstn LIKE '0385%' OR
no_pstn LIKE '0386%' OR no_pstn LIKE '0387%' OR no_pstn LIKE '0388%' OR
no_pstn LIKE '0389%' OR no_pstn LIKE '0430%' OR no_pstn LIKE '0431%' OR 
no_pstn LIKE '0432%' OR no_pstn LIKE '0434%' OR no_pstn LIKE '0438%' OR 
no_pstn LIKE '0435%' OR no_pstn LIKE '0443%' OR no_pstn LIKE '0450%' OR 
no_pstn LIKE '0451%' OR no_pstn LIKE '0452%' OR no_pstn LIKE '0453%' OR 
no_pstn LIKE '0457%' OR no_pstn LIKE '0458%' OR no_pstn LIKE '0461%' OR 
no_pstn LIKE '0462%' OR no_pstn LIKE '0463%' OR no_pstn LIKE '0464%' OR 
no_pstn LIKE '0465%' OR no_pstn LIKE '0422%' OR no_pstn LIKE '0426%' OR 
no_pstn LIKE '0428%' OR no_pstn LIKE '0474%' OR no_pstn LIKE '0410%' OR 
no_pstn LIKE '0442%' OR no_pstn LIKE '0455%' OR no_pstn LIKE '0411%' OR 
no_pstn LIKE '0413%' OR no_pstn LIKE '0445%' OR no_pstn LIKE '0475%' OR 
no_pstn LIKE '0414%' OR no_pstn LIKE '0417%' OR no_pstn LIKE '0418%' OR 
no_pstn LIKE '0419%' OR no_pstn LIKE '0420%' OR no_pstn LIKE '0421%' OR 
no_pstn LIKE '0422%' OR no_pstn LIKE '0423%' OR no_pstn LIKE '0427%' OR 
no_pstn LIKE '0428%' OR no_pstn LIKE '0471%' OR no_pstn LIKE '0473%' OR 
no_pstn LIKE '0481%' OR no_pstn LIKE '0482%' OR no_pstn LIKE '0484%' OR 
no_pstn LIKE '0485%' OR no_pstn LIKE '0401%' OR no_pstn LIKE '0402%' OR 
no_pstn LIKE '0403%' OR no_pstn LIKE '0404%' OR no_pstn LIKE '0405%' OR 
no_pstn LIKE '0408%' OR no_pstn LIKE '0910%' OR no_pstn LIKE '0911%' OR 
no_pstn LIKE '0913%' OR no_pstn LIKE '0914%' OR no_pstn LIKE '0915%' OR 
no_pstn LIKE '0916%' OR no_pstn LIKE '0917%' OR no_pstn LIKE '0918%' OR 
no_pstn LIKE '0921%' OR no_pstn LIKE '0922%' OR no_pstn LIKE '0923%' OR 
no_pstn LIKE '0924%' OR no_pstn LIKE '0927%' OR no_pstn LIKE '0929%' OR 
no_pstn LIKE '0931%' OR no_pstn LIKE '0901%' OR no_pstn LIKE '0902%' OR 
no_pstn LIKE '0951%' OR no_pstn LIKE '0952%' OR no_pstn LIKE '0955%' OR 
no_pstn LIKE '0956%' OR no_pstn LIKE '0957%' OR no_pstn LIKE '0966%' OR 
no_pstn LIKE '0967%' OR no_pstn LIKE '0969%' OR no_pstn LIKE '0971%' OR 
no_pstn LIKE '0975%' OR no_pstn LIKE '0980%' OR no_pstn LIKE '0981%' OR 
no_pstn LIKE '0983%' OR no_pstn LIKE '0984%' OR no_pstn LIKE '0985%' OR 
no_pstn LIKE '0986%' OR no_pstn LIKE '17%'))");
		for ($r = 1; $r < 8; $r++) {
			$regi = $regional[$r]->row_array();
			if ($regi) {
				$return[$r] = $regi['num_rows'];
			} else {
				$return[$r] = 0;
			}
		}
		return $return;
	}
	function get_data_list()
	{
		$data['controller'] = $this;
		$start_filter = date('Y-m-d');
		$end_filter = date('Y-m-d');
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
			$agentid = $_GET['agentid'];

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

			if (isset($agentid)) {
				if ($agentid) {
					if (count($_GET['agentid']) > 1) {
						$n_agent_pick = count($_GET['agentid']);
						foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
							if ($k_agentid == 0) {
								$filter_agent = " AND (trans_profiling.veri_upd = '$v_agentid'";
								$filter_agent_veri = " AND (update_by = '$v_agentid'";
								$where_agent_multi = "( agentid = '$v_agentid'";
							} else {
								if ($k_agentid == ($n_agent_pick - 1)) {
									$where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' )";
									$filter_agent = $filter_agent . " OR trans_profiling.veri_upd = '$v_agentid' )";
									$filter_agent_veri = $filter_agent_veri . " OR update_by = '$v_agentid' )";
								} else {
									$where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' ";
									$filter_agent = $filter_agent . " OR trans_profiling.veri_upd = '$agentid' ";
									$filter_agent_veri = $filter_agent_veri . " OR update_by = '$agentid' ";
								}
							}
						}
						$where_agent['or_where_null'] = array($where_agent_multi);
					} else {
						$where_agent['agentid'] = $agentid[0];
						$filter_agent = " AND trans_profiling.veri_upd = '$agentid[0]'";
						$filter_agent_veri = " AND update_by = '$agentid[0]'";
					}
				}
			}
			if ($userdata->opt_level == 9) {
				$where_agent['tl'] = $userdata->agentid;
			}
			$data['agent'] = $this->sys_user->get_results($where_agent, array("nama,agentid,kategori"));
			$filter = array();
			$data['query_trans_profiling'] = $this->trans_profiling->live_query(
				"SELECT veri_call,veri_upd,handphone,email FROM trans_profiling 
				WHERE DATE_FORMAT(trans_profiling.lup ,'%Y-%m-%d') >= '$start_filter' 
				AND DATE_FORMAT(trans_profiling.lup ,'%Y-%m-%d') <= '$end_filter'
				$filter_agent
				"
			);
		}
		$this->load->view('Report_profiling/list_area', $data);
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
	function filter_by_hp_email($array, $index, $value)
	{
		if (is_array($array) && count($array) > 0) {
			foreach (array_keys($array) as $key) {
				if (is_array($index) && count($index) > 0) {
					$email = 0;
					$handphone = 0;
					foreach ($index as $idx => $idv) {
						$temp[$key] = $array[$key][$idv];

						if ($idv == "email") {
							if (stripos($temp[$key], $value[$idx]) !== false) {
								// if (stripos($temp[$key], $value[$idx]) !== true) {
								$email = 1;
							}
						}
						if ($idv == "handphone") {
							if (stripos($temp[$key], $value[$idx]) !== false) {
								// if (stripos($temp[$key], $value[$idx]) !== true) {

								$handphone = 1;
							}
						}
						if ($email == 1 && $handphone == 1) {
							$newarray[$key] = $array[$key];
						}
					}
				}
			}
		}
		return $newarray;
	}
	function filter_by_hp_only($array, $index, $value)
	{
		if (is_array($array) && count($array) > 0) {
			foreach (array_keys($array) as $key) {
				if (is_array($index) && count($index) > 0) {
					$email = 0;
					$handphone = 0;
					foreach ($index as $idx => $idv) {
						$temp[$key] = $array[$key][$idv];

						if ($idv == "email") {
							if ($temp[$key] == '') {
								// if (stripos($temp[$key], $value[$idx]) !== true) {
								$email = 1;
							}
						}
						if ($idv == "handphone") {
							if (stripos($temp[$key], $value[$idx]) !== false) {
								// if (stripos($temp[$key], $value[$idx]) !== true) {

								$handphone = 1;
							}
						}
						if ($email == 1 && $handphone == 1) {
							$newarray[$key] = $array[$key];
						}
					}
				}
			}
		}
		return $newarray;
	}

	function report_dapros()
	{

		$view = 'Report_profiling/dapros';
		$data['title_page_big']     =   '';

		$this->template->load($view, $data);
	}
	function report_persumber()
	{
		$start_filter = date('Y-m-d');
		$end_filter = date('Y-m-d');
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_filter = $_GET['start'];
			$end_filter = $_GET['end'];
		}
		if (isset($_GET['start']) && isset($_GET['end'])  && isset($_GET['sumber']) ) {
			$start_filter = $_GET['start'];
			$sumber = $_GET['end'];
			$end_filter = $_GET['end'];
			
			$query_trans_profiling = $this->trans_profiling->live_query(
				"SELECT ncli,pstn1,no_speedy,veri_call,veri_upd,handphone,email,DATE(lup) as date_lup FROM trans_profiling 
				WHERE DATE_FORMAT(trans_profiling.lup ,'%Y-%m-%d') >= '$start_filter' 
				AND DATE_FORMAT(trans_profiling.lup ,'%Y-%m-%d') <= '$end_filter'
				"
			);

			$no = 1;
			$data_profiling = $query_trans_profiling->result_array();
			$list_sumber=array();
			foreach ($data_profiling as $d_tp) {
				$no_speedy = $d_tp['no_speedy'];
				$no_pstn = $d_tp['pstn1'];
				$agent_id = $d_tp['veri_upd'];
				$sumber=false;
				if ($d_tp['no_speedy'] != "") {
					$sumber = $this->trans_profiling->live_query(
						"SELECT sumber FROM dbprofile_validate_forcall_3p WHERE no_speedy='$no_speedy' AND update_by='$agent_id' 
						
						"
					)->row()->sumber;
				}else{
					$sumber=$this->trans_profiling->live_query(
						"SELECT sumber FROM dbprofile_validate_forcall_3p WHERE no_pstn='$no_pstn' AND update_by='$agent_id' 
						"
					)->row()->sumber;
				}
				if($sumber){
					$list_sumber[$sumber][$d_tp['veri_call']]=$list_sumber[$sumber][$d_tp['veri_call']]+1;
				}
			}
		}
		if(count($list_sumber) > 0){
			foreach($list_sumber as $nama_sumber=>$status_call){
				echo $nama_sumber."<br>";
				foreach($status_call as $veri_call=>$jml){
					echo "Status ".$veri_call." : ".$jml."<br>";
				}
				echo "<br>";
			}
		}
		// $this->template->load('Report_profiling/Report_sumber', $data);
	}
};
