<script>
    $(function() {
        // Pie Chart untuk Data penduduk per jorong -> Penduduk
        var pieChartCanvas = $('#pc_jorong').get(0).getContext('2d')
        <?php
        ?>
        var jekel = {
            labels: [
                'Jorong Gantiang',
                'Jorong Gunuang Rajo Utara'
            ],
            datasets: [{
                data: [<?= $g; ?>, <?= $gru; ?>],
                backgroundColor: ['lightblue', 'lightpink'],
            }]
        }
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        var pc_jekel = new Chart(pieChartCanvas, {
            type: 'pie',
            data: jekel,
            options: pieOptions
        })

        // Pie Chart untuk Data Jenis Kelamin -> Penduduk
        var pieChartCanvas = $('#pc_jekel_g').get(0).getContext('2d')
        var jekel = {
            labels: [
                'Perempuan',
                'Laki - Laki'
            ],
            datasets: [{
                data: [<?= $perempuan; ?>, <?= $laki; ?>],
                backgroundColor: ['#f38630', '#0b486b'],
            }]
        }
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        var pc_jekel = new Chart(pieChartCanvas, {
            type: 'pie',
            data: jekel,
            options: pieOptions
        })

        var pieChartCanvas = $('#pc_jekel_gru').get(0).getContext('2d')
        var jekel_g = {
            labels: [
                'Perempuan',
                'Laki - Laki'
            ],
            datasets: [{
                data: [<?= $perempuan_gru; ?>, <?= $laki_gru; ?>],
                backgroundColor: ['#f38630', '#0b486b'],
            }]
        }
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        var pc_jekel = new Chart(pieChartCanvas, {
            type: 'pie',
            data: jekel_g,
            options: pieOptions
        })

        // Bar Chart untuk Data Umur -> Penduduk
        var DataBar = {
            labels: ['0-5', '6-12', '13-16', '17-25', '26-35', '36-45', '46-55', '56-65', '65>'],
            datasets: [{
                label: 'Umur',
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef',
                    '#3c8dbc', '#d2d6de', '#f56954', '#00a65a', '#f39c12',
                    '#f56954', '#00a65a', '#f39c12', '#00c0ef',
                    '#3c8dbc', '#d2d6de', '#f56954', '#00a65a', '#f39c12',
                    '#f56954', '#00a65a', '#f39c12', '#00c0ef',
                    '#3c8dbc', '#d2d6de', '#f56954', '#00a65a', '#f39c12',
                    '#f56954', '#00a65a', '#f39c12', '#00c0ef',
                    '#3c8dbc', '#d2d6de', '#f56954', '#00a65a', '#f39c12'
                ],
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: <?= JSON_ENCODE($umur); ?>
            }, ]
        }

        var barChartCanvas = $('#bc_umur').get(0).getContext('2d')
        var barChartData = jQuery.extend(true, {}, DataBar)

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: true
        }

        var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })

        // Kelahiran dan Kematian
        var areaChartData = {
            labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
            datasets: [{
                    label: 'Kelahiran <?= date('Y'); ?>',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: <?= JSON_ENCODE($lahir); ?>
                },
                {
                    label: 'Kematian <?= date('Y'); ?>',
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: <?= JSON_ENCODE($mati); ?>
                },
            ]
        };

        var barChartCanvas = $('#bc_banding').get(0).getContext('2d')
        var barChartData = jQuery.extend(true, {}, areaChartData)
        var temp0 = areaChartData.datasets[0]
        var temp1 = areaChartData.datasets[1]
        barChartData.datasets[0] = temp1
        barChartData.datasets[1] = temp0

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false
        }

        var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })

        // Perubahan
        <?php
        $y = date('Y');
        $l = array($y - 4, $y - 3, $y - 2, $y - 1, $y);
        ?>
        var perubahan = {
            labels: [<?= $l[0]; ?>, <?= $l[1]; ?>, <?= $l[2]; ?>, <?= $l[3]; ?>, <?= $l[4]; ?>],
            datasets: [{
                label: 'Penduduk per Tahun',
                backgroundColor: [
                    '#3c8dbc', '#d2d6de', '#f56954', '#00a65a', '#f39c12'
                ],
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: true,
                fill: false,
                lineTension: 0.1,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: <?= JSON_ENCODE($rubah); ?>
            }, ]
        };
        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: true,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: true,
                    }
                }]
            }
        }

        var lineChartCanvas = $('#bc_rubah').get(0).getContext('2d')
        var lineChartOptions = $.extend(true, {}, areaChartOptions)
        var lineChartData = $.extend(true, {}, perubahan)

        var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
        })

        // Bar Chart Permohonan Surat
        var pieChartCanvas = $('#bc_mohon').get(0).getContext('2d')
        <?php
        ?>
        var mohon = {
            labels: [
                'SKU', 'SKTM', 'SKM', 'SKPO'
            ],
            datasets: [{
                data: <?= JSON_ENCODE($mohon); ?>,
                backgroundColor: ['lightblue', 'lightpink', 'lightgrey', 'lightgreen'],
            }]
        }
        var pieOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        var pc_mohon = new Chart(pieChartCanvas, {
            type: 'pie',
            data: mohon,
            options: pieOptions
        })

        // Bar Chart Aduan
        var aduan = {
            labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
            datasets: [{
                label: 'Penduduk per Tahun',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: true,
                fill: false,
                lineTension: 0.1,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: <?= JSON_ENCODE($aduan); ?>
            }, ]
        };
        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: true,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: true,
                    }
                }]
            }
        }

        var lineChartCanvas = $('#bc_aduan').get(0).getContext('2d')
        var lineChartOptions = $.extend(true, {}, areaChartOptions)
        var lineChartData = $.extend(true, {}, aduan)

        var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
        })
    })
</script>