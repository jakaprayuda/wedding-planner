<?= $this->extend('layout/template'); ?>

<?= $this->Section('content'); ?>
<section>
    <div class="container">
        <form action="<?= base_url('Pages/'); ?>" method="POST">
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="bukti" class="form-label">Upload Bukti :</label>
                        <input type="file" class="form-control" id="bukti" name="bukti" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" title="Save">Submit</button>
        </form>
</section>

<?= $this->endSection(); ?>