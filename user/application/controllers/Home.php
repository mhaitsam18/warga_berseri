<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Template_model');
    $this->load->model('KeluhanAspirasi_Model');
    $this->load->model('BeritaPengumuman_Model');
    $this->load->library('form_validation');
    $this->load->library('pagination');
  }

  public function index()
  {
    $this->db->order_by('id', 'DESC');
    $this->db->limit(1);
    $data['pengumuman_terkini'] = $this->db->get('pengumuman')->row_array();
    $this->db->order_by('id', 'DESC');
    $this->db->limit(1);
    $data['berita_terkini'] = $this->db->get('berita')->row_array();
    $this->db->order_by('id', 'DESC');
    $this->db->limit(1);
    $data['notulensi_terkini'] = $this->db->get('notulensi')->row_array();
    $this->db->order_by('id', 'DESC');
    $this->db->limit(1);
    $data['peraturan_terkini'] = $this->db->get('peraturan')->row_array();
    $data['musrembang'] = $this->db->get('musrembang')->result_array();
    $data['fasilitas'] = $this->db->get('data_fasilitas')->result_array();
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
    $this->load->view('layouts/header');
    $this->load->view('home/index', $data);
    $this->load->view('layouts/footer');
  }

  public function template()
  {
    $data['template'] = $this->Template_model->getTemplate()->result();
    $this->load->view('layouts/header');
    $this->load->view('home/template', $data);
    $this->load->view('layouts/footer');
  }

  public function keluhanAspirasi()
  {
    if ($this->session->username) {
      $this->load->view('layouts/header');
      $this->load->view('home/keluhan-aspirasi');
      $this->load->view('layouts/footer');
    } else {
      redirect('Auth');
    }

    
  }

  public function strukturOrganisasi()
  {
    $data['struktur'] = $this->db->get('struktur')->result_array();
    $this->load->view('layouts/header');
    $this->load->view('home/struktur-organisasi', $data);
    $this->load->view('layouts/footer');
  }

  public function download_template($id)
  {
    $this->load->helper('download');
    $fileinfo = $this->Template_model->downloadTemplate($id);
    $file = '../admin/uploads/'.$fileinfo['file_template'];
    force_download($file, NULL);
  }

  public function berita()
  {
    $data['all_berita'] = $this->db->get('berita')->result_array();
    $config['base_url'] = 'http://localhost/warga_berseri/user/home/berita';
    $config['total_rows'] = $this->BeritaPengumuman_Model->countAllBerita();
    $config['per_page'] = 3;
    $config['num_links'] = 2;
    
    //styling
    $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
    $config['full_tag_close'] = '</nav></ul>';

    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';

    if ($config['total_rows']>18) {
      $config['next_link'] = '&raquo';
    } else{
      $config['next_link'] = 'Next';
    }
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';

    if ($config['total_rows']>18) {
      $config['prev_link'] = '&laquo';
    } else{
      $config['prev_link'] = 'Next';
    }
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><a class="page-link" href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';

    $config['attributes'] = array('class' => 'page-link');

    // $config['display_pages'] = TRUE;
    // $config['attributes']['rel'] = FALSE;
    $this->pagination->initialize($config);


    $data['start'] = $this->uri->segment(3);
    $data['berita'] = $this->BeritaPengumuman_Model->getBerita($config['per_page'],$data['start']);
    $this->load->view('layouts/header');
    $this->load->view('home/berita', $data);
    $this->load->view('layouts/footer');
  }

  public function notulensi()
  {
    if (!$this->session->userdata('username')) {
      redirect('Auth/');
    }
    $data['all_notulensi'] = $this->db->get('notulensi')->result_array();
    $config['base_url'] = 'http://localhost/warga_berseri/user/home/notulensi';
    $config['total_rows'] = $this->BeritaPengumuman_Model->countAllNotulensi();
    $config['per_page'] = 3;
    $config['num_links'] = 2;
    
    //styling
    $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
    $config['full_tag_close'] = '</nav></ul>';

    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';

    if ($config['total_rows']>18) {
      $config['next_link'] = '&raquo';
    } else{
      $config['next_link'] = 'Next';
    }
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';

    if ($config['total_rows']>18) {
      $config['prev_link'] = '&laquo';
    } else{
      $config['prev_link'] = 'Next';
    }
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><a class="page-link" href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';

    $config['attributes'] = array('class' => 'page-link');

    // $config['display_pages'] = TRUE;
    // $config['attributes']['rel'] = FALSE;
    $this->pagination->initialize($config);


    $data['start'] = $this->uri->segment(3);
    $data['notulensi'] = $this->BeritaPengumuman_Model->getNotulensi($config['per_page'],$data['start']);
    $this->load->view('layouts/header');
    $this->load->view('home/notulensi', $data);
    $this->load->view('layouts/footer');
  }

  public function peraturan()
  {
    // if (!$this->session->userdata('username')) {
    //   redirect('Auth/');
    // }
    $data['all_peraturan'] = $this->db->get('peraturan')->result_array();
    $config['base_url'] = 'http://localhost/warga_berseri/user/home/peraturan';
    $config['total_rows'] = $this->BeritaPengumuman_Model->countAllPeraturan();
    $config['per_page'] = 3;
    $config['num_links'] = 2;
    
    //styling
    $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
    $config['full_tag_close'] = '</nav></ul>';

    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';

    if ($config['total_rows']>18) {
      $config['next_link'] = '&raquo';
    } else{
      $config['next_link'] = 'Next';
    }
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';

    if ($config['total_rows']>18) {
      $config['prev_link'] = '&laquo';
    } else{
      $config['prev_link'] = 'Next';
    }
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><a class="page-link" href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';

    $config['attributes'] = array('class' => 'page-link');

    // $config['display_pages'] = TRUE;
    // $config['attributes']['rel'] = FALSE;
    $this->pagination->initialize($config);


    $data['start'] = $this->uri->segment(3);
    $data['peraturan'] = $this->BeritaPengumuman_Model->getPeraturan($config['per_page'],$data['start']);
    $this->load->view('layouts/header');
    $this->load->view('home/peraturan', $data);
    $this->load->view('layouts/footer');
  }

  public function informasi()
  {
    $data['all_pengumuman'] = $this->db->get('pengumuman')->result_array();
    $config['base_url'] = 'http://localhost/warga_berseri/user/home/informasi';
    $config['total_rows'] = $this->BeritaPengumuman_Model->countAllPengumuman();
    $config['per_page'] = 3;
    $config['num_links'] = 2;
    
    //styling
    $config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
    $config['full_tag_close'] = '</nav></ul>';

    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';

    if ($config['total_rows']>18) {
      $config['next_link'] = '&raquo';
    } else{
      $config['next_link'] = 'Next';
    }
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';

    if ($config['total_rows']>18) {
      $config['prev_link'] = '&laquo';
    } else{
      $config['prev_link'] = 'Next';
    }
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><a class="page-link" href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';

    $config['attributes'] = array('class' => 'page-link');

    // $config['display_pages'] = TRUE;
    // $config['attributes']['rel'] = FALSE;
    $this->pagination->initialize($config);


    $data['start'] = $this->uri->segment(3);
    $data['pengumuman'] = $this->BeritaPengumuman_Model->getPengumuman($config['per_page'],$data['start']);
    $this->load->view('layouts/header');
    $this->load->view('home/informasi', $data);
    $this->load->view('layouts/footer');
  }

  public function insertKeluhanAspirasi()
  {
    $this->form_validation->set_rules('nama', 'Full Name', 'trim|required');
    // $this->form_validation->set_rules('email', 'Email', 'trim|required');
    $this->form_validation->set_rules('no_wa', 'WhatsApp Number', 'trim|required');
    $this->form_validation->set_rules('jenis', 'Type', 'trim|required');
    $this->form_validation->set_rules('jenis_pesan', 'Message Type', 'trim|required');
    $this->form_validation->set_rules('isi', 'Content', 'trim|required');
    // $this->form_validation->set_rules('bukti', 'Evidence', 'trim|required');
    $this->db->order_by('id', 'DESC');
    $this->db->limit(1);
    $data['pengumuman_terkini'] = $this->db->get('pengumuman')->row_array();
    $this->db->order_by('id', 'DESC');
    $this->db->limit(1);
    $data['berita_terkini'] = $this->db->get('berita')->row_array();
    if ($this->form_validation->run() == false) {
      $this->load->view('layouts/header');
      if ($this->input->post('site') == 'home') {
        $this->load->view('home/index', $data);
      } else{
        $this->load->view('home/keluhan-aspirasi');
      }
      $this->load->view('layouts/footer');
    } else{
      $upload_image = $_FILES['bukti']['name'];
      if ($upload_image) {
        $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
        $config['upload_path'] = './assets/img/keluhan-aspirasi';
        $config['max_size']     = '2048';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('bukti')) {
          $new_image = $this->upload->data('file_name');
          if ($this->input->post('jenis') == 'Aspirasi') {
            $data = [
              'nama' => $this->input->post('nama'),
              // 'email' => $this->input->post('email'),
              'no_wa' => $this->input->post('no_wa'),
              'jenis_aspirasi' => $this->input->post('jenis_pesan'),
              'aspirasi' => $this->input->post('isi'),
              'status' => 'Belum diproses',
              'waktu_kirim' => date("Y-m-d H:i:s"),
              'bukti' => $new_image
            ];
            $this->KeluhanAspirasi_Model->insertAspirasi($data);
          } elseif ($this->input->post('jenis') == 'Keluhan') {
            $data = [
              'nama' => $this->input->post('nama'),
              // 'email' => $this->input->post('email'),
              'no_wa' => $this->input->post('no_wa'),
              'jenis_keluhan' => $this->input->post('jenis_pesan'),
              'keluhan' => $this->input->post('isi'),
              'status' => 'Belum diproses',
              'waktu_kirim' => date("Y-m-d H:i:s"),
              'bukti' => $new_image
            ];
            $this->KeluhanAspirasi_Model->insertKeluhan($data);
          }
          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Your Message has been sent! </div>');
          if ($this->input->post('site') == 'home') {
            redirect('Home/');
          } else{
            redirect('Home/keluhanAspirasi');
          }
        } else{
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">'.$this->upload->display_errors().'</div>');
        }
        redirect('Home/keluhanAspirasi');
      }
    }
  }

  public function detailInformasi($id=1)
  {
    $data['pengumuman'] = $this->db->get_where('pengumuman',['id' => $id])->row_array();
    $this->load->view('layouts/header');
    $this->load->view('home/detail-informasi', $data);
    $this->load->view('layouts/footer');
  }
  public function detailBerita($id=1)
  {
    $data['berita'] = $this->db->get_where('berita',['id' => $id])->row_array();
    $this->load->view('layouts/header');
    $this->load->view('home/detail-berita', $data);
    $this->load->view('layouts/footer');
  }
  public function detailNotulensi($id=1)
  {
    if (!$this->session->userdata('username')) {
      redirect('Auth/');
    }
    $data['notulensi'] = $this->db->get_where('notulensi',['id' => $id])->row_array();
    $this->load->view('layouts/header');
    $this->load->view('home/detail-notulensi', $data);
    $this->load->view('layouts/footer');
  }
  public function detailPeraturan($id=1)
  {
    // if (!$this->session->userdata('username')) {
    //   redirect('Auth/');
    // }
    $data['peraturan'] = $this->db->get_where('peraturan',['id' => $id])->row_array();
    $this->load->view('layouts/header');
    $this->load->view('home/detail-peraturan', $data);
    $this->load->view('layouts/footer');
  }
  
}
