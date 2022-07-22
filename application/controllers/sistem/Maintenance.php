<?php 
class Maintenance extends CI_Controller { 
	private $log_key,$log_temp;
	public $_key_register;
	public function __construct() {
		parent::__construct();
		$this->load->model('sys/Sys_maintenance_model','tmodel');
		$this->log_key ='log_Maintenance';
		$this->_key_register = "";
	}

	public function maintenance_setting_list(){
			$row = $this->tmodel->get_all();
			
			
			$tm = time();
			//menyimpan key encode di session
			$this->session->set_userdata($this->log_key,$tm);
			
			foreach($row as $val){
				$idgenerate		= _encode_id($val->id,$tm);
				
				$time_start 	= _indonesia_date($val->start);
				$val->start 	= $time_start;
				$val->id		= $idgenerate;
				
			}
		
			$data = array(
				'link_create'				=>	site_url().'sistem/Maintenance/create',
				'link_delete'				=>	site_url().'sistem/Maintenance/delete_schedule/'.$this->_token,
				'link_stop_maintenance'		=>	site_url().'sistem/Maintenance/stop_maintenance/'.$this->_token,
				'link_register_ip'			=>	site_url().'sistem/Register_ip',
				'row'						=>	$row,
			
			);
			$this->template->load('sistem/Maintenance_setting_list',$data);
	}
	
	public function create (){
		$data = array(
		'link_save'	=>site_url().'sistem/Maintenance/save_n_run/'.$this->_token,
		'link_back'	=>site_url().'sistem/Maintenance/maintenance_setting_list', 
		'link_register_ip'			=>	site_url().'sistem/Register_ip',
		
		);
		
		$this->template->load('sistem/Maintenance_setting_form',$data);
	}
	
	
	public function save_n_run($token){
		if($this->_token ==$token && $this->_user_id==1){
			$data 	= $this->input->post('data_ajax',true);
			$val	= json_decode($data,true);
			
			$o = new Outputview();
			
			if(!$o->not_empty($val['days'])){
				$o->message = "Jumlah hari belum di pilih";
				echo $o->result();
				return;
			}
			if(!$o->not_empty($val['hours'])){
				$o->message = "Jumlah jam belum di pilih";
				echo $o->result();
				return;
			}
			
			if(!$o->not_empty($val['minutes'])){
				$o->message = "Jumlah menit belum di pilih";
				echo $o->result();
				return;
			}
			
			if(!$o->not_empty($val['desc'])){
				$o->message = "Deskripsi belum di isi";
				echo $o->result();
				return;
			}
			
			
			$key =  _generate(time());
			
			$data = array(
				'start'		=> time(),
				'days'		=> $val['days'],
				'hours'		=> $val['hours'],
				'minutes'	=> $val['minutes'],
				'desc'		=> $val['desc'],
				'actual_finish'	=> 0,
				'key'		=> $key,	
			);
			
			$success = $this->tmodel->insert($data);
			
			if($success){
				
				
				
				$f =  '<a href="'.site_url().'sistem/Maintenance/download_urlkey/'.$key.'x001xyour_user_name'.'x001xyourpass'.'" type="button" class="btn btn-danger btn-sm"><i class="fa fa-key mr-2"></i>Download key</a>';
				$this->tmodel->set_mode_on();
				$o->success 	= 'true';
				$o->message 	= $f;//$this->_key_register;
				echo $o->result(); 
			}else{
				$this->tmodel->set_mode_off();
				$o->success 	= 'false';
				$o->message 	= 'opps gagal menjalankan Page Maintenance';
				echo $o->result(); 
				
			}
			
			
		
			
			
		}else{
			redirect("Auth");
		}
		
		
		
	}
	
	public function download_urlkey($data){
		if($this->_user_id==1){
			$this->_key_register = site_url().'api/Public_Access/aXmqpMdcWaoPffGNmzUiadCdBcbdcBqorAuroo/'.$data;
			
			$a = str_replace("your_user_name","andika",$data);
			$b = str_replace("yourpass","123456",$a);
			
			$sample =  site_url().'api/Public_Access/aXmqpMdcWaoPffGNmzUiadCdBcbdcBqorAuroo/'.$b;
			
			$this->load->helper('download');
			force_download('url_key.txt' ,
							'kode ini hanya di gunakan jika anda tidak dapat mengakses halaman login'.
							' isi *your_user_name* dengan user_name login anda  dan yourpass dengan password login anda'. 
							'
							
'.
						
							'url key anda  :  '.
							'
							
'.
							$this->_key_register .
							'
							

'.
							'contoh penulisan: '.
							'
'.
							$sample	,TRUE);
		}else{
			
		}
	}

	
	
	public function delete_schedule($token){
		if($token==$this->_token && $this->_user_id==1){
			$data = $this->input->post('data_ajax',TRUE);
			$val  = json_decode($data,TRUE);	
			
			if($val['id'] !== NULL && $val['id'] !==""){
				$log_key = $this->session->userdata($this->log_key);
				$iddecode = _decode_id($val['id'],$log_key);
				$this->tmodel->delete_schedule($iddecode);
			
				$o = new Outputview();
				$o->success = "redirect";
				$o->message = site_url().'sistem/Maintenance/maintenance_setting_list';

				//menyiapkan pesan output
				//type message redirect-success,redirect-failed,redirect-warning 
				$this->session->set_flashdata('redirect_success','Data Berhasil di hapus');
				echo $o->result();
			
			}else{
				
				
				
			}
			
		
			
			
		}else{
			redirect("Auth");
		}
	}
		
	public function stop_maintenance($token){
		if($token==$this->_token && $this->_user_id==1){
			$data  	= $this->input->post('data_ajax',TRUE);
			$val	= json_decode($data,TRUE);
			$o = new Outputview();
			if($val['id'] !== NULL && $val['id'] !==""){
				$log_key 	= $this->session->userdata($this->log_key);
				$iddecode 	= _decode_id($val['id'],$log_key); 
				
				$finish = array('actual_finish'=>time());
				$success = $this->tmodel->stop_maintenance($iddecode,$finish);
				
			
				if($success){
					
					$this->tmodel->set_mode_off();
					$o->success = "redirect";
					$o->message = site_url().'sistem/Maintenance/maintenance_setting_list';

					//menyiapkan pesan output
					//type message redirect-success,redirect-failed,redirect-warning 
					$this->session->set_flashdata('redirect_success','Data Berhasil di update');
					echo $o->result();
					
				}else{
					$o->success = "false";
					$o->message = 'Opps proses gagal';
					echo $o->result();
					return;
				}
				
				
				
				
				
			}else{
				redirect("Auth");
			}	
			
		}else{
			redirect("Auth");
		}
	}

} 