<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2>Form Tambah Data Anime</h2>
            <form action="/anime/save" method="POST">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="judul" name="judul" autofocus>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="penulis" name="penulis">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="sampul" name="sampul">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="rating" class="col-sm-2 col-form-label">Rating</label>
                    <div class="col-sm-10">
                        <input type="string" class="form-control" id="rating" name="rating">
                    </div>
                </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Tambah Data</button>
    </form>
</div>
</div>
</div>
<?= $this->endSection(); ?>