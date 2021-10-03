<?php

namespace App\Controllers;

use App\Models\PendudukModel;
use App\Models\AuthModel;
use App\Models\PerangkatModel;
use App\Models\AduanModel;

class Aduan extends BaseController
{
	public function __construct()
	{
		helper('form');
		$this->model =  new AduanModel();
		$this->penduduk =  new PendudukModel();
		$this->user =  new AuthModel();
		$this->perangkat =  new PerangkatModel();
	}

	public function index()
	{
		if (session()->get('level') == 1 or session()->get('level') == 2) {
			$ket = [
				'List Aduan', '<li class="breadcrumb-item active"><a href="' . base_url() . '/aduan/index">List Aduan</a></li>'
			];
			$data = [
				'title' => 'List Aduan',
				'ket' => $ket,
				'link' => 'home',
				'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
				'isi' => $this->user->getUser(session()->id),
				'aduan_blm' => $this->model->getAduan(false, false, 'Belum Diproses'),
				'aduan_sdh' => $this->model->getAduan(false, false, 'Selesai')
			];
			return view('aduan/indexadmin', $data);
		} elseif (session()->get('level') == 3) {
			$ket = [
				'List Aduan', '<li class="breadcrumb-item active"><a href="' . base_url() . '/aduan/index">List Aduan</a></li>'
			];
			$data = [
				'title' => 'List Aduan',
				'ket' => $ket,
				'link' => 'home',
				'user' => $this->penduduk->getPenduduk(session()->get('id_datauser')),
				'isi' => $this->user->getUser(session()->id),
				'aduan' => $this->model->getAduan(session()->id)
			];
			return view('aduan/index', $data);
		}
	}

	public function view($id_aduan, $hasil = false)
	{
		if (session()->get('level') == 1 or session()->get('level') == 2) {
			if ($hasil == 'belum') {
				$view = 'viewadmin';
			} elseif ($hasil == 'sudah') {
				$view = 'view';
			}
			$getAduan = $this->model->getAduan(false, $id_aduan, false);
			$x = $this->user->getUser($getAduan->id_user);
			if (isset($getAduan)) {
				$ket = [
					'Periksa Data : ' . $getAduan->id_aduan,
					'<li class="breadcrumb-item active"><a href="/aduan/index">List Aduan</a></li>',
					'<li class="breadcrumb-item active">Periksa Data</li>'
				];
				$data = [
					'title' => 'Periksa Data : ' . $getAduan->id_aduan,
					'ket' => $ket,
					'aduan' => $getAduan,
					'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
					'isi' => $this->user->getUser(session()->id),
					'penduduk' => $this->penduduk->getPenduduk($x->id_datauser)
				];
				return view('aduan/' . $view, $data);
			} else {
				session()->setFlashdata('warning_aduan', 'aduan Tidak Ditemukan.');
				return redirect()->to(base_url() . 'aduan/index');
			}
		} elseif (session()->get('level') == 3) {
			$ket = [
				'View Aduan', '<li class="breadcrumb-item active"><a href="' . base_url() . '/aduan/index">List Aduan</a></li>',
				'<li class="breadcrumb-item active">View Data</li>'
			];
			$data = [
				'title' => 'View Aduan',
				'ket' => $ket,
				'link' => 'home',
				'user' => $this->penduduk->getPenduduk(session()->get('id_datauser')),
				'isi' => $this->user->getUser(session()->id),
				'aduan' => $this->model->getAduan(false, $id_aduan)
			];
			return view('aduan/view', $data);
		}
	}

	public function input()
	{
		$ket = [
			'Tambah Aduan', '<li class="breadcrumb-item active"><a href="' . base_url() . '/aduan/index">List Aduan</a></li>',
			'<li class="breadcrumb-item active">Tambah Data</li>'
		];
		$data = [
			'title' => 'Tambah Aduan',
			'ket' => $ket,
			'link' => 'home',
			'user' => $this->penduduk->getPenduduk(session()->get('id_datauser')),
			'isi' => $this->user->getUser(session()->id),
		];
		return view('aduan/input', $data);
	}

