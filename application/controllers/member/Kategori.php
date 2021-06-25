<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function index()
    {
        $data['judul'] = 'Kategori Sepatu';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->ModelKategori->getKategori()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar-member', $data);
        $this->load->view('templates/topbar-member', $data);
        $this->load->view('kategori/kategori-member', $data);
        $this->load->view('templates/footer');
    }
}
