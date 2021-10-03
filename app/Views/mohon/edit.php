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
    <form method="post" action="<?= base_url('/permohonan/update'); ?>" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-1"></i>
                    <?= $title; ?>
                </h3>
            </div>
            <div class="container-fluid card-body">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="jenis" class="col-sm-2 col-form-label">Jenis Surat</label>
                    <div class="col-sm-10">
                        <select onchange="surat()" class="form-control" name="jenis" id="jenis" data-id="getkomponen" required>
                            <option value="">Pilih Jenis Surat</option>
                            <?php
                            for ($i = 0; $i < count($surat); $i++) {
                            ?>)
                            <option <?php if ($mohon->jenis == $surat[$i]) {
                                        echo 'selected';
                                    } ?> value="<?php echo $surat[$i] ?>"><?php echo $surat[$i] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tujuan" class="col-sm-2 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" value="<?= $mohon->tujuan; ?>" type="text" placeholder="Masukkan Tujuan Surat" class="form-control" id="tujuan" name="tujuan" required>
                    </div>
                </div>
                <div class="row mb-3" id="divtambah" style="display: none;">
                    <label for="tambahan" id="labeltambahan" class="col-sm-2 col-form-label">Keterangan Tambahan</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" value="<?= $mohon->tambahan; ?>" type="text" placeholder="Masukkan Keterangan Tambahan" class="form-control" id="tambahan" name="tambahan" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="scan_ktp" class="col-sm-2 col-form-label label">Scan KTP</label>
                    <div class="col-sm-1">
                        <img class="img-thumbnail img-preview" src="<?= base_url(); ?>/permohonan/<?= $mohon->scan_ktp; ?>" alt="">
                    </div>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fotoo" name="scan_ktp" onchange="previewImg()">
                            <input type="hidden" name="lama" value="<?= $mohon->scan_ktp; ?>">
                            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg (Ukuran Max 2 MB)</p>
                            <label for="scan_ktp" class="custom-file-label"><?= $mohon->scan_ktp; ?></label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="scan_kk" class="col-sm-2 col-form-label label">Scan KK</label>
                    <div class="col-sm-1">
                        <img class="img-thumbnail img-preview img_prev1" src="<?= base_url(); ?>/permohonan/<?= $mohon->scan_kk; ?>" alt="">
                    </div>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto1" name="scan_kk" onchange="previewImg()">
                            <input type="hidden" name="lama" value="<?= $mohon->scan_kk; ?>">
                            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg (Ukuran Max 2 MB)</p>
                            <label for="scan_kk" class="custom-file-label img_lab1"><?= $mohon->scan_kk; ?></label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3" id="divjamkes" style="display: none;">
                    <label for="scan_jamkes" class="col-sm-2 col-form-label label">Scan Jamkesmas</label>
                    <div class="col-sm-1">
                        <img class="img-thumbnail img-preview img_prev2" src="<?= base_url(); ?>/permohonan/<?= $mohon->scan_jamkes; ?>" alt="">
                    </div>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto2" name="scan_jamkes" onchange="previewImg()">
                            <input type="hidden" name="lama" value="<?= $mohon->scan_jamkes; ?>">
                            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg (Ukuran Max 2 MB)</p>
                            <label for="scan_jamkes" class="custom-file-label img_lab2"><?= $mohon->scan_jamkes; ?></label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id_permohonan" value="<?= $mohon->id_permohonan; ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</section>
<!-- /.content -->

<!-- /.content -->
<?= $this->endSection(); ?>