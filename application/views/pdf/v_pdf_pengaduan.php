<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?= base_url("assets/css/tabel.css"); ?>">
    <meta name="author" content="Van" />
    <style>
        body,
        p,
        h3,
        h4,
        h1 h2 {
            font-family: "Times New Roman", serif;
        }

        .garis {
            height: 2px;
            background-color: #000;
            margin-bottom: 0px;
            margin-top: 10px;
        }

        hr {
            height: 0.5px;
            background-color: #000;
            margin-top: 5px;
        }

        p {
            margin: 0 0 0 0;
            padding: 0 0 0 0;
        }

        .left {
            text-align: left
        }

        .right {
            text-align: right
        }

        .center {
            text-align: center
        }

        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto auto;
            grid-gap: 10px;
            padding: 10px;
            text-align: center;
        }

        .grid-container>div {
            text-align: center;
            padding: 20px 0;
        }

        .item1 {
            grid-row: 1 / span 2;
        }

        .mb-5 {
            margin-bottom: 20px;
        }

        .img-thumbnail {
            width: 100px;
            display: block;
            margin: 0 auto;
        }

        /* .container {
            padding-left: 30px;
            padding-right: 30px;
        } */
    </style>

</head>

<body style="font-family: 'Times New Roman',serif; ">

    <div class="left" style="margin-top: 20px;">
        <h3 align="center" class="mb-5"><b><u><?= $title; ?></u></b></h3>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Waktu Pelaporan</th>
                <th scope="col">Kode Pasien</th>
                <th scope="col">Data Pasien</th>
                <th scope="col">Isi Pengaduan</th>
                <th scope="col">Status Pengaduan</th>
            </tr>
        </thead>
        <?php
        if (!empty($data)) {
            $no = 1;
            foreach ($data as $key => $value) {
                echo "<tr>";
                echo "<td>$no</td>";
                echo "<td>" . tgl_jam_indo($value['tgl_pengaduan']) . "</td>";
                echo "<td>$value[kode_pasien]</td>";
                echo "<td><b>Nama:</b> $value[nama_pasien] <br/> <b>Jenis Kelamin:</b> $value[jenis_kelamin] <br/> <b>Alamat:</b> $value[alamat] <br/> <b>Telp:</b> $value[telp]</td>";
                echo "<td>$value[pengaduan]</td>";
                echo "<td>" . status_pengaduan($value['status']) . "</td>";
                echo "</tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='5' class='text-center'>Belum ada data..!</td></tr>";
        }
        ?>
    </table>
</body>

</html>