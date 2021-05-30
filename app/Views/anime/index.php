<<?= $this->extend('layout/template'); ?> <<?= $this->section('content'); ?> <div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">List Anime</h1>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Episode</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Dragon Ball</td>
                        <td>9</td>
                        <td>1300+-</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Naruto</td>
                        <td>9.5</td>
                        <td>1200+-</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>One Piece</td>
                        <td>10</td>
                        <td>976</td>
                    </tr>
                    <tr>
                        <th scope="row">34</th>
                        <td>Boku No Pico</td>
                        <td>999999999999999</td>
                        <td>999999999999999</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <?= $this->endSection(); ?>