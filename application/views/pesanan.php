<div class="container-fluid">
    <h4>Detail Pesanan Produk</h4>

    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>Id</th>
            <th>Nama Pesanan</th>
            <th>Jumlah</th>
            <th>Harga Total</th>
            <th>aksi</th>
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
                    switch ($inv->pilihan) {
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
            </tr>
        <?php endforeach; ?>
    </table>
    <!-- Tombol Kembali -->
    <a href="<?php echo base_url('pemesanan') ?>">
        <div class="btn btn-sm btn-success">Kembali</div>
    </a>
</div>