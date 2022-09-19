<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Public_Access extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}


	/*##############################################################*/
	/*	  						WARNING !! 				  		  	*/
	/*	Class ini dapat diakses langsung tanpa melalui 			  	*/
	/*  proses filter / verifikasi request,,tanpa melalui Login	  	*/
	/*																*/
	/*				JANGAN MELAKUKAN HAL DI BAWAH INI	:		  	*/
	/*	1. Membuat Function Upload,Update,Delete File				*/
	/*	2. Membuat Function Insert,Update,Delete DataBase			*/
	/*	3. Membuat Function untuk mengambil informasi penting		*/
	/*	4. Membuat Function untuk mengambil data dalam jumlah besar	*/
	/*							WARNING !! 							*/
	/*##############################################################*/

	public function get_logo_login()
	{
		$path	= "./images/logo/" . $this->_appinfo['login_logo'];
		$ext   = substr($this->_appinfo['login_logo'], -4);

		// Quick check to verify that the file exists
		if (!file_exists($path)) die("File not found");
		$this->load->helper('download');
		$f = file_get_contents($path);
		force_download(time() . $ext, $f, TRUE);
	}

	public function get_logo_template()
	{
		$path	= "./images/logo/" . $this->_appinfo['template_logo'];
		$ext   = substr($this->_appinfo['template_logo'], -4);

		// Quick check to verify that the file exists
		if (!file_exists($path)) die("File not found");
		$this->load->helper('download');
		$f = file_get_contents($path);
		force_download(time() . $ext, $f, TRUE);
	}

	public function get_logo_title_bar()
	{
		$path	= "./images/logo/logo_titlebar.png";
		//$ext   = substr($this->_appinfo['template_logo'],-4);

		// Quick check to verify that the file exists
		if (!file_exists($path)) die("File not found");
		$this->load->helper('download');
		$f = file_get_contents($path);
		force_download(time() . '.png', $f, TRUE);
	}


	/*JANGAN MERUBAH NAMA FUNCTION INI*/
	public function aXmqpMdcWaoPffGNmzUiadCdBcbdcBqorAuroo($data)
	{
		$val = $this->security->xss_clean($data);
		$a = explode("x001x", $data);
		if (count($a) == 3) {
			$key   	= $a[0];
			$user  	= $a[1];
			$pass   = $a[2];

			$this->load->model('sys/Sys_maintenance_model', 'maintenance');
			$this->load->model('sys/Authorization', 'auth');
			$m = $this->maintenance->get_time_maintenance();

			if ($key == $m->key) {
				$p = _generate($pass);
				$data = array('nmuser' => $user, 'passuser' => $p);

				$valid  = $this->auth->is_valid_password($data);
				if ($valid) {
					$this->load->model('sys/Register_ip_model', 'register');

					$dip = array('ip_address' => $_SERVER['REMOTE_ADDR']);

					$exist = $this->register->if_exist(null, $dip);
					if (!$exist) {
						$this->register->insert($dip);
						redirect("Auth");
					} else {
						redirect("Auth");
					}
				} else {
					redirect("Auth");
				}
			} else {
				redirect("Auth");
			}
		} else {
			redirect("Auth");
		}
	}


	public function jqr($time)
	{
		$path	= "./assets/js/jquery-3.3.1.min.js";
		if (!file_exists($path)) die("File not found");
		$this->load->helper('download');
		$f = file_get_contents($path);
		$name = _generate('jquery-3.3.1.min.js' . time());
		force_download($name . '.js', $f, TRUE);
	}

	public function font($time)
	{
		$path	= "./assets/fonts/font-awesome/css/font-awesome.min.css";
		if (!file_exists($path)) die("File not found");
		$this->load->helper('download');
		$f = file_get_contents($path);
		$name = _generate('font-awesome.min.css' . time());
		force_download($name . '.css', $f, TRUE);
	}

	public function bot($time)
	{
		$path	= "./assets/front-end/css/bootstrap.min.css";
		if (!file_exists($path)) die("File not found");
		$this->load->helper('download');
		$f = file_get_contents($path);
		$name = _generate('bootstrap.min.css' . time());
		force_download($name . '.css', $f, TRUE);
	}
	public function get_data_profile($ncli)
	{
		if ($ncli) {
			$verified_status = 0;
			$dapros_status = 0;
			$this->load->model('Custom_model/Dapros_infomedia_model', 'distribution');
			$q_check_verified = $this->distribution->live_query(
				'SELECT ncli,lup FROM trans_profiling_verifikasi WHERE ncli="' . $ncli . '" ORDER BY lup DESC'
			);
			$d_check_verified = $q_check_verified->row_array();

			if ($d_check_verified) {
				$now = strtotime("-1 years", strtotime(date('Y-m-d H:i:s')));
				$d_verified = strtotime($d_check_verified['lup']);
				if ($d_verified > $now) {
					$verified_status = 1;
				}
			}
			$q_check_dapros = $this->distribution->live_query(
				'SELECT ncli,lup,status FROM dbprofile_validate_forcall_3p WHERE ncli="' . $ncli . '" ORDER BY lup DESC'
			);
			$d_check_dapros = $q_check_dapros->row_array();
			if ($d_check_dapros) {
				if ($d_check_dapros['status'] == 1) {
					$now = strtotime("-1 years", strtotime(date('Y-m-d H:i:s')));
					$d_dapros = strtotime($d_check_dapros['lup']);
					if ($d_dapros > $now) {
						$dapros_status = 1;
					}
				} else {
					$dapros_status = 0;
				}
			}
			$arr = array(
				"status" => 1,
				"dapros_status" => $dapros_status,
				"verified_status" => $verified_status
			);
		} else {
			$arr = array(
				"status" => 0
			);
		}
		//add the header here
		header('Content-Type: application/json');
		echo json_encode($arr);
	}
	public function generate_dapros($sumber)
	{
		$limit = 10;
		for ($z = 1; $z <= $limit; $z++) {


			$verified_status = 0;
			$dapros_status = 0;
			// API URL
			$url = 'http://10.194.52.203/infomedia_app/api/Public_Access/get_dapros';
			// Create a new cURL resource
			$ch = curl_init($url);

			// Set the content type to application/json
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			// Return response instead of outputting
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			// Execute the POST request
			$result = curl_exec($ch);
			// Close cURL resource
			curl_close($ch);
			$res = json_decode($result);

			if (isset($res->ncli)) {
				$ncli = $res->ncli;
				$data_insert = (array) $res;
				if ($ncli) {
					$verified_status = 0;
					$dapros_status = 0;
					$this->load->model('Custom_model/Dapros_infomedia_model', 'distribution');
					$q_check_verified = $this->distribution->live_query(
						'SELECT ncli,lup FROM trans_profiling_verifikasi WHERE ncli="' . $ncli . '" ORDER BY lup DESC'
					);
					$d_check_verified = $q_check_verified->row_array();

					if ($d_check_verified) {
						$now = strtotime("-1 years", strtotime(date('Y-m-d H:i:s')));
						$d_verified = strtotime($d_check_verified['lup']);
						if ($d_verified > $now) {
							$verified_status = 1;
						}
					}
					$q_check_dapros = $this->distribution->live_query(
						'SELECT ncli,lup,status FROM dbprofile_validate_forcall_3p WHERE ncli="' . $ncli . '" ORDER BY lup DESC'
					);
					$d_check_dapros = $q_check_dapros->row_array();
					if ($d_check_dapros) {
						if ($d_check_dapros['status'] == 1) {
							$now = strtotime("-1 years", strtotime(date('Y-m-d H:i:s')));
							$d_dapros = strtotime($d_check_dapros['lup']);
							if ($d_dapros > $now) {
								$dapros_status = 1;
							}
						} else {
							$dapros_status = 0;
						}
					}
					if ($verified_status == 0 && $dapros_status == 0) {

						// header('Content-Type: application/json');
						// echo json_encode($data_insert);
						$this->distribution->add($data_insert);
					} else {
						if ($dapros_status == 0) {
							// header('Content-Type: application/json');
							// echo json_encode($data_insert);
							$this->distribution->delete(array('ncli' => $ncli, 'status' => 0));
							$this->distribution->add($data_insert);
						}
					}
					$url = 'http://10.194.52.203/infomedia_app/api/Public_Access/update_dapros/' . $ncli;
					// Create a new cURL resource
					$ch = curl_init($url);

					// Set the content type to application/json
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
					// Return response instead of outputting
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					// Execute the POST request
					$result = curl_exec($ch);
					// Close cURL resource
					curl_close($ch);
				}
			}
		}
		$data['link'] = base_url() . "api/Public_Access/generate_dapros/" . $sumber;
		$this->load->view('Custom_view/count_down', $data);
	}
	public function transaction_on4()
	{
		$this->dwh = $this->load->database('dwh', TRUE);
		$data = array(
			'id' => $_POST['id'],
			'account' => $_POST['account'],
			'channel_name' => $_POST['channel_name'],
			'cwc_id' => $_POST['cwc_id'],
			'case_type' => $_POST['case_type'],
			'date_download' => $_POST['date_download'],
			'date_in' => $_POST['date_in'],
			'download_time' => $_POST['download_time'],
			'fr_date' => $_POST['fr_date'],
			'upload_date' => $_POST['upload_date'],
			'upload_time' => $_POST['upload_time'],
			'pickup_date' => $_POST['pickup_date'],
			'end_date' => $_POST['end_date'],
			'submit_date' => $_POST['submit_date'],
			'handling_time' => $_POST['handling_time'],
			'waiting_time' => $_POST['waiting_time'],
			'response_time' => $_POST['response_time'],
			'cust_id' => $_POST['cust_id'],
			'cust_name' => $_POST['cust_name'],
			'cust_email' => $_POST['cust_email'],
			'cust_hp' => $_POST['cust_hp'],
			'cust_phone1' => $_POST['cust_phone1'],
			'cust_fb_acc' => $_POST['cust_fb_acc'],
			'cust_tw_acc' => $_POST['cust_tw_acc'],
			'cust_ig_acc' => $_POST['cust_ig_acc'],
			'category' => $_POST['category'],
			'sub_category' => $_POST['sub_category'],
			'regional' => $_POST['regional'],
			'remark' => $_POST['remark'],
			'feedback' => $_POST['feedback'],
			'pic' => $_POST['pic'],
			'sentiment' => $_POST['sentiment'],
			'indihome_num' => $_POST['indihome_num'],
			'segment' => $_POST['segment'],
			'witel' => $_POST['witel'],
			'alamat' => $_POST['alamat'],
			'cust_id_search' => $_POST['cust_id_search'],
			'cust_id_name' => $_POST['cust_id_name'],
			'agent_id_handle' => $_POST['agent_id_handle'],
			'jml_int' => $_POST['jml_int'],
			'status_fcr' => $_POST['status_fcr']

		);
		$query = $this->dwh->insert('t_cwc_on4', $data);
		if($query){
			echo "success";
		}else{
			echo "failed";
		}

	}
	public function transaction_moss()
	{
		if ((substr($this->input->post('no_handphone'), 0, 2) == "08" || substr($this->input->post('no_handphone'), 0, 3) == "+62")) {
			$this->infomedia = $this->load->database('infomedia', TRUE);

			$blacklist = array('085249506484', '085651028417', '085162780805');

			if (in_array($this->input->post('no_handphone'), $blacklist)) {

				$this->infomedia = $this->load->database('infomedia', TRUE);
				$data = array(
					'ncli' => $this->input->post('ncli'),
					'no_pstn' => $this->input->post('no_telp'),
					'no_speedy' => $this->input->post('no_internet'),
					'no_handpone' => $this->input->post('no_handphone'),
					'email' => $this->input->post('email'),
					'nama_pelanggan' => $this->input->post('nama_pelanggan'),
					'nama_pastel' => $this->input->post('nama_pelanggan'),
					'alamat' => $this->input->post('alamat'),
					'layanan' => $this->input->post('layanan'),
					'tagihan' => $this->input->post('tagihan'),
					'kecepatan' => $this->input->post('kecepatan'),
					'tgl_bayar' => $this->input->post('tgl_bayar'),
					'waktu_bayar' => $this->input->post('waktu_bayar'),
					'facebook' => $this->input->post('facebook'),
					'twitter' => $this->input->post('twitter'),
					'tgl_insert' => date("Y-m-d H:i:s"),
					'status' => 10,
					'update_by' => "SYS",
					'sumber' => "ProfillingMOS"
				);
				$query = $this->infomedia->insert('trans_profiling_validasi_mos', $data);
				if ($query) {
					echo 1;
				} else {
					echo 0;
				}
			} else {
				$data = array(
					'ncli' => $this->input->post('ncli'),
					'no_pstn' => $this->input->post('no_telp'),
					'no_speedy' => $this->input->post('no_internet'),
					'no_handpone' => $this->input->post('no_handphone'),
					'email' => $this->input->post('email'),
					'nama_pelanggan' => $this->input->post('nama_pelanggan'),
					'nama_pastel' => $this->input->post('nama_pelanggan'),
					'alamat' => $this->input->post('alamat'),
					'layanan' => $this->input->post('layanan'),
					'tagihan' => $this->input->post('tagihan'),
					'kecepatan' => $this->input->post('kecepatan'),
					'tgl_bayar' => $this->input->post('tgl_bayar'),
					'waktu_bayar' => $this->input->post('waktu_bayar'),
					'facebook' => $this->input->post('facebook'),
					'twitter' => $this->input->post('twitter'),
					'tgl_insert' => date("Y-m-d H:i:s"),
					'sumber' => "ProfillingMOS"
				);
				$query = $this->infomedia->insert('trans_profiling_validasi_mos', $data);
				if ($query) {
					$cek_explode = explode("|", $this->input->post('layanan'));
					if (count($cek_explode) > 1) {
						$ref_id = str_replace(" ", "", $cek_explode[1]);
						$data_insert = array(
							'ncli' => $this->input->post('ncli'),
							'no_pstn' => $this->input->post('no_telp'),
							'no_speedy' => $this->input->post('no_internet'),
							'no_handpone' => $this->input->post('no_handphone'),
							'ref_id' => $ref_id,
						);
						$query_2 = $this->infomedia->insert('trans_lp', $data_insert);
					}
					echo 1;
				} else {
					echo 0;
				}
			}
		} else {
			$this->infomedia = $this->load->database('infomedia', TRUE);
			$data = array(
				'ncli' => $this->input->post('ncli'),
				'no_pstn' => $this->input->post('no_telp'),
				'no_speedy' => $this->input->post('no_internet'),
				'no_handpone' => $this->input->post('no_handphone'),
				'email' => $this->input->post('email'),
				'nama_pelanggan' => $this->input->post('nama_pelanggan'),
				'nama_pastel' => $this->input->post('nama_pelanggan'),
				'alamat' => $this->input->post('alamat'),
				'layanan' => $this->input->post('layanan'),
				'tagihan' => $this->input->post('tagihan'),
				'kecepatan' => $this->input->post('kecepatan'),
				'tgl_bayar' => $this->input->post('tgl_bayar'),
				'waktu_bayar' => $this->input->post('waktu_bayar'),
				'facebook' => $this->input->post('facebook'),
				'twitter' => $this->input->post('twitter'),
				'tgl_insert' => date("Y-m-d H:i:s"),
				'status' => 10,
				'update_by' => "SYS",
				'sumber' => "ProfillingMOS"
			);
			$query = $this->infomedia->insert('trans_profiling_validasi_mos', $data);
			if ($query) {
				echo 1;
			} else {
				echo 0;
			}
		}
	}

	public function transaction_trans_verifikasi()
	{
		if (substr($this->input->post('no_handphone'), 0, 2) == "08" || substr($this->input->post('no_handphone'), 0, 3) == "+62") {
			$this->infomedia = $this->load->database('infomedia', TRUE);
			$data = array(
				'ncli' => $this->input->post('ncli'),
				'no_pstn' => $this->input->post('no_telp'),
				'no_speedy' => $this->input->post('no_internet'),
				'no_handpone' => $this->input->post('no_handphone'),
				'email' => $this->input->post('email'),
				'nama_pelanggan' => $this->input->post('nama_pelanggan'),
				'nama_pastel' => $this->input->post('nama_pelanggan'),
				'alamat' => $this->input->post('alamat'),
				'kota' => $this->input->post('kota'),
				'facebook' => $this->input->post('facebook'),
				'twitter' => $this->input->post('twitter'),
				'instagram' => $this->input->post('instagram'),
				'tgl_update' => date("Y-m-d H:i:s"),
				'lup' => date("Y-m-d H:i:s"),
				'update_by' => "ProfillingDC"
			);
			$query = $this->infomedia->insert('trans_profiling_verifikasi', $data);

			$trans_profiling = array(
				'ncli' => $this->input->post('ncli'),
				'pstn1' => $this->input->post('no_telp'),
				'no_speedy' => $this->input->post('no_internet'),
				'handphone' => $this->input->post('no_handphone'),
				'email' => $this->input->post('email'),
				'nama' => $this->input->post('nama_pelanggan'),
				'nama_pastel' => $this->input->post('nama_pelanggan'),
				'alamat' => $this->input->post('alamat'),
				'kota' => $this->input->post('kota'),
				'facebook' => $this->input->post('facebook'),
				'twitter' => $this->input->post('twitter'),
				'lup' => date("Y-m-d H:i:s"),
				'veri_lup' => date("Y-m-d H:i:s"),
				'veri_upd' => "ProfillingDC"
			);


			$query_transprofiling = $this->infomedia->insert('trans_profiling', $trans_profiling);

			$trans_dc = array(
				'ncli' => $this->input->post('ncli'),
				'no_telp' => $this->input->post('no_telp'),
				'no_internet' => $this->input->post('no_internet'),
				'no_handphone' => $this->input->post('no_handphone'),
				'email' => $this->input->post('email'),
				'nama_pelanggan' => $this->input->post('nama_pelanggan'),
				'relasi' => $this->input->post('relasi'),
				'alamat' => $this->input->post('alamat'),
				'kota' => $this->input->post('kota'),
				'kelurahan' => $this->input->post('kelurahan'),
				'provinsi' => $this->input->post('provinsi'),
				'kode_pos' => $this->input->post('kode_pos'),
				'kecamatan' => $this->input->post('kecamatan'),
				'instagram' => $this->input->post('instagram'),
				'facebook' => $this->input->post('facebook'),
				'twitter' => $this->input->post('twitter'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'sumber' => "ProfillingDC",
				'lup' => date("Y-m-d H:i:s")
			);

			$query_dc = $this->infomedia->insert('trans_digital_channel', $trans_dc);

			if ($query_transprofiling && $query_dc && $query) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			$this->infomedia = $this->load->database('infomedia', TRUE);
			$data = array(
				'ncli' => $this->input->post('ncli'),
				'no_pstn' => $this->input->post('no_telp'),
				'no_speedy' => $this->input->post('no_internet'),
				'no_handpone' => $this->input->post('no_handphone'),
				'email' => $this->input->post('email'),
				'nama_pelanggan' => $this->input->post('nama_pelanggan'),
				'nama_pastel' => $this->input->post('nama_pelanggan'),
				'alamat' => $this->input->post('alamat'),
				'kota' => $this->input->post('kota'),
				'facebook' => $this->input->post('facebook'),
				'twitter' => $this->input->post('twitter'),
				'instagram' => $this->input->post('instagram'),
				'tgl_update' => date("Y-m-d H:i:s"),
				'lup' => date("Y-m-d H:i:s"),
				'update_by' => "ProfillingDC"
			);
			$query = $this->infomedia->insert('trans_profiling_verifikasi', $data);

			$trans_profiling = array(
				'ncli' => $this->input->post('ncli'),
				'pstn1' => $this->input->post('no_telp'),
				'no_speedy' => $this->input->post('no_internet'),
				'handphone' => $this->input->post('no_handphone'),
				'email' => $this->input->post('email'),
				'nama' => $this->input->post('nama_pelanggan'),
				'nama_pastel' => $this->input->post('nama_pelanggan'),
				'alamat' => $this->input->post('alamat'),
				'kota' => $this->input->post('kota'),
				'facebook' => $this->input->post('facebook'),
				'twitter' => $this->input->post('twitter'),
				'lup' => date("Y-m-d H:i:s"),
				'veri_lup' => date("Y-m-d H:i:s"),
				'veri_upd' => "ProfillingDC"
			);


			$query_transprofiling = $this->infomedia->insert('trans_profiling', $trans_profiling);

			$trans_dc = array(
				'ncli' => $this->input->post('ncli'),
				'no_telp' => $this->input->post('no_telp'),
				'no_internet' => $this->input->post('no_internet'),
				'no_handphone' => $this->input->post('no_handphone'),
				'email' => $this->input->post('email'),
				'nama_pelanggan' => $this->input->post('nama_pelanggan'),
				'relasi' => $this->input->post('relasi'),
				'alamat' => $this->input->post('alamat'),
				'kota' => $this->input->post('kota'),
				'kelurahan' => $this->input->post('kelurahan'),
				'provinsi' => $this->input->post('provinsi'),
				'kode_pos' => $this->input->post('kode_pos'),
				'kecamatan' => $this->input->post('kecamatan'),
				'instagram' => $this->input->post('instagram'),
				'facebook' => $this->input->post('facebook'),
				'twitter' => $this->input->post('twitter'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'sumber' => "ProfillingDC",
				'lup' => date("Y-m-d H:i:s")
			);

			$query_dc = $this->infomedia->insert('trans_digital_channel', $trans_dc);

			if ($query_transprofiling && $query_dc && $query) {
				echo 1;
			} else {
				echo 0;
			}
		}
	}
	public function cek_status_moss()
	{
		$this->infomedia = $this->load->database('infomedia', TRUE);
		$ncli = $_POST['ncli'];
		$nointernet = $_POST['nointernet'];
		$handphone = $_POST['handphone'];
		$no_tanggal = $_POST['no_tanggal'];
		$sumber = $_POST['sumber'];
		$uniq = $ncli . $nointernet . $handphone . $no_tanggal;
		$get_data = $query = $this->infomedia->query("SELECT
		a.ncli,
		a.no_speedy,
		a.no_handpone,
		a.layanan,
		a.reason_call as kode_reason,
		b.nama_reason,
		a.lup as time_updateagent
		FROM db_profiling.trans_profiling_validasi_mos a
		INNER JOIN infomedia_app.status_call b ON a.reason_call = b.id
		WHERE 
		a.ncli='$ncli' and a.no_speedy='$nointernet' and no_handpone='$handphone' and a.tgl_insert='$no_tanggal' and a.layanan='$sumber'")->row();
		if (!$get_data) {
			$get_data = "no data";
		}
		echo json_encode($get_data);
		
	}
	public function cari_kontak()
	{
		$this->infomedia = $this->load->database('infomedia', TRUE);
		
		$nointernet = $_POST['nointernet'];
		
		$get_data = $this->infomedia->query("SELECT no_handpone, email, nama_pelanggan, no_pstn
		FROM db_profiling.trans_profiling_verifikasi
		WHERE 
		no_speedy='$nointernet' limit 5")->result();
		
		echo json_encode($get_data);
		
	}

	public function cari_kontak_moss_bynd()
	{
		$this->infomedia = $this->load->database('infomedia', TRUE);
		
		$nointernet = $_POST['nointernet'];
		
		$get_data = $this->infomedia->query("SELECT no_handpone, email, nama_pelanggan, no_pstn
		FROM db_profiling.trans_profiling_validasi_mos
		WHERE 
		no_speedy='$nointernet' limit 5")->result();
		
		if (!$get_data) {
			$get_data = "no data";
		}
		echo json_encode($get_data);
		
	}

	public function cari_kontak_indipass()
	{
		$this->infomedia = $this->load->database('dwh', TRUE);
		
		$nointernet = $_POST['nointernet'];
		
		$get_data = $this->infomedia->query("SELECT msisdn, email, ncli, nd
		FROM transaction_log
		WHERE 
		nd='$nointernet' limit 5")->result();
		
		if (!$get_data) {
			$get_data = "no data";
		}
		echo json_encode($get_data);
		
	}
}
