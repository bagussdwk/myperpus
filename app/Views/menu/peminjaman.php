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
        <div class="container col-sm-8">
            <div class="main-body mx-3">
                <!-- Default box -->
                <div class="card">
                    <div class="card-body">
                        <?php if (!empty(session()->getFlashdata('error'))) : ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Ada kesalahan dalam menambah user</strong>
                                <?= session()->getFlashdata('error'); ?>
                            </div>
                        <?php endif ?>
                        <?php if (user()->no_kartu_anggota == null) : ?>
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
                            <div class="row ">
                                <div class=" col-lg-10 mx-auto ">
                                    <div class=" card card-style1 border-0">
                                        <div class="card-body">
                                            <div class="text-center">
                                                <h3 class="text-dark">Kartu Anggota masih diproses, Silahkan menunggu hingga kartu anggota telah dikonfirmasi!!!</h3>
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
                                                <h3 class="text-dark">Kartu Anggota ditolak, Silahkan menuju permintaan kartu anggota!!!</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <form action="<?= base_url('/user/pinjam'); ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field(); ?>

                                <div class="form-group row">
                                    <label for="kode_buku" class="col-sm-2 col-form-label">Kode Buku *</label>
                                    <div class="input-group col-sm-10 ">
                                        <input type="hidden" name="id_user" value="<?= user()->id; ?>">
                                        <input type="hidden" name="id" id="id">
                                        <input type="text" class="form-control" name="kode_buku" id="kode_buku" required autofocus>
                                        <span>
                                            <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-buku">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="Judul" class="col-sm-2 col-form-label">Judul Buku</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="judul" name="judul" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="pengarang" name="pengarang" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jumlah_stok" class="col-sm-2 col-form-label">Jumlah stok</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="jumlah_stok" name="jumlah_stok" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_pinjam" class="col-sm-2 col-form-label">Tgl Pinjam</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="tgl_pinjam" id="tgl_pinjam" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_kembali" class="col-sm-2 col-form-label">Tgl Kembali</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="tgl_kembali" id="tgl_kembali" class="form-control" value="<?= date('Y-m-d', strtotime("+7 day", strtotime(date("Y-m-d")))); ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="totalpinjam" class="col-sm-2 col-form-label">Total pinjam</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="totalpinjam" name="totalpinjam">
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="col-md-12 mb-3 text-center">
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal fade" id="modal-buku">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
                <h4 class="modal-title">Pilih Buku</h4>
            </div>
            <div class="mx-2 my-2">
                <table class="table table-bordered table-striped text-center" id="table1">
                    <thead>
                        <tr>
                            <th>Kode Buku</th>
                            <th>Judul</th>
                            <th>Pengarang</th>
                            <th>Stok</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($buku as $b => $value) { ?>
                            <tr>
                                <td><?= $value->kode_buku; ?></td>
                                <td><?= $value->judul; ?></td>
                                <td><?= $value->pengarang; ?></td>
                                <td><?= $value->jumlah_stok; ?></td>
                                <td>
                                    <button class="btn btn-xs btn-info" id="pilihbuku" data-id="<?= $value->id; ?>" data-kode_buku="<?= $value->kode_buku; ?>" data-pengarang="<?= $value->pengarang; ?>" data-judul="<?= $value->judul; ?>" data-jumlah_stok="<?= $value->jumlah_stok; ?>">
                                        <i class=" fas fa-check"></i> Pilih
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<?= $this->endSection(); ?>