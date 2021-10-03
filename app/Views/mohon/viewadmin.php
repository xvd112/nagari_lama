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
                                <th>Tujuan Surat</th>
                                <td> : <?= $mohon->tujuan; ?></td>
                            </tr>
                            <tr>
                                <th>Keterangan Tambahan</th>
                                <td> : <?= $mohon->tambahan; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-eye mr-1"></i>
                            Kelengkapan Syarat
                        </h3>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <form method="post" action="<?= base_url('/permohonan/update'); ?>" enctype="multipart/form-data">
                            <table class="table">
                                <tr>
                                    <th>Lampiran Scan KTP : </th>
                                    <td>
                                        <input class="form-check-input" value="KTP Tidak Sesuai" type="radio" name="ktp" id="ktp" checked> Tidak Sesuai
                                    </td>
                                    <td>
                                        <input class="form-check-input" value="KTP Sesuai" type="radio" name="ktp" id="ktp"> Sesuai
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"><img src="<?= base_url(); ?>/permohonan/<?= $mohon->scan_ktp; ?>" alt="Scan KTP" width="100%"></td>
                                </tr>
                                <tr>
                                    <th>Lampiran Scan KK : </th>
                                    <td>
                                        <input class="form-check-input" value="KK Tidak Sesuai" type="radio" name="kk" id="kk" checked> Tidak Sesuai
                                    </td>
                                    <td>
                                        <input class="form-check-input" value="KK Sesuai" type="radio" name="kk" id="kk"> Sesuai
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"><img src="<?= base_url(); ?>/permohonan/<?= $mohon->scan_jamkes; ?>" alt="Scan Jamkesmas" width="100%"></td>
                                </tr>
                                <?php if ($mohon->jenis == 'SKM') { ?>
                                    <tr>
                                        <th>Lampiran Scan Jamkesmas: </th>
                                        <td>
                                            <input class="form-check-input" value="Jamkes Tidak Sesuai" type="radio" name="jamkes" id="jamkes" checked> Tidak Sesuai
                                        </td>
                                        <td>
                                            <input class="form-check-input" value="Jamkes Sesuai" type="radio" name="jamkes" id="jamkes"> Sesuai
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><img src="<?= base_url(); ?>/permohonan/<?= $mohon->scan_kk; ?>" alt="Scan KK" width="100%"></td>
                                    </tr>
                                <?php } ?>
                                <input type="hidden" name="jenis" value="<?= $mohon->jenis; ?>">
                            </table>
                            <input type="hidden" name="id_permohonan" value="<?= $mohon->id_permohonan; ?>">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-eye mr-1"></i>
                            Data Penduduk
                        </h3>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Nama</th>
                                <td> : <?= $penduduk->nama; ?></td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <td> : <?= $penduduk->nik; ?></td>
                            </tr>
                            <tr>
                                <th>No KK</th>
                                <td> : <?= $penduduk->no_kk; ?></td>
                            </tr>
                            <tr>
                                <th>Tempat / Tanggal Lahir</th>
                                <td> : <?= $penduduk->tpt_lahir; ?> / <?= tgl_indo($penduduk->tgl_lahir); ?></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td> : <?= $penduduk->jekel; ?></td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td> : <?= $penduduk->agama; ?></td>
                            </tr>
                            <tr>
                                <th>Pekerjaan</th>
                                <td> : <?= $penduduk->kerja; ?></td>
                            </tr>
                            <tr>
                                <th>Status Perkawinan</th>
                                <td> : <?= $penduduk->status_kawin; ?></td>
                            </tr>
                            <tr>
                                <th>Status Hubungan</th>
                                <td> : <?= $penduduk->status_hub; ?></td>
                            </tr>
                            <tr>
                                <th>Pendidikan</th>
                                <td> : <?= $penduduk->pendidikan; ?></td>
                            </tr>
                            <tr>
                                <th>Nama Ayah</th>
                                <td> : <?= $penduduk->nm_ayah; ?></td>
                            </tr>
                            <tr>
                                <th>Nama Ibu</th>
                                <td> : <?= $penduduk->nm_ibu; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
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