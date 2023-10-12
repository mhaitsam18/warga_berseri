

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
                      <th>Nama Kebutuhan</th>
                      <th>Jumlah Pengeluaran</th>
                      <th>Tanggal Pengeluaran</th>
                      <th>Keterangan</th> 
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $no=1;
                  foreach ($penggunaan as $pengguna) { ?>
                    <tr>
                      <th><?php echo $no++; ?></th>
                      <th> <?php echo $pengguna->nama_kebutuhan; ?></th>
                      <th> <?php echo $pengguna->jumlah_pengeluaran; ?></th>
                      <th> <?php echo $pengguna->tanggal_penggunaan; ?></th>
                      <th> <?php echo $pengguna->keterangan; ?></th>    
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

     