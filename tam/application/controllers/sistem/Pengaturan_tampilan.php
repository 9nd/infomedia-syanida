<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_tampilan extends CI_Controller {
	var $table_column;
	private $log_key,$log_temp;
    function __construct(){
        parent::__construct();
		$this->load->model('sys/Menu_model','tmodel');
		$this->load->model('sys/Sys_form_model','form_model');
		$this->log_key = 'log_table_menu';
    }


	public function menu_management(){
		$data = array(
			'title_page_big' 				=> '<small>Menu Management</small>',
			'link_refresh_table_menu'		=> site_url().'sistem/Pengaturan_tampilan/refresh_table_menu/'.$this->_token,
			'link_create_menu'				=> site_url().'sistem/Pengaturan_tampilan/create_menu',
			'link_delete'					=> site_url().'sistem/Pengaturan_tampilan/delete_multiple',
			'link_update'					=> site_url().'sistem/Pengaturan_tampilan/update_menu',
			
		);
		$this->template->load('sistem/Menu_list',$data);
	}
	
	public function get_parent_menu($token){
		if($token==$this->_token && $this->_user_id==1){
			$parent_menu =$this->tmodel->get_parent_menu();
			
			$o=new Outputview();
			$o->success = 'true';
			$o->message = $parent_menu;
			echo $o->result(); 
		}else{
			redirect('Auth');
		}
	}
	
	public function refresh_table_menu($token){
		if($token==$this->_token && $this->_user_id==1){
			$parent_menu =$this->tmodel->get_parent_menu();
			$child_menu	 =$this->tmodel->get_all_child_menu(); 
			$list_menu = array();
			$menu=array();
			
			$x=0;
			$tm = time();
			$this->session->set_userdata($this->log_key,$tm);
			
			foreach($parent_menu as $val_parent){
				$menu['menu_utama'] = $val_parent['name'];
				
				$idgenerate			= _encode_id($val_parent['id'],$tm);
				$menu['id_menu'] 	= $idgenerate;
				$menu['sub_menu']	= '#';
				$menu['link'] 		= $val_parent['link'];
				$menu['icon'] 		= $val_parent['icon'];
				$menu['type_menu']	= "<b>MENU UTAMA</b>";
				$list_menu[$x] = $menu;
				
				foreach($child_menu as $val_child){
					if($val_parent['id'] == $val_child['is_parent']){
						$x++;
						$menu['menu_utama'] = $val_parent['name'];
						$idgenerate			= _encode_id($val_child['id'],$tm);
						$menu['id_menu'] 	= $idgenerate;
						$menu['sub_menu']	= $val_child['name'];
						$menu['link'] 		= $val_child['link'];
						$menu['icon'] 		= $val_child['icon'];
						$menu['type_menu']	= "SUB MENU";
						
						$list_menu[$x] = $menu;
					}
				}
				$list_menu[$x] = $menu;
				$x++;
			}
			
		
			
			$o=new Outputview();
			$o->success = 'true';
			$o->message =  $list_menu;
			echo $o->result(); 
		}else{
			redirect('Auth');
		}
	}
	
	
	public function create_menu(){
		
		$list_urlform = $this->form_model->get_all_by_shortcut(1);
		
		$data =array(
			'title_page_big' 				=> 'Buat Menu Baru',
			'link_get_parent_menu'			=> site_url().'sistem/Pengaturan_tampilan/get_parent_menu/'.$this->_token,
			'link_back'						=> site_url().'sistem/Pengaturan_tampilan/menu_management',
			'link_save'						=> site_url().'sistem/Pengaturan_tampilan/create_menu_action',
			'id'							=> "",
			'selected_type'					=> "0",
			'selected_parent'				=> "",
			'menu_name'						=> "",
			'menu_icon'						=> "",
			'selected_link'					=> "1",
			'list_urlform'					=> $list_urlform,
		);
		
		$this->template->load('sistem/Menu_form',$data);
	}
	
	public function create_menu_action(){
		$data 	= $this->input->post('data_ajax',true);
		$val 	= json_decode($data,true);
		
		//memastikan kembali inputan
		$o=new Outputview();
		unset($val['id']);
		unset($val['undefined']);
		
		if($val['is_parent']=='0'){
			unset($val['menu_parent']);
		}else{
			
			if($val['menu_parent']==''||$val['menu_parent']===null){
				$o->success 		= 'false';
				$o->message			= 'Menu Utama Belum di pilih';
				$o->elementid		= 'input-nama-menu';
				echo $o->result();
				return;
			}
			
			$val['is_parent'] = $val['menu_parent'];
			unset($val['menu_parent']);
		}
		
		
		if($val['name']==""){	
			$o->success 		= 'false';
			$o->message			= 'Nama menu belum di isi !';
			$o->elementid		= 'input-nama-menu';
			echo $o->result();
			return;
		}
		
		if($val['id_form']==""){
			$val['id_form']="1";
		}
		
		
		$success = $this->tmodel->insert($val);
		
		$o->success 	= 'true';
		$o->message		= 'Menu berhasil di buat';
		echo $o->result();
	}
	
	public function update_menu($id){
		$id  		= $this->security->xss_clean($id);
		$idgenerate = $id;
			
		$this->log_temp 	= $this->session->userdata($this->log_key);
		
		//important !! tempdata digunakan sbagai antisipasi
		//perubahan session log_table_menu saat membuka tab baru secara bersamaan
		$this->session->set_tempdata($id,$this->log_temp,300);
	
		$id			= _decode_id($id,$this->log_temp);
		
		$row 		= $this->tmodel->get_by_id($id);


		
		
		if($row){
			$list_urlform = $this->form_model->get_all_by_shortcut(1);		
			
			$selected_type		= "0";
			$selected_parent	= "";
			$menu_name			= $row->name;
			$menu_icon			= $row->icon;
			$selected_link		= $row->id_form;
			
			if($row->is_parent !=="0"){
				$selected_type			= "1" ;
				$selected_parent		= $row->is_parent;		
			}

			$data =array(
			'title_page_big' 				=> 'Update Menu "' . $row->name .'"',
			'link_get_parent_menu'			=> site_url().'sistem/Pengaturan_tampilan/get_parent_menu/'.$this->_token,
			'link_back'						=> site_url().'sistem/Pengaturan_tampilan/menu_management',
			'link_save'						=> site_url().'sistem/Pengaturan_tampilan/update_action',
			'id'							=> $idgenerate,
			'selected_type'					=> $selected_type,
			'selected_parent'				=> $selected_parent,
			'menu_name'						=> $menu_name,
			'menu_icon'						=> $menu_icon,
			'selected_link'					=> $selected_link,
			'list_urlform'					=> $list_urlform,
		);
	
			$this->template->load('sistem/Menu_form',$data);
		}else{
			redirect($this->agent->referrer());	
		}
	
		
	}
	
	public function update_action(){
		$data 	= $this->input->post('data_ajax',true);
		$val 	= json_decode($data,true);
		$this->log_temp = $this->session->tempdata($val['id']); 
		$id		= _decode_id($val['id'],$this->log_temp);
		unset($val['id']);
		unset($val['undefined']);
		
		//memastikan id terdaftar
		$row = $this->tmodel->get_by_id($id);
		$o=new Outputview();
		if($row){

			//memastikan menu parent tidak menjadi sub menu diri sendiri
			if($row->id==$val['menu_parent']){
				$o->success 		= 'false';
				$o->message		= 'Opps Menu Utama tidak dapat menjadi sub menu diri sendiri!';
				$o->elementid	= '';
				echo $o->result();
				return;
			}
			
			//memastikan menu utama yang memiliki sub menu
			//tidak berubah menjadi sub menu
			$haschild = $this->tmodel->haschild($id);
			if($haschild){
				if($val['is_parent'] !=='0'){
					$o->success 		= 'false';
					$o->message		= 'Opps Menu Utama memiliki sub menu !.. tidak dapat di ubah menjadi sub menu';
					$o->elementid	= '';
					echo $o->result();
					return;
				}
			}
			
			
			
			
			if($val['is_parent']=='0'){
				unset($val['menu_parent']);
			}else{
				$val['is_parent'] = $val['menu_parent'];
				unset($val['menu_parent']);
			}
			
			
			if($val['name']==""){	
				$o->success 		= 'false';
				$o->message		= 'Nama menu belum di isi !';
				$o->elementid	= 'input-nama-menu';
				echo $o->result();
				return;
			}
			
			if($val['id_form']==""){
				$val['id_form']="1";
			}
			
			
		
			
			$this->tmodel->update($id,$val);
			$o->success 	= 'true';
			$o->message	= 'Menu berhasil di update';
			echo $o->result();
			
			
			
			
		}else{
			$o->success 	= 'false';
			$o->message	= "Opss..gagal mengupdate menu !";
			echo $o->result();
			return;
		}
		
		
	
	}
	
	
	
	public function delete_multiple(){
		$data=$this->input->get('data_ajax',TRUE);
		$val=json_decode($data,TRUE);
		$data = explode(',',$val['data_delete']);


		$xx=0;
		
		//get key generate
		$log_id = $this->session->userdata($this->log_key);
		$o = new Outputview();
		foreach($data as $value){
			$value =  _decode_id($value,$log_id);
			//menganti ke id asli
			$data[$xx] = $value;
			
			//memastikan menu utama yang memiliki sub menu
			//tidak di hapus
			$haschild = $this->tmodel->haschild($value);
			if($haschild){
					$o->success 		= 'false';
					$o->message		= 'Opps Menu Utama memiliki Sub Menu !!.. hapus Sub Menu terlebih dahulu';
					$o->elementid	= '';
					echo $o->result();
					return;
			}
			
			
			
			$xx++;	
		}
		
		$this->tmodel->delete_multiple($data);
		
		$o->success 	= 'true';
		$o->message	= 'Menu di hapus';
		echo $o->result();
		
	}
	

}
