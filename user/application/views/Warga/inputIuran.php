<link href="<?php echo base_url(); ?>asset_iuran/css/tambahdataPenggunaan.css" rel="stylesheet">
<div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Form Pembayaran Iuran</h6>
    </div>
     <div class="card-body">
<div class="container">
  <form action="<?php echo base_url();?>WargaController/input_data_pembayaran" method="POST" enctype ="multipart/form-data">

    <?php $warga = $this->session->all_userdata(); ?>


     <label for="nama">No Tagihan</label>
    <input type="text" id="fname" name="no_tagihan" value="<?php echo date('ymis'); ?>" readonly>
    <label for="nama">Nama Penghuni</label>
    <input type="text" id="fname" name="nama" value="<?php echo $warga['nama']; ?>">
    <input type="hidden" name="id_warga" value="<?php echo $warga['id_warga']; ?>">
    <br><br>
    <label for="pembayaran">Tanggal Pembayaran</label>
    <br>
    <input type="date" name="tanggal_pembayaran">
    <br><br>
    <label for="pembayaran">Pembayaran</label>
    <br>
    <input type="text" name="pembayaran" readonly value="Transfer">
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
