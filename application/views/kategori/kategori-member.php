<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = 1;
                    foreach ($kategori as $k) { ?>
                        <tr>
                            <th scope="row"><?= $a++; ?></th>
                            <td><?= $k['nama_kategori']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->