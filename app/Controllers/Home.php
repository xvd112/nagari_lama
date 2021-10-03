<?php

namespace App\Controllers;

use App\Models\PendudukModel;
use App\Models\AuthModel;
use App\Models\PerangkatModel;
use App\Models\MohonModel;
use App\Models\AduanModel;

class Home extends BaseController
{
	protected $model, $user;
	public function __construct()
	{
		helper('form');
		// Deklarasi model
		$this->penduduk =  new PendudukModel();
		$this->user =  new AuthModel();
		$this->perangkat =  new PerangkatModel();
		$this->mohon =  new MohonModel();
		$this->aduan =  new AduanModel();
	}

	public function index()
	{
		if (session()->get('level') == 1 or session()->get('level') == 2) {
			$ket = [
				'Beranda'
			];
			$data = [
				'title' => 'Sistem Informasi Nagari', // Title Tab
				'ket' => $ket, // Untuk link halaman
				'link' => 'chart', // Untuk memanggil chart
				'user' => $this->perangkat->getPerangkat(session()->get('id_datauser'), 'Perangkat Nagari'), // Data lengkap dari user yang aktif
				'isi' => $this->user->getUser(session()->id), // Data user yang aktif
				'penduduk' => $this->penduduk->tot('penduduk'), // Total semua penduduk
				'keluarga' => $this->penduduk->tot('keluarga'), // Total semua kepala keluarga
				'pr' => $this->penduduk->totjekel('penduduk', 'Perempuan'), // Total semua penduduk yang peremuan
				'lk' => $this->penduduk->totjekel('penduduk', 'Laki - Laki'), // Total semua penduduk yang laki - laki
				'g' => $this->penduduk->tot('penduduk', false, false, 'Jorong Gantiang'), // Total penduduk jorong gatiang
				'gru' => $this->penduduk->tot('penduduk', false, false, 'Jorong Gunuang Rajo Utara'), // Total penduduk jorong gunuang rajo utara
				'laki' => $this->penduduk->totjekel('penduduk', "Laki - Laki", false, false, 'Jorong Gantiang'), // Total penduduk jorong gatiang yang laki - laki
				'perempuan' => $this->penduduk->totjekel('penduduk', "Perempuan", false, false, 'Jorong Gantiang'), // Total penduduk jorong gatiang yang perempuan
				'laki_gru' => $this->penduduk->totjekel('penduduk', "Laki - Laki", false, false, 'Jorong Gunuang Rajo Utara'), // Total penduduk jorong gunuang rajo utara yang laki - laki
				'perempuan_gru' => $this->penduduk->totjekel('penduduk', "Perempuan", false, false, 'Jorong Gunuang Rajo Utara') // Total penduduk jorong gunuang rajo utara yang perempuan
			];

			// Menghitung jumlah penduduk berdasarkan umur
			$data['umur'] = array(
				count($this->penduduk->jmlUmur(0, 5)),
				count($this->penduduk->jmlUmur(6, 12)),
				count($this->penduduk->jmlUmur(13, 16)),
				count($this->penduduk->jmlUmur(17, 25)),
				count($this->penduduk->jmlUmur(26, 35)),
				count($this->penduduk->jmlUmur(36, 45)),
				count($this->penduduk->jmlUmur(46, 55)),
				count($this->penduduk->jmlUmur(56, 65)),
				count($this->penduduk->jmlUmurTua(65)),
			);

			// Mengitung jumlah penduduk yang lahir per tahun
			for ($i = 1; $i <= 12; $i++) {
				$lahir[$i - 1] = $this->penduduk->countlahir(date('Y'), $i);
			}
			$data['lahir'] = $lahir;

			// Mengitung jumlah penduduk yang meninggal per tahun
			for ($i = 1; $i <= 12; $i++) {
				$mati[$i - 1] = $this->penduduk->countmati(date('Y'), $i);
			}
			$data['mati'] = $mati;

			$y = date('Y');
			$l = array($y - 4, $y - 3, $y - 2, $y - 1, $y);
			for ($i = 0; $i < 5; $i++) {
				$rubah[$i] = $this->penduduk->tot('penduduk', $l[$i]);
			}
			$data['rubah'] = $rubah;

			$srt = array('SKU', 'SKTM', 'SKM', 'SKPO');
			for ($i = 0; $i < 4; $i++) {
				$mohon[$i] = $this->mohon->count($srt[$i]);
			}
			$data['mohon'] = $mohon;

			for ($i = 1; $i <= 12; $i++) {
				$aduan[$i - 1] = $this->aduan->count(date('Y'), $i);
			}
			$data['aduan'] = $aduan;
			return view('beranda/index', $data);
		} elseif (session()->get('level') == 3) {
			$ket = [
				'My Profile'
			];
			$data = [
				'title' => 'Sistem Informasi Nagari',
				'ket' => $ket,
				'link' => 'home',
				'user' => $this->penduduk->getPenduduk(session()->get('id_datauser')),
				'isi' => $this->user->getUser(session()->id)
			];
			return view('profile/index', $data);
		}
	}
}
