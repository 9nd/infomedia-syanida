<?php
require APPPATH . '/controllers/Sys_user_detail/Sys_user_detail_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');



class Sys_user_detail extends CI_Controller
{

	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Sys_user_detail/Sys_user_detail_model', 'tmodel');
		$this->log_key = 'log_Sys_user_detail';
		$this->load->model('Custom_model/T_absensi_model', 't_absensi');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('Custom_model/Shift_moss_model', 'shift_moss');
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->title = new Sys_user_detail_config();
	}


	public function index()
	{
		$data = array(
			'title_page_big'		=> 'DAFTAR',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'Sys_user_detail/Sys_user_detail/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'Sys_user_detail/Sys_user_detail/create',
			'link_update'			=> site_url() . 'Sys_user_detail/Sys_user_detail/update',
			'link_delete'			=> site_url() . 'Sys_user_detail/Sys_user_detail/delete_multiple',
		);
		$data['agent'] = $this->tmodel->live_query('SELECT * FROM sys_user_detail')->result_array();
		$data['agentcount'] = $this->tmodel->live_query('SELECT COUNT(*) FROM sys_user_detail');
		$this->template->load('Sys_user_detail/Sys_user_detail_list', $data);
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
			'link_save'				=> site_url() . 'Sys_user_detail/Sys_user_detail/create_action',
			'link_back'				=> $this->agent->referrer(),
		);

		$this->template->load('Sys_user_detail/Sys_user_detail_form', $data);
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
		if (!$o->not_empty($val['agentid'], '#agentid')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('agentid' => $val['agentid']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#agentid')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['no_ktp'], '#no_ktp')) {
			echo $o->result();
			return;
		}



		unset($val['id']);
		$success = $this->tmodel->insert($val);
		echo $o->auto_result($success);
	}

	public function update($id)
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

		$row = $this->tmodel->get_by_id($id);
		//echo var_dump($row);
		if ($row) {
			$data = array(
				'title_page_big'		=> 'Edit',
				'title'					=> $this->title,
				'link_save'				=> site_url() . 'Sys_user_detail/Sys_user_detail/update_action',
				'link_back'				=> $this->agent->referrer(),
				'data'					=> $row,
				'id'					=> $id,
			);

			$this->template->load('Sys_user_detail/Sys_user_detail_form', $data);
		} else {
			redirect($this->agent->referrer());
		}
	}

	public function detail()
	{
		$idlogin = $this->session->userdata('idlogin');
		$data['logindata'] = $this->log_login->get_by_id($idlogin);
		$agentid = $data['logindata']->agentid;
		if (!isset($id)) {
			$agents = $this->db->query("SELECT * FROM sys_user_detail")->row()->id;
			$agentid = $this->db->query("SELECT * FROM sys_user_detail")->row()->agentid;
			$id = $agents;
		}
		$id = $_GET['id'];
		$row = $this->tmodel->get_by_id($id);

		if ($row) {
			$data = array(
				'title_page_big'		=> 'Edit',
				'title'					=> $this->title,
				'link_back'				=> $this->agent->referrer(),
				'data'					=> $row,
				'id'					=> $id,
			);

			$data['controller'] = $this;
			$data['hadir'] = $this->hadir($agentid);

			// $data['telat'] = $this;
			// $data['absen'] = $this;
			// $data['sakit'] = $this;
			$this->template->load('Sys_user_detail/Sys_user_detail_detail', $data);
		} else {
			redirect($this->agent->referrer());
		}
	}


	public function hadir($agentid)
	{
		$hadir = $this->db->query("SELECT distinct(date(waktu_in)), YEAR(waktu_in) tahun,DATE(waktu_in) waktu, month(waktu_in) as bulan, DAY(waktu_in) AS hari,  COUNT(distinct(DATE(waktu_in))) as jml FROM t_absensi WHERE stts='in' AND agentid='$agentid' GROUP BY waktu");
		$datanya = $hadir->result();
		foreach ($datanya as $datasaja) {
			$hari = $datasaja->hari;
			if ($hari <= 15) {
				$startbln = $datasaja->bulan - 1;
				$endbln = $datasaja->bulan;
			} else {
				$startbln = $datasaja->bulan;
				$endbln = $datasaja->bulan + 1;
			}
			$startdate = $datasaja->tahun . "-" . $startbln . "-" . 16;
			$startnew = date("Y-m-d", strtotime($startdate));
			$enddate = $datasaja->tahun . "-" . $endbln . "-" . 15;
			$endnew = date("Y-m-d", strtotime($enddate));
			// $startdates = date_format($startdate,"Y-m-d");
			// $enddates = date_format($enddate,"Y-m-d");

			$sakit = $this->db->query("
				SELECT
	count(*) AS jmlh,
	date( waktu_in ) AS waktu 
FROM
	t_absensi 
WHERE
	stts = 'sakit' 
	AND DATE( waktu_in ) BETWEEN '$startnew' AND '$enddate' AND agentid = '$agentid' 
GROUP BY
	waktu
				")->row();
			if (isset($sakit->jmlh)) {
				$jmlhsakit = $sakit->jmlh;
			} else {
				$jmlhsakit = 0;
			}
			if (($startnew <= $datasaja->waktu) && ($endnew >= $datasaja->waktu)) {
				$hadirbln['sakit'][$startnew . "|" . $endnew] = 0;
				if (isset($hadirbln['sakit'][$startnew . "|" . $endnew])) {
					$hadirbln['sakit'][$startnew . "|" . $endnew] = $hadirbln['sakit'][$startnew . "|" . $endnew] + $jmlhsakit;
				}
			}
		}
		foreach ($datanya as $datasaja) {
			$hari = $datasaja->hari;
			if ($hari <= 15) {
				$startbln = $datasaja->bulan - 1;
				$endbln = $datasaja->bulan;
			} else {
				$startbln = $datasaja->bulan;
				$endbln = $datasaja->bulan + 1;
			}
			$startdate = $datasaja->tahun . "-" . $startbln . "-" . 16;
			$startnew = date("Y-m-d", strtotime($startdate));
			$enddate = $datasaja->tahun . "-" . $endbln . "-" . 15;
			$endnew = date("Y-m-d", strtotime($enddate));
			// $startdates = date_format($startdate,"Y-m-d");
			// $enddates = date_format($enddate,"Y-m-d");
			if (($startnew <= $datasaja->waktu) && ($endnew >= $datasaja->waktu)) {
				if (isset($hadirbln['hadir'][$startnew . "|" . $endnew])) {
					$hadirbln['hadir'][$startnew . "|" . $endnew] = $hadirbln['hadir'][$startnew . "|" . $endnew] + 1;
				} else {
					$hadirbln['hadir'][$startnew . "|" . $endnew] = 0;
				}
				$hadirbln['absen'][$startnew . "|" . $endnew] = 22 - $hadirbln['hadir'][$startnew . "|" . $endnew];
				if ($hadirbln['absen'][$startnew . "|" . $endnew] < 0) {
					$hadirbln['absen'][$startnew . "|" . $endnew] = 0;
				}
			}
		}
		foreach ($datanya as $datasaja) {
			$hari = $datasaja->hari;
			if ($hari <= 15) {
				$startbln = $datasaja->bulan - 1;
				$endbln = $datasaja->bulan;
			} else {
				$startbln = $datasaja->bulan;
				$endbln = $datasaja->bulan + 1;
			}
			$startdate = $datasaja->tahun . "-" . $startbln . "-" . 16;
			$startnew = date("Y-m-d", strtotime($startdate));
			$enddate = $datasaja->tahun . "-" . $endbln . "-" . 15;
			$endnew = date("Y-m-d", strtotime($enddate));

			$reg = $this->db->query("SELECT agentid_mos, nik_absensi FROM sys_user WHERE agentid='$agentid'")->row();

			if (($startnew <= $datasaja->waktu) && ($endnew >= $datasaja->waktu)) {
				$cthadir = count($datanya);
				if ($cthadir > 0) {
					$data_in = $this->t_absensi->get_row(array("date(waktu_in)" => $datasaja->waktu, "stts" => 'in', "nik" => $reg->nik_absensi), array("*,time(waktu_in) as waktu_masuk"), array("waktu_in" => "ASC"));
					$to_time = strtotime($datasaja->waktu . " " . $data_in->waktu_masuk);
					$from_time = strtotime($datasaja->waktu . " 08:01:00");
					$durasi = $to_time - $from_time;
					$late = round(abs($to_time - $from_time) / 60, 2);
					$hadirbln['late'][$startnew . "|" . $endnew] = 0;
					if ($durasi > 0) {
						$hadirbln['late'][$startnew . "|" . $endnew] = $hadirbln['late'][$startnew . "|" . $endnew] + $late;
					} else {
						$hadirbln['late'][$startnew . "|" . $endnew] = 0;
					}
				}
			}
			// }
		}
		return $hadirbln;
		// return $sakit;
	}


	public function viewpayroll()
	{
		$idlogin = $this->session->userdata('idlogin');
		$data['logindata'] = $this->log_login->get_by_id($idlogin);
		$logindata = $data['logindata']->agentid;
		$data['id'] = $_GET['id'];
		$data['controller'] = $this;

		$this->template->load('Sys_user_detail/sys_user-detail_payslip', $data);
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


		$success = $this->tmodel->update($val['id'], $val);
		echo $o->auto_result($success);
	}

	public function delete_multiple($id)
	{
		// $data=$this->input->get('data_ajax',true);
		// $val=json_decode($data,true);
		//	$data = explode(',',$val['data_delete']);

		// //get key generate
		// $log_id = $this->session->userdata($this->log_key);
		// $xx=0;
		// foreach($data as $value){
		// 	$value =  _decode_id($value,$log_id);
		// 	//menganti ke id asli
		// 	$data[$xx] = $value;
		// 	$xx++;	
		// }
		echo var_dump($id);
		echo "<br>";
		$data = $id;
		// echo var_dump($data);
		$success = $this->tmodel->delete_multiple($data);

		$o = new Outputview();

		// //create message
		if ($success) {
			$o->success 	= 'true';
			$o->message	= 'Data berhasil di hapus !';
			redirect(site_url() . "Sys_user_detail/Sys_user_detail/");
		} else {
			$o->success 	= 'false';
			$o->message	= 'Opps..Gagal menghapus data !!';
			redirect(site_url() . "Sys_user_detail/Sys_user_detail/");
		}


		echo $o->result();
	}
};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-02-07 09:33:58 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
