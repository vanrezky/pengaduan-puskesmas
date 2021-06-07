<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <a href="<?= base_url("pdf/" . encode(["index" => "pengaduan"])); ?>" class="btn btn-primary"><i class="fas fa-file-pdf"></i> Cetak </a>
            </div>
        </div>

        <div class="card-body">
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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($pengaduan)) {
                            $baseurl = base_url("backend/pengaduan");
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
                                echo "<td class='text-center'>";
                                echo "<a href='$baseurl/lihat/$id' class='btn btn-info btn-sm'><i class='fas fa-eye'></i> Lihat</a>";
                                echo "</td>";
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
        <form id="form-delete" action="#">
            <?= csrf_field("csrf_delete"); ?>
        </form>
        <div class="card-footer float-right">
            <?= $pagin; ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        const baseurl = "<?= base_url("admin/kontak/delete"); ?>";
        $(".btn-delete").click(function(e) {
            e.preventDefault();
            let id = $(this).data("id");

            Swal.fire({
                title: "Konfirmasi Ulang",
                text: "Yakin menghapus data?",
                icon: "warning",
                showCancelButton: true,
                reverseButtons: true,
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: baseurl + '/' + id,
                        data: $("#form-delete").serialize(),
                        dataType: "json",
                        beforeSend: function() {
                            $(this).addClass("disabled");
                        },
                        complete: function() {
                            $(this).removeClass("disabled");
                        },
                        success: function(response) {

                            if (response.csrf) {
                                $("#csrf_delete").val(response.csrf);
                            }

                            if (response.error) {
                                Swal.fire("Terjadi galat..!", response.error.pesan, "warning");
                            }
                            if (response.success) {
                                Swal.fire("Sukses..!", response.success.pesan, "success").then(() => {
                                    location.reload();
                                });
                            }

                        }
                    });
                }
            });

        });
    });
</script>