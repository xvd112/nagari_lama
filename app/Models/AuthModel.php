<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'users';

    public function getUser($id = false, $level = false)
    {
        if ($id == false and $level != false) {
            return $this->where('level', $level)->orderBy('id', 'DESC')->findAll();
        } elseif ($id != false and $level != false) {
            return $this->where('level', $level)->getWhere(['id' => $id])->getRow();
        } else {
            return $this->getWhere(['id' => $id])->getRow();
        }
    }

    public function saveUser($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editUser($data, $id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id', $id);
        return $builder->update($data);
    }

    public function hapusUser($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id' => $id]);
    }

    public function login($x, $log)
    {
        return $this->where($x, $log)->get()->getRowArray();
    }
}
