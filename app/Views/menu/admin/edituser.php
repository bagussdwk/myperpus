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
            <div class="main-body mx-3">
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="alert alert-danger" role="alert">
                        <strong>Ada kesalahan dalam mengedit profile</strong>
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                <?php endif ?>
                <form action="<?= base_url('/admin/update'); ?>/<?= $user['id']; ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $user['id']; ?>">
                    <input type="hidden" name="oldUserImage" value="<?= $user['user_image']; ?>">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" value="<?= $user['email']; ?>" name='email' readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='username' id="username" autofocus value='<?= $user['username']; ?>'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fullname" class="col-sm-2 col-form-label">Fullname</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='fullname' id="fullname" value='<?= $user['fullname']; ?>'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal lahir</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name='tgl_lahir' id="tgl_lahir" value='<?= $user['tgl_lahir']; ?>'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_telpon" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='no_telpon' id="no_telpon" value='<?= $user['no_telpon']; ?>'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='alamat' id="alamat" value="<?= $user['alamat']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="user_image" class="col-sm-2 col-form-label">User Image</label>
                        <div class="col-sm-2">
                            <?php if ($user['user_image'] == 'user.png') : ?>
                                <img src="<?= base_url('img/user-profile-picture'); ?>/<?= $user['user_image']; ?>" class="img-thumbnail img-preview">
                            <?php else : ?>
                                <img src="<?= base_url('img/user-profile-picture/' . $user['email']); ?>/<?= $user['user_image']; ?>" class="img-thumbnail img-preview">
                            <?php endif; ?>
                            <?php if ($user['user_image'] == 'user.png') : ?>
                            <?php else : ?>
                                <a href="<?= base_url('user/hapusfoto'); ?>/<?= $user['id']; ?>; ?>">Hapus Foto</a>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="user_image" name="user_image" onchange="previewImg()">
                                <label class="custom-file-label" for="user_image"><?= $user['user_image']; ?></label>
                            </div>
                            <small class="pl-2">Max ukuran 10mb</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3 text-center">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection(); ?>