        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <?php if (user()->user_image == 'user.png') : ?>
                <img src="<?= base_url('img/user-profile-picture'); ?>/<?= user()->user_image; ?>" class="animation__shake img-circle elevation-2" alt="<?= user()->username; ?>" height="60" width="60">
            <?php elseif (user()->user_image == 'logo.png') : ?>
                <img src="<?= base_url('img/user-profile-picture'); ?>/<?= user()->user_image; ?>" class="animation__shake img-circle elevation-2" alt="<?= user()->username; ?>" height="60" width="60">
            <?php else : ?>
                <img src="<?= base_url('img/user-profile-picture/' . user()->email); ?>/<?= user()->user_image; ?>" class="animation__shake img-circle elevation-2" alt="<?= user()->username; ?>" height="60" width="60">
            <?php endif; ?>
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url('home'); ?>" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Profile -->
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><?= user()->username; ?>
                        <?php if (user()->user_image == 'user.png') : ?>
                            <img src="<?= base_url('img/user-profile-picture'); ?>/<?= user()->user_image; ?>" class="img-circle elevation-2 mx-2" alt="<?= user()->username; ?>" width='30' height='30' style="background-position: center center; background-repeat: no-repeat;">
                        <?php elseif (user()->user_image == 'logo.png') : ?>
                            <img src="<?= base_url('img/user-profile-picture'); ?>/<?= user()->user_image; ?>" class=" img-circle elevation-2 mx-2" alt="<?= user()->username; ?>" width='30' height='30' style="background-position: center center; background-repeat: no-repeat;">
                        <?php else : ?>
                            <img src="<?= base_url('img/user-profile-picture/' . user()->email); ?>/<?= user()->user_image; ?>" class=" img-circle elevation-2 mx-2" alt="<?= user()->username; ?>" width='30' height='30' style="background-position: center center; background-repeat: no-repeat;">
                        <?php endif; ?></a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow text-center">
                        <?php if (in_groups('user')) : ?>
                            <li><a href="<?= base_url('user/editprofile'); ?>" class="dropdown-item">Edit Profile </a></li>
                        <?php else : ?>
                        <?php endif ?>

                        <li class="dropdown-divider"></li>


                        <li><a href="<?= base_url('logout'); ?>" class="dropdown-item text-danger">Logout</a></li>
                    </ul>
                </li>
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->