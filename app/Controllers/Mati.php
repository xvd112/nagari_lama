<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KeluargaModel;
use App\Models\KematianModel;
use App\Models\PendudukModel;
use App\Models\PerangkatModel;
use App\Models\AuthModel;

class Mati extends Controller
{
    protected $model, $id_kematian, $keluarga;
    public function __construct()
    {
        helper('form');

        $this->keluarga =  new KeluargaModel();
        $this->penduduk =  new PendudukModel();
        $this->model =  new KematianModel();
        $this->perangkat =  new PerangkatModel();
        $this->user =  new AuthModel();
    }


    public function index()
    {
        $ket = [
            'Data Kematian', '<li class="breadcrumb-item active"><a href="/mati/index">Data Kematian</a></li>'
        ];
        $data = [
            'title' => 'Data Kematian',
            'ket' => $ket,
            'kematian' => $this->model->getKematian(),
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('mati/index', $data);
    }


    public function input()
    {
        $ket = [
            'Tambah Data Kematian',
            '<li class="breadcrumb-item active"><a href="/mati/index">Data Kematian</a></li>',
            '<li class="breadcrumb-item active">Tambah Data</li>'
        ];
        $data = [
            'title' => 'Tambah Data Kematian',
            'ket' => $ket,
            'keluarga' => $this->keluarga->getKeluarga(),
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('mati/input', $data);
    }

    public function getnik($id_keluarga)
    {
        $data = $this->penduduk->mati($id_keluarga, 'id_keluarga', 'Hidup');
        for ($i = 0; $i < count($data); $i++) {
            $json[$i]['nik'] = $data[$i]['nik'];
            $json[$i]['id_penduduk'] = $data[$i]['id_penduduk'];
            $json[$i]['nama'] = $data[$i]['nama'];
        }
        return $this->response->setJson($json);
    }

    public function nama($id_penduduk)
    {
        $data = $this->penduduk->id($id_penduduk, 'id_penduduk');
        $json = array();
        $json['nama'] = $data->nama;
        return $this->response->setJson($json);
    }


    public function view($id_kematian)
    {
        $kematian = $this->model->getKematian($id_kematian);
        $ket = [
            'View Data Kematian : ' . $kematian->nik, '<li class="breadcrumb-item active"><a href="/mati/index">Data Kematian</a></li>',
            '<li class="breadcrumb-item active">View Data</li>'
        ];

        $data = [
            'title' => 'View Data Kematian : ' . $kematian->nik,
            'ket' => $ket,
            'mati' => $kematian,
            'umur' => $this->penduduk->umur($kematian->id_penduduk)[0]['x'],
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('mati/view', $data);
    }

    public function add()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_penduduk' => [
                'label' => 'id_penduduk',
                'rules' => 'is_unique[kematian.id_penduduk]|required|numeric',
                'errors' => [
                    'is_unique' => 'NIK sudah terdaftar',
                    'required' => 'NIK harus diisi',
                    'numeric' => 'NIK harus angka'
                ]
            ],
        ]);
        if (!$validation->withRequest($request)->run()) {
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to('/mati/input');
        }
        $data = array(
            'id_penduduk' => $request->getPost('id_penduduk'),
            'tpt_kematian' => $request->getPost('tpt_kematian'),
            'tgl_kematian' => $request->getPost('tgl_kematian'),
            'sebab' => $request->getPost('sebab'),
            'tgl_update'  =>  date('Y-m-d')
        );
        $this->model->saveKematian($data);

        $ubah = [
            'ket' => 'Wafat'
        ];
        $this->penduduk->editPenduduk($ubah, $request->getPost('id_penduduk'));

