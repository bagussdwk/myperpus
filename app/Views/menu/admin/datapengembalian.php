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
        <!-- Default box -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center">
                                <a href="<?= base_url('admin/tambahuser'); ?>"><button type="button" class="btn btn-primary">Tambah User</button></a>
                            </div>
                        </div>
                        <?php if (session()->getFlashdata('msg')) : ?>
                            <div class="alert alert-success mx-4 mt-4" role="alert">
                                <?= session()->getFlashdata('msg'); ?>
                            </div>
                        <?php endif ?>
                        <div class="card-body">
                            <table id="table1" class="table table-bordered table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Peminjaman</th>
                                        <th>Tgl Pengembalian</th>
                                        <th>Tgl Harus Kembali</th>
                                        <th>Denda Per Hari</th>
                                        <th>Total Denda</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Angka sebelum perkalian harus sesuai pagination user di controller
                                    $no = 1;
                                    foreach ($pengembalian as $key => $value) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $value->no_peminjaman; ?></td>
                                            <td><?= $value->tgl_pengembalian; ?></td>
                                            <td><?= $value->tgl_kembali; ?></td>
                                            <td>Rp. <?= $value->dendaPerHari; ?></td>
                                            <td>Rp. <?= $value->totalDenda; ?></td>
                                            <td class="text-center d-flex">
                                                <form action="/admin/konfirmasipengembalian/<?= $value->id; ?>/<?= $value->id_peminjaman; ?>/<?= $value->id_buku; ?>/<?= $value->totalpinjam; ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="put">
                                                    <button type="submit" class="btn btn-primary">konfirmasi</button>
                                                </form>
                                                <form action="/admin/hapuspengembalian/<?= $value->id; ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="put">
                                                    <button type="submit" class="btn btn-danger">hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

<?= $this->endSection(); ?>