<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Size extends CI_Controller
{
    public function showOrAddSize()
    {
        $data['judul'] = 'Size Sepatu';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['size'] = $this->ModelSize->getSize()->result_array();

        if ($data['user']['role_id'] == 1) {
            $this->form_validation->set_rules('uk', 'UK Size', 'required', [
                'required' => 'UK Size Harus Diisi'
            ]);

            $this->form_validation->set_rules('us', 'US Size', 'required', [
                'required' => 'UK Size Harus Diisi'
            ]);

            $this->form_validation->set_rules('eu', 'EU Size', 'required', [
                'required' => 'EU Size Harus Diisi'
            ]);

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('size/size', $data);
                $this->load->view('templates/footer');
            } else {
                $data = [
                    'UK' => $this->input->post('uk'),
                    'US' => $this->input->post('us'),
                    'EU' => $this->input->post('eu'),
                ];

                $this->ModelSize->simpanSize($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Data Ukuran Sepatu Berhasil Ditambah</div>');
                redirect('size/showOrAddSize');
            }
        } else {
            redirect('autentifikasi/blok');
        }
    }

    public function ubahSize()
    {
        $data['judul'] = 'Ubah Size';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $where = ['id' => $this->uri->segment(3)];
        $data['size'] = $this->ModelSize->sizeWhere($where)->row_array();

        $this->form_validation->set_rules('uk', 'UK Size', 'required', [
            'required' => 'UK Size Harus Diisi'
        ]);

        $this->form_validation->set_rules('us', 'US Size', 'required', [
            'required' => 'UK Size Harus Diisi'
        ]);

        $this->form_validation->set_rules('eu', 'EU Size', 'required', [
            'required' => 'EU Size Harus Diisi'
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
            $dataPost = [
                'UK' => $this->input->post('uk'),
                'US' => $this->input->post('us'),
                'EU' => $this->input->post('eu'),
            ];
            $id = $this->input->post('id', true);
            $back = $this->input->post('back', true);

            if ($back == 'back') {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-message" role="alert">Nama Size Tidak Berubah</div>');
                redirect('size/showOrAddSize');
            } else {
                $this->ModelSize->updateSize($dataPost, ['id' => $this->input->post('id', true)]);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Nama Size Berhasil Diubah</div>');
                redirect('size/showOrAddSize');
            }
        }
    }

    public function hapusSize()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelSize->hapusSize($where);
        redirect('size/showOrAddSize');
    }
}
