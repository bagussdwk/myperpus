        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url('/'); ?>" class="brand-link">
                <img src="<?= base_url('img/user-profile-picture'); ?>/logo.png" alt="<?= $appName; ?> Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?= $appName; ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <?php if (user()->user_image == 'user.png') : ?>
                            <img src="<?= base_url('img/user-profile-picture'); ?>/<?= user()->user_image; ?>" class=" img-circle elevation-2" alt="<?= user()->username; ?>" width="30" height="30">
                        <?php elseif (user()->user_image == 'logo.png') : ?>
                            <img src="<?= base_url('img/user-profile-picture'); ?>/<?= user()->user_image; ?>" class=" img-circle elevation-2" alt="<?= user()->username; ?>" width="200">
                        <?php else : ?>
                            <img src="<?= base_url('img/user-profile-picture/' . user()->email); ?>/<?= user()->user_image; ?>" class=" img-circle elevation-2" alt="<?= user()->username; ?>" width="30" height="30">
                        <?php endif; ?>
                    </div>
                    <div class="info">
                        <a href="<?= base_url('user/profile'); ?>" class="d-block"><?= user()->username; ?></a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header">USER</li>
                        <li class="nav-item">
                            <a href="<?= base_url('user'); ?>" class="nav-link <?= ($sidebar === 'Dashboard') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <?php if (in_groups('admin')) : ?>
                            <li class="nav-header">BUKU</li>
                            <li class="nav-item my-2">
                                <a href="<?= base_url('admin/datapeminjaman'); ?>" class="nav-link <?= ($sidebar === 'Data Peminjaman') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-list"></i>
                                    <p>
                                        Data Peminjaman
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item my-2">
                                <a href="<?= base_url('admin/datapengembalian'); ?>" class="nav-link <?= ($sidebar === 'Data Pengembalian') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-receipt"></i>
                                    <p>
                                        Data Pengembalian
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item my-2">
                                <a href="<?= base_url('admin/datapermintaankartu'); ?>" class="nav-link <?= ($sidebar === 'Data Permintaan Kartu') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-id-card"></i>
                                    <p>
                                        Data Permintaan Kartu
                                    </p>
                                </a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item my-2">
                                <a href="<?= base_url('user/profile'); ?>" class="nav-link <?= ($sidebar === 'Profile') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-address-card"></i>
                                    <p>
                                        Profile
                                    </p>
                                </a>
                            </li>
                            <li class="nav-header">MENU</li>
                            <li class="nav-item my-2">
                                <a href="<?= base_url('user/peminjaman'); ?>" class="nav-link <?= ($sidebar === 'Peminjaman Buku') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-book-open-reader"></i>
                                    <p>
                                        Peminjaman Buku
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item my-2">
                                <a href="<?= base_url('user/riwayatpeminjaman'); ?>" class="nav-link <?= ($sidebar === 'Riwayat Peminjaman') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-book-bookmark"></i>
                                    <p>
                                        Riwayat Peminjaman
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item my-2">
                                <a href="<?= base_url('user/kartuanggota'); ?>" class="nav-link <?= ($sidebar === 'Kartu Anggota') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-id-card"></i>
                                    <p>
                                        Kartu Anggota
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item my-2">
                            <a href="<?= base_url('user/koleksibuku'); ?>" class="nav-link <?= ($sidebar === 'Koleksi Buku') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Koleksi Buku
                                </p>
                            </a>
                        </li>
                        <?php if (in_groups('admin')) : ?>
                            <li class="nav-header">USER MANAGEMENT</li>
                            <li class="nav-item my-2">
                                <a href="<?= base_url('admin/datauser'); ?>" class="nav-link <?= ($sidebar === 'Data User') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Data User
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>