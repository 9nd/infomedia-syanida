<?php
require APPPATH . '/controllers/Report_profiling/Report_profiling_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Workorder_indri extends CI_Controller
{
	private $log_key, $log_temp, $title;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Outbound/Outbound_model', 'tmodel');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('Custom_model/T_handle_time_model', 'T_handle_time_model');
		$this->load->model('Custom_model/On_call_moss_model', 'On_call_moss_model');
		$this->load->model('Custom_model/On_call_indibox_model', 'On_call_indibox_model');
		$this->load->model('Custom_model/Indibox_forcall_3p_model', 'indibox_forcall_3p');
		$this->infomedia = $this->load->database('infomedia', TRUE);
		// $this->log_key ='log_Form_caring';
		$this->title = new Report_profiling_config();
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$this->load->model('Custom_model/Sys_user_log_in_out_table_model', 'Sys_log');
		if ($data['userdata']->opt_level == 8) {
			$log_where = array(
				'id_user' => $logindata->id_user,
				'agentid' => $data['userdata']->agentid,
			);
			$log = $this->Sys_log->get_row($log_where, array("id,logout_time"), array("id" => "DESC"));
			if ($log) {
				if ($log->logout_time == '') {
					redirect('Lockscreen', 'refresh');
				}
			}
		}
	}


	function index()
	{

		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

		$no = 0;

		$data['list_count'] = $this->tmodel->live_query("SELECT COUNT(*) AS hitung FROM v2_forcall_dapros WHERE update_by='$userdata->agentid'")->row();
		$data['list_outbound'] = $this->tmodel->live_query("SELECT *,status as v_status from v2_forcall_dapros WHERE update_by='$userdata->agentid' and (lup is null or veri_lup is null) limit 30")->result();

		$this->template->load('Workorder_indri/Workorder_indri_list', $data);
	}




	public function get()
	{

		/* $query1="SELECT COUNT(1) AS jml FROM dbprofile_validate_forcall_3p WHERE update_by='$upd'
							AND `status` in (0,3)"; */
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$query1 = $this->tmodel->live_query("SELECT COUNT(update_by) AS jml FROM v2_forcall_dapros WHERE update_by='$userdata->agentid'")->row();
		$jml = $query1->jml;
		// while($rows1 = @mysql_fetch_assoc($result1))@extract($rows1,EXTR_OVERWRITE);

		if ($jml > 100) {
			$onload = "Jumlah data anda,  $jml Anda tidak diperkenankan menambah data";
			print "<script type=\"text/javascript\">alert('$onload');</script>";
			echo "<script>
			alert('$onload');
			window.location.href='";
			echo base_url() . "Workorder_indri/Workorder_indri";
			echo "';
			</script>";
		} else {
			$jml = 100 - $jml;
			$jml = 5;
			$this->tmodel->live_query("UPDATE v2_forcall_dapros SET update_by='$userdata->agentid',date_distribution=SYSDATE()
									WHERE status=0 AND (update_by IS NULL or update_by='') AND no_telp<>'' LIMIT $jml");

			$onload = "Penambahan $jml data baru sukses";
			echo "<script>
			alert('$onload');
			window.location.href='";
			echo base_url() . "Workorder_indri/Workorder_indri";
			echo "';
			</script>";
		}
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
	public function insertdata()
	{
		//agentid
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$agentid = $userdata->agentid;
		$iddapros = $_POST['iddapros'];
		//
		if ($_POST['v_email'] == 11) {
			$_POST['v_email'] = $_POST['v_email'] . "_" . $_POST['vrdeclineemail'];
		}
		if ($_POST['v_sms'] == 11) {
			$_POST['v_sms'] = $_POST['v_sms'] . "_" . $_POST['v_sms'];
		}
		//
		if (isset($agentid)) {
			$lup = date("Y-m-d H:i:s");
			$datainsert = array(
				'no_telp' => $_POST['no_telp'],
				'no_internet' => $_POST['no_internet'],
				'ncli' => $_POST['ncli'],
				'no_indri' => $_POST['no_indri'],
				'nama_pelanggan' => $_POST['nama_pelanggan'],
				'relasi' => $_POST['relasi'],
				'jk' => $_POST['jk'],
				'no_hp' => $_POST['no_hp'],
				'no_hp_lain' => $_POST['no_hp_lain'],
				'wa' => $_POST['wa'],
				'email_utama' => $_POST['email_utama'],
				'email_lain' => $_POST['email_lain'],
				'fb' => $_POST['fb'],
				'tw' => $_POST['tw'],
				'ig' => $_POST['ig'],
				'v_nama' => $_POST['v_nama'],
				'v_alamat' => $_POST['v_alamat'],
				'v_kota' => $_POST['v_kota'],
				'v_kecepatan' => $_POST['v_kecepatan'],
				'v_tagihan' => $_POST['v_tagihan'],
				'tp_bayar' => $_POST['tp_bayar'],
				'th_pasang' => $_POST['th_pasang'],
				'v_email' => $_POST['v_email'],
				'v_sms' => $_POST['v_sms'],
				'opsi_call' => $_POST['opsi_call'],
				'kat_call' => $_POST['kat_call'],
				'sub_call' => $_POST['sub_call'],
				'status_call' => $_POST['status_call'],
				'keterangan' => $_POST['keterangan'],
				'veri_upd' => $agentid,
				'veri_lup' => $lup,
				'lup' => $lup
			);
			$insertdata = $this->infomedia->insert('v2_trans_profiling', $datainsert);

			$dataupdate = array(
				'no_telp' => $_POST['no_telp'],
				'no_internet' => $_POST['no_internet'],
				'ncli' => $_POST['ncli'],
				'no_indri' => $_POST['no_indri'],
				'nama_pelanggan' => $_POST['nama_pelanggan'],
				'relasi' => $_POST['relasi'],
				'jk' => $_POST['jk'],
				'no_hp' => $_POST['no_hp'],
				'no_hp_lain' => $_POST['no_hp_lain'],
				'wa' => $_POST['wa'],
				'email_utama' => $_POST['email_utama'],
				'email_lain' => $_POST['email_lain'],
				'fb' => $_POST['fb'],
				'tw' => $_POST['tw'],
				'ig' => $_POST['ig'],
				'v_nama' => $_POST['v_nama'],
				'v_alamat' => $_POST['v_alamat'],
				'v_kota' => $_POST['v_kota'],
				'v_kecepatan' => $_POST['v_kecepatan'],
				'v_tagihan' => $_POST['v_tagihan'],
				'tp_bayar' => $_POST['tp_bayar'],
				'th_pasang' => $_POST['th_pasang'],
				'v_email' => $_POST['v_email'],
				'v_sms' => $_POST['v_sms'],
				'opsi_call' => $_POST['opsi_call'],
				'kat_call' => $_POST['kat_call'],
				'sub_call' => $_POST['sub_call'],
				'status_call' => $_POST['status_call'],
				'keterangan' => $_POST['keterangan'],
				'veri_upd' => $agentid,
				'veri_lup' => $lup,
				'lup' => $lup,
				'status' =>  $_POST['status_call']
			);
			$this->infomedia->where('id', $iddapros);
			$this->infomedia->update('v2_forcall_dapros', $dataupdate);
			$onload = 'berhasil disimpan';
		} else {
			$onload = 'login terlebih dahulu';
		}
		echo "<script>
				alert('" . $onload . "');	
				window.location = '" . base_url() . "Workorder_indri/Workorder_indri';
				</script>";
	}
	public function insert_moss()
	{
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$idx = $_POST['idx'];

		$lup = date("Y-m-d H:i:s");
		$random_num = $this->set_session();
		$status = 0;
		if ($_POST['labelvalidated'] == "valid") {
			$status = 1;
		}
		$pc = $_SERVER['REMOTE_ADDR'];
		$userdata->kategori = "MOS";


		//moss		
		if ($_POST['jenis_aktivasi'] == "0") {
			$_POST['jenis_aktivasi'] = "pelanggan";
		}
		if ($_POST['jenis_aktivasi'] == "pelanggan") {
			$_POST['produk_moss'] = $_POST['aktivasi_pelangganr'];
		}
		$data9 = array(
			'ncli' =>  $_POST['ncli'],
			'no_speedy' =>  $_POST['no_speedy'],
			'nama_pelanggan'	=>  $_POST['nama_pelanggan'],
			'relasi'	=>  $_POST['relasi'],
			'no_handpone'	=>  $_POST['no_handpone'],
			'verfi_handphone' =>  $_POST['otpphone'],
			'email'	=>  $_POST['email'],
			'verfi_email' =>  $_POST['otpemail'],
			'facebook' =>  $_POST['facebook'],
			'twitter' =>  $_POST['twitter'],
			'instagram' =>  $_POST['instagram'],
			'nama_pastel' =>  $_POST['nama_pastel'],
			'alamat' =>  $_POST['alamat'],
			'kota'	=>  $_POST['kota'],
			'update_by'	=> $userdata->agentid,
			'lup'	=>  $lup,
			'sumber' =>  $_POST['layanan'],
			'tgl_insert' =>  $lup,
			'layanan' =>  $_POST['layanan'],
			'reason_call' =>  $_POST['veri_call'],
			'status' =>  $_POST['veri_status'],
			'keterangan'	=>  $_POST['keterangan'],
			'kecepatan' =>  $_POST['kec_speedy'],
			'tagihan' =>  $_POST['billing'],
			'click_time'	=>  $lup,
			'tahun_pemasangan' =>  $_POST['waktu_psb'],
			'tempat_bayar' =>  $_POST['payment'],
			'produk_mos'	=>  $_POST['produk_moss'],
			'jenis_aktivasi'	=>  $_POST['jenis_aktivasi'],
			'hp2' =>  $_POST['handphone_lainnya'],
			'reason_decline'	=>  $_POST['reason_decline'],
			'checked_nama'	=>  $_POST['checked_nama'],
			'checked_alamat'	=>  $_POST['checked_alamat'],
			'checked_kecepatan'	=>  $_POST['checked_kecepatan'],
			'checked_tagihan'	=>  $_POST['checked_tagihan'],
			'checked_tempatbayar'	=>  $_POST['checked_tempatbayar'],
			'checked_tahnpemasangan'	=>  $_POST['checked_tahnpemasangan'],
			'checked_wa1'	=>  $_POST['handphone_utama_wa'],
			'checked_wa2'	=>  $_POST['handphone_lainnya_wa'],
		);
		$this->infomedia->insert('indri_trans_profiling_validasi_mos', $data9);
		$onload = "Data MOSS, Sukses disimpan";
		echo "<script>
				alert('" . $onload . "');	
				</script>";
		$this->cwc_moss();
	}

	function get_token_moss()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://apigw.telkom.co.id:7777/invoke/pub.apigateway.oauth2/getAccessToken",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => '{
				"grant_type":"client_credentials",
				"client_id":"432b96ed-00bc-40b8-ba28-29582561e35e",
				"client_secret":"8b27a24e-98d0-4dde-aaf4-c18bfe2dfe07"
				}',
			CURLOPT_HTTPHEADER => array(
				"cache-control: no-cache",
				'Content-Type: application/json',
				"postman-token: 7be6d429-43ee-cd2c-61dc-3d36c10f72dc"
			),
		));

		$response = curl_exec($curl);
		$response = json_decode($response);
		return $response->access_token;
	}
	public function testsoaprest()
	{
		$test = $this->set_mos_to_telkom_rest('52491795', '131156107430', 'TEDDY SETIA PERMANA', 'Pemilik', '082127161271', 'teddysetia.p@gmail.com', 'Kabupaten Bandung', '', '', 3);
		// $test = $this->set_mos_to_telkom_rest('59475350', '172825808888', 'mulyadi', 'Karyawan', '085397377760', 'rahmawatibaruff031@gmail.com', 'MAMUJU', '', '', 3);

		if ($test == "Data Updated") {
			echo var_dump($test);
		} else {
			echo var_dump($test);
		}
	}
	function set_mos_to_telkom_rest($ncli, $nd, $nama, $relasi, $hp, $email, $kota, $facebook, $twitter, $regional = '')
	{
		$curl = curl_init();
		$token = $this->get_token_moss();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://apigw.telkom.co.id:7777/ws/telkom-eai-insertVerifiedProfile/1.0/insertVerifiedProfile",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => '{
				"P_NCLI": "' . $ncli . '",
				"P_ND": "' . $nd . '",
				"P_NAMA" : "' . $nama . '",
				"P_RELASI": "' . $relasi . '",
				"P_HP" : "' . $hp . '",
				"P_SUMBER" : "INFOMEDIA_MOS",
				"P_EMAIL":"' . $email . '",
				"P_KOTA":"' . $kota . '"
			}
			',
			CURLOPT_HTTPHEADER => array(
				'Accept: application/json',
				"cache-control: no-cache",
				'Content-Type: application/json',
				"postman-token: 7be6d429-43ee-cd2c-61dc-3d36c10f72dc",
				"Authorization: Bearer $token"
			),
		));

		$response = curl_exec($curl);
		$response = json_decode($response);
		// return $response;
		if ($response->insertVerifiedProfileResponse->outResult == 2) {
			return $response->insertVerifiedProfileResponse->outMessage;
		} else {
			return $response;
		}
	}


	// function set_mos_to_telkom($ncli, $nd, $nama, $relasi, $hp, $email, $kota, $facebook, $twitter)
	function set_mos_to_telkom($ncli, $nd, $nama, $relasi, $hp, $email, $kota, $facebook, $twitter, $regional = 3)
	{
		//ini_set('default_socket_timeout', 600);
		$client     = new SoapClient("http://servicebussit.telkom.co.id:9001/TelkomSystem/DWH/Services/ProxyService/insertVerifiedProfile?wsdl");

		try {
			$val = array();
			// $input = array("P_NCLI" => $ncli, "P_ND" => $nd, "P_NAMA" => $nama, "P_RELASI" => $relasi, "P_HP" => $hp, "P_EMAIL" => $email, "P_SUMBER" => "INFOMEDIA_MOS", "CALL" => "INFOMEDIA", "P_KOTA" => $kota, "P_FB" => $facebook, "P_TWITTER" => $twitter);
			$input = array("P_NCLI" => $ncli, "P_ND" => $nd, "P_NAMA" => $nama, "P_RELASI" => $relasi, "P_HP" => $hp, "P_EMAIL" => $email, "P_SUMBER" => "INFOMEDIA_MOS", "IN_KORESPONDENSI" => "", "IN_KOTA" => $kota, "IN_REGIONAL" => $regional);

			$var = $client->insertVerifiedProfile($input);
		} catch (SoapFault $fault) {
			echo "fault:";
			echo "<pre>";
			print_r($fault);
			echo "</pre>";
		}
		return $var->outMessage;
	}
	public function handletime()
	{
		$proses_time = date("Y-m-d H:i:s");
		$hp = $_POST['no_handphone'];
		$agent = $_POST['agentid'];
		$ncli = $_POST['ncli'];
		$qrcek = $this->db->query("SELECT * FROM t_handle_time WHERE agentid='$agent'");
		if (count($qrcek->result()) != 0) {
			$this->db->query("UPDATE t_handle_time set ncli='$ncli', no_handphone='$hp' WHERE agentid='$agent'");
		} else {
			$this->db->query("INSERT INTO t_handle_time	(no_handphone, agentid, proses_time, ncli) VALUE ('$hp','$agent', '$proses_time', '$ncli')");
		}
	}
	public function handletimeu($agent)
	{
		// $agent = $_POST['agentid'];

		$this->T_handle_time_model->delete(array("agentid" => $agent));
	}

	public function edit()
	{
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$data['userdata'] = $userdata;
		$id   = $this->input->get('id');

		// $data['agent'] = $this->tmodel->live_query('SELECT * FROM Form_caring')->result_array();
		// $data['agentcount'] = $this->tmodel->live_query('SELECT COUNT(*) FROM Form_caring');
		// $userdata->kategori = "MOS";

		$today = date('Y-m-d') . " 00:00:01";
		$vtoday = date('Y-m-d') . " 23:59:01";
		$data['datana'] = $this->tmodel->live_query("SELECT * FROM v2_forcall_dapros WHERE id=$id")->row();
		if (!$data['datana']) {
			echo "<script>
				alert('maaf, data tidak tersedia');
				window.close();
				</script>";
		}
		if ($data['datana']->status_call == 1) {
			if ($data['datana']->update_by != $userdata->agentid) {
				// $this->template->load('Outbound/Form_outbound', $data);
				$view = 'New_cwc/edit_cwc_formwo?';
				// $this->load->vars($data);
				// parse_str($_SERVER['id='.$id], $_GET); 
				$this->load->view($view, $data);
			} else {
				echo "<script>
				alert('data yang anda pilih sudah verified');
				window.close();
				</script>";
			}
		}
		// var_dump($data['datana']);
		if (count($data['datana']) > 0) {
			$view = 'New_cwc/edit_cwc_formwo';
			// $this->load->vars($data);
			// parse_str($_SERVER['id='.$id], $_GET); 
			$this->load->view($view, $data);
		} else {
			echo "<script>
				alert('data not available');
				window.close();
				</script>";
		}
	}
	public function cwc_moss()
	{
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$data['userdata'] = $userdata;
		$phone   = $this->input->get('phone');
		$ncli   = $this->input->get('ncli');
		$no_handpone   = $this->input->get('no_handpone');
		$no_speedy   = $this->input->get('no_speedy');
		$userdata->kategori = "MOS";


		if ($userdata->kategori == "MOS") {
			$data['produk_moss'] = $this->db->query("SELECT * FROM t_produk_moss")->result();

			$this->template->load('Outbound/Form_outbound_moss', $data);
		}
	}
};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-02-07 09:33:58 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/