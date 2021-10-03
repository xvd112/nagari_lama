<?php

namespace App\Models;

use CodeIgniter\Model;

class PendudukModel extends Model
{
    protected $table = 'penduduk';

    public function getPenduduk($id_penduduk = false)
    {
        if ($id_penduduk === false) {
            return $this->db->table('penduduk')
                ->join('keluarga', 'keluarga.id_keluarga = penduduk.id_keluarga')
                ->orderBy('id_penduduk', 'DESC')
                ->get()->getResultArray();
        } else {
            return $this->db->table('penduduk')
                ->join('keluarga', 'keluarga.id_keluarga = penduduk.id_keluarga')
                ->getWhere(['id_penduduk' => $id_penduduk])->getRow();
        }
    }

    public function lahir($id_penduduk = false)
    {
        if ($id_penduduk === false) {
            return $this->db->table('penduduk')
                ->join('keluarga', 'keluarga.id_keluarga = penduduk.id_keluarga')
                ->where('nik', NULL)
                ->orderBy('id_penduduk', 'DESC')
                ->get()->getResultArray();
        } else {
            return $this->db->table('penduduk')
                ->join('keluarga', 'keluarga.id_keluarga = penduduk.id_keluarga')
                ->getWhere(['id_penduduk' => $id_penduduk])->getRow();
        }
    }

    public function cari($input)
    {
        return $this->where('nik', $input)->findAll();
    }

    public function savePenduduk($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editPenduduk($data, $id_penduduk)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_penduduk', $id_penduduk);
        return $builder->update($data);
    }

    public function hapusPenduduk($id_penduduk)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_penduduk' => $id_penduduk]);
    }

    public function id($input, $field)
    {
        return $this->getWhere([$field => $input])->getRow();
    }

    public function id_array($input, $field)
    {
        return $this->getWhere([$field => $input])->getResultArray();
    }

    public function mati($input, $field, $ket)
    {
        return $this->where($field, $input)->like('ket', 'Hidup')->get()->getResultArray();
    }

    public function search($input)
    {
        return $this->like('nik', $input)->orLike('no_kk', $input)->orLike('nama', $input);
    }

    public function jml($input, $field)
    {
        return $this->select('count(id_keluarga) as x')->getWhere([$field => $input])->getRow();
    }

    public function tot($tabel, $tahun = false, $bulan = false, $jorong = false)
    {
        if ($tahun === false and $bulan === false and $jorong === false) {
            return $this->db->table($tabel)->countAllResults();
        } elseif ($tahun != false and $bulan != false and $jorong === false) {
            return $this->db->table($tabel)->where('year(tgl_update) <= ', $tahun)->where('month(tgl_update) <= ', $bulan)->countAllResults();
        } elseif ($tahun === false and $bulan === false and $jorong != false) {
            return $this->db->table($tabel)
                ->join('keluarga', 'keluarga.id_keluarga = penduduk.id_keluarga')
                ->where('keluarga.alamat', $jorong)->countAllResults();
        } elseif ($tahun != false and $bulan === false and $jorong === false) {
            return $this->db->table($tabel)->where('year(tgl_update) <= ', $tahun)->countAllResults();
        } elseif ($tahun != false and $bulan === false and $jorong != false) {
            return $this->db->table($tabel)
                ->join('keluarga', 'keluarga.id_keluarga = penduduk.id_keluarga')
                ->where('year(penduduk.tgl_update) <= ', $tahun)
                ->where('keluarga.alamat', $jorong)
                ->countAllResults();
        } else {
            return $this->db->table($tabel)
                ->join('keluarga', 'keluarga.id_keluarga = penduduk.id_keluarga')
                ->where('year(penduduk.tgl_update) <= ', $tahun)->where('month(penduduk.tgl_update) <= ', $bulan)->where('keluarga.alamat', $jorong)->countAllResults();
        }
    }

    public function totjekel($tabel, $jekel, $tahun = false, $bulan = false, $jorong = false)
    {
        if ($tahun === false and $bulan === false and $jorong === false) {
            return $this->db->table($tabel)->where('jekel', $jekel)->countAllResults();
        } elseif ($tahun != false and $bulan != false and $jorong === false) {
            return $this->db->table('penduduk')->where('jekel', $jekel)->where('year(tgl_update) <=', $tahun)->where('month(tgl_update) <= ', $bulan)->countAllResults();
        } elseif ($tahun === false and $bulan === false and $jorong != false) {
            return $this->db->table('penduduk')
                ->join('keluarga', 'keluarga.id_keluarga = penduduk.id_keluarga')
                ->where('jekel', $jekel)->where('keluarga.alamat', $jorong)->countAllResults();
        } else {
            return $this->db->table('penduduk')
                ->join('keluarga', 'keluarga.id_keluarga = penduduk.id_keluarga')
                ->where('jekel', $jekel)->where('year(penduduk.tgl_update) <=', $tahun)->where('month(penduduk.tgl_update) <= ', $bulan)->where('keluarga.alamat', $jorong)->countAllResults();
        }
    }

    public function umur($a)
    {
        $query = $this->db->query("select TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) as x from penduduk where id_penduduk = " . $a);
        return $query->getResultArray();
    }

    public function jmlUmur($a, $e)
    {
        $query = $this->db->query("select TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) as x from penduduk where TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) between " . $a . " and " . $e);
        return $query->getResultArray();
    }

    public function jmlUmurTua()
    {
        $query = $this->db->query("select TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) as x from penduduk where TIMESTAMPDIFF(YEAR, tgl_lahir, CURDATE()) > 65");
        return $query->getResultArray();
    }

    public function countlahir($year, $bulan)
    {
        return $this->db->table('penduduk')->where('nik', NULL)->where("year(tgl_lahir)", $year)->where("month(tgl_lahir)", $bulan)->countAllResults();
    }

    public function countmati($year, $bulan)
    {
        return $this->db->table('kematian')->where("year(tgl_kematian)", $year)->where("month(tgl_kematian)", $bulan)->countAllResults();
    }

    public function count($x, $isi)
    {
        return $this->db->table('penduduk')->where($x, $isi)->countAllResults();
    }
}
