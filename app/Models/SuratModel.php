<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table = 'surat';

    public function getSurat($id_surat = false, $jenis = false)
    {
        if ($id_surat === false) {
            return $this->db->table('surat')
                ->join('penduduk', 'penduduk.id_penduduk = surat.id_penduduk')
                ->where('jenis', $jenis)->orderBy('id_surat', 'DESC')
                ->get()->getResultArray();
        } else {
            return $this->db->table('surat')
                ->join('penduduk', 'penduduk.id_penduduk = surat.id_penduduk')
                ->getWhere(['id_surat' => $id_surat])->getRow();
        }
    }

    public function saveSurat($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editSurat($data, $id_surat)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_surat', $id_surat);
        return $builder->update($data);
    }

    public function hapusSurat($id_surat)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_surat' => $id_surat]);
    }

    public function no($input)
    {
        return $this->select('max(no_surat) as x')->getWhere(['jenis' => $input])->getRow();
    }
}
