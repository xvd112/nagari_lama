<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

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
            <form method="post" action="<?= base_url('galeri/update'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="jenis" class="col-sm-2 col-form-label">Jenis Foto / Judul</label>
                    <div class="col-sm-10">
                        <input <?php if ($galeri->id_galeri <= 15) {
                                    echo 'readonly';
                                } ?> value="<?= $galeri->jenis; ?>" autocomplete="off" autofocus placeholder="Masukkan Jenis Foto / Judul" required type="text" class="form-control" id="jenis" name="jenis">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="foto" class="col-sm-2 col-form-label label">Foto</label>
                    <div class="col-sm-1">
                        <img class="img-thumbnail img-preview" src="<?= base_url(); ?>/aset/img/<?= $galeri->foto; ?>" alt="">
                    </div>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fotoo" name="foto" onchange="previewImg()">
                            <input type="hidden" name="lama" value="<?= $galeri->foto; ?>">
                            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg (Ukuran Max 10 MB dan Nama File Sesuai Nama)</p>
                            <label for="foto" class="custom-file-label"><?= $galeri->foto; ?></label>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="<?= $galeri->id_galeri; ?>" name="id_galeri" id="id_galeri">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>