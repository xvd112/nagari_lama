<?php

namespace App\Models;

use CodeIgniter\Model;

class KeluargaModel extends Model
{
    protected $table = 'keluarga';


    public function getKeluarga($id_keluarga = false)
    {
        if ($id_keluarga == false) {
            return $this->orderBy('id_keluarga', 'DESC')->findAll();
        } else {
            return $this->getWhere(['id_keluarga' => $id_keluarga])->getRow();
        }
    }


    public function saveKeluarga($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }


    public function editKeluarga($data, $id_keluarga)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_keluarga', $id_keluarga);
        return $builder->update($data);
    }


    public function hapusKeluarga($id_keluarga)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_keluarga' => $id_keluarga]);
    }


    public function id($input, $field)
    {
        return $this->getWhere([$field => $input])->getRow();
    }


    public function cek($no_kk, $nik_kepala)
    {
        return $this->where(['no_kk' => $no_kk])->where('nik_kepala', $nik_kepala)->get()->getRowArray();
    }
}
