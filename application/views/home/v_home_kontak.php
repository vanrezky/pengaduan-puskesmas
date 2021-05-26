<div class="section-wrap gmap">
    <!-- SECTION -->
    <div class="section void">
        <!-- CONTACT ACTIONS -->
        <div class="contact-actions">
            <!-- CONTACT FORM -->
            <div class="contact-form">
                <h2 class="subsection-title">Kirim Pesan / Kritik</h2>
                <hr class="line-separator">
                <!-- FORM -->
                <form action="<?= base_url("kontak/save"); ?>" method="post" id="form-contact">
                    <?= csrf_field("csrf_protection"); ?>
                    <!-- FORM ROW -->
                    <div class="form-row">
                        <div class="half">
                            <label for="nama" class="rl-label">Nama</label>
                            <input type="text" id="nama" name="nama" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="half">
                            <label for="email" class="rl-label">Email</label>
                            <input type="text" id="email" name="email" placeholder="Email Valid.." required>
                        </div>
                    </div>
                    <!-- /FORM ROW -->

                    <!-- FORM ROW -->
                    <div class="form-row">
                        <label for="pesan" class="rl-label">Pesan</label>
                        <textarea id="pesan" name="pesan" placeholder="Tulis Pesan disini" required></textarea>
                    </div>
                    <!-- /FORM ROW -->

                    <!-- FORM ROW -->
                    <div class="form-row separated">
                        <button class="submit" id="btn-submit">Kirim Pesan</button>
                    </div>
                    <!-- /FORM ROW -->
                </form>
                <!-- /FORM -->
            </div>
            <!-- /CONTACT FORM -->
        </div>
        <!-- /CONTACT ACTIONS -->
    </div>
    <!-- /SECTION -->

    <!-- CONTACT MAP -->
    <div class="contact-map contact-images"></div>
    <!-- /CONTACT MAP -->
</div>
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