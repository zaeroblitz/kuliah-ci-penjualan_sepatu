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

        if ($data['user']['role_id'] == 1) {
            $this->formValidasi();

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('sepatu/index', $data);
                $this->load->view('templates/footer');
            } else {

                // Jika ada gambar yang akan diupload
                $upload_image = $_FILES['picture']['name'];

                if ($upload_image) {

                    // Konfigurasi sebelum gambar diupload
                    $config['upload_path'] = './assets/img/upload/';
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $config['file_name'] = 'img' . time();

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('picture')) {
                        $image = $this->upload->data('file_name');
                    } else {
                        $image = 'default.png';
                    }
                } else {
                }

                $dataPost = [
                    'kode_sepatu' => $this->input->post('kode_sepatu', true),
                    'nama_sepatu' => $this->input->post('nama_sepatu', true),
                    'id_kategori' => $this->input->post('id_kategori', true),
                    'merek' => $this->input->post('merek', true),
                    'warna' => $this->input->post('warna', true),
                    'for_gender' => $this->input->post('gender', true),
                    'size_available' => json_encode(implode(',', $this->input->post('size', true))),
                    'harga' => $this->input->post('harga', true),
                    'stok' => $this->input->post('stok', true),
                    'terjual' => $this->input->post('sold', true),
                    'deskripsi' => $this->input->post('deskripsi', true),
                    'picture' => $image,
                ];

                $this->ModelSepatu->simpanSepatu($dataPost);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Data Berhasil Ditambahkan</div>');
                redirect('sepatu');
            }
        } else {
            redirect('autentifikasi/blok');
        }
    }

    public function ubahSepatu()
    {
        $data['judul'] = 'Ubah Data sepatu';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['sepatu'] = $this->ModelSepatu->sepatuWhere(['id' => $this->uri->segment(3)])->row_array();
        $data['kategori'] = $this->ModelKategori->joinKategoriSepatu(['sepatu.id' => $this->uri->segment(3)])->row_array();
        $data['kategori'] = $this->ModelKategori->getKategori()->result_array();
        $data['gender'] = $this->ModelGender->getGender()->result_array();
        $data['size'] = $this->ModelSize->getSize()->result_array();

        $this->formValidasi();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('sepatu/ubah-sepatu', $data);
            $this->load->view('templates/footer');
        } else {

            $dataPost = [
                'kode_sepatu' => $this->input->post('kode_sepatu', true),
                'nama_sepatu' => $this->input->post('nama_sepatu', true),
                'id_kategori' => $this->input->post('id_kategori', true),
                'merek' => $this->input->post('merek', true),
                'warna' => $this->input->post('warna', true),
                'for_gender' => $this->input->post('gender', true),
                'size_available' => json_encode(implode(',', $this->input->post('size', true))),
                'harga' => $this->input->post('harga', true),
                'stok' => $this->input->post('stok', true),
                'terjual' => $this->input->post('sold', true),
                'deskripsi' => $this->input->post('deskripsi', true),
            ];

            $back = $this->input->post('back', true);

            $similarDataPost =
                $dataPost['kode_sepatu'] == $data['sepatu']['kode_sepatu'] &&
                $dataPost['nama_sepatu'] == $data['sepatu']['nama_sepatu'] &&
                $dataPost['id_kategori'] == $data['sepatu']['id_kategori'] &&
                $dataPost['merek'] == $data['sepatu']['merek'] &&
                $dataPost['warna'] == $data['sepatu']['warna'] &&
                $dataPost['for_genre'] == $data['sepatu']['for_genre'] &&
                $dataPost['size_available'] == $data['sepatu']['size_available'] &&
                $dataPost['harga'] == $data['sepatu']['harga'] &&
                $dataPost['stok'] == $data['sepatu']['stok'] &&
                $dataPost['terjual'] == $data['sepatu']['terjual'] &&
                $dataPost['deskripsi'] == $data['sepatu']['deskripsi'];

            if ($back == 'back' || $similarDataPost) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-message" role="alert">Data sepatu Tidak Berubah</div>');
                redirect('sepatu/index');
            } else {
                // Jika ada gambar yang akan diupload
                $upload_image = $_FILES['picture']['name'];

                if ($upload_image) {

                    // Konfigurasi sebelum gambar diupload
                    $config['upload_path'] = './assets/img/upload/';
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $config['file_name'] = 'img' . time();

                    // Membuat atau memanggil library upload
                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('picture')) {
                        $gambar_lama = $data['sepatu']['picture'];
                        if ($gambar_lama != 'default.png') {
                            unlink(FCPATH . 'assets/img/upload/' . $gambar_lama);
                        }

                        $gambar_baru = $this->upload->data('file_name');
                        $this->db->set('picture', $gambar_baru);
                    } else {
                    }
                }

                $this->ModelSepatu->updateSepatu($dataPost, ['id' => $this->input->post('id')]);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Data Berhasil Diubah</div>');
                redirect('sepatu');
            }
        }
    }

    public function hapusSepatu()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelSepatu->hapusSepatu($where);
        redirect('sepatu');
    }

    public function formValidasi()
    {
        // Validasi Kode Sepatu
        $this->form_validation->set_rules('kode_sepatu', 'Kode sepatu', 'required|min_length[3]', [
            'required' => 'Kode sepatu harus diisi',
            'min_length' => 'Kode sepatu terlalu pendek',
        ]);

        // Validasi Nama Sepatu
        $this->form_validation->set_rules('nama_sepatu', 'Nama sepatu', 'required|min_length[3]', [
            'required' => 'Nama sepatu harus diisi',
            'min_length' => 'Nama sepatu terlalu pendek',
        ]);

        // Validasi ID Kategori            
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Nama Kategori harus diisi'
        ]);

        // Validasi Merek
        $this->form_validation->set_rules('merek', 'Merek', 'required|min_length[3]', [
            'required' => 'Merek harus diisi',
            'min_length' => 'Merek terlalu pendek',
        ]);

        // Validasi Warna
        $this->form_validation->set_rules('warna', 'Warna sepatu', 'required|min_length[3]', [
            'required' => 'Warna sepatu harus diisi',
            'min_length' => 'Warna sepatu terlalu pendek',
        ]);

        // Validasi For Gender            
        $this->form_validation->set_rules('gender', 'Gender', 'required', [
            'required' => 'For Gender harus diisi'
        ]);

        // Validasi Size            
        $this->form_validation->set_rules('size[]', 'Size', 'required', [
            'required' => 'Ukuran sepatu harus diisi'
        ]);

        // Validasi Harga
        $this->form_validation->set_rules('harga', 'harga', 'required|numeric', [
            'required' => 'Harga harus diisi',
            'numeric' => 'Hanya dapat diisi oleh angka',
        ]);

        // Validasi Stok
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric', [
            'required' => 'Stok harus diisi',
            'numeric' => 'Hanya dapat diisi oleh angka',
        ]);

        // Validasi Sold
        $this->form_validation->set_rules('sold', 'Sold', 'required|numeric', [
            'required' => 'Stok Terjual harus diisi',
            'numeric' => 'Hanya dapat diisi oleh angka',
        ]);

        // Validasi Deskripsi Produk
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Produk', 'required|min_length[3]', [
            'required' => 'Deskripsi produk harus diisi',
            'min_length' => 'Deskripsi produk terlalu pendek',
        ]);
    }
}
