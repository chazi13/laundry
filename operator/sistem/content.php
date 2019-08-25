<?php
include_once '../sistem/koneksi.php';
check_login(['Admin', 'Pegawai']);

$get_page = $_GET['page'];
switch ($get_page) {
    case 'profil_toko':
        $title = 'Profil Toko';
        $page = 'profil_toko.php';
        $pt_active = 'active';
        break;

    case 'pegawai':
        $title = 'Data Pegawai';
        $page = 'pegawai.php';
        $p_active = 'active';
        break;

    case 'add_pegawai':
        $title = 'Tambah Data Pegawai';
        $page = 'add_pegawai.php';
        $p_active = 'active';
        break;

    case 'edit_pegawai':
        $title = 'Edit Data Pegawai';
        $page = 'edit_pegawai.php';
        $p_active = 'active';
        break;

    case 'member':
        $title = 'Data Member';
        $page = 'member.php';
        $m_active = 'active';
        break;

    case 'klasifikasi':
        $title = 'Klasifikasi';
        $page = 'klasifikasi.php';
        $klasifikasi_active = 'active';
        break;

    case 'coa':
        $title = 'COA';
        $page = 'coa.php';
        $coa_active = 'active';
        break;

    case 'add_member':
        $title = 'Tambah Data Member';
        $page = 'add_member.php';
        $m_active = 'active';
        break;

    case 'edit_member':
        $title = 'Edit Data Member';
        $page = 'edit_member.php';
        $m_active = 'active';
        break;

    case 'produk':
        $title = 'Katalog Produk';
        $page = 'produk.php';
        $pk_active = 'active';
        break;

    case 'diskon':
        $title = 'Diskon';
        $page = 'diskon.php';
        $pd_active = 'active';
        break;

    case 'pesanan':
        $title = 'Pesanan';
        $page = 'pesanan.php';
        $ps_active = 'active';
        break;

    case 'laporan':
        $title = 'Laporan Transaksi';
        $page = 'laporan.php';
        $l_active = 'active';
        break;

    case 'jurnal':
        $title = 'Jurnal';
        $page = 'jurnal.php';
        $j_active = 'active';
        break;

    case 'add_pesanan':
        $title = 'Tambah Pesanan';
        $page = 'add_pesanan.php';
        $ps_active = 'active';
        break;

    case 'edit_profil':
        $title = 'Edit Profil';
        $page = 'edit_pegawai.php';
        break;
    
    default:
        $title = 'Dashboard';
        $page = 'home.php';
        $d_active = 'active';
        break;
}

$info_toko = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM info_toko"));
