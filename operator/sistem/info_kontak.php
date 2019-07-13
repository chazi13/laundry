<?php
include_once '../../sistem/koneksi.php';

$nama_toko = $_POST['nama_toko'];
$email = $_POST['email'];
$telp = $_POST['telp'];
$fax = $_POST['fax'];
$alamat = $_POST['alamat'];

$check = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM info_toko"));
if ($check < 1) {
    $query = mysqli_query($koneksi, "INSERT INTO info_toko (nama_toko, email, telp, fax, alamat) VALUES ('$nama_toko', '$email', '$telp', '$fax', '$alamat')");
} else {
    $query = mysqli_query($koneksi, "UPDATE info_toko SET nama_toko = '$nama_toko', email = '$email', telp = '$telp', fax = '$fax', alamat = '$alamat'");
}

if ($query) {
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'Info Kontak Toko Telah Diupdate'
    ];
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Info Kontak Toko Gagal Diupdate'
    ];
}
header('location: ../index.php?page=profil_toko');
 