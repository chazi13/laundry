<?php
include_once '../../sistem/koneksi.php';

$id_member = $_GET['id_member'];
$data_pegawai = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT nama FROM member WHERE id_member = '$id_member'"));
$query = mysqli_query($koneksi, "DELETE FROM member WHERE id_member = '$id_member'");
if ($query) {
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'Data Member ' . $data_pegawai['nama'] . ' telah dihapus!'
    ];
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Data Member ' . $data_pegawai['nama'] . ' gagal dihapus!'
    ];
}
header('location: ../index.php?page=member');
