    <div class="content-page">
        <div class="content">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
                <?= $this->session->flashdata('message'); ?>
                <?= form_error('judul','<div class="alert alert-danger" role="alert">','</div>'); ?>
                <?= form_error('isi','<div class="alert alert-danger" role="alert">','</div>'); ?>
                <?= form_error('thumbnail','<div class="alert alert-danger" role="alert">','</div>'); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="" class="btn btn-primary mb-3 newNotulensiModalButton" data-toggle="modal" data-target="#newNotulensiModal">Tambah Notulensi Baru</a>
                        <table class="table table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Isi</th>
                                    <th scope="col">Penulis</th>
                                    <th scope="col">Waktu Post</th>
                                    <th scope="col">Terakhir diubah</th>
                                    <th scope="col">Thumbnail</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                <?php foreach ($notulensi as $key): ?>
                                    <tr>
                                        <th scope="row"><?= $no ?></th>
                                        <td><?= $key['judul'] ?></td>
                                        <td><?= $key['isi'] ?></td>
                                        <td><?= $key['penulis'] ?></td>
                                        <td><?= $key['waktu_post'] ?></td>
                                        <td><?= $key['terakhir_diubah'] ?></td>
                                        <td><img src="<?= base_url('assets/img/notulensi/').$key['thumbnail'] ?>" class="img-thumbnail" style="width: 300px;"></td>
                                        <td>
                                            <a href="<?= base_url("Admin/updateNotulensi/$key[id]"); ?>" class="badge badge-success updateNotulensiModalButton" data-toggle="modal" data-target="#newNotulensiModal" data-id="<?=$key['id']?>">Edit</a>
                                            <a href="<?= base_url("Admin/deleteNotulensi/$key[id]"); ?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">Delete</a>
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
<div class="modal fade" id="newNotulensiModal" tabindex="-1" aria-labelledby="newNotulensiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newNotulensiModalLabel">Tambah Notulensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Admin/notulensi') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul">
                        <?= form_error('judul','<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="penulis" name="penulis" value="<?= $user['name'] ?>"  readonly>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="isi" name="isi" placeholder="Isi"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Upload Thumbnail</label>
                        <input type="file" class="form-control" id="thumbnail" name="thumbnail">
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