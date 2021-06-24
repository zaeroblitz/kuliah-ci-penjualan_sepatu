<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelKategori extends CI_Model
{
    // Manajemen Kategori
    public function getKategori()
    {
        return $this->db->get('kategori');
    }
    public function kategoriWhere($where)
    {
        return $this->db->get_where('kategori', $where);
    }
    public function simpanKategori($data = null)
    {
        $this->db->insert('kategori', $data);
    }
    public function hapusKategori($where = null)
    {
        $this->db->delete('kategori', $where);
    }
    public function updateKategori($data = null, $where = null)
    {
        $this->db->update('kategori', $data, $where);
    }

    //join
    public function joinKategoriSepatu($where)
    {
        $this->db->select('sepatu.id_kategori,kategori.id_kategori');
        $this->db->from('sepatu');
        $this->db->join('kategori', 'kategori.id_kategori = sepatu.id_kategori');
        $this->db->where($where);
        return $this->db->get();
    }
}
