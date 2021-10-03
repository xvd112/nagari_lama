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
                            View Data Penduduk
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <button type="button" class="btn btn-success">
                                        <a href="<?php echo base_url('/penduduk/edit/' . $penduduk->id_penduduk); ?>" style="color: white;">
                                            <i class="fas fa-edit"> Edit Data</i>
                                        </a>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td rowspan="12" style="width: 1px;">
                                    <img src="<?= base_url(); ?>/penduduk/<?= $penduduk->foto; ?>" alt="Foto <?= $penduduk->nama; ?>" height="150px">
                                </td>
                                <th>NIK</th>
                                <td> : <?= $penduduk->nik; ?></td>
                                <th>Provinsi</th>
                                <td> : <?= $alm->prov; ?></td>
                            </tr>
                            <tr>
                                <th>No KK</th>
                                <td> : <a href="<?= base_url(); ?>/keluarga/view/<?= $penduduk->id_keluarga; ?>"><?= $penduduk->no_kk; ?></a></td>
                                <th>Agama</th>
                                <td> : <?= $penduduk->agama; ?></td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td> : <?= $penduduk->nama; ?></td>
                                <th>Status Perkawinan</th>
                                <td> : <?= $penduduk->status_kawin; ?></td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir</th>
                                <td> : <?= $penduduk->tpt_lahir; ?></td>
                                <th>Status Hubungan</th>
                                <td> : <?= $penduduk->status_hub; ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td> : <?= $penduduk->tgl_lahir; ?></td>
                                <th>Kode Pos</th>
                                <td> : <?= $alm->kd_pos; ?></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td> : <?= $penduduk->jekel; ?></td>
                                <th>Golongan Darah</th>
                                <td> : <?= $penduduk->goldar; ?></td>
                            </tr>
                            <tr>
                                <th>Nama Ayah</th>
                                <td> : <?= $penduduk->nm_ayah; ?></td>
                                <th>Pendidikan</th>
                                <td> : <?= $penduduk->pendidikan; ?></td>
                            </tr>
                            <tr>
                                <th>Nama Ibu</th>
                                <td> : <?= $penduduk->nm_ibu; ?></td>
                                <th>Pekerjaan</th>
                                <td> : <?= $penduduk->kerja; ?></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td> : <?= $penduduk->alamat; ?></td>
                                <th>Kewarganegaraan</th>
                                <td> : <?= $penduduk->kwn; ?></td>
                            </tr>
                            <tr>
                                <th>Nagari</th>
                                <td> : <?= $alm->nagari; ?></td>
                                <th>Masa Berlaku</th>
                                <td> : Seumur Hidup</td>
                            </tr>
                            <tr>
                                <th>Kecamatan</th>
                                <td> : <?= $alm->kec; ?></td>
                                <th>Keterangan</th>
                                <td> : <?= $penduduk->ket; ?></td>
                            </tr>
                            <tr>
                                <th>Kabupaten</th>
                                <td> : <?= $alm->kab; ?></td>
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