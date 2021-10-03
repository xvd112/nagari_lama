<?= $this->extend('web/template'); ?>
<?= $this->section('content'); ?>

<main id="main">
  <div class="row">
    <div class="col-md-9">
      <section style="padding: 40px; background: #f8fcfd;">
        <div style="padding: 10px;">
          <h1><b>Asal-Usul / Legenda Nagari</b></h1>
          <?= $data->sejarah; ?>
        </div>
        <div style="padding: 10px;">
          <h1><b>Sejarah Pemerintahan Nagari</b></h1>
          <table class="table table-bordered">
            <tr align="center">
              <th>No</th>
              <th>Periode</th>
              <th>Nama Kepala Desa</th>
              <th>Keterangan</th>
            </tr>
            <?php $no = 1;
            foreach ($wali as $wali) { ?>
              <tr>
                <td><?= $no; ?></td>
                <td><?= date('Y', strtotime($wali['tgl_lantik'])); ?> - <?php if ($wali['tgl_berhenti'] != NULL and $wali['tgl_berhenti'] != '0000-00-00') {
                                                                          echo date('Y', strtotime($wali['tgl_berhenti']));
                                                                        } else {
                                                                          echo 'Sekarang';
                                                                        } ?></td>
                <td><?= $wali['nama']; ?></td>
                <td><?php if ($wali['nama'] != '-') {
                      echo '-';
                    } else {
                      echo 'Desa';
                    } ?></td>
              </tr>
            <?php $no++;
            } ?>
          </table>
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