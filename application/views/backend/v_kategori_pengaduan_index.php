<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    Form Kategori
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <form action="<?= base_url("backend/pengaduan/kategori/save"); ?>" method="post" id="submit-form">
                            <?= csrf_field("csrf_protection"); ?>
                            <div class="form-group">
                                <label for="nama_kategori">Nama Kategori</label>
                                <input class="form-control" name="nama_kategori" id="nama_kategori" autofocus>
                                <div class="invalid-feedback" id="feednama_kategori"></div>
                            </div>
                            <button type="reset" class="btn btn-warning d-none" id="btn-reset">Cancel</button>
                            <button type="submit" class="btn btn-info" id="btn-submit">Tambahkan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    Daftar Kategori
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama Kategori Pengaduan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($kategori)) {
                                    $no = 1;
                                    foreach ($kategori as $key => $value) {
                                        $id = encode($value['id']);
                                        echo "<tr data-id='$id' data-nama_kategori='$value[nama_kategori]'>";
                                        echo "<td>$value[nama_kategori]</td>";
                                        echo "<td class='text-center'>";
                                        echo "<a href='javascript:void(0)' class='btn btn-warning btn-sm mx-1 my-1 btn-edit'><i class='fas fa-edit'></i></a>";
                                        echo "<a href='javascript:void(0)' class='btn btn-danger btn-sm mx-1 my-1 btn-delete'><i class='fas fa-trash'></i></a>";
                                        echo "</td>";
                                        echo "</tr>";
                                        $no++;
                                    }
                                } else {
                                    echo "<tr><td colspan='2' class='text-center'>Belum ada kategori..!</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <form id="form-delete" action="#">
                    <?= csrf_field("csrf_delete"); ?>
                </form>
            </div>
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
        const baseurl = "<?= base_url("backend/pengaduan/kategori"); ?>";
        const url_add = baseurl + '/save';

        $("#btn-reset").click(function(e) {
            $(this).addClass("d-none");
            $("#btn-submit").text("Tambahkan");
            $("#submit-form").prop("action", url_add);
        });

        $(".btn-edit").click(function(e) {
            e.preventDefault();
            let closest = $(this).closest("tr");
            let id = closest.data("id");
            let nama_kategori = closest.data("nama_kategori");

            $("[name='nama_kategori']").val(nama_kategori);
            $("#btn-reset").removeClass("d-none");
            $("#btn-submit").text("Update");
            $("#submit-form").prop("action", baseurl + '/update/' + id);
        });

        $("#submit-form").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).prop("action"),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $("#form-info").html("");
                    $("#btn-submit").addClass("disabled");
                },
                complete: function() {
                    $("#btn-submit").removeClass("disabled");
                },
                success: function(response) {
                    if (response.csrf) {
                        $("#csrf_protection").val(response.csrf);
                        $("#csrf_delete").val(response.csrf);
                    }
                    if (response.error) {
                        if (response.error.nama_kategori) {
                            $('#nama_kategori').addClass('is-invalid');
                            $('#feednama_kategori').html(response.error.nama_kategori);
                        } else {
                            $('#nama_kategori').removeClass('is-invalid');
                            $('#feednama_kategori').html("");
                        }
                    }

                    if (response.success) {
                        Swal.fire("Sukses..", response.success.pesan, "success").then(() => {
                            window.location = response.success.link;
                        });
                    }

                }
            });
        });
        $(".btn-delete").click(function(e) {
            e.preventDefault();
            let id = $(this).closest("tr").data("id");

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
                        url: baseurl + '/delete/' + id,
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