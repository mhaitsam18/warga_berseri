

        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran Iuran</h6>
              <a href="<?php echo base_url();?>AdminIuranController/tambah_data_iuran" 
              class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="float: right; margin-top: -25px">Tambah Data Iuran +</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Tanggal Pembayaran</th>
                      <th>Bukti Pembayaran</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  foreach ($iuran as $iuran_warga) { ?>
                  <tr>
                    <th> <?php echo $iuran_warga->no_tagihan; ?></th>
                    <th> <?php echo $iuran_warga->nama; ?></th>
                    <th> <?php echo $iuran_warga->tanggal_pembayaran; ?></th>
                    <th><img src="<?php echo $iuran_warga->bukti_pembayaran;?>"></th>
                    <th><a href="<?php echo base_url(); ?>AdminIuranController/verifikasi_iuran/<?php echo $iuran_warga->no_tagihan; ?>"><button type="button">Verifikasi Iuran</button></a></th>
                  </tr>
                  <?php } ?>
                </form>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     