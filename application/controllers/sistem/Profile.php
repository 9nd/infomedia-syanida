<?php
class Profile extends CI_Controller
{
	private $log_key, $log_temp;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sys/Sys_user_model', 'tmodel');
		$this->log_key = "log_profile_pengguna";
	}

	public function setting()
	{
		$data = array();
		$data['title_page_big'] = 'Setting Profile';
		$data['nmuser']			= $this->_user_name;
		$data['link_update']	= site_url() . 'sistem/Profile/update/' . $this->_token;
		$data['link_check']		= site_url() . 'sistem/Profile/check/' . $this->_token;

		$this->template->load('sistem/Setting_profile', $data);
	}


	public function update($token)
	{
		if ($token == $this->_token) {
			$data 	= $this->input->post('data_ajax', true);
			$val	= json_decode($data, true);

			$o = new Outputview();
			if ($val['new_pass'] == '') {
				$o->success 	= 'false';
				$o->message		= 'Opss..password baru belum di isi ! ';
				$o->elementid   = '#new-pass';
				echo $o->result();
				return;
			}

			if ($val['re_pass'] == '') {
				$o->success		= 'false';
				$o->message		= 'Opss..konfirmasi password baru belum di isi ! ';
				$o->elementid	= '#re-pass';
				echo $o->result();
				return;
			}

			if ($val['re_pass'] !== $val['new_pass']) {
				$o->success		= 'false';
				$o->message		= 'Opss..password tidak sama';
				$o->elementid	= '#new-pass';
				echo $o->result();
				return;
			}

			$this->load->model('sys/Sys_user_model', 'tuser');

			$pass = _generate($val['new_pass']);
			$d = array('passuser' => $pass);

			$success  = $this->tuser->update_pass($this->_user_id, $d);

			if ($success) {
				$o->success 	= 'true';
				$o->message		= 'password berhasil di update';
				$o->elementid	= '';
				echo $o->result();
			} else {
				$o->success 	= 'false';
				$o->message		= 'Opps..gagal mengupdate password';
				$o->elementid	= '#new-pass';
				echo $o->result();
			}
		} else {
			redirect('Auth');
		}
	}

	public function check($token)
	{
		if ($token == $this->_token) {
			$data 	= $this->input->post('data_ajax', true);
			$val	= json_decode($data, true);

			$o = new Outputview();
			if ($val['old_pass'] == '') {
				$o->success 	= 'false';
				$o->message		= 'Opss..Password belum di isi ! ';
				echo $o->result();
				return;
			}

			$this->load->model('sys/Authorization', 'auth');
			$pass = _generate($val['old_pass']);

			$d = array('nmuser' => $this->_user_name, 'passuser' => $pass);
			$valid = $this->auth->is_valid_password($d);
			if (!$valid) {
				$o->success 	= 'false';
				$o->message		= 'Opss..Password tidak sesuai';
				echo $o->result();
				return;
			}

			$o->success 	= 'true';
			$o->message		= '';
			echo $o->result();
			return;
		} else {
			redirect('Auth');
		}
	}
	function profile()
	{
		$id = $this->_user_id;
		$data 			= $this->security->xss_clean($id);
		$idgenerate		= $id;

		$this->log_temp = $this->session->userdata($this->log_key);
		$this->session->set_tempdata($id, $this->log_temp);

		$id = _decode_id($id, $this->log_temp);

		$row = $this->tmodel->get_by_id($id);

		if ($row) {
			$data = array(
				'title_page_big'		=> 'Update User ' . $row->nmuser,
				'link_save'				=> site_url() . 'sistem/Profile/update_profile_action',
				'link_prepare_picture'	=> site_url() . 'sistem/Profile/prepare_picture/' . $this->_token,
				'link_back'				=> $this->agent->referrer(),
				'selected_status'		=> $row->opt_status,
				'selected_level'		=> $row->opt_level,
				'nmuser'				=> $row->nmuser,
				'nama'				=> $row->nama,
				'kategori'				=> $row->kategori,
				'agentid'				=> $row->agentid,
				'nmpicture'				=> $row->nmuser,
				'nmlevel'				=> $row->nmlevel,
				'id'					=> $idgenerate,
				'data_level'			=> $this->get_level(),
				'picture'				=> base_url() . 'YbsService/get_picture/' . $this->_token . $this->_separator_a . $row->picture,
			);


			//identifikasi yang mengupdate adalah configurator 
			if ($this->_user_id == $id && $id == '1') {
				$this->template->load('sistem/User_form_update_configurator', $data);
			} else {
				$this->template->load('profile/User_form_update', $data);
			}
		} else {
			redirect($this->agent->referrer());
		}
	}
	function update_profile_action()
	{
		$data 	= $this->input->post('data_ajax', true);
		$val	= json_decode($data, true);

		$this->log_temp = $this->session->tempdata($val['id']);

		$val['id']	=	_decode_id($val['id'], $this->log_temp);

		$o = new Outputview();
		if ($val['nmuser'] == "") {
			$o->success = 'false';
			$o->message = 'nama pengguna belum di isi';
			$o->elementid = '#input-nama-user';
			echo $o->result();
			return;
		}

		$field = array();
		$field['nmuser'] = $val['nmuser'];
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if ($exist) {
			$o->success	 = 'false';
			$o->message	 = 'nama pengguna sudah digunakan';
			$o->elementid	 = '#input-nama-user';
			echo $o->result();
			return;
		}


		//set oldpicture
		if ($this->_user_id != '1') {
			unset($val['nama']);
			unset($val['agentid']);
			unset($val['nmuser']);
		}

		$old_p  = $this->tmodel->get_picture_for_update_byid($val['id']);

		$val['oldpicture'] = $old_p->picture;
		$this->tmodel->update($val['id'], $val);

		$o->success  = 'true';
		$o->message = 'data berhasil di update';
		echo $o->result();
	}
	private function get_level()
	{
		$this->load->model('sys/Sys_level_model', 'tlevel');
		$row = $this->tlevel->get_all();
		return $row;
	}
	public function prepare_picture($token)
	{

		if ($token == $this->_token) {
			$tm = time();
			$config['upload_path']          = './images/tmp_user_profile/';
			$config['allowed_types']        = 'jpg|png';
			$config['max_size']             = 60000;
			$config['file_name']			= $this->_user_id . 'xx_xx' . $tm . '.jpg';
			$config['overwrite']			= TRUE;

			$this->reset_image();
			$this->load->library('upload', $config);

			$o = array();
			if (!$this->upload->do_upload('inputfile')) {

				$em = $this->upload->display_errors();
				$em = str_replace('You did not select a file to upload.', 'Tidak ada file yang di pilih', $em);

				$o['success'] 	= 'false';
				$o['message']	= $em;
				$o['elementid'] = '#inputfile';
				$o['sec_val']	=  $this->security->get_csrf_token_name() . "=" . $this->security->get_csrf_hash() . "&";
				$o = json_encode($o);
				echo $o;
				return;
			} else {
				$path_picture = $config['upload_path'] . $config['file_name']; //'';//$this->save_temp_picture();



				$o['success']		= 'true';
				$o['message'] 		= $path_picture;
				$o['original_name']	= $this->upload->data('client_name');
				$o['sec_val']		=  $this->security->get_csrf_token_name() . "=" . $this->security->get_csrf_hash() . "&";
				$o = json_encode($o);
				echo $o;
				return;
			}
		} else {
			redirect("Auth");
		}
	}
	public function prepare_absen()
	{

		// requires php5  
		define('UPLOAD_DIR', './images/user_profile/absen/');
		$img = $_POST['imgBase64'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = UPLOAD_DIR . uniqid() . '.png';
		$success = file_put_contents($file, $data);

		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('Custom_model/Ws_model', 'ws_model');
		$this->load->model('Absensi/Absensi_model', 'absensi');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$cek_ip=$this->ws_model->get_count(array("ipaddress"=>$this->input->ip_address()));
		$methode=1;
		if($cek_ip > 0){
			$methode=0;
		}
		if ($success) {
			$data_insert=array(
				"methode"=>$methode,
				"nama"=>$userdata->nama,
				"agentid"=>$userdata->agentid,
				"nik"=>$userdata->nik_absensi,
				"stts"=>'in',
				"waktu_in"=>date('Y-m-d H:i:s'),
				"picture"=>$file,
				"latitude"=>$_POST['latitude'],
				"longitude"=>$_POST['longitude'],
				"ip_address"=>$this->input->ip_address()
			);
			$this->absensi->add($data_insert);
		}
			  
		// echo distance(32.9697, -96.80322, 29.46786, -98.53506, "M") . " Miles<br>";
		// echo distance(32.9697, -96.80322, 29.46786, -98.53506, "K") . " Kilometers<br>";
		// echo distance(32.9697, -96.80322, 29.46786, -98.53506, "N") . " Nautical Miles<br>";
		print $success ? $file : 'Unable to save the file.';
	}
	public function prepare_absen_pulang()
	{

		// requires php5  
		define('UPLOAD_DIR', './images/user_profile/absen/');
		$img = $_POST['imgBase64'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = UPLOAD_DIR . uniqid() . '.png';
		$success = file_put_contents($file, $data);

		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('Custom_model/Ws_model', 'ws_model');
		$this->load->model('Absensi/Absensi_model', 'absensi');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$cek_ip=$this->ws_model->get_count(array("ipaddress"=>$this->input->ip_address()));
		$methode=1;
		if($cek_ip > 0){
			$methode=0;
		}
		$data_insert=array(
			"methode"=>$methode,
			"nama"=>$userdata->nama,
			"agentid"=>$userdata->agentid,
			"nik"=>$userdata->nik_absensi,
			"stts"=>'out',
			"waktu_in"=>date('Y-m-d H:i:s'),
			"picture"=>$file,
			"latitude"=>$_POST['latitude'],
			"longitude"=>$_POST['longitude'],
			"ip_address"=>$this->input->ip_address()
		);
		$this->absensi->add($data_insert);
		print $success ? $file : 'Unable to save the file.';
	}
	private function reset_image()
	{
		//delete all file temp if create by this user
		$files = glob('./images/tmp_user_profile/*');
		foreach ($files as $file) {
			if (is_file($file)) {
				$fname = basename($file);
				$id_old_pic = explode('xx_xx', $fname);
				if ($id_old_pic[0] == $this->_user_id) {
					unlink($file);
				}
			}
		}
	}
	function distance($lat1, $lon1, $lat2, $lon2, $unit) {
		if (($lat1 == $lat2) && ($lon1 == $lon2)) {
		  return 0;
		}
		else {
		  $theta = $lon1 - $lon2;
		  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		  $dist = acos($dist);
		  $dist = rad2deg($dist);
		  $miles = $dist * 60 * 1.1515;
		  $unit = strtoupper($unit);
	  
		  if ($unit == "K") {
			return ($miles * 1.609344);
		  } else if ($unit == "N") {
			return ($miles * 0.8684);
		  } else {
			return $miles;
		  }
		}
	  }

	  
}
