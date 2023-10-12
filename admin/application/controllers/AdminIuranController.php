<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminIuranController extends CI_Controller {



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
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('theme/header', $data);
		$this->load->view('AdminIuran/dashboard', $data);
		$this->load->view('theme/footer', $data);		

		$this->generate_iuran();
		$this->generate_rekap_iuran();
		$this->generate_totalsaldo();
	}
	
//==================Penggunaan Iuran=====================//
	public function data_penggunaan(){
		$data['penggunaan']=$this->PenggunaanIuranModel->tampilDataPenggunaan()->result();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('theme/header', $data);
		$this->load->view('AdminIuran/dataPenggunaan',$data);
		$this->load->view('theme/footer', $data);

	}
	
	public function tambah_data_penggunaan(){
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('theme/header', $data);
		$this->load->view('AdminIuran/tambahdataPenggunaan', $data);
		$this->load->view('theme/footer', $data);
	}
	public function input_data_penggunaan(){
		$nama = $this->input->post('nama_kebutuhan');
		$jml = $this->input->post('jumlah_pengeluaran');
		$tgl = $this->input->post('tanggal_penggunaan');

		$ket = $this->input->post('keterangan');

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

			$data=array('nama_kebutuhan' => $nama,
						'jumlah_pengeluaran' => $jml,
						'tanggal_penggunaan' => $tgl,
						'bukti_pengeluaran'	=> "/ProjectUla/bukti_pengeluaran_penggunaan/".$data['upload_data']['file_name'],
						'keterangan' => $ket);
		$this->PenggunaanIuranModel->tambahdataPenggunaan($data);
		redirect('AdminIuranController/data_penggunaan');
			
		}

		
	}
	public function edit_data_penggunaan($id){

		$data['data'] = $this->PenggunaanIuranModel->cari_id_penggunaan($id)->result();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('theme/header', $data);
		$this->load->view('AdminIuran/editdataPenggunaan',$data);
		$this->load->view('theme/footer', $data);

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
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['iuran']=$this->IuranModel->tampilDataPembayaran()->result();
		$this->load->view('theme/header', $data);
		$this->load->view('AdminIuran/dataIuran',$data);
		$this->load->view('theme/footer', $data);
	}
	public function riwayat_iuran(){
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['riwayat']=$this->IuranModel->tampilRiwayatPembayaran()->result();
		$this->load->view('theme/header', $data);
		$this->load->view('AdminIuran/riwayatVerifikasi',$data);
		$this->load->view('theme/footer', $data);

	}

	public function tambah_data_iuran(){
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['warga'] = $this->WargaModel->getwarga();
		$this->load->view('theme/header', $data);
		$this->load->view('AdminIuran/tambahdataIuran',$data);
		$this->load->view('theme/footer', $data);
	}
	public function input_data_iuran(){
		$nama = $this->input->post('nama');
		$tgl = $this->input->post('tanggal_pembayaran');
		$pem = $this->input->post('pembayaran');
		$kode = $this->input->post('id_warga');


		$data=array('nama' => $nama,
						'tanggal_pembayaran' => $tgl,
						'pembayaran' => $pem,
						'id_warga' => $kode);

		$this->IuranModel->tambahDataPembayaran($data);
		redirect('AdminIuranController/data_iuran');
	
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
	redirect('AdminIuranController/data_iuran');
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

