<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IuranController extends CI_Controller {



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
		$this->load->model('IuranModel');
		$this->load->model('PenggunaanIuranModel');
		$this->load->model('WargaModel');
		$this->load->helper('url');
		date_default_timezone_set('Asia/Jakarta');

	}
	
	public function index(){


		// $this->load->view('theme/header');
		// $this->load->view('AdminIuran/dashboard');
		// $this->load->view('theme/footer');		

		$this->generate_iuran();
		$this->generate_rekap_iuran();
		$this->generate_totalsaldo();
		redirect('dashboard/');
	}
	
//==================Penggunaan Iuran=====================//
	public function data_penggunaan(){
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['penggunaan']=$this->PenggunaanIuranModel->tampilDataPenggunaan()->result();
		$this->load->view('theme/header', $data);
		$this->load->view('AdminIuran/dataPenggunaan',$data);
		$this->load->view('theme/footer', $data);

	}

	public function data_penggunaan_iuran(){
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['penggunaan']=$this->PenggunaanIuranModel->tampilDataPenggunaan()->result();
		$this->load->view('layouts/header', $data);
   		$this->load->view('penggunaan/dataPenggunaan', $data);
   		$this->load->view('layouts/footer', $data);

	}
	
	public function tambah_data_penggunaan(){
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('theme/header', $data);
		$this->load->view('AdminIuran/tambahdataPenggunaan', $data);
		$this->load->view('theme/footer', $data);
	}

	public function tambah_penggunaan(){
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('layouts/header', $data);
   		$this->load->view('penggunaan/tambahPenggunaan', $data);
   		$this->load->view('layouts/footer', $data);
	}
	public function input_data_penggunaan(){
		$data_form = $this->input->post();

		$config['upload_path'] = './bukti_pengeluaran_penggunaan/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = '10000';
		$config['max_width'] = '10000';
		$config['max_height'] = '10000';

		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		if(! $this->upload->do_upload('bukti_penggunaan')){
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		}else{
			$data = array('upload_data'	=>	$this->upload->data());
			$admin = $this->session->all_userdata();

			$data=array('nama_kebutuhan' => $data_form['nama_kebutuhan'],
						'jumlah_pengeluaran' => $data_form['jumlah_pengeluaran'],
						'tanggal_penggunaan' => $data_form['tanggal_penggunaan'],
						'bukti_pengeluaran'	=> "/admin/bukti_pengeluaran_penggunaan/".$data['upload_data']['file_name'],
						'keterangan' => $data_form['keterangan'],
						'id_admin' => $admin['id_admin'] );
			
		$this->PenggunaanIuranModel->tambahdataPenggunaan($data);
		redirect('IuranController/data_penggunaan_iuran');
			
		}

		
	}
	public function edit_data_penggunaan($id){

		$data_penggunaan['data_penggunaan'] = $this->PenggunaanIuranModel->cari_id_penggunaan($id)->result();
		$this->load->view('layouts/header');
   		$this->load->view('penggunaan/editPenggunaan',$data_penggunaan);
   		$this->load->view('layouts/footer');

	}

	public function update_data_penggunaan($id){
		$data_edit = $this->input->post();

		$data=array(	'nama_kebutuhan' => $data_edit['nama_kebutuhan'],
						'jumlah_pengeluaran' => $data_edit['jumlah_pengeluaran'],
						'tanggal_penggunaan' => $data_edit['tanggal_penggunaan'],
						'keterangan' => $data_edit['keterangan']);
	
		$this->PenggunaanIuranModel->editdataPenggunaan($data,$id);
		redirect('IuranController/data_penggunaan_iuran');
	}
	public function hapus_data_penggunaan($id){


		$this->PenggunaanIuranModel->hapusdataPenggunaan($id);
		redirect('IuranController/data_penggunaan_iuran');
	}
