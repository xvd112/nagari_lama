<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SuratModel;
use App\Models\PendudukModel;
use App\Models\AlamatModel;
use App\Models\KeluargaModel;
use App\Models\PerangkatModel;
use App\Models\AuthModel;
use App\Models\GaleriModel;
use TCPDF;

class pdf extends TCPDF
{
    public function Header()
    {
        $this->data =  new AlamatModel();
        $x = $this->data->getAlamat();
        $kab = strtoupper($x->kab);
        $kec = strtoupper($x->kec);
        $nag = strtoupper($x->nagari);
        $image_file = @FCPATH . 'aset\img\logo.png';
        $this->SetY(10);
        $this->SetFont('times', 'B', 12);
        $isi_header = "
        <table>
            <tr>
                <td width=\"70\"><img src=\"" . $image_file . "\" width=\"80\" height=\"80\"></td>
                <td align=\"center\" style=\"font-size:17px\" width=\"90%\">
                    PEMERINTAHAN KABUPATEN " . $kab . "<br>
                    KECAMATAN " . $kec . "<br>
                    WALI NAGARI " . $nag . "
                </td>
            </tr>
            <tr>
                <td width=\"50%\">" . $x->alm . "</td>
                <td width=\"50%\" align=\"right\">Kode Pos : " . $x->kd_pos . "</td>
            </tr>
        </table>
        <hr>
        ";
        $this->writeHTML($isi_header, true, false, false, false, '');
    }
}

class Skpo extends Controller
{
    protected $model, $penduduk, $data, $keluarga, $perangkat;
    public function __construct()
    {
        helper('form');
        $this->model =  new SuratModel();
        $this->penduduk =  new PendudukModel();
        $this->data =  new AlamatModel();
        $this->keluarga =  new KeluargaModel();
        $this->perangkat =  new PerangkatModel();
        $this->user =  new AuthModel();
        $this->gal =  new GaleriModel();
    }

    public function index()
    {
        $ket = [
            'Data Surat Keterangan Penghasilan Orang Tua', '<li class="breadcrumb-item active"><a href="/skpo/index">Data Surat Keterangan Penghasilan Orang Tua</a></li>'
        ];
        $data = [
            'title' => 'Data Surat Keterangan Penghasilan Orang Tua',
            'ket' => $ket,
            'link' => 'skpo',
            'surat' => $this->model->getSurat(false, 'SKPO'),
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('surat/index', $data);
    }

    // View detail data
    public function view($id_surat)
    {
        $x = $this->model->getSurat($id_surat, 'SKPO');
        $ket = [
            'View Data Surat Keterangan Penghasilan Orang Tua', '<li class="breadcrumb-item active"><a href="/skpo/index">Data Surat Keterangan Penghasilan Orang Tua</a></li>',
            '<li class="breadcrumb-item active">View Data</li>'
        ];
        $data = [
            'title' => 'View Data Surat Keterangan Penghasilan Orang Tua',
            'ket' => $ket,
            'link' => 'skpo',
            'surat' => $x,
            'data' => $this->data->getAlamat(),
            'gal' => $this->gal->getGaleri(2),
            'kk' => $this->keluarga->getKeluarga($x->id_keluarga),
            'ttd' => $this->perangkat->getPerangkat($x->id_pemerintahan, 'Perangkat Nagari'),
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id),
            'jenis_s' => 'SURAT KETERANGAN MISKIN',
            'label_s' => '/SKM/KESRA',
            'label' => 'Penghasilan Orang Tua'
        ];
        return view('surat/view', $data);
    }

    public function nama($id_penduduk)
    {
        $data = $this->penduduk->id($id_penduduk, 'id_penduduk');
        $json = array();
        $json['nama'] = $data->tambahan;
        return $this->response->setJson($json);
    }

