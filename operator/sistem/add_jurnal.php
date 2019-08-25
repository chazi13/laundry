<?php
include_once '../../sistem/koneksi.php';
// var_dump($_POST);
$kode_jurnal = $_POST['kode_jurnal'];
$tanggal = $_POST['tanggal'];
$coa_id = $_POST['coa_id'];
$saldo = $_POST['saldo'];

$query = mysqli_query($koneksi, "INSERT INTO jurnal (kode_jurnal, tanggal, coa_id, saldo) VALUES ('$kode_jurnal', '$tanggal', '$coa_id', '$saldo')");
if ($query) {
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'Jurnal Berhasil ditambahkan'
    ];
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Jurnal Gagal ditambahkan'
    ];
}
header('location: ../index.php?page=jurnal');

/* End of File: d:\Ampps\www\project\laundry\operator\sistem\add_jurnal.php */