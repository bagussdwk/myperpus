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
                        <strong>Ada kesalahan dalam menambah buku</strong>
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                <?php endif ?>
                <form action="<?= base_url('admin/savebuku'); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Kode Buku</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kode_buku" value="<?= $kode_buku; ?>" name='kode_buku' readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="kategori" id="kategori">
                                <option value="">- Pilih -</option>
                                <?php foreach ($kategori as $key => $data) { ?>
                                    <option value="<?= $data->id; ?>"><?= $data->nama_kategori; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="penerbit" id="penerbit">
                                <option value="">- Pilih -</option>
                                <?php foreach ($penerbit as $key => $data) { ?>
                                    <option value="<?= $data->id; ?>"><?= $data->nama_penerbit; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="judul" value="<?= old('judul') ?>" name='judul'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pengarang" value="<?= old('pengarang') ?>" name='pengarang'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="isbn" class="col-sm-2 col-form-label">ISBN</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="isbn" value="<?= old('isbn') ?>" name='isbn'>
                        </div>
                        <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="tahun_terbit" value="<?= old('tahun_terbit') ?>" name='tahun_terbit'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah_halaman" class="col-sm-2 col-form-label">Jumlah Halaman</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="jumlah_halaman" value="<?= old('jumlah_halaman') ?>" name='jumlah_halaman'>
                        </div>
                        <label for="jumlah_stok" class="col-sm-2 col-form-label">Jumlah Stok</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="jumlah_stok" value="<?= old('jumlah_stok') ?>" name='jumlah_stok'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gambar" class="col-sm-2 col-form-label">Cover Buku</label>
                        <div class="col-sm-2">
                            <img src="<?= base_url('img/buku'); ?>/default.png" class="img-thumbnail img-preview">
                        </div>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="gambar" name="gambar" onchange="previewCover()">
                                <label class="custom-file-label" for="gambar">Pilih gambar ...</label>
                            </div>
                            <small class="pl-2">Max ukuran 10mb</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sinopsis" class="col-sm-2 col-form-label">Sinopsis</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sinopsis" value="<?= old('sinopsis') ?>" name='sinopsis'>
                        </div>
                    </div>
                    <div class=" row">
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