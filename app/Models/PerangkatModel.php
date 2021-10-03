<?php

namespace App\Models;

use CodeIgniter\Model;

class PerangkatModel extends Model
{
    protected $table = 'pemerintahan';

    // Menampilkan data perangkat nagari
    public function getPerangkat($id_pemerintahan = false, $status)
    {
        if ($id_pemerintahan === false) {
            return $this->where('status', $status)->orderBy('id_pemerintahan', 'DESC')->findAll();
        } else {
            return $this->where(['status' => $status])->getWhere(['id_pemerintahan' => $id_pemerintahan])->getRow();
        }
    }

    // Save data
    public function savePerangkat($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    // Edit data
    public function editPerangkat($data, $id_pemerintahan)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_pemerintahan', $id_pemerintahan);
        return $builder->update($data);
    }

    // Hapus data
    public function hapusPerangkat($id_pemerintahan)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_pemerintahan' => $id_pemerintahan]);
    }

    // Melihat list jabatan taken
    public function jabatan($status, $jabatan)
    {
        return $this->where(['status' => $status])->where('jabatan', $jabatan)->where('tgl_berhenti', NULL)->orLike('tgl_berhenti', '0000-00-00')->findAll();
    }

    // Cek data
    public function cek($status, $jabatan, $tgl_a, $tgl_e)
    {
        return $this->where(['status' => $status])->where('jabatan', $jabatan)->where(['tgl_lantik' => $tgl_a])->where('tgl_berhenti', $tgl_e)->get()->getRowArray();
    }

    // Melihat yang ttd
    public function ttd()
    {
        return $this->where(['status' => 'Perangkat Nagari'])->whereIN('jabatan', ['Wali Nagari', 'Sekretaris Nagari'])->where('tgl_berhenti', NULL)->orLike('tgl_berhenti', '0000-00-00')->findAll();
    }

    // Mencari wali nagari
    public function wali()
    {
        return $this->where(['status' => 'Perangkat Nagari'])->where('jabatan', 'Wali Nagari')->where('tgl_berhenti', NULL)->orLike('tgl_berhenti', '0000-00-00')->get()->getRow();
    }

    public function sejarah()
    {
        return $this->where(['status' => 'Perangkat Nagari'])->where('jabatan', 'Wali Nagari')->orderBy('tgl_lantik', 'ASC')->findAll();
    }

    public function data($status)
    {
        return $this->where(['status' => $status])->where('tgl_berhenti', NULL)->orLike('tgl_berhenti', '0000-00-00')->findAll();
    }
}
