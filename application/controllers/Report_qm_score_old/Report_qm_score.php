<?php
require APPPATH . '/controllers/Report_qm_score/Report_qm_score_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Report_qm_score extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Custom_model/Status_call_model', 'status_call');
		$this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
		$this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling');
		$this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling_verifikasi');
		$this->load->model('Custom_model/Trans_profiling_daily_model', 'trans_profiling_daily');
		$this->load->model('Custom_model/Qm_score_model', 'qm_score');
		$this->load->model('Custom_model/Qm_score_parameter_model', 'qm_score_parameter');
		$this->load->model('Custom_model/qc_model', 'qc');
		$this->title = new Report_qm_score_config();
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
			'title_page_big'		=> 'Report Qm Score',
			'title'					=> "Report Qm Score " . $start_filter . " Sampai " . $end_filter,
		);
		$data['controller'] = $this;

		$filter_agent = array("opt_level" => 8, "tl !=" => "-");
		if ($userdata->opt_level == 8) {
			$filter_agent = array("agentid" => $userdata->agentid);
			$data['user_categori'] = $userdata->opt_level;
		}
		$data['list_agent'] = $this->sys_user->get_results($filter_agent);

		if (isset($_GET['tahun']) && isset($_GET['bulan']) && isset($_GET['peak'])) {
			$tahun = $_GET['tahun'];
			$bulan = $_GET['bulan'];
			$peak = $_GET['peak'];
			$agentid = $_GET['agentid'];

			$data['status'] = $this->status_call->get_results();
			$where_agent = array("opt_level" => 8, "tl !=" => "-", "kategori" => "REG");

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

			if ($userdata->opt_level == 9) {
				$where_agent['tl'] = $userdata->agentid;
			}

			if ($peak == 1) {
				$startdate = "-01";
				$enddate = "-10";
			} elseif ($peak == 2) {
				$startdate = "-11";
				$enddate = "-20";
			} elseif ($peak == 3) {
				$startdate = "-21";
				$enddate = "-31";
			}
			$start = $tahun . "-" . $bulan . $startdate;
			$end = $tahun . "-" . $bulan . $enddate;
			$agent = $this->sys_user->get_results($where_agent, array("nama,agentid,kategori,nik_absensi,id,tl"));
			$query_report = $this->qm_score->live_query(
				"SELECT * FROM qm_score 
				WHERE
				DATE(tanggal) >= '$start' AND DATE(tanggal) <= '$end'
				 $filter_agent
				"
			);
			$qr_qm = $query_report->result();

			if (count($qr_qm) > 0) {
				foreach ($qr_qm as $r) {
					$data['agent'][$r->agentid][$r->id_qm_score][$r->hasil] = intval($data['agent'][$r->id_qm_score][$r->hasil]) + 1;
					$data['total'][$r->id_qm_score][$r->hasil] = intval($data['total'][$r->id_qm_score][$r->hasil]) + 1;
				}
			}
			$data['users'] = $agent;
			if (isset($agentid)) {
				if ($agentid) {
					if (count($_GET['agentid']) > 1) {
						$n_agent_pick = count($_GET['agentid']);
						foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
							if ($k_agentid == 0) {
								$filter_agent = " AND (qm_score.agentid = '$v_agentid'";
								$where_agent_multi = "AND ( qm_score.agentid = '$v_agentid'";
							} else {
								if ($k_agentid == ($n_agent_pick - 1)) {
									$where_agent_multi = $where_agent_multi . " OR qm_score.agentid = '$v_agentid' )";
									$filter_agent = $filter_agent . " OR agentid = '$v_agentid' )";
								} else {
									$where_agent_multi = $where_agent_multi . " OR qm_score.agentid = '$v_agentid' ";
									$filter_agent = $filter_agent . " OR qm_score.agentid = '$agentid' ";
								}
							}
						}
						$where_agent['or_where_null'] = array($where_agent_multi);
					} else {
						if ($agentid[0] != '0') {
							$where_agent['agentid'] = $agentid[0];
							$filter_agent = " AND qm_score.agentid = '$agentid[0]' ";
							$where_agent_multi = "AND ( qm_score.agentid = '$agentid[0]')";
						}
					}
				}
			}
			$data['query_report_detailed'] = $this->qm_score->live_query(
				"SELECT
				sys_user.agentid,
				sys_user.nama,
				
	CONCAT(qm_score.tanggal, qm_score.dial_to) as tanggals,
				qm_score.* 
			FROM
			qm_score
				LEFT JOIN sys_user ON sys_user.agentid = qm_score.agentid 
			WHERE
				DATE(tanggal) >= '$start' AND DATE(tanggal) <= '$end'
				AND (sys_user.kategori = 'REG' 
				OR sys_user.kategori = 'MOS')
				$where_agent_multi	
				ORDER BY tanggal,id_qm_score ASC
				"
			);


			$data['qm_score_parameter'] = $this->qm_score_parameter->get_results(array(), array("*"), array(), array("urutan" => "ASC"));
			$data['qm_score_parameter_1'] = $this->qm_score_parameter->get_results(array("kategori" => 1), array("*"), array(), array("urutan" => "ASC"));
			$data['qm_score_parameter_2'] = $this->qm_score_parameter->get_results(array("kategori" => 2), array("*"), array(), array("urutan" => "ASC"));
			$data['qm_score_parameter_3'] = $this->qm_score_parameter->get_results(array("kategori" => 3), array("*"), array(), array("urutan" => "ASC"));
		}


		$start = $tahun . "-" . $bulan . $startdate;
		$end = $tahun . "-" . $bulan . $enddate;

		$data['agree'] = $this->qc->live_query("SELECT id FROM qc WHERE (DATE(tanggal) BETWEEN '$start' AND '$end')")->num_rows();
		$data['valid'] = $this->qc->live_query("SELECT * FROM qc WHERE status_approve = 1 AND (DATE(tanggal) BETWEEN '$start' AND '$end')")->num_rows();
		$data['tdkvalid'] = $this->qc->live_query("SELECT * FROM qc WHERE status_approve = 0 AND (DATE(tanggal) BETWEEN '$start' AND '$end')")->num_rows();
		$data['controller'] = $this;
		$data['start'] = $start;
		$data['end'] = $end;

		// echo var_dump($data['total'][$r->id_qm_score][$r->hasil]);
		$this->template->load('Report_qm_score/Report_qm_score_list', $data);
	}



	function action()
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
			'title_page_big'		=> 'Report Qm Score',
			'title'					=> "Report Qm Score " . $start_filter . " Sampai " . $end_filter,
		);
		$data['controller'] = $this;

		$filter_agent = array("opt_level" => 8, "tl !=" => "-");
		if ($userdata->opt_level == 8) {
			$filter_agent = array("agentid" => $userdata->agentid);
			$data['user_categori'] = $userdata->opt_level;
		}
		$data['list_agent'] = $this->sys_user->get_results($filter_agent);

		if (isset($_GET['tahun']) && isset($_GET['bulan']) && isset($_GET['peak'])) {
			$tahun = $_GET['tahun'];
			$bulan = $_GET['bulan'];
			$peak = $_GET['peak'];
			if (isset($_GET['agentid'])) {
				$agentid = $_GET['agentid'];
			} else {
				$agentid = "";
			}


			$data['status'] = $this->status_call->get_results();
			$where_agent = array("opt_level" => 8, "tl !=" => "-", "kategori" => "REG");

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

			if ($userdata->opt_level == 9) {
				$where_agent['tl'] = $userdata->agentid;
			}

			if ($peak == 1) {
				$startdate = "-01";
				$enddate = "-10";
			} elseif ($peak == 2) {
				$startdate = "-11";
				$enddate = "-20";
			} elseif ($peak == 3) {
				$startdate = "-21";
				$enddate = "-31";
			}
			$start = $tahun . "-" . $bulan . $startdate;
			$end = $tahun . "-" . $bulan . $enddate;
			$agent = $this->sys_user->get_results($where_agent, array("nama,agentid,kategori,nik_absensi,id,tl"));
			$query_report = $this->qm_score->live_query(
				"SELECT * FROM qm_score 
				WHERE
				DATE(tanggal) >= '$start' AND DATE(tanggal) <= '$end'
				 $filter_agent
				"
			);
			$qr_qm = $query_report->result();

			$data['users'] = $agent;
			if (isset($agentid)) {
				if ($agentid) {
					if (count($_GET['agentid']) > 1) {
						$n_agent_pick = count($_GET['agentid']);
						foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
							if ($k_agentid == 0) {
								$filter_agent = " AND (qm_score.agentid = '$v_agentid'";
								$where_agent_multi = "AND ( qm_score.agentid = '$v_agentid'";
							} else {
								if ($k_agentid == ($n_agent_pick - 1)) {
									$where_agent_multi = $where_agent_multi . " OR qm_score.agentid = '$v_agentid' )";
									$filter_agent = $filter_agent . " OR agentid = '$v_agentid' )";
								} else {
									$where_agent_multi = $where_agent_multi . " OR qm_score.agentid = '$v_agentid' ";
									$filter_agent = $filter_agent . " OR qm_score.agentid = '$agentid' ";
								}
							}
						}
						$where_agent['or_where_null'] = array($where_agent_multi);
					} else {
						if ($agentid[0] != '0') {
							$where_agent['agentid'] = $agentid[0];
							$filter_agent = " AND qm_score.agentid = '$agentid[0]' ";
							$where_agent_multi = "AND ( qm_score.agentid = '$agentid[0]')";
						}
					}
				}
			}
			$query_report_detailed = $this->qm_score->live_query(
				"SELECT
				sys_user.agentid,
				sys_user.nama,
				
	CONCAT(qm_score.tanggal, qm_score.dial_to) as tanggals,
				qm_score.* 
			FROM
			qm_score
				LEFT JOIN sys_user ON sys_user.agentid = qm_score.agentid 
			WHERE
				DATE(tanggal) >= '$start' AND DATE(tanggal) <= '$end'
				AND (sys_user.kategori = 'REG' 
				OR sys_user.kategori = 'MOS')
				ORDER BY tanggal,id_qm_score ASC
				"
			);
		}


		$start = $tahun . "-" . $bulan . $startdate;
		$end = $tahun . "-" . $bulan . $enddate;

		$data['agree'] = $this->qc->live_query("SELECT id FROM qc WHERE (DATE(tanggal) BETWEEN '$start' AND '$end')")->num_rows();
		$data['valid'] = $this->qc->live_query("SELECT * FROM qc WHERE status_approve = 1 AND (DATE(tanggal) BETWEEN '$start' AND '$end')")->num_rows();
		$data['tdkvalid'] = $this->qc->live_query("SELECT * FROM qc WHERE status_approve = 0 AND (DATE(tanggal) BETWEEN '$start' AND '$end')")->num_rows();
		$data['controller'] = $this;
		$data['start'] = $start;
		$data['end'] = $end;


		$this->load->library("excel");

		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);

		$table_columns = array(
			"No", "Nama Agent", "Tgl Penilaian", "Tgl Kejadian", "Dial To",
			"Salam pembuka",
			"Salam penutup",
			"Mengucapkan nama pelanggan minimal 3 kali  (awal, tengah & akhir) selama percakapan.",
			"Menyampaikan informasi/pertanyaan dengan jelas, lengkap dan sistematis (tidak berbelit-belit)",
			"Menggunakan bahasa Indonesia/inggris dengan baik & benar, serta sopan",
			"Intonasi & artikulasi",
			"Validasi data pemilik nomor Nama, Alamat, Kecepatan, Tagihan, Tahun pemasangan,Tempat Pembayaran",
			"Decision Maker",
			"Verifikasi HP",
			"Verifikasi Email",
			"Kode Verifikasi",
			"Dapat memberikan informasi tujuan Profiling",
			"Melakukan dokumentasi pada aplikasi terkait",
			"Phone & Communication Skill",
			"Validation",
			"Documentatioin & Information"
		);

		$column = 0;

		foreach ($table_columns as $field) {

			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);

			$column++;
		}


		////
		if (count($query_report_detailed->result()) != "") {
			foreach ($query_report_detailed->result() as $datana) {
				$dataarray[$datana->nama][$datana->tanggals][$datana->tanggal_kejadian][$datana->dial_to][$datana->id_qm_score][$datana->keterangan] = $datana->hasil;
			}



			if (count($dataarray) != 0) {
				$no = 1;
				$excel_row = 2;
				foreach ($dataarray as $keyagent => $valueagent) {


					if (count($valueagent) > 1) {

						foreach ($valueagent as $keyagent2 => $valueagent2) {

							$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $no);
							$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $keyagent);
							$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $keyagent2);

							foreach ($valueagent2 as $keykejadian => $valuekejadian) {
								$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, substr($keykejadian, 0, 10));

								foreach ($valuekejadian as $keydialto => $valdialto) {

									$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $keydialto);

									foreach ($valdialto as $keyqm => $valueqm) {
										// echo "<td>" . $valueqm . "</td>";
										foreach ($valueqm as $keyket => $valket) {
											if ($valket == "0") {
												$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $keyket);
											} else {
												$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $valket);
											}
										}
									}

									// echo "<td>";
									$average = (($valket[1] + $valket[2] + $valket[3] + $valket[4] + $valket[5] + $valket[6]) / 6) * 100;
									// echo round($average, 2);
									$object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, round($average, 2));
									// echo "<td>";
									$average1 = (($valket[7] + $valket[8] + $valket[9] + $valket[10] + $valket[11]) / 5) * 100;
									// echo round($average1, 2) . "%</td>";
									// echo "<td>";
									$object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, round($average1, 2));
									$average2 = (($valket[12] + $valket[13]) / 2) * 100;
									// echo round($average2, 2) . "%</td>";
									// echo "</tr>";
									$object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, round($average2, 2));
								}
							}
						}
					} else {
						foreach ($valueagent as $keytanggal => $valuetanggal) {
							// echo "<tr>";
							// echo "<td>" . $no . "</td>";
							$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $no);
							$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $keyagent);
							// echo "<td>" . $keyagent . "</td>";
							$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, substr($keytanggal, 0, 10));
							// echo "<td>" . substr($keytanggal, 0, 10) . "</td>";
							foreach ($valuetanggal as $keykejadian => $valuekejadian) {
								// echo "<td>" . substr($keykejadian, 0, 10) . "</td>";
								$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, substr($keykejadian, 0, 10));
								foreach ($valuekejadian as $keydialto => $valdialto) {
									// echo "<td>" . $keydialto . "</td>";
									$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $keydialto);

									$numval = 5;
									$nbr = 1;
									foreach ($valdialto as $keyqm => $valueqm) {
										// echo "<td>" . $valueqm . "</td>";

										foreach ($valueqm as $keyket => $valket) {

											if ($valket == "0") {
												// echo "<td>" . $keyket . "</td>";
												$object->getActiveSheet()->setCellValueByColumnAndRow($numval, $excel_row, $valket);
												$arr_letter = array(
													5 => "F",
													6 => "G",
													7 => "H",
													8 => "I",
													9 => "J",
													10 => "K",
													11 => "L",
													12 => "M",
													13 => "N",
													14 => "O",
													15 => "P",
													16 => "Q",
													17 => "R",
													18 => "S",
													19 => "T",
													20 => "U",
												);
												$object->getActiveSheet()->getComment($arr_letter[$numval] . $excel_row)->getText()->createTextRun($keyket);
												$value[$nbr] = $valket;
											} else {
												// echo "<td>" . $valket . "</td>";
												$object->getActiveSheet()->setCellValueByColumnAndRow($numval, $excel_row, $valket);
												$value[$nbr] = $valket;
											}

											$numval++;
											$nbr++;
										}
										// var_dump($value);
									}


									// echo "<td>";
									$average = (($value[1] + $value[2] + $value[3] + $value[4] + $value[5] + $value[6]) / 6) * 100;
									// // echo round($average, 2) . "%</td>";
									// // echo "<td>";
									$object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, round($average, 2));
									$average1 = (($value[7] + $value[8] + $value[9] + $value[10] + $value[11]) / 5) * 100;
									// // echo round($average1, 2) . "%</td>";
									// // echo "<td>";
									$object->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row, round($average1, 2));
									$average2 = (($value[12] + $value[13]) / 2) * 100;
									// // echo round($average2, 2) . "%</td>";
									// // echo "</tr>";
									$object->getActiveSheet()->setCellValueByColumnAndRow(20, $excel_row, round($average2, 2));
								}
							}
						}
					}

					$no++;
					$excel_row++;
				}
			}
		}


		////
		// $employee_data = $this->db->query("SELECT * FROM sys_user")->result();

		// $excel_row = 2;

		// foreach ($employee_data as $row) {

		// 	$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->agentid);

		// 	$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->agentid);

		// 	$excel_row++;
		// }

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Qm Score Report.xlsx"');
		$object_writer->save('php://output');
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
		if (isset($_GET['start']) && isset($_GET['end'])  && isset($_GET['sumber'])) {
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
			$list_sumber = array();
			foreach ($data_profiling as $d_tp) {
				$no_speedy = $d_tp['no_speedy'];
				$no_pstn = $d_tp['pstn1'];
				$agent_id = $d_tp['veri_upd'];
				$sumber = false;
				if ($d_tp['no_speedy'] != "") {
					$sumber = $this->trans_profiling->live_query(
						"SELECT sumber FROM dbprofile_validate_forcall_3p WHERE no_speedy='$no_speedy' AND update_by='$agent_id' 
						
						"
					)->row()->sumber;
				} else {
					$sumber = $this->trans_profiling->live_query(
						"SELECT sumber FROM dbprofile_validate_forcall_3p WHERE no_pstn='$no_pstn' AND update_by='$agent_id' 
						"
					)->row()->sumber;
				}
				if ($sumber) {
					$list_sumber[$sumber][$d_tp['veri_call']] = $list_sumber[$sumber][$d_tp['veri_call']] + 1;
				}
			}
		}
		if (count($list_sumber) > 0) {
			foreach ($list_sumber as $nama_sumber => $status_call) {
				echo $nama_sumber . "<br>";
				foreach ($status_call as $veri_call => $jml) {
					echo "Status " . $veri_call . " : " . $jml . "<br>";
				}
				echo "<br>";
			}
		}
		// $this->template->load('Report_profiling/Report_sumber', $data);
	}
};
