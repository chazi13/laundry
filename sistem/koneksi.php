<?php

$koneksi = mysqli_connect('localhost', 'root', 'mysql', 'laundry');
session_start();

if (!$koneksi) {
    echo "Koneksi ke database gagal!";
}

function check_login()
{
    if (!@$_SESSION['login']) {
        header('location: login.php');
    }
}
