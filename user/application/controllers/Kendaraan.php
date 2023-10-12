<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kendaraan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Kendaraan_model');
  }

  public function index()
  {
    if ($this->session->username) {
      $username = $this->session->username;
      $id_warga = $this->session->id_warga;
      $this->load->view('layouts/header');
      $this->load->view('home/kendaraan');
      $this->load->view('layouts/footer');
    }
    else {
      redirect('Auth');
    }
  }

  public function proses_kendaraan()
  {
    $this->form_validation->set_rules('kategori','Kategori','required');
    $this->form_validation->set_rules('merk','Merk','required');
    $this->form_validation->set_rules('plat_no','Nomor Polisi','required');

    if ($this->form_validation->run() == FALSE) {
      $this->index();
    }else {
      $id_warga       = $this->session->id_warga;
      $kategori       = $this->input->post('kategori',true);
      $merk           = $this->input->post('merk',true);
      $plat_no        = $this->input->post('plat_no',true);

      $data = [
            "id_warga"            => $id_warga,
            "kategori"            => $kategori,
            "merk"                => $merk,
            "plat_no"             => $plat_no
      ];

      $result = $this->Kendaraan_model->insertKendaraan($data);
      if ($result) {
        redirect(base_url('Kendaraan/'));
      }else {
        redirect(base_url('Kendaraan/'));
      }
    }
  }
}
