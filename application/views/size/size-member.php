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
                        <th scope="col">UK</th>
                        <th scope="col">US</th>
                        <th scope="col">EU</th>
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
                            
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->