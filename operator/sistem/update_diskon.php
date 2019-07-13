<?php
include_once '../../sistem/koneksi.php';

$pemesanan = $_POST['pemesanan'];
$potongan = $_POST['potongan'];

$query = mysqli_query($koneksi, "UPDATE diskon SET pemesanan = '$pemesanan', potongan = '$potongan'");
if ($query) {
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'Diskon telah diupdate'
    ];
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Diskon gagal diupdate'
    ];
}

header('location: ../index.php?page=diskon');
