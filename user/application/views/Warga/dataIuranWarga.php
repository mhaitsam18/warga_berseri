

        <!-- Begin Page Content -->
        <div class="container-fluid">
           

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Penggunaan Iuran</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No Tagihan</th>
                      <th>Nama</th>
                      <th>Status Iuran</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $no=1;
                  foreach ($iuran as $pengguna) { ?>
                    <tr>
                      <th><?php echo $no++; ?></th>
                      <th> <?php echo $pengguna->no_tagihan; ?></th>
                      <th> <?php echo $pengguna->nama; ?></th>
                      <th> <?php echo $pengguna->status_iuran; ?></th>
                      <th><?php if($pengguna->status_iuran != "Lunas" && $pengguna->status_iuran != "Belum Diverifikasi" ){ ?><a href="<?php echo base_url(); ?>WargaController/tambah_data_pembayaran/<?php echo $pengguna->no_tagihan; ?>"><button class="btn btn-primary">Bayar</button></a><?php } ?></th>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     