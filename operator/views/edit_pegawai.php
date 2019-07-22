<?php
$id_pegawai = @$_GET['id_pegawai'] ? $_GET['id_pegawai'] : $_SESSION['id'];
$data_pegawai = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin = '$id_pegawai'"));
?>

<div class="page-inner">
    <div class="row heading">
        <div class="col-12">
            <h2 class="pb-2 fw-bold"><?= $title ?></h2>
        </div>
    </div>

    <div class="card">
        <form action="sistem/update_pegawai.php" method="post">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="id">ID :</label>
                        <input type="text" id="id" class="form-control" placeholder="<?= $data_pegawai['id_admin'] ?>" disabled>
                        <input type="hidden" name="id" value="<?= $data_pegawai['id_admin'] ?>">
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="nama">Nama :</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $data_pegawai['nama'] ?>" autocomplete="name" placeholder="Masukan Nama Pegawai" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jk" class="d-block">Jenis Kelamin</label>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="l" name="jenis_kelamin" value="L" <?= ($data_pegawai['jenis_kelamin'] == 'L') ? 'checked' : '' ?> class="custom-control-input">
                        <label class="custom-control-label" for="l">Laki-laki</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="p" name="jenis_kelamin" value="P" <?= ($data_pegawai['jenis_kelamin'] == 'P') ? 'checked' : '' ?> class="custom-control-input">
                        <label class="custom-control-label" for="p">Perempuan</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?= $data_pegawai['email'] ?>" autocomplete="email" placeholder="Masukan Email Pegawai" required>
                </div>
                <div class="form-group">
                    <label for="telp">Telp :</label>
                    <input type="number" name="telp" id="telp" class="form-control" value="<?= $data_pegawai['telp'] ?>" autocomplete="tel" pattern="^[08][0-9]{10,15}" title="Masukan Nomor Telpon yang valid, seperti 085774237xxx. Telp hanya bisa berisi angka" placeholder="Masukan Telp Pegawai" required>
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