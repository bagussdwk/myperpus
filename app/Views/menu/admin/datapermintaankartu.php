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
        <div class="container">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?= $title; ?></h3>
                </div>
                <?php if ($user == NULL) : ?>
                    <div class="card-body text-center table-responsive">
                        <h4>Untuk saat ini, belum ada permintaan kartu anggota kartu</h4>
                    </div>
                <?php else : ?>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-striped text-center" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Fullname</th>
                                    <th>Alamat</th>
                                    <th>Tanggal Lahir</th>
                                    <th>No Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($user as $key => $value) : ?>
                                    <tr>
                                        <th scope="row"><?php echo $no++; ?></td>
                                        <td><?php echo $value->username; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $value->fullname; ?></td>
                                        <td><?php echo $value->alamat; ?></td>
                                        <td><?php echo $value->tgl_lahir; ?></td>
                                        <td><?php echo $value->no_telpon; ?></td>
                                        <td class="text-center d-flex">
                                            <form action="/admin/konfirmasikartu/<?= $value->id; ?>" method="post">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="put">
                                                <button type="submit" class="btn btn-success">Konfirmasi</button>
                                            </form>
                                            <form action="/admin/hapuspermintaankartu/<?= $value->id; ?>" method="post">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="put">
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                <?php endif; ?>
            </div>
            <!-- /.card -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection(); ?>