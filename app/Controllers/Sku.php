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

class Sku extends Controller
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
            'Data Surat Keterangan Usaha', '<li class="breadcrumb-item active"><a href="/sku/index">Data Surat Keterangan Usaha</a></li>'
        ];
        $data = [
            'title' => 'Data Surat Keterangan Usaha',
            'ket' => $ket,
            'link' => 'sku',
            'surat' => $this->model->getSurat(false, 'SKU'),
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('surat/index', $data);
    }

    public function view($id_surat)
    {
        $x = $this->model->getSurat($id_surat, 'SKU');
        $ket = [
            'View Data Surat Keterangan Usaha', '<li class="breadcrumb-item active"><a href="/sku/index">Data Surat Keterangan Usaha</a></li>',
            '<li class="breadcrumb-item active">View Data</li>'
        ];
        $data = [
            'title' => 'View Data Surat Keterangan Usaha',
            'ket' => $ket,
            'link' => 'sku',
            'surat' => $x,
            'data' => $this->data->getAlamat(),
            'gal' => $this->gal->getGaleri(2),
            'kk' => $this->keluarga->getKeluarga($x->id_keluarga),
            'ttd' => $this->perangkat->getPerangkat($x->id_pemerintahan, 'Perangkat Nagari'),
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id),
            'jenis_s' => 'SURAT KETERANGAN USAHA',
            'label_s' => '/PEREK/',
            'label' => 'Jenis Usaha',
        ];
        return view('surat/view', $data);
    }

    public function print($id_surat)
    {
        $x = $this->model->getSurat($id_surat, 'SKU');
        $data = [
            'title' => 'View Data Surat Keterangan Usaha',
            'surat' => $x,
            'data' => $this->data->getAlamat(),
            'kk' => $this->keluarga->getKeluarga($x->id_keluarga),
            'ttd' => $this->perangkat->getPerangkat($x->id_pemerintahan, 'Perangkat Nagari')
        ];
        $html = view('surat/print', $data);
        $pdf = new pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'F4', true, 'UTF-8', false);
        $pdf->SetFont('times', '', 12);
        $pdf->setHeaderMargin(20);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        $pdf->SetMargins(20, 45, 20, true);
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $this->response->setContentType('application/pdf');
        $pdf->Output('sku.pdf', 'I');
    }

    public function input()
    {
        $ket = [
            'Tambah Data Surat Keterangan Usaha',
            '<li class="breadcrumb-item active"><a href="/sku/index">Data Surat Keterangan Usaha</a></li>',
            '<li class="breadcrumb-item active">Tambah Data</li>'
        ];
        $data = [
            'title' => 'Tambah Data Surat Keterangan Usaha',
            'ket' => $ket,
            'link' => 'sku',
            'label' => 'Jenis Usaha',
            'keluarga' => $this->keluarga->getKeluarga(),
            'ttd' => $this->perangkat->ttd(),
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('surat/input', $data);
    }

    public function nama($id_penduduk)
    {
        $data = $this->penduduk->id($id_penduduk, 'id_penduduk');
        $json = array();
        $json['nama'] = $data->tambahan;
        return $this->response->setJson($json);
    }

    public function getnik($id_keluarga)
    {
        $data = $this->penduduk->id_array($id_keluarga, 'id_keluarga');
        for ($i = 0; $i < count($data); $i++) {
            $json[$i]['nik'] = $data[$i]['nik'];
            $json[$i]['id_penduduk'] = $data[$i]['id_penduduk'];
            $json[$i]['nama'] = $data[$i]['nama'];
        }
        return $this->response->setJson($json);
    }

    public function add()
    {
        $request = \Config\Services::request();
        $max = $this->model->no('SKU');
        $data = array(
            'no_surat' => $max->x + 1,
            'id_penduduk' => $request->getPost('id_penduduk'),
            'id_pemerintahan' => $request->getPost('ttd'),
            'tgl_surat' => date('Y-m-d'),
            'jenis' => 'SKU',
            'tujuan' => $request->getPost('tujuan'),
            'tambahan' => $request->getPost('ket'),
        );
        $this->model->saveSurat($data);
        return redirect()->to('sku/index');
    }

    public function edit($id_surat)
    {
        $surat = $this->model->getSurat($id_surat, 'SKU');
        if (isset($surat)) {
            $ket = [
                'Edit ' . $surat->tambahan,
                '<li class="breadcrumb-item active"><a href="/sku/index">Data Surat Keterangan Usaha</a></li>',
                '<li class="breadcrumb-item active">Edit Data</li>'
            ];
            $x = $this->penduduk->getPenduduk($surat->id_penduduk);
            $data = [
                'title' => 'Edit ' . $surat->tambahan,
                'ket' => $ket,
                'link' => 'sku',
                'surat' => $surat,
                'label' => 'Jenis Usaha',
                'keluarga' => $this->keluarga->getKeluarga(),
                'ttd' => $this->perangkat->ttd(),
                'kel' => $x,
                'penduduk' => $this->penduduk->id_array($surat->id_keluarga, 'id_keluarga'),
                'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
                'isi' => $this->user->getUser(session()->id)
            ];
            return view('surat/edit', $data);
        } else {
            session()->setFlashdata('warning_surat', 'Surat tanggal : ' . $surat->tambahan . ' Tidak Ditemukan.');
            return redirect()->to('sku/index');
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id_surat = $request->getPost('id_surat');
        $max = $this->model->no('SKU');
        $data = array(
            'no_surat' => $max->x + 1,
            'id_penduduk' => $request->getPost('id_penduduk'),
            'id_pemerintahan' => $request->getPost('ttd'),
            'tgl_surat' => date('Y-m-d'),
            'jenis' => 'SKU',
            'tujuan' => $request->getPost('tujuan'),
            'tambahan' => $request->getPost('ket'),
        );
        $this->model->editSurat($data, $id_surat);
        session()->setFlashdata('pesan_surat', 'Data Surat Keterangan Usaha Berhasi Diedit.');
        return redirect()->to('sku/index');
    }

    public function delete($id_surat)
    {
        $surat = $this->model->getSurat($id_surat, 'SKU');
        if (isset($surat)) {
            $this->model->hapusSurat($id_surat);
            session()->setFlashdata('pesan_surat', 'Data Surat Keterangan Usaha : ' . $surat->tambahan . ' Berhasi Dihapus.');
            return redirect()->to('sku/index');
        } else {
            session()->setFlashdata('warning_surat', 'Data Surat Keterangan Usaha : ' . $surat->tambahan . ' Tidak Ditemukan.');
            return redirect()->to('sku/index');
        }
    }

    public function hapusbanyak()
    {
        $request = \Config\Services::request();
        $id_surat = $request->getPost('id_surat');
        if ($id_surat == null) {
            session()->setFlashdata('warning', 'Data Pejabat dan berita Desa Belum Dipilih, Silahkan Pilih Data Terlebih Dahulu.');
            $data['title'] = 'Data Surat Keterangan Usaha dan Pejabat Desa';
            return redirect()->to('sku/index');
        }

        $jmldata = count($id_surat);
        $x = 0;
        for ($i = 0; $i < $jmldata; $i++) {
            $this->model->hapusSurat($id_surat[$i]);
            $x++;
        }

        session()->setFlashdata('pesan', 'Data Pejabat dan berita Desa Berhasi Dihapus Sebanyak ' . $x . ' Data.');
        $data['title'] = 'Data Surat Keterangan Usaha dan Pejabat Desa';
        return redirect()->to('sku/index');
    }
}
