<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice Pemesanan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <h4>Invoice Pemesanan Produk</h4>
    <table>
        <thead>
            <tr>
                <th>Id Invoice</th>
                <th>Nama barang</th>
                <th>Keterangan</th>
                <th>Harga</th>
                <th>stok</th>
            </tr>
        </thead>
        <tbody>
            <?php $index = 1; // Inisialisasi variabel index mulai dari 1 
            ?>
            <?php foreach ($barang as $brg) : ?>
                <tr>
                    <td><?php echo $index++; ?></td> <!-- Menampilkan index yang bertambah setiap iterasi -->
                    <td><?php echo $brg->nama_brg ?></td>
                    <td><?php echo $brg->keterangan ?></td>
                    <td><?php echo $brg->harga ?></td>
                    <td><?php echo $brg->stok ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>