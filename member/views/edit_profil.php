<?php
$data_member = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM member WHERE id_member = '$_SESSION[id]'"));
?>

<div class="page-inner">
    <div class="row heading">
        <div class="col-12">
            <h2 class="pb-2 fw-bold"><?= $title ?></h2>
        </div>
    </div>

    <div class="card">
        <form action="sistem/update_profil.php" method="post">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="id">ID :</label>
                        <input type="text" name="id" id="id" class="form-control" placeholder="<?= $data_member['id_member'] ?>" disabled>
                        <input type="hidden" name="id" value="<?= $data_member['id_member'] ?>">
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="nama">Nama :</label>
                        <input type="text" name="nama" id="nama" class="form-control" autocomplete="name" value="<?= $data_member['nama'] ?>" placeholder="Masukan Nama Member" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jk" class="d-block">Jenis Kelamin</label>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="l" name="jenis_kelamin" value="L" <?= ($data_member['jenis_kelamin'] == 'L') ? 'checked' : '' ?> class="custom-control-input">
                        <label class="custom-control-label" for="l">Laki-laki</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="p" name="jenis_kelamin" value="P" <?= ($data_member['jenis_kelamin'] == 'P') ? 'checked' : '' ?> class="custom-control-input">
                        <label class="custom-control-label" for="p">Perempuan</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="telp">Telp :</label>
                    <input type="text" name="telp" id="telp" class="form-control" autocomplete="tel" value="<?= $data_member['telp'] ?>" pattern="^[08][0-9]{11,15}" title="Masukan Nomor Telpon yang valid, seperti 085774237xxx. Telp hanya bisa berisi angka" placeholder="Masukan Telp Member" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat :</label>
                    <textarea name="alamat" id="alamat" rows="3" class="form-control" autocomplete="street-address" placeholder="Masukan Alamat Member"><?= $data_member['alamat'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="password">Password :</label>
                    <input type="password" name="password" id="password" class="form-control" autocomplete="new-password" placeholder="********">
                    <small id="password-help" class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
                </div>
            </div>
            <div class="card-footer"><input type="submit" value="Save" class="btn btn-primary"></div>
        </form>
    </div>
</div>