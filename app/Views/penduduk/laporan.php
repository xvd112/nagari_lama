<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (session()->getFlashdata('pesan_penduduk')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_penduduk'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('danger_penduduk')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('danger_penduduk'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('warning_penduduk')) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('warning_penduduk'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-file mr-1"></i>
                            <?= $ket[0]; ?>
                        </h3>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <form method="post" action="<?= base_url('penduduk/print'); ?>">
                            <div class="row mb-3">
                                <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                                <div class="col-sm-3">
                                    <select class="form-control select2bs4" name="tahun" id="tahun" required style="background:lightgrey">
                                        <option value="">Pilih Tahun </option>
                                        <?php
                                        $x = 2021;
                                        $jml = date('Y') - 2021;
                                        for ($i = 0; $i < $jml + 1; $i++) {
                                        ?>
                                            <option value="<?php echo $x ?>"><?php echo $x ?></option>
                                        <?php $x++;
                                        } ?>
                                    </select>
                                </div>
                                <label for="bulan" class="col-sm-2 col-form-label">Bulan</label>
                                <div class="col-sm-3">
                                    <select class="form-control select2bs4" name="bulan" id="bulan" required style="background:lightgrey">
                                        <option value="">Pilih Bulan </option> -->
                                        <?php
                                        $data = [
                                            '', 'Januari', 'Februari', 'Maret', 'April', 'Mei',
                                            'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
                                            'November', 'Desember'
                                        ];
                                        for ($i = 1; $i < count($data); $i++) {
                                        ?>
                                            <option value="<?php echo $i ?>"><?php echo $data[$i] ?></option>
                                        <?php }  ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-download"></i> Cetak</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- /.content -->
<?= $this->endSection(); ?>