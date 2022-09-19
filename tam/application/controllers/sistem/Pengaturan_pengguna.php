<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form_General
 *
 * @author Dhiya
 */
class Pengaturan_pengguna extends CI_Controller {
	private $log_key,$log_temp;
	
    public function __construct() {
        parent::__construct();
		$this->load->model('sys/Sys_user_model','tmodel');
		$this->log_key="log_pengaturan_pengguna";
    }

    public function index() {
		$data =array(
			'title_page_big'				=> 'Pengaturan Pengguna',
			'link_refresh_table'			=>  site_url().'sistem/Pengaturan_pengguna/refresh_table/'.$this->_token,
			'link_create'					=> site_url().'sistem/Pengaturan_pengguna/create',
			'link_create_multiple'			=> site_url().'sistem/Pengaturan_pengguna/create_multiple',
			'link_delete'					=> site_url().'sistem/Pengaturan_pengguna/delete_multiple',
			'link_update'					=> site_url().'sistem/Pengaturan_pengguna/update',
		);
		
		$this->template->load('sistem/User_list',$data);
    }
	
	public function create(){
		$data =array(
			'title_page_big'			=> 'Buat Pengguna Baru',
			'link_save'					=> site_url().'sistem/Pengaturan_pengguna/create_action',
			'link_prepare_picture'		=> site_url().'sistem/Pengaturan_pengguna/prepare_picture/'.$this->_token,
			'link_back'					=> $this->agent->referrer(),
			'id'						=> '',
			'nmuser'					=> '',
			'nama'					=> '',
			'kategori'					=> '',
			'agentid'					=> '',
			'nmpicture'					=>  'Picture Profile',	
			'nmlevel'					=> '',
			'selected_status'			=> '1',
			'selected_level'			=> '',
			'data_level'				=> $this->get_level(),
			'picture'					=> '_profile.png',
			'tl'					=> '',

		);
		
		$this->template->load('sistem/User_form',$data);
	}
	
	public function create_multiple(){
		$data =array(
			'title_page_big'				=> 'Buat Multiple Pengguna',
			'link_save'						=> site_url().'sistem/Pengaturan_pengguna/create_action',
			'link_prepare_picture'			=> site_url().'prepare_picture'.$this->_token,
			'link_download_template_user'	=> site_url().'sistem/Pengaturan_pengguna/download_template_user/'.$this->_token,
			'link_upload_template'			=> site_url().'sistem/Pengaturan_pengguna/upload_template_user/'.$this->_token,
			'link_back'						=> $this->agent->referrer(),
			'id'							=> '',
			'nmuser'						=> '',
			'nama'					=> '',
			'agentid'					=> '',
			'nmpicture'						=>  'Picture Profile',	
			'nmlevel'						=> '',
			'selected_status'				=> '1',
			'selected_level'				=> '',
			'data_level'					=> $this->get_level(),
			'picture'						=> '_profile.png',
			'tl'					=> '',

		);
		
		$this->template->load('sistem/User_form_multiple',$data);
	}
	
	
	
	
	
	
	
	
	public function prepare_picture($token){
		
		if($token== $this->_token && $this->_user_id==1){
				$tm = time();
				$config['upload_path']          = './images/tmp_user_profile/';
                $config['allowed_types']        = 'jpg|png';
                $config['max_size']             = 60000;
				$config['file_name']			= $this->_user_id.'xx_xx'.$tm .'.jpg';
				$config['overwrite']			= TRUE;
				
				$this->reset_image();
                $this->load->library('upload', $config);	
				
				$o = array();
			 if ( !$this->upload->do_upload('inputfile')){
				 
						$em = $this->upload->display_errors();
						$em = str_replace('You did not select a file to upload.','Tidak ada file yang di pilih',$em);
					
						$o['success'] 	= 'false';
						$o['message']	= $em;
						$o['elementid'] = '#inputfile';
						$o['sec_val']	=  $this->security->get_csrf_token_name()."=".$this->security->get_csrf_hash()."&";
						$o = json_encode($o);
						echo $o;
						return;		
                }else{
					$path_picture = $config['upload_path'].$config['file_name']; //'';//$this->save_temp_picture();
					
					
					
					$o['success']		= 'true';
					$o['message'] 		= $path_picture;
					$o['original_name']	= $this->upload->data('client_name');
					$o['sec_val']		=  $this->security->get_csrf_token_name()."=".$this->security->get_csrf_hash()."&";
					$o = json_encode($o);
					echo $o;
					return;		
                }	
		}else{
			redirect("Auth");
		}			
	}
	
	
	
	

