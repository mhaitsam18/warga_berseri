<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('Penduduk_model');
    $this->load->model('Template_model');
    $this->load->model('Fasilitas_Model');
    $this->load->model('Kendaraan_model');
    date_default_timezone_set('Asia/Jakarta');
  }

  public function index()
  {

    $data['title'] = 'Dashboard Admin';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('layouts/header', $data);
    $this->load->view('dashboard/index', $data);
    $this->load->view('layouts/footer', $data);
  }

  public function detail_warga($id)
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    if (!$this->session->username_admin) {
      redirect(base_url());
    } else {
      $query = $this->Penduduk_model->get_single_penduduk($id)->row();
      $data['id_warga'] = $query;
      $data['title'] = 'Detail Warga';
      $this->load->view('layouts/header', $data);
      $this->load->view('dashboard/detail_warga', $data);
      $this->load->view('layouts/footer', $data);
    }
  }

  public function data_warga()
  {
    $query = $this->Penduduk_model->get_all_penduduk()->result();
    $data['pendataan_warga'] = $query;
    $data['title'] = 'Data Warga';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('layouts/header', $data);
    $this->load->view('dashboard/data_warga', $data);
    $this->load->view('layouts/footer', $data);
  }

  public function delete_warga($id)
  {
    $query = $this->Penduduk_model->delete_warga($id);
    if ($query) {
      return redirect(base_url('Dashboard/data_warga'));
    }

    echo "Gagal";
  }

  public function verifikasi_warga($id_warga)
  {
    $data = [
      'status' => 'Terverifikasi'
    ];
    $result = $this->Penduduk_model->updateWarga($id_warga, $data);
    redirect('Dashboard/data_warga');
  }

  public function template()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $query = $this->Template_model->get_all_template()->result();
    $data['template'] = $query;
    $data['title'] = 'Template';
    $this->load->view('layouts/header', $data);
    $this->load->view('dashboard/template', $data);
    $this->load->view('layouts/footer', $data);
  }


  public function tambah_template()
  {
    if (empty($_FILES['file_template']['name'])) {
      $this->form_validation->set_rules('file_template', 'file template', 'required');
    }
    $config['upload_path']    = './uploads/';
    $config['allowed_types']  = 'pdf|docx|doc';
    $config['max_size']       = 5000;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('file_template')) {
      $this->session->set_flashdata('status', 'File gagal diupload.');
      redirect(base_url('Dashboard/template'));
    } else {

      $nama_template     = $this->input->post('nama_template');
      $tgl_buat          = date('Y-m-d');
      $file_template     = $this->upload->data('file_name');

      $data = array(
        'nama_template'   => $nama_template,
        'tgl_buat'        => $tgl_buat,
        'file_template'   => $file_template
      );

      $query = $this->Template_model->insertTemplate($data);
      $this->session->set_flashdata('file', 'File berhasil diupload');
      redirect(base_url('Dashboard/template'));
    }
  }

  public function fasilitas()
  {
    $query = $this->Fasilitas_Model->get_fasilitas()->result();
    $data['data_fasilitas'] = $query;
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['title'] = 'Data Fasilitas';
    $this->load->view('layouts/header', $data);
    $this->load->view('dashboard/V_fasilitas', $data);
    $this->load->view('layouts/footer', $data);
  }

  public function create()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['title'] = 'Tambah Data';
    $this->load->view('layouts/header', $data);
    $this->load->view('dashboard/V_tambahdata', $data);
    $this->load->view('layouts/footer', $data);
  }

  public function insert()
  {
    $nama_lokasi = $this->input->post('nama_lokasi');
    $fasilitas_lokasi = $this->input->post('fasilitas_lokasi');
    $alamat_lokasi = $this->input->post('alamat_lokasi');
    $foto_lokasi = $this->input->post('foto_lokasi');

    //get lat long
    $prepAddr = rawurlencode($alamat_lokasi);
    $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=false&key=AIzaSyD0IiE8DDVHIZJYCT1jmcaJpXtjP6Dftvg');
    $output = json_decode($geocode);
    $latitude = $output->results[0]->geometry->location->lat;
    $longitude = $output->results[0]->geometry->location->lng;

    $config['upload_path'] = './foto_lokasi/';
    $config['allowed_types'] = 'jpeg|png|jpg';
    // $config['max_size'] = '99999999999';
    // $config['max_width'] = '99999999999';
    // $config['max_height'] = '99999999999';

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('foto_lokasi')) {
      $error = array('error' => $this->upload->display_errors());
      // $this->load->view('layouts/header');
      // $this->load->view('dashboard/V_tambahdata');
      // $this->load->view('layouts/footer');
      echo "<pre>";
      // print_r ($error);
      echo "</pre>";
      redirect(base_url('dashboard/get'));
    } else {
      $data = $this->upload->data();
      $foto_lokasi = '/warga_berseri/admin/foto_lokasi/' . $data['file_name'];
      $data = array(
        'nama_lokasi' => $nama_lokasi,
        'fasilitas_lokasi' => $fasilitas_lokasi,
        'alamat_lokasi' => $alamat_lokasi,
        'foto_lokasi' => $foto_lokasi,
        'lat' => $latitude,
        'long' => $longitude,
      );
      $this->Fasilitas_Model->insert_fasilitas($data);
      redirect(base_url('dashboard/get'));
    }
  }

  public function get()
  {
    $q = $this->Fasilitas_Model->get_fasilitas()->result();
    $data['data_fasilitas'] = $q;
    $data['title'] = 'Data Fasilitas';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->load->view('layouts/header', $data);
    $this->load->view('dashboard/V_fasilitas', $data);
    $this->load->view('layouts/footer', $data);
  }

  public function delete($id)
  {
    $q = $this->Fasilitas_Model->delete_fasilitas($id);

    if ($q) {
      return redirect(base_url('Dashboard/get'));
    }
    echo "Gagal";
  }

  public function edit($id)
  {
    $q = $this->Fasilitas_Model->get_fasilitas_single($id)->row();
    $data['data_fasilitas'] = $q;
    $data['title'] = 'Edit Data';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('layouts/header', $data);
    $this->load->view('dashboard/V_editdata', $data);
    $this->load->view('layouts/footer', $data);
  }

  public function update($id)
  {
    $nama_lokasi = $this->input->post('nama_lokasi');
    $fasilitas_lokasi = $this->input->post('fasilitas_lokasi');
    $alamat_lokasi = $this->input->post('alamat_lokasi');
    $foto_lokasi = $this->input->post('foto_lokasi');

    $config['upload_path'] = './foto_lokasi/';
    $config['allowed_types'] = 'jpeg|png|jpg';
    $config['max_size'] = '99999999999';
    $config['max_width'] = '99999999999';
    $config['max_height'] = '99999999999';

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('foto_lokasi')) {
      $error = array('error' => $this->upload->display_errors());
    } else {
      $foto = $this->upload->data();
      $foto_lokasi = '/warga_berseri/admin/foto_lokasi/' . $foto['file_name'];
      $data = array(
        'nama_lokasi' => $nama_lokasi,
        'fasilitas_lokasi' => $fasilitas_lokasi,
        'alamat_lokasi' => $alamat_lokasi,
        'foto_lokasi' => $foto_lokasi
      );
      $q = $this->Fasilitas_Model->update_fasilitas($id, $data);
      if ($q) {
        return redirect(base_url('Dashboard/get'));
      }
      echo "Gagal";
    }
  }

  public function detail($id)
  {
    $q = $this->Fasilitas_Model->get_fasilitas_single($id)->result();
    $data['data_fasilitas'] = $q;
    $data['title'] = 'Lihat Data';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->load->view('layouts/header', $data);
    $this->load->view('dashboard/V_detaildata', $data);
    $this->load->view('layouts/footer', $data);
  }


  public function riwayat_verifikasi()
  {
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['riwayat'] = $this->Penduduk_model->tampilRiwayatPendataan()->result();
    $data['title'] = 'Riwayat Verifikasi';
    $this->load->view('layouts/header', $data);
    $this->load->view('dashboard/riwayat_verifikasi', $data);
    $this->load->view('layouts/footer', $data);
  }

  public function data_kendaraan()
  {
    $id_warga = $this->session->id_warga;
    $query = $this->Kendaraan_model->get_call_nama($id_warga)->result();
    $data['pendataan_kendaraan'] = $query;
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['title'] = 'Data Kendaraan';
    $this->load->view('layouts/header', $data);
    $this->load->view('dashboard/data_kendaraan', $data);
    $this->load->view('layouts/footer', $data);
  }

  public function delete_template($id)
  {
    $query = $this->Template_model->delete_template($id);
    if ($query) {
      return redirect(base_url('Dashboard/template'));
    }
  }
}
