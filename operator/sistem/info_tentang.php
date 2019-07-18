<?php
include_once '../../sistem/koneksi.php';

$tentang = $_POST['tentang'];

$check = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM info_toko"));
if ($check < 1) {
    $query = mysqli_query($koneksi, "INSERT INTO info_toko (tentang) VALUES ('$tentang')");
} else {
    $query = mysqli_query($koneksi, "UPDATE info_toko SET tentang = '$tentang'");
}

if ($query) {
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'Info Tentang Toko Telah Diupdate'
    ];
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Info Tentang Toko Gagal Diupdate'
    ];
}
header('location: ../index.php?page=profil_toko');
 