	private function reset_image(){
		//delete all file temp if create by this user
		$files =glob('./images/tmp_user_profile/*');
		foreach($files as $file){
			if(is_file($file)){
				$fname = basename($file);
				$id_old_pic = explode('xx_xx',$fname); 
				if($id_old_pic[0]==$this->_user_id ){
					unlink($file);
				}	
			}
		}	
	}
	
	
	public function create_action(){
		$data 	= $this->input->post('data_ajax',true);
		$val	= json_decode($data,true);
		$o = new Outputview();
		 if($val['nmuser']==""){
			 $o->success = 'false';
			 $o->message = 'nama pengguna belum di isi';
			 $o->elementid = '#input-nama-user';
			 echo $o->result();
			 return;
		 }
		 
		$field=array();
		$field['nmuser'] =$val['nmuser'];
		$exist = $this->tmodel->if_exist('',$field);
		if($exist){
			 $o->success  = 'false';
			 $o->message = 'nama pengguna sudah digunakan';
			 $o->elementid = '#input-nama-user';
			 echo $o->result();
			 return;
		}
		
		if($val['opt_level']==""){
			 $o->success = 'false';
			 $o->message = 'Level belum di pilih';
			 $o->elementid = '#select-level-user';
			 echo $o->result();
			 return;
		 }
		 
		
		
		unset($val['id']);
		
		$val['passuser']= _generate($val['passuser']); 
		
		
		//memastikan file foto temp ada..
		$a = $val['picture'];
		if(!is_file($a) && $a !=="default.png" && $a !=="-"){
			 $o->success = 'false';
			 $o->message = 'Foto belum di isi';
			 $o->elementid = '';
			 echo $o->result();
			 return;
		}	
			
		
		
		$success = $this->tmodel->insert($val);
		
		
		if($success){
			if($val['picture'] !=='default.png'){
				unlink($val['picture']);
			}

			$o->success = 'true';
			$o->message = "User berhasil di buat";
			$o->elementid = '#input-nama-user';
			echo $o->result();
		
		}else{
			$o->success = 'false';
			$o->message = "Opps..gagal";
			$o->elementid = '';
			echo $o->result();
		}
		

		
	}
	
	public function update($id){
		$data 			= $this->security->xss_clean($id);
		$idgenerate		=$id;
		
		$this->log_temp = $this->session->userdata($this->log_key); 
		$this->session->set_tempdata($id,$this->log_temp);
		
		$id = _decode_id($id,$this->log_temp);

		$row = $this->tmodel->get_by_id($id);

		if($row){
			$data =array(
				'title_page_big'		=> 'Update User ' . $row->nmuser,
				'link_save'				=> site_url().'sistem/Pengaturan_pengguna/update_action',
				'link_prepare_picture'	=> site_url().'sistem/Pengaturan_pengguna/prepare_picture/'.$this->_token,
				'link_back'				=> $this->agent->referrer(),
				'selected_status'		=> $row->opt_status,
				'selected_level'		=> $row->opt_level,
				'nmuser'				=> $row->nmuser,
				'nama'				=> $row->nama,
				'kategori'				=> $row->kategori,
				'tl'				=> $row->tl,
				'agentid'				=> $row->agentid,
				'nmpicture'				=> $row->nmuser,
				'nmlevel'				=> $row->nmlevel,
				'id'					=> $idgenerate,
				'data_level'			=> $this->get_level(),
				'picture'				=> base_url().'YbsService/get_picture/'.$this->_token . $this->_separator_a. $row->picture,
			);
			
			
			//identifikasi yang mengupdate adalah configurator 
			if($this->_user_id == $id && $id=='1'){
				$this->template->load('sistem/User_form_update_configurator',$data);
			}else if($this->_user_id !== $id && $id=='1'){
				$this->session->set_flashdata('auth_form','Opps Akses terbatas, hanya bisa di akses oleh Level Configurator');
				redirect($this->agent->referrer());
			}else{
				$this->template->load('sistem/User_form_update',$data);
			}
			
			
		}else{
			redirect($this->agent->referrer());
		}	
		
	}
	
