<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-user-friends mr-1"></i>
                            View Data : <?= $berita->judul; ?>
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <button type="button" style="margin-left: 10px;" class="btn btn-success">
                                        <a href="<?php echo base_url('berita/edit/' . $berita->id_berita); ?>" style="color: white;">
                                            <i class="far fa-plus-square"> Edit Data</i>
                                        </a>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="row card-body" align="center">
                        <h3><b><?= $berita->judul; ?></b></h3>
                        <?php if ($berita->gambar != NULL and $berita->gambar != 'no_image.png') { ?>
                            <div>
                                <img width="30%" src="<?= base_url(); ?>/berita/<?= $berita->gambar; ?>" alt=" Gambar <?= $berita->judul; ?>">
                            </div>
                        <?php } ?>
                        <div class="dropdown-divider"></div>
                        <div class="col" align="left">
                            Penulis : <b><i><?= $berita->penulis; ?></i></b>
                        </div>
                        <div class="col" align="right">
                            Tanggal Update : <b><?= date('d M Y', strtotime($berita->tgl_update)); ?></b>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div style="text-align: justify;">
                            <?= $berita->isi; ?>
                        </div>
                    </div>
                    <!-- /.card-body -->
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