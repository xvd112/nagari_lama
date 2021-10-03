<!-- Admin -->
<?php if (session()->get('level') == 1) : ?>
    <li class="nav-item">
        <a href="<?= base_url(); ?>/user/index" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
                User
            </p>
        </a>
    </li>
    <div class="dropdown-divider"></div>
<?php endif; ?>