<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_kelola_dokumen');
		$this->load->library('form_validation');
		$this->load->helper(array('url', 'download'));
	}

	public function index()
	{
		$json = file_get_contents("./assets/MOCK_DATA.json");
		$obj  = json_decode($json);
		$data = array(
			'title' => 'KELOLA DATA',
			'isi' => 'kelola_dokumen/v_kelola',
			'list_data' => $obj
		);

		$data['tbl_coba'] = $this->M_kelola_dokumen->get_data('tbl_coba')->result();
		$this->load->view('template/wraper', $data, FALSE);
	}

	public function tambah()
	{
		$this->form_validation->set_rules('jenis_dokumen', 'Jenis Dokumen', 'required');
		$this->form_validation->set_rules('nama_dokumen', 'Nama Dokumen', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

		if ($this->form_validation->run() == TRUE) {
			$config['upload_path']          = './file/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg|docx|pdf|xlsx';
			$config['max_size']             = 50000;
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('dokumen')) {
				$data = array(
					'title' => 'TAMBAH DATA',
					'isi' => 'kelola_dokumen/v_tambah',
				);
				$this->load->view('template/wraper', $data, FALSE);
			} else {
				$upload_data = array('uploads' => $this->upload->data());
				$config['image_library'] = 'gd2';
				$config['source_image'] = './file/' . $upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);
				$data = array(
					'dokumen' => $upload_data['uploads']['file_name'],
					'jenis_dokumen' => $this->input->post('jenis_dokumen'),
					'nama_dokumen' => $this->input->post('nama_dokumen'),
					'keterangan' => $this->input->post('keterangan'),
				);
				$this->M_kelola_dokumen->insert_data($data);
				$this->session->set_flashdata('flash', 'Ditambahkan');
				redirect('kelola');
			}
		}
		$data = array(
			'title' => 'TAMBAH DATA',
			'isi' => 'kelola_dokumen/v_tambah',
		);
		$this->load->view('template/wraper', $data, FALSE);
	}

	public function edit($id)
	{
		$data = array(
			'title' => 'EDIT DATA',
			'isi' => 'kelola_dokumen/v_edit',
		);

		$data['tbl_coba'] = $this->M_kelola_dokumen->get_data_by_id($id);
		$data['jenis_dokumen'] = ['Png', 'Jpg', 'Docx', 'Pdf', 'Xlsx'];

		$this->form_validation->set_rules('jenis_dokumen', 'Jenis Dokumen', 'required');
		$this->form_validation->set_rules('nama_dokumen', 'Nama Dokumen', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/wraper', $data, FALSE);
		} else {
			$this->M_kelola_dokumen->update_data();
			$this->session->set_flashdata('flash', 'Diubah');
			redirect('kelola');
		}
		$this->load->view('template/wraper', $data, FALSE);
	}

	public function hapus($id)
	{

		$this->M_kelola_dokumen->delete_data($id);
		$this->session->set_flashdata('flash', 'Dihapus');
		redirect('kelola');
	}

	public function download()
	{
		$dokumen = $_GET['dokumen'];
		$pth    =   file_get_contents(base_url() . "file/" . $dokumen);
		force_download($dokumen, $pth);
	}
}
