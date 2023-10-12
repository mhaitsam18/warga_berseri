<?php 

	
	/**
	* 
	*/
	class DataIuranModel extends CI_Model
	{
		 public function tambahDataIuran(){
            $this->db->insert('data_iuran_warga');
        }

		public function ambilDataIuran(){

			$query = "SELECT * FROM data_iuran_warga";
			$dataIuran = $this->db->query($query);
			return $dataIuran;
		}

		public function ambilDataIuran2(){

			return $this->db->get('data_iuran_warga');
		}

	}
 ?>