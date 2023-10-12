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
    $this->db->where('username_admin', $data['username_admin']);
    $this->db->where('password_admin', $data['password_admin']);

    $query = $this->db->get('data_admin');
    return $query;
  }

}
