<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["admin"])) {
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
    <title>home | admin</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mt-4">
        <div class="row">
            <div class="col-3">
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Data Guru</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="/desi/admin/data.php?runFunction=getDataGuru" class="btn btn-primary">lihat</a>
  </div>
</div>
            </div>
            <div class="col-3">
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Data Jurusan</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="/desi/admin/data.php?runFunction=getDataJurusan" class="btn btn-primary">lihat</a>
  </div>
</div>
            </div>
            <div class="col-3">
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Data Kelas</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="/desi/admin/data.php?runFunction=getDataKelas" class="btn btn-primary">lihat</a>
  </div>
</div>
            </div>
            <div class="col-3">
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Data Siswa</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="/desi/admin/data.php?runFunction=getDataSiswa" class="btn btn-primary">lihat</a>
  </div>
</div>
            </div>
        </div>
    </div>
</body>
</html>