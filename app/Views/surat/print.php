<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="SHORTCUT ICON" href="<?php echo base_url() ?>/aset/img/logo.png">
</head>

<body>
    <?= $this->include('template/tgl'); ?>
    <div align="center">
        <b><u>SURAT KETERANGAN USAHA</u></b><br>
        NO.<?= $surat->no_surat; ?>/PEREK/<?= date('Y', strtotime($surat->tgl_surat)); ?>
    </div>
    <div style="text-align: justify;">
        &nbsp;&nbsp; Yang bertanda tangan dibawah ini adalah Wali Nagari <?= $data->nagari; ?> Kecamatan <?= $data->kec; ?> Kabupaten <?= $data->kab; ?>, dengan ini :
        <br>
        <table>
            <tr>
                <td>Nama</td>
                <td style="width: 10px;"> : </td>
                <td style="width: 60%;"><b><?= $surat->nama; ?></b></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td> : </td>
                <td><?= $surat->jekel; ?></td>
            </tr>
            <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td> : </td>
                <td><?= $surat->tpt_lahir; ?> / <?= tgl_indo($surat->tgl_lahir); ?></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td> : </td>
                <td><?= $surat->nik; ?></td>
            </tr>
            <tr>
                <td>Agama</td>
                <td> : </td>
                <td><?= $surat->agama; ?></td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td> : </td>
                <td><?= $surat->kerja; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td> : </td>
                <td><?= $kk->alamat; ?> Nagari <?= $data->nagari; ?> Kecamatan <?= $data->kec; ?> Kabupaten <?= $data->kab; ?></td>
            </tr>
        </table>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nama yang tersebut diatas memang benar Penduduk Nagari <?= $data->nagari; ?> Kecamatan <?= $data->kec; ?> Kabupaten <?= $data->kab; ?> dan benar usaha sehari-hari adalah <b><?= $surat->tambahan; ?></b>. <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Surat Keterangan Usaha ini dipergunakan sebagai syarat untuk <?= $surat->tujuan; ?>. <br>
        &nbsp; &nbsp; Demikianlah Surat Keterangan usaha ini kami berikan untuk dapat dipergunakan oleh yang bersangkutan.
        <div style="text-align: right;">
            <?= $data->nagari; ?>, <?= tgl_indo($surat->tgl_surat); ?><br>
            Wali Nagari <?= $data->nagari; ?>
            <?php if ($ttd->jabatan == 'Sekretaris Nagari')
                echo '<br> a/n Sekretaris Nagari'
            ?>
            <br><br><br><br>
            <?= $ttd->nama; ?>
        </div>
    </div>
</body>

</html>