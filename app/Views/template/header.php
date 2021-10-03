<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url(); ?>/aset/img/logo.png" alt="AdminLTELogo" height="200" width="200">
        </div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url(); ?>/home" class="nav-link">Sistem Informasi Nagari</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <div class="user-panel d-flex">
                        <div class="image">
                            <?php if (session()->get('id_datauser') != 0) { ?>
                                <img src="<?= base_url(); ?>/<?php if (session()->level == 3) {
                                                                    echo 'penduduk';
                                                                } else {
                                                                    echo 'perangkat';
                                                                } ?>/<?= $isi->foto; ?>" class="img-circle elevation-1" alt="User Image">
                            <?php } else { ?>
                                <img src="<?= base_url(); ?>/aset/img/default.svg" class="img-circle elevation-1" alt="User Image">
                            <?php } ?>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a style="margin-right: 10px;" id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                        <?php if (session()->get('id_datauser') != 0) {
                            echo $user->nama;
                        } else {
                            echo 'Super Admin';
                        } ?>
                    </a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="<?= base_url(); ?>/<?php if (session()->level == 3) {
                                                            echo 'home';
                                                        } else {
                                                            echo 'profile/index';
                                                        } ?>" class="dropdown-item">View Profile </a></li>
                        <li class="dropdown-divider"></li>
                        <li><a href="<?= base_url(); ?>/auth/logout" class="dropdown-item">Logout</a></li>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->