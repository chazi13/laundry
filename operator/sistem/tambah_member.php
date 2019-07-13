<?php
include_once '../../sistem/koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$telp = $_POST['telp'];
$password = md5($_POST['password']);

$query = mysqli_query($koneksi, "INSERT INTO admin (id_admin, nama, jenis_kelamin, alamat, telp, password) VALUES ('$id', '$nama', '$jenis_kelamin', '$alamat', '$telp', '$password')");
if (!mysqli_error()) {
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'Member Berhasil ditambahkan'
    ];
    header('location: ../index.php?page=member');
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Member Gagal ditambahkan'
    ];
    header('location: ../index.php?page=member');
}
