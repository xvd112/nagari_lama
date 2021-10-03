<?= $this->extend('auth/template'); ?>

<?= $this->section('content'); ?>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-md-10 col-lg-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><?= $title; ?></h1>
                                </div>
                                <?php if (session()->getFlashdata('error')) { ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        <?= session()->getFlashdata('error'); ?>
                                    </div>
                                <?php } ?>

                                <form class="user" action="<?= base_url() ?>/auth/cek_login" method="post">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <input required type="text" class="form-control form-control-user" name="login" placeholder="Masukkan NIK / No Telepon / Email">
                                    </div>
                                    <div class="form-group">
                                        <input required type="password" class="form-control form-control-user" name="password" placeholder="Masukkan Password">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        <?= $title; ?>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<?= $this->endSection(); ?>