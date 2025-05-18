<div class="container-fluid">
    <h4>Pemesanan Produk</h4>

    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>Id Invoice</th>
            <th>Nama Pesanan</th>
            <th>Jumlah</th>
            <th>Harga Total</th>
            <th>Statusa</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($invoice as $inv) : ?>
            <tr>
                <td><?php echo $inv->id ?></td>
                <td><?php echo $inv->nama_brg ?></td>
                <td><?php echo $inv->jumlah ?></td>
                <td><?php echo $inv->harga ?></td>
                <td>
                    <?php
                    // Menampilkan status berdasarkan nilai dari kolom pilihan
                    if ($inv->pilihan == 0) {
                        echo "Diproses";  // Status "Diproses" jika pilihan 0
                    } elseif ($inv->pilihan == 1) {
                        echo "Diterima";  // Status "Diterima" jika pilihan 1
                    } elseif ($inv->pilihan == 2) {
                        echo "Selesai";  // Status "Selesai" jika pilihan 2
                    }
                    ?>
                </td>
                <td>
                    <?php
                    // Aksi untuk memperbarui status berdasarkan nilai pilihan
                    if ($inv->pilihan == 0) {
                        // Jika pilihan 0, tampilkan teks "Diproses" dan tidak ada tombol aksi
                        echo '<div class="btn btn-sm btn-secondary" disabled>Diproses</div>';
                    } elseif ($inv->pilihan == 1) {
                        // Jika pilihan 1, tampilkan tombol "Diterima" untuk memperbarui status menjadi 2
                        echo anchor(
                            'invoice/update_status/' . $inv->id . '/2',
                            '<div class="btn btn-sm btn-success">Diterima</div>'
                        );
                    } elseif ($inv->pilihan == 2) {
                        // Jika pilihan 2, tampilkan teks "Selesai" dan tidak ada tombol aksi
                        echo '<div class="btn btn-sm btn-primary" disabled>Selesai</div>';
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>