<?php
require APPPATH . '/controllers/Tvv/Tvv_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Tvv extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Indibox/Indibox_model', 'tmodel');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('Status_call/Status_call_model', 'Status_call_model');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/On_call_indibox_model', 'On_call_indibox_model');
		$this->load->model('Custom_model/Indibox_forcall_3p_model', 'indibox_forcall_3p');
		$this->load->model('Custom_model/Status_call_model', 'status_call');
		$this->infomedia = $this->load->database('infomedia', TRUE);
		$this->log_key = 'log_tvv';
		$this->title = new Tvv_config();
	}


	public function index()
	{
		$data = array(
			'title_page_big'		=> 'List Tabel Data Tvv',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'Tvv/Tvv/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'Tvv/Tvv/create',
			'link_update'			=> site_url() . 'Tvv/Tvv/update',
			'link_delete'			=> site_url() . 'Tvv/Tvv/delete_multiple',
		);
		$start = date('Y-m-d');
		$end = date('Y-m-d');
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start = $_GET['start'];
			$end = $_GET['end'];
		}

		// $data['indibox'] = $this->tmodel->live_query('SELECT * FROM trans_profiling_validasi_mos WHERE sumber="IndiBox"')->result_array();
		// $data['Status_call_model'] = $this->Status_call_model;
		$this->template->load('Tvv/Tvv_list', $data);
	}

	function get_data_list()
	{

		$data = array(
			'title_page_big'		=> 'List Tabel Data Tvv',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'Tvv/Tvv/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'Tvv/Tvv/create',
			'link_update'			=> site_url() . 'Tvv/Tvv/update',
			'link_delete'			=> site_url() . 'Tvv/Tvv/delete_multiple',
		);

		$data['controller'] = $this;
		$start = date('Y-m-d');
		$end = date('Y-m-d');
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start = $_GET['start'];
			$end = $_GET['end'];


			$idlogin = $this->session->userdata('idlogin');
			$logindata = $this->log_login->get_by_id($idlogin);

			$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

			$data['indibox'] = $this->tmodel->live_query("SELECT * FROM trans_profiling_validasi_mos WHERE sumber='TVV' AND DATE(tgl_insert) BETWEEN '$start' AND '$end' ")->result_array();
			$data['Status_call_model'] = $this->Status_call_model;
		}
		$this->load->view('Tvv/Tvv_area', $data);
	}

	public function detail($id)
	{

		$row = $this->tmodel->get_by_id($id);
		//echo var_dump($row);
		if ($row) {
			$data = array(
				'title_page_big'		=> 'Detail',
				'title'					=> $this->title,
				'link_save'				=> site_url() . 'Tvv/Tvv/update_action',
				'link_back'				=> $this->agent->referrer(),
				'data'					=> $row,
				'id'					=> $id,
			);

			$this->template->load('Tvv/Tvv_detail', $data);
		} else {
			redirect($this->agent->referrer());
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

	public function create($id = false)
	{
		$data = array(
			'title_page_big'		=> 'Buat Baru',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'Tvv/Tvv/create_action',
			'link_back'				=> $this->agent->referrer(),
		);
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$data['id_forcall'] = $id;
		if ($id != false) {
			$oncall_data = array(
				'idx' => $id,
				'agentid' => $data['userdata']->agentid,
				'click_time' => date('Y-m-d H:i:s')
			);

			$this->On_call_indibox_model->add($oncall_data);
			$data['data_indibox'] = $this->indibox_forcall_3p->get_row(array("id" => $id));
			$data['data_ar']['no_pstn'] = $data['data_indibox']->no_pstn;
			$data['data_ar']['no_speedy'] = $data['data_indibox']->no_indihome;
			$data['data_ar']['nama_pelanggan'] = $data['data_indibox']->name;
			$data['data_ar']['no_handpone'] = $data['data_indibox']->phone;
			$data['data_ar']['email'] = $data['data_indibox']->email;
			$data['data_ar']['nama_pastel'] = $data['data_indibox']->nama_pastel;
			$data['data_ar']['alamat'] = $data['data_indibox']->alamat;
			$data['data_ar']['kecepatan'] = $data['data_indibox']->kecepatan;
			$data['data_ar']['tagihan'] = $data['data_indibox']->epayment;
			$data['data_ar']['tahun_pemasangan'] = $data['data_indibox']->tahun_pasang;
			$data['data_ar']['tempat_bayar'] = $data['data_indibox']->lokasi_pembayaran;

			$data['data'] = (object) $data['data_ar'];
		}
		$this->template->load('Tvv/Tvv_form', $data);
	}

	public function create_action()
	{
		$data 	= $this->input->post('data_ajax', true);
		$val	= json_decode($data, true);
		$o		= new Outputview();
		$pc = $_SERVER['REMOTE_ADDR'];
		$random_num = $this->set_session();
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
		if (!$o->not_empty($val['sumber'], '#sumber')) {
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

		if (!$o->not_empty($val['no_handpone'], '#no_handpone')) {
			echo $o->result();
			return;
		}
		/////GOOGLE SHEET PROGRESS///
		// if ($val['id_forcall'] > 0) {
		// 	$this->On_call_indibox_model->delete(array("idx" => $val['id_forcall']));
		// 	$status_call = $this->Status_call_model->get_by_id($val['reason_call']);

		// 	$data_update_forcall = array(
		// 		"ncli" => $val['ncli'],
		// 		"no_indihome" => $val['no_speedy'],
		// 		"no_pstn" => $val['no_pstn'],
		// 		"nama_pastel" => $val['nama_pastel'],
		// 		"alamat" => $val['alamat'],
		// 		"kecepatan" => $val['kecepatan'],
		// 		"epayment" => $val['tagihan'],
		// 		"lokasi_pembayaran" => $val['tempat_bayar'],
		// 		"tahun_pasang" => $val['tahun_pemasangan'],
		// 		"keterangan" => $val['keterangan'],
		// 		"lup" => date('Y-m-d H:i:s'),
		// 		"status_call" => $status_call->nama_reason,
		// 		"veri_status" =>  $val['status'],
		// 		"reason_call" =>  $val['reason_call'],
		// 		"click_time" => $val['click_time'],
		// 		"update_googlesheet" => 0,
		// 	);
		// 	$update_data = $this->indibox_forcall_3p->edit(array("id" => $val['id_forcall']), $data_update_forcall);
		// }
		// 	if ($update_data) {
		// 		$dataori = $this->indibox_forcall_3p->get_row(array("id" => $val['id_forcall']));
		// 		if ($dataori) {
		// 			if ($dataori->row > 0) {
		// 				$update_range = "$dataori->sheet!H$dataori->row:Q$dataori->row";
		// 				$values = [
		// 					[
		// 						$val['no_pstn'],
		// 						$val['no_speedy'],
		// 						$val['nama_pastel'],
		// 						$val['alamat'],
		// 						$status_call->nama_reason,
		// 						$val['kecepatan'],
		// 						$val['tagihan'],
		// 						$val['tempat_bayar'],
		// 						$val['tahun_pemasangan'],
		// 						$val['keterangan']
		// 					]
		// 				];
		// 				// $body = new Google_Service_Sheets_ValueRange([

		// 				// 	'values' => $values

		// 				// ]);

		// 				// $params = [
		// 				// 	'valueInputOption' => 'RAW'
		// 				// ];
		// 				// $update_sheet = $service->spreadsheets_values->update($spreadsheetId, $update_range, $body, $params);
		// 			}
		// 		}
		// 	}
		// }
		/////END GOOGLE SHEET PROGRESS///

		// if ($query == 0) {
		unset($val['id']);
		unset($val['id_forcall']);
		// unset($val['click_time']);
		$success = $this->tmodel->insert($val);
		if ($success) {
			$data = array(
				'ncli'	=>  $val['ncli'],
				'pstn1' =>  $val['no_pstn'],
				'nama'	=>  $val['nama_pelanggan'],
				'no_speedy'	=>  $val['no_speedy'],
				'kepemilikan'	=>  $val['relasi'],
				'facebook'	=>  $val['facebook'],
				'twitter'	=>  $val['twitter'],
				'email'	=>  $val['email'],
				'handphone'	=>  $val['no_handpone'],
				'nama_pastel'	=>  $val['nama_pastel'],
				'alamat'	=>  $val['alamat'],
				'kota'	=>  $val['kota'],
				'kec_speedy'	=>  $val['kec_speedy'],
				'billing'	=>  $val['billing'],
				'payment'	=>  $val['payment'],
				'tgl_lahir'	=>  $val['waktu_psb'],
				'veri_call'	=>  $val['reason_call'],
				'veri_status'	=>  $val['status'],
				'profiling_by'	=>  '100',
				'veri_keterangan'	=>  $val['keterangan'] . "/TVV",
				'handphone_lain'	=>  $val['handphone_lainnya'],
				'click_session'	=>  $random_num,
				'veri_upd'	=>  $val['update_by'],
				'veri_lup'	=>  date('Y-m-d H:i:s'),
				'lup'	=>  date('Y-m-d H:i:s'),
				'ip_address'	=>  $pc,
				'status'	=>  1,
				'veri_count'	=>  1
			);
			$this->infomedia->insert('trans_profiling', $data);
			$insert_id = $this->infomedia->insert_id();
			if ($insert_id != 0) {
				$data = array(
					'pstn1'	=>  $val['no_pstn'],
					'no_speedy' =>  $val['no_speedy'],
					'ncli'	=>  $val['ncli'],
					'nama'	=>  $val['nama_pelanggan'],
					'kepemilikan'	=>  $val['relasi'],
					'facebook'	=>  $val['facebook'],
					'twitter'	=>  $val['twitter'],
					'verfi_email'	=>  $val['otpemail'],
					'email'	=>  $val['email'],
					'handphone'	=>  $val['no_handpone'],
					'email_lain'	=>  $val['email_lainnya'],
					'verfi_handphone'	=>  $val['otpphone'],
					'nama_pastel'	=>  $val['nama_pastel'],
					'alamat'	=>  $val['alamat'],
					'kota'	=>  $val['kota'],
					'kec_speedy'	=>  $val['kec_speedy'],
					'billing'	=>  $val['billing'],
					'payment'	=>  $val['payment'],
					'waktu_psb'	=>  $val['waktu_psb'],
					'veri_call'	=>  $val['reason_call'],
					'veri_status'	=>  $val['status'],
					'veri_keterangan'	=>  $val['keterangan'] . "/TVV",
					'handphone_lain'	=>  $val['handphone_lainnya'],
					'idx'	=>  $insert_id,
					'sumber'	=>  $val['sumber'],
					'jk'	=>  $val['jk'],
					'click_session'	=>  $random_num,
					'veri_upd'	=>  $val['update_by'],
					'veri_lup'	=>  date('Y-m-d H:i:s'),
					'lup'	=> date('Y-m-d H:i:s'),
					'ip_address'	=>  $pc,
					'status'	=>  1,
					'profiling_by'	=>  '100',
					'veri_count'	=>  1
				);
				$this->infomedia->insert('trans_profiling_detail', $data);
			}
		}
		// $success = $this->tmodel->insert($val);
		echo $o->auto_result($success);
		// } else {
		// 	echo "gagal";
		// }
	}
	function set_session()
	{
		$random_char = 1;
		$characters = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
		$keys = array();
		while (count($keys) < 8) {
			$x = mt_rand(0, count($characters) - 1);
			if (!in_array($x, $keys)) {
				$keys[] = $x;
			}
		}
		foreach ($keys as $key) {
			$random_char .= $characters[$key];
		}
		$today = date('mdH');
		$var_tiket = $today . $random_char;

		return $var_tiket;
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
				'link_save'				=> site_url() . 'Tvv/Tvv/update_action',
				'link_back'				=> $this->agent->referrer(),
				'data'					=> $row,
			);

			$this->template->load('Tvv/Tvv_form', $data);
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

		unset($val['id_forcall']);
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
			redirect(site_url() . "Tvv/Tvv/");
		} else {
			$o->success 	= 'false';
			$o->message	= 'Opps..Gagal menghapus data !!';
			redirect(site_url() . "Tvv//");
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