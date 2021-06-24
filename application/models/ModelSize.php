<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelSize extends CI_Model
{
    // Manajemen Kategori
    public function getSize()
    {
        return $this->db->get('size');
    }
    public function sizeWhere($where)
    {
        return $this->db->get_where('size', $where);
    }
    public function simpanSize($data = null)
    {
        $this->db->insert('size', $data);
    }
    public function hapusSize($where = null)
    {
        $this->db->delete('size', $where);
    }
    public function updateSize($data = null, $where = null)
    {
        $this->db->update('size', $data, $where);
    }
}
