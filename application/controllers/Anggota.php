<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends CI_Controller
{
    public function index()
    {
        $data['judul'] = 'Data Anggota';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['anggota'] = $this->ModelUser->getAllUser()->result_array();

        if ($data['user']['role_id'] == 1) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('anggota/anggota', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('autentifikasi/blok');
        }
    }

    public function ubahAnggota()
    {
        $data['judul'] = 'Ubah Anggota';
        $data['anggota'] = $this->ModelUser->getAllUser()->result_array();
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->ModelUser->getRole()->result_array();
        $where = ['id' => $this->uri->segment(3)];
        $data['selectedUser'] = $this->ModelUser->getUserWhere($where)->row_array();

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama tidak boleh kosong'
        ]);

        $this->form_validation->set_rules('role_id', 'Role ID', 'required|numeric', [
            'required' => 'Nama tidak boleh kosong',
            'numeric' => 'Hanya dapat diisi oleh angka'
        ]);

        $this->form_validation->set_rules('is_active', 'Nama Lengkap', 'required|numeric', [
            'required' => 'Nama tidak boleh kosong',
            'numeric' => 'Hanya dapat diisi oleh angka'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('anggota/ubah-anggota', $data);
            $this->load->view('templates/footer');
        } else {
            $dataPost = [
                'nama' => $this->input->post('nama', true),
                'role_id' => $this->input->post('role_id', true),
                'is_active' => $this->input->post('is_active', true)
            ];
            $back = $this->input->post('back', true);
            $similarData =
                $dataPost['nama'] == $data['selectedUser']['nama'] &&
                $dataPost['role_id'] == $data['selectedUser']['role_id'] &&
                $dataPost['is_active'] == $data['selectedUser']['is_active'];

            if ($back == 'back' || $similarData) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-message" role="alert">Data Anggota Tidak Berubah</div>');
                redirect('anggota');
            } else {

                $this->ModelUser->updateUser($dataPost, ['id' => $this->input->post('id', true)]);

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Data Anggota Berhasil Diubah</div>');
                redirect('anggota');
            }
        }
    }

    public function deleteAnggota(){
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelUser->deleteUser($where); 
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Data Anggota Berhasil Dihapus</div>');
        redirect('anggota');
    }
}
