<?= $this->include('template/link_css'); ?>
<?= $this->include('template/header'); ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="<?= base_url(); ?>/home" class="brand-link">
    <img src="<?= base_url(); ?>/aset/img/logo.png" alt="Nagari Gunung Rajo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><b>Nagari Gunung Rajo</b></span>
  </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?= $this->include('template/sidebar_pemerintah'); ?>
        <?= $this->include('template/sidebar_admin'); ?>
        <?= $this->include('template/sidebar_warga'); ?>

        <li class="nav-item">
          <a href="<?= base_url(); ?>/auth/logout" class="nav-link">
            <i class="nav-icon fas fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>

<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function() {
      $(this).remove();
    });
  }, 3000);
</script>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?= $ket[0]; ?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/home/index">
                <?php
                if (session()->get('level') == 1 or session()->get('level') == 2) {
                  echo 'Beranda';
                } else {
                  echo ' My Profile';
                }  ?>
              </a></li>
            <?php
            for ($i = 1; $i < count($ket); $i++) {
            ?>
              <?= $ket[$i]; ?>
            <?php } ?>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <?= $this->renderSection('content'); ?>
</div>
<?= $this->include('template/footer'); ?>
<?= $this->include('template/link_js'); ?>
<?php if (isset($link) and $link == 'chart') { ?>
  <?= $this->include('template/chart'); ?>
<?php } ?>
<?= $this->include('template/form'); ?>
<?= $this->include('template/ambil_data'); ?>