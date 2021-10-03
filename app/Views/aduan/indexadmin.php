<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>
<?= $this->include('template/tgl'); ?>
<!-- Main content -->
<section class="content">
    <?= form_open('mati/hapusbanyak', ['class' => 'formhapus']) ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (session()->getFlashdata('pesan_aduan')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_aduan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('danger_aduan')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('danger_aduan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('warning_aduan')) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('warning_aduan'); ?>
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
                                    <a class="nav-link active" href="#belum" data-toggle="tab">Belum Diproses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#sudah" data-toggle="tab">Sudah Diproses</a>
                                </li>
                                <li class="nav-item">
                                    <button type="submit" style="margin-left: 10px;" class="btn btn-danger tombolHapusBanyak" onclick="javascript:return confirm('Apakah ingin menghapus data ini ?')">
                                        <i class="far fa-trash-alt"> Hapus</i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <div class="tab-pane active" id="belum" style="position: relative; height: 300px;">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead class="thead-dark" style="text-align: center;">
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="centangsemua">
                                            </th>
                                            <th style="text-align:center">No</th>
                                            <th style="text-align:center">Tanggal Aduan</th>
                                            <th style="text-align:center">Isi Aduan/th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($aduan_blm as $data) {
                                        ?>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <input type="checkbox" id="check" name="id_aduan[]" class="centang" value="<?= $data['id_aduan']; ?>">
                                                </td>
                                                <td><?= $no; ?></td>
                                                <td><?= $data['tgl_aduan']; ?></td>
                                                <td><?= $data['aduan']; ?></td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo base_url('aduan/view/' . $data['id_aduan'] . '/belum'); ?>" style="color: black;">
                                                        <li class="far fa-eye"></li>
                                                    </a>
                                                    <a href="<?php echo base_url('aduan/delete/' . $data['id_aduan']); ?>" onclick="javascript:return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" style="color: black;">
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
                            <div class="tab-pane" id="sudah" style="position: relative; height: 300px;">
                                <table id="example2-2" class="table table-bordered table-hover">
                                    <thead class="thead-dark" style="text-align: center;">
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="centangsemua2">
                                            </th>
                                            <th style="text-align:center">No</th>
                                            <th style="text-align:center">Tanggal Aduan</th>
                                            <th style="text-align:center">Isi Aduan/th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($aduan_sdh as $data) {
                                        ?>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <input type="checkbox" id="check" name="id_aduan[]" class="centang" value="<?= $data['id_aduan']; ?>">
                                                </td>
                                                <td><?= $no; ?></td>
                                                <td><?= $data['tgl_aduan']; ?></td>
                                                <td><?= $data['aduan']; ?></td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo base_url('aduan/view/' . $data['id_aduan'] . '/belum'); ?>" style="color: black;">
                                                        <li class="far fa-edit"></li>
                                                    </a>
                                                    <a href="<?php echo base_url('aduan/view/' . $data['id_aduan'] . '/sudah'); ?>" style="color: black;">
                                                        <li class="far fa-eye"></li>
                                                    </a>
                                                    <a href="<?php echo base_url('aduan/delete/' . $data['id_aduan']); ?>" onclick="javascript:return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" style="color: black;">
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
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- /.content -->
<?= $this->endSection(); ?>