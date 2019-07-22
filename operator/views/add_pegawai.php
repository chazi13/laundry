<?php
$last_id = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUBSTR(id_admin, 3, 3) AS id FROM admin ORDER BY id_admin DESC LIMIT 0,1"));
$prefix = 'OP';
$new_id = sprintf('%03d', $last_id['id'] + 1);
$full_id = $prefix . $new_id;
?>

<div class="page-inner">
    <div class="row heading">
        <div class="col-12">
            <h2 class="pb-2 fw-bold"><?= $title ?></h2>
        </div>
    </div>

    <div class="card">
        <form action="sistem/add_pegawai.php" method="post">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="id">ID :</label>
                        <input type="text" name="id" id="id" class="form-control" placeholder="<?= $full_id ?>" disabled>
                        <input type="hidden" name="id" value="<?= $full_id ?>">
                    </div>
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="nama">Nama :</label>
                        <input type="text" name="nama" id="nama" class="form-control" autocomplete="name" placeholder="Masukan Nama Pegawai" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jk" class="d-block">Jenis Kelamin</label>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="l" name="jenis_kelamin" value="L" class="custom-control-input">
                        <label class="custom-control-label" for="l">Laki-laki</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="p" name="jenis_kelamin" value="P" class="custom-control-input">
                        <label class="custom-control-label" for="p">Perempuan</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" class="form-control" autocomplete="email" placeholder="Masukan Email Pegawai" required>
                </div>
                <div class="form-group">
                    <label for="telp">Telp :</label>
                    <input type="number" name="telp" id="telp" class="form-control" autocomplete="tel" pattern="^[08][0-9]{10,15}" title="Masukan Nomor Telpon yang valid, seperti 085774237xxx. Telp hanya bisa berisi angka" placeholder="Masukan Telp Pegawai" required>
                </div>
                <div class="form-group">
                    <label for="password">Password :</label>
                    <input type="password" name="password" id="password" class="form-control" autocomplete="new-password" placeholder="********" required>
                </div>
            </div>
            <div class="card-footer"><input type="submit" value="Save" class="btn btn-primary"></div>
        </form>
    </div>
</div>