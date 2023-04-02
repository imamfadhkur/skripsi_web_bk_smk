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
    $sql = "SELECT * FROM kategori_pelanggaran WHERE kategori_pelanggaran.nama_pelanggaran = '".$_POST["nama"]."'";
    $result = mysqli_query($con_mysqli, $sql);
    $row = mysqli_fetch_assoc($result);
  }
  if ($row >= 1) {
    header('Location: /desi/admin/pelanggaran.php?pesanGagal=Data%20pelanggaran%20yang%20anda%20masukkan%20sudah%20ada,%20silahkan%20masukkan%20data%20lainnya!&runFunction=getPelanggarankp');
    exit();
  }
  else {
    $update = $con_pdo->prepare("UPDATE kategori_pelanggaran SET nama_pelanggaran = :nama, poin = :poin WHERE nama_pelanggaran = :namaLama");
    $update->bindValue(':namaLama', $_POST['namaLama']);
    $update->bindValue(':nama', $_POST['nama']);
    $update->bindValue(':poin', $_POST['poin']);
    $update->execute();
    header('Location: /desi/admin/pelanggaran.php?pesanSuccess=Data%20berhasil%20di%20edit&runFunction=getPelanggarankp');
    exit();
  }
}

if ($_GET["nama"]) {
  $stmt = $con_pdo->prepare("SELECT * FROM kategori_pelanggaran WHERE nama_pelanggaran = :nama");
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
    <title>edit data pelanggaran</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="container mb-5">
        <div class="row">
            <div class="col">
    <h2 class="my-2">Edit Data Kategori Pelanggaran</h2>
<form action="editPelanggarankp.php" method="post">
  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="hidden" name="namaLama" class="form-control" value="<?php echo $value["nama_pelanggaran"] ?>">
    <input type="text" name="nama" class="form-control" value="<?php echo $value["nama_pelanggaran"] ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Poin</label>
    <input type="text" name="poin" class="form-control" value="<?php echo $value["poin"] ?>">
  </div>
  <button type="submit" class="btn btn-primary" name="edit">Submit</button>
</form>
            </div>
        </div>
    </div>
</body>
</html>