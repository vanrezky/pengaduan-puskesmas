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

                    <?php
                    if (!empty($tps)) {
                        foreach ($tps as $key => $value) : ?>
                            <article class="row blog_item">
                                <div class="col-md-3">
                                    <div class="blog_info text-right">
                                        <ul class="blog_meta list_style">
                                            <li><a href="javascript:void(0);"><?= $value['nama_jenistps']; ?> <i class="lnr lnr-map-marker"></i></a></li>
                                            <li><a href="javascript:void(0);"><?= $value['dilihat']; ?><i class="lnr lnr-eye"></i></a></li>
                                            <li><a href="tel:<?= $value['telp']; ?>"><?= $value['telp']; ?><i class="lnr lnr-phone"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="blog_post">
                                        <img src="<?= base_url('uploads/img/' . $value['gambar']); ?>" alt="<?= $value['nama_tps']; ?>">
                                        <div class="blog_details">
                                            <a href="<?= base_url('detail-tps/' . encode($value['id_tps'])); ?>">
                                                <h2><?= $value['nama_tps']; ?></h2>
                                            </a>
                                            <p><?= word_limiter($value['keterangan'], 20); ?></p>
                                            <a href="<?= base_url('detail-tps/' . encode($value['id_tps'])); ?>" class="view_btn button_hover">Lihat</a>
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
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search Posts">
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
<!--================Blog Area =================-->