<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model
{
    protected $table = 'data';

    public function getData()
    {
        return $this->where('id_data', 1)->get()->getRow();
    }

    public function editData($data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_data', 1);
        return $builder->update($data);
    }
}
