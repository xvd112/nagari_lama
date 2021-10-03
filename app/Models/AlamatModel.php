<?php

namespace App\Models;

use CodeIgniter\Model;

class AlamatModel extends Model
{
    protected $table = 'alamat';

    public function getAlamat()
    {
        return $this->where('id_alamat', 1)->get()->getRow();
    }

    public function editAlamat($data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_alamat', 1);
        return $builder->update($data);
    }
}
