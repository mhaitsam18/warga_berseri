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
           <h1 class="text-lg text-white mt-2">Pendataan Kendaraan</h1>
      </div>
    </div>
  </div>
</section>
</div>

<!-- UPDATE FOTO PROFILE -->
<!-- <?php if ($pendataan_warga->status == 'Terverifikasi'): ?>
  <div class="alert alert-success" role="alert">
    <center>Akun anda telah Terverifikasi</center>
  </div>
<?php else: ?>
  <div class="alert alert-warning" role="alert">
    <center>Akun anda belum Terverifikasi</center>
  </div>
<?php endif; ?> -->

    <section class="checkout-section spad">


    <!-- UPDATE PROFILE -->
    <section class="checkout-section spad">
      <div class="container checkout-form">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
              <h4>Data Kendaraan Anda</h4>
              <?= form_open('Kendaraan/proses_kendaraan',array('method' =>'POST')) ?>
              <div class="row">
                <div class="col-lg-7">
                  <label for="fir">No Rumah<span>*</span></label>
                  <input type="text" id="fir" value="<?php echo $this->session->no_rumah ?>" disabled>
                  <small class="form-text text-danger"><?= form_error('no_rumah'); ?></small>
                </div>
                <div class="col-lg-12">
                  <label for="cun">Nama Lengkap<span>*</span></label>
                  <input type="text" name="nama" id="cun" value="<?php echo $this->session->nama ?>" disabled>
                  <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                </div>
                <div class="col-lg-12">
                  <label for="cun">Kategori<span>*</span></label>
                  <input type="text" name="kategori" id="cun" placeholder="Motor/Mobil/Truk/dll">
                  <small class="form-text text-danger"><?= form_error('kategori'); ?></small>
                </div>
                <div class="col-lg-12">
                  <label for="street">Merk<span>*</span></label>
                  <input type="text" name="merk" id="street" class="street-first">
                  <small class="form-text text-danger"><?= form_error('kategori'); ?></small>
                </div>
                <div class="col-lg-6">
                  <label for="town">Nomor Polisi<span>*</span></label>
                  <input type="text" name="plat_no" id="town">
                  <small class="form-text text-danger"><?= form_error('plat_no'); ?></small>
                </div>
                <div class="col-lg-6">
                  <?php if ($this->session->kategori){ ?>
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
