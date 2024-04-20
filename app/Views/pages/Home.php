<?= $this->extend('layout/template'); ?>

<?= $this->Section('content'); ?>
<section class="u-align-left u-clearfix u-image u-shading u-typography-custom-page-typography-8--Introduction u-section-1" src="" id="sec-de75" data-image-width="1067" data-image-height="1600">
    <div class="u-clearfix u-sheet u-sheet-1">
        <h1 class="u-custom-font u-font-raleway u-text u-text-default u-text-white u-text-1">Syarif Wedding Project</h1>
        <div class="u-border-4 u-border-palette-3-base u-line u-line-horizontal u-line-1"></div>
        <a href="/Pages/booking" class="u-border-none u-btn u-btn-round u-button-style u-custom u-palette-2-base u-radius-50 u-btn-1">book now</a>
    </div>
</section>
<section>
    <div class="three_box">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="box_text">
                        <h3>Login</h3>
                        <i><img src="/img/user.png" alt="#" style="width: 60px; height: 60px;" /></i>
                        <p>Lakukan login akun untuk memesan paket SWP.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box_text">
                        <h3>Pesan</h3>
                        <i><img src="/img/kalender.png" alt="#" style="width: 60px; height: 60px;" /></i>
                        <p>Klik tombol "Book Now", isi seluruh form pemesanan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box_text">
                        <h3>Bayar</h3>
                        <i><img src="/img/cek.png" alt="#" style="width: 60px; height: 60px;" /></i>
                        <p>Transfer Bank, Lakukan upload bukti Transfer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <small style="color:red">*Catatan*<br> Pembayaran hanya lewat Tranfer Bank, Waktu Pembayaran 1 X 24 Jam.</small>
    </div>
</section>


<?= $this->endSection(); ?>