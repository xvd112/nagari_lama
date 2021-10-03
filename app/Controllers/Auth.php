<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\PendudukModel;
use App\Models\KeluargaModel;

class Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->model =  new AuthModel();
        $this->penduduk =  new PendudukModel();
        $this->keluarga =  new KeluargaModel();
    }

    public function login()
    {
        $data = [
            'title' => 'Login',
        ];
        return view('auth/login', $data);
    }

    public function cek_login()
    {
        $request = \Config\Services::request();
        $log = $request->getPost('login');
        $pass = $request->getPost('password');
        $cek_email = $this->model->login('email', $log);
        $cek_telp = $this->model->login('telp', $log);
        $cek_nik = $this->model->login('username', $log);
        if ($cek_email != NULL and password_verify($pass, $cek_email['password'])) {
            session()->set('log', true);
            session()->set('level', $cek_email['level']);
            session()->set('id_datauser', $cek_email['id_datauser']);
            session()->set('foto', $cek_email['foto']);
            session()->set('username', $cek_email['username']);
            session()->set('email', $cek_email['email']);
            session()->set('telp', $cek_email['telp']);
            session()->set('id', $cek_email['id']);
            return redirect()->to(base_url() . '/home/index');
        } elseif ($cek_telp != NULL and password_verify($pass, $cek_telp['password'])) {
            session()->set('log', true);
            session()->set('level', $cek_telp['level']);
            session()->set('id_datauser', $cek_telp['id_datauser']);
            session()->set('foto', $cek_telp['foto']);
            session()->set('username', $cek_telp['username']);
            session()->set('email', $cek_telp['email']);
            session()->set('telp', $cek_telp['telp']);
            session()->set('id', $cek_telp['id']);
            return redirect()->to(base_url() . '/home/index');
        } elseif ($cek_nik != NULL and password_verify($pass, $cek_nik['password'])) {
            session()->set('log', true);
            session()->set('level', $cek_nik['level']);
            session()->set('id_datauser', $cek_nik['id_datauser']);
            session()->set('foto', $cek_nik['foto']);
            session()->set('username', $cek_nik['username']);
            session()->set('email', $cek_nik['email']);
            session()->set('telp', $cek_nik['telp']);
            session()->set('id', $cek_nik['id']);
            return redirect()->to(base_url() . '/home/index');
        } else {
            session()->setFlashdata('error', 'Login gagal');
            if ($request->getPost('log') == 'surat') {
                return redirect()->to(base_url() . '/web/surat');
            } else {
                return redirect()->to(base_url() . '/auth/login');
            }
        }
    }

    public function logout()
    {
        session()->remove('log');
        session()->remove('level');
        session()->remove('id_datauser');
        session()->remove('foto');
        session()->remove('username');
        session()->remove('email');
        session()->remove('telp');
        session()->setFlashdata('pesan_log', 'Logout sukses');
        return redirect()->to(base_url() . '/auth/login');
    }
}
