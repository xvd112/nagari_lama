<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KeluargaModel;
use App\Models\IsiModel;
use App\Models\PendudukModel;
use App\Models\PerangkatModel;
use App\Models\AuthModel;

class Lahir extends Controller
{
    protected $model, $isi, $keluarga, $data;
    public function __construct()
    {
        helper('form');
        $this->keluarga =  new KeluargaModel();
        $this->isi =  new IsiModel();
        $this->model =  new PendudukModel();
        $this->perangkat =  new PerangkatModel();
        $this->user =  new AuthModel();
    }

    public function index()
    {
        $ket = [
            'Data Kelahiran', '<li class="breadcrumb-item active"><a href="/lahir/index">Data Kelahiran</a></li>'
        ];
        $data = [
            'title' => 'Data Kelahiran',
            'ket' => $ket,
            'penduduk' => $this->model->lahir(),
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('lahir/index', $data);
    }

    public function input()
    {
        $ket = [
            'Tambah Data Kelahiran',
            '<li class="breadcrumb-item active"><a href="/lahir/index">Data Kelahiran</a></li>',
            '<li class="breadcrumb-item active">Tambah Data</li>'
        ];
        $data = [
            'title' => 'Tambah Data Kelahiran',
            'ket' => $ket,
            'no_kk' => $this->keluarga->getKeluarga(),
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('lahir/input', $data);
    }

    public function view($id_penduduk)
    {
        $lahir = $this->model->lahir($id_penduduk);
        $ket = [
            'View Data Kelahiran : ' . $lahir->nik, '<li class="breadcrumb-item active"><a href="/lahir/index">Data Kelahiran</a></li>',
            '<li class="breadcrumb-item active">View Data</li>'
        ];

        $data = [
            'title' => 'View Data Kelahiran : ' . $lahir->nik,
            'ket' => $ket,
            'penduduk' => $lahir,
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('lahir/view', $data);
    }

    public function add()
    {
        $request = \Config\Services::request();
        $data = array(
            'id_keluarga' => $request->getPost('id_keluarga'),
            'nama' => $request->getPost('nama'),
            'tpt_lahir' => $request->getPost('tpt_lahir'),
            'tgl_lahir' => $request->getPost('tgl_lahir'),
            'jekel' => $request->getPost('jekel'),
            'kerja' => 'Belum/Tidak Bekerja',
            'kwn' => 'WNI',
            'status_kawin' => 'Belum Kawin',
            'status_hub' => 'Anak',
            'pendidikan' => 'Tidak/Belum Sekolah',
            'nm_ayah' => $request->getPost('nm_ayah'),
            'nik_ayah' => $request->getPost('nik_ayah'),
            'nm_ibu' => $request->getPost('nm_ibu'),
            'nik_ibu' => $request->getPost('nik_ibu'),
            'ket' => 'Hidup',
            'tgl_update'  =>  date('Y-m-d')
        );
        $this->model->savePenduduk($data);
        session()->setFlashdata('pesan_lahir', 'Data kelahiran berhasil ditambahkan.');
        return redirect()->to('/lahir/index');
    }

    public function ortu($id_keluarga)
    {
        $data = $this->model->id_array($id_keluarga, 'id_keluarga');
        $json = array();
        foreach ($data as $kk) {
            if ($kk['status_hub'] == 'Kepala Keluarga' or $kk['status_hub'] == 'Suami') {
                $json['nm_ayah'] = $kk['nama'];
                $json['nik_ayah'] = $kk['nik'];
            } elseif ($kk['status_hub'] == 'Istri') {
                $json['nm_ibu'] = $kk['nama'];
                $json['nik_ibu'] = $kk['nik'];
            }
        }
        return $this->response->setJson($json);
    }

    public function edit($id_penduduk)
    {
        $lahir = $this->model->lahir($id_penduduk);
        if (isset($lahir)) {
            $ket = [
                'Edit Data : ' . $lahir->no_kk,
                '<li class="breadcrumb-item active"><a href="/lahir/index">Data Kelahiran</a></li>',
                '<li class="breadcrumb-item active">Edit Data</li>'
            ];
            $data = [
                'title' => 'Edit Data : ' . $lahir->no_kk,
                'ket' => $ket,
                'penduduk' => $lahir,
                'no_kk' => $this->keluarga->getKeluarga(),
                'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
                'isi' => $this->user->getUser(session()->id)
            ];
            return view('lahir/edit', $data);
        } else {
            session()->setFlashdata('warning_lahir', 'No KK ' . $lahir->no_kk . ' Tidak Ditemukan.');
            return redirect()->to('/lahir/index');
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id_penduduk = $request->getPost('id_penduduk');
        $data = array(
            'id_keluarga' => $request->getPost('id_keluarga'),
            'nama' => $request->getPost('nama'),
            'tpt_lahir' => $request->getPost('tpt_lahir'),
            'tgl_lahir' => $request->getPost('tgl_lahir'),
            'jekel' => $request->getPost('jekel'),
            'kerja' => 'Belum/Tidak Bekerja',
            'kwn' => 'WNI',
            'status_kawin' => 'Belum Kawin',
            'status_hub' => 'Anak',
            'pendidikan' => 'Tidak/Belum Sekolah',
            'nm_ayah' => $request->getPost('nm_ayah'),
            'nik_ayah' => $request->getPost('nik_ayah'),
            'nm_ibu' => $request->getPost('nm_ibu'),
            'nik_ibu' => $request->getPost('nik_ibu'),
            'ket' => 'Hidup',
            'tgl_update'  =>  date('Y-m-d')
        );
        $this->model->editPenduduk($data, $id_penduduk);
        session()->setFlashdata('pesan_lahir', 'Data Kelahiran Berhasi Diedit.');
        return redirect()->to('lahir/index');
    }

    public function delete($id_penduduk)
    {
        $lahir = $this->model->lahir($id_penduduk);
        if (isset($lahir)) {
            if ($lahir->status_hub != 'Kepala Keluarga') {
                $this->model->hapusPenduduk($id_penduduk);
                session()->setFlashdata('danger_lahir', 'Data Kelahiran ' . $id_penduduk . ' berhasi dihapus.');
                return redirect()->to('/lahir/index');
            } else {
                session()->setFlashdata('warning_lahir', 'Data Kelahiran tidak bisa dihapus karena kepala keluarga.');
                return redirect()->to('/lahir/index');
            }
        } else {

            session()->setFlashdata('warning_lahir', 'Data Kelahiran ' . $id_penduduk . ' Tidak Ditemukan.');
            return redirect()->to('/lahir/index');
        }
    }
}
