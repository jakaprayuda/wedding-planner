<!-- Modal -->
<!--
    <?php foreach ($Pesanan as $key => $value) : ?>
        <div class="modal fade" id="detail<?= $value['Id_pesanan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel">Detail Booking</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="">
                            <tr>
                                <th>Name</th>
                                <td>:</td>
                                <td><?= $value['Nama']; ?></td>
                            </tr>
                            <tr>
                                <th>Package</th>
                                <td>:</td>
                                <td><?= $value['plh_paket']; ?></td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>:</td>
                                <td><?= $value['hrg_paket']; ?></td>
                            </tr>
                            <tr>
                                <th>Reserve</th>
                                <td>:</td>
                                <td><?= $value['tgl_booking']; ?></td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>:</td>
                                <td><?= $value['Telepon']; ?></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>:</td>
                                <td><?= $value['Alamat']; ?></td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td>:</td>
                                <td><?= $value['created_at']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cetak</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>-->