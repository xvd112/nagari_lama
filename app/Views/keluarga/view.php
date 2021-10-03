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
                            Data Keluarga
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <button type="button" class="btn btn-success">
                                        <a href="<?php echo base_url('/keluarga/edit/' . $keluarga->id_keluarga); ?>" style="color: white;">
                                            <i class="fas fa-edit"> Edit Data</i>
                                        </a>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3>Jumlah Anggota Keluarga : <?= $jml->x; ?></h3>
                            </div>
                            <div class="col">
                                <p style="text-align: right;">No Kartu Keluarga : <?= $keluarga->no_kk; ?>
                                <p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <table>
                                    <tr>
                                        <th>Nama Kepala Keluarga</th>
                                        <td> : </td>
                                        <td><?= $anggota[0]['nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td> : </td>
                                        <td><?= $keluarga->alamat; ?></td>
                                    </tr>
                                    <tr>
                                        <th>RT/RW</th>
                                        <td> : </td>
                                        <td>000/000</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Pos</th>
                                        <td> : </td>
                                        <td><?= $alm->kd_pos; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col">
                                <table>
                                    <tr>
                                        <th>Desa/Kelurahan</th>
                                        <td> : </td>
                                        <td><?= $alm->nagari; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kecamatan</th>
                                        <td> : </td>
                                        <td><?= $alm->kec; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kabupaten/Kota</th>
                                        <td> : </td>
                                        <td><?= $alm->kab; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Provinsi</th>
                                        <td> : </td>
                                        <td><?= $alm->prov; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered table-hover">
                            <thead class="table-info" style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>NIK</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Agama</th>
                                    <th>Pendidikan</th>
                                    <th>Jenis Pekerjaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if ($anggota != NULL) {
                                    for ($i = 0; $i < count($anggota); $i++) {
                                ?>
                                        <tr>
                                            <td align="center"><?= $no; ?></td>
                                            <td><?= $anggota[$i]['nama'] ?></td>
                                            <td><a href="<?= base_url(); ?>/penduduk/viewnik/<?= $anggota[$i]['nik'] ?>"><?= $anggota[$i]['nik'] ?></a></td>
                                            <td><?= $anggota[$i]['jekel'] ?></td>
                                            <td><?= $anggota[$i]['tpt_lahir'] ?></td>
                                            <td><?= date('d M Y', strtotime($anggota[$i]['tgl_lahir'])) ?></td>
                                            <td><?= $anggota[$i]['agama'] ?></td>
                                            <td><?= $anggota[$i]['pendidikan'] ?></td>
                                            <td><?= $anggota[$i]['kerja'] ?></td>
                                        </tr>
                                <?php $no++;
                                    }
                                } ?>
                            </tbody>
                        </table>
                        <br>
                        <table class="table table-bordered table-hover">
                            <thead class="table-info" style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Status Perkawinan</th>
                                    <th>Status Hubungan Dalam Keluarga</th>
                                    <th>Kewarganegaraan</th>
                                    <th>Nama Ayah</th>
                                    <th>Nama Ibu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if ($anggota != NULL) {
                                    for ($i = 0; $i < count($anggota); $i++) {
                                ?>
                                        <tr>
                                            <td align="center"><?= $no; ?></td>
                                            <td><?= $anggota[$i]['status_kawin'] ?></td>
                                            <td><?= $anggota[$i]['status_hub'] ?></td>
                                            <td><?= $anggota[$i]['kwn'] ?></td>
                                            <td><?= $anggota[$i]['nm_ayah'] ?></td>
                                            <td><?= $anggota[$i]['nm_ibu'] ?></td>
                                        </tr>
                                <?php $no++;
                                    }
                                }
                                ?>
                            </tbody>
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