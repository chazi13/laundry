<?php
$b = @$_GET['bulan'] ? $_GET['bulan'] : date('m');
$t = @$_GET['tahun'] ? $_GET['tahun'] : date('Y');
$bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$tgl = range(1, 31);
$data_jml_transaksi = [];
for ($i=0; $i < count($tgl); $i++) { 
    $data_jml_transaksi[$i] = 0;
    
    $query = mysqli_query($koneksi, "SELECT COUNT(kode_transaksi) AS jml_transaksi, DATE_FORMAT(tgl_transaksi, '%d') AS tgl FROM transaksi WHERE status >= '4' AND DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') BETWEEN '$t-$b-01' AND '$t-$b-32' GROUP BY DATE_FORMAT(tgl_transaksi, '%d')");
    while ($bytgl = mysqli_fetch_assoc($query)) {
        if ($bytgl['tgl'] == $tgl[$i]) {
            $data_jml_transaksi[$i] = (int) $bytgl['jml_transaksi'];
        }
    }
}

?>

<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold"><?= $title ?></h2>
            </div>
            <div class="ml-md-auto py-2 py-md-0">
                <?php if ($_SESSION['level'] == 'Admin'): ?>
                    <a href="index.php?page=add_member" class="btn btn-white btn-border btn-round mr-2">Add Member</a>
                <?php endif; ?>
                <a href="index.php?page=add_pesanan" class="btn btn-secondary btn-round">Add Pesanan</a>
            </div>
        </div>
    </div>
</div>

<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <div class="card-title">Pemesanan</div>
                        </div>
                        <div class="col-4 text-right ml-auto">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col p-1">
                                        <select name="bulan" id="" class="form-control">
                                            <option value="">Bulan</option>
                                            <?php for ($i=1; $i <= 12; $i++): $sb = (strlen($i) < 2) ? '0'.$i : $i; ?>
                                                <option value="<?= $sb; ?>" <?= ($sb == $b) ? 'selected' : '' ?>><?= $bulan[$i-1] ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col p-1">
                                        <select name="tahun" id="" class="form-control">
                                            <option value="">Tahun</option>
                                            <?php for ($st=date('Y'); $st > date(Y)-5; $st--): ?>
                                                <option value="<?= $st ?>" <?= ($st == $t) ? 'selected' : '' ?>><?= $st ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col p-1">
                                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let data = {
    labels: <?= json_encode($tgl) ?> ,
    datasets: [{
        label: 'Jumlah Transaksi',
        borderColor: 'rgb(18, 105, 219)',
        fill: false,
        lineTension: 0.1,
        data: <?= json_encode($data_jml_transaksi) ?>
    }]
}
</script>
