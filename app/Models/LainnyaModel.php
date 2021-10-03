<?php

namespace App\Models;

use CodeIgniter\Model;

class LainnyaModel extends Model
{
    protected $table = 'lainnya';

    public function getLainnya()
    {
        return $this->getWhere(['id_lainnya' => 1])->getRow();
    }

    public function editLainnya($lainnya)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_lainnya', 1);
        return $builder->update($lainnya);
    }
}
