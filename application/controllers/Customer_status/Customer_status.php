<?php
require APPPATH . '/controllers/Customer_status/Customer_status_config.php';

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

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
class Customer_status extends CI_Controller {
	private $log_key,$log_temp;
	
    public function __construct() {
		parent::__construct();
		$this->log_key = 'log_Customer_status';
		$this->title = new Customer_status_config();
		// $this->load->model('sys/Dapros_cto_model','tmodel');
		// $this->load->model('Pract0_spd_bayar/Pract0_spd_bayar_model','pract0_spd_bayar');
    }

    
	
	// public function create_multiple(){
	// 	$data =array(
	// 		'title_page_big'				=> 'Buat Multiple',
	// 		'link_save'						=> site_url().'Cto/Check_payment/create_action',
	// 		'link_prepare_picture'			=> site_url().'prepare_picture'.$this->_token,
	// 		'link_download_template_user'	=> site_url().'Cto/Check_payment/download_template_user/'.$this->_token,
	// 		'link_upload_template'			=> site_url().'Cto/Check_payment/upload_template_user/'.$this->_token,
	// 		'link_back'						=> $this->agent->referrer(),

	// 	);
		
	// 	$this->template->load('Cto/Check_payment_form_multiple',$data);
	// }
	public function create_multiple(){
		$data =array(
			'title_page_big'				=> 'Customers status',
			'link_save'						=> site_url().'Customer_status/Customer_status/create_action',
			'link_prepare_picture'			=> site_url().'prepare_picture'.$this->_token,
			'link_download_template_user'	=> site_url().'Customer_status/Customer_status/download_template_user/'.$this->_token,
			'link_upload_template'			=> site_url().'Customer_status/Customer_status/upload_template_user/'.$this->_token,
			'link_back'						=> $this->agent->referrer(),

		);
		$datana="";
		if(isset($_POST['no_internet'])){
			$inet=$this->input->post('no_internet');
			$result=explode(",",$inet);
			$n=0;
			foreach($result as $row ){
				// echo $row;
				$hasil=$this->loadBillData(preg_replace('/[^A-Za-z0-9\-]/', '', $row));
				$datana=$datana.$hasil;
				$n++;
			}
		}
		$data['list']=$datana;
		$this->template->load('Customer_status/Check_payment_form_manual',$data);
	}
	public function loadBillData($inet){
		$url = "http://10.60.165.60/script/intag_search_trems.php?phone=$inet&rname=&raddr=&rphone=&via=TREMS";
		$return="";
		$payload = file_get_contents($url);
		if (strpos($payload, "silakan hubungi helpdesk") !== false || strpos($payload, "tidak mempunyai billing") !== false || strpos($payload, "No such host") !== false) {
			$return=$return."<tr><td>".$inet."</td><td>no data</td><td>no data</td><td>no data</td><td>no data</td><td>no data</td><td>no data</td><td>no data</td></tr>";
		}
		else{
			$dom = new domDocument;
			@$dom->loadHTML($payload);
			$dom->preserveWhiteSpace = true;
			$dom_ee=$dom->getElementsByTagName('table');
			$tab = $dom_ee[1];
			for($k=0; $k<=4; $k++){
				//billing payload
				$tableid = $dom_ee[0];
				$dataid = array();
				$idval = '<tr><td nowrap>'.$inet.'</td>';
				$tidee=$tableid->getElementsByTagName('tr');
				$row0 = $tidee[0];
				for($i=0; $i<$row0->childNodes->length; $i++){
					$eetd=$row0->getElementsByTagName('td');
					$load = $eetd[$i]->textContent;
					if($i==1){
						$idval .= "<td nowrap>".$load."</td>";
					}
				};

				//billing payload
				$tables = $dom_ee[1];
				$tidee=$tables->getElementsByTagName('tr');
				$rows = $tidee[0];
				$rows = $rows->parentNode->removeChild($rows);
				$rows = $tidee[0];
				$bill = array();
				$rowval = '';
				for($i=0; $i<$rows->childNodes->length; $i++){
					$tds=$rows->getElementsByTagName('td');
					$load = $tds[$i]->textContent;
					if(($i==1||$i==4||$i==3||$i==5||$i==7||$i==8)){
						if($i==3||$i==4){
							$load = preg_replace('/,/', '', $load);
						}
						$rowval .= "<td nowrap>".$load."</td>";
					}
				};
				if (strlen($rowval)>0){
					$return=$return.$idval.$rowval."</tr>";
				}
			}
		}
		return $return;
	}
	
	
}
