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
                    <label for="alm" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea name="alm" id="alm" cols="30" rows="3" class="form-control" style="background:lightgrey"><?= $data->alm; ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nagari" class="col-sm-2 col-form-label">Nagari</label>
                    <div class="col-sm-10">
                        <input value="<?= $data->nagari; ?>" autocomplete="off" placeholder="Masukkan Nama Nagari" required type="text" class="form-control" id="nagari" name="nagari" style="background:lightgrey">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kec" class="col-sm-2 col-form-label">Kecamatan</label>
                    <div class="col-sm-10">
                        <input value="<?= $data->kec; ?>" autocomplete="off" placeholder="Masukkan Nama Kecamatan" required type="text" class="form-control" id="kec" name="kec" style="background:lightgrey">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kab" class="col-sm-2 col-form-label">Kabupaten</label>
                    <div class="col-sm-10">
                        <input value="<?= $data->kab; ?>" autocomplete="off" placeholder="Masukkan Nama Kabupaten" required type="text" class="form-control" id="kab" name="kab" style="background:lightgrey">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="prov" class="col-sm-2 col-form-label">Provinsi</label>
                    <div class="col-sm-10">
                        <input value="<?= $data->prov; ?>" autocomplete="off" placeholder="Masukkan Nama Provinsi" required type="text" class="form-control" id="prov" name="prov" style="background:lightgrey">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kd_pos" class="col-sm-2 col-form-label">Kode Pos</label>
                    <div class="col-sm-10">
                        <input value="<?= $data->kd_pos; ?>" autocomplete="off" placeholder="Masukkan Kode Pos" required type="text" class="form-control" id="kd_pos" name="kd_pos" style="background:lightgrey">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="map_kantor" class="col-sm-2 col-form-label">Maps Kantor</label>
                    <div class="col-sm-10">
                        <input value="<?= $data->map_kantor; ?>" autocomplete="off" placeholder="Masukkan Link Maps Kantor" required type="text" class="form-control" id="map_kantor" name="map_kantor" style="background:lightgrey">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="map_wilayah" class="col-sm-2 col-form-label">Maps Wilayah</label>
                    <div class="col-sm-10">
                        <textarea autocomplete="off" placeholder="Masukkan Link Maps Wilayah" required type="text" class="form-control" id="map_wilayah" name="map_wilayah" style="background:lightgrey"><?= $data->map_wilayah; ?></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- /.content -->
<?= $this->endSection(); ?>