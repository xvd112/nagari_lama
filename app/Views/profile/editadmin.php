<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <?php if (session()->getFlashdata('error')) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <form method="post" action="<?= base_url('profile/updatadmin'); ?>" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user mr-1"></i>
                    My Profile
                </h3>
            </div>
            <div class="container-fluid card-body">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input value="<?= $user->nama; ?>" readonly autocomplete="off" type="text" placeholder="Masukkan Nama" class="form-control" id="nama" name="nama">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input value="<?= $user->nik; ?>" autocomplete="off" type="text" placeholder="Masukkan NIK" class="form-control" name="nik">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input value="<?= $isi->username; ?>" autocomplete="off" type="text" placeholder="Masukkan Username" class="form-control" name="username">
                    </div>
                </div>
                <?php if (password_verify('123', $isi->password) or password_verify('12345678', $isi->password)) { ?>
                    <div class="row mb-3">
                        <label for="pass" class="col-sm-2 col-form-label">Password Baru </label>
                        <div class="col-sm-10">
                            <input autocomplete="off" minlength="8" type="text" placeholder="Masukkan Password Baru" class="form-control" id="pass" name="pass">
                        </div>
                    </div>
                <?php } ?>
                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input required value="<?= $isi->email; ?>" autocomplete="off" type="email" placeholder="Masukkan Email" class="form-control" name="email">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="telp" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <input required value="<?= $isi->telp; ?>" autocomplete="off" type="text" placeholder="Masukkan Nomor Telepon" class="form-control" name="telp">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="foto" class="col-sm-2 col-form-label label">Foto</label>
                    <div class="col-sm-1">
                        <img class="img-thumbnail img-preview" src="<?= base_url(); ?>/<?php if (session()->level == 3) {
                                                                                            echo 'penduduk';
                                                                                        } else {
                                                                                            echo 'perangkat';
                                                                                        } ?>/<?= $isi->foto; ?>" alt="">
                    </div>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fotoo" name="foto" onchange="previewImg()">
                            <input type="hidden" name="lama" value="<?= $isi->foto; ?>">
                            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg (Ukuran Max 2 MB)</p>
                            <label for="foto" class="custom-file-label" style="background:lightgrey"><?= $isi->foto; ?></label>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" id="id" value="<?= session()->id; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</section>

<?= $this->endSection(); ?>