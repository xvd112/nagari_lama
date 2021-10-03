<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

    <link rel="SHORTCUT ICON" href="<?php echo base_url() ?>/aset/img/logo.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/aset/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/aset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/aset/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/aset/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/aset/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/aset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/aset/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/aset/plugins/summernote/summernote-bs4.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>/aset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/aset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/aset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/aset/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/aset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/aset/plugins/uplot/uPlot.min.css">

    <script>
        $(function() {
            $("#datepicker").datepicker({
                maxDate: moment().toDate(),
                dateFormat: "yy-mm-dd"
            });
        });
    </script>
</head>