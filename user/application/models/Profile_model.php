<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function profile($data)
  {
    $id_warga   = $this->session->id_warga;
    $this->db->where('id_warga',$id_warga);
    $this->db->update('pendataan_warga',$data);
  }

  public function update_foto($data)
  {
    $id_warga   = $this->session->id_warga;
    $this->db->where('id_warga',$id_warga);
    $q = $this->db->update('pendataan_warga',$data);

    return $q;
  }


  public function data_user($username)
  {
    $query = $this->db->get_where('pendataan_warga',['username' => $username]);
    return $query;
  }

}
