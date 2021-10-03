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
                            <i class="fas fa-user-friends mr-1"></i>
                            View Data Kematian
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <button type="button" class="btn btn-success">
                                        <a href="<?php echo base_url('/mati/edit/' . $mati->id_kematian); ?>" style="color: white;">
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
                                <th>NIK</th>
                                <td> : <a href="<?= base_url(); ?>/penduduk/view/<?= $mati->id_penduduk; ?>"><?= $mati->nik; ?></a></td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td> : <?= $mati->nama; ?></a></td>
                            </tr>
                            <tr>
                                <th>Tempat Kematian</th>
                                <td> : <?= $mati->tpt_kematian; ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Kematian</th>
                                <td> : <?= tgl_indo($mati->tgl_kematian); ?> (<?= $umur; ?> tahun)</td>
                            </tr>
                            <tr>
                                <th>Sebab Kematian</th>
                                <td> : <?= $mati->sebab; ?></td>
                            </tr>
                        </table>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



<?= $this->endSection(); ?>