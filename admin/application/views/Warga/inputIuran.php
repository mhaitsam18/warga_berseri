<link href="<?php echo base_url(); ?>asset/css/tambahdataPenggunaan.css" rel="stylesheet">
<div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Form Pembayaran Iuran</h6>
    </div>
     <div class="card-body">
<div class="container">
  <form action="<?php echo base_url();?>WargaController/input_data_pembayaran" method="POST" enctype ="multipart/form-data">

    <label for="nama">Nama Penghuni</label>
    <input type="text" id="fname" name="nama">
    <br><br>
    <label for="pembayaran">Tanggal Pembayaran</label>
    <br>
    <input type="date" name="tanggal_pembayaran">
    <br><br>
    <label for="pembayaran">Pembayaran</label>
    <br>
    <input type="text" name="pembayaran" readonly value="Tunai">
    <br><br>
    <label for="bukti">Bukti Pembayaran</label>
    <br>
    <input id="bukti" type="file" name="bukti_pembayaran">
    <br><br>
    <input type="submit" value="Kirim">

  </form>
</div>
    </div>
</div>
</div>
