<?php
include_once '../sistem/koneksi.php';

$b = @$_GET['bulan'] ? $_GET['bulan'] : date('m');
$t = @$_GET['tahun'] ? $_GET['tahun'] : date('Y');
if ($b !== 'semua') {
    $query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE status >= '4' AND DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') BETWEEN '$t-$b-01' AND '$t-$b-32'  ORDER BY status ASC, tgl_transaksi ASC");
} else {
    $query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE status >= '4' AND DATE_FORMAT(tgl_transaksi, '%Y') = '$t'  ORDER BY status ASC, tgl_transaksi ASC");
}
$bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$total = 0;

$info_toko = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM info_toko"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi <?= (is_numeric($b)) ? 'Bulan ' . $bulan[$b-1] . ',' : 'Tahun' ?> <?= $t ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>
    <div class="wrap mt-3">
        <div class="container">
            <header class="text-center border-bottom">
                <h2 class="text-uppercase mb-0 font-weight-bold"><?= $info_toko['nama_toko'] ?></h2>
                <address>
                    <?= $info_toko['alamat'] ?> <br>
                    Telp. <?= $info_toko['telp'] ?>, Fax. <?= $info_toko['fax'] ?>, Email: <?= $info_toko['email'] ?>
                </address>
            </header>
            <section id="laporan" class="mt-4">
                <h4>Laporan Transaksi <?= (is_numeric($b)) ? 'Bulan ' . $bulan[$b-1] . ',' : 'Tahun' ?> <?= $t ?></h4>
                <table class="table table-striped table-bordered data-table">
                    <thead>
                        <th width="13%">Kode Transaksi</th>
                        <th>Pemesan</th>
                        <th width="16%">Tanggal</th>
                        <th width="30%">Alamat</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($query)): $total += $row['total'] ?>
                            <tr>
                                <td><?= $row['kode_transaksi'] ?></td>
                                <td>
                                    <span><?= $row['pemesan'] ?></span> <br>
                                    <span class="text-muted">Telp. <?= $row['telp'] ?></span>
                                </td>
                                <td>
                                    <?= date('d F Y', strtotime($row['tgl_transaksi'])) ?>
                                </td>
                                <td><?= $row['alamat'] ?></td>
                                <td>Rp. <?= number_format($row['total'], '0', ',', '.') ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot class="bg-light">
                        <tr>
                            <th colspan="4">Jumlah Total</th>
                            <th colspan="2">Rp. <?= number_format($total, 0, ',', '.') ?></th>
                        </tr>
                    </tfoot>
                </table>
            </section>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>