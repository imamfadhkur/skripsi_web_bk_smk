<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["guru"])) {
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
    <title>home | guru</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mt-4">
        <div class="row my-4">
            <div class="col-3">
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Data Siswa</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="/desi/guru/data.php?runFunction=getDataSiswa" class="btn btn-primary">lihat</a>
  </div>
</div>
            </div>
            <div class="col-3">
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Kategori Pelanggaran</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="/desi/guru/pelanggaran.php?runFunction=getPelanggarankp" class="btn btn-primary">lihat</a>
  </div>
</div>
            </div>
            <div class="col-3">
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Tata Tertib</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="/desi/guru/pelanggaran.php?runFunction=getPelanggarantatib" class="btn btn-primary">lihat</a>
  </div>
</div>
            </div>
            <div class="col-3">
<div class="card">
  <div class="card-body">
    <h5 class="card-title">List Pelanggaran</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="/desi/guru/pelanggaran.php?runFunction=getPelanggaranlp" class="btn btn-primary">lihat</a>
  </div>
</div>
            </div>
        </div>
    </div>
</body>
</html>