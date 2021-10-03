<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-user-friends mr-1"></i>
                            View Data : <?= $potensi->nama; ?>
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <button type="button" style="margin-left: 10px;" class="btn btn-success">
                                        <a href="<?php echo base_url($link . '/edit/' . $potensi->id_potensi); ?>" style="color: white;">
                                            <i class="far fa-plus-square"> Edit Data</i>
                                        </a>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row card-body" align="center">
                        <h1><b><u><?= $potensi->nama; ?></u></b></h1>
                        <div>
                            <img width="50%" src="<?= base_url(); ?>/potensi/<?= $potensi->foto; ?>" alt="foto <?= $potensi->foto; ?>">
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="col" align="left">
                            Nama : <b><i><?= $potensi->nama; ?></i></b>
                        </div>
                        <div class="dropdown-divider"></div>
                        <p style="text-align: left;"><?= $potensi->ket; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>