<?php
include_once 'sistem/koneksi.php';
$info_toko = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM info_toko"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $info_toko['nama_toko'] ?></title>
</head>
<body>
    
</body>
</html>