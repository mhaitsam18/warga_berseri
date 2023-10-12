<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penduduk_model extends CI_Model{

  public function get_all_penduduk()
  {
    return $this->db->get('warga');
  }

  public function get_single_penduduk($id)
  {
    return $this->db->get_where('warga', ['id_warga' => $id]);
  }

  public function delete_warga($id)
  {
    $this->db->where('id_warga', $id);
    $query = $this->db->delete('warga');
    return $query;
  }

}
