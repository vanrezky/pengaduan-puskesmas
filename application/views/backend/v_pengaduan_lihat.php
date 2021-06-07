<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <a href="<?= base_url("backend/pengaduan"); ?>" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Kembali </a>
            </div>
        </div>

        <form action="<?= base_url("backend/pengaduan/save/" . encode($pengaduan['id'])); ?>" method="post" id="submit-form">
            <?= csrf_field("csrf_protection"); ?>
            <div class="card-body row">
                <div class="col-md-8 mx-auto">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <tbody>
                            <tr>
                                <td width="30%">Kode Pasien</td>
                                <td width="10px">:</td>
                                <td><?= $pengaduan['kode_pasien']; ?></td>
                            </tr>
                            <tr>
                                <td>Nama Pasien</td>
                                <td>:</td>
                                <td><?= $pengaduan['nama_pasien']; ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><?= $pengaduan['jenis_kelamin']; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?= $pengaduan['alamat']; ?></td>
                            </tr>
                            <tr>
                                <td>Telp</td>
                                <td>:</td>
                                <td><?= $pengaduan['telp']; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Pelaporan</td>
                                <td>:</td>
                                <td><?= tgl_jam_indo($pengaduan['tgl_pengaduan'])  ?></td>
                            </tr>
                            <tr>
                                <td>Kategori Pengaduan</td>
                                <td>:</td>
                                <td><?= $pengaduan['nama_kategori']; ?></td>
                            </tr>
                            <tr>
                                <td>Isi Pengaduan</td>
                                <td>:</td>
                                <td><?= $pengaduan['pengaduan']; ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>
                                    <select class="form-control" name="status" <?= $this->session->userdata("role") == 'pimpinan' ? 'disabled' : ''; ?>>
                                        <?php
                                        foreach ($status as $key => $value) {
                                            $s = $key == $pengaduan['status'] ? 'selected' : "";
                                            echo "<option $s value='$key'>$value</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <?php
                            if ($this->session->userdata("role") == "petugas") { ?>
                                <tr>
                                    <td colspan="3">
                                        <div class="float-right"><button type="submit" id="btn-submit" class="btn btn-success">Simpan</button></div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <div class="card-footer float-right">
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#submit-form").submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).prop("action"),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $("#btn-submit").prop("disabled", true);
                },
                success: function(response) {
                    $("#btn-submit").prop("disabled", false);

                    if (response.csrf) {
                        $("#csrf_protection").val(response.csrf);
                    }

                    if (response.success) {
                        Swal.fire("Sukses..", response.pesan, "success");
                    } else {
                        Swal.fire("Sukses..", response.pesan, "warning").then(() => {
                            location.reload();
                        });
                    }
                }
            });
        });
    });
</script>