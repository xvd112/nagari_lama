<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $penduduk; ?></h3>
                        <p>Penduduk</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="<?= base_url(); ?>/penduduk/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $keluarga; ?></h3>
                        <p>Kepala Keluarga</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <a href="<?= base_url(); ?>/keluarga/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning" style="height: 141px;">
                    <div class="inner">
                        <h3><?= $lk; ?></h3>
                        <p>Laki - Laki</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger" style="height: 141px;">
                    <div class="inner">
                        <h3><?= $pr; ?></h3>
                        <p>Perempuan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title" style="padding:5px">
                            Penduduk
                        </h3>
                        <div class="card-tools" style="padding:5px">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#jorong" data-toggle="tab">Jorong</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#jekel_g" data-toggle="tab">Jekel Gantiang</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#jekel_gru" data-toggle="tab">Jekel Gunuang Rajo Utara</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#umur" data-toggle="tab">Umur</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <div class="chart tab-pane active" id="jorong" style="position: relative; height: 300px;">
                                <canvas id="pc_jorong" height="300" style="height: 300px;"></canvas>
                            </div>
                            <div class="chart tab-pane " id="jekel_g" style="position: relative; height: 300px;">
                                <canvas id="pc_jekel_g" height="300" style="height: 300px;"></canvas>
                            </div>
                            <div class="chart tab-pane " id="jekel_gru" style="position: relative; height: 300px;">
                                <canvas id="pc_jekel_gru" height="300" style="height: 300px;"></canvas>
                            </div>
                            <div class="chart tab-pane" id="umur" style="position: relative; height: 300px;">
                                <canvas id="bc_umur" height="300" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title" style="padding:5px">Aduan</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="bc_aduan" style="min-height: 305px; height: 305px; max-height: 305px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title" style="padding:5px">
                            Grafik Penduduk
                        </h3>
                        <div class="card-tools" style="padding:5px">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#rubah" data-toggle="tab">Perubahan Penduduk</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#banding" data-toggle="tab">Kelahiran & Kematian</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <div class="chart tab-pane active" id="rubah" style="position: relative; height: 300px;">
                                <canvas id="bc_rubah" height="300" style="height: 300px;"></canvas>
                            </div>
                            <div class="chart tab-pane" id="banding" style="position: relative; height: 300px;">
                                <canvas id="bc_banding" height="300" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title" style="padding:5px">Permohonan Surat</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="bc_mohon" style="min-height: 305px; height: 305px; max-height: 305px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>