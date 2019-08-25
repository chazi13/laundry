<?php
include_once '../../sistem/koneksi.php';

$no_coa = $_POST['no_coa'];
$nama_coa = $_POST['nama_coa'];
$gol = $_POST['gol'];
$klasifikasi = $_POST['klasifikasi'];

$query = mysqli_query($koneksi, "INSERT INTO coa (no_coa, nama_coa, gol, klasifikasi) VALUES ('$no_coa', '$nama_coa', '$gol', '$klasifikasi')");
if ($query) {
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'COA Berhasil ditambahkan'
    ];
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'COA Gagal ditambahkan'
    ];
}
header('location: ../index.php?page=coa');


/* End of File: D:\Ampps\www\project\laundry\operator\sistem\add_coa.php */