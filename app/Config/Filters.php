<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'       => CSRF::class,
		'toolbar'    => DebugToolbar::class,
		'honeypot' 	 => Honeypot::class,
		'user' => \App\Filters\UserFilter::class,
		'admin' => \App\Filters\AdminFilter::class,
		'perangkat' => \App\Filters\PerangkatFilter::class,
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			// 'honeypot',
			// 'csrf',
			'user' => ['except' =>
			[
				'auth', 'auth/*',		// Login
				'web', 'web/*', '/'		// Web
			]],
			'admin' => ['except' =>
			[
				'auth', 'auth/*',		// Login
				'web', 'web/*', '/'		// Web
			]],
			'perangkat' => ['except' =>
			[
				'auth', 'auth/*',		// Login
				'web', 'web/*', '/'		// Web
			]]
		],
		'after'  => [
			// 'honeypot',
			'toolbar',
			'user' => ['except' =>
			[
				'web', 'web/*', '/',			// Web
				'home', 'home/*',				// Beranda
				'profile', 'profile/*',			// My Profile
				'permohonan', 'permohonan/*',	// Permohonan Surat
				'aduan', 'aduan/*',				// Pojok Aduan
			]],
			'admin' => ['except' => // Wali Nagari
			[
				// Web
				'web', 'web/*', '/',
				// Beranda
				'home', 'home/*',
				// Profile
				'profile', 'profile/*',
				// Pemerintahan Nagari
				'nagari', 'nagari/*',		// Perangkat Nagari
				'bprn', 'bprn/*',			// BPRN
				'kan', 'kan/*',				// KAN
				// Lembaga Nagari
				'bundo', 'bundo/*',			// Bundo Kanduang
				'ulama', 'ulama/*',			// Alim Ulama
				'cadiak', 'cadiak/*',		// Cadiak Pandai
				'pemuda', 'pemuda/*',		// Pemuda
				// Kependudukan
				'keluarga', 'keluarga/*',	// Keluarga
				'penduduk', 'penduduk/*',	// Penduduk
				'lahir', 'lahir/*',			// Kelahiran
				'mati', 'mati/*',			// Kematian
				// Surat
				'sku', 'sku/*',				// SKU
				'sktm', 'sktm/*',			// SKTM
				'skm', 'skm/*',				// SKM
				'skpo', 'skpo/*',			// SKPO
				// List Permohonan Surat
				'permohonan', 'permohonan/index', 'permohonan/edit/*', 'permohonan/surat/*', 'permohonan/update', 'permohonan/view/*', 'permohonan/delete/*',
				// List Aduan Warga
				'aduan', 'aduan/index', 'aduan/edit/*', 'aduan/update', 'aduan/view/*', 'aduan/delete/*',
				// Berita
				'berita', 'berita/*',
				// Data Nagari
				'data', 'data/*',			// Alamat & Info Desa
				'potensi', 'potensi/*',		// Potensi
				'galeri', 'galeri/*',		// Foto Web
				'user', 'user/*',			// Users
			]],
			'perangkat' => ['except' => // Perangkat Nagari
			[
				// Web
				'web', 'web/*', '/',
				// Beranda
				'home', 'home/*',
				// Profile
				'profile', 'profile/*',
				// Pemerintahan Nagari
				'nagari', 'nagari/*',		// Perangkat Nagari
				'bprn', 'bprn/*',			// BPRN
				'kan', 'kan/*',				// KAN
				// Lembaga Nagari
				'bundo', 'bundo/*',			// Bundo Kanduang
				'ulama', 'ulama/*',			// Alim Ulama
				'cadiak', 'cadiak/*',		// Cadiak Pandai
				'pemuda', 'pemuda/*',		// Pemuda
				// Kependudukan
				'keluarga', 'keluarga/*',	// Keluarga
				'penduduk', 'penduduk/*',	// Penduduk
				'lahir', 'lahir/*',			// Kelahiran
				'mati', 'mati/*',			// Kematian
				// Surat
				'sku', 'sku/*',				// SKU
				'sktm', 'sktm/*',			// SKTM
				'skm', 'skm/*',				// SKM
				'skpo', 'skpo/*',			// SKPO
				// List Permohonan Surat
				'permohonan', 'permohonan/index', 'permohonan/edit/*', 'permohonan/surat/*', 'permohonan/update', 'permohonan/view/*', 'permohonan/delete/*',
				// List Aduan Warga
				'aduan', 'aduan/index', 'aduan/edit/*', 'aduan/update', 'aduan/view/*', 'aduan/delete/*',
				// Berita
				'berita', 'berita/*',
				// Data Nagari
				'data', 'data/*',			// Alamat & Info Desa
				'potensi', 'potensi/*',		// Potensi
				'galeri', 'galeri/*',		// Foto Web
			]],
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [];
}
