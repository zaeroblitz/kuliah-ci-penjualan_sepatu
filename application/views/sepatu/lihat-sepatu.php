<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9">

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
                    <input type="text" class="form-control form-control-user" id="kode_sepatu" name="kode_sepatu" value="<?= $sepatu['kode_sepatu']; ?>" readonly>
                </div>
            </div>

            <!-- Input Nama Sepatu -->
            <div class="form-group row">
                <label for="nama_sepatu" class="col-sm-2 col-form-label">Nama Sepatu</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-user" id="nama_sepatu" name="nama_sepatu" value="<?= $sepatu['nama_sepatu']; ?>" readonly>
                </div>
            </div>

            <!-- Input Kategori Sepatu -->
            <div class="form-group row">
                <label for="id_kategori" class="col-sm-2 col-form-label">Kategori Sepatu</label>
                <div class="col-sm-10">
                <input type="text" class="form-control form-control-user" id="id_kategori" name="id_kategori" value="<?php foreach ($kategori as $k) {
                    echo ($k['id_kategori'] == $sepatu['id_kategori']) ? $k['nama_kategori'] : '';
                }
                ?>" readonly>
                </div>
            </div>

            <!-- Input Merek Sepatu -->
            <div class="form-group row">
                <label for="merek" class="col-sm-2 col-form-label">Merek</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-user" id="merek" name="merek" placeholder="Masukkan nama merek" value="<?= $sepatu['merek']; ?>" readonly>
                </div>
            </div>

            <!-- Input Warna Sepatu -->
            <div class="form-group row">
                <label for="warna" class="col-sm-2 col-form-label">Warna</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-user" id="warna" name="warna" placeholder="Masukkan Warna" value="<?= $sepatu['warna']; ?>" readonly>
                </div>
            </div>

            <!-- Input Pilihan Gender -->
            <div class="form-group row">
                <label for="gender" class="col-sm-2 col-form-label">Untuk Gender</label>
                <div class="col-sm-10">
                <input type="text" class="form-control form-control-user" id="gender" name="gender"  value="<?php foreach ($gender as $g) {
                    echo ($g['id'] == $sepatu['for_gender']) ? $g['gender'] : '';
                }
                ?>" readonly>
                </div>
            </div>

           <!-- Input Ukuran Sepatu -->
           <div class="form-group row ">
                <label for="size" class="col-sm-2 col-form-label">Ukuran Sepatu Tersedia</label>
                <div class="col-sm-10">
                    <?php
                    foreach ($size as $s) { ?>
                        <label style="width: 200px; font-size: 10px;">
                            <input disabled type="checkbox" class="form-control-md  form-control-user" id="size" name="size[]" value="<?= $s['id'] ?>" 
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
                    <input type="number" class="form-control form-control-user" id="harga" name="harga" placeholder="Masukkan Harga Sepatu" value="<?= $sepatu['harga']; ?>" readonly>
                </div>
            </div>

            <!-- Stok -->
            <div class="form-group row">
                <label for="stok" class="col-sm-2 col-form-label">Stok Sepatu</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control form-control-user" id="stok" name="stok" placeholder="Masukkan nominal stok" value="<?= $sepatu['stok']; ?>" readonly>
                </div>
            </div>

            <!-- Sold -->
            <div class="form-group row">
                <label for="sold" class="col-sm-2 col-form-label">Terjual</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control form-control-user" id="sold" name="sold" placeholder="Masukkan stok terjual" value="<?= $sepatu['terjual']; ?>" readonly>
                </div>
            </div>

            <!-- Deksripsi -->
            <div class="form-group row">
                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi Produk</label>
                <div class="col-sm-10">
                    <textarea readonly name="deskripsi" id="deskripsi" cols="30" rows="10" placeholder="Masukkan deskripsi produk" class="form-control form-control-user"><?= $sepatu['deskripsi']; ?>
                    </textarea>
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
                    </div>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button class="btn btn-dark" onclick="window.history.go(-1)" id="back" name="back" value="back"> Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->