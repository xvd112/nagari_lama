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
                            View Data User
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item" style="margin-right: 10px;">
                                    <button type="button" class="btn btn-info">
                                        <?php if ($datauser->level != 3) { ?>
                                            <a href="<?php echo base_url('/nagari/view/' . $datauser->id_datauser); ?>" style="color: white;">
                                            <?php } else { ?>
                                                <a href="<?php echo base_url('/penduduk/view/' . $datauser->id_datauser); ?>" style="color: white;">
                                                <?php } ?>
                                                <i class="fas fa-eye"> Lihat Data</i>
                                                </a>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="btn btn-success">
                                        <a href="<?php echo base_url('/user/edit/' . $datauser->id); ?>" style="color: white;">
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
                                <td rowspan="4" style="width: 1px;">
                                    <img src="<?= base_url(); ?>/<?php if ($datauser->foto == NULL or $datauser->foto == 'default.jpg' or $datauser->foto == 'default.svg') {
                                                                        echo 'user/default.svg';
                                                                    } else {
                                                                        'user/' . $datauser->foto;
                                                                    } ?>" alt="Foto <?= $datauser->username; ?>" height="150px">
                                </td>
                                <th>Username</th>
                                <td> : <?= $datauser->username; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td> : <?= $datauser->email; ?></td>
                            </tr>
                            <tr>
                                <th>Telp</th>
                                <td> : <?= $datauser->telp; ?></td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td> : <?php if ($datauser->level == 1) {
                                            echo 'Super Admin';
                                        } elseif ($datauser->level == 2) {
                                            echo 'Admin';
                                        } elseif ($datauser->level == 3) {
                                            echo 'Warga';
                                        } ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>