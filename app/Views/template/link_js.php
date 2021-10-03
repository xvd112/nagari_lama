<script src="<?= base_url(); ?>/aset/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/chart.js/Chart.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/sparklines/sparkline.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= base_url(); ?>/aset/dist/js/adminlte.js"></script>
<script src="<?= base_url(); ?>/aset/dist/js/demo.js"></script>
<script src="<?= base_url(); ?>/aset/dist/js/pages/dashboard.js"></script>

<script src="<?= base_url(); ?>/aset/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= base_url(); ?>/aset/plugins/uplot/uPlot.iife.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

<script>
    $(function() {
        $('.textarea').summernote()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        $(document).on('shown.lte.pushmenu', handleExpandedEvent)
        $('[data-widget="pushmenu"]').PushMenu('toggle')
    })
    $.widget.bridge('uibutton', $.ui.button)
</script>