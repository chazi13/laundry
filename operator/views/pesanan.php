<?php
$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE status < '4' ORDER BY status ASC, tgl_transaksi ASC");
?>

<div class="page-inner">
    <div class="row heading">
        <div class="col-8">
            <h2 class="pb-2 fw-bold"><?= $title ?></h2>
        </div>
        <div class="col-4 text-right ml-auto">
            <a href="index.php?page=add_pesanan" class="btn btn-primary btn-round btn-sm">
                <i class="fa fa-plus"></i> Tambah
            </a>
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
            <div class="card-body px-2">
                <table class="table table-striped table-bordered data-table">
                    <thead>
                        <th>Kode Transaksi</th>
                        <th>Pemesan</th>
                        <th width="20%">Alamat</th>
                        <th>Pengiriman</th>
                        <!-- <th>Total</th> -->
                        <th>Status</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($query)): ?>
                            <tr>
                                <td><?= $row['kode_transaksi'] ?></td>
                                <td>
                                    <span><?= $row['pemesan'] ?></span> <br>
                                    <span class="text-muted">Telp. <?= $row['telp'] ?></span>
                                </td>
                                <td><?= $row['alamat'] ?></td>
                                <td>
                                    <?= $row['logistik'] ?>
                                </td>
                                <!-- <td>Rp. <?= number_format($row['total'], '0', ',', '.') ?></td> -->
                                <td>
                                    <?php if ($row['status'] == '0') echo "<span class=\"badge badge-warning\">Menunggu</span>" ?>
                                    <?php if ($row['status'] == '1') echo "<span class=\"badge badge-info\">Dikerjakan</span>" ?>
                                    <?php if ($row['status'] == '2') echo "<span class=\"badge badge-primary\">Selesai Dikerjakan</span>" ?>
                                    <?php if ($row['status'] == '3') echo "<span class=\"badge badge-secondary\">Sedang Diantarkan</span>" ?>
                                    <?php if ($row['status'] == '4') echo "<span class=\"badge badge-success\">Selesai</span>" ?>
                                    <br>
                                    <span class="text-muted"><?= date('d-F-Y', strtotime($row['update_at'])) ?></span>
                                </td>
                                <td>
                                    <?php if ($row['status'] == '0'): ?>
                                        <a href="sistem/update_status_pesanan.php?s=1&k=<?= base64_encode($row['kode_transaksi']) ?>" class="btn btn-info btn-xs py-1" data-toggle="tooltip" data-placement="top" title="Tandai Dikerjakan"><i class="fa fa-clipboard-list fa-2x"></i></a>
                                    <?php elseif ($row['status'] == '1'): ?>
                                        <a href="sistem/update_status_pesanan.php?s=2&k=<?= base64_encode($row['kode_transaksi']) ?>" class="btn btn-primary btn-xs py-1" data-toggle="tooltip" data-placement="top" title="Tandai Selesai Dikerjakan"><i class="fa fa-tasks fa-2x"></i></a>
                                    <?php elseif ($row['status'] == '2' && $row['logistik'] == 'Diantar'): ?>
                                        <a href="sistem/update_status_pesanan.php?s=3&k=<?= base64_encode($row['kode_transaksi']) ?>" class="btn btn-secondary btn-xs py-1" data-toggle="tooltip" data-placement="top" title="Tandai Dikirim"><i class="fa fa-shipping-fast fa-2x"></i></a>
                                    <?php elseif ($row['status'] == '3' || ($row['status'] == '2' && $row['logistik'] == 'Ambil Sendiri')): ?>
                                        <a href="sistem/update_status_pesanan.php?s=4&k=<?= base64_encode($row['kode_transaksi']) ?>" class="btn btn-success btn-xs py-1" data-toggle="tooltip" data-placement="top" title="Tandai Selesai"><i class="fa fa-check fa-2x"></i></a>
                                    <?php endif; ?>

                                    <a href="#detail-transaksi" class="btn btn-dark btn-xs btn-detail-transaksi py-1" data-toggle="modal" data-target="#detail-transaksi" data-kt="<?= base64_encode($row['kode_transaksi']) ?>"><i class="fa fa-file-invoice fa-2x"  data-toggle="tooltip" data-placement="top" title="Detail Transaksi"></i></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
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
                <a href="cetak_struk.php?k=" id="btn-print-struk" class="btn btn-primary" target="_blank" onclick="return false">
                    <i class="fa fa-print"></i>
                    <span>Print</span>
                </a>
            </div>
        </div>
    </div>
</div>
