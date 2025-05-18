<div class="container-fluid">
    <h4>Invoice Pemesanan Produk</h4>

    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>Id Invoice</th>
            <th>Nama Pemesan</th>
            <th>Alamat Pengiriman</th>
            <th>Tanggal Pengiriman</th>
            
            <th>status</th>
            <th>Aksi</th>
        </tr>
        <?php if(!empty($invoice)) :?>
        <?php foreach ($invoice as $inv) : ?>
            <tr>
                <td><?php echo $inv->id ?></td>
                <td><?php echo $inv->nama ?></td>
                <td><?php echo $inv->alamat ?></td>
                <td><?php echo $inv->tgl_pesan ?></td>
               
                <td>
                    <?php
                    switch ($inv->status) {
                        case 0:
                            echo "Pesanan menunggu konfirmasi";
                            break;
                        case 1:
                            echo "Pesanan di proses";
                            break;
                        case 2:
                            echo "Dikirim";
                            break;
                        case 4:
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
                    <a href="<?php echo base_url('pemesananController/detail/' . $inv->id) ?>"
                        class="btn btn-sm btn-primary">
                        Detail
                    </a>
                    <!-- Logika untuk tombol -->
                    <?php if ($inv->status == 2) : ?>
                        <!-- Tombol Diterima jika status = 2 -->
                        <a href="<?php echo base_url('pemesananController/diterima/' . $inv->id) ?>"
                            class="btn btn-sm btn-success"
                            onclick="return confirm('Apakah Anda yakin pesanan ini sudah diterima?')">
                            Diterima
                        </a>
                    <?php elseif (strtotime($inv->batas_bayar) > time()) : ?>
                        <!-- Tombol Batalkan jika batas_bayar belum terlewati -->
                        <a href="<?php echo base_url('pemesananController/batalkan/' . $inv->id) ?>"
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                            Batalkan
                        </a>
                    <?php else : ?>
                        <!-- Pesanan tidak bisa dibatalkan -->
                        <span class="text-muted"> Tidak bisa dibatalkan</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>