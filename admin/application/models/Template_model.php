<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_model extends CI_Model{

  public function insertTemplate($data)
  {
    return $this->db->insert('template', $data);
  }

  public function delete_template($id)
  {
    $this->db->where('id_template', $id);
    return $this->db->delete('template');
  }

  public function get_all_template()
  {
    return $this->db->get('template');
  }

}
