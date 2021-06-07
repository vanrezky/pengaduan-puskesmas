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
<section class="about_history_area section_gap">
    <div class="container">
        <?= (empty($data) && !empty($kode)) ? "<div class='alert alert-danger text-center'>Maaf data tidak ditemukan!</div>" : ""; ?>
        <div class="row">
            <?php if (empty($data)) { ?>
                <div class="col-md-6 mx-auto">
                    <form class="row contact_form" action="<?= base_url("pengaduan/cek"); ?>" method="get" id="submit-form">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="kode_pasien">Kode Pasien</label>
                                <input type="text" class="form-control" id="kode_pasien" name="kode_pasien" required placeholder="Kode Pasien">
                            </div>
                            <div class="text-right">
                                <button type="submit" value="submit" id="btn-submit" class="btn theme_btn button_hover">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php } else {
                echo "<table class='table table-bordered'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>No</th>";
                echo "<th>Tanggal Pengaduan</th>";
                echo "<th>Kode Pasien</th>";
                echo "<th>Nama Pasien</th>";
                echo "<th>Pengaduan</th>";
                echo "<th>Status</th>";
                echo "</tr>";
                echo "</thead>";
                foreach ($data as $key => $value) {
                    echo "<tr>";
                    echo "<td>" . ($key + 1) . "</td>";
                    echo "<td>" . tgl_jam_indo($value['tgl_pengaduan']) . "</td>";
                    echo "<td>$value[kode_pasien]</td>";
                    echo "<td>$value[nama_pasien]</td>";
                    echo "<td>$value[pengaduan]</td>";
                    echo "<td>" . status_pengaduan($value['status']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }; ?>
        </div>
    </div>
</section>