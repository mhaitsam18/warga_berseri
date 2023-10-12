    <div class="content-page">
        <div class="content">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
                <?= $this->session->flashdata('message'); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="" class="btn btn-primary mb-3 newMusrembangModalButton" data-toggle="modal" data-target="#newMusrembangModal">Tambah Musrembang Baru</a>
                        <table class="table table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Program</th>
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Sasaran</th>
                                    <th scope="col">Volume / Lokasi</th>
                                    <th scope="col">Diusulkan oleh</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                <?php foreach ($musrembang as $key): ?>
                                    <tr>
                                        <th scope="row"><?= $no ?></th>
                                        <td><?= $key['program'] ?></td>
                                        <td><?= $key['kegiatan'] ?></td>
                                        <td><?= $key['sasaran'] ?></td>
                                        <td><?= $key['volume_lokasi'] ?></td>
                                        <td><?= $key['pengusul'] ?></td>
                                        <td><?= $key['keterangan'] ?></td>
                                        <td><?= $key['status'] ?></td>
                                        <td>
                                            <a href="<?= base_url("Admin/updateMusrembang/$key[id]"); ?>" class="badge badge-success updateMusrembangModalButton" data-toggle="modal" data-target="#newMusrembangModal" data-id="<?=$key['id']?>">Edit</a>
                                            <a href="<?= base_url("Admin/deleteMusrembang/$key[id]"); ?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php $no++; ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
    </div>
</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newMusrembangModal" tabindex="-1" aria-labelledby="newMusrembangModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMusrembangModalLabel">Tambah Musrembang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Admin/musrembang') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="program" name="program" placeholder="Program">
                        <?= form_error('program','<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="kegiatan" name="kegiatan" placeholder="Kegiatan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="sasaran" name="sasaran" placeholder="Sasaran">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="volume_lokasi" name="volume_lokasi" placeholder="Volume Lokasi"></textarea>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="pengusul" name="pengusul" placeholder="diusulkan oleh"></textarea>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="status_musrembang" name="status" placeholder="Status">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>