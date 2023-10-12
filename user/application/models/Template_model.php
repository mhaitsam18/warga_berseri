<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_model extends CI_Model{

  public function getTemplate()
  {
    $query = $this->db->get('template');
    return $query;
  }

  public function downloadTemplate($id)
  {
    $query = $this->db->get_where('template',array('id_template'=>$id));
    return $query->row_array();
  }

}
