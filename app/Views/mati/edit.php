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
    <form method="post" action="<?= base_url('mati/update'); ?>">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user mr-1"></i>
                    Data Pribadi
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="container-fluid card-body">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="id_keluarga" class="col-sm-2 col-form-label">No KK</label>
                    <div class="col-md-10">
                        <select onchange="nikmati()" class="form-control select2bs4" name="id_keluarga" id="id_keluarga" required>
                            <option value="">Pilih No KK</option>
                            <?php
                            foreach ($keluarga as $k) {
                            ?>
                                <option <?php if ($mati->id_keluarga == $k['id_keluarga']) {
                                            echo 'selected';
                                        } ?> value="<?= $k['id_keluarga'] ?>"><?php echo $k['no_kk'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="id_penduduk" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-md-10">
                        <select onchange="ambilNama()" class="form-control select2bs4" name="id_penduduk" id="id_penduduk" required>
                            <option value="">Pilih NIK</option>
                            <?php
                            foreach ($penduduk as $p) {
                            ?>
                                <option <?php if ($mati->id_penduduk == $p['id_penduduk']) {
                                            echo 'selected';
                                        } ?> value="<?= $p['id_penduduk'] ?>"><?php echo $p['nik'] ?> - <?= $p['nama']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input value="<?= $mati->nama; ?>" readonly autocomplete="off" type="text" placeholder="Masukkan Nama" class="form-control" id="nama" name="nama" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tpt_kematian" class="col-sm-2 col-form-label">Tempat Kematian</label>
                    <div class="col-sm-10">
                        <input value="<?= $mati->tpt_kematian; ?>" autocomplete="off" type="text" placeholder="Masukkan Tempat Kematian" class="form-control" id="tpt_kematian" name="tpt_kematian" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tgl_kematian" class="col-sm-2 col-form-label">Tanggal Kematian</label>
                    <div class="col-sm-10">
                        <input value="<?= $mati->tgl_kematian; ?>" autocomplete="off" value="<?= date('Y-m-d'); ?>" placeholder="yyyy-mm-dd" type="date" id="datepicker" class="form-control" name="tgl_kematian" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sebab" class="col-sm-2 col-form-label">Sebab Kematian</label>
                    <div class="col-sm-10">
                        <input value="<?= $mati->sebab; ?>" autocomplete="off" type="text" placeholder="Masukkan Sebab Kematian" class="form-control" id="sebab" name="sebab" required>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id_kematian" id="id_kematian" value="<?= $mati->id_kematian; ?>">
            <input type="hidden" name="lama" id="lama" value="<?= $mati->id_penduduk; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-danger">Clear</button>
    </form>
</section>
<!-- /.content -->

<!-- /.content -->
<?= $this->endSection(); ?>