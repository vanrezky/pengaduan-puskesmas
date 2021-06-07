    <!--================Banner Area =================-->
    <section class="banner_area">
        <div class="booking_table d_flex align-items-center">
            <!-- <div class="overlay bg-parallax" style="background: url('') no-repeat scroll center 0/cover;" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div> -->
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
            <div class="container">
                <div class="banner_content text-center">
                    <h6>Sistem Informasi Pengaduan Keluhan Pelayanan</h6>
                    <h2>Puskesmas Payung Sekaki</h2>
                    <p><?= $pengaturan['deskripsi']; ?></p>
                </div>
            </div>
        </div>

    </section>
    <!--================Banner Area =================-->

    <!--================ About History Area  =================-->
    <section class="about_history_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d_flex align-items-center">
                    <div class="about_content ">
                        <h2 class="title title_color">Tentang Puskesmas</h2>
                        <p>Puskesmas adalah fasilitas pelayanan kesehatan yang menyelenggarakan upaya kesehatan masyarakat
                            dan upaya kesehatan perorangan tingkat pertama yang mengutamakan upaya promotif dan preventif,
                            untuk mencapai derajat kesehatan masyarakat setinggi - tingginya diwilayah kerjanya.
                            Salah satu upaya pelayanan yang diberikan Puskesmas kepada masyarakat adalah perencanaan, pelaksanaan, evaluasi, pencatatan, dan pelaporan yang dirangkum dalam suatu sistem.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid" src="<?= base_url('assets/frontend/'); ?>image/garbage.jpg" alt="img">
                </div>
            </div>
        </div>
    </section>
    <!--================ About History Area  =================-->

    <!--================ Latest Blog Area  =================-->
    <section class="testimonial_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Artikel Terbaru</h2>
                <p>Artikel menarik dan terbaru dari kami untuk anda.</p>
            </div>
            <div class="row mb_30">
                <?php
                if (!empty($latest)) {
                    foreach ($latest as $key => $value) : ?>

                        <div class="col-lg-4 col-md-6">
                            <div class="single-recent-blog-post">
                                <div class="thumb">
                                    <img class="img-fluid" src="<?= base_url('uploads/img/' . $value['gambar']); ?>" alt="<?= $value['judul']; ?>">
                                </div>
                                <div class="details">
                                    <div class="tags">
                                        <a href="javascript:void(0);" class="button_hover tag_btn"><?= $value['nama_kategori']; ?></a>
                                    </div>
                                    <a href="<?= base_url('berita/' . $value['slug']); ?>">
                                        <h4 class="sec_h4"><?= $value['judul']; ?></h4>
                                    </a>
                                    <p><?= word_limiter(strip_tags($value['isi']), 20); ?></p>
                                </div>
                            </div>
                        </div>
                <?php endforeach;
                }
                ?>
            </div>
        </div>
    </section>
    <!--================ Recent Area  =================-->