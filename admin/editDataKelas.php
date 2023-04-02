<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_POST["edit"])) {
  $row = 0;
  if ($_POST["namaLama"] !== $_POST["nama"]) {
    $sql = "SELECT * FROM kelas WHERE kelas.nama = '".$_POST["nama"]."'";
    $result = mysqli_query($con_mysqli, $sql);
    $row = mysqli_fetch_assoc($result);
  }
  if ($row >= 1) {
    header('Location: /desi/admin/data.php?pesanGagal=Data%20kelas%20yang%20anda%20masukkan%20sudah%20ada,%20silahkan%20masukkan%20data%20lainnya!&runFunction=getDataKelas');
    exit();
  }
  else {
    $update = $con_pdo->prepare("UPDATE kelas SET nama = :nama, jurusan = :jurusan, wali_kelas = :wali_kelas WHERE nama = :namaLama");
    $update->bindValue(':namaLama', $_POST['namaLama']);
    $update->bindValue(':nama', $_POST['nama']);
    $update->bindValue(':jurusan', $_POST['jurusan']);
    $update->bindValue(':wali_kelas', $_POST['wali_kelas']);
    $update->execute();
    header('Location: /desi/admin/data.php?pesanSuccess=Data%20berhasil%20di%20edit&runFunction=getDataKelas');
    exit();
  }
}

if ($_GET["nama"]) {
  $stmt = $con_pdo->prepare("SELECT * FROM kelas WHERE kelas.nama = :nama");
  $stmt->bindValue(":nama", $_GET['nama']);
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
    <title>edit data kelas</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col">
    <h2 class="my-2">Edit Data Kelas</h2>
<form action="editDataKelas.php" method="post">
  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="hidden" name="namaLama" class="form-control" value="<?php echo $value["nama"] ?>">
    <input type="text" name="nama" class="form-control" value="<?php echo $value["nama"] ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Jurusan</label>
    <select name="jurusan" class="form-control" required>
      <?php
        $query = mysqli_query($con_mysqli, "SELECT * FROM jurusan");
        while ($row_j = mysqli_fetch_array($query)) {
          ?>
          <option value="<?php echo $row_j['singkatan']?>" <?php echo $value["nama"] == $row_j["singkatan"] ? "selected" : ""; ?>><?php echo $row_j['nama']?></option>
          <?php
        }
      ?>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Wali Kelas</label>
    <select name="wali_kelas" class="form-control" required>
      <?php
        $query = mysqli_query($con_mysqli, "SELECT * FROM guru");
        while ($row_g = mysqli_fetch_array($query)) {
          ?>
          <option value="<?php echo $row_g['nip']?>" <?php echo $value["wali_kelas"] = $row_g["nip"] ? "selected" : ""; ?>><?php echo $row_g['nama']?></option>
          <?php
        }
      ?>
    </select>
  </div>
  <button type="submit" class="btn btn-primary" name="edit">Submit</button>
</form>
            </div>
        </div>
    </div>
</body>
</html>