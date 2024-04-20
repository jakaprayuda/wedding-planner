<?= $this->extend('layout/Admin_layout'); ?>

<?= $this->Section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2 text-center">Update Paket</h2>
            <form action="/C_admin/update_paket/<?= $paket->id_paket ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="col-6">
                    <input type="hidden" name="gambarLama" value="<?= $paket->gambar ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Paket :</label>
                        <input type="text" class="form-control <?= ($validation->hasError('plh_paket')) ? 'is-invalid' : ''; ?>" id="" name="plh_paket" value="<?= $paket->plh_paket ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('plh_paket'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Harga Paket :</label>
                        <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="" name="harga" value="<?= $paket->harga ?>" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                        <div class="invalid-feedback">
                            <?= $validation->getError('harga'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Masukan Gambar :</label>
                        <div class="col-sm-4">
                            <img src="/img/paket/<?= $paket->gambar ?>" alt="" class="img-thumbnail img-preview">
                        </div>
                        <div class="custom-file">
                            <input class="custom-file-input <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" type="file" id="gambar" name="gambar" onchange="previewImage()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('gambar'); ?>
                            </div>
                            <label for="gambar" class="custom-file-label"><?= $paket->gambar ?></label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" title="Save">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- js preview upload image -->
<script>
    function previewImage() {

        const gambar = document.querySelector('#gambar');
        const gambarLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        gambarLabel.textContent = gambar.files[0].name;

        const fileGambar = new FileReader();
        fileGambar.readAsDataURL(gambar.files[0]);

        fileGambar.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

<?= $this->endSection(); ?>