    // Menampilkan form input
    public function input()
    {
        $ket = [
            'Tambah Data Surat Keterangan Penghasilan Orang Tua',
            '<li class="breadcrumb-item active"><a href="/skpo/index">Data Surat Keterangan Penghasilan Orang Tua</a></li>',
            '<li class="breadcrumb-item active">Tambah Data</li>'
        ];
        $data = [
            'title' => 'Tambah Data Surat Keterangan Penghasilan Orang Tua',
            'ket' => $ket,
            'link' => 'skpo',
            'label' => 'Penghasilan Orang Tua',
            'keluarga' => $this->keluarga->getKeluarga(),
            'ttd' => $this->perangkat->ttd(),
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('surat/input', $data);
    }

    public function add()
    {
        $request = \Config\Services::request();
        $max = $this->model->no('SKPO');
        $data = array(
            'no_surat' => $max->x + 1,
            'id_penduduk' => $request->getPost('id_penduduk'),
            'id_pemerintahan' => $request->getPost('ttd'),
            'tgl_surat' => date('Y-m-d'),
            'jenis' => 'SKPO',
            'tujuan' => $request->getPost('tujuan'),
            'tambahan' => $request->getPost('ket'),
        );
        $this->model->saveSurat($data);
        return redirect()->to('skpo/index');
    }

    public function print($id_surat)
    {
        $x = $this->model->getSurat($id_surat, 'SKPO');
        $c = $this->penduduk->id_array($x->id_keluarga, 'id_keluarga');
        $z = 0;
        for ($i = 0; $i < count($c); $i++) {
            if ($c[$i]['status_hub'] != 'Kepala Keluarga') {
                $kel[$z]['nama'] = $c[$i]['nama'];
                $kel[$z]['jekel'] = $c[$i]['jekel'];
                $kel[$z]['kerja'] = $c[$i]['kerja'];
                $kel[$z]['status_hub'] = $c[$i]['status_hub'];
                $kel[$z]['umur'] = date('Y') - date('Y', strtotime($c[$i]['tgl_lahir']));
                $z++;
            }
        }
        $data = [
            'title' => 'View Data Surat Keterangan Penghasilan Orang Tua',
            'surat' => $x,
            'data' => $this->data->getAlamat(),
            'kk' => $this->keluarga->getKeluarga($x->id_keluarga),
            'ttd' => $this->perangkat->getPerangkat($x->id_pemerintahan, 'Perangkat Nagari'),
            'ayah' => $this->penduduk->id($x->nik_ayah, 'nik'),
            'ibu' => $this->penduduk->id($x->nik_ibu, 'nik'),
            'kel' => $kel,
            'jenis' => 'Miskin',
            'link' => 'SKpo'
        ];
        $html = view('surat/printskm', $data);
        $pdf = new pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'F4', true, 'UTF-8', false);
        $pdf->SetFont('times', '', 12);
        $pdf->setHeaderMargin(20);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        $pdf->SetMargins(20, 45, 20, true);
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $this->response->setContentType('application/pdf');
        $pdf->Output('skpo.pdf', 'I');
    }

    ///edit data
    public function edit($id_surat)
    {
        $surat = $this->model->getSurat($id_surat, 'SKPO');
        if (isset($surat)) {
            $ket = [
                'Edit ' . $surat->tambahan,
                '<li class="breadcrumb-item active"><a href="/skpo/index">Data Surat Keterangan Penghasilan Orang Tua</a></li>',
                '<li class="breadcrumb-item active">Edit Data</li>'
            ];
            $x = $this->penduduk->getPenduduk($surat->id_penduduk);
            $data = [
                'title' => 'Edit ' . $surat->tambahan,
                'ket' => $ket,
                'link' => 'skpo',
                'label' => 'Penghasilan Orang Tua',
                'keluarga' => $this->keluarga->getKeluarga(),
                'surat' => $surat,
                'kel' => $x,
                'penduduk' => $this->penduduk->id_array($surat->id_keluarga, 'id_keluarga'),
                'ttd' => $this->perangkat->ttd(),
                'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
                'isi' => $this->user->getUser(session()->id)
            ];
            return view('surat/edit', $data);
        } else {
            session()->setFlashdata('warning_surat', 'Surat tanggal : ' . $surat->tambahan . ' Tidak Ditemukan.');
            return redirect()->to('skpo/index');
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id_surat = $request->getPost('id_surat');
        $max = $this->model->no('SKPO');
        $data = array(
            'no_surat' => $max->x + 1,
            'id_penduduk' => $request->getPost('id_penduduk'),
            'id_pemerintahan' => $request->getPost('ttd'),
            'tgl_surat' => date('Y-m-d'),
            'jenis' => 'SKPO',
            'tujuan' => $request->getPost('tujuan'),
            'tambahan' => $request->getPost('ket'),
        );
        $this->model->editSurat($data, $id_surat);
        session()->setFlashdata('pesan_surat', 'Data Surat Keterangan Penghasilan Orang Tua Berhasi Diedit.');
        return redirect()->to('skpo/index');
    }

    // Menghapus data
    public function delete($id_surat)
    {
        $surat = $this->model->getSurat($id_surat, 'SKPO');
        if (isset($surat)) {
            $this->model->hapusSurat($id_surat);
            session()->setFlashdata('danger_surat', 'Data Surat Keterangan Penghasilan Orang Tua : ' . $surat->tambahan . ' Berhasi Dihapus.');
            return redirect()->to('skpo/index');
        } else {
            session()->setFlashdata('warning_surat', 'Data Surat Keterangan Penghasilan Orang Tua : ' . $surat->tambahan . ' Tidak Ditemukan.');
            return redirect()->to('skpo/index');
        }
    }

    // Menghapus data pilihan
    public function hapusbanyak()
    {
        $request = \Config\Services::request();
        $id_surat = $request->getPost('id_surat');
        if ($id_surat == null) {
            session()->setFlashdata('warning_surat', 'Data Pejabat dan berita Desa Belum Dipilih, Silahkan Pilih Data Terlebih Dahulu.');
            $data['title'] = 'Data Surat Keterangan Penghasilan Orang Tua dan Pejabat Desa';
            return redirect()->to('skpo/index');
        }

        $jmldata = count($id_surat);
        $x = 0;
        for ($i = 0; $i < $jmldata; $i++) {
            $this->model->hapusSurat($id_surat[$i]);
            $x++;
        }

        session()->setFlashdata('pesan_surat', 'Data Pejabat dan berita Desa Berhasi Dihapus Sebanyak ' . $x . ' Data.');
        $data['title'] = 'Data Surat Keterangan Penghasilan Orang Tua dan Pejabat Desa';
        return redirect()->to('skpo/index');
    }
}
