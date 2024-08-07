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
                                        <th>No Anggota</th>
                                        <th>Nama Anggota</th>
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
                                            <td><?= $value->no_kartu_anggota; ?></td>
                                            <td><?= $value->fullname; ?></td>
                                            <td><?= $value->judul; ?></td>
                                            <td><?= $value->tgl_pinjam; ?></td>
                                            <td><?= $value->tgl_kembali; ?></td>
                                            <td><?= $value->totalpinjam; ?></td>
                                            <td><?= $value->status; ?></td>
                                            <td class="d-flex">
                                                <?php if ($value->status == 'Kembali') : ?>
                                                    <!-- <form action="/admin/lihattransaksi/ $value->id;" method="post">
                                                        <input type="hidden" name="_method" value="put">
                                                        <button type="submit" class="btn btn-primary">Lihat Transaksi</button>
                                                    </form> -->
                                                <?php elseif ($value->status == 'Proses') : ?>
                                                    <form action="/admin/konfirmasipeminjaman/<?= $value->id; ?>/<?= $value->id_buku; ?>/<?= $value->totalpinjam; ?>" method="post">
                                                        <input type="hidden" name="_method" value="put">
                                                        <button type="submit" class="btn btn-primary mr-2">Konfirmasi</button>
                                                    </form>
                                                    <form action="/admin/hapuspeminjaman/<?= $value->id; ?>" method="post">
                                                        <input type="hidden" name="_method" value="put">
                                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                                    </form>
                                                <?php else : ?>
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