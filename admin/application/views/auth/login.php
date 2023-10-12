<div class="account-pages mt-5 mb-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 col-lg-6 col-xl-5">
				<div class="card bg-pattern">
					<div class="card-body p-4">
						<?php if($this->session->flashdata('error')) { ?>
							<div class="alert alert-danger col-12"><center><?=$this->session->flashdata('error');?></center></div>
						<?php } ?>

						<div class="text-center w-75 m-auto">
								<span><img src="<?php echo base_url() ?>assets/images/pbb-logo.png" alt="" height="40"></span>
							<p class="text-muted mb-4 mt-3">Enter your username and password to access admin panel.</p>
						</div>

						<?php echo form_open('Auth/', array('method' => 'POST')) ?>

							<div class="form-group mb-3">
								<label for="emailaddress">Email address</label>
								<input class="form-control" type="text" name="email" id="email" placeholder="Enter your email">
							</div>

							<div class="form-group mb-3">
								<label for="password">Password</label>
								<input class="form-control" type="password" name="password" id="password" placeholder="Enter your password">
							</div>

							<div class="form-group mb-0 text-center">
								<button class="btn btn-primary btn-block" type="submit"> Log In </button>
							</div>

						<?php echo form_close() ?>
						<hr>
						<div class="text-center">
							<a class="small" href="<?= base_url('auth/forgotPassword') ?>">Forgot Password?</a>
						</div>
						<!-- <div class="text-center">
							<a class="small" href="<?= base_url('Auth/registration') ?>">Create an Account!</a>
						</div> -->
					</div> <!-- end card-body -->
				</div>
				<!-- end card -->
				<!-- end row -->

			</div> <!-- end col -->
		</div>
		<!-- end row -->
	</div>
	<!-- end container -->
</div>
<!-- end page -->