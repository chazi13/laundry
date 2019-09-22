<?php
error_reporting(0);
$koneksi = mysqli_connect('localhost', 'root', '', 'laundry');
session_start();

if (!$koneksi) {
    echo "Koneksi ke database gagal!";
}

function check_login($level = '')
{
    if (!@$_SESSION['login']) {
        header('location: login.php');
    }

    if ($level !== '') {
        if (is_array($level)) {
            if (@$_SESSION['login'] && !in_array($_SESSION['level'], $level)) {
                header('location: login.php');
            }
        } else {
            if (@$_SESSION['login'] && $_SESSION['level'] !== $level) {
                header('location: login.php');
            }
        }
    }
}
