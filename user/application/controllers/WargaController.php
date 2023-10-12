<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WargaController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model('PenggunaanIuranModel');
		$this->load->model('IuranModel');
		$this->load->helper('url');
	}
	
	public function index(){
		$this->load->view('theme/atas');
		$this->load->view('Warga/awal');
		$this->load->view('theme/bawah');

	}
	
//==================Penggunaan Iuran=====================//
	public function data_penggunaan(){
		$dataPenggunaan['penggunaan']=$this->PenggunaanIuranModel->tampilDataPenggunaan()->result();
		$this->load->view('theme/atas');
		$this->load->view('Warga/dataPenggunaan',$dataPenggunaan);
		$this->load->view('theme/bawah');

	}

	public function dataIuran_warga(){
		$warga = $this->session->all_userdata();
		$data_iuran['iuran'] = $this->IuranModel->get_IuranWarga($warga['id_warga']);
		$this->load->view('theme/atas');
		$this->load->view('Warga/dataIuranWarga',$data_iuran);
		$this->load->view('theme/bawah');

	}
	
	public function riwayat_iuran(){
		$warga = $this->session->all_userdata();
		$riwayatIuran['iuran']=$this->IuranModel->tampilRiwayatPembayaran($warga['id_warga'])->result();
		$this->load->view('theme/atas');
		$this->load->view('Warga/riwayatIuran',$riwayatIuran);
		$this->load->view('theme/bawah');

	}
	public function tambah_data_pembayaran(){
		$this->load->view('theme/atas');
		$this->load->view('Warga/inputIuran');
		$this->load->view('theme/bawah');
	}
	public function input_data_pembayaran(){
		$nama = $this->input->post('nama');
		$tgl = $this->input->post('tanggal_pembayaran');
		$pem = $this->input->post('pembayaran');
		$id = $this->input->post('id_warga');
		$no_tagihan = $this->input->post('no_tagihan');

		$config['upload_path'] = './bukti_pembayaran_iuran/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = '10000';
		$config['max_width'] = '10000';
		$config['max_height'] = '10000';

		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		if(! $this->upload->do_upload('bukti_pembayaran')){
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		}else{
			$data = array('upload_data'	=>	$this->upload->data());
			// $warga = $this->session->all_userdata();
			$data=array('nama' => $nama,
				'tanggal_pembayaran' => $tgl,
				'bukti_pembayaran'	=> "/user/bukti_pembayaran_iuran/".$data['upload_data']['file_name'],
				'status_iuran'=> 'Belum Diverifikasi',
				'no_tagihan' => $no_tagihan,
				'id_warga'	=> $id);
		$this->IuranModel->tambahDataPembayaran($data);
		redirect('WargaController/');			
		}

		
	}
	public function edit_data_penggunaan($id){

		$data_penggunaan['data_penggunaan'] = $this->PenggunaanIuranModel->cari_id_penggunaan($id)->result();

		$this->load->view('theme/header');
		$this->load->view('AdminIuran/editdataPenggunaan',$data_penggunaan);
		$this->load->view('theme/footer');

	}

	public function update_data_penggunaan($id){
		$nama = $this->input->post('nama_kebutuhan');
		$jml = $this->input->post('jumlah_pengeluaran');
		$tgl = $this->input->post('tanggal_penggunaan');

		$ket = $this->input->post('keterangan');

		$data=array('nama_kebutuhan' => $nama,
						'jumlah_pengeluaran' => $jml,
						'tanggal_penggunaan' => $tgl,
						'keterangan' => $ket);
	
		$this->PenggunaanIuranModel->editdataPenggunaan($data,$id);
		redirect('AdminIuranController/data_penggunaan');
	}
	public function hapus_data_penggunaan($id){

		$this->PenggunaanIuranModel->hapusdataPenggunaan($id);
		redirect('AdminIuranController/data_penggunaan');
	}
//===============Data Iuran==================//
	public function data_iuran(){
		$this->load->view('theme/header');
		$dataIuran['iuran'] = $this->DataIuranModel->ambilDataIuran()->result();
		$this->load->view('AdminIuran/dataIuran',$dataIuran);
		$this->load->view('theme/footer');
	}

	public function view_upload(){
		$this->load->view('upload');
	}

	public function upload_bukti_pembayaran(){

		$config['upload_path'] = './bukti_pembayaran_iuran/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = '10000';
		$config['max_width'] = '10000';
		$config['max_height'] = '10000';

		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		if(! $this->upload->do_upload('bukti_pembayaran')){
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		}else{
			$data = array('upload_data'	=>	$this->upload->data());
			echo $data['upload_data']['file_name'];

			
		}
	}


	

}
