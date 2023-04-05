<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["siswa"])) {
    header('Location: /desi/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home | siswa</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-3">
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Konsultasi</h5>
    <p class="card-text">Konsultasikan segera permasalahan anda kepada guru BK (Bimbingan Konseling) untuk menemukan solusi atas permasalahan yang kamu hadapi :)</p>
    <a href="/desi/siswa/konsultasi.php" class="btn btn-primary">konsultasi</a>
  </div>
</div>
            </div>
        </div>
    </div>
</body>
</html>