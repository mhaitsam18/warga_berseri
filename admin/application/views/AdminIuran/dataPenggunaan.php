

        <!-- Begin Page Content -->
        <div class="container-fluid">
           

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Penggunaan Iuran</h6>
              <a href="<?php echo base_url();?>AdminIuranController/tambah_data_penggunaan" 
              class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="float: right; margin-top: -25px">Tambah Data +</a>
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
                      <th>Bukti Penggunaan</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
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
                      <th><img src="<?php echo $pengguna->bukti_pengeluaran; ?>"> </th> 
                      <th> <?php echo $pengguna->keterangan; ?></th>    
                      <th><a href="<?php echo base_url();?>AdminIuranController/edit_data_penggunaan/<?php echo $pengguna->id_penggunaan; ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style='font-size: 15px'>Edit <i class='far fa-edit'></i></a>
                      &nbsp;
                     <a href="<?php echo base_url();?>AdminIuranController/hapus_data_penggunaan/<?php echo $pengguna->id_penggunaan; ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style='font-size: 15px' >Hapus <i class='far fa-trash-alt'></i></button></th>         
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

     