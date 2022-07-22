<?php
require APPPATH . '/controllers/Status_call/Status_call_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Report_qc extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
		$this->load->model('Custom_model/qc_model', 'qc');
	}

	public function index()
	{
		$data = array(
			'title_page_big'		=> 'Report qc',
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
		$filter_agent = array("kategori" => "REG");
		$data['user_categori'] = '-';
		if ($userdata->opt_level == 8) {
			$filter_agent = array("agentid" => $userdata->agentid);
			$data['user_categori'] = $userdata->opt_level;
		}
		if ($userdata->opt_level == 9) {
			$filter_agent = array("tl" => $userdata->agentid);
			$data['user_categori'] = $userdata->opt_level;
		}


		$data['list_agent_d'] = $this->sys_user->get_results($filter_agent);
		//$data['list_agent_d'] = $this->qc->get_results($filter_agent);
		$this->load->model('Custom_model/Sys_user_log_in_out_table_model', 'Sys_log');
		if ($userdata->opt_level == 8) {
			$log_where = array(
				'id_user' => $logindata->id_user,
				'agentid' => $userdata->agentid,
			);
			$log = $this->Sys_log->get_row($log_where, array("id,logout_time"), array("id" => "DESC"));
			if ($log) {
				if ($log->logout_time == '') {
					redirect('Lockscreen', 'refresh');
				}
			}
		}

		$data['agree'] = $this->qc->live_query("SELECT id FROM qc WHERE (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['valid'] = $this->qc->live_query("SELECT * FROM qc WHERE status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['tdkvalid'] = $this->qc->live_query("SELECT * FROM qc WHERE status_approve = 1 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		
		$this->template->load('Report_qc/Report_qc_list_by_ajax', $data);
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

			$data['qc'] = $this->qc->get_results();
			$where_agent = array("kategori" == "REG");
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
								$filter_agent = " AND (trans_profiling_last_month.veri_upd = '$v_agentid'";
								$filter_agent_veri = " AND (update_by = '$v_agentid'";
								$where_agent_multi = "( agentid = '$v_agentid'";
							} else {
								if ($k_agentid == ($n_agent_pick - 1)) {
									$where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' )";
									$filter_agent = $filter_agent . " OR trans_profiling_last_month.veri_upd = '$v_agentid' )";
									$filter_agent_veri = $filter_agent_veri . " OR update_by = '$v_agentid' )";
								} else {
									$where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' ";
									$filter_agent = $filter_agent . " OR trans_profiling_last_month.veri_upd = '$agentid' ";
									$filter_agent_veri = $filter_agent_veri . " OR update_by = '$agentid' ";
								}
							}
						}
						$where_agent['or_where_null'] = array($where_agent_multi);
					} else {
						$where_agent['agentid'] = $agentid[0];
						$filter_agent = " AND trans_profiling_last_month.veri_upd = '$agentid[0]'";
						$filter_agent_veri = " AND update_by = '$agentid[0]'";
					}
				}
			}
			if ($userdata->opt_level == 9) {
				$where_agent['tl'] = $userdata->agentid;
			}
		}

		$data['na1'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'DM Tidak Valid' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na2'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'HP salah' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na3'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Email salah' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na4'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Alamat salah' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na5'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Socmed salah' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na6'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Nama Pelanggan Salah' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na7'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Kecepatan Salah' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na8'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Kode Verifikasi Handphone Salah' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na9'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Tagihan Salah' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na10'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Waktu bayar Salah' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na11'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Tidak bersedia' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na12'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Tidak tanya HP pelanggan' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na13'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Tidak tanya email' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na14'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Tidak tanya Alamat' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na15'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Tidak tanya socmed' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na16'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Rekaman tidak ditemukan' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na17'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Validate Form < 4' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na18'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Tidak minta kode verivikasi' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na19'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Tidak speling Email' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na20'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'No PSTN Tidak Sesuai' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na21'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Tidak Konfirmasi no PSTN' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['na22'] = $this->qc->live_query("SELECT * FROM qc WHERE reason_qa = 'Lainnya' AND status_approve = 0 AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();

		$data['aht1'] = $this->qc->live_query("SELECT * FROM qc WHERE aht_qc = 'Agent Melakukan Carring' AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['aht2'] = $this->qc->live_query("SELECT * FROM qc WHERE aht_qc = 'Pelanggan Ragu - Ragu' AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['aht3'] = $this->qc->live_query("SELECT * FROM qc WHERE aht_qc = 'Pelanggan Meminta Menunggu' AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['aht4'] = $this->qc->live_query("SELECT * FROM qc WHERE aht_qc = 'Pertanyaan Agent berbelit - belit' AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['aht5'] = $this->qc->live_query("SELECT * FROM qc WHERE aht_qc = 'Tidak langsung bertemu DM' AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['aht6'] = $this->qc->live_query("SELECT * FROM qc WHERE aht_qc = 'Spelling' AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['aht7'] = $this->qc->live_query("SELECT * FROM qc WHERE aht_qc = 'Keluhan pelanggan' AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		$data['aht8'] = $this->qc->live_query("SELECT * FROM qc WHERE aht_qc = 'Tanya promo / produk' AND (DATE(tanggal) BETWEEN '$start_filter' AND '$end_filter')")->num_rows();
		
		
		$this->load->view('Report_qc/list_area', $data);
	}

	function download_excel()
	{

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
				$agentid = $userdata->agentid;
			}

			if (isset($agentid)) {

				if ($agentid) {
					if (count($_GET['agentid']) > 1) {
						$n_agent_pick = count($_GET['agentid']);
						foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
							if ($k_agentid == 0) {
								$filter_agent = " AND (trans_profiling_last_month.veri_upd = '$v_agentid'";
								$filter_agent_veri = " AND (update_by = '$v_agentid'";
								$where_agent_multi = "( agentid = '$v_agentid'";
							} else {
								if ($k_agentid == ($n_agent_pick - 1)) {
									$where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' )";
									$filter_agent = $filter_agent . " OR trans_profiling_last_month.veri_upd = '$v_agentid' )";
									$filter_agent_veri = $filter_agent_veri . " OR update_by = '$v_agentid' )";
								} else {
									$where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' ";
									$filter_agent = $filter_agent . " OR trans_profiling_last_month.veri_upd = '$agentid' ";
									$filter_agent_veri = $filter_agent_veri . " OR update_by = '$agentid' ";
								}
							}
						}
						$where_agent['or_where_null'] = array($where_agent_multi);
					} else {
						$where_agent['agentid'] = $agentid[0];
						$filter_agent = " AND trans_profiling_last_month.veri_upd = '$agentid[0]'";
						$filter_agent_veri = " AND update_by = '$agentid[0]'";
					}
				}
			}
			if ($userdata->opt_level == 9) {
				$where_agent['tl'] = $userdata->agentid;
			}
			//	$data['agent'] = $this->sys_user->get_results($where_agent, array("nama,agentid"));
			$filter = array();
			$data['query_trans_profiling'] = $this->trans_profiling_last_month->live_query(
				"SELECT veri_call,veri_upd,handphone,email FROM trans_profiling_last_month 
				WHERE DATE_FORMAT(trans_profiling_last_month.lup ,'%Y-%m-%d') >= '$start_filter' 
				AND DATE_FORMAT(trans_profiling_last_month.lup ,'%Y-%m-%d') <= '$end_filter'
				$filter_agent
				-- AND trans_profiling.veri_status <> 13
				"
			);
			// $data['query_trans_profiling_verifikasi'] = $this->trans_profiling_verifikasi->live_query(
			// 	"SELECT update_by,no_handpone,email FROM trans_profiling_verifikasi 
			// 	WHERE DATE_FORMAT(lup ,'%Y-%m-%d') >= '$start_filter' 
			// 	AND DATE_FORMAT(lup ,'%Y-%m-%d') <= '$end_filter'
			// 	$filter_agent_veri
			// 	"
			// );
			$this->download_excel_profiling($data);
		}
	}
	private function download_excel_profiling($data)
	{


		$no = 1;
		$total = array();
		$total['contacted'] = 0;
		$total['uncontacted'] = 0;
		$total['hp_email'] = 0;
		$total['hp_only'] = 0;
		$total['agent_online'] = 0;
		for ($i = 1; $i < 16; $i++) {
			$total[$i] = 0;
		}
		if ($data['agent']['num'] > 0) {
			$sub_total_contacted = 0;
			$sub_total_uncontacted = 0;
			$this->load->library("PHPExcel");
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setCreator("Infomedia")
				->setLastModifiedBy("Infomedia")
				->setTitle("Office 2007 XLSX Test Document")
				->setSubject("Office 2007 XLSX Test Document")
				->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
				->setKeywords("office 2007 openxml php")
				->setCategory("Test result file");


			//========================================//
			/* 	 MEMBUAT TABLE ISIAN PADA COLUMN A1	  */
			//========================================//					 

			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', 'No')
				->setCellValue('B1', 'Nama Agent')
				->setCellValue('C1', 'Agent ID')
				->setCellValue('D1', 'Contacted')
				->setCellValue('K1', 'Not Contacted');

			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('D2', 'BP')
				->setCellValue('E2', 'Verified')
				->setCellValue('F2', 'TBP')
				->setCellValue('G2', 'FLUP')
				->setCellValue('H2', 'Sub Total')
				->setCellValue('I2', 'Hp & Email')
				->setCellValue('J2', 'Hp Only')
				->setCellValue('K2', 'RNA')
				->setCellValue('L2', 'SS')
				->setCellValue('M2', 'Isolir')
				->setCellValue('N2', 'Decline')
				->setCellValue('O2', 'Reject')
				->setCellValue('P2', 'Lain Reject')
				->setCellValue('Q2', 'Sub Total');

			//MERGE COLOMN A1-D1 UNTUK TITLE KETERANGAN
			$objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
			$objPHPExcel->getActiveSheet()->mergeCells('B1:B2');
			$objPHPExcel->getActiveSheet()->mergeCells('C1:C2');

			//MERGE COLOMN A2-D2 UNTUK TITLE KETERANGAN
			$objPHPExcel->getActiveSheet()->mergeCells('D1:J1');
			$objPHPExcel->getActiveSheet()->mergeCells('K1:Q1');

			// //MEMBUAT COLOR FONT WHITE A3-D3	
			// $objPHPExcel->getActiveSheet()->getStyle('A1:Q2')->getFont()
			// 	->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

			//BOLD G3-H4
			$objPHPExcel->getActiveSheet()->getStyle('A1:Q2')->getFont()->setBold(true);

			//SET COLOR CELL BLACK A3-D3
			$objPHPExcel->getActiveSheet()->getStyle('A1:Q2')->getFill()
				->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
				->getStartColor()->setARGB(PHPExcel_Style_Color::COLOR_YELLOW);



			//========================================//
			/* 	 END TABLE ISIAN PADA COLUMN A1	  */
			//========================================//
			$i_excel = 3;
			foreach ($data['agent']['results'] as $ag) {

				$data_agent = $this->filter_by_value($data['query_trans_profiling']->result_array(), 'veri_upd', $ag->agentid);
				$status_1 = count($this->filter_by_value($data_agent, 'veri_call', '1'));
				// $verified = $this->filter_by_value($data['query_trans_profiling_verifikasi']->result_array(), 'update_by', $ag->agentid);

				$verified = $this->filter_by_value($data_agent, 'veri_call', '13');
				$status_3 = count($this->filter_by_value($data_agent, 'veri_call', '3'));
				$status_12 = count($this->filter_by_value($data_agent, 'veri_call', '12'));
				$status_2 = count($this->filter_by_value($data_agent, 'veri_call', '2'));
				$status_4 = count($this->filter_by_value($data_agent, 'veri_call', '4'));
				$status_7 = count($this->filter_by_value($data_agent, 'veri_call', '7'));
				$status_11 = count($this->filter_by_value($data_agent, 'veri_call', '11'));
				$status_10 = count($this->filter_by_value($data_agent, 'veri_call', '10'));
				$status_14 = count($this->filter_by_value($data_agent, 'veri_call', '14'));
				$sub_total_contacted = $status_1 + count($verified) + $status_3 + $status_12;
				$sub_total_uncontacted = $status_4 + $status_7 + $status_11 + $status_10 + $status_14 + $status_2;
				$total['contacted'] = $total['contacted'] + $sub_total_contacted;
				$total['uncontacted'] = $total['uncontacted'] + $sub_total_uncontacted;
				$hp_email = $this->filter_by_hp_email($verified, array("handphone", "email"), array("08", "@"));
				$hp_only = $this->filter_by_hp_only($verified, array("handphone", "email"), array("08", "@"));
				$total['hp_email'] = $total['hp_email'] + count($hp_email);
				$total['hp_only'] = $total['hp_only'] + count($hp_only);
				$total[1] = $status_1 + $total[1];
				$total[2] = $status_2 + $total[2];
				$total[3] = $status_3 + $total[3];
				$total[4] = $status_4 + $total[4];
				$total[5] = $status_5 + $total[5];
				$total[6] = $status_6 + $total[6];
				$total[7] = $status_7 + $total[7];
				$total[8] = $status_8 + $total[8];
				$total[9] = $status_9 + $total[9];
				$total[10] = $status_10 + $total[10];
				$total[11] = $status_11 + $total[11];
				$total[12] = $status_12 + $total[12];
				$total[13] = count($verified) + $total[13];
				$total[14] = $status_14 + $total[14];
				$total[15] = $status_15 + $total[15];
				$total[16] = $status_16 + $total[16];

				$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A' . $i_excel, $no)
					->setCellValue('B' . $i_excel, $ag->nama)
					->setCellValue('C' . $i_excel, $ag->agentid)
					->setCellValue('D' . $i_excel, number_format($status_1))
					->setCellValue('E' . $i_excel, number_format(count($verified)))
					->setCellValue('F' . $i_excel, number_format($status_3))
					->setCellValue('G' . $i_excel, number_format($status_12))
					->setCellValue('H' . $i_excel, number_format($sub_total_contacted))
					->setCellValue('I' . $i_excel, number_format(count($hp_email)))
					->setCellValue('J' . $i_excel, number_format(count($hp_only)))
					->setCellValue('K' . $i_excel, number_format($status_2))
					->setCellValue('L' . $i_excel, number_format($status_4))
					->setCellValue('M' . $i_excel, number_format($status_7))
					->setCellValue('N' . $i_excel, number_format($status_11))
					->setCellValue('O' . $i_excel, number_format($status_10))
					->setCellValue('P' . $i_excel, number_format($status_14))
					->setCellValue('Q' . $i_excel, number_format($sub_total_uncontacted));
				if ($sub_total_contacted > 0 || $sub_total_uncontacted > 0) {
					$total['agent_online']++;
				}
				$i_excel++;
				$no++;
			}
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A' . $i_excel, 'TOTAL')
				->setCellValue('D' . $i_excel, number_format($total[1]))
				->setCellValue('E' . $i_excel, number_format($total[13]))
				->setCellValue('F' . $i_excel, number_format($total[3]))
				->setCellValue('G' . $i_excel, number_format($total[12]))
				->setCellValue('H' . $i_excel, number_format($total['contacted']))
				->setCellValue('I' . $i_excel, number_format($total['hp_email']))
				->setCellValue('J' . $i_excel, number_format($total['hp_only']))
				->setCellValue('K' . $i_excel, number_format($total[2]))
				->setCellValue('L' . $i_excel, number_format($total[4]))
				->setCellValue('M' . $i_excel, number_format($total[7]))
				->setCellValue('N' . $i_excel, number_format($total[11]))
				->setCellValue('O' . $i_excel, number_format($total[10]))
				->setCellValue('P' . $i_excel, number_format($total[14]))
				->setCellValue('Q' . $i_excel, number_format($total['uncontacted']));


			//MERGE COLOMN A2-D2 UNTUK TITLE KETERANGAN
			$objPHPExcel->getActiveSheet()->mergeCells('A' . $i_excel . ':C' . $i_excel);

			//BOLD G3-H4
			$objPHPExcel->getActiveSheet()->getStyle('A' . $i_excel . ':Q' . $i_excel)->getFont()->setBold(true);

			//MEMBUAT BORDER TABLE
			$thick = array();
			$thick['borders'] = array();
			$thick['borders']['allborders'] = array();
			$thick['borders']['allborders']['style'] = PHPExcel_Style_Border::BORDER_THIN;
			$objPHPExcel->getActiveSheet()->getStyle('A1:Q' . $i_excel)->applyFromArray($thick);

			//SET ALIGNMENT -CENTER-CENTER A1-A2
			$objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

			//SET ALIGNMENT -CENTER-CENTER A1-A2
			$objPHPExcel->getActiveSheet()->getStyle('A' . $i_excel)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$objPHPExcel->getActiveSheet()->getStyle('A' . $i_excel)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('REPORT');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Report_profiling.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
			header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			exit;
		}
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
};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-01-12 19:58:23 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
