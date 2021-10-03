<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <?php if (session()->getFlashdata('error')) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <form method="post" action="<?= base_url('user/add'); ?>">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user mr-1"></i>
                    Data User
                </h3>
            </div>
            <div class="container-fluid card-body">
                <?= csrf_field(); ?>
                <?php if ($level == 1 or $level == 2) { ?>
                    <div class="row mb-3">
                        <label for="id_datauser" class="col-sm-2 col-form-label">Data Perangkat</label>
                        <div class="col-sm-10">
                            <select class="form-control select2bs4" name="id_datauser" id="id_datauser" required required>
                                <option value="">Pilih Data Perangkat</option>
                                <?php
                                foreach ($data as $data) {
                                ?>
                                    <option value="<?= $data['id_pemerintahan']; ?>"><?= $data['nama'] ?> - <?= $data['jabatan']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php } elseif ($level == 3) { ?>
                    <div class="row mb-3">
                        <label for="id_keluarga" class="col-sm-2 col-form-label">No KK</label>
                        <div class="col-md-10">
                            <select onchange="nik()" class="form-control select2bs4" name="id_keluarga" id="id_keluarga" required>
                                <option value="">Pilih No KK</option>
                                <?php
                                foreach ($data as $k) {
                                ?>
                                    <option value="<?php echo $k['id_keluarga'] ?>"><?php echo $k['no_kk'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="id_penduduk" class="col-sm-2 col-form-label">NIK</label>
                        <div class="col-md-10">
                            <select onchange="ambilnik()" class="form-control select2bs4" name="id_penduduk" id="id_penduduk" required>
                                <option value="">Pilih NIK</option>
                            </select>
                        </div>
                    </div>
                <?php } ?>
                <div class="row mb-3">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" placeholder="Masukkan Username" class="form-control" id="username" name="username" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="email" placeholder="Masukkan Email" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pass" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" minlength="8" type="password" placeholder="Masukkan Password" class="form-control" id="pass" name="pass" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="telp" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" placeholder="Masukkan Nomor Telepon" class="form-control" id="telp" name="telp">
                    </div>
                </div>
                <input type="hidden" name="level" id="level" value="<?= $level; ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-danger">Clear</button>
    </form>
</section>
<!-- /.content -->

<!-- /.content -->
<?= $this->endSection(); ?>