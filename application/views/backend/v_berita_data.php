<link rel="stylesheet" href="<?= base_url('assets/backend/vendor/summernote/summernote-bs4.min.css'); ?>">
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div id="form-info"></div>
        <div class="col-lg-12 col-12">
            <!-- Basic Card Example -->
            <form role="form" method="post" id="submit-form" action="<?= base_url(isset($data['id']) ? "backend/berita/update/" . encode($data['id']) : "backend/berita/save") ?>">
                <?= csrf_field("csrf_protection"); ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <a href="<?= base_url('backend/berita'); ?>" class="btn btn-warning float-right"> Kembali</a>
                        </h6>

                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul Berita</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="<?= isset($data['judul']) ? $data['judul'] : ""; ?>">
                            <div class="invalid-feedback" id="feedjudul"></div>
                        </div>
                        <div class="form-group">
                            <label>Kategori Berita</label>
                            <select id="id_kategori" name="id_kategori" class="custom-select">
                                <option value="">Pilih</option>
                                <?php
                                foreach ($kategori as $key => $value) {
                                    $s = isset($data['id_kategori']) ? ($data['id_kategori'] == $value['id'] ? "selected" : "") : "";

                                    echo "<option value='$value[id]' $s>$value[nama_kategori]</option>";
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback" id="feedid_kategori"></div>
                        </div>

                        <div class="form-group">
                            <label>Isi Berita</label>
                            <textarea id="isi" name="isi" class="form-control summernote"><?= isset($news['isi']) ? $news['isi'] : ''; ?></textarea>
                            <div class="invalid-feedback" id="feedisi"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gambar</label>
                                    <div class="custom-file">
                                        <input type="file" name="gambar" class="custom-file-input" id="gambar" onchange="previewImg('#gambar', '.label-preview-1', '.img-preview-1')">
                                        <label class="custom-file-label label-preview-1"><?= isset($tps['gambar']) ? $tps['gambar'] : 'Pilih gambar'; ?></label>
                                        <div class="invalid-feedback mt-2" id="feedgambar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img style="max-width:200px" src="<?= base_url("/uploads/img/" . (isset($tps['gambar']) ? $tps['gambar'] : 'default.jpg')); ?>" alt="preview img" class="img-thumbnail img-preview-1 mt-2">

                            </div>
                        </div>


                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-right" id="btn-submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url('assets/backend/vendor/summernote/summernote-bs4.js'); ?>"></script>
<script>
    $(document).ready(function() {
        $(".summernote").summernote({
            placeholder: 'mulai menulis disini...',
            dialogsInBody: true,
            minHeight: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ]
        });

        $("#submit-form").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).prop("action"),
                data: new FormData(this),
                contentType: false,
                processData: false,
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
                    }

                    if (response.error) {
                        if (response.error.judul) {
                            $('#judul').addClass('is-invalid');
                            $('#feedjudul').html(response.error.judul);
                        } else {
                            $('#judul').removeClass('is-invalid');
                            $('#feedjudul').html("");
                        }
                        if (response.error.isi) {
                            $('#isi').addClass('is-invalid');
                            $('#feedisi').html(response.error.isi);
                        } else {
                            $('#isi').removeClass('is-invalid');
                            $('#feedisi').html("");
                        }
                        if (response.error.dgambar) {
                            $('#dgambar').addClass('is-invalid');
                            $('#feeddgambar').html(response.error.dgambar);
                        } else {
                            $('#dgambar').removeClass('is-invalid');
                            $('#feeddgambar').html("");
                        }
                        if (response.error.id_kategori) {
                            $('#id_kategori').addClass('is-invalid');
                            $('#feedid_kategori').html(response.error.id_kategori);
                        } else {
                            $('#id_kategori').removeClass('is-invalid');
                            $('#feedid_kategori').html("");
                        }
                        if (response.error.telp) {
                            $('#telp').addClass('is-invalid');
                            $('#feedtelp').html(response.error.telp);
                        } else {
                            $('#telp').removeClass('is-invalid');
                            $('#feedtelp').html("");
                        }

                    }

                    if (response.info) {
                        $("#form-info").html(response.info);
                    }

                    if (response.success) {
                        Swal.fire("Sukses..", response.success.pesan, "success").then(() => {
                            window.location = response.success.link;
                        });
                    }

                }
            });
        });
    });
</script>