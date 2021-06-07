<?php $role = $this->session->userdata("role"); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?php if ($role == "petugas") {; ?>
                <div class="float-right">
                    <a href="<?= base_url('backend/pasien/add') ?>" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Pasien</span>
                    </a>
                </div>
            <?php } ?>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Kode Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <?= $role == "petugas" ? "<th>Aksi</th>" : ""; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($pasien)) {
                            $baseurl = base_url();
                            $no = 1;
                            foreach ($pasien as $key => $value) {
                                $id = encode($value['id']);
                                echo "<tr>";
                                echo "<td>$no</td>";
                                echo "<td>$value[nama_pasien]</td>";
                                echo "<td>$value[kode_pasien]</td>";
                                echo "<td>$value[jenis_kelamin]</td>";
                                echo "<td>$value[alamat]</td>";
                                echo "<td>$value[telp]</td>";
                                if ($role == 'petugas') {

                                    echo "<td class='text-center'>";
                                    echo "<a href='" . $baseurl . "backend/pasien/edit/$id' class='btn btn-warning btn-sm mx-1 my-1'><i class='fas fa-edit'></i></a>";
                                    echo "<a href='javascript:void(0)' data-id='" . encode($value['id']) . "' class='btn btn-danger btn-sm mx-1 my-1 btn-delete'><i class='fas fa-trash'></i></a>";
                                    echo "</td>";
                                }
                                echo "</tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>Belum ada data..!</td></tr>";
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
<style>
    .sampul {
        width: 100px;
    }

    .table>tbody>tr>* {
        vertical-align: middle;
    }
</style>
<script>
    $(document).ready(function() {
        const baseurl = "<?= base_url("backend/pasien/delete"); ?>";
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