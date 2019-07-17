<?php
session_start();

session_destroy();
$_SESSION['pesan'] = [
    'status' => 'success',
    'msg' => 'Terima Kasih Telah Menggunakan Aplikasi Kami '
];
header('location: ../login.php');
