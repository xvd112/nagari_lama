<?php

namespace App\Controllers;

use App\Models\PendudukModel;
use App\Models\AuthModel;
use App\Models\MohonModel;
use App\Models\PerangkatModel;
use App\Models\SuratModel;

class Permohonan extends BaseController
{
	public function __construct()
	{
		helper('form');
		// Deklarasi model
		$this->model =  new MohonModel();
		$this->penduduk =  new PendudukModel();
		$this->user =  new AuthModel();
		$this->perangkat =  new PerangkatModel();
		$this->surat =  new SuratModel();
	}

	public function index()
	{
		if (session()->get('level') == 1 or session()->get('level') == 2) {
			$ket = [
				'List Permohonan', '<li class="breadcrumb-item active"><a href="' . base_url() . '/permohonan/index">List Permohonan</a></li>'
			];
			$data = [
				'title' => 'List Permohonan',
				'ket' => $ket,
				'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
				'isi' => $this->user->getUser(session()->id),
				'mohon_blm' => $this->model->getMohon(false, false, 'Belum Diperiksa'),
				'mohon_stj' => $this->model->getMohon(false, false, 'Diterima'),
				'mohon_tlk' => $this->model->getMohon(false, false, 'Ditolak'),
			];
			return view('mohon/indexadmin', $data);
		} elseif (session()->get('level') == 3) {
			$ket = [
				'Permohonan Surat', '<li class="breadcrumb-item active"><a href="' . base_url() . '/permohonan/index">Permohonan Surat</a></li>'
			];
			$data = [
				'title' => 'Permohonan Surat',
				'ket' => $ket,
				'user' => $this->penduduk->getPenduduk(session()->get('id_datauser')),
				'isi' => $this->user->getUser(session()->id),
				'permohonan' => $this->model->getMohon(session()->id, false, false),
			];
			return view('mohon/index', $data);
		}
	}

