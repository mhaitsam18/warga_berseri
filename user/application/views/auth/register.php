<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <?= form_open_multipart('Auth/proses_register',array('method' =>'POST')) ?>
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user">
                <div class="form-group row">

              </div>
              <div class="form-group">
                <input type="text" name="no_rumah" class="form-control form-control-user" id="exampleInputUsername" placeholder="No Rumah">
                <small class="form-text text-danger"><?= form_error('no_rumah'); ?></small>
              </div>
              <div class="form-group">
                <input type="text" name="nama" class="form-control form-control-user" id="exampleInputUsername" placeholder="Nama Lengkap">
                <small class="form-text text-danger"><?= form_error('nama'); ?></small>
              </div>
                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-user" id="exampleInputUsername" placeholder="Username">
                  <small class="form-text text-danger"><?= form_error('username'); ?></small>
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                  <small class="form-text text-danger"><?= form_error('password'); ?></small>
                </div>
                <div class="form-group">
                  Foto KTP
                  <input type="file" name="foto_ktp" class="form-control form-control-user" id="exampleInputUsername" placeholder="Foto Ktp">
                  <small class="form-text text-danger"><?= form_error('foto_ktp'); ?></small>
                </div>
                <div class="form-group">

                </div>
                  <button type="submit" name="kirim" class="btn btn-facebook btn-user btn-block">Daftar</button>

              <?php echo form_close() ?>

              </form>
              <div class="text-center">
                <a class="small" href="<?php echo base_url('Auth/') ?>">Sudah memiliki akun? Masuk!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
