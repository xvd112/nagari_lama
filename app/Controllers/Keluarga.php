<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KeluargaModel;
use App\Models\IsiModel;
use App\Models\PendudukModel;
use App\Models\DataModel;
use App\Models\AuthModel;
use App\Models\AlamatModel;
use App\Models\PerangkatModel;

class Keluarga extends Controller
{
    public function __construct()
    {
        helper('form');
        $this->model =  new KeluargaModel();
        $this->isi =  new IsiModel();
        $this->penduduk =  new PendudukModel();
        $this->data =  new DataModel();
        $this->user =  new AuthModel();
        $this->alm =  new AlamatModel();
        $this->perangkat =  new PerangkatModel();
    }

    public function index()
    {
        $kel = $this->model->getKeluarga();
        $x = $kel;
        for ($i = 0; $i < count($kel); $i++) {
            $x[$i]['id_keluarga'] = $kel[$i]['id_keluarga'];
            $x[$i]['no_kk'] = $kel[$i]['no_kk'];
            $x[$i]['nik_kepala'] = $kel[$i]['nik_kepala'];
            $p = $this->penduduk->id($kel[$i]['nik_kepala'], 'nik');
            if ($p != NULL) {
                $x[$i]['nama'] = $p->nama;
            } else {
                $x[$i]['nama'] = NULL;
            }
        }

        $ket = [
            'Data Keluarga', '<li class="breadcrumb-item active"><a href="/keluarga/index">Data Keluarga</a></li>'
        ];
        $data = [
            'title' => 'Data Keluarga',
            'ket' => $ket,
            'keluarga' => $x,
            'link' => 'home',
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('keluarga/index', $data);
    }

    public function input()
    {
        $ket = [
            'Tambah Data Keluarga',
            '<li class="breadcrumb-item active"><a href="/keluarga/index">Data Keluarga</a></li>',
            '<li class="breadcrumb-item active">Tambah Data</li>'
        ];
        $data = [
            'title' => 'Tambah Data Keluarga',
            'ket' => $ket,
            'agama' => $this->isi->getIsi(false, 'agama'),
            'pendidikan' => $this->isi->getIsi(false, 'pendidikan'),
            'pekerjaan' => $this->isi->getIsi(false, 'pekerjaan'),
            'status_kawin' => $this->isi->getIsi(false, 'status_kawin'),
            'link' => 'home',
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('keluarga/input', $data);
    }

    public function view($id_keluarga)
    {
        $getKeluarga = $this->model->getKeluarga($id_keluarga);
        $ket = [
            'View Data Keluaga : ' . $getKeluarga->no_kk, '<li class="breadcrumb-item active"><a href="/keluarga/index">Data Keluarga</a></li>',
            '<li class="breadcrumb-item active">View Data</li>'
        ];

        $isi = $this->isi->getIsi(false, 'status_hub');
        $x = 0;
        for ($i = 0; $i < count($isi); $i++) {
            if ($this->penduduk->id_array($isi[$i]['nama'], 'status_hub') != NULL) {
                $p = $this->penduduk->id_array($getKeluarga->id_keluarga, 'id_keluarga');
                $anggota = $p;
                $x++;
            } else {
                continue;
            }
        }

        $data = [
            'title' => 'View Data Keluaga : ' . $getKeluarga->no_kk,
            'ket' => $ket,
            'jml' => $this->penduduk->jml($getKeluarga->id_keluarga, 'id_keluarga'),
            'keluarga' => $getKeluarga,
            'penduduk' => $this->penduduk->id($getKeluarga->nik_kepala, 'nik'),
            'data' => $this->data->getData(),
            'anggota' => $anggota,
            'link' => 'home',
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id),
            'alm' => $this->alm->getAlamat(),
        ];
        return view('keluarga/view', $data);
    }

    public function add()
    {
        $request = \Config\Services::request();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'no_kk' => [
                'label' => 'no_kk',
                'rules' => 'is_unique[keluarga.no_kk]|required|numeric',
                'errors' => [
                    'is_unique' => 'No Kartu Keluarga sudah terdaftar',
                    'required' => 'No Kartu Keluarga harus diisi',
                    'numeric' => 'No Kartu Keluarga harus angka'
                ]
            ],
            'nik' => [
                'label' => 'nik_kepala',
                'rules' => 'is_unique[keluarga.nik_kepala]|required|numeric',
                'errors' => [
                    'is_unique' => 'NIK sudah terdaftar',
                    'required' => 'NIK harus diisi',
                    'numeric' => 'NIK harus angka'
                ]
            ],
        ]);
        if (!$validation->withRequest($request)->run()) {
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to('/keluarga/input');
        }

        $data = array(
            'no_kk' => $request->getPost('no_kk'),
            'nik_kepala' => $request->getPost('nik'),
            'alamat' => $request->getPost('alamat'),
            'tgl_update'  =>  date('Y-m-d')
        );
        $this->model->saveKeluarga($data);

        $id = $this->model->id($request->getPost('no_kk'), 'no_kk');