	public function add()
	{
		$request = \Config\Services::request();
		$file = $request->getFile('foto');
		if ($file->getError() == 4) {
			$nm = "no_image.png";
		} else {
			$nm = $file->getRandomName();
			$file->move('aduan', $nm);
		}
		$data = array(
			'aduan' => $request->getPost('aduan'),
			'gambar' => $nm,
			'tgl_aduan' => date('Y-m-d'),
			'id_user' => session()->id,
			'respon' => 'Belum ada respon'
		);
		$this->model->saveAduan($data);
		session()->setFlashdata('pesan_aduan', 'Aduan berhasi ditambah.');
		return redirect()->to(base_url() . '/aduan/index');
	}

	public function edit($id_aduan)
	{
		$getAduan = $this->model->getAduan(false, $id_aduan);
		if (isset($getAduan)) {
			$ket = [
				'Edit Aduan', '<li class="breadcrumb-item active"><a href="' . base_url() . '/aduan/index">List Aduan</a></li>',
				'<li class="breadcrumb-item active">Edit Data</li>'
			];
			$data = [
				'title' => 'Edit Aduan',
				'ket' => $ket,
				'link' => 'home',
				'aduan' => $getAduan,
				'isi' => $this->user->getUser(session()->id),
				'user' => $this->penduduk->getPenduduk(session()->get('id_datauser')),
			];
			return view('aduan/edit', $data);
		} else {
			session()->setFlashdata('warning_aduan', 'Data Aduan tidak ditemukan.');
			return redirect()->to(base_url() . '/aduan/index');
		}
	}

	public function update()
	{
		if (session()->get('level') == 1 or session()->get('level') == 2) {
			$request = \Config\Services::request();
			$id = $request->getPost('id_aduan');

			$data = array(
				'respon' => $request->getPost('respon'),
				'tgl_respon' => date('Y-m-d'),
				'ket' => 'Selesai'
			);
			$this->model->editAduan($data, $id);
			session()->setFlashdata('pesan_aduan', 'Data Aduan berhasi diedit.');
			return redirect()->to(base_url() . '/aduan/index');
		} elseif (session()->get('level') == 3) {
			$request = \Config\Services::request();
			$id = $request->getPost('id_aduan');

			$file = $request->getFile('foto');
			if ($file->getError() == 4) {
				$nm = $request->getPost('lama');
			} else {
				$nm = $file->getRandomName();
				$file->move('aduan', $nm);
				if ($request->getPost('lama') != 'no_image.png') {
					unlink('aduan/' . $request->getPost('lama'));
				}
			}
			$data = array(
				'aduan' => $request->getPost('aduan'),
				'gambar' => $nm,
				'tgl_aduan' => date('Y-m-d'),
				'id_user' => session()->id,
				'respon' => 'Belum ada respon'
			);
			$this->model->editAduan($data, $id);
			session()->setFlashdata('pesan_aduan', 'Data Aduan berhasi diedit.');
			return redirect()->to(base_url() . '/aduan/index');
		}
	}

	public function delete($id_aduan)
	{
		$getAduan = $this->model->getAduan($id_aduan);
		if (isset($getAduan)) {
			$this->model->hapusAduan($id_aduan);
			session()->setFlashdata('danger_aduan', 'Data aduan Berhasi Dihapus.');
			return redirect()->to(base_url() . '/aduan/index');
		} else {
			session()->setFlashdata('warning_aduan', 'Data aduan Tidak Ditemukan.');
			return redirect()->to(base_url() . '/aduan/index');
		}
	}

	public function hapusbanyak()
	{
		$request = \Config\Services::request();
		$id_aduan = $request->getPost('id_aduan');
		if ($id_aduan == null) {
			session()->setFlashdata('warning_aduan', 'Data aduan Belum Dipilih, Silahkan Pilih Data Terlebih Dahulu.');
			return redirect()->to(base_url() . '/aduan/index');
		}

		$jmldata = count($id_aduan);
		for ($i = 0; $i < $jmldata; $i++) {
			$this->model->hapusAduan($id_aduan[$i]);
		}

		session()->setFlashdata('pesan_aduan', 'Data aduan Berhasi Dihapus Sebanyak ' . $jmldata . ' Data.');
		return redirect()->to(base_url() . '/aduan/index');
	}
}
