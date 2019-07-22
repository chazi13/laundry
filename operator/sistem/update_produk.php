<?php
include_once '../../sistem/koneksi.php';

print_r($_POST);
$id_produk = $_POST['id_produk'];
$nama_produk = $_POST['nama'];
$harga = $_POST['harga'];

$update_icon = '';
if ($_FILES['icon']['error'] == 0) {
    $path = 'assets/img/produk/';
    if (!file_exists('../../' . $path)) {
        mkdir('../../' . $path);
    }
    $ext = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
    $filename = round(microtime(date('d-Y-H'))) . '-' . strtolower(str_replace(' ', '-', $nama_produk));
    $full_path = $path . $filename . '.' . $ext;
    move_uploaded_file($_FILES['icon']['tmp_name'], '../../' . $full_path);
    $update_icon = ", icon = '$full_path'";
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Icon/gambar gagal diupload'
    ];
    header('location: ../index.php?page=produk');
}

$query = mysqli_query($koneksi, "UPDATE produk SET nama = '$nama_produk', harga = '$harga'$update_icon WHERE id_produk = '$id_produk'");
if ($query) {
    $_SESSION['pesan'] = [
        'status' => 'success',
        'msg' => 'Katalog Produk berhasil diupdate!'
    ];
} else {
    $_SESSION['pesan'] = [
        'status' => 'error',
        'msg' => 'Katalog Produk gagal diupdate!'
    ];
}

header('location: ../index.php?page=produk');
