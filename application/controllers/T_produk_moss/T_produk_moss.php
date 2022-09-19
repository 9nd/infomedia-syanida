<?php
require APPPATH. '/controllers/T_produk_moss/T_produk_moss_config.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T_produk_moss extends CI_Controller {
   private $log_key,$log_temp,$title;
   function __construct(){
        parent::__construct();
		$this->load->model('T_produk_moss/T_produk_moss_model','tmodel');
		$this->log_key ='log_T_produk_moss';
		$this->title = new T_produk_moss_config();
   }


	public function index(){
		$data = array(
			'title_page_big'		=> 'DAFTAR',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url().'T_produk_moss/T_produk_moss/refresh_table/'.$this->_token,
			'link_create'			=> site_url().'T_produk_moss/T_produk_moss/create',
			'link_update'			=> site_url().'T_produk_moss/T_produk_moss/update',
			'link_delete'			=> site_url().'T_produk_moss/T_produk_moss/delete_multiple',
		);
		
		$this->template->load('T_produk_moss/T_produk_moss_list',$data);
	}

	public function refresh_table($token){
		if($token==$this->_token){
			$row = $this->tmodel->get_all();
			
			//encode id 
			$tm = time();
			$this->session->set_userdata($this->log_key,$tm);
			$x = 0;
			foreach($row as $val){
				$idgenerate = _encode_id($val['id'],$tm);
				$row[$x]['id'] = $idgenerate;
				$x++;
			}
			
			
			$o = new Outputview();
			$o->success	= 'true';
			$o->message	= $row;
			
			echo $o->result();
			

		}else{
			redirect('Auth');
		}
	}

	public function create(){
		$data = array(
			'title_page_big'		=> 'Buat Baru',
			'title'					=> $this->title,
			'link_save'				=> site_url().'T_produk_moss/T_produk_moss/create_action',
			'link_back'				=> $this->agent->referrer(),			
		);
		
		$this->template->load('T_produk_moss/T_produk_moss_form',$data);

	}

	public function create_action(){
		$data 	= $this->input->post('data_ajax',true);
		$val	= json_decode($data,true);
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
		if(!$o->not_empty($val['nama_chanel'],'#nama_chanel')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('nama_chanel'=>$val['nama_chanel']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#nama_chanel')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['kode_chanel'],'#kode_chanel')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('kode_chanel'=>$val['kode_chanel']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#kode_chanel')){
			echo $o->result();	
			return;
		}

		unset($val['id']);
		$success = $this->tmodel->insert($val);
		echo $o->auto_result($success);

	}

	public function update($id){
		$id 				= $this->security->xss_clean($id);
		$id_generate		= $id;
		
		/** proses decode id 
		* important !! tempdata digunakan sbagai antisipasi
		* perubahan session saat membuka tab baru secara bersamaan
		**/
		$this->log_temp	= $this->session->userdata($this->log_key);
		$this->session->set_tempdata($id,$this->log_temp,300);
		
		//mengembalikan id asli
		$id = _decode_id($id,$this->log_temp);
		
		$row = $this->tmodel->get_by_id($id);
		
		if($row){
			$data = array(
				'title_page_big'		=> 'Buat Baru',
				'title'					=> $this->title,
				'link_save'				=> site_url().'T_produk_moss/T_produk_moss/update_action',
				'link_back'				=> $this->agent->referrer(),
				'data'					=> $row,
				'id'					=> $id_generate,
			);
			
			$this->template->load('T_produk_moss/T_produk_moss_form',$data);
		}else{
			redirect($this->agent->referrer());
		}
	}

	public function update_action(){
		$data 	= $this->input->post('data_ajax',true);
		$val	= json_decode($data,true);
		$this->log_temp		= $this->session->tempdata($val['id']);
		$val['id']				= _decode_id($val['id'],$this->log_temp);
		
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
		if(!$o->not_empty($val['nama_chanel'],'#nama_chanel')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('nama_chanel'=>$val['nama_chanel']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#nama_chanel')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['kode_chanel'],'#kode_chanel')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('kode_chanel'=>$val['kode_chanel']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#kode_chanel')){
			echo $o->result();	
			return;
		}


		$success = $this->tmodel->update($val['id'],$val);
		echo $o->auto_result($success);

	}

	public function delete_multiple(){
		$data=$this->input->get('data_ajax',true);
		$val=json_decode($data,true);
		$data = explode(',',$val['data_delete']);

		//get key generate
		$log_id = $this->session->userdata($this->log_key);
		$xx=0;
		foreach($data as $value){
			$value =  _decode_id($value,$log_id);
			//menganti ke id asli
			$data[$xx] = $value;
			$xx++;	
		}
		
		$success = $this->tmodel->delete_multiple($data);
		
		$o = new Outputview();
		
		//create message
		if($success){
			$o->success 	= 'true';
			$o->message	= 'Data berhasil di hapus !';
		}else{
			$o->success 	= 'false';
			$o->message	= 'Opps..Gagal menghapus data !!';
		}
		
		
		echo $o->result();
	
	}



};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-07-30 11:51:31 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/

