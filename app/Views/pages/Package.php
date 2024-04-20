<?= $this->extend('layout/template'); ?>

<?= $this->Section('content'); ?>
<section class="u-align-center u-clearfix u-palette-3-light-3 u-section-1paket" id="sec-2687">
    <div class="u-clearfix u-sheet u-sheet-1paket">
        <h1 class="u-custom-font u-font-raleway u-text u-text-default u-text-1paket">PACKAGES SWP</h1>
        <div class="u-expanded-width u-gallery u-layout-grid u-lightbox u-show-text-on-hover u-gallery-1paket">
            <div class="u-gallery-inner u-gallery-inner-1paket">
                <?php
                foreach ($paket as $key => $value) : ?>
                    <div class="u-border-2 u-border-grey-75 u-effect-fade u-gallery-item u-radius-2 u-shape-round u-gallery-item-1paket">
                        <div class="u-back-slide" data-image-width="899" data-image-height="1599">
                            <img class="u-back-image u-expanded" src="/img/paket/<?= $value->gambar ?>">
                        </div>
                        <div class="u-over-slide u-shading u-over-slide-1paket">
                            <h3 class="u-gallery-heading"><?= $value->plh_paket ?></h3>
                            <p class="u-gallery-text"><?= $value->harga ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>