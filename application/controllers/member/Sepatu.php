<?php
defined('BASEPATH') or exit('No direct scipt access allowed');

class Sepatu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    public function index()
    {
        $data['judul'] = 'Data sepatu';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['sepatu'] = $this->ModelSepatu->getSepatu()->result_array();
        $data['kategori'] = $this->ModelKategori->getKategori()->result_array();
        $data['gender'] = $this->ModelGender->getGender()->result_array();
        $data['ukuran'] = $this->ModelSize->getSize()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar-member', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('sepatu/sepatu-member', $data);
        $this->load->view('templates/footer');
    }

    public function lihatSepatu()
    {
        $data['judul'] = 'Data sepatu';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['sepatu'] = $this->ModelSepatu->sepatuWhere(['id' => $this->uri->segment(4)])->row_array();
        $data['kategori'] = $this->ModelKategori->joinKategoriSepatu(['sepatu.id' => $this->uri->segment(3)])->row_array();
        $data['kategori'] = $this->ModelKategori->getKategori()->result_array();
        $data['gender'] = $this->ModelGender->getGender()->result_array();
        $data['size'] = $this->ModelSize->getSize()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar-member', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('sepatu/lihat-sepatu', $data);
        $this->load->view('templates/footer');

        $back = $this->input->post('back', true);
        if ($back == 'back') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-message" role="alert">Data sepatu Tidak Berubah</div>');
            redirect('sepatu/index');
        }
    }
}
