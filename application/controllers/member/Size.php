<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Size extends CI_Controller
{
    public function index()
    {
        $data['judul'] = 'Size Sepatu';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['size'] = $this->ModelSize->getSize()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar-member', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('size/size-member', $data);
        $this->load->view('templates/footer');
    }
}
