<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PotensiModel;
use App\Models\PendudukModel;
use App\Models\AuthModel;
use App\Models\PerangkatModel;

class Potensi extends Controller
{
    protected $model;
    public function __construct()
    {
        helper('form');
        // Deklarasi model
        $this->model =  new PotensiModel();
        $this->penduduk =  new PendudukModel();
        $this->user =  new AuthModel();
        $this->perangkat =  new PerangkatModel();
    }

    // Menampilkan list Data Potensi
    public function index()
    {
        $ket = [
            'Data Potensi', '<li class="breadcrumb-item active"><a href="/potensi/index">Data Potensi</a></li>'
        ];
        $data = [
            'title' => 'Data Potensi',
            'ket' => $ket,
            'link' => 'potensi',
            'potensi' => $this->model->getPotensi(),
            'link' => 'home',
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('potensi/index', $data);
    }

    // View detail data
    public function view($id_potensi)
    {
        $data = $this->model->getPotensi($id_potensi);
        $ket = [
            'View Data Potensi', '<li class="breadcrumb-item active"><a href="/potensi/index">Data Potensi</a></li>',
            '<li class="breadcrumb-item active">View Data</li>'
        ];
        $data = [
            'title' => 'View Data Potensi',
            'ket' => $ket,
            'link' => 'potensi',
            'potensi' => $this->model->getPotensi($id_potensi),
            'link' => 'home',
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('potensi/view', $data);
    }

    // Menampilkan form input
    public function input()
    {
        $ket = [
            'Tambah Data Potensi',
            '<li class="breadcrumb-item active"><a href="/potensi/index">Data Potensi</a></li>',
            '<li class="breadcrumb-item active">Tambah Data</li>'
        ];
        $data = [
            'title' => 'Tambah Data Potensi',
            'ket' => $ket,
            'link' => 'potensi',
            'link' => 'home',
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('potensi/input', $data);
    }

    public function add()
    {
        $request = \Config\Services::request();

        $file = $request->getFile('foto');
        if ($file->getError() == 4) {
            $nm = "no_image.png";
        } else {
            $nm = $file->getRandomName();
            $file->move('potensi', $nm);
        }

        $data = array(
            'nama' => $request->getPost('nama'),
            'foto' => $nm,
            'ket' => $request->getPost('ket'),
            'tgl_update' => date('Y-m-d')
        );
        $this->model->savePotensi($data);
        return redirect()->to('potensi/index');
    }

    ///edit data
    public function edit($id_potensi)
    {
        $potensi = $this->model->getPotensi($id_potensi);
        if (isset($potensi)) {
            $ket = [
                'Edit ' . $potensi->nama,
                '<li class="breadcrumb-item active"><a href="/potensi/index">Data Potensi</a></li>',
                '<li class="breadcrumb-item active">Edit Data</li>'
            ];
            $data = [
                'title' => 'Edit ' . $potensi->nama,
                'ket' => $ket,
                'link' => 'potensi',
                'potensi' => $potensi,
                'link' => 'home',
                'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
                'isi' => $this->user->getUser(session()->id)
            ];
            return view('potensi/edit', $data);
        } else {
            session()->setFlashdata('warning_potensi', 'berita dengan Nama : ' . $potensi->nama . ' Tidak Ditemukan.');
            return redirect()->to('potensi/index');
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id_potensi = $request->getPost('id_potensi');

        $file = $request->getFile('foto');
        if ($file->getError() == 4) {
            $nm = $request->getPost('lama');
        } else {
            $nm = $file->getRandomName();
            $file->move('potensi', $nm);
            if ($request->getPost('lama') != 'no_image.png') {
                unlink('potensi/' . $request->getPost('lama'));
            }
        }

        $data = array(
            'nama' => $request->getPost('nama'),
            'foto' => $nm,
            'ket' => $request->getPost('ket'),
            'tgl_update' => date('Y-m-d')
        );
        $this->model->editPotensi($data, $id_potensi);
        session()->setFlashdata('pesan_potensi', 'Data Potensi Berhasi Diedit.');
        return redirect()->to('potensi/index');
    }

    // Menghapus data
    public function delete($id_potensi)
    {
        $potensi = $this->model->getPotensi($id_potensi);
        if (isset($potensi)) {
            $this->model->hapusPotensi($id_potensi);
            session()->setFlashdata('danger_potensi', 'Data Potensi : ' . $potensi->nama . ' Berhasi Dihapus.');
            return redirect()->to('potensi/index');
        } else {
            session()->setFlashdata('warning_potensi', 'Data Potensi : ' . $potensi->nama . ' Tidak Ditemukan.');
            return redirect()->to('potensi/index');
        }
    }

    // Menghapus data pilihan
    public function hapusbanyak()
    {
        $request = \Config\Services::request();
        $id_potensi = $request->getPost('id_potensi');
        if ($id_potensi == null) {
            session()->setFlashdata('warning', 'Data Pejabat dan berita Desa Belum Dipilih, Silahkan Pilih Data Terlebih Dahulu.');
            $data['title'] = 'Data Potensi dan Pejabat Desa';
            return redirect()->to('potensi/index');
        }

        $jmldata = count($id_potensi);
        for ($i = 0; $i < $jmldata; $i++) {
            $this->model->hapusPotensi($id_potensi[$i]);
        }

        session()->setFlashdata('pesan', 'Data Pejabat dan berita Desa Berhasi Dihapus Sebanyak ' . $jmldata . ' Data.');
        $data['title'] = 'Data Potensi dan Pejabat Desa';
        return redirect()->to('potensi/index');
    }
}
