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
                            View Data : <?= $perangkat->nama; ?>
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <button type="button" style="margin-left: 10px;" class="btn btn-success">
                                        <a href="<?php echo base_url($link . '/edit/' . $perangkat->id_pemerintahan); ?>" style="color: white;">
                                            <i class="far fa-plus-square"> Edit Data</i>
                                        </a>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td rowspan="3" style="width: 1px;">
                                    <img src="<?= base_url(); ?>/perangkat/<?= $perangkat->foto; ?>" alt="Foto <?= $perangkat->nama; ?>" height="150px">
                                </td>
                                <td><b>Jabatan </b></td>
                                <td> : <?= $perangkat->jabatan; ?></td>
                                <td style="text-align: right;" rowspan="3">
                                    <?php if ($perangkat->tgl_berhenti == NULL or $perangkat->tgl_berhenti == '0000-00-00') {
                                        echo '<b style="color: red;">Masih Menjabat</b>';
                                    } else {
                                        echo '<b style="color: lightgrey;">Sudah Berhenti</b>';
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Tanggal Lantik</b></td>
                                <td> : <?= date('d M Y', strtotime($perangkat->tgl_lantik)); ?></td>
                            </tr>
                            <tr>
                                <td><b>Tanggal Berhenti</b></td>
                                <td> : <?php if ($perangkat->tgl_berhenti != NULL and $perangkat->tgl_berhenti != '0000-00-00') {
                                            echo date('d M Y', strtotime($perangkat->tgl_berhenti));
                                        } else {
                                            echo '-';
                                        } ?></td>
                            </tr>
                            <tr>
                                <td><b>Nama</b></td>
                                <td> : <?= $perangkat->nama; ?></td>
                            </tr>
                            <tr>
                                <td><b>NIK</b></td>
                                <td> : <?= $perangkat->nik; ?></td>
                            </tr>
                            <tr>
                                <td><b>Jenis Kelamin</b></td>
                                <td> : <?= $perangkat->jekel; ?></td>
                            </tr>
                            <tr>
                                <td><b>Nomor Telepon</b></td>
                                <td> : <a href="tel:<?= $perangkat->telp; ?>"><?= $perangkat->telp; ?></a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection(); ?>