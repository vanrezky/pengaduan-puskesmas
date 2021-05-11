<!-- MAIN SLIDER -->
<div class="main-slider">
    <!-- SLIDER CONTROLS -->
    <div class="slider-controls">
        <!-- SLIDER CONTROL -->
        <div class="slider-control"></div>
        <!-- SLIDER CONTROL -->

        <!-- SLIDER CONTROL -->
        <div class="slider-control"></div>
        <!-- SLIDER CONTROL -->

    </div>
    <!-- /SLIDER CONTROLS -->

    <!-- SLIDE LIST -->
    <div class="slide-list">
        <!-- SLIDE -->
        <div class="slide slide-1">
            <!-- SLIDE CONTENT WRAP -->
            <div class="slide-content-wrap">
                <!-- SLIDE CONTENT -->
                <div class="slide-content">
                    <h2 class="banner-title dark large">Customize</h2>
                    <h2 class="banner-title main medium">Your Helmet</h2>
                    <h2 class="banner-title micro light">Millions of different posibilities!</h2>
                </div>
                <!-- SLIDE CONTENT -->
            </div>
            <!-- SLIDE CONTENT WRAP -->
        </div>
        <!-- SLIDE -->

        <!-- SLIDE -->
        <div class="slide slide-2">
            <!-- SLIDE CONTENT WRAP -->
            <div class="slide-content-wrap">
                <!-- SLIDE CONTENT -->
                <div class="slide-content">
                    <h2 class="banner-title small">We have</h2>
                    <h2 class="banner-title"><span class="highlighted">Incredible</span></h2>
                    <h2 class="banner-title">Designs</h2>
                    <h2 class="banner-title micro">Thousands of helmets to choose from!</h2>
                    <a href="#" class="button">Browse Popular</a>
                </div>
                <!-- SLIDE CONTENT -->
            </div>
            <!-- SLIDE CONTENT WRAP -->
        </div>
        <!-- SLIDE -->
    </div>
    <!-- /SLIDE LIST -->
</div>
<!-- /MAIN SLIDER -->

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
                <i class="s-icon icon-energy"></i>
                <p class="title">Ultra Durability</p>
                <p>Lorem ipsum dolor sit amet, consecteture ipisicing elit, sed dorem eiusmod tempor incididunt ut labore et dolore.</p>
            </li>
            <!-- /FEATURE LIST ITEM -->

            <!-- FEATURE LIST ITEM -->
            <li class="feature-list-item">
                <i class="s-icon icon-drop"></i>
                <p class="title">Water Resistant</p>
                <p>Lorem ipsum dolor sit amet, consecteture ipisicing elit, sed dorem eiusmod tempor incididunt ut labore et dolore.</p>
            </li>
            <!-- /FEATURE LIST ITEM -->

            <!-- FEATURE LIST ITEM -->
            <li class="feature-list-item">
                <i class="s-icon icon-star"></i>
                <p class="title">Super Comfort</p>
                <p>Lorem ipsum dolor sit amet, consecteture ipisicing elit, sed dorem eiusmod tempor incididunt ut labore et dolore.</p>
            </li>
            <!-- /FEATURE LIST ITEM -->

            <!-- FEATURE LIST ITEM -->
            <li class="feature-list-item">
                <i class="s-icon icon-rocket"></i>
                <p class="title">Special Designs</p>
                <p>Lorem ipsum dolor sit amet, consecteture ipisicing elit, sed dorem eiusmod tempor incididunt ut labore et dolore.</p>
            </li>
            <!-- /FEATURE LIST ITEM -->

            <!-- FEATURE LIST ITEM -->
            <li class="feature-list-item">
                <i class="s-icon icon-like"></i>
                <p class="title">Quality Warranty</p>
                <p>Lorem ipsum dolor sit amet, consecteture ipisicing elit, sed dorem eiusmod tempor incididunt ut labore et dolore.</p>
            </li>
            <!-- /FEATURE LIST ITEM -->

            <!-- FEATURE LIST ITEM -->
            <li class="feature-list-item">
                <i class="s-icon icon-wrench"></i>
                <p class="title">Product Builder</p>
                <p>Lorem ipsum dolor sit amet, consecteture ipisicing elit, sed dorem eiusmod tempor incididunt ut labore et dolore.</p>
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
<script src="<?= base_url("/assets/frontend/"); ?>js/xmslider.js"></script>