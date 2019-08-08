<?php
include_once '../../sistem/koneksi.php';
var_dump($_POST);
$kode_jurnal = $_POST['kode_jurnal'];
$tanggal = $_POST['tanggal'];
$keterangan = $_POST['keterangan'];
$jenis = $_POST['jenis'];
$nominal = $_POST['nominal'];

$query = mysqli_query($koneksi, "UPDATE `jurnal` SET `tanggal`='$tanggal',`keterangan`='$keterangan',`jenis`='$jenis',`nominal`='$nominal' WHERE `kode_jurnal`='$kode_jurnal'");
if ($query) {
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'Jurnal Berhasil diubah'
    ];
header('location: ../index.php?page=jurnal');
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Jurnal Gagal diubah'
    ];
header('location: ../index.php?page=jurnal');
}

/* End of File: d:\Ampps\www\project\laundry\operator\sistem\add_jurnal.php */