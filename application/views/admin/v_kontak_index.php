<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th width="35%">Pesan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($kontak)) {
                            $baseurl = base_url("admin/kontak");
                            $no = 1;
                            foreach ($kontak as $key => $value) {
                                $id = encode($value['id_kontak']);
                                echo "<tr>";
                                echo "<td>$no</td>";
                                echo "<td>$value[nama]</td>";
                                echo "<td>$value[email]</td>";
                                echo "<td>$value[pesan]</td>";
                                echo "<td class='text-center'>";
                                echo "<a href='javascript:void(0)' data-id='" . encode($value['id_kontak']) . "' class='btn btn-danger btn-sm mx-1 my-1 btn-delete'><i class='fas fa-trash'></i></a>";
                                echo "</td>";
                                echo "</tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>Belum ada data..!</td></tr>";
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
<script>
    $(document).ready(function() {
        const baseurl = "<?= base_url("admin/kontak/delete"); ?>";
        $(".btn-delete").click(function(e) {
            e.preventDefault();
            let id = $(this).data("id");

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
                        url: baseurl + '/' + id,
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