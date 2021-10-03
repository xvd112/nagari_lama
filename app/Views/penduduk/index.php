<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

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
                            <i class="fas fa-user-friends mr-1"></i>
                            Data penduduk
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li>
                                    <button type="button" style="margin-left: 10px;" class="btn btn-success">
                                        <a href="<?php echo base_url('/penduduk/input'); ?>" style="color: white;">
                                            <i class="far fa-plus-square"> Tambah Data</i>
                                        </a>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="btn" style="background:purple; margin-left:10px">
                                        <a href="<?php echo base_url('/penduduk/import'); ?>" style="color: white;">
                                            <i class="fas fa-file-import"> Import Data</i>
                                        </a>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="btn" style="background:grey; margin-left:10px">
                                        <a href="<?php echo base_url('/penduduk/laporan'); ?>" style="color: white;">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <b>Total Penduduk : </b><?= $jml; ?> orang
                        <div style="float: right;">
                            <form method="post" action="">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" aria-describedby="basic-addon2" name="key">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" name="submit" type="submit">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?= form_open('penduduk/hapusbanyak', ['class' => 'formhapus']) ?>
                        <div style="padding-bottom: 10px;">
                            <button type="submit" style="margin-left: 10px;" class="btn btn-danger tombolHapusBanyak" onclick="javascript:return confirm('Apakah ingin menghapus data ini ?')">
                                <i class="far fa-trash-alt"> Hapus</i>
                            </button>
                        </div>
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark" style="text-align: center;">
                                <tr>
                                    <th>
                                        <input type="checkbox" id="centangsemua">
                                    </th>
                                    <th style="text-align:center">No</th>
                                    <th style="text-align:center">Nomor KK</th>
                                    <th style="text-align:center">NIK</th>
                                    <th style="text-align:center">Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <?php
                            $no = 1 + (10 * ($currentPage - 1));
                            foreach ($penduduk as $data) {
                            ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <input type="checkbox" id="check" name="id_penduduk[]" class="centang" value="<?= $data['id_penduduk']; ?>">
                                    </td>
                                    <td><?= $no; ?></td>
                                    <td id="no_kk"><a href="<?= base_url(); ?>/keluarga/view/<?= $data['id_keluarga']; ?>"><?= $data['no_kk']; ?></a></td>
                                    <td id="nik"><?= $data['nik']; ?></td>
                                    <td id="nama"><?= $data['nama']; ?></td>
                                    <td style="text-align: center;">
                                        <a href="<?php echo base_url('/penduduk/view/' . $data['id_penduduk']); ?>" style="color: black;">
                                            <li class="far fa-eye"></li>
                                        </a>
                                        <a href="<?php echo base_url('penduduk/edit/' . $data['id_penduduk']); ?>" style="color: black;">
                                            <li class="far fa-edit"></li>
                                        </a>
                                        <a href="<?php echo base_url('penduduk/delete/' . $data['id_penduduk']); ?>" onclick="javascript:return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" style="color: black;">
                                            <li class="far fa-trash-alt"></li>
                                        </a>
                                    </td>
                                </tr>
                            <?php $no++;
                            }
                            ?>
                        </table>
                        <?= form_close(); ?>
                        <?= $pager->links('data', 'bootstrap_pagination') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>