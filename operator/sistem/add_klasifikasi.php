<?php
include_once '../../sistem/koneksi.php';
$nama_klasifikasi = $_POST['nama_klasifikasi'];
$query = mysqli_query($koneksi, "INSERT INTO klasifikasi (nama_klasifikasi) VALUE ('$nama_klasifikasi')");

if ($query) {
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'Klasifikasi Berhasil ditambahkan'
    ];
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Klasifikasi Gagal ditambahkan'
    ];
}
header('location: ../index.php?page=klasifikasi');


/* End of File: D:\Ampps\www\project\laundry\operator\sistem\add_klasifikasi.php */