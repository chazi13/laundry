<?php
$pesanan_counter = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT counter FROM diskon_counter WHERE id_member = '$_SESSION[id]'"));
$diskon = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM diskon"));
$menunggu = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT count(kode_transaksi) AS jml FROM transaksi WHERE status = '0' AND id_member = '$_SESSION[id]'"));
$dikerjakan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT count(kode_transaksi) AS jml FROM transaksi WHERE status = '1' AND id_member = '$_SESSION[id]'"));
$selesai = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT count(kode_transaksi) AS jml FROM transaksi WHERE status = '4' AND id_member = '$_SESSION[id]'"));
?>

<div class="page-inner">
    <div class="row heading">
        <div class="col-8">
            <h2 class="pb-2 fw-bold"><?= $title ?></h2>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big tect-center bubble-shadow-small icon-secondary"><i class="flaticon-inbox"></i></div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Menunggu</p>
                                <h4 class="card-title"><?= $menunggu['jml'] ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big tect-center bubble-shadow-small icon-primary"><i class="flaticon-repeat"></i></div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Dikerjakan</p>
                                <h4 class="card-title"><?= $dikerjakan['jml'] ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big tect-center bubble-shadow-small icon-success"><i class="flaticon-check"></i></div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                            <div class="numbers">
                                <p class="card-category">Selesai</p>
                                <h4 class="card-title"><?= $selesai['jml'] ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    <?php if ($pesanan_counter['counter'] < $diskon['pemesanan']): ?>
        <div class="alert alert-primary fade show" role="alert">
            <p>Ayo laundry <?= ($diskon['pemesanan'] - $pesanan_counter['counter']) ?> kali lagi dan dapat kan potongan <?= $diskon['potongan'] ?>&percnt;</p>
        </div>
    <?php endif; ?>
</div>