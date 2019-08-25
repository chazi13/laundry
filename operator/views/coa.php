<?php
$query = mysqli_query($koneksi, "SELECT * FROM coa JOIN klasifikasi ON coa.klasifikasi = klasifikasi.id_klasifikasi");
$klasifikasi_query = mysqli_query($koneksi, "SELECT * FROM klasifikasi");
$data_klasifikasi = [];
while ($krow = mysqli_fetch_assoc($klasifikasi_query)) {
    $data_klasifikasi[] = $krow;
}
?>

<div class="page-inner">
    <div class="row heading">
        <div class="col-7">
            <h2 class="pb-2 fw-bold"><?= $title ?></h2>
        </div>
        <div class="col-5 text-right ml-auto">
            <a href="#add_coa" class="btn btn-primary btn-round btn-sm" data-toggle="modal" data-target="#add_coa">
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
                            <th>No COA</th>
                            <th>Nama COA</th>
                            <th>GOL</th>
                            <th>Klasifikasi</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                                <tr>
                                    <td><?= $row['no_coa'] ?></td>
                                    <td><?= $row['nama_coa'] ?></td>
                                    <td><?= $row['gol'] ?></td>
                                    <td><?= $row['nama_klasifikasi'] ?></td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-xs btn-edit-coa" data-toggle="modal" data-target="#edit_coa" data-coa="<?= base64_encode(json_encode($row)) ?>"><i class="fa fa-pen"></i></a>
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

<div class="modal fade" id="add_coa" tabindex="-1" role="dialog" aria-labelledby="add_coaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="sistem/add_coa.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_coaLabel">Tambah COA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="no-coa">NO. COA :</label>
                        <input type="text" name="no_coa" id="no-coa" class="form-control" autofocus placeholder="Masukan No. COA" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama COA :</label>
                        <input type="text" name="nama_coa" id="nama" class="form-control" placeholder="Masukan Nama COA" required>
                    </div>
                    <div class="form-group">
                        <label for="gol">GOl :</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="debet" name="gol" value="D" class="custom-control-input">
                            <label class="custom-control-label" for="debet">Debet</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="kredit" name="gol" value="C" class="custom-control-input">
                            <label class="custom-control-label" for="kredit">Kredit</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="klasifiakasi">Klasifikasi :</label>
                        <select name="klasifikasi" id="klasifikasi" class="form-control">
                            <option value="">Pilih Klasifikasi</option>
                            <?php foreach($data_klasifikasi as $v): ?>
                                <option value="<?=  $v['id_klasifikasi'] ?>"><?= $v['nama_klasifikasi'] ?></option>
                            <?php endforeach; ?>
                        </select>
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

<div class="modal fade" id="edit_coa" tabindex="-1" role="dialog" aria-labelledby="edit_coaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="sistem/edit_coa.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_coaLabel">Edit COA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="no-coa">NO. COA :</label>
                        <input type="text" name="no_coa" id="edit-no-coa" class="form-control" autofocus placeholder="Masukan No. COA" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama COA :</label>
                        <input type="text" name="nama_coa" id="edit-nama" class="form-control" placeholder="Masukan Nama COA" required>
                    </div>
                    <div class="form-group">
                        <label for="gol">GOl :</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="edit-debet" name="edit-coa-gol" value="D" class="custom-control-input">
                            <label class="custom-control-label" for="edit-debet">Debet</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="edit-kredit" name="edit-coa-gol"  value="C" class="custom-control-input">
                            <label class="custom-control-label" for="edit-kredit">Kredit</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="klasifiakasi">Klasifikasi :</label>
                        <select name="klasifikasi" id="edit-klasifikasi" class="form-control">
                            <option value="">Pilih Klasifikasi</option>
                            <?php foreach($data_klasifikasi as $v): ?>
                                <option value="<?= $v['id_klasifikasi'] ?>"><?= $v['nama_klasifikasi'] ?></option>
                            <?php endforeach; ?>
                        </select>
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
