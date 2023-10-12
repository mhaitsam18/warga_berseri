<div class="content-page">
  <div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

<form action="<?= base_url('IuranController/input_data_iuran') ?>" enctype="multipart/form-data" method="post">
    <div class="container-fluid">
        <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h4 class="m-0 font-weight-bold text-primary">Form Tambah Pembayaran Iuran</h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <form>
                      <div class="form-group row">
                        <label style="text-align: left" class="col-sm-2 col-form-label">No Tagihan</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="no_tagihan" value="<?php echo date('ymihs'); ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label style="text-align: left" class="col-sm-2 col-form-label">Nama Warga</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="warga" required="">
                            <option>-</option>
                            <?php foreach ($warga as $warga_pbb ) {?>         
                            <option value="<?php echo $warga_pbb->id_warga; ?>"><?php echo $warga_pbb->nama; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label style="text-align: left" class="col-sm-2 col-form-label">Tanggal Pembayaran</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" name="tanggal_pembayaran" required="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label style="text-align: left" class="col-sm-2 col-form-label">Pembayaran</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control-file" name="pembayaran" value="Tunai" readonly="" required="">
                        </div>
                      </div>
                        <div style="text-align: right" class="col-sm-12">
                        <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
  </div>
  </form>
