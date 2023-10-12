

        <!-- Begin Page Content -->
        <div class="container-fluid">
           

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Riwayat Pembayaran Iuran</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Id Warga</th>
                      <th>No Tagihan</th>
                      <th>Nama</th>
                      <th>Tanggal Pembayaran</th>
                      <th>Tanggal Terverifikasi</th>
                      <th>Status</th> 
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $no=1;
                  foreach ($iuran as $iuran_warga) { ?>
                    <tr>
                      <th><?php echo $no++; ?></th>
                      <th> <?php echo $iuran_warga->id_warga; ?></th>
                      <th> <?php echo $iuran_warga->no_tagihan; ?></th>
                      <th> <?php echo $iuran_warga->nama; ?></th>
                      <th> <?php echo $iuran_warga->tanggal_pembayaran; ?></th>
                      <th> <?php echo $iuran_warga->tanggal_diterima; ?></th>
                       <th> <?php echo $iuran_warga->status_iuran; ?></th>    
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

     