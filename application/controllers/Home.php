<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form_General
 *
 * @author Dhiya
 */
class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('News/News_model', 'News_model');
		$this->load->model('News/Read_model', 'Read_model');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		
	}

	public function index()
	{
		// meload dashboard jika tidak ada redirect lain
		$this->load->model('sys/Sys_dashboard_model', 'dashboard');
		$this->load->model('Absensi/Absensi_model', 'absensi');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

		$absen=$this->absensi->get_count(array("nik"=>$data['userdata']->nik_absensi,"DATE(waktu_in)"=>date('Y-m-d')));
		// echo $data['userdata']->nik_absensi;
		$data['input_absen']=true;
		if($absen > 0){
			$data['input_absen']=false;
		}
		$dashboard = $this->dashboard->get_form($this->_user_id);

		if ($dashboard !== false) {
			redirect($dashboard->link);
		} else {
			//untuk mengganti default halaman home
			//buat statement or hapus code di bawah

			$view = 'sistem/Home';
			$data['title_page_big']	 	= 	'';
			$idlogin = $this->session->userdata('idlogin');
    		$logindata = $this->log_login->get_by_id($idlogin);
			$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
			$data['controller'] = $this;
			$this->load->model('Custom_model/Sys_user_log_in_out_table_model', 'Sys_log');
			if($data['userdata']->opt_level == 8){
				$log_where = array(
					'id_user'=>$logindata->id_user,
					'agentid'=> $data['userdata']->agentid,
				);
				$log=$this->Sys_log->get_row($log_where,array("id,logout_time"),array("id"=>"DESC"));
				if($log){
					if($log->logout_time == ''){
						redirect('Lockscreen', 'refresh');
					}
				}
			}

			//tambahan untuk news
			$where = array(
				'status_publish' => 'Publish',
				'join' => array(
					'sys_user' => 't_news.id_sender = sys_user.id'
				)			
				
			);

			$fields = array(
				't_news.*, sys_user.nama, sys_user.nmuser, sys_user.id as userid'
			);

			$whereread = array(
				'join' => array(
					'sys_user' => 't_baca_news.id_user = sys_user.id',
					't_news' => 't_baca_news.id_news = t_news.id'

				)
			);		
			
			if ($data['userdata']) {
				$this->infomedia = $this->load->database('infomedia', TRUE);
				$agentid = $data['userdata']->agentid;
				$data['wo'] = $this->infomedia->query("SELECT count(*) as wo FROM v2_trans_profiling WHERE veri_upd = '$agentid' AND DATE( lup ) = CURDATE()")->row()->wo;
				$data['success'] = $this->infomedia->query("SELECT count(*) as success FROM v2_trans_profiling WHERE veri_upd = '$agentid' AND sub_call = 13 AND DATE( lup ) = CURDATE()")->row()->success;
				$data['con'] = $this->infomedia->query("SELECT count(*) as con FROM v2_trans_profiling WHERE veri_upd = '$agentid' AND (sub_call in(1,3,11,12,13)) AND DATE( lup ) = CURDATE()")->row()->con;
				$data['notcon'] = $this->infomedia->query("SELECT count(*) as notcon FROM v2_trans_profiling WHERE veri_upd = '$agentid' AND (sub_call in (2, 4, 5, 6, 7, 8, 9, 10, 14, 15, 16, 111, 112, 113)) AND DATE( lup ) = CURDATE()")->row()->notcon;
			}
			
			$data['berita']=$this->News_model->get_results($where, $fields);
			$data['read']=$this->Read_model->get_results($whereread);
			
			$this->template->load($view, $data);

			

			//-------------------------------------//


			//kemudian ganti dengan perintah di bawah

			//redirect(....);

			//-----------------------------------//
		}
		// redirect(base_url()."dashboard/dashboard");
	}
	public function get_data_by_status($status_call = "call_order")
	{
		$this->load->model('Custom_model/Trans_profiling_today_model', 'trans_profiling');
		$tampil = 0;
		switch ($status_call) {
			case "call_order":
				$where_reguler_order_call_reg = array(
					// " DATE_FORMAT(trans_profiling.lup, '%Y-%m-%d') = " => date('Y-m-d'),
					// 'join' => array('sys_user' => 'sys_user.agentid = trans_profiling.veri_upd'),
					// 'or_where_null' => array("(sys_user.kategori='USER ID REGULER' or sys_user.kategori='USER ID MOSS')")
				);
				$tampil = $this->trans_profiling->get_count(
					$where_reguler_order_call_reg,
					array(),
					false,
					"id"
				);
				break;
			case "not_contacted":
				$where_reguler_order_call_reg = array(
					// " DATE_FORMAT(lup, '%Y-%m-%d') = " => date('Y-m-d'),
					// 'join' => array('sys_user' => 'sys_user.agentid = trans_profiling.veri_upd'),
					'or_where_null' => array(
						// "(sys_user.kategori='USER ID REGULER' or sys_user.kategori='USER ID MOSS')",
						"(
							veri_call = 4 
							or veri_call = 7 
							or veri_call = 11 
							or veri_call = 10 
							or veri_call = 14
							)"
					)
				);
				$tampil = $this->trans_profiling->get_count(
					$where_reguler_order_call_reg,
					array(),
					false,
					"id"
				);
				break;
			case "contacted":
				$where_reguler_order_call_reg = array(
					// " DATE_FORMAT(trans_profiling.lup, '%Y-%m-%d') = " => date('Y-m-d'),
					// 'join' => array('sys_user' => 'sys_user.agentid = trans_profiling.veri_upd'),
					'or_where_null' => array(
						// "(sys_user.kategori='USER ID REGULER' or sys_user.kategori='USER ID MOSS')",
						"(
							veri_call = 1 
							or veri_call = 13 
							or veri_call = 3 
							or veri_call = 12 
							or veri_call = 2
							)"
					)
				);
				$tampil = $this->trans_profiling->get_count(
					$where_reguler_order_call_reg,
					array(),
					false,
					"id"
				);
				break;
			case "verified":
				$where_reguler_order_call_reg = array(
					// " DATE_FORMAT(trans_profiling.lup, '%Y-%m-%d') = " => date('Y-m-d'),
					// 'join' => array('sys_user' => 'sys_user.agentid = trans_profiling.veri_upd'),
					'or_where_null' => array(
						// "(sys_user.kategori='USER ID REGULER' or sys_user.kategori='USER ID MOSS')",
						"(veri_call = 13)"
					)
				);
				$tampil = $this->trans_profiling->get_count(
					$where_reguler_order_call_reg,
					array(),
					false,
					"id"
				);
				break;
			case "bp":
				$where_reguler_order_call_reg = array(
					// " DATE_FORMAT(trans_profiling.lup, '%Y-%m-%d') = " => date('Y-m-d'),
					// 'join' => array('sys_user' => 'sys_user.agentid = trans_profiling.veri_upd'),
					'or_where_null' => array(
						// "(sys_user.kategori='USER ID REGULER' or sys_user.kategori='USER ID MOSS')",
						"(veri_call = 1)"
					)
				);
				$tampil = $this->trans_profiling->get_count(
					$where_reguler_order_call_reg,
					array(),
					false,
					"id"
				);
				break;
			case "tbp":
				$where_reguler_order_call_reg = array(
					// " DATE_FORMAT(trans_profiling.lup, '%Y-%m-%d') = " => date('Y-m-d'),
					// 'join' => array('sys_user' => 'sys_user.agentid = trans_profiling.veri_upd'),
					'or_where_null' => array(
						// "(sys_user.kategori='USER ID REGULER' or sys_user.kategori='USER ID MOSS')",
						"(veri_call = 3)"
					)
				);
				$tampil = $this->trans_profiling->get_count(
					$where_reguler_order_call_reg,
					array(),
					false,
					"id"
				);
				break;
			case "fu":
				$where_reguler_order_call_reg = array(
					// " DATE_FORMAT(trans_profiling.lup, '%Y-%m-%d') = " => date('Y-m-d'),
					// 'join' => array('sys_user' => 'sys_user.agentid = trans_profiling.veri_upd'),
					'or_where_null' => array(
						// "(sys_user.kategori='USER ID REGULER' or sys_user.kategori='USER ID MOSS')",
						"(veri_call = 12)"
					)
				);
				$tampil = $this->trans_profiling->get_count(
					$where_reguler_order_call_reg,
					array(),
					false,
					"id"
				);
				break;
			case "rna":
				$where_reguler_order_call_reg = array(
					// " DATE_FORMAT(trans_profiling.lup, '%Y-%m-%d') = " => date('Y-m-d'),
					// 'join' => array('sys_user' => 'sys_user.agentid = trans_profiling.veri_upd'),
					'or_where_null' => array(
						// "(sys_user.kategori='USER ID REGULER' or sys_user.kategori='USER ID MOSS')",
						"(veri_call = 2)"
					)
				);
				$tampil = $this->trans_profiling->get_count(
					$where_reguler_order_call_reg,
					array(),
					false,
					"id"
				);
				break;
			case "decline":
				$where_reguler_order_call_reg = array(
					// " DATE_FORMAT(trans_profiling.lup, '%Y-%m-%d') = " => date('Y-m-d'),
					// 'join' => array('sys_user' => 'sys_user.agentid = trans_profiling.veri_upd'),
					'or_where_null' => array(
						// "(sys_user.kategori='USER ID REGULER' or sys_user.kategori='USER ID MOSS')",
						"(veri_call = 11)"
					)
				);
				$tampil = $this->trans_profiling->get_count(
					$where_reguler_order_call_reg,
					array(),
					false,
					"id"
				);
				break;
			case "mailbox":
				$where_reguler_order_call_reg = array(
					// " DATE_FORMAT(trans_profiling.lup, '%Y-%m-%d') = " => date('Y-m-d'),
					// 'join' => array('sys_user' => 'sys_user.agentid = trans_profiling.veri_upd'),
					'or_where_null' => array(
						// "(sys_user.kategori='USER ID REGULER' or sys_user.kategori='USER ID MOSS')",
						"(tveri_call = 8)"
					)
				);
				$tampil = $this->trans_profiling->get_count(
					$where_reguler_order_call_reg,
					array(),
					false,
					"id"
				);
				break;
			case "rbs":
				$where_reguler_order_call_reg = array(
					// " DATE_FORMAT(trans_profiling.lup, '%Y-%m-%d') = " => date('Y-m-d'),
					// 'join' => array('sys_user' => 'sys_user.agentid = trans_profiling.veri_upd'),
					'or_where_null' => array(
						// "(sys_user.kategori='USER ID REGULER' or sys_user.kategori='USER ID MOSS')",
						"(veri_call = 14)"
					)
				);
				$tampil = $this->trans_profiling->get_count(
					$where_reguler_order_call_reg,
					array(),
					false,
					"id"
				);
				break;
			case "reject":
				$where_reguler_order_call_reg = array(
					// " DATE_FORMAT(trans_profiling.lup, '%Y-%m-%d') = " => date('Y-m-d'),
					// 'join' => array('sys_user' => 'sys_user.agentid = trans_profiling.veri_upd'),
					'or_where_null' => array(
						// "(sys_user.kategori='USER ID REGULER' or sys_user.kategori='USER ID MOSS')",
						"(veri_call = 10)"
					)
				);
				$tampil = $this->trans_profiling->get_count(
					$where_reguler_order_call_reg,
					array(),
					false,
					"id"
				);
				break;
		}
		echo $tampil;
	}
	public function get_all_by_status()
	{
		$this->load->model('Custom_model/Trans_profiling_today_model', 'trans_profiling');

		$data['trans_profiling'] = $this->trans_profiling->get_results_array(
			array("veri_call")
		);
		$data['veri_call'] = array_count_values($data['trans_profiling']['results']);

		$this->load->view('Custom_view/dashboard');
	}
	public function get_num_by_status()
	{
		$this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling');
		$today = date('Y-m-d');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$filter_agent = "";
		if ($userdata->opt_level == 8) {
			$filter_agent = " AND veri_upd='" . $userdata->agentid . "'";
		}
		$query_trans_profiling = $this->trans_profiling->live_query(
			"SELECT veri_call,veri_upd,handphone,email FROM trans_profiling 
			WHERE DATE_FORMAT(trans_profiling.lup ,'%Y-%m-%d') = '$today' 
			$filter_agent
			"
		);

		$data_agent = $query_trans_profiling->result_array();
		$status_1 = count($this->filter_by_value($data_agent, 'veri_call', '1'));
		$verified = $this->filter_by_value($data_agent, 'veri_call', '13');
		// $status_13=count($controller->filter_by_value($data_agent, 'veri_call', '13'));
		$status_3 = count($this->filter_by_value($data_agent, 'veri_call', '3'));
		$status_12 = count($this->filter_by_value($data_agent, 'veri_call', '12'));
		$status_2 = count($this->filter_by_value($data_agent, 'veri_call', '2'));
		$status_4 = count($this->filter_by_value($data_agent, 'veri_call', '4'));
		$status_7 = count($this->filter_by_value($data_agent, 'veri_call', '7'));
		$status_11 = count($this->filter_by_value($data_agent, 'veri_call', '11'));
		$status_10 = count($this->filter_by_value($data_agent, 'veri_call', '10'));
		$status_14 = count($this->filter_by_value($data_agent, 'veri_call', '14'));
		$status_8 = count($this->filter_by_value($data_agent, 'veri_call', '8'));
		$sub_total_contacted = $status_1 + count($verified) + $status_3 + $status_12;
		$sub_total_uncontacted = $status_4 + $status_7 + $status_11 + $status_10 + $status_14 + $status_2;

		$call_order = count($data_agent);
		$not_contacted = $sub_total_uncontacted;
		$contacted = $sub_total_contacted;
		$verified = count($verified);

		$return_arr = array(
			'call_order' => number_format($call_order),
			'not_contacted' => number_format($not_contacted),
			'contacted' => number_format($contacted),
			'verified' => number_format($verified),
			'status_1' => number_format($status_1),
			'status_3' => number_format($status_3),
			'status_12' => number_format($status_12),
			'status_2' => number_format($status_2),
			'status_11' => number_format($status_11),
			'status_8' => number_format($status_8),
			'status_14' => number_format($status_14),
			'status_10' => number_format($status_10),
			'date' => date("Y-m-d H:i:s"),
		);
		echo json_encode($return_arr);
	}
	public function get_curl_callorder()
	{
		$json = file_get_contents('http://10.194.194.61/dashboard/data/get_data_callorder.php');
		echo $json;
	}
	public function get_curl_notcontacted()
	{
		$json = file_get_contents('http://10.194.194.61/dashboard/data/get_data_sum_notcontacted.php');
		echo $json;
	}
	public function get_curl_contacted()
	{
		$json = file_get_contents('http://10.194.194.61/dashboard/data/get_data_contacted.php');
		echo $json;
	}
	public function get_curl_datanotcontacted()
	{
		$json = file_get_contents('http://10.194.194.61/dashboard/data/get_data_notcontacted.php');
		echo $json;
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
}
