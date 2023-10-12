<?php 

    
    /**
    * 
    */
    class IuranModel extends CI_Model
    {   
        //==============Warga==============//
        public function tambahDataPembayaran($data){
            $this->db->insert('data_iuran_warga',$data);
        }
        // 
        // public function riwayatPembayaran(){
        //     return $this->db->query("CALL priwayat_pembayaran_iuran");
        // }
        //==============Pengurus==============//
        public function tampilDataPembayaran(){
            return $this->db->get('data_iuran_warga');
        }
        public function tampilRiwayatPembayaran(){
            return $this->db->query('CALL priwayat_pembayaran_iuran_admin');
        }

        public function tambahDataIuran($data){
            $this->db->insert('data_iuran_warga',$data);
        }

        public function check_data_iuran($where){
            $this->db->like('no_tagihan', $where);
            return $this->db->get('data_iuran_warga');
            // $query = "SELECT * FROM `data_iuran_warga` WHERE no_tagihan LIKE ".$where."%";
            // return $query->row();
        }

        public function check_data_iuran_bulanan($where){
            $this->db->like('no_tagihan', $where);
            $this->db->like('status_iuran', 'Lunas');
            return $this->db->get('data_iuran_warga');
        }

        public function check_tagihan_perbulan($bulan,$tahun){
            $this->db->where('bulan', $bulan);
            $this->db->where('tahun', $tahun);
            return $this->db->get('data_keuangan_iuran');
        }
        public function getsaldo(){
            $this->db->select('SUM(saldo) as "total_saldo" ');
            $this->db->from('data_keuangan_iuran');
            return $this->db->get();
        }

        public function tambah_totalsaldo($data){
            $data_rekap = array('total_saldo' => $data );
            $this->db->insert('data_keuangan_iuran', $data_rekap);
        }


        public function check_totalsaldo(){
            $this->db->where('tahun', 0000);
           return $this->db->get('data_keuangan_iuran');
        }

         public function update_totalsaldo($data){
            $data_update = array('total_saldo' => $data);
            $this->db->where('tahun', 0000);
           $this->db->update('data_keuangan_iuran', $data_update);
        }

        public function rekap_iuran_bulanan($data){
            $this->db->insert('data_keuangan_iuran', $data);
        }

        public function update_rekap_iruan_bulanan($bulan,$tahun,$data){
            $this->db->where('bulan', $bulan);
            $this->db->where('tahun', $tahun);
            $this->db->update('data_keuangan_iuran', $data);
        }
        
        public function editDataPembayaran($data,$id){
            $this->db->like('no_tagihan',$id);
            $this->db->update('data_iuran_warga',$data);
        }

        public function hapusDataPembayaran($id){
            $this->db->like('no_tagihan',$id);
            $this->db->delete('data_iuran_warga');
        }
        
        public function cari_no_tagihan($data){
            $this->db->like('no_tagihan',$data);
            return $this->db->get('data_iuran_warga');
        }

        public function verifikasi_iuran($no_tagihan){
            $data_iuran = array('status_iuran' =>  "Lunas" );
            $this->db->where('no_tagihan',$no_tagihan);
            $this->db->update('data_iuran_warga',$data_iuran);

        }
    }
 ?>


