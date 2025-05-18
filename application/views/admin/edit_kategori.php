<div class="container">
    <h3><i class="fas fa-edit"></i>EDIT DATA KATEGORI</h3>

    <?php foreach ($kategori as $ktg) : ?>

        <form method="post" action="<?php echo base_url() . 'admin/kategori/update' ?>">

            <div class="for-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $ktg->nama ?>">
            </div>

            <div class="for-group">
                <label>Kode</label>
                <input type="hidden" name="id" class="form-control" value="<?php echo $ktg->id ?>">
                <input type="text" name="kode" class="form-control" value="<?php echo $ktg->kode ?>">
            </div>  

            <button class="btn btn-primary btn-sm mt-3" type="submit"> Simpan</button>
        </form>

    <?php endforeach; ?>
</div>