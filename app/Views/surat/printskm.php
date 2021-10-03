<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?= $this->include('template/tgl'); ?>
    <div align="center">
        <b><u>SURAT KETERANGAN <?= strtoupper($jenis); ?></u></b><br>
        NO.<?= $surat->no_surat; ?>/<?= $link; ?>/KESRA/<?= date('Y', strtotime($surat->tgl_surat)); ?>
    </div>
    <div style="text-align: justify;">
        &nbsp;&nbsp; Yang bertanda tangan dibawah ini adalah Wali Nagari <?= $data->nagari; ?> Kecamatan <?= $data->kec; ?> Kabupaten <?= $data->kab; ?> menerangkan bahwa :
        <br>
        <table>
            <tr>
                <td style="width: 110px;">Nama</td>
                <td style="width: 10px;"> : </td>
                <td style="width: 75%;"><b><?= $surat->nama; ?></b></td>
            </tr>
            <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td> : </td>
                <td><?= $surat->tpt_lahir; ?> / <?= tgl_indo($surat->tgl_lahir); ?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td> : </td>
                <td><?= $surat->jekel; ?></td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td> : </td>
                <td><?= $surat->kerja; ?></td>
            </tr>
            <tr>
                <td>Agama</td>
                <td> : </td>
                <td><?= $surat->agama; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td> : </td>
                <td><?= $kk->alamat; ?> Nagari <?= $data->nagari; ?> Kecamatan <?= $data->kec; ?> Kabupaten <?= $data->kab; ?></td>
            </tr>
        </table>
        <br><br>
        <?php if ($surat->status_hub == 'Anak') { ?>
            &nbsp;&nbsp; Nama tersebut di atas adalah anak dari :
            <br>
            <table>
                <tr>
                    <td style="width: 110px;">Nama Ayah</td>
                    <td style="width: 10px;"> : </td>
                    <td style="width: 75%;"><b><?= $surat->nm_ayah; ?></b></td>
                </tr>
                <?php if ($surat->nik_ayah != NULL or $surat->nik_ayah != '-') { ?>
                    <tr>
                        <td>Tempat/Tanggal Lahir</td>
                        <td> : </td>
                        <td><?= $ayah->tpt_lahir; ?> / <?= tgl_indo($ayah->tgl_lahir); ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td> : </td>
                        <td><?= $ayah->jekel; ?></td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        <td> : </td>
                        <td><?= $ayah->kerja; ?></td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td> : </td>
                        <td><?= $ayah->agama; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td> : </td>
                        <td><?= $kk->alamat; ?> Nagari <?= $data->nagari; ?> Kecamatan <?= $data->kec; ?> Kabupaten <?= $data->kab; ?></td>
                    </tr>
                <?php } ?>
            </table>
            <br><br>
            <table>
                <tr>
                    <td style="width: 110px;">Nama Ibu</td>
                    <td style="width: 10px;"> : </td>
                    <td style="width: 75%;"><b><?= $surat->nm_ibu; ?></b></td>
                </tr>
                <?php if ($surat->nik_ibu != NULL or $surat->nik_ibu != '-') { ?>
                    <tr>
                        <td>Tempat/Tanggal Lahir</td>
                        <td> : </td>
                        <td><?= $ibu->tpt_lahir; ?> / <?= tgl_indo($ibu->tgl_lahir); ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td> : </td>
                        <td><?= $ibu->jekel; ?></td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        <td> : </td>
                        <td><?= $ibu->kerja; ?></td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td> : </td>
                        <td><?= $ibu->agama; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td> : </td>
                        <td><?= $kk->alamat; ?> Nagari <?= $data->nagari; ?> Kecamatan <?= $data->kec; ?> Kabupaten <?= $data->kab; ?></td>
                    </tr>
                <?php } ?>
            </table>
            <br><br>
        <?php } ?>
        &nbsp; Nama yang tersebut di atas adalah benar Penduduk Nagari <?= $data->nagari; ?> Kecamatan <?= $data->kec; ?> Kabupaten <?= $data->kab; ?>. Dimana sepengetahuan kami keluarga
        tersebut memang termasuk kelurga <?= strtolower($jenis); ?> dengan penghasilan <b>Rp<?= number_format($surat->tambahan, 2, ',', '.') ?></b>/bulan.
        <br>
        &nbsp;&nbsp; Surat Keterangan <?= $jenis; ?> ini kami berikan untuk keperluan <?= $surat->tujuan; ?>.
        <br>
        <table border="1" align="center">
            <tr>
                <td style="width: 20px;"><b>No</b></td>
                <td style="width: 100px;"><b>Nama</b></td>
                <td style="width: 100px;"><b>Jenis Kelamin</b></td>
                <td style="width: 45px;"><b>Umur</b></td>
                <td style="width: 140px;"><b>Pekerjaan</b></td>
                <td><b>Hubungan</b></td>
            </tr>
            <?php $no = 1;
            foreach ($kel as $kel) { ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td> <?= $kel['nama']; ?></td>
                    <td> <?= $kel['jekel']; ?></td>
                    <td> <?= $kel['umur']; ?> Th</td>
                    <td> <?= $kel['kerja']; ?></td>
                    <td> <?= $kel['status_hub']; ?></td>
                </tr>
            <?php $no++;
            } ?>
        </table>
        <br>
        &nbsp; &nbsp; Demikianlah Surat Keterangan <?= $jenis; ?> ini kami buat agar dapat dipergunakan seperlunya oleh yang bersangkutan.
        <br>
        <table align="center">
            <tr>
                <td>Diketahui <br>Camat Batipuh</td>
                <td><?= $data->nagari; ?>, <?= tgl_indo($surat->tgl_surat); ?><br>
                    Wali Nagari <?= $data->nagari; ?>
                    <?php if ($ttd->jabatan == 'Sekretaris Nagari')
                        echo '<br> a/n Sekretaris Nagari'
                    ?></td>
            </tr>
            <tr>
                <td>
                    <br><br><br><br>
                    <hr>
                </td>
                <td><br><br><br><br><?= $ttd->nama; ?></td>
            </tr>
        </table>
    </div>
</body>

</html>