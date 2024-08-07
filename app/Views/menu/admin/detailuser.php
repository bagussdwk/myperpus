<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
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
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <?php if ($user->user_image == 'user.png') : ?>
                                        <img src="<?= base_url('img/user-profile-picture'); ?>/<?= $user->user_image; ?>" alt="UserImage" class="rounded-circle" width="170" height="170">
                                    <?php elseif ($user->user_image == 'logo.png') : ?>
                                        <img src="<?= base_url('img/user-profile-picture'); ?>/<?= $user->user_image; ?>" alt="UserImage" class="rounded-circle" width="170" height="170">
                                    <?php else : ?>
                                        <img src="<?= base_url('img/user-profile-picture/' . $user->email); ?>/<?= $user->user_image; ?>" alt="UserImage" class="rounded-circle" width="170" height="170">
                                    <?php endif; ?>
                                    <div class="mt-3">
                                        <h4><?= $user->username; ?></h4>
                                        <p class="text-secondary mb-1"><?= $user->description; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">No Kartu Anggota</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?php if ($user->no_kartu_anggota == NULL) : ?>
                                            -
                                        <?php elseif ($user->no_kartu_anggota == '0') : ?>
                                            -
                                        <?php else : ?>
                                            <?= $user->no_kartu_anggota; ?>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $user->fullname; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $user->email; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $user->no_telpon; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $user->alamat; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Birthday</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $user->tgl_lahir; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection(); ?>