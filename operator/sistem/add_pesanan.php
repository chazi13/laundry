<?php
include_once '../../sistem/koneksi.php';

// data transaksi
$is_member = $_POST['is_member'];
$nama_pemesan = ($is_member == 'true') ? $_POST['nama_member'] : $_POST['input_nama_pemesan'];
$id_member = @$_POST['id_member'] ? $_POST['id_member'] : 0;
$telp = $_POST['telp'];
$alamat = $_POST['alamat'];
$logistik = (@$_POST['antar'] == 'on') ? 'Diantar' : 'Ambil Sendiri';
$diskon = 0;
$total = $_POST['total'];
$tunai = $_POST['tunai'];

$last_id = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUBSTR(kode_transaksi, 5, 5) AS id FROM transaksi ORDER BY kode_transaksi DESC LIMIT 0,1"));
$prefix_code = 'TRS-';
$new_id = sprintf('%05d', $last_id['id'] + 1);
$kode_transaksi = $prefix_code . $new_id;

// data produk detail transaksi
$produk = $_POST['produk'];
$nama_produk = $_POST['nama_produk'];
$harga = $_POST['harga'];
$qty = $_POST['qty'];
$subtotal = $_POST['subtotal'];

if ($is_member == 'true') {
    $check_diskon = mysqli_query($koneksi, "SELECT counter FROM diskon_counter WHERE id_member = '$id_member'");
    if (mysqli_num_rows($check_diskon) < 1) {
        mysqli_query($koneksi, "INSERT INTO diskon_counter (id_member, counter) VALUES ('$id_member', '0')");
    } elseif (mysqli_num_rows($check_diskon) == 1) {
        $ketentuan_diskon = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM diskon"));
        $counter = mysqli_fetch_assoc($check_diskon);
        if ($counter['counter'] >= $ketentuan_diskon['pemesanan']) {
            $diskon = $ketentuan_diskon['potongan'];
            $set_discount_counter = $counter['counter'] - $ketentuan_diskon['pemesanan'];
            $total -= $total * ($ketentuan_diskon['potongan'] / 100);
            $update_counter = mysqli_query($koneksi, "UPDATE diskon_counter SET counter = '$set_discount_counter' WHERE id_member = '$id_member'");
        }
    }
}

$sql_transaksi = "INSERT INTO transaksi (kode_transaksi, pemesan, telp, alamat, logistik, diskon, total, tunai, id_member) VALUES ('$kode_transaksi', '$nama_pemesan', '$telp', '$alamat', '$logistik', '$diskon', '$total', '$tunai', '$id_member')";
$query_transaksi = mysqli_query($koneksi, $sql_transaksi);
if ($sql_transaksi) {

    $last_jurnal_kode = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUBSTR(kode_jurnal, 5, 5) AS id FROM jurnal ORDER BY kode_jurnal DESC"));
    $prefix_code = 'JNL-';
    $new_kode = sprintf('%05d', $last_jurnal_kode['id'] + 1);
    $kode_jurnal = $prefix_code . $new_kode;
    $tanggal = date('Y-m-d');
    $keterang_jurnal = 'Transaksi Pemesanan';
    $jenis = 'debet';
    $sql_jurnal = "INSERT INTO jurnal (kode_jurnal, tanggal, keterangan, jenis, nominal) VALUES ('$kode_jurnal', '$tanggal', '$keterang_jurnal', '$jenis', '$total')";
    mysqli_query($koneksi, $sql_jurnal);

    $sql_log = "INSERT INTO log_transaksi (pegawai, kode_transaksi) VALUES ('$_SESSION[nama]', '$kode_transaksi')";
    $query_log = mysqli_query($koneksi, $sql_log);
    for ($i=0; $i < count($produk); $i++) { 
        $sql_detail = "INSERT INTO detail_transaksi (nama_produk, qty, harga, id_produk, kode_transaksi) VALUES ('$nama_produk[$i]', '$qty[$i]', '$harga[$i]', '$produk[$i]', '$kode_transaksi')";
        $query_detail = mysqli_query($koneksi, $sql_detail);
    }
    if ($is_member) {
        $update_counter = "UPDATE diskon_counter SET counter = (counter+1) WHERE id_member = '$id_member'";
        $query_counter = mysqli_query($koneksi, $update_counter);
    }
}

$info_toko = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM info_toko"));
?>
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
            <td class="p-1">No. Transaksi</td>
            <td class="p-1">:</td>
            <td class="p-1" id="kode-transaksi"><?= $kode_transaksi ?></td>
        </tr>
        <tr>
            <td class="p-1">Kasir</td>
            <td class="p-1">:</td>
            <td class="p-1"><?= $_SESSION['nama'] ?></td>
        </tr>
        <tr>
            <td class="p-1">Tanggal</td>
            <td class="p-1">:</td>
            <td class="p-1"><?= date('d/M/Y H:i:s') ?></td>
        </tr>
    </table>
    <table class="table">
        <thead class="bg-grey2">
            <th>Produk</th>
            <th class="text-right">Jumlah</th>
        </thead>
        <tbody>
            <?php $totalsub = 0; for ($k=0; $k < count($produk); $k++): $totalsub += $subtotal[$k]; ?>
                <tr>
                    <td>
                        <h6 class="mb-0"><?= $nama_produk[$k] ?></h6>
                        <small><?= $qty[$k] . ' &times; Rp. ' . number_format($harga[$k], 0, ',', '.') ?></small>
                    </td>
                    <td class="text-right">
                        <h6 class="font-weight-bold">Rp. <?= number_format($subtotal[$k], 0, ',', '.') ?></h6>
                    </td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
    <hr>
    <table class="table table-borderless">
        <tr>
            <td class="p-1 text-uppercase">Subtotal</td>
            <td class="p-1 text-right font-weight-bold">Rp. <?= number_format($totalsub, 0, ',', '.') ?></td>
        </tr>
        <tr>
            <td class="p-1 text-uppercase">Pengiriman</td>
            <td class="p-1 text-right"><?= (@$_POST['antar'] == 'on') ? 'Rp. 9.000' : 0 ?></td>
        </tr>
        <tr>
            <td class="p-1 text-uppercase">Diskon</td>
            <td class="p-1 text-right"><?= ($diskon > 0) ? $diskon . '%' : 0 ?></td>
        </tr>
    </table>
    <hr>
    <table class="table table-borderless">
        <tr>
            <td class="p-1 text-uppercase">Total</td>
            <td class="p-1 text-right font-weight-bold">Rp. <?= number_format($total, 0, ',', '.') ?></td>
        </tr>
        <tr>
            <td class="p-1 text-uppercase">Tunai</td>
            <td class="p-1 text-right">Rp. <?= number_format($tunai, 0, ',', '.') ?></td>
        </tr>
        <tr>
            <td class="p-1 text-uppercase">Kembali</td>
            <td class="p-1 text-right">Rp. <?= $kembali = $tunai - $total; number_format($kembali, 0, ',', '.') ?></td>
        </tr>
    </table>
</div>
