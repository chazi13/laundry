<?php
include_once '../sistem/koneksi.php';
check_login(['member']);

$get_page = $_GET['page'];
switch ($get_page) {
    case 'profil_toko':
        $title = 'Profil Toko';
        $page = 'profil_toko.php';
        $pt_active = 'active';
        break;

    case 'pesanan':
        $title = 'Pesanan';
        $page = 'pesanan.php';
        $ps_active = 'active';
        break;

    case 'riwayat':
        $title = 'Riwayat Pesanan';
        $page = 'riwayat.php';
        $r_active = 'active';
        break;

    case 'edit_profil':
        $title = 'Edit Profil';
        $page = 'edit_profil.php';
        break;
    
    default:
        $title = 'Dashboard';
        $page = 'home.php';
        $d_active = 'active';
        break;
}

$info_toko = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM info_toko"));
