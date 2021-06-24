<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Size extends CI_Controller
{
    public function showOrAddSize()
    {
        $data['judul'] = 'Size Sepatu';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['size'] = $this->ModelSize->getSize()->result_array();

        $this->form_validation->set_rules('size', 'Size', 'required', [
            'required' => 'Nama Size Harus Diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('size/size', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_size' => $this->input->post('size')
            ];

            $this->ModelSize->simpanSize($data);
            redirect('size/showOrAddSize');
        }
    }

    public function ubahSize()
    {
        $data['judul'] = 'Ubah Size';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $where = ['id_size' => $this->uri->segment(3)];
        $data['size'] = $this->ModelSize->sizeWhere($where)->row_array();
        $nama_size = $data['size']['nama_size'];

        $this->form_validation->set_rules('size', 'Nama Size', 'required|trim', [
            'required' => 'Nama Size tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('size/ubah-size', $data);
            $this->load->view('templates/footer');
            validation_errors();
            $this->session->set_flashdata('size_error', '<div class="alert alert-danger alert-message" role="alert">Nama Size Tidak Boleh Kosong</div>');
        } else {
            $size = $this->input->post('size', true);
            $id = $this->input->post('id', true);
            $back = $this->input->post('back', true);

            if ($back == 'back' || $size == $nama_size) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-message" role="alert">Nama Size Tidak Berubah</div>');
                redirect('size/showOrAddSize');
            } else {
                $this->db->set('nama_size', $size);
                $this->db->where('id_size', $id);
                $this->db->update('size');

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Nama Size Berhasil Diubah</div>');
                redirect('size/showOrAddSize');
            }
        }
    }

    public function hapusSize()
    {
        $where = ['id_size' => $this->uri->segment(3)];
        $this->ModelSize->hapusSize($where);
        redirect('size/showOrAddSize');
    }
}
