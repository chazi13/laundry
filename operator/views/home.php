<?php
$tahun = @$_GET['tahun'] ? $_GET['tahun'] : date('Y');
$bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$data_jml_transaksi = [];

for ($i=0; $i < count($bulan); $i++) { 
    $data_jml_transaksi[$i] = 0;
    
    $query = mysqli_query($koneksi, "SELECT COUNT(kode_transaksi) AS jml_transaksi, tgl_transaksi FROM transaksi WHERE DATE_FORMAT(tgl_transaksi, '%Y') = '$tahun' GROUP BY DATE_FORMAT(tgl_transaksi, '%m')");
    while ($data_transaksi = mysqli_fetch_assoc($query)) {
        if (date('m', strtotime($data_transaksi['tgl_transaksi'])) == $i+1) {
            $data_jml_transaksi[$i] = (int) $data_transaksi['jml_transaksi'];
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
                <a href="index.php?page=add_member" class="btn btn-white btn-border btn-round mr-2">Add Member</a>
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
                                    <div class="col-4 p-1 ml-auto">
                                        <select name="tahun" id="" class="form-control">
                                            <option value="">Tahun</option>
                                            <?php for ($st=date('Y'); $st > date(Y)-5; $st--): ?>
                                                <option value="<?= $st ?>" <?= ($st == $tahun) ? 'selected' : '' ?>><?= $st ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col-4 p-1">
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
    labels: <?= json_encode(array_values($bulan)) ?> ,
    datasets: [{
        label: 'Jumlah Transaksi',
        borderColor: 'rgb(18, 105, 219)',
        fill: false,
        lineTension: 0.1,
        data: <?= json_encode($data_jml_transaksi) ?>
    }]
}

let options = {
    scales: {
        yAxes: [{
            display: true,
            ticks: {
                beginAtZero: true   // minimum value will be 0.
            }
        }]
    }
};
</script>
