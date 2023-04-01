<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_POST["edit"])) {
  $row = 0;
  if ($_POST["singkatanLama"] !== $_POST["singkatan"]) {
    $sql = "SELECT * FROM jurusan WHERE jurusan.singkatan = '".$_POST["singkatan"]."'";
    $result = mysqli_query($con_mysqli, $sql);
    $row = mysqli_fetch_assoc($result);
  }
  if ($row >= 1) {
    header('Location: /desi/admin/data.php?pesanGagal=Data%20jurusan%20yang%20anda%20masukkan%20sudah%20ada,%20silahkan%20masukkan%20data%20lainnya!&runFunction=getDataJurusan');
    exit();
  }
  else {
    $update = $con_pdo->prepare("UPDATE jurusan SET nama = :nama, singkatan = :singkatan WHERE singkatan = :singkatanLama");
    $update->bindValue(':singkatanLama', $_POST['singkatanLama']);
    $update->bindValue(':singkatan', $_POST['singkatan']);
    $update->bindValue(':nama', $_POST['nama']);
    $update->execute();
    header('Location: /desi/admin/data.php?pesanSuccess=Data%20berhasil%20di%20edit&runFunction=getDataJurusan');
    exit();
  }
}

if ($_GET["singkatan"]) {
  $stmt = $con_pdo->prepare("SELECT * FROM jurusan WHERE jurusan.singkatan = :singkatan");
  $stmt->bindValue(":singkatan", $_GET['singkatan']);
  $stmt->execute();
  foreach ($stmt as $key => $value) {
    # code...
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit data jurusan</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col">
    <h2 class="my-2">Edit Data Jurusan</h2>
<form action="editDataJurusan.php" method="post">
  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control" value="<?php echo $value["nama"] ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">singkatan</label>
    <input type="hidden" class="form-control" name="singkatanLama" value="<?php echo $_GET["singkatan"] ?>">
    <input type="text" class="form-control" name="singkatan" value="<?php echo $value["singkatan"] ?>">
  </div>
  <button type="submit" class="btn btn-primary" name="edit">Submit</button>
</form>
            </div>
        </div>
    </div>
</body>
</html>