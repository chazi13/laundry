<?php

$koneksi = mysqli_connect('localhost', 'operator1', 'operator1', 'laundry');
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
