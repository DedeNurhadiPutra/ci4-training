<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2>Form Ubah Data Anime</h2>

            <form action="/anime/update/<?= $anime['id']; ?>" method="POST">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $anime['slug']; ?>">
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= (old('judul')) ? old('judul') : $anime['judul'] ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('judul'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" autofocus value="<?= (old('penulis')) ? old('penulis') : $anime['penulis'] ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('penulis'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="sampul" name="sampul" value="<?= (old('sampul')) ? old('sampul') : $anime['sampul'] ?>">
                    </div>
                </div>
                <div class=" row mb-3">
                    <label for="rating" class="col-sm-2 col-form-label">Rating</label>
                    <div class="col-sm-10">
                        <input type="string" class="form-control" id="rating" name="rating" value="<?= (old('rating')) ? old('rating') : $anime['rating'] ?>">
                    </div>
                </div>
        </div>
    </div>
    <button type=" submit" class="btn btn-primary">Ubah Data</button>
    </form>
</div>
</div>
</div>
<?= $this->endSection(); ?>