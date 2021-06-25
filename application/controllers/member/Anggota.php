<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends CI_Controller
{
    public function index()
    {
        $data['judul'] = 'Data Member';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['anggota'] = $this->ModelUser->getAllUser()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar-member', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('anggota/anggota-member', $data);
        $this->load->view('templates/footer');
    }
}
