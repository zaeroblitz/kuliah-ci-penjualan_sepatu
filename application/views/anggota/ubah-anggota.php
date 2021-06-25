<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9">
            <form action="<?= base_url('anggota/ubahAnggota/') . $selectedUser['id']; ?>" method="POST">

                <!-- ID -->
                <div class="form-group row">
                    <label for="id" class="col-sm-2 col-formlabel">ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id" name="id" value="<?= $selectedUser['id']; ?>" readonly>
                    </div>
                </div>

                <!-- Nama -->
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-formlabel">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $selectedUser['nama']; ?>" readonly>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-formlabel">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="<?= $selectedUser['email']; ?>" readonly>
                    </div>
                </div>

                <!-- Image -->
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Picture</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/img/profile/') . $selectedUser['image']; ?>" class="img-thumbnail" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Role -->
                <div class="form-group row">
                    <label for="role_id" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select name="role_id" class="form-control">
                            <option value="<?= $selectedUser['role_id']; ?>">
                            <?php
                            foreach ($role as $r) {
                                echo ($r['id'] == $selectedUser['role_id']) ? $r['role_id'] : '';
                            }
                            ?>
                            </option>
                            <?php
                                foreach ($role as $r) { ?>
                                <?php  if($r['id'] != $selectedUser['role_id']) { ?>
                                <option value="<?= $r['id']; ?>"><?= $r['role_id']; ?></option>
                                <?php  } ?>
                            <?php } ?>
                        </select>
                        <?= form_error('role_id', '<small class="textdanger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <!-- Is Active -->
                <div class="form-group row">
                    <label for="is_active" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select name="is_active" class="form-control">
                            <option value="<?= $selectedUser['is_active']; ?>">
                            <?php
                                switch ($selectedUser['is_active']) {
                                    case '0':
                                        echo 'Not Activated';
                                        break;
                                    
                                    default:
                                    echo 'Activated';
                                        break;
                                }
                            ?>
                            </option>
                            <?php
                                switch ($selectedUser['is_active']) {
                                    case '0':
                                        echo '<option value="1">Activated</option>';
                                        break;
                                    
                                    default:
                                    echo '<option value="0">Not Activated</option>';
                                        break;
                                }
                            ?>
                            <!-- <option value="0">Not Activated</option>
                            <option value="1">Activated</option> -->
                        </select>
                        <?= form_error('is_active', '<small class="textdanger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <!-- Registration Date -->
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-formlabel">Registration Date</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="<?= date("Y-m-d H:i:s", $selectedUser['tanggal_input']); ?>" readonly>
                    </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                        <button class="btn btn-dark" onclick="window.history.go(-1)" id='back' name='back' value='back'> Kembali
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