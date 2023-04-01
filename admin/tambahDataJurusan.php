<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_POST["tambah"])) {
  $stmt = $con_pdo->prepare("SELECT * FROM jurusan WHERE singkatan = :singkatan");
  $stmt->bindParam(':singkatan', $_POST["singkatan"]);
  $stmt->execute();
  $row = $stmt->rowCount();
  if ($row >= 1) {
    header('Location: /desi/admin/data.php?pesanGagal=Data%20jurusan%20yang%20anda%20masukkan%20sudah%20ada,%20silahkan%20masukkan%20data%20lainnya!&runFunction=getDataJurusan');
    exit();
  }
  else {
    $insert = $con_pdo->prepare("INSERT INTO jurusan (nama, singkatan) VALUES (:nama, :singkatan)");
    $insert->bindValue(':nama', $_POST['nama']);
    $insert->bindValue(':singkatan', $_POST["singkatan"]);
    $insert->execute();
    header('Location: /desi/admin/data.php?pesanSuccess=Data%20berhasil%20ditambahkan!&runFunction=getDataJurusan');
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah data jurusan</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col">
    <h2 class="my-2">Tambah Data Jurusan</h2>
<form action="tambahDataJurusan.php" method="post">
  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" placeholder="Pendidikan Informatika">
  </div>
  <div class="mb-3">
    <label class="form-label">Singkatan</label>
    <input type="text" class="form-control" name="singkatan" placeholder="PIF">
  </div>
  <button type="submit" class="btn btn-primary" name="tambah">Submit</button>
</form>
            </div>
        </div>
    </div>
</body>
</html>