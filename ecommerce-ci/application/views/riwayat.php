<div class="container-fluid">
    <h4>Riwayat Pesanan</h4>

    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>Id Invoice</th>
            <th>Nama Pemesan</th>
            <th>Alamat Pengiriman</th>
            <th>Tanggal Pengiriman</th>
            <th>Batas Pembayaran</th>
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
                <td><?php echo $inv->batas_bayar ?></td>
                <td>
                    <?php
                    switch ($inv->status) {
                        case 2:
                            echo "Selesai";
                            break;
                        case 3:
                            echo "Dibatalkan";
                            break;
                        default:
                            echo "Status tidak diketahui";
                    }
                    ?>
                </td>
                <td>
                    <a href="<?php echo base_url('riwayat/detail/' . $inv->id) ?>"
                        class="btn btn-sm btn-primary">
                        Detail
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>