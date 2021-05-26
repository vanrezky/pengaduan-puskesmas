<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= base_url('assets/frontend/'); ?>image/favicon.png" type="image/png">
    <title><?= $title; ?> | <?= $pengaturan['nama_website']; ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>vendors/linericon/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>vendors/owl-carousel/owl.carousel.min.css">
    <!-- main css -->
    <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/'); ?>css/responsive.css">
    <script src="<?= base_url('assets/frontend/'); ?>js/jquery-3.2.1.min.js"></script>

</head>

<body>
    <!--================Header Area =================-->
    <header class="header_area">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="<?= base_url(); ?>"><img src="<?= base_url('uploads/img/' . $pengaturan['logo']); ?>" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.html">Tentang</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('persebaran'); ?>">Persebaran</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('daftar-tps'); ?>">Daftar TPS</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('kontak'); ?>">Kontak</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!--================Header Area =================-->