    <!--================Banner Area =================-->
    <section class="banner_area">
        <div class="booking_table d_flex align-items-center">
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
            <div class="container">
                <div class="banner_content text-center">
                    <h6>Sistem Informasi Geografis</h6>
                    <h2>TPS Kota Pekanbaru</h2>
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
                        <h2 class="title title_color">Tentang TPS</h2>
                        <p>Tempat pembuangan sampah akhir (TPA) suatu area tanah atau galian yang menerima sampah rumah tangga atau jenis sampah lainnya yang tidak berbahaya, seperti sampah padat komersial, limbah lumpur/endapan dan limbah padat industri yang tidak mengandung bahan kimia berbahaya.</p>
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
                <h2 class="title_color">Paling banyak dicari</h2>
                <p>Lokasi tempat sampah pekanbaru yang paling banyak dicari saat ini.</p>
            </div>
            <div class="row mb_30">
                <?php
                if (!empty($banyakDilihat)) {
                    foreach ($banyakDilihat as $key => $value) : ?>

                        <div class="col-lg-4 col-md-6">
                            <div class="single-recent-blog-post">
                                <div class="thumb">
                                    <img class="img-fluid" src="<?= base_url('uploads/img/' . $value['gambar']); ?>" alt="<?= $value['nama_tps']; ?>">
                                </div>
                                <div class="details">
                                    <div class="tags">
                                        <a href="javascript:void(0);" class="button_hover tag_btn"><?= $value['nama_jenistps']; ?></a>
                                    </div>
                                    <a href="<?= base_url('detail-tps/' . encode($value['id_tps'])); ?>">
                                        <h4 class="sec_h4"><?= $value['nama_tps']; ?></h4>
                                    </a>
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