<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\GaleriModel;
use App\Models\AuthModel;
use App\Models\PerangkatModel;

class Galeri extends Controller
{
    protected $model;
    public function __construct()
    {
        helper('form');
        // Deklarasi model
        $this->model =  new GaleriModel();
        $this->user =  new AuthModel();
        $this->perangkat =  new PerangkatModel();
    }

    // Menampilkan list data Galeri
    public function index()
    {
        $ket = [
            'Data Galeri', '<li class="breadcrumb-item active"><a href="/galeri/index">Data Galeri</a></li>'
        ];
        $data = [
            'title' => 'Data Galeri',
            'ket' => $ket,
            'galeri' => $this->model->getGaleri(),
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('galeri/index', $data);
    }

    // View detail data
    public function view($id_galeri)
    {
        $data = $this->model->getGaleri($id_galeri);
        $ket = [
            'View Data Galeri', '<li class="breadcrumb-item active"><a href="/galeri/index">Data Galeri</a></li>',
            '<li class="breadcrumb-item active">View Data</li>'
        ];
        $data = [
            'title' => 'View Data Galeri',
            'ket' => $ket,
            'galeri' => $this->model->getGaleri($id_galeri),
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('galeri/view', $data);
    }

    // Menampilkan form input
    public function input()
    {
        $ket = [
            'Tambah Data Galeri',
            '<li class="breadcrumb-item active"><a href="/galeri/index">Data Galeri</a></li>',
            '<li class="breadcrumb-item active">Tambah Data</li>'
        ];
        $data = [
            'title' => 'Tambah Data Galeri',
            'ket' => $ket,
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('galeri/input', $data);
    }

    public function add()
    {
        $request = \Config\Services::request();

        $file = $request->getFile('foto');
        if ($file->getError() == 4) {
            $nm = "default.jpg";
        } else {
            $nm = $file->getRandomName();
            $file->move('aset/img', $nm);
        }

        $data = array(
            'jenis' => $request->getPost('jenis'),
            'foto' => $nm,
        );
        $this->model->saveGaleri($data);
        return redirect()->to(base_url() . '/galeri/index');
    }

    ///edit data
    public function edit($id_galeri)
    {
        $getGaleri = $this->model->getGaleri($id_galeri);
        if (isset($getGaleri)) {
            $ket = [
                'Edit ' . $getGaleri->jenis,
                '<li class="breadcrumb-item active"><a href="/galeri/index">Data Galeri</a></li>',
                '<li class="breadcrumb-item active">Edit Data</li>'
            ];
            $data = [
                'title' => 'Edit ' . $getGaleri->jenis,
                'ket' => $ket,
                'galeri' => $getGaleri,
                'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
                'isi' => $this->user->getUser(session()->id)
            ];
            return view('galeri/edit', $data);
        } else {
            session()->setFlashdata('warning_galeri', 'galeri dengan Nama : ' . $getGaleri->jenis . ' Tidak Ditemukan.');
            return redirect()->to(base_url() . '/galeri/index');
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id_galeri = $request->getPost('id_galeri');

        $file = $request->getFile('foto');
        if ($file->getError() == 4) {
            $nm = $request->getPost('lama');
        } else {
            $nm = $file->getRandomName();
            $file->move('aset/img', $nm);
            if ($request->getPost('lama') != 'default.jpg') {
                unlink('aset/img/' . $request->getPost('lama'));
            }
        }

        $data = array(
            'jenis' => $request->getPost('jenis'),
            'foto' => $nm,
        );
        $this->model->editGaleri($data, $id_galeri);
        session()->setFlashdata('pesan_galeri', 'Data Galeri Berhasi Diedit.');
        return redirect()->to(base_url() . '/galeri/index');
    }

    // Menghapus data
    public function delete($id_galeri)
    {
        $getGaleri = $this->model->getGaleri($id_galeri);
        if (isset($getGaleri)) {
            if ($id_galeri > 15) {
                $this->model->hapusGaleri($id_galeri);
                session()->setFlashdata('danger_galeri', 'Data Galeri : ' . $getGaleri->jenis . ' Berhasi Dihapus.');
            } else {
                session()->setFlashdata('warning_galeri', 'Data Galeri : tidak dapat dihapus.');
            }
            return redirect()->to(base_url() . '/galeri/index');
        } else {
            session()->setFlashdata('warning_galeri', 'Data Galeri : ' . $getGaleri->jenis . ' Tidak Ditemukan.');
            return redirect()->to(base_url() . '/galeri/index');
        }
    }

    // Menghapus data pilihan
    public function hapusbanyak()
    {
        $request = \Config\Services::request();
        $id_galeri = $request->getPost('id_galeri');
        if ($id_galeri == null) {
            session()->setFlashdata('warning', 'Data foto Belum Dipilih, Silahkan Pilih Data Terlebih Dahulu.');
            $data['title'] = 'Data Galeri dan Pejabat Desa';
            return redirect()->to(base_url() . '/galeri/index');
        }

        $jmldata = count($id_galeri);
        $hps = 0;
        $tdk = 0;
        for ($i = 0; $i < $jmldata; $i++) {
            if ($id_galeri[$i] > 15) {
                $this->model->hapusGaleri($id_galeri[$i]);
                $hps++;
            } else {
                $tdk++;
            }
        }
        if ($hps != 0 and $tdk == 0) {
            session()->setFlashdata('pesan_galeri', 'Data foto berhasi dihapus sebanyak ' . $hps . ' data');
        } elseif ($hps != 0 and $tdk != 0) {
            session()->setFlashdata('pesan_galeri', 'Data fto berhasi dihapus sebanyak ' . $hps . ' data dan ' . $tdk . ' data tidak terhapus');
        } else {
            session()->setFlashdata('warning_galeri', 'Data foto tidak berhasi dihapus sebanyak ' . $tdk . ' data');
        }
        return redirect()->to(base_url() . '/galeri/index');
    }
}
