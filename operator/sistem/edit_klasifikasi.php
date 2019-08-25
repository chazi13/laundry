<?php
include_once '../../sistem/koneksi.php';
$id_klasifikasi = $_POST['id_klasifikasi'];
$nama_klasifikasi = $_POST['nama_klasifikasi'];
$query = mysqli_query($koneksi, "UPDATE klasifikasi SET nama_klasifikasi='$nama_klasifikasi' WHERE id_klasifikasi='$id_klasifikasi'");

if ($query) {
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'Klasifikasi Berhasil diubah'
    ];
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Klasifikasi Gagal diubah'
    ];
}
header('location: ../index.php?page=klasifikasi');


/* End of File: D:\Ampps\www\project\laundry\operator\sistem\edit_klasifikasi.php */