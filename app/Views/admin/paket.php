<?= $this->extend('layout/Admin_layout'); ?>

<?= $this->Section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="text-center">List Package</h2>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('pesan1')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('pesan1'); ?>
                </div>
            <?php endif; ?>
            <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#insert_paket"><i class="fas fa-plus fa-sm text-white-50"></i> Data</a>
            <br><br>
            <table class="table" style="text-align: center;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Pic</th>
                        <th scope="col">Nama Paket</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php
                    foreach ($paket as $key => $value) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/paket/<?= $value->gambar ?>" alt="" width="100"></td>
                            <td><?= $value->plh_paket ?></td>
                            <td><?php echo number_format($value->harga, 0, ',', '.') ?></td>
                            <td>
                                <a class="btn btn-warning" href="/C_admin/edit_paket/<?= $value->id_paket; ?>"><i class="bi bi-pencil-fill"></i><a>
                                        <a class="btn btn-danger" href="/C_admin/delete_paket/<?= $value->id_paket ?>" onclick="return confirm('Apakah anda yakin?');"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Insert Modal-->
<div class="modal fade" id="insert_paket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add DATA</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('/C_admin/insert_paket') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="namapaket" class="form-label">Nama Paket</label>
                            <input type="text" class="form-control <?= ($validation->hasError('plh_paket')) ? 'is-invalid' : ''; ?>" id="" name="plh_paket" autofocus required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('plh_paket'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="hargapaket" class="form-label">Harga Paket</label>
                            <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="" name="harga" onkeypress="return event.charCode >= 48 && event.charCode <=57" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('harga'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Masukan Gambar</label>
                            <div class="col-sm-4">
                                <img src="/img/default-image.jpg" alt="" class="img-thumbnail img-preview">
                            </div>
                            <div class="custom-file">
                                <input class="custom-file-input <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" type="file" id="gambar" name="gambar" onchange="previewImage()" required>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('gambar'); ?>
                                </div>
                                <label for="gambar" class="custom-file-label">pilih gambar ....</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" title="Save">Submit</button>
                    <button type="reset" class="btn btn-danger" title="Reset">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- update Modal-->
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Paket</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="/C_admin/update_paket/" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_paket" id="id_paket">
                    <input type="hidden" name="gambarLama" id="gambarLama">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Paket</label>
                            <input type="text" class="form-control <?= ($validation->hasError('plh_paket')) ? 'is-invalid' : ''; ?>" id="plh_paket" name="plh_paket" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('plh_paket'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Harga Paket</label>
                            <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" required>
                            <div class="invalid-feedback">
                                <?= $validation->getError('harga'); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Masukan Gambar</label>
                            <div class="col-sm-4">
                                <img src="/img/upload/" alt="" class="img-thumbnail img-preview">
                            </div>
                            <div class="custom-file">
                                <input class="custom-file-input <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" type="file" id="gambar" name="gambar" onchange="previewImage()" required>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('gambar'); ?>
                                </div>
                                <label for="gambar" class="custom-file-label"></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" title="Save">Save</button>
                    </div>
            </form>
        </div>
    </div>
</div>

<!-- js ambil data update data modal -->
<script>
    $(document).ready(function() {
        $(document).on('click', '#edit', function() {
            var id_paket = $(this).data('id_paket')
            var plh_paket = $(this).data('plh_paket')
            var harga = $(this).data('harga')
            var gambar = $(this).data('gambar')

            $('#id_paket').val(id_paket)
            $('#plh_paket').val(plh_paket)
            $('#harga').val(harga)
            $('#gambar').val(gambar)
        })
    })
</script>

<!-- js format rupiah -->
<script>
    var rupiah1 = document.getElementById("rupiah1");
    rupiah1.addEventListener("keyup", function(e) {
        rupiah1.value = convertRupiah(this.value);
    });
    rupiah1.addEventListener('keydown', function(event) {
        return isNumberKey(event);
    });

    var rupiah2 = document.getElementById("rupiah2");
    rupiah2.addEventListener("keyup", function(e) {
        rupiah2.value = convertRupiah(this.value, "Rp. ");
    });
    rupiah2.addEventListener('keydown', function(event) {
        return isNumberKey(event);
    });

    function convertRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
    }

    function isNumberKey(evt) {
        key = evt.which || evt.keyCode;
        if (key != 188 // Comma
            &&
            key != 8 // Backspace
            &&
            key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
            &&
            (key < 48 || key > 57) // Non digit
        ) {
            evt.preventDefault();
            return;
        }
    }
</script>

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