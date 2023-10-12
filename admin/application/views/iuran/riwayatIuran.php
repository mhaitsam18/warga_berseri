<title>Data Iuran</title>
<div class="content-page">
  <div class="content">
<title>Data Iuran</title>
    <!-- Start Content-->
    <div class="container-fluid">

<div class="container-fluid">
   <div class="card shadow mb-4">
     <div class="card-header py-3">
      <h4> Riwayat Pembayaran Iuran</h6>
     </div>
     <div class="card-body">
       <div class="text-center">
        <table class="table table-bordered" style="height:-150px">
        <thead>
           <tr>
              <th scope="col" style="width: 5%">No</th>
              <th scope="col">No Tagihan</th>
              <th scope="col">Nama</th>
              <th scope="col">Status Iuran</th>
           </tr>
         </thead>
         <tbody>
          <?php $no=1;
          foreach($riwayat as $f) { ?>
             <tr>
              <th scope="row"> <?php echo $no++ ?></th>
              <td> <?php echo $f->no_tagihan; ?></td>
              <td ><?php echo $f->nama; ?></td>
              <td><?php echo $f->Status; ?></td>
              </tr>
          <?php } ?>
        </tbody>
        </table>

        <!-- CARA MENAMPILKAN : -->
        <!-- <section class="map1 cid-qv5AtTlAOw" id="map1-4y" data-rv-view="10734">
        <div class="google-map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.305551337187!2d107.6361689142461!3d-6.973232094962348!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9b3dbad8a1f%3A0x89ae734cc4aba80b!2sJl.%20Komp.%20Permata%20Buah%20Batu%2C%20Lengkong%2C%20Kec.%20Bojongsoang%2C%20Bandung%2C%20Jawa%20Barat%2040287!5e0!3m2!1sid!2sid!4v1584367442855!5m2!1sid!2sid" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>
        </section> -->
      </div>
    </div>
  </div>
</div>