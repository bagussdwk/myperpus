<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container">
            <div class="card">
                <div class="card-header text-center">
                    <?= $appName; ?> Books
                </div>
                <div class="row my-4">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-3 my-4">
                        <img src="<?= base_url('img/buku/'); ?><?= $book->gambar; ?>" class="shadow-lg" width="100%" height="350" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                        <title><?= $book->judul; ?></title>
                        </img>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h3 class="title-card"><?= $book->judul; ?></h3>
                            <p class="card-text">by : <?= $book->pengarang; ?></p>
                            <p class="card-text text-justify"><?= $book->sinopsis; ?></p>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="w-25"><strong>Penerbit</strong></td>
                                        <td><?= $book->nama_penerbit; ?></td>

                                        <td><strong>Halaman</strong></td>
                                        <td><?= $book->jumlah_halaman; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kategori</strong></td>
                                        <td><?= $book->nama_kategori; ?></td>

                                        <td><strong>Tahun Terbit</strong></td>
                                        <td><?= $book->tahun_terbit; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>ISBN</strong></td>
                                        <td><?= $book->isbn; ?></td>

                                        <td><strong>Stok Buku</strong></td>
                                        <td><?= $book->jumlah_stok; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php if (user()->username == 'admin') : ?>
                            <?php else : ?>
                                <div class="button my-2">
                                    <a href="#" class="btn btn-primary">Tambahkan ke Baca Nanti</a>
                                    <a href="<?= base_url('user/peminjaman'); ?>" class="btn btn-success">Mulai Peminjaman</a>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="col-sm-1">
                    </div>
                </div>

            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection(); ?>