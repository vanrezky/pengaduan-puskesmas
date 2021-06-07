<section class="breadcrumb_area">
    <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
    <div class="container">
        <div class="page-cover text-center">
            <h2 class="page-cover-tittle"><?= $title; ?></h2>
            <ol class="breadcrumb">
                <li><a href="<?= base_url(); ?>">Home</a></li>
                <li class="active"><?= $title; ?></li>
            </ol>
        </div>
    </div>
</section>
<!--================Blog Area =================-->
<section class="blog_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog_left_sidebar">
                    <h3> <?= !empty($search) ? "Pencarian anda: " . $search  : "" ?></h3>
                    <?php
                    if (!empty($berita)) {
                        foreach ($berita as $key => $value) : ?>
                            <article class="row blog_item">
                                <div class="col-md-3">
                                    <div class="blog_info text-right">
                                        <ul class="blog_meta list_style">
                                            <li><a href="javascript:void(0);"><?= $value['nama_kategori']; ?> <i class="lnr lnr-list"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-9">

                                    <div class="blog_post">
                                        <img src="<?= base_url('uploads/img/' . $value['gambar']); ?>" alt="<?= $value['judul']; ?>">
                                        <div class="blog_details">
                                            <a href="<?= base_url('berita/' . $value['slug']); ?>">
                                                <h2><?= $value['judul']; ?></h2>
                                            </a>
                                            <p><?= word_limiter(strip_tags($value['isi']), 20); ?></p>
                                            <a href="<?= base_url('berita/' . $value['slug']); ?>" class="view_btn button_hover">Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                    <?php endforeach;
                    }
                    ?>
                    <?= $pagin; ?>
                </div>
            </div>
            <?= inject_sidebar($lastest); ?>
        </div>
    </div>
</section>
<!--================Blog Area =================-->