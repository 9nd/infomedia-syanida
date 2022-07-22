<?php
header("Location: https://10.194.194.61/dashboard/app/dashboard_v2/dashboard");
// require_once("../library/config.php");
// include('../library/fs_umum.php');
// require_once("../classes/class_speed_template.php");
// require_once("../library/fungsi_paging.php");
// include('security.php');
// include('list_menu.php');

// if(is_array($_POST)) extract($_POST,EXTR_OVERWRITE);
// parse_str(decode($coded));
// $class="genap";
// $arr_order=array("asc" => "desc:down","desc" => "asc:up");
// $arr_class=array("ganjil"=>"genap","genap"=>"ganjil");

// $template = new speed_template($template_path);
// $template->register($template_name);

// dbconnect();
// $upd=$_SESSION[active_user_id];
// $row_count=25;	

// $query1="SELECT DISTINCT ncli,no_pstn,no_speedy,nama_pastel,no_handpone,email,layanan FROM
// 		 trans_profiling_validasi_mos WHERE `status` IN ('0','3',null) and ncli IS NOT NULL AND update_by is null order by tgl_insert desc" ;
// //$query1="SELECT * FROM trans_profiling_validasi_mos WHERE `status` IN ('0','3',null) AND update_by is null" ;				
// $result1 = @mysql_query($query1);
// while($rows1 = @mysql_fetch_assoc($result1))
// {
// 	@extract($rows1,EXTR_OVERWRITE);
// 	$no++;
// 		$nom=0;
// 		$query3="SELECT idx as countData,tgl_insert FROM
// 				 trans_profiling_validasi_mos WHERE `status` IN ('0','3',null) AND update_by is null AND ncli='$ncli' AND no_pstn='$no_pstn'"  ;
// 		//echo $query3;
// 		$result3 = @mysql_query($query3);
// 		while($rows3 = @mysql_fetch_assoc($result3))
// 		{
// 			@extract($rows3,EXTR_OVERWRITE);
// 			$nom++;
// 			if($nom>1){
// 				$query="UPDATE trans_profiling_validasi_mos SET `status`=10,update_by='SYS' 
// 						WHERE IDX='$countData'";
// 				$result04= mysql_unbuffered_query($query);
// 			}else{
// 				$idx=$countData;
// 			}
// 		}		


// 		$jam=substr($tgl_insert,10,10);
// 		$lup=substr($tgl_insert,8,2). "/" .substr($tgl_insert,5,2). "/" .substr($tgl_insert,0,4) ;
// 		if($status==3){
// 			$stsCall='CallBack';
// 		}else{
// 			$stsCall='NewData';
// 		}
// 		$lup=$lup." ".$jam;
// 		$link_Release="IPAddress=$IPAddress";
// 	$class=$arr_class[$class];
// 	$bgcolor=${$class};
// 	$template->push($template_name,"blok");

// }
// $template->finish_loop($template_name,"blok");





// disconnect();

// $template->parse($template_name);
// $template->print_template($template_name);
?>
