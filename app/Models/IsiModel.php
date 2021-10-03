<?php

namespace App\Models;

use CodeIgniter\Model;

class IsiModel extends Model
{
    public function getIsi($id = false, $tabel)
    {
        if ($id === false) {
            $builder = $this->db->table($tabel);
            return $builder->select('nama')->get()->getResultArray();
        } else {
            $builder = $this->db->table($tabel);
            return $builder->where('id', $id)->get()->getRow();
        }
    }
}
