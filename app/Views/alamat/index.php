<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <?php if (session()->getFlashdata('error')) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php if (session()->getFlashdata('pesan_data')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('pesan_data'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('warning_data')) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('warning_data'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-info mr-1"></i>
                <?= $ket[0]; ?>
            </h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                        <button type="button" class="btn btn-success">
                            <a href="<?php echo base_url('/data/edit'); ?>" style="color: white;">
                                <i class="fas fa-edit"> Edit Data</i>
                            </a>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container-fluid card-body">
            <table class="table">
                <tr>
                    <td>Alamat Kantor</td>
                    <td> : </td>
                    <td><?= $data->alm; ?>, Nagari <?= $data->nagari; ?>, Kecamatan <?= $data->kec; ?>, Kabupaten <?= $data->kab; ?>, <?= $data->prov; ?>, <?= $data->kd_pos; ?></td>
                    <td><a href="<?= $data->map_kantor; ?>" target="_blank"><i class="fas fa-map-signs"></i></a></td>
                </tr>
                <tr>
                    <td>Area Nagari</td>
                    <td> : </td>
                    <td><?= $data->map_wilayah; ?></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- /.content -->
<?= $this->endSection(); ?>