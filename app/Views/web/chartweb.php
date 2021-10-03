<script>
    var ctx = document.getElementById('pc_penduduk').getContext('2d');
    var pc_penduduk = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Jorong Gantiang', 'Jorong Gunuang Rajo Utara'],
            datasets: [{
                data: [<?= $g; ?>, <?= $gru; ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Penduduk Tahun <?= date('Y'); ?>'
                },
            }
        }
    });
</script>
<script>
    <?php
    $y = date('Y');
    $l = array($y - 4, $y - 3, $y - 2, $y - 1, $y);
    ?>
    var ctx = document.getElementById('lc_rubah').getContext('2d');
    var lc_rubah = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?= $l[0]; ?>, <?= $l[1]; ?>, <?= $l[2]; ?>, <?= $l[3]; ?>, <?= $l[4]; ?>],
            datasets: [{
                    label: 'Penduduk per Tahun',
                    data: <?= JSON_ENCODE($rubah); ?>,
                    backgroundColor: ['#3c8dbc'],
                    borderColor: ['#3c8dbc']
                },
                {
                    label: 'Jorong Gunuang Rajo Utara',
                    data: <?= JSON_ENCODE($rubah_gru); ?>,
                    backgroundColor: ['#d2d6de'],
                    borderColor: ['#d2d6de']
                },
                {
                    label: 'Jorong Gantiang',
                    data: <?= JSON_ENCODE($rubah_g); ?>,
                    backgroundColor: ['#f39c12'],
                    borderColor: ['#f39c12']
                },
            ]
        },
        options: {
            maintainAspectRatio: true,
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Perubahan Penduduk 5 Tahun Terakhir'
                },
            }
        }
    });
</script>
<script>
    var ctx = document.getElementById('bc_pendidikan').getContext('2d');
    var bc_pendidikan = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= JSON_ENCODE($pen); ?>,
            datasets: [{
                label: 'Pendidikan',
                data: <?= JSON_ENCODE($isi_p); ?>,
                backgroundColor: ['#3bc43b'],
            }]
        },
        options: {
            maintainAspectRatio: true,
            responsive: true,
            indexAxis: 'y',
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Jumlah Penduduk Berdasakan Pendidikan Tahun <?= date('Y'); ?>'
                },
            }
        }
    });
</script>
<script>
    var ctx = document.getElementById('pc_agama').getContext('2d');
    var pc_agama = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?= JSON_ENCODE($agm); ?>,
            datasets: [{
                data: <?= JSON_ENCODE($isi_a); ?>,
                backgroundColor: [
                    '#b9deff', '#b9ffda', '#ffdab9',
                    '#ffb9de', '#dab9ff', '#ffdb9'
                ],
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Penduduk Tahun <?= date('Y'); ?>'
                },
            }
        }
    });
</script>
<script>
    var ctx = document.getElementById('pc_jekel').getContext('2d');
    var pc_jekel = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Laki - Laki', 'Perempuan'],
            datasets: [{
                data: [<?= $laki; ?>, <?= $perempuan; ?>],
                backgroundColor: [
                    '#b9deff', '#b9ffda'
                ],
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Penduduk Tahun <?= date('Y'); ?>'
                },
            }
        }
    });
</script>
<script>
    var ctx = document.getElementById('pc_jkg').getContext('2d');
    var pc_jkg = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Laki - Laki', 'Perempuan'],
            datasets: [{
                data: [<?= $laki_g; ?>, <?= $perempuan_g; ?>],
                backgroundColor: [
                    '#ffdab9', '#ffb9de'
                ],
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Penduduk Tahun <?= date('Y'); ?> Jorong Gantiang'
                },
            }
        }
    });
</script>
<script>
    var ctx = document.getElementById('pc_jkgru').getContext('2d');
    var pc_jkgru = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Laki - Laki', 'Perempuan'],
            datasets: [{
                data: [<?= $laki_gru; ?>, <?= $perempuan_gru; ?>],
                backgroundColor: [
                    '#dab9ff', '#ffdb9'
                ],
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Penduduk Tahun <?= date('Y'); ?> Jorong Gunuang Rajo Utara'
                },
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById('bc_umur').getContext('2d');
    var bc_umur = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['0-5', '6-12', '13-16', '17-25', '26-35', '36-45', '46-55', '56-65', '65>'],
            datasets: [{
                label: 'Umur',
                data: <?= JSON_ENCODE($umur); ?>,
                backgroundColor: ['#acbdb6'],
            }]
        },
        options: {
            maintainAspectRatio: true,
            responsive: true,
            indexAxis: 'y',
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Jumlah Penduduk Berdasakan Umur Tahun <?= date('Y'); ?>'
                },
            }
        }
    });
</script>