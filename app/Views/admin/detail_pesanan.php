<?= $this->extend('layout/Admin_layout'); ?>

<?= $this->Section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Pesanan</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/paket/<?= $paket->gambar; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><b><?= $paket->plh_paket; ?></b></h5>
                            <p class="card-text"><b>Nama Pemesan : </b> <?= $pesanan->Nama; ?></p>
                            <p class="card-text"><b>Tgl Booking : </b> <?= $pesanan->tgl_booking; ?></p>
                            <p class="card-text"><b>Down Payment : </b>Rp. <?php echo number_format($paket->DP, 0, ',', '.') ?></p>
                            <p class="card-text"><b>Telepon : </b> <?= $pesanan->Telepon; ?></p>
                            <p class="card-text"><b>Alamat : </b> <?= $pesanan->Alamat; ?></p>
                            <p class="card-text"><b>Sisa Bayar : </b>Rp. <?php echo number_format($paket->harga - $paket->DP, 0, ',', '.') ?></p>

                            <a href="/C_admin/pesanan" class="btn btn-warning"><i class="bi bi-arrow-return-left"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>