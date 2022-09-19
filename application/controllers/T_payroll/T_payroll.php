<?php
require APPPATH . '/controllers/T_payroll/T_payroll_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class T_payroll extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('T_payroll/T_payroll_model', 'tmodel');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->log_key = 'log_T_payroll';
		$this->title = new T_payroll_config();
	}


	public function index()
	{
		$data = array(
			'title_page_big'		=> 'Penggajian Profiling',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'T_payroll/T_payroll/refresh_table/' . $this->_token,
			'link_generate'			=> site_url() . 'T_payroll/T_payroll/generate_form',
			'link_upload'			=> site_url() . 'T_payroll/T_payroll/upload',
			'link_delete'			=> site_url() . 'T_payroll/T_payroll/delete_multiple',
		);
		$data['periode'] = $this->db->query("SELECT *, sum(total_thp) as total FROM t_payroll GROUP BY periode");
		$data['controller'] = $this;

		$this->template->load('T_payroll/T_payroll_list', $data);
	}

	public function kalkulasi_tambahan()
	{
		$hadir = $_POST['hadir'];
		$jml_verified = $_POST['jml_verified'];
		$jml_contacted = $_POST['jml_contacted'];
		$jml_hpemail = $_POST['jml_hpemail'];
		$jmlhp = $_POST['jmlhp'];
		$tbh_jml_hpemail = $_POST['tbh_jml_hpemail'];
		$tbh_tl = $_POST['tbh_tl'];
		$tbh_ver = $_POST['tbh_ver'];
		$agentid = $_POST['agentid'];

		$tenur = $this->tenur();
		$akomodasi = $this->akomodasi();
		


		$ihkasdf = 22;
		$hkagentihkasdf = $ihkasdf / $hadir;

		$ctc = $jml_contacted;
		if ($ctc >= 1) {
			$sc_cont = 100;
		} else if ($ctc >= 0.8) {
			$sc_cont = 80;
		} else if ($ctc >= 0.6) {
			$sc_cont = 60;
		} else if ($ctc >= 0.4) {
			$sc_cont = 30;
		} else {
			$sc_cont = 0;
		}
		$asc_cont = $sc_cont * 30 / 100;

		$ctv = $jml_verified  + $tbh_ver;
		if ($ctv < 0.5) {
			$sc_ver = 0;
		} else if ($ctv < 0.75) {
			$sc_ver = 50;
		} else if ($ctv < 0.9) {
			$sc_ver = 75;
		} else if ($ctv < 1) {
			$sc_ver = 90;
		} else {
			$sc_ver = 100;
		}
		$asc_ver = $sc_ver * 50 / 100;



		$pendidikana = $tenur[$agentid]['pendidikan'];
		if ($pendidikana == "S1") {
			$sc_pendidikan = 100;
		} else if ($pendidikana == "D3") {
			$sc_pendidikan = 80;
		} else if ($pendidikana == "D1") {
			$sc_pendidikan = 60;
		} else if ($pendidikana == "SMU" || $pendidikana == "SMA") {
			$sc_pendidikan = 40;
		} else {
			$sc_pendidikan = 0;
		}
		$asc_pendidikan = $sc_pendidikan * 5 / 100;

		$tenura = $tenur[$agentid]['tenur'];
		if ($tenura < 3) {
			$sc_tenur = 40;
		} else if ($tenura < 6) {
			$sc_tenur = 60;
		} else if ($tenura < 12) {
			$sc_tenur = 80;
		} else if ($tenura > 12) {
			$sc_tenur = 100;
		} else {
			$sc_tenur = 0;
		}
		$asc_tenur = $sc_tenur * 5 / 100;

		$tot_score = $asc_cont + $asc_ver + $asc_tenur + $asc_pendidikan;


		if ($tot_score < 30) {
			$level = "Pemula";
		} else if ($tot_score < 50) {
			$level = "Junior";
		} else if ($tot_score < 80) {
			$level = "Madya";
		} else {
			$level = "Senior";
		}

		$sakomodasi = $akomodasi[$level]['akomodasi'];
		if ($hkagentihkasdf >= 1) {
			$sakomodasi = $sakomodasi;
		} else {
			$sakomodasi = $hkagentihkasdf * $sakomodasi;
		}

		$ttransport = $akomodasi[$level]['tunjangan_transport'] * $hkagentihkasdf;
		$komisiong = $akomodasi[$level]['komisi'] * $hkagentihkasdf['r_contcs']['achievementc'];

		if ($ctv > 1) {
			$tunjanganlevel = $akomodasi[$level]['tunjangan_level'] + $tbh_tl;
		} else {
			$tunjanganlevel = ($akomodasi[$level]['tunjangan_level'] * $ctv) + $tbh_tl;
		}


		$thpleveling = $sakomodasi + $ttransport + $komisiong + $tunjanganlevel + $akomodasi[$level]['tunjangan_jabatan'];

		$hpemails = $jml_hpemail + $tbh_jml_hpemail;
		$kelebihanhpemail = ($ihkasdf * 95) - $ctv;
		if ($kelebihanhpemail > 0 && $hpemails >= $kelebihanhpemail) {
			$kelebihanhpemail = $kelebihanhpemail;
			$rupiah = $kelebihanhpemail * 5000;
		} else {
			$kelebihanhpemail = 0;
			$rupiah = 0;
		}


		$tottahp = $thpleveling + $akomodasi[$level]['tunjangan_skill'] + $rupiah;
		$headcount = $tottahp + $akomodasi[$level]['tunjangan_skill'] + $akomodasi[$level]['non_thp'] + $akomodasi[$level]['benefit_lain'] + $akomodasi[$level]['m_fee'];

		echo json_encode(array(
			'kehadiran' => number_format($hkagentihkasdf, 2),
			'contacted' => number_format($asc_cont, 2),
			'verified' => number_format($asc_ver, 2),
			'tenur' => $tenura,
			'pendidikan' => $pendidikana,
			'foreign' => 0,
			's_contacted' => $asc_cont,
			's_verified' => $asc_ver,
			's_tenur' => $asc_tenur,
			's_reward' => 0,
			's_pendidikan' => $asc_pendidikan,
			'score' => $tot_score,
			'level' => $level,
			't_trasnport' => $ttransport,
			'komisi' => $komisiong,
			'tunj_level' => $tunjanganlevel,
			'ot_moss' => 0,
			'other_fee' => 0,
			'tunj_skill' => $akomodasi[$level]['tunjangan_skill'],
			'perbantuan_hpemail' => 0, //cek
			'perbantuan_hponly' => 0, //cek
			'nominal_perbantuan' => $rupiah,
			'total_thp' => $tottahp,
			'non_thp' => $akomodasi[$level]['non_thp'],
			'benefit_lain' => $akomodasi[$level]['benefit_lain'],
			'm_fee' => $akomodasi[$level]['m_fee'],
			'headcount' => $headcount,
			'jml_verified' => $ctv,
			'jml_contacted' => $jml_contacted,
			'jml_hpemail' => $hpemails,
			'jml_hp' => $jmlhp,
			'tbh_jml_hpemail' => $tbh_jml_hpemail,
			'tbh_tl' => $tbh_tl,
			'tbh_ver' => $tbh_ver
		));
	}

	public function generate_form()
	{
		$data = array(
			'title_page_big'		=> 'Penggajian Profiling',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'T_payroll/T_payroll/refresh_table/' . $this->_token,
			'link_generate'			=> site_url() . 'T_payroll/T_payroll/generate',
			'link_upload'			=> site_url() . 'T_payroll/T_payroll/upload',
			'link_delete'			=> site_url() . 'T_payroll/T_payroll/delete_multiple',
		);
		$data['periode'] = $this->db->query("SELECT *, sum(total_thp) as total FROM t_payroll GROUP BY periode");
		$data['controller'] = $this;

		$this->template->load('T_payroll/generate_form', $data);
	}

	public function detail()
	{
		$periode = $_GET['periode'];

		$data = array(
			'title_page_big'		=> 'Edit',
			'title'					=> $this->title,
		);
		$data['t_payroll'] = $this->db->query("SELECT * FROM t_payroll WHERE periode='$periode'");
		$data['periode'] = $periode;
		$data['controller'] = $this;

		$this->template->load('T_payroll/detail_table', $data);
	}
	public function edit()
	{
		$id = $_GET['id'];

		$data = array(
			'title_page_big'		=> 'Detail Profiling Periode',
			'title'					=> $this->title,
		);
		$data['t_payroll'] = $this->db->query("SELECT * FROM t_payroll WHERE id='$id'")->row();
		$data['controller'] = $this;

		$this->template->load('T_payroll/edit_payroll', $data);
	}

	public function get_data_list()
	{
		// $periode = $_GET['periode'];
		$start_periode = $_GET['start'];
		$end_periode = $_GET['end'];

		$data = array();


		///hk
		$hk = $this->db->query("
    select t_absensi.agentid as agentna,COUNT(DISTINCT (DATE(waktu_in))) as hk FROM t_absensi 
    LEFT JOIN sys_user ON sys_user.agentid = t_absensi.agentid 
    WHERE stts='in' 
    AND (sys_user.kategori = 'REG' OR sys_user.kategori = 'MOS')
    AND sys_user.opt_level = 8 
	AND DATE(waktu_in) BETWEEN '$start_periode' AND '$end_periode'
  GROUP BY t_absensi.agentid,MONTH(waktu_in),DATE(waktu_in)
")->result();

		//jmlhk
		if (count($hk) > 0) {
			foreach ($hk as $fr) {
				if (!isset($data['hkagent'][$fr->agentna]['hk'])) {
					$data['hkagent'][$fr->agentna]['hk'] = 0;
				}
				$data['hkagent'][$fr->agentna]['hk'] = $data['hkagent'][$fr->agentna]['hk'] + 1;
			}
		}


		$filter_agent = array("opt_level" => 8, "tl !=" => "-", "kategori" => "REG");
		$data['list_agent_d'] = $this->Sys_user_table_model->get_results($filter_agent);
		$data['contacted'] = $this->get_contacted($start_periode, $end_periode, $data['hkagent'][$fr->agentna]['hk']);
		$data['kehadiran'] = $this->hitung_hk($start_periode, $end_periode);
		$data['tenur'] = $this->tenur();
		$data['akomodasi'] = $this->akomodasi();
		$data['hpemail'] = $this->hpemail($start_periode, $end_periode);
		$data['hponly'] = $this->hponly($start_periode, $end_periode);
		$data['agentmoss'] = $this->agentmoss($start_periode, $end_periode);

		$this->load->view('T_payroll/list_generate', $data);
	}

	public function bulk_insert()
	{
		$start_periode = $_GET['start'];
		$end_periode = $_GET['end'];

		$data = array();


		///hk
		$hk = $this->db->query("
    select t_absensi.agentid as agentna,COUNT(DISTINCT (DATE(waktu_in))) as hk FROM t_absensi 
    LEFT JOIN sys_user ON sys_user.agentid = t_absensi.agentid 
    WHERE stts='in' 
    AND (sys_user.kategori = 'REG' OR sys_user.kategori = 'MOS')
    AND sys_user.opt_level = 8 
	AND DATE(waktu_in) BETWEEN '$start_periode' AND '$end_periode'
  GROUP BY t_absensi.agentid,MONTH(waktu_in),DATE(waktu_in)
")->result();


		//jmlhk
		if (count($hk) > 0) {
			foreach ($hk as $fr) {
				if (!isset($hkagent[$fr->agentna]['hk'])) {
					$hkagent[$fr->agentna]['hk'] = 0;
				}
				$hkagent[$fr->agentna]['hk'] = $hkagent[$fr->agentna]['hk'] + 1;
			}
		}


		$filter_agent = array("opt_level" => 8, "tl !=" => "-", "kategori" => "REG");
		$list_agent_d = $this->Sys_user_table_model->get_results($filter_agent);
		$contacted = $this->get_contacted($start_periode, $end_periode, $hkagent[$fr->agentna]['hk']);
		$kehadiran = $this->hitung_hk($start_periode, $end_periode);
		$tenur = $this->tenur();
		$akomodasi = $this->akomodasi();
		$hpemail = $this->hpemail($start_periode, $end_periode);
		$hponly = $this->hponly($start_periode, $end_periode);
		$agentmoss = $this->agentmoss($start_periode, $end_periode);

		foreach ($list_agent_d['results'] as $datana) {
			if ($datana->agentid_mos == $agentmoss[$datana->agentid_mos]['moss_duty']) {
				$agent = $datana->agentid_mos;
			} else {
				$agent = $datana->agentid;
			}
			$ihkasdf = $hkagent[$agent]['hk'];
			$hkagentihkasdf = $ihkasdf / $kehadiran['hknya'];

			$ctc = $contacted[$agent]['r_contcs']['achievementc'];
			if ($ctc >= 1) {
				$sc_cont = 100;
			} else if ($ctc >= 0.8) {
				$sc_cont = 80;
			} else if ($ctc >= 0.6) {
				$sc_cont = 60;
			} else if ($ctc >= 0.4) {
				$sc_cont = 30;
			} else {
				$sc_cont = 0;
			}
			$asc_cont = $sc_cont * 30 / 100;
			number_format($asc_cont);

			$ctv = $contacted[$agent]['r_verif']['achievementk'];
			if ($ctv < 0.5) {
				$sc_ver = 0;
			} else if ($ctv < 0.75) {
				$sc_ver = 50;
			} else if ($ctv < 0.9) {
				$sc_ver = 75;
			} else if ($ctv < 1) {
				$sc_ver = 90;
			} else {
				$sc_ver = 100;
			}
			$asc_ver = $sc_ver * 50 / 100;

			$tenura = $tenur[$datana->agentid]['tenur'];
			if ($tenura < 3) {
				$sc_tenur = 40;
			} else if ($tenura < 6) {
				$sc_tenur = 60;
			} else if ($tenura < 12) {
				$sc_tenur = 80;
			} else if ($tenura > 12) {
				$sc_tenur = 100;
			} else {
				$sc_tenur = 0;
			}
			$asc_tenur = $sc_tenur * 5 / 100;

			$pendidikana = $tenur[$datana->agentid]['pendidikan'];
			if ($pendidikana == "S1") {
				$sc_pendidikan = 100;
			} else if ($pendidikana == "D3") {
				$sc_pendidikan = 80;
			} else if ($pendidikana == "D1") {
				$sc_pendidikan = 60;
			} else if ($pendidikana == "SMU" || $pendidikana == "SMA") {
				$sc_pendidikan = 40;
			} else {
				$sc_pendidikan = 0;
			}
			$asc_pendidikan = $sc_pendidikan * 5 / 100;

			if ($agent == $datana->agentid) {
				$tot_score = $asc_cont + $asc_ver + $asc_tenur + $asc_pendidikan;
			} else {
				$tot_score = 70;
			}

			if ($tot_score < 30) {
				$level = "Pemula";
			} else if ($tot_score < 50) {
				$level = "Junior";
			} else if ($tot_score < 80) {
				$level = "Madya";
			} else {
				$level = "Senior";
			}

			$sakomodasi = $akomodasi[$level]['akomodasi'];
			if ($hkagent[$agent]['hk'] >= 1) {
				$sakomodasi = $sakomodasi;
			} else {
				$sakomodasi = $hkagent[$agent]['hk'] * $sakomodasi;
			}

			($akomodasi[$level]['tunjangan_transport'] * $hkagent[$agent]['hk']);
			($akomodasi[$level]['komisi'] * $contacted[$agent]['r_contcs']['achievementc']);

			if ($ctv > 1) {
				$tunjanganlevel = $akomodasi[$level]['tunjangan_level'];
			} else {
				$tunjanganlevel = $akomodasi[$level]['tunjangan_level'] * $ctv;
			}


			$thpleveling = $sakomodasi + ($akomodasi[$level]['tunjangan_transport'] * $hkagent[$agent]['hk']) + ($akomodasi[$level]['komisi'] * $contacted[$agent]['r_contcs']['achievementc']) + $tunjanganlevel + $akomodasi[$level]['tunjangan_jabatan'];

			$hpemails = $hpemail[$agent]['hpemail'];
			$kelebihanhpemail = ($kehadiran['hknya'] * 95) - $contacted[$agent]['verif'];
			if ($kelebihanhpemail > 0) {
				$kelebihanhpemail = $kelebihanhpemail;
				$rupiah = $kelebihanhpemail * 5000;
			} else {
				$kelebihanhpemail = 0;
				$rupiah = 0;
			}


			$tottahp = $thpleveling + $akomodasi[$level]['tunjangan_skill'] + $rupiah;
			$headcount = $tottahp + $akomodasi[$level]['tunjangan_skill'] + $akomodasi[$level]['non_thp'] + $akomodasi[$level]['benefit_lain'] + $akomodasi[$level]['m_fee'];

			$datainsert = array(
				'periode' => $start_periode . '_' . $end_periode,
				'skema' => "",
				'agentid' => "$datana->agentid",
				'hadir' => $ihkasdf,
				'kehadiran' => number_format($hkagentihkasdf, 2),
				'contacted' => number_format($contacted[$agent]['r_contcs']['achievementc'], 2),
				'verified' => number_format($contacted[$agent]['r_verif']['achievementk'], 2),
				'tenur' => number_format($tenur[$datana->agentid]['tenur']),
				'reward' => 0,
				'pendidikan' => $tenur[$datana->agentid]['pendidikan'],
				'foreign' => 0,
				's_contacted' => number_format($asc_cont, 2),
				's_verified' => number_format($asc_ver, 2),
				's_tenur' => number_format($asc_tenur),
				's_reward' => 0,
				's_pendidikan' => number_format($asc_pendidikan, 2),
				'score' => number_format($tot_score, 2),
				'level' => $level,
				'akomodasi' => $sakomodasi,
				't_trasnport' => $akomodasi[$level]['tunjangan_transport'] * $hkagent[$agent]['hk'],
				'komisi' => $akomodasi[$level]['komisi'] * $contacted[$agent]['r_contcs']['achievementc'],
				'tunj_level' => $tunjanganlevel,
				'tunj_jabatan' => $akomodasi[$level]['tunjangan_jabatan'],
				'thp_leveling' => $thpleveling,
				'ot_moss' => 0,
				'other_fee' => 0,
				'tunj_skill' => $akomodasi[$level]['tunjangan_skill'],
				'perbantuan_hpemail' => $kelebihanhpemail, //cek lagi
				'perbantuan_hponly' => 0, //cek lagi
				'nominal_perbantuan' => $rupiah,
				'total_thp' => $tottahp,
				'non_thp' => $akomodasi[$level]['non_thp'],
				'benefit_lain' => $akomodasi[$level]['benefit_lain'],
				'm_fee' => $akomodasi[$level]['m_fee'],
				'headcount' => $headcount,
				'jml_verified' =>  $contacted[$agent]['verif'],
				'jml_contacted' =>  $contacted[$agent]['contcs'],
				'jml_hpemail' =>  $hpemail[$agent]['hpemail'], //cek lagi
				'jmlhp' =>  $hponly[$agent]['hponly'] //cek lagi
			);
			$rangeperiode = $start_periode . "_" . $end_periode;
			$jmldata = $this->db->query("SELECT count(*) AS jumlah FROM t_payroll WHERE periode='$rangeperiode' AND agentid='$agent'")->row();
			if ($jmldata->jumlah < 1) {
				$this->db->insert('t_payroll', $datainsert);
				// var_dump($datainsert);
			}
			// var_dump($datainsert);	
		}
	}

	public function agentmoss($start, $end)
	{
		$agentmoss = $this->db->query("
		SELECT
	sys_user_moss.agentid AS agentna,
	sys_user_moss.*,
	sys_user.agentid as agentreg
FROM
	sys_user_moss
	LEFT JOIN sys_user ON sys_user.agentid_mos = sys_user_moss.agentid 
WHERE
	sys_user.kategori = 'REG'
	AND sys_user.opt_level = 8
	AND periode_start='$start'
	AND periode_end='$end'");
		foreach ($agentmoss->result() as $sa) {
			$data[$sa->agentna]['moss_duty'] = $sa->agentna;
			$data[$sa->agentna]['reg_duty'] = $sa->agentreg;
		}
		return $data;
	}
	public function tenur()
	{
		$masakerja = $this->db->query("SELECT agentid, tanggal_gabung, pendidikan FROM sys_user_detail");

		foreach ($masakerja->result() as $sa) {
			$now = strtotime("now");
			$your_date = strtotime($sa->tanggal_gabung);
			$datediff = $now - $your_date;
			$data[$sa->agentid]['tenur'] = $datediff / (60 * 60 * 24 * 30);
			$data[$sa->agentid]['pendidikan'] = $sa->pendidikan;
		}
		return $data;
	}
	public function hpemail($start, $end)
	{
		$hpemail = $this->db->query("SELECT veri_upd AS agentid, COUNT(*) AS hpemail
		FROM `trans_profiling_last_month`
		WHERE veri_lup BETWEEN '$start' AND '$end' 
		AND (handphone LIKE '08%')
		AND (email IS NOT NULL AND email LIKE '%@%' AND email NOT LIKE '%-%')
		AND veri_call='13'
		GROUP BY veri_upd");

		foreach ($hpemail->result() as $sa) {

			$data[$sa->agentid]['hpemail'] = $sa->hpemail;
		}
		return $data;
	}
	public function hponly($start, $end)
	{
		$hponly = $this->db->query("SELECT veri_upd AS agentid, COUNT(*) AS hponly
		FROM `trans_profiling_last_month`
		WHERE veri_lup BETWEEN '$start' AND '$end' 
		AND (handphone LIKE '08%')
		AND (email IS NULL OR email NOT LIKE '%@%' OR email='-')
		AND veri_call='13'
		GROUP BY veri_upd;");

		foreach ($hponly->result() as $sa) {

			$data[$sa->agentid]['hponly'] = $sa->hponly;
		}
		return $data;
	}
	public function akomodasi()
	{
		$akomodasi = $this->db->query("SELECT * FROM t_payroll_akomodasi");

		foreach ($akomodasi->result() as $sa) {
			$data[$sa->jabatan]['akomodasi'] = $sa->akomodasi;
			$data[$sa->jabatan]['komisi'] = $sa->komisi;
			$data[$sa->jabatan]['tunjangan_skill'] = $sa->tunjangan_skill;
			$data[$sa->jabatan]['tunjangan_level'] = $sa->tunjangan_level;
			$data[$sa->jabatan]['tunjangan_prestasi'] = $sa->tunjangan_prestasi;
			$data[$sa->jabatan]['overtime'] = $sa->overtime;
			$data[$sa->jabatan]['overtime_mirya'] = $sa->overtime_mirya;
			$data[$sa->jabatan]['tunjangan_transport'] = $sa->tunjangan_transport;
			$data[$sa->jabatan]['tunjangan_jabatan'] = $sa->tunjangan_jabatan;
			$data[$sa->jabatan]['non_thp'] = $sa->non_thp;
			$data[$sa->jabatan]['benefit_lain'] = $sa->benefit_lain;
			$data[$sa->jabatan]['m_fee'] = $sa->m_fee;
		}
		return $data;
	}
	public function get_contacted($start, $end, $hk)
	{
		$data = array();
		$contacted = $this->db->query("
		SELECT
	trans_profiling_last_month.veri_upd AS agentna,
	trans_profiling_last_month.veri_call,
	count(
	DISTINCT ( trans_profiling_last_month.ncli )) AS jumlah 
FROM
	trans_profiling_last_month
	LEFT JOIN sys_user ON sys_user.agentid = trans_profiling_last_month.veri_upd 
WHERE
	(sys_user.kategori = 'REG' OR sys_user.kategori = 'MOS') 
	AND sys_user.tl != '-'
	AND (veri_call=13 or veri_call=12 or veri_call=11)
	AND date(lup) BETWEEN '$start' AND '$end'
	GROUP BY veri_upd, veri_call
		");

		foreach ($contacted->result() as $as) {
			if ($as->veri_call == 13) {
				$data[$as->agentna]['verif'] = $as->jumlah;
				$data[$as->agentna]['r_verif'] = $this->get_pverif($data[$as->agentna]['verif'], $hk);
			} else {
				$data[$as->agentna]['contc'] = $as->jumlah + $data[$as->agentna]['contc'];
			}
			$data[$as->agentna]['contcs'] = $data[$as->agentna]['contc'] + $data[$as->agentna]['verif'];
			$data[$as->agentna]['r_contcs'] = $this->get_pcontacted($data[$as->agentna]['contcs'], $hk);
		}

		return $data;
	}

	public function get_pcontacted($contacted, $hk)
	{
		$target = 124;
		$data['achievementc'] = $contacted / ($hk * $target);
		return $data;
	}
	public function get_pverif($verif, $hk)
	{
		$target = 95;
		$data['achievementk'] = $verif / ($hk * $target);
		return $data;
	}
	public function hitung_hk($start, $end)
	{
		$start = strtotime($start);
		$end = strtotime($end);
		$count = 0;
		while (date('Y-m-d', $start) < date('Y-m-d', $end)) {
			$count += date('N', $start) < 6 ? 1 : 0;
			$start = strtotime("+1 day", $start);
		}
		$data['hknya'] = $count;
		return $data;
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
			'link_save'				=> site_url() . 'T_payroll/T_payroll/create_action',
			'link_back'				=> $this->agent->referrer(),
		);

		$this->template->load('T_payroll/T_payroll_form', $data);
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
		if (!$o->not_empty($val['kehadiran'], '#kehadiran')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('kehadiran' => $val['kehadiran']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#kehadiran')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['contacted'], '#contacted')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('contacted' => $val['contacted']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#contacted')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['verified'], '#verified')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('verified' => $val['verified']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#verified')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['tenur'], '#tenur')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('tenur' => $val['tenur']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#tenur')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['pendidikan'], '#pendidikan')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('pendidikan' => $val['pendidikan']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#pendidikan')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['score'], '#score')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('score' => $val['score']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#score')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['level'], '#level')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('level' => $val['level']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#level')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['akomodasi'], '#akomodasi')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('akomodasi' => $val['akomodasi']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#akomodasi')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['t_trasnport'], '#t_trasnport')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('t_trasnport' => $val['t_trasnport']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#t_trasnport')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['komisi'], '#komisi')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('komisi' => $val['komisi']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#komisi')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['tunj_level'], '#tunj_level')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('tunj_level' => $val['tunj_level']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#tunj_level')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['tunj_jabatan'], '#tunj_jabatan')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('tunj_jabatan' => $val['tunj_jabatan']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#tunj_jabatan')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['thp_leveling'], '#thp_leveling')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('thp_leveling' => $val['thp_leveling']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#thp_leveling')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['ot_moss'], '#ot_moss')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('ot_moss' => $val['ot_moss']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#ot_moss')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['other_fee'], '#other_fee')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('other_fee' => $val['other_fee']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#other_fee')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['tunj_skill'], '#tunj_skill')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('tunj_skill' => $val['tunj_skill']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#tunj_skill')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['perbantuan_hpemail'], '#perbantuan_hpemail')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('perbantuan_hpemail' => $val['perbantuan_hpemail']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#perbantuan_hpemail')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['perbantuan_hponly'], '#perbantuan_hponly')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('perbantuan_hponly' => $val['perbantuan_hponly']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#perbantuan_hponly')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['nominal_perbantuan'], '#nominal_perbantuan')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('nominal_perbantuan' => $val['nominal_perbantuan']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#nominal_perbantuan')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['total_thp'], '#total_thp')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('total_thp' => $val['total_thp']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#total_thp')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['non_thp'], '#non_thp')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('non_thp' => $val['non_thp']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#non_thp')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['benefit_lain'], '#benefit_lain')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('benefit_lain' => $val['benefit_lain']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#benefit_lain')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['m_fee'], '#m_fee')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('m_fee' => $val['m_fee']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#m_fee')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['headcount'], '#headcount')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('headcount' => $val['headcount']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#headcount')) {
			echo $o->result();
			return;
		}

		unset($val['id']);
		$success = $this->tmodel->insert($val);
		echo $o->auto_result($success);
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
				'link_save'				=> site_url() . 'T_payroll/T_payroll/update_action',
				'link_back'				=> $this->agent->referrer(),
				'data'					=> $row,
				'id'					=> $id_generate,
			);

			$this->template->load('T_payroll/T_payroll_form', $data);
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
		if (!$o->not_empty($val['agentid'], '#agentid')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('agentid' => $val['agentid']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#agentid')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['kehadiran'], '#kehadiran')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('kehadiran' => $val['kehadiran']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#kehadiran')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['contacted'], '#contacted')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('contacted' => $val['contacted']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#contacted')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['verified'], '#verified')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('verified' => $val['verified']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#verified')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['tenur'], '#tenur')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('tenur' => $val['tenur']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#tenur')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['pendidikan'], '#pendidikan')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('pendidikan' => $val['pendidikan']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#pendidikan')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['score'], '#score')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('score' => $val['score']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#score')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['level'], '#level')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('level' => $val['level']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#level')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['akomodasi'], '#akomodasi')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('akomodasi' => $val['akomodasi']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#akomodasi')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['t_trasnport'], '#t_trasnport')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('t_trasnport' => $val['t_trasnport']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#t_trasnport')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['komisi'], '#komisi')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('komisi' => $val['komisi']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#komisi')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['tunj_level'], '#tunj_level')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('tunj_level' => $val['tunj_level']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#tunj_level')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['tunj_jabatan'], '#tunj_jabatan')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('tunj_jabatan' => $val['tunj_jabatan']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#tunj_jabatan')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['thp_leveling'], '#thp_leveling')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('thp_leveling' => $val['thp_leveling']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#thp_leveling')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['ot_moss'], '#ot_moss')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('ot_moss' => $val['ot_moss']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#ot_moss')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['other_fee'], '#other_fee')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('other_fee' => $val['other_fee']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#other_fee')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['tunj_skill'], '#tunj_skill')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('tunj_skill' => $val['tunj_skill']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#tunj_skill')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['perbantuan_hpemail'], '#perbantuan_hpemail')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('perbantuan_hpemail' => $val['perbantuan_hpemail']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#perbantuan_hpemail')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['perbantuan_hponly'], '#perbantuan_hponly')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('perbantuan_hponly' => $val['perbantuan_hponly']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#perbantuan_hponly')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['nominal_perbantuan'], '#nominal_perbantuan')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('nominal_perbantuan' => $val['nominal_perbantuan']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#nominal_perbantuan')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['total_thp'], '#total_thp')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('total_thp' => $val['total_thp']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#total_thp')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['non_thp'], '#non_thp')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('non_thp' => $val['non_thp']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#non_thp')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['benefit_lain'], '#benefit_lain')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('benefit_lain' => $val['benefit_lain']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#benefit_lain')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['m_fee'], '#m_fee')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('m_fee' => $val['m_fee']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#m_fee')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['headcount'], '#headcount')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('headcount' => $val['headcount']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#headcount')) {
			echo $o->result();
			return;
		}


		$success = $this->tmodel->update($val['id'], $val);
		echo $o->auto_result($success);
	}

	public function delete_multiple()
	{
		$data = $this->input->get('data_ajax', true);
		$val = json_decode($data, true);
		$data = explode(',', $val['data_delete']);

		//get key generate
		$log_id = $this->session->userdata($this->log_key);
		$xx = 0;
		foreach ($data as $value) {
			$value =  _decode_id($value, $log_id);
			//menganti ke id asli
			$data[$xx] = $value;
			$xx++;
		}

		$success = $this->tmodel->delete_multiple($data);

		$o = new Outputview();

		//create message
		if ($success) {
			$o->success 	= 'true';
			$o->message	= 'Data berhasil di hapus !';
		} else {
			$o->success 	= 'false';
			$o->message	= 'Opps..Gagal menghapus data !!';
		}


		echo $o->result();
	}
};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2021-02-02 09:55:54 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
