<?= $this->extend('layout/Admin_layout'); ?>

<?= $this->Section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="text-center">List Booking</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <div class="card mt-4">
                <div class="row">
                    <?php
                    helper('form');
                    ?>
                    <?php
                    $keyword = [
                        'name' => 'keyword',
                        'value' => $keyword,
                        'placeholder' => 'Search Booking...'
                    ];

                    $submit = [
                        'name' => 'submit',
                        'value' => 'cari',
                        'type' => 'submit'
                    ];
                    ?>
                    <div class="col card-header py-2">
                        <?php echo form_open('/C_admin/pesanan', ['class' => 'form-inline']) ?>
                        <div>
                            <?= form_input($keyword) ?>
                        </div>
                        <div>
                            <?= form_submit($submit) ?>
                        </div>
                        <?= form_close() ?>
                    </div>
                    <div class="col card-header text-right">
                        <a target="_blank" href="/export-pdf" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Report</a>
                    </div>
                </div>
            </div>
            <table class="table" style="text-align:center">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tgl Booking</th>
                        <th scope="col">Paket</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($pesanan as $key => $value) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $value->Nama ?></td>
                            <td><?= $value->tgl_booking ?></td>
                            <td><?= $value->plh_paket ?></td>
                            <td>
                                <a class="btn btn-info" href="/C_admin/detail/<?= $value->Id_pesanan; ?>"><i class="bi bi-eye"></i></a>
                                <a target="_blank" href="/C_admin/cetakID/<?= $value->Id_pesanan; ?>" class="btn btn-primary"><i class="fas fa-download"></i></a>
                                <?php {
                                    echo '<a href="javascript.void(0);" data-toggle="modal" data-target="#delete" id="hapus" 
                                        data-id_transaksi ="' . $value->Id_transaksi . '"
                                        data-pesanan ="' . $value->Id_pesanan . '"
                                    class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                    </a>';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

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
            <form action="/C_admin/delete_pesanan" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_transaksi" id="id_transaksi">
                    <input type="hidden" name="id_pesanan" id="pesanan">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" title="Save">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- js ambil data hapus-->
<script>
    $(document).ready(function() {
        $(document).on('click', '#hapus', function() {
            var id_transaksi = $(this).data('id_transaksi')
            var pesanan = $(this).data('pesanan')

            $('#id_transaksi').val(id_transaksi)
            $('#pesanan').val(pesanan)
        })
    })
</script>


<?= $this->endSection(); ?>