<?php defined('BASEPATH') OR exit('No direct script access allowed');

class WargaModel extends CI_Model
{
    private $_table = "data_pembayaran";

    public $kode;
    public $nama;
    public $tanggal_pembayaran;
    public $bukti_pembayaran = "default.jpg";
    public $keterangan;

    public function rules()
    {
        return [
            ['field' => 'nama',
            'label' => 'nama',
            'rules' => 'required'],

            ['field' => 'tanggal_penggunaan',
            'label' => 'tanggal_penggunaan',
            'rules' => 'required'],
            
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->data_pembayaran)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->data_pembayaran, ["kode" => $id])->row();
    }
    public function save()
    {
        $post = $this->input->post();
        $this->kode = uniqid();
        $this->nama = $post["nama"];
        $this->tanggal_pembayaran= $post["tanggal_pembayaran"];
        return $this->db->insert($this->data_pembayaran, $post);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->kode = uniqid();
        $this->nama = $post["nama"];
        $this->tanggal_pembayaran= $post["tanggal_pembayaran"];
        return $this->db->update($this->_table, $this, array('kode' => $post['id']));
    }
    public function delete($id)
    {
        return $this->db->delete($this->_table, array("kode" => $id));
    }

    public function getwarga(){
        return $this->db->get('pendataan_warga')->result();
    }

    function getwarga_by_id($where){
        $this->db->where('id_warga', $where);
        return $this->db->get('pendataan_warga')->row();
    }


   
}
?>
