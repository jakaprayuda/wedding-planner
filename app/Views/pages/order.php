<?= $this->extend('layout/template'); ?>

<?= $this->Section('content'); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-center">List Booking</h2>
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>
                <?php foreach ($requested as $key => $u) : ?>
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="/img/paket/<?= $u->gambar; ?>" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><b><?= $u->plh_paket; ?></b></h5>
                                    <table>
                                        <?php $i = 1; ?>
                                        <tr>
                                            <td>
                                                <b>Reservasi</b>
                                            </td>
                                            <td>:</td>
                                            <td><?= $u->tgl_booking; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b>Price Package</b>
                                            </td>
                                            <td>:</td>
                                            <td>Rp. <?php echo number_format($u->harga, 0, ',', '.') ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b>DownPayment</b>
                                            </td>
                                            <td>:</td>
                                            <td>Rp. <?php echo number_format($u->DP, 0, ',', '.') ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b>Status</b>
                                            </td>
                                            <td>:</td>
                                            <td>
                                                <?php if ($u->status == 1) { ?>
                                                    <span class="badge badge-warning text-dark">Waiting...</span>
                                                <?php } else if ($u->status == 2) { ?>
                                                    <span class="badge badge-success text-dark">success</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b>Transfer Bank</b>
                                            </td>
                                            <td></td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        BCA
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <!--<a class="btn btn-info" data-toggle="modal" data-target="#modal-pesanan" id="view" data-name="<?= $u->Nama ?>" data-plh_paket="<?= $u->plh_paket ?>" data-harga="<?= $u->harga ?>" data-tgl_booking="<?= $u->tgl_booking ?>" data-dp="<?= $u->DP ?>" data-akun_bank="<?= $u->akun_bank ?>"><i class="bi bi-eye"></i></a>-->
                                                <form action="/Pages/downloadPDF" method="POST" class="d-inline" target="_blank">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" value="<?= $u->Id_pesanan; ?>" name="id_pesanan">
                                                    <input type="hidden" value="<?= $u->Id_transaksi; ?>" name="id_transaksi">
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-download"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                                <?php
                                                if ($u->bukti == NULL) {
                                                    echo '<a href="javascript.void(0);" data-toggle="modal" data-target="#upload" id="upload-gambar" 
                                    data-transaksi ="' . $u->Id_transaksi . '"
                                    data-dp ="' . $u->DP . '"
                                    data-rekening ="' . $u->akun_bank . '"
                                    data-bukti ="' . $u->bukti . '"
                                    class="btn btn-warning">
                                    Bayar
                                    </a>';
                                                }
                                                ?>
                                                <?php
                                                if ($u->bukti == NULL) {
                                                    echo '<a href="javascript.void(0);" data-toggle="modal" data-target="#delete" id="hapus" 
                                        data-id_transaksi ="' . $u->Id_transaksi . '"
                                        data-id_pesanan ="' . $u->Id_pesanan . '"
                                        data-bukti ="' . $u->bukti . '""
                                    class="btn btn-danger">
                                   Batalkan
                                    </a>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- delete Modal-->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="/Pages/delete" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_transaksi" id="id_transaksi">
                    <input type="hidden" name="id_pesanan" id="id_pesanan">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" title="Save">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- upload Modal-->
<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Bukti</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="/Pages/upload" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_transaksi" id="transaksi">
                    <table>
                        <tr>
                            <td><b>Total Bayar :</b> <span id="dp"></span></td>
                        </tr>
                    </table>
                    <label for="no.rekening" class="form-label">Nomer Rekening :</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="rekening" name="akun_bank" readonly>
                        <button class="btn btn-outline-secondary" type="button" onclick="copy_text()"><i class="bi bi-clipboard"></i></button>
                    </div>
                    <small>
                        <font color="blue">*Bayar transaksi sesuai Total bayar*</font>
                    </small>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Masukan Gambar</label>
                        <div class="col-sm-4">
                            <img src="/img/default-image.jpg" alt="" class="img-thumbnail img-preview">
                        </div>
                        <div class="custom-file">
                            <input class="custom-file-input <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" type="file" id="gambar" name="gambar" onchange="previewImage()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('gambar'); ?>
                            </div>
                            <label for="gambar" class="custom-file-label">pilih gambar ....</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" title="Save">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- js ambil data modal upload-->
<script>
    $(document).ready(function() {
        $(document).on('click', '#upload-gambar', function() {
            var transaksi = $(this).data('transaksi')
            var dp = $(this).data('dp')
            var rekening = $(this).data('rekening')
            var bukti = $(this).data('bukti')

            $('#transaksi').val(transaksi)
            $('#dp').text(dp)
            $('#rekening').val(rekening)
            $('#bukti').val(bukti)
        })
    })
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

<!-- js ambil data hapus-->
<script>
    $(document).ready(function() {
        $(document).on('click', '#hapus', function() {
            var id_transaksi = $(this).data('id_transaksi')
            var id_pesanan = $(this).data('id_pesanan')
            var bukti = $(this).data('bukti')

            $('#id_transaksi').val(id_transaksi)
            $('#id_pesanan').val(id_pesanan)
            $('#bukti').val(bukti)
        })
    })
</script>

<!-- copy text -->
<script type="text/javascript">
    function copy_text() {
        document.getElementById("rekening").select();
        document.execCommand("copy");
        alert("Text berhasil dicopy");
    }
</script>

<?= $this->endSection(); ?>