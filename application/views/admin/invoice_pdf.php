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
                <th>Nama Pemesan</th>
                <th>Alamat Pengiriman</th>
                <th>Tanggal Pengiriman</th>
                <th>Batas Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php $index = 1; // Inisialisasi variabel index mulai dari 1 
            ?>
            <?php foreach ($invoice as $inv) : ?>
                <tr>
                    <td><?php echo $index++; ?></td> <!-- Menampilkan index yang bertambah setiap iterasi -->
                    <td><?php echo $inv->nama ?></td>
                    <td><?php echo $inv->alamat ?></td>
                    <td><?php echo $inv->tgl_pesan ?></td>
                    <td><?php echo $inv->batas_bayar ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>