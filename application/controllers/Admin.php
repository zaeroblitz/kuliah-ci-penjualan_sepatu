<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    // User Profile
    public function index()
    {
        $data['judul'] = 'Profil Saya';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function ubahProfile()
    {
        $data['judul'] = 'Ubah Profil';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data_nama = $data['user']['nama'];

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/ubah-profile', $data);
            $this->load->view('templates/footer');
            validation_errors();
            $this->session->set_flashdata('nama', '<div class="alert alert-danger alert-message" role="alert">Nama Lengkap Tidak Boleh Kosong</div>');
        } else {
            $nama = $this->input->post('nama', true);
            $email = $this->input->post('email', true);
            $back = $this->input->post('back', true);

            if ($back == 'back') {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-message" role="alert">Data User Tidak Berubah</div>');
                redirect('user');
            } else {
                // Jika ada gambar yang akan diupload
                $upload_image = $_FILES['image']['name'];

                if ($upload_image) {
                    $config['upload_path'] = './assets/img/profile/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    // $config['max_sizes'] = '3000';
                    // $config['max_width'] = '1024';
                    // $config['max_height'] = '1000';
                    $config['file_name'] = 'pro' . time();

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('image')) {
                        $gambar_lama = $data['user']['image'];
                        if ($gambar_lama != 'default.jpg') {
                            unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
                        }

                        $gambar_baru = $this->upload->data('file_name');
                        $this->db->set('image', $gambar_baru);
                    } else {
                    }
                }

                $this->db->set('nama', $nama);
                $this->db->where('email', $email);
                $this->db->update('user');

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Profil Berhasil Diubah</div>');
                redirect('user');
            }
        }
    }
}
