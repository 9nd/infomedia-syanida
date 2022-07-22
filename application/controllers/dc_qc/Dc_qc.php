<?php
require APPPATH . '/controllers/Dc_qc/Dc_qc_config.php';
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Dc_qc extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Custom_model/Trans_profiling_daily_model', 'trans_profiling_daily');
		$this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling_verifikasi');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->log_key = 'log_dc_qc';
		$this->title = new dc_qc_config();
	}


	public function index()
	{
		$data = array();
		if (isset($_GET["date"])) {
			$data["date"] = $_GET["date"];
			$data["sumber"] = $_GET["sumber"];
		} else {
			$data["date"] = "";
			$data["sumber"] = "";
		}

		$this->load->view('Dc_qc/Dc_qc', $data);
	}

	public function get_data_list()
	{
		$data = array();
		$data['date'] = $_GET["date"];
		$data['sumber'] = $_GET["sumber"];

		if (isset($_GET['date']) && isset($_GET['sumber'])) {
			$data["tabledata"] = $this->filter_dc($data['sumber'], $_GET['date']);
		}
		$this->load->view('Dc_qc/' . $data['tabledata']['view'], $data);
	}


	public function checkstatus($listdata, $sumber)
	{
		if ($sumber == "obc") {
			$f_hp_1 = "handphone";
			$f_hp_2 = "handphone_lain";
			$f_email1 = "email";
			$f_email2 = "email_lain";
		} else if ($sumber == "digital") {
			$f_hp_1 = "handphone";
			$f_hp_2 = "handphone_lain";
			$f_email1 = "email";
			$f_email2 = "email_lain";
		} else {
			$f_hp_1 = "undifined";
			$f_hp_2 = "undifined";
			$f_email1 = "undifined";
			$f_email2 = "undifined";
		}
		foreach ($listdata->result() as $kdatanya => $vdatanya) {
			if (substr($vdatanya->{$f_hp_1}, 0, 2) == '08' || substr($vdatanya->{$f_hp_2}, 0, 2) == '08') {
				$status_hp = '-';
			} else {
				$status_hp = 'HP Not Like 08';
			}
			if ($vdatanya->{$f_email1} != "") {
				if ((!filter_var($vdatanya->{$f_email1}, FILTER_VALIDATE_EMAIL))) {
					$status_email1 = 'Format Email(1) Salah';
				} else {
					$status_email1 = '';
				}
			}
			if ($vdatanya->{$f_email2} != "") {
				if ((!filter_var($vdatanya->{$f_email1}, FILTER_VALIDATE_EMAIL))) {
					$status_email2 = 'Format Email(2) Salah';
				} else {
					$status_email2 = '';
				}
			}

			$data['status'][$kdatanya] = array($status_hp, $status_email1, $status_email2);
		}
		return $data;
	}

	public function form_revalidate()
	{
		$data = array();
		$view = "form_validate_obc";
		$this->load->view('dc_qc/' . $view, $data);
	}

	public function submit_obc()
	{
		$reason = $_GET['reason'];
		$databulk = $_GET['idx'];
		$pecah = explode("_", $databulk);
		$idx = $pecah[0];
		$sumber = $pecah[1];
		$ncli = $pecah[2];
		$no_speedy = $pecah[3];
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		if ($sumber == "obc") {
			$checkdata = $this->db->query("SELECT * FROM trans_profiling_monthly WHERE idx='$idx' AND ncli='$ncli' AND no_speedy='$no_speedy'")->result();
			if (count($checkdata) == 1) {

				$insertadata = $this->db->query("INSERT INTO re_validate SELECT
				*, '$userdata->agentid' as qc_revalidate, CURRENT_TIMESTAMP as date_qc, '$reason' as reason_qc
				FROM
					trans_profiling_monthly 
				WHERE
					idx = '48538438' 
					AND ncli = '38537128' 
					AND no_speedy = '111810814622'");

				if (!$insertadata) {
					$messages =  "Gagal Tambah Data Data";
				} else {
					$ncli = $checkdata[0]->ncli;
					$no_pstn = $checkdata[0]->pstn1;
					$no_speedy = $checkdata[0]->no_speedy;
					$no_handpone = $checkdata[0]->handphone;
					$email = $checkdata[0]->email;
					$nama_pelanggan = $checkdata[0]->nama;
					$nama_pastel = $checkdata[0]->nama;
					$alamat = $checkdata[0]->alamat;
					$layanan = "QC Digital Channel";
					$tagihan = $checkdata[0]->billing;
					$kecepatan = $checkdata[0]->kec_speedy;
					$tgl_bayar = "";
					$waktu_bayar = "";
					$facebook = $checkdata[0]->facebook;
					$twitter = $checkdata[0]->twitter;
					$tgl_insert = date("Y/m/d");
					$sumber = $sumber;
					$api = $this->transaction_moss($ncli, $no_pstn, $no_speedy, $no_handpone, $email, $nama_pelanggan, $nama_pastel, $alamat, $layanan, $tagihan, $kecepatan, $tgl_bayar, $waktu_bayar, $facebook, $twitter, $tgl_insert, $sumber);

					if ($api != "1") {
						$messages = "Failed push to API";
					} else {
						$messages = "Berhasil Re-Validate \n reason : " . $reason . "\n " . "idx: " . $idx . "\n " . "sumber : " . $sumber . "\n " . "ncli :" . $ncli . "\n " . "no_speedy :" . $no_speedy . "\n Input by: " . $userdata->agentid;
					}
				}
			}
		}
		echo $messages;
	}
	public function test()
	{
		$test = $this->transaction_moss('51589599', '131159124293', 'Ahmad Sadikin MOS', 'Pemilik', '081221609591', 'ahmadsadikin8888@gmail.com', 'Bandung Barat', '', '', 3, '', '', '', '', '', '', '');

		echo $test;
	}
	public function transaction_moss($ncli, $no_pstn, $no_speedy, $no_handpone, $email, $nama_pelanggan, $nama_pastel, $alamat, $layanan, $tagihan, $kecepatan, $tgl_bayar, $waktu_bayar, $facebook, $twitter, $tgl_insert, $sumber)
	{
		$url = base_url() . "api/Public_Access/transaction_moss";

		//The data you want to send via POST
		$data = array(
			'ncli' => $ncli,
			'no_pstn' => $no_pstn,
			'no_speedy' =>  $no_speedy,
			'no_handpone' =>  $no_handpone,
			'email' =>  $email,
			'nama_pelanggan' =>  $nama_pelanggan,
			'nama_pastel' =>  $nama_pastel,
			'alamat' =>  $alamat,
			'layanan' =>  $layanan,
			'tagihan' =>  $tagihan,
			'kecepatan' =>  $kecepatan,
			'tgl_bayar' =>  $tgl_bayar,
			'waktu_bayar' =>  $waktu_bayar,
			'facebook' =>  $facebook,
			'twitter' =>  $twitter,
			'tgl_insert' =>  $tgl_insert,
			'sumber' =>  $sumber
		);

		//url-ify the data for the POST
		$fields_string = http_build_query($data);

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

		//So that curl_exec returns the contents of the cURL; rather than echoing it
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		//execute post
		$result = curl_exec($ch);
		return $result;
	}

	public function filter_dc($sumber, $date)
	{
		$data = array();
		if ($sumber == "obc") {
			$data['listdata'] = $this->db->query("SELECT * FROM trans_profiling_monthly WHERE date(lup)='$date' AND veri_call=13");
			$data['listdata_status'] = $this->checkstatus($data['listdata'], $sumber);
			$data['view'] = "obc";
		} else if ($sumber == "digital") {
			$data['listdata'] = $this->db->query("SELECT * FROM trans_profiling_monthly WHERE date(lup)='$date' AND veri_call=13");
			$data['listdata_status'] = $this->checkstatus($data['listdata'], $sumber);
			$data['view'] = "digital";
		} else {
			$data['listdata'] = "no data";
			$data['view'] = "no view";
		}

		// $data['hpnotlike08'] = $this->db->query("SELECT * FROM trans_profiling WHERE date(lup)='$date' AND handphone NOT LIKE '08%'")->result();
		// $data['invalidemail'] = $this->db->query("SELECT * FROM trans_profiling WHERE date(lup)='$date' AND email NOT LIKE '%_@_%._%'")->result();
		// $data['totaldata'] = $this->db->query("SELECT * FROM trans_profiling WHERE date(lup)='$date'")->result();
		// $data['no_hp'] = $this->trans_profiling_daily->live_query("
		// 		SELECT * FROM trans_profiling_monthly WHERE date(lup)='$date' and veri_call='13'
		// 	  ")->result();
		// if (count($data['no_hp']) > 0) {
		// 	foreach ($data['no_hp'] as $row_veri) {

		// 		$number_lain = $this->trans_profiling_verifikasi->live_query("
		// 			  select no_speedy FROM trans_profiling_verifikasi WHERE no_handpone = '$row_veri->handphone' AND no_speedy <> '$row_veri->no_speedy'
		// 			  ")->num_rows();

		// 		/***********SUMMARY */
		// 		$data['multi'][$row_veri->no_speedy] = $number_lain + $data['multi'][$row_veri->no_speedy];

		// 		// echo $row_veri->handphone . "<br>";
		// 		// echo "count : " . $rec->num . " | sum : " . $rec->sumna . " | dup : " . $number_lain . "<br>";
		// 	}
		// }


		return $data;
	}
	public function dc_sum()
	{

		$this->load->view('dc_qc/dc_qc_sum');
	}
	public function dc_automation()
	{

		$this->load->view('dc_qc/dc_qc_automation');
	}
	public function dc_wallboard()
	{

		$this->load->view('dc_qc/dc_wallboard');
	}
	public function dc_report()
	{

		$this->load->view('dc_qc/dc_report');
	}
}

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-02-08 07:42:27 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
