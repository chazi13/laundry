<?php
include_once '../sistem/koneksi.php';
$b = @$_GET['bulan'] ? $_GET['bulan'] : date('m');
$t = @$_GET['tahun'] ? $_GET['tahun'] : date('Y');
$query = mysqli_query($koneksi, "SELECT * FROM jurnal JOIN coa ON jurnal.coa_id = coa.no_coa WHERE DATE_FORMAT(tanggal, '%Y-%m-%d') BETWEEN '$t-$b-01' AND '$t-$b-32'  ORDER BY tanggal ASC");
$bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

$query_coa = mysqli_query($koneksi, "SELECT * FROM coa");

// $total_pemasukan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(total) AS total FROM transaksi WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') BETWEEN '$t-$b-01' AND '$t-$b-32'"));

$saldo_debet = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jurnal.saldo) AS debet FROM jurnal JOIN coa ON jurnal.coa_id = coa.no_coa WHERE DATE_FORMAT(tanggal, '%Y-%m-%d') < '$t-$b-01' AND coa.gol = 'D'"));
$saldo_kredit = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jurnal.saldo) AS kredit FROM jurnal JOIN coa ON jurnal.coa_id = coa.no_coa WHERE DATE_FORMAT(tanggal, '%Y-%m-%d') < '$t-$b-01' AND coa.gol = 'C'"));
$saldo = $saldo_debet['debet'] - $saldo_kredit['kredit'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Junal Laporan Bulan <?= date('M', strtotime($b)) . ', tahun ' . $t ?></title>

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container pt-5">
        <div class="card">
            <div class="card-body pb-0">
                <h3>Jurnal Bulan <?= $bulan[$b-1] . ', ' . $t ?></h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>Kode Jurnal</th>
                            <th>Tanggal</th>
                            <th>No. COA</th>
                            <th>Keterangan</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5">Saldo Sebelumnya</td>
                                <td colspan="2">Rp. <?= number_format($saldo, 0, ',', '.') ?></td>
                            </tr>
                            <?php while($row = mysqli_fetch_assoc($query)): ?>
                                <tr>
                                    <td><?= $row['kode_jurnal'] ?></td>
                                    <td><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
                                    <td><?= $row['no_coa'] ?></td>
                                    <td><?= $row['nama_coa'] ?></td>
                                    <td>Rp. <?= ($row['gol'] == 'D') ? number_format($row['saldo'], 0, ',', '.') : '' ?></td>
                                    <td>Rp. <?= ($row['gol'] == 'K') ? number_format($row['saldo'], 0, ',', '.') : '' ?></td>
                                    <td>Rp. <?php $saldo = ($row['gol'] == 'D') ? $saldo + $row['saldo'] : $saldo - $row['saldo']; echo number_format($saldo, 0, ',', '.') ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                        <tfoot>
                            <th colspan="6">Total</th>
                            <th>Rp. <?= number_format($saldo, 0, ',', '.') ?></th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>