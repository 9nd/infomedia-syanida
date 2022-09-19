<?php
require APPPATH . '/controllers/Distribution/Distribution_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Distribution extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Custom_model/Dapros_infomedia_model', 'distribution');
		// $this->load->model('Custom_model/Dapros_model', 'distribution');
		$this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
		$this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling_verifikasi');

		$this->log_key = 'log_Distributon';
		$this->title = new Distribution_config();
	}


	public function index()
	{
		$data = array(
			'title_page_big'		=> 'FILTER DAPROS',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'Distribution/Distribution/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'Distribution/Distribution/create',
			'link_update'			=> site_url() . 'Distribution/Distribution/update',
			'link_delete'			=> site_url() . 'Distribution/Distribution/delete_multiple',
			'link_filter'				=> site_url() . 'Distribution/Distribution/get_data',
			'link_duplicate'				=> site_url() . 'Distribution/Distribution/check_duplicate',
			'link_close'				=> site_url() . 'Distribution/Distribution',
			'link_back'				=> site_url() . 'Distribution/Distribution',
		);
		$data['sumbernya'] = $_POST['sumber'];


		$this->template->load('Distribution/Distribution_filter_form', $data);
	}
	public function get_data()
	{
		$post = $this->input->post();
		$data = array(
			'title_page_big'		=> 'CHECK DAPROS',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'Distribution/Distribution/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'Distribution/Distribution/create',
			'link_update'			=> site_url() . 'Distribution/Distribution/update',
			'link_delete'			=> site_url() . 'Distribution/Distribution/delete_multiple',
			'link_filter'				=> site_url() . 'Distribution/Distribution/get_data',
			'link_submit'				=> site_url() . 'Distribution/Distribution/proses_data',
			'link_back'				=> site_url() . 'Distribution/Distribution',
		);
		$filter_agent = array("opt_level" => 8, "kategori" => "REG", "tl !=" => "-");
		$data['list_agent_d'] = $this->sys_user->get_results($filter_agent);
		$data['sumbernya'] = $post['sumber'];
		if ($post) {
			$filter = array();
			$filter["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '' )"] = null;
			$filter["(ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '' )"] = null;
			$filter['status'] = 0;
			$filter['status2'] = 0;
			$filter['status3'] = 0;
			if ($post['sumber'] != "semua") {
				$filter['sumber'] = $post['sumber'];
			}

			if ($post['length_ncli'] > 0) {
				$filter['LENGTH(ncli)'] = $post['length_ncli'];
			}
			// if ($post['no_handpone'] != "semua") {
			// 	$filter["no_handpone LIKE '08%' "] = NULL;
			// }
			if ($post['no_handpone'] != "semua" && $post['no_handpone'] != "IS NULL") {
				$filter_no_hp = $post['no_handpone_filter'];
				$filter_param = $post['no_handpone'];
				$filter["no_handpone $filter_param '$filter_no_hp' "] = NULL;
			}
			if ($post['no_handpone'] == "IS NULL") {
				// $filter_no_hp="";
				$filter_param = $post['no_handpone'];
				$filter["no_handpone IS NULL"] = NULL;
			}
			if ($post['ncli'] > 0) {
				$filter["ncli " . $post['operator_ncli'] . " '" . $post['ncli'] . "' "] = NULL;
			}
			if ($post['no_pstn'] > 0) {
				$filter["no_pstn " . $post['operator_no_pstn'] . " '" . $post['no_pstn'] . "' "] = NULL;
			}
			if ($post['no_speedy'] > 0) {
				$filter["no_speedy " . $post['operator_no_speedy'] . " '" . $post['no_speedy'] . "' "] = NULL;
			}
			$data['jumlah_data'] = $this->distribution->get_count($filter);
			$data['filter'] = $post;
			$this->template->load('Distribution/Distribution_list', $data);
		} else {
			$this->template->load('Distribution/Distribution_filter_form', $data);
		}
	}
	function proses_data()
	{
		$post = $this->input->post();
		$filter_agent = array("opt_level" => 8, "kategori" => "REG",  "tl !=" => "-");
		$dc = false;
		if (count($post['agentid']) > 1) {
			$n_agent_pick = count($post['agentid']);
			foreach ($post['agentid'] as $k_agentid => $v_agentid) {
				if ($v_agentid == "DC") {
					$dc = true;
				}
				if ($k_agentid == 0) {
					$where_agent_multi = "( agentid = '$v_agentid'";
				} else {
					if ($k_agentid == ($n_agent_pick - 1)) {
						$where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' )";
					} else {
						$where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' ";
					}
				}
			}
			$filter_agent['or_where_null'] = array($where_agent_multi);
		} else {

			if ($post['agentid'][0] != '0') {
				// echo $agentid[0];
				$filter_agent['agentid'] = $post['agentid'][0];
				if ($post['agentid'][0] == "DC") {
					$dc = true;
				}
			}
		}
		$list_agent_d = $this->sys_user->get_results($filter_agent, array("*"), array(), array("id" => "RANDOM"));

		if ($post) {
			$filter = array();
			$filter["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '' )"] = null;
			$filter["(ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '' )"] = null;
			$filter['status'] = 0;
			$filter['status2'] = 0;
			$filter['status3'] = 0;
			if ($post['sumber'] != "semua") {
				$filter['sumber'] = $post['sumber'];
			}

			if ($post['length_ncli'] > 0) {
				$filter['LENGTH(ncli)'] = $post['length_ncli'];
			}
			// if ($post['no_handpone'] != "semua") {
			// 	$filter["no_handpone LIKE '08%' "] = NULL;
			// }
			if ($post['no_handpone'] != "semua" && $post['no_handpone'] != "IS NULL") {
				$filter_no_hp = $post['no_handpone_filter'];
				$filter_param = $post['no_handpone'];
				$filter["no_handpone $filter_param '$filter_no_hp' "] = NULL;
			}
			if ($post['no_handpone'] == "IS NULL") {
				// $filter_no_hp="";
				$filter_param = $post['no_handpone'];
				$filter["no_handpone IS NULL "] = NULL;
			}

			if ($post['ncli'] > 0) {
				$filter["ncli " . $post['operator_ncli'] . " '" . $post['ncli'] . "' "] = NULL;
			}
			if ($post['no_pstn'] > 0) {
				$filter["no_pstn " . $post['operator_no_pstn'] . " '" . $post['no_pstn'] . "' "] = NULL;
			}
			if ($post['no_speedy'] > 0) {
				$filter["no_speedy " . $post['operator_no_speedy'] . " '" . $post['no_speedy'] . "' "] = NULL;
			}
			// if ($post['agentid'] == "0") {
			$n = 0;
			if ($filter_agent['agentid']) {
			}
			if ($list_agent_d['num'] > 0) {
				foreach ($list_agent_d['results'] as $list_agent) {
					$n++;
					$data_insert = array(
						"update_by" => $list_agent->agentid
					);
					if (isset($post['limit'])) {
						if ($post['limit'] > 0) {
							$this->distribution->edit($filter, $data_insert, $post['limit']);
						}
					}
				}
			}
			if ($dc == true) {
				$data_insert = array(
					"update_by" => 'DC'
				);
				$this->distribution->edit($filter, $data_insert, $post['limit']);
			}
			// } else {
			// 	$data_insert = array(
			// 		"update_by" => $post['agentid']
			// 	);
			// 	if (isset($post['limit'])) {
			// 		if ($post['limit'] > 0) {
			// 			$this->distribution->edit($filter, $data_insert, $post['limit']);
			// 		}
			// 	}
			// }
			redirect(site_url() . 'Distribution/Distribution?success=1&dibagi=' . $post['dibagi']);
		}
	}
	function check_duplicate()
	{
		$data = array(
			'title_page_big'		=> 'DUPLICATE DAPROS',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'Distribution/Distribution/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'Distribution/Distribution/create',
			'link_update'			=> site_url() . 'Distribution/Distribution/update_duplicate',
			'link_delete'			=> site_url() . 'Distribution/Distribution/delete_multiple',
			'link_filter'				=> site_url() . 'Distribution/Distribution/check_duplicate',
			'link_close'				=> site_url() . 'Distribution/Distribution',
			'link_back'				=> site_url() . 'Distribution/Distribution/check_duplicate',
		);
		$post = $this->input->post();

		if (!$post) {
			$filter = array();
			$filter[" (ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '') "] = null;
			$filter[" (ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '') "] = null;
			$filter['status'] = 0;
			// $filter['status2'] = 0;
			// $filter['status3'] = 0;

			// $data['data']['num'] = $this->distribution->get_count($filter,array(),'ncli,IF(no_pstn ="" OR ISNULL(no_pstn), no_speedy, no_pstn) ',array('ncli,no_pstn,no_speedy,count(*) as jumlah_ncli'),array("jumlah_ncli >"=>1));


			$this->template->load('Distribution/Distribution_check_duplicate_form', $data);
		} else {
			$filter = array();
			$filter[" (ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '') "] = null;
			$filter[" (ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '') "] = null;
			$filter['status'] = 0;
			// $filter['status2'] = 0;
			// $filter['status3'] = 0;
			$limit = $post['limit'];
			if ($post['sumber'] != "semua") {
				$filter['sumber'] = $post['sumber'];
				$data['sumber'] = $post['sumber'];
			}
			if ($post['limit'] <= 0) {
				$limit = 10;
			}
			$data['limit'] = $post['limit'];
			$data['data'] = $this->distribution->get_results($filter, array('ncli,no_pstn,no_speedy,count(*) as jumlah_ncli'), array("limit" => $limit, "offset" => 0), array("ncli" => "DESC"), 'ncli,IF(no_pstn ="" OR ISNULL(no_pstn), no_speedy, no_pstn) ', array("jumlah_ncli >" => 1));


			$this->template->load('Distribution/Distribution_duplicate_form', $data);
		}
	}
	function update_duplicate()
	{
		$post = $this->input->post();

		if ($post) {
			$total = 0;

			if ($post['limit']) {
				$filter = array();
				$filter["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '')"] = null;
				$filter["(ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '')"] = null;
				$filter['status'] = 0;
				$filter['status2'] = 0;
				$filter['status3'] = 0;
				$limit = $post['limit'];
				if ($post['sumber'] != "semua") {
					$filter['sumber'] = $post['sumber'];
				}
				$dapros = $this->distribution->get_results($filter, array('ncli,no_pstn,no_speedy,count(*) as jumlah_ncli'), array("limit" => $limit, "offset" => 0), array("ncli" => "DESC"), 'ncli,IF(no_pstn ="" OR ISNULL(no_pstn), no_speedy, no_pstn) ', array("jumlah_ncli >" => 1));

				if ($dapros['num'] > 0) {

					foreach ($dapros['results'] as $val) {

						if ($val->no_pstn == "") {
							$where = array(
								'ncli' => $val->ncli,
								"(no_pstn = '' OR no_pstn = null)" => NULL,
								'no_speedy' => $val->no_speedy,
							);
						} else {
							$where = array(
								'ncli' => $val->ncli,
								'no_pstn' => $val->no_pstn,
							);
						}
						$where["(ISNULL(update_by) OR update_by = 'baru' OR update_by = 'BARU' OR update_by = '')"] = null;
						$where["(ISNULL(duplicate_ncli) OR duplicate_ncli = 0 OR duplicate_ncli = '')"] = null;
						$where['status'] = 0;
						$where['status2'] = 0;
						$where['status3'] = 0;
						$update = $this->distribution->edit($where, array("duplicate_ncli" => 1), ($val->jumlah_ncli - 1), array("no_tgl" => "DESC"));
						if ($update) {
							$total = $total + ($val->jumlah_ncli - 1);
						}
					}
				}
			}
			// echo $total;
			redirect(site_url() . 'Distribution/Distribution/check_duplicate?success=1&diupdate=' . $total);
		} else {
			redirect(site_url() . 'Distribution/Distribution/check_duplicate');
		}
	}
};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-02-08 07:42:27 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
