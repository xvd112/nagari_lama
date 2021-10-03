<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KeluargaModel;
use App\Models\IsiModel;
use App\Models\PendudukModel;
use App\Models\PerangkatModel;
use App\Models\AuthModel;
use App\Models\AlamatModel;
use App\Models\MohonModel;
use App\Models\AduanModel;
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

class Penduduk extends Controller
{
    protected $model, $isi, $keluarga, $data;
    public function __construct()
    {
        helper('form');
        $this->model =  new PendudukModel();
        $this->keluarga =  new KeluargaModel();
        $this->isi =  new IsiModel();
        $this->perangkat =  new PerangkatModel();
        $this->user =  new AuthModel();
        $this->alm =  new AlamatModel();
        $this->mohon =  new MohonModel();
        $this->aduan =  new AduanModel();
    }

    public function index()
    {
        $request = \Config\Services::request();
        $key = $request->getPost('key');
        if ($key) {
            $datapen = $this->model->join('keluarga', 'keluarga.id_keluarga = penduduk.id_keluarga')->search($key);
        } else {
            $datapen = $this->model->join('keluarga', 'keluarga.id_keluarga = penduduk.id_keluarga')->orderBy('id_penduduk', 'DESC');
        }
        $currentPage = $request->getVar('page_data') ? $request->getVar('page_data') : 1;

        $ket = [
            'Data Penduduk', '<li class="breadcrumb-item active"><a href="/penduduk/index">Data Penduduk</a></li>'
        ];
        $data = [
            'title' => 'Data Penduduk',
            'ket' => $ket,
            'penduduk' => $datapen->paginate(10, 'data'),
            'pager' => $this->model->pager,
            'currentPage' => $currentPage,
            'jml' => $this->model->countAllResults(),
            'link' => 'home',
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id),
        ];
        return view('penduduk/index', $data);
    }

    public function getdata($input)
    {
        $data = $this->model->search($input);
        for ($i = 0; $i < count($data); $i++) {
            $json[$i]['nik'] = $data[$i]['nik'];
            $json[$i]['nama'] = $data[$i]['nama'];
            $json[$i]['no_kk'] = $data[$i]['no_kk'];
        }
        return $this->response->setJson($json);
    }

    public function input()
    {
        $ket = [
            'Tambah Data Penduduk',
            '<li class="breadcrumb-item active"><a href="/penduduk/index">Data Penduduk</a></li>',
            '<li class="breadcrumb-item active">Tambah Data</li>'
        ];
        $data = [
            'title' => 'Tambah Data Penduduk',
            'ket' => $ket,
            'no_kk' => $this->keluarga->getKeluarga(),
            'agama' => $this->isi->getIsi(false, 'agama'),
            'pendidikan' => $this->isi->getIsi(false, 'pendidikan'),
            'pekerjaan' => $this->isi->getIsi(false, 'pekerjaan'),
            'status_kawin' => $this->isi->getIsi(false, 'status_kawin'),
            'status_hub' => $this->isi->getIsi(false, 'status_hub'),
            'link' => 'home',
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('penduduk/input', $data);
    }

    public function view($id_penduduk)
    {
        $getpenduduk = $this->model->getpenduduk($id_penduduk);
        $ket = [
            'View Data Penduduk : ' . $getpenduduk->nik, '<li class="breadcrumb-item active"><a href="/penduduk/index">Data Penduduk</a></li>',
            '<li class="breadcrumb-item active">View Data</li>'
        ];

        $data = [
            'title' => 'View Data Penduduk : ' . $getpenduduk->nik,
            'ket' => $ket,
            'penduduk' => $getpenduduk,
            'link' => 'home',
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id),
            'alm' => $this->alm->getAlamat(),
        ];
        return view('penduduk/view', $data);
    }

    public function laporan()
    {
        $ket = [
            'Laporan Data Penduduk', '<li class="breadcrumb-item active"><a href="/penduduk/index">Data Penduduk</a></li>',
            '<li class="breadcrumb-item active">Laporan Data Penduduk</li>'
        ];
        $data = [
            'title' => 'Laporan Data Penduduk',
            'ket' => $ket,
            'link' => 'home',
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('penduduk/laporan', $data);
    }

    public function print()
    {
        $request = \Config\Services::request();
        $tahun = $request->getPost('tahun');
        $bulan = $request->getPost('bulan');

        $data = array(
            'title' => 'View Surat',
            'p' => $this->model->tot('penduduk', $tahun, $bulan),
            'lk' => $this->model->totjekel('penduduk', 'Laki - Laki', $tahun, $bulan),
            'pr' => $this->model->totjekel('penduduk', 'Perempuan', $tahun, $bulan),
            'p_g' => $this->model->tot('penduduk', $tahun, $bulan, 'Jorong Gantiang'),
            'lk_g' => $this->model->totjekel('penduduk', 'Laki - Laki', $tahun, $bulan, 'Jorong Gantiang'),
            'pr_g' => $this->model->totjekel('penduduk', 'Perempuan', $tahun, $bulan, 'Jorong Gantiang'),
            'p_gru' => $this->model->tot('penduduk', $tahun, $bulan, 'Jorong Gunuang Rajo Utara'),
            'lk_gru' => $this->model->totjekel('penduduk', 'Laki - Laki', $tahun, $bulan, 'Jorong Gunuang Rajo Utara'),
            'pr_gru' => $this->model->totjekel('penduduk', 'Perempuan', $tahun, $bulan, 'Jorong Gunuang Rajo Utara'),
            'data' => $this->alm->getAlamat()
        );
        $html = view('penduduk/rekap', $data);
        $pdf = new pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->SetFont('times', '', 12);
        $pdf->setHeaderMargin(20);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        $pdf->SetMargins(20, 40, 20, true);
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $this->response->setContentType('application/pdf');
        $pdf->Output('penduduk.pdf', 'I');
    }

    public function viewnik($nik)
    {
        $id = $this->model->id($nik, 'nik');
        $getpenduduk = $this->model->getpenduduk($id->id_penduduk);
        $ket = [
            'View Data Penduduk : ' . $getpenduduk->nik, '<li class="breadcrumb-item active"><a href="/penduduk/index">Data Penduduk</a></li>',
            '<li class="breadcrumb-item active">View Data</li>'
        ];

        $data = [
            'title' => 'View Data Penduduk : ' . $getpenduduk->nik,
            'ket' => $ket,
            'penduduk' => $getpenduduk,
            'link' => 'home',
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id),
            'alm' => $this->alm->getAlamat(),
        ];
        return view('penduduk/view', $data);
    }

    public function add()
    {
        $request = \Config\Services::request();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nik' => [
                'label' => 'nik',
                'rules' => 'is_unique[penduduk.nik]|required|numeric',
                'errors' => [
                    'is_unique' => 'NIK sudah terdaftar',
                    'required' => 'NIK harus diisi',
                    'numeric' => 'NIK harus angka'
                ]
            ],
        ]);
        if (!$validation->withRequest($request)->run()) {
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to('/penduduk/input');
        }
        $data = array(
            'id_keluarga' => $request->getPost('id_keluarga'),
            'nik' => $request->getPost('nik'),
            'nama' => $request->getPost('nama'),
            'tpt_lahir' => $request->getPost('tpt_lahir'),
            'tgl_lahir' => $request->getPost('tgl_lahir'),
            'jekel' => $request->getPost('jekel'),
            'agama' => $request->getPost('agama'),
            'kerja' => $request->getPost('kerja'),
            'kwn' => $request->getPost('kwn'),
            'goldar' => $request->getPost('goldar'),
            'status_kawin' => $request->getPost('status_kawin'),
            'status_hub' => $request->getPost('status_hub'),
            'pendidikan' => $request->getPost('pendidikan'),
            'nm_ayah' => $request->getPost('nm_ayah'),
            'nik_ayah' => $request->getPost('nik_ayah'),
            'nm_ibu' => $request->getPost('nm_ibu'),
            'nik_ibu' => $request->getPost('nik_ibu'),
            'paspor' => $request->getPost('paspor'),
            'kitap' => $request->getPost('kitap'),
            'ket' => 'Hidup',
            'tgl_update'  =>  date('Y-m-d')
        );
        $this->model->savePenduduk($data);

        return redirect()->to('/penduduk/index');
    }

    public function edit($id_penduduk)
    {
        $getpenduduk = $this->model->getpenduduk($id_penduduk);
        if (isset($getpenduduk)) {
            $ket = [
                'Edit Data : ' . $getpenduduk->no_kk,
                '<li class="breadcrumb-item active"><a href="/penduduk/index">Data Penduduk</a></li>',
                '<li class="breadcrumb-item active">Edit Data</li>'
            ];
            $data = [
                'title' => 'Edit Data : ' . $getpenduduk->no_kk,
                'ket' => $ket,
                'penduduk' => $getpenduduk,
                'no_kk' => $this->keluarga->getKeluarga(),
                'agama' => $this->isi->getIsi(false, 'agama'),
                'pendidikan' => $this->isi->getIsi(false, 'pendidikan'),
                'pekerjaan' => $this->isi->getIsi(false, 'pekerjaan'),
                'status_kawin' => $this->isi->getIsi(false, 'status_kawin'),
                'status_hub' => $this->isi->getIsi(false, 'status_hub'),
                'link' => 'home',
                'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
                'isi' => $this->user->getUser(session()->id)
            ];
            return view('penduduk/edit', $data);
        } else {
            session()->setFlashdata('warning_penduduk', 'No KK ' . $getpenduduk->no_kk . ' Tidak Ditemukan.');
            return redirect()->to('/penduduk/index');
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $id_penduduk = $request->getPost('id_penduduk');

        $m = $this->model->getpenduduk($id_penduduk);
        if ($id_penduduk != $m->id_penduduk) {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'nik' => [
                    'label' => 'nik_kepala',
                    'rules' => 'is_unique[penduduk.nik_kepala]|required|numeric',
                    'errors' => [
                        'is_unique' => 'NIK sudah terdaftar',
                        'required' => 'NIK harus diisi',
                        'numeric' => 'NIK harus angka'
                    ]
                ],
            ]);
            if (!$validation->withRequest($request)->run()) {
                session()->setFlashdata('error', $validation->listErrors());
                return redirect()->to('/penduduk/edit/' . $id_penduduk);
            }
        }

        $data = array(
            'id_keluarga' => $request->getPost('id_keluarga'),
            'nik' => $request->getPost('nik'),
            'nama' => $request->getPost('nama'),
            'tpt_lahir' => $request->getPost('tpt_lahir'),
            'tgl_lahir' => $request->getPost('tgl_lahir'),
            'jekel' => $request->getPost('jekel'),
            'agama' => $request->getPost('agama'),
            'kerja' => $request->getPost('kerja'),
            'kwn' => $request->getPost('kwn'),
            'goldar' => $request->getPost('goldar'),
            'status_kawin' => $request->getPost('status_kawin'),
            'status_hub' => $request->getPost('status_hub'),
            'pendidikan' => $request->getPost('pendidikan'),
            'nm_ayah' => $request->getPost('nm_ayah'),
            'nik_ayah' => $request->getPost('nik_ayah'),
            'nm_ibu' => $request->getPost('nm_ibu'),
            'nik_ibu' => $request->getPost('nik_ibu'),
            'paspor' => $request->getPost('paspor'),
            'kitap' => $request->getPost('kitap'),
            'ket' => 'Hidup',
            'tgl_update'  =>  date('Y-m-d')
        );
        $this->model->editPenduduk($data, $id_penduduk);
        session()->setFlashdata('pesan_penduduk', 'Data Penduduk Berhasi Diedit.');
        return redirect()->to('penduduk/index');
    }

    public function delete($id_penduduk)
    {
        $getpenduduk = $this->model->getpenduduk($id_penduduk);
        if (isset($getpenduduk)) {
            if ($getpenduduk->status_hub != 'Kepala Keluarga') {
                $this->model->hapusPenduduk($id_penduduk);
                session()->setFlashdata('danger_penduduk', 'Data penduduk ' . $id_penduduk . ' berhasi dihapus.');
                return redirect()->to('/penduduk/index');
            } elseif ($getpenduduk->status_hub == 'Kepala Keluarga') {
                session()->setFlashdata('warning_penduduk', 'Data penduduk tidak bisa dihapus karena kepala keluarga.');
                return redirect()->to('/penduduk/index');
            }
        } else {

            session()->setFlashdata('warning_penduduk', 'Data Penduduk ' . $id_penduduk . ' Tidak Ditemukan.');
            return redirect()->to('/penduduk/index');
        }
    }

    public function hapusbanyak()
    {
        $request = \Config\Services::request();
        $id_penduduk = $request->getPost('id_penduduk');
        if ($id_penduduk == null) {
            session()->setFlashdata('warning_penduduk', 'Data Penduduk Belum Dipilih, Silahkan Pilih Data Terlebih Dahulu.');
            return redirect()->to('penduduk/index');
        }

        $jmldata = count($id_penduduk);
        $x = 0;
        $y = 0;
        for ($i = 0; $i < $jmldata; $i++) {
            $n = $this->model->getPenduduk($id_penduduk[$i]);
            if ($n->status_hub != 'Kepala Keluarga') {
                $this->model->hapusPenduduk($id_penduduk[$i]);
                $x++;
            } else {
                $y++;
            }
        }

        if ($x != 0 and $y == 0) {
            session()->setFlashdata('pesan_penduduk',  $x . ' Data berhasi dihapus.');
            return redirect()->to('/penduduk/index');
        } elseif ($x == 0 and $y != 0) {
            session()->setFlashdata('warning_penduduk',  $y . ' Data tidak bisa dihapus karena kepala keluarga.');
            return redirect()->to('/penduduk/index');
        } elseif ($x != 0 and $y != 0) {
            session()->setFlashdata('warning_penduduk',  $x . ' Data berhasi dihapus dan ' . $y . ' data tidak bisa dihapus karena kepala keluarga.');
            return redirect()->to('/penduduk/index');
        } else {
            session()->setFlashdata('warning_penduduk', 'Data Penduduk tidak bisa dihapus karena kepala keluarga.');
            return redirect()->to('/penduduk/index');
        }
    }

    public function import()
    {
        $ket = [
            'Import Data Penduduk', '<li class="breadcrumb-item active"><a href="/penduduk/index">Data Penduduk</a></li>',
            '<li class="breadcrumb-item active">Import Data</li>'
        ];
        $data = [
            'title' => 'Import Data Penduduk',
            'ket' => $ket,
            'link' => 'home',
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('penduduk/import', $data);
    }

    public function proses()
    {
        $request = \Config\Services::request();
        $file = $request->getFile('file_excel');
        $ext = $file->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } elseif ($ext == 'xlsx') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        } else {
            session()->setFlashdata('warning_penduduk', 'Ekstensi File Salah, Silahkan Pilih File Ber-ekstensi Excel.');
            return redirect()->to('bprn/import');
        }
        $spreadsheet = $render->load($file);
        $sheet = $spreadsheet->getActiveSheet()->toArray();
        foreach ($sheet as $x => $excel) {
            if ($x == 0) {
                continue;
            }

            $cek = $this->model->id($excel[2], 'nik');
            if ($cek != NULL) {
                if ($excel[2] == $cek->nik) {
                    continue;
                }
            }

            if ($excel[6] == 'L' or $excel[6] == 'LAKI-LAKI') {
                $excel[6] = 'Laki - Laki';
            } elseif ($excel[6] == 'P' or $excel[6] == 'PEREMPUAN') {
                $excel[6] = 'Perempuan';
            }

            if ($excel[13] == 'Kepala Keluarga') {
                $datakep = array(
                    'no_kk' => $excel[1],
                    'nik_kepala' => $excel[2],
                    'alamat' => $excel[8],
                    'tgl_update'  =>  date('Y-m-d')
                );
                $this->keluarga->saveKeluarga($datakep);
            }

            if ($excel[2] == '-' or $excel[2] == '0000000000000000') {
                $nik = '';
            } else {
                $nik = $excel[2];
            }

            $id = $this->keluarga->id($excel[1], 'no_kk');
            $data = array(
                'id_keluarga' => $id->id_keluarga,
                'nik' => $nik,
                'nama' => $excel[3],
                'tpt_lahir' => $excel[4],
                'tgl_lahir' => $excel[5],
                'jekel' => $excel[6],
                'agama' => $excel[7],
                'kerja' => $excel[9],
                'kwn' => $excel[10],
                'goldar' => $excel[11],
                'status_kawin' => $excel[12],
                'status_hub' => $excel[13],
                'pendidikan' => $excel[14],
                'nm_ayah' => $excel[15],
                'nik_ayah' => $excel[16],
                'nm_ibu' => $excel[17],
                'nik_ibu' => $excel[18],
                'paspor' => $excel[19],
                'kitap' => $excel[20],
                'ket' => 'Hidup',
                'tgl_update'  =>  date('Y-m-d')
            );
            $this->model->savePenduduk($data);
        }

        session()->setFlashdata('pesan_penduduk', 'Data Penduduk Berhasi Diimport.');
        return redirect()->to('/penduduk/index');
    }
}
