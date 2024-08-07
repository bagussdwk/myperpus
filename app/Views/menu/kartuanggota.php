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
            <?php if (user()->no_kartu_anggota == NULL) : ?>
                <?php if (session()->getFlashdata('msg')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('msg'); ?>
                    </div>
                <?php endif ?>
                <div class="row ">
                    <div class=" col-lg-10 mx-auto ">
                        <div class="card card-style1 border-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <h3 class="text-dark">Kamu belum memiliki kartu anggota, <br>silahkan melakukan permintaan kartu anggota!!!</h3>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <form action="/user/permintaannokartu/<?= user()->id; ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="put">
                                <button type="submit" class="btn btn-primary">Permintaan Kartu Anggota</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php elseif (user()->no_kartu_anggota == '0') : ?>
                <?php if (session()->getFlashdata('msg')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('msg'); ?>
                    </div>
                <?php endif ?>
                <div class="row ">
                    <div class=" col-lg-10 mx-auto ">
                        <div class=" card card-style1 border-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <h3 class="text-dark">Kartu Anggota anda sedang diproses, silahkan tunggu hingga proses selesai!!!</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php elseif (user()->no_kartu_anggota == '1') : ?>
                <div class="row ">
                    <div class=" col-lg-10 mx-auto ">
                        <div class=" card card-style1 border-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <h3 class="text-dark">Permintaan kartu anggota anda telah ditolak, silahkan coba permintaan lagi!!!</h3>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <form action="/user/permintaannokartu/<?= user()->id; ?>" method="post">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="put">
                                <button type="submit" class="btn btn-primary">Permintaan Kartu Anggota</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="row ">
                    <div class=" col-lg-10 mx-auto ">
                        <div class=" card card-style1 border-0">
                            <div class="card-body">
                                <div class="text-center">
                                    <h4 class="text-dark">Kartu Anggota anda telah dikonfirmasi. <br>
                                        Silahkan datang keperpustakaan untuk mencetak dan mengambil kartu anggota!! <br>
                                        Terima Kasih.
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-md-12 mb-3 text-center">
                        <a href="#"><button type=" button" class="btn btn-primary">Lihat Kartu Anggota</button></a>
                    </div>
                </div> -->
            <?php endif; ?>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection(); ?>