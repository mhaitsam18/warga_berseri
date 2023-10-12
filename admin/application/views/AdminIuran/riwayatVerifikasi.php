

        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Riwayat Verifikasi</h6>
              <a href="<?php echo base_url();?>AdminIuranController/tambah_data_iuran" 
              class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="float: right; margin-top: -25px">Tambah Data +</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                  <tr>
                      <th>No Tagihan</th>
                      <th>Nama</th>
                      <th>Status Iuran</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  foreach ($riwayat as $history) { ?>
                  <tr>
                    <th> <?php echo $history->no_tagihan; ?></th>
                    <th> <?php echo $history->nama; ?></th>
                    <th> <?php echo $history->Status; ?></th>
                  </tr>
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

     