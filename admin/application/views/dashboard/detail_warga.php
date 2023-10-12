
		<!-- ============================================================== -->
		<!-- Start Page Content here -->
		<!-- ============================================================== -->

		<div class="content-page">
			<div class="content">

				<!-- Start Content-->
				<div class="container-fluid">

					<!-- start page title -->
					<div class="row">
						<div class="col-12">
							<div class="page-title-box">
								<div class="page-title-right">
									<ol class="breadcrumb m-0">
										<li class="breadcrumb-item"><a href="javascript: void(0);">Warga Berseri</a></li>
										<li class="breadcrumb-item"><a href="javascript: void(0);">Detail Warga</a></li>
									</ol>
								</div>
								<h4 class="page-title">Profile Warga</h4>
							</div>
						</div>
					</div>
					<!-- end page title -->

					<div class="row">
						<div class="col-lg-4 col-xl-4">
							<div class="card-box text-center">
								<img src="<?php echo base_url() ?>assets/images/users/user-1.jpg" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

								<h4 class="mb-0"><?php echo $id_warga->nama?></h4>
								<p class="text-muted"><?php echo $id_warga->username?></p>

								<button type="button" class="btn btn-success btn-xs waves-effect mb-2 waves-light">Verifikasi</button>
								<button type="button" class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Hapus</button>

								<div class="text-left mt-3">
									<p class="text-muted mb-2 font-14"><strong>Nama Lengkap :</strong> <span class="ml-2">
                    <?php echo $id_warga->nama?></span></p>

                  <p class="text-muted mb-2 font-14"><strong>Jenis Kelamin :</strong><span class="ml-2">
                    <?php echo $id_warga->jenis_kelamin?></span></p>

                  <p class="text-muted mb-2 font-14"><strong>Agama :</strong><span class="ml-2">
                    <?php echo $id_warga->agama?></span></p>

                  <p class="text-muted mb-2 font-14"><strong>Usia :</strong><span class="ml-2">
                  <?php echo $id_warga->umur?> Tahun</span></p>

									<p class="text-muted mb-2 font-14"><strong>No Telepon :</strong><span class="ml-2">(123)
											123 1234</span></p>

								</div>
                <?php if ($id_warga->status != "Terverifikasi"): ?>
                  <div class="alert alert-danger" role="alert">
                    <?php echo $id_warga->status ?>
                  </div>
                <?php else: ?>
                  <div class="alert alert-success" role="alert">
                    <?php echo $id_warga->status ?>
                  </div>
                <?php endif; ?>


							</div> <!-- end card-box -->


						</div> <!-- end col-->

						<div class="col-lg-8 col-xl-8">
							<div class="card-box">
								<div class="tab-content">

									<div >
											<h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Data personal</h5>
											<div class="row">
												<div class="col-md-8">
													<div class="form-group">
														<label for="firstname">Nama Lengkap</label>
														<input class="form-control" id="firstname" disabled value= "<?php echo $id_warga->nama?>">
													</div>
												</div>
											</div> <!-- end row -->

                      <div class="row">
												<div class="col-md-8">
													<div class="form-group">
														<label for="firstname">Nomor Induk Keluarga</label>
														<input class="form-control" id="firstname" disabled value= "<?php echo $id_warga->nik?>">
													</div>
												</div>
											</div> <!-- end row -->

                      <div class="row">
												<div class="col-md-8">
													<div class="form-group">
														<label for="firstname">Nomor Akta</label>
														<input class="form-control" id="firstname" disabled value= "<?php echo $id_warga->no_akta?>">
													</div>
												</div>
											</div> <!-- end row -->

                      <div class="row">
												<div class="col-md-8">
													<div class="form-group">
														<label for="firstname">Status Tinggal</label>
														<input class="form-control" id="firstname" disabled value= "<?php echo $id_warga->status_tinggal?>">
													</div>
												</div>
											</div> <!-- end row -->

                      <div class="row">
												<div class="col-md-5">
													<div class="form-group">
														<label for="firstname">Nomor Rumah</label>
														<input class="form-control" id="firstname" disabled value= "<?php echo $id_warga->no_rumah?>">
													</div>
												</div>
                        <div class="col-md-5">
													<div class="form-group">
														<label for="firstname">RT / RW</label>
														<input class="form-control" id="firstname" disabled value= "<?php echo $id_warga->rt?> / <?php echo $id_warga->rw?>">
													</div>
												</div>
											</div> <!-- end row -->

                      <div class="row">
												<div class="col-md-5">
													<div class="form-group">
														<label for="firstname">Tempat</label>
														<input class="form-control" id="firstname" disabled value= "<?php echo $id_warga->tempat_lahir?>">
													</div>
												</div>
                        <div class="col-md-5">
													<div class="form-group">
														<label for="firstname">Tanggal Lahir</label>
														<input class="form-control" id="firstname" disabled value= "<?php echo $id_warga->tanggal_lahir?>">
													</div>
												</div>
											</div> <!-- end row -->

											<div class="row">
												<div class="col-12">
													<div class="form-group">
														<label for="userbio">Alamat</label>
														<textarea disabled class="form-control" id="userbio" rows="4"><?php echo $id_warga->alamat?></textarea>
													</div>
												</div> <!-- end col -->
											</div> <!-- end row -->

											<h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building mr-1"></i> Info Pekerjaan</h5>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="companyname">Pendidikan</label>
														<input disabled class="form-control" id="companyname" value= "<?php echo $id_warga->pendidikan?>">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="cwebsite">Pekerjaan</label>
														<input disabled class="form-control" id="cwebsite" value= "<?php echo $id_warga->pekerjaan?>">
													</div>
												</div> <!-- end col -->
											</div> <!-- end row -->

										</form>
									</div>
									<!-- end settings content-->

								</div> <!-- end tab-content -->
							</div> <!-- end card-box-->

						</div> <!-- end col -->
					</div>
					<!-- end row-->

				</div> <!-- container -->

			</div> <!-- content -->
