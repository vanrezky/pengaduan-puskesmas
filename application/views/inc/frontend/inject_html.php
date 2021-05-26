<div class="aboutus-banner-wrap" style="background-image:url(<?= base_url('assets/frontend/img/home/home.png'); ?>) ;">
    <div class="aboutus-banner-bg-fill"></div>
    <!-- ABOUTUS BANNER -->
    <div class="aboutus-banner">
        <!-- ABOUTUS BANNER CONTENT -->
        <div class="aboutus-banner-content">
            <h6 class="title secondary">Lokasi TPS</h6>
            <p class="title">Kota Pekanbaru</p>
            <p>Tempat Pembuangan Sampah (Akhir) adalah tempat untuk menimbun sampah dan merupakan bentuk tertua perlakuan sampah.</p>
            <a href="<?= base_url("persebaran"); ?>" class="button medium">Lihat Persebaran</a>
        </div>
        <!-- /ABOUTUS BANNER CONTENT -->
    </div>
    <!-- /ABOUTUS BANNER -->
</div>

<div class="section-wrap">
    <!-- FEATURES SECTION -->
    <div class="features-section section">
        <h6 class="pretitle">SELAMAT DATANG DI</h6>
        <h3 class="title large"><?= $pengaturan['nama_website']; ?></h3>
        <hr class="line-separator short">

        <!-- FEATURE LIST -->
        <ul class="feature-list big">
            <!-- FEATURE LIST ITEM -->
            <li class="feature-list-item">
                <i class="s-icon icon-star"></i>
                <p class="title">Mudah Digunakan</p>
                <p>Sistem Informasi Geografis ini sangat mudah digunakan, bahkan bagi yang tidak mengenal sistem sekalipun.</p>
            </li>
            <!-- /FEATURE LIST ITEM -->

            <!-- FEATURE LIST ITEM -->
            <li class="feature-list-item">
                <i class="s-icon icon-rocket"></i>
                <p class="title">Web Responsive</p>
                <p>Sistem Informasi Geografis ini sudah responsive, sehingga kamu dapat mengakses melalui smartphone kamu</p>
            </li>
            <li class="feature-list-item">
                <i class="s-icon icon-map"></i>
                <p class="title">Lokasi Akurat</p>
                <p>Memberikan akurasi ketepatan mengenai lokasi tempat pembuangan sampah, serta memberikan arah lokasi terbaik</p>
            </li>
            <!-- /FEATURE LIST ITEM -->
        </ul>
        <!-- /FEATURE LIST -->
    </div>
    <!-- /FEATURES SECTION -->
</div>
<!-- ACTION POSTER WRAP -->
<div class="action-poster-wrap">
    <!-- ACTION POSTER -->
    <div class="action-poster">
        <!-- ACTION POSTER INFO -->
        <div class="action-poster-info">
            <h3 class="title">Cek yuk <span class="bold">Seputar Info</span></h3>
            <p><?= $pengaturan['nama_website']; ?></p>
        </div>
        <!-- /ACTION POSTER INFO -->

        <a href="<?= base_url('persebaran'); ?>" class="button medium with-icon">
            Lihat Persebaran
            <!-- SVG ARROW -->
            <svg class="svg-arrow">
                <use xlink:href="#svg-arrow"></use>
            </svg>
            <!-- /SVG ARROW -->
        </a>
    </div>
    <!-- /ACTION POSTER -->
</div>
<!-- /ACTION POSTER WRAP -->