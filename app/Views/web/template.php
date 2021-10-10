<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url(); ?>/aset/img/<?= $gambar['icon']; ?>" rel="icon">
    <link href="<?= base_url(); ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url(); ?>/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="<?= base_url(); ?>/aset/plugins/fontawesome-free/css/all.min.css">
    <link href="<?= base_url(); ?>/assets/css/style.css" rel="stylesheet">
    <!-- =======================================================
  * Template Name: Avilon - v4.3.0
  * Template URL: https://bootstrapmade.com/avilon-bootstrap-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/0.2.0/Chart.min.js" type="text/javascript"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        #tab nav {
            display: flex;
        }

        #tab nav a {
            color: black;
            text-decoration: none;
            padding: 0.5rem;
            /* border: 1px solid silver; */
        }

        #tab nav .act {
            background: #d8d8d8;
            border-radius: 10px;
        }

        .tab-content {
            display: none;
            border: 1px solid silver;
            padding: 1rem;
        }

        .tab-content.act {
            display: block;
        }
    </style>
</head>

<body>
    <style>
        .h:hover {
            background-color: #e0e0e0;
            /* opacity: 20%; */
        }
    </style>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
        <div class="container d-flex justify-content-between align-items-center">
            <?= $this->include('web/slide'); ?>
            <div id="logo">
                <a href="<?= base_url(); ?>/"><img src="<?= base_url(); ?>/aset/img/<?= $gambar['logo']; ?>" alt="" height="35px"> </a>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="<?= base_url(); ?>/">Home</a></li>
                    <li class="dropdown"><a href="#"><span>Profile Nagari</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="<?= base_url(); ?>/web/sejarah">Sejarah Nagari</a></li>
                            <li><a href="<?= base_url(); ?>/web/visi">Visi & Misi</a></li>
                            <li><a href="<?= base_url(); ?>/web/wilayah">Profile Wilayah</a></li>
                            <li><a href="<?= base_url(); ?>/web/potensi">Potensi Wilayah</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="<?= base_url(); ?>/web/berita">Berita</a></li>
                    <li class="dropdown"><a href="#"><span>Pemerintahan Nagari</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="<?= base_url(); ?>/web/perangkat">Perangkat Nagari</a></li>
                            <li><a href="<?= base_url(); ?>/web/kan">KAN</a></li>
                            <li><a href="<?= base_url(); ?>/web/bprn">BPRN</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span>Lembaga Nagari</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="<?= base_url(); ?>/web/bundo">Bundo Kanduang</a></li>
                            <li><a href="<?= base_url(); ?>/web/ulama">Alim Ulama</a></li>
                            <li><a href="<?= base_url(); ?>/web/cadiak">Cadiak Pandai</a></li>
                            <li><a href="<?= base_url(); ?>/web/pemuda">Pemuda</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="<?= base_url(); ?>/web/data">Data Nagari</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url(); ?>/web/surat">Surat</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url(); ?>/web/kontak">Kontak</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url(); ?>/auth/login" target="_blank">PPID</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle" style="color:black"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <style>
        #hero {
            width: 100%;
            height: 100vh;
            background: linear-gradient(45deg,
                    /* rgba(29, 224, 153, 0.8),
      rgba(29, 200, 205, 0.8) */
                    rgba(171, 171, 171, 0.8),
                    rgba(171, 171, 171, 0.8)),
                url("<?= base_url(); ?>/aset/img/<?= $gambar['bg']; ?>") center top no-repeat;
            background-size: cover;
            position: relative;
        }
    </style>
    <?php if ($judul != 'Kata Sambutan' and $judul != 'Isi Berita' and $judul != 'Surat' and $judul != 'Potensi') { ?>
        <section id="hero">
            <div class="hero-text" data-aos="zoom-out" style="padding: 40px;">
                <div class="row">
                    <h1 style="font-size: 5vw;"><b><a style="color: black;" href="<?= base_url(); ?>/<?= $link; ?>"><?= $judul; ?></a></b></h1>
                    <p style="color: black; font-size: 2vw;"><a style="color: black;" target="_blank" href="<?= $direct; ?>"><?= $ket; ?></a></p>
                </div>
                <div class="row">
                    <?php if ($kontak->telp != NULL) : ?>
                        <div class="col">
                            <a href="tel:<?= $kontak->telp; ?>" class="btn-get-started scrollto" style="width: 250px;"><i class="fab fa-whatsapp"></i> Telepon</a>
                        </div>
                    <?php endif; ?>
                    <?php if ($kontak->email != NULL) : ?>
                        <div class="col">
                            <a href="mailto:<?= $kontak->email; ?>" class="btn-get-started scrollto" style="width: 250px;"><i class="fas fa-envelope"></i> Email</a>
                        </div>
                    <?php endif; ?>
                    <div class="col">
                        <a href="<?= base_url() ?>/auth/login" target="_blank" class="btn-get-started scrollto" style="width: 250px;"><i class="fas fa-user"></i> Layanan Mandiri</a>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
    <!-- End Hero Section -->
    <?= $this->renderSection('content'); ?>

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-lg-start text-center">
                    <div class="copyright">
                        &copy; Copyright <?= date('Y') ?> <strong>Safira Putri Nabila</strong> - Politeknik Negeri Padang
                    </div>
                    <div class="credits">
                        <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Avilon
          -->
                        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
                        <a href="<?= base_url(); ?>/">Home</a>
                        <a href="tel:<?= $kontak->telp; ?>" class="btn-get-started scrollto"><i class="fab fa-whatsapp"></i> : <?= $kontak->telp; ?></a>
                        <a href="mailto:<?= $kontak->email; ?>" class="btn-get-started scrollto"><i class="fas fa-envelope"></i> : <?= $kontak->email; ?></a>
                    </nav>
                </div>
            </div>
        </div>
    </footer><!-- End  Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-chevron-up"></i></a>
    <!-- Vendor JS Files -->
    <script src="<?= base_url(); ?>/assets/vendor/aos/aos.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url(); ?>/assets/js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>

    <script>
        $("#tab nav a").click(function() {
            const id = $(this).data('id');
            if (!$(this).hasClass('act')) {
                $("#tab nav a").removeClass('act');
                $(this).addClass('act');

                $('.tab-content').hide();
                $(`[data-content=${id}]`).fadeIn();
            }
        });
    </script>
</body>

</html>
