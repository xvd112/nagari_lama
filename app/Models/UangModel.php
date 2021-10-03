<?php

namespace App\Models;

use CodeIgniter\Model;

class UangModel extends Model
{
    protected $table = 'uang';

    public function getUang($id_uang = false)
    {
        if ($id_uang === false) {
            return $this->orderBy('id_uang', 'DESC')->findAll();
        } else {
            return $this->getWhere(['id_uang' => $id_uang])->getRow();
        }
    }

    public function saveUang($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editUang($data, $id_uang)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_uang', $id_uang);
        return $builder->update($data);
    }

    public function hapusUang($id_uang)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_uang' => $id_uang]);
    }

    // Mencari ID
    public function id($input, $field)
    {
        return $this->getWhere([$field => $input])->getRow();
    }
}
