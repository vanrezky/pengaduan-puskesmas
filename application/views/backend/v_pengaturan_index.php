<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <div id="form-info"></div>
    <div class="row">

        <div class="col-lg-12">
            <!-- Basic Card Example -->
            <form role="form" method="post" enctype="multipart/form-data" id="submit-form" action="<?= base_url("backend/pengaturan/save"); ?>">
                <?= csrf_field("csrf_protection"); ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Website</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Website</label>
                            <input type="text" class="form-control" id="nama_website" name="nama_website" value="<?= $pengaturan["nama_website"]; ?>">
                            <div class="invalid-feedback" id="feednama_website"></div>
                        </div>
                        <div class="form-group">
                            <label>Nama Singkatan</label>
                            <input type="text" class="form-control" name="nama_singkat" id="nama_singkat" value="<?= $pengaturan["nama_singkat"] ?>">
                            <div class="invalid-feedback" id="feednama_singkat"></div>
                        </div>
                        <div class="form-group">
                            <label>Semboyan</label>
                            <input type="text" class="form-control" name="semboyan" id="semboyan" value="<?= $pengaturan["semboyan"] ?>">
                            <div class="invalid-feedback" id="feedsemboyan"></div>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Website</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4"><?= $pengaturan["deskripsi"] ?></textarea>
                            <div class="invalid-feedback" id="feeddeskripsi"></div>
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo Website</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="logo" name="logo" class="form-control-file">
                                    <div class="invalid-feedback" id="feedlogo"></div>
                                    <input type="text" name="logo_delete_foto" value="<?= $pengaturan["logo"] ?>" hidden readonly>
                                </div>
                                <div class="col-sm-6">
                                    <img class="img-fluid" src="<?= base_url('uploads/img/' . $pengaturan['logo']) ?>" alt="Logo Website">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info  float-right" id="btn-submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<script>
    $(document).ready(function() {
        $("#submit-form").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr("action"),
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function() {
                    $("#btn-submit").addClass("disabled btn-progres");
                },
                complete: function() {
                    $("#btn-submit").removeClass("disabled btn-progres");
                },
                success: function(response) {
                    if (response.csrf) {
                        $("#csrf_protection").val(response.csrf);
                    }

                    if (response.error) {

                        if (response.error.nama_website) {
                            $('#nama_website').addClass('is-invalid');
                            $('#feednama_website').html(response.error.nama_website);
                        } else {
                            $('#nama_website').removeClass('is-invalid');
                            $('#feednama_website').html("");
                        }
                        if (response.error.deskripsi) {
                            $('#deskripsi').addClass('is-invalid');
                            $('#feeddeskripsi').html(response.error.deskripsi);
                        } else {
                            $('#deskripsi').removeClass('is-invalid');
                            $('#feeddeskripsi').html("");
                        }

                        if (response.error.nama_singkat) {
                            $('#nama_singkat').addClass('is-invalid');
                            $('#feednama_singkat').html(response.error.nama_singkat);
                        } else {
                            $('#nama_singkat').removeClass('is-invalid');
                            $('#feednama_singkat').html("");
                        }
                        if (response.error.logo) {
                            $('#logo').addClass('is-invalid');
                            $('#feedlogo').html(response.error.logo);
                        } else {
                            $('#logo').removeClass('is-invalid');
                            $('#feedlogo').html("");
                        }
                    } else {

                    }

                    if (response.info) {
                        $("#form-info").html(response.info);

                    }

                    if (response.success) {
                        Swal.fire("Sukses..", response.success.pesan, "success").then(() => {
                            location.reload();
                        });
                    }
                }
            });
        });
    });
</script>