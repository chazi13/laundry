<?php
include_once '../../sistem/koneksi.php';

$nama_produk = $_POST['nama'];
$harga = $_POST['harga'];

if ($_FILES['icon']['error'] == 0) {
    $path = 'assets/img/produk/';
    if (!file_exists('../../' . $path)) {
        mkdir('../../' . $path);
    }
    $ext = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
    $filename = round(microtime(date('d-Y-H'))) . strtolower(str_replace(' ', '-', $nama_produk));
    $full_path = $path . $filename . '.' . $ext;
    move_uploaded_file($_FILES['icon']['tmp_name'], '../../' . $full_path);
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Icon/gambar gagal diupload'
    ];
    header('location: ../index.php?page=produk');
}

$query = mysqli_query($koneksi, "INSERT INTO produk (nama, icon, harga) VALUES ('$nama_produk', '$full_path', '$harga')");
if ($query) {
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'Katalog Produk berhasil ditambahkan!'
    ];
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Katalog Produk gagal ditambahkan!'
    ];
}

header('location: ../index.php?page=produk');
