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
                        <li class="breadcrumb-item"><a href="<?= base_url('user/riwayatpeminjaman'); ?>">Riwayat Peminjaman</a></li>
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
                            <div class="alert alert-success mx-4 mt-4 text-center" role="alert">
                                <?= session()->getFlashdata('msg'); ?>
                            </div>
                        <?php endif ?>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>No Peminjaman</th>
                                        <th>Tgl Pengembalian</th>
                                        <th>Tgl Harus Kembali</th>
                                        <th>Denda Per Hari</th>
                                        <th>Total Denda</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $pengembalian->no_peminjaman; ?></td>
                                        <td><?= $pengembalian->tgl_pengembalian; ?></td>
                                        <td><?= $pengembalian->tgl_kembali; ?></td>
                                        <td><?= $pengembalian->dendaPerHari; ?></td>
                                        <td><?= $pengembalian->totalDenda; ?></td>
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