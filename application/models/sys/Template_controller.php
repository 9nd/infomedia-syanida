<?php
class Template_controller extends CI_Model {

function __construct(){
      parent::__construct();
}


function create_controller($fc,$fm,$fl,$ff,$pc,$gf,
					  $field_alias_form,$field_alias_field,$type_input_field,
					  $field_double,$field_empty,
					  $crud_show,$server_side){

$private_where="";
$private_insert="";
$private_id=""; 
$separator="";

if($crud_show=='off'){
	$private_id 	= "\$this->_user_id";
	$separator =  ",";
}	
					  

$string = "<?php
require APPPATH. '/controllers/$gf/$fc"."_config.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class $fc extends CI_Controller {
   private \$log_key,\$log_temp,\$title;
   function __construct(){
        parent::__construct();
		\$this->load->model('$gf/$fm','tmodel');
		\$this->log_key ='log_$fc';
		\$this->title = new $fc"."_config();
   }

";

//----->function index <-------//  
$string .="
	public function index(){
		\$data = array(
			'title_page_big'		=> 'DAFTAR',
			'title'					=> \$this->title,
			'link_refresh_table'	=> site_url().'$gf/$fc/refresh_table/'.\$this->_token,
			'link_create'			=> site_url().'$gf/$fc/create',
			'link_update'			=> site_url().'$gf/$fc/update',
			'link_delete'			=> site_url().'$gf/$fc/delete_multiple',
		);
		
		\$this->template->load('$gf/$fl',\$data);
	}
";	
//----->END index <-------//  	




//----->function refresh_table <-------//  
$string .="
	public function refresh_table(\$token){
		if(\$token==\$this->_token){";
			
			


if($server_side=='on'){
$string .= "
			\$row = \$this->tmodel->json($private_id);
			
			//encode id 
			\$tm = time();
			\$this->session->set_userdata(\$this->log_key,\$tm);
			\$x = 0;
			foreach(\$row['data'] as \$val){
				\$idgenerate = _encode_id(\$val['id'],\$tm);
				\$row['data'][\$x]['id'] = \$idgenerate;
				\$x++;
			}
			
			\$o = new Outputview();
			\$o->success	= 'true';
			\$o->serverside	= 'true';
			\$o->message	= \$row;
			
			echo \$o->result();
";
}else{
	
$string .="
			\$row = \$this->tmodel->get_all($private_id);
			
			//encode id 
			\$tm = time();
			\$this->session->set_userdata(\$this->log_key,\$tm);
			\$x = 0;
			foreach(\$row as \$val){
				\$idgenerate = _encode_id(\$val['id'],\$tm);
				\$row[\$x]['id'] = \$idgenerate;
				\$x++;
			}
			
			
			\$o = new Outputview();
			\$o->success	= 'true';
			\$o->message	= \$row;
			
			echo \$o->result();
";
}			
			
$string .="			

		}else{
			redirect('Auth');
		}
	}
";
//----->END refresh_table <-------//  



//----->function create <-------//  
$string .="
	public function create(){
		\$data = array(
			'title_page_big'		=> 'Buat Baru',
			'title'					=> \$this->title,
			'link_save'				=> site_url().'$gf/$fc/create_action',
			'link_back'				=> \$this->agent->referrer(),";

$string .="			
		);
		
		\$this->template->load('$gf/$ff',\$data);

	}
";
//----->END function create <-------//  
	
	
	
//----->function create action <-------//  	
$string .="
	public function create_action(){
		\$data 	= \$this->input->post('data_ajax',true);
		\$val	= json_decode(\$data,true);
		\$o		= new Outputview(); 

		/* 
		*	untuk mengganti message output
		* tambahkan perintah : \$o->message = 'isi pesan'; 
 		* sebelum perintah validasi.
		* ex.
		* 	\$o->message = 'halo ini pesan baru';
		* 	if(!\$o->not_empty(\$val['descriptions'],'#descriptions')){
		*		echo \$o->result();	
		*		return;
		*  	}
		*
		*/	
";	

	
foreach($field_double as $k=>$v){

$can_empty = $field_empty[$k];

if($can_empty==0 && $k !=='id' && $k !=='user_input'){
$string .="
		//mencegah data kosong
		if(!\$o->not_empty(\$val['$k'],'#$k')){
			echo \$o->result();	
			return;
		}
";		
}		
	
if($v==0  && $k !=='id' && $k !=='user_input'){

$string .="
		//mencegah data double
		\$field=array('$k'=>\$val['$k']);
		\$exist = \$this->tmodel->if_exist('',\$field$separator$private_id);
		if(!\$o->not_exist(\$exist,'#$k')){
			echo \$o->result();	
			return;
		}
";	

}




}


$string .="
		unset(\$val['id']);
		\$success = \$this->tmodel->insert(\$val$separator$private_id);
		echo \$o->auto_result(\$success);

	}
";	
//----->END create action <-------//  	





//----->function update <-------//  
$string .="
	public function update(\$id){
		\$id 				= \$this->security->xss_clean(\$id);
		\$id_generate		= \$id;
		
		/** proses decode id 
		* important !! tempdata digunakan sbagai antisipasi
		* perubahan session saat membuka tab baru secara bersamaan
		**/
		\$this->log_temp	= \$this->session->userdata(\$this->log_key);
		\$this->session->set_tempdata(\$id,\$this->log_temp,300);
		
		//mengembalikan id asli
		\$id = _decode_id(\$id,\$this->log_temp);
		
		\$row = \$this->tmodel->get_by_id(\$id$separator$private_id);
		
		if(\$row){
			\$data = array(
				'title_page_big'		=> 'Buat Baru',
				'title'					=> \$this->title,
				'link_save'				=> site_url().'$gf/$fc/update_action',
				'link_back'				=> \$this->agent->referrer(),
				'data'					=> \$row,";
foreach($field_empty as $k=>$v){

if($k=='id'){
	$string .="
				'$k'					=> \$id_generate,";					
}	

}
				
$string .="
			);
			
			\$this->template->load('$gf/$ff',\$data);
		}else{
			redirect(\$this->agent->referrer());
		}
	}
";


//----->END function update <-------//  
$string .="
	public function update_action(){
		\$data 	= \$this->input->post('data_ajax',true);
		\$val	= json_decode(\$data,true);
		\$this->log_temp		= \$this->session->tempdata(\$val['id']);
		\$val['id']				= _decode_id(\$val['id'],\$this->log_temp);
		
		\$o		= new Outputview(); 
			
		/* 
		*	untuk mengganti message output
		* tambahkan perintah : \$o->message = 'isi pesan'; 
 		* sebelum perintah validasi.
		* ex.
		* 	\$o->message = 'halo ini pesan baru';
		* 	if(!\$o->not_empty(\$val['descriptions'],'#descriptions')){
		*		echo \$o->result();	
		*		return;
		*  	}
		*
		*/			
";	
	
foreach($field_double as $k=>$v){

$can_empty = $field_empty[$k];	

if($can_empty==0 && $k !=='id' && $k !=='user_input'){
$string .="
		//mencegah data kosong
		if(!\$o->not_empty(\$val['$k'],'#$k')){
			echo \$o->result();	
			return;
		}
";		
}		
	
if($v==0  && $k !=='id' && $k !=='user_input'){

$string .="
		//mencegah data double
		\$field=array('$k'=>\$val['$k']);
		\$exist = \$this->tmodel->if_exist(\$val['id'],\$field$separator$private_id);
		if(!\$o->not_exist(\$exist,'#$k')){
			echo \$o->result();	
			return;
		}
";	

}
}



$string .="

		\$success = \$this->tmodel->update(\$val['id'],\$val$separator$private_id);
		echo \$o->auto_result(\$success);

	}
";	



//----->function update action <-------//  







//----->END function update action<-------//  


//----->function delete multiple <-------//  	
$string .="
	public function delete_multiple(){
		\$data=\$this->input->get('data_ajax',true);
		\$val=json_decode(\$data,true);
		\$data = explode(',',\$val['data_delete']);

		//get key generate
		\$log_id = \$this->session->userdata(\$this->log_key);
		\$xx=0;
		foreach(\$data as \$value){
			\$value =  _decode_id(\$value,\$log_id);
			//menganti ke id asli
			\$data[\$xx] = \$value;
			\$xx++;	
		}
		
		\$success = \$this->tmodel->delete_multiple(\$data$separator$private_id);
		
		\$o = new Outputview();
		
		//create message
		if(\$success){
			\$o->success 	= 'true';
			\$o->message	= 'Data berhasil di hapus !';
		}else{
			\$o->success 	= 'false';
			\$o->message	= 'Opps..Gagal menghapus data !!';
		}
		
		
		echo \$o->result();
	
	}
";	



//----->END delete multiple <-------//  		
	
	
	
//end class		
$string .= "


};

/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator ".date('Y-m-d H:i:s')." */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/

"	;	
	
	
	
$this->create_config_file($fc,$fm,$fl,$ff,$pc,$gf,
					  $field_alias_form,$field_alias_field,$type_input_field,
					  $crud_show);
					  
$result = _createFile($string,$pc,$fc .'.php');		
return $result;			
	
}



