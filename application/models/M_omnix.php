<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_omnix extends CI_Model
{
    /*Omnix*/
    public function get_data_omnix($agentid, $optlevel, $table, $where, $dari, $sampai)
    { 
        if ($optlevel == 8) {
            $filter = 'WHERE agentid="'. $agentid.'"';
            $where = "AND date(tanggal_pengerjaan) BETWEEN '$dari' AND '$sampai'";
        }else{
            $filter = '';
            $where = "WHERE date(tanggal_pengerjaan) BETWEEN '$dari' AND '$sampai'";
        }

        return $this->db->query("SELECT * FROM t_omnix_report ".$filter.$where." ")->result();
    }
    public function get_data_omnix_status_done($agentid, $optlevel, $table, $where, $dari, $sampai)
    { 
        if ($optlevel == 8) {
            $filter = 'WHERE agentid="'. $agentid.'"';
            $where = "AND date(tanggal_pengerjaan) BETWEEN '$dari' AND '$sampai'status='2'";
        }else{
            $filter = '';
            $where = "WHERE date(tanggal_pengerjaan) BETWEEN '$dari' AND '$sampai'AND status='2'";
        }

        return $this->db->query("SELECT * FROM t_omnix_report ".$filter.$where."")->result();
    }

    public function view(){
        return $this->db->get('t_omnix_report')->result(); // Tampilkan semua data yang ada di tabel omnix
    }
    
    public function tambahomnix($data)
    {
        $this->db->insert('t_omnix_report', $data);
        return TRUE;
    }
    public function update_omnix($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
    }
    public function delete_data_log_gangguan($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function get_nama_tl()
    {
        $this->db->select('t_log_problem.*, sys_user.agentid as agentid, sys_user.nama as nama');
        $this->db->from('t_log_problem');
        $this->db->join('sys_user', 'sys_user.agentid = t_log_problem.nama_tl');
        $query = $this->db->get();
        return $query;
    }

    /*End Omnix*/
}
