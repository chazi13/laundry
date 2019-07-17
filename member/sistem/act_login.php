<?php
include_once '../../sistem/koneksi.php';

$id = $_POST['id'];
$password = md5($_POST['password']);

$check = mysqli_query($koneksi, "SELECT * FROM member WHERE id_member = '$id' AND password = '$password'");
if (mysqli_num_rows($check) == 1) {
    $data = mysqli_fetch_assoc($check);
    $_SESSION['id'] = $data['id_member'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['jenis_kelamin'] = $data['jenis_kelamin'];
    $_SESSION['level'] = 'member';
    $_SESSION['login'] = true;
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'Selamat Datang ' . $data['nama']
    ];
    header('location: ../index.php');
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Login gagal! <br>Username atau password salah!'
    ];
    header('location: ../login.php');
}
