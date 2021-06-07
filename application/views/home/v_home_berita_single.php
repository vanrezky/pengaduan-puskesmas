 <!--================Breadcrumb Area =================-->

 <section class="breadcrumb_area">
     <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
     <div class="container">
         <div class="page-cover text-center">
             <h2 class="page-cover-tittle f_48"><?= $berita['judul']; ?></h2>
             <ol class="breadcrumb">
                 <li><a href="index.html">Home</a></li>
                 <li><a href="<?= base_url('daftar-tps'); ?>">Berita</a></li>
                 <li class="active"><?= $berita['judul']; ?></li>
             </ol>
         </div>
     </div>
 </section>
 <section class="blog_area single-post-area">
     <div class="container">
         <div class="row">
             <div class="col-lg-8 posts-list">
                 <div class="single-post row">
                     <div class="col-lg-12">
                         <div class="feature-img">
                             <img class="img-fluid" src="<?= base_url("uploads/img/" . $berita['gambar']); ?>" alt="<?= $berita['judul']; ?>">
                         </div>
                     </div>
                     <div class="col-lg-3  col-md-3">
                         <div class="blog_info text-right">
                             <ul class="blog_meta list_style">
                                 <li><a href="javascript:void(0);"><?= $berita['nama_kategori']; ?> <i class="lnr lnr-list"></i></a></li>
                                 <li><a href="javascript:void(0);"><?= tgl_jam_indo($berita['updated_at']); ?><i class="lnr lnr-calendar-full"></i></a></li>
                             </ul>
                         </div>
                     </div>
                     <div class="col-lg-9 col-md-9 blog_details">
                         <h2><?= $berita['judul']; ?></h2>
                         <?= $berita['isi']; ?>
                     </div>
                 </div>

             </div>
             <?= inject_sidebar($lastest); ?>
         </div>
     </div>
 </section>
 <!-- Modal -->
 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog bd-example-modal-lg" role="document">
         <div class="modal-content modal-lg">
             <img id="gambar-zoom" src="<?= base_url("uploads/img/default.jpg"); ?>" id="" alt="">
         </div>
     </div>
 </div>
 <!--================Blog Area =================-->