<?php
require APPPATH . '/controllers/Dbprofile_verified/Dbprofile_verified_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Dbprofile_verified extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Dbprofile_verified/Dbprofile_verified_model', 'tmodel');
		$this->log_key = 'log_Dbprofile_verified';
		$this->title = new Dbprofile_verified_config();
	}


	public function index()
	{
		$data = array(
			'title_page_big'		=> 'DAFTAR',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'Dbprofile_verified/Dbprofile_verified/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'Dbprofile_verified/Dbprofile_verified/create',
			'link_update'			=> site_url() . 'Dbprofile_verified/Dbprofile_verified/update',
			'link_delete'			=> site_url() . 'Dbprofile_verified/Dbprofile_verified/delete_multiple',
		);

		$this->template->load('Dbprofile_verified/Dbprofile_verified_list', $data);
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
			'link_save'				=> site_url() . 'Dbprofile_verified/Dbprofile_verified/create_action',
			'link_back'				=> $this->agent->referrer(),
		);

		$this->template->load('Dbprofile_verified/Dbprofile_verified_form', $data);
	}
	public function check_ncli()
	{
		$data = array(
			'title_page_big'		=> 'Check NCLI',
			'title'					=> $this->title,
			'link_save'				=> site_url() . 'Dbprofile_verified/Dbprofile_verified/update_check',
			'link_back'				=> $this->agent->referrer(),
		);

		$this->template->load('Dbprofile_verified/Dbprofile_verified_check_form', $data);
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
		if (!$o->not_empty($val['NCLI'], '#NCLI')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('NCLI' => $val['NCLI']);
		$exist = $this->tmodel->if_exist('', $field);
		if (!$o->not_exist($exist, '#NCLI')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['NO_PSTN'], '#NO_PSTN')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['NO_SPEEDY'], '#NO_SPEEDY')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['NAMA_PELANGGAN'], '#NAMA_PELANGGAN')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['NO_HP'], '#NO_HP')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['NAMA_PEMILIK'], '#NAMA_PEMILIK')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['ALAMAT'], '#ALAMAT')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['KOTA'], '#KOTA')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['REGIONAL'], '#REGIONAL')) {
			echo $o->result();
			return;
		}

		unset($val['id']);
		$success = $this->tmodel->insert($val);
		echo $o->auto_result($success);
	}

	public function update_check()
	{

		$NCLI = $this->input->post('NCLI');
		$berdasarkan = $this->input->post('berdasarkan');
		$row = $this->tmodel->get_by_filter($NCLI, $berdasarkan);

		
			$data = array(
				'title_page_big'		=> 'CHECK DATA DBPROFILE_VERIFIED',
				'title'					=> $this->title,
				'link_edit'				=> site_url() . 'Dbprofile_verified/Dbprofile_verified/update',
				'link_back'				=> $this->agent->referrer(),
				'data'					=> $row,
				'berdasarkan' => $berdasarkan,
				'ncli' => $NCLI,
			);

			$this->template->load('Dbprofile_verified/Dbprofile_verified_list_filter', $data);
		
	}
	public function update()
	{

		$NCLI = $this->input->get('ncli');
		$berdasarkan = $this->input->get('berdasarkan');
		$tgl_veri = $this->input->get('tgl_veri');
		$row = $this->tmodel->get_by_id_2($NCLI, $berdasarkan,$tgl_veri);

		if ($row) {
			$data = array(
				'title_page_big'		=> 'UPDATE DATA DBPROFILE_VERIFIED',
				'title'					=> $this->title,
				'link_save'				=> site_url() . 'Dbprofile_verified/Dbprofile_verified/update_action',
				'link_back'				=> site_url() . 'Dbprofile_verified/Dbprofile_verified/check_ncli',
				'data'					=> $row,
				'berdasarkan' => $berdasarkan
			);

			$this->template->load('Dbprofile_verified/Dbprofile_verified_form', $data);
		} else {
			redirect($this->agent->referrer());
		}
	}

	public function update_action()
	{
		$data 	= $this->input->post('data_ajax', true);
		$val	= json_decode($data, true);
		$this->log_temp		= $this->session->tempdata($val['NCLI']);


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
		if (!$o->not_empty($val['NCLI'], '#NCLI')) {
			echo $o->result();
			return;
		}



		//mencegah data kosong
		if (!$o->not_empty($val['NO_PSTN'], '#NO_PSTN')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['NO_SPEEDY'], '#NO_SPEEDY')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['NAMA_PELANGGAN'], '#NAMA_PELANGGAN')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['NO_HP'], '#NO_HP')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['NAMA_PEMILIK'], '#NAMA_PEMILIK')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['ALAMAT'], '#ALAMAT')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['KOTA'], '#KOTA')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['REGIONAL'], '#REGIONAL')) {
			echo $o->result();
			return;
		}
		$berdasarkan = $val['berdasarkan'];
		unset($val['berdasarkan']);
		$val['IS_LAST']=null;
		$val['DATRS']=null;
		$success = $this->tmodel->update($val[$berdasarkan], $val, $berdasarkan, $val['TGL_VERIFIKASI']);
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
/* Generated by YBS CRUD Generator 2020-02-08 07:42:27 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
