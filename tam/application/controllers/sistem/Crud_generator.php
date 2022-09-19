<?php
 
class Crud_generator extends CI_Controller { 
	var 	$c_path;
	var 	$v_path;
	var 	$m_path;
	var		$page_version;
	public function __construct() {
		parent::__construct();

		$this->load->model('sys/Crud_generator_model','crud_model');
		$this->c_path 	= APPPATH . 'controllers';
		$this->v_path 	= APPPATH . 'views';
		$this->m_path 	= APPPATH . 'models';
		
		$this->page_version	= $this->_appinfo['version'];
	}

	public function index(){
		
		$data = array();
			$data['title_page_big'] 			= '';
			$data['table_list']					= $this->crud_model->get_table_list();
			$data['link_get_field_table']		= site_url().'sistem/Crud_generator/get_field_table/'.$this->_token;	
			$data['link_get_field_table_join']	= site_url().'sistem/Crud_generator/get_field_table_join/'.$this->_token;
			$data['link_get_title_alias']		= site_url().'sistem/Crud_generator/get_title_alias/'.$this->_token;
			$data['link_generate_form']			= site_url().'sistem/Crud_generator/generator_form/'.$this->_token;
			$data['link_registrasi_url']		= site_url().'sistem/Registrasi_form/create';
			$data['link_create_menu']			= site_url().'sistem/Pengaturan_tampilan/create_menu';
			$this->template->load('sistem/crud_generator/Generator_form',$data);
	}

	
	
	public function generator_form($token){
		if($this->_token == $token && $this->_user_id==1){
			
				$data 	= $this->input->post('data_ajax',true);
				$val	= json_decode($data,true);
				
				if($val==NULL){
					redirect('auth');
					return;
				}
				

				$table 					= '';
				$general_folder			= '';
				$general_file_name		= '';
				$crud_show				= '';
				$server_side			= '';
				$field_tabel			= array();
				$field_empty 			= array();
				$field_double			= array();
				$field_alias_field 		= array();
				$type_input_field		= array();
				//$alias_table_join		= array();
				$index_alias_table_join	= array();
				$field_alias_form 		= array();
				$table_join				= array();
				$select_show_join		= array();

				
				$itj=0;
				foreach($val as $key=>$value){
					switch($key){
						case 'table_name' :
							$table = $value;
							break;
						case 'general_folder':
							$general_folder = $value;
							break;
						case 'general_file_name' :
							$general_file_name = $value;
							break;	
						case 'crud_show':
							$crud_show = $value;
							break;
						case 'server_side':
							$server_side = $value;
							break;	

						default :
							//identifikasi key
							$a = explode('___',$key);
							switch($a[0]){
								case 'dk':  //data_kosong
									$f = $a[1];
									$field_empty[$f] = $value;
									$field_tabel[] = $f;
									break;
								case 'dr': //data_kembar
									$f = $a[1];
									$field_double[$f] = $value; 
									break;
								case 'sj': //select_join
									$f = $a[1];
									if($value !=='none'){
										$table_join[$f] = $value;
										$itj++;
									}
									break;		
								case 'atj': //alias_table_join
									if($value !==""){
										$f = $a[1];
										//$alias_table_join[$f] =$value; //1_-_sys_status
										$index_alias_table_join[$itj] = $value;
									}
									break;
								case 'af': //alias_field
									$f = $a[1];
									$field_alias_field[$f] = $value; 
									break;
									
								case 'am': //alias form
									$f = $a[1];
									$field_alias_form[$f] = $value; 
									break;	
			
								case 'ssj': //select_show_join
									$f = $a[1];
									if($value !=='none'){
										$select_show_join[$f] = $value; 
									}
									
									break;	
								case 'sti' : //select_type_input
									$f = $a[1];
									$type_input_field[$f] = $value; 
									break;	
							}
							
						
					}
				}
				
				if($general_folder=='sistem' || $general_folder=='sys'){
					$o = new Outputview();
					$o->success 	= 'false';
					$o->message 	= 'Opps..folder sistem tidak dapat digunakan !!';//
					$o->elementid	= '#general-folder';
					echo $o->result();
					return;
				}

				$gf 		= ucfirst($general_folder);		//ucfirst($table); 			//general folder
				$fc			= ucfirst($general_file_name); 	//file controllers
				$fm			= $fc.'_model';	//file model
				$fl			= $fc.'_list';	//file view list
				$ff			= $fc.'_form';	//file view form
				
				$pm 		= APPPATH . 'models/' . $gf ;
				$pc			= APPPATH . 'controllers/' . $gf ;
				$pv			= APPPATH . 'views/' . $gf ;
				
				
				if($crud_show=='off'){
					$this->crud_model->create_field_user_input($table);
				}
				
				
				$result = array();
				$this->load->model('sys/Template_model','tm');
				$result['create_model'] = $this->tm->create_model($fm,$pm,$field_alias_field,$table_join,$index_alias_table_join,$table,$crud_show);
				
				$this->load->model('sys/Template_controller','tc');
				$result['create_controller'] = $this->tc->create_controller($fc,$fm,$fl,$ff,$pc,$gf,
																			$field_alias_form,$field_alias_field,$type_input_field,
																			$field_double,$field_empty,
																			$crud_show,$server_side);
				
				$this->load->model('sys/Template_list','tl');
				$result['create_list'] = $this->tl->create_view_list($fl,$pv,$gf,$field_alias_form,$type_input_field,$server_side,$this->page_version);
				
				$this->load->model('sys/Template_form','tf');
				$result['create_form_input'] = $this->tf->create_view_form($ff,$pv,$gf,$select_show_join,$field_tabel,$table,$type_input_field,$this->page_version);
				
				
				$o = new Outputview();
				$o->success = 'true';
				$o->message =  'Done..! Proses Generate Form Selesai..';//
				echo $o->result();
		}else{
			redirect("Auth");
		}
	}
	
	
	