	public function update_action(){
		$data 	= $this->input->post('data_ajax',true);
		$val	= json_decode($data,true);
		
		$this->log_temp = $this->session->tempdata($val['id']);
		$val['id']	=	_decode_id($val['id'],$this->log_temp);
		
		$o = new Outputview();
		 if($val['nmuser']==""){
			 $o->success = 'false';
			 $o->message = 'nama pengguna belum di isi';
			 $o->elementid= '#input-nama-user';
			 echo $o->result();
			 return;
		 }
		 
		$field=array();
		$field['nmuser'] =$val['nmuser'];
		$exist = $this->tmodel->if_exist($val['id'],$field);
		if($exist){
			 $o->success	 = 'false';
			 $o->message	 = 'nama pengguna sudah digunakan';
			 $o->elementid	 = '#input-nama-user';
			 echo $o->result();
			 return;
		}
		
		//identifikasi update account configurator
		if($val['id']=='1'){
			$val['opt_level'] = '1';
			$val['opt_status'] = '1';
		}
		
		
		if($val['opt_level']==""){
			 $o->success 	 = 'false';
			 $o->message 	 = 'Level belum di pilih !!';
			 $o->elementid	 = '#select-level-user';
			 echo $o->result();
			 return;
		 }
		 
		
		if($val['select-reset']=='on'){
			if($val['passuser']==""){
				 $o->success  = 'false';
				 $o->message = 'password belum di isi';
				 $o->elementid = '#input-pass-user';
				 echo $o->result();
				 return;
			}
			
			$val['passuser']= _generate($val['passuser']); 
		}else{
			unset($val['passuser']);
		}
		
		unset($val['select-reset']);
		
		//set oldpicture
	    $old_p  = $this->tmodel->get_picture_for_update_byid($val['id']);

		$val['oldpicture'] = $old_p->picture;
		$this->tmodel->update($val['id'],$val);
		
		$o->success  = 'true';
		$o->message = 'data berhasil di update';
		echo $o->result();
	}
	
	
	
	
	public function delete_multiple(){
		$data 	= $this->input->get('data_ajax',true);
		$val	= json_decode($data,true);
		$data	= explode(',',$val['data_delete']);
		
		$this->log_temp = $this->session->userdata($this->log_key);
		
		$x=0;
		$o = new Outputview();
		foreach($data as $value){
			$id = _decode_id($value,$this->log_temp);
			//mengembalikan id asli
			$data[$x] = $id;
			
			if($id=='1'){
				 $o->success = 'false';
				 $o->message = 'Opps..user configurator tidak dapat di hapus !! block by system';
				 echo $o->result();
				return;
			}
			
			
			$x++;
		}
		
		$this->tmodel->delete_multiple($data);
		$o = new Outputview();
		$o->success = 'true';
		$o->message = 'Data berhasil di hapus !';
		echo $o->result();
		
		
	}
	
	
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
	
	
	
	

	private function get_level(){
		$this->load->model('sys/Sys_level_model','tlevel');
		$row = $this->tlevel->get_all();
		return $row;
	}
	
	
	
