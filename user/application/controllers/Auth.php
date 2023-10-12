<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Auth_model');
  }

  public function index()
  {
   $data['title'] = "Masuk";
   $this->load->view('layouts/auth_header', $data);
   $this->load->view('auth/login');
   $this->load->view('layouts/auth_footer');
  }

  public function register()
  {
   $data['title'] = "Registrasi";
   $this->load->view('layouts/auth_header', $data);
   $this->load->view('auth/register');
   $this->load->view('layouts/auth_footer');
  }

  public function proses_login()
  {

    $username = $this->input->POST('username');
    $password = $this->input->POST('password');

    $data = array(
      'username' => $username,
      'password' => $password
    );

    $cek_user = $this->Auth_model->login($data);
    if ($cek_user->num_rows() > 0) {
      $this->session->set_userdata('username', $username);
      $this->session->set_flashdata('flash','berhasil');
      redirect(base_url(''));
    }
    else {
      $this->session->set_flashdata('status','Email atau Password salah');
      redirect(base_url('Auth'));
    }

  }

  // public function proses_register()
  // {
  //   $this->form_validation->set_rules('username','Username','required');
  //   $this->form_validation->set_rules('password','Password','required');
  //   $this->form_validation->set_rules('no_rumah','No Rumah','required');
  //
  //
  //   if ($this->form_validation->run() == FALSE) {
  //     $this->register();
  //   }else {
  //     $username       = $this->input->post('username',true);
  //     $password       = $this->input->post('password',true);
  //
  //     $data = [
  //           "username"        => $username,
  //           "password"        => PASSWORD_HASH($password,PASSWORD_DEFAULT)
  //     ];
  //
  //     $result = $this->Auth_model->register($data);
  //     if ($result) {
  //       redirect(base_url('Auth/'));
  //     }else {
  //       redirect(base_url('Auth/register'));
  //     }
  //   }
  // }

  public function proses_register()
  {
    $this->form_validation->set_rules('no_rumah','No Rumah','required|min_length[2]|numeric',[
        'min_length' => 'No rumah yang anda masukan terlalu pendek!'
]);
    $this->form_validation->set_rules('username','Username','required|trim|is_unique[pendataan_warga.username]',[
        'is_unique' => 'Username telah dipakai!'
    ]);
    $this->form_validation->set_rules('nama','Nama Lengkap','required');
    $this->form_validation->set_rules('password','Password','required|trim|min_length[5]',[
        'min_length' => 'Password terlalu pendek!'
    ]);

    if (empty($_FILES['foto_ktp']['name'])) {
      $this->form_validation->set_rules('foto_ktp','Foto KTP','required');
    }
    if ($this->form_validation->run() == FALSE) {
      $this->register();
    }else {
      $id_warga   = $this->Auth_model->id_warga();
      $no_rumah   = $this->input->post('no_rumah');
      $nama       = $this->input->post('nama');
      $username   = $this->input->post('username',true);
      $password   = $this->input->post('password',true);

      $config['upload_path']          = './uploads/';
      $config['allowed_types']        = 'pdf|jpeg|jpg|png';
      $config['max_size']             = 4000;

      $this->load->library('upload', $config);

      if (! $this->upload->do_upload('foto_ktp')) {
        $this->session->set_flashdata('status','File gagal diupload.');
        redirect(base_url('auth/register'));
      }else {
        $foto_ktp = $this->upload->data('file_name');

        $data = array(
            'id_warga'   => $id_warga,
            'no_rumah'   => $no_rumah,
            'nama'       => $nama,
            'username'   => $username,
            'password'   => $password,
            'status'     => 'Belum Terverifikasi',
            'foto_ktp'    => $foto_ktp
        );

        $result = $this->Auth_model->register($data);
        if ($result) {
          redirect(base_url('auth'));
        }else {
          redirect(base_url('auth/register'));
        }
      }
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect(base_url());
  }

}
