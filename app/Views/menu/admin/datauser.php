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
                                    <tr class="">
                                        <th>No</th>
                                        <th>No Kartu Anggota</th>
                                        <th>Fullname</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Angka sebelum perkalian harus sesuai pagination user di controller
                                    $no = 1;
                                    foreach ($user as $key => $value) : ?>
                                        <tr>
                                            <td scope="row"><?= $no++; ?></td>
                                            <?php if ($value->no_kartu_anggota == '0') : ?>
                                                <td> - </td>
                                            <?php else : ?>
                                                <td><?= $value->no_kartu_anggota; ?></td>
                                            <?php endif ?>
                                            <td><?= $value->fullname; ?></td>
                                            <td><?= $value->username; ?></td>
                                            <td><?= $value->email; ?></td>
                                            <td><?= $value->description; ?></td>
                                            <td class="text-center d-flex ml-3">
                                                <button class="btn btn-transparent"> <a href="edituser/<?= $value->id; ?>"><i class="fas fa-edit text-green"></i></a></button>
                                                <button class="btn btn-transparent"> <a href="detail/ <?= $value->id; ?>"><i class="fas fa-eye text-blue"></i></a></button>
                                                <form action="/admin/hapus/<?= $value->id; ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="put">
                                                    <button type="submit" class="btn btn-transparent"><i class="fas fa-eraser text-red"></i></button>
                                                </form>
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