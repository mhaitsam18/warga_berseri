
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
										<li class="breadcrumb-item"><a href="javascript: void(0);">Data Warga</a></li>
									</ol>
								</div>
								<h4 class="page-title">Data Kendaraan</h4>
							</div>
						</div>
					</div>
					<!-- end page title -->

					<div class="row">
						<div class="col-12">
							<div class="card-box">


								<div class="mb-2">
									<div class="row">
										<div class="col-12 text-sm-center form-inline">
											<div class="form-group mr-2">
												<select id="demo-foo-filter-status" class="custom-select custom-select-sm">
													<option value="">Tampilkan Semua</option>
													<option value="Belum Terverifikasi">Belum Terverifikasi</option>
												</select>
											</div>
											<div class="form-group">
												<input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
											</div>
										</div>
									</div>
								</div>

								<div class="table-responsive">
									<table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
										<thead>
											<tr>
                        <th>No.</th>
                        <th>Id Warga</th>
												<th>Nama</th>
												<th>Kategori</th>
                        <th>Merk</th>
												<th>Nomor Polisi</th>
											</tr>
										</thead>
										<tbody>
                      <?php $no = 1; foreach ($pendataan_kendaraan as $kendaraan): ?>
                        <tr>
                          <td><?php echo $no++ ?></td>
                          <td><?php echo $kendaraan->id_warga ?></td>
													<td><?php echo $kendaraan->nama ?></td>
  												<td><?php echo $kendaraan->kategori ?></td>
  												<td><?php echo $kendaraan->merk ?></td>
  												<td><?php echo $kendaraan->plat_no ?></td>
                          </center></td>
  											</tr>
                      <?php endforeach; ?>
										</tbody>
										<tfoot>
											<tr class="active">
												<td colspan="6">
													<div class="text-right">
														<ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
													</div>
												</td>
											</tr>
										</tfoot>
									</table>
								</div> <!-- end .table-responsive-->
							</div> <!-- end card-box -->
						</div> <!-- end col -->
					</div>
					<!-- end row -->

				</div> <!-- container -->

			</div> <!-- content -->
