<div class="content-page">
  <div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
      <?php foreach ($data_penggunaan as $penggunaan) {?>
<form action="<?= base_url('IuranController/update_data_penggunaan/') ?><?php echo $penggunaan->id_penggunaan; ?>" enctype="multipart/form-data" method="post">
    <div class="container-fluid">
        <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h4 class="m-0 font-weight-bold text-primary">Form Tambah Data Penggunaan</h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <form>
                      <div class="form-group row">
                        <label style="text-align: left" class="col-sm-2 col-form-label">Nama Kebutuhan</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="nama_kebutuhan" required="" value="<?php echo $penggunaan->nama_kebutuhan; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label style="text-align: left" class="col-sm-2 col-form-label">Jumlah Pengeluaran</label>
                        <div class="col-sm-10">
                          <input type="number" name="jumlah_pengeluaran" class="form-control" required="" value="<?php echo $penggunaan->jumlah_pengeluaran; ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label style="text-align: left" class="col-sm-2 col-form-label">Tanggal Penggunaan</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" name="tanggal_penggunaan" required="" value="<?php echo $penggunaan->tanggal_penggunaan; ?>">
                        </div>
                      </div>
                       <div class="form-group row">
                        <label style="text-align: left" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" rows="10" name="keterangan" required=""><?php echo $penggunaan->keterangan; ?></textarea>
                        </div>
                      </div>
                        <div style="text-align: right" class="col-sm-12">
                        <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                  <?php } ?>
                  </div>
                </div>
              </div>
  </div>
  </form>
