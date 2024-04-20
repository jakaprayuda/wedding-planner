<?= $this->extend('layout/template'); ?>

<?= $this->Section('content'); ?>
<section>
    <div class="container">
        <h1 class="text-center">Form Booking</h1>
        <form action="<?= base_url('Pages/simpan'); ?>" method="POST">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name :</label>
                        <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="" name="nama" placeholder="Name" value="<?= session()->get('nama_user') ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Package :</label>
                        <select class="form-select <?= ($validation->hasError('paket')) ? 'is-invalid' : ''; ?>" aria-label=" Default select example" name="paket" id="">
                            <option selected disabled></option>
                            <?php foreach ($paket as $key => $u) : ?>
                                <option value="<?= $u->id_paket ?>"><?= $u->plh_paket ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('paket'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">booking date :</label>
                        <?php date_default_timezone_set('Asia/Jakarta'); ?>
                        <input onchange="pilih_tanggal(this.value)" type="date" class="form-control <?= ($validation->hasError('date')) ? 'is-invalid' : ''; ?>" name="date" id="" min="<?= date("Y-m-d"); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('date'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Phone :</label>
                        <input type="text" class="form-control <?= ($validation->hasError('phone')) ? 'is-invalid' : ''; ?>" name="phone" id="" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                        <div class="invalid-feedback">
                            <?= $validation->getError('phone'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                        <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" name=" alamat" id="" rows="3"></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                    <input type="hidden" name="status" id="status" value="1" readonly required>
                    <input type="hidden" name="bank" id="bank" value="1560204716" readonly required>
                    <button type="submit" class="btn btn-primary" title="Save">Submit</button>
                    <button type="reset" class="btn btn-danger" title="Reset">Reset</button>
        </form>
    </div>
    </div>


    </div>
</section>
<script>
    function pakets() {
        var paket = $('#paket').val();
        if (paket == '1') {
            $('#price').val('1.500.000');
        } else if (paket == '2') {
            $('#price').val('3.000.000');
        } else if (paket == '3') {
            $('#price').val('3.500.000');
        }
    }
</script>
<?= $this->endSection(); ?>