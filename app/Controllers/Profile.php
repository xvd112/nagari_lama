<?php

namespace App\Controllers;

use App\Models\PendudukModel;
use App\Models\AuthModel;
use App\Models\PerangkatModel;

class Profile extends BaseController
{
    protected $model, $user;
    public function __construct()
    {
        helper('form');
        // Deklarasi model
        $this->model =  new PendudukModel();
        $this->user =  new AuthModel();
        $this->perangkat =  new PerangkatModel();
    }

    public function index()
    {
        $ket = [
            'Profile', '<li class="breadcrumb-item active"><a href="' . base_url() . '/profile/index">Profile</a></li>'
        ];
        $data = [
            'title' => 'Sistem Informasi Nagari',
            'ket' => $ket,
            'link' => 'home',
            'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
            'isi' => $this->user->getUser(session()->id)
        ];
        return view('profile/adminprof', $data);
    }

    public function editadmin()
    {
        $getUser = $this->user->getUser(session()->id);
        $x = $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari');
        if (isset($getUser)) {
            $ket = [
                'Edit Data : ' . $x->nama, '<li class="breadcrumb-item active"><a href="' . base_url() . '/profile/index">Profile</a></li>',
                '<li class="breadcrumb-item active">Edit Profile</li>'
            ];
            $data = [
                'title' => 'Edit Data : ' . $x->nama,
                'ket' => $ket,
                'data' => $getUser,
                'link' => 'home',
                'user' => $x,
                'isi' => $getUser
            ];
            return view('profile/editadmin', $data);
        } else {
            session()->setFlashdata('warning_profile', 'User ' . session()->username . ' tidak ditemukan.');
            return redirect()->to(base_url() . '/profile/editadmin');
        }
    }

    public function updatadmin()
    {
        $request = \Config\Services::request();
        $id = $request->getPost('id');

        $file = $request->getFile('foto');
        if ($file->getError() == 4) {
            $nm = $request->getPost('lama');
        } else {
            if (session()->level == 3) {
                $folder = 'penduduk';
            } else {
                $folder = 'perangkat';
            }
            $nm = $file->getRandomName();
            $file->move($folder, $nm);
            if ($request->getPost('lama') != 'default.svg') {
                unlink($folder . '/' . $request->getPost('lama'));
            }
        }

        $pass = $request->getPost('pass');
        if ($pass != NULL) {
            $data = array(
                'password' => password_hash($pass, PASSWORD_BCRYPT)
            );
            $this->user->editUser($data, $id);
        }

        $data = array(
            'email' => $request->getPost('email'),
            'username' => $request->getPost('username'),
            'telp' => $request->getPost('telp'),
            'foto'  =>  $nm,
        );
        $this->user->editUser($data, $id);
        $data2 = array(
            'nik' => $request->getPost('nik'),
        );
        $this->perangkat->editPerangkat($data2, session()->get('id_datauser'));
        session()->setFlashdata('pesan_profile', 'Pofile berhasi diedit.');
        return redirect()->to(base_url() . '/profile/index');
    }

    public function edit()
    {
        $getUser = $this->user->getUser(session()->id);
        $x = $this->model->getPenduduk(session()->id_datauser);
        if (isset($getUser)) {
            $ket = [
                'Edit Data Profile',
                '<li class="breadcrumb-item active">Edit Profile</li>'
            ];
            $data = [
                'title' => 'Edit Data Profile',
                'ket' => $ket,
                'data' => $getUser,
                'link' => 'home',
                'user' => $x,
                'isi' => $getUser
            ];
            return view('profile/edit', $data);
        } else {
            session()->setFlashdata('warning_profile', 'User ' . session()->username . ' tidak ditemukan.');
            return redirect()->to(base_url() . '/profile/edit');
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
            if (session()->level == 3) {
                $folder = 'penduduk';
            } else {
                $folder = 'perangkat';
            }
            $nm = $file->getRandomName();
            $file->move($folder, $nm);
            if ($request->getPost('lama') != 'default.svg') {
                unlink($folder . '/' . $request->getPost('lama'));
            }
        }

        $pass = $request->getPost('pass');
        if ($pass != NULL) {
            $data = array(
                'password' => password_hash($pass, PASSWORD_BCRYPT)
            );
            $this->user->editUser($data, $id);
        }

        $data = array(
            'email' => $request->getPost('email'),
            'username' => $request->getPost('username'),
            'telp' => $request->getPost('telp'),
            'foto'  =>  $nm,
        );
        $this->user->editUser($data, $id);
        session()->setFlashdata('pesan_profile', 'Pofile berhasi diedit.');
        return redirect()->to(base_url() . '/home/index');
    }
}
