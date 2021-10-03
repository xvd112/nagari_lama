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
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Jenis Surat</th>
                                <td> : <?= $mohon->jenis; ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Permohoanan Surat</th>
                                <td> : <?= tgl_indo($mohon->tgl_masuk); ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td> : <?= $mohon->ket; ?></td>
                            </tr>
                            <tr>
                                <th>Tujuan Surat</th>
                                <td> : <?= $mohon->tujuan; ?></td>
                            </tr>
                            <tr>
                                <th>Keterangan Tambahan</th>
                                <td> : <?= $mohon->tambahan; ?></td>
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