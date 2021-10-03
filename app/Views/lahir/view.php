<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-user-friends mr-1"></i>
                            View Data Kelahiran
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
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td rowspan="12" style="width: 1px;">
                                    <img src="<?= base_url(); ?>/penduduk/<?php if ($penduduk->foto == NULL or $penduduk->foto == 'default.jpg') {
                                                                                echo 'default.jpg';
                                                                            } else {
                                                                                $penduduk->foto;
                                                                            } ?>" alt="Foto <?= $penduduk->nama; ?>" height="150px">
                                </td>
                                <th>No KK</th>
                                <td> : <?= $penduduk->no_kk; ?></td>
                                <th>Nama Ayah</th>
                                <td> : <?= $penduduk->nm_ayah; ?></a></td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td> : <?= $penduduk->nama; ?></td>
                                <th>NIK Ayah</th>
                                <td> : <a href="<?= base_url(); ?>/penduduk/viewortu/<?= $penduduk->nik_ayah; ?>"><?= $penduduk->nik_ayah; ?></a></td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir</th>
                                <td> : <?= $penduduk->tpt_lahir; ?></td>
                                <th>Nama Ibu</th>
                                <td> : <?= $penduduk->nm_ibu; ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td> : <?= $penduduk->tgl_lahir; ?></td>
                                <th>NIK Ibu</th>
                                <td> : <a href="<?= base_url(); ?>/penduduk/viewortu/<?= $penduduk->nik_ibu; ?>"><?= $penduduk->nik_ibu; ?></a></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td> : <?= $penduduk->jekel; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection(); ?>