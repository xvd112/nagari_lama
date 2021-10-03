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

    <form method="post" action="<?= base_url('/data/updateinfo'); ?>" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-phone mr-1"></i>
                    Kontak
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="container-fluid card-body">
                <div class="row mb-3">
                    <label for="telp" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <input value="<?= $tambah->telp; ?>" autocomplete="off" placeholder="Masukkan Nomor Telepon" type="text" class="form-control" id="telp" name="telp" style="background:lightgrey">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" value="<?= $tambah->email; ?>" autocomplete="off" placeholder="Masukkan Email" type="text" class="form-control" id="email" name="email" style="background:lightgrey">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info mr-1"></i>
                    Info
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="container-fluid card-body">
                <div class="row mb-3">
                    <label for="kata_sambutan" class="col-sm-2 col-form-label">Kata Sambutan</label>
                    <div class="col-sm-10">
                        <div class="card card-outline card-info">
                            <div class="card-header" style="background:lightgrey">
                                <h3 class="card-title">
                                    Masukkan Kata Sambutan
                                </h3>
                            </div>
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <textarea name="kata_sambutan" id="kata_sambutan" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $data->kata_sambutan; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="visi" class="col-sm-2 col-form-label">Visi</label>
                    <div class="col-sm-10">
                        <div class="card card-outline card-info">
                            <div class="card-header" style="background:lightgrey">
                                <h3 class="card-title">
                                    Masukkan Visi
                                </h3>
                            </div>
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <textarea name="visi" id="visi" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $data->visi; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="misi" class="col-sm-2 col-form-label">Misi</label>
                    <div class="col-sm-10">
                        <div class="card card-outline card-info">
                            <div class="card-header" style="background:lightgrey">
                                <h3 class="card-title">
                                    Masukkan Misi
                                </h3>
                            </div>
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <textarea name="misi" id="misi" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $data->misi; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sejarah" class="col-sm-2 col-form-label">Sejarah</label>
                    <div class="col-sm-10">
                        <div class="card card-outline card-info">
                            <div class="card-header" style="background:lightgrey">
                                <h3 class="card-title">
                                    Masukkan Sejarah
                                </h3>
                            </div>
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <textarea name="sejarah" id="sejarah" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $data->sejarah; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="wilayah" class="col-sm-2 col-form-label">Wilayah</label>
                    <div class="col-sm-10">
                        <div class="card card-outline card-info">
                            <div class="card-header" style="background:lightgrey">
                                <h3 class="card-title">
                                    Masukkan Wilayah
                                </h3>
                            </div>
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <textarea name="wilayah" id="wilayah" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $data->wilayah; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="surat" class="col-sm-2 col-form-label">Persyaratan Surat</label>
                    <div class="col-sm-10">
                        <div class="card card-outline card-info">
                            <div class="card-header" style="background:lightgrey">
                                <h3 class="card-title">
                                    Masukkan Persyaratan Surat
                                </h3>
                            </div>
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <textarea name="surat" id="surat" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $data->syarat_surat; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</section>
<!-- /.content -->

<!-- /.content -->
<?= $this->endSection(); ?>