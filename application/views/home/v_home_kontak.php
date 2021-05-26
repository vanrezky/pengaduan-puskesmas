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
        <h2 class="title title_color">Kontak / Kritik</h2>
        <div class="row">
            <div class="col-md-12">
                <form class="row contact_form" action="<?= base_url("kontak/save"); ?>" method="post" id="form-contact">
                    <?= csrf_field("csrf_protection"); ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nama" name="nama" required placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" required placeholder="Email">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control" name="pesan" id="pesan" rows="" placeholder="pesan"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <button type="submit" value="submit" class="btn theme_btn button_hover">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="<?= base_url('assets/js/sweetalert2/sweetalert2.all.min.js'); ?>"></script>
<script>
    $(document).ready(function() {
        $("#form-contact").submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).prop("action"),
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {

                    if (response.csrf) $("#csrf_protection").val(response.csrf);

                    if (response.success) {
                        Swal.fire("Sukses..!", response.pesan, "success").then(() => {
                            location.reload();
                        });
                    }

                }
            });
        });
    });
</script>