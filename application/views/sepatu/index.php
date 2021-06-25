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
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#sepatuBaruModal"><i class="fas fa-plus-circle"></i> Sepatu Baru</a>
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
                                <a href="<?= base_url('sepatu/ubahSepatu/') . $s['id']; ?>" class="badge badge-info"><i class="fas fa-edit"></i> Ubah</a>
                                <a href="<?= base_url('sepatu/hapusSepatu/') . $s['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus <?= $judul . '' . $s['nama_sepatu']; ?> ?');" class="badge badge-danger"><i class="fas fa-trash"></i> Hapus</a>
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
<div class="modal fade" id="sepatuBaruModal" tabindex="-1" role="dialog" aria-labelledby="sepatuBaruModalLabel" ariahidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sepatuBaruModalLabel">Tambah Data Sepatu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('sepatu'); ?>
            <div class="modal-body">

                <!-- Input Kode Sepatu -->
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="kode_sepatu" name="kode_sepatu" placeholder="Masukkan Kode Sepatu">
                </div>

                <!-- Input Nama Sepatu -->
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="nama_sepatu" name="nama_sepatu" placeholder="Masukkan Nama Sepatu">
                </div>

                <!-- Input Kategori Sepatu -->
                <div class="form-group">
                    <select name="id_kategori" class="form-control form-control-user">
                        <option value="">Pilih Kategori</option>
                        <?php
                        foreach ($kategori as $k) { ?>
                            <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Input Merek Sepatu -->
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="merek" name="merek" placeholder="Masukkan nama merek">
                </div>

                <!-- Input Warna Sepatu -->
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="warna" name="warna" placeholder="Masukkan Warna">
                </div>

                <!-- Input Pilihan Gender -->
                <div class="form-group">
                    <select name="gender" class="form-control form-control-user">
                        <option value="">Pilih Gender</option>
                        <?php
                        foreach ($gender as $g) { ?>
                            <option value="<?= $g['id']; ?>"><?= $g['gender']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Input Ukuran Sepatu -->
                <div class="form-group">
                    <fieldset>
                        <legend>Ukuran Sepatu</legend>
                        <?php
                        foreach ($ukuran as $s) { ?>
                            <label style="width: 200px; margin: 5px; font-size: 10px;">
                                <input type="checkbox" class="form-control-sm form-control-user" id="size" name="size[]" value="<?= $s['id'] ?>">
                                <?= 'UK ' . $s['UK'] . ' | ' . 'US ' . $s['US'] . ' | ' . $s['EU'] ?>
                            </label>
                        <?php } ?>
                    </fieldset>
                </div>

                <!-- Input Harga Sepatu -->
                <div class="form-group">
                    <input type="number" class="form-control form-control-user" id="harga" name="harga" placeholder="Masukkan Harga Sepatu">
                </div>

                <!-- Stok -->
                <div class="form-group">
                    <input type="number" class="form-control form-control-user" id="stok" name="stok" placeholder="Masukkan nominal stok">
                </div>

                <!-- Sold -->
                <div class="form-group">
                    <input type="number" class="form-control form-control-user" id="sold" name="sold" placeholder="Masukkan stok terjual">
                </div>

                <!-- Deksripsi -->
                <div class="form-group">
                    <textarea name="deskripsi" id="deskripsi" class="form-control form-control-user"></textarea>
                </div>

                <!-- Picture -->
                <div class="form-group">
                    <input type="file" class="form-control form-control-user" id="picture" name="picture">
                </div>
            </div>

            <!-- Button -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Tambah Menu -->