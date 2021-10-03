<?= $this->extend('web/template'); ?>
<?= $this->section('content'); ?>

<main id="main">
  <div class="row">
    <div class="col-md-9">
      <section style="padding: 40px; background: #f8fcfd;">
        <div style="padding: 10px;">
          <h1><b>Kondisi Geografis</b></h1>
          <?= $data->wilayah; ?>
        </div>
        <div style="padding: 10px;">
          <h1><b>Peta Wilayah</b></h1>
          <?= $alm->map_wilayah; ?>
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