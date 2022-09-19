<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('ybs_sisa_waktu')){
	
	/**
	 * Mendapatkan sisa waktu
	 *
	 * @param	int	Unix timestamp
	 * @param	int	Unix timestamp
	 * @return	string
	 */
	function ybs_sisa_waktu($start,$end){
		$sisa_waktu="";
				//konversi tanggal
				Date_default_timezone_set('Asia/Makassar');
				
				$dt_s				= date('Y-m-d H:i:s',$start);
				$dt_e				= date('Y-m-d H:i:s',$end);
			
				
				$t2					= new DateTime($dt_s);
				$tn					= new DateTime($dt_e);
				
				$tn_diff			= $tn->diff($t2);
				$sisa_waktu			= $tn_diff->format('%R%a');
				
				if($sisa_waktu > 0){
					$sisa_waktu	= $tn_diff->format('%a hari');
				}else if($sisa_waktu == 0 ){
					if(strpos($sisa_waktu,'-') !== false){
						$sisa_waktu	= 'hari ini';	
					}else{
						$sisa_waktu	= '1 hari';	
					}		
				}else if($sisa_waktu  < 0 && $sisa_waktu  >= -5 ){
					$sisa_waktu	= 'masa tenggang (max 5 hari)';
				}else {
					$sisa_waktu	= 'expayer';
				}	
		return $sisa_waktu;			
	}
	
}


if ( ! function_exists('ybs_tanggal_indo')){
	 /**
	 * Konversi tanggal timespan to tanggal indo 
	 *
	 * @param	int	Unix timestamp
	 * @return	string
	 */
	function ybs_tanggal_indo ($date){
		//konversi tanggal
		Date_default_timezone_set('Asia/Makassar');
		$dt_s				= date('d M Y',$date);
		return $dt_s;
	}
	
	function _indonesia_date ($date){
		//konversi tanggal
		Date_default_timezone_set('Asia/Makassar');
		$dt_s				= date('d M Y H:i:s',$date);
		return $dt_s;
	}
	
	function ybs_jam ($date){
		//konversi tanggal
		Date_default_timezone_set('Asia/Makassar');
		$dt_s				= date('H:i:s',$date);
		return $dt_s;
	}

	function ybs_nama_hari ($date){
		//konversi tanggal
		Date_default_timezone_set('Asia/Makassar');
		$dt_s				= date('l',$date);
		$day  = "";
		switch(strtolower($dt_s)){
			
			case "sunday" :
				$day = "Ahad";
				break;
			case "monday" :
				$day = "Senin";
				break;
			case "tuesday" :
				$day = "Selasa";
				break;
			case "wednesday" :
				$day = "Rabu";
				break;
			case "thursday" :
				$day = "Kamis";
				break;	
			case "friday" :
				$day = "Ahad";
				break;
			case "saturday" :
				$day = "Ahad";
				break;
			default :
				$day = $dt_s;
			
		
		
		
		}	
		return $day;
	}
	
}	
