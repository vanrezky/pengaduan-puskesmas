<section class="breadcrumb_area">
    <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
    <div class="container">
        <div class="page-cover text-center">
            <h2 class="page-cover-tittle"><?= $title; ?></h2>
            <ol class="breadcrumb">
                <li><a href="<?= base_url(); ?>">Home</a></li>
                <li class="active"><?= $title; ?></li>
            </ol>
        </div>
    </div>
</section>
<section class="about_history_area section_gap">
    <div class="container">
        <div class="info-pasien"></div>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form class="row contact_form" action="<?= base_url("pengaduan/save"); ?>" method="post" id="submit-form">
                    <?= csrf_field("csrf_protection"); ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="kode_pasien">Kode Pasien</label>
                            <input type="text" class="form-control" id="kode_pasien" name="kode_pasien" required placeholder="Kode Pasien">
                        </div>
                        <div class="data-pasien"></div>
                        <div class="form-group">
                            <label for="id_kategori">Kategori Pengaduan</label>
                            <div class="form-select" id="default-select">
                                <select class="form-control" id="id_kategori" name="id_kategori">
                                    <option value="">Pilih Kategori Pengaduan</option>
                                    <?php
                                    foreach ($kategori as $key => $value) {
                                        echo "<option value='$value[id]'>$value[nama_kategori]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kode_pasien">Isi Pengaduan</label>
                            <textarea class="form-control" id="pengaduan" name="pengaduan" required placeholder="Jelaskan Pengaduan Anda.."></textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit" value="submit" id="btn-submit" disabled class="btn theme_btn button_hover">Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<style>
    button:disabled {
        cursor: not-allowed !important;
        pointer-events: all !important;
    }
</style>

<script src="<?= base_url('assets/js/sweetalert2/sweetalert2.all.min.js'); ?>"></script>
<script>
    $(document).ready(function() {
        const baseurl = "<?= base_url(); ?>";
        $("#kode_pasien").on("input", function(e) {
            var dInput = this.value;


            $.ajax({
                type: "get",
                url: baseurl + "/pengaduan?pasien=" + dInput,
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $("#btn-submit").prop("disabled", false);
                        $(".info-pasien").empty().html(info_pasien(response.pesan, "success"));
                        $(".data-pasien").empty().html(data_pasien(response.data));
                    } else {
                        $("#btn-submit").prop("disabled", true);
                        $(".info-pasien").empty().html(info_pasien(response.pesan, "danger"));
                    }
                }
            });
        });

        $("#submit-form").submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).prop("action"),
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {

                    if (response.csrf) $("#csrf_protection").val(response.csrf);

                    Swal.fire("Sukses..!", response.pesan, "success").then(() => {
                        location.reload();
                    });

                }
            });
        });
    });

    function data_pasien(data) {
        $H = "";
        $H += "<table class='table table-bordered'>";
        $H += "<tbody>";
        $H += "<tr>";
        $H += "<td width='35%'>Nama</td>";
        $H += "<td width='3px'>:</td>";
        $H += "<td>" + data.nama_pasien + "</td>";
        $H += "</tr>";
        $H += "<tr>";
        $H += "<td>Jenis Kelamin</td>";
        $H += "<td >:</td>";
        $H += "<td>" + data.jenis_kelamin + "</td>";
        $H += "</tr>";
        $H += "<tr>";
        $H += "<td>Alamat</td>";
        $H += "<td >:</td>";
        $H += "<td>" + data.alamat + "</td>";
        $H += "</tr>";
        $H += "<tr>";
        $H += "<td>Telepon</td>";
        $H += "<td >:</td>";
        $H += "<td>" + data.telp + "</td>";
        $H += "</tr>";
        $H += "</tbody>";
        $H += "</table>";

        return $H;
    }

    function info_pasien(pesan, status = "danger") {

        return "<div class='alert alert-" + status + " text-center'>" + pesan + "</div>";
    }
</script>