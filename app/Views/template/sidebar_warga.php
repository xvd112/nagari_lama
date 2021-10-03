<!-- Warga -->
<?php if (session()->get('level') == 3) : ?>
    <li class="nav-item">
        <a href="<?= base_url(); ?>/home" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
                My Profile
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url(); ?>/permohonan/index" class="nav-link">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
                Permohonan Surat
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url(); ?>/aduan/index" class="nav-link">
            <i class="nav-icon fas fa-volume-up"></i>
            <p>
                Pojok Aduan
            </p>
        </a>
    </li>
    <div class="dropdown-divider"></div>
<?php endif; ?>