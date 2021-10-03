<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table = 'berita';

    public function getBerita($id_berita = false, $limit = false)
    {
        if ($id_berita == false and $limit == false) {
            return $this->orderBy('id_berita', 'DESC')->findAll();
        } elseif ($id_berita != false and $limit == false) {
            return $this->getWhere(['id_berita' => $id_berita])->getRow();
        } elseif ($id_berita == false and $limit != false) {
            return $this->orderBy('id_berita', 'DESC')->limit($limit)->find();
        }
    }

    public function saveBerita($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editBerita($data, $id_berita)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_berita', $id_berita);
        return $builder->update($data);
    }

    public function hapusBerita($id_berita)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_berita' => $id_berita]);
    }

    public function search($input)
    {
        return $this->like('judul', $input)->orLike('penulis', $input)->orLike('tgl_update', $input);
    }
}
