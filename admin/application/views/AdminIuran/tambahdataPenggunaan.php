<link href="<?php echo base_url(); ?>asset_iuran/css/tambahdataPenggunaan.css" rel="stylesheet">
<div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data Penggunaan Iuran</h6>
    </div>
     <div class="card-body">
<div class="container">
  <form action="<?php echo base_url();?>AdminIuranController/input_data_penggunaan" method="POST" enctype ="multipart/form-data">

    <label for="nama">Nama Kebutuhan</label>
    <input type="text" id="fname" name="nama_kebutuhan">

    <label for="jumlah">Jumlah Pengeluaran</label><br>
    <input type="number" id="jumlah" name="jumlah_pengeluaran" placeholder="Dalam rupiah">
    <br><br>
    <label for="penggunaan">Tanggal Penggunaan</label>
    <br>
    <input id="tanggal" type="date" name="tanggal_penggunaan">
    <br><br>
     <label for="penggunaan">Bukti Penggunaan</label>
    <br>
    <input id="tanggal" type="file" name="bukti_penggunaan">
    <br><br>
    <label for="keterangan">Keterangan</label>
    <textarea id="keterangan" name="keterangan" style="height:200px"></textarea>

    <input type="submit" value="Tambah Data">

  </form>
</div>
    </div>
</div>
</div>
