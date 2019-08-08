<?php
$b = @$_GET['bulan'] ? $_GET['bulan'] : date('m');
$t = @$_GET['tahun'] ? $_GET['tahun'] : date('Y');
$query = mysqli_query($koneksi, "SELECT * FROM jurnal WHERE DATE_FORMAT(tanggal, '%Y-%m-%d') BETWEEN '$t-$b-01' AND '$t-$b-32'  ORDER BY tanggal ASC");
$bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

$last_jurnal_kode = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUBSTR(kode_jurnal, 5, 5) AS id FROM jurnal ORDER BY kode_jurnal DESC"));
$prefix_code = 'JNL-';
$new_kode = sprintf('%05d', $last_jurnal_kode['id'] + 1);
$kode_jurnal = $prefix_code . $new_kode;

$saldo_debet = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(nominal) AS debet FROM jurnal WHERE DATE_FORMAT(tanggal, '%Y-%m-%d') < '$t-$b-01' AND jenis = 'debet'"));
$saldo_kredit = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(nominal) AS kredit FROM jurnal WHERE DATE_FORMAT(tanggal, '%Y-%m-%d') < '$t-$b-01' AND jenis = 'kredit'"));
$saldo = $saldo_debet['debet'] - $saldo_kredit['kredit'];
?>

<div class="page-inner">
    <?php if (@$_SESSION['pesan']): ?>
        <div class="alert alert-<?= $_SESSION['pesan']['status'] == 'error' ? 'danger' : $_SESSION['pesan']['status'] ?> alert-dismisable fade show" role="alert">
            <button class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <p><?= $_SESSION['pesan']['msg'] ?></p>
        </div>
    <?php endif; ?>

    <div class="main-content">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <form id="form-jurnal" action="sistem/add_jurnal.php" method="post">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Jurnal</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-row form-group">
                                <label for="kode_jurnal" class="col-3">Kode Jurnal</label>
                                <div class="col-9">
                                    <input type="text" name="kode_jurnal" value="<?= $kode_jurnal ?>" id="kode_jurnal" readonly class="form-control">
                                </div>
                            </div>
                            <div class="form-row form-group">
                                <label for="tanggal" class="col-3">Tanggal</label>
                                <div class="col-9">
                                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row form-group">
                                <label for="keterangan" class="col-3">Keterangan</label>
                                <div class="col-9">
                                    <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan" required>
                                </div>
                            </div>
                            <div class="form-row form-group">
                                <label for="jenis" class="col-3">Jenis</label>
                                <div class="col-9">
                                    <select name="jenis" id="jenis" class="form-control">
                                        <option value="debet">Debet</option>
                                        <option value="kredit">Kredit</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row form-group">
                                <label for="nominal" class="col-3">Nominal</label>
                                <div class="col-9">
                                    <input type="number" name="nominal" id="nominal" class="form-control" placeholder="Masukan Nominal">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-top">
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-9">
                                    <button type="submit" class="btn btn-primary">Simpan <i class=""></i></button>
                                    <button type="reset" class="btn btn-danger">Kosongkan <i class=""></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-bottom">
                <div class="row mb-2">
                    <div class="col-8">
                        <h4 class="card-title"><?= $title ?></h2>
                    </div>
                    <div class="col-4 text-right ml-auto">
                        <form action="index.php" method="get">
                            <input type="hidden" name="page" value="jurnal">
                            <div class="row">
                                <div class="col p-1">
                                    <select name="bulan" id="" class="form-control">
                                        <option value="" disabled>Bulan</option>
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
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>Kode Jurnal</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                            <th>Aksi</th>
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
                                    <td><?= $row['keterangan'] ?></td>
                                    <td>Rp. <?= ($row['jenis'] == 'debet') ? number_format($row['nominal'], 0, ',', '.') : '' ?></td>
                                    <td>Rp. <?= ($row['jenis'] == 'kredit') ? number_format($row['nominal'], 0, ',', '.') : '' ?></td>
                                    <td>Rp. <?php $saldo = ($row['jenis'] == 'debet') ? $saldo + $row['nominal'] : $saldo - $row['nominal']; echo number_format($saldo, 0, ',', '.') ?></td>
                                    <td>
                                        <a href="#form-jurnal" class="btn btn-info btn-xs btn-edit-jurnal" data-jurnal="<?= base64_encode(json_encode($row)) ?>"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                        <tfoot>
                            <th colspan="5">Total</th>
                            <th colspan="2">Rp. <?= number_format($saldo, 0, ',', '.') ?></th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>