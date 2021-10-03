<?= $this->extend('web/template'); ?>
<?= $this->section('content'); ?>
<div style="height: 90px;">

</div>
<main id="main">
  <div class="row">
    <div class="col-md-9">
      <section style="padding: 40px; background: #f8fcfd;">
        <?php if ($potensi != NULL) {
          for ($i = 0; $i < count($potensi); $i++) {
            if ($i % 2 == 0) { ?>
              <div class="row" style="padding: 10px;" id="<?= $potensi[$i]['id_potensi']; ?>">
                <h3 style="background: #e2e2e2;"><b><?= $potensi[$i]['nama']; ?></b></h3>
                <div class="col-md-5">
                  <img style="max-height: 50vh; max-width: 60vh;" src="<?= base_url(); ?>/potensi/<?= $potensi[$i]['foto']; ?>" alt="">
                </div>
                <div class="col">
                  <?= $potensi[$i]['ket']; ?>
                </div>
              </div>
            <?php } else { ?>
              <div class="row" style="padding: 10px;" id="<?= $potensi[$i]['id_potensi']; ?>">
                <h3 style=" text-align: right;background: #e2e2e2;"><b><?= $potensi[$i]['nama']; ?></b></h3>
                <div class="col">
                  <?= $potensi[$i]['ket']; ?>
                </div>
                <div class="col-md-5">
                  <img style="max-height: 50vh; max-width: 60vh;" src="<?= base_url(); ?>/potensi/<?= $potensi[$i]['foto']; ?>" alt="">
                </div>
              </div>
        <?php }
          }
        } else {
          echo 'Potensi tidak ada';
        } ?>
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