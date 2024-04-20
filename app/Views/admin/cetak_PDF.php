<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
    <style>
        .border-table {
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 12px;
        }

        .border-table th {
            border: 1 solid #000;
            font-weight: bold;
        }

        .border-table td {
            border: 1 solid #000;

        }

        .hr {
            border: 0;
            border-style: unset;
            border-top: 1px solid #000;

        }
    </style>
</head>

<body>
    <img src="/img/LambangCover.png" alt="" style="position: absolute; width: 60px; height: auto;">
    <table style="width : 100%;">
        <tr>
            <td align="center">
                <span style="line-height: 1.6; font-weight: bold;">Syarif Wedding Project</span>
            </td>
        </tr>
        <tr>
            <td align="center">Jl.Antapani Lama No.25</td>
        </tr>
        <tr>
            <td align="center">Kota Bandung, Jawa Barat 40291</td>
        </tr>
    </table>
    <br><br>
    <hr class="line-title">
    <center>
        <h3>Laporan Data Pesanan</h3>
    </center>
    <table class="border-table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pemesan</th>
                <th scope="col">Nomer Telepon</th>
                <th scope="col">Tgl Booking</th>
                <th scope="col">Paket</th>
                <th scope="col">Down Payment</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($Pesanan as $key => $value) : ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td><?= $value->Nama ?></td>
                    <td><?= $value->Telepon ?></td>
                    <td><?= $value->tgl_booking ?></td>
                    <td><?= $value->plh_paket ?></td>
                    <td><?php echo number_format($value->DP, 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            <tr style="font-weight: bold;">
                <td colspan="5">Total Pemasukan :</td>
                <td><?php echo number_format($total[0]->total_bayar, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>

    <!-- jquery -->
    <script class="u-script" type="text/javascript" src="<?= base_url('js/jquery.min.js') ?>"></script>
    <script class="u-script" type="text/javascript" src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
</body>

</html>