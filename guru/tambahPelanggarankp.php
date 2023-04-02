<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["guru"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_POST["tambah"])) {
  $stmt = $con_pdo->prepare("SELECT * FROM kategori_pelanggaran WHERE nama_pelanggaran = :nama");
  $stmt->bindParam(':nama', $_POST["nama_pelanggaran"]);
  $stmt->execute();
  $row = $stmt->rowCount();
  if ($row >= 1) {
    header('Location: /desi/guru/pelanggaran.php?pesanGagal=Data%20pelanggaran%20yang%20anda%20masukkan%20sudah%20ada,%20silahkan%20masukkan%20data%20lainnya!&runFunction=getPelanggarankp');
    exit();
  }
  else {
    $insert = $con_pdo->prepare("INSERT INTO kategori_pelanggaran (nama_pelanggaran, poin) VALUES (:nama, :poin)");
    $insert->bindValue(':nama', $_POST['nama_pelanggaran']);
    $insert->bindValue(':poin', $_POST["poin"]);
    $insert->execute();
    header('Location: /desi/guru/pelanggaran.php?pesanSuccess=Data%20berhasil%20ditambahkan!&runFunction=getPelanggarankp');
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
    <title>tambah data pelanggaran</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col">
    <h2 class="my-2">Tambah Data Kategori Pelanggaran</h2>
<form action="tambahPelanggarankp.php" method="post">
  <div class="mb-3">
    <label class="form-label">Nama Pelanggaran</label>
    <input type="text" name="nama_pelanggaran" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Poin</label>
    <input type="text" name="poin" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary" name="tambah">Submit</button>
</form>
            </div>
        </div>
    </div>
</body>
</html>