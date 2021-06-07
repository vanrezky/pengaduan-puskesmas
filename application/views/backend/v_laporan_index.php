<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <a href="<?= base_url("pdf/" . encode(["index" => "pengaduan", "tgl_mulai" => $filter['tgl_mulai'], "tgl_akhir" => $filter['tgl_akhir']])); ?>" class="btn btn-primary"><i class="fas fa-file-pdf"></i> Cetak </a>
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-8 mb-3">
                <form class="row" action="<?= base_url("backend/laporan"); ?>" method="get">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Mulai</label>
                            <input type="date" class="form-control" name="tgl_mulai" id="tgl_mulai" value="<?= isset($filter['tgl_mulai']) ? $filter['tgl_mulai'] : ""; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Akhir</label>
                            <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" value="<?= isset($filter['tgl_akhir']) ? $filter['tgl_akhir'] : ""; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="margin-top"></div>
                        <button type="submit" class="btn btn-info"><i class="fas fa-search"></i> Cari</button>
                        <a href="<?= base_url("backend/laporan"); ?>" class="btn btn-warning"><i class="fas fa-sync"></i> Reset</a>
                    </div>

                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Waktu Pelaporan</th>
                            <th>Kode Pasien</th>
                            <th>Data Pasien</th>
                            <th width="35%">Isi Pengaduan</th>
                            <th>Status Pengaduan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($pengaduan)) {
                            $no = 1;
                            foreach ($pengaduan as $key => $value) {
                                $id = encode($value['id']);
                                echo "<tr>";
                                echo "<td>$no</td>";
                                echo "<td>" . tgl_jam_indo($value['tgl_pengaduan']) . "</td>";
                                echo "<td>$value[kode_pasien]</td>";
                                echo "<td><b>Nama:</b> $value[nama_pasien] <br/> <b>Jenis Kelamin:</b> $value[jenis_kelamin] <br/> <b>Alamat:</b> $value[alamat] <br/> <b>Telp:</b> $value[telp]</td>";
                                echo "<td>$value[pengaduan]</td>";
                                echo "<td>" . status_pengaduan($value['status']) . "</td>";
                                echo "</tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>Belum ada data..!</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
    @media screen and (min-width: 992px) {
        .margin-top {
            margin-top: 32px;
        }
    }
</style>