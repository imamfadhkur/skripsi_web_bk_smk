<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_POST["tambah"])) {
  $stmt = $con_pdo->prepare("SELECT * FROM kelas WHERE nama = :nama");
  $stmt->bindParam(':nama', $_POST["nama"]);
  $stmt->execute();
  $row = $stmt->rowCount();
  if ($row >= 1) {
    header('Location: /desi/admin/data.php?pesanGagal=Data%20kelas%20yang%20anda%20masukkan%20sudah%20ada,%20silahkan%20masukkan%20data%20lainnya!&runFunction=getDataKelas');
    exit();
  }
  else {
    $insert = $con_pdo->prepare("INSERT INTO kelas (nama, jurusan, wali_kelas) VALUES (:nama, :jurusan, :wali_kelas)");
    $insert->bindValue(':nama', $_POST['nama']);
    $insert->bindValue(':jurusan', $_POST["jurusan"]);
    $insert->bindValue(':wali_kelas', $_POST["wali_kelas"]);
    $insert->execute();
    header('Location: /desi/admin/data.php?pesanSuccess=Data%20berhasil%20ditambahkan!&runFunction=getDataKelas');
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
    <title>tambah data kelas</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col">
    <h2 class="my-2">Tambah Data Kelas</h2>
<form action="tambahDataKelas.php" method="post">
  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" placeholder="contoh: X IPA 1" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Jurusan</label>
    <select name="jurusan" class="form-control" required>
      <?php
        $query = mysqli_query($con_mysqli, "SELECT * FROM jurusan");
        while ($row = mysqli_fetch_array($query)) {
          echo '<option value="'.$row['singkatan'].'">'.$row['nama'].'</option>';
        }
      ?>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Wali Kelas</label>
    <select name="wali_kelas" class="form-control" required>
      <?php
        $query = mysqli_query($con_mysqli, "SELECT * FROM guru");
        while ($row = mysqli_fetch_array($query)) {
          echo '<option value="'.$row['nip'].'">'.$row['nama'].'</option>';
        }
      ?>
    </select>
  </div>
  <button type="submit" class="btn btn-primary" name="tambah">Submit</button>
</form>
            </div>
        </div>
    </div>
</body>
</html>