        $datakepala = array(
            'id_keluarga' => $id->id_keluarga,
            'nik' => $request->getPost('nik'),
            'nama' => $request->getPost('nama'),
            'tpt_lahir' => $request->getPost('tpt_lahir'),
            'tgl_lahir' => $request->getPost('tgl_lahir'),
            'jekel' => $request->getPost('jekel'),
            'agama' => $request->getPost('agama'),
            'kerja' => $request->getPost('kerja'),
            'kwn' => $request->getPost('kwn'),
            'goldar' => $request->getPost('goldar'),
            'ket_tinggal' => 'Permanen',
            'status_kawin' => $request->getPost('status_kawin'),
            'status_kk' => $request->getPost('status_kk'),
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
        $this->penduduk->savePenduduk($datakepala);

        return redirect()->to(base_url() . '/keluarga/index');
    }


    public function edit($id_keluarga)
    {
        $getKeluarga = $this->model->getKeluarga($id_keluarga);
        if (isset($getKeluarga)) {
            $ket = [
                'Edit Data : ' . $getKeluarga->no_kk,
                '<li class="breadcrumb-item active"><a href="/keluarga/index">Data Keluarga</a></li>',
                '<li class="breadcrumb-item active">Edit Data</li>'
            ];
            $data = [
                'title' => 'Edit Data : ' . $getKeluarga->no_kk,
                'ket' => $ket,
                'keluarga' => $getKeluarga,
                'penduduk' => $this->penduduk->id($getKeluarga->nik_kepala, 'nik'),
                'agama' => $this->isi->getIsi(false, 'agama'),
                'pendidikan' => $this->isi->getIsi(false, 'pendidikan'),
                'pekerjaan' => $this->isi->getIsi(false, 'pekerjaan'),
                'status_kawin' => $this->isi->getIsi(false, 'status_kawin'),
                'link' => 'home',
                'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
                'isi' => $this->user->getUser(session()->id)
            ];
            return view('keluarga/edit', $data);
        } else {
            session()->setFlashdata('warning_keluarga', 'No KK ' . $getKeluarga->no_kk . ' Tidak Ditemukan.');
            return redirect()->to(base_url() . '/keluarga/index');
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $id_keluarga = $request->getPost('id_keluarga');

        $m = $this->model->getKeluarga($id_keluarga);
        if ($request->getPost('no_kk') != $m->no_kk) {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'no_kk' => [
                    'label' => 'no_kk',
                    'rules' => 'is_unique[keluarga.no_kk]|required|numeric',
                    'errors' => [
                        'is_unique' => 'No Kartu Keluarga sudah terdaftar',
                        'required' => 'No Kartu Keluarga harus diisi',
                        'numeric' => 'No Kartu Keluarga harus angka'
                    ]
                ],
            ]);
            if (!$validation->withRequest($request)->run()) {

                session()->setFlashdata('error', $validation->listErrors());

                return redirect()->to('/keluarga/edit/' . $id_keluarga);
            }
        }
        if ($request->getPost('nik') != $m->nik_kepala) {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'nik' => [
                    'label' => 'nik_kepala',
                    'rules' => 'is_unique[keluarga.nik_kepala]|required|numeric',
                    'errors' => [
                        'is_unique' => 'NIK sudah terdaftar',
                        'required' => 'NIK harus diisi',
                        'numeric' => 'NIK harus angka'
                    ]
                ],
            ]);
            if (!$validation->withRequest($request)->run()) {

                session()->setFlashdata('error', $validation->listErrors());

                return redirect()->to('/keluarga/edit/' . $id_keluarga);
            }
        }

        $data = array(
            'no_kk' => $request->getPost('no_kk'),
            'nik_kepala' => $request->getPost('nik'),
            'alamat' => $request->getPost('alamat')
        );
        $this->model->editKeluarga($data, $id_keluarga);

        $id = $this->penduduk->id($request->getPost('nik'), 'nik');

        $datakepala = array(
            'id_keluarga' => $id_keluarga,
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
        $this->penduduk->editPenduduk($datakepala, $id->id_penduduk);
        session()->setFlashdata('pesan_keluarga', 'Data Keluarga Berhasi Diedit.');
        return redirect()->to(base_url() . '/keluarga/index');
    }


    public function delete($id_keluarga)
    {
        $getKeluarga = $this->model->getKeluarga($id_keluarga);
        if (isset($getKeluarga)) {
            $m = $this->penduduk->id($id_keluarga, 'id_keluarga');

            $n = $this->penduduk->jml($id_keluarga, 'id_keluarga');
            if ($m == NULL or $n->x == 1) {
                $id = $this->penduduk->id($getKeluarga->nik_kepala, 'nik');
                $data = $this->penduduk->getPenduduk($id->id_penduduk);

                $this->penduduk->hapusPenduduk($data->id_penduduk);
                $this->model->hapusKeluarga($id_keluarga);
                session()->setFlashdata('danger_keluarga', 'Data keluarga ' . $id_keluarga . ' berhasi dihapus.');
                return redirect()->to(base_url() . '/keluarga/index');
            } else {
                session()->setFlashdata('warning_keluarga', 'Data keluarga tidak bisa dihapus karena data dipakai pada tabel penduduk.');
                return redirect()->to(base_url() . '/keluarga/index');
            }
        } else {

            session()->setFlashdata('warning_keluarga', 'Data Keluarga ' . $id_keluarga . ' Tidak Ditemukan.');
            return redirect()->to(base_url() . '/keluarga/index');
        }
    }

    public function hapusbanyak()
    {
        $request = \Config\Services::request();
        $nokk = $request->getPost('id_keluarga');
        if ($nokk == null) {
            session()->setFlashdata('warning_keluarga', 'Data Keluarga Belum Dipilih, Silahkan Pilih Data Terlebih Dahulu.');
            return redirect()->to('index');
        }

        $jmldata = count($nokk);
        $x = 0;
        $y = 0;
        for ($i = 0; $i < $jmldata; $i++) {
            $getKeluarga = $this->model->getKeluarga($nokk[$i]);

            $m = $this->penduduk->id($nokk[$i], 'id_keluarga');


            $n = $this->penduduk->jml($nokk[$i], 'id_keluarga');
            if ($m == NULL or $n->x == 1) {
                $id = $this->penduduk->id($getKeluarga->nik_kepala, 'nik');
                $data = $this->penduduk->getPenduduk($id->id_penduduk);

                $this->penduduk->hapusPenduduk($data->id_penduduk);
                $this->model->hapusKeluarga($nokk[$i]);;
                $x++;
            } else {
                $y++;
            }
        }

        if ($x != 0 and $y == 0) {
            session()->setFlashdata('pesan_keluarga',  $x . ' Data berhasi dihapus.');
            return redirect()->to(base_url() . '/keluarga/index');
        } elseif ($x == 0 and $y != 0) {
            session()->setFlashdata('warning_keluarga',  $y . ' Data tidak bisa dihapus karena ada keluarga.');
            return redirect()->to(base_url() . '/keluarga/index');
        } elseif ($x != 0 and $y != 0) {
            session()->setFlashdata('warning_keluarga',  $x . ' Data berhasi dihapus dan ' . $y . ' data tidak bisa dihapus karena ada kepala keluarga.');
            return redirect()->to(base_url() . '/keluarga/index');
        } else {
            session()->setFlashdata('warning_keluarga', 'Data tidak bisa dihapus karena ada keluarga.');
            return redirect()->to(base_url() . '/keluarga/index');
        }
    }


    public function import()
    {
        $ket = [
            'Import Data Keluarga', '<li class="breadcrumb-item active"><a href="/keluarga/index">Data Keluarga</a></li>',
            '<li class="breadcrumb-item active">Import Data</li>'
        ];
        $data = [
            'title' => 'Import Data Penduduk',
            'ket' => $ket,
            'link' => 'home',
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('keluarga/import', $data);
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
            session()->setFlashdata('warning_keluarga', 'Ekstensi File Salah, Silahkan Pilih File Ber-ekstensi Excel.');
            return redirect()->to('bprn/import');
        }
        $spreadsheet = $render->load($file);
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        foreach ($sheet as $x => $excel) {
            if ($x == 0) {
                continue;
            }

            $nokk = $this->model->cek($excel[1], $excel[2]);

            if ($nokk != NULL) {
                if ($excel[1] == $nokk['no_kk'] or $excel[2] == $nokk['nik_kepala']) {
                    continue;
                }
            }

            if ($excel[6] == 'L' or $excel[6] == 'LAKI-LAKI') {
                $excel[6] = 'Laki - Laki';
            } elseif ($excel[6] == 'P' or $excel[6] == 'PEREMPUAN') {
                $excel[6] = 'Perempuan';
            }

            if ($excel[2] == '-' or $excel[2] == '0000000000000000') {
                $nik = '';
            } else {
                $nik = $excel[2];
            }

            $data = array(
                'no_kk' => $excel[1],
                'nik_kepala' => $nik,
                'alamat' => $excel[8],
                'tgl_update'  =>  date('Y-m-d')
            );
            $this->model->saveKeluarga($data);

            $id = $this->model->id($excel[1], 'no_kk');

            $datakepala = array(
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
                'status_hub' => 'Kepala Keluarga',
                'pendidikan' => $excel[13],
                'nm_ayah' => $excel[14],
                'nik_ayah' => $excel[15],
                'nm_ibu' => $excel[16],
                'nik_ibu' => $excel[17],
                'paspor' => $excel[18],
                'kitap' => $excel[19],
                'ket' => 'Hidup',
                'tgl_update'  =>  date('Y-m-d')
            );
            $this->penduduk->savePenduduk($datakepala);
        }

        session()->setFlashdata('pesan_keluarga', 'Data Badan Permusyawaratan Rakyat Nagari (BPRN) Berhasi Diimport.');
        return redirect()->to('/keluarga');
    }
}
