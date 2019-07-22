<?php
$query = mysqli_query($koneksi, "SELECT * FROM diskon");
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
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>Pemesanan</th>
                            <th>Potongan</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                                <tr>
                                    <td><?= $row['pemesanan'] ?>&times;</td>
                                    <td><?= $row['potongan'] ?>&percnt;</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-xs btn-edit-diskon" data-toggle="modal" data-target="#edit-diskon" data-diskon="<?= base64_encode(json_encode($row)) ?>"><i class="fa fa-pen"></i></a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-diskon" tabindex="-1" role="dialog" aria-labelledby="edit-diskon-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="sistem/update_diskon.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h3 class="modal-title" id="edit-diskon-label">Edit Diskon</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-pemesanan-diskon">Pemesanan</label>
                        <div class="input-group">
                            <input type="text" name="pemesanan" id="edit-pemesanan-diskon" class="form-control" aria-label="pemesanan" placeholder="Masukan jumlah minimal pemesanan" pattern="[0-9].{0,3}" required>
                            <div class="input-group-append">
                                <span class="input-group-text">&times;</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit-potongan-diskon">Potongan</label>
                        <div class="input-group">
                            <input type="text" name="potongan" id="edit-potongan-diskon" class="form-control" aria-label="potongan" placeholder="Masukan jumlah persentase potongan" pattern="[0-9].{0,}" required>
                            <div class="input-group-append">
                                <span class="input-group-text">&percnt;</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


