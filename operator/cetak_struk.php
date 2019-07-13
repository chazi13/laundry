<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<?php
include_once '../sistem/koneksi.php';
$kode_transaksi = $_GET['k'];
$transaksi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM transaksi WHERE kode_transaksi = '$kode_transaksi'"));
$query_detail = mysqli_query($koneksi, "SELECT * FROM detail_transaksi WHERE kode_transaksi = '$kode_transaksi'");
$info_toko = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM info_toko"));
?>

<style>
    /* @page {
        size: A5;
    } */
</style>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <div class="struk-header text-center">
                <h4 class="text-uppercase mb-0"><?= $info_toko['nama_toko'] ?></h4>
                <address>
                    <?= $info_toko['alamat'] ?> <br>
                    Telp. <?= $info_toko['telp'] ?>
                </address>
            </div>
            <hr>
            <div class="struk-detail">
                <table class="table table-borderless">
                    <tr>
                        <td>No. Transaksi</td>
                        <td>:</td>
                        <td id="kode-transaksi"><?= $kode_transaksi ?></td>
                    </tr>
                    <tr>
                        <td>Kasir</td>
                        <td>:</td>
                        <td><?= $_SESSION['nama'] ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td><?= date('d/M/Y H:i:s') ?></td>
                    </tr>
                </table>
                <table class="table">
                    <thead class="bg-light">
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
        </div>
    </div>
</div>

<script>
    window.print();
</script>