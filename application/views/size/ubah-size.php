<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9">
            <form action="<?=  base_url('size/ubahSize/') . $size['id']; ?>" method="POST">
            <div class="form-group row">
                <label for="id" class="col-sm-2 col-formlabel">ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="id" name="id" value="<?= $size['id']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="uk" class="col-sm-2 col-formlabel">UK Size</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="uk" name="uk" value="<?= $size['UK']; ?>">                    
                    <?= form_error('uk_size', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="size" class="col-sm-2 col-formlabel">US Size</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="us" name="us" value="<?= $size['US']; ?>">                    
                    <?= form_error('us_size', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="size" class="col-sm-2 col-formlabel">EU Size</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="eu" name="eu" value="<?= $size['EU']; ?>">                    
                    <?= form_error('eu_size', '<small class="text-danger pl-3">', '</small>'); ?>
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