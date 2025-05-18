<div class="container-fluid">
    <h4>Detail Riwayat Pesanan</h4>

    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>Id</th>
            <th>Nama Pesanan</th>
            <th>Jumlah</th>
            <th>Hargaa Total</th>
            <th>Status</th>
        </tr>

        <?php foreach ($pesanan as $inv) : ?>
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
                        echo "Dikofirmasi Silahkan Tunggu Pesanan Untuk Dikirim";
                    } elseif ($inv->pilihan == 2) {
                        echo "Pesanan Dikirimkan ";  // Status "Selesai" jika pilihan 2
                    } elseif ($inv->pilihan == 3) {
                        echo "dibatalkan";  
                    } elseif ($inv->pilihan == 4) {
                        echo "Pesanan Diterima ";  // Status "Selesai" jika pilihan 2
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <!-- Tombol Kembali -->
    <a href="<?php echo base_url('riwayat') ?>">
        <div class="btn btn-sm btn-success">Kembali</div>
    </a>
</div>