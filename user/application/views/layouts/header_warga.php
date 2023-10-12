<!doctype html>
<html lang="en">
  <head>
  <!-- Required meta tags -->
  <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/pbb.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="GYm,fitness,business,company,agency,multipurpose,modern,bootstrap4">

  <meta name="author" content="Themefisher.com">

  <title>Warga Berseri</title>

  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/bootstrap/css/bootstrap.min.css">
  <!-- Icofont Css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/icofont/icofont.min.css">
  <!-- Themify Css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/themify/css/themify-icons.css">
  <!-- animate.css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/animate-css/animate.css">
  <!-- Magnify Popup -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/magnific-popup/dist/magnific-popup.css">
  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/slick-carousel/slick/slick-theme.css">
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>css/style.css">

</head>
<body>


<!-- Section Menu Start -->
<!-- Header Start -->
<nav class="navbar navbar-expand-lg navigation fixed-top" id="navbar">
	<div class="container-fluid">
		<a class="navbar-brand" href="index.html">
			<h2 class="text-white text-capitalize"></i>Warga<span class="text-color"> Berseri</span></h2>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsid"
			aria-controls="navbarsid" aria-expanded="false" aria-label="Toggle navigation">
			<span class="ti-view-list"></span>
		</button>
		<div class="collapse text-center navbar-collapse" id="navbarsid">
			<ul class="navbar-nav mx-auto">
				<li class="nav-item active">
					<a class="nav-link" href="<?php echo base_url('Home/') ?>">Beranda<span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false">Iuran</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>WargaController/tambah_data_pembayaran">Pembayaran</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>WargaController/riwayat_iuran">Riwayat Pembayaran Iuran</a></li>
						<li><a class="dropdown-item" href="<?php echo base_url(); ?>WargaController/data_penggunaan">Data Penggunaan</a></li>
					</ul>
				</li>
				<li class="nav-item"><a class="nav-link" href="<?php echo base_url('Home/template') ?>">Print Surat</a></li>
				<li class="nav-item"><a class="nav-link" href="pricing.html">Pengaduan</a></li>
				<!-- <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false">Kontak</a>
					<ul class="dropdown-menu">
						<li><a class="dropdown-item" href="blog.html">Ersa</a></li>
						<li><a class="dropdown-item" href="blog-sidebar.html">Januar</a></li>
						<li><a class="dropdown-item" href="blog-single.html">Naurah</a></li>
					</ul>
				</li> -->

        <?php if (! $this->session->username): ?>
          <li class="nav-item"><a class="nav-link" href="contact.html">Login</a></li>
        <?php endif; ?>
        <?php if ($this->session->username): ?>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('auth/logout') ?>">Logout</a></li>
        <?php endif; ?>
			</ul>
			<div class="my-md-0 ml-lg-4 mt-4 mt-lg-0 ml-auto text-lg-right mb-3 mb-lg-0">
				<!-- <a href="tel:+23-345-67890">
					<h3 class="text-color mb-0"><i class="ti-mobile mr-2"></i>+23-563-5688</h3>
				</a> -->
			</div>
		</div>
	</div>
</nav>


<!-- Header Close -->
