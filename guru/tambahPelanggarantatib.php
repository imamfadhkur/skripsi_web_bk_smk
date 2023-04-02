<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["guru"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_POST["tambah"])) {
  $stmt = $con_pdo->prepare("SELECT * FROM tata_tertib WHERE jenis_tatib = :nama");
  $stmt->bindParam(':nama', $_POST["jenis_tatib"]);
  $stmt->execute();
  $row = $stmt->rowCount();
  if ($row >= 1) {
    header('Location: /desi/guru/pelanggaran.php?pesanGagal=Data%20pelanggaran%20yang%20anda%20masukkan%20sudah%20ada,%20silahkan%20masukkan%20data%20lainnya!&runFunction=getPelanggarantatib');
    exit();
  }
  else {
    $insert = $con_pdo->prepare("INSERT INTO tata_tertib (jenis_tatib, keterangan) VALUES (:nama, :keterangan)");
    $insert->bindValue(':nama', $_POST['jenis_tatib']);
    $insert->bindValue(':keterangan', $_POST["keterangan"]);
    $insert->execute();
    header('Location: /desi/guru/pelanggaran.php?pesanSuccess=Data%20berhasil%20ditambahkan!&runFunction=getPelanggarantatib');
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
    <title>tambah data tata tertib</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col">
    <h2 class="my-2">Tambah Data Tata Tertib</h2>
<form action="tambahPelanggarantatib.php" method="post">
  <div class="mb-3">
    <label class="form-label">Jenis Tata Tertib</label>
    <input type="text" name="jenis_tatib" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Keterangan</label>
    <input type="text" name="keterangan" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary" name="tambah">Submit</button>
</form>
            </div>
        </div>
    </div>
</body>
</html>