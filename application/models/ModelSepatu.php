<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelSepatu extends CI_Model
{
    // Manajemen sepatu
    public function getMobil()
    {
        return $this->db->get('sepatu');
    }

    public function sepatuWhere($where)
    {
        return $this->db->get_where('sepatu', $where);
    }

    public function simpanSepatu($data = null)
    {
        $this->db->insert('sepatu', $data);
    }

    public function updateSepatu($data = null, $where = null)
    {
        $this->db->update('sepatu', $data, $where);
    }

    public function hapusSepatu($where = null)
    {
        $this->db->delete('sepatu', $where);
    }

    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if (!empty($where) && count($where) > 0) {
            $this->db->where($where);
        }
        $this->db->from('sepatu');
        return $this->db->get()->row($field);
    }
}
