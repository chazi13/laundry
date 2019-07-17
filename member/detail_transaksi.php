<?php
include_once '../sistem/koneksi.php';
$kode_transaksi = base64_decode($_GET['k']);
$transaksi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM transaksi WHERE kode_transaksi = '$kode_transaksi'"));
$query_detail = mysqli_query($koneksi, "SELECT * FROM detail_transaksi WHERE kode_transaksi = '$kode_transaksi'");
?>

<div class="struk-detail">
    <table class="table table-borderless">
        <tr>
            <td>No. Transaksi</td>
            <td>:</td>
            <td id="kode-transaksi"><?= $kode_transaksi ?></td>
        </tr>
        <tr>
            <td>Pemesan</td>
            <td>:</td>
            <td><?= $transaksi['pemesan'] ?></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td><?= date('d/M/Y H:i:s') ?></td>
        </tr>
    </table>
    <table class="table">
        <thead class="bg-grey2">
            <th>Produk</th>
            <th class="text-right">Jumlah</th>
        </thead>
        <tbody>
            <?php $totalsub = 0; while ($rdt = mysqli_fetch_assoc($query_detail)): $subtotal = $rdt['harga'] * $rdt['qty']; $totalsub += $subtotal;  ?>
                <tr>
                    <td>
                        <h6 class="mb-0"><?= $rdt['nama_produk'] ?></h6>
                        <small><?= $rdt['qty'] . ' &times; Rp. ' . number_format($rdt['harga'], 0, ',', '.') ?></small>
                    </td>
                    <td class="text-right">
                        <h6 class="font-weight-bold">Rp. <?= number_format($subtotal, 0, ',', '.') ?></h6>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <hr>
    <table class="table table-borderless">
        <tr>
            <td class="p-0 text-uppercase">Subtotal</td>
            <td class="p-0 text-right font-weight-bold">Rp. <?= number_format($totalsub, 0, ',', '.') ?></td>
        </tr>
        <tr>
            <td class="p-0 text-uppercase">Diskon</td>
            <td class="p-0 text-right"><?= ($transaksi['diskon'] > 0) ? $transaksi['diskon'] . '%' : 0 ?></td>
        </tr>
        <tr>
            <td class="p-0 text-uppercase">Pengiriman</td>
            <td class="p-0 text-right"><?= ($transaksi['logistik'] == 'Diantar') ? 'Rp. 9.000' : 0 ?></td>
        </tr>
    </table>
    <hr>
    <table class="table table-borderless">
        <tr>
            <td class="p-0 text-uppercase">Total</td>
            <td class="p-0 text-right font-weight-bold">Rp. <?= number_format($transaksi['total'], 0, ',', '.') ?></td>
        </tr>
        <tr>
            <td class="p-0 text-uppercase">Tunai</td>
            <td class="p-0 text-right">Rp. <?= number_format($transaksi['tunai'], 0, ',', '.') ?></td>
        </tr>
        <tr>
            <td class="p-0 text-uppercase">Kembali</td>
            <td class="p-0 text-right">Rp. <?= $kembali = $transaksi['tunai'] - $transaksi['total']; number_format($kembali, 0, ',', '.') ?></td>
        </tr>
    </table>
</div>
