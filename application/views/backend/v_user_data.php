<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div id="form-info"></div>
        <div class="col-lg-12">
            <!-- Basic Card Example -->
            <form role="form" method="post" id="submit-form" action="<?= base_url(isset($pengguna['id_user']) ? 'admin/pengguna/update/' . encode($pengguna['id_user']) : 'admin/pengguna/save') ?>">
                <?= csrf_field("csrf_protection"); ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Formulir
                            <a href="<?= base_url('admin/pengguna/'); ?>" class="btn btn-warning float-right"> Kembali</a>
                        </h6>

                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= isset($pengguna['nama']) ? $pengguna['nama'] : ""; ?>">
                            <div class="invalid-feedback" id="feednama"></div>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" id="username" name="username" <?= isset($pengguna['username']) ? 'readonly' : ''; ?> value="<?= isset($pengguna['username']) ? $pengguna['username'] : ""; ?>">
                            <div class="invalid-feedback" id="feedusername"></div>
                        </div>
                        <div class="form-group">
                            <label>Role Akses</label>
                            <select id="role" name="role" class="custom-select">
                                <option value="">Pilih</option>
                                <?php
                                foreach (role_akses() as $key => $value) {
                                    $s = isset($pengguna['role']) ? ($pengguna['role'] == $value ? "selected" : "") : "";

                                    echo "<option value='$value' $s>" . ucfirst($value) . "</option>";
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback" id="feedrole"></div>
                        </div>
                        <?= isset($pengguna['password']) ? '<div class="alert alert-danger">Kosongkan jika tidak ingin merubah password</div>' : ''; ?>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="invalid-feedback" id="feedpassword"></div>
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password2" name="password2">
                            <div class="invalid-feedback" id="feedpassword2"></div>
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
                        if (response.error.nama) {
                            $('#nama').addClass('is-invalid');
                            $('#feednama').html(response.error.nama);
                        } else {
                            $('#nama').removeClass('is-invalid');
                            $('#feednama').html("");
                        }
                        if (response.error.username) {
                            $('#username').addClass('is-invalid');
                            $('#feedusername').html(response.error.username);
                        } else {
                            $('#username').removeClass('is-invalid');
                            $('#feedusername').html("");
                        }
                        if (response.error.password) {
                            $('#password').addClass('is-invalid');
                            $('#feedpassword').html(response.error.password);
                        } else {
                            $('#password').removeClass('is-invalid');
                            $('#feedpassword').html("");
                        }
                        if (response.error.password2) {
                            $('#password2').addClass('is-invalid');
                            $('#feedpassword2').html(response.error.password2);
                        } else {
                            $('#password2').removeClass('is-invalid');
                            $('#feedpassword2').html("");
                        }
                        if (response.error.role) {
                            $('#role').addClass('is-invalid');
                            $('#feedrole').html(response.error.role);
                        } else {
                            $('#role').removeClass('is-invalid');
                            $('#feedrole').html("");
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