<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kelola_dokumen/M_kelola_dokumen');
		$this->load->library('form_validation');
		$this->load->helper(array('url', 'download'));
	}

	public function index()
	{
		// $json = file_get_contents("./assets/MOCK_DATA.json");
		// $obj  = json_decode($json);
		$data = array(
			'title' => 'KELOLA DATA',
			'isi' => 'Kelola_dokumen/v_kelola',
			// 'list_data' => $obj
		);

		$data['t_dokumen'] = $this->M_kelola_dokumen->get_data('t_dokumen')->result();
		$this->template->load('Kelola_dokumen/v_kelola', $data);
	}

	public function tambah()
	{
		$this->form_validation->set_rules('nama_dokumen', 'Nama Dokumen', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

		if ($this->form_validation->run() == TRUE) {
			$config['upload_path']          = './images/upload_files/file/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg|docx|pdf|xlsx';
			$config['max_size']             = 50000;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('dokumen')) {
				$data = array(
					'title' => 'TAMBAH DATA',
					'isi' => 'Kelola_dokumen/v_tambah',
				);
				// echo "alert('test')";
				$this->template->load('Kelola_dokumen/v_tambah', $data, FALSE);
			} else {
				$upload_data = array('uploads' => $this->upload->data());
				$config['image_library'] = 'gd2';
				$config['source_image'] = './images/upload_files/file/' . $upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);
				$data = array(
					'dokumen' => $upload_data['uploads']['file_name'],
					'nama_dokumen' => $this->input->post('nama_dokumen'),
					'keterangan' => $this->input->post('keterangan'),
				);
				$this->M_kelola_dokumen->insert_data($data);
				$this->session->set_flashdata('flash', 'Ditambahkan');
				redirect('Kelola_dokumen/kelola');
				// echo "alert('tes1')";
			}
		}
		$data = array(
			'title' => 'TAMBAH DATA',
			'isi' => 'Kelola_dokumen/v_tambah',
		);
		$this->template->load('Kelola_dokumen/v_tambah', $data, FALSE);
		// echo "alert('tests2')";
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('nama_dokumen', 'Nama Dokumen', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

		if ($this->form_validation->run() == TRUE) {
			$config['upload_path']          = './images/upload_files/file/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg|docx|pdf|xlsx';
			$config['max_size']             = 50000;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('dokumen')) {
				$data = array(
					'title' => 'EDIT DATA',
					't_dokumen' => $this->M_kelola_dokumen->get_data_by_id($id),
					'isi' => 'Kelola_dokumen/v_edit',
				);
				$this->template->load('kelola_dokumen/v_edit', $data, FALSE);
			} else {
				$upload_data = array('uploads' => $this->upload->data());
				$config['image_library'] = 'gd2';
				$config['source_image'] = './images/upload_files/file/' . $upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);
				$data = array(
					'id' => $id,
					'dokumen' => $upload_data['uploads']['file_name'],
					'nama_dokumen' => $this->input->post('nama_dokumen'),
					'keterangan' => $this->input->post('keterangan'),
				);
				$this->M_kelola_dokumen->update_data($data);
				$this->session->set_flashdata('flash', 'Diubah');
				redirect('kelola_dokumen/kelola');
			}
		}
		$data = array(
			'title' => 'EDIT DATA',
			't_dokumen' => $this->M_kelola_dokumen->get_data_by_id($id),
			'isi' => 'kelola_dokumen/v_edit',
		);
		$this->template->load('kelola_dokumen/v_edit', $data, FALSE);
	}

	public function hapus($id)
	{

		$this->M_kelola_dokumen->delete_data($id);
		$this->session->set_flashdata('flash', 'Dihapus');
		redirect('Kelola_dokumen/Kelola');
	}

	public function download()
	{
		$dokumen = $_GET['dokumen'];
		$pth    =   file_get_contents(base_url() . "./images/upload_files/file/" . $dokumen);
		force_download($dokumen, $pth);
	}
}
