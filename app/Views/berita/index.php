<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (session()->getFlashdata('pesan_berita')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_berita'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('danger_berita')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('danger_berita'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('warning_berita')) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('warning_berita'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-newspaper mr-1"></i>
                            <?= $ket[0]; ?>
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <button type="button" style="margin-left: 10px;" class="btn btn-success">
                                        <a href="<?php echo base_url('berita/input'); ?>" style="color: white;">
                                            <i class="far fa-plus-square"> Tambah Data</i>
                                        </a>
                                    </button>
                                </li>
                                <?= form_open('berita/hapusbanyak', ['class' => 'formhapus']) ?>
                                <li class="nav-item">
                                    <button type="submit" style="margin-left: 10px;" class="btn btn-danger tombolHapusBanyak" onclick="javascript:return confirm('Apakah ingin menghapus data ini ?')">
                                        <i class="far fa-trash-alt"> Hapus Data Terpilih</i>
                                    </button>
                                </li>
                                <?= form_close(); ?>
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
                                    <th style="text-align:center">Judul Berita</th>
                                    <th style="text-align:center">Penulis</th>
                                    <th style="text-align:center">Tanggal Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($berita as $data) {
                                ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" id="check" name="id_berita[]" class="centang" value="<?= $data['id_berita']; ?>">
                                        </td>
                                        <td><?= $no; ?></td>
                                        <td><?= $data['judul']; ?></td>
                                        <td><?= $data['penulis']; ?></td>
                                        <td><?= $data['tgl_update']; ?></td>
                                        <td style="text-align: center;">
                                            <a href="<?php echo base_url('berita/view/' . $data['id_berita']); ?>" style="color: black;">
                                                <li class="far fa-eye"></li>
                                            </a>
                                            <a href="<?php echo base_url('berita/edit/' . $data['id_berita']); ?>" style="color: black;">
                                                <li class="far fa-edit"></li>
                                            </a>
                                            <a href="<?php echo base_url('berita/delete/' . $data['id_berita']); ?>" onclick="javascript:return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" style="color: black;">
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