<div class="main-wrapper ">
<section class="page-title bg-2">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
          <ul class="list-inline mb-0">
            <li class="list-inline-item"><a href="index.html" class="text-sm letter-spacing text-white text-uppercase font-weight-bold">Home</a></li>
            <li class="list-inline-item"><span class="text-white">|</span></li>
            <li class="list-inline-item"><a href="#" class="text-color text-uppercase text-sm letter-spacing">About us</a></li>
          </ul>
           <h1 class="text-lg text-white mt-2">Struktur Organisasi</h1>
      </div>
    </div>
  </div>
</section>
</div>

<!-- <div class=container>
  <div class="card mt-4">
    <div class="card-header">
      Struktur Organisasi
    </div>
    <div class="card-body">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Foto</th>
            <th scope="col">Nama</th>
            <th scope="col">Jabatan</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1 ?>
          <?php foreach ($struktur as $row): ?>
            <tr>
              <th scope="row"><?= $no ?></th>
              <td><img src="<?= base_url('assets/img/struktur-organisasi/').$row['foto'] ?>" class:"img-thumbnail" style="width: 300px;"></td>
              <td><?= $row['nama'] ?></td>
              <td><?= $row['jabatan'] ?></td>
            </tr>
            <?php $no++; ?>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div> -->
  <div class="card mt-3 mb-3">
		<div class="card-header pb-2 border-bottom">
			<div class="row m-0 w-100">
				<div class="col-lg-auto col-sm-12 mb-md-0 mb-1 text-center">
					<button class="btn btn-primary btn-sm p-1" id="zoom-reset"><i class="fa fa-undo"></i></button>
					<button class="btn btn-primary btn-sm p-1" id="zoom-minus"><i class="fa fa-minus"></i></button>
					<span class="px-1" id="zoom-calc">100%</span>
					<button class="btn btn-primary btn-sm p-1" id="zoom-plus"><i class="fa fa-plus"></i></button>
				</div>
			</div>
		</div>
		<div class="card-content">
			<div class="card-body position-relative">
      <!-- <?=$this->uri->segment(2);?> -->
				<div id="struktur_organisasi-chart" style="height: 570px;"></div>
			</div>
		</div>
	</div>
</div>


