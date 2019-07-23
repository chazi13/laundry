<?php
include_once '../../sistem/koneksi.php';

$id_pegawai = $_GET['id_pegawai'];
$data_pegawai = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama FROM admin WHERE id_admin = '$id_pegawai'"));
$query = mysqli_query($koneksi, "DELETE FROM admin WHERE id_admin = '$id_pegawai'");
if ($query) {
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'Data Pegawai ' . $data_pegawai['nama'] . ' telah dihapus!'
    ];
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Data Pegawai ' . $data_pegawai['nama'] . ' gagal dihapus!'
    ];
}
header('location: ../index.php?page=pegawai');
