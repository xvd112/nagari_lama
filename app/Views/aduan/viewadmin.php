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
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Nama</th>
                                <td> : <?= $penduduk->nama; ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Aduan</th>
                                <td> : <?= tgl_indo($aduan->tgl_aduan); ?></td>
                            </tr>
                            <tr>
                                <th>Gambar</th>
                                <td> : <img style="max-width: 50%;" src="<?= base_url(); ?>/aduan/<?= $aduan->gambar; ?>" alt=""></td>
                            </tr>
                            <tr>
                                <th>Isi Aduan</th>
                                <td> : <?= $aduan->aduan; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-eye mr-1"></i>
                            Tanggapan
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url(); ?>/aduan/update" method="post">
                            <?= csrf_field(); ?>
                            <div class="row mb-3">
                                <label for="respon" class="col-form-label">Tanggapan</label>
                                <textarea name="respon" id="respon" style="height: 200px; background: lightgrey;"><?php if ($aduan->respon != NULL or $aduan->respon != 'Belum ada respon') {
                                                                                                                        echo $aduan->respon;
                                                                                                                    } ?></textarea>
                            </div>
                            <input type="hidden" name="id_aduan" value="<?= $aduan->id_aduan; ?>">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>