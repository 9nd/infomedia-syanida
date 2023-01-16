<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_log_gangguan extends CI_Model {
    /*log_gangguan*/
    // public function get_data_log_gangguan($table)
    // {
    //     return $this->db->get($table);
    // }
     public function detail_data_log_gangguan($id=NULL){
        $query = $this->db->get_where('t_log_problem', array('id' => $id)) ->row();
        return $query;
    }
    public function insert_data_log_gangguan($data,$table){
        $this->db->insert($table,$data);
    }
    public function update_data_log_gangguan($table,$data,$where){
        $this->db->update($table,$data,$where);
    }
    public function delete_data_log_gangguan($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function get_nama_tl(){
      $this->db->select('t_log_problem.*, sys_user.agentid as agentid, sys_user.nama as nama');
      $this->db->from('t_log_problem');
      $this->db->join('sys_user','sys_user.agentid = t_log_problem.nama_tl');      
      $query = $this->db->get();
      return $query;
   }

   // function get_no_ticket(){
   //      $q = $this->db->query("SELECT MAX(RIGHT(no_ticket,4)) AS kd_max FROM t_log_problem WHERE DATE(tanggal)=CURDATE()");
   //      $kd = "";
   //      if($q->num_rows()>0){
   //          foreach($q->result() as $k){
   //              $tmp = ((int)$k->kd_max)+1;  
   //              $kd = "PROF".sprintf("%04s", $tmp);
   //          }
   //      }else{
   //          $kd = "0001";
            
   //      }
   //      date_default_timezone_set('Asia/Jakarta');
   //      return $kd."-".date('ymd');
   //  }
    /*end Log Gangguan*/
    

}

