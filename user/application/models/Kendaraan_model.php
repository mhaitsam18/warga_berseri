<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kendaraan_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function insertKendaraan($data)
  {
    return $this->db->insert('pendataan_kendaraan', $data);
  }

}
