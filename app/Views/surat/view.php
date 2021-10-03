<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-user-friends mr-1"></i>
                            View Data Surat : <?= $surat->tambahan; ?> -> <?= $surat->nama; ?>
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <button type="button" style="margin-left: 10px;" class="btn btn-success">
                                        <a href="<?php echo base_url($link . '/edit/' . $surat->id_surat); ?>" style="color: white;">
                                            <i class="far fa-plus-square"> Edit Data</i>
                                        </a>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="btn" style="background:grey; margin-left:10px">
                                        <a href="<?php echo base_url($link . '/print/' . $surat->id_surat); ?>" style="color: white;">
                                            <i class="fas fa-print"></i>
                                        </a>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body" align="center">
                        <?= $this->include('template/tgl'); ?>
                        <div class="row">
                            <div class="col-sm-2">
                                <img src="<?= base_url(); ?>/aset/img/<?= $gal->foto; ?>" alt="" width="100px">
                            </div>
                            <div class="col">
                                <h3><b>PEMERINTAHAN KABUPATEN <?= strtoupper($data->kab); ?></b></h3>
                                <h3><b>KECAMATAN <?= strtoupper($data->kec); ?></b></h3>
                                <h3><b>WALI NAGARI <?= strtoupper($data->nagari); ?></b></h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" style="text-align: left;"><b><?= $data->alm; ?></b></div>
                            <div class="col" style="text-align: right;"><b>Kode Pos <?= $data->kd_pos; ?></b></div>
                        </div>
                        <hr>
                        <div><b><u><?= $jenis_s; ?></u></b></div>
                        <div>NO.<?= $surat->no_surat; ?><?= $label_s; ?><?= date('Y', strtotime($surat->tgl_surat)); ?></div>
                        <br>
                        <div style="text-align: justify;">
                            <table class="table">
                                <tr>
                                    <th>NIK</th>
                                    <td> : </td>
                                    <td><?= $surat->nik ?></td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td> : </td>
                                    <td><?= $surat->nama ?></td>
                                </tr>
                                <tr>
                                    <th>Tujuan</th>
                                    <td> : </td>
                                    <td><?= $surat->tujuan ?></td>
                                </tr>
                                <tr>
                                    <th><?= $label; ?></th>
                                    <td> : </td>
                                    <td><?php if ($link != 'sku') {
                                            echo 'Rp' . number_format($surat->tambahan, 2, ',', '.');
                                        } else {
                                            echo $surat->tambahan;
                                        } ?></td>
                                </tr>
                                <tr>
                                    <th>Yang Menandatangani</th>
                                    <td> : </td>
                                    <td><?= $ttd->nama; ?> - <?= $ttd->jabatan; ?></td>
                                </tr>
                            </table>
                        </div>
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