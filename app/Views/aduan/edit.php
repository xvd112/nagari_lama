<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <?php if (session()->getFlashdata('error')) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <form method="post" action="<?= base_url('/aduan/update'); ?>" enctype="multipart/form-data">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-1"></i>
                    <?= $title; ?>
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
                    <label for="foto" class="col-sm-2 col-form-label label">Foto</label>
                    <div class="col-sm-2">
                        <img class="img-thumbnail img-preview" src="<?= base_url(); ?>/aduan/<?php if ($aduan->gambar == NULL and $aduan->gambar == 'no_image.png') {
                                                                                                    echo 'no_image.png';
                                                                                                } else {
                                                                                                    echo $aduan->gambar;
                                                                                                } ?>" alt="">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fotoo" name="foto" onchange="previewImg()">
                            <input type="hidden" name="lama" value="<?= $aduan->gambar; ?>">
                            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg (Ukuran Max 10 MB dan Nama File Sesuai Nama)</p>
                            <label for="foto" class="custom-file-label"><?= $aduan->gambar; ?></label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="aduan" class="col-form-label">Aduan</label>
                    <textarea name="aduan" id="aduan" style="height: 200px;"><?= $aduan->aduan; ?></textarea>
                </div>
                <input type="hidden" name="id_aduan" value="<?= $aduan->id_aduan; ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</section>

<?= $this->endSection(); ?>