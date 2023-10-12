<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Profile_model');
  }

  public function index()
  {

  }

  public function pendataan()
  {
    if ($this->session->username) {
      $username = $this->session->username;
      $pendataan_warga = $this->Profile_model->data_user($username)->row();
      $data['pendataan_warga']  = $pendataan_warga;
      $this->load->view('layouts/header');
      $this->load->view('home/pendataan', $data);
      $this->load->view('layouts/footer');
    }
    else {
      redirect('Auth');
    }
  }

  public function upload_foto()
  {
    if (empty($_FILES['foto_user']['name'])) {
    $this->form_validation->set_rules('foto_user','Foto Profil','required');
      if ($this->form_validation->run() == FALSE) {
    $this->pendataan();
    }
  }else {
    $config['upload_path']          = './uploads/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
    $config['max_size']             = 2000;

    $this->load->library('upload', $config);

    if (! $this->upload->do_upload('foto_user')) {
      $this->session->set_flashdata('status','File gagal diupload.');
      redirect(base_url('Profile/pendataan'));
      }else {
      $foto_user    = $this->upload->data('file_name');
      $data = [
            'foto_user' => $foto_user
      ];
      $this->Profile_model->update_foto($data);
      $this->session->set_flashdata('flash','Diubah');
      redirect(base_url('Profile/pendataan'));

      }
    }
  }

  public function hapus_foto()
  {
      $data = [
            'foto_user' => ''
      ];
      $this->Profile_model->update_foto($data);
      $this->session->set_flashdata('flash','Dihapus');
      redirect(base_url('Profile/pendataan'));
  }

  public function proses_profile()
  {

    $this->form_validation->set_rules('no_rumah','No Rumah','required|min_length[2]|numeric',[
        'min_length' => 'No rumah yang anda masukan terlalu pendek!'
]);
    $this->form_validation->set_rules('rt','RT','required|numeric');
    $this->form_validation->set_rules('rw','RW','required|numeric');
    $this->form_validation->set_rules('alamat','Alamat','required|min_length[10]',[
        'min_length' => 'Alamat yang anda masukan kurang lengkap!'
]);
    $this->form_validation->set_rules('nama','Nama','required');
    $this->form_validation->set_rules('nik','NIK','required|min_length[16]|numeric',[
        'min_length' => 'NIK yang anda masukan terlalu pendek!'
]);
    $this->form_validation->set_rules('no_akta','Nomor Akta','required|min_length[16]|numeric',[
        'min_length' => 'Nomor Akta yang anda masukan terlalu pendek!'
]);
    $this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','required|alpha');
    $this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','required|alpha');
    $this->form_validation->set_rules('tempat_lahir','Tempat Lahir','required|alpha');
    $this->form_validation->set_rules('agama','Agama','required|alpha');
    $this->form_validation->set_rules('pendidikan','Pendidikan','required');
    $this->form_validation->set_rules('umur','Umur','required|numeric');
    $this->form_validation->set_rules('pekerjaan','Pekerjaan','required');

    if ($this->form_validation->run() == FALSE) {
      $this->pendataan();
    }else {
      $no_rumah       = $this->input->post('no_rumah',true);
      $rt             = $this->input->post('rt',true);
      $rw             = $this->input->post('rw',true);
      $alamat         = $this->input->post('alamat',true);
      $nama           = $this->input->post('nama',true);
      $nik            = $this->input->post('nik',true);
      $no_akta        = $this->input->post('no_akta',true);
      $jenis_kelamin  = $this->input->post('jenis_kelamin',true);
      $no_rumah       = $this->input->post('no_rumah',true);
      $tempat_lahir   = $this->input->post('tempat_lahir',true);
      $tanggal_lahir  = $this->input->post('tanggal_lahir',true);
      $agama          = $this->input->post('agama',true);
      $pendidikan     = $this->input->post('pendidikan',true);
      $umur           = $this->input->post('umur',true);
      $pekerjaan      = $this->input->post('pekerjaan',true);

      $data = [
            "no_rumah"            => $no_rumah,
            "rt"                  => $rt,
            "rw"                => $rw,
            "alamat"              => $alamat,
            "nama"                => $nama,
            "nik"                 => $nik,
            "no_akta"             => $no_akta,
            "jenis_kelamin"       => $jenis_kelamin,
            "no_rumah"            => $no_rumah,
            "tempat_lahir"        => $tempat_lahir,
            "tanggal_lahir"       => $tanggal_lahir,
            "agama"               => $agama,
            "pendidikan"          => $pendidikan,
            "umur"                => $umur,
            "pekerjaan"           => $pekerjaan,
      ];

      $result = $this->Profile_model->profile($data);
      if ($result) {
        redirect(base_url('Profile/pendataan'));
      }else {
        redirect(base_url('Profile/pendataan'));
      }
    }
  }
}
