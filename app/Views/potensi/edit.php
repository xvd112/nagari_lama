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
            <form method="post" action="<?= base_url('/potensi/update'); ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input value="<?= $potensi->nama; ?>" autocomplete="off" placeholder="Masukkan Nama" required type="text" class="form-control" id="nama" name="nama">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="foto" class="col-sm-2 col-form-label label">Foto</label>
                    <div class="col-sm-2">
                        <img class="img-thumbnail img-preview" src="<?= base_url(); ?>/potensi/<?= $potensi->foto; ?>" alt="">
                    </div>
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fotoo" name="foto" onchange="previewImg()">
                            <input type="hidden" name="lama" value="<?= $potensi->foto; ?>">
                            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg (Ukuran Max 10 MB dan Nama File Sesuai Nama)</p>
                            <label for="foto" class="custom-file-label"><?= $potensi->foto; ?></label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ket" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Masukkan Keterangan
                                </h3>
                            </div>
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <textarea name="ket" id="ket" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $potensi->ket; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="<?= $potensi->id_potensi; ?>" name="id_potensi" id="id_potensi">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Clear</button>
            </form>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- /.content -->
<?= $this->endSection(); ?>