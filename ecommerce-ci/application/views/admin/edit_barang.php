<div class="container">
	<h3><i class="fas fa-edit"></i>EDIT DATA BARANG</h3>

	<?php foreach ($barang as $brg) : ?>

		<form method="post" action="<?php echo base_url() . 'admin/data_barang/update' ?>">

			<div class="for-group">
				<label>Nama Barang</label>
				<input type="text" name="nama_brg" class="form-control" value="<?php echo $brg->nama_brg ?>">
			</div>

			<div class="for-group">
				<label>Keterangan</label>
				<input type="hidden" name="id_brg" class="form-control" value="<?php echo $brg->id_brg ?>">
				<input type="text" name="keterangan" class="form-control" value="<?php echo $brg->keterangan ?>">
			</div>

			<div class="form-group">
				<label>Kategori</label>
				<select class="form-control" name="kategori">
					<!-- Loop untuk menampilkan kategori dari database -->
					<?php foreach ($kategori as $k) : ?>
						<option value="<?= $k->id ?>"><?= $k->nama ?></option>
					<?php endforeach; ?>
				</select>
			</div>


			<div class="for-group">
				<label>Harga</label>
				<input type="text" name="harga" class="form-control" value="<?php echo $brg->harga ?>">
			</div>

			<div class="for-group">
				<label>Stok</label>
				<input type="text" name="stok" class="form-control" value="<?php echo $brg->stok ?>">
			</div>

			<button class="btn btn-primary btn-sm mt-3" type="submit"> Simpan</button>
		</form>

	<?php endforeach; ?>
</div>