<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model
{
    private $_table = "data_penggunaan";

    public $kode;
    public $nama_kebutuhan;
    public $jumlah_pengeluaran;
    public $tanggal_penggunaan;
    public $bukti_pengeluaran = "default.jpg";
    public $keterangan;

    public function rules()
    {
        return [
            ['field' => 'nama_kebutuhan',
            'label' => 'nama_kebutuhan',
            'rules' => 'required'],

            ['field' => 'jumlah_pengeluaran',
            'label' => 'jumlah_pengeluaran',
            'rules' => 'numeric'],

            ['field' => 'tanggal_penggunaan',
            'label' => 'tanggal_penggunaan',
            'rules' => 'required'],
            
            ['field' => 'keterangan',
            'label' => 'keterangan',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->data_penggunaan)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->data_penggunaan, ["kode" => $id])->row();
    }
    public function save()
    {
        $post = $this->input->post();
        $this->kode = uniqid();
        $this->nama_kebutuhan = $post["nama_kebutuhan"];
        $this->jumlah_pengeluaran = $post["jumlah_pengeluaran"];
        $this->tanggal_penggunaan = $post["tanggal_penggunaan"];
        $this->keterangan = $post["keterangan"];
        return $this->db->insert($this->data_penggunaan, $post);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->kode = $post["id"];
        $this->nama_kebutuhan = $post["nama_kebutuhan"];
        $this->jumlah_pengeluaran = $post["jumlah_pengeluaran"];
        $this->tanggal_penggunaan = $post["tanggal_penggunaan"];
        $this->keterangan = $post["keterangan"];
        return $this->db->update($this->_table, $this, array('kode' => $post['id']));
    }
    public function delete($id)
    {
        return $this->db->delete($this->_table, array("kode" => $id));
    }
}