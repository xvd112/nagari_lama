<?= $this->extend('web/template'); ?>
<?= $this->section('content'); ?>
<div style="height: 90px;">

</div>
<main id="main">
    <div class="row">
        <div class="col-md-9">
            <section style="padding: 40px; background: #f8fcfd;">
                <div align="center">
                    <h3><b><?= $data->judul; ?></b></h3>
                    <?php if ($data->gambar != NULL and $data->gambar != 'no_image.png') { ?>
                        <img src="<?= base_url(); ?>/berita/<?= $data->gambar; ?>" alt="Foto <?= $data->judul; ?>" height="300wh">
                    <?php } ?>
                </div>
                <div class="row" style="margin-top: 30px;">
                    <div class="col">Admin</div>
                    <div class="col" align="right"><?= $data->tgl_update; ?></div>
                </div>
                <div style="word-wrap: break-word; margin-top: 30px;">
                    <?= $data->isi; ?>
                </div>
            </section>
        </div>
        <div class="col-md-3" style="margin-top: 40px; padding-right: 35px;">
            <h5 align=" center"><b>Berita Terbaru</b></h5>
            <hr>
            <?php if ($berita == NULL) { ?>
                <div class="row h" style="word-wrap: break-word; padding: 10px;">
                    Berita belum ada
                </div>
            <?php } ?>
            <?php
            foreach ($berita as $data) {
            ?>
                <div class="row h" style="word-wrap: break-word; padding: 10px;">
                    <a href="<?= base_url('/web/isi/' . $data['id_berita']) ?>" style="color: black;">
                        <p><b><?= $data['judul']; ?></b></p>
                        <?= substr($data['isi'], 0, 50); ?>
                        <p style="color: #061F2D;"> Baca Selengkapnya...</p>
                    </a>
                </div>
                <hr>
            <?php } ?>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>