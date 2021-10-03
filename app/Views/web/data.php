<?= $this->extend('web/template'); ?>
<?= $this->section('content'); ?>

<main id="main">
  <div class="row">
    <div class="col-md-9">
      <section style="padding: 40px;">
        <div class="card">
          <div class="card-header">
            <div id="tab" class="card-tools">
              <nav>
                <a href="#isi" class="act" data-id='1'>Perubahan Penduduk</a>
                <a href="#isi" data-id='2'>Pendidikan</a>
                <a href="#isi" data-id='3'>Pekerjaan</a>
                <a href="#isi" data-id='4'>Agama</a>
                <a href="#isi" data-id='5'>Jenis Kelamin</a>
                <a href="#isi" data-id='6'>Umur</a>
              </nav>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content act" data-content='1'>
              <div>
                <h5><b>Total Penduduk Tahun <?= date('Y'); ?> : </b> <?= $penduduk; ?> Orang</h5><br>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <canvas id="pc_penduduk"></canvas>
                </div>
                <div class="col-md-6">
                  <canvas id="lc_rubah"></canvas>
                </div>
              </div>
            </div>
            <div class="tab-content" data-content='2'>
              <canvas id="bc_pendidikan"></canvas>
            </div>
            <div class="tab-content" data-content='3'>
              <h5><b>Penduduk Berdasarkan Pekerjaan Tahun <?= date('Y'); ?></b></h5>
              <table class="table table-hover table-bordered">
                <thead class="table-secondary" style="text-align: center;">
                  <tr>
                    <th>No.</th>
                    <th>Nama Pekerjaan</th>
                    <th>Jumlah Penduduk</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($kerja as $kerja) { ?>
                    <tr>
                      <td style="text-align: center;"><?= $no; ?></td>
                      <td><?= $kerja['nama']; ?></td>
                      <td style="text-align: center;"><?= $kerja['tot']; ?></td>
                    </tr>
                  <?php $no++;
                  } ?>
                </tbody>
              </table>
            </div>
            <div class="tab-content" data-content='4'>
              <canvas id="pc_agama"></canvas>
            </div>
            <div class="tab-content" data-content='5'>
              <div>
                <canvas id="pc_jekel"></canvas>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <canvas id="pc_jkg"></canvas>
                </div>
                <div class="col-md-6">
                  <canvas id="pc_jkgru"></canvas>
                </div>
              </div>
            </div>
            <div class="tab-content" data-content='6'>
              <canvas id="bc_umur"></canvas>
            </div>
          </div>
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
<?= $this->include('web/chartweb'); ?>
<?= $this->endSection(); ?>