function create_config_file($fc,$fm,$fl,$ff,$pc,$gf,
					  $field_alias_form,$field_alias_field,$type_input_field,
					  $crud_show){

$string = "<?php
require APPPATH . 'controllers/sistem/General_title.php';
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class $fc".'_config'." {
	

";



$string .="
   function __construct(){
	   /* title */
	    \$this->general		= new General_title();
";

foreach($field_alias_form as $key=>$val){
$keys = str_replace('.','_',$key);	
$string .="		\$this->$keys	= '$val';
";	
}

$string .="
		
		
		
		/*field_alias_database db*/
";	
foreach($field_alias_field as $key=>$val){
$keys = str_replace('.','_',$key);	
$string .="		\$this->f_$val	= '$val';
";	
}


$string .="
		
		
		
		/* CONFIG FORM LIST */
		/* field_alias_database => \$title */	
		\$this->table_column =array(
";	
foreach($field_alias_field as $key=>$val){
$keys = str_replace('.','_',$key);	
$string .="			\$this->f_$val	=> \$this->$keys,
";	
}

$string .="		);
";




//end class		
$string .= "
	}

};









/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator ".date('Y-m-d H:i:s')." */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/

"	;	

$result =  _createFile($string,$pc,$fc .'_config.php');	
}











}
