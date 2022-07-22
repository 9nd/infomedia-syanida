<?php
require APPPATH . '/controllers/Report_profiling/Report_profiling_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Outbound extends CI_Controller
{
	private $log_key, $log_temp, $title;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Outbound/Outbound_model', 'tmodel');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('Custom_model/T_handle_time_model', 'T_handle_time_model');
		$this->infomedia = $this->load->database('infomedia', TRUE);
		// $this->log_key ='log_Form_caring';
		$this->title = new Report_profiling_config();
	}


	function index()
	{

		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$data['userdata'] = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));

		$no = 0;

		if ($userdata->kategori == "MOS") {
			$data['list_outbound'] = $this->tmodel->live_query("SELECT DISTINCT ncli,no_pstn,no_speedy,nama_pastel,no_handpone,email,layanan FROM
			trans_profiling_validasi_mos WHERE `status` IN ('0','3',null) and ncli IS NOT NULL AND update_by is null order by tgl_insert desc")->result_array();
			$data_list = array();

			foreach ($data['list_outbound'] as $datanya) {
				$no++;
				$nom = 0;
				$data_list[$no] = $datanya;
				$ncli = $datanya['ncli'];
				$no_pstn = $datanya['no_pstn'];
				$cekdouble = $this->tmodel->live_query("SELECT idx as countData,tgl_insert FROM
				trans_profiling_validasi_mos WHERE `status` IN ('0','3',null) AND update_by is null AND ncli='$ncli' AND no_pstn='$no_pstn'")->result();
				foreach ($cekdouble as $datadouble) {
					$nom++;
					if ($nom > 1) {
						$data = array(
							'status'      => 10,
							'update_by' => 'SYS'
						);

						$this->infomedia->where('idx', $datadouble->countData);

						$this->infomedia->update('trans_profiling_validasi_mos', $data);
					} else {
						$data_list[$no]['idx'] = $datadouble->countData;
						// echo $datadouble->tgl_insert;
						$tgl_insert = $datadouble->tgl_insert;
						$data_list[$no]['lup'] = $tgl_insert;
					}
				}
			}
			$data['data_list'] = $data_list;
			$this->template->load('Outbound/List_outbound_moss', $data);
		} else {
			$data['list_count'] = $this->tmodel->live_query("SELECT COUNT(*) AS hitung FROM v_list_outbond WHERE update_by='$userdata->agentid'")->row();
			$data['list_outbound'] = $this->tmodel->live_query("SELECT *,status as v_status from v_list_outbond WHERE update_by='$userdata->agentid' limit 30")->result();

			$this->template->load('Outbound/List_outbound', $data);
		}
	}
	
	public function get_list_mos()
	{
		$data['count'] = $this->tmodel->live_query("SELECT count(distinct ncli)jumlah FROM trans_profiling_validasi_mos WHERE `status` IN ('0','3',null) AND update_by is null and ncli IS NOT NULL")->row();
		echo $data['count']->jumlah;
	}

	public function testsoap()
	{
		$test = $this->set_mos_to_telkom('38081997', '121101203171', 'Mohamad afriliansyah r', 'Pemilik', '082299503237', 'apriliansyah.ramadhan17@gmail.com', '', '', '');

		if ($test == "Data Updated") {
			echo var_dump($test);
		} else {
			echo var_dump($test);
		}
	}

	public function get()
	{

		/* $query1="SELECT COUNT(1) AS jml FROM dbprofile_validate_forcall_3p WHERE update_by='$upd'
							AND `status` in (0,3)"; */
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$query1 = $this->tmodel->live_query("SELECT COUNT(update_by) AS jml FROM v_list_outbond WHERE update_by='$userdata->agentid'")->row();
		$jml = $query1->jml;
		// while($rows1 = @mysql_fetch_assoc($result1))@extract($rows1,EXTR_OVERWRITE);

		if ($jml > 100) {
			$onload = "Jumlah data anda,  $jml Anda tidak diperkenankan menambah data";
			print "<script type=\"text/javascript\">alert('$onload');</script>";
			echo "<script>
			alert('$onload');
			window.location.href='";
			echo base_url() . "Outbound/Outbound";
			echo "';
			</script>";
		} else {
			$jml = 100 - $jml;
			$jml = 5;
			$this->tmodel->live_query("UPDATE dbprofile_validate_forcall_3p SET update_by='$userdata->agentid',tgl_update=SYSDATE()
									WHERE status=0 AND (update_by IS NULL or update_by='') AND no_PSTN<>'' LIMIT $jml");
			// $query;						
			// $result=@mysql_unbuffered_query($query);
			$onload = "Penambahan $jml data baru sukses";
			// redirect("base_url()/Outbound/Outbound/Index?onload=$onload");
			// print "<script type=\"text/javascript\">alert('$onload');</script>";
			// echo "<script>
			// alert('$onload');
			// window.location.href='";echo base_url()."Outbound/Outbound";
			// echo "';
			// </script>";
			// redirect('Outbound/Outbound');
			echo "<script>
			alert('$onload');
			window.location.href='";
			echo base_url() . "Outbound/Outbound";
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
		$bysistem = $this->input->post('bysistem');


		$pc = $_SERVER['REMOTE_ADDR'];

		$click_session = trim($_POST['click_session']);


		//moss
		if ($userdata->kategori == "MOS") {



			if ($bysistem != 1) {
				$bysistem = 0;
			}
			if ($click_session == '') {
				$random_num = $this->set_session($idx);
				if ($_POST['nama_pelanggan'] != "" && $_POST['veri_status'] == "1" && $_POST['ncli'] != substr($_POST['ncli'], 0, 2)) {
					if ($_POST['otpemail'] != "" || $_POST['otpphone'] != "") {
						$setMos = $this->set_mos_to_telkom($_POST['ncli'], $_POST['no_speedy'], $_POST['nama_pelanggan'], $_POST['relasi'], $_POST['no_handpone'], $_POST['email'], $_POST['kota'], $_POST['facebook'],  $_POST['twitter']);
						// $setMos= "Data Updated";
						if ($setMos == "Data Updated") {

							$data = array(
								'ncli'	=>  $_POST['ncli'],
								'pstn1' =>  $_POST['no_pstn'],
								'nama'	=>  $_POST['nama_pelanggan'],
								'no_speedy'	=>  $_POST['no_speedy'],
								'kepemilikan'	=>  $_POST['relasi'],
								'facebook'	=>  $_POST['facebook'],
								'twitter'	=>  $_POST['twitter'],
								'email'	=>  $_POST['email'],
								'verfi_email'	=>  $_POST['otpemail'],
								'email_lain'	=>  $_POST['email_lainnya'],
								'handphone'	=>  $_POST['no_handpone'],
								'verfi_handphone'	=>  $_POST['otpphone'],
								'nama_pastel'	=>  $_POST['nama_pastel'],
								'alamat'	=>  $_POST['alamat'],
								'kota'	=>  $_POST['kota'],
								'kec_speedy'	=>  $_POST['kec_speedy'],
								'billing'	=>  $_POST['billing'],
								'payment'	=>  $_POST['payment'],
								'tgl_lahir'	=>  $_POST['waktu_psb'],
								'veri_call'	=>  $_POST['veri_call'],
								'veri_status'	=>  $_POST['veri_status'],
								'profiling_by'	=>  '100',
								'veri_keterangan'	=>  $_POST['keterangan'],
								'handphone_lain'	=>  $_POST['handphone_lainnya'],
								'click_session'	=>  $random_num,
								'veri_upd'	=>  $userdata->agentid,
								'veri_lup'	=>  $lup,
								'lup'	=>  $lup,
								'ip_address'	=>  $pc,
								'status'	=>  $status,
								'veri_system'	=>  $bysistem,
								'opsi_call'	=>  $_POST['opsi_call'],
								'veri_count'	=>  1
							);
							$this->infomedia->insert('trans_profiling', $data);
							$insert_id = $this->infomedia->insert_id();

							if (!isset($_POST['emailtambahan1'])) {
								$emailtambahan1 = "";
							} else {
								$emailtambahan1 = $_POST['emailtambahan1'];
							}
							if (!isset($_POST['emailtambahan2'])) {
								$emailtambahan2 = "";
							} else {
								$emailtambahan2 = $_POST['emailtambahan2'];
							}
							if (!isset($_POST['emailtambahan3'])) {
								$emailtambahan3 = "";
							} else {
								$emailtambahan3 = $_POST['emailtambahan3'];
							}
							if (!isset($_POST['hptambahan1'])) {
								$hptambahan1 = "";
							} else {
								$hptambahan1 = $_POST['hptambahan1'];
							}
							if (!isset($_POST['hptambahan2'])) {
								$hptambahan2 = "";
							} else {
								$hptambahan2 = $_POST['hptambahan2'];
							}
							if (!isset($_POST['hptambahan3'])) {
								$hptambahan3 = "";
							} else {
								$hptambahan3 = $_POST['hptambahan3'];
							}
							if ($insert_id != 0) {
								$data = array(
									'pstn1'	=>  $_POST['no_pstn'],
									'no_speedy' =>  $_POST['no_speedy'],
									'ncli'	=>  $_POST['ncli'],
									'nama'	=>  $_POST['nama_pelanggan'],
									'kepemilikan'	=>  $_POST['relasi'],
									'facebook'	=>  $_POST['facebook'],
									'twitter'	=>  $_POST['twitter'],
									'verfi_email'	=>  $_POST['otpemail'],
									'email'	=>  $_POST['email'],
									'handphone'	=>  $_POST['no_handpone'],
									'email_lain'	=>  $_POST['email_lainnya'],
									'verfi_handphone'	=>  $_POST['otpphone'],
									'nama_pastel'	=>  $_POST['nama_pastel'],
									'alamat'	=>  $_POST['alamat'],
									'kota'	=>  $_POST['kota'],
									'kec_speedy'	=>  $_POST['kec_speedy'],
									'billing'	=>  $_POST['billing'],
									'payment'	=>  $_POST['payment'],
									'waktu_psb'	=>  $_POST['waktu_psb'],
									'veri_call'	=>  $_POST['veri_call'],
									'veri_status'	=>  $_POST['veri_status'],
									'veri_keterangan'	=>  $_POST['keterangan'],
									'handphone_lain'	=>  $_POST['handphone_lainnya'],
									'idx'	=>  $insert_id,
									'email3'	=>  $emailtambahan1,
									'email4'	=>  $emailtambahan2,
									'email5'	=>  $emailtambahan3,
									'hp3'	=>  $hptambahan1,
									'hp4'	=> $hptambahan2,
									'hp5'	=>  $hptambahan3,
									'sumber'	=>  $_POST['sumber'],
									'jk'	=>  $_POST['jk'],
									'click_session'	=>  $random_num,
									'veri_upd'	=>  $userdata->agentid,
									'veri_lup'	=>  $lup,
									'lup'	=>  $lup,
									'ip_address'	=>  $pc,
									'status'	=>  $status,
									'veri_system'	=>  $bysistem,
									'profiling_by'	=>  '100',
									'opsi_call'	=>  $_POST['opsi_call'],
									'veri_count'	=>  1
								);
								$this->infomedia->insert('trans_profiling_detail', $data);
							}

							$sukses_simpan = 1;
							$onload = "Data verifikasi, Sukses disimpan";
						} else {
							$sukses_simpan = 3;
							$onload = "Data tidak bisa disimpan, Silahkan Ulangi kembali ( Silahkan hubungi IT )";
						}
					} elseif ($bysistem == 1) {
						$verfi_handphone = $_POST['otpphone'];
						$verfi_email = $_POST['otpemail'];

						//gak ada by sistem

						/*$query="INSERT INTO trans_profiling_verifikasi  (ncli,no_pstn,no_speedy,nama_pelanggan,relasi,no_handpone,status_handpone,email,status_email,nama_pastel,alamat,kota,regional,update_by,lup,is_last,sumber,twitter,status_twitter,facebook)
					VALUES
					('$ncli','$phone','$no_speedy','$nama','$kepemilikan','$handphone','$verfi_handphone','$email','$verfi_email','$nama_pastel','$alamat','$kota','$regional','$upd','$lup',0,0,'$twitter','$verfi_twitter','$facebook')";
					$result= mysql_unbuffered_query($query);*/
						// $onload = "Data verifikasi by system, Sukses disimpan";
						$onload = "alert('Data verifikasi by system, Sukses disimpan'. $setMos);";
					} else {
						$onload = "Kode Email/Handphone Tidak diisi, Verifikasi tidak sukses disimpan";
					}
				} else {
					$onload = "Data Not Verified berhasil disimpan";
				}

				//click_session mos di matikan karena untuk setiap status_cal 13 dan status 1 harus selalu insert ke trans_profilling
			} else {


				if ($_POST['veri_status'] != "3") {
					if ($_POST['nama_pelanggan'] != "" && $_POST['veri_status'] == "1" && $_POST['ncli'] != substr($_POST['ncli'], 0, 2)) {
						if ($_POST['otpemail'] != "" || $_POST['otpphone'] != "") {
							$setMos = $this->set_mos_to_telkom($_POST['ncli'], $_POST['no_speedy'], $_POST['nama_pelanggan'], $_POST['relasi'], $_POST['no_handpone'], $_POST['email'], $_POST['kota'], $_POST['facebook'],  $_POST['twitter']);

							if ($setMos == "Data Updated") {
								$data9 = array(
									'pstn1'	=>  $_POST['no_pstn'],
									'no_speedy' =>  $_POST['no_speedy'],
									'ncli'	=>  $_POST['ncli'],
									'nama'	=>  $_POST['nama_pelanggan'],
									'kepemilikan'	=>  $_POST['relasi'],
									'facebook'	=>  $_POST['facebook'],
									'twitter'	=>  $_POST['twitter'],
									'verfi_email'	=>  $_POST['otpemail'],
									'email'	=>  $_POST['email'],
									'veri_count' => $jml,
									'handphone'	=>  $_POST['no_handpone'],
									'email_lain'	=>  $_POST['email_lainnya'],
									'verfi_handphone'	=>  $_POST['otpphone'],
									'nama_pastel'	=>  $_POST['nama_pastel'],
									'alamat'	=>  $_POST['alamat'],
									'kota'	=>  $_POST['kota'],
									'kec_speedy'	=>  $_POST['kec_speedy'],
									'billing'	=>  $_POST['billing'],
									'payment'	=>  $_POST['payment'],
									'tgl_lahir'	=>  $_POST['waktu_psb'],
									'veri_call'	=>  $_POST['veri_call'],
									'veri_status'	=>  $_POST['veri_status'],
									'veri_keterangan'	=>  $_POST['keterangan'],
									'veri_upd'	=>  $userdata->agentid,
									'veri_lup'	=>  $lup,
									'lup'	=>  $lup,
									'ip_address'	=>  $pc,
									'status'	=>  $status,
									'opsi_call'	=>  $_POST['opsi_call'],
									'veri_system'	=> $bysistem
								);
								$this->infomedia->where('click_session', $_POST['click_session']);
								$this->infomedia->update('trans_profiling', $data9);
								if (!isset($_POST['emailtambahan1'])) {
									$emailtambahan1 = "";
								} else {
									$emailtambahan1 = $_POST['emailtambahan1'];
								}
								if (!isset($_POST['emailtambahan2'])) {
									$emailtambahan2 = "";
								} else {
									$emailtambahan2 = $_POST['emailtambahan2'];
								}
								if (!isset($_POST['emailtambahan3'])) {
									$emailtambahan3 = "";
								} else {
									$emailtambahan3 = $_POST['emailtambahan3'];
								}
								if (!isset($_POST['hptambahan1'])) {
									$hptambahan1 = "";
								} else {
									$hptambahan1 = $_POST['hptambahan1'];
								}
								if (!isset($_POST['hptambahan2'])) {
									$hptambahan2 = "";
								} else {
									$hptambahan2 = $_POST['hptambahan2'];
								}
								if (!isset($_POST['hptambahan3'])) {
									$hptambahan3 = "";
								} else {
									$hptambahan3 = $_POST['hptambahan3'];
								}

								$data95 = array(
									'pstn1'	=>  $_POST['no_pstn'],
									'no_speedy' =>  $_POST['no_speedy'],
									'ncli'	=>  $_POST['ncli'],
									'nama'	=>  $_POST['nama_pelanggan'],
									'kepemilikan'	=>  $_POST['relasi'],
									'facebook'	=>  $_POST['facebook'],
									'twitter'	=>  $_POST['twitter'],
									'verfi_email'	=>  $_POST['otpemail'],
									'email'	=>  $_POST['email'],
									'veri_count' => $jml,
									'handphone'	=>  $_POST['no_handpone'],
									'email_lain'	=>  $_POST['email_lainnya'],
									'verfi_handphone'	=>  $_POST['otpphone'],
									'nama_pastel'	=>  $_POST['nama_pastel'],
									'alamat'	=>  $_POST['alamat'],
									'kota'	=>  $_POST['kota'],
									'kec_speedy'	=>  $_POST['kec_speedy'],
									'billing'	=>  $_POST['billing'],
									'payment'	=>  $_POST['payment'],
									'waktu_psb'	=>  $_POST['waktu_psb'],
									'veri_call'	=>  $_POST['veri_call'],
									'veri_status'	=>  $_POST['veri_status'],
									'veri_keterangan'	=>  $_POST['keterangan'],
									'click_session'	=>  $_POST['click_session'],
									'handphone_lain'	=>  $_POST['handphone_lainnya'],
									'veri_upd'	=>  $userdata->agentid,
									'veri_lup'	=>  $lup,
									'lup'	=>  $lup,
									'ip_address'	=>  $pc,
									'status'	=>  $status,
									'veri_system'	=>  $bysistem,
									'opsi_call'	=>  $_POST['opsi_call']
								);

								$this->infomedia->where('click_session', $_POST['click_session']);
								$this->infomedia->update('trans_profiling_detail', $data95);
								$sukses_simpan = 1;
								$onload = "Data verifikasi by system, Sukses disimpan dan data MOS" . $setMos;
							} else {
								$sukses_simpan = 3;
								$onload = "Data tidak bisa disimpan, Silahkan Ulangi kembali ( Silahkan hubungi IT )";
							}
						} elseif ($bysistem == 1) {
							$verfi_handphone = $_POST['otpphone'];
							$verfi_email =  $_POST['otpemail'];
							/*$query="INSERT INTO trans_profiling_verifikasi  (ncli,no_pstn,no_speedy,nama_pelanggan,relasi,no_handpone,status_handpone,email,status_email,nama_pastel,alamat,kota,regional,update_by,lup,is_last,sumber,twitter,status_twitter,facebook)
								VALUES
								('$ncli','$phone','$no_speedy','$nama','$kepemilikan','$handphone','$verfi_handphone','$email','$verfi_email','$nama_pastel','$alamat','$kota','$regional','$upd','$lup',0,0,'$twitter','$verfi_twitter','$facebook')";
								  $result= mysql_unbuffered_query($query);*/
							$onload = "Data verifikasi by system, Sukses disimpan dan data MOS" . $setMos;
						} else {
							$onload = "Kode Email/Handphone Tidak diisi, Verifikasi tidak sukses disimpan";
						}
					}
				}
			}



			if ($sukses_simpan == 3) {
				$status = "4";
			} else {
				if (!isset($_POST['jenis_aktivasi'])) {
					$_POST['jenis_aktivasi'] = "pelanggan";
				}
				$data9 = array(
					'status'	=>  $_POST['veri_status'],
					'reason_call' =>  $_POST['veri_call'],
					'ncli'	=>  $_POST['ncli'],
					'no_pstn'	=>  $_POST['no_pstn'],
					'verfi_handphone'	=>  $_POST['otpphone'],
					'verfi_email'	=>  $_POST['otpemail'],
					'update_by'	=> $userdata->agentid,
					'lup'	=>  $lup,
					'no_handpone'	=>  $_POST['no_handpone'],
					'nama_pelanggan'	=>  $_POST['nama_pelanggan'],
					'email'	=>  $_POST['email'],
					'relasi'	=>  $_POST['relasi'],
					'kota'	=>  $_POST['kota'],
					'keterangan'	=>  $_POST['keterangan'],
					'produk_mos'	=>  $_POST['produk_moss'],
					'jenis_aktivasi'	=>  $_POST['jenis_aktivasi'],
					'click_time'	=>  $_POST['click_time']
				);
				$this->infomedia->where('idx', $_POST['idx']);
				$this->infomedia->update('trans_profiling_validasi_mos', $data9);
			}


			echo "<script>
				alert('" . $onload . "');	
				window.location = '" . base_url() . "Outbound/Outbound';
				</script>";
		} else {
			///////reguler/////

			if ($userdata->agentid != NULL) {
				// $today = date('Y-m-d') . " 00:00:01";
				// $vtoday = date('Y-m-d') . " 23:59:01";
				// 		$jumlah = $this->tmodel->live_query("SELECT COUNT(1) as jml FROM trans_profiling_verifikasi WHERE update_by='$userdata->agentid' 
				//  and lup BETWEEN '$today' AND '$vtoday'")->row();
				// 		$jmlh = $jumlah->jml;
				if ($_POST['otpphone']  == "") {
					$_POST['otpphone'] = $_POST['code_handphone'];
				}
				if ($_POST['otpemail']  == "") {
					$_POST['otpemail'] = $_POST['code_email'];
				}
				if ($click_session == "") {
					$data1 = array(
						'pstn1'	=>  $_POST['no_pstn'],
						'no_speedy' =>  $_POST['no_speedy'],
						'ncli'	=>  $_POST['ncli'],
						'nama'	=>  $_POST['nama_pelanggan'],
						'kepemilikan'	=>  $_POST['relasi'],
						'facebook'	=>  $_POST['facebook'],
						'twitter'	=>  $_POST['twitter'],
						'verfi_email'	=>  $_POST['otpemail'],
						'email'	=>  $_POST['email'],
						'handphone'	=>  $_POST['no_handpone'],
						'email_lain'	=>  $_POST['email_lainnya'],
						'verfi_handphone'	=>  $_POST['otpphone'],
						'nama_pastel'	=>  $_POST['nama_pastel'],
						'alamat'	=>  $_POST['alamat'],
						'kota'	=>  $_POST['kota'],
						'kec_speedy'	=>  $_POST['kec_speedy'],
						'billing'	=>  $_POST['billing'],
						'payment'	=>  $_POST['payment'],
						'waktu_psb'	=>  $_POST['waktu_psb'],
						'veri_call'	=>  $_POST['veri_call'],
						'veri_status'	=>  $_POST['veri_status'],
						'veri_keterangan'	=>  $_POST['keterangan'],
						'handphone_lain'	=>  $_POST['handphone_lainnya'],
						'click_session'	=>  $random_num,
						'veri_upd'	=>  $userdata->agentid,
						'veri_lup'	=>  $lup,
						'lup'	=>  $lup,
						'ip_address'	=>  $pc,
						'status'	=>  $status,
						'veri_system'	=>  $_POST['bysistem'],
						'veri_count'	=>  '1',
						'opsi_call'	=>  $_POST['opsi_call']

					);
					$this->infomedia->insert('trans_profiling', $data1);
					$insert_id = $this->infomedia->insert_id();

					if (!isset($_POST['emailtambahan1'])) {
						$emailtambahan1 = "";
					} else {
						$emailtambahan1 = $_POST['emailtambahan1'];
					}
					if (!isset($_POST['emailtambahan2'])) {
						$emailtambahan2 = "";
					} else {
						$emailtambahan2 = $_POST['emailtambahan2'];
					}
					if (!isset($_POST['emailtambahan3'])) {
						$emailtambahan3 = "";
					} else {
						$emailtambahan3 = $_POST['emailtambahan3'];
					}
					if (!isset($_POST['hptambahan1'])) {
						$hptambahan1 = "";
					} else {
						$hptambahan1 = $_POST['hptambahan1'];
					}
					if (!isset($_POST['hptambahan2'])) {
						$hptambahan2 = "";
					} else {
						$hptambahan2 = $_POST['hptambahan2'];
					}
					if (!isset($_POST['hptambahan3'])) {
						$hptambahan3 = "";
					} else {
						$hptambahan3 = $_POST['hptambahan3'];
					}
					if ($insert_id != 0) {
						$data11 = array(
							'pstn1'	=>  $_POST['no_pstn'],
							'no_speedy' =>  $_POST['no_speedy'],
							'ncli'	=>  $_POST['ncli'],
							'nama'	=>  $_POST['nama_pelanggan'],
							'kepemilikan'	=>  $_POST['relasi'],
							'facebook'	=>  $_POST['facebook'],
							'twitter'	=>  $_POST['twitter'],
							'verfi_email'	=>  $_POST['otpemail'],
							'email'	=>  $_POST['email'],
							'handphone'	=>  $_POST['no_handpone'],
							'email_lain'	=>  $_POST['email_lainnya'],
							'verfi_handphone'	=>  $_POST['otpphone'],
							'nama_pastel'	=>  $_POST['nama_pastel'],
							'alamat'	=>  $_POST['alamat'],
							'kota'	=>  $_POST['kota'],
							'kec_speedy'	=>  $_POST['kec_speedy'],
							'billing'	=>  $_POST['billing'],
							'payment'	=>  $_POST['payment'],
							'waktu_psb'	=>  $_POST['waktu_psb'],
							'veri_call'	=>  $_POST['veri_call'],
							'veri_status'	=>  $_POST['veri_status'],
							'veri_keterangan'	=>  $_POST['keterangan'],
							'handphone_lain'	=>  $_POST['handphone_lainnya'],
							'idx'	=>  $insert_id,
							'email3'	=>  $emailtambahan1,
							'email4'	=>  $emailtambahan2,
							'email5'	=>  $emailtambahan3,
							'hp3'	=>  $hptambahan1,
							'hp4'	=> $hptambahan2,
							'hp5'	=>  $hptambahan3,
							'sumber'	=>  $_POST['sumber'],
							'jk'	=>  $_POST['jk'],
							'click_session'	=>  $random_num,
							'veri_upd'	=>  $userdata->agentid,
							'veri_lup'	=>  $lup,
							'lup'	=>  $lup,
							'ip_address'	=>  $pc,
							'status'	=>  $status,
							'veri_system'	=>  $_POST['bysistem'],
							'veri_count'	=> '1',
							'opsi_call'	=>  $_POST['opsi_call']
						);
						$this->infomedia->insert('trans_profiling_detail', $data11);
						$onload = "Data Not Verified, Sukses disimpan";
					}



					if ($_POST['nama_pelanggan'] != "" && $_POST['veri_status'] == 1 &&  $_POST['veri_call'] == 13 &&  $_POST['ncli'] != substr($_POST['ncli'], 0, 2)) {
						if ($_POST['otpemail'] != "" || $_POST['otpphone'] != "") {

							$data1 = array(
								'no_pstn'	=>  $_POST['no_pstn'],
								'no_speedy' =>  $_POST['no_speedy'],
								'ncli'	=>  $_POST['ncli'],
								'nama_pelanggan'	=>  $_POST['nama_pelanggan'],
								'relasi'	=>  $_POST['relasi'],
								'status_handpone'	=>  $_POST['otpphone'],
								'no_handpone'	=>  $_POST['no_handpone'],
								'email'	=>  $_POST['email'],
								'status_email'	=>  $_POST['otpemail'],
								'facebook'	=>  $_POST['facebook'],
								'twitter'	=>  $_POST['twitter'],
								'nama_pastel'	=>  $_POST['nama_pastel'],
								'alamat'	=>  $_POST['alamat'],
								'kota'	=>  $_POST['kota'],
								'regional'	=>  $_POST['regional'],
								'update_by'	=>  $userdata->agentid,
								'lup'	=>  $lup,
								'is_last'	=>  '0',
								'sumber'	=>  '0'

							);
							$this->infomedia->insert('trans_profiling_verifikasi', $data1);
							$onload = "Data verifikasi, Sukses disimpan";
						} elseif ($_POST['bysistem'] == 1) {
							$verfi_handphone = $_POST['code_handphone'];
							$verfi_email = $_POST['code_email'];
							$data1 = array(
								'no_pstn'	=>  $_POST['no_pstn'],
								'no_speedy' =>  $_POST['no_speedy'],
								'ncli'	=>  $_POST['ncli'],
								'nama_pelanggan'	=>  $_POST['nama_pelanggan'],
								'relasi'	=>  $_POST['relasi'],
								'status_handpone'	=>  $verfi_handphone,
								'no_handpone'	=>  $_POST['no_handpone'],
								'email'	=>  $_POST['email'],
								'status_email'	=>  $verfi_email,
								'facebook'	=>  $_POST['facebook'],
								'twitter'	=>  $_POST['twitter'],
								'nama_pastel'	=>  $_POST['nama_pastel'],
								'alamat'	=>  $_POST['alamat'],
								'kota'	=>  $_POST['kota'],
								'regional'	=>  $_POST['regional'],
								'update_by'	=>  $userdata->agentid,
								'lup'	=>  $lup,
								'is_last'	=>  '0',
								'sumber'	=>  '0'
							);
							$this->infomedia->insert('trans_profiling_verifikasi', $data1);
							$onload = "Data verifikasi by system, Sukses disimpan";
						} else {
							$onload = "Kode Email/Handphone Tidak diisi, Verifikasi tidak sukses disimpan";
						}
					}
				} else {
					if ($_POST['otpphone']  == "") {
						$_POST['otpphone'] = $_POST['code_handphone'];
					}
					if ($_POST['otpemail']  == "") {
						$_POST['otpemail'] = $_POST['code_email'];
					}
					$data1 = array(
						'pstn1'	=>  $_POST['no_pstn'],
						'no_speedy' =>  $_POST['no_speedy'],
						'ncli'	=>  $_POST['ncli'],
						'nama'	=>  $_POST['nama_pelanggan'],
						'kepemilikan'	=>  $_POST['relasi'],
						'facebook'	=>  $_POST['facebook'],
						'twitter'	=>  $_POST['twitter'],
						'verfi_email'	=>  $_POST['otpemail'],
						'email'	=>  $_POST['email'],
						'veri_count' => 0,
						'handphone'	=>  $_POST['no_handpone'],
						'email_lain'	=>  $_POST['email_lainnya'],
						'verfi_handphone'	=>  $_POST['otpphone'],
						'nama_pastel'	=>  $_POST['nama_pastel'],
						'alamat'	=>  $_POST['alamat'],
						'kota'	=>  $_POST['kota'],
						'kec_speedy'	=>  $_POST['kec_speedy'],
						'billing'	=>  $_POST['billing'],
						'payment'	=>  $_POST['payment'],
						'waktu_psb'	=>  $_POST['waktu_psb'],
						'veri_call'	=>  $_POST['veri_call'],
						'veri_status'	=>  $_POST['veri_status'],
						'veri_keterangan'	=>  $_POST['keterangan'],
						'handphone_lain'	=>  $_POST['handphone_lainnya'],
						'veri_upd'	=>  $userdata->agentid,
						'veri_lup'	=>  $lup,
						'lup'	=>  $lup,
						'ip_address'	=>  $pc,
						'status'	=>  $status,
						'veri_system'	=>  $_POST['bysistem'],
						'opsi_call'	=>  $_POST['opsi_call']
					);
					$this->infomedia->where('click_session', $_POST['click_session']);
					$this->infomedia->update('trans_profiling', $data1);

					if (!isset($_POST['emailtambahan1'])) {
						$emailtambahan1 = "";
					} else {
						$emailtambahan1 = $_POST['emailtambahan1'];
					}
					if (!isset($_POST['emailtambahan2'])) {
						$emailtambahan2 = "";
					} else {
						$emailtambahan2 = $_POST['emailtambahan2'];
					}
					if (!isset($_POST['emailtambahan3'])) {
						$emailtambahan3 = "";
					} else {
						$emailtambahan3 = $_POST['emailtambahan3'];
					}
					if (!isset($_POST['hptambahan1'])) {
						$hptambahan1 = "";
					} else {
						$hptambahan1 = $_POST['hptambahan1'];
					}
					if (!isset($_POST['hptambahan2'])) {
						$hptambahan2 = "";
					} else {
						$hptambahan2 = $_POST['hptambahan2'];
					}
					if (!isset($_POST['hptambahan3'])) {
						$hptambahan3 = "";
					} else {
						$hptambahan3 = $_POST['hptambahan3'];
					}

					$data11 = array(
						'pstn1'	=>  $_POST['no_pstn'],
						'no_speedy' =>  $_POST['no_speedy'],
						'ncli'	=>  $_POST['ncli'],
						'nama'	=>  $_POST['nama_pelanggan'],
						'kepemilikan'	=>  $_POST['relasi'],
						'facebook'	=>  $_POST['facebook'],
						'twitter'	=>  $_POST['twitter'],
						'verfi_email'	=>  $_POST['otpemail'],
						'email'	=>  $_POST['email'],
						'veri_count' => 0,
						'handphone'	=>  $_POST['no_handpone'],
						'email_lain'	=>  $_POST['email_lainnya'],
						'verfi_handphone'	=>  $_POST['otpphone'],
						'nama_pastel'	=>  $_POST['nama_pastel'],
						'alamat'	=>  $_POST['alamat'],
						'kota'	=>  $_POST['kota'],
						'kec_speedy'	=>  $_POST['kec_speedy'],
						'billing'	=>  $_POST['billing'],
						'payment'	=>  $_POST['payment'],
						'waktu_psb'	=>  $_POST['waktu_psb'],
						'veri_call'	=>  $_POST['veri_call'],
						'veri_status'	=>  $_POST['veri_status'],
						'veri_keterangan'	=>  $_POST['keterangan'],
						'handphone_lain'	=>  $_POST['handphone_lainnya'],
						'veri_upd'	=>  $userdata->agentid,
						'veri_lup'	=>  $lup,
						'lup'	=>  $lup,
						'ip_address'	=>  $pc,
						'status'	=>  $status,
						'veri_system'	=>  $_POST['bysistem'],
						'opsi_call'	=>  $_POST['opsi_call'],
						'email3'	=>  $emailtambahan1,
						'email4'	=>  $emailtambahan2,
						'email5'	=>  $emailtambahan3,
						'hp3'	=>  $hptambahan1,
						'hp4'	=> $hptambahan2,
						'hp5'	=>  $hptambahan3,
						'sumber'	=>  $_POST['sumber'],
						'jk'	=>  $_POST['jk']
					);
					$this->infomedia->where('click_session',  $_POST['click_session']);
					$this->infomedia->update('trans_profiling_detail', $data11);
					if ($_POST['veri_status'] != 3) {
						if ($_POST['nama_pelanggan'] != "" && $_POST['veri_status'] == "1" && $_POST['ncli'] != substr($_POST['ncli'], 0, 2)) {
							if ($_POST['otpemail'] != "" || $_POST['otpphone'] != "") {
								$data1 = array(
									'no_pstn'	=>  $_POST['no_pstn'],
									'no_speedy' =>  $_POST['no_speedy'],
									'ncli'	=>  $_POST['ncli'],
									'nama_pelanggan'	=>  $_POST['nama_pelanggan'],
									'relasi'	=>  $_POST['relasi'],
									'status_handpone'	=>  $_POST['otpphone'],
									'no_handpone'	=>  $_POST['no_handpone'],
									'email'	=>  $_POST['email'],
									'status_email'	=>  $_POST['otpemail'],
									'facebook'	=>  $_POST['facebook'],
									'twitter'	=>  $_POST['twitter'],
									'nama_pastel'	=>  $_POST['nama_pastel'],
									'alamat'	=>  $_POST['alamat'],
									'kota'	=>  $_POST['kota'],
									'regional'	=>  $_POST['regional'],
									'update_by'	=>  $userdata->agentid,
									'lup'	=>  $lup,
									'is_last'	=>  '0',
									'sumber'	=>  '0'

								);
								$this->infomedia->insert('trans_profiling_verifikasi', $data1);
								$onload = "Data verifikasi, Sukses disimpan";
							} elseif ($_POST['bysistem'] == 1) {
								$verfi_handphone = $_POST['code_handphone'];
								$verfi_email = $_POST['code_email'];
								$data1 = array(
									'no_pstn'	=>  $_POST['no_pstn'],
									'no_speedy' =>  $_POST['no_speedy'],
									'ncli'	=>  $_POST['ncli'],
									'nama_pelanggan'	=>  $_POST['nama_pelanggan'],
									'relasi'	=>  $_POST['relasi'],
									'status_handpone'	=>  $verfi_handphone,
									'no_handpone'	=>  $_POST['no_handpone'],
									'email'	=>  $_POST['email'],
									'status_email'	=>  $verfi_email,
									'facebook'	=>  $_POST['facebook'],
									'twitter'	=>  $_POST['twitter'],
									'nama_pastel'	=>  $_POST['nama_pastel'],
									'alamat'	=>  $_POST['alamat'],
									'kota'	=>  $_POST['kota'],
									'regional'	=>  $_POST['regional'],
									'update_by'	=>  $userdata->agentid,
									'lup'	=>  $lup,
									'verified'	=>  '1',
									'is_last'	=>  '0',
									'sumber'	=>  '0'

								);
								$this->infomedia->insert('trans_profiling_verifikasi', $data1);
								$onload = "Data verifikasi by Sistem, Sukses disimpan";
							} else {
								$onload = "Kode Email/Handphone Tidak diisi, Verifikasi tidak sukses disimpan";
							}
						}
					}
				}

				$dataupdate = array(
					'status'	=>  $_POST['veri_status'],
					'lup' => $lup,
					'no_handpone' => $_POST['no_handpone'],
					'nama_pelanggan' => $_POST['nama_pelanggan'],
					'email' => $_POST['email'],
					'keterangan' => $_POST['keterangan']
				);

				$this->infomedia->where('update_by', $userdata->agentid);

				if ($_GET['phone'] == "") {
					$dataupdate['no_pstn'] = $_POST['no_pstn'];
					$this->infomedia->where('no_speedy', $_POST['no_speedy']);
				} else {
					$this->infomedia->where('no_pstn', $_GET['phone']);
				}

				// $this->infomedia->where("(no_pstn = '$no_pstn' OR no_speedy = '$no_speedy')");
				$this->infomedia->update('dbprofile_validate_forcall_3p', $dataupdate);
				$this->handletimeu($userdata->agentid);

				echo "<script>
				alert('" . $onload . "');
				window.close();
				</script>";
			}
		}
	}

	// function set_mos_to_telkom($ncli, $nd, $nama, $relasi, $hp, $email, $kota, $facebook, $twitter)
	function set_mos_to_telkom($ncli, $nd, $nama, $relasi, $hp, $email, $kota, $facebook, $twitter)
	{
		//ini_set('default_socket_timeout', 600);
		$client     = new SoapClient("http://servicebussit.telkom.co.id:9001/TelkomSystem/DWH/Services/ProxyService/insertVerifiedProfile?wsdl");

		try {
			$val = array();
			$input = array("P_NCLI" => $ncli, "P_ND" => $nd, "P_NAMA" => $nama, "P_RELASI" => $relasi, "P_HP" => $hp, "P_EMAIL" => $email, "P_SUMBER" => "INFOMEDIA_MOS", "CALL" => "INFOMEDIA", "P_KOTA" => $kota, "P_FB" => $facebook, "P_TWITTER" => $twitter);
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
		$phone   = $this->input->get('phone');
		$ncli   = $this->input->get('ncli');
		$no_handpone   = $this->input->get('no_handpone');
		$no_speedy   = $this->input->get('no_speedy');

		// $data['agent'] = $this->tmodel->live_query('SELECT * FROM Form_caring')->result_array();
		// $data['agentcount'] = $this->tmodel->live_query('SELECT COUNT(*) FROM Form_caring');
		if ($userdata->kategori == "MOS") {

			$idx  = $this->input->get('idx');
			$data['idx']  = $this->input->get('idx');
			$hp = '';
			$data['ucapan'] = $this->db->query("SELECT * FROM t_script where status = 'aktif'")->row();
			$data['produk_moss'] = $this->db->query("SELECT * FROM t_produk_moss")->result();
			$data['datanya'] = $this->tmodel->live_query("CALL sp_get_notel_mos('$phone','$idx','$hp')")->row();
			// var_dump($data['datanya']);
			$this->template->load('Outbound/Form_outbound', $data);
		} else {
			$today = date('Y-m-d') . " 00:00:01";
			$vtoday = date('Y-m-d') . " 23:59:01";
			$data['ucapan'] = $this->db->query("SELECT * FROM t_script where status = 'aktif'")->row();
			$data['produk_moss'] = $this->db->query("SELECT * FROM t_produk_moss")->result();
			$data['datahc'] = $this->tmodel->live_query("SELECT * FROM trans_profiling_verifikasi where ncli='$ncli' and no_pstn='$phone'");
			$data['verifagnt'] = $this->tmodel->live_query("SELECT COUNT(1) as jml FROM trans_profiling_verifikasi WHERE update_by='$userdata->agentid' and lup BETWEEN '$today' AND '$vtoday'")->row();
			$data['datanya'] = $this->tmodel->live_query("CALL sp_get_notel_reguler('$phone','$userdata->agentid','$ncli')")->row();
			if (!$data['datanya']) {
				echo "<script>
				alert('maaf, data tidak tersedia');
				window.close();
				</script>";
			}
			if ($data['datanya']->status == 1) {
				echo "<script>
				alert('data yang anda pilih sudah verified');
				window.close();
				</script>";
			}
			// var_dump($data['datanya']);
			$this->template->load('Outbound/Form_outbound', $data);
		}
	}
};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-02-07 09:33:58 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/