	public function view($id_permohonan, $hasil = false)
	{
		if (session()->get('level') == 1 or session()->get('level') == 2) {
			if ($hasil == 'belum') {
				$view = 'viewadmin';
			} elseif ($hasil == 'terima') {
				$view = 'view';
			} elseif ($hasil == 'tolak') {
				$view = 'view';
			}
			$getMohon = $this->model->getMohon(false, $id_permohonan, false);
			if (isset($getMohon)) {
				$ket = [
					'Periksa Data : ' . $getMohon->id_permohonan,
					'<li class="breadcrumb-item active"><a href="/permohonan/index">List Permohonan</a></li>',
					'<li class="breadcrumb-item active">Periksa Data</li>'
				];
				$data = [
					'title' => 'Periksa Data : ' . $getMohon->id_permohonan,
					'ket' => $ket,
					'mohon' => $getMohon,
					'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'),
					'isi' => $this->user->getUser(session()->id),
					'penduduk' => $this->penduduk->getPenduduk($getMohon->id_penduduk)
				];
				return view('mohon/' . $view, $data);
			} else {
				session()->setFlashdata('warning_permohonan', 'Permohonan Tidak Ditemukan.');
				return redirect()->to(base_url() . 'permohonan/index');
			}
		} elseif (session()->get('level') == 3) {
			$getMohon = $this->model->getMohon(false, $id_permohonan, false);
			if (isset($getMohon)) {
				$ket = [
					'Periksa Data : ' . $getMohon->id_permohonan,
					'<li class="breadcrumb-item active"><a href="/permohonan/index">Permohonan Surat</a></li>',
					'<li class="breadcrumb-item active">Periksa Data</li>'
				];
				$data = [
					'title' => 'Periksa Data : ' . $getMohon->id_permohonan,
					'ket' => $ket,
					'mohon' => $getMohon,
					'user' => $this->penduduk->getPenduduk(session()->get('id_datauser')),
					'isi' => $this->user->getUser(session()->id),
				];
				return view('mohon/view', $data);
			} else {
				session()->setFlashdata('warning_permohonan', 'Permohonan Tidak Ditemukan.');
				return redirect()->to(base_url() . 'permohonan/index');
			}
		}
	}


	public function input()
	{
		$ket = [
			'Tambah Permohonan', '<li class="breadcrumb-item active"><a href="' . base_url() . '/permohonan/index">Permohonan Surat</a></li>',
			'<li class="breadcrumb-item active">Tambah Data</li>'
		];
		$surat = array(
			'SKTM', 'SKM', 'SKPO', 'SKU'
		);
		$data = [
			'title' => 'Tambah Permohonan',
			'ket' => $ket,
			'link' => 'home',
			'user' => $this->penduduk->getPenduduk(session()->get('id_datauser')),
			'isi' => $this->user->getUser(session()->id),
			'surat' => $surat
		];
		return view('mohon/input', $data);
	}

	public function add()
	{
		$request = \Config\Services::request();

		$ktp = $request->getFile('scan_ktp');
		if ($ktp->getError() == 4) {
			$nm_ktp = "no_image.png";
		} else {
			$nm_ktp = $ktp->getRandomName();
			$ktp->move('permohonan', $nm_ktp);
		}

		$kk = $request->getFile('scan_kk');
		if ($kk->getError() == 4) {
			$nm_kk = "no_image.png";
		} else {
			$nm_kk = $kk->getRandomName();
			$kk->move('permohonan', $nm_kk);
		}

		$jamkes = $request->getFile('scan_jamkes');
		if ($jamkes->getError() == 4) {
			$nm_jamkes = "no_image.png";
		} else {
			$nm_jamkes = $jamkes->getRandomName();
			$jamkes->move('permohonan', $nm_jamkes);
		}

		$data = array(
			'id_penduduk' => session()->id_datauser,
			'id_user' => session()->id,
			'jenis' => $request->getPost('jenis'),
			'tujuan' => $request->getPost('tujuan'),
			'tambahan' => $request->getPost('tambahan'),
			'scan_ktp' => $nm_ktp,
			'scan_kk' => $nm_kk,
			'scan_jamkes' => $nm_jamkes,
			'tgl_masuk' => date('Y-m-d'),
		);
		// dd($data);
		$this->model->saveMohon($data);
		session()->setFlashdata('pesan_mohon', 'Permohonan berhasi ditambah.');
		return redirect()->to(base_url() . '/permohonan/index');
	}

	public function surat($id_permohonan)
	{
		$srt = $this->model->getMohon(false, $id_permohonan, false);
		$max = $this->surat->no($srt->jenis);
		$wali = $this->perangkat->wali();
		$data = array(
			'no_surat' => $max->x + 1,
			'id_penduduk' => $srt->id_penduduk,
			'id_pemerintahan' => $wali->id_pemerintahan,
			'tgl_surat' => date('Y-m-d'),
			'jenis' => $srt->jenis,
			'tujuan' => $srt->tujuan,
			'tambahan' => $srt->tambahan,
		);
		$this->surat->saveSurat($data);
		return redirect()->to($srt->jenis . '/index');
	}


	public function edit($id_permohonan)
	{
		$getMohon = $this->model->getMohon(false, $id_permohonan);
		if (isset($getMohon)) {
			$surat = array(
				'SKTM', 'SKM', 'SKPO', 'SKU'
			);
			$ket = [
				'Edit Permohonan', '<li class="breadcrumb-item active"><a href="' . base_url() . '/permohonan/index">Permohonan Surat</a></li>',
				'<li class="breadcrumb-item active">Edit Data</li>'
			];
			$data = [
				'title' => 'Edit Permohonan : ' . $getMohon->jenis,
				'ket' => $ket,
				'link' => 'home',
				'mohon' => $getMohon,
				'surat' => $surat,
				'user' => $this->penduduk->getPenduduk(session()->get('id_datauser')),
				'isi' => $this->user->getUser(session()->id),
			];
			return view('mohon/edit', $data);
		} else {
			session()->setFlashdata('warning_mohon', 'Data permohonan tidak ditemukan.');
			return redirect()->to(base_url() . '/permohonan/index');
		}
	}

	public function update()
	{
		if (session()->get('level') == 1 or session()->get('level') == 2) {
			$request = \Config\Services::request();
			$id = $request->getPost('id_permohonan');
			$jenis = $request->getPost('jenis');
			if ($jenis != 'SKM') {
				$hasil = 'Hasil Pemeriksaan KTP : ' . $request->getPost('ktp') . '<br>Hasil Pemeriksaan KK : ' . $request->getPost('kk');
				if ($request->getPost('ktp') == 'KTP Sesuai' and $request->getPost('kk') == 'KK Sesuai') {
					$ket = 'Diterima';
				} else {
					$ket = 'Ditolak';
				}
			} else {
				$hasil = 'Hasil Pemeriksaan KTP : ' . $request->getPost('ktp') . '<br>Hasil Pemeriksaan KK : ' . $request->getPost('kk') . '<br>Hasil Pemeriksaan Jamkesmas : ' . $request->getPost('jamkes');
				if ($request->getPost('ktp') == 'KTP Sesuai' and $request->getPost('kk') == 'KK Sesuai'  and $request->getPost('jamkes') == 'Jamkesmas Sesuai') {
					$ket = 'Diterima';
				} else {
					$ket = 'Ditolak';
				}
			}
			$data = array(
				'hasil' => $hasil,
				'ket' => $ket
			);
			$this->model->editMohon($data, $id);
			session()->setFlashdata('pesan_mohon', 'Data permohonan berhasi diedit.');
			return redirect()->to(base_url() . '/permohonan/index');
		} elseif (session()->get('level') == 3) {
			$request = \Config\Services::request();
			$id = $request->getPost('id_permohonan');

			$ktp = $request->getFile('scan_ktp');
			if ($ktp->getError() == 4) {
				$nm_ktp = $request->getPost('lama');
			} else {
				$nm_ktp = $ktp->getRandomName();
				$ktp->move('permohonan', $nm_ktp);
				if ($request->getPost('lama') != 'no_img.png') {
					unlink('permohonan/' . $request->getPost('lama'));
				}
			}

			$kk = $request->getFile('scan_kk');
			if ($kk->getError() == 4) {
				$nm_kk = $request->getPost('lama');
			} else {
				$nm_kk = $kk->getRandomName();
				$kk->move('permohonan', $nm_kk);
				if ($request->getPost('lama') != 'no_img.png') {
					unlink('permohonan/' . $request->getPost('lama'));
				}
			}

			$jamkes = $request->getFile('scan_jamkes');
			if ($jamkes->getError() == 4) {
				$nm_jamkes = $request->getPost('lama');
			} else {
				$nm_jamkes = $jamkes->getRandomName();
				$jamkes->move('permohonan', $nm_jamkes);
				if ($request->getPost('lama') != 'no_img.png') {
					unlink('permohonan/' . $request->getPost('lama'));
				}
			}

			$data = array(
				'jenis' => $request->getPost('jenis'),
				'tujuan' => $request->getPost('tujuan'),
				'tambahan' => $request->getPost('tambahan'),
				'scan_ktp' => $nm_ktp,
				'scan_kk' => $nm_kk,
				'scan_jamkes' => $nm_jamkes,
				'tgl_masuk' => date('Y-m-d'),
				'id_penduduk' => session()->id_datauser,
				'ket' => 'Belum Diperiksa'
			);
			$this->model->editMohon($data, $id);
			session()->setFlashdata('pesan_mohon', 'Data permohonan berhasi diedit.');
			return redirect()->to(base_url() . '/permohonan/index');
		}
	}

	public function delete($id_permohonan)
	{
		$getMohon = $this->model->getMohon($id_permohonan);
		if (isset($getMohon)) {
			$this->model->hapusMohon($id_permohonan);
			session()->setFlashdata('danger_mohon', 'Data Permohonan Berhasi Dihapus.');
			return redirect()->to(base_url() . '/permohonan/index');
		} else {
			session()->setFlashdata('warning_mohon', 'Data Permohonan Tidak Ditemukan.');
			return redirect()->to(base_url() . '/permohonan/index');
		}
	}

	public function hapusbanyak()
	{
		$request = \Config\Services::request();
		$id_permohonan = $request->getPost('id_permohonan');
		if ($id_permohonan == null) {
			session()->setFlashdata('warning_mohon', 'Data Permohonan Belum Dipilih, Silahkan Pilih Data Terlebih Dahulu.');
			return redirect()->to(base_url() . '/permohonan/index');
		}

		$jmldata = count($id_permohonan);
		for ($i = 0; $i < $jmldata; $i++) {
			$this->model->hapusMohon($id_permohonan[$i]);
		}

		session()->setFlashdata('pesan_mohon', 'Data Permohonan Berhasi Dihapus Sebanyak ' . $jmldata . ' Data.');
		return redirect()->to(base_url() . '/permohonan/index');
	}
}
