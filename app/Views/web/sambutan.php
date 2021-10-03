<?= $this->extend('web/template'); ?>
<?= $this->section('content'); ?>
<div style="height: 90px;">

</div>
<main id="main">
    <div class="row">
        <div class="col-md-9">
            <section class="section-bg" style="padding: 40px;">
                <div align="center">
                    <img src="<?= base_url(); ?>/perangkat/<?= $wali->foto; ?>" alt="Foto <?= $wali->nama; ?>" height="300wh">

                    <div>
                        Wali Nagari <?= $kontak->nagari; ?><br>
                        <b><u><?= $wali->nama; ?></u></b>
                    </div>
                </div>
                <div>
                    <br>
                    <?= $sambutan->kata_sambutan; ?>
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