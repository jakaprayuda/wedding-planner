<?= $this->extend('layout/Admin_layout'); ?>

<?= $this->Section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="text-center">List Confirm</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table" style="text-align:center">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Down Payment</th>
                        <th scope="col">Create</th>
                        <th scope="col">bukti</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($Pesanan as $key => $value) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?php echo number_format($value->DP, 0, ',', '.') ?></td>
                            <td><?= $value->created_at ?></td>
                            <td>
                                <a href="/img/upload/<?= $value->bukti ?>" target="_blank">
                                    <img src="/img/upload/<?= $value->bukti ?>" alt="" width="100">
                                </a>
                            </td>
                            <td>
                                <?php
                                if ($value->status == 1) {
                                    echo '<a href="javascript.void(0);" data-toggle="modal" data-target="#modal-pesanan" id="select_pesanan" 
                                    data-id_pesanan ="' . $value->Id_pesanan . '"
                                    data-status ="' . $value->status . '"
                                    class="btn btn-success">
                                    confirm
                                    </a>';
                                }
                                ?>
                                <?php {
                                    echo '<a href="javascript.void(0);" data-toggle="modal" data-target="#delete" id="hapus" 
                                        data-id_transaksi ="' . $value->Id_transaksi . '"
                                        data-pesanan ="' . $value->Id_pesanan . '"
                                    class="btn btn-danger">
                                   Batalkan
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

<!-- konfirmasi Modal-->
<div class="modal fade" id="modal-pesanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Pesanan ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="/C_admin/konfirmasi" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body" style="text-align: center;">
                    <div class="form-group">
                        <input type="hidden" name="id_pesanan" id="id_pesanan" class="form-control">
                        <input type="hidden" name="status" value="2" class="form-control">
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" title="Save">Submit</button>
                </div>
            </form>
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
            <form action="/C_admin/delete_konfirmasi" method="POST" enctype="multipart/form-data">
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

<!-- konfirmasi -->
<script>
    $(document).ready(function() {
        $(document).on('click', '#select_pesanan', function() {
            var id_pesanan = $(this).data('id_pesanan')
            var status = $(this).data('status')

            $('#id_pesanan').val(id_pesanan)
            $('#status').val(status)
        })
    })
</script>

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