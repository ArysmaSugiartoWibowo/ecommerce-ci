<div class="container-fluid">
	<h4>Invoice Pemesanan Produk</h4>

	<table class="table table-bordered table-hover table-striped">
		<a href="<?php echo base_url('admin/invoice/invoice_pdf') ?>" class="btn btn-sm btn-success mb-3">Download PDF</a>
		<tr>
			<th>Id Invoice</th>
			<th>Nama Pemesan</th>
			<th>Alamat Pengiriman</th>
			<th>Tanggal Pengiriman</th>
			<th>Status</th>
			<th>Aksi</th>
		</tr>

		<?php if(!empty($invoice)) : ?>
		<?php foreach ($invoice as $inv) : ?>
			<tr>
				<td><?php echo $inv->id ?></td>
				<td><?php echo $inv->nama ?></td>
				<td><?php echo $inv->alamat ?></td>
				<td><?php echo $inv->tgl_pesan ?></td>
				
				<td>
					<?php
					// Menampilkan status berdasarkan nilai dari kolom pilihan
		switch ($inv->status) {
			case 0:
				echo "Diproses";  // Status "Diproses" jika pilihan 0
				break;
			case 1:
				echo "Dikonfirmasi, Silahkan Tunggu Pesanan Untuk Dikirim";  // Status untuk pilihan 1
				break;
			case 2:
				echo "Pesanan Dikirimkan";  // Status "Pesanan Dikirimkan" jika pilihan 2
				break;
			case 3:
				echo "Dibatalkan";  // Status "Dibatalkan" jika pilihan 3
				break;
			case 4:
				echo "Pesanan Diterima";  // Status "Pesanan Diterima" jika pilihan 4
				break;
			default:
				echo "Status tidak diketahui";  // Status default jika nilai tidak sesuai
				break;
		}
		?>
				</td>
				<td><?php echo anchor('admin/invoice/detail/' . $inv->id, '<div class="btn btn-sm btn-primary">Detail</div>') ?></td>
			</tr>
		<?php endforeach; ?>
		<?php endif; ?>
	</table>
</div>