<?php
$b = @$_GET['bulan'] ? $_GET['bulan'] : date('m');
$t = @$_GET['tahun'] ? $_GET['tahun'] : date('Y');
$query = mysqli_query($koneksi, "SELECT *, jurnal.saldo AS saldo_jurnal FROM jurnal JOIN coa ON jurnal.coa_id = coa.no_coa WHERE DATE_FORMAT(tanggal, '%Y-%m-%d') BETWEEN '$t-$b-01' AND '$t-$b-32'  ORDER BY tanggal ASC");
$bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

$last_jurnal_kode = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUBSTR(kode_jurnal, 5, 5) AS id FROM jurnal ORDER BY kode_jurnal DESC"));
$prefix_code = 'JNL-';
$new_kode = sprintf('%05d', $last_jurnal_kode['id'] + 1);
$kode_jurnal = $prefix_code . $new_kode;

$query_coa = mysqli_query($koneksi, "SELECT * FROM coa");

$saldo_debet = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jurnal.saldo) AS debet FROM jurnal JOIN coa ON jurnal.coa_id = coa.no_coa WHERE DATE_FORMAT(tanggal, '%Y-%m-%d') < '$t-$b-01' AND coa.gol = 'D'"));
$saldo_kredit = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jurnal.saldo) AS kredit FROM jurnal JOIN coa ON jurnal.coa_id = coa.no_coa WHERE DATE_FORMAT(tanggal, '%Y-%m-%d') < '$t-$b-01' AND coa.gol = 'C'"));
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
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <form id="form-jurnal" action="sistem/add_jurnal.php" method="post">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Jurnal</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-row form-group">
                                <label for="kode_jurnal" class="col-3">ID</label>
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
                                <label for="coa" class="col-3">Jenis COA</label>
                                <div class="col-9">
                                    <select name="coa_id" id="select-coa" class="form-control">
                                        <option value="" disabled selected>Pilih COA</option>
                                        <?php while($coa_row = mysqli_fetch_assoc($query_coa)): ?>
                                            <option value="<?= $coa_row['no_coa'] ?>" data-saldo="<?= $coa_row['saldo'] ?>"><?= $coa_row['nama_coa'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row form-group">
                                <label for="saldo" class="col-3">Saldo</label>
                                <div class="col-9">
                                    <input type="number" name="saldo" id="saldo" class="form-control" placeholder="Masukan Saldo">
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
                    <div class="col-lg-6 col-md-12">
                        <h4 class="card-title"><?= $title ?></h2>
                    </div>
                    <div class="col-lg-6 col-md-12 text-right ml-auto">
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
                                <div class="col p-1">
                                    <a href="cetak_jurnal.php?&bulan=<?= $b ?>&tahun=<?= $t ?>" target="_blank" class="btn btn-success">
                                        <i class="fa fa-print"></i> Cetak
                                    </a>
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
                            <th>ID</th>
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
                                    <td>Rp. <?= ($row['gol'] == 'D') ? number_format($row['saldo_jurnal'], 0, ',', '.') : '' ?></td>
                                    <td>Rp. <?= ($row['gol'] == 'C') ? number_format($row['saldo_jurnal'], 0, ',', '.') : '' ?></td>
                                    <td>Rp. <?php $saldo = ($row['gol'] == 'D') ? $saldo + $row['saldo_jurnal'] : $saldo - $row['saldo_jurnal']; echo number_format($saldo, 0, ',', '.') ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                        <tfoot>
                            <th colspan="6">Total</th>
                            <th colspan="1">Rp. <?= number_format($saldo, 0, ',', '.') ?></th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
