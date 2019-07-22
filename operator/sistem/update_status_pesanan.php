<?php
include_once '../../sistem/koneksi.php';

$status = $_GET['s'];
$kode_transaksi = base64_decode($_GET['k']);

switch ($status) {
    case '2':
        $new_status = 'Telah Selesai Dikerjakan';
        break;

    case '3':
        $new_status = 'Sedang Dikirim';
        break;

    case '3':
        $new_status = 'Telah Selesai';
        break;

    case '1':
    default:
        $new_status = 'Sedang Dikerjakan';
        break;
}

$query = mysqli_query($koneksi, "UPDATE transaksi SET status = '$status' WHERE kode_transaksi = '$kode_transaksi'");
if ($query) {
    mysqli_query($koneksi, "INSERT INTO log_transaksi (pegawai, status, kode_transaksi) VALUES ('$_SESSION[nama]', '$status', '$kode_transaksi')");
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'Staus Pesanan Diupdate Menjadi ' . $new_status
    ];
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Gagal Mengupdate Status Pesanan'
    ];
}

header('location: ../index.php?page=pesanan');
