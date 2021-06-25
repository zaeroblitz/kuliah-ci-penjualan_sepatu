<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9">
            <?= form_open_multipart('sepatu/ubahSepatu/' . $sepatu['id']) ?>

            <!-- ID -->
            <div class="form-group row">
                <label for="id" class="col-sm-2 col-form-label">ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="id" name="id" value="<?= $sepatu['id']; ?>" readonly>
                </div>
            </div>

            <!-- Input Kode Sepatu -->
            <div class="form-group row">
                <label for="kode_sepatu" class="col-sm-2 col-form-label">Kode Sepatu</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-user" id="kode_sepatu" name="kode_sepatu" placeholder="Masukkan Kode Sepatu" value="<?= $sepatu['kode_sepatu']; ?>">
                    <?= form_error('kode_sepatu', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <!-- Input Nama Sepatu -->
            <div class="form-group row">
                <label for="nama_sepatu" class="col-sm-2 col-form-label">Nama Sepatu</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-user" id="nama_sepatu" name="nama_sepatu" placeholder="Masukkan Nama Sepatu" value="<?= $sepatu['nama_sepatu']; ?>">
                    <?= form_error('nama_sepatu', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <!-- Input Kategori Sepatu -->
            <div class="form-group row">
                <label for="id_kategori" class="col-sm-2 col-form-label">Kategori Sepatu</label>
                <div class="col-sm-10">
                    <select name="id_kategori" class="form-control form-control-user">
                        <option value="<?= $sepatu['id_kategori'] ?>">
                            <?php
                            foreach ($kategori as $k) {
                                echo ($k['id_kategori'] == $sepatu['id_kategori']) ? $k['nama_kategori'] : '';
                            }
                            ?>
                        </option>
                        <?php
                        foreach ($kategori as $k) { ?>
                        <?php  if($k['id_kategori'] != $sepatu['id_kategori']) { ?>
                        <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                       <?php  } ?>
                        <?php } ?>
                    </select>
                    <?= form_error('id_kategori', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <!-- Input Merek Sepatu -->
            <div class="form-group row">
                <label for="merek" class="col-sm-2 col-form-label">Merek</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-user" id="merek" name="merek" placeholder="Masukkan nama merek" value="<?= $sepatu['merek']; ?>">
                    <?= form_error('merek', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <!-- Input Warna Sepatu -->
            <div class="form-group row">
                <label for="warna" class="col-sm-2 col-form-label">Warna</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-user" id="warna" name="warna" placeholder="Masukkan Warna" value="<?= $sepatu['warna']; ?>">
                    <?= form_error('warna', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <!-- Input Pilihan Gender -->
            <div class="form-group row">
                <label for="gender" class="col-sm-2 col-form-label">Pilihan Gender</label>
                <div class="col-sm-10">
                    <select name="gender" class="form-control form-control-user">
                        <option value="<?= $sepatu['for_gender'] ?>">Pilih Gender</option>
                        <?php
                        foreach ($gender as $g) { ?>
                            <option value="<?= $g['id']; ?>"><?= $g['gender']; ?></option>
                        <?php } ?>
                    </select>
                    <?= form_error('gender', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <!-- Input Ukuran Sepatu -->
            <div class="form-group row text-center align-items-center justify-content-center">
                <label for="size" class="col-sm-2 col-form-label">Ukuran Sepatu Tersedia</label>
                <div class="col-sm-10">
                    <?php
                    foreach ($size as $s) { ?>
                        <label style="width: 200px; text-align: center; font-size: 10px;">
                            <input type="checkbox" class="form-control-md  form-control-user" id="size" name="size[]" value="<?= $s['id'] ?>" 
                            <?php
                            foreach (explode(',', $sepatu['size_available']) as $sz) {
                                $str_replace_sz = str_replace('"', "", $sz);
                                echo ($str_replace_sz == $s['id']) ? 'checked' : '';
                            }
                            ?>>
                            <?= 'UK ' . $s['UK'] . ' | ' . 'US ' . $s['US'] . ' | ' . 'EU ' . $s['EU'] ?>
                        </label>
                    <?php } ?>
                    <?= form_error('size', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <!-- Input Harga Sepatu -->
            <div class="form-group row">
                <label for="harga" class="col-sm-2 col-form-label">Harga Sepatu</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control form-control-user" id="harga" name="harga" placeholder="Masukkan Harga Sepatu" value="<?= $sepatu['harga']; ?>">
                    <?= form_error('harga', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <!-- Stok -->
            <div class="form-group row">
                <label for="stok" class="col-sm-2 col-form-label">Stok Sepatu</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control form-control-user" id="stok" name="stok" placeholder="Masukkan nominal stok" value="<?= $sepatu['stok']; ?>">
                    <?= form_error('stok', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <!-- Sold -->
            <div class="form-group row">
                <label for="sold" class="col-sm-2 col-form-label">Terjual</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control form-control-user" id="sold" name="sold" placeholder="Masukkan stok terjual" value="<?= $sepatu['terjual']; ?>">
                    <?= form_error('sold', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <!-- Deksripsi -->
            <div class="form-group row">
                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Produk</label>
                <div class="col-sm-10">
                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" placeholder="Masukkan deskripsi produk" class="form-control form-control-user"><?= $sepatu['deskripsi']; ?>
                    </textarea>
                    <?= form_error('deskripsi', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <!-- Image -->
            <div class="form-group row">
                <label for="picture" class="col-sm-2 col-form-label">Gambar</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/upload/') . $sepatu['picture']; ?>" class="img-thumbnail" alt="">
                        </div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="form-control form-control-user" id="picture" name="picture">
                            </div>
                        </div>
                        <?= form_error('picture', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <button class="btn btn-dark" onclick="window.history.go(-1)" id="back" name="back" value="back"> Kembali
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->