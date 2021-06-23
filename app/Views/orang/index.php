<<?= $this->extend('layout/template'); ?> <<?= $this->section('content'); ?> <div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">Daftar Orang</h1>
            <form action="" method="GET">
                <div class="row">
                    <div class="col-md-4 offset-md-8">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Masukan nama.." aria-label="Recipient's username" aria-describedby="button-addon2" name="keyword">
                            <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                        </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                    <?php foreach ($orang as $o) : ?> <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $o['nama']; ?></td>
                            <td><?= $o['alamat']; ?></td>
                            <td>
                                <a href="" class="btn btn-success">Klik Disini</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <?= $pager->links('orang', 'orang_pagination'); ?>
        </div>
        </>
    </div>

    <?= $this->endSection(); ?>