<?php

namespace App\Models;

use CodeIgniter\Model;

class PotensiModel extends Model
{
    protected $table = 'potensi';

    public function getPotensi($id_potensi = false)
    {
        if ($id_potensi === false) {
            return $this->orderBy('id_potensi', 'DESC')->findAll();
        } else {
            return $this->getWhere(['id_potensi' => $id_potensi])->getRow();
        }
    }

    public function savePotensi($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editPotensi($data, $id_potensi)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_potensi', $id_potensi);
        return $builder->update($data);
    }

    public function hapusPotensi($id_potensi)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_potensi' => $id_potensi]);
    }
}
