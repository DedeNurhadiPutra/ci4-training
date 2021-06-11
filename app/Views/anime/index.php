<<?= $this->extend('layout/template'); ?> <<?= $this->section('content'); ?> <div class="container">
    <div class="row">
        <div class="col">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success position-relative top-0 start-50 translate-middle-x" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif ?>
            <h1 class="mt-2">List Anime</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($anime as $an) : ?> <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $an['sampul']; ?>" alt="sampul" class="sampul"></td>
                            <td><?= $an['judul']; ?></td>
                            <td>
                                <a href="/anime/<?= $an['slug']; ?>" class="btn btn-success">Klik Disini</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <a href="anime/create" class="btn btn-primary my-5 position-relative top-0 start-50 translate-middle-x">Tambah Anime</a>
        </div>
    </div>
    </div>

    <?= $this->endSection(); ?>