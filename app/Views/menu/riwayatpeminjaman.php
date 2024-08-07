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
                                <a href="<?= base_url('user/peminjaman'); ?>"><button type="button" class="btn btn-primary">Tambah Peminjaman</button></a>
                            </div>
                        </div>
                        <?php if (session()->getFlashdata('msg')) : ?>
                            <div class="alert alert-success mx-4 mt-4 text-center" role="alert">
                                <?= session()->getFlashdata('msg'); ?>
                            </div>
                        <?php endif ?>
                        <div class="card-body">
                            <table id="table1" class="table table-bordered table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Peminjaman</th>
                                        <th>Buku</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Tgl Kembali</th>
                                        <th>Total Pinjam</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Angka sebelum perkalian harus sesuai pagination user di controller
                                    $no = 1;
                                    foreach ($peminjaman as $key => $value) : ?>
                                        <tr>
                                            <td scope="row"><?= $no++; ?></td>
                                            <td><?= $value->no_peminjaman; ?></td>
                                            <td><?= $value->judul; ?></td>
                                            <td><?= $value->tgl_pinjam; ?></td>
                                            <td><?= $value->tgl_kembali; ?></td>
                                            <td><?= $value->totalpinjam; ?></td>
                                            <td><?= $value->status; ?></td>
                                            <td class="text-center">
                                                <?php if ($value->status == 'Proses') : ?>
                                                    <form action="/user/hapuspeminjaman/<?= $value->id; ?>" method="post">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="put">
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                <?php elseif ($value->status == 'Ditolak') : ?>
                                                    <form action="/user/hapuspeminjaman/<?= $value->id; ?>" method="post">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="put">
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                <?php elseif ($value->status == 'Pinjam') : ?>
                                                    <form action="/user/pengembalian/<?= $value->id; ?>/<?= $value->id_buku; ?>" method="post">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="put">
                                                        <button type="submit" class="btn btn-primary">Pengembalian</button>
                                                    </form>
                                                <?php else : ?>
                                                    <!-- <form action="/user/transaksibuku/ $value->id; " method="post">
                                                         csrf_field();
                                                        <input type="hidden" name="_method" value="put">
                                                        <button type="submit" class="btn btn-primary">Lihat Transaksi</button>
                                                    </form> -->
                                                <?php endif ?>
                                            </td>
                                        <?php endforeach; ?>
                                        </tr>

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