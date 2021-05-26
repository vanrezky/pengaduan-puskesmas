 <!--================Breadcrumb Area =================-->
 <section class="breadcrumb_area blog_banner_two">
     <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
     <div class="container">
         <div class="page-cover text-center">
             <h2 class="page-cover-tittle f_48"><?= $data['nama_tps']; ?></h2>
             <ol class="breadcrumb">
                 <li><a href="index.html">Home</a></li>
                 <li><a href="<?= base_url('daftar-tps'); ?>">TPS</a></li>
                 <li class="active">detail Details</li>
             </ol>
         </div>
     </div>
 </section>
 <!--================Breadcrumb Area =================--
 <!--================Blog Area =================-->
 <section class="blog_area single-post-area">
     <div class="container">
         <div class="row">
             <div class="col-lg-8 posts-list">
                 <div class="single-post row">
                     <div class="col-lg-12">
                         <div>
                             <?= $map['html']; ?>
                         </div>
                     </div>
                     <div class="col-lg-3  col-md-3">
                         <div class="blog_info text-right">
                             <ul class="rute-list">
                                 <li><a href="<?= base_url('persebaran/' . encode($data['id_tps'])); ?>" class="genric-btn danger radius">Cari Rute</a></li>
                             </ul>

                             <ul class="blog_meta list_style">
                                 <li><a href="javascript:void(0);"><?= $data['nama_jenistps']; ?> <i class="lnr lnr-map-marker"></i></a></li>
                                 <li><a href="javascript:void(0);"><?= $data['dilihat']; ?>x Dilihat<i class="lnr lnr-eye"></i></a></li>
                                 <li><a href="tel:<?= $data['telp']; ?>"><?= $data['telp']; ?><i class="lnr lnr-phone"></i></a></li>

                             </ul>

                         </div>
                     </div>
                     <div class="col-lg-9 col-md-9 blog_details">
                         <h2><?= $data['nama_tps']; ?></h2>
                         <p><?= $data['keterangan']; ?></p>
                         <h2 class="mt-5">Infomasi Detail</h2>
                         <div class="table-responsive">
                             <table class="table table-bordered">
                                 <tbody>

                                     <tr>
                                         <td>Nama</td>
                                         <td class="text-center">:</td>
                                         <td><?= $data['nama_tps']; ?></td>
                                     </tr>
                                     <tr>
                                         <td>Alamat</td>
                                         <td class="text-center">:</td>
                                         <td><?= $data['alamat']; ?></td>
                                     </tr>
                                     <tr>
                                         <td>Telepon</td>
                                         <td class="text-center">:</td>
                                         <td><?= $data['telp']; ?></td>
                                     </tr>
                                     <tr>
                                         <td>Latitude</td>
                                         <td class="text-center">:</td>
                                         <td><?= $data['lat']; ?></td>
                                     </tr>
                                     <tr>
                                         <td>Longitude</td>
                                         <td class="text-center">:</td>
                                         <td><?= $data['lng']; ?></td>
                                     </tr>
                                     <tr>
                                         <td>Created At</td>
                                         <td class="text-center">:</td>
                                         <td><?= tgl_jam_indo($data['created_at']); ?></td>
                                     </tr>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>

             </div>
             <div class="col-lg-4">
                 <div class="blog_right_sidebar">
                     <aside class="single_sidebar_widget popular_post_widget">
                         <h3 class="widget_title">Foto Lokasi</h3>
                         <div class="feature-img">
                             <img class="img-fluid" data-src="<?= base_url('uploads/img/' . $data['gambar']); ?>" src="<?= base_url('uploads/img/' . $data['gambar']); ?>" alt="<?= $data['nama_tps']; ?>">
                         </div>
                     </aside>
                 </div>
                 <div class="blog_right_sidebar">
                     <aside class="single_sidebar_widget search_widget">
                         <div class="input-group">
                             <input type="text" class="form-control" placeholder="Cari TPS..">
                             <span class="input-group-btn">
                                 <button class="btn btn-default" type="button"><i class="lnr lnr-magnifier"></i></button>
                             </span>
                         </div><!-- /input-group -->
                         <div class="br"></div>
                     </aside>
                     <aside class="single_sidebar_widget popular_post_widget">
                         <h3 class="widget_title">Banyak Dilihat</h3>
                         <?php
                            if (!empty($banyakDilihat)) {
                                foreach ($banyakDilihat as $key => $value) : ?>
                                 <div class="media post_item">
                                     <img src="<?= base_url('uploads/img/' . $value['gambar']); ?>" style="width: 75px;" alt="<?= $value['nama_tps']; ?>">
                                     <div class="media-body">
                                         <a href="<?= base_url('detail-tps/' . encode($value['id_tps'])); ?>">
                                             <h3><?= $value['nama_tps']; ?></h3>
                                         </a>
                                         <p><?= $value['dilihat']; ?>x Dilihat</p>
                                     </div>
                                 </div>
                         <?php endforeach;
                            }
                            ?>
                         <div class="br"></div>
                     </aside>
                 </div>
             </div>
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
 <?= $map['js']; ?>
 <style>
     .img-fluid {
         cursor: zoom-in;
     }

     body.modal-open .modal {
         display: flex !important;
         height: 100%;
         align-items: center;
     }

     body.modal-open .modal .modal-dialog {
         margin: auto;
     }

     .rute-list {
         list-style-type: none;
         -webkit-transition: all 0.2s linear;
         -o-transition: all 0.2s linear;
         transition: all 0.2s linear;
     }
 </style>
 <script>
     $(document).ready(function() {
         $(".img-fluid").click(function(e) {
             e.preventDefault();
             var src = $(this).data("src");
             $("#gambar-zoom").attr("src", src);
             $('#exampleModalCenter').modal('show');
         });

     });
 </script>
 <!--================Blog Area =================-->