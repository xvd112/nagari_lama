<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Nagari extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id_datauser'   => '',
                'foto'          => 'default.svg',
                'email'         => 'putrinabila010501@gmail.com',
                'username'      => 'putri',
                'password'      => '$2y$10$kTylQZUrsjdIQSi5NYcUnOmmEZMJ/HltwxBuppjC2y1T/dqoiXw8C',
                'telp'          => '085265732502',
                'level'         => '1'
            ],
        ];
        $this->db->table('users')->insertBatch($users);

        $galeri = [
            [
                'jenis' => 'Logo Web',
                'foto'  => 'logo-nama.png'
            ],
            [
                'jenis' => 'Logo Icon',
                'foto'  => 'logo.png'
            ],
            [
                'jenis' => 'Bg Home',
                'foto'  => 'rumah_gadang.jpg'
            ],
            [
                'jenis' => 'Bg Sejarah',
                'foto'  => 'sejarah.jpg'
            ],
            [
                'jenis' => 'Bg Visi',
                'foto'  => 'rumah_gadang.jpg'
            ],
            [
                'jenis' => 'Bg Wilayah',
                'foto'  => 'sejarah.jpg'
            ],
            [
                'jenis' => 'Bg Berita',
                'foto'  => 'rumah_gadang.jpg'
            ],
            [
                'jenis' => 'Bg Perangkat',
                'foto'  => 'sejarah.jpg'
            ],
            [
                'jenis' => 'Bg KAN',
                'foto'  => 'rumah_gadang.jpg'
            ],
            [
                'jenis' => 'Bg BPRN',
                'foto'  => 'sejarah.jpg'
            ],
            [
                'jenis' => 'Bg Bundo',
                'foto'  => 'rumah_gadang.jpg'
            ],
            [
                'jenis' => 'Bg Ulama',
                'foto'  => 'sejarah.jpg'
            ],
            [
                'jenis' => 'Bg Cadiak',
                'foto'  => 'rumah_gadang.jpg'
            ],
            [
                'jenis' => 'Bg Pemuda',
                'foto'  => 'sejarah.jpg'
            ],
            [
                'jenis' => 'Bg Kontak',
                'foto'  => 'rumah_gadang.jpg'
            ],
        ];
        $this->db->table('galeri')->insertBatch($galeri);

        $kawin = [
            ['nama' => 'Kawin'],
            ['nama' => 'Belum Kawin'],
            ['nama' => 'Cerai Hidup'],
            ['nama' => 'Cerai Mati'],
        ];
        $this->db->table('status_kawin')->insertBatch($kawin);

        $hub = [
            ['nama' => 'Kepala Keluarga'],
            ['nama' => 'Suami'],
            ['nama' => 'Istri'],
            ['nama' => 'Anak'],
            ['nama' => 'Menantu'],
            ['nama' => 'Cucu'],
            ['nama' => 'Orang Tua'],
            ['nama' => 'Mertua'],
            ['nama' => 'Famili Lain'],
            ['nama' => 'Pembantu'],
            ['nama' => 'Lainnya'],
        ];
        $this->db->table('status_hub')->insertBatch($hub);

        $agama = [
            ['nama' => 'Islam'],
            ['nama' => 'Protestan'],
            ['nama' => 'Katolik'],
            ['nama' => 'Hindu'],
            ['nama' => 'Buddha'],
            ['nama' => 'Khonghucu'],
        ];
        $this->db->table('agama')->insertBatch($agama);

        $pendidikan = [
            ['nama' => 'Tidak/Belum Sekolah'],
            ['nama' => 'Belum Tamat SD/Sederajat'],
            ['nama' => 'SD/Sederajat'],
            ['nama' => 'SLTP/Sederajat'],
            ['nama' => 'SLTA/Sederajat'],
            ['nama' => 'DI/DII'],
            ['nama' => 'DIII/Akademik'],
            ['nama' => 'S1'],
            ['nama' => 'S2'],
            ['nama' => 'S3'],
        ];
        $this->db->table('pendidikan')->insertBatch($pendidikan);

        $pekerjaan = [
            ['nama' => 'Belum/ Tidak Bekerja'],
            ['nama' => 'Mengurus Rumah Tangga'],
            ['nama' => 'Pelajar/ Mahasiswa'],
            ['nama' => 'Pensiunan'],
            ['nama' => 'Pegawai Negeri Sipil'],
            ['nama' => 'Tentara Nasional Indonesia'],
            ['nama' => 'Kepolisian RI'],
            ['nama' => 'Perdagangan'],
            ['nama' => 'Petani/ Pekebun'],
            ['nama' => 'Peternak'],
            ['nama' => 'Nelayan/ Perikanan'],
            ['nama' => 'Industri'],
            ['nama' => 'Konstruksi'],
            ['nama' => 'Transportasi'],
            ['nama' => 'Karyawan Swasta'],
            ['nama' => 'Karyawan BUMN'],
            ['nama' => 'Karyawan BUMD'],
            ['nama' => 'Karyawan Honorer'],
            ['nama' => 'Buruh Harian Lepas'],
            ['nama' => 'Buruh Tani/Perkebunan'],
            ['nama' => 'Buruh Nelayan/Perikanan'],
            ['nama' => 'Buruh Peternakan'],
            ['nama' => 'Pembantu Rumah Tangga'],
            ['nama' => 'Tukang Cukur'],
            ['nama' => 'Tukang Listrik'],
            ['nama' => 'Tukang Batu'],
            ['nama' => 'Tukang Kayu'],
            ['nama' => 'Tukang Sol Sepatu'],
            ['nama' => 'Tukang Las/Pandai Besi'],
            ['nama' => 'Tukang Jahit'],
            ['nama' => 'Tukang Gigi'],
            ['nama' => 'Penata Rias'],
            ['nama' => 'Penata Busana'],
            ['nama' => 'Penata Rambut'],
            ['nama' => 'Mekanik'],
            ['nama' => 'Seniman'],
            ['nama' => 'Tabib'],
            ['nama' => 'Paraji'],
            ['nama' => 'Perancang Busana'],
            ['nama' => 'Penterjemah'],
            ['nama' => 'Imam Masjid'],
            ['nama' => 'Pendeta'],
            ['nama' => 'Pastor'],
            ['nama' => 'Wartawan'],
            ['nama' => 'Ustadz/Mubaligh'],
            ['nama' => 'Juru Masak'],
            ['nama' => 'Promotor Acara'],
            ['nama' => 'Anggota DPR RI'],
            ['nama' => 'Anggota DPD'],
            ['nama' => 'Anggota BPK'],
            ['nama' => 'Presiden'],
            ['nama' => 'Wakil Presiden'],
            ['nama' => 'Anggota Mahkamah Konstitusi'],
            ['nama' => 'Anggota Kabinet/Kementerian'],
            ['nama' => 'Duta Besar'],
            ['nama' => 'Gubernur'],
            ['nama' => 'Wakil Gubenur'],
            ['nama' => 'Bupati'],
            ['nama' => 'Wakil Bupati'],
            ['nama' => 'Walikota'],
            ['nama' => 'Wakil Walikota'],
            ['nama' => 'Anggota DPRD Prvinsi'],
            ['nama' => 'Anggota DPRD Kabupaten/Kota'],
            ['nama' => 'Dosen'],
            ['nama' => 'Guru'],
            ['nama' => 'Guru Honorer'],
            ['nama' => 'Pilot'],
            ['nama' => 'Pengacara'],
            ['nama' => 'Notaris'],
            ['nama' => 'Arsitek'],
            ['nama' => 'Akuntan'],
            ['nama' => 'Konsultan'],
            ['nama' => 'Dokter'],
            ['nama' => 'Bidan'],
            ['nama' => 'Perawat'],
            ['nama' => 'Apoteker'],
            ['nama' => 'Psikiater/Psikolog'],
            ['nama' => 'Penyiar Televisi'],
            ['nama' => 'Penyiar Radio'],
            ['nama' => 'Pelaut'],
            ['nama' => 'Peneliti'],
            ['nama' => 'Sopir'],
            ['nama' => 'Pialang'],
            ['nama' => 'Paranormal'],
            ['nama' => 'Pedagang'],
            ['nama' => 'Perangkat Desa'],
            ['nama' => 'Kepala Desa'],
            ['nama' => 'Biarawati'],
            ['nama' => 'Wiraswasta'],
        ];
        $this->db->table('pekerjaan')->insertBatch($pekerjaan);

        $alamat = [
            [
                'alm'           => 'Jln. Gunuang Rajo Sumpur (Jorong Gunung Rajo Utara)',
                'nagari'        => 'Gunung Rajo',
                'kec'           => 'Batipuh',
                'kab'           => 'Tanah Datar',
                'prov'          => 'Sumatera Barat',
                'kd_pos'        => '27265',
                'map_wilayah'   => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31917.20193372847!2d100.4460903189346!3d-0.5259189755633029!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd528c8732c73f9%3A0xad97379c3828f28f!2sGn.%20Rajo%2C%20Batipuh%2C%20Kabupaten%20Tanah%20Datar%2C%20Sumatera%20Barat!5e0!3m2!1sid!2sid!4v1627545015604!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'map_kantor'    => 'https://goo.gl/maps/8fs79UAkRXE6pxW56',
                'telp'          => '081363196202',
                'email'         => 'putrinabila010501@gmail.com',
                'tgl_update'    => date('Y-m-d')
            ],
        ];
        $this->db->table('alamat')->insertBatch($alamat);

        $data = [
            [
                'nama_wali'     => 'RAMON ZASRA, Amd',
                'visi'          => 'TERWUJUDNYA MASYARAKAT NAGARI GUNUNG RAJO SEJAHTERA DAN BERKEADILAN YANG DI LANDASI FILOSOFI ADAT BASADI SARA’ SARA’ BASANDI KITABULLAH',
                'misi'          => '<ol><li>Meningkatkan pemahaman dan pengalaman agama, adat dan budaya dengan penguatan kelembagaan sosial budaya sesuai dengan filosofi adat basandi sara’ sara’ basandi kitabullah.</li><li>Meningkatkan kualitas sumber daya manusia melalui peningkatan mutu pelayanan pendidikan.</li><li>Meningkatkan mutu pelayanan kesehatan dan pelayanan sosial. </li><li>Meningkatakan aksebilitas dan kualitas sarana dan prasarana serta lingkungan yang medukung pembangunan berkelanjutan. </li><li>Meningkatkan keamanan, kenyamanan dan ketertiban umum melalui penegakan hukum yang konsisten dan berkeadilan.
                </li></ol>',
                'sejarah'       => '<p style="text-align: justify; ">Nagari Gunung Rajo berasal dari kata <i style="font-weight: bold;">Guno Rajo</i>, dimana Nagari Gunung Rajo pernah dikunjungi oleh seorang raja semasa dahulu, dan sesampai rajo itu di Gunung Rajo (sekarang) beliau beristirahat dan duduk di sebuah batu, yang sampai sekarang dinamakan <i style="font-weight: bold;">Batu Rajo</i>, setelah ituterjadi perselisihan antara masyarakat Batipuah dengan masyarakat Gunung Rajo sekarang, maka dijemputlah rajo yang sudah sampai di Batu Rajo tersebut untuk menyelesaikan perselisihan antar masyarakat yang bertikai yang bertempat di <i style="font-weight: bold;">Guguak Suarang</i>. Maka hasil penyelesaian rajo terjadilah <i style="font-weight: bold;">Suruang Baragiah Sarikaik Babalah</i> antara masyarakat yang berselisih. Setelah adanya penyelesaian maka rajo membuat batas berupa parit yang terletak di sebelah barat <i style="font-weight: bold;">Batu Rajo</i>.</p><p style="text-align: justify; ">Dengan hasil penyelesaian masalah tersebut, karena jasa rajo yang menyelesaikan masalah di atas maka daerah tersebut diberi nama <i style="font-weight: bold;">Guno Rajo</i>. Berdasarkan kesepakatan niniak mamak semasa itu mengingat besarnya jasa rajo, mak akata guno rajo dirubah menjadi <i style="font-weight: bold;">Gunuang Rajo</i>. Kata gunuang tersebut diambil dari besarnya jasa rajo dalam menyelesaikan perselisihan di atas.</p>',
                'wilayah'       => '<p><span style="font-weight: bolder;">Luas Wilayah :</span>&nbsp;512 Ha</p><p><span style="font-weight: bolder;">Jumlah Jorong ada dua, yaitu :</span></p><ol><li>Jorong Gunuang Rajo Utara</li><li>Jorong Gantiang</li></ol><p><span style="font-weight: bolder;">Batas Wilayah :</span></p><ul><li>Utara : Pitalah</li><li>Selatan : Batipuah Baruah</li><li>Barat : Batipuah Baruah</li><li>Timur : Bungo Tanjuang</li></ul><p><span style="font-weight: bolder;">Hidrologi :</span>&nbsp;Irigasi berpengairan teknik</p><p><span style="font-weight: bolder;">Klimatologi :</span></p><ol><li>Suhu : 33 C</li><li>Curah Hujan : 1200 mm</li><li>Tinggi tempat : 00 MDL</li><li>Bentang Wilayah : Berbukit</li></ol><p><span style="font-weight: bolder;">Luas Lahan Pertanian :</span></p><ul><li>Sawah : 170 Ha</li><li>Perkebunan : 175 Ha</li></ul><p><span style="font-weight: bolder;">Luas Lahan Pemukiman :&nbsp;</span>167 Ha</p>',
                'syarat_surat'  => '<p><b>SKU :</b></p><p>1. Scan KTP</p><p>2. Scan KK</p><p><b>SKTM & SKPO :</b></p><p>1. Scan KTP</p><p>2. Scan KK</p><p><b>SKM :</b></p><p>1. Scan KTP</p><p>2. Scan KK</p><p>3. Scan Jamkesmas</p>',
                'logo'          => 'logo.png',
                'kata_sambutan' => '<p>Kata Sambutan</p>',
                'tgl_update'    => date('Y-m-d')
            ],
        ];
        $this->db->table('data')->insertBatch($data);
    }
}
