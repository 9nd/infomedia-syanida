<?php
/**
 *
 */
class Problemwfh_model extends CI_Model
{

  public function get($batas=NULL,$offset=NULL,$cari=NULL)
  {
      if ($batas != NULL) {
        $this->db->limit($batas,$offset);
      }
      if ($cari != NULL) {
          $this->db->or_like($cari);
      }
      $this->db->from('log_problemwfh');
      $query = $this->db->get();
      return $query->result();
  }
  public function jumlah_row($search)
  {
    $this->db->or_like($search);
    $query = $this->db->get('log_problemwfh');

    return $query->num_rows();
  }

  function live_query($query)
    {
        $query = $this->db->query($query);
        return $query;
    }



  public function get_by_id($kondisi)
  {
      $this->db->from('log_problemwfh');
      $this->db->where($kondisi);
      $query = $this->db->get();
      return $query->row();
  }

  public function insert($data)
  {
      $this->db->insert('log_problemwfh',$data);
      return TRUE;
  }
  public function delete($where)
  {
      $this->db->where($where);
      $this->db->delete('log_problemwfh');
      return TRUE;
  }
  public function update($data,$kondisi)
  {
      $this->db->update('log_problemwfh',$data,$kondisi);
      return TRUE;
  }

}
