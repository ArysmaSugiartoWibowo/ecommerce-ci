<div class="container-fluid">
    <h4>Invoice Pemesanan Produk</h4>
    <button class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#tambah_kategori"><i class="fas fa-plus fa-sm"></i> Tambah Kategori</button>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama </th>
            <th>Kode Kategori</th>
            <th colspan="2">Aksi</th>
        </tr>

        <?php foreach ($kategori as $ktg) : ?>
            <tr>
                <td><?php echo $ktg->id ?></td>
                <td><?php echo $ktg->nama ?></td>
                <td><?php echo $ktg->kode ?></td>
                <td><?php echo anchor('admin/kategori/edit/' . $ktg->id, '<div class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></div>') ?></td>
                <td><?php echo anchor('admin/kategori/hapus/' . $ktg->id, '<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></div>') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>



<!-- Modal -->
<div class="modal fade" id="tambah_kategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Data Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url() . 'admin/kategori/tambah_aksi'; ?>" method='post' enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Kode</label>
                        <input type="text" name="kode" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

            </form>

        </div>
    </div>
</div>