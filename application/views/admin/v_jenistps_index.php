<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-right">
                <button class="btn btn-primary btn-icon-split btn-sm" id="btn-add">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add Record</span>
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <!-- <th>No</th> -->
                            <th>Marker</th>
                            <th>Nama Jenis TPS</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($jenistps)) {
                            $no = 1;
                            foreach ($jenistps as $key => $value) {
                                echo "<tr data-id='" . encode($value['id_jenistps']) . "'>";
                                // echo "<td>$no</td>";
                                echo "<td class='text-center'><img class='img-thumbnail sampul' src='" . base_url("uploads/img/" . $value['marker']) . "'></td>";
                                echo "<td>$value[nama_jenistps]</td>";
                                echo "<td class='text-center'>";
                                echo "<a href='javascript:void(0)' class='btn btn-warning btn-sm mx-1 my-1 btn-edit'><i class='fas fa-edit'></i></a>";
                                echo "<a href='javascript:void(0)' class='btn btn-danger btn-sm mx-1 my-1 btn-delete'><i class='fas fa-trash'></i></a>";
                                echo "</td>";
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
<div class="modal fade" tabindex="-1" role="dialog" id="jenistpa-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="form-submit" method="post">
                <?= csrf_field('csrf_protection'); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_jenistps">Nama Jenis TPS</label>
                        <input type="text" class="form-control" id="nama_jenistps" name="nama_jenistps" value="">
                        <div class="invalid-feedback feednama_jenistps"></div>
                    </div>
                    <div class="form-group">
                        <label for="marker">Gambar</label>
                        <div class="custom-file">
                            <input type="file" name="marker" class="custom-file-input" id="marker" onchange="previewImg('#marker', '.label-preview-1', '.img-preview-1')">
                            <label class="custom-file-label label-preview-1">Pilih Gambar</label>
                            <div class="invalid-feedback feedmarker mt-2"></div>
                        </div>
                        <div class="row">
                            <div class="mx-auto">
                                <img src="<?= base_url("uploads/img/default.jpg"); ?>" alt="preview img" class="img-thumbnail img-preview-1 mt-2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-warning btnClose" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnSave"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .sampul {
        width: 50px;
    }

    .table>tbody>tr>* {
        vertical-align: middle;
    }
</style>
<script>
    $(document).ready(function() {

        const baseurl = "<?= base_url(); ?>";

        $('#btn-add').click(function(e) {
            resetInput("form-submit");
            $("#form-submit").prop('action', baseurl + '/admin/tps/jenis-save');
            $(".label-preview-1").html("Pilih Gambar");
            $(".img-preview-1").prop('src', baseurl + '/uploads/img/default.jpg');
            $('.modalTitle').html('Tambah Jenis TPS');
            showModal("jenistpa-modal", true);
        });

        $(".btn-edit").click(function(e) {
            let id = $(this).closest("tr").data("id");
            $.ajax({
                type: "get",
                url: baseurl + "admin/tps/jenis-get/" + id,
                dataType: "json",
                success: function(response) {

                    if (response.error) {
                        Swal.fire("Terjadi Galat..!", response.error.pesan, "warning");
                    }

                    if (response.success) {

                        $("#form-submit").prop('action', baseurl + '/admin/tps/jenis-save/' + id);
                        $(".label-preview-1").html(response.data.marker);
                        $(".img-preview-1").prop('src', baseurl + '/uploads/img/' + response.data.marker);
                        $('.modalTitle').html('Edit Jenis TPS');
                        $("#nama_jenistps").val(response.data.nama_jenistps);
                        showModal("jenistpa-modal", true);
                    }

                }
            });
        });


        $('#form-submit').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).prop('action'),
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function() {
                    $(".btnClose").addClass("disabled");
                    $(".btnSave").addClass("disabled btn-progress");
                },
                complete: function() {
                    $(".btnClose").removeClass("disabled");
                    $(".btnSave").removeClass("disabled btn-progress");
                },
                success: function(response) {
                    if (response.csrf) {
                        $('#csrf_protection').val(response.csrf);
                        $('#csrf_delete').val(response.csrf);
                    }

                    if (response.error) {
                        Swal.fire("Terjadi Galat..!", "Mohon periksa kembali inputan anda", 'warning');
                        if (response.error.nama_jenistps) {
                            $('#nama_jenistps').addClass('is-invalid');
                            $('.feednama_jenistps').html(response.error.nama_jenistps);
                        } else {
                            $('#nama_jenistps').removeClass('is-invalid');
                            $('.feednama_jenistps').html("");
                        }
                        if (response.error.marker) {
                            $('#marker').addClass('is-invalid');
                            $('.feedmarker').html(response.error.marker);
                        } else {
                            $('#marker').removeClass('is-invalid');
                            $('.feedmarker').html("");
                        }
                    }

                    if (response.success) {
                        Swal.fire("Sukses..!", response.success.pesan, "success").then(() => {
                            // panggil kembali fungsi
                            window.location.href = baseurl + "/admin/tps/jenis";
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });

            return false;
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
                        url: baseurl + 'admin/tps/jenis-delete/' + id,
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
                                $("#csrf_protection").val(response.csrf);
                            }

                            if (response.error) {
                                Swal.fire("Terjadi galat..!", response.error.pesan, "warning");
                            }
                            if (response.success) {
                                Swal.fire("Sukses..!", response.success.pesan, "success").then(() => {
                                    window.location.href = baseurl + 'admin/tps/jenis'
                                });
                            }

                        }
                    });
                }
            });

        });
    });

    function resetInput(divId) {
        $("#" + divId).find("input:text, input:password, input:file, select").each(function() {
            $(this).val("").removeClass("is-invalid");
        });
    }

    function showModal(prop, staticModal = false) {
        if (staticModal) {
            $("#" + prop).modal({
                backdrop: "static",
                keyboard: false,
            });
        } else {
            $("#" + prop).modal("show");
        }
    }
</script>