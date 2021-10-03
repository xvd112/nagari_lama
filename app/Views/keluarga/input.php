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
    <form method="post" action="<?= base_url('keluarga/add'); ?>">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-id-card mr-1"></i>
                    Data Kartu Keluarga
                </h3>
            </div>
            <div class="container-fluid card-body">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="no_kk" class="col-sm-2 col-form-label">No Kartu Keluarga</label>
                    <div class="col-sm-10">
                        <input required autocomplete="off" autofocus placeholder="0000000000000000" minlength="16" maxlength="16" type="text" class="form-control" name="no_kk" id="no_kk">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user mr-1"></i>
                    Data Pribadi Kepala Keluarga
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
                    <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" placeholder="0000000000000000" maxlength="16" minlength="16" class="form-control" id="nik" name="nik" required>
                    </div>
                </div>
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
                        <input autocomplete="off" placeholder="yyyy-mm-dd" type="date" id="datepicker" class="form-control" name="tgl_lahir" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jekel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <input type="radio" name="jekel" value="Laki - Laki" checked> Laki - laki
                        <input type="radio" name="jekel" value="Perempuan"> Perempuan
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <select required class="form-control select2bs4" name="alamat" id="alamat" required autocomplete="off">
                            <option value="">Pilih Alamat </option>
                            <?php
                            $data = array(
                                "Jorong Gunuang Rajo Utara", "Jorong Gantiang"
                            );
                            for ($i = 0; $i < count($data); $i++) {
                            ?>
                                <option value="<?php echo $data[$i] ?>"><?php echo $data[$i] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kwn" class="col-sm-2 col-form-label">Kewarganegaraan</label>
                    <div class="col-sm-10">
                        <div class="col-sm-10">
                            <input type="radio" name="kwn" value="WNI" checked> WNI
                            <input type="radio" name="kwn" value="WNA"> WNA
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="agama" id="agama" required>
                            <option value="">Pilih Agama</option>
                            <?php
                            foreach ($agama as $agama) {
                            ?>
                                <option value="<?php echo $agama['nama'] ?>"><?php echo $agama['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status_kawin" class="col-sm-2 col-form-label">Status Perkawinan</label>
                    <div class="col-sm-10">
                        <select class="form-control select2bs4" name="status_kawin" id="status_kawin" required>
                            <option value="">Pilih Status </option>
                            <?php
                            foreach ($status_kawin as $status_kawin) {
                            ?>
                                <option value="<?php echo $status_kawin['nama'] ?>"><?php echo $status_kawin['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status_hub" class="col-sm-2 col-form-label">Status Hubungan</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" readonly value="Kepala Keluarga" class="form-control" id="status_hub" name="status_hub" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="goldar" class="col-sm-2 col-form-label">Golongan Darah</label>
                    <div class="col-sm-10">
                        <select class="form-control select2bs4" name="goldar" id="goldar" required>
                            <option value="-">Pilih Golongan Darah</option>
                            <?php
                            $goldar = [
                                'A', 'B', 'AB', 'O', '-'
                            ];
                            foreach ($goldar as $goldar) {
                            ?>
                                <option value="<?php echo $goldar ?>"><?php echo $goldar ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
                    <div class="col-sm-10">
                        <select class="form-control select2bs4" name="pendidikan" id="pendidikan" required>
                            <option value="">Pilih Pendidikan</option>
                            <?php
                            foreach ($pendidikan as $pendidikan) {
                            ?>
                                <option value="<?php echo $pendidikan['nama'] ?>"><?php echo $pendidikan['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kerja" class="col-sm-2 col-form-label">Pekerjaan</label>
                    <div class="col-sm-10">
                        <select class="form-control select2bs4" name="kerja" id="kerja" required>
                            <option value="">Pilih Pekerjaan </option>
                            <?php
                            foreach ($pekerjaan as $pekerjaan) {
                            ?>
                                <option value="<?php echo $pekerjaan['nama'] ?>"><?php echo $pekerjaan['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="paspor" class="col-sm-2 col-form-label">No Paspor</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" placeholder="Masukkan No Paspor" class="form-control" id="paspor" name="paspor">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kitap" class="col-sm-2 col-form-label">No Kitap</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" placeholder="Masukkan No Kitap" class="form-control" id="kitap" name="kitap">
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user mr-1"></i>
                    Data Keluarga Kepala Keluarga
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
                    <label for="nm_ayah" class="col-sm-2 col-form-label">Nama Ayah</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" placeholder="Masukkan Nama Ayah" class="form-control" id="nm_ayah" name="nm_ayah" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nik_ayah" class="col-sm-2 col-form-label">NIK Ayah</label>
                    <div class="col-sm-10">
                        <input autocomplete="off" type="text" placeholder="Masukkan NIK Ayah" class="form-control" id="nik_ayah" name="nik_ayah">
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
                        <input autocomplete="off" type="text" placeholder="Masukkan NIK Ibu" class="form-control" id="nik_ibu" name="nik_ibu">
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