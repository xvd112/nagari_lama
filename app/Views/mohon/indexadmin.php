<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <?= form_open('permohonan/hapusbanyak', ['class' => 'formhapus']) ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (session()->getFlashdata('pesan_permohonan')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_permohonan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('danger_permohonan')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('danger_permohonan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('warning_permohonan')) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('warning_permohonan'); ?>
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
                                    <a class="nav-link active" href="#belum" data-toggle="tab">Belum Diperiksa</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#terima" data-toggle="tab">Diterima</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tolak" data-toggle="tab">Ditolak</a>
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
                                            <th style="text-align:center">Tanggal Pengajuan</th>
                                            <th style="text-align:center">ID Penduduk</th>
                                            <th style="text-align:center">Jenis Surat yang Diminta</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($mohon_blm as $data) {
                                        ?>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <input type="checkbox" id="check" name="id_permohonan[]" class="centang" value="<?= $data['id_permohonan']; ?>">
                                                </td>
                                                <td><?= $no; ?></td>
                                                <td><?= $data['tgl_masuk']; ?></td>
                                                <td><?= $data['id_penduduk']; ?></td>
                                                <td><?= $data['jenis']; ?></td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo base_url('permohonan/view/' . $data['id_permohonan'] . '/belum'); ?>" style="color: black;">
                                                        <li class="far fa-eye"></li>
                                                    </a>
                                                    <a href="<?php echo base_url('permohonan/delete/' . $data['id_permohonan']); ?>" onclick="javascript:return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" style="color: black;">
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
                            <div class="tab-pane" id="terima" style="position: relative; height: 300px;">
                                <table id="example2-2" class="table table-bordered table-hover">
                                    <thead class="thead-dark" style="text-align: center;">
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="centangsemua2">
                                            </th>
                                            <th style="text-align:center">No</th>
                                            <th style="text-align:center">Tanggal Pengajuan</th>
                                            <th style="text-align:center">ID Penduduk</th>
                                            <th style="text-align:center">Jenis Surat yang Diminta</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($mohon_stj as $data) {
                                        ?>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <input type="checkbox" id="check" name="id_permohonan[]" class="centang" value="<?= $data['id_permohonan']; ?>">
                                                </td>
                                                <td><?= $no; ?></td>
                                                <td><?= $data['tgl_masuk']; ?></td>
                                                <td><?= $data['id_penduduk']; ?></td>
                                                <td><?= $data['jenis']; ?></td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo base_url('permohonan/view/' . $data['id_permohonan'] . '/belum'); ?>" style="color: black;">
                                                        <li class="far fa-edit"></li>
                                                    </a>
                                                    <a href="<?php echo base_url('permohonan/view/' . $data['id_permohonan'] . '/terima'); ?>" style="color: black;">
                                                        <li class="far fa-eye"></li>
                                                    </a>
                                                    <a href="<?php echo base_url('permohonan/delete/' . $data['id_permohonan']); ?>" onclick="javascript:return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" style="color: black;">
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
                            <div class="tab-pane" id="tolak" style="position: relative; height: 300px;">
                                <table id="example2-3" class="table table-bordered table-hover">
                                    <thead class="thead-dark" style="text-align: center;">
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="centangsemua3">
                                            </th>
                                            <th style="text-align:center">No</th>
                                            <th style="text-align:center">Tanggal Pengajuan</th>
                                            <th style="text-align:center">ID Penduduk</th>
                                            <th style="text-align:center">Jenis Surat yang Diminta</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($mohon_tlk as $data) {
                                        ?>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <input type="checkbox" id="check" name="id_permohonan[]" class="centang" value="<?= $data['id_permohonan']; ?>">
                                                </td>
                                                <td><?= $no; ?></td>
                                                <td><?= $data['tgl_masuk']; ?></td>
                                                <td><?= $data['id_penduduk']; ?></td>
                                                <td><?= $data['jenis']; ?></td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo base_url('permohonan/view/' . $data['id_permohonan'] . '/belum'); ?>" style="color: black;">
                                                        <li class="far fa-edit"></li>
                                                    </a>
                                                    <a href="<?php echo base_url('permohonan/view/' . $data['id_permohonan'] . '/tolak'); ?>" style="color: black;">
                                                        <li class="far fa-eye"></li>
                                                    </a>
                                                    <a href="<?php echo base_url('permohonan/delete/' . $data['id_permohonan']); ?>" onclick="javascript:return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" style="color: black;">
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