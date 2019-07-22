<?php
$info_toko = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM info_toko"));
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

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <form action="sistem/info_kontak.php" method="post">
                <div class="card">
                    <div class="card-header with-border">
                        <h4 class="card-title">Informasi Kontak</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_toko">Nama Toko :</label>
                            <input type="text" name="nama_toko" value="<?= $info_toko['nama_toko'] ?>" id="nama_toko" class="form-control" placeholder="Masukan Nama Toko">
                        </div>
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" name="email" value="<?= $info_toko['email'] ?>" id="email" class="form-control" placeholder="Masukan Email">
                        </div>
                        <div class="form-group">
                            <label for="telp">Telp :</label>
                            <input type="text" name="telp" value="<?= $info_toko['telp'] ?>" id="telp" class="form-control" placeholder="Masukan Telp">
                        </div>
                        <div class="form-group">
                            <label for="fax">Fax :</label>
                            <input type="text" name="fax" value="<?= $info_toko['fax'] ?>" id="fax" class="form-control" placeholder="Masukan Fax">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap :</label>
                            <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Masukan Alamat Lengkap"><?= $info_toko['alamat'] ?></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="simpan" value="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 col-sm-12">
            <form action="sistem/info_sosmed.php" method="post">
                <div class="card">
                    <div class="card-header with-border">
                        <h4 class="card-title">Informasi Sosial Media</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="text" name="facebook" value="<?= $info_toko['facebook'] ?>" id="facebook" class="form-control" placeholder="Masukan Link Facebook">
                        </div>
                        <div class="form-group">
                            <label for="twitter">Twitter</label>
                            <input type="text" name="twitter" value="<?= $info_toko['twitter'] ?>" id="twitter" class="form-control" placeholder="Masukan Link Twitter">
                        </div>
                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input type="text" name="instagram" value="<?= $info_toko['instagram'] ?>" id="instagram" class="form-control" placeholder="Masukan Link Instagram">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="simpan" value="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-12">
            <form action="sistem/info_tentang.php" method="post">
                <div class="card">
                    <div class="card-header with-border">
                        <h4 class="card-title">Tentang Toko</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tentang">Tentang</label>
                            <textarea name="tentang" id="tentang" rows="3" class="form-control texteditor"><?= @$info_toko['tentang'] ?></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="simpan" value="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
