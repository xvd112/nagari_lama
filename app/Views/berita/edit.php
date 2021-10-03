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
            <form method="post" action="<?= base_url('berita/update'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis Berita</label>
                    <div class="col-sm-10">
                        <input readonly value="<?= $berita->penulis; ?>" autocomplete="off" placeholder="Masukkan Penulis Berita" required type="text" class="form-control" id="penulis" name="penulis">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul Berita</label>
                    <div class="col-sm-10">
                        <input value="<?= $berita->judul; ?>" autocomplete="off" autofocus placeholder="Masukkan Judul Berita" required type="text" class="form-control" id="judul" name="judul">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="foto" class="col-sm-2 col-form-label label">Foto</label>
                    <div class="col-sm-2">
                        <img class="img-thumbnail img-preview" src="<?= base_url(); ?>/berita/<?php if ($berita->gambar == NULL and $berita->gambar == 'no_image.png') {
                                                                                                    echo 'no_image.png';
                                                                                                } else {
                                                                                                    echo $berita->gambar;
                                                                                                } ?>" alt="">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fotoo" name="foto" onchange="previewImg()">
                            <input type="hidden" name="lama" value="<?= $berita->gambar; ?>">
                            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg (Ukuran Max 10 MB dan Nama File Sesuai Nama)</p>
                            <label for="foto" class="custom-file-label"><?= $berita->gambar; ?></label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="isi" class="col-sm-2 col-form-label">Isi Berita</label>
                    <div class="col-sm-10">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Masukkan Isi Berita
                                </h3>
                            </div>
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <textarea name="isi" id="isi" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $berita->isi; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="<?= $berita->id_berita; ?>" name="id_berita" id="id_berita">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Clear</button>
            </form>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- /.content -->
<?= $this->endSection(); ?>