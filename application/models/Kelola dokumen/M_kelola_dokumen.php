<?php

class M_kelola_dokumen extends CI_Model
{
    public function get_data($table)
    {
        return $this->db->get($table);
    }

    public function insert_data($data)
    {
        $this->db->insert('tbl_coba', $data);
    }

    public function get_data_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_coba');
        $this->db->where('id', $id);
        return $this->db->get()->row();
    }

    public function update_data($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_coba', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_coba');
    }
}
