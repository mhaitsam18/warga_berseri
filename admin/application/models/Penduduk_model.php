<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penduduk_model extends CI_Model{

  public function get_all_penduduk()
  {
    return $this->db->get('pendataan_warga');
  }

  // public function get_all_penduduk()
  // {
  //   $procedure = "CALL pview_pendataan_warga()";
  //   $query = $this->db->query($procedure);
  //   return $query;
  // }

  public function get_single_penduduk($id)
  {
    return $this->db->get_where('pendataan_warga', ['id_warga' => $id]);
  }

  public function delete_warga($id)
  {
    $procedure = "CALL pdelete_pendataan_warga('$id')";
    $query = $this->db->query($procedure);
    return $query;
  }

  public function updateWarga($id_warga,$data)
  {
    $this->db->where('id_warga', $id_warga);
    return $this->db->update('pendataan_warga', $data);
  }

  public function tampilRiwayatPendataan(){
      return $this->db->query('SELECT id_warga,nama,friwayat_pendataan_warga(id_warga) AS Status FROM riwayat_pendataan_warga');
      // return $this->db->query('CALL priwayat_pendataan_warga');
  }

}
