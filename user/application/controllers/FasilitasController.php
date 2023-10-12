<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FasilitasController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('FasilitasModel');
    }

    public function index()
    {

    }

    public function view_fasilitas()
    {
        $query = $this->FasilitasModel->get_fasilitas()->result();
   	    $data['data_fasilitas'] = $query;

        $this->load->view('layouts/header');
		$this->load->view('V_fasilitas', $data);
        $this->load->view('layouts/footer');
    }
    

}

/* End of file Controllername.php */



        