<div class="content-page">
  <div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

<form action="<?= base_url('Dashboard/insert') ?>" enctype="multipart/form-data" method="post">
    <div class="container-fluid">
        <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">  Form Tambah Data </h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <form>
                      <div class="form-group row">
                        <label style="text-align: left" class="col-sm-2 col-form-label">Nama lokasi</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="nama_lokasi">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label style="text-align: left" class="col-sm-2 col-form-label">Fasilitas lokasi</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="fasilitas_lokasi">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label style="text-align: left" class="col-sm-2 col-form-label">Alamat lokasi</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="alamat_lokasi">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label style="text-align: left" class="col-sm-2 col-form-label">Foto lokasi</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control-file" name="foto_lokasi">
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
