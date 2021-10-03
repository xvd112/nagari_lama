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
    <form method="post" action="<?= base_url('lahir/add'); ?>">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-id-card mr-1"></i>
                    Data Kelahiran
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
                    <label for="id_keluarga" class="col-sm-2 col-form-label">No Kartu Keluarga</label>
                    <div class="col-md-10 col-sm-10">
                        <select onchange="ambilDataOrtu()" class="form-control select2bs4" name="id_keluarga" id="id_keluarga" required>
                            <option value="">Pilih No Kartu Keluarga</option>
                            <?php
                            foreach ($no_kk as $kel) {
                            ?>
                                <option value="<?php echo $kel['id_keluarga'] ?>"><?php echo $kel['no_kk'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nm_ayah" class="col-sm-2 col-form-label">Nama Ayah</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" placeholder="Masukkan Nama Ayah" class="form-control" id="nm_ayah" name="nm_ayah" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nik_ayah" class="col-sm-2 col-form-label">NIK Ayah</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" placeholder="Masukkan NIK Ayah" class="form-control" id="nik_ayah" name="nik_ayah" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nm_ibu" class="col-sm-2 col-form-label">Nama Ibu</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" placeholder="Masukkan Nama Ibu" class="form-control" id="nm_ibu" name="nm_ibu" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nik_ibu" class="col-sm-2 col-form-label">NIK Ibu</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" placeholder="Masukkan NIK Ibu" class="form-control" id="nik_ibu" name="nik_ibu" required>
                    </div>
                </div>
            </div>
        </div>
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
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" placeholder="Masukkan Nama" class="form-control" id="nama" name="nama" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tpt_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" placeholder="Masukkan Tempat Lahir" class="form-control" id="tpt_lahir" name="tpt_lahir" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" value="<?= date('Y-m-d'); ?>" placeholder="yyyy-mm-dd" type="date" id="datepicker" class="form-control" name="tgl_lahir" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jekel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <input type="radio" name="jekel" value="Laki - Laki" checked> Laki - laki
                        <input type="radio" name="jekel" value="Perempuan"> Perempuan
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-danger">Clear</button>
    </form>
</section>
<!-- /.content -->

<!-- /.content -->
<?= $this->endSection(); ?>