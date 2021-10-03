<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>
<?= $this->include('template/tgl'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-eye mr-1"></i>
                            View Data : Aduan - <?= tgl_indo($aduan->tgl_aduan); ?>
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <button type="button" style="margin-left: 10vh;" class="btn btn-success">
                                        <?php if (session()->get('level') == 1 or session()->get('level') == 2) { ?>
                                            <a href="<?php echo base_url('/aduan/view/' . $aduan->id_aduan . '/belum'); ?>" style="color: white;">
                                            <?php } elseif (session()->get('level') == 3) { ?>
                                                <a href="<?php echo base_url('/aduan/edit/' . $aduan->id_aduan); ?>" style="color: white;">
                                                <?php } ?>
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
                                <th>Tanggal Aduan</th>
                                <td> : <?= tgl_indo($aduan->tgl_aduan); ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td> : <?= $aduan->ket; ?></td>
                            </tr>
                            <tr>
                                <th>Gambar</th>
                                <td> : <img style="max-width: 50%;" src="<?= base_url(); ?>/aduan/<?= $aduan->gambar; ?>" alt=""></td>
                            </tr>
                            <tr>
                                <th>Isi Aduan</th>
                                <td> : <?= $aduan->aduan; ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Respon</th>
                                <td> : <?php if ($aduan->tgl_respon != NULL) {
                                            echo tgl_indo($aduan->tgl_respon);
                                        } else {
                                            echo 'Belum ada respon';
                                        } ?></td>
                            </tr>
                            <tr>
                                <th>Respon</th>
                                <td> : <?php if ($aduan->respon != NULL) {
                                            echo $aduan->respon;
                                        } else {
                                            echo 'Belum ada respon';
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