<section style="padding: 100px 0;">
	<div class="container">
		<div class="row">
			<div class="col-md-10 mx-auto">
				<div class="text-justify p-5 shadow" style="height: 1000px">
					<h2 class="mb-3"><?= $pengumuman['judul'] ?></span></h2>
					<small>Author: <?= $pengumuman['penulis'] ?></small>			
					<h6 class="mb-3">Terakhir diubah : <?= date('l, d F Y', strtotime($pengumuman['waktu_post'])) ?> <i class="fas fa-fw fa-edit"></i></h6>
					<p>
						<img src="<?= 'http://localhost/warga_berseri/admin/assets/img/pengumuman/'.$pengumuman['thumbnail'] ?>" class="img-thumbnail float-left mr-3" alt="<?= $pengumuman['thumbnail'] ?>" style="width: 300px;"><?= $pengumuman['isi'] ?>
					</p>
					<a href="<?= base_url('Home/informasi') ?>" class="">Kembali</a>
				</div>
			</div>
		</div>
	</div>
</section>