<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function login($data)
  {
    $this->db->where('username', $data['username']);
    $this->db->where('password', $data['password']);

    $query = $this->db->get('pendataan_warga');
    return $query;
  }

  public function register($data)
  {
    $query = $this->db->insert('pendataan_warga', $data);
    return $query;
  }

  public function id_warga()
  {
    $warga = "W-PBB-";
    $q     = "SELECT MAX(TRIM(REPLACE(id_warga,'W-PBB-', ''))) as nama
             FROM pendataan_warga WHERE id_warga LIKE '$warga%'";
    $baris = $this->db->query($q);
    $akhir = $baris->row()->nama;
    $akhir++;
    $id    =str_pad($akhir, 3, "0", STR_PAD_LEFT);
    $id    = "W-PBB-".$id;
    return $id;
  }

}