	public function upload_template_user($token){
		if($token == $this->_token && $this->_user_id==1){
				$data_level = $this->get_level();
			
				$tm = time();
				$config['upload_path']          = './temp_upload/';
                $config['allowed_types']        = 'xls';
                $config['max_size']             = 60000;
				$config['file_name']			= 'template_user.xls';
				$config['overwrite']			= TRUE;
				
				
                $this->load->library('upload', $config);	
				
				$o = array();
			 if ( !$this->upload->do_upload('inputfile')){
				 
						$em = $this->upload->display_errors();
						$em = str_replace('You did not select a file to upload.','Tidak ada file yang di pilih',$em);
					
						$o['success'] 	= 'false';
						$o['message']	= $em;
						$o['elementid'] = '#inputfile';
						$o['sec_val']	=  $this->security->get_csrf_token_name()."=".$this->security->get_csrf_hash()."&";
						$o = json_encode($o);
						echo $o;
						return;		
                }else{
					$path_file = $config['upload_path'].$config['file_name']; 
					$this->load->library("YBSExcelReader");
					$dataError = array();
		
					try{
						$excel  = new YBSExcelReader();
						$excel->set_file($path_file,"TEMPLATE");
						$dataFinal = $excel->read(4,2003,range('A','F'));
						
						$x=4;
						foreach($dataFinal as $key){
							if($key["A"]=="" || $key["B"]=="" || $key["C"]=="" || $key["D"]=="" || $key["E"]=="" || $key["F"]==""){
								$dataError[]= "<small>ERROR : ROW (". $x . ") ADA DATA YANG KOSONG, data tidak boleh kosong.. </small><br>";
							}
							
							
							//MENGECEK KODE LEVEL
							$exist = FALSE;
							$kode_level = (string) $key["E"] ;
							foreach($data_level as $key_level){
								if($key_level["id"] == $kode_level && $kode_level !=="1"){
									$exist = TRUE;
								}
							}
							
							if(!$exist){
								 $dataError[]= "<small>ERROR : ROW (". $x . ") KODE LEVEL tidak valid.. </small><br>";
							}
							
							
							
							//MENGECEK KODE STATUS
							$kode_status = (string) $key["F"] ;
							if($kode_status !=="1" && $kode_status !=="2" ){
								 $dataError[]= "<small>ERROR : ROW (". $x . ") KODE STATUS tidak valid.. </small><br>";
							}
							

							$field=array();
							$field['nmuser'] =$key["C"];
							$exist = $this->tmodel->if_exist('',$field);
							if($exist){
								 $dataError[]= "<small>ERROR : ROW (". $x . ") User ".$key["C"]."  sudah digunakan </small><br>";
							}
							
							
							$double = $this->check_data_double($dataFinal,$key["C"],$x);
							
							
							if($double !==""){
								$dataError[] = $double;
							}
							
							//membatasi pembacaan error ,max 10 error
							if(count($dataError)>10){
								break;
							}
							
							
							$x++;
						}
						
						
						
					} catch(Exception $e) {
						$msgError = $e->getMessage();
						$msgError = str_replace("Your requested sheet index: -1 is out of bounds. The actual number of sheets is 0.","Error : Sheet tidak di temukan",$msgError);
						$dataError[]= "<small>".$msgError."</small><br>";
					}
				
					
						

					if(count($dataError) > 0){
						unlink($path_file);
						
						$o['success']		= 'false';
						$o['message'] 		= $dataError;
						$o['original_name']	= $this->upload->data('client_name');
						$o['sec_val']		=  $this->security->get_csrf_token_name()."=".$this->security->get_csrf_hash()."&";
						$o = json_encode($o);
						echo $o;
						return;	
					}else{		
						$o['success']		= 'true';
						$o['message'] 		= "<small> File Ready in Process,,click save</small><br><a onclick=\"save('".site_url()."sistem/Pengaturan_pengguna/create_user_by_template/".$this->_token."')\" href=\"javascript:void(0)\" class=\"btn btn-success\">Save<a/>";
						$o['original_name']	= $this->upload->data('client_name');
						$o['sec_val']		=  $this->security->get_csrf_token_name()."=".$this->security->get_csrf_hash()."&";
						$o = json_encode($o);
						echo $o;
						return;		
					}
                }	
		
		}else{
			redirect("Auth");
		}	
	
	
	
	}

	private function check_data_double($data_master,$data_check,$row_check){
		$x =4;
		$data ="";
		foreach($data_master as $key){
			if($key["C"]== $data_check && $row_check !== $x){
				$data="<small>ERROR : ROW (". $row_check . ") dan ROW (".$x.") Column C (".$key["C"].") Data Double</small><br>";
				break;
			}
			
			$x++;
		}
		
		return $data;
		
	}
	


	public function create_user_by_template($token){
		if($this->_token ==$token && $this->_user_id==1){
			$path_file = './temp_upload/template_user.xls';
			
			$this->load->library("YBSExcelReader");
			$excel  = new YBSExcelReader();
			$excel->set_file($path_file,"TEMPLATE");
			$dataFinal = $excel->read(4,2003,range('A','F'));
			
			$val = array();
			$val_exist= array();
			$val_final = array();
			$x=4;
			foreach($dataFinal as $key){
				$val["nmuser"]  	= $key["C"];
				$val["nama"]  	= $key["A"];
				$val["agentid"]  	= $key["B"];
				$pass 				=  (string) $key["D"];
				$val["passuser"]	= _generate($pass); 
				$val["opt_level"]	= (string) $key["E"];
				$val["opt_status"] 	= (string) $key["F"];
				$val["picture"]		= "default.png";
				
				
				$field=array();
				$field['nmuser'] =$val['nmuser'];
				$exist = $this->tmodel->if_exist('',$field);
				if($exist){
					$val_exist[] = "<small>ERROR : ROW (". $x . ") User ".$key["C"]."  sudah digunakan </small><br>";
				}else{
					$val_final [] = $val;
				}
				
				$x++;
			
			}
			
			$o = new Outputview();
			if(count($val_exist)>0){
				 $o->success = 'false';
				 $o->message = $val_exist;
				 echo $o->result();
				 return;
			}else{
				
				$split_data = array_chunk($val_final,100);
				foreach($split_data as $val){
					$this->tmodel->insert_multiple($val);
				}
				
				$o->success = 'true';
				$o->message = "<small>data berhasil di simpan..total data ".count($val_final)." row </small><br>";
				echo $o->result();
				return;
				
				
			}
			
			
		
			
		}else{
			redirect("Auth");
		}
	}
	
