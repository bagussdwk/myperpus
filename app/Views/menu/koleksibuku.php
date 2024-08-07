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
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php if (in_groups('admin')) : ?>
                <div class="col-7 ml-3">
                    <a href="<?= base_url("admin/tambahbuku") ?>"><button type="button" class="btn btn-primary">Tambah Buku</button></a>
                </div>
            <?php else : ?>
                <div class="col-7 ml-3">
                </div>
            <?php endif; ?>
            <div class="col mr-3">
                <form action="" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search books" name="keyword">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" name="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Default box -->
        <div class="album py-3">
            <div class="container">
                <div class="row">
                    <?php
                    foreach ($buku as $key => $value) : ?>
                        <div class="col-md-2">
                            <div class="card mb-4 shadow-sm">
                                <?php if ($value['gambar'] == 'default.png') : ?>
                                    <img src="<?= base_url('img/buku/'); ?>default.png" class="bd-placeholder-img card-img-top" width="100%" height="250" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                                <?php else : ?>
                                    <img src="<?= base_url('img/buku/'); ?><?= $value['gambar']; ?>" class="bd-placeholder-img card-img-top" width="100%" height="250" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                                <?php endif ?>
                                <title><?= $value['judul']; ?></title>
                                </img>
                                <small class="text-center mt-1">
                                    <?= $value['judul']; ?>
                                    <br>
                                    By : <?= $value['pengarang']; ?>
                                    <br><br>
                                    Stok : <?= $value['jumlah_stok']; ?>

                                </small>
                                <div class="card-body">
                                    <?php if (in_groups('admin')) : ?>
                                        <div class="btn-group d-flex align-items-end">
                                            <button type="button" class="btn btn-sm btn-outline-secondary "><a href="detailbook/<?= $value['id']; ?>"><i class="fas fa-eye text-blue"></i></a></button>
                                            <button type=" button" class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit text-green"></i></button>
                                        </div>
                                    <?php else : ?>
                                        <div class="btn-group d-flex align-items-end">
                                            <button type="button" class="btn btn-sm btn-outline-secondary "><a href="detailbook/<?= $value['id']; ?>">Detail Book</a></button>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?= $pager->links('buku', 'books_pagination'); ?>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection(); ?>