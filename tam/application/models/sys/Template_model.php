<?php

class Template_model extends CI_Model {

function __construct(){
      parent::__construct();
}

function create_model($file_name,$path_model,
					  $field_alias_field,$table_join,$index_alias_table_join,
					  $table,$crud_show){

$private_where="";
$private_ss_where="";
$private_insert="";
$private_id=""; 
$separator="";

if($crud_show=='off'){
	$private_id 		= "\$user_id";
	$private_where		= "		\$this->db->where('$table.user_input',\$user_id);";	
	$private_ss_where 	= "\$this->datatables->where('$table.user_input',\$user_id);";
	$private_insert		= " 	\$data['user_input'] = \$user_id;";
	$separator 			=  ",";
}					  
						  
$string = "<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class $file_name extends CI_Model {
   public \$id;	
   function __construct(){
        parent::__construct();
   }	
	
	public function json($private_id){
		\$this->datatables->select('";
		 foreach($field_alias_field as $key=>$val){
			$string.= "\n\t\t\t$key as $val,";		
		}
		
		
$string .="\n\t\t');
		
		\$this->datatables->from('$table');\n";

$xx = 1;
foreach($table_join as $key=>$val){
$ak = explode('.',$key);
$taf = $table.'.'.$key;
if(count($ak)>1){
	$alias = explode('_-_',$ak[1]);
	$taf = $alias[1].'.'.$alias[0];

}
$string .="	
		\$this->datatables->join('$val $index_alias_table_join[$xx]','$index_alias_table_join[$xx].id=$taf','LEFT'); \n";		
$xx++;
}
		
	
	
		
$string .="
		$private_ss_where
		
		//mengembalikan dalam bentuk array
		\$q =  json_decode(\$this->datatables->generate(),true);
		return \$q;
	}
	

   public function get_all($private_id){
		\$afield = array(";	

   foreach($field_alias_field as $key=>$val){
		$string.= "\n\t\t\t'$key as $val',";		
   }

$string.="
		
		);
		\$this->db->select(\$afield);\n";	


$xx = 1;
foreach($table_join as $key=>$val){
$ak = explode('.',$key);
$taf = $table.'.'.$key;
if(count($ak)>1){
	$alias = explode('_-_',$ak[1]);
	$taf = $alias[1].'.'.$alias[0];

}
$string .="		\$this->db->join('$val $index_alias_table_join[$xx]','$index_alias_table_join[$xx].id=$taf','LEFT'); \n";		
$xx++;
}


$string .=$private_where."
		\$this->db->order_by('$table.id', 'ASC');
		return \$this->db->get('$table')->result_array();
   }";



//----->function get_by_id <-------// 
$string .="


	public function get_by_id(\$id$separator$private_id){
		\$afield = array(";
		
foreach($field_alias_field as $key=>$val){
				
		 $string.= "\n\t\t\t'$key as $val',";
}

$string.="
		
		);
		\$this->db->select(\$afield);\n";	

$xx=1;

foreach($table_join as $key=>$val){
$ak = explode('.',$key);
$taf = $table.'.'.$key;
if(count($ak)>1){
	$alias = explode('_-_',$ak[1]);

	$taf = $alias[1].'.'.$alias[0];
	// $t = $k[0].'_-_'.$ak[0];//1_-_..	
	// $taf = $alias_table_join[$t].'.'.$ak[1];

}
$string .="		\$this->db->join('$val $index_alias_table_join[$xx]','$index_alias_table_join[$xx].id=$taf','LEFT'); \n";			
$xx++;
}


$string .=$private_where."
		\$this->db->where('$table.id', \$id);
		\$this->db->order_by('$table.id', 'ASC');
		return \$this->db->get('$table')->row();
   }";
//end get_by_id		



//----->function if_exist<-------// 		
$string .="


	/* Memastikan data yg dibuat tidak kembar/sama,
	   fungsi ini sebagai pengganti fungsi primary key dr db,
	   krn primary key sudah di gunakan untuk column id.
	   -create : id di kosongkan.
	   -update : id di isi dengan id data yg di proses.	
	*/	
	function if_exist(\$id,\$data".$separator.$private_id."){
		\$this->db->where('$table.id <>',\$id);
".$private_where."
		\$q = \$this->db->get_where('$table', \$data)->result_array();
		
		if(count(\$q)>0){
			return true;
		}else{
			return false;
		}		

	
";		
		

		
$string .="
	}
";		
//end if_exist			
		

//----->function insert<-------// 	
$string .="

	function insert(\$data".$separator.$private_id."){
	".$private_insert."
	    /* transaction rollback */
		\$this->db->trans_start();
		
		\$this->db->insert('$table', \$data);		
		/* id primary yg baru saja di input*/
		\$this->id = \$this->db->insert_id(); 
		
		\$this->db->trans_complete();
		return \$this->db->trans_status(); //return true or false
";



$string .="	}";		
//end insert		

		

//----->function update<-------// 	
$string .="

	function update(\$id,\$data".$separator.$private_id."){
".$private_where."
		/* transaction rollback */
		\$this->db->trans_start();

		\$this->db->where('$table.id', \$id);
		\$this->db->update('$table', \$data);
		
		\$this->db->trans_complete();
		return \$this->db->trans_status(); //return true or false	
";





$string .="	}";		
//end update	



//----->function delete_multiple<-------// 	
$string .="

	function delete_multiple(\$data".$separator.$private_id."){
		/* transaction rollback */
		\$this->db->trans_start();
		
		if(!empty(\$data)){
			\$this->db->where_in('$table.id',\$data);	
	".$private_where."
			\$this->db->delete('$table');
		}
		
		\$this->db->trans_complete();
		return \$this->db->trans_status(); //return true or false	
		
";


$string .="	}";		
//end delete_multiple	



		
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
		
		
$result = _createFile($string,$path_model,$file_name .'.php');		
return $result;		
		
}	
	
	
	
}	