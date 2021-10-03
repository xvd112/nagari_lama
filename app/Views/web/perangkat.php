<?= $this->extend('web/template'); ?>
<?= $this->section('content'); ?>

<main id="main">
  <div class="row">
    <div class="col-md-9">
      <section style="padding: 40px; background: #f8fcfd;">
        <div class="row" align="center">
          <?php if ($data != NULL) {
            foreach ($data as $data) { ?>
              <div class="col-md-3 h" style="padding: 10px;">
                <div style="word-wrap: break-word;">
                  <p><b><?= $data['jabatan']; ?></b></p>
                </div>
                <div>
                  <img src="<?= base_url(); ?>/perangkat/<?= $data['foto']; ?>" alt="" width="75%">
                </div>
                <div>
                  <?= $data['nama']; ?>
                </div>
              </div>
          <?php }
          } ?>
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