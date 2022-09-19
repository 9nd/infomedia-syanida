<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Maintenance {
	private $ci;
	public $_maintenance_days;
	public $_maintenance_hours;
	public $_maintenance_minutes;
	public $_maintenance_second;
	public $_maintenance_desc;
	
	public function check(){
		$this->ci = & get_instance();
		$this->ci->load->model('sys/Sys_maintenance_model','info');
			
			$this->_maintenance_days	=	0;
			$this->_maintenance_hours 	= 	0;
			$this->_maintenance_minutes =	0;
			$this->_maintenance_second =	0;
			$this->_maintenance_desc    =   "";
		
		$ips 		= $this->ci->info->get_all_ip();
		$mode 		= $this->ci->info->get_maintenance_mode();
		
		$client_ip = array('ip_address'=>$_SERVER['REMOTE_ADDR']);

        if(!in_array($client_ip,$ips) && $mode == 1 ) {
			
			//kondisi dimana maintenance mode di aktifkan dan yang mengakses bukan  dari ip terdaftar
			//memastikan jika yang di akses adalah url registerip
			if($this->ci->uri->total_segments()==4){
				if($this->ci->uri->segment(1)=="api" && $this->ci->uri->segment(2)=="Public_Access" && $this->ci->uri->segment(3)=="aXmqpMdcWaoPffGNmzUiadCdBcbdcBqorAuroo" ){
					return;
				}
			}
			
			$time_m = $this->ci->info->get_time_maintenance();
			
			if($time_m){
				$start				= date('Y-m-d H:i:s',$time_m->start);
				
				$day				= $time_m->days;
				$hour				= $time_m->hours;
				$minute				= $time_m->minutes;
				
				$end_schedule_time	= date('Y-m-d H:i:s',strtotime("+$day day +$hour hour +$minute minutes",strtotime($start)));	
				

				$time = time();
				
				$run_time			= date('Y-m-d H:i:s',$time);
				$t1					= new DateTime($run_time);
				$t2					= new DateTime($end_schedule_time);
					
				$selisih			= $t1->diff($t2);
				
				$sisa_waktu			= $selisih->format('%R%a');
				
				if($sisa_waktu==="-0" ){
					$this->_maintenance_desc    =   "system shutdown..";
				}else{
					$this->_maintenance_days	=	$selisih->days;
					$this->_maintenance_hours 	= 	$selisih->h;
					$this->_maintenance_minutes =	$selisih->i;
					$this->_maintenance_second =	$selisih->s;
					$this->_maintenance_desc    =   $time_m->desc;
				}

				
			}else{
				//kondisi dimana semua time schedule maintenance di hentikan
				//dan yang mengakses bukan dari ip terdaftar
				$this->_maintenance_desc    =   "system shutdown..";
			}
			
			include(APPPATH.'views/front-end/maintenance/Maintenance.php');
            exit;
		
		}
   
	}
   
   
   
}
