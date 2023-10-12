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
                                    <h4 class="page-title">Upload Templates</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <!-- Form row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Form row</h4>
                                        <p class="text-muted font-13">
                                            deskripsi
                                        </p>

                                        <?= form_open_multipart('Dashboard/tambah_template',array('method' =>'POST')) ?>
                                            <div class="form-group">
                                                <label for="inputAddress" class="col-form-label">Nama Template</label>
                                                <input type="text" name="nama_template" class="form-control" id="inputAddress" placeholder="Nama template">
                                            </div>
                                            <label for="inputAddress" class="col-form-label">Unggah File</label>
                                            <input type="file" name="file_template" class="dropify" data-height="250" />

                                            <button type="submit" class="btn btn-primary waves-effect waves-light btn-block mt-4">Upload</button>

                                        <?php echo form_close() ?>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

              
                								<div class="table-responsive">
                									<table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                										<thead>
                											<tr>
                                        <th>No.</th>
                												<th data-toggle="true">Nama Surat</th>
                												<th>Tanggal Buat</th>
                												<th>File</th>
                												<th>Aksi</th>
                											</tr>
                										</thead>
                										<tbody>
                                      <?php $no = 1; foreach ($template as $t): ?>
                                        <tr>
                                          <td><?php echo $no++ ?></td>
                  												<td><?php echo $t->nama_template ?></td>
                  												<td><?php echo $t->tgl_buat ?></td>
                  												<td><?php echo $t->file_template ?></td>
                                          <td>
                                                <a href="<?php echo base_url('Dashboard/delete_template/'.$t->id_template)?>" class="ladda-button btn btn-danger" data-style="slide-up">
                                                    <i class="mdi mdi-delete"></i> Hapus
                                                </a>
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
