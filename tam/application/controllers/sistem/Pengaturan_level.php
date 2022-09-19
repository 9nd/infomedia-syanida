<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_level extends CI_Controller {
	private $log_key,$log_temp;
    function __construct(){
        parent::__construct();
		$this->load->model('sys/Sys_level_model','tmodel');
		$this->log_key ="log_pengaturan_level";
    }


	public function index(){
		$data = array(
			'title_page_big'			=> 'Level Konfigurasi',
			'link_refresh_table'		=> site_url().'sistem/Pengaturan_level/refresh_table/'.$this->_token,
			'link_create'				=> site_url().'sistem/Pengaturan_level/create',
			'link_update'				=> site_url().'sistem/Pengaturan_level/update',
			'link_delete'				=> site_url().'sistem/Pengaturan_level/delete_multiple',		
		);
		$this->template->load('sistem/Level_list',$data);
	}
	
	
	// public function refresh_table($token){
		// if($token==$this->_token && $this->_user_id==1){
			// $row = $this->tmodel->get_all();
			
			// $tm = time();
			// $this->session->set_userdata($this->log_key,$tm);
			// $x = 0;
			// foreach($row as $val){
				// $idgenerate = _encode_id($val['id'],$tm);
				// $row[$x]['id'] = $idgenerate;
				// $x++;
			// }
			
			// $o=new Outputview();
			// $o->success		 = 'true';
			// $o->message		 = $row;
			// echo $o->result(); 
		// }else{
			// redirect("Auth");
		// }
	// }
	
	public function refresh_table($token){
		if($token==$this->_token && $this->_user_id==1){
			$row = $this->tmodel->json();
			
			//encode id 
			$tm = time();
			$this->session->set_userdata($this->log_key,$tm);
			$x = 0;
			foreach($row['data'] as $val){
				$idgenerate = _encode_id($val['id'],$tm);
				$row['data'][$x]['id'] = $idgenerate;
				$x++;
			}
			
			$o = new Outputview();
			$o->success	= 'true';
			$o->serverside	= 'true';
			$o->message	= $row;
			
			echo $o->result();
			

		}else{
			redirect('Auth');
		}
	}
	
	
	public function create(){
		
		$data = array(
			'title_page_big'				=> 'Level Baru',
			'id'							=> '',
			'nmlevel'						=> '',
			'opt_status'					=> '',
			'link_back'						=>  $this->agent->referrer(),
			'selected_status'				=> '1',
			'link_save'						=> site_url().'sistem/Pengaturan_level/create_action'	,
			'data_url'						=> $this->get_table_url(),
			'data_menu'						=> $this->get_table_menu(),

		);

		$this->template->load('sistem/Level_form',$data);
		
		
	}
	public function create_action(){
		$data 	= $this->input->post('data_ajax',true);
		$val	= json_decode($data,true);
		unset($val['id']);
		$o = new Outputview();
		
		//melakukan validasi ulang
		if($val['nmlevel']==""){
			$o->success 	= 'false';
			$o->message 	= 'Nama Level Belum disi !';
			$o->elementid	= '#input-nama-level';
			echo $o->result(); 
			return;
		}
		
		$nm = array('nmlevel'=> $val['nmlevel']);
		$exist = $this->tmodel->if_exist('', $nm);
		if($exist){
			$o->success 	= 'false';
			$o->message 	= 'Nama level sudah di gunakan !';
			$o->elementid	= '#input-nama-level';
			echo $o->result(); 
			return;
		}
		
		$status  = $this->tmodel->insert($val);
		
		$o->success 	= 'true';
		$o->message	= 'Level berhasil di buat';
		echo $o->result();
	}
	
	
	public function update($id){
		$id 			= $this->security->xss_clean($id);
		$id_generate	= $id;
		$this->log_temp	= $this->session->userdata($this->log_key);
		
		//important !! tempdata digunakan sbagai antisipasi
		//perubahan session saat membuka tab baru secara bersamaan
		$this->session->set_tempdata($id,$this->log_temp,300);
		
		//mengembalikan id asli
		$id = _decode_id($id,$this->log_temp);
		
		$row = $this->tmodel->get_by_id($id);
		
		if($row){
		
			$data = array(
			'title_page_big'				=> 'Update Level <b>' .  $row->nmlevel.'</b>',
			'id'							=> $id_generate,
			'nmlevel'						=> $row->nmlevel,
			'link_back'						=> $this->agent->referrer(),
			'selected_status'				=> $row->opt_status,
			'link_save'						=> site_url().'sistem/Pengaturan_level/update_action'	,
			'data_url'						=> $this->get_table_url($id),
			'data_menu'						=> $this->get_table_menu($id),
			);

			$this->template->load('sistem/Level_form',$data);
		}else{
			redirect($this->agent->referrer());
		}
		
		
	}
	public function update_action(){
		$data 	 			= $this->input->post('data_ajax',true);
		$val				= json_decode($data,true);
		
		$this->log_temp		= $this->session->tempdata($val['id']);
		$val['id']			= _decode_id($val['id'],$this->log_temp);
		
		$o = new Outputview();
		
		//melakukan validasi ulang
		if($val['nmlevel']==""){
			$o->success 	= 'false';
			$o->message 	= 'Nama Level Belum disi !';
			$o->elementid	= '#input-nama-level';
			echo $o->result(); 
			return;
		}
		
		$nm = array('nmlevel'=> $val['nmlevel']);
		$exist = $this->tmodel->if_exist($val['id'], $nm);
		if($exist){
			$o->success 	= 'false';
			$o->message 	= 'Nama level sudah di gunakan !';
			$o->elementid	= '#input-nama-level';
			echo $o->result(); 
			return;
		}
		

		$success = $this->tmodel->update($val);
		if($success){
			$o->success  	= 'true';
			$o->message 	= 'Berhasil di update';
			$o->elementid	= '';
			echo $o->result(); 	
		
		}else{
			$o->success  	= 'false';
			$o->message 	= 'Gagal memproses data';
			$o->elementid	= '';
			echo $o->result(); 
		
		}
		

		
		
	}
	
	private function get_table_url($id=null){
		$auth_form=array();
		if($id !==null){
			$this->load->model('sys/Sys_authorized_model','tmodel1');
			$auth_form = $this->tmodel1->get_all_by_idlevel($id); 
		}
		
		$this->load->model('sys/Sys_form_model','tmodel2');
		$row = $this->tmodel2->get_all();

		$x=0;
		foreach($row as $val_form){
			$row[$x]['no']		 = $x+1;
			$row[$x]['checked'] = " ";
			foreach($auth_form as $val_auth){
				if($val_form['id'] ==$val_auth['id_form']){
					$row[$x]['checked'] = " checked ";	
				}
			}
			$x++;
		}
		
		return json_encode($row);
	}
	
	private function get_table_menu($id=null){
		$auth_menu=array();
		if($id !==null){
			$this->load->model('sys/Sys_authorized_menu_model','tmodel3');	
			$auth_menu	 = $this->tmodel3->get_all_by_idlevel ($id);
		}
		
		$this->load->model('sys/Menu_model','tmodel4');
		$parent_menu = $this->tmodel4->get_parent_menu();
		$child_menu	 = $this->tmodel4->get_all_child_menu(); 
		
		$list_menu = array();
		$menu=array();
		
		$x=0;		
		foreach($parent_menu as $val_parent){
			$menu['no']			= $x+1;	
			$menu['menu_utama'] = $val_parent['name'];
			$menu['id_menu'] 	= $val_parent['id'];
			$menu['sub_menu']	= '#';
			$menu['link'] 		= $val_parent['link'];
			$menu['icon'] 		= $val_parent['icon'];
			$menu['checked']	= ' ';
			$menu['type_menu']	= '<b>MENU UTAMA</b>';
			
			$list_menu[$x] = $menu;
			
			foreach($child_menu as $val_child){
				if($val_parent['id'] == $val_child['is_parent']){
					$x++;
					$menu['no']			= $x+1;	
					$menu['menu_utama'] = $val_parent['name'];
					$menu['id_menu'] 	= $val_child['id'];
					$menu['sub_menu']	= $val_child['name'];
					$menu['link'] 		= $val_child['link'];
					$menu['icon'] 		= $val_child['icon'];
					$menu['checked']	= ' ';
					$menu['type_menu']	= 'SUB MENU';
					$list_menu[$x] = $menu;
				}
			}
			$list_menu[$x] = $menu;
			$x++;
		}
		
		$x=0;
		foreach($list_menu as $val_list){
			foreach($auth_menu as $val_auth){
				if($val_list['id_menu']==$val_auth['id_menu']){
				 $list_menu[$x]['checked'] = ' checked ';	
				}
			}
			$x++;
		}
		
		
		return json_encode($list_menu);
		
	}
	
	public function delete_multiple(){
		$data=$this->input->get('data_ajax',TRUE);
		$val=json_decode($data,TRUE);
		$data = explode(',',$val['data_delete']);

		//get key generate
		$log_id = $this->session->userdata($this->log_key);
		$xx=0;
		foreach($data as $value){
			$value =  _decode_id($value,$log_id);
			
			if($value=='1'){
				 $o = new Outputview();
				 $o->success = 'false';
				 $o->message = 'Opps..level configurator tidak dapat di hapus !! block by system';
				 echo $o->result();
				 return;
			}
			
			//menganti ke id asli
			$data[$xx] = $value;
			$xx++;	
		}
		
		$this->tmodel->delete_multiple($data);
		$o = new Outputview();
		$o->success 	= 'true';
		$o->message		= 'Level di hapus';
		echo $o->result();
		
	}
	
	
	
}
