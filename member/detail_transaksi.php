<?php
include_once '../sistem/koneksi.php';
$kode_transaksi = base64_decode($_GET['k']);
$log_transaksi = mysqli_query($koneksi, "SELECT * FROM log_transaksi WHERE kode_transaksi = '$kode_transaksi'");
$log = [];
while ($row = mysqli_fetch_assoc($log_transaksi)) {
    $log[] = $row;
}

$route = [];
if (mysqli_num_rows($log_transaksi) > 4) {
    $route = [
        [
            'kategori' => 'Diterima',
            'icon' => 'flaticon-inbox',
            'color' => 'secondary'
        ],
        [
            'kategori' => 'Pengerjaan',
            'icon' => 'flaticon-chain',
            'color' => 'primary'
        ],
        [
            'kategori' => 'Pengiriman',
            'icon' => 'flaticon-delivery-truck',
            'color' => 'warning'
        ],
        [
            'kategori' => 'Selesai',
            'icon' => 'flaticon-check',
            'color' => 'success'
        ],
    ];
} else {
    $route = [
        [
            'kategori' => 'Diterima',
            'icon' => 'flaticon-inbox',
            'color' => 'secondary'
        ],
        [
            'kategori' => 'Pengerjaan',
            'icon' => 'flaticon-chain',
            'color' => 'primary'
        ],
        [
            'kategori' => 'Selesai',
            'icon' => 'flaticon-check',
            'color' => 'success'
        ],
    ];
}
?>

<ul class="timeline">
    <?php for ($i=0; $i < count($route); $i++): ?>
        <li class="timeline-inverted">
            <div class="timeline-badge <?= $route[$i]['color'] ?>">
                <i class="<?= $route[$i]['icon'] ?>"></i>
            </div>
            <div class="timeline-panel">
                <div class="timline-heading">
                    <h4 class="timline-title text-uppercase font-weight-bold border-bottom mt--2"><?= $route[$i]['kategori'] ?></h4>
                </div>
                <div class="timline-body">
                    <?php for ($l=0; $l < count($log); $l++): ?>
                        <!-- <?= var_dump($log[$l]) ?> -->
                        <?php if ($route[$i]['kategori'] == 'Diterima' && $log[$l]['status'] == '0'): ?>
                            <dl>
                                <dt><span class="d-block text-muted"><?= date('d-M-Y H:i:s', strtotime($log[$l]['timestamp'])) ?></span></dt>
                                <dd>Diterima oleh <span class="text-uppercase"><?= $log[$i]['pegawai'] ?></span></dd>
                            </dl>
                        
                        <?php elseif ($route[$i]['kategori'] == 'Pengerjaan' && ($log[$l]['status'] == '1' || $log[$l]['status'] == '2')): ?>
                            <dl>
                                <dt><span class="d-block text-muted"><?= date('d-M-Y H:i:s', strtotime($log[$l]['timestamp'])) ?></span></dt>
                                <?php if ($log[$l]['status'] == '1'): ?>
                                    <dd>Laundry dikerjakan oleh <span class="text-uppercase"><?= $log[$i]['pegawai'] ?></span></dd>
                                <?php elseif ($log[$l]['status'] == '2'): ?>
                                    <dd>Laundry telah selesai dikerjakan oleh <span class="text-uppercase"><?= $log[$i]['pegawai'] ?></span></dd>
                                <?php endif; ?>
                            </dl>
                        
                        <?php elseif ($route[$i]['kategori'] == 'Pengiriman' && $log[$l]['status'] == '3'): ?>
                            <dl>
                                <dt><span class="d-block text-muted"><?= date('d-M-Y H:i:s', strtotime($log[$l]['timestamp'])) ?></span></dt>
                                <dd>Laundry sedang dikirim oleh <span class="text-uppercase"><?= $log[$i]['pegawai'] ?></span></dd>
                            </dl>
                        
                        <?php elseif ($route[$i]['kategori'] == 'Selesai' && $log[$l]['status'] == '4'): ?>
                            <dl>
                                <dt><span class="d-block text-muted"><?= date('d-M-Y H:i:s', strtotime($log[$l]['timestamp'])) ?></span></dt>
                                <dd>Laundry dinyatakan selesai oleh <span class="text-uppercase"><?= $log[$i]['pegawai'] ?></span></dd>
                            </dl>

                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </li>
    <?php endfor; ?>
</ul>
