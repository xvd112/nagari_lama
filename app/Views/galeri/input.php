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
            <form method="post" action="<?= base_url('galeri/add'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="jenis" class="col-sm-2 col-form-label">Jenis Foto / Judul</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" autofocus placeholder="Masukkan Jenis Foto / Judul" required type="text" class="form-control" id="jenis" name="jenis" style="background:lightgrey">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="foto" class="col-sm-2 col-form-label label">Foto</label>
                    <div class="col-sm-1">
                        <img class="img-thumbnail img-preview" src="/img/no_image.png" alt="">
                    </div>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input required type="file" class="custom-file-input" id="fotoo" name="foto" onchange="previewImg()">
                            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg (Ukuran Max 2 MB)</p>
                            <label for="foto" class="custom-file-label" style="background:lightgrey">Masukkan Gambar</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Clear</button>
            </form>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>