//===============Data Iuran==================//
	public function data_iuran(){
		$dataIuran['iuran']=$this->IuranModel->tampilDataPembayaran()->result();
		$this->load->view('theme/header');
		$this->load->view('AdminIuran/dataIuran',$dataIuran);
		$this->load->view('theme/footer');
	}

	public function view_dataIuran(){
		$dataIuran['iuran']=$this->IuranModel->tampilDataPembayaran()->result();
		$this->load->view('layouts/header');
   		$this->load->view('iuran/dataIuran', $dataIuran);
   		$this->load->view('layouts/footer');
	}
	public function riwayat_iuran(){
		$dataRiwayat['riwayat']=$this->IuranModel->tampilRiwayatPembayaran()->result();
		$this->load->view('layouts/header');
   		$this->load->view('iuran/riwayatIuran', $dataRiwayat);
   		$this->load->view('layouts/footer');

	}

	public function tambah_data_iuran(){
		$data['warga'] = $this->WargaModel->getwarga();
		$this->load->view('theme/header');
		$this->load->view('AdminIuran/tambahdataIuran',$data);
		$this->load->view('theme/footer');
	}

	public function tambah_iuran(){
		$data['warga'] = $this->WargaModel->getwarga();
		$this->load->view('layouts/header');
   		$this->load->view('iuran/tambahIuran',$data);
   		$this->load->view('layouts/footer');
	}

	public function input_data_iuran(){
		$data_form = $this->input->post();
		$data_warga = $this->WargaModel->getwarga_by_id($data_form['warga']);

		$data_pembayaran=array(	'no_tagihan' 	=> $data_form['no_tagihan'],
								'nama' => $data_warga->nama,
								'tanggal_pembayaran' => $data_form['tanggal_pembayaran'],
								'id_warga' => $data_warga->id_warga);
		// echo "<pre>";
		// print_r ($data_pembayaran);
		// echo "</pre>";

		$this->IuranModel->tambahDataPembayaran($data_pembayaran);
		redirect('IuranController/view_dataIuran');
	
	}



	public function generate_iuran(){
		$tagihan_bulanan = date('ym');
		// echo $tagihan_bulanan."%";
		$check_tagihan_bulanan = $this->IuranModel->check_data_iuran($tagihan_bulanan)->result();
		// echo count($check_tagihan_bulanan);

		if(count($check_tagihan_bulanan) == 0 ){
			$notagihan = date('ymhis');
			$data_warga = $this->WargaModel->getwarga();
			
			// ini kalo pake tabel warga
			for ($i=0; $i < count($data_warga) ; $i++) { 

				$data_iuran = array('no_tagihan' 		=> $notagihan+$i ,
								'nama' 					=> $data_warga[$i]->nama,
								'id_warga'				=> $data_warga[$i]->id_warga
								);
				// echo "<pre>";
				// print_r ($data_iuran);
				// echo "</pre>";
				$this->IuranModel->tambahDataIuran($data_iuran);

			}

		}
		

	}

	public function generate_rekap_iuran(){
		$bulan = date('M');
		$tahun = date('Y');
		$tagihan_bulanan = date('ym');
		$check_tagihan = $this->IuranModel->check_data_iuran_bulanan($tagihan_bulanan)->result();
		$check_tagihan_bulanan = $this->IuranModel->check_data_iuran($tagihan_bulanan)->result();
		$check_tagihan_perbulan = $this->IuranModel->check_tagihan_perbulan($bulan,$tahun)->result();
		$jumlah_warga_iuran = count($check_tagihan_bulanan);
		$warga_sudah_bayar = count($check_tagihan);
		$warga_belum_bayar = $jumlah_warga_iuran - $warga_sudah_bayar;
		$uang_iuran = count($check_tagihan) * 100000;

		if(count($check_tagihan_perbulan) == 0 ){

			$data_keuangan = array(	'bulan' 				=> $bulan ,
								'tahun'					=> $tahun,
								'jumlah_warga' 			=> $jumlah_warga_iuran,
								'jumlah_sudah_bayar' 	=> $warga_sudah_bayar,
								'jumlah_belum_bayar'	=> $warga_belum_bayar ,
								'saldo'					=> $uang_iuran
							);

				// echo "<pre>";
				// print_r ($data_keuangan);
				// echo "</pre>";
					
					$this->IuranModel->rekap_iuran_bulanan($data_keuangan);

				

		}else{

			$data_keuangan = array(	'bulan' 				=> $bulan ,
								'tahun'					=> $tahun,
								'jumlah_warga' 			=> $jumlah_warga_iuran,
								'jumlah_sudah_bayar' 	=> $warga_sudah_bayar,
								'jumlah_belum_bayar'	=> $warga_belum_bayar ,
								'saldo'					=> $uang_iuran
							);

				$this->IuranModel->update_rekap_iruan_bulanan($bulan,$tahun,$data_keuangan);


		}
		
		
	}

	public function generate_totalsaldo(){

		$check_totalsaldo = $this->IuranModel->check_totalsaldo()->result();

					if(count($check_totalsaldo) == 0){
						$total_saldo_iuran = $this->IuranModel->getsaldo()->result();

						$this->IuranModel->tambah_totalsaldo($total_saldo_iuran[0]->total_saldo);
					}else{
						$total_saldo_iuran = $this->IuranModel->getsaldo()->result();

						$this->IuranModel->update_totalsaldo($total_saldo_iuran[0]->total_saldo);
					}	
	}



public function verifikasi_iuran($tagihan){
	$this->IuranModel->verifikasi_iuran($tagihan);
	redirect('IuranController/view_dataIuran');
}
//===============Upload==================//
	public function view_upload(){
		$this->load->view('upload');
	}

	public function upload_bukti_pengeluaran(){

		$config['upload_path'] = './bukti_pengeluaran_penggunaan/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = '10000';
		$config['max_width'] = '10000';
		$config['max_height'] = '10000';

		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		if(! $this->upload->do_upload('bukti_penggunaan')){
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		}else{
			$data = array('upload_data'	=>	$this->upload->data());
			echo $data['upload_data']['file_name'];
			
		}
	}


	

}
?>

