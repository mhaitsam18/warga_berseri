<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kendaraan_model extends CI_Model{

  public function get_all_kendaraan()
  {
    return $this->db->get('Pendataan_Kendaraan');
  }

  public function get_call_nama($id_warga)
  {
    $this->db->select('pendataan_warga.*,pendataan_kendaraan.*');
    $this->db->from('pendataan_kendaraan');
    $this->db->join('pendataan_warga', 'pendataan_warga.id_warga = pendataan_kendaraan.id_warga');
    $this->db->where('pendataan_warga.id_warga', $id_warga);
    $this->db->where('pendataan_kendaraan.id_warga', $id_warga);
    $query = $this->db->get();
    return $query;
  }

}
