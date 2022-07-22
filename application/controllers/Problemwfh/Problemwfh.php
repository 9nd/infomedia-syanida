<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Problemwfh extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Problemwfh/Problemwfh_model', 'modelcrud');
		$this->load->library('upload');
		$this->load->library('pagination');
		$this->load->helper('url');
	}

	// fungsi untuk mengambil data
	public function index()
	{

		$cari = $this->input->get('cari');
		$page = $this->input->get('per_page');

		$search = array('id_agent' => $cari);

		$batas =  9; // 9 data per page
		if (!$page) :
			$offset = 0;
		else :
			$offset = $page;
		endif;

		$config['page_query_string'] = TRUE;
		$config['base_url'] 				 = base_url() . 'index.php/home/?cari=' . $cari;
		$config['total_rows'] 			 = $this->modelcrud->jumlah_row($search);

		$config['per_page'] 				 = $batas;
		$config['uri_segment'] 			 = $page;

		$config['full_tag_open'] 		= '<ul class="pagination">';
		$config['full_tag_close'] 	= '<ul>';

		$config['first_link'] 			= 'first';
		$config['first_tag_open'] 	= '<li><a>';
		$config['first_tag_close'] 	= '</a></li>';

		$config['last_link'] 				= 'last';
		$config['last_tag_open']	 	= '<li><a>';
		$config['last_tag_close'] 	= '</a></li>';

		$config['next_link'] 				= '&raquo;';
		$config['next_tag_open'] 		= '<li><a>';
		$config['next_tag_close'] 	= '</a></li>';

		$config['prev_link'] 				= '&laquo;';
		$config['prev_tag_open'] 		= '<li><a>';
		$config['prev_tag_close'] 	= '</a></li>';

		$config['cur_tag_open'] 		= '<li class="active"><a>';
		$config['cur_tag_close'] 		= '</a></li>';

		$config['num_tag_open'] 		= '<li><a>';
		$config['num_tag_close'] 		= '</a></li>';

		$this->pagination->initialize($config);
		$data['pagination']	 = $this->pagination->create_links();
		$data['jumlah_page'] = $page;


		//$data['data'] = $this->modelcrud->get($batas, $offset, $search);
		$data['namaagent'] = $this->modelcrud->live_query("SELECT 
		log_problemwfh.id AS idproblem,
		log_problemwfh.*,
		sys_user.id,
		sys_user.tl,
		sys_user.nama
		FROM log_problemwfh
		LEFT JOIN sys_user
		ON sys_user.id = log_problemwfh.id_agent
		")->result();

		$this->template->load('Problemwfh/home', $data);
	}

	// untuk menampilkan halaman tambah data
	public function tambah()
	{
		$data = array();
		$queryjoin = $this->modelcrud->live_query("SELECT 
	log_problemwfh.*,
	sys_user.id,
	sys_user.tl,
	sys_user.nama
	FROM log_problemwfh
	LEFT JOIN sys_user
	ON sys_user.id = log_problemwfh.id_agent
	");
		$queryjoin2 = $this->modelcrud->live_query("SELECT * FROM sys_user WHERE opt_level = 8 AND tl <> '-'  ORDER BY tl");
		$data['listagent'] = $queryjoin2->result();
		$data['namaagent'] = $queryjoin->result();

		return $this->template->load('Problemwfh/tambah_data', $data);
	}

	// untuk memasukan data ke database
	public function insertdata()
	{
		$id_agent   = $this->input->post('id_agent');
		$kendala   = $this->input->post('kendala');
		$solusi   = $this->input->post('solusi');
		$waktu_kejadian   = $this->input->post('waktu_kejadian');

		// get foto
		$tm = time();
		$config['upload_path'] = './images/upload_files/log_problemwfh/';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size'] = '2048';  //2MB max
		$config['max_width'] = '4480'; // pixel
		$config['max_height'] = '4480'; // pixel
		//$config['file_name'] = $_FILES['fotopost']['name'];
		$config['file_name']			= $this->input->post('id_agent') . '_' . $tm . '.jpg';

		$this->upload->initialize($config);

		if (!empty($_FILES['fotopost']['name'])) {
			if ($this->upload->do_upload('fotopost')) {
				$foto = $this->upload->data();
				$data = array(
					'id_agent'       => $id_agent,
					'kendala'       => $kendala,
					'solusi'     => $solusi,
					'attachment' => $config['file_name'],
					'waktu_kejadian' => $waktu_kejadian,
				);
				$this->modelcrud->insert($data);
				redirect('Problemwfh/Problemwfh/index');
			} else {
				die("gagal upload");
			}
		} else {
			echo "tidak masuk";
		}
	}

	// delete
	public function deletedata($id)
	{
		$path = '.images/user_profile/uploadlog/';
		@unlink($path);

		$where = array('id' => $id);
		$this->modelcrud->delete($where);
		redirect('Problemwfh/Problemwfh/index');
	}

	// edit
	public function edit($idproblem)
	{

		$data = array();
		$kondisi = array('id' => $idproblem);
		$queryjoin = $this->modelcrud->live_query("SELECT 
	log_problemwfh.*,
	sys_user.id,
	sys_user.tl,
	sys_user.nama
	FROM log_problemwfh
	LEFT JOIN sys_user
	ON sys_user.id = log_problemwfh.id_agent
	");
		$queryjoin2 = $this->modelcrud->live_query("SELECT * FROM sys_user WHERE opt_level = 8 AND tl <> '-'  ORDER BY tl");
		$data['listagent'] = $queryjoin2->result();
		$data['namaagent'] = $queryjoin->result();
		$data['data'] = $this->modelcrud->get_by_id($kondisi);

		return $this->template->load('Problemwfh/edit_data', $data);
	}

	// update
	public function updatedata()
	{
		$id   = $this->input->post('id');
		$id_agent   = $this->input->post('id_agent');
		$idproblem   = $this->input->post('idproblem');
		$kendala   = $this->input->post('kendala');
		$solusi   = $this->input->post('solusi');
		$waktu_kejadian   = $this->input->post('waktu_kejadian');


		$path = './images/upload_files/log_problemwfh/';

		$kondisi = array('id' => $id);

		$tm = time();
		$config['upload_path'] = './images/upload_files/log_problemwfh/';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size'] = '2048';  //2MB max
		$config['max_width'] = '4480'; // pixel
		$config['max_height'] = '4480'; // pixel
		//$config['file_name'] = $_FILES['fotopost']['name'];
		$config['file_name']			= $this->input->post('id_agent') . '_' . $tm . '.jpg';

		$this->upload->initialize($config);

		if (!empty($_FILES['fotopost']['name'])) {
			if ($this->upload->do_upload('fotopost')) {
				$foto = $this->upload->data();
				$data = array(
					'id_agent'       => $id_agent,
					'kendala'       => $kendala,
					'solusi'     => $solusi,
					'waktu_kejadian'     => $waktu_kejadian,
				);
				// hapus foto pada direktori
				@unlink($path . $this->input->post('filelama'));

				$this->modelcrud->update($data, $kondisi);
				redirect('Problemwfh/Problemwfh/index');
			} else {
				die("gagal update");
			}
		} else {
			echo "tidak masuk";
		}
		redirect('Problemwfh/Problemwfh/index');
	}
} // end class
