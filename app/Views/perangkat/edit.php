<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-balance-scale mr-1"></i>
                <?= $ket[0]; ?>
            </h3>
        </div>
        <div class="container-fluid card-body">
            <form method="post" action="<?= base_url($link . '/update'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input value="<?= $perangkat->nik; ?>" numeric autocomplete="off" type="text" placeholder="0000000000000000" maxlength="16" minlength="16" class="form-control" id="nik" name="nik" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input value="<?= $perangkat->nama; ?>" autocomplete="off" type="text" placeholder="Masukkan Nama" class="form-control" id="nama" name="nama" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                        <select class="form-control select2bs4" name="jabatan" id="jabatan" required autocomplete="off">
                            <option value="">Pilih Jabatan </option>
                            <?php
                            for ($i = 0; $i < count($jabatan); $i++) {
                            ?>
                                <option <?php if ($perangkat->jabatan == $jabatan[$i]) echo 'selected' ?> value="<?php echo $jabatan[$i] ?>"><?php echo $jabatan[$i] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jekel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <input type="radio" name="jekel" value="Laki - Laki" <?php if ($perangkat->jekel == 'Laki - Laki') echo 'checked' ?>> Laki-laki
                        <input type="radio" name="jekel" value="Perempuan" <?php if ($perangkat->jekel == 'Perempuan') echo 'checked' ?>> Perempuan
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tgl_lantik" class="col-sm-2 col-form-label">Tanggal Dilantik</label>
                    <div class="col-sm-10">
                        <input value="<?= $perangkat->tgl_lantik; ?>" autocomplete="off" type="date" placeholder="Masukkan Tanggal Dilantik" class="form-control" id="tgl_lantik" name="tgl_lantik" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tgl_berhenti" class="col-sm-2 col-form-label">Tanggal Berhenti</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="date" placeholder="Masukkan Tanggal Dilantik" class="form-control" id="tgl_berhenti" name="tgl_berhenti">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="telp" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <input value="<?= $perangkat->telp; ?>" autocomplete="off" type="text" placeholder="Masukkan Nomor Telepon" class="form-control" id="telp" name="telp" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="foto" class="col-sm-2 col-form-label label">Foto</label>
                    <div class="col-sm-1">
                        <img class="img-thumbnail img-preview" src="<?= base_url(); ?>/perangkat/<?= $perangkat->foto; ?>" alt="">
                    </div>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fotoo" name="foto" onchange="previewImg()">
                            <input type="hidden" name="lama" value="<?= $perangkat->foto; ?>">
                            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg (Ukuran Max 10 MB dan Nama File Sesuai Nama)</p>
                            <label for="foto" class="custom-file-label"><?= $perangkat->foto; ?></label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id_pemerintahan" id="id_pemerintahan" value="<?= $perangkat->id_pemerintahan; ?>">
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>