<?php
include_once '../../sistem/koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$email = $_POST['email'];
$telp = $_POST['telp'];

$update_password = '';
if (@$_POST['password'] && $_POST['password'] !== '') {
    $password = md5($_POST['password']);
    $update_password = ", password = '$password'";
}

$data_type = ($id == $_SESSION['id']) ? 'Profil' : 'Pegawai';

$query = mysqli_query($koneksi, "UPDATE admin SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', email = '$email', telp = '$telp' $update_password WHERE id_admin = '$id'");
if ($query) {
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'Data ' . $data_type . ' Berhasil diubah'
    ];
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Data ' . $data_type . ' Gagal diubah'
    ];
}
header('location: ../index.php?page=pegawai');
