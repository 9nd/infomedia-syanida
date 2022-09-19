<?php
require APPPATH . '/controllers/T_fraud_alert_check/T_fraud_alert_check_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class T_fraud_alert_check extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('T_fraud_alert_check/T_fraud_alert_check_model', 'tmodel');
		$this->log_key = 'log_T_fraud_alert_check';
		$this->title = new T_fraud_alert_check_config();
	}


	public function index()
	{
		$data = array(
			'title_page_big'		=> 'Daftar Fraud Check',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'T_fraud_alert_check/T_fraud_alert_check/refresh_table/' . $this->_token,
			'link_update'			=> site_url() . 'T_fraud_alert_check/T_fraud_alert_check/update',
			'link_delete'			=> site_url() . 'T_fraud_alert_check/T_fraud_alert_check/delete_multiple',
		);
		$data['start'] = date('Y-m-d');
		$data['end'] = date('Y-m-d');
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$data['start'] = $_GET['start'];
			$data['end'] = $_GET['end'];
		}

		$this->template->load('T_fraud_alert_check/T_fraud_alert_check_list', $data);
		// var_dump($data);
	}

	public function refresh_table($token)
	{
		if ($token == $this->_token) {
			$row = $this->tmodel->json();

			//encode id 
			$tm = time();
			$this->session->set_userdata($this->log_key, $tm);
			$x = 0;
			foreach ($row['data'] as $val) {
				$idgenerate = _encode_id($val['id'], $tm);
				$row['data'][$x]['id'] = $idgenerate;
				$x++;
			}

			$o = new Outputview();
			$o->success	= 'true';
			$o->serverside	= 'true';
			$o->message	= $row;

			echo $o->result();
		} else {
			redirect('Auth');
		}
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
		if (!$o->not_empty($val['no_handphone'], '#no_handphone')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('no_handphone' => $val['no_handphone']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#no_handphone')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['tanggal_check'], '#tanggal_check')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('tanggal_check' => $val['tanggal_check']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#tanggal_check')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['update_by'], '#update_by')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('update_by' => $val['update_by']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#update_by')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['reason'], '#reason')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('reason' => $val['reason']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#reason')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['status_approve'], '#status_approve')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('status_approve' => $val['status_approve']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#status_approve')) {
			echo $o->result();
			return;
		}

		unset($val['id']);
		$success = $this->tmodel->insert($val);
		echo $o->auto_result($success);
	}

	public function get_data_list()
	{
		$view = 'T_fraud_alert_check/data';

		if (isset($_GET['start'])) {

			$data['start'] = $_GET['start'];
			$data['end'] = $_GET['end'];
		} else {
			$data['start'] = date('Y-m-d');
			$data['end'] = date('Y-m-d');
		}
		$start = $data['start'];
		$end = $data['end'];



		$response['rec'] = $this->db->query("SELECT * FROM t_fraud_alert_check WHERE tanggal_check BETWEEN '$start' AND '$end'");
		$response['start'] = $data['start'];
		$response['end'] = $data['end'];
		$response['controller'] = $this;
		$this->load->view($view, $response);
	}


	public function update($id)
	{
		$id 				= $this->security->xss_clean($id);
		$id_generate		= $id;

		/** proses decode id 
		 * important !! tempdata digunakan sbagai antisipasi
		 * perubahan session saat membuka tab baru secara bersamaan
		 **/
		$this->log_temp	= $this->session->userdata($this->log_key);
		$this->session->set_tempdata($id, $this->log_temp, 300);

		//mengembalikan id asli
		$id = _decode_id($id, $this->log_temp);

		$row = $this->tmodel->get_by_id($id);

		if ($row) {
			$data = array(
				'title_page_big'		=> 'Buat Baru',
				'title'					=> $this->title,
				'link_save'				=> site_url() . 'T_fraud_alert_check/T_fraud_alert_check/update_action',
				'link_back'				=> $this->agent->referrer(),
				'data'					=> $row,
				'id'					=> $id_generate,
			);

			$this->template->load('T_fraud_alert_check/T_fraud_alert_check_form', $data);
		} else {
			redirect($this->agent->referrer());
		}
	}

	public function update_action()
	{
		$data 	= $this->input->post('data_ajax', true);
		$val	= json_decode($data, true);
		$this->log_temp		= $this->session->tempdata($val['id']);
		$val['id']				= _decode_id($val['id'], $this->log_temp);

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
		if (!$o->not_empty($val['no_handphone'], '#no_handphone')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('no_handphone' => $val['no_handphone']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#no_handphone')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['tanggal_check'], '#tanggal_check')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('tanggal_check' => $val['tanggal_check']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#tanggal_check')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['update_by'], '#update_by')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('update_by' => $val['update_by']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#update_by')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['reason'], '#reason')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('reason' => $val['reason']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#reason')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['status_approve'], '#status_approve')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('status_approve' => $val['status_approve']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#status_approve')) {
			echo $o->result();
			return;
		}


		$success = $this->tmodel->update($val['id'], $val);
		echo $o->auto_result($success);
	}

	public function delete_multiple($idx)
	{

		$data = $idx;
		// echo var_dump($data);
		$success = $this->tmodel->delete_multiple($data);

		$o = new Outputview();

		// //create message
		if ($success) {
			$o->success 	= 'true';
			$o->message	= 'Data berhasil di hapus !';
			redirect(site_url() . "T_fraud_alert_check/T_fraud_alert_check/");
		} else {
			$o->success 	= 'false';
			$o->message	= 'Opps..Gagal menghapus data !!';
			redirect(site_url() . "T_fraud_alert_check//");
		}


		echo $o->result();
	}
};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-09-28 13:49:17 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
