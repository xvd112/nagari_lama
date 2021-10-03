<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>
<?= form_open($link . '/hapusbanyak', ['class' => 'formhapus']) ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (session()->getFlashdata('pesan_perangkat')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_perangkat'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('danger_perangkat')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('danger_perangkat'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('warning_perangkat')) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('warning_perangkat'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="padding:5px">
                            <i class="fas fa-user-friends mr-1"></i>
                            <?= $ket[0]; ?>
                        </h3>
                        <div class="card-tools" style="padding:5px">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <button type="button" style="margin-left: 10px;" class="btn btn-success">
                                        <a href="<?php echo base_url($link . '/input'); ?>" style="color: white;">
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
                                        <a href="<?php echo base_url($link . '/import'); ?>" style="color: white;">
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
                                    <th style="text-align:center">Nama</th>
                                    <th style="text-align:center">NIK</th>
                                    <th style="text-align:center">Jabatan</th>
                                    <th style="text-align:center">Periode</th>
                                    <th style="text-align:center">Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($perangkat as $data) {
                                ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" id="check" name="id_pemerintahan[]" class="centang" value="<?= $data['id_pemerintahan']; ?>">
                                        </td>
                                        <td><?= $no; ?></td>
                                        <td><?= $data['nama']; ?></td>
                                        <td><?php if ($p[$no - 1] == true) { ?><a href="<?= base_url(); ?>/penduduk/viewnik/<?= $data['nik']; ?>"><?= $data['nik']; ?></a><?php } else { ?><?= $data['nik']; ?><?php } ?></td>
                                        <td><?= $data['jabatan']; ?></td>
                                        <td><?= date('Y', strtotime($data['tgl_lantik'])); ?> - <?php if ($data['tgl_berhenti'] != NULL and $data['tgl_berhenti'] != '0000-00-00') {
                                                                                                    echo date('Y', strtotime($data['tgl_berhenti']));
                                                                                                } else {
                                                                                                    echo 'Sekarang';
                                                                                                } ?></td>
                                        <td><a href="tel:<?= $data['telp']; ?>"><?= $data['telp']; ?></a></td>
                                        <td style="text-align: center;">
                                            <a href="<?php echo base_url($link . '/view/' . $data['id_pemerintahan']); ?>" style="color: black;">
                                                <li class="far fa-eye"></li>
                                            </a>
                                            <a href="<?php echo base_url($link . '/edit/' . $data['id_pemerintahan']); ?>" style="color: black;">
                                                <li class="far fa-edit"></li>
                                            </a>
                                            <a href="<?php echo base_url($link . '/delete/' . $data['id_pemerintahan']); ?>" onclick="javascript:return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" style="color: black;">
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