<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0">
    <!-- styles -->
    <link rel="stylesheet" href="<?= base_url("/assets/frontend/"); ?>css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url("/assets/frontend/"); ?>css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="<?= base_url("/assets/frontend/"); ?>css/style.min.css">
    <link rel="stylesheet" href="<?= base_url("/assets/frontend/css/custom.css"); ?>">
    <!-- jQuery -->
    <script src="<?= base_url("/assets/frontend/"); ?>js/vendor/jquery-3.1.0.min.js"></script>
    <!-- favicon -->
    <link rel="icon" href="<?= base_url('assets/frontend/img/'); ?>map-marker.png">
    <title><?= $title . ' | ' .  $pengaturan['nama_website']; ?></title>
</head>

<body>

    <!-- WIDGET LINE WRAP -->
    <div class="widget-line-wrap widget-line-1">
        <!-- WIDGET LINE -->
        <div class="widget-line">
            <!-- ACTIONS LIST -->
            <ul class="actions-list right">
                <!-- ACTIONS LIST ITEM -->
                <li class="actions-list-item">
                    <!-- SEARCH FORM -->
                    <form class="search-form">
                        <input type="text" name="search" autocomplete="off" placeholder="Cari lokasi disini..">
                        <!-- SEARCH SUBMIT -->
                        <div class="search-submit">
                            <!-- SVG MAG GLASS -->
                            <svg class="svg-mag-glass">
                                <use xlink:href="#svg-mag-glass"></use>
                            </svg>
                            <!-- /SVG MAG GLASS -->
                        </div>
                        <!-- /SEARCH SUBMIT -->

                        <!-- SEARCH CANCEL -->
                        <div class="search-cancel hidden">
                            <!-- SVG CROSS -->
                            <svg class="svg-cross">
                                <use xlink:href="#svg-cross"></use>
                            </svg>
                            <!-- /SVG CROSS -->
                        </div>
                        <!-- /SEARCH CANCEL -->
                    </form>
                    <!-- /SEARCH FORM -->
                </li>
                <!-- ACTIONS LIST ITEM -->
            </ul>
            <!-- ACTIONS LIST -->
        </div>
        <!-- WIDGET LINE -->
    </div>
    <!-- WIDGET LINE WRAP -->

    <!-- WIDGET LINE WRAP -->
    <div class="widget-line-wrap widget-line-2">
        <!-- WIDGET LINE -->
        <div class="widget-line">
            <!-- ACTIONS LIST -->
            <ul class="actions-list">
                <!-- ACTIONS LIST ITEM -->
                <li class="actions-list-item full void">
                    <!-- SEARCH FORM -->
                    <form class="search-form">
                        <input type="text" name="search" autocomplete="off" placeholder="Cari lokasi disini..">
                        <!-- SEARCH SUBMIT -->
                        <div class="search-submit">
                            <!-- SVG MAG GLASS -->
                            <svg class="svg-mag-glass">
                                <use xlink:href="#svg-mag-glass"></use>
                            </svg>
                            <!-- /SVG MAG GLASS -->
                        </div>
                        <!-- /SEARCH SUBMIT -->

                        <!-- SEARCH CANCEL -->
                        <div class="search-cancel hidden">
                            <!-- SVG CROSS -->
                            <svg class="svg-cross">
                                <use xlink:href="#svg-cross"></use>
                            </svg>
                            <!-- /SVG CROSS -->
                        </div>
                        <!-- /SEARCH CANCEL -->
                    </form>
                    <!-- /SEARCH FORM -->
                </li>
                <!-- ACTIONS LIST ITEM -->
            </ul>
            <!-- ACTIONS LIST -->
        </div>
        <!-- WIDGET LINE -->
    </div>
    <!-- WIDGET LINE WRAP -->

    <!-- NAVIGATION WRAP -->
    <div class="navigation-wrap">
        <!-- NAVIGATION -->
        <nav class="navigation">
            <!-- LOGO -->
            <figure class="logo">
                <img src="<?= base_url('uploads/img/' . $pengaturan['logo']); ?>" alt="<?= $pengaturan['nama_website']; ?>">
                <figcaption></figcaption>
            </figure>
            <ul class="main-menu">
                <!-- MAIN MENU ITEM -->
                <li class="main-menu-item">
                    <a href="<?= base_url(); ?>">Home</a>
                </li>
                <!-- /MAIN MENU ITEM -->

                <!-- MAIN MENU ITEM -->
                <li class="main-menu-item">
                    <a href="aboutus.html">About</a>
                </li>
                <!-- /MAIN MENU ITEM -->

                <!-- MAIN MENU ITEM -->
                <li class="main-menu-item">
                    <a href="blog.html">Our Blog</a>
                </li>
                <!-- /MAIN MENU ITEM -->

                <!-- MAIN MENU ITEM -->
                <li class="main-menu-item">
                    <a href="contactus.html">Contact</a>
                </li>
                <!-- /MAIN MENU ITEM -->
            </ul>

            <!-- /LOGO -->

            <!-- MAIN MENU -->

            <!-- /MAIN MENU -->

        </nav>
        <!-- /NAVIGATION -->
    </div>
    <!-- /NAVIGATION WRAP -->

    <!-- MOBILE MENU WRAP -->
    <div class="mobile-menu-wrap">
        <!-- MOBILE MENU CONTROL -->
        <div class="mobile-menu-control dropdown-control">
            <!-- SVG BURGER -->
            <svg class="svg-burger">
                <use xlink:href="#svg-burger"></use>
            </svg>
            <!-- /SVG BURGER -->
        </div>
        <!-- /MOBILE MENU CONTROL -->

        <!-- MOBILE MENU -->
        <ul class="mobile-menu dropdown">
            <!-- MOBILE MENU ITEM -->
            <li class="mobile-menu-item">
                <a href="<?= base_url(); ?>">Home</a>
            </li>
            <!-- /MOBILE MENU ITEM -->

            <!-- MOBILE MENU ITEM -->
            <li class="mobile-menu-item">
                <a href="aboutus.html">About</a>
            </li>
            <!-- /MOBILE MENU ITEM -->


            <!-- MOBILE MENU ITEM -->
            <li class="mobile-menu-item">
                <a href="blog.html">Our Blog</a>
            </li>
            <!-- /MOBILE MENU ITEM -->

            <!-- /MOBILE MENU ITEM -->
        </ul>
        <!-- /MOBILE MENU -->
    </div>
    <!-- /MOBILE MENU WRAP -->