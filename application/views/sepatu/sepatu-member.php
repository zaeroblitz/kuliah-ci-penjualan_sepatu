<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kode Sepatu</th>
                        <th scope="col">Nama Sepatu</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Merek</th>
                        <th scope="col">Warna</th>
                        <th scope="col">Untuk Gender</th>
                        <th scope="col">Ukuran Tersedia</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Terjual</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Pilihan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = 1;
                    $this->load->helper('text');
                    foreach ($sepatu as $s) { ?>
                        <tr>
                            <th scope="row"><?= $a++; ?></th>
                            <td><?= $s['kode_sepatu']; ?></td>
                            <td><?= $s['nama_sepatu']; ?></td>
                            <td><?php
                                foreach ($kategori as $k) {
                                    echo ($s['id_kategori']  == $k['id_kategori']) ? $k['nama_kategori'] : '';
                                }
                                ?>
                            </td>
                            <td><?= $s['merek']; ?></td>
                            <td><?= $s['warna']; ?></td>
                            <td><?php
                                foreach ($gender as $g) {
                                    echo ($s['for_gender'] == $g['id']) ? $g['gender'] : '';
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                foreach (explode(',', $s['size_available']) as $sz) {
                                    $str_replace_sz = str_replace('"', "", $sz);
                                    $where = ['id' => $str_replace_sz];
                                    $ukSize = $this->ModelSize->sizeWhere($where)->row_array();
                                    echo 'EU ' . $ukSize['EU'] . ', ';
                                }
                                ?>
                            </td>
                            <td>
                                <?= 'Rp. ' . strrev(implode('.', str_split(strrev(strval($s['harga'])), 3))); ?>
                            </td>
                            <td><?= $s['stok']; ?></td>
                            <td><?= $s['terjual']; ?></td>
                            <td><?= word_limiter($s['deskripsi'], 10) ?></td>
                            <td>
                                <picture>
                                    <source srcset="" type="image/svg+xml">
                                    <img src="<?= base_url('assets/img/upload/') . $s['picture']; ?>" class="img-fluid img-thumbnail" alt="..." style="object-fit: cover; background-position: center; width:350px; height:100px;">
                                </picture>
                            </td>
                            <td>
                                <a href="<?= base_url('member/sepatu/lihatSepatu/') . $s['id']; ?>" class="badge badge-info"><i class="fas fa-eye"></i> Lihat</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- Modal Tambah mobil baru-->
<!-- End of Modal Tambah Menu -->