<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelGender extends CI_Model
{
    // Manajemen Kategori
    public function getGender()
    {
        return $this->db->get('gender');
    }
    public function genderWhere($where)
    {
        return $this->db->get_where('gender', $where);
    }
    public function simpanGender($data = null)
    {
        $this->db->insert('gender', $data);
    }
    public function hapusGender($where = null)
    {
        $this->db->delete('gender', $where);
    }
    public function updateGender($data = null, $where = null)
    {
        $this->db->update('gender', $data, $where);
    }
}
