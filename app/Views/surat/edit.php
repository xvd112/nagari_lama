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
                            foreach ($penduduk as $p) {
                            ?>
                                <option <?php if ($surat->id_penduduk == $p['id_penduduk']) {
                                            echo 'selected';
                                        } ?> value="<?= $p['id_penduduk'] ?>"><?php echo $p['nik'] ?> - <?= $p['nama']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input value="<?= $surat->nama; ?>" readonly autocomplete="off" type="text" placeholder="Masukkan Nama" class="form-control" id="nama" name="nama" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tujuan" class="col-sm-2 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-10">
                        <input value="<?= $surat->tujuan; ?>" autocomplete="off" placeholder="Masukkan Tujuan Surat" required type="text" class="form-control" id="tujuan" name="tujuan">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ket" class="col-sm-2 col-form-label"><?= $label; ?></label>
                    <div class="col-sm-10">
                        <input value="<?= $surat->tambahan; ?>" autocomplete="off" placeholder="Masukkan <?= $label; ?>" required type="<?php if ($link != 'sku') {
                                                                                                                                            echo 'number';
                                                                                                                                        } else {
                                                                                                                                            echo 'text';
                                                                                                                                        } ?>" class="form-control" id="ket" name="ket">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ttd" class="col-sm-2 col-form-label">Yang Menandatangani</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="ttd" id="ttd" required required>
                            <option value="">Pilih Pejabat</option>
                            <?php
                            foreach ($ttd as $p) {
                            ?>
                                <option <?php if ($surat->id_pemerintahan == $p['id_pemerintahan']) echo 'selected' ?> value="<?php echo $p['id_pemerintahan'] ?>"><?php echo $p['jabatan'] ?> - <?php echo $p['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="id_surat" id="id_surat" value="<?= $surat->id_surat; ?>">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Clear</button>
            </form>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- /.content -->
<?= $this->endSection(); ?>