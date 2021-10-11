<?= $this->extend('web/template'); ?>
<?= $this->section('content'); ?>

<main id="main">
  <div class="row">
    <div class="col-md-9">
      <?php if ($wali != NULL and $sambutan->kata_sambutan != NULL) { ?>
        <section class="section-bg" style="padding: 40px;">
          <div class="row">
            <div class="col-md-4 col-lg-1">
              <img src="<?= base_url(); ?>/perangkat/<?= $wali->foto; ?>" alt="Foto <?= $wali->nama; ?>" height="200wh">
            </div>
            <div class="container col-md-8 col-lg-8">
              <h5>Kata Sambutan </h5>
              <p><?= substr($sambutan->kata_sambutan, 0, 500); ?></p>
              <a href="<?= base_url(); ?>/web/sambutan" style="color: darkgray;">Baca Selengkapnya...</a>
            </div>
          </div>
        </section>
      <?php } ?>
      <?php if ($potensi != NULL) { ?>
        <section style="padding: 40px; background: #f8fcfd;">
          <h5 align="center"><b>Potensi Wilayah Tanah Datar</b></h5>
          <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <?php if (count($potensi) > 1) {
                for ($i = 1; $i < count($potensi); $i++) { ?>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $i; ?>" aria-label="Slide <?= ($i + 1); ?>"></button>
              <?php }
              } ?>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <a href="<?= base_url(); ?>/web/potensi/#<?= $potensi[0]['id_potensi']; ?>">
                  <img height="500px" src="<?= base_url(); ?>/potensi/<?= $potensi[0]['foto']; ?>" class="d-block w-100" alt="<?= $potensi[0]['nama']; ?>">
                  <div class="carousel-caption d-none d-md-block">
                    <h5 style="background: grey;"><?= $potensi[0]['nama']; ?></h5>
                  </div>
                </a>
              </div>
              <?php if (count($potensi) > 1) {
                for ($i = 1; $i < count($potensi); $i++) { ?>
                  <div class="carousel-item">
                    <a href="<?= base_url(); ?>/web/potensi/#<?= $potensi[$i]['id_potensi']; ?>">
                      <img height="500px" src="<?= base_url(); ?>/potensi/<?= $potensi[$i]['foto']; ?>" class="d-block w-100" alt="<?= $potensi[$i]['nama']; ?>">
                      <div class="carousel-caption d-none d-md-block">
                        <h5 style="background: grey;"><?= $potensi[$i]['nama']; ?></h5>
                      </div>
                    </a>
                  </div>
              <?php }
              } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </section>
      <?php } ?>
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
