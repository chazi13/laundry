<?php
$b = @$_GET['bulan'] ? $_GET['bulan'] : date('m');
$t = @$_GET['tahun'] ? $_GET['tahun'] : date('Y');
if ($b !== 'semua') {
    $query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE status >= '4' AND DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') BETWEEN '$t-$b-01' AND '$t-$b-32'  ORDER BY status ASC, tgl_transaksi ASC");
} else {
    $query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE status >= '4' AND DATE_FORMAT(tgl_transaksi, '%Y') = '$t'  ORDER BY status ASC, tgl_transaksi ASC");
}
$bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
$total = 0;
?>

<div class="page-inner">
    <div class="row heading mb-2">
        <div class="col-8">
            <h2 class="pb-2 fw-bold"><?= $title ?></h2>
        </div>
        <div class="col-4 text-right ml-auto">
            <form action="index.php" method="get">
                <input type="hidden" name="page" value="laporan">
                <div class="row">
                    <div class="col p-1">
                        <select name="bulan" id="" class="form-control">
                            <option value="" disabled>Bulan</option>
                            <option value="semua">Semua</option>
                            <?php for ($i=1; $i <= 12; $i++): $sb = (strlen($i) < 2) ? '0'.$i : $i; ?>
                                <option value="<?= $sb; ?>" <?= ($sb == $b) ? 'selected' : '' ?>><?= $bulan[$i-1] ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col p-1">
                        <select name="tahun" id="" class="form-control">
                            <option value="" disabled>Tahun</option>
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

    <?php if (@$_SESSION['pesan']): ?>
        <div class="alert alert-<?= $_SESSION['pesan']['status'] == 'error' ? 'danger' : $_SESSION['pesan']['status'] ?> alert-dismisable fade show" role="alert">
            <button class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <p><?= $_SESSION['pesan']['msg'] ?></p>
        </div>
    <?php endif; ?>

    <div class="main-content">
        <div class="card">
            <div class="card-header with-border">
                <h4 class="d-inline float-left card-title"><?= (is_numeric($b)) ? 'Bulan ' . $bulan[$b-1] . ',' : 'Tahun' ?> <?= $t ?></h4>
                <div class="d-inline float-right ml-auto text-right">
                    <a href="cetak_laporan.php?bulan=<?= $b ?>&tahun=<?= $t ?>" class="btn btn-outline-primary py-1" target="_blank">
                        <i class="fa fa-print"></i>
                        <span>Print</span>
                    </a>
                </div>
            </div>
            <div class="card-body px-2">
                <table class="table table-striped table-bordered data-table">
                    <thead>
                        <th width="13%">Kode Transaksi</th>
                        <th>Pemesan</th>
                        <th width="16%">Tanggal</th>
                        <th width="30%">Alamat</th>
                        <th>Total</th>
                        <!-- <th>Status</th> -->
                        <th>Aksi</th>
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
                                    <?= date('d M Y', strtotime($row['tgl_transaksi'])) ?>
                                </td>
                                <td><?= $row['alamat'] ?></td>
                                <td>Rp. <?= number_format($row['total'], '0', ',', '.') ?></td>
                                <!-- <td>
                                    <?php if ($row['status'] == '0') echo "<span class=\"badge badge-warning\">Menunggu</span>" ?>
                                    <?php if ($row['status'] == '1') echo "<span class=\"badge badge-info\">Dikerjakan</span>" ?>
                                    <?php if ($row['status'] == '2') echo "<span class=\"badge badge-primary\">Selesai Dikerjakan</span>" ?>
                                    <?php if ($row['status'] == '3') echo "<span class=\"badge badge-secondary\">Sedang Diantarkan</span>" ?>
                                    <?php if ($row['status'] == '4') echo "<span class=\"badge badge-success\">Selesai</span>" ?>
                                </td> -->
                                <td>
                                    <a href="#detail-transaksi" class="btn btn-dark btn-xs btn-detail-transaksi py-1" data-toggle="modal" data-target="#detail-transaksi" data-kt="<?= base64_encode($row['kode_transaksi']) ?>"><i class="fa fa-file-invoice fa-2x"  data-toggle="tooltip" data-placement="top" title="Detail Transaksi"></i></a>
                                </td>
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
            </div>
        </div>
    </div>
</div>

<div id="detail-transaksi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detail-transaksi-title" aria-modal="true" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="detail-transaksi-title">Detail Transaksi</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body detail-content">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <a href="cetak_struk.php?k=" id="btn-print-struk" class="btn btn-primary" target="_blank" onclick="return false">
                    <i class="fa fa-print"></i>
                    <span>Print</span>
                </a> -->
            </div>
        </div>
    </div>
</div>
