<?php
include_once '../../sistem/koneksi.php';

$id_produk = $_GET['id_produk'];
$data_pegawai = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama FROM produk WHERE id_produk = '$id_produk'"));
$query = mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk = '$id_produk'");
if ($query) {
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'Data Produk ' . $data_pegawai['nama'] . ' telah dihapus!'
    ];
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Data Produk ' . $data_pegawai['nama'] . ' gagal dihapus!'
    ];
}
header('location: ../index.php?page=produk');
