<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <?= $this->include('template/tgl') ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (session()->getFlashdata('pesan_profile')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan_profile'); ?>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="row">
                        <div class="col-lg-3 col-md-5" style="padding: 3vh;">
                            <img src="<?= base_url(); ?>/<?php if (session()->level == 3) {
                                                                echo 'penduduk';
                                                            } else {
                                                                echo 'perangkat';
                                                            } ?>/<?= $isi->foto; ?>">
                        </div>
                        <div class="col" style="padding: 3vh;">
                            <h3><b><?= $user->nama; ?></b></h3>
                            <table class="table">
                                <tr>
                                    <td>NIK</td>
                                    <td> : <?= $user->nik; ?></td>
                                </tr>
                                <tr>
                                    <td>No KK</td>
                                    <td> : <?= $user->no_kk; ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td> : <?= $user->alamat; ?></td>
                                </tr>
                                <tr>
                                    <td>Tempat/Tanggal Lahir</td>
                                    <td> : <?= $user->tpt_lahir; ?>/<?= tgl_indo($user->tgl_lahir); ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td> : <?= $isi->email; ?></td>
                                </tr>
                                <tr>
                                    <td>No Telepon</td>
                                    <td> : <a href="tel:<?= $isi->telp; ?>"><?= $isi->telp; ?></a></td>
                                </tr>
                            </table>
                            <button type="button" class="btn btn-success">
                                <a href="<?php echo base_url('/profile/edit'); ?>" style="color: white;">
                                    <i class="far fa-edit"> Edit Profile</i>
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>