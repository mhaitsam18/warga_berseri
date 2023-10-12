<!-- Css Styles -->

  <link rel="stylesheet" href="<?php echo base_url('assets2/') ?>css/style.css" type="text/css">



<div class="main-wrapper ">
<section class="page-title bg-3">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
          <ul class="list-inline mb-0">
            <li class="list-inline-item"><a href="index.html" class="text-sm letter-spacing text-white text-uppercase font-weight-bold">Home</a></li>
            <li class="list-inline-item"><span class="text-white">|</span></li>
            <li class="list-inline-item"><a href="#" class="text-color text-uppercase text-sm letter-spacing">About us</a></li>
          </ul>
           <h1 class="text-lg text-white mt-2">Pendataan Warga</h1>
      </div>
    </div>
  </div>
</section>
</div>

<!-- UPDATE FOTO PROFILE -->
<?php if ($pendataan_warga->status == 'Terverifikasi'): ?>
  <div class="alert alert-success" role="alert">
    <center>Akun anda telah Terverifikasi</center>
  </div>
<?php else: ?>
  <div class="alert alert-warning" role="alert">
    <center>Akun anda belum Terverifikasi</center>
  </div>
<?php endif; ?>

    <section class="checkout-section spad">
      <div class="container checkout-form">
          <div class="row">
            <?= form_open_multipart('Profile/upload_foto',array('method' =>'POST')) ?>
            <div class="container.fluid col-xl-3 col-lg-4 container checkout-form">
                <div class="col-lg-6 mb-5">
                  <?php if ($pendataan_warga->foto_user == NULL): ?>
                    <img class="offset-lg-6" width="220px" height="140px" style="border-radius:1000%;"
                      src="<?php echo base_url('assets/images/user.png')?>">
                   <?php endif; ?>
                   <?php if ($pendataan_warga->foto_user): ?>
                    <img class="offset-lg-6" width="370px" height="170px" style="border-radius:1000%;"
                      src="<?php echo base_url('uploads/'.$pendataan_warga->foto_user)?>">
                  <?php endif; ?>
                </div>
                  <div class="form-group">
                    <div class="custom-file">
                      <input type="file" name="foto_user" class="custom-file-input">
                      <label class="custom-file-label" for="file-input">Pilih Foto...</label>
                    </div>
                  </div>
                  <div class="pt-2">
                    <button class="btn btn-success btn-sm btn-block"> Ubah Foto Profile</button>
                  </div>

                <div class="pt-2">
                  <a class="btn btn-danger btn-sm btn-block tombol-hapus-foto"
                  href="<?php echo base_url('Profile/hapus_foto') ?>">Hapus Foto Profile</a>
                </div>


                  <small class="form-text text-danger"><?= form_error('foto_user'); ?></small>
            </div>
          <?php echo form_close() ?>


    <!-- UPDATE PROFILE -->
            <div class="col-lg-6 offset-lg-1">
              <h4>Profile Anda</h4>
              <?= form_open('profile/proses_profile',array('method' =>'POST')) ?>
              <div class="row">
                <div class="col-lg-7">
                  <label for="fir">No Rumah<span>*</span></label>
                  <input type="text" name="no_rumah" id="fir" value="<?php echo $this->session->no_rumah ?>">
                  <small class="form-text text-danger"><?= form_error('no_rumah'); ?></small>
                </div>
                <div class="col-lg-6">
                  <label for="last">RT<span>*</span></label>
                  <input type="text" name="rt" id="last" value="<?php echo $this->session->rt ?>">
                  <small class="form-text text-danger"><?= form_error('rt'); ?></small>
                </div>
                <div class="col-lg-6">
                  <label for="last">RW<span>*</span></label>
                  <input type="text" name="rw" id="last" value="<?php echo $this->session->rw ?>">
                  <small class="form-text text-danger"><?= form_error('rw'); ?></small>
                </div>
                <div class="col-lg-12">
                  <label for="cun">Alamat<span>*</span></label>
                  <input type="text" name="alamat" id="cun" value="<?php echo $this->session->alamat ?>">
                  <small class="form-text text-danger"><?= form_error('alamat'); ?></small>
                </div>
                <div class="col-lg-12">
                  <label for="cun">Nama Lengkap<span>*</span></label>
                  <input type="text" name="nama" id="cun" value="<?php echo $this->session->nama ?>">
                  <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                </div>
                <div class="col-lg-12">
                  <label for="cun">NIK<span>*</span></label>
                  <input type="text" name="nik" id="cun" value="<?php echo $this->session->nik ?>">
                  <small class="form-text text-danger"><?= form_error('nik'); ?></small>
                </div>
                <div class="col-lg-12">
                  <label for="street">Nomer Akta Kelahiran<span>*</span></label>
                  <input type="text" name="no_akta" id="street" class="street-first" value="<?php echo $this->session->no_akta ?>">
                  <small class="form-text text-danger"><?= form_error('no_akta'); ?></small>
                </div>
                <div class="col-lg-6">
                  <label for="town">Tempat Lahir<span>*</span></label>
                  <input type="text" name="tempat_lahir" id="town" value="<?php echo $this->session->tempat_lahir ?>">
                  <small class="form-text text-danger"><?= form_error('tempat_lahir'); ?></small>
                </div>
                <div class="col-lg-6">
                  <label for="zip">Tanggal Lahir<span>*</span></label>
                  <input type="date" name="tanggal_lahir" id="zip" value="<?php echo $this->session->tanggal_lahir ?>">
                  <small class="form-text text-danger"><?= form_error('tanggal_lahir'); ?></small>
                </div>
                <?php if ($this->session->jenis_kelamin === 'Perempuan'){ ?>
										<div class="col-lg-7">
	                  <label for="email">Jenis Kelamin<span>*</span></label>
	                  <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
	                          <option selected value="Perempuan">Perempuan</option>
	                          <option  value="Laki-laki">Laki-laki</option>
	                        </select>
	                  <small class="form-text text-danger"><?= form_error('jenis_kelamin'); ?></small>
	                </div>
									<?php }else {?>
										<div class="col-lg-7">
	                  <label for="email">Jenis Kelamin<span>*</span></label>
	                  <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
	                          <option  value="Perempuan">Perempuan</option>
	                          <option selected value="Laki-laki">Laki-laki</option>
	                        </select>
	                  <small class="form-text text-danger"><?= form_error('jenis_kelamin'); ?></small>
	                </div>
								 <?php 	} ?>
                <div class="col-lg-7">
                  <label for="phone">Agama<span>*</span></label>
                  <input type="text" name="agama" id="phone" value="<?php echo $this->session->agama ?>">
                  <small class="form-text text-danger"><?= form_error('agama'); ?></small>
                </div>
                <div class="col-lg-12">
                  <label for="phone">Pendidikan<span>*</span></label>
                  <input type="text" name="pendidikan" id="phone" value="<?php echo $this->session->pendidikan ?>">
                  <small class="form-text text-danger"><?= form_error('pendidikan'); ?></small>
                </div>
                <div class="col-lg-6">
                  <label for="phone">Umur<span>*</span></label>
                  <input type="text" name="umur" id="phone" value="<?php echo $this->session->umur ?>">
                  <small class="form-text text-danger"><?= form_error('umur'); ?></small>
                </div>
                <div class="col-lg-12">
                  <label for="phone">Pekerjaan<span>*</span></label>
                  <input type="text" name="pekerjaan" id="phone" value="<?php echo $this->session->pekerjaan ?>">
                  <small class="form-text text-danger"><?= form_error('pekerjaan'); ?></small>
                </div>
                  <?php if ($this->session->nik){ ?>
                    <button type="submit" name="kirim" class="site-btn register-btn offset-lg-4">Perbaharui Data</button>
                  <?php }
                  else { ?>
                    <button type="submit" name="kirim" class="site-btn register-btn offset-lg-4">Kirim Data</button>
                  <?php } ?>


              </div>
            </div>
          </div>
        <?php echo form_close() ?>
      </div>
    </section>
