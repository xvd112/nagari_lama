<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PerangkatModel;
use App\Models\PendudukModel;
use App\Models\AuthModel;

class Ulama extends Controller
{
    protected $model;
    public function __construct()
    {
        helper('form');
        $this->model =  new PerangkatModel();
        $this->penduduk =  new PendudukModel();
        $this->user =  new AuthModel();
    }

    public function index()
    {
        $ket = [
            'Data Alim Ulama', '<li class="breadcrumb-item active"><a href="' . base_url() . '/ulama/index">Data Alim Ulama</a></li>'
        ];
        $perangkat = $this->model->getPerangkat(false, 'Alim Ulama');
        $p = NULL;
        for ($i = 0; $i < count($perangkat); $i++) {
            if ($this->penduduk->cari($perangkat[$i]['nik']) != NULL) {
                $p[$i] = true;
            } else {
                $p[$i] = false;
            }
        }
        $data = [
            'title' => 'Data Alim Ulama',
            'ket' => $ket,
            'link' => 'ulama',
            'perangkat' => $perangkat,
            'p' => $p,
            'user' => $this->model->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('perangkat/index', $data);
    }

    public function view($id_pemerintahan)
    {
        $data = $this->model->getPerangkat($id_pemerintahan, 'Alim Ulama');
        $ket = [
            'View Data : ' . $data->nama, '<li class="breadcrumb-item active"><a href="' . base_url() . '/ulama/index">Data Alim Ulama</a></li>',
            '<li class="breadcrumb-item active">View Data</li>'
        ];
        $data = [
            'title' => 'View Data : ' . $data->nama,
            'ket' => $ket,
            'link' => 'ulama',
            'perangkat' => $this->model->getPerangkat($id_pemerintahan, 'Alim Ulama'),
            'user' => $this->model->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('perangkat/view', $data);
    }

    public function input()
    {
        $jabatan = array(
            "Ketua", "Sekretaris", "Anggota"
        );

        $x = 0;
        for ($i = 0; $i < count($jabatan); $i++) {
            if ($this->model->jabatan('Alim Ulama', $jabatan[$i]) == NULL) {
                $rev[$x] = $jabatan[$i];
                $x++;
            } else {
                continue;
            }
        }
        if ($x < count($jabatan)) {
            $rev[$x] = 'Anggota';
        }

        $ket = [
            'Tambah Data Alim Ulama',
            '<li class="breadcrumb-item active"><a href="' . base_url() . '/ulama/index">Data Alim Ulama</a></li>',
            '<li class="breadcrumb-item active">Tambah Data</li>'
        ];
        $data = [
            'title' => 'Tambah Data Alim Ulama',
            'ket' => $ket,
            'link' => 'ulama',
            'jabatan' => $rev,
            'user' => $this->model->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('perangkat/input', $data);
    }

    public function add()
    {
        $request = \Config\Services::request();

        $file = $request->getFile('foto');
        if ($file->getError() == 4) {
            $nm = "default.jpg";
        } else {
            $nm = $file->getRandomName();
            $file->move('perangkat', $nm);
        }

        $data = array(
            'no' => date('y', strtotime($request->getPost('tgl_lantik'))) . '-05-' . $request->getPost('jabatan'),
            'nik' => $request->getPost('nik'),
            'nama' => $request->getPost('nama'),
            'jabatan' => $request->getPost('jabatan'),
            'status' => 'Alim Ulama',
            'foto' => $nm,
            'tgl_lantik' => $request->getPost('tgl_lantik'),
            'telp' => $request->getPost('telp'),
            'jekel' => $request->getPost('jekel'),
            'tgl_update' => date('Y-m-d')
        );
        $this->model->savePerangkat($data);
        return redirect()->to(base_url() . 'ulama/index');
    }

    public function edit($id_pemerintahan)
    {
        $getperangkat = $this->model->getPerangkat($id_pemerintahan, 'Alim Ulama');
        if (isset($getperangkat)) {
            $jabatan = array(
                "Ketua", "Sekretaris", "Anggota"
            );
            $ket = [
                'Edit ' . $getperangkat->nama,
                '<li class="breadcrumb-item active"><a href="' . base_url() . '/ulama/index">Data Alim Ulama</a></li>',
                '<li class="breadcrumb-item active">Edit Data</li>'
            ];
            $data = [
                'title' => 'Edit ' . $getperangkat->nama,
                'ket' => $ket,
                'link' => 'ulama',
                'perangkat' => $getperangkat,
                'jabatan' => $jabatan,
                'user' => $this->model->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
                'isi' => $this->user->getUser(session()->id)
            ];
            return view('perangkat/edit', $data);
        } else {
            session()->setFlashdata('warning_perangkat', 'Data alim ulama tidak ditemukan.');
            return redirect()->to(base_url() . 'ulama/index');
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id_pemerintahan = $request->getPost('id_pemerintahan');

        $file = $request->getFile('foto');
        if ($file->getError() == 4) {
            $nm = $request->getPost('lama');
        } else {
            $nm = $file->getRandomName();
            $file->move('perangkat', $nm);
            if ($request->getPost('lama') != 'default.jpg') {
                unlink('perangkat/' . $request->getPost('lama'));
            }
        }

        if ($request->getPost('tgl_berhenti') == NULL or $request->getPost('tgl_berhenti') == '0000-00-00') {
            $berhenti = '';
        } else {
            $berhenti = $request->getPost('tgl_berhenti');
        }

        $data = array(
            'no' => date('y', strtotime($request->getPost('tgl_lantik'))) . '-05-' . $request->getPost('jabatan'),
            'nik' => $request->getPost('nik'),
            'nama' => $request->getPost('nama'),
            'jabatan' => $request->getPost('jabatan'),
            'status' => 'Alim Ulama',
            'foto' => $nm,
            'tgl_lantik' => $request->getPost('tgl_lantik'),
            'tgl_berhenti' => $berhenti,
            'telp' => $request->getPost('telp'),
            'jekel' => $request->getPost('jekel'),
            'tgl_update' => date('Y-m-d')
        );
        $this->model->editPerangkat($data, $id_pemerintahan);
        session()->setFlashdata('pesan_perangkat', 'Data alim ulama berhasi diedit.');
        return redirect()->to(base_url() . 'ulama/index');
    }

    public function delete($id_pemerintahan)
    {
        $getPerangkat = $this->model->getPerangkat($id_pemerintahan, 'Alim Ulama');
        if (isset($getPerangkat)) {
            $this->model->hapusPerangkat($id_pemerintahan);
            session()->setFlashdata('pesan_perangkat', 'Data alim ulama : ' . $getPerangkat->nama . ' berhasi dihapus.');
            return redirect()->to(base_url() . 'ulama/index');
        } else {
            session()->setFlashdata('warning_perangkat', 'Data alim ulama tidak ditemukan.');
            return redirect()->to(base_url() . 'ulama/index');
        }
    }

    public function hapusbanyak()
    {
        $request = \Config\Services::request();
        $id_pemerintahan = $request->getPost('id_pemerintahan');
        if ($id_pemerintahan == null) {
            session()->setFlashdata('warning_perangkat', 'Data alim ulama belum dipilih, silahkan pilih data terlebih dahulu.');
            return redirect()->to(base_url() . 'ulama/index');
        }

        $jmldata = count($id_pemerintahan);
        for ($i = 0; $i < $jmldata; $i++) {
            $this->model->hapusPerangkat($id_pemerintahan[$i]);
        }

        session()->setFlashdata('pesan_perangkat', 'Data alim ulama berhasil dihapus sebanyak ' . $jmldata . ' data.');
        return redirect()->to(base_url() . 'ulama/index');
    }

    public function import()
    {
        $ket = [
            'Import Data Alim Ulama', '<li class="breadcrumb-item active"><a href="' . base_url() . '/ulama/index">Data Alim Ulama</a></li>',
            '<li class="breadcrumb-item active">Import Data</li>'
        ];
        $data = [
            'title' => 'Import Data Alim Ulama',
            'ket' => $ket,
            'link' => 'ulama',
            'perangkat' => $this->model->getPerangkat(false, 'Alim Ulama'),
            'user' => $this->model->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('perangkat/import', $data);
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
            session()->setFlashdata('warning_perangkat', 'Ekstensi file salah, silahkan masukkan file berekstensi .xls atau .xlsx.');
            return redirect()->to(base_url() . 'ulama/import');
        }
        $spreadsheet = $render->load($file);
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        foreach ($sheet as $x => $excel) {
            if ($x == 0) {
                continue;
            }

            $jabatan = $this->model->cek('Alim Ulama', $excel[3], $excel[4], $excel[5]);  // Mengecek data apa ada yg sama atau tidak

            if ($jabatan != NULL and $jabatan['jabatan'] != 'Anggota') {
                if ($excel[3] == $jabatan['jabatan'] and $excel[2] == $jabatan['nama']) { // Data sama akan di skip
                    continue;
                }
            }

            if ($excel[7] == 'L') {
                $excel[7] = 'Laki - Laki';
            } elseif ($excel[7] == 'P') {
                $excel[7] = 'Perempuan';
            }

            if ($excel[5] == '' or $excel[5] == '0000-00-00' or $excel[5] == '-') {
                $berhenti = NULL;
            } else {
                $berhenti = $excel[5];
            }

            if ($excel[1] == '-' or $excel[1] == '0000000000000000') {
                $nik = '';
            } else {
                $nik = $excel[1];
            }

            $data = array(
                'no' => date('y', strtotime($excel[4])) . '-04-' . $excel[3],
                'nik' => $nik,
                'nama' => $excel[2],
                'jabatan' => $excel[3],
                'status' => 'Alim Ulama',
                'foto' => 'default.jpg',
                'tgl_lantik' => $excel[4],
                'tgl_berhenti' => $berhenti,
                'telp' => $excel[6],
                'jekel' => $excel[7],
                'tgl_update' => date('Y-m-d')
            );
            $this->model->savePerangkat($data);
        }

        session()->setFlashdata('pesan_perangkat', 'Data alim ulama berhasil diimport.');
        return redirect()->to(base_url() . '/ulama/index');
    }
}