	public function get_field_table($token){
		if($this->_token == $token && $this->_user_id==1){
			$data 	= $this->input->get('data_ajax',true);
			$val	= json_decode($data,true);
		
			$o= new outputview();
			
			if(!isset($val['table_name'])){
				redirect('auth');
				return;
			}
			
			if($val['table_name']=='none'){
				$o->success='false';
				echo $o->result();
				return;
			}
			
			$lfield 	= $this->crud_model->get_field_info($val['table_name']);
			$count_row 	=  $this->crud_model->get_count($val['table_name']);
			$o->success ='true';
			$o->message = $lfield;
			
			//menggunakan variable elementid untuk mengirim jumlah row
			$o->elementid = $count_row;
			
			echo $o->result();
			return;
		}else{
			redirect("Auth");
		}
		
		
	}
	
	public function get_field_table_join($token){
		if($this->_token == $token && $this->_user_id==1){
			
			$data 	= $this->input->get('data_ajax',true);
			$val	= json_decode($data,true);
		
			$o= new outputview();
			if(!isset($val['table_name'])){
				redirect('auth');
				return;
			}	
			
			if($val['table_name']=='none'){
				$o->success='false';
				echo $o->result();
				return;
			}
			
			
			
			$lfield = $this->crud_model->get_field_info($val['table_name']);

			$o->success ='true';
			$o->message = $lfield;
			echo $o->result();
			return;
		}else{
			redirect("Auth");
		}	
	}
	
	public function get_title_alias($token){
		if($this->_token == $token && $this->_user_id==1){
			$data 		= $this->input->get('data_ajax',true);
			$val		= json_decode($data,true);
			
			if(!isset($val['table_name'])){
				redirect('auth');
				return;
			}
			
			$xf  		= explode(',',$val['table_name']); 
			
			
			
			$table_fname = array();
			$table = array();
			$x = 0;
			
			
			$o = new outputview();
		
			foreach($xf as $val){
				$ff 	= array();
				$ff 	= explode('___',$val);
				$talias='';
				$table_name	= $ff[0];
				
				//mendapatkan alias table
				if(count($ff)>1){
					$talias = $ff[1];
				}else{
					$talias = $table_name;
				}
				
				
				$lfield = $this->crud_model->get_field_info($table_name);
				
				$xy =0;
				foreach($lfield as $val_field){
					$table['nomor']	 = [$x+1];	
					$table['name']   =  $talias.'.'.$val_field->name;
					
					
					
					//harus membuat alias field name jika antara table ada nama field yang sama
					$alias =$val_field->name;
					
					
					foreach($table_fname as $val_join){
						if($alias == $val_join['alias_field']){
							//mengchitung jumlah field yang sama
							$xy++;
						}
						if($xy>0){
							//jika field yang sama lebih besar dari 1
							//tambahkan nama table
							$alias = $talias.'_'.$val_field->name;
							
							//reset count
							$xy=0;
						}
					}
					
					$table['alias_field']   =  $alias;
					$table['title_alias']  =  strtoupper($val_field->name);
					$table_fname[$x] = $table;
					$x++;
				}
				
			}
			
			
			
			$o->success='true';
			$o->message=$table_fname;
			echo $o->result();
		}else{
			redirect("Auth");
		}	
			
	}
	
	

	
	
} 