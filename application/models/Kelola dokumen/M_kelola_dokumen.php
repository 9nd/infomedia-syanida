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
        return $this->db->get_where('tbl_coba', ['id' => $id])->row_array();
    }

    public function update_data()
    {
        $data = array(
            'dokumen' => $this->input->post('dokumen', true),
            'jenis_dokumen' => $this->input->post('jenis_dokumen', true),
            'nama_dokumen' => $this->input->post('nama_dokumen', true),
            'keterangan' => $this->input->post('keterangan', true),
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tbl_coba', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_coba');
    }
}
