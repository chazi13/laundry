<?php
$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE status < '4' AND id_member = '$_SESSION[id]' ORDER BY status ASC, tgl_transaksi ASC");
?>

<div class="page-inner">
    <div class="row heading">
        <div class="col-8">
            <h2 class="pb-2 fw-bold"><?= $title ?></h2>
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
    <div class="row">
            <?php if (mysqli_num_rows($query) < 1): ?>
                <div class="col-12">
                    <div class="alert alert-danger fade show" role="alert">
                        <p>Belum ada catatan pesanan saat ini</p>
                    </div>
                </div>
            <?php else: ?>
                <?php while ($row = mysqli_fetch_assoc($query)): ?>
                    <div class="col-xs-12 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <dl>
                                            <dt class="text-uppercase text-muted font-weight-bolde">Kode Transaksi</dt>
                                            <dd><?= $row['kode_transaksi'] ?></dd>
                                        </dl>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-outline-primary btn-sm btn-detail-transaksi float-right" data-toggle="modal" data-target="#detail-transaksi" data-kt="<?= base64_encode($row['kode_transaksi']) ?>">Detail</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8 col-xl-6 pr-1">
                                        <dl>
                                            <dt class="text-uppercase text-muted font-weight-bolde">Status Pengerjaan</dt>
                                            <dd>
                                                <?php if ($row['status'] == '0') echo "<span class=\"badge badge-warning\">Menunggu</span>" ?>
                                                <?php if ($row['status'] == '1') echo "<span class=\"badge badge-info\">Dikerjakan</span>" ?>
                                                <?php if ($row['status'] == '2') echo "<span class=\"badge badge-primary\">Selesai Dikerjakan</span>" ?>
                                                <?php if ($row['status'] == '3') echo "<span class=\"badge badge-secondary\">Sedang Diantarkan</span>" ?>
                                                <?php if ($row['status'] == '4') echo "<span class=\"badge badge-success\">Selesai</span>" ?>
                                                <!-- <br> -->
                                                <span class="d-inline">(<?= date('d M Y, H:i:s', strtotime($row['update_at'])) ?>)</span>
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="col-4 col-xl-6 pl-1">
                                        <dl class="ml-auto d-inline text-right">
                                            <dt class="text-uppercase text-muted font-weight-bolde">Total</dt>
                                            <dd class=>Rp. <?= number_format($row['total'], 0, ',', '.') ?></dd>
                                        </dl>
                                    </div>
                                    <hr class="mt--2 mb-2">
                                </div>
                            </div>
                            <div class="card-footer bg-grey1">
                                <div class="card-title">Detail Produk</div>
                                <div class="row">
                                    <?php
                                        $query_detail = mysqli_query($koneksi, "SELECT detail_transaksi.nama_produk, detail_transaksi.qty, produk.icon, produk.harga AS harga_satuan FROM detail_transaksi JOIN produk ON detail_transaksi.id_produk = produk.id_produk WHERE kode_transaksi = '$row[kode_transaksi]'");
                                        while ($row_detail = mysqli_fetch_assoc($query_detail)): ?>
                                        
                                        <div class="col-xs-12 col-sm-6 mt-2 p-2 border-left-after border-bottom-after-xs">
                                            <div class="avatar-lg float-left mr-2">
                                                <img src="<?= '../' . $row_detail['icon'] ?>" alt="<?= $row_detail['nama_produk'] ?>" class="avatar-img">
                                            </div>
                                            <div class="info">
                                                <span>
                                                    <h5 class="mb-0 mt-1"><?= $row_detail['nama_produk'] ?></h5>
                                                    <span class="user-level mt-0"><?= $row_detail['qty'] . ' @ ' . $row_detail['harga_satuan'] ?></span>
                                                </span>
                                            </div>
                                        </div>
                                            
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
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
