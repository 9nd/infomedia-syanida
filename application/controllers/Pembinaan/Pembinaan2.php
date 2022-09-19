<?php


if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Pembinaan extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();

		$this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
		$this->load->model('Custom_model/qc_model', 'qc');
		$this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
	}

	public function Tambah_form()
	{

		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);

		$filter_agent = array("opt_level" => 8, "tl !=" => "-");
		$data['list_agent_d'] = $this->sys_user->get_results($filter_agent);
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$this->template->load('Pembinaan/Form_tambah', $data);
	}

	public function insertk()
	{
		if (isset($_POST["idtemuan"])) {
			$idtemuan = $_POST["idtemuan"];	
				
				if ($idtemuan != '') {
					$queryx = $this->db->query('INSERT INTO t_pembinaan(id_kasus, tanggal_pembinaan, status_pembinaan, keterangan) 
				VALUES("' . $idtemuan . '", "' . $idtemuan . '", "' . $idtemuan . '", "' . $idtemuan . '")');
				}
			
			if ($queryx != '') {
				if ($queryx) {
					echo 'Item Data Inserted';
				} else {
					echo 'Error';
				}
			} else {
				echo 'All Fields are Required';
			}
		}
	}

	public function fetch()
	{

		$resulta = $this->db->query("SELECT * FROM t_pembinaan ORDER BY id DESC")->result();
?>
		<br />
		<h3 align="center">Item Data</h3>
		<table class="table table-bordered table-striped">
			<tr>
				<th width="30%">Item Name</th>
				<th width="10%">Item Code</th>
				<th width="50%">Description</th>
				<th width="10%">Price</th>
			</tr>
<?php

			foreach ($resulta as $row) {
				echo " <tr> ";
				echo "  <td>" . $row->id . "</td>";
				echo " <td>" .  $row->id . "</td>";
				echo "  <td>" .  $row->id . "</td>";
				echo "  <td>" .  $row->id . "</td>";
				echo " </tr>";
				
			}
			echo "	</table>";
		}

		public function get_kasus()
		{
			$idlogin = $this->session->userdata('idlogin');
			$logindata = $this->log_login->get_by_id($idlogin);
			$agentid = $_GET['agentid'];
			$list_qc = $this->db->query("SELECT lup, reason_qa, id,keterangan_qc, handphone FROM qc WHERE agentid='$agentid' AND status_approve='0'")->result();
			// var_dump($list_qc);
			$user_categori = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user))->opt_level;
			// var_dump($user_categori);
			?>
			<?php echo _css("datatables") ?>
			<table id="tableget" class="timecard display">
				<thead>
					<tr>
						<td>id kasus</td>
						<td>tanggal</td>
						<td>parameter</td>
						<td>NO HP</td>
						<td>Detail Not Approve</td>
						<td>#</td>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($user_categori != 8) {
					?>
						<option value="0">--Semua Kasus--</option>
					<?php
					}
					if (COUNT($list_qc) > 0) {
						foreach ($list_qc as $list_kasus) {

							echo "<tr>";
							echo "<td>" . $list_kasus->id . "</td>";
							echo "<td>" . substr($list_kasus->lup, 0, 10) . "</td>";
							echo "<td>" . $list_kasus->reason_qa . "</td>";
							echo "<td>" . $list_kasus->handphone . "</td>";
							echo "<td>" . $list_kasus->keterangan_qc . "</td>";
							echo "<td> <button type='button' name='insertk' id='$list_kasus->id' class='btn btn-info'><span class='fe fe-plus-circle'></span></button></td>";
							echo "</tr>";
						}
					}
					?>

				</tbody>
			</table>

			<?php echo _js("datatables") ?>
			<script type="text/javascript">
				$(document).ready(function() {

					$("#tableget").DataTable({
						dom: 'Bfrtip'
					});
				});
			</script>
	<?php
		}
		public function index()
		{
			$data = array(
				'title_page_big'		=> 'Coaching List',
				'title'					=> $this->title,
			);
			if (isset($_GET['start']) && isset($_GET['end'])) {
				$start = $_GET['start'];
				$end = $_GET['end'];
			}


			$idlogin = $this->session->userdata('idlogin');
			$logindata = $this->log_login->get_by_id($idlogin);
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
			$data['list_pembinaan'] = $this->db->query(
				"SELECT
			*
		FROM
		t_pembinaan
			
		WHERE
			DATE(tanggal_pembinaan) >= '$start' AND DATE(tanggal_pembinaan) <= '$end'
			$where_agent_multi				
			"
			);
			$filter_agent = array("opt_level" => 8, "tl !=" => "-");
			$data['list_agent_d'] = $this->sys_user->get_results($filter_agent);

			$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

			$this->template->load('Pembinaan/pembinaan_date', $data);
		}

		public function detail($id)
		{
			$data = array(
				'title_page_big'		=> 'Detail ',
				'title'					=> $this->title,
				'link_back'				=> $this->agent->referrer(),
			);

			$data['data_qc'] = $this->qc->get_row(array("id" => $id));
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
			GROUP BY idx"
			);
			$data['agent'] = $this->sys_user->get_row(array("agentid" => $agentid));
			$data['data'] = $data['query_trans_profiling']->row();
			$data['recording'] = false;
			$data['q_recording'] = $this->cdr->get_row(array("dst" => "61" . $data['data']->handphone));
			if (!$data['q_recording']) {
				$data['q_recording'] = $this->cdr->get_row(array("dst" => "61" . $data['data']->pstn1));
			}
			if ($data['q_recording']) {
				$data['recording'] = $data['q_recording']->recordingfile;
			}
			$data['qc'] = $this->qc->live_query(
				"SELECT * FROM qc WHERE id = $id"
			)->row();
			$this->template->load('Pembinaan/detail_pembinaan', $data);
		}



		public function Pembinaan_list()
		{
			$data = array(
				'title_page_big'		=> 'Pembinaan',
				'title'					=> $this->title,
			);
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

			if ($userdata->opt_level == 8) {
				$data['data_tapping'] = $this->db->query("SELECT
			* 
		FROM
			t_pembinaan 
		WHERE  
		
		agentid = '$userdata->agentid'
		AND
		DATE( tanggal_pembinaan ) BETWEEN '$start_filter' AND '$end_filter' ")->result();
			} else {
				$data['data_tapping'] = $this->db->query("SELECT
			* 
		FROM
			t_pembinaan 
		WHERE  
		
		DATE( tanggal_pembinaan ) BETWEEN '$start_filter' AND '$end_filter' ")->result();
			}

			$data['start'] = $_GET['start'];
			$data['end'] = $_GET['end'];

			$data['controller'] = $this;
			$data['opt_level'] = $userdata->opt_level;
			$data['userdata'] = $userdata->agentid;
			$this->load->view('Pembinaan/Pembinaan_list', $data);
		}

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
			$data['q_recording'] = $this->cdr->get_row(array("dst" => "61" . $data['data']->handphone));
			if (!$data['q_recording']) {
				$data['q_recording'] = $this->cdr->get_row(array("dst" => "61" . $data['data']->pstn1));
			}
			if ($data['q_recording']) {
				$data['recording'] = $data['q_recording']->recordingfile;
			}
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
			$data['q_recording'] = $this->cdr->get_row(array("dst" => "61" . $data['data']->handphone));
			if (!$data['q_recording']) {
				$data['q_recording'] = $this->cdr->get_row(array("dst" => "61" . $data['data']->pstn1));
			}
			if ($data['q_recording']) {
				$data['recording'] = $data['q_recording']->recordingfile;
			}

			$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
			$this->load->model('sys/Sys_user_log_model', 'log_login');
			$idlogin = $this->session->userdata('idlogin');
			$data['loginid'] = $this->log_login->get_by_id($idlogin);

			$this->template->load('qc/form_qc', $data);
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
			$val['tanggal'] = date('Y-m-d H:i:s');
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


				$data['data_qc'] = $this->qc->get_results(array('DATE(lup) >=' => $start_filter, 'DATE(lup) <=' => $end_filter));
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
	};
