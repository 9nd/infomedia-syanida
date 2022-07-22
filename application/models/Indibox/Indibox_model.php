<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Indibox_model extends CI_Model
{
	public $id;
	function __construct()
	{
		parent::__construct();
		$this->infomedia = $this->load->database('infomedia', TRUE);
	}
	function live_query($query)
	{
		
		$query = $this->infomedia->query($query);
		return $query;
	}
	function get_results($where = array(), $fields = array('*'), $limit = array(), $order_by = array())
	{
		$data = array();
		//select field
		if (is_array($fields)) {
			$this->db->select(implode(',', $fields));
		}
		if (count($where) > 0) {
			foreach ($where as $field => $value) {
				switch ($field) {
					default:
						$this->db->where($field, $value);
						break;
					case "or_where":
						foreach ($value as $fi => $val) {
							$this->db->or_where($fi, $val);
						}
						break;
					case "or_where_null":
						foreach ($value as $val) {
							$this->db->where($val, NULL, FALSE);
						}
						break;
					case "or_where_null_multi":
						foreach ($value as $val_arr) {
							foreach ($val_arr as $val) {
								$this->db->where($val, NULL, FALSE);
							}
						}
						break;
					case "like":
						foreach ($value as $fi => $val) {
							$this->db->like($fi, $val, 'both');
						}
						break;
					case "or_like":
						foreach ($value as $fi => $val) {
							$this->db->or_like($fi, $val, 'both');
						}
						break;
					case "join":
						foreach ($value as $fi => $val) {
							$this->db->join($fi, $val);
						}
						break;
					case "join_left":
						foreach ($value as $fi => $val) {
							$this->db->join($fi, $val, "INNER");
						}
						break;
				}
			}
		}
		//order
		if (count($order_by) > 0) {
			foreach ($order_by as $field => $typ) {
				$this->db->order_by($field, $typ);
			}
		}
		//limit
		if (count($limit) > 0) {
			$query = $this->db->get($this->tbl, $limit['limit'], $limit['offset']);
		} else {
			$query = $this->db->get($this->tbl);
		}
		if ($result = $query->result()) {
			$data['results'] = $result;
		}
		$data['num'] = $query->num_rows();
		return $data;
	}
	public function json()
	{
		$this->datatables->set_database('infomedia');
		$this->datatables->select('
			trans_profiling_validasi_mos.idx as idx,
			trans_profiling_validasi_mos.ncli as ncli,
			trans_profiling_validasi_mos.no_pstn as no_pstn,
			trans_profiling_validasi_mos.no_speedy as no_speedy,
			trans_profiling_validasi_mos.nama_pelanggan as nama_pelanggan,
			trans_profiling_validasi_mos.relasi as relasi,
			trans_profiling_validasi_mos.no_handpone as no_handpone,
			trans_profiling_validasi_mos.verfi_handphone as verfi_handphone,
			trans_profiling_validasi_mos.email as email,
			trans_profiling_validasi_mos.verfi_email as verfi_email,
			trans_profiling_validasi_mos.facebook as facebook,
			trans_profiling_validasi_mos.twitter as twitter,
			trans_profiling_validasi_mos.nama_pastel as nama_pastel,
			trans_profiling_validasi_mos.alamat as alamat,
			trans_profiling_validasi_mos.kota as kota,
			trans_profiling_validasi_mos.regional as regional,
			trans_profiling_validasi_mos.update_by as update_by,
			trans_profiling_validasi_mos.lup as lup,
			trans_profiling_validasi_mos.sumber as sumber,
			trans_profiling_validasi_mos.tgl_insert as tgl_insert,
			trans_profiling_validasi_mos.is_3p as is_3p,
			trans_profiling_validasi_mos.layanan as layanan,
			trans_profiling_validasi_mos.reason_call as reason_call,			
			trans_profiling_validasi_mos.status as status,
			trans_profiling_validasi_mos.keterangan as keterangan,
			trans_profiling_validasi_mos.tgl_bayar as tgl_bayar,
			trans_profiling_validasi_mos.waktu_bayar as waktu_bayar,
			trans_profiling_validasi_mos.kecepatan as kecepatan,
			trans_profiling_validasi_mos.tagihan as tagihan,
			trans_profiling_validasi_mos.click_time as click_time,
			trans_profiling_validasi_mos.tahun_pemasangan as tahun_pemasangan,
			trans_profiling_validasi_mos.tempat_bayar as tempat_bayar,
		');

		$this->datatables->from('trans_profiling_validasi_mos');
		$this->datatables->where('trans_profiling_validasi_mos.sumber', 'IndiBox');

		//mengembalikan dalam bentuk array
		$q =  json_decode($this->datatables->generate(), true);
		return $q;
	}


	public function get_all()
	{
		$afield = array(
			'trans_profiling_validasi_mos.idx as idx',
			'trans_profiling_validasi_mos.ncli as ncli',
			'trans_profiling_validasi_mos.no_pstn as no_pstn',
			'trans_profiling_validasi_mos.no_speedy as no_speedy',
			'trans_profiling_validasi_mos.nama_pelanggan as nama_pelanggan',
			'trans_profiling_validasi_mos.relasi as relasi',
			'trans_profiling_validasi_mos.no_handpone as no_handpone',
			'trans_profiling_validasi_mos.verfi_handphone as verfi_handphone',
			'trans_profiling_validasi_mos.email as email',
			'trans_profiling_validasi_mos.verfi_email as verfi_email',
			'trans_profiling_validasi_mos.facebook as facebook',
			'trans_profiling_validasi_mos.twitter as twitter',
			'trans_profiling_validasi_mos.nama_pastel as nama_pastel',
			'trans_profiling_validasi_mos.alamat as alamat',
			'trans_profiling_validasi_mos.kota as kota',
			'trans_profiling_validasi_mos.regional as regional',
			'trans_profiling_validasi_mos.update_by as update_by',
			'trans_profiling_validasi_mos.lup as lup',
			'trans_profiling_validasi_mos.sumber as sumber',
			'trans_profiling_validasi_mos.tgl_insert as tgl_insert',
			'trans_profiling_validasi_mos.is_3p as is_3p',
			'trans_profiling_validasi_mos.layanan as layanan',
			'trans_profiling_validasi_mos.reason_call as reason_call',
			'trans_profiling_validasi_mos.status as status',
			'trans_profiling_validasi_mos.keterangan as keterangan',
			'trans_profiling_validasi_mos.tgl_bayar as tgl_bayar',
			'trans_profiling_validasi_mos.waktu_bayar as waktu_bayar',
			'trans_profiling_validasi_mos.kecepatan as kecepatan',
			'trans_profiling_validasi_mos.tagihan as tagihan',
			'trans_profiling_validasi_mos.click_time as click_time',
			'trans_profiling_validasi_mos.tahun_pemasangan as tahun_pemasangan',
			'trans_profiling_validasi_mos.tempat_bayar as tempat_bayar',

		);
		$this->infomedia->select($afield);
		//$this->infomedia->where('trans_profiling_validasi_mos.sumber', 'indibox');
		$this->infomedia->order_by('trans_profiling_validasi_mos.idx', 'ASC');
		return $this->infomedia->getwhere('trans_profiling_validasi_mos')->result_array();
	}


	public function get_by_id($idx)
	{
		$afield = array(
			'trans_profiling_validasi_mos.idx as idx',
			'trans_profiling_validasi_mos.ncli as ncli',
			'trans_profiling_validasi_mos.no_pstn as no_pstn',
			'trans_profiling_validasi_mos.no_speedy as no_speedy',
			'trans_profiling_validasi_mos.nama_pelanggan as nama_pelanggan',
			'trans_profiling_validasi_mos.relasi as relasi',
			'trans_profiling_validasi_mos.no_handpone as no_handpone',
			'trans_profiling_validasi_mos.verfi_handphone as verfi_handphone',
			'trans_profiling_validasi_mos.email as email',
			'trans_profiling_validasi_mos.verfi_email as verfi_email',
			'trans_profiling_validasi_mos.facebook as facebook',
			'trans_profiling_validasi_mos.twitter as twitter',
			'trans_profiling_validasi_mos.nama_pastel as nama_pastel',
			'trans_profiling_validasi_mos.alamat as alamat',
			'trans_profiling_validasi_mos.kota as kota',
			'trans_profiling_validasi_mos.regional as regional',
			'trans_profiling_validasi_mos.update_by as update_by',
			'trans_profiling_validasi_mos.lup as lup',
			'trans_profiling_validasi_mos.sumber as sumber',
			'trans_profiling_validasi_mos.tgl_insert as tgl_insert',
			'trans_profiling_validasi_mos.is_3p as is_3p',
			'trans_profiling_validasi_mos.layanan as layanan',
			'trans_profiling_validasi_mos.reason_call as reason_call',
			'trans_profiling_validasi_mos.status as status',
			'trans_profiling_validasi_mos.keterangan as keterangan',
			'trans_profiling_validasi_mos.tgl_bayar as tgl_bayar',
			'trans_profiling_validasi_mos.waktu_bayar as waktu_bayar',
			'trans_profiling_validasi_mos.kecepatan as kecepatan',
			'trans_profiling_validasi_mos.tagihan as tagihan',
			'trans_profiling_validasi_mos.click_time as click_time',
			'trans_profiling_validasi_mos.tahun_pemasangan as tahun_pemasangan',
			'trans_profiling_validasi_mos.tempat_bayar as tempat_bayar',

		);
		$this->infomedia->select("*");
		$this->infomedia->where('trans_profiling_validasi_mos.idx', $idx);
		$this->infomedia->order_by('trans_profiling_validasi_mos.idx', 'ASC');
		return $this->infomedia->get('trans_profiling_validasi_mos')->row();
	}


	/* Memastikan data yg dibuat tidak kembar/sama,
	   fungsi ini sebagai pengganti fungsi primary key dr db,
	   krn primary key sudah di gunakan untuk column id.
	   -create : id di kosongkan.
	   -update : id di isi dengan id data yg di proses.	
	*/


	function insert($data)
	{

		/* transaction rollback */


		$this->infomedia->trans_start();

		$this->infomedia->insert('trans_profiling_validasi_mos', $data);
		/* id primary yg baru saja di input*/
		$this->id = $this->infomedia->insert_id();

		$this->infomedia->trans_complete();
		return $this->infomedia->trans_status(); //return true or false
	}



	function update($idx, $data)
	{

		/* transaction rollback */
		$this->infomedia->trans_start();

		$this->infomedia->where('trans_profiling_validasi_mos.idx', $idx);
		$this->infomedia->update('trans_profiling_validasi_mos', $data);

		$this->infomedia->trans_complete();
		return $this->infomedia->trans_status(); //return true or false	
	}

	function delete_multiple($data)
	{
		/* transaction rollback */
		$this->infomedia->trans_start();

		if (!empty($data)) {
			$this->infomedia->where_in('trans_profiling_validasi_mos.idx', $data);

			$this->infomedia->delete('trans_profiling_validasi_mos');
		}

		$this->infomedia->trans_complete();
		return $this->infomedia->trans_status(); //return true or false	

	}
};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-06-02 15:25:04 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
