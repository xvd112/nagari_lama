<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        $('#example2-2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        $('#example2-3').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        $("#centangsemua").click(function(e) {
            if ($(this).is(':checked')) {
                $('.centang').prop('checked', true);
            } else {
                $('.centang').prop('checked', false);
            }
        });

        $("#centangsemua2").click(function(e) {
            if ($(this).is(':checked')) {
                $('.centang').prop('checked', true);
            } else {
                $('.centang').prop('checked', false);
            }
        });

        $("#centangsemua3").click(function(e) {
            if ($(this).is(':checked')) {
                $('.centang').prop('checked', true);
            } else {
                $('.centang').prop('checked', false);
            }
        });

        $(document).on('shown.lte.pushmenu', handleExpandedEvent)
        $('[data-widget="pushmenu"]').PushMenu('toggle')
    });
    $.widget.bridge('uibutton', $.ui.button)
</script>