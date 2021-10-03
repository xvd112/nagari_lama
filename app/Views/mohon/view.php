<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>
<?= $this->include('template/tgl'); ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-eye mr-1"></i>
                            View Data : <?= $mohon->jenis; ?> ~ <?= tgl_indo($mohon->tgl_masuk); ?>
                        </h3>
                        <?php if (session()->get('level') == 3) { ?>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <button type="button" style="margin-left: 10vh;" class="btn btn-success">
                                            <a href="<?php echo base_url('/permohonan/edit/' . $mohon->id_permohonan); ?>" style="color: white;">
                                                <i class="far fa-plus-square"> Edit Data</i>
                                            </a>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        <?php } ?>
                        <?php if ((session()->get('level') == 1 or session()->get('level') == 2) and $mohon->ket == 'Diterima') { ?>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <button type="button" style="margin-left: 10vh;" class="btn btn-success">
                                            <a href="<?php echo base_url('/permohonan/surat/' . $mohon->id_permohonan); ?>" style="color: white;">
                                                <i class="far fa-plus-square"> Buat Surat</i>
                                            </a>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        <?php } ?>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Jenis Surat</th>
                                <td> : </td>
                                <td><?= $mohon->jenis; ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Permohoanan Surat</th>
                                <td> : </td>
                                <td><?= tgl_indo($mohon->tgl_masuk); ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td> : </td>
                                <td><b><u><?= $mohon->ket; ?></u></b></td>
                            </tr>
                            <tr>
                                <th>Tujuan Surat</th>
                                <td> : </td>
                                <td><?= $mohon->tujuan; ?></td>
                            </tr>
                            <tr>
                                <th><?php if ($mohon->jenis == 'SKU') {
                                        echo 'Jenis Usaha';
                                    } else {
                                        echo 'Penghasilan Orang Tua';
                                    } ?></th>
                                <td> : </td>
                                <td><?php if ($mohon->jenis == 'SKU') {
                                        echo $mohon->tambahan;
                                    } else {
                                        echo 'Rp' . number_format($mohon->tambahan, 2, ',', '.');
                                    } ?></td>
                            </tr>
                            <tr>
                                <th>Hasil Pemeriksaan</th>
                                <td> : </td>
                                <td><?php if ($mohon->hasil != NULL) {
                                        echo $mohon->hasil;
                                    } else {
                                        echo 'Belum ada';
                                    } ?></td>
                            </tr>
                        </table>
                        <table class="table">
                            <tr>
                                <th>Lampiran Scan KTP : </th>
                                <th>Lampiran Scan KK : </th>
                            </tr>
                            <tr>
                                <td><img src="<?= base_url(); ?>/permohonan/<?= $mohon->scan_ktp; ?>" alt="Scan KTP" width="100%"></td>
                                <td><img src="<?= base_url(); ?>/permohonan/<?= $mohon->scan_kk; ?>" alt="Scan KK" width="100%"></td>
                            </tr>
                        </table>
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