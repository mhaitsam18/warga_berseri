<?php 

	
	/**
	* 
	*/
	class PenggunaanIuranModel extends CI_Model
	{	
		public function tambahDataPenggunaan($data){
			$this->db->insert('data_penggunaan_iuran',$data);
		}

		public function tampilDataPenggunaan(){
			return $this->db->get('data_penggunaan_iuran');
		}

		public function editDataPenggunaan($data,$id){
			$this->db->like('id_penggunaan',$id);
			$this->db->update('data_penggunaan_iuran',$data);
		}

		public function hapusDataPenggunaan($id){
			$this->db->like('id_penggunaan',$id);
			$this->db->delete('data_penggunaan_iuran');
		}
		
		public function cari_id_penggunaan($data){
			$this->db->like('id_penggunaan',$data);
			return $this->db->get('data_penggunaan_iuran');
		}
	}
 ?>