<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen</title>
    <style>
        body {
            margin: 20px 100px;
        }

        .hr {
            border: 0;
            border-style: unset;
            border-top: 1px solid #000;

        }

        .tabel-style {
            border-collapse: collapse;
        }

        .tabel-style td {
            padding: 20px;
        }
    </style>
</head>

<body onload="window.print()">
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
        <h3>Reservasi</h3>
    </center>
    <table class="tabel-style">
        <tr>
            <td>Nama Pemesan</td>
            <td>:</td>
            <td><?php echo $pesanan->Nama; ?></td>
        </tr>
        <tr>
            <td>Paket</td>
            <td>:</td>
            <td><?php echo $paket->plh_paket; ?></td>
        </tr>
        <tr>
            <td>Harga</td>
            <td>:</td>
            <td><?php echo $paket->harga; ?></td>
        </tr>
        <tr>
            <td>Tanggal Booking</td>
            <td>:</td>
            <td><?php echo $pesanan->tgl_booking; ?></td>
        </tr>
        <tr>
            <td>Down Payment</td>
            <td>:</td>
            <td><?php echo $paket->DP; ?></td>
        </tr>
    </table>

</body>

</html>