        return redirect()->to('/mati/index');
    }


    public function edit($id_kematian)
    {
        $getkematian = $this->model->getKematian($id_kematian);
        if (isset($getkematian)) {
            $ket = [
                'Edit Data : ' . $getkematian->nik,
                '<li class="breadcrumb-item active"><a href="/mati/index">Data Kematian</a></li>',
                '<li class="breadcrumb-item active">Edit Data</li>'
            ];
            $data = [
                'title' => 'Edit Data : ' . $getkematian->nik,
                'ket' => $ket,
                'mati' => $getkematian,
                'penduduk' => $this->penduduk->id_array($getkematian->id_keluarga, 'id_keluarga'),
                'keluarga' => $this->keluarga->getKeluarga(),
                'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
                'isi' => $this->user->getUser(session()->id)
            ];
            return view('mati/edit', $data);
        } else {
            session()->setFlashdata('warning_kematian', 'No KK ' . $getkematian->nik . ' Tidak Ditemukan.');
            return redirect()->to('/mati/index');
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id_kematian = $request->getPost('id_kematian');

        $m = $this->model->getKematian($id_kematian);
        if ($id_kematian != $m->id_kematian) {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'id_penduduk' => [
                    'label' => 'id_penduduk',
                    'rules' => 'is_unique[kematian.id_penduduk]|required|numeric',
                    'errors' => [
                        'is_unique' => 'NIK sudah terdaftar',
                        'required' => 'NIK harus diisi',
                        'numeric' => 'NIK harus angka'
                    ]
                ],
            ]);
            if (!$validation->withRequest($request)->run()) {

                session()->setFlashdata('error', $validation->listErrors());

                return redirect()->to('/mati/edit/' . $id_kematian);
            }
        }

        $data = array(
            'id_penduduk' => $request->getPost('id_penduduk'),
            'tpt_kematian' => $request->getPost('tpt_kematian'),
            'tgl_kematian' => $request->getPost('tgl_kematian'),
            'sebab' => $request->getPost('sebab'),
            'tgl_update'  =>  date('Y-m-d')
        );
        $this->model->editKematian($data, $id_kematian);

        $ubah = [
            'ket' => 'Wafat'
        ];
        $this->penduduk->editPenduduk($ubah, $request->getPost('id_penduduk'));

        $ubah2 = [
            'ket' => 'Hidup'
        ];
        $this->penduduk->editPenduduk($ubah2, $request->getPost('lama'));

        session()->setFlashdata('pesan_kematian', 'Data Kematian Berhasi Diedit.');
        return redirect()->to('mati/index');
    }


    public function delete($id_kematian)
    {
        $kematian = $this->model->getKematian($id_kematian);
        if (isset($kematian)) {
            $this->model->hapusKematian($id_kematian);
            $ubah = [
                'ket' => 'Hidup'
            ];
            $this->penduduk->editPenduduk($ubah, $kematian->id_penduduk);
            session()->setFlashdata('danger_kematian', 'Data Kematian ' . $id_kematian . ' berhasi dihapus.');
            return redirect()->to('/mati/index');
        } else {
            session()->setFlashdata('warning_kematian', 'Data Kematian ' . $id_kematian . ' Tidak Ditemukan.');
            return redirect()->to('/mati/index');
        }
    }

    public function hapusbanyak()
    {
        $request = \Config\Services::request();
        $id_kematian = $request->getPost('id_kematian');
        if ($id_kematian == null) {
            session()->setFlashdata('warning_kematian', 'Data Kematian Belum Dipilih, Silahkan Pilih Data Terlebih Dahulu.');
            return redirect()->to('penduduk/index');
        }

        $jmldata = count($id_kematian);
        $x = 0;
        for ($i = 0; $i < $jmldata; $i++) {
            $n = $this->model->getKematian($id_kematian[$i]);
            $this->model->hapusKematian($id_kematian[$i]);
            $ubah = [
                'ket' => 'Hidup'
            ];
            $this->penduduk->editPenduduk($ubah, $id_kematian[$i]);
            $x++;
        }

        if ($x != 0) {
            session()->setFlashdata('pesan_kematian',  $x . ' Data berhasi dihapus.');
            return redirect()->to('/mati/index');
        } else {
            session()->setFlashdata('warning_kematian', 'Data Kematian tidak bisa dihapus karena kepala keluarga.');
            return redirect()->to('/mati/index');
        }
    }
}
