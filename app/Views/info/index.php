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
    <div>
        <button type="button" class="btn btn-success">
            <a href="<?php echo base_url('data/editinfo'); ?>" style="color: white;">
                <i class="fas fa-edit"> Edit Data</i>
            </a>
        </button>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-phone mr-1"></i>
                Kontak
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="container-fluid card-body">
            <table class="table">
                <tr>
                    <td style="width: 200px;">Nomor Telepon</td>
                    <td style="width: 1px;"> : </td>
                    <td><a href="tel:<?= $tambah->telp; ?>"> <i class="fas fa-phone"></i></a> <?= $tambah->telp; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td> : </td>
                    <td><a href="mailto:<?= $tambah->email; ?>"> <i class="fas fa-envelope"></i></a> <?= $tambah->email; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-info mr-1"></i>
                Info
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="container-fluid card-body">
            <table class="table">
                <?php if (session()->get('level') == 1) { ?>
                    <tr>
                        <td style="width: 1px;">Kata Sambutan</td>
                        <td style="width: 1px;"> : </td>
                        <td><?= $data->kata_sambutan; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td style="width: 1px;">Visi</td>
                    <td style="width: 1px;"> : </td>
                    <td><?= $data->visi; ?></td>
                </tr>
                <tr>
                    <td>Misi</td>
                    <td> : </td>
                    <td><?= $data->misi; ?></td>
                </tr>
                <tr>
                    <td>Sejarah</td>
                    <td> : </td>
                    <td><?= $data->sejarah; ?></td>
                </tr>
                <tr>
                    <td>Wilayah</td>
                    <td> : </td>
                    <td><?= $data->wilayah; ?></td>
                </tr>
                <tr>
                    <td>Persyaratan Surat</td>
                    <td> : </td>
                    <td><?= $data->syarat_surat; ?></td>
                </tr>
            </table>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- /.content -->
<?= $this->endSection(); ?>