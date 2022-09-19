<?php
require APPPATH . '/controllers/Histori_call/Histori_call_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Histori_call extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Indibox/Indibox_model', 'tmodel');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('Custom_model/Status_call_model', 'Status_call');
		$this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'verifikasi');
		$this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Trans_profiling_last_month_infomedia_model', 'trans_profiling_last_month');
    
		$this->log_key = 'log_Indibox';
		$this->title = new Histori_call_config();
	}


	public function index()
	{
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);

		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$agent_id = false;
		if ($userdata->opt_level == 8) {
			$agent_id = $userdata->agentid;
		}

		$data = array(
			'title_page_big'		=> 'Call History',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'Histori_call/Histori_call/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'Histori_call/Histori_call/create',
			'link_update'			=> site_url() . 'Histori_call/Histori_call/update',
			'link_delete'			=> site_url() . 'Histori_call/Histori_call/delete_multiple',
		);
		$data['controller'] = $this;
		$tgl = $this->input->get('tgl');
		if (!isset($tgl)) {
			$tgl = date('Y-m-d');
		}
		$agid = $this->input->get('agentid');
		if (isset($agid)) {
			$agent_id = $agid;
		}
		// $tgl='2020-07-07';
		$filter_agent = array("opt_level" => 8, "tl !=" => "-");
		$data['user_categori'] = $userdata->opt_level;
		$data['list_agent'] = $this->sys_user->get_results($filter_agent);
		if ($agent_id) {
			$data['list'] = $this->tmodel->live_query('
		SELECT * FROM trans_profiling WHERE lup >= DATE_SUB(now(), INTERVAL 6 MONTH) AND DATE(lup)="' . $tgl . '" AND veri_upd="' . $agent_id . '"
		AND (veri_call=2 OR veri_call=1 OR veri_call=3 OR veri_call=11) 
		')->result_array();
		}


		$this->template->load('Histori_call/Histori_call_list', $data);
	}

	public function detail($id)
	{
		$detail = $this->tmodel->live_query('
		SELECT * FROM trans_profiling WHERE idx="' . $id . '" 
		')->row();
		$num = $this->verifikasi->get_count(array("ncli" => $detail->ncli));
		if ($num > 0) {
			echo "data sudah diverifikasi";
		} else {
			redirect('http://10.194.194.61/profilling/app/form_outbound.php?phone=' . $detail->pstn1 . '&ncli=' . $detail->ncli);
		}
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

	public function create()
	{
		$data = array(
			'title_page_big'		=> 'Buat Baru',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'Indibox/Indibox/create_action',
			'link_back'				=> $this->agent->referrer(),
		);
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

		$this->template->load('Indibox/Indibox_form', $data);
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
		if (!$o->not_empty($val['ncli'], '#ncli')) {
			echo $o->result();
			return;
		}
		if (!$o->not_empty($val['no_pstn'], '#no_pstn')) {
			echo $o->result();
			return;
		}
		if (!$o->not_empty($val['no_speedy'], '#no_speedy')) {
			echo $o->result();
			return;
		}
		if (!$o->not_empty($val['nama_pelanggan'], '#nama_pelanggan')) {
			echo $o->result();
			return;
		}
		if (!$o->not_empty($val['relasi'], '#relasi')) {
			echo $o->result();
			return;
		}
		if (!$o->not_empty($val['email'], '#email')) {
			echo $o->result();
			return;
		}
		if (!$o->not_empty($val['no_handpone'], '#no_handpone')) {
			echo $o->result();
			return;
		}



		// if ($query == 0) {
		unset($val['id']);
		$success = $this->tmodel->insert($val);
		echo $o->auto_result($success);
		// } else {
		// 	echo "gagal";
		// }
	}

	public function update($idx)
	{

		// $id 				= $this->security->xss_clean($id);
		// $id_generate		= $id;

		// /** proses decode id 
		// * important !! tempdata digunakan sbagai antisipasi
		// * perubahan session saat membuka tab baru secara bersamaan
		// **/
		// $this->log_temp	= $this->session->userdata($this->log_key);
		// $this->session->set_tempdata($id,$this->log_temp,300);

		// //mengembalikan id asli
		// $id = _decode_id($id,$this->log_temp);

		$row = $this->tmodel->get_by_id($idx);

		if ($row) {
			$data = array(
				'title_page_big'		=> 'Buat Baru',
				'title'					=> $this->title,
				'link_save'				=> site_url() . 'Indibox/Indibox/update_action',
				'link_back'				=> $this->agent->referrer(),
				'data'					=> $row,
			);

			$this->template->load('Indibox/Indibox_form', $data);
		} else {
			// redirect($this->agent->referrer());
			echo "else";
		}
	}

	public function update_action()
	{
		$data 	= $this->input->post('data_ajax', true);
		$val	= json_decode($data, true);
		$this->log_temp		= $this->session->tempdata($val['idx']);
		$val['idx']				= _decode_id($val['idx'], $this->log_temp);

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

		// //mencegah data kosong
		// if(!$o->not_empty($val['idx'],'#idx')){
		// 	echo $o->result();	
		// 	return;
		// }

		// //mencegah data double
		// $field=array('idx'=>$val['idx']);
		// $exist = $this->tmodel->if_exist($val['idx'],$field);
		// if(!$o->not_exist($exist,'#idx')){
		// 	echo $o->result();	
		// 	return;
		// }


		$success = $this->tmodel->update($val['idx'], $val);
		echo $o->auto_result($success);
	}

	// public function delete_multiple()
	// {
	// 	$data = $this->input->get('data_ajax', true);
	// 	$val = json_decode($data, true);
	// 	$data = explode(',', $val['data_delete']);

	// 	//get key generate
	// 	$log_id = $this->session->userdata($this->log_key);
	// 	$xx = 0;
	// 	foreach ($data as $value) {
	// 		$value =  _decode_id($value, $log_id);
	// 		//menganti ke id asli
	// 		$data[$xx] = $value;
	// 		$xx++;
	// 	}

	// 	$success = $this->tmodel->delete_multiple($data);

	// 	$o = new Outputview();

	// 	//create message
	// 	if ($success) {
	// 		$o->success 	= 'true';
	// 		$o->message	= 'Data berhasil di hapus !';
	// 	} else {
	// 		$o->success 	= 'false';
	// 		$o->message	= 'Opps..Gagal menghapus data !!';
	// 	}


	// 	echo $o->result();
	// }

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
			redirect(site_url() . "Indibox/Indibox/");
		} else {
			$o->success 	= 'false';
			$o->message	= 'Opps..Gagal menghapus data !!';
			redirect(site_url() . "Indibox//");
		}


		echo $o->result();
	}
};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-06-02 15:25:04 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
