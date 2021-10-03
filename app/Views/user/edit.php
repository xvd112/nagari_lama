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
    <form method="post" action="<?= base_url('user/update'); ?>" enctype="multipart/form-data">
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
                                    <option <?php if ($datauser->id_datauser == $data['id_pemerintahan']) {
                                                echo 'selected';
                                            } ?> value="<?= $data['id_pemerintahan']; ?>"><?= $data['nama'] ?> - <?= $data['jabatan']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php } elseif ($level == 3) { ?>
                    <div class="row mb-3">
                        <label for="id_keluarga" class="col-sm-2 col-form-label">No KK</label>
                        <div class="col-sm-10">
                            <select onchange="nik()" class="form-control select2bs4" name="id_keluarga" id="id_keluarga" required>
                                <option value="">Pilih No KK</option>
                                <?php
                                foreach ($keluarga as $k) {
                                ?>
                                    <option <?php if ($kel->id_keluarga == $k['id_keluarga']) {
                                                echo 'selected';
                                            } ?> value="<?= $k['id_keluarga'] ?>"><?php echo $k['no_kk'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="id_penduduk" class="col-sm-2 col-form-label">NIK</label>
                        <div class="col-sm-10">
                            <select onchange="ambilNama()" class="form-control select2bs4" name="id_penduduk" id="id_penduduk" required>
                                <option value="">Pilih NIK</option>
                                <?php
                                foreach ($data as $p) {
                                ?>
                                    <option <?php if ($datauser->id_datauser == $p['id_penduduk']) {
                                                echo 'selected';
                                            } ?> value="<?= $p['id_penduduk'] ?>"><?php echo $p['nik'] ?> - <?= $p['nama']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php } ?>
                <div class="row mb-3">
                    <label for="level" class="col-sm-2 col-form-label">Data Role</label>
                    <div class="col-sm-10">
                        <select class="form-control select2bs4" name="level" id="level" required required>
                            <option value="">Pilih Data Role</option>
                            <?php
                            $level = [
                                'Super Admin', 'Admin', 'Warga'
                            ];
                            for ($i = 0; $i < count($level); $i++) {
                            ?>
                                <option <?php if ($datauser->level == ($i + 1)) {
                                            echo 'selected';
                                        } ?> value="<?= ($i + 1); ?>"><?= $level[$i] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input value="<?= $datauser->username; ?>" autocomplete="off" type="text" placeholder="Masukkan Username" class="form-control" id="username" name="username" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input value="<?= $datauser->email; ?>" autocomplete="off" type="email" placeholder="Masukkan Email" class="form-control" id="email" name="email">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pass" class="col-sm-2 col-form-label">Reset Password</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="password" minlength="8" placeholder="Masukkan Password Baru" class="form-control" id="pass" name="pass">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="telp" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <input value="<?= $datauser->telp; ?>" autocomplete="off" type="text" placeholder="Masukkan Nomor Telepon" class="form-control" id="telp" name="telp">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="foto" class="col-sm-2 col-form-label label">Foto</label>
                    <div class="col-sm-1">
                        <img class="img-thumbnail img-preview" src="<?= base_url(); ?>/user/<?= $datauser->foto; ?>" alt="">
                    </div>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fotoo" name="foto" onchange="previewImg()">
                            <input type="hidden" name="lama" value="<?= $datauser->foto; ?>">
                            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg (Ukuran Max 10 MB dan Nama File Sesuai Nama)</p>
                            <label for="foto" class="custom-file-label"><?= $datauser->foto; ?></label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" id="id" value="<?= $datauser->id; ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</section>
<!-- /.content -->

<!-- /.content -->
<?= $this->endSection(); ?>