	public function download_template_user($token){
		if($token == $this->_token && $this->_user_id==1){
		
			//mendapatkan data level
			$data_level = $this->get_level();
			
			
			$this->load->library("PHPExcel");
			$objPHPExcel = new PHPExcel();
			
			//SET BORDER
			$thick = array ();
			$thick['borders']=array();
			$thick['borders']['allborders']=array();
			$thick['borders']['allborders']['style']=PHPExcel_Style_Border::BORDER_THIN ;
			

			$objPHPExcel->getProperties()->setCreator("Ahmad Sadikin")
								 ->setLastModifiedBy("Ahmad Sadikin")
								 ->setTitle("Office 2007 XLSX Test Document")
								 ->setSubject("Office 2007 XLSX Test Document")
								 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
								 ->setKeywords("office 2007 openxml php")
								 ->setCategory("Test result file");


			//========================================//
			/* 	 MEMBUAT TABLE ISIAN PADA COLUMN A1	  */
			//========================================//					 

			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'ISI PADA TABEL DI BAWAH INI (MAX 2000 ROW)')
						->setCellValue('A2', 'pastikan anda mengisi dengan benar, cek kembali isian anda sebelum melakukan upload ke system')
						->setCellValue('A3', 'NAMA')
						->setCellValue('B3', 'AGENTID')
						->setCellValue('C3', 'USER_NAME')
						->setCellValue('D3', 'PASSWORD')
						->setCellValue('E3', 'KODE_LEVEL')
						->setCellValue('F3', 'KODE_STATUS');
						
			//MERGE COLOMN A1-D1 UNTUK TITLE KETERANGAN
			$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');	
			
			//MERGE COLOMN A2-D2 UNTUK TITLE KETERANGAN
			$objPHPExcel->getActiveSheet()->mergeCells('A2:F2');	
			
				
			//MEMBUAT COLOR FONT RED A1
			$objPHPExcel->getActiveSheet()->getStyle('A1:A2')->getFont()
						->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);		
			
			
			//WRAP TEST A2
			$objPHPExcel->getActiveSheet()->getStyle('A2')
						->getAlignment()->setWrapText(true);
			
			//Set Height Row 2
			$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(40);			

			
			//SET ALIGNMENT -CENTER-CENTER A1-A2
			$objPHPExcel->getActiveSheet()->getStyle('A1:F2003')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:F2003')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);			
			
			
			//MEMBUAT COLOR FONT WHITE A3-D3	
			$objPHPExcel->getActiveSheet()->getStyle('A3:F3')->getFont()
						->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
						
			
			//BOLD A1
			$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			
			//BOLD A3-D3
			$objPHPExcel->getActiveSheet()->getStyle('A3:F3')->getFont()->setBold(true);
			
			
			//SET WIDTH COLUMN
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);	
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			
			
			
			//SET COLOR CELL BLACK A3-D3
			$objPHPExcel->getActiveSheet()->getStyle('A3:F3')->getFill()
						->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
						->getStartColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);
						
						
			//========================================//
			/* 	 END TABLE ISIAN PADA COLUMN A1	  */
			//========================================//	

					


			
						
			
			//========================================//
			/*MEMBUAT TABLE CODE LEVEL PADA COLUMN G3*/
			//========================================//
			
				//MENULIS PADA COLUMN G3
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('I3', 'KODE_LEVEL')
							->setCellValue('I4', 'KODE_LEVEL')
							->setCellValue('J4', 'DESKRIPSI');
				
				//MERGE COLOMN G3-H3 SEBAGAI TABLE TITLE
				$objPHPExcel->getActiveSheet()->mergeCells('I3:J3');
				
				//SET COLOR CELL BLACK G3
				$objPHPExcel->getActiveSheet()->getStyle('I3')->getFill()
							->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
							->getStartColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);	
				
				//MEMBUAT COLOR FONT WHITE G3-H3	
				$objPHPExcel->getActiveSheet()->getStyle('I3:J3')->getFont()
							->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);	

				//BOLD G3-H4
				$objPHPExcel->getActiveSheet()->getStyle('I3:J4')->getFont()->setBold(true);						
							
				
				//SET ALIGNMENT  TITLE CENTER-CENTER G3-H4
				$objPHPExcel->getActiveSheet()->getStyle('I3:I4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('I3:I4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
				
				//SET WIDTH Column G-H
				$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
				
				
							
							
				
				//membuat border				
				$objPHPExcel->getActiveSheet()->getStyle ( 'I3:J4' )->applyFromArray ($thick);
				
				$x = 5; //start row data
				foreach($data_level as $val){
					//mencegah id configurator di tampilkan
					if( $val['id'] > 1){
						$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('I'.$x, $val['id'])
						->setCellValue('J'.$x, $val['nmlevel']);
						
						$x++;
					}
				}
			
			

				$x = $x-1;
				
				
				$objPHPExcel->getActiveSheet()->getStyle('I5:J'.$x)->applyFromArray ($thick);
				$objPHPExcel->getActiveSheet()->getStyle('I5:I'.$x)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('I5:I'.$x)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	
				
			
			//========================================//
			/* END TABLE CODE LEVEL PADA COLUMN G3*/
			//========================================//


			
			
			//========================================//
			/*MEMBUAT TABLE CODE STATUS PADA COLUMN J3*/
			//========================================//
			
				$objPHPExcel->setActiveSheetIndex(0) 
							->setCellValue('L3', 'KODE_STATUS')
							->setCellValue('L4', 'KODE_STATUS')
							->setCellValue('M4', 'DESKRIPSI');
				
				//MERGE COLOMN J3-K3
				$objPHPExcel->getActiveSheet()->mergeCells('L3:M3');
				
				//SET COLOR CELL BLACK J3
				$objPHPExcel->getActiveSheet()->getStyle('L3')->getFill()
							->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
							->getStartColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);	
				
				//MEMBUAT COLOR FONT WHITE J3-K3	
				$objPHPExcel->getActiveSheet()->getStyle('L3:M3')->getFont()
							->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);	

				//BOLD J3-K4
				$objPHPExcel->getActiveSheet()->getStyle('L3:M4')->getFont()->setBold(true);						

				//SET ALIGNMENT TITLE -CENTER-CENTER J3-K4
				$objPHPExcel->getActiveSheet()->getStyle('L3:L4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('L3:L4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);	

				//SET WIDTH Column J-K
				$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);			
			
				//MEMBUAT BORDER TABLE
				$objPHPExcel->getActiveSheet()->getStyle ( 'L3:M6' )->applyFromArray ($thick);
			
				
				//MENGISI DATA
				$objPHPExcel->setActiveSheetIndex(0) 
							->setCellValue('L5', '1')
							->setCellValue('L6', '2')
							->setCellValue('M5', 'AKTIF')
							->setCellValue('M6', 'NON AKTIF');
				//set ALIGNMENT DATA			
				$objPHPExcel->getActiveSheet()->getStyle('L5:L6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->getStyle('L5:L6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);			
			
			//========================================//
			/* END TABLE CODE STATUS PADA COLUMN J3*/
			//========================================//
			
				
			
			//PROTECTION SHEET
			$objPHPExcel->getActiveSheet()->getProtection()->setPassword('PHPExcel');
			$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);

			//UNPROTECT TABLE ISIAN MAX 2000 ROW
			$objPHPExcel->getActiveSheet()->getStyle('A4:F2003')->getProtection()->setLocked(
				PHPExcel_Style_Protection::PROTECTION_UNPROTECTED
			);
			
			//membuat border				
		   $objPHPExcel->getActiveSheet()->getStyle ( 'A4:F2003' )->applyFromArray ($thick);

						
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('TEMPLATE');		

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Template_User.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			exit;	
		}else{
			redirect("Auth");			
		}		
		
	}
	
	
	
	
	
	
}
