<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\DataModel;
use App\Models\AlamatModel;
use App\Models\PendudukModel;
use App\Models\AuthModel;
use App\Models\PerangkatModel;


class Data extends Controller
{
    protected $model;
    public function __construct()
    {
        helper('form');
        // Deklarasi model
        $this->model =  new DataModel();
        $this->alm =  new AlamatModel();
        $this->penduduk =  new PendudukModel();
        $this->user =  new AuthModel();
        $this->perangkat =  new PerangkatModel();
    }

    // Menampilkan Alamat
    public function index()
    {
        $ket = [
            'Alamat', '<li class="breadcrumb-item active"><a href="/data/index">Alamat</a></li>'
        ];
        $data = [
            'title' => 'Alamat',
            'ket' => $ket,
            'data' => $this->alm->getAlamat(),
            'link' => 'home',
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('alamat/index', $data);
    }

    // Menampilkan form edit data
    public function edit()
    {
        $data = $this->alm->getAlamat();
        if (isset($data)) {
            $ket = [
                'Edit Alamat', '<li class="breadcrumb-item active"><a href="/data/index">Alamat</a></li>',
                '<li class="breadcrumb-item active">Edit Data</li>'
            ];
            $data = [
                'title' => 'Edit Alamat',
                'ket' => $ket,
                'link' => 'home',
                'data' => $data,
                'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
                'isi' => $this->user->getUser(session()->id)
            ];
            return view('alamat/edit', $data);
        } else {
            session()->setFlashdata('warning_data', 'data Tidak Ditemukan.');
            return redirect()->to(base_url() . '/data/index');
        }
    }

    // Edit Data
    public function update()
    {
        $request = \Config\Services::request();

        $data = array(
            'kec' => $request->getPost('kec'),
            'nagari' => $request->getPost('nagari'),
            'kab' => $request->getPost('kab'),
            'prov' => $request->getPost('prov'),
            'alm' => $request->getPost('alm'),
            'map_wilayah' => $request->getPost('map_wilayah'),
            'map_kantor' => $request->getPost('map_kantor'),
            'kd_pos' => $request->getPost('kd_pos')
        );
        $this->alm->editAlamat($data);
        session()->setFlashData('pesan_data', 'Alamat Berhasi Diedit.');
        return redirect()->to(base_url() . '/data/index');
    }

    public function info()
    {
        $ket = [
            'Info', '<li class="breadcrumb-item active"><a href="/data/info">Info</a></li>'
        ];
        $data = [
            'title' => 'Info',
            'ket' => $ket,
            'link' => 'home',
            'data' => $this->model->getData(),
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id),
            'tambah' => $this->alm->getAlamat(),
        ];
        return view('info/index', $data);
    }

    public function editinfo()
    {
        $data = $this->model->getData();
        if (isset($data)) {
            $ket = [
                'Edit Info', '<li class="breadcrumb-item active"><a href="/data/info">Info</a></li>',
                '<li class="breadcrumb-item active">Edit Data</li>'
            ];
            $data = [
                'title' => 'Edit Info',
                'ket' => $ket,
                'link' => 'home',
                'data' => $data,
                'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
                'isi' => $this->user->getUser(session()->id),
                'tambah' => $this->alm->getAlamat(),
            ];
            return view('info/edit', $data);
        } else {
            session()->setFlashdata('warning_data', 'data Tidak Ditemukan.');
            return redirect()->to(base_url() . '/data/info');
        }
    }

    // Edit Data
    public function updateinfo()
    {
        $request = \Config\Services::request();

        $data = array(
            'visi' => $request->getPost('visi'),
            'misi' => $request->getPost('misi'),
            'sejarah' => $request->getPost('sejarah'),
            'wilayah' => $request->getPost('wilayah'),
            'kata_sambutan' => $request->getPost('kata_sambutan'),
            'syarat_surat' => $request->getPost('surat'),
        );
        $this->model->editData($data);
        $data2 = array(
            'telp' => $request->getPost('telp'),
            'email' => $request->getPost('email')
        );
        $this->alm->editAlamat($data2);
        session()->setFlashData('pesan_data', 'Info Berhasi Diedit.');
        return redirect()->to(base_url() . '/data/info');
    }
}
