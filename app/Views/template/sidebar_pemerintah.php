<!-- Pemerintah -->
<?php if (session()->get('level') == 2 or session()->get('level') == 1) : ?>
    <li class="nav-item">
        <a href="<?= base_url(); ?>/home" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
                Beranda
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url(); ?>/profile/index" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
                Profile
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-balance-scale"></i>
            <p>
                Pemerintahan Nagari
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url(); ?>/nagari/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Perangkat Nagari</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url(); ?>/bprn/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>BPRN</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url(); ?>/kan/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>KAN</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-building"></i>
            <p>
                Lembaga Nagari
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url(); ?>/bundo/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bundo Kanduang</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url(); ?>/ulama/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Alim Ulama</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url(); ?>/cadiak/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cadiak Pandai</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url(); ?>/pemuda/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pemuda</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
                Kependudukan
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url(); ?>/keluarga/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Keluarga</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url(); ?>/penduduk/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penduduk</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url(); ?>/lahir/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kelahiran</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url(); ?>/mati/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kematian</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
                Surat
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url(); ?>/sku/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>SKU</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url(); ?>/sktm/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>SKTM</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url(); ?>/skm/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>SKM</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url(); ?>/skpo/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>SKPO</p>
                </a>
            </li>
        </ul>
    </li>
    <div class="dropdown-divider"></div>
    <li class="nav-item">
        <a href="<?= base_url(); ?>/permohonan/index" class="nav-link">
            <i class="nav-icon fas fa-mail-bulk"></i>
            <p>
                List Permohonan Surat
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url(); ?>/aduan/index" class="nav-link">
            <i class="nav-icon fas fa-volume-up"></i>
            <p>
                List Aduan Warga
            </p>
        </a>
    </li>
    <div class="dropdown-divider"></div>
    <li class="nav-item">
        <a href="<?= base_url(); ?>/berita/index" class="nav-link">
            <i class="nav-icon fas fa-newspaper"></i>
            <p>
                Berita
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>
                Data Nagari
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url(); ?>/data/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Alamat</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url(); ?>/data/info" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Info Desa</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url(); ?>/potensi/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Potensi</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url(); ?>/galeri/index" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Galeri</p>
                </a>
            </li>
        </ul>
    </li>
    <div class="dropdown-divider"></div>
<?php endif; ?>