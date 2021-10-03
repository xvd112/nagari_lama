<?= $this->extend('web/template'); ?>
<?= $this->section('content'); ?>
<div style="height: 90px;">

</div>
<main id="main">
    <div class="row">
        <div class="col-md-9">
            <section class="section-bg" style="padding: 40px;">
                <?= $data->syarat_surat; ?>
                <p> Jika ingin membuat permohonan surat, silahkan masukkan username dan password anda di bawah ini. Jika anda belum mempunyai username dan pasword silahkan kontak ke nomor di bawah ini, username dan password akan di beritahu ke anda. Terimakasih.</p>
                <h1><b> Kontak : <a href="tel:<?= $kontak->telp; ?>"> <i class="fab fa-whatsapp"></i><?= $kontak->telp; ?></a></b></h1>
                <div class="container card" style="width: 70%;">
                    <div class="container-fluid card-body">
                        <script>
                            window.setTimeout(function() {
                                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                                    $(this).remove();
                                });
                            }, 3000);
                        </script>
                        <?php if (session()->getFlashdata('error')) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('error'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php } ?>

                        <form action="<?= base_url() ?>/auth/cek_login" method="POST">
                            <?= csrf_field() ?>
                            <div class="row mb-3">
                                <label for="login" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input autocomplete="off" type="text" placeholder="Masukkan Username" class="form-control" id="login" name="login">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input autocomplete="off" type="password" placeholder="Masukkan Password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                            <input type="hidden" name="log" id="log" value="surat">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
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
<?= $this->endSection(); ?>