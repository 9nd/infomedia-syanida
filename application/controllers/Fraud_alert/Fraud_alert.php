<?php
require APPPATH . '/controllers/Fraud_alert/Fraud_alert_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Fraud_alert extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Custom_model/Tahun_model', 'tahun');
		$this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling_verifikasi');
		$this->load->model('Custom_model/Trans_profiling_daily_model', 'trans_profiling_daily');
		$this->load->model('Custom_model/Trans_profiling_infomedia_model', 'trans_profiling');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Cache_monev_realtime_model', 'cache_modev_realtime');
		$this->load->model('Custom_model/Layanan_moss_model', 'layanan_moss');
		$this->load->model('Custom_model/Status_call_model', 'status_call');
		$this->load->model('Custom_model/Trans_profiling_daily_model', 'trans_profiling_daily');
		$this->load->model('Custom_model/Trans_profiling_monthly_model', 'trans_profiling_monthly');
		$this->load->model('Custom_model/Trans_profiling_last_month_infomedia_model', 'trans_profiling_last_month');
		$this->load->model('Custom_model/T_produk_moss_model', 'product_moss');
		$this->load->model('Custom_model/Cdr_model', 'cdr');
		$this->load->model('Custom_model/Cdr_daily_model', 'cdr_daily');
		$this->load->model('Custom_model/Recording_daily_model', 'recording_daily');
		$this->log_key = 'Fraud_alert';
		$this->title = new Fraud_alert_config();
	}


	public function index()
	{
		$data = array(
			'title_page_big'		=> 'Audit Fraud Alert',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'Fraud_alert/Fraud_alert/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'Fraud_alert/Fraud_alert/create',
			'link_update'			=> site_url() . 'Fraud_alert/Fraud_alert/update',
			'link_delete'			=> site_url() . 'Fraud_alert/Fraud_alert/delete_multiple',
		);
		$start = date('Y-m-d');
		$end = date('Y-m-d');
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start = $_GET['start'];
			$end = $_GET['end'];
		}

		$this->template->load('Fraud_alert/list', $data);
	}

	public function audit()
	{


		$hp = $_GET['hp'];
		$data['resultm'] = $this->trans_profiling_verifikasi->live_query("
        select no_speedy,ncli,update_by, nama_pelanggan,no_handpone, alamat, nama_pastel, relasi, email, lup, no_speedy, no_pstn FROM trans_profiling_verifikasi WHERE no_handpone = '$hp'
         ORDER BY no_speedy")->result();
		$data['hp'] = $hp;
		$data['count_multiinet'] = $this->trans_profiling_verifikasi->live_query("
        select count(distinct no_speedy) as hitung FROM trans_profiling_verifikasi WHERE no_handpone = '$hp'
         ORDER BY no_speedy")->row()->hitung;
		$this->template->load('Fraud_alert/audit_form', $data);
	}
	public function Insert()
	{
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$datauser = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user))->agentid;
		$tanggal = date("Y-m-d  H:i:s");
		$data = array(
			'no_handphone' => $_POST['handphone'],
			'tanggal_check' => $tanggal,
			'update_by' => $datauser,
			'status_approve' => $_POST['approval'],
			'reason' => $_POST['reason']
		);
		if ($datauser == 8) {
			echo "<script>alert('data tidak dizinkan');</script>";
		} else {
			$this->db->insert('t_fraud_alert_check', $data);
			echo "<script>
				alert('Data " .$_POST['handphone']." | ". $_POST['approval'] . " Berhasil disimpan');
				window.close();
				</script>";
		}
	}

	public function get_data_list()
	{
		$view = 'Fraud_alert/data';
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		if (isset($_POST['start'])) {

			$data['start'] = $_POST['start'];
			$data['end'] = $_POST['end'];
			$data['end_tgl'] = $_POST['end'];
			$table_recording = "recording_daily";
			if ($_POST['start'] != date('Y-m-d')) {
				$table_trans_profiling = "trans_profiling_monthly";
			}
		} else {
			$data['start'] = date('Y-m-d');
			$data['end'] = date('Y-m-d');
			$data['end_tgl'] = date('Y-m-d');
			$table_recording = "recording_daily";
			$table_trans_profiling = "trans_profiling_daily";
		}
		$start = $data['start'];
		$end = $data['end_tgl'];
		$agentid = false;
		if (isset($_POST['agentid'])) {
			if ($_POST['agentid'] != '0') {
				$agentid = $_POST['agentid'];
				$response['agent_filter'] = $agentid;
			}
		}
		$where_agent = array("opt_level" => 8, "kategori" => "REG", "tl !=" => "-");
		if ($userdata->opt_level == 9) {
			$where_agent['tl'] = $userdata->agentid;
		}
		$data['controller'] = $this;
		$data['title_page_big']     =   '';

		$response['agent'] = $this->Sys_user_table_model->get_results($where_agent);

		$response['rec'] = $this->get_verified_quality($table_trans_profiling, $table_recording, $data['start'], $data['end'], $agentid);
		$response['start'] = $data['start'];
		$response['end'] = $data['end_tgl'];
		$response['controller'] = $this;
		$this->load->view($view, $response);
	}


	function get_verified_quality($trans_profiling_daily = 'trans_profiling_daily', $tabel_recording = 'recording_daily', $start, $end, $agentid = false)
	{
		$filter_agent = "";
		if ($agentid) {
			$filter_agent = " AND veri_upd = '$agentid' ";
		}
		$data['no_hp'] = $this->trans_profiling_daily->live_query("
      select handphone,no_speedy,veri_upd,
      count(*) AS num FROM $trans_profiling_daily WHERE DATE(lup) >= '$start' AND DATE(lup) <= '$end' AND veri_call=13  
      $filter_agent
      GROUP BY
      handphone
    ")->result();
		$response = array();
		if (count($data['no_hp']) > 0) {
			foreach ($data['no_hp'] as $row_veri) {
				$rec = $this->trans_profiling_daily->live_query("
            select dst,count(*) AS num,SUM(duration) AS sumna FROM $tabel_recording WHERE dst = '61$row_veri->handphone' AND
            DATE(calldate) >= '$start' AND DATE(calldate) <= '$end' GROUP BY dst
          ")->row();
				$number_lain = $this->trans_profiling_verifikasi->live_query("
        select no_speedy FROM trans_profiling_verifikasi WHERE no_handpone = '$row_veri->handphone' AND no_speedy <> '$row_veri->no_speedy'
        ")->num_rows();
				/***********SUMMARY */
				$response['rec_count'] = $rec->num + $response['rec_count'];
				$response['rec_sum'] = $rec->sumna + $response['rec_sum'];
				$response['dup'] = $number_lain + $response['dup'];
				// echo $row_veri->handphone . "<br>";
				// echo "count : " . $rec->num . " | sum : " . $rec->sumna . " | dup : " . $number_lain . "<br>";

				/*******AGENT */
				$response[$row_veri->veri_upd]['count'] = $rec->num + $response[$row_veri->veri_upd]['count'];
				$response[$row_veri->veri_upd]['sum'] = $rec->sumna + $response[$row_veri->veri_upd]['sum'];
				$response[$row_veri->veri_upd]['dup'] = $number_lain + $response[$row_veri->veri_upd]['dup'];
				$response[$row_veri->veri_upd]['detail'][$row_veri->handphone]['çount'] = $rec->num;
				$response[$row_veri->veri_upd]['detail'][$row_veri->handphone]['sum'] = $rec->sumna;
				$response[$row_veri->veri_upd]['detail'][$row_veri->handphone]['dup'] = $number_lain;

				//****HANDPHONE */
				$response['rec_hp'][$row_veri->handphone]['çount'] = $rec->num;
				$response['rec_hp'][$row_veri->handphone]['sum'] = $rec->sumna;
				$response['rec_hp'][$row_veri->handphone]['dup'] = $number_lain;
				$response['rec_hp'][$row_veri->handphone]['agentid'] = $row_veri->veri_upd;
			}
		}

		return $response;
	}
	function by_sumber($start, $end, $agentid = false)
	{
		$filter_agent = "";
		if ($agentid) {
			$filter_agent = " AND veri_upd = '$agentid' ";
		}
		$data['sumber'] = $this->trans_profiling_verifikasi->live_query("
    select sumber,veri_call,count(*) as num FROM trans_profiling_detail WHERE DATE(lup) >= '$start' AND DATE(lup) <= '$end' $filter_agent GROUP BY sumber,veri_call
    ")->result();
		$response = array();
		if (count($data['sumber']) > 0) {
			foreach ($data['sumber'] as $r) {
				$response['sumber'][$r->sumber][$r->veri_call] = $r->num;
				$response['sumber'][$r->sumber]['oc'] = $r->num + $response[$r->sumber]['oc'];
				$response['oc'] = $r->num + $response['oc'];
			}
		}

		return $response;
	}

	public function detail($id)
	{

		$row = $this->tmodel->get_by_id($id);
		//echo var_dump($row);
		if ($row) {
			$data = array(
				'title_page_big'		=> 'Detail',
				'title'					=> $this->title,
				'link_save'				=> site_url() . 'Indibox/Indibox/update_action',
				'link_back'				=> $this->agent->referrer(),
				'data'					=> $row,
				'id'					=> $id,
			);

			$this->template->load('Indibox/Indibox_detail', $data);
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