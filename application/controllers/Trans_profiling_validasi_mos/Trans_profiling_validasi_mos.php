<?php
require APPPATH. '/controllers/Trans_profiling_validasi_mos/Trans_profiling_validasi_mos_config.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Trans_profiling_validasi_mos extends CI_Controller {
   private $log_key,$log_temp,$title;
   function __construct(){
        parent::__construct();
		$this->load->model('Trans_profiling_validasi_mos/Trans_profiling_validasi_mos_model','tmodel');
		$this->log_key ='log_Trans_profiling_validasi_mos';
		$this->title = new Trans_profiling_validasi_mos_config();
   }


	public function index(){
		$data = array(
			'title_page_big'		=> 'DAFTAR',
			'title'					=> $this->title,
			'link_refresh_table'	=> site_url().'Trans_profiling_validasi_mos/Trans_profiling_validasi_mos/refresh_table/'.$this->_token,
			'link_create'			=> site_url().'Trans_profiling_validasi_mos/Trans_profiling_validasi_mos/create',
			'link_update'			=> site_url().'Trans_profiling_validasi_mos/Trans_profiling_validasi_mos/update',
			'link_delete'			=> site_url().'Trans_profiling_validasi_mos/Trans_profiling_validasi_mos/delete_multiple',
		);
		
		$this->template->load('Trans_profiling_validasi_mos/Trans_profiling_validasi_mos_list',$data);
	}

	public function refresh_table($token){
		if($token==$this->_token){
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
			'title_page_big'		=> 'Buat Baru',
			'title'					=> $this->title,
			'link_save'				=> site_url().'Trans_profiling_validasi_mos/Trans_profiling_validasi_mos/create_action',
			'link_back'				=> $this->agent->referrer(),			
		);
		
		$this->template->load('Trans_profiling_validasi_mos/Trans_profiling_validasi_mos_form',$data);

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
		if(!$o->not_empty($val['verfi_email'],'#verfi_email')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['facebook'],'#facebook')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('facebook'=>$val['facebook']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#facebook')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['twitter'],'#twitter')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('twitter'=>$val['twitter']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#twitter')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['nama_pastel'],'#nama_pastel')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('nama_pastel'=>$val['nama_pastel']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#nama_pastel')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['alamat'],'#alamat')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('alamat'=>$val['alamat']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#alamat')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['kota'],'#kota')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('kota'=>$val['kota']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#kota')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['regional'],'#regional')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('regional'=>$val['regional']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#regional')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['update_by'],'#update_by')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('update_by'=>$val['update_by']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#update_by')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['lup'],'#lup')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('lup'=>$val['lup']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#lup')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['sumber'],'#sumber')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('sumber'=>$val['sumber']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#sumber')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['tgl_insert'],'#tgl_insert')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('tgl_insert'=>$val['tgl_insert']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#tgl_insert')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['is_3p'],'#is_3p')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('is_3p'=>$val['is_3p']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#is_3p')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['layanan'],'#layanan')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('layanan'=>$val['layanan']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#layanan')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['reason_call'],'#reason_call')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('reason_call'=>$val['reason_call']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#reason_call')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['status'],'#status')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('status'=>$val['status']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#status')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['keterangan'],'#keterangan')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('keterangan'=>$val['keterangan']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#keterangan')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['tgl_bayar'],'#tgl_bayar')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('tgl_bayar'=>$val['tgl_bayar']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#tgl_bayar')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['waktu_bayar'],'#waktu_bayar')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('waktu_bayar'=>$val['waktu_bayar']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#waktu_bayar')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['kecepatan'],'#kecepatan')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('kecepatan'=>$val['kecepatan']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#kecepatan')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['tagihan'],'#tagihan')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('tagihan'=>$val['tagihan']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#tagihan')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['click_time'],'#click_time')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('click_time'=>$val['click_time']);
		$exist = $this->tmodel->if_exist('',$field);
		if(!$o->not_exist($exist,'#click_time')){
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
				'link_save'				=> site_url().'Trans_profiling_validasi_mos/Trans_profiling_validasi_mos/update_action',
				'link_back'				=> $this->agent->referrer(),
				'data'					=> $row,
			);
			
			$this->template->load('Trans_profiling_validasi_mos/Trans_profiling_validasi_mos_form',$data);
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
		if(!$o->not_empty($val['verfi_email'],'#verfi_email')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['facebook'],'#facebook')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('facebook'=>$val['facebook']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#facebook')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['twitter'],'#twitter')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('twitter'=>$val['twitter']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#twitter')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['nama_pastel'],'#nama_pastel')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('nama_pastel'=>$val['nama_pastel']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#nama_pastel')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['alamat'],'#alamat')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('alamat'=>$val['alamat']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#alamat')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['kota'],'#kota')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('kota'=>$val['kota']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#kota')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['regional'],'#regional')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('regional'=>$val['regional']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#regional')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['update_by'],'#update_by')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('update_by'=>$val['update_by']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#update_by')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['lup'],'#lup')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('lup'=>$val['lup']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#lup')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['sumber'],'#sumber')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('sumber'=>$val['sumber']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#sumber')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['tgl_insert'],'#tgl_insert')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('tgl_insert'=>$val['tgl_insert']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#tgl_insert')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['is_3p'],'#is_3p')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('is_3p'=>$val['is_3p']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#is_3p')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['layanan'],'#layanan')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('layanan'=>$val['layanan']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#layanan')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['reason_call'],'#reason_call')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('reason_call'=>$val['reason_call']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#reason_call')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['status'],'#status')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('status'=>$val['status']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#status')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['keterangan'],'#keterangan')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('keterangan'=>$val['keterangan']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#keterangan')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['tgl_bayar'],'#tgl_bayar')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('tgl_bayar'=>$val['tgl_bayar']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#tgl_bayar')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['waktu_bayar'],'#waktu_bayar')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('waktu_bayar'=>$val['waktu_bayar']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#waktu_bayar')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['kecepatan'],'#kecepatan')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('kecepatan'=>$val['kecepatan']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#kecepatan')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['tagihan'],'#tagihan')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('tagihan'=>$val['tagihan']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#tagihan')){
			echo $o->result();	
			return;
		}

		//mencegah data kosong
		if(!$o->not_empty($val['click_time'],'#click_time')){
			echo $o->result();	
			return;
		}

		//mencegah data double
		$field=array('click_time'=>$val['click_time']);
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if(!$o->not_exist($exist,'#click_time')){
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
/* Generated by YBS CRUD Generator 2020-05-04 22:46:06 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/

