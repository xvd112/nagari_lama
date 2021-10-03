<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <?= form_open('user/hapusbanyak', ['class' => 'formhapus']) ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (session()->getFlashdata('pesan_user')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_user'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('danger_user')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('danger_user'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (session()->getFlashdata('warning_user')) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('warning_user'); ?>
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
                                    <a class="nav-link active" href="#admin" data-toggle="tab">Admin</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#perangkat" data-toggle="tab">Operator</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#warga" data-toggle="tab">Warga</a>
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
                            <div class="tab-pane active" id="admin" style="position: relative;">
                                <div style="margin-bottom: 20px;">
                                    <button type="button" class="btn btn-success">
                                        <a href="<?php echo base_url('user/input/1'); ?>" style="color: white;">
                                            <i class="far fa-plus-square"> Tambah Data</i>
                                        </a>
                                    </button>
                                </div>
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead class="thead-dark" style="text-align: center;">
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="centangsemua">
                                            </th>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Pass</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data_admin as $data) {
                                        ?>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <input type="checkbox" id="check" name="id[]" class="centang" value="<?= $data['id']; ?>">
                                                </td>
                                                <td><?= $no; ?></td>
                                                <td><?= $data['nama']; ?></td>
                                                <td><?= $data['username']; ?></td>
                                                <td><?= $data['email']; ?></td>
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-outline-danger">
                                                        <a href="<?= base_url(); ?>/user/reset/<?= $data['id']; ?>" style="text-decoration: none;color: black;">Reset</a>
                                                    </button>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo base_url('user/edit/' . $data['id']); ?>" style="color: black;">
                                                        <li class="far fa-edit"></li>
                                                    </a>
                                                    <a href="<?php echo base_url('user/view/' . $data['id']); ?>" style="color: black;">
                                                        <li class="far fa-eye"></li>
                                                    </a>
                                                    <a href="<?php echo base_url('user/delete/' . $data['id']); ?>" onclick="javascript:return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" style="color: black;">
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
                            <div class="tab-pane" id="perangkat" style="position: relative;">
                                <div style="margin-bottom: 20px;">
                                    <button type="button" class="btn btn-success">
                                        <a href="<?php echo base_url('user/input/2'); ?>" style="color: white;">
                                            <i class="far fa-plus-square"> Tambah Data</i>
                                        </a>
                                    </button>
                                </div>
                                <table id="example2-2" class="table table-bordered table-hover">
                                    <thead class="thead-dark" style="text-align: center;">
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="centangsemua2">
                                            </th>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Pass</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data_perangkat as $data) {
                                        ?>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <input type="checkbox" id="check" name="id[]" class="centang" value="<?= $data['id']; ?>">
                                                </td>
                                                <td><?= $no; ?></td>
                                                <td><?= $data['nama']; ?></td>
                                                <td><?= $data['username']; ?></td>
                                                <td><?= $data['email']; ?></td>
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-outline-danger">
                                                        <a href="<?= base_url(); ?>/user/reset/<?= $data['id']; ?>" style="text-decoration: none;color: black;">Reset</a>
                                                    </button>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo base_url('user/edit/' . $data['id']); ?>" style="color: black;">
                                                        <li class="far fa-edit"></li>
                                                    </a>
                                                    <a href="<?php echo base_url('user/view/' . $data['id']); ?>" style="color: black;">
                                                        <li class="far fa-eye"></li>
                                                    </a>
                                                    <a href="<?php echo base_url('user/delete/' . $data['id']); ?>" onclick="javascript:return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" style="color: black;">
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
                            <div class="tab-pane" id="warga" style="position: relative;">
                                <div style="margin-bottom: 20px;">
                                    <button type="button" class="btn btn-success">
                                        <a href="<?php echo base_url('user/input/3'); ?>" style="color: white;">
                                            <i class="far fa-plus-square"> Tambah Data</i>
                                        </a>
                                    </button>
                                </div>
                                <table id="example2-3" class="table table-bordered table-hover">
                                    <thead class="thead-dark" style="text-align: center;">
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="centangsemua3">
                                            </th>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Pass</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data_warga as $data) {
                                        ?>
                                            <tr>
                                                <td style="text-align: center;">
                                                    <input type="checkbox" id="check" name="id[]" class="centang" value="<?= $data['id']; ?>">
                                                </td>
                                                <td><?= $no; ?></td>
                                                <td><?= $data['nama']; ?></td>
                                                <td><?= $data['username']; ?></td>
                                                <td><?= $data['email']; ?></td>
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-outline-danger">
                                                        <a href="<?= base_url(); ?>/user/reset/<?= $data['id']; ?>" style="text-decoration: none;color: black;">Reset</a>
                                                    </button>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo base_url('user/edit/' . $data['id']); ?>" style="color: black;">
                                                        <li class="far fa-edit"></li>
                                                    </a>
                                                    <a href="<?php echo base_url('user/view/' . $data['id']); ?>" style="color: black;">
                                                        <li class="far fa-eye"></li>
                                                    </a>
                                                    <a href="<?php echo base_url('user/delete/' . $data['id']); ?>" onclick="javascript:return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" style="color: black;">
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