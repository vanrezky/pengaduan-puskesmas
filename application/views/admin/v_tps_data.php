<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div id="form-info"></div>
        <div class="col-lg-6">
            <!-- Basic Card Example -->
            <form role="form" method="post" id="submit-form" action="<?= base_url(isset($tps['id_tps']) ? 'admin/tps/update/' . encode($tps['id_tps']) : 'admin/tps/save') ?>">
                <?= csrf_field("csrf_protection"); ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Formulir
                            <a href="<?= base_url('admin/tps/'); ?>" class="btn btn-warning float-right"> Kembali</a>
                        </h6>

                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama TPS</label>
                            <input type="text" class="form-control" id="nama_tps" name="nama_tps" value="<?= isset($tps['nama_tps']) ? $tps['nama_tps'] : ""; ?>">
                            <div class="invalid-feedback" id="feednama_tps"></div>
                        </div>
                        <div class="form-group">
                            <label>Keterangan (Opsional)</label>
                            <textarea class="form-control" name="keterangan" rows="4" id="keterangan"><?= isset($tps['keterangan']) ? $tps['keterangan'] : ""; ?></textarea>
                            <div class="invalid-feedback" id="feedketerangan"></div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" rows="4" id="alamat"><?= isset($tps['alamat']) ? $tps['alamat'] : ""; ?></textarea>
                            <div class="invalid-feedback" id="feedalamat"></div>
                        </div>
                        <div class="form-group">
                            <label>Jenis TPS</label>
                            <select id="id_jenistps" name="id_jenistps" class="custom-select">
                                <option value="">Pilih</option>
                                <?php
                                if (!empty($jenistps)) {
                                    foreach ($jenistps as $key => $value) {
                                        $s = isset($tps['id_jenistps']) ? ($tps['id_jenistps'] == $value['id_jenistps'] ? "selected" : "") : "";

                                        echo "<option value='$value[id_jenistps]' $s>$value[nama_jenistps]</option>";
                                    }
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback" id="feedid_jenistps"></div>
                        </div>
                        <div class="form-group">
                            <label>Telp</label>
                            <input type="text" class="form-control" id="telp" name="telp" value="<?= isset($tps['telp']) ? $tps['telp'] : ""; ?>">
                            <div class="invalid-feedback" id="feedtelp"></div>
                        </div>
                        <div class="form-group">
                            <label>Foto Lokasi</label>
                            <div class="custom-file">
                                <input type="file" name="gambar" class="custom-file-input" id="gambar" onchange="previewImg('#gambar', '.label-preview-1', '.img-preview-1')">
                                <label class="custom-file-label label-preview-1"><?= isset($tps['gambar']) ? $tps['gambar'] : 'Pilih gambar'; ?></label>
                                <div class="invalid-feedback mt-2" id="feedgambar"></div>
                            </div>
                            <img style="max-width:200px" src="<?= base_url("/uploads/img/" . (isset($tps['gambar']) ? $tps['gambar'] : 'default.jpg')); ?>" alt="preview img" class="img-thumbnail img-preview-1 mt-2">
                        </div>
                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="text" class="form-control" id="lat" name="lat" value="<?= isset($tps['lat']) ? $tps['lat'] : ""; ?>" placeholder="otomatis dari map" readonly>
                            <div class="invalid-feedback" id="feedlat"></div>
                        </div>
                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="text" class="form-control" id="lng" name="lng" value="<?= isset($tps['lng']) ? $tps['lng'] : ""; ?>" placeholder="otomatis dari map" readonly>
                            <div class="invalid-feedback" id="feedlng"></div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info float-right" id="btn-submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Peta</h6>
                </div>
                <div class="card-body">
                    <div class="mb-5">
                        <input type="text" id="myPlaceTextBox" class="form-control">
                    </div>
                    <?php echo $map['html'] ?>
                </div>
            </div>
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
                        if (response.error.nama_tps) {
                            $('#nama_tps').addClass('is-invalid');
                            $('#feednama_tps').html(response.error.nama_tps);
                        } else {
                            $('#nama_tps').removeClass('is-invalid');
                            $('#feednama_tps').html("");
                        }
                        if (response.error.keterangan) {
                            $('#keterangan').addClass('is-invalid');
                            $('#feedketerangan').html(response.error.keterangan);
                        } else {
                            $('#keterangan').removeClass('is-invalid');
                            $('#feedketerangan').html("");
                        }
                        if (response.error.alamat) {
                            $('#alamat').addClass('is-invalid');
                            $('#feedalamat').html(response.error.alamat);
                        } else {
                            $('#alamat').removeClass('is-invalid');
                            $('#feedalamat').html("");
                        }
                        if (response.error.id_jenistps) {
                            $('#id_jenistps').addClass('is-invalid');
                            $('#feedid_jenistps').html(response.error.id_jenistps);
                        } else {
                            $('#id_jenistps').removeClass('is-invalid');
                            $('#feedid_jenistps').html("");
                        }
                        if (response.error.telp) {
                            $('#telp').addClass('is-invalid');
                            $('#feedtelp').html(response.error.telp);
                        } else {
                            $('#telp').removeClass('is-invalid');
                            $('#feedtelp').html("");
                        }
                        if (response.error.gambar) {
                            $('#gambar').addClass('is-invalid');
                            $('#feedgambar').append(response.error.gambar);
                        } else {
                            $('#gambar').removeClass('is-invalid');
                            $('#feedgambar').html("");
                        }
                        if (response.error.lat) {
                            $('#lat').addClass('is-invalid');
                            $('#feedlat').html(response.error.lat);
                        } else {
                            $('#lat').removeClass('is-invalid');
                            $('#feedlat').html("");
                        }
                        if (response.error.lng) {
                            $('#lng').addClass('is-invalid');
                            $('#feedlng').html(response.error.lng);
                        } else {
                            $('#lng').removeClass('is-invalid');
                            $('#feedlng').html("");
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