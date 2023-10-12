<link href="<?php echo base_url(); ?>asset/css/tambahdataPenggunaan.css" rel="stylesheet">
<div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Form Edit Data Penggunaan Iuran</h6>
    </div>
     <div class="card-body">
<div class="container">

    <?php foreach ($data_penggunaan as $penggunaan){?>
  <form action="<?php echo base_url();?>AdminIuranController/update_data_penggunaan/<?php echo $penggunaan->id_penggunaan; ?>" method="POST">

    <label for="nama">Nama Kebutuhan</label>
    <input type="text" id="fname" name="nama_kebutuhan" value="<?php echo $penggunaan->nama_kebutuhan; ?>">

    <label for="jumlah">Jumlah Pengeluaran</label><br>
    <input type="number" id="jumlah" name="jumlah_pengeluaran" value="<?php echo $penggunaan->jumlah_pengeluaran; ?>">
    <br><br>
    <label for="penggunaan">Tanggal Penggunaan</label>
    <br>
    <input id="tanggal" type="date" name="tanggal_penggunaan" value="<?php echo $penggunaan->tanggal_penggunaan; ?>">
    <br><br>
    <label for="keterangan">Keterangan</label>
    <textarea id="keterangan" name="keterangan" style="height:200px"><?php echo $penggunaan->keterangan; ?>
    </textarea>

    <input type="submit" value="Edit Data">
    <?php } ?>

  </form>
</div>
    </div>
</div>
</div>
