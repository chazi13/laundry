<?php
include_once '../../sistem/koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$telp = $_POST['telp'];

$update_password = '';
if (@$_POST['password'] && $_POST['password'] !== '') {
    $password = md5($_POST['password']);
    $update_password = ", password = $password";
}

$query = mysqli_query($koneksi, "UPDATE member SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat', telp = '$telp' $update_password WHERE id_member = '$id'");
if ($query) {
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'Data Member Berhasil diubah'
    ];
    header('location: ../index.php?page=member');
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Data Member Gagal diubah'
    ];
    header('location: ../index.php?page=member');
}
