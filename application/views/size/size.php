<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-3">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#sizeBaruModal"><i class="fas fa-file-alt"></i> Tambah Size</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">UK</th>
                        <th scope="col">US</th>
                        <th scope="col">EU</th>
                        <th scope="col" colspan="2">Pilihan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = 1;
                    foreach ($size as $s) { ?>
                        <tr>
                            <th scope="row"><?= $a++; ?></th>
                            <td><?= $s['UK']; ?></td>
                            <td><?= $s['US']; ?></td>
                            <td><?= $s['EU']; ?></td>
                            <td>
                                <a href="<?= base_url('size/ubahSize/') . $s['id']; ?>" class="badge badge-info"><i class="fas fa-edit"></i> Ubah</a>
                            </td>
                            <td>
                                <a href="<?= base_url('size/hapusSize/') . $s['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus <?= $judul . ' ' . 'UK ' . $s['UK'] . ' | ' . 'US ' . $s['US'] . ' | ' . 'EU ' . $s['EU']; ?> ?');" class="badge badge-danger"><i class="fas fa-trash"></i>
                                    Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->

<!-- Modal Tambah size baru-->
<div class="modal fade" id="sizeBaruModal" tabindex="-1" role="dialog" aria-labelledby="sizeBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sizeBaruModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('size/showOrAddSize'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="uk" name="uk" placeholder="UK Size" value="<?= set_value('UK') ?>">
                        <?= form_error('uk_size', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="us" name="us" placeholder="US Size" value="<?= set_value('US') ?>">
                        <?= form_error('us_size', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="eu" name="eu" placeholder="EU Size" value="<?= set_value('EU') ?>">
                        <?= form_error('eu_size', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Tambah Menu -->