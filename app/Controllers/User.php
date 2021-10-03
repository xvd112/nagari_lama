<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PendudukModel;
use App\Models\PerangkatModel;
use App\Models\AuthModel;
use App\Models\KeluargaModel;

class User extends Controller
{
    protected $model, $isi, $keluarga, $data;
    public function __construct()
    {
        helper('form');
        $this->model =  new AuthModel();
        $this->penduduk =  new PendudukModel();
        $this->perangkat =  new PerangkatModel();
        $this->keluarga =  new KeluargaModel();
    }

    public function index()
    {
        $ket = [
            'Data User', '<li class="breadcrumb-item active"><a href="' . base_url() . '/user/index">Data User</a></li>'
        ];
        $x = $this->model->getUser(false, 1);
        $admin = [];
        for ($i = 0; $i < count($x); $i++) {
            $admin[$i]['id'] = $x[$i]['id'];
            $admin[$i]['username'] = $x[$i]['username'];
            $admin[$i]['email'] = $x[$i]['email'];
            if ($this->perangkat->getPerangkat($x[$i]['id_datauser'], 'Perangkat Nagari') != NULL) {
                $admin[$i]['nama'] = $this->perangkat->getPerangkat($x[$i]['id_datauser'], 'Perangkat Nagari')->nama;
            } else {
                $admin[$i]['nama'] = 'Super Admin';
            }
        }

        $y = $this->model->getUser(false, 2);
        $perangkat = [];
        for ($i = 0; $i < count($y); $i++) {
            $perangkat[$i]['id'] = $y[$i]['id'];
            $perangkat[$i]['username'] = $y[$i]['username'];
            $perangkat[$i]['email'] = $y[$i]['email'];
            if ($this->perangkat->getPerangkat($x[$i]['id_datauser'], 'Perangkat Nagari') != NULL) {
                $perangkat[$i]['nama'] = $this->perangkat->getPerangkat($x[$i]['id_datauser'], 'Perangkat Nagari')->nama;
            } else {
                $perangkat[$i]['nama'] = 'Admin';
            }
        }

        $z = $this->model->getUser(false, 3);
        $warga = [];
        for ($i = 0; $i < count($z); $i++) {
            $warga[$i]['id'] = $z[$i]['id'];
            $warga[$i]['username'] = $z[$i]['username'];
            $warga[$i]['email'] = $z[$i]['email'];
            if ($this->penduduk->getPenduduk($z[$i]['id_datauser']) != NULL) {
                $warga[$i]['nama'] = $this->penduduk->getPenduduk($z[$i]['id_datauser'])->nama;
            } else {
                $warga[$i]['nama'] = 'Warga';
            }
        }

        $data = [
            'title' => 'Data User',
            'ket' => $ket,
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->model->getUser(session()->id),
            'data_admin' => $admin,
            'data_perangkat' => $perangkat,
            'data_warga' => $warga
        ];

        return view('user/index', $data);
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
    public function input($l)
    {
        $ket = [
            'Tambah Data User',
            '<li class="breadcrumb-item active"><a href="' . base_url() . '/user/index">Data User</a></li>',
            '<li class="breadcrumb-item active">Tambah Data</li>'
        ];
        $data = [
            'title' => 'Tambah Data User',
            'ket' => $ket,
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->model->getUser(session()->id)
        ];
        if ($l == 1 or $l == 2) {
            $data['data'] = $this->perangkat->data('Perangkat Nagari');
        } elseif ($l == 3) {
            $data['data'] = $this->keluarga->getKeluarga();
        }
        $data['level'] = $l;
        return view('user/input', $data);
    }

    public function view($id)
    {
        $user = $this->model->getUser($id);
        $ket = [
            'View Data User : ' . $user->username, '<li class="breadcrumb-item active"><a href="' . base_url() . '/user/index">Data User</a></li>',
            '<li class="breadcrumb-item active">View Data</li>'
        ];

        $data = [
            'title' => 'View Data User : ' . $user->username,
            'ket' => $ket,
            'datauser' => $user,
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->model->getUser(session()->id)
        ];
        return view('user/view', $data);
    }

    public function add()
    {
        $request = \Config\Services::request();
        if ($request->getPost('level') == 1 or $request->getPost('level') == 2) {
            $id = $request->getPost('id_datauser');
        } elseif ($request->getPost('level') == 3) {
            $id = $request->getPost('id_penduduk');
        }

        $data = array(
            'id_datauser' => $id,
            'email' => $request->getPost('email'),
            'username' => $request->getPost('username'),
            'password' => password_hash($request->getPost('pass'), PASSWORD_BCRYPT),
            'telp' => $request->getPost('telp'),
            'level' => $request->getPost('level'),
            'foto' => 'default.svg',
        );
        $this->model->saveUser($data);
        session()->setFlashdata('pesan_user', 'Data user berhasi ditambahkan.');
        return redirect()->to('/user/index');
    }

    public function edit($id)
    {
        $user = $this->model->getUser($id);
        if (isset($user)) {
            $ket = [
                'Edit Data : ' . $user->username,
                '<li class="breadcrumb-item active"><a href="' . base_url() . '/user/index">Data User</a></li>',
                '<li class="breadcrumb-item active">Edit Data</li>'
            ];
            $data = [
                'level' => $user->level,
                'title' => 'Edit Data : ' . $user->username,
                'ket' => $ket,
                'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
                'isi' => $this->model->getUser(session()->id),
                'datauser' => $user
            ];
            $x = $this->model->getUser($id);
            if ($user->level == 1 or $user->level == 2) {
                $data['data'] = $this->perangkat->getPerangkat(false, 'Perangkat Nagari');
            } elseif ($user->level == 3) {
                $data['data'] = $this->penduduk->id_array($x->id_datauser, 'id_penduduk');
                $data['keluarga'] = $this->keluarga->getKeluarga();
                $data['kel'] = $this->penduduk->getPenduduk($x->id_datauser);
            }
            return view('user/edit', $data);
        } else {
            session()->setFlashdata('warning_user', 'User tidak ditemukan.');
            return redirect()->to('/user/index');
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id = $request->getPost('id');

        $file = $request->getFile('foto');
        if ($file->getError() == 4) {
            $nm = $request->getPost('lama');
        } else {
            $nm = $file->getRandomName();
            $file->move('user', $nm);
            if ($request->getPost('lama') != 'default.svg') {
                unlink('user/' . $request->getPost('lama'));
            }
        }

        if ($request->getPost('username') != NULL) {
            $data = array(
                'password' => password_hash($request->getPost('pass'), PASSWORD_BCRYPT),
            );
            $this->model->editUser($data, $id);
        }
        $data = array(
            'id_datauser' => $request->getPost('id_datauser'),
            'foto' => $nm,
            'email' => $request->getPost('email'),
            'username' => $request->getPost('username'),
            'telp' => $request->getPost('telp'),
            'level' => $request->getPost('level'),
        );
        $this->model->editUser($data, $id);
        session()->setFlashdata('pesan_user', 'Data User Berhasi Diedit.');
        return redirect()->to('user/index');
    }

    public function reset($id)
    {
        $data = array(
            'password' => password_hash('12345678', PASSWORD_BCRYPT),
        );
        $this->model->editUser($data, $id);
        session()->setFlashdata('pesan_user', 'Password berhasil di reset');
        return redirect()->to('user/index');
    }

    public function delete($id)
    {
        $user = $this->model->getUser($id);
        if (isset($user) and $id != 1) {
            $this->model->hapusUser($id);
            session()->setFlashdata('danger_user', 'Data User ' . $user->username . ' berhasi dihapus.');
            return redirect()->to('/user/index');
        } elseif (isset($user) and $id == 1) {
            session()->setFlashdata('warning_user', 'User : ' . $user->username . ' tidak dapat dihapus.');
            return redirect()->to('/user/index');
        } else {
            session()->setFlashdata('warning_user', 'Data User ' . $user->username . ' Tidak Ditemukan.');
            return redirect()->to('/user/index');
        }
    }

    public function hapusbanyak()
    {
        $request = \Config\Services::request();
        $id = $request->getPost('id');
        if ($id == null) {
            session()->setFlashdata('warning_user', 'Data user tidak dapat dihapus.');
            return redirect()->to('user/index');
        }

        $jmldata = count($id);
        $x = 0;
        $y = 0;
        for ($i = 0; $i < $jmldata; $i++) {
            if ($id[$i] != 1) {
                $this->model->hapusUser($id[$i]);
                $x++;
            } else {
                $y++;
            }
        }

        if ($y == 0 and $x != 0) {
            session()->setFlashdata('pesan_user', 'Data user Berhasi Dihapus Sebanyak ' . $x . ' Data.');
        } elseif ($y != 0 and $x != 0) {
            session()->setFlashdata('pesan_user', 'Data user Berhasi Dihapus Sebanyak ' . $x . ' Data dan ' . $y . ' data tidak dapat dihapus.');
        } else {
            session()->setFlashdata('warning_user', 'Data user tidak dapat dihapus sebanyak ' . $y . ' data.');
        }
        return redirect()->to('user/index');
    }
}
