<link href="<?php echo base_url(); ?>asset_iuran/css/tambahdataPenggunaan.css" rel="stylesheet">
<div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Pembayaran Iuran</h6>
    </div>
     <div class="card-body">
<div class="container">
  <form action="<?php echo base_url();?>AdminIuranController/input_data_iuran" method="POST" enctype ="multipart/form-data">

    <label for="nama">No Tagihan</label>
    <input type="text" name="no_tagihan" value="<?php echo date('ymihs'); ?>" readonly>

    <label for="nama">Nama Warga</label>
    <select name="nama_warga" required="">
      <option>-</option>
      <?php foreach ($warga as $data_warga) {?>
        <option value="<?php echo $data_warga->id_warga; ?>"><?php echo $data_warga->nama; ?></option>
      <?php } ?>
    </select>

    <label for="jumlah">Tanggal Pembayaran</label><br>
    <input type="date"  name="tanggal_pembayaran" placeholder="Dalam rupiah">
    <br><br>
    <label for="pembayaran">Pembayaran</label>
    <br>
    <input type="text" name="pembayaran" readonly value="Transfer">
    <br><br>
    <input type="submit" value="Tambah Data">

  </form>
</div>
    </div>
</div>
</div>
