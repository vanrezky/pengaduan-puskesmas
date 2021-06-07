<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div id="form-info"></div>
        <div class="col-lg-7 col-12">
            <!-- Basic Card Example -->
            <form role="form" method="post" id="submit-form" action="<?= base_url(isset($data['id']) ? "backend/pasien/update/" . encode($data['id']) : "backend/pasien/save") ?>">
                <?= csrf_field("csrf_protection"); ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Formulir Pasien
                            <a href="<?= base_url('backend/pasien'); ?>" class="btn btn-warning float-right"> Kembali</a>
                        </h6>

                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Kode Pasien</label>
                            <input type="text" class="form-control" id="kode_pasien" name="kode_pasien" value="<?= isset($data['kode_pasien']) ? $data['kode_pasien'] : ""; ?>">
                            <div class="invalid-feedback" id="feedkode_pasien"></div>
                        </div>
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input class="form-control" name="nama_pasien" id="nama_pasien" value="<?= isset($data['nama_pasien']) ? $data['nama_pasien'] : ""; ?>">
                            <div class="invalid-feedback" id="feednama_pasien"></div>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="custom-select">
                                <option value="">Pilih</option>
                                <?php
                                foreach (getJenisKelamin() as $key => $value) {
                                    $s = isset($data['jenis_kelamin']) ? ($data['jenis_kelamin'] == $value ? "selected" : "") : "";

                                    echo "<option value='$value' $s>$value</option>";
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback" id="feedjenis_kelamin"></div>
                        </div>
                        <div class="form-group">
                            <label>Telp</label>
                            <input type="text" class="form-control" id="telp" name="telp" value="<?= isset($data['telp']) ? $data['telp'] : ""; ?>">
                            <div class="invalid-feedback" id="feedtelp"></div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" rows="4" id="alamat"><?= isset($data['alamat']) ? $data['alamat'] : ""; ?></textarea>
                            <div class="invalid-feedback" id="feedalamat"></div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= isset($data['email']) ? $data['email'] : ""; ?>">
                            <div class="invalid-feedback" id="feedemail"></div>
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
<script>
    $(document).ready(function() {

        $("#btn-edit").click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            alert(id);
            $.ajax({
                type: "get",
                url: "<?= base_url('admin/datauser/edit'); ?>" + id,
                data: "data",
                dataType: "dataType",
                success: function(response) {
                    $(".tampil-edit").empty().append(response);

                    $(".modal-edit").show();
                }
            });
        });
    });
</script>

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
                        if (response.error.kode_pasien) {
                            $('#kode_pasien').addClass('is-invalid');
                            $('#feedkode_pasien').html(response.error.kode_pasien);
                        } else {
                            $('#kode_pasien').removeClass('is-invalid');
                            $('#feedkode_pasien').html("");
                        }
                        if (response.error.nama_pasien) {
                            $('#nama_pasien').addClass('is-invalid');
                            $('#feednama_pasien').html(response.error.nama_pasien);
                        } else {
                            $('#nama_pasien').removeClass('is-invalid');
                            $('#feednama_pasien').html("");
                        }
                        if (response.error.alamat) {
                            $('#alamat').addClass('is-invalid');
                            $('#feedalamat').html(response.error.alamat);
                        } else {
                            $('#alamat').removeClass('is-invalid');
                            $('#feedalamat').html("");
                        }
                        if (response.error.jenis_kelamin) {
                            $('#jenis_kelamin').addClass('is-invalid');
                            $('#feedjenis_kelamin').html(response.error.jenis_kelamin);
                        } else {
                            $('#jenis_kelamin').removeClass('is-invalid');
                            $('#feedjenis_kelamin').html("");
                        }
                        if (response.error.telp) {
                            $('#telp').addClass('is-invalid');
                            $('#feedtelp').html(response.error.telp);
                        } else {
                            $('#telp').removeClass('is-invalid');
                            $('#feedtelp').html("");
                        }
                        if (response.error.email) {
                            $('#email').addClass('is-invalid');
                            $('#feedemail').html(response.error.email);
                        } else {
                            $('#email').removeClass('is-invalid');
                            $('#feedemail').html("");
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