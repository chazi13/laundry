<?php
$query = mysqli_query($koneksi, "SELECT * FROM klasifikasi");
?>

<div class="page-inner">
    <div class="row heading">
        <div class="col-7">
            <h2 class="pb-2 fw-bold"><?= $title ?></h2>
        </div>
        <div class="col-5 text-right ml-auto">
            <a href="#add_klasifikasi" class="btn btn-primary btn-round btn-sm" data-toggle="modal" data-target="#add_klasifikasi">
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
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <th>No</th>
                            <th>Nama Klasifikasi</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                                <tr>
                                    <td><?= $row['id_klasifikasi'] ?></td>
                                    <td><?= $row['nama_klasifikasi'] ?></td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-xs btn-edit-klasifikasi" data-toggle="modal" data-target="#edit_klasifikasi" data-klasifikasi="<?= base64_encode(json_encode($row)) ?>"><i class="fa fa-pen"></i></a>
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

<div class="modal fade" id="add_klasifikasi" tabindex="-1" role="dialog" aria-labelledby="add_klasifikasiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="sistem/add_klasifikasi.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_klasifikasiLabel">Tambah Klasifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Klasifikasi :</label>
                        <input type="text" name="nama_klasifikasi" id="nama" class="form-control" autocomplete="name" autofocus placeholder="Masukan Nama Klasifikasi" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_klasifikasi" tabindex="-1" role="dialog" aria-labelledby="edit_klasifikasiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="sistem/edit_klasifikasi.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_klasifikasiLabel">Edit Klasifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_nama">Nama Klasifikasi :</label>
                        <input type="hidden" name="id_klasifikasi" id="id_klasifikasi">
                        <input type="text" name="nama_klasifikasi" id="edit_nama" class="form-control" autocomplete="name" autofocus placeholder="Masukan Nama Klasifikasi" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
