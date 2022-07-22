<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Authorization
 *
 * @author Dhiya
 */
class Authorization extends CI_Model {
    public $table_auth = 'sys_authorized';
	public $table_level ='sys_level';
	public $table_user = 'sys_user';
	
	private $fopt_status = 'opt_status';
	private $fopt_level =  'opt_level';
	private $fid = 'id';
	private $fnmuser = 'nmuser';
	private $fshortcut = 'shortcut';
	private $flink  = 'link';
	private $fcode  = 'code';
	private $fform_name = 'form_name';
	
	private $fid_level = 'id_level';
	private $fid_module = 'id_module';
	private $fid_form = 'id_form';
	

    
	
	/*deprecated*/
    public function is_valid_user($data){
        $afield=array(
		 'sys_user.id',
		 'sys_user.nmuser',
		// 'sys_user.passuser',
		 'sys_user.opt_level',
		 'sys_user.idkaryawan',
		 'sys_user.opt_status',
		 'sys_level.nmlevel',
		 'sys_user.picture',
		);
		
		$this->db->select($afield);
		$this->db->join($this->table_level,
		$this->table_level.'.'.$this->fid. '=' .
		$this->table_user.'.'.$this->fopt_level,'left');
		$this->db->where_not_in($this->table_level.'.'.$this->fopt_status,2);
		$this->db->where_not_in($this->table_user.'.'.$this->fopt_status,2);
        $q = $this->db->get_where($this->table_user, $data);
        return $q->row();
    }
	
	public function is_valid_password($data){
		$afield = array(
			'sys_user.id'
		);
		$this->db->select($afield);
		$this->db->where('nmuser', $data['nmuser']);
		$this->db->where('passuser', $data['passuser']);
		$q =  $this->db->get('sys_user')->result_array();
		if(count($q)>0){
			return true;
		}else{
			return false;
		}
	}
	
	
	public function get_user_data($token,$logtime){
		$afield=array(
		 'sys_user.id',
		 'sys_user.nmuser',
		 'sys_user.opt_level',
		 'sys_user.opt_status',
		 'sys_level.nmlevel',
		 'sys_user.picture',
		);
		
		$data=array(
			'tokenserial'=>$token,
			'login_time'=>$logtime,
		);
		
		$this->db->select($afield);
		$this->db->join('sys_user',	'sys_user.id=sys_userlogin.iduser','left');
		$this->db->join('sys_level', 'sys_level.id=sys_user.opt_level','left');
		$this->db->where_not_in($this->table_level.'.'.$this->fopt_status,2);
		$this->db->where_not_in($this->table_user.'.'.$this->fopt_status,2);
        $q = $this->db->get_where('sys_userlogin', $data);
        return $q->result_array();//->row();
		
	}
	
	
	
	public function get_token($data){
		$afield1=array(
		 'sys_user.id',
		);
		$this->db->select($afield1);
		$this->db->where('nmuser', $data['nmuser']);
		$this->db->where('passuser', $data['passuser']);
		$this->db->where('sys_user.opt_status <>', '2');
		$this->db->where('sys_level.opt_status <>', '2');
		$this->db->join('sys_level','sys_level.id=sys_user.opt_level');
		$data = $this->db->get('sys_user')->row();
		
		if(empty($data)){
			return false;
		}else{
			$time = time();
			$token = $this->create_token();
			$df =array(
				'iduser'=>$data->id,
				'tokenserial'=>$token,
				'login_time'=>$time,
			); 
			
			//Untuk penggunaan SQL Server Remark Script Replace
			//$success =  $this->db->replace('sys_userlogin', $df);
			
			//Untuk penggunaan SQL Server Gunakan Script Ini Untuk Update Data User Token
			$this->db->select('iduser');
			$this->db->where('iduser', $data->id);			
			$datanya = $this->db->get('sys_userlogin')->row();
			if(empty($datanya)){
				$success =  $this->db->insert('sys_userlogin', $df);
			}else{
				$this->db->set('tokenserial',$token);
				$this->db->set('login_time',$time);
				$this->db->where('iduser', $data->id);			
				$success =  $this->db->update('sys_userlogin');
			}
			//Batas Akhir Scritpnya
			
			//jika berhasil menginput token
			if($success=='1'){
				$data=array(
					'token'=> $token,
					'time'=>$time,
					'iduser'=>$data->id,
				);
				return $data;
			}else{
				return false;
			}
			
		}	
		
	}
	
	
	
	public function is_valid_token($token,$logtime){
		$afield=array(
		 'sys_userlogin.iduser',
		);
		
		$this->db->select($afield);
		$this->db->where('sys_userlogin.tokenserial', $token);
		$this->db->where('sys_userlogin.login_time', $logtime);
		$q =  $this->db->get('sys_userlogin')->result_array();
		if(count($q)>0){
			return 'true';
		}else{
			return 'false';
		}
		
	}
	
	
	private function create_token(){
		Date_default_timezone_set('Asia/Makassar');
		$end = new DateTime();
		$f1 = sha1($end->getTimestamp());
		$f2 = md5('195225'.$f1.'32521');
		return $f2;
	}


	public function get_idform($link){
		$afield = array(
			$this->fid,
			$this->fshortcut,
			$this->fcode,
			$this->fform_name,
		);
		 $this->db->select($afield);
		 $this->db->where($this->flink,$link);
		 $query=$this->db->get('sys_form');
		 return $query->result_array();
	}
	
	public function get_dataform_by_code($initial_module,$code){
		$afield=array(
		 $this->fid,
		 $this->fcode,
		 $this->flink,
		 $this->fform_name,
		);
		 $this->db->select($afield);
		 $this->db->where($this->fcode,$code);
		 $this->db->where_not_in($this->fshortcut,2);
		 $query=$this->db->get($initial_module.'_form');
		 return $query->result_array();
	}
	
	
	
	
	function is_valid_auth_link($idlevel,$idform)
    {
		$condition=array(
		$this->table_auth .'.'.$this->fid_level =>$idlevel,
		$this->table_auth .'.'.$this->fid_form => $idform,
		);
		
		$this->db->select($this->fid);
		$this->db->where($this->fid_level,$idlevel);
		$this->db->where($this->fid_form,$idform);
		$query = $this->db->get($this->table_auth);
		$data = $query->row();
	
		if($data==NULL){
			return FALSE;
		}else{
			return TRUE;
		}
	
	}
	
    
    
}
