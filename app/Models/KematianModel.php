<?php

namespace App\Models;

use CodeIgniter\Model;

class KematianModel extends Model
{
    protected $table = 'kematian';

    public function getKematian($id_kematian = false)
    {
        if ($id_kematian === false) {
            return $this->db->table('kematian')
                ->join('penduduk', 'penduduk.id_penduduk = kematian.id_penduduk')
                ->orderBy('id_kematian', 'DESC')
                ->get()->getResultArray();
        } else {
            return $this->db->table('kematian')
                ->join('penduduk', 'penduduk.id_penduduk = kematian.id_penduduk')
                ->getWhere(['id_kematian' => $id_kematian])->getRow();
        }
    }

    // Save data
    public function saveKematian($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    // Edit data
    public function editKematian($data, $id_kematian)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_kematian', $id_kematian);
        return $builder->update($data);
    }

    // Hapus data
    public function hapusKematian($id_kematian)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_kematian' => $id_kematian]);
    }

    // Mencari ID
    public function id($input, $field)
    {
        return $this->getWhere([$field => $input])->getRow();
    }

    // Mencari ID
    public function id_array($input, $field)
    {
        return $this->getWhere([$field => $input])->getResultArray();
    }
}
