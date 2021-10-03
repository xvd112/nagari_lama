<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Nagari extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_keluarga'	=> [
				'type'           => 'INT',
				'auto_increment' => true,
			],
			'no_kk'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '16'
			],
			'nik_kepala'	=> [
				'type'           => 'VARCHAR',
				'constraint'     => '16'
			],
			'alamat'		=> [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
			'tgl_update'	=> [
				'type'           => 'DATE',
			],
		]);

		$this->forge->addKey('id_keluarga', TRUE);
		$this->forge->addUniqueKey('no_kk');
		$this->forge->addUniqueKey('nik_kepala');
		$this->forge->createTable('keluarga', TRUE);

		$this->forge->addField([
			'id_penduduk'	=> [
				'type'           => 'INT',
				'auto_increment' => true
			],
			'id_keluarga'	=> [
				'type'           => 'INT'
			],
			'nik'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '16',
				'null'			 => true
			],
			'nama'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'tpt_lahir'		=> [
				'type'           => 'VARCHAR',
				'constraint'     => '25'
			],
			'tgl_lahir'		=> [
				'type'           => 'DATE',
			],
			'jekel'			=> [
				'type'           => 'ENUM',
				'constraint'     => ['Laki - Laki', 'Perempuan']
			],
			'agama'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '25'
			],
			'kerja'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
			'kwn'			=> [
				'type'           => 'ENUM',
				'constraint'     => ['WNI', 'WNA']
			],
			'goldar'		=> [
				'type'           => 'VARCHAR',
				'constraint'     => '3',
				'default'		 => '-'
			],
			'foto'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'default'		 => 'default.jpg'
			],
			'status_kawin'	=> [
				'type'           => 'VARCHAR',
				'constraint'     => '20',
				'default'		 => 'Belum Kawin'
			],
			'status_hub'	=> [
				'type'           => 'VARCHAR',
				'constraint'     => '20',
				'default'		 => 'Anak'
			],
			'pendidikan'    => [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
				'default'		 => 'Tidak/Belum Sekolah'
			],
			'nm_ayah'   	=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'nik_ayah'   	=> [
				'type'           => 'VARCHAR',
				'constraint'     => '16',
				'null'			 => true
			],
			'nm_ibu'   		=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'nik_ibu'   	=> [
				'type'           => 'VARCHAR',
				'constraint'     => '16',
				'null'			 => true
			],
			'paspor'   		=> [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
				'null'			 => true
			],
			'kitap'   		=> [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
				'null'			 => true
			],
			'ket'   		=> [
				'type'           => 'ENUM',
				'constraint'     => ['Hidup', 'Wafat'],
				'default'		 => 'Hidup'
			],
			'tgl_update'	=> [
				'type'           => 'DATE',
			],
		]);

		$this->forge->addKey('id_penduduk', TRUE);
		$this->forge->addUniqueKey('nik');
		$this->forge->addForeignKey('id_keluarga', 'keluarga', 'id_keluarga', 'CASCADE', 'CASCADE');
		$this->forge->createTable('penduduk', TRUE);

		$this->forge->addField([
			'id_kematian'	=> [
				'type'           => 'INT',
				'auto_increment' => true,
			],
			'id_penduduk'	=> [
				'type'           => 'INT'
			],
			'sebab'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'tpt_kematian'	=> [
				'type'           => 'VARCHAR',
				'constraint'     => '25'
			],
			'tgl_kematian'	=> [
				'type'           => 'DATE',
			],
			'tgl_update'	=> [
				'type'           => 'DATE'
			],
		]);
		$this->forge->addKey('id_kematian', TRUE);
		$this->forge->addForeignKey('id_penduduk', 'penduduk', 'id_penduduk', 'CASCADE', 'CASCADE');
		$this->forge->createTable('kematian', TRUE);

		$this->forge->addField([
			'id_permohonan'	=> [
				'type'           => 'INT',
				'auto_increment' => true,
			],
			'id_penduduk'	=> [
				'type'           => 'INT'
			],
			'id_user'		=> [
				'type'           => 'INT'
			],
			'jenis'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '5'
			],
			'tujuan'		=> [
				'type'           => 'TEXT'
			],
			'tambahan'		=> [
				'type'           => 'TEXT'
			],
			'scan_ktp'		=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'scan_kk'		=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'scan_jamkes'		=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'	         => true
			],
			'tgl_masuk'		=> [
				'type'           => 'DATE'
			],
			'tgl_periksa'	=> [
				'type'           => 'DATE',
				'null'	         => true
			],
			'hasil'		=> [
				'type'           => 'TEXT',
				'null'	         => true
			],
			'ket'		=> [
				'type'           => 'ENUM',
				'constraint'     => ['Belum Diperiksa', 'Disetujui', 'Ditolak'],
				'default'	     => 'Belum Diperiksa'
			],
		]);
		$this->forge->addKey('id_permohonan', TRUE);
		$this->forge->addForeignKey('id_penduduk', 'penduduk', 'id_penduduk', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE');
		$this->forge->createTable('permohonan', TRUE);

		$this->forge->addField([
			'id_surat'			=> [
				'type'           => 'INT',
				'auto_increment' => true,
			],
			'no_surat'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
			'id_penduduk'		=> [
				'type'           => 'INT'
			],
			'id_pemerintahan'	=> [
				'type'           => 'INT'
			],
			'tgl_surat'			=> [
				'type'           => 'DATE'
			],
			'jenis'				=> [
				'type'           => 'VARCHAR',
				'constraint'     => '5'
			],
			'tujuan'		=> [
				'type'           => 'TEXT'
			],
			'tambahan'		=> [
				'type'           => 'TEXT'
			],
		]);
		$this->forge->addKey('id_surat', TRUE);
		$this->forge->addForeignKey('id_penduduk', 'penduduk', 'id_penduduk', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('id_pemerintahan', 'pemerintahan', 'id_pemerintahan', 'CASCADE', 'CASCADE');
		$this->forge->createTable('surat', TRUE);


		$this->forge->addField([
			'id_pemerintahan'	=> [
				'type'           => 'INT',
				'auto_increment' => true,
			],
			'no'				=> [
				'type'           => 'VARCHAR',
				'constraint'     => '50',
			],
			'nik'				=> [
				'type'           => 'VARCHAR',
				'constraint'     => '16',
				'null'			 => true
			],
			'nama'				=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'jabatan'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
			'status'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '25'
			],
			'telp'				=> [
				'type'           => 'VARCHAR',
				'constraint'     => '20',
				'null'			 => true
			],
			'jekel'				=> [
				'type'           => 'ENUM',
				'constraint'     => ['Laki - Laki', 'Perempuan']
			],
			'foto'				=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'default'		 => 'default.jpg'
			],
			'tgl_lantik'		=> [
				'type'           => 'DATE',

			],
			'tgl_berhenti'		=> [
				'type'           => 'DATE',
				'null'			 => true
			],
			'ket'				=> [
				'type'           => 'ENUM',
				'constraint'     => ['Menjabat', 'Berhenti'],
				'default'		 => 'Menjabat'
			],
			'tgl_update'		=> [
				'type'           => 'DATE'
			],
		]);
		$this->forge->addKey('id_pemerintahan', TRUE);
		$this->forge->createTable('pemerintahan', TRUE);

		$this->forge->addField([
			'id_berita'		=> [
				'type'           => 'INT',
				'auto_increment' => true,
			],
			'judul'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'penulis'		=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'gambar'		=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'			 => true
			],
			'isi'			=> [
				'type'           => 'TEXT',
			],
			'tgl_update'	=> [
				'type'           => 'DATE'
			],
		]);
		$this->forge->addKey('id_berita', TRUE);
		$this->forge->createTable('berita', TRUE);

		$this->forge->addField([
			'id_potensi'	=> [
				'type'           => 'INT',
				'auto_increment' => true,
			],
			'nama'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'foto'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'			 => true
			],
			'ket'			=> [
				'type'           => 'TEXT',
			],
			'tgl_update'	=> [
				'type'           => 'DATE'
			],
		]);
		$this->forge->addKey('id_potensi', TRUE);
		$this->forge->createTable('potensi', TRUE);

		$this->forge->addField([
			'id_data'		=> [
				'type'           => 'INT',
				'auto_increment' => true,
			],
			'nama_wali'		=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'visi'			=> [
				'type'           => 'TEXT',
				'null'			 => true
			],
			'misi'			=> [
				'type'           => 'TEXT',
				'null'			 => true
			],
			'sejarah'		=> [
				'type'           => 'TEXT',
				'null'			 => true
			],
			'wilayah'		=> [
				'type'           => 'TEXT',
				'null'			 => true
			],
			'logo'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'kata_sambutan'	=> [
				'type'           => 'TEXT',
				'null'			 => true
			],
			'tgl_update'	=> [
				'type'           => 'DATE'
			],
		]);
		$this->forge->addKey('id_data', TRUE);
		$this->forge->createTable('data', TRUE);

		$this->forge->addField([
			'id_alamat'		=> [
				'type'           => 'INT',
				'auto_increment' => true,
			],
			'alm'			=> [
				'type'           => 'TEXT'
			],
			'nagari'		=> [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
			'kec'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
			'kab'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
			'prov'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
			'kd_pos'		=> [
				'type'           => 'VARCHAR',
				'constraint'     => '10',
				'null'			 => true
			],
			'map_wilayah'	=> [
				'type'           => 'TEXT',
				'null'			 => true
			],
			'map_kantor'	=> [
				'type'           => 'TEXT',
				'null'			 => true
			],
			'telp'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '20',
				'null'			 => true
			],
			'email'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'			 => true
			],
			'tgl_update'	=> [
				'type'           => 'DATE'
			],
		]);
		$this->forge->addKey('id_alamat', TRUE);
		$this->forge->createTable('alamat', TRUE);

		$this->forge->addField([
			'id_agama'		=> [
				'type'           => 'INT',
				'auto_increment' => true,
			],
			'nama'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '25'
			],
		]);
		$this->forge->addKey('id_agama', TRUE);
		$this->forge->createTable('agama', TRUE);

		$this->forge->addField([
			'id_pendidikan'		=> [
				'type'           => 'INT',
				'auto_increment' => true,
			],
			'nama'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
		]);
		$this->forge->addKey('id_pendidikan', TRUE);
		$this->forge->createTable('pendidikan', TRUE);

		$this->forge->addField([
			'id_pekerjaan'		=> [
				'type'           => 'INT',
				'auto_increment' => true,
			],
			'nama'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
		]);
		$this->forge->addKey('id_pekerjaan', TRUE);
		$this->forge->createTable('pekerjaan', TRUE);

		$this->forge->addField([
			'id_kawin'		=> [
				'type'           => 'INT',
				'auto_increment' => true,
			],
			'nama'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '20'
			],
		]);
		$this->forge->addKey('id_kawin', TRUE);
		$this->forge->createTable('status_kawin', TRUE);

		$this->forge->addField([
			'id_hub'		=> [
				'type'           => 'INT',
				'auto_increment' => true,
			],
			'nama'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '20'
			],
		]);
		$this->forge->addKey('id_hub', TRUE);
		$this->forge->createTable('status_hub', TRUE);

		$this->forge->addField([
			'id_galeri'		=> [
				'type'           => 'INT',
				'auto_increment' => true,
			],
			'jenis'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'foto'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
		]);
		$this->forge->addKey('id_galeri', TRUE);
		$this->forge->createTable('galeri', TRUE);

		$this->forge->addField([
			'id_aduan'		=> [
				'type'           => 'INT',
				'auto_increment' => true
			],
			'id_user'		=> [
				'type'           => 'INT'
			],
			'tgl_aduan'			=> [
				'type'           => 'DATE'
			],
			'tgl_respon'	=> [
				'type'           => 'DATE',
				'null'			 => true
			],
			'aduan'			=> [
				'type'           => 'TEXT'
			],
			'respon'	=> [
				'type'           => 'DATE',
				'null'			 => true
			],
			'ket'				=> [
				'type'           => 'ENUM',
				'constraint'     => ['Belum Diproses', 'Selesai'],
				'default'		 => 'Belum Diproses'
			],
		]);
		$this->forge->addKey('id_aduan', TRUE);
		$this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE');
		$this->forge->createTable('aduan', TRUE);

		$this->forge->addField([
			'id'		=> [
				'type'           => 'INT',
				'auto_increment' => true
			],
			'id_datauser'		=> [
				'type'           => 'INT',
				'null'			 => true
			],
			'foto'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'default'		 => 'default.svg'
			],
			'email'			=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'			 => true
			],
			'username'		=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'password'		=> [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'telp'		=> [
				'type'           => 'VARCHAR',
				'constraint'     => '20',
				'null'			 => true
			],
			'level'		=> [
				'type'           => 'INT'
			],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('users', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('keluarga');
		$this->forge->dropTable('penduduk');
		$this->forge->dropTable('kematian');
		$this->forge->dropTable('permohonan'); //
		$this->forge->dropTable('surat'); //
		$this->forge->dropTable('pemerintahan');
		$this->forge->dropTable('berita');
		$this->forge->dropTable('potensi');
		$this->forge->dropTable('data');
		$this->forge->dropTable('alamat');
		$this->forge->dropTable('agama');
		$this->forge->dropTable('pendidikan');
		$this->forge->dropTable('pekerjaan');
		$this->forge->dropTable('status_kawin');
		$this->forge->dropTable('status_hub');
		$this->forge->dropTable('galeri');
		$this->forge->dropTable('aduan');
		$this->forge->dropTable('users');
	}
}
