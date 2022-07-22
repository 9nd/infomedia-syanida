<?php
require APPPATH . '/controllers/Inbox/Inbox_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Inbox extends CI_Controller
{
	private $log_key, $log_temp, $title;
	function __construct()
	{
		parent::__construct();
		$this->load->model('Custom_model/Sys_message_model', 'sys_message');
		$this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
		$this->log_key = 'log_Status_call';
		$this->title = new Inbox_config();
	}


	public function index()
	{
		$this->load->library('pagination');


		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);

		$data = array(
			'title_page_big'		=> 'INBOX',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'Status_call/Status_call/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'Status_call/Status_call/create',
			'link_update'			=> site_url() . 'Status_call/Status_call/update',
			'link_delete'			=> site_url() . 'Status_call/Status_call/delete_multiple',
			'link_compose'			=> site_url() . 'Inbox/Inbox/compose',
			'link_inbox'			=> site_url() . 'Inbox/Inbox',
			'jumlah_new'			=> $this->sys_message->live_query("SELECT id FROM sys_message WHERE status_read=0 AND to_user_id = '$logindata->id_user' GROUP BY group_id")->num_rows()
		);
		$data['id_login'] = $logindata->id_user;
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$num_inbox = $this->sys_message->live_query("
		SELECT id as jumlah_data FROM sys_message where subject != '' AND (to_user_id = '$logindata->id_user' OR from_user_id='$logindata->id_user')
		GROUP BY datetime
		ORDER BY datetime DESC
	");
		//konfigurasi pagination
		$config['base_url'] = site_url('Inbox/Inbox/index'); //site url
		$config['total_rows'] = count($num_inbox->result_array()); //total row
		$config['per_page'] = 10;  //show record per halaman
		$config["uri_segment"] = 4;  // uri parameter
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);

		// Membuat Style pagination untuk BootStrap v4
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
		$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		//panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
		$limit = $config["per_page"];
		$offset = $data['page'];

		$data['data'] = $this->sys_message->live_query("
		SELECT sys_message.*, sys_user.nama, sys_user.opt_level	
		FROM
		sys_message 
		INNER JOIN
		sys_user
		on sys_message.from_user_id = sys_user.id
		WHERE
		SUBJECT != '' 
		AND (to_user_id = '$logindata->id_user' OR from_user_id='$logindata->id_user')
		GROUP BY datetime 
		ORDER BY datetime DESC
		LIMIT $limit offset $offset			
		");

		$data['controller'] = $this;
		$data['pagination'] = $this->pagination->create_links();

		$this->template->load('Inbox/list', $data);
	}

	function get_inbox()
	{
		// $data['controller'] = $this;
		// $start_filter = date('Y-m-d');


		$where_agent = array("opt_level" => 8);

		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$this->load->model('Custom_model/Sys_user_table_model', 'sys_user');
		$this->load->model('Custom_model/Sys_message_model', 'sys_message');
		$this->load->model('Custom_model/Sys_user_moss_model', 'Sys_user_moss');
		$this->load->model('Custom_model/Trans_profiling_verifikasi_infomedia_model', 'trans_profiling_verifikasi');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$iduser = $logindata->id_user;
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $iduser));
		$now = date('Y-m-d');
		$datetime = date('Y-m-d H:i:s');
		$query_tarik_inbox = $this->sys_message->live_query(
			"SELECT id FROM sys_message WHERE to_user_id = '$iduser' AND status_read = 0"
		);
		$data['get_inbox'] = count($query_tarik_inbox->result_array());

		$query_trans_profiling = $this->trans_profiling_verifikasi->live_query(
            "SELECT tgl_insert FROM trans_profiling_validasi_mos 
             WHERE DATE_FORMAT(tgl_insert ,'%Y-%m-%d') = '$now' AND TIMESTAMPDIFF(SECOND, tgl_insert, NOW()) > 100 AND status = 0 AND reason_call = 0
            "
		);
		$agent_moss=$this->Sys_user_moss->get_results(array("join"=>array("shift_moss"=>"sys_user_moss.shift = shift_moss.id"),"DATE_FORMAT(sys_user_moss.periode_start,'%Y-%m-%d') <="=>$now,"DATE_FORMAT(sys_user_moss.periode_end,'%Y-%m-%d') >="=>$now),array("sys_user_moss.*,shift_moss.keterangan,shift_moss.id as id_shift,"));
		$waiting = count($query_trans_profiling->result_array());
		
		if($agent_moss['num'] > 0){
			
			foreach($agent_moss['results'] as $agm){
				$shift=explode(" - ",$agm->keterangan);
				$start=strtotime($now.' '.$shift[0].date(':s'));
				$end=strtotime($now.' '.$shift[1].date(':s'));
				if($agm->id_shift == 3){
					$end=strtotime("+1 day",strtotime($now.' '.$shift[1].date(':s')));
					
				}
				
				$todatetime=strtotime($datetime);
				
				if($end >= $todatetime && $start <= $todatetime){
					if($waiting > 0){
						if($agm->agentid == $userdata->agentid){
							$data['waiting']=$waiting;
						}
					}
				}
			}
		}
       
		echo json_encode($data);
	}
	public function compose()
	{
		$data = array(
			'title_page_big'		=> 'COMPOSE',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'Status_call/Status_call/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'Status_call/Status_call/create',
			'link_update'			=> site_url() . 'Status_call/Status_call/update',
			'link_delete'			=> site_url() . 'Status_call/Status_call/delete_multiple',
			'link_compose'			=> site_url() . 'Inbox/Inbox/compose',
			'link_inbox'			=> site_url() . 'Inbox/Inbox',
			'link_save'				=> site_url() . 'Inbox/Inbox/create_action',
			'jumlah_new'			=> $this->sys_message->live_query("SELECT id FROM sys_message WHERE status_read=0 AND to_user_id = '$logindata->id_user' GROUP BY group_id")->num_rows()

		);
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$userdata = $this->Sys_user_table_model->get_row(array("id" => $logindata->id_user));
		$filter_agent = array("or_where_null" => "(opt_level = 8 OR opt_level=9)");
		$data['user_categori'] = '-';
		if ($userdata->opt_level == 8) {
			$filter_agent = array("agentid" => $userdata->tl);
			$data['user_categori'] = $userdata->opt_level;
		}
		// if ($userdata->opt_level == 9) {
		// 	$filter_agent = array("tl" => $userdata->agentid);
		// 	$data['user_categori'] = $userdata->opt_level;
		// }
		$data['list_agent_d'] = $this->sys_user->get_results($filter_agent);

		$this->template->load('Inbox/compose', $data);
	}
	public function read()
	{
		$this->load->library('pagination');
		$data = array(
			'title_page_big'		=> 'READ',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url() . 'Status_call/Status_call/refresh_table/' . $this->_token,
			'link_create'			=> site_url() . 'Status_call/Status_call/create',
			'link_update'			=> site_url() . 'Status_call/Status_call/update',
			'link_delete'			=> site_url() . 'Status_call/Status_call/delete_multiple',
			'link_compose'			=> site_url() . 'Inbox/Inbox/compose',
			'link_inbox'			=> site_url() . 'Inbox/Inbox',
			'link_save'				=> site_url() . 'Inbox/Inbox/create_action',
			'jumlah_new'			=> $this->sys_message->live_query("SELECT id FROM sys_message WHERE status_read=0 AND to_user_id = '$logindata->id_user' GROUP BY group_id")->num_rows()

		);
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);

		$post = $this->input->post();
		if (isset($post['group_id'])) {
			$val['from_user_id'] = $logindata->id_user;
			$val['group_id'] = $_POST['group_id'];
			$group_id = $_POST['group_id'];
			$val['conten'] = $_POST['conten'];
			$val['subject'] = $_POST['subject'];
			$val['datetime'] = date('Y-m-d H:i:s');
			$all_group = $this->sys_message->live_query(
				"	SELECT * FROM sys_message 
			where group_id='$group_id' AND to_user_id != '$logindata->id_user'
				GROUP BY to_user_id
			"
			);
			$all_group = $all_group->result_array();
			if (count($all_group) > 0) {
				foreach ($all_group as $r_data) {
					$val['to_user_id'] = $r_data['to_user_id'];
					$this->sys_message->add($val);
				}
			} else {
				$all_group = $this->sys_message->get_row(array("group_id" => $val['group_id'], "from_user_id !=" => $logindata->id_user));

				$val['to_user_id'] = $all_group->from_user_id;
				$this->sys_message->add($val);
			}
			redirect(base_url() . "Inbox/Inbox/read?group_id=" . $val['group_id']);
		}
		$group_id = $this->input->get('group_id');
		$data['group_id'] = $this->input->get('group_id');
		if ($group_id) {

			////////////////

			$list = $this->sys_message->live_query("
			SELECT sys_message.*,sys_user.nama,sys_user.agentid,sys_user.picture FROM sys_message LEFT JOIN sys_user ON sys_message.from_user_id = sys_user.id where group_id='$group_id'
			GROUP BY sys_message.datetime
			ORDER BY sys_message.datetime DESC
		");


			// $page = $this->uri->segment(4);
			$page = $this->input->get('start');

		
			$batas =  10; 
			if (!$page) :
				$offset = 0;
			else :
				$offset = $page;
			endif;

			$config['page_query_string'] = TRUE;
			$config['base_url'] 				 = base_url() . 'Inbox/Inbox/read?group_id=' . $group_id;
			$config['total_rows'] 			 = COUNT($list->result_array());

			$config['per_page'] = $batas;  //show record per halaman
			$config["uri_segment"] = $offset;  // uri parameter
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = floor($choice);
			



			$config['first_link']       = 'First';
			$config['last_link']        = 'Last';
			$config['next_link']        = 'Next';
			$config['prev_link']        = 'Prev';
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close']    = '</span></li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close']  = '</span>Next</li>';
			$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close']  = '</span></li>';


			$this->pagination->initialize($config);
			// $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			// $limit = $config["per_page"];
			// $offset = $data['page'];

			$data['pagination']	 = $this->pagination->create_links();
			$data['jumlah_page'] = $page;
			$data['data'] = $this->sys_message->live_query("
			SELECT sys_message.*,sys_user.nama,sys_user.agentid,sys_user.picture FROM sys_message LEFT JOIN sys_user ON sys_message.from_user_id = sys_user.id where group_id='$group_id'
			GROUP BY sys_message.datetime
			ORDER BY sys_message.datetime DESC
			LIMIT $batas offset $offset
		");


			//////////////////////
			$this->sys_message->edit(array("group_id" => $group_id, "to_user_id" => $logindata->id_user), array("status_read" => 1));
			$data['subject'] = $data['data']->result()->subject;
			$this->template->load('Inbox/read', $data);
		}
	}

	public function refresh_table($token)
	{
		if ($token == $this->_token) {
			$row = $this->tmodel->get_all();

			//encode id 
			$tm = time();
			$this->session->set_userdata($this->log_key, $tm);
			$x = 0;
			foreach ($row as $val) {
				$idgenerate = _encode_id($val['id'], $tm);
				$row[$x]['id'] = $idgenerate;
				$x++;
			}


			$o = new Outputview();
			$o->success	= 'true';
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
			'link_save'				=> site_url() . 'Status_call/Status_call/create_action',
			'link_back'				=> $this->agent->referrer(),
		);

		$this->template->load('Status_call/Status_call_form', $data);
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
		if (!$o->not_empty($val['agentid'], '#agentid')) {
			echo $o->result();
			return;
		}
		if (!$o->not_empty($val['subject'], '#subject')) {
			echo $o->result();
			return;
		}
		if (!$o->not_empty($val['conten'], '#conten')) {
			echo $o->result();
			return;
		}



		$agentid =  explode(",", $val['agentid']);

		if (isset($val['agentid'])) {
			if ($agentid) {
				if (count($agentid) > 1) {
					$n_agent_pick = count($agentid);
					foreach ($agentid as $k_agentid => $v_agentid) {
						if ($k_agentid == 0) {
							$where_agent_multi = "( agentid = '$v_agentid'";
						} else {
							if ($k_agentid == ($n_agent_pick - 1)) {
								$where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' )";
							} else {
								$where_agent_multi = $where_agent_multi . " OR agentid = '$v_agentid' ";
							}
						}
					}
					$where_agent['or_where_null'] = array($where_agent_multi);
				} else {
					$where_agent['agentid'] = $agentid[0];
				}
			}
		}


		switch ($val['agentid']) {
			default:
				$agent = $this->sys_user->get_results($where_agent, array("id,nama,agentid,kategori"));
				break;
			case 1:
				$agent = $this->sys_user->get_results(array(), array("id,nama,agentid,kategori"));
				break;
			case 2:
				$agent = $this->sys_user->get_results(array("opt_level" => 8), array("id,nama,agentid,kategori"));
				break;
			case 3:
				$agent = $this->sys_user->get_results(array("opt_level" => 9), array("id,nama,agentid,kategori"));
				break;
			case 4:
				$agent = $this->sys_user->get_results(array("opt_level" => 6), array("id,nama,agentid,kategori"));
				break;
			case 5:
				$agent = $this->sys_user->get_results(array("opt_level" => 7), array("id,nama,agentid,kategori"));
				break;
		}
		// //mencegah data kosong
		// if(!$o->not_empty($val['nama_reason'],'#nama_reason')){
		// 	echo $o->result();	
		// 	return;
		// }
		unset($val['agentid']);
		$this->load->model('sys/Sys_user_log_model', 'log_login');
		$this->load->model('Custom_model/Sys_user_table_model', 'Sys_user_table_model');
		$idlogin = $this->session->userdata('idlogin');
		$logindata = $this->log_login->get_by_id($idlogin);
		$val['from_user_id'] = $logindata->id_user;
		$val['group_id'] = time();
		$val['datetime'] = date('Y-m-d H:i:s');



		if ($agent['num'] > 1) {
			foreach ($agent['results'] as $r_a) {
				$val['to_user_id'] = $r_a->id;
				$success = $this->sys_message->add($val);
			}
		}

		if ($agent['num'] == 1) {
			// unset($val['group_id']);
			foreach ($agent['results'] as $r_a) {
				$val['to_user_id'] = $r_a->id;
				$success = $this->sys_message->add($val);
			}
		}
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
				'link_save'				=> site_url() . 'Status_call/Status_call/update_action',
				'link_back'				=> $this->agent->referrer(),
				'data'					=> $row,
				'id'					=> $id_generate,
			);

			$this->template->load('Status_call/Status_call_form', $data);
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
		if (!$o->not_empty($val['id_reason'], '#id_reason')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('id_reason' => $val['id_reason']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#id_reason')) {
			echo $o->result();
			return;
		}

		//mencegah data kosong
		if (!$o->not_empty($val['nama_reason'], '#nama_reason')) {
			echo $o->result();
			return;
		}

		//mencegah data double
		$field = array('nama_reason' => $val['nama_reason']);
		$exist = $this->tmodel->if_exist($val['id'], $field);
		if (!$o->not_exist($exist, '#nama_reason')) {
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
/* Generated by YBS CRUD Generator 2020-01-12 19:58:23 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/
