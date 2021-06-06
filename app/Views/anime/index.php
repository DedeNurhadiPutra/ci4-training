<<?= $this->extend('layout/template'); ?> <<?= $this->section('content'); ?> <div class="container">
    <div class="row">
        <div class="col">
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
                            <td><img src="/img/<?= $an['sampul']; ?>" alt="son goku" class="sampul"></td>
                            <td><?= $an['judul']; ?></td>
                            <td>
                                <a href="" class="btn btn-success">Klik Disini</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <?= $this->endSection(); ?>