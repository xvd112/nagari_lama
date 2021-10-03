<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BeritaModel;
use App\Models\AuthModel;
use App\Models\PerangkatModel;

class Berita extends Controller
{
    protected $model;
    public function __construct()
    {
        helper('form');
        $this->model =  new BeritaModel();
        $this->user =  new AuthModel();
        $this->perangkat =  new PerangkatModel();
    }

    public function index()
    {
        $request = \Config\Services::request();
        $ket = [
            'Data Berita', '<li class="breadcrumb-item active"><a href="/berita/index">Data Berita</a></li>'
        ];
        $data = [
            'title' => 'Data Berita',
            'ket' => $ket,
            'berita' => $this->model->getBerita(),
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('berita/index', $data);
    }


    public function view($id_berita)
    {
        $data = $this->model->getberita($id_berita);
        $ket = [
            'View Data Berita', '<li class="breadcrumb-item active"><a href="/berita/index">Data Berita</a></li>',
            '<li class="breadcrumb-item active">View Data</li>'
        ];
        $data = [
            'title' => 'View Data Berita',
            'ket' => $ket,
            'berita' => $this->model->getBerita($id_berita),
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('berita/view', $data);
    }

    public function input()
    {
        $ket = [
            'Tambah Data Berita',
            '<li class="breadcrumb-item active"><a href="/berita/index">Data Berita</a></li>',
            '<li class="breadcrumb-item active">Tambah Data</li>'
        ];
        $data = [
            'title' => 'Tambah Data Berita',
            'ket' => $ket,
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('berita/input', $data);
    }

    public function add()
    {
        $request = \Config\Services::request();

        $file = $request->getFile('foto');
        if ($file->getError() == 4) {
            $nm = "no_image.png";
        } else {
            $nm = $file->getRandomName();
            $file->move('berita', $nm);
        }

        $penulis = $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari');
        $data = array(
            'judul' => $request->getPost('judul'),
            'penulis' => $penulis->nama,
            'gambar' => $nm,
            'isi' => $request->getPost('isi'),
            'tgl_update' => date('Y-m-d')
        );
        $this->model->saveberita($data);
        session()->setFlashdata('pesan_berita', 'Berita baru berhasil ditambah.');
        return redirect()->to(base_url() . '/berita/index');
    }

    public function edit($id_berita)
    {
        $getberita = $this->model->getberita($id_berita);
        if (isset($getberita)) {
            $ket = [
                'Edit ' . $getberita->judul,
                '<li class="breadcrumb-item active"><a href="/berita/index">Data Berita</a></li>',
                '<li class="breadcrumb-item active">Edit Data</li>'
            ];
            $data = [
                'title' => 'Edit ' . $getberita->judul,
                'ket' => $ket,
                'berita' => $getberita,
                'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
                'isi' => $this->user->getUser(session()->id)
            ];
            return view('berita/edit', $data);
        } else {
            session()->setFlashdata('warning_berita', 'berita dengan Nama : ' . $getberita->judul . ' Tidak Ditemukan.');
            return redirect()->to(base_url() . '/berita/index');
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id_berita = $request->getPost('id_berita');

        $file = $request->getFile('foto');
        if ($file->getError() == 4) {
            $nm = $request->getPost('lama');
        } else {
            $nm = $file->getRandomName();
            $file->move('berita', $nm);
            if ($request->getPost('lama') != 'no_image.png') {
                unlink('berita/' . $request->getPost('lama'));
            }
        }

        $penulis = $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari');
        $data = array(
            'judul' => $request->getPost('judul'),
            'penulis' => $penulis->nama,
            'gambar' => $nm,
            'isi' => $request->getPost('isi'),
            'tgl_update' => date('Y-m-d')
        );
        $this->model->editberita($data, $id_berita);
        session()->setFlashdata('pesan_berita', 'Data berita berhasi diedit.');
        return redirect()->to(base_url() . '/berita/index');
    }

    public function delete($id_berita)
    {
        $getberita = $this->model->getberita($id_berita);
        if (isset($getberita)) {
            $this->model->hapusberita($id_berita);
            session()->setFlashdata('danger_berita', 'Data Berita : ' . $getberita->judul . ' Berhasi Dihapus.');
            return redirect()->to(base_url() . '/berita/index');
        } else {
            session()->setFlashdata('warning_berita', 'Data Berita : ' . $getberita->judul . ' Tidak Ditemukan.');
            return redirect()->to(base_url() . '/berita/index');
        }
    }

    public function hapusbanyak()
    {
        $request = \Config\Services::request();
        $id_berita = $request->getPost('id_berita');
        if ($id_berita == null) {
            session()->setFlashdata('warning', 'Data Pejabat dan berita Desa Belum Dipilih, Silahkan Pilih Data Terlebih Dahulu.');
            $data['title'] = 'Data berita dan Pejabat Desa';
            return redirect()->to(base_url() . '/berita/index');
        }

        $jmldata = count($id_berita);
        for ($i = 0; $i < $jmldata; $i++) {
            $this->model->hapusberita($id_berita[$i]);
        }

        session()->setFlashdata('pesan', 'Data Pejabat dan berita Desa Berhasi Dihapus Sebanyak ' . $jmldata . ' Data.');
        $data['title'] = 'Data berita dan Pejabat Desa';
        return redirect()->to(base_url() . '/berita/index');
    }
}
