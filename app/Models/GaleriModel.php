<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table = 'galeri';

    public function getGaleri($id_galeri = false)
    {
        if ($id_galeri === false) {
            return $this->orderBy('id_galeri', 'DESC')->findAll();
        } else {
            return $this->getWhere(['id_galeri' => $id_galeri])->getRow();
        }
    }

    public function saveGaleri($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editGaleri($data, $id_galeri)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_galeri', $id_galeri);
        return $builder->update($data);
    }

    public function hapusGaleri($id_galeri)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_galeri' => $id_galeri]);
    }

    public function gambar($jenis)
    {
        return $this->select('foto as x')->where('jenis', $jenis)->get()->getRow();
    }
}
