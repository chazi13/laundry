<?php
include_once '../../sistem/koneksi.php';

$facebook = $_POST['facebook'];
$twitter = $_POST['twitter'];
$instagram = $_POST['instagram'];

$check = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM info_toko"));
if ($check < 1) {
    $query = mysqli_query($koneksi, "INSERT INTO info_toko (facebook, twitter, instagram) VALUES ('$facebook', '$twitter', '$instagram')");
} else {
    $query = mysqli_query($koneksi, "UPDATE info_toko SET facebook = '$facebook', twitter = '$twitter', instagram = '$instagram'");
}

if ($query) {
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'Info Sosmed Toko Telah Diupdate'
    ];
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Info Sosmed Toko Gagal Diupdate'
    ];
}
header('location: ../index.php?page=profil_toko');
 