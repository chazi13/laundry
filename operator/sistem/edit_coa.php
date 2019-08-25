<?php
include_once '../../sistem/koneksi.php';

$no_coa = $_POST['no_coa'];
$nama_coa = $_POST['nama_coa'];
$gol = $_POST['edit-coa-gol'];
$klasifikasi = $_POST['klasifikasi'];

$query = mysqli_query($koneksi, "UPDATE coa SET nama_coa='$nama_coa', gol='$gol', klasifikasi='$klasifikasi' WHERE no_coa='$no_coa'");
if ($query) {
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'COA Berhasil diubah'
    ];
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'COA Gagal diubah'
    ];
}
header('location: ../index.php?page=coa');


/* End of File: D:\Ampps\www\project\laundry\operator\sistem\edit_coa.php */