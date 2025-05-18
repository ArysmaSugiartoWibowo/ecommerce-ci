<div class="container-fluid">
	<h4>Detail Pesanan <div class="btn btn-sm btn-success">No. Invoice: <?php echo $invoice->id ?></div>
	</h4>

	<table class="table table-bordered table-hover table-striped">
		<tr>
			<th>Id Barang</th>
			<th>Nama Produk</th>
			<th>Jumlah Pesanan</th>
			<th>Status</th>
			<th>Harga Satuan</th>
			<th>Sub Total</th>
		</tr>

		<?php
		$total = 0; // Inisialisasi variabel $total
		if ($pesanan && is_array($pesanan)) : ?>
			<?php
			foreach ($pesanan as $psn) :
				$subtotal = $psn->jumlah * $psn->harga;
				$total += $subtotal;
				// Menentukan status berdasarkan pilihan
					// Menampilkan status berdasarkan nilai dari kolom pilihan
					if ($psn->pilihan == 0) {
						$status= "Diproses";  // Status "Diproses" jika pilihan 0
					} elseif ($psn->pilihan == 1) {
						$status= "Dikofirmasi Silahkan Tunggu Pesanan Untuk Dikirim";
					} elseif ($psn->pilihan == 2) {
						$status= "Pesanan Dikirimkan ";  // Status "Selesai" jika pilihan 2
					} elseif ($psn->pilihan == 3) {
						$status= "dibatalkan";  
					} elseif ($psn->pilihan == 4) {
						$status= "Pesanan Diterima ";  // Status "Selesai" jika pilihan 2
					}
			?>
				<tr>
					<td><?php echo $psn->id_brg ?></td>
					<td><?php echo $psn->nama_brg ?></td>
					<td><?php echo $psn->jumlah ?></td>
					<td><?php echo $status ?></td>
					<td><?php echo number_format($psn->harga, 0, ',', '.') ?></td>
					<td><?php echo number_format($subtotal, 0, ',', '.') ?></td>
				</tr>
			<?php endforeach; ?>
		<?php else : ?>
			<tr>
				<td colspan="6" align="center">Data pesanan tidak ditemukan.</td>
			</tr>
		<?php endif; ?>

		<tr>
			<td colspan="5" align="right">Grand Total</td>
			<td align="right">Rp. <?php echo number_format($total, 0, ',', '.') ?></td>
		</tr>
	</table>

	<!-- Tombol Kembali -->
	<a href="<?php echo base_url('admin/invoice/index') ?>">
		<div class="btn btn-sm btn-primary">Kembali</div>
	</a>
	<?php  
// Menampilkan status berdasarkan nilai dari kolom pilihan
if ($psn->pilihan == 0) : ?>
    <a href="<?php echo base_url('admin/invoice/konfirmasi_pesanan/' . $invoice->id) ?>">
        <div class="btn btn-sm btn-success">Konfirmasi Pesanan</div>
    </a>
<?php elseif ($psn->pilihan == 1) : ?>
    <a href="<?php echo base_url('admin/invoice/kirimkan_pesanan/' . $invoice->id) ?>">
        <div class="btn btn-sm btn-success">Kirimkan Pesanan</div>
    </a>
<?php endif; ?>

					

	
</div>