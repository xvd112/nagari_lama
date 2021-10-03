<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <?= form_open('keluarga/hapusbanyak', ['class' => 'formhapus']) ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (session()->getFlashdata('pesan_keluarga')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_keluarga'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('danger_keluarga')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('danger_keluarga'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('warning_keluarga')) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('warning_keluarga'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
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
                                        <a href="<?php echo base_url('/keluarga/input'); ?>" style="color: white;">
                                            <i class="far fa-plus-square"> Tambah Data</i>
                                        </a>
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button type="submit" style="margin-left: 10px;" class="btn btn-danger tombolHapusBanyak" onclick="javascript:return confirm('Apakah ingin menghapus data ini ?')">
                                        <i class="far fa-trash-alt"> Hapus Data Terpilih</i>
                                    </button>
                                </li>

                                <li class="nav-item">
                                    <button type="button" class="btn" style="background:purple; margin-left:10px">
                                        <a href="<?php echo base_url('/keluarga/import'); ?>" style="color: white;">
                                            <i class="fas fa-file-import"> Import Data</i>
                                        </a>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="thead-dark" style="text-align: center;">
                                <tr>
                                    <th>
                                        <input type="checkbox" id="centangsemua">
                                    </th>
                                    <th style="text-align:center">No</th>
                                    <th style="text-align:center">Nomor KK</th>
                                    <th style="text-align:center">NIK Kepala Keluarga</th>
                                    <th style="text-align:center">Nama Kepala Keluarga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($keluarga as $data) {
                                ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" id="check" name="id_keluarga[]" class="centang" value="<?= $data['id_keluarga']; ?>">
                                        </td>
                                        <td><?= $no; ?></td>
                                        <td><?= $data['no_kk']; ?></td>
                                        <td><a href="<?= base_url(); ?>/penduduk/viewnik/<?= $data['nik_kepala']; ?>"><?= $data['nik_kepala']; ?></a></td>
                                        <td><?= $data['nama']; ?></td>
                                        <td style="text-align: center;">
                                            <a href="<?php echo base_url('/keluarga/view/' . $data['id_keluarga']); ?>" style="color: black;">
                                                <li class="far fa-eye"></li>
                                            </a>
                                            <a href="<?php echo base_url('keluarga/edit/' . $data['id_keluarga']); ?>" style="color: black;">
                                                <li class="far fa-edit"></li>
                                            </a>
                                            <a href="<?php echo base_url('keluarga/delete/' . $data['id_keluarga']); ?>" onclick="javascript:return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" style="color: black;">
                                                <li class="far fa-trash-alt"></li>
                                            </a>
                                        </td>
                                    </tr>
